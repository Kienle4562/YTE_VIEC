<html lang="en">
<head>
	<?php
		include_once("components/com_createcv/template/5/css/app.php");
		include_once("components/com_createcv/template/5/css/cv.php");
		include_once("components/com_createcv/template/5/css/print.php");
		include_once("components/com_createcv/template/5/css/reset.php");
		include_once("components/com_createcv/template/5/css/style.php");
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
.cvo-document .cvo-subpage {
    padding: 5mm;
    min-height: 295mm;
}
#cv-layout-viewer {
    margin-top: 0;
    margin-bottom: 0;
}
</style>
<body id="cv-viewer">
    <div id="cv-layout-viewer">
        <div id="cvo-document-root">
            <div id="cvo-document" class="cvo-document">
                <div class="cvo-page">
                    <div class="cvo-subpage">
                        <div id="cvo-body">

                            <div id="cvo-main">

                                <div id="group-header">

                                    <div class="cvo-block" id="cvo-profile">
                                        <table id="profile-table">
                                            <tr>
                                                <td>
												
                                                    <span id="cvo-profile-fullname"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></span>
                                                </td>
                                                <td class="avatar-wraper" rowspan="9" class="avatar" id="avatar">
													<img  id="cvo-profile-avatar" src="<?php echo $row['hinhanh'] ?>">
                                                   
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Ngày sinh</span>
                                                    <span class="profile-field" id="cvo-profile-dob"><?php echo $row['birthday'] ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Giới tính</span>
                                                    <span class="profile-field" id="cvo-profile-gender"> <?php echo $row['gender'] ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Điện thoại</span>
                                                    <span class="profile-field" id="cvo-profile-phone"><?php echo $row['mobile'] ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Email</span>
                                                    <span class="profile-field" id="cvo-profile-email"><?php echo $email ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Địa chỉ</span>
                                                    <span class="profile-field" id="cvo-profile-address"> <?php echo $row['diachi'] ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Hôn nhân  </span>
                                                    <span class="profile-field" id="cvo-profile-website"><?php echo $row['tinhtranghonnhan'] ?> </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div id="group-content">
                                    <div class="cvo-block" id="cvo-objective">
                                        <h3 class="cvo-block-title"><span id="cvo-objective-blocktitle">Mục tiêu nghề nghiệp</span></h3>
                                        <div class="block-body">
                                            <div id="cvo-objective-objective">
                                              <?php echo $row['muctieunghenghiep'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cvo-block" id="cvo-education">
                                        <h3 class="cvo-block-title"><span id="cvo-education-blocktitle">Học vấn</span></h3>
                                        <div id="education-table">
											<?php
														$truongkhoahoc = explode("|", $row['truongkhoahoc']);
														$bangcap = explode("|", $row['bangcap']);
														$motachitiet = explode("|", $row['motachitiet']);
														for($num_ = 0; $num_ < count($truongkhoahoc); $num_++){
															$arrBangCap = explode(":", $bangcap[$num_]);
													?>
                                            <div class="row ">
                                                <div class="time">
                                                    <span class="cvo-education-start start"><?php echo $arrBangCap[1] ?></span>
                                                    <?php echo $arrBangCap[0] ?> - <?php echo $truongkhoahoc[$num_] ?>
                                                </div>
                                                <div class="school">
                                                    <span class="cvo-education-school"><?php echo $row['truongkhoahoc']?></span>
                                                    <span class="cvo-education-title"><?php if(!empty($row['bangcap'])){?>Chuyên ngành: <?php echo $row['bangcap'] ?> <?php } ?></span>
                                                    <span class="cvo-education-details">Bằng cấp: <?php echo $row['bangcap1'] ?></span>
                                                </div>
                                                <div style="clear: both"></div>
                                            </div>
											<?php }?>
                                            
                                        </div>
                                    </div>
                                    <div class="cvo-block" id="cvo-additional-info">
                                        <h3 class="cvo-block-title"><span id="cvo-additional-info-blocktitle">Công việc mong muốn</span></h3>
                                        <div class="block-body">
                                            <div id="cvo-additional-information-details">
                                                - Cấp bậc mong muốn: <?php echo $row['capbacmongmuon'] ?>
                                                <br />- Mức lương: <?php echo $row['mucluong'] ?>
                                                <br />- Hình thức làm việc: <?php echo $row['hinhthuclamviec'] ?>
                                                <br />- Nơi làm việc mong muốn: <?php echo $row['noilamviecmongmuon'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cvo-block" id="cvo-experience">
                                        <h3 class="cvo-block-title"><span id="cvo-experience-blocktitle">Kinh nghiệm làm việc <?php if(!empty($row['kinhnghiem'])){ ?>( <?php echo $row['kinhnghiem'] ?> năm) <?php } ?></span></h3>
                                        <div id="experience-table">
											     <?php
														$vitrichucdanh = explode("|", $row['vitrichucdanh']);
														$congty = explode("|", $row['congty']);
														$thoigianlamviec = explode("|", $row['thoigianlamviec']);
														$motacongviec = explode("|", $row['motacongviec']);
														for($num_ = 0; $num_ < count($vitrichucdanh); $num_++){
													?>
                                            <div class="row ">
                                                <div class="time">
                                                    <span class="cvo-experience-start start"><?php echo $thoigianlamviec[$num_] ?></span>
                                           
                                                </div>
                                                <div class="company">
                                                    <span class="cvo-experience-company"><?php echo $congty[$num_] ?></span>
                                                    <span class="cvo-experience-position"><?php echo $vitrichucdanh[$num_] ?></span>
                                                    <div class="cvo-experience-details">
														<p><?php echo $motacongviec[$num_] ?></p>
                                                    </div>
                                                    <div style="clear: both"></div>
                                                </div>
                                                <div style="clear: both"></div>
                                            </div>
											<?php }?>
                                            
                                        </div>
                                    </div>
                                    <div class="cvo-block" id="cvo-certification">
                                        <h3 class="cvo-block-title"><span id="cvo-certification-blocktitle">Bằng cấp</span></h3>
                                        <div id="certification-table">
												<?php
														$truongkhoahoc = explode("|", $row['truongkhoahoc']);
														$bangcap = explode("|", $row['bangcap1']);
														//$thoigianhoc = explode("|", $row['thoigianhoc']);
														for($num_ = 0; $num_ < count($truongkhoahoc); $num_++){
							
													?>
															<div class="row ">
																<div class="time">
																	<span class="cvo-certification-time"><?php echo $row['thoigianhoc'] ?></span>
																</div>
																<div class="details">
																	<span class="cvo-certification-title"><?php echo $truongkhoahoc[$num_] ?> - <?php echo $bangcap[$num_] ?></span>
																</div>
																<div style="clear: both"></div>
															</div>
												<?php } ?>
                                        </div>
                                    </div>
                                   <div class="cvo-block" id="cvo-skillgroup">
                                        <h3 class="cvo-block-title"><span id="cvo-award-blocktitle">Ngoại Ngữ</span></h3>
                                         <div id="skill-table">
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
												<div class="row ">
													  <div>
															<span class="cvo-skillgroup-area"><?php echo $arrVal[0] ?> </span>
														</div>
													<div>
														<span class="cvo-skillgroup-skill-description"><?php
																			for($i=1;$i<=$star;$i++){
																		?>
																		*
																		<?php }?></span>
													</div> 
													<div style="clear: both"></div>
												</div>
											<?php } ?>
                                        </div>
                                    </div>
                                    <div class="cvo-block" id="cvo-skillgroup">
                                        <h3 class="cvo-block-title"><span id="cvo-skillgroup-blocktitle">Các kỹ năng</span></h3>
                                        <div id="skill-table">
											<?php
												$kynangchuyenmon = explode("|", $row['kynangchuyenmon']);
												$mucdo = explode("|", $row['mucdo']);
												for($num_ = 0; $num_ < count($kynangchuyenmon); $num_++){
											?>
                                            <div class="row">
                                                <div>
                                                    <span class="cvo-skillgroup-area"><?php echo $kynangchuyenmon[$num_] ?></span>
                                                </div>
                                                <div>
                                                    <span class="cvo-skillgroup-skill-description">
																		<?php
																			for($star=1;$star<=$mucdo[$num_];$star++){
																		?>
																		*
																		<?php }?></span>
                                                </div>
                                                <div style="clear: both"></div>
                                            </div>
                                         	<?php }?>
                                        </div>
                                    </div>
									<?php if(!empty($row['thanhtichnoibat'])) {?>
										 <div class="cvo-block" id="cvo-additional-info">
											<h3 class="cvo-block-title"><span id="cvo-additional-info-blocktitle">Thành tích nỗi bật</span></h3>
											<div class="block-body">
												<div id="cvo-additional-information-details">
												   <?php echo $row['thanhtichnoibat'] ?>
												</div>
											</div>
										</div>
									<?php } ?>
									<?php if(!empty($row['tennguoithamkhao'])) {?>
									 <div class="cvo-block" id="cvo-skillgroup">
										 <h3 class="cvo-block-title"><span id="cvo-skillgroup-blocktitle">Người tham khảo</span></h3>
										<?php
														$tennguoithamkhao = explode("|", $row['tennguoithamkhao']);
														$chucvunguoithamkhao = explode("|", $row['chucvunguoithamkhao']);
														$congtynguoithamkhao = explode("|", $row['congtynguoithamkhao']);
														$dienthoainguoithamkhao = explode("|", $row['dienthoainguoithamkhao']);
														$emailnguoithamkhao = explode("|", $row['emailnguoithamkhao']);
														for($num_ = 0; $num_ < count($tennguoithamkhao); $num_++){
													?>
													<div class="text-edt">
														<div class="title"><strong> <?php echo $tennguoithamkhao[$num_] ?></strong></div>
														<div class="content_fck">
															<p>Chức vụ: <?php echo $chucvunguoithamkhao[$num_] ?></p>
															<p>Công ty: <?php echo $congtynguoithamkhao[$num_] ?></p>
															<p>Điện thoại: <?php echo $dienthoainguoithamkhao[$num_] ?></p>
															<p>Email: <?php echo $emailnguoithamkhao[$num_] ?></p>
														</div>
													</div>
											<?php }?>
									 </div>
									 <?php } ?>
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