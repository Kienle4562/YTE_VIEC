<html lang="en">
<head>
	<?php
		include_once("components/com_career/template/7/css/app.php");
		include_once("components/com_career/template/7/css/cv.php");
		include_once("components/com_career/template/7/css/print.php");
		include_once("components/com_career/template/7/css/reset.php");
		include_once("components/com_career/template/7/css/style.php");
		$myprocess = new process();
		$profile = 0;
		$email = "";
		$temp = 0;
		$career_id = 0;
		
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
#cv-layout-viewer {
    margin-top: 0;
    margin-bottom: 0;
}
.cvo-document .cvo-subpage {
    padding: 5mm;
    min-height: 295mm;
}
.cvo-document .cvo-page {
    width: 815px;
}
</style>
<body id="cv-viewer">
    <div id="cv-layout-viewer">
        <div id="cvo-document-root">
            <div id="cvo-document" class="cvo-document">
                <div class="cvo-page">
                    <div class="cvo-subpage">
                        <div id="cvo-body">
                            <div id="group-header">
                                <div id="cvo-profile" class="cvo-block">
                                    <div id="cvo-profile-wraper">
                                        <div id="cvo-profile-avatar-wraper" class="profile-item">
                                            <img id="cvo-profile-avatar" src="<?php echo $row['hinhanh'] ?>">
                                        </div>
                                        <div id="cvo-profile-info" class="profile-item">
                                            <div class="info">
                                                <span id="cvo-profile-fullname"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></span>
                                                <span id="cvo-profile-title"><?php echo $row['bangcap1']?></span>
                                            </div>
                                            <div class="contact">
                                                <div class="contact-item"><i class="fa fa-calendar"></i><span id="cvo-profile-dob"><?php echo date("d/m/Y", strtotime($row['birthday'])) ?></span></div>
                                                <div class="contact-item"><i class="fa fa-user"></i><span id="cvo-profile-gender"><?php echo $row['gender'] ?></span></div>
                                                <div class="contact-item"><i class="fa fa-phone"></i><span id="cvo-profile-phone"><?php echo $row['mobile'] ?></span></div>
                                                <div class="contact-item"><i class="fa fa-envelope-square"></i><span id="cvo-profile-email"><?php echo $row['email'] ?></span></div>
                                                <div class="contact-item"><i class="fa fa-map-marker"></i><span id="cvo-profile-address"><?php echo $row['diachi'] ?></span></div>
                                                <div class="contact-item"><i class="fa fa-info"></i><span id="cvo-profile-website"><?php echo $row['tinhtranghonnhan'] ?></span></div>
                                                <div style="clear: both"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="group-main">
                               
                                <div id="cvo-education" class="cvo-block">
                                    <div class="cvo-block-header">
                                        <span id="cvo-education-blocktitle">Học vấn</span>
                                    </div>
                                    <div id="education-table" class="cvo-block-body">
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
                                        <div class="row ">
                                            <div class="row-col-left">
                                                <div><span class="cvo-education-title"><?php if(!empty($bangcap2[$num_])){?>Chuyên ngành: <?php echo $bangcap2[$num_] ?> <?php } ?></span></div>
                                                <div class="cvo-education-time">
                                                    <span class="cvo-education-start"><span class="cvo-education-end"><?php echo $truongkhoahoc[$num_] ?></span>
                                                </div>
                                            </div>
                                            <div class="row-col-right">
                                                <div class="cvo-education-school-wraper">
                                                    <span class="cvo-education-school"><?php echo $thoigianhoc[$num_]?></span>
                                                </div>
                                                <div class="cvo-education-details">Bằng cấp: <?php echo $bangcap1[$num_] ?></div>
                                            </div>
                                        </div>
										<?php } ?>
                                    </div>
                                </div>
                                <div id="cvo-experience" class="cvo-block">
                                    <div class="cvo-block-header">
                                        <span id="cvo-experience-blocktitle">Kinh nghiệm làm việc <?php if(!empty($row['kinhnghiem'])){ ?>( <?php echo $row['kinhnghiem'] ?> năm) <?php } ?></span>
                                    </div>
                                    <div id="experience-table" class="cvo-block-body">
										<?php
												$vitrichucdanh = explode("|", $row['vitrichucdanh']);
												$congty = explode("|", $row['congty']);
												$thoigianlamviec = explode("|", $row['thoigianlamviec']);
												$motacongviec = explode("|", $row['motacongviec']);
												for($num_ = 0; $num_ < count($vitrichucdanh); $num_++){
										?>
                                        <div class="row ">
                                            <div class="row-col-left">
                                                <div><span class="cvo-experience-position"><?php echo $vitrichucdanh[$num_] ?></span></div>
                                                <div class="cvo-experience-time">
                                                    <span class="cvo-experience-start"><?php echo $thoigianlamviec[$num_] ?></span>
                                                   
                                                </div>
                                            </div>
                                            <div class="row-col-right">
                                                <div class="cvo-experience-company-wraper">
                                                    <span class="cvo-experience-company"><?php echo $congty[$num_] ?></span>
                                                </div>
                                                <div class="cvo-experience-details">
												<?php echo $motacongviec[$num_] ?>
                                                </div>
                                            </div>
                                        </div>
                                         <?php }?>
                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                            </div>
                            <div id="group-bottom">
                                <div id="group-bottom-left">
                                    <div class="cvo-block" id="cvo-reference">
                                        <div class="cvo-block-header"><span id="cvo-reference-blocktitle">công việc mong muốn</span></div>
                                        <div id="reference-table" class="cvo-block-body">
                                            <div class="row">
                                                <span class="cvo-reference-content color-content">
- Cấp bậc mong muốn: <?php echo $row['capbacmongmuon'] ?> <br />- Mức lương: <?php echo $row['mucluong'] ?><br />- Hình thức làm việc: <?php echo $row['hinhthuclamviec'] ?> <br />- Nơi làm việc mong muốn: <?php echo $row['noilamviecmongmuon'] ?><br />
</span>
                                            </div>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                </div>
                                <div id="group-bottom-right">
                                    <div id="cvo-award" class="cvo-block">
                                        <div class="cvo-block-header"><span id="cvo-award-blocktitle">Ngoại Ngữ</span></div>
                                           <div id="award-table" class="cvo-block-body">
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
                                           <div class="row">
                                           <div class="cvo-skillrate-title-wraper">- <?php echo $arrVal[0] ?> </div>
										   <div class ="Star_">
											<?php echo $star ?>
										   </div>
                                        </div>
												<?php } ?>
											</div>
											<div style="clear: both"></div>
										</div>
									</div>
						
									<div style="clear: both;"></div>
								</div>
								 <div id="cvo-objective" class="cvo-block">
                                    <div class="cvo-block-header">
                                        <span id="cvo-objective-blocktitle">Mục tiêu nghề nghiệp</span>
                                    </div>
                                    <div class="cvo-block-body">
                                        <div id="cvo-objective-objective">	<?php echo $row['muctieunghenghiep'] ?></div>
                                    </div>
									<div style="clear: both"></div>
                                </div>
								<div style="clear: both"></div>
								 <div id="cvo-education" class="cvo-block">
                                    <div class="cvo-block-header">
                                        <span id="cvo-objective-blocktitle">KỶ NĂNG & THÀNH TÍCH NỔI BẬT</span>
                                    </div>
                                    <div class="cvo-block-body">
                                        <div id="cvo-objective-objective">	 <?php echo $row['thanhtichnoibat'] ?></div>
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