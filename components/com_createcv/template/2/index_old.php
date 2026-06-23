<html lang="en">
<head>
	<?php
		include_once("components/com_createcv/template/print.php");
		include_once("components/com_createcv/template/temp.php");
		include_once("components/com_createcv/template/bootstrap.php");
		$myprocess = new process();

		$profile = 0;
		$email = "";
		$temp = 0;
		$career_id = 0;

		if(isset($_REQUEST['temp'])){
			$email = $_REQUEST['email'];
			$temp = $_REQUEST['temp'];
			$profile = $_REQUEST['profile'];
			$career_id = $_REQUEST['career_id'];
		}else if(!empty($_SESSION["career"]["career_id"]) && $_SESSION["career"]["career_id"] != NULL){
			$email = $_SESSION['career']['email'];
			$profile = $_SESSION["career"]["profile"];
			$temp = $_SESSION["career"]["temp"];
			$career_id = $_SESSION["career"]["career_id"];
		}else{
			return false;
		}

		if($myprocess->checkTemplate($temp)){
			if(!$myprocess->checkProfile($profile, $career_id)){
				return false;
			}
		}else{
			return false;
		}
		$result = $myprocess->getThongTinCaNhan($career_id, $profile);
		$row = $result->fetch();
	?>
	<meta charset="utf8">
</head>
<style>
.cv-template-wrapper {
    margin-bottom: 0;
	box-shadow: none;
}
.step-content {
    margin-top: 0;
    padding: 0;
}
body{
	font-family: Verdana, Geneva, sans-serif;
}
.cv-template-6 .top {
    padding-bottom: 30px;
}
</style>
<body class="jobseeker_site A-Bootstrap">
	<div id="uni_wrapper">
		<div class="swc-wrapper">
			<div class="">
				<div class="">
					<div class="step-content cv-mode-finish" id="Step4" style="display: block;">
						<div class="editCVtemplate-wrapper editCVtemplate">
							<div class="">
								<div id="ZoneShowCVTemplate" class="cv-template-wrapper cv-template-4 fontCVRoboto clrBlackRed fontCVsize14">
									<!--<div class="col-xs-12 coverCVpage">
										<table class="table-responsive table-wrapper">
											<tbody>
												<tr>
													<td valign="top">
														<div class="right-col">
															<header>
																<table class="table-responsive" cellpadding="0" cellspacing="0">
																	<tbody>
																		<tr>
																			<td><img src="<?php echo $row['hinhanh'] ?>"></td>
																		</tr>
																	</tbody>
																</table>
																<h2><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></h2>
																<h4><?php echo $row['tieudehoso'] ?></h4>
																<div class="bgtf"></div>
															</header>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>-->
									<div class="col-xs-12 subCVpage">
										<div class="col-xs-5 left-col">
											<header>
												<table class="table-responsive" cellpadding="0" cellspacing="0">
													<tbody>
														<tr>
															<td><img src="<?php echo $row['hinhanh'] ?>"></td>
														</tr>
													</tbody>
												</table>
											</header>
											<div class="col-xs-12 content">
												<ul class="contact">
													<li><i class="fa fa-phone"></i> <?php echo $row['mobile'] ?></li>
													<li><i class="fa fa-home"></i> <?php echo $row['diachi'] ?> </li>
													<li class="email"><i class="fa fa-envelope"></i><span><?php echo $email ?></span></li>
												</ul>
												<?php /* TẠM GỠ
												<h3>Kỹ năng</h3>
												<div class="skill-blck">
													<?php
														$kynangchuyenmon = explode("|", $row['kynangchuyenmon']);
														$mucdo = explode("|", $row['mucdo']);
														for($num_ = 0; $num_ < count($kynangchuyenmon); $num_++){
													?>
														<div class="ite-skill">
															<label><?php echo $kynangchuyenmon[$num_] ?></label>
															<div class="point">
																<?php
																	for($star=1;$star<=$mucdo[$num_];$star++){
																?>
																<span></span>
																<?php }?>
															</div>
														</div>
													<?php }?>
												</div>
												*/?>
												<h3>Ngôn ngữ</h3>
												<div class="skill-blck">
													<?php
														$arrTDNN = explode(",", $row['trinhdongoaingu']);
														foreach($arrTDNN as $key => $value){
															$arrVal = explode(":", $value);
															$star = 0;
															if($arrVal[1] == 'Bản ngữ'){
																$star = 1;
															}else if($arrVal[1] == 'Sơ cấp'){
																$star = 2;
															}else if($arrVal[1] == 'Trung cấp'){
																$star = 3;
															}else if($arrVal[1] == 'Cao cấp'){
																$star = 5;
															}
													?>
													<div class="ite-skill">
														<label><?php echo $arrVal[0] ?></label>
														<div class="point">
															<?php
																for($i=1;$i<=$star;$i++){
															?>
															<span></span>
															<?php }?>
														</div>
													</div>
													<?php }?>													
												</div>
											</div>
										</div>


										<div class="col-xs-7 right-col" id="full_height">
											<header>
												<h2 id="height"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></h2>
												<h4><?php echo $row['tieudehoso'] ?></h4>
												<div class="bgtf"></div>
											</header>
											<div class="col-xs-12 content">
												<h3>Thông tin cá nhân</h3>
												<ul class="personal">
													<li><label>Giới tính</label><div class="annou">:  <?php echo $row['gender'] ?> </div></li>
													<li><label>Ngày sinh</label><div class="annou">: <?php echo date("d/m/Y", strtotime($row['birthday'])) ?></div></li>
													<li><label>Tình trạng hôn nhân</label><div class="annou">:  <?php echo $row['tinhtranghonnhan'] ?></div></li>		
												</ul>
												<h3>Thông tin công việc</h3>
													<ul class="personal">
														<li><label>Cấp bậc </label><div class="annou">: Mới tốt nghiệp</div></li>
														<li><label>Mức lương</label><div class="annou">: <?php echo $row['mucluong'] ?></div></li>
														<li><label>Hình thức làm việc</label><div class="annou">: <?php echo str_replace("|", ", ", $row['hinhthuclamviec']) ?></div></li>
														<li><label>Ngành nghề</label><div class="annou">: <?php echo $row['nganhnghe'] ?></div></li>
														<li><label>Nơi làm việc</label><div class="annou">: <?php echo $row['noilamviecmongmuon'] ?></div></li>
													</ul>
												<h3>Mục tiêu nghề nghiệp</h3>
												<div class="text-edt">
													<div class="content_fck">
														<p><?php echo $row['muctieunghenghiep'] ?></p>
													</div>
												</div>
												<h3>Kinh Nghiệm Làm Việc</h3>
												<div class="content_fck">
													<p>Số năm kinh nghiệm: <?php echo $row['kinhnghiem'] ?></p>
													<p>Cấp bậc hiện tại: <?php echo $row['capbachientai'] ?></p>
												</div>
												<?php
													$vitrichucdanh = explode("|", $row['vitrichucdanh']);
													$congty = explode("|", $row['congty']);
													$thoigianlamviec = explode("|", $row['thoigianlamviec']);
													$motacongviec = explode("|", $row['motacongviec']);
													for($num_ = 0; $num_ < count($vitrichucdanh); $num_++){
												?>
												<div class="text-edt">
													<div class="title">
														<i class="fa fa-circle"></i>
														- Công ty: <?php echo $congty[$num_] ?></br> 
														- Vị trí / Chức danh: <?php echo $vitrichucdanh[$num_] ?></br>
														- Thời gian làm việc: <?php echo $thoigianlamviec[$num_] ?> </br>
													</div>
													<div class="content_fck">
														<p><?php echo $motacongviec[$num_] ?></p>
													</div>
												</div>
												<?php }?>
												<h3>Học vấn</h3>
												<div class="content_fck">
													<p>Bằng cấp cao nhất: <?php echo $row['bangcapcaonhat'] ?></p>
												</div>
												<?php
													$truongkhoahoc = explode("|", $row['truongkhoahoc']);
													$bangcap = explode("|", $row['bangcap']);
													$motachitiet = explode("|", $row['motachitiet']);
													for($num_ = 0; $num_ < count($truongkhoahoc); $num_++){
														$arrBangCap = explode(":", $bangcap[$num_]);
												?>
												<div class="exp text-edt">
													<div class="title">
													<i class="fa fa-circle"></i> 
														Ngày tốt nghiệp: <?php echo $arrBangCap[1] ?><br>
														<?php echo $arrBangCap[0] ?> - <?php echo $truongkhoahoc[$num_] ?><br>
													</div>
													<div class="content_fck">
														<p><?php echo $motachitiet[$num_] ?></p>
													</div>
												</div>
												<?php }?>
												<!--<h3>Thông Tin Tham Khảo</h3>
												<?php
													$tennguoithamkhao = explode("|", $row['tennguoithamkhao']);
													$chucvunguoithamkhao = explode("|", $row['chucvunguoithamkhao']);
													$congtynguoithamkhao = explode("|", $row['congtynguoithamkhao']);
													$dienthoainguoithamkhao = explode("|", $row['dienthoainguoithamkhao']);
													$emailnguoithamkhao = explode("|", $row['emailnguoithamkhao']);
													for($num_ = 0; $num_ < count($tennguoithamkhao); $num_++){
												?>
												<div class="text-edt">
													<div class="title" style="padding-left: 0"><?php echo $tennguoithamkhao[$num_] ?></div>
													<div class="content_fck">
														<p>Chức vụ: <?php echo $chucvunguoithamkhao[$num_] ?></p>
														<p>Công ty: <?php echo $congtynguoithamkhao[$num_] ?></p>
														<p>Điện thoại: <?php echo $dienthoainguoithamkhao[$num_] ?></p>
														<p>Email: <?php echo $emailnguoithamkhao[$num_] ?></p>
													</div>
												</div>
												<?php }?>
												-->
											</div>
										</div>						
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>