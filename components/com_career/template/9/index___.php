<html lang="en">
<head>
   <meta charset="utf8">
    <?php
		include_once("components/com_createcv/template/9/css/app.php");
		include_once("components/com_createcv/template/9/css/viewCV.php");
		include_once("components/com_createcv/template/9/css/print.php");
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
    background-color: #525659;
    width: 815px;
    max-width: 815px;
    margin: 0 auto;
    padding-top: 0;
    padding-bottom: 0;
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
                                <div id="cv-top" data-x-name="item" data-x-id="info">
                                    <h1><span data-x-id="name" contenteditable="true"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></span></h1>
                                    <h2><span data-x-id="job" contenteditable="true"><?php echo $row['bangcap1']?></span></h2>
                                    <div id="cv-box-ava" data-x-id="info" data-x-name="item">
                                        <img id="cv-ava" src="<?php echo $row['hinhanh'] ?>">
                                    </div>
                                    <div class="box-contact" data-x-id="info" data-x-name="item">
                                        <p class="icoweb" data-x-rel="dob"><i class="fa fa-calendar"></i><span data-x-id="dob" contenteditable="true"><?php echo $row['birthday'] ?></span></p>
                                        <p class="icoweb" data-x-name="gen"><i class="fa fa-user"></i><span data-x-id="gen" contenteditable="true"><?php echo $row['gender'] ?></span></p>
                                        <p class="icoweb" data-x-name="tel"><i class="fa fa-phone"></i><span data-x-id="tel" contenteditable="true"><?php echo $row['mobile'] ?></span></p>
                                        <p class="icoweb" data-x-name="email"><i class="fa fa-envelope-square"></i><span data-x-id="email" contenteditable="true"><?php echo $email ?></span></p>
                                        <p class="icoweb" data-x-name="add"><i class="fa fa-map-marker"></i><span data-x-id="add" contenteditable="true"><?php echo $row['diachi'] ?></span></p>
                                        <p class="icoweb" data-x-name="web"><i class="fa fa-info"></i><span data-x-id="web" contenteditable="true"><?php echo $row['tinhtranghonnhan'] ?></span></p>
                                    </div>
                                </div>
                                <div data-x-name="group-item">
                                    <div class="block cvo-block" data-x-name="item" data-x-id="award">
                                        <p class="h3" data-x-name="head"><span data-x-id="tit" contenteditable="true" class="box-title">CÔNG VIỆC MONG MUỐN</span>
                                        </p>
                                        <div data-x-name="list-item">

                                            <div data-x-name="sub-item">
                                                <span class="box-content" data-x-id="name" contenteditable="true">- Cấp bậc mong muốn: <?php echo $row['capbacmongmuon'] ?> <div>- Mức lương: <?php echo $row['mucluong'] ?></div><div>- Hình thức làm việc: <?php echo $row['hinhthuclamviec'] ?> </div><div>- Nơi làm việc mong muốn: <?php echo $row['noilamviecmongmuon'] ?></div></span>
                                                <span class="date" data-x-id="time" contenteditable="true"></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="block cvo-block box-skills" data-x-id="skill" data-x-name="item">
                                        <p class="h3" data-x-name="head"><span id="cv-boxtitle" data-x-id="tit" contenteditable="true" class="box-title">KỸ NĂNG</span></p>
                                        <div class="exp content-edit skill" data-x-name="list-item">
                                            <?php
												$kynangchuyenmon = explode("|", $row['kynangchuyenmon']);
												$mucdo = explode("|", $row['mucdo']);
												for($num_ = 0; $num_ < count($kynangchuyenmon); $num_++){
								 ?>
                                                <div class="cv-box-content" data-x-name="sub-item">
                                                    <p class="skill-name" data-x-id="name" contenteditable="true">
                                                        <?php echo $kynangchuyenmon[$num_] ?>
                                                    </p>
                                                    <div class="bar-exp cvo-skillrate-bar"><span data-x-id="val" class="cvo-skillrate-value" value="<?php echo $mucdo[$num_] ?>"></span></div>
                                                </div>
                                                <?php } ?>

                                        </div>
                                    </div>
								 <div class="block cvo-block box-skills" data-x-id="skill" data-x-name="item">
                                        <p class="h3" data-x-name="head"><span id="cv-boxtitle" data-x-id="tit" contenteditable="true" class="box-title">NGOẠI NGỮ</span></p>
                                        <div class="exp content-edit skill" data-x-name="list-item">
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
                                                <div class="cv-box-content" data-x-name="sub-item">
                                                    <p class="skill-name" data-x-id="name" contenteditable="true">
                                                       <?php echo $arrVal[0] ?>
                                                    </p>
                                                    <div class="bar-exp cvo-skillrate-bar"><span data-x-id="val" class="cvo-skillrate-value" value="<?php echo $star ?>"></span></div>
                                                </div>
                                                <?php } ?>

                                        </div>
                                    </div>
                                    <div class="block cvo-block" data-x-name="item" data-x-id="hob">
                                        <p class="h3" data-x-name="head"><span data-x-id="tit" contenteditable="true" class="box-title">thành tích nổi bật</span></p>
                                        <div data-x-name="list-item">

                                            <div data-x-name="sub-item">
                                                <div class="box-content" data-x-id="name" contenteditable="true"> <?php echo $row['thanhtichnoibat'] ?>
											   </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="block cvo-block x_hide" data-x-name="item" data-x-id="cer">
                                        <p class="h3" data-x-name="head"><span data-x-id="tit" contenteditable="true" class="box-title">Chứng chỉ</span>
                                        </p>
                                        <div data-x-name="list-item">
                                            <div data-x-name="sub-item">
                                                <span class="box-content" data-x-id="name" contenteditable="true"></span>
                                                <span class="date" data-x-id="time" contenteditable="true"></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cv-content" data-x-name="col-parrent" data-x-col="2">
                            <div class="height-curent">
                                <div data-x-name="group-item">
                                    <div class="cvo-block" data-x-id="tar" data-x-name="item">
                                        <p class="head" data-x-name="head">
                                            <span data-x-id="tit" contenteditable="true">Mục tiêu nghề nghiệp</span>
                                        </p>
                                        <div>
                                            <div class="cv-box-content experience">
                                                <div data-x-name="list-item">
                                                    <div data-x-id="name" contenteditable="true"><?php echo $row['muctieunghenghiep'] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cvo-block" data-x-name="item" data-x-id="edu">
                                        <p class="head" data-x-name="head">
                                            <span data-x-id="tit" contenteditable="true">Học vấn</span>
                                        </p>
                                        <div data-x-name="list-item">
											<?php
												$truongkhoahoc = explode("|", $row['truongkhoahoc']);
												$bangcap = explode("|", $row['bangcap']);
												$motachitiet = explode("|", $row['motachitiet']);
												for($num_ = 0; $num_ < count($truongkhoahoc); $num_++){
													$arrBangCap = explode(":", $bangcap[$num_]);
											?>
												<div class="cv-box-content" data-x-name="sub-item">
													<h3>
														<span contenteditable="true" data-x-id="name"><?php echo $truongkhoahoc[$num_] ?></span>
														<span class="exp-date"><em data-x-id="start" contenteditable="true"><?php echo $arrBangCap[1] ?> </span>
													</h3>
													<p class="h3">
														<span data-x-id="cat" contenteditable="true"><?php echo $motachitiet[$num_] ?></span>
													</p>
													<div class="exp-content" contenteditable="true" data-x-id="des">Bằng cấp: <?php echo $arrBangCap[0] ?></div>
												</div>
											<?php }?>
                                        </div>
                                    </div>
                                    <div class="cvo-block" data-x-name="item" data-x-id="exp">
                                        <p class="head" data-x-name="head">
                                            <span data-x-id="tit" contenteditable="true">Kinh nghiệm làm việc <?php if(!empty($row['kinhnghiem'])){ ?>( <?php echo $row['kinhnghiem'] ?> năm) <?php } ?></span>
                                        </p>
										<?php
												$vitrichucdanh = explode("|", $row['vitrichucdanh']);
												$congty = explode("|", $row['congty']);
												$thoigianlamviec = explode("|", $row['thoigianlamviec']);
												$motacongviec = explode("|", $row['motacongviec']);
												for($num_ = 0; $num_ < count($vitrichucdanh); $num_++){
											?>
											<div data-x-name="list-item">
											
                                            <div class="cv-box-content" data-x-name="sub-item">
                                                <h3>
													<span contenteditable="true" data-x-id="name"><?php echo $congty[$num_] ?></span>
													<span class="exp-date"><em data-x-id="start" contenteditable="true"><?php echo $thoigianlamviec[$num_] ?></span>
												</h3>
                                                <p class="h3">
                                                    <span data-x-id="pos" contenteditable="true"><?php echo $vitrichucdanh[$num_] ?></span>
                                                </p>
                                                <div class="exp-content" contenteditable="true" data-x-id="des"><?php echo $motacongviec[$num_] ?></div>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="cvo-block x_hide" data-x-id="more" data-x-name="item">
                                        <p class="head" data-x-name="head">
                                            <span data-x-id="tit" contenteditable="true">Thông tin khác</span>
                                        </p>
                                        <div>
                                            <div class="cv-box-content">
                                                <div data-x-name="list-item">
                                                    <div data-x-id="name" contenteditable="true"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="cvo-block x_hide" data-x-id="ref" data-x-name="item">
                                        <p class="head" data-x-name="head">
                                            <span data-x-id="tit" contenteditable="true">Người tham chiếu</span>
                                        </p>
                                        <div data-x-name="list-item">
                                            <div class="cv-box-content" data-x-name="sub-item">
                                                <div data-x-id="name" contenteditable="true"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cvo-block x_hide" data-x-name="item" data-x-id="act">
                                        <p class="head" data-x-name="head">
                                            <span data-x-id="tit" contenteditable="true">Hoạt động</span>
                                        </p>
                                        <div data-x-name="list-item">
                                            <div class="cv-box-content" data-x-name="sub-item">
                                                <h3>
                                    <span contenteditable="true" data-x-id="name"></span>
                                    <span class="exp-date"><em data-x-id="start" contenteditable="true">03/2015</em> -
                                        <em data-x-id="end" contenteditable="true">05/2018</em></span>
                                </h3>
                                                <p class="h3">
                                                    <span data-x-id="pos" contenteditable="true">Tình nguyện viên</span>
                                                </p>
                                                <div class="exp-content" contenteditable="true" data-x-id="des"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cv-main page" style="display: none" id="page">
                    <div class="cv-left" data-x-name="col-parrent" data-x-col="1">
                        <div class="height-curent"></div>
                    </div>
                    <div class="cv-content" data-x-name="col-parrent" data-x-col="2">
                        <div class="height-curent"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="paging-separator" id="paging-separator" style="display: none">
            <div class="paging-arrow"></div>
        </div>
    </div>
</body>

</html>