<html lang="en">
<head>

<?php
		include_once("components/com_career/template/print.php");
		include_once("components/com_career/template/temp.php");
		include_once("components/com_career/template/bootstrap.php");
		$myprocess = new process();
		$profile = 0;
		$email = "";
		$temp = 0;
		$career_id = 0;
		//echo $_SESSION["session"]["Id"];
		if(!empty($_REQUEST['idProfile']) && $_SESSION["session"]["Id"] != NULL)
		{
			
			$result = $myprocess->getThongTinCaNhan($_REQUEST['idProfile']);
			$row = $result->fetch();
			
		}else{
			return false;
		}
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
.step-content {
    margin-top: 0px !important;
    padding: 0;
}
.cv-mode-finish .cv-template-14 .posAreaName {
    right: 0px;
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
								<div id="ZoneShowCVTemplate" class="cv-template-wrapper cv-template-14 fontCVRoboto clrYellow fontCVsize14">
									<div class="subCVpage">
										<div class="posAreaName">
											<div class="name">
												<h2 style="text-transform: uppercase;"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></h2>
												<h4><?php echo $row['tieudehoso'] ?></h4>
												<ul class="contact">
													<li><i class="fa fa-phone"></i><span><?php echo $row['mobile'] ?></span></li>
													<li class="dbl-line"><i class="fa fa-envelope"></i><span><?php echo $row['email'] ?></span></li>
													<li class="dbl-line"><i class="fa fa-home"></i><span class="txt"><?php echo $row['diachi'] ?></span></li>
												</ul>
											</div>
										</div>
										<div class="col-sm-6 box-profile">
											<div class="iavatar"><img src="<?php echo $row['hinhanh'] ?>"></div>
											<h3><span>Thông tin cá nhân</span></h3>
											<ul class="contact">
												<li><label>Giới tính</label><div class="annou">:  <?php echo $row['gender'] ?> </div></li>
												<li><label>Ngày sinh</label><div class="annou">: <?php echo date("d/m/Y", strtotime($row['birthday'])) ?></div></li>
												<li><label>Tình trạng hôn nhân</label><div class="annou">:  <?php echo $row['tinhtranghonnhan'] ?></div></li>		
											</ul>
										</div>
										<div class="col-xs-12">
											<?php /* TẠM GỠ
											<div class="col-sm-6 col-skill">
												<h3><span>Kỹ năng</span></h3>
												<ul class="skill">
													<?php
														$kynangchuyenmon = explode("|", $row['kynangchuyenmon']);
														$mucdo = explode("|", $row['mucdo']);
														for($num_ = 0; $num_ < count($kynangchuyenmon); $num_++){
													?>
														<li class="ite-skill">
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
											<div class="col-sm-6 col-language">
												<h3><span>Học vấn</span></h3>
												<!--<div class="content_fck">
													<p>Bằng cấp cao nhất: <?php echo $row['bangcapcaonhat'] ?></p>
												</div>-->
												<?php
														$truongkhoahoc = explode("|", $row['truongkhoahoc']);
														$bangcap1 = explode("|", $row['bangcap1']);
														$bangcap1khac = explode("|", $row['bangcap1khac']);
														$bangcap2 = explode("|", $row['bangcap2']);
														$bangcap2khac = explode("|", $row['bangcap2khac']);
														$thoigianhoc = explode("|", $row['thoigianhoc']);
														$motachitiet = explode("|", $row['motachitiet']);
														for($num_ = 0; $num_ < count($truongkhoahoc); $num_++){
															$arrTGH = explode(" đến ", $thoigianhoc[$num_]);
															$arrDateStart = explode("/", $arrTGH[0]);
															$arrDateEnd = explode("/", $arrTGH[1]);
													?>
												<div class="exp text-edt">
													<div class="title_">
														- <?php echo $bangcap1[$num_] ?><?php if(!empty($bangcap2[$num_])){ ?>(<?php echo $bangcap2[$num_] ?>) <?php } ?> 
														- <?php echo $truongkhoahoc[$num_] ?><br>
														- Ngày tốt nghiệp: <?php echo $thoigianhoc[$num_]?>
													
													</div>
													<?php if(!empty($bangcap1khac[$num_])) { ?>
														<div class="title_">
															<?php echo $bangcap1khac[$num_] ?><br>
														</div>
														<?php } ?>
													<div class="content_fck">
														<p><?php echo $motachitiet[$num_] ?></p>
													</div>
												</div>
												<?php }?>
											</div>
											
											</div>
										</div>
										<div class="content">
											<div class="col-xs-12">
												
												<h3><span>Kinh Nghiệm Làm Việc</span></h3>
												<div class="content_fck">
													<p>Số năm kinh nghiệm: <?php echo $row['kinhnghiem'] ?> năm</p>
													<!--<p>Cấp bậc hiện tại: <?php echo $row['capbachientai'] ?></p> -->
												</div>
												<?php
													$vitrichucdanh = explode("|", $row['vitrichucdanh']);
													$congty = explode("|", $row['congty']);
													$thoigianlamviec = explode("|", $row['thoigianlamviec']);
													$motacongviec = explode("|", $row['motacongviec']);
													for($num_ = 0; $num_ < count($vitrichucdanh); $num_++){
												?>
												<div class="text-edt">
													<div class="title_">
														- Nơi làm việc: <?php echo $congty[$num_] ?><br>
														- Vị trí / Chức danh: <?php echo $vitrichucdanh[$num_] ?> <br> 
														- Thời gian làm việc: <?php echo $thoigianlamviec[$num_] ?> <br>
													</div>
													<div class="content_fck">
														<p><?php echo $motacongviec[$num_] ?></p>
													</div>
												</div>
												<?php }?>
												<h3><span>Ngôn ngữ</span></h3>
												<ul class="skill">
													<?php
														$arrTDNN = explode(",", $row['trinhdongoaingu']);
														foreach($arrTDNN as $key => $value){
															$arrVal = explode(":", $value);
															$star = 0;
															if($arrVal[1] == 'Bản ngữ'){
																			$star = 'Sơ cấp';
																		}else if($arrVal[1] == 'Sơ cấp'){
																			$star = 'Sơ cấp';
																		}else if($arrVal[1] == 'Trung cấp'){
																			$star = 'Trung cấp';
																		}else if($arrVal[1] == 'Cao cấp'){
																			$star = 'Cao cấp';
																		}
													?>
													<li>
														<label><?php echo $arrVal[0] ?></label>
														<div class="point">
															<?php echo $star ?>
														</div>
													</li>
													<?php }?>
												</ul>
												<h3><span>Công việc mong muốn</span></h3>
												<ul class="personal">
													<li><label>Cấp bậc </label><div class="annou">: Mới tốt nghiệp</div></li>
													<li><label>Mức lương</label><div class="annou">: <?php echo $row['mucluong'] ?></div></li>
													<li><label>Hình thức làm việc</label><div class="annou">: <?php echo str_replace("|", ", ", $row['hinhthuclamviec']) ?></div></li>
													
													<li><label>Nơi làm việc</label><div class="annou">: <?php echo $row['noilamviecmongmuon'] ?></div></li>
												</ul>
												<h3><span>Mục tiêu nghề nghiệp</span></h3>
												<div class="text-edt">
													<div class="content_fck">
														<p><?php echo $row['muctieunghenghiep'] ?></p>
													</div>
												</div>
												
												
												
												<!-- <h3><span>Thông Tin Tham Khảo</span></h3>
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
												<?php }?> -->
												<h3>KỶ NĂNG & THÀNH TÍCH NỔI BẬT</h3>
												<div class="content_fck">
													 <?php echo $row['thanhtichnoibat'] ?>
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