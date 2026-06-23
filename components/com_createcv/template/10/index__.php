<html lang="en">
<head>
   <meta charset="utf8">
    <?php
		include_once("components/com_createcv/template/10/css/app.php");
		include_once("components/com_createcv/template/10/css/print.php");
		include_once("components/com_createcv/template/10/css/style.php");
		include_once("components/com_createcv/template/10/css/cv.php");
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

                                <div id="group-header">

                                    <div id="cvo-profile" class="cvo-block">
                                        <table class="profile-table">
                                            <tr>
                                                <td class="avatar-wraper" rowspan="9">
                                                    <img id="cvo-profile-avatar" src="<?php echo $row['hinhanh'] ?>">
                                                </td>
                                                <td>
                                                    <span id="cvo-profile-fullname"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span id="cvo-profile-title"><?php echo $row['bangcap1']?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Ngày sinh: </span>
                                                    <span class="profile-field" id="cvo-profile-dob"><?php echo $row['birthday'] ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Giới tính: </span>
                                                    <span class="profile-field" id="cvo-profile-gender"><?php echo $row['gender'] ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Điện thoại: </span>
                                                    <span class="profile-field" id="cvo-profile-phone"><?php echo $row['mobile'] ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Email: </span>
                                                    <span class="profile-field" id="cvo-profile-email"><?php echo $email ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Địa chỉ: </span>
                                                    <span class="profile-field" id="cvo-profile-address"><?php echo $row['diachi'] ?></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="profile-label">Hôn nhân: </span>
                                                    <span class="profile-field" id="cvo-profile-website"<?php echo $row['tinhtranghonnhan'] ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div id="group-content">
                                    <div id="cvo-objective" class="cvo-block">
                                        <h3 class="cvo-block-title"><span id="cvo-objective-blocktitle">Mục tiêu nghề nghiệp</span></h3>
                                        <div class="cvo-block-body">
                                            <div id="cvo-objective-objective">
												<?php echo $row['muctieunghenghiep'] ?>
											</div>
                                        </div>
                                    </div>
                                    <div id="cvo-reference" class="cvo-block">
                                        <h3 class="cvo-block-title"><span id="cvo-reference-blocktitle">công việc mong muốn</span></h3>
                                        <div id="reference-table">
                                            <div class="row">
                                                <div>
												<span class="cvo-reference-content">
- Cấp bậc mong muốn: <?php echo $row['capbacmongmuon'] ?> <br />- Mức lương: <?php echo $row['mucluong'] ?><br />- Hình thức làm việc: <?php echo $row['hinhthuclamviec'] ?> <br />- Nơi làm việc mong muốn: <?php echo $row['noilamviecmongmuon'] ?> <br />
</span>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <div style="clear: both"></div>
                                    </div>
                                    <div id="cvo-education" class="cvo-block">
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
                                                <div class="cvo-education-time col-time">
                                                    <span class="cvo-education-start start"><?php echo $arrBangCap[1] ?></span>
                                                   
                                                </div>
                                                <div class="school">
                                                    <span class="cvo-education-school"><?php echo $truongkhoahoc[$num_] ?></span>
                                                    <span class="cvo-education-title"><?php if(!empty($row['bangcap'])){?>Chuyên ngành: <?php echo $row['bangcap'] ?> <?php } ?></span>
                                                    <span class="cvo-education-details">Bằng cấp:  <?php echo $row['bangcap1'] ?></span>
                                                </div>
                                                <div style="clear: both"></div>
                                            </div>
											<?php } ?>
                                           
                                        </div>
                                    </div>
                                    <div id="cvo-experience" class="cvo-block">
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
                                                <div class="cvo-experience-time col-time">
                                                    <span class="cvo-experience-start start"><?php echo $thoigianlamviec[$num_] ?></span>
                                                </div>
                                                <div class="company">
                                                    <span class="cvo-experience-company"><?php echo $congty[$num_] ?></span>
                                                    <span class="cvo-experience-position"><?php echo $vitrichucdanh[$num_] ?></span>
                                                    <div class="cvo-experience-details">
														<p><?php echo $motacongviec[$num_] ?></p>
                                                    </div>
                                                </div>
                                                <div style="clear: both"></div>
                                            </div>
											<?php }?>
                                           
                                        </div>
                                    </div>
                                    <!--<div id="cvo-certification" class="cvo-block">
                                        <h3 class="cvo-block-title"><span id="cvo-certification-blocktitle">Chứng chỉ</span></h3>
                                        <div id="certification-table">
                                            <div class="row ">
                                                <div class="cvo-certification-time-wraper col-time">
                                                    <span class="cvo-certification-time">09/2015</span>
                                                </div>
                                                <div class="details">
                                                    <span class="cvo-certification-title">Chứng chỉ hành nghề</span>
                                                </div>
                                                <div style="clear: both"></div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div id="cvo-award" class="cvo-block">
                                        <h3 class="cvo-block-title"><span id="cvo-award-blocktitle">Ngoại Ngữ</span></h3>
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
                                            <div class="row">
                                           <div class="cvo-skillrate-title-wraper">- <?php echo $arrVal[0] ?> </div>
										   <div class ="Star_">
											<?php
																			for($i=1;$i<=$star;$i++){
																		?>
										   *
																			<?php } ?>
										   </div>
                                        </div>
											<?php } ?>
                                        </div>
                                    </div>
                                    <div id="cvo-interests" class="cvo-block">
                                        <h3 class="cvo-block-title"><span id="cvo-interests-blocktitle">Thành tích nổi bật</span></h3>
                                        <div class="cvo-block-body">
                                            <span id="cvo-interests-interests">  <?php echo $row['thanhtichnoibat'] ?></span>
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