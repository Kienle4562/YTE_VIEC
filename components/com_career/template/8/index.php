<html lang="en">
<head>
	<?php
		include_once("components/com_career/template/8/css/app.php");
		include_once("components/com_career/template/8/css/viewCV.php");
		include_once("components/com_career/template/8/css/print.php");
		include_once("components/com_career/template/8/css/bootstrap.min.left.php");
		$myprocess = new process();
		$profile = 0;
		$email = "";
		$temp = 0;
		$career_id = 0;
		
		if(!empty($_REQUEST['idTheme']) && $_SESSION["career"]["career_id"] != NULL)
		{
			$result = $myprocess->getThongTinCaNhan();
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
#cv-viewer {
    background-color: #525659;
    width: 768px;
    margin: 0 auto;
}
.cvo-document .cvo-subpage {
    padding: 5mm;
    min-height: 295mm;
}
.cvo-document .cvo-page {
    width: 815px;
}
.cv_wrap {
    margin: 0 auto;
    width: 100%;
    background: #fff !important;
	min-height: 280mm;
}
.col_left {
    padding: 0 12px 13px 20px;
}
</style>
<body>
    <div id="main">
        <div id="cv-viewer">
            <div id="cv-document">
			<link id="cv-css" href="bootstrap.min.left.css">
			<link id="cv-scheme-css" rel="stylesheet" href="1fbc89.css">
			<link media="print" rel="stylesheet" href="print.css">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12" data-x-name="parrent" style='padding:0'>
            <!-- Wrap -->
            <div class="cv_wrap  page">
                <!-- Info -->
                <div class="cv_info clearfix">
                    <div class="avatar clearfix">
                        <div class="avatarL">
                            <p class="avatarImg"> <img src="<?php echo $row['hinhanh'] ?>"> </p>
                        </div>
                        <div class="name">
                            <h2 data-x-id="name" contenteditable="true"><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></h2>
                            <p data-x-id="job" contenteditable="true"><?php 
														$bangcap1 = explode("|", $row['bangcap1']);
														$bangcap1khac = explode("|", $row['bangcap1khac']);
														$bangcap2 = explode("|", $row['bangcap2']);
														$bangcap2khac = explode("|", $row['bangcap2khac']);
														if($bangcap1[0] == 'Khác')
														{
															$bangcap1[0] = 'Bằng cấp khác';
														}
														echo $bangcap1[0] ?> <?php if(!empty($bangcap2[0])){ ?> - <?php echo $bangcap2[0] ?> <?php } ?></p>
                        </div>
                        <div class="line">&nbsp;</div>
                    </div>
                </div>
				<div class="content_left_right">
					<div class="col_left ">
                    <!-- Info -->
                    <div class="height-curent">
                    <div class="cv_info" data-x-name="item" data-x-id="info">
                        <h2 data-x-id="tit" contenteditable="true" class="ml_ttl">THÔNG TIN</h2>
                        <ul class="info">
                            <li>
                                <p data-x-rel="gen"> <img class="ico1" alt=""> <span data-x-id="gen" contenteditable="true"><?php echo $row['gender'] ?></span> </p>
                                <p data-x-rel="dob"> <img class="ico2" alt=""> <span data-x-id="dob" contenteditable="true"><?php echo date("d/m/Y", strtotime($row['birthday'])) ?></span> </p>
                                <p data-x-rel="tel"> <img class="ico4" alt=""> <span data-x-id="tel" contenteditable="true"><?php echo $row['mobile'] ?></span> </p>
                                <p data-x-rel="email"> <img class="ico5" alt=""> <span data-x-id="email" contenteditable="true"><?php echo $row['email'] ?></span> </p>
                                <p data-x-rel="add"> <img class="ico3" alt=""> <span data-x-id="add" contenteditable="true"><?php echo $row['diachi'] ?></span> </p>
                                <p>
                            </li>
                        </ul>
                    </div>
						<div class="right_block" data-x-name="item" data-x-id="skill_ta">
                            <h2 data-x-id="tit" contenteditable="true" class="ml_ttl">Ngoại ngữ</h2>
                            <ul class="cc_lst" data-x-name="list-item">
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
												 <li data-x-name="sub-item">
                                    <h5 data-x-id="name" contenteditable="true">- <?php echo $arrVal[0] ?> </h5>
										<?php echo $star ?>
                                   
                                </li>
											<?php } ?>
                          </ul>
                        </div></div>
					</div>
                </div>
				
					<!-- Left -->
					<!-- Right -->
                <div class="col_right" data-x-name="col-parrent" data-x-col="2">
                    <div class="height-curent">
                    <div data-x-name="group-item"><div class="block clearfix" data-x-name="item" data-x-id="award">
                            <div class="blockR">
                                <h2 data-x-name="head"><img alt="" class="ico12 imgDot"><span data-x-id="tit" contenteditable="true">CÔNG VIỆC MONG MUỐN</span></h2>
                                <div class="block_content">
                                    <div class="block_line">
                                        <ul class="gt_lst" data-x-name="list-item">
                                            
                                        <li class="clearfix" data-x-name="sub-item"> 
                                                <span data-x-id="name" contenteditable="true" class="gt_name">- Cấp bậc mong muốn: <?php echo $row['capbacmongmuon'] ?>  <div>- Mức lương: <?php echo $row['mucluong'] ?></div><div>- Hình thức làm việc: <?php echo $row['hinhthuclamviec'] ?> </div><div>- Nơi làm việc mong muốn: <?php echo $row['noilamviecmongmuon'] ?></div></span>
                                                 <span class="date" data-x-id="time" contenteditable="true"></span> 
                                            </li></ul>
                                    </div>
                                </div>
                            </div>
                        </div><div class="block clearfix" data-x-name="item" data-x-id="tar">
                            <div class="blockR">
                                <h2><img alt="" class="ico7 imgDot"><span data-x-id="tit" contenteditable="true">Mục tiêu nghề nghiệp</span></h2>
                                <div class="block_content">
                                    <div class="block_line" data-x-id="name" contenteditable="true"> -<?php echo $row['muctieunghenghiep'] ?></div>
                                </div>
                            </div>
                        </div><div class="block clearfix" data-x-name="item" data-x-id="edu">
                            <div class="blockR">
                                <h2 data-x-name="head"><img alt="" class="ico8 imgDot"><span data-x-id="tit" contenteditable="true">Học vấn</span></h2>
								<div class="block_content" data-x-name="list-item"> 
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
										<div class="block_line clearfix" data-x-name="sub-item">
											<h4 class="clearfix"><div class="truong"> <?php echo $truongkhoahoc[$num_] ?></div></h4>
											 <p class="date"><img class="ico16" alt=""><?php echo $bangcap1[$num_] ?> </p>
											<div class="cont_txt clearfix">
												<div class="motachitiet"><?php echo $motachitiet[$num_] ?></div>
												<div class="normal">Bằng cấp: <?php echo $bangcap1[$num_] ?><?php if(!empty($bangcap2[$num_])){ ?>(<?php echo $bangcap2[$num_] ?>) <?php } ?></div>
											</div>
										</div>
									<?php }?>
								</div>
                            </div>
                        </div>
						
						<div class="block clearfix" data-x-name="item" data-x-id="exp">
                            <div class="blockR">
                                <h2 data-x-name="head"><img alt="" class="ico9 imgDot"><span data-x-id="tit" contenteditable="true">Kinh nghiệm làm việc <?php if(!empty($row['kinhnghiem'])){ ?>( <?php echo $row['kinhnghiem'] ?> năm) <?php } ?></span></h2>
                                <div class="block_content" data-x-name="list-item">
                                    <?php
											$vitrichucdanh = explode("|", $row['vitrichucdanh']);
											$congty = explode("|", $row['congty']);
											$thoigianlamviec = explode("|", $row['thoigianlamviec']);
											$motacongviec = explode("|", $row['motacongviec']);
											for($num_ = 0; $num_ < count($vitrichucdanh); $num_++){
									?>
									<div class="block_line block_line2 clearfix" data-x-name="sub-item">
                                        <h4 class="clearfix"><div data-x-id="name" contenteditable="true"><?php echo $congty[$num_] ?></div> </h4>
                                        <div class="cont_txt"> <span data-x-id="pos" contenteditable="true"><?php echo $vitrichucdanh[$num_] ?></span> </div>
                                        <p class="date"><img class="ico16" alt=""> <?php echo $thoigianlamviec[$num_] ?></p>
                                        <div class="cont_txt">
                                          <?php echo $motacongviec[$num_] ?>
                                        </div>
                                    </div>
									<?php }?>
									
								</div>
                            </div>
                        </div><div class="block clearfix" data-x-name="item" data-x-id="hob">
                            <div class="blockR">
                                <h2><img alt="" class="ico11 imgDot"><span data-x-id="tit" contenteditable="true">KỶ NĂNG & THÀNH TÍCH NỔI BẬT</span></h2>
                                <div class="block_content" data-x-name="list-item">
                                
                                <div data-x-name="sub-item">
									 <?php echo $row['thanhtichnoibat'] ?>
                                   </div></div>
                            </div>
                        </div>
					 </div>
                    </div>
                </div>

					<!-- Right -->
				</div>
            </div>
        </div>
    </div>
</div>
        </div>
       
    </div>
</body>
</html>