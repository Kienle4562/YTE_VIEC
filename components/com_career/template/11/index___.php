<html lang="en">
<head>
   <meta charset="utf8">
    <?php
		include_once("components/com_createcv/template/11/css/app.php");
		include_once("components/com_createcv/template/11/css/print.php");
		include_once("components/com_createcv/template/11/css/style.php");
		include_once("components/com_createcv/template/11/css/cv.php");
		include_once("components/com_createcv/template/11/css/viewCV.php");
		include_once("components/com_createcv/template/11/css/reset.php");
		include_once("components/com_createcv/template/11/css/font-awesome.min.php");
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
</head>
<style>
#cv-viewer {
    width: 815px;
    max-width: 815px;
    margin: 0 auto;
    padding-top: 0;
    padding-bottom: 0;
}
#cv-layout-viewer{
    padding-top: 0;
    padding-bottom: 0;
    margin-top: 0;
    margin-bottom: 0;
}
.cvo-document .cvo-page {
    width: auto;
}
</style>
 <body id="cv-viewer" class=" ">
      <div id="cv-layout-viewer">
         <div id="cvo-document-root">
            <div id="cvo-document" class="cvo-document">
               <div class="cvo-page">
                  <div class="cvo-subpage">
                     <div id="cvo-body">
                        <div id="cvo-main">
                           <div id="col-left">
                              <div id="group-top-left">
                                 <div id="cvo-profile" class="cvo-block">
                                    <div id="profile-title-wrapper">
                                       <div id="cvo-profile-avatar-wraper">
                                          <img id="cvo-profile-avatar" src="<?php echo $row['hinhanh'] ?>" value="<?php echo $row['hinhanh'] ?>" alt="avatar">
                                       </div>
                                       <div>
                                          <span id="cvo-profile-fullname"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></span><br>
                                          <span id="cvo-profile-title"><?php echo $row['bangcap1']?></span>
                                       </div>
                                    </div>
                                    <div id="profile-contact-wraper">
                                       <div id="cvo-profile-dob-wraper">
                                          <i class="fa fa-calendar"></i><span id="cvo-profile-dob"><?php echo date("d/m/Y", strtotime($row['birthday'])) ?></span>
                                       </div>
                                       <div id="cvo-profile-gender-wraper"><i class="fa fa-user"></i><span id="cvo-profile-gender"><?php echo $row['gender'] ?></span></div>
                                       <div id="cvo-profile-phone-wraper"><i class="fa fa-phone"></i><span id="cvo-profile-phone"><?php echo $row['mobile'] ?></span></div>
                                       <div id="cvo-profile-email-wraper"><i class="fa fa-envelope-square"></i><span id="cvo-profile-email"><?php echo $email ?></span></div>
                                       <div id="cvo-profile-address-wraper"><i class="fa fa-map-marker"></i><span id="cvo-profile-address"><?php echo $row['diachi'] ?></span></div>
                                       <div id="cvo-profile-website-wraper"><i class="fa fa-info"></i><span id="cvo-profile-website"> <?php echo $row['tinhtranghonnhan'] ?></span></div>
                                    </div>
                                    <div style="clear: both"></div>
                                 </div>
                              </div>
                              <div id="group-bottom-left">
                                 <div id="cvo-objective" class="cvo-block">
                                    <div class="cvo-block-title no-horizontal-line"><span id="cvo-objective-blocktitle">Mục tiêu nghề nghiệp</span></div>
                                    <div id="cvo-objective-objective"> <?php echo $row['muctieunghenghiep'] ?></div>
                                 </div>
                                 <div id="cvo-skillrate" class="cvo-block">
                                    <div class="cvo-block-title"><span id="cvo-skillrate-blocktitle">Kỹ năng</span></div>
                                    <div id="skillrate-table">
										<?php
												$kynangchuyenmon = explode("|", $row['kynangchuyenmon']);
												$mucdo = explode("|", $row['mucdo']);
												for($num_ = 0; $num_ < count($kynangchuyenmon); $num_++){
											?>
                                               
												 <div class="row">
													  <div><span class="cvo-skillrate-title"><?php echo $kynangchuyenmon[$num_] ?></span></div>
													  <div class="cvo-skillrate-bar" bval="<?php echo $mucdo[$num_] ?>" rate-value="<?php echo $mucdo[$num_] ?>">
														 <span class="cvo-skillrate-value"></span>
													  </div>
												</div>
                                                <?php } ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div id="col-right">
                              <div id="group-col-right">
                                 <div id="cvo-education" class="cvo-block">
                                    <div class="cvo-block-title">
                                       <span><i class="fa fa-graduation-cap"></i></span>
                                       <span id="cvo-education-blocktitle">Học vấn</span>
                                    </div>
                                    <div id="education-table">
									<?php
										$truongkhoahoc = explode("|", $row['truongkhoahoc']);
										$bangcap = explode("|", $row['bangcap']);
										$motachitiet = explode("|", $row['motachitiet']);
										for($num_ = 0; $num_ < count($truongkhoahoc); $num_++){
											$arrBangCap = explode(":", $bangcap[$num_]);
									?>
										   <div class="row ">
											  <div class="row-title">
												 <div class="cvo-education-school-wraper">
													<span class="cvo-education-school"><?php echo $truongkhoahoc[$num_] ?></span>
												 </div>
												 <div class="cvo-education-time">
													<span class="cvo-education-start"><?php echo $arrBangCap[1] ?></span> 
												 </div>
												 <div style="clear:both;"></div>
												 <div>
													<span class="cvo-education-title"><?php if(!empty($row['bangcap'])){?>Chuyên ngành: <?php echo $row['bangcap'] ?> <?php } ?></span>
												 </div>
											  </div>
											  <div class="row-details">
												 <div class="cvo-education-details">Bằng cấp: <?php echo $row['bangcap1'] ?></div>
											  </div>
											  <div style="clear:both;"></div>
										   </div>
                                       <?php } ?>
                                    </div>
                                 </div>
                                 <div class="cvo-block" id="cvo-reference">
                                    <div class="cvo-block-title"><span><i class="fa fa-bookmark-o"></i></span><span id="cvo-reference-blocktitle">công việc mong muốn</span></div>
                                    <div id="reference-table">
                                       <div class="row">
									   <span class="cvo-reference-content color-content">
											- Cấp bậc mong muốn: <?php echo $row['capbacmongmuon'] ?> <br />
											- Mức lương: <?php echo $row['mucluong'] ?><br />
											- Hình thức làm việc: <?php echo $row['hinhthuclamviec'] ?> <br />
											- Nơi làm việc mong muốn: <?php echo $row['noilamviecmongmuon'] ?> <br />
										</span>
                                         
                                       </div>
                                    </div>
                                    <div style="clear: both;"></div>
                                 </div>
                                 <div id="cvo-experience" class="cvo-block">
                                    <div class="cvo-block-title"><span><i class="fa fa-briefcase"></i></span><span id="cvo-experience-blocktitle">Kinh nghiệm làm việc <?php if(!empty($row['kinhnghiem'])){ ?>( <?php echo $row['kinhnghiem'] ?> năm) <?php } ?></span></div>
                                    <div id="experience-table">
									  <?php
														$vitrichucdanh = explode("|", $row['vitrichucdanh']);
														$congty = explode("|", $row['congty']);
														$thoigianlamviec = explode("|", $row['thoigianlamviec']);
														$motacongviec = explode("|", $row['motacongviec']);
														for($num_ = 0; $num_ < count($vitrichucdanh); $num_++){
													?>
                                       <div class="row ">
                                          <div class="row-title">
                                             <div class="cvo-experience-company-wraper">
                                                <span class="cvo-experience-company"><?php echo $congty[$num_] ?></span>
                                             </div>
                                             <div class="cvo-experience-time">
                                                <span class="cvo-experience-start"><?php echo $thoigianlamviec[$num_] ?></span>
                                             </div>
                                             <div style="clear:both;"></div>
                                             <div>
                                                <span class="cvo-experience-position"><?php echo $vitrichucdanh[$num_] ?></span>
                                             </div>
                                          </div>
                                          <div class="row-details">
                                             <div class="cvo-experience-details">
                                               <?php echo $motacongviec[$num_] ?>
                                             </div>
                                          </div>
                                          <div style="clear:both;"></div>
                                       </div>
                                    	<?php }?>
                                    </div>
                                    <div style="clear: both"></div>
                                 </div>
                                
                                 <div id="cvo-award" class="cvo-block">
                                    <div class="cvo-block-title"><span><i class="fa fa-trophy"></i></span><span id="cvo-award-blocktitle">Ngoại Ngữ</span></div>
                                    <div id="award-table">
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
												  <div class="row-title">
													 <div class="cvo-award-title-wraper">
														<span class="cvo-award-title"> <?php echo $arrVal[0] ?></span>
													 </div>
													 <div class="cvo-award-time-wraper">
														<span class="cvo-award-time">
															<?php
																for($i=1;$i<=$star;$i++){
															?>
																*
															<?php } ?>
														</span>
													 </div>
													 <div style="clear:both;"></div>
												  </div>
												  <div style="clear:both;"></div>
											   </div>
									   	<?php } ?>
                                    </div>
                                    <div style="clear: both"></div>
                                 </div>
                              </div>
                           </div>
                           <div style="clear: both;"></div>
                        </div>
                        <div style="clear: both;"></div>
                     </div>
                    
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>

</html>