<html lang="en">
<head>
   <meta charset="utf8">
    <?php
		include_once("components/com_createcv/template/12/css/viewCV.php");
		include_once("components/com_createcv/template/12/css/cv.php");
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
   <body>
      <div id="main">
         <div id="cv-viewer">
            <div id="cv-document">
              
               <div id="form-cv" data-x-name="parrent">
                  <div class="cv-main page" page="1">
                     <div class="cv-left" data-x-name="col-parrent" data-x-col="1">
                        <div class="height-curent">
                           <div data-x-name="item" data-x-id="info">
                              <div id="cv-box-ava">
                                 <img id="cv-ava" data-x-id="ava" src="<?php echo $row['hinhanh'] ?>" value="<?php echo $row['hinhanh'] ?>">
                              </div>
                              <div class="box-contact">
                                 <p class="icoweb" data-x-rel="dob"><i class="fa fa-calendar"></i><span data-x-id="dob" contenteditable="true"><?php echo date("d/m/Y", strtotime($row['birthday'])) ?></span></p>
                                 <p class="icoweb" data-x-rel="gen"><i class="fa fa-user"></i><span data-x-id="gen" contenteditable="true"><?php echo $row['gender'] ?></span></p>
                                 <p class="icoweb" data-x-rel="tel"><i class="fa fa-phone"></i><span data-x-id="tel" contenteditable="true"><?php echo $row['mobile'] ?></span></p>
                                 <p class="icoweb" data-x-rel="email"><i class="fa fa-envelope-square"></i><span data-x-id="email" contenteditable="true"><?php echo $email ?></span></p>
                                 <p class="icoweb" data-x-rel="add"><i class="fa fa-map-marker"></i><span data-x-id="add" contenteditable="true"><?php echo $row['diachi'] ?></span></p>
                                 <p class="icoweb" data-x-rel="web"><i class="fa fa-info"></i><span data-x-id="web" contenteditable="true"><?php echo $row['tinhtranghonnhan'] ?></span></p>
                              </div>
                           </div>
                           <div data-x-name="group-item">
                              <div class="block cvo-block" data-x-id="award" data-x-name="item">
                                 <div data-x-name="head">
                                    <div class="icon_fa">
                                       <i class="fa fa-trophy"></i>
                                    </div>
                                    <p class="h3"><span contenteditable="true" data-x-id="tit" class="box-title">CÔNG VIỆC MONG MUỐN</span>
                                    </p>
                                 </div>
                                 <div data-x-name="list-item">
                                    <div data-x-name="sub-item">
                                      
                                         <span  class="box-content">
- Cấp bậc mong muốn: <?php echo $row['capbacmongmuon'] ?> <br />- Mức lương: <?php echo $row['mucluong'] ?><br />- Hình thức làm việc: <?php echo $row['hinhthuclamviec'] ?> <br />- Nơi làm việc mong muốn: <?php echo $row['noilamviecmongmuon'] ?> <br />
</span>
                                     
                                       <span class="date" data-x-id="time" contenteditable="true"></span>
                                       <div class="clearfix"></div>
                                    </div>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="block cvo-block box-skills" data-x-id="skill" data-x-name="item">
                                 <div data-x-name="head">
                                    <div class="icon_fa"><i class="fa fa-angellist"></i></div>
                                    <p class="h3"><span contenteditable="true" data-x-id="tit" class="box-title">chứng chỉ</span></p>
                                 </div>
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
                                 <div class="exp content-edit skill" data-x-name="list-item">
                                    <div class="cv-box-content" data-x-name="sub-item">
                                       <p class="skill-name" data-x-id="name" contenteditable="true"> <?php echo $arrVal[0] ?></p>
                                       <div class="bar-exp cvo-skillrate-bar">
										<?php echo $star ?>
										<!--<span data-x-id="val" class="cvo-skillrate-value" value="<?php echo $star ?>"></span> -->
									   </div>
                                    </div>
                                 </div>
								 	<?php } ?>
                              </div>
                              <div class="block cvo-block" data-x-id="hob" data-x-name="item">
                                 <div data-x-name="head">
                                    <div class="icon_fa">
                                       <i class="fa fa-star"></i>
                                    </div>
                                    <p class="h3"><span contenteditable="true" data-x-id="tit" class="box-title">thành tích nổi bật</span></p>
                                 </div>
                                 <div data-x-name="list-item">
                                    <div data-x-name="sub-item">
                                       <div class="box-content" data-x-id="name" contenteditable="true"> <?php echo $row['thanhtichnoibat'] ?></div>
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="block cvo-block x_hide" data-x-id="more" data-x-name="item">
                                 <div data-x-name="head">
                                    <div class="icon_fa">
                                       <i class="fa fa-book"></i>
                                    </div>
                                    <p class="h3" data-x-name="head"><span contenteditable="true" data-x-id="tit" class="box-title">Thông tin khác</span></p>
                                 </div>
                                 <div data-x-name="list-item">
                                    <div class="box-content" data-x-id="name" contenteditable="true"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="cv-content" data-x-name="col-parrent" data-x-col="2">
                        <div class="height-curent">
                           <div id="cv-top">
                              <div data-x-name="item" data-x-id="info">
                                 <h1><span data-x-id="name" contenteditable="true"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></span></h1>
                                 <h2><span contenteditable="true" data-x-id="job"><?php 
														$bangcap1 = explode("|", $row['bangcap1']);
														$bangcap1khac = explode("|", $row['bangcap1khac']);
														$bangcap2 = explode("|", $row['bangcap2']);
														$bangcap2khac = explode("|", $row['bangcap2khac']);
														if($bangcap1[0] == 'Khác')
														{
															$bangcap1[0] = 'Bằng cấp khác';
														}
														echo $bangcap1[0] ?> <?php if(!empty($bangcap2[0])){ ?> - <?php echo $bangcap2[0] ?> <?php } ?></span></h2>
                              </div>
                           </div>
                           <div data-x-name="group-item">
                              <div class="cvo-block" data-x-name="item" data-x-id="tar">
                                 <div data-x-name="head">
                                    <div class="icon_fa">
                                       <i class="fa fa-flag"></i>
                                    </div>
                                    <p class="head" data-x-name="head">
                                       <span data-x-id="tit" contenteditable="true">Mục tiêu nghề nghiệp</span>
                                    </p>
                                 </div>
                                 <div class="cv-box-content">
                                    <div data-x-name="list-item">
                                       <div data-x-id="name" contenteditable="true"> <?php echo $row['muctieunghenghiep'] ?></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="cvo-block" data-x-name="item" data-x-id="edu">
                                 <div data-x-name="head">
                                    <div class="icon_fa">
                                       <i class="fa fa-book"></i>
                                    </div>
                                    <p class="head">
                                       <span data-x-id="tit" contenteditable="true">Học vấn</span>
                                    </p>
                                 </div>
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
                                 <div data-x-name="list-item">
                                    <div class="cv-box-content" data-x-name="sub-item">
                                       <h3>
                                          <span contenteditable="true" data-x-id="name"><?php echo $truongkhoahoc[$num_] ?> ( <?php echo $thoigianhoc[$num_]?> ) </span>
                                         
                                       </h3>
                                       <p class="h3"><span data-x-id="cat" contenteditable="true"><?php if(!empty($bangcap2[$num_])){?>Chuyên ngành: <?php echo $bangcap2[$num_] ?> <?php } ?></span></p>
                                       <div class="exp-content" contenteditable="true" data-x-id="des">Bằng cấp:  <?php echo $bangcap1[$num_] ?></div>
                                    </div>
                                 </div>
								  <?php } ?>
                              </div>
                              <div class="cvo-block" data-x-name="item" data-x-id="exp">
                                 <div data-x-name="head">
                                    <div class="icon_fa">
                                       <i class="fa fa-road"></i>
                                    </div>
                                    <p class="head">
                                       <span data-x-id="tit" contenteditable="true">Kinh nghiệm làm việc <?php if(!empty($row['kinhnghiem'])){ ?>( <?php echo $row['kinhnghiem'] ?> năm) <?php } ?></span>
                                    </p>
                                 </div>
                                 <div data-x-name="list-item">
								  <?php
														$vitrichucdanh = explode("|", $row['vitrichucdanh']);
														$congty = explode("|", $row['congty']);
														$thoigianlamviec = explode("|", $row['thoigianlamviec']);
														$motacongviec = explode("|", $row['motacongviec']);
														for($num_ = 0; $num_ < count($vitrichucdanh); $num_++){
													?>
                                    <div class="cv-box-content" data-x-name="sub-item">
                                       <h3>
                                          <span contenteditable="true" data-x-id="name"><?php echo $congty[$num_] ?></span>
                                          <span class="exp-date"><em data-x-id="start" contenteditable="true"><?php echo $thoigianlamviec[$num_] ?></span>
                                       </h3>
                                       <p class="h3">
                                          <span data-x-id="pos" contenteditable="true"><?php echo $vitrichucdanh[$num_] ?><span>
                                       </p>
                                       <div class="exp-content" contenteditable="true" data-x-id="des">
                                         <?php echo $motacongviec[$num_] ?>
                                       </div>
                                    </div>
										<?php }?>
                                   
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