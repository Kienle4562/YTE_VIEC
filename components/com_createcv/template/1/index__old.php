<html lang="en">
<head>
	<?php
		include_once("components/com_createcv/template/1/print.php");
		include_once("components/com_createcv/template/1/temp.php");
		include_once("components/com_createcv/template/1/bootstrap.php");
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
    height: 850px;
    overflow: hidden;
    color: #58595b;
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
						<div class="">
							<div class="">
								<div id="ZoneShowCVTemplate" class="cv-template-wrapper cv-template-6 clrGreenBlueLight2 fontCVsize14">
									<!--<div class="col-xs-12 coverCVpage">
										<table class="table-responsive table-wrapper">
											<tbody>
												<tr>
													<td valign="top" style="padding-top: 15%">
														<div class="posRelative">
															<div class="top">
																<div class="left-h">
																	<div class="progress-circle">
																		<div class="avatar">
																			<img src="<?php echo $row['hinhanh'] ?>">
																			</div>
																		</div>
																	</div>
																	<div class="right-h">
																		<div class="name">
																			<h2><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></h2>
																			<h4><?php echo $row['tieudehoso'] ?></h4>
																		</div>
																	</div>
																</div>
															</div>
														</td>
													</tr>
												</tbody>
											</table>
										</div>-->
										<div class="col-xs-12 subCVpage">
											<div class="top">
												<div class="left-h">
													<div class="progress-circle">
														<div class="avatar">
															<img src="<?php echo $row['hinhanh'] ?>">
															</div>
														</div>
														<ul class="contact">
															<li>
																<i class="fa fa-phone"></i> <?php echo $row['mobile'] ?>
															</li>
															<li style="width:400px" class="email">
																<i class="fa fa-envelope"></i> <?php echo $email ?>
															</li>
														</ul>
													</div>
													<div class="right-h">
														<div class="name">
															<h2><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></h2>
															<h4><?php echo $row['tieudehoso'] ?></h4>
														</div>
														<h3>Mục tiêu nghề nghiệp</h3>
														<div class="text-edt">
															<div class="content_fck">
																<p><?php echo $row['muctieunghenghiep'] ?></p>
															</div>
														</div>
													</div>
												</div>
												<div class="content">
													<h3>Thông tin cá nhân</h3>
													<ul class="contact">
														<li>
															<label>Giới tính </label> :  <?php echo $row['gender'] ?>
														</li>
														<li>
															<label>Ngày sinh </label> : <?php echo date("d/m/Y", strtotime($row['birthday'])) ?> 
														</li>
														<li>
															<label>Tình trạng hôn nhân </label> :  <?php echo $row['tinhtranghonnhan'] ?> 
														</li>
														<li>
															<label>Địa chỉ</label> : <?php echo $row['diachi'] ?> 
														</li>
													</ul>
													<h3>Thông tin công việc</h3>
													<ul class="contact">
														<li>
															<label>Cấp bậc mong muốn</label> : <?php echo $row['capbacmongmuon'] ?> 
														</li>
														<li>
															<label>Mức lương</label> :  <?php echo $row['mucluong'] ?>
														</li>
														<li>
															<label>Hình thức làm việc</label> : <?php echo str_replace("|", ", ", $row['hinhthuclamviec']) ?>
														</li>
														<!--<li>
															<label>Ngành nghề</label> :  <?php echo $row['nganhnghe'] ?>
														</li>-->
														<li>
															<label>Nơi làm việc mong muốn</label> : <?php echo $row['noilamviecmongmuon'] ?>
														</li>
													</ul>
													<h3>Kinh nghiệm </h3>
													<div class="content_fck">
														<p>Số năm kinh nghiệm: <?php echo $row['kinhnghiem'] ?>  </p>
														<p>Cấp bậc hiện tại: <?php echo $row['capbachientai'] ?></p>
													</div>
													<?php
														$vitrichucdanh = explode("|", $row['vitrichucdanh']);
														$congty = explode("|", $row['congty']);
														$thoigianlamviec = explode("|", $row['thoigianlamviec']);
														$motacongviec = explode("|", $row['motacongviec']);
														for($num_ = 0; $num_ < count($vitrichucdanh); $num_++){
													?>
													<div class="exp text-edt">
														<div class="title">
															- Công ty: <?php echo $congty[$num_] ?></br> 
															- Vị trí / Chức danh: <?php echo $vitrichucdanh[$num_] ?></br>
															- Thời gian làm việc: <?php echo $thoigianlamviec[$num_] ?>
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
														$thoigianhoc = explode("|", $row['thoigianhoc']);
														for($num_ = 0; $num_ < count($truongkhoahoc); $num_++){
															$arrBangCap = explode(":", $bangcap[$num_]);
													?>
													<div class="exp text-edt">
														<div class="title">
															Ngày tốt nghiệp: <?php echo $thoigianhoc[$num_]?><br>
															<?php echo $arrBangCap[0] ?> - <?php echo $truongkhoahoc[$num_] ?><br>
														</div>
														<div class="content_fck">
															<p><?php echo $motachitiet[$num_] ?></p>
														</div>
													</div>
													<?php }?>
													<div class="one-col">
														<?php /* TẠM GỠ
														<div class="col1">
															<h3>Kỹ năng chuyên môn</h3>
															<ul class="skill">
															<?php
																$kynangchuyenmon = explode("|", $row['kynangchuyenmon']);
																$mucdo = explode("|", $row['mucdo']);
																for($num_ = 0; $num_ < count($kynangchuyenmon); $num_++){
															?>
																<li>
																	<label><?php echo $kynangchuyenmon[$num_] ?></label>
																	<div class="point">
																		<?php
																			for($star=1;$star<=$mucdo[$num_];$star++){
																		?>
																		<i class="fa fa-star"></i>
																		<?php }?>
																	</div>
																</li>
															<?php }?>
															</ul>
														</div>
														*/?>
														<div class="col2">
															<h3>Trình độ ngoại ngữ</h3>
															<ul class="skill">
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
																<li>
																	<label><?php echo $arrVal[0] ?></label>
																	<div class="point">
																		<?php
																			for($i=1;$i<=$star;$i++){
																		?>
																		<i class="fa fa-star"></i>
																		<?php }?>
																	</div>
																</li>
																<?php }?>
															</ul>
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
				</div>
			</div>
		</body>
</html>