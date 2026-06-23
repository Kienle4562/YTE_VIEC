<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include_once('com_congty.article.models.php');
	$myprocess = new process_article();
	$shareLink = "https://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI];
	$resultJob = $myprocess->get_job(intval($_GET["id"]));
?>
<link rel="stylesheet" type="text/css" href="plugins/sweetalert/sweet-alert.css">
<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/company/style.bundle.css") ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/company/vendors.bundle.css") ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/custom2.css"); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/jquery-simple-mobilemenu-slide.css"); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/css-stars.css") ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/fontawesome-stars-o.css"); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo $index.$template_folder; ?>/css/bootstrap.css">
<body class="cp">
	<header>
		
		
		<div class="modal fade social-share-popup" id="socialShareListModal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<h4 class="text-center">Share to</h4>
						<ul>
							<li>
								<a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $indexs; ?>" target="_blank">
									<span class="ic-facebook">
										<i class="fa fa-facebook"></i>
									</span>
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="https://twitter.com/home?status=<?php echo $shareLink ?>" class="ic-twitter" target="_blank">
									<span class="ic-twitter">
										<i class="fa fa-twitter"></i>
									</span>
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $shareLink ?>" target="_blank">
									<span class="ic-linkedIn">
										<i class="fa fa-linkedin"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane active">
			<!--<section id="home" class="cp_tab_content cp_herro_banner  vnw_hero_banner ">-->
			   <section id="home" class="cp_tab_content vnw_hero_banner ">
				<nav class="navbar navbar-inverse  vnw-profile-main-menu " style="background-color: <?php echo $row["chude"] ?>">
			   <div class="container-fluid">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 navbar-main-menu">
							<div class="navbar-header">
								<div class="cp_mobile_icon_menu">
									<ul class="cp_mobile_menu  noCoding ">
										<li>
											<a href="#home" data-id="info" class="active">
												<i class="icon-fixed-width fa fa-home"></i>
											</a>
										</li>
										<li>
											<a href="#jobs" data-id="info" class="">
												<i class="icon-fixed-width fa fa-briefcase"></i>
											</a>
										</li>
										<li>
											<a href="#office" data-id="info" class="">
												<i class="icon-fixed-width fa fa-building-o"></i>
											</a>
										</li>
										<li>
											<a href="#stories" data-id="info" class="">
												<i class="icon-fixed-width fa fa-info-circle"></i>
											</a>
										</li>
										<li>
											<a href="#people" data-id="info" class="">
												<i class="icon-fixed-width fa fa-group"></i>
											</a>
										</li>
										<li>
											<a href="#benefits" data-id="info" class="">
												<i class="icon-fixed-width fa fa-star"></i>
											</a>
										</li>
									</ul>
								</div>
							</div>
							<div id="navbar" class="navbar-collapse collapse">
								<ul class="nav navbar-nav main-menu">
									<li>
										<a href="#home" data-id="info" class="link-menu active">
											<i class="icon-fixed-width fa fa-home"></i>
											Về đầu trang
										</a>
									</li>
									<li>
										<a href="#jobs" data-id="info" class="link-menu">
											<i class="icon-fixed-width fa fa-briefcase"></i>
											Công việc                                        
										</a>
									</li>
									<li>
										<a href="#office" data-id="info" class="link-menu">
											<i class="icon-fixed-width fa fa-building-o"></i>
											Văn phòng                                        
										</a>
									</li>
									<li>
										<a href="#stories" data-id="info" class="link-menu">
											<i class="icon-fixed-width fa fa-info-circle"></i>
											Giới thiệu                                       
										</a>
									</li>
									<li>
										<a href="#people" data-id="info" class="link-menu">
											<i class="icon-fixed-width fa fa-group"></i>
											Con người                                        
										</a>
									</li>
									<li>
										<a href="#benefits" data-id="info" class="link-menu">
											<i class="icon-fixed-width fa fa-star"></i>
											Phúc lợi                                        
										</a>
									</li>
								</ul>
								<ul class="nav navbar-nav main-menu navbar-right">
									<li class="dropdown popup-social-share">
										<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
											<i class="icon-fixed-width fa fa-share-alt"></i> Share
										</a>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $shareLink ?>" target="_blank">
												<span class="ic-facebook">
													<i class="fa fa-facebook"></i>
												</span>
											</a>
											<a class="dropdown-item" href="https://twitter.com/home?status=<?php echo $shareLink ?>" class="ic-twitter" target="_blank">
												<span class="ic-twitter">
													<i class="fa fa-twitter"></i>
												</span>
											</a>
											<a class="dropdown-item" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $shareLink ?>" target="_blank">
												<span class="ic-linkedIn">
													<i class="fa fa-linkedin"></i>
												</span>
											</a>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</nav>
				<?php 
					if(str_replace("image/noimage.jpg", "", $row["banner"]) != ""){ 
				?>
				<img src="<?php echo $row["banner"] ?>" class="cp_herro_banner_image">
				<?php 
					}
				?>
				
			</section>
		</div>
		<section class="cp_basic_info" style="border-bottom-color:<?php echo $row["chude"] ?>; border-top: 1px solid <?php echo $row["chude"] ?>">
		<?php 
					if(str_replace("image/noimage.jpg", "", $row["hinhanh"]) != ""){ 
				?>
				<div class="company-overview mobile-show text-center">
					<div class="company-overview-logo">
						<img src="<?php echo $row["hinhanh"] ?>" alt="">
					</div>
				</div>
				<?php 
					}
				?>
			<div class="container">
				<div class="row">
					<?php 
						if(!empty($row["hinhanh"])){ 
					?>
					<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 cp_logo  mobile-hide">
						<div>
							<img src="<?php echo $row["hinhanh"] ?>" alt="">
						</div>
					</div>
					<?php 
						}
					?>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 cp_basic_info_details">
						<h2 id="cp_company_name"><?php echo $row["tencongty"] ?></h2>
						<?php 
								$resultLoaihinh = $myprocess->get_loaihinh(intval($row["loaihinhhoatdong_id"]));
								if($rowloaihinh = $resultLoaihinh->fetch())
								{
									 $loaihinhhoatdong = $rowloaihinh['tenloaihinhhoatdong'];
								}
								
								$resultQM_Cty = $myprocess->get_quimo(intval($row["quymo_id"]));
								
								if($rowQM = $resultQM_Cty->fetch())
								{
									$quimo = $rowQM['tenquymo'];
								}
						?>
						<ul>
							<li>
								<span class="li-items-limit" title="<?php echo $row["diachicongty"] ?>"> <i class="fa fa-map-marker"></i>  <?php echo $row["diachicongty"] ?> </span>
							</li>
							<li>
								<span class="li-items-limit" title="<?php echo $quimo ?>"> <i class="fa fa-group"></i>  <?php echo $quimo ?> -</span>  <span class="li-items-limit" title="<?php echo $loaihinhhoatdong ?>"> -  <i class="fa fa-gears"></i>  <?php echo $loaihinhhoatdong ?></span>
							</li>
							
							<li>
								<span class="li-items-limit">
									<a class="website-company" href="<?php echo $row["web"] ?>" target="_blank" style="color: <?php echo $row["chude"] ?>"><?php echo $row["web"] ?></a>
								</span>
								<?php 
									if(!empty($row["urlfacebook"])){ 
								?>
								<span class="line">|</span>
								<span class="find-us mobile-hide">
									<span class="find-us-title">Find us on</span>
									<a href="<?php echo $row["urlfacebook"] ?>" class="ic-social ic-social-facebook" target="_blank">
										<span>
											<i class="icon-fixed-width fa fa-facebook" aria-hidden="true"></i>
										</span>
									</a>
								</span>
								<?php }?>
							</li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 cp_follow_survey text-right">
						<?php 
								$FollowID = $core_class->findValues("trn_congty", "follow", array("congty_id" => intval($_GET["id"])));
								//echo $FollowID;
								$ArrayFollow = explode(",",$FollowID );
								$action = "";
								$lbbnt = "";
								$result = in_array(intval($_SESSION["career"]['career_id']), $ArrayFollow);
								if($result == 1 && !empty($_SESSION["career"]['career_id']))
								{
									$action = "follow_remove";
									$lbbnt = "UnFollow";
									
								}elseif ($result == null && !empty($_SESSION["career"]['career_id']))
								{
									$action = "follow_add";
									$lbbnt = "Follow";
								}else
								{
									$action = "follow_";
									$lbbnt = "Follow";
								}
						?>
						<a style="background-color:<?php echo $row["chude"] ?>" id="<?php echo $action ?>" class="btn-animation follow-company">
							<span id="follow_text"><?php echo $lbbnt ?></span>(<span class="countfl"><?php echo count(array_filter($ArrayFollow)) ?></span>)
						</a>
						<!--<div class="modal cp_follow_form fade fade" id="confirmFollow" tabindex="-1" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header text-left" style="background-color: <?php echo $row["chude"] ?>">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
										<h4 class="modal-title"> Follow <?php echo $row["tencongty"] ?> </h4>
									</div>
									<div class="modal-body confirm-follow-company">
										<p>Theo dõi <?php echo $row["tencongty"] ?> và nhận thông tin công việc mới nhất</p>
										<button type="button" class="btn btn-animation btn-primary" id="followConfirm" style="background-color:<?php echo $row["chude"] ?>;">Yes, send me notifications</button>
									</div>
								</div>
							</div>
						</div>-->
						<?php 
							if(!empty($row["urlfacebook"])){ 
						?>
						<!-- find us for mobile -->
						<span class="find-us mobile-show">
							<span class="find-us-title">Find us on</span>
							<a href="<?php echo $row["urlfacebook"] ?>" class="ic-social ic-facebook" target="_blank">
								<span>
									<i class="icon-fixed-width fa fa-facebook" aria-hidden="true"></i>
								</span>
							</a>
						</span>
						<?php }?>
					</div>
				</div>
			</div>
		</section>
	</header>                                                                                                                                                                                                                                                                                                                                                                     
    <!-- Section jobs list -->
    <section class="cp_container container">
            <div id="info" class="tab-pane fade active in ">
        
            <style>
        .cp_job_view_detail a.quick-apply:hover {
            border-color: #999;
            opacity: 1;
            background-color: transparent;
            color: #333;
        }
        .cp_job_view_detail a.quick-apply {
            border-color: <?php echo $row["chude"] ?>;
            background-color: <?php echo $row["chude"] ?>;
            color: #fff;
        }
        .cp_job_view_detail a:hover {
            border-color: <?php echo $row["chude"] ?>;
            background-color: <?php echo $row["chude"] ?>;
            color: #fff;
        }
        a.collapse-jobs-listing:hover span{
            background-color: <?php echo $row["chude"] ?>;
        }
        a.collapse-jobs-listing:hover span i{color: #fff}
        .load_more a:hover {
            border-color: <?php echo $row["chude"] ?>;
            background-color: <?php echo $row["chude"] ?>;
            color: #fff;
        }
    </style>
	<?php  
		if($totalJob > 0){ 
	?>
	<div class="cp_tab_content cp_our_jobs_section" id="jobs">
		<div class="container">
			<div class="panel-group">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" aria-expanded="false" aria-controls="jobsListing" href="#jobsListing" class="collapse-jobs-listing" style="color: <?php echo $row["chude"] ?>">
								<?php echo $totalJob ?> Công việc đang được mở. <strong>Xem toàn bộ công việc</strong>
								<span style="border-color: <?php echo $row["chude"] ?>">
									<i class="fa fa-angle-up"></i>
								</span>
							</a>
						</h4>
                    </div>
                    <div id="jobsListing" class="panel-collapse collapse cp_our_jobs_container in">
                        <div class="panel-body">
							<ul class="nav nav-tabs  m-tabs-line" role="tablist">
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link active" data-toggle="tab" href="#job_you" role="tab">
										<?php 
											 $Counttongquan = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"]
												));
										?>
										<h4 style="border-color: <?php echo $row["chude"] ?>"> <i class="fa fa-bar-chart"></i> Có <?php echo $totalJob ?> công việc dành cho bạn</h4>
									</a>
								</li>
								
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link" data-toggle="tab" href="#job_raiting" role="tab">
										
										<h4 style="border-color: <?php echo $row["chude"] ?>"> <i class="fa fa-heart"></i> Có <span class="totalrating"><?php echo $Counttongquan['COUNT(1)'] ?></span> Đánh giá </h4>
									</a>
								</li>
								<!--<li class="nav-item m-tabs__item">
								    <a class="nav-link m-tabs__link" data-toggle="tab" href="#job_review" role="tab">
										<h4 style="border-color: <?php echo $row["chude"] ?>"> <i class="fa fa-edit"></i> Viết đánh giá </h4>
									</a>
								</li>-->
							</ul>
								<div class="tab-content">
											<div class="tab-pane active" id="job_you" role="tabpanel">
												 <div class="jobs_listing_block  show_all_jobs">
													<?php
														while($rowJob = $resultJob->fetch()){
															$link = $core_class->_removesigns($rowJob["tencongviec"])."-".$rowJob["congviec_id"]."-cv.html";
															$postID = $rowJob["congviec_id"];
													?>
													<div class="cp_our_job_item show">
														<div class="row">
															<div class="col-xs-12 col-sm-10 cp_Job_summary_info">
																<h4>
																	<a href="<?php echo $link ?>" target="_blank"><?php echo $rowJob["tencongviec"] ?></a>
																</h4>
																<ul>
																 <?php if(!empty($rowJob["diadiemlamviec"])) { ?>
																	<li>
																	
																		<i class="fa fa-map-marker"></i>
																	
																		<?php echo $rowJob["diadiemlamviec"] ?>
																	</li>
																	 <?php } ?>
																	<li>
																		<i class="fa fa-calendar-o"></i>
																		<?php echo $core_class->time_ago(strtotime($rowJob["ngaydang"])) ?>
																	</li>
																</ul>
															</div>
															<div class="col-xs-12 col-sm-2 cp_job_view_detail">
																<a href="<?php echo $link ?>" target="_blank">
																	Xem chi tiết
																</a>
															</div>
														</div>
													</div>
													<?php }?>
												</div>
												<?php
													if($totalJob > 5){
												?>
												<div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
													<span id="<?php echo $postID; ?>" class="show_more" title="Load more posts">Xem thêm</span>
													<span class="loading" style="display: none;"><span class="loading_txt">Đang tải...</span></span>
												</div>
													<?php } ?>
												<!--<div class="load_more btn_load_more">
													<a>Xem thêm...</a>
												</div>-->
											
											</div>
											<!--- #2 STAR load STAR -->
											<?php  
											  // echo $_GET["id"];
											  $labelTongquan = " ";
												 $Tongquan5 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Tongquan' => 5,
												));
												 $Tongquan4 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Tongquan' => 4,
												));
												 $Tongquan3 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Tongquan' => 3,
												));
												 $Tongquan2 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Tongquan' => 2,
												));
												 $Tongquan1 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Tongquan' => 1,
												));
												$Tongquan = array(
													5 => intval($Tongquan5['COUNT(1)']),
													4 => intval($Tongquan4['COUNT(1)']),
													3 => intval($Tongquan3['COUNT(1)']),
													2 => intval($Tongquan2['COUNT(1)']),
													1 => intval($Tongquan1['COUNT(1)'])
													);
													
												$totalTongquan = $myprocess->calcAverageRating($Tongquan);
												
												if(intval($totalTongquan) == 5)
												{
													$labelTongquan = "Tuyệt vời";
													
												}else if(intval($totalTongquan) == 4)
												{
													$labelTongquan = "Rất tốt";
													
												}else if(intval($totalTongquan) == 3)
												{
													$labelTongquan = "Tốt";
													
												}
												else if(intval($totalTongquan) == 2)
												{
													$labelTongquan = "Cần cải thiện nhiều";
												}
												else if(intval($totalTongquan) == 1)
												{
													$labelTongquan = "Rất tệ";
												}
												// Case 1
												$labelCASE = '';
												 $Case_1_5 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_1' => 5,
												));
												 $Case_1_4 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_1' => 4,
												));
												 $Case_1_3 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_1' => 3,
												));
												 $Case_1_2 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_1' => 2,
												));
												 $Case_1_1 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_1' => 1,
												));
												$Case_1 = array(
													5 => intval($Case_1_5['COUNT(1)']),
													4 => intval($Case_1_4['COUNT(1)']),
													3 => intval($Case_1_3['COUNT(1)']),
													2 => intval($Case_1_2['COUNT(1)']),
													1 => intval($Case_1_1['COUNT(1)'])
													);
												$totalCase_1 = $myprocess->calcAverageRating($Case_1);
												// Case 2
												 $Case_2_5 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_2' => 5,
												));
												 $Case_2_4 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_2' => 4,
												));
												 $Case_2_3 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_2' => 3,
												));
												 $Case_2_2 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_2' => 2,
												));
												 $Case_2_1 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_2' => 1,
												));
												$Case_2 = array(
													5 => intval($Case_2_5['COUNT(1)']),
													4 => intval($Case_2_4['COUNT(1)']),
													3 => intval($Case_2_3['COUNT(1)']),
													2 => intval($Case_2_2['COUNT(1)']),
													1 => intval($Case_2_1['COUNT(1)'])
													);
												$totalCase_2 = $myprocess->calcAverageRating($Case_2);
												// Case 3
												 $Case_3_5 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_3' => 5,
												));
												 $Case_3_4 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_3' => 4,
												));
												 $Case_3_3 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_3' => 3,
												));
												 $Case_3_2 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_3' => 2,
												));
												 $Case_3_1 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_3' => 1,
												));
												$Case_3 = array(
													5 => intval($Case_3_5['COUNT(1)']),
													4 => intval($Case_3_4['COUNT(1)']),
													3 => intval($Case_3_3['COUNT(1)']),
													2 => intval($Case_3_2['COUNT(1)']),
													1 => intval($Case_3_1['COUNT(1)'])
													);
												$totalCase_3 = $myprocess->calcAverageRating($Case_3);
												// Case 4
												 $Case_4_5 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_4' => 5,
												));
												 $Case_4_4 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_4' => 4,
												));
												 $Case_4_3 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_4' => 3,
												));
												 $Case_4_2 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_4' => 2,
												));
												 $Case_4_1 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_4' => 1,
												));
												$Case_4 = array(
													5 => intval($Case_4_5['COUNT(1)']),
													4 => intval($Case_4_4['COUNT(1)']),
													3 => intval($Case_4_3['COUNT(1)']),
													2 => intval($Case_4_2['COUNT(1)']),
													1 => intval($Case_4_1['COUNT(1)'])
													);
												$totalCase_4 = $myprocess->calcAverageRating($Case_4);
												$labelCASE_1  =" ";
												if(intval($totalCase_1) == 5)
												{
													$labelCASE_1 = ' Tuyệt vời';
													
												}else if(intval($totalCase_1) == 4)
												{
													$labelCASE_1 = ' Rất tốt';
													
												}else if(intval($totalCase_1) == 3)
												{
													$labelCASE_1 = 'Tốt';
													
												}else if(intval($totalCase_1) == 2)
												{
													$labelCASE_1 = ' Cần cải thiện nhiều';
													
												}else if(intval($totalCase_1) == 1)
												{
													$labelCASE_1 = ' Rất tệ';
												}
												
												$labelCASE_2  =" ";
												
												if(intval($totalCase_2) == 5)
												{
													$labelCASE_2 = ' Tuyệt vời';
													
												}else if(intval($totalCase_2) == 4)
												{
													$labelCASE_2 = ' Rất tốt';
													
												}else if(intval($totalCase_2) == 3)
												{
													$labelCASE_2 = 'Tốt';
													
												}else if(intval($totalCase_2) == 2)
												{
													$labelCASE_2 = ' Cần cải thiện nhiều';
													
												}else if(intval($totalCase_1) == 1)
												{
													$labelCASE_2 = ' Rất tệ';
												}
												
												$labelCASE_3  =" ";
												
												if(intval($totalCase_3) == 5)
												{
													$labelCASE_3 = ' Tuyệt vời';
													
												}else if(intval($totalCase_3) == 4)
												{
													$labelCASE_3 = ' Rất tốt';
													
												}else if(intval($totalCase_3) == 3)
												{
													$labelCASE_3 = 'Tốt';
													
												}else if(intval($totalCase_3) == 2)
												{
													$labelCASE_3 = ' Cần cải thiện nhiều';
													
												}else if(intval($totalCase_3) == 1)
												{
													$labelCASE_3 = ' Rất tệ';
												}
												$labelCASE_4  =" ";
												if(intval($totalCase_4) == 5)
												{
													$labelCASE_4 = ' Tuyệt vời';
													
												}else if(intval($totalCase_4) == 4)
												{
													$labelCASE_4 = ' Rất tốt';
													
												}else if(intval($totalCase_4) == 3)
												{
													$labelCASE_4 = 'Tốt';
													
												}else if(intval($totalCase_4) == 2)
												{
													$labelCASE_4 = ' Cần cải thiện nhiều';
													
												}else if(intval($totalCase_4) == 1)
												{
													$labelCASE_4 = ' Rất tệ';
												}
											?>
											<div class="tab-pane" id="job_raiting" role="tabpanel">
												<div class="row summary-ratings">
														<div class="col-md-12 col-sm-12 list-stars">
															<div class="alert alert-brand alert-dismissible fade show   m-alert m-alert--square m-alert--air" role="alert">
																Dành ra 1 phút để đánh giá bên dưới. Đánh giá của bạn sẻ rất hữu ích cho cộng đồng Y tế đang tìm việc
															</div>
														</div>
														<div class="col-md-5 col-sm-12 list-stars">
															 <h4> Đánh giá tổng quan:</h4>
															
															<div class="col-lg-7 col-md-8 col-sm-12">
																	<div class='starrr' id='starOverView'>
																		<input type='hidden' name='caseOverView' value='<?php echo intval($totalTongquan) ?>' id='caseOverView' />
																	</div>
																	<span class="m-form__help"> <span class="class_label_tongquan"> <?php echo $labelTongquan; ?> <?php //echo intval($totalTongquan) ?></span></span>
																	<p class='class_label  m-form__help'>
																			
																	</p>
																	<p class='your-choice-was_OverView m-form__help' style='display: none;'>
																			Bạn đã đánh giá: <span class='choiceOverView'></span> sao.
																	</p>
																</div>
														</div>
														<div class="col-md-7 col-sm-12 list-stars">
																	<?php
																		$like = $core_class->find("trn_like_unlike", "count", array(
																			'IdCongty' => $_GET["id"],
																			'type'  => 1,
																		));
																		$unlike = $core_class->find("trn_like_unlike", "count", array(
																					'IdCongty' => $_GET["id"],
																					'type'  => 0,
																				));	
																				
																		$total = @(intval($like['COUNT(1)']) /(intval($like['COUNT(1)']) + intval($unlike['COUNT(1)'])) * 100) ;
																		
																	?>
																<h4 class="fm_lbname_"> Thống kê đề xuất : </h4> 
																<div class="form-group m-form__group">
																	<input class="knob" data-width="100" data-height="100" data-min="0" data-displayPrevious=true value="<?php echo round($total,1) ?>" readOnly>
															  </div>
															
														</div>
														<div class="col-md-8 col-sm-12 list-stars">
															<h4 class="m-section__heading"> Đánh giá cụ thể : </h4>
															<!-- # CASE 1 -->
															<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-6 col-sm-12">
																	 - Cơ sở vật chất & trang thiết bị 
																</label>
																<div class="col-lg-6 col-md-8 col-sm-12">
																	<div class='starrr' id='star1'>
																		<input type='hidden' name='case1' value='<?php echo intval($totalCase_1) ?>' id='case1' />
																	</div>
																	<span class="m-form__help fmlb class_label_1"> <?php echo $labelCASE_1; ?> <?php //echo intval($totalCase_1) ?></span>
																	<p class='class_label class_label_1 m-form__help'></p>
																	<p class='your-choice-was1 m-form__help' style='display: none;'>
																			Bạn đã đánh giá: <span class='choice1'></span> sao.
																	</p>
																</div>
																
															</div>
															<!-- # CASE 2 -->
															<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-6 col-sm-12">
																	 - Lương, thưởng, chế độ đãi ngộ
																</label>
																<div class="col-lg-6 col-md-8 col-sm-12">
																	<div class='starrr' id='star2'>
																		<input type='hidden' name='case2' value='<?php echo intval($totalCase_2) ?>' id='case2' />
																	</div>
																	<span class="m-form__help class_label_2 fmlb"> <?php echo $labelCASE_2; ?> <?php //echo intval($totalCase_2) ?> </span>
																	 <p class='class_label class_label_2 m-form__help'>	</p>
																	
																	<p class='your-choice-was2 m-form__help' style='display: none;'>
																			Bạn đã đánh giá : <span class='choice2'></span> sao.
																	</p>
																</div>
																
															</div>
															<!-- # CASE 3 -->
															<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-6 col-sm-12">
																	- Điều kiện, cơ hội phát triển chuyên môn
																</label>
																<div class="col-lg-6 col-md-8 col-sm-12">
																	<div class='starrr' id='star3'>
																		<input type='hidden' name='case3' value='<?php echo intval($totalCase_3) ?>' id='case3' />
																	</div>
																	<span class="m-form__help class_label_3 fmlb"> <?php echo $labelCASE_3; ?> <?php //echo intval($totalCase_3) ?></span>
																	<p class='class_label  m-form__help'></p>
																	
																	<p class='your-choice-was3 m-form__help' style='display: none;'>
																			Bạn đã đánh giá : <span class='choice3'></span> sao.
																	</p>
																</div>
																
															</div>
															<!-- # CASE 4 -->
															
															<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-6 col-sm-12">
																	- Văn hóa, đời sống tinh thần  
																</label>
																<div class="col-lg-6 col-md-8 col-sm-12">
																	<div class='starrr' id='star4'>
																		<input type='hidden' name='case4' value='<?php echo intval($totalCase_4) ?>' id='case4' />
																	</div>
																	<span class="m-form__help class_label_4 fmlb"> <?php echo $labelCASE_4; ?><?php //echo intval($totalCase_4) ?></span>
																	<p class='class_label  m-form__help'>		
																	</p>
																	<p class='your-choice-was4 m-form__help' style='display: none;'>
																			Bạn đã đánh giá : <span class='choice4'></span> sao.
																	</p>
																</div>
																
															</div>
															
															<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-6 col-sm-12">
																	Đề xuất làm việc ở đây
																</label>
																<div class="m-checkbox-inline">
																		<a id="like" data-id="1" data-company="<?php echo $_GET['id'] ?>" href="#" onclick="return false" class="m-like">
																			<i class="fa fa-thumbs-o-up"></i>
																				Có(<span class="totalLike"><?php echo $like['COUNT(1)'] ?></span>)
																			
																		</a>
																		<a id="unlike" data-id="0" data-company="<?php echo $_GET['id'] ?>" href="#" onclick="return false" class="m-Unlike">
																			<i class="fa fa-thumbs-o-down"></i>
																				Không (<span class="totalUnLike"><?php echo $unlike['COUNT(1)'] ?></span>)
																			
																		</a>
																	</div>
															</div>
															<!-- # Note -->
															<!--<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-12 col-sm-12 m--font-info">
																	* Ghi chú :   
																</label>
																<div class="col-lg-12 col-md-12 col-sm-12">
																	<div class="row">
																			<div class="col-md-2">
																				<div class="m-demo-icon__class fm_13px m--font-warning">
																						1 Sao : rất tệ
																					</div>
																			</div>
																			<div class="col-md-3">
																				<div class="m-demo-icon__class fm_13px m--font-warning">
																					2 Sao: cần cải thiện nhiều
																				</div>
																			</div>
																			<div class="col-md-2 ">
																				<div class="m-demo-icon__class fm_13px m--font-warning">
																					3 Sao: tốt
																				</div>
																			
																			</div>
																			<div class="col-md-2">
																				<div class="m-demo-icon__class fm_13px m--font-warning">
																					4 Sao: rất tốt
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="m-demo-icon__class fm_13px m--font-warning">
																					5 Sao: tuyệt vời
																				</div>
																			</div>
																	</div>
																</div>
															</div> -->
														</div>
												</div>
											</div>
											<!-- #2 END load data starr -->
											<!--<div class="tab-pane" id="job_review" role="tabpanel">
													<form class="m-form m-form--fit m-form--label-align-right">
														<div class="m-portlet__body">
															<div class="form-group m-form__group m--margin-top-10">
																<div class="alert m-alert m-alert--default" role="alert">
																	Gửi ý kiến / Đề xuất làm việc / Thông tin về công ty
																</div>
															</div>
														<div class="form-group m-form__group">
															<label for="exampleInputEmail1">
																Tiêu đề
															</label>
															<input type="text" class="form-control m-input m-input--air" id="title" placeholder="Nhập tiêu đề">
															<span class="m-form__help">
																We'll never share your email with anyone else.
															</span>
														</div>
														<div class="form-group m-form__group">
															<label for="exampleTextarea">
																Nội dung : 
															</label>
															  <textarea class="form-control" id="m_maxlength_5" maxlength="800"  placeholder="Nhập nội dung" rows="6"></textarea>
														</div>
													</div>
													<div class="m-portlet__foot m-portlet__foot--fit">
														<div class="m-form__actions">
															<button type="reset" class="btn btn-accent">
																Gửi nội dung
															</button>
															<button type="reset" class="btn btn-secondary">
																Thoát
															</button>
														</div>
													</div>
												</form>
											</div> -->
									</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php
		}else{
	?>
		<!-- #123-->
		<div class="cp_tab_content cp_our_jobs_section" id="jobs">
		<div class="container">
			<div class="panel-group">
				<div class="panel panel-default">
					
                    <div id="jobsListing" class="panel-collapse collapse cp_our_jobs_container in">
                        <div class="panel-body">
							<ul class="nav nav-tabs  m-tabs-line" role="tablist">
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link active" data-toggle="tab" href="#job_you" role="tab">
										<?php 
											 $Counttongquan = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"]
												));
										?>
										<h4 style="border-color: <?php echo $row["chude"] ?>"> <i class="fa fa-bar-chart"></i> Có <?php echo $totalJob ?> công việc dành cho bạn</h4>
									</a>
								</li>
								
								<li class="nav-item m-tabs__item">
									<a class="nav-link m-tabs__link" data-toggle="tab" href="#job_raiting" role="tab">
										
										<h4 style="border-color: <?php echo $row["chude"] ?>"> <i class="fa fa-heart"></i> Có <span class="totalrating"><?php echo $Counttongquan['COUNT(1)'] ?></span> Đánh giá </h4>
									</a>
								</li>
								<!--<li class="nav-item m-tabs__item">
								    <a class="nav-link m-tabs__link" data-toggle="tab" href="#job_review" role="tab">
										<h4 style="border-color: <?php echo $row["chude"] ?>"> <i class="fa fa-edit"></i> Viết đánh giá </h4>
									</a>
								</li>-->
							</ul>
								<div class="tab-content">
											<div class="tab-pane active" id="job_you" role="tabpanel">
												 <div class="jobs_listing_block  show_all_jobs">
													Không có công việc dành cho bạn
												</div>
												<?php
													if($totalJob > 5){
												?>
												<div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
													<span id="<?php echo $postID; ?>" class="show_more" title="Load more posts">Xem thêm</span>
													<span class="loading" style="display: none;"><span class="loading_txt">Đang tải...</span></span>
												</div>
													<?php } ?>
												<!--<div class="load_more btn_load_more">
													<a>Xem thêm...</a>
												</div>-->
											
											</div>
											<!--- #2 STAR load STAR -->
											<?php  
											  // echo $_GET["id"];
											  $labelTongquan = " ";
												 $Tongquan5 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Tongquan' => 5,
												));
												 $Tongquan4 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Tongquan' => 4,
												));
												 $Tongquan3 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Tongquan' => 3,
												));
												 $Tongquan2 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Tongquan' => 2,
												));
												 $Tongquan1 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Tongquan' => 1,
												));
												$Tongquan = array(
													5 => intval($Tongquan5['COUNT(1)']),
													4 => intval($Tongquan4['COUNT(1)']),
													3 => intval($Tongquan3['COUNT(1)']),
													2 => intval($Tongquan2['COUNT(1)']),
													1 => intval($Tongquan1['COUNT(1)'])
													);
													
												$totalTongquan = $myprocess->calcAverageRating($Tongquan);
												
												if(intval($totalTongquan) == 5)
												{
													$labelTongquan = "Tuyệt vời";
													
												}else if(intval($totalTongquan) == 4)
												{
													$labelTongquan = "Rất tốt";
													
												}else if(intval($totalTongquan) == 3)
												{
													$labelTongquan = "Tốt";
													
												}
												else if(intval($totalTongquan) == 2)
												{
													$labelTongquan = "Cần cải thiện nhiều";
												}
												else if(intval($totalTongquan) == 1)
												{
													$labelTongquan = "Rất tệ";
												}
												// Case 1
												$labelCASE = '';
												 $Case_1_5 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_1' => 5,
												));
												 $Case_1_4 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_1' => 4,
												));
												 $Case_1_3 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_1' => 3,
												));
												 $Case_1_2 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_1' => 2,
												));
												 $Case_1_1 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_1' => 1,
												));
												$Case_1 = array(
													5 => intval($Case_1_5['COUNT(1)']),
													4 => intval($Case_1_4['COUNT(1)']),
													3 => intval($Case_1_3['COUNT(1)']),
													2 => intval($Case_1_2['COUNT(1)']),
													1 => intval($Case_1_1['COUNT(1)'])
													);
												$totalCase_1 = $myprocess->calcAverageRating($Case_1);
												// Case 2
												 $Case_2_5 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_2' => 5,
												));
												 $Case_2_4 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_2' => 4,
												));
												 $Case_2_3 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_2' => 3,
												));
												 $Case_2_2 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_2' => 2,
												));
												 $Case_2_1 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_2' => 1,
												));
												$Case_2 = array(
													5 => intval($Case_2_5['COUNT(1)']),
													4 => intval($Case_2_4['COUNT(1)']),
													3 => intval($Case_2_3['COUNT(1)']),
													2 => intval($Case_2_2['COUNT(1)']),
													1 => intval($Case_2_1['COUNT(1)'])
													);
												$totalCase_2 = $myprocess->calcAverageRating($Case_2);
												// Case 3
												 $Case_3_5 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_3' => 5,
												));
												 $Case_3_4 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_3' => 4,
												));
												 $Case_3_3 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_3' => 3,
												));
												 $Case_3_2 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_3' => 2,
												));
												 $Case_3_1 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_3' => 1,
												));
												$Case_3 = array(
													5 => intval($Case_3_5['COUNT(1)']),
													4 => intval($Case_3_4['COUNT(1)']),
													3 => intval($Case_3_3['COUNT(1)']),
													2 => intval($Case_3_2['COUNT(1)']),
													1 => intval($Case_3_1['COUNT(1)'])
													);
												$totalCase_3 = $myprocess->calcAverageRating($Case_3);
												// Case 4
												 $Case_4_5 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_4' => 5,
												));
												 $Case_4_4 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_4' => 4,
												));
												 $Case_4_3 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_4' => 3,
												));
												 $Case_4_2 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_4' => 2,
												));
												 $Case_4_1 = $core_class->find("trn_raiting", "count", array(
														'Id_congTy' => $_GET["id"],
														'Case_4' => 1,
												));
												$Case_4 = array(
													5 => intval($Case_4_5['COUNT(1)']),
													4 => intval($Case_4_4['COUNT(1)']),
													3 => intval($Case_4_3['COUNT(1)']),
													2 => intval($Case_4_2['COUNT(1)']),
													1 => intval($Case_4_1['COUNT(1)'])
													);
												$totalCase_4 = $myprocess->calcAverageRating($Case_4);
												$labelCASE_1  =" ";
												if(intval($totalCase_1) == 5)
												{
													$labelCASE_1 = ' Tuyệt vời';
													
												}else if(intval($totalCase_1) == 4)
												{
													$labelCASE_1 = ' Rất tốt';
													
												}else if(intval($totalCase_1) == 3)
												{
													$labelCASE_1 = 'Tốt';
													
												}else if(intval($totalCase_1) == 2)
												{
													$labelCASE_1 = ' Cần cải thiện nhiều';
													
												}else if(intval($totalCase_1) == 1)
												{
													$labelCASE_1 = ' Rất tệ';
												}
												
												$labelCASE_2  =" ";
												
												if(intval($totalCase_2) == 5)
												{
													$labelCASE_2 = ' Tuyệt vời';
													
												}else if(intval($totalCase_2) == 4)
												{
													$labelCASE_2 = ' Rất tốt';
													
												}else if(intval($totalCase_2) == 3)
												{
													$labelCASE_2 = 'Tốt';
													
												}else if(intval($totalCase_2) == 2)
												{
													$labelCASE_2 = ' Cần cải thiện nhiều';
													
												}else if(intval($totalCase_1) == 1)
												{
													$labelCASE_2 = ' Rất tệ';
												}
												
												$labelCASE_3  =" ";
												
												if(intval($totalCase_3) == 5)
												{
													$labelCASE_3 = ' Tuyệt vời';
													
												}else if(intval($totalCase_3) == 4)
												{
													$labelCASE_3 = ' Rất tốt';
													
												}else if(intval($totalCase_3) == 3)
												{
													$labelCASE_3 = 'Tốt';
													
												}else if(intval($totalCase_3) == 2)
												{
													$labelCASE_3 = ' Cần cải thiện nhiều';
													
												}else if(intval($totalCase_3) == 1)
												{
													$labelCASE_3 = ' Rất tệ';
												}
												$labelCASE_4  =" ";
												if(intval($totalCase_4) == 5)
												{
													$labelCASE_4 = ' Tuyệt vời';
													
												}else if(intval($totalCase_4) == 4)
												{
													$labelCASE_4 = ' Rất tốt';
													
												}else if(intval($totalCase_4) == 3)
												{
													$labelCASE_4 = 'Tốt';
													
												}else if(intval($totalCase_4) == 2)
												{
													$labelCASE_4 = ' Cần cải thiện nhiều';
													
												}else if(intval($totalCase_4) == 1)
												{
													$labelCASE_4 = ' Rất tệ';
												}
											?>
											<div class="tab-pane" id="job_raiting" role="tabpanel">
												<div class="row summary-ratings">
														<div class="col-md-12 col-sm-12 list-stars">
															<div class="alert alert-brand alert-dismissible fade show   m-alert m-alert--square m-alert--air" role="alert">
																Dành ra 1 phút để đánh giá bên dưới. Đánh giá của bạn sẻ rất hữu ích cho cộng đồng Y tế đang tìm việc
															</div>
														</div>
														<div class="col-md-5 col-sm-12 list-stars">
															 <h4> Đánh giá tổng quan:</h4>
															
															<div class="col-lg-7 col-md-8 col-sm-12">
																	<div class='starrr' id='starOverView'>
																		<input type='hidden' name='caseOverView' value='<?php echo intval($totalTongquan) ?>' id='caseOverView' />
																	</div>
																	<span class="m-form__help"> <span class="class_label_tongquan"> <?php echo $labelTongquan; ?> <?php //echo intval($totalTongquan) ?></span></span>
																	<p class='class_label  m-form__help'>
																			
																	</p>
																	<p class='your-choice-was_OverView m-form__help' style='display: none;'>
																			Bạn đã đánh giá: <span class='choiceOverView'></span> sao.
																	</p>
																</div>
														</div>
														<div class="col-md-7 col-sm-12 list-stars">
																	<?php
																		$like = $core_class->find("trn_like_unlike", "count", array(
																			'IdCongty' => $_GET["id"],
																			'type'  => 1,
																		));
																		$unlike = $core_class->find("trn_like_unlike", "count", array(
																					'IdCongty' => $_GET["id"],
																					'type'  => 0,
																				));	
																				
																		$total = @(intval($like['COUNT(1)']) /(intval($like['COUNT(1)']) + intval($unlike['COUNT(1)'])) * 100) ;
																		
																	?>
																<h4 class="fm_lbname_"> Thống kê đề xuất : </h4> 
																<div class="form-group m-form__group">
																	<input class="knob" data-width="100" data-height="100" data-min="0" data-displayPrevious=true value="<?php echo round($total,1) ?>" readOnly>
															  </div>
															
														</div>
														<div class="col-md-8 col-sm-12 list-stars">
															<h4 class="m-section__heading"> Đánh giá cụ thể : </h4>
															<!-- # CASE 1 -->
															<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-6 col-sm-12">
																	 - Cơ sở vật chất & trang thiết bị 
																</label>
																<div class="col-lg-6 col-md-8 col-sm-12">
																	<div class='starrr' id='star1'>
																		<input type='hidden' name='case1' value='<?php echo intval($totalCase_1) ?>' id='case1' />
																	</div>
																	<span class="m-form__help fmlb class_label_1"> <?php echo $labelCASE_1; ?> <?php //echo intval($totalCase_1) ?></span>
																	<p class='class_label class_label_1 m-form__help'></p>
																	<p class='your-choice-was1 m-form__help' style='display: none;'>
																			Bạn đã đánh giá: <span class='choice1'></span> sao.
																	</p>
																</div>
																
															</div>
															<!-- # CASE 2 -->
															<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-6 col-sm-12">
																	 - Lương, thưởng, chế độ đãi ngộ
																</label>
																<div class="col-lg-6 col-md-8 col-sm-12">
																	<div class='starrr' id='star2'>
																		<input type='hidden' name='case2' value='<?php echo intval($totalCase_2) ?>' id='case2' />
																	</div>
																	<span class="m-form__help class_label_2 fmlb"> <?php echo $labelCASE_2; ?> <?php //echo intval($totalCase_2) ?> </span>
																	 <p class='class_label class_label_2 m-form__help'>	</p>
																	
																	<p class='your-choice-was2 m-form__help' style='display: none;'>
																			Bạn đã đánh giá : <span class='choice2'></span> sao.
																	</p>
																</div>
																
															</div>
															<!-- # CASE 3 -->
															<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-6 col-sm-12">
																	- Điều kiện, cơ hội phát triển chuyên môn
																</label>
																<div class="col-lg-6 col-md-8 col-sm-12">
																	<div class='starrr' id='star3'>
																		<input type='hidden' name='case3' value='<?php echo intval($totalCase_3) ?>' id='case3' />
																	</div>
																	<span class="m-form__help class_label_3 fmlb"> <?php echo $labelCASE_3; ?> <?php //echo intval($totalCase_3) ?></span>
																	<p class='class_label  m-form__help'></p>
																	
																	<p class='your-choice-was3 m-form__help' style='display: none;'>
																			Bạn đã đánh giá : <span class='choice3'></span> sao.
																	</p>
																</div>
																
															</div>
															<!-- # CASE 4 -->
															
															<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-6 col-sm-12">
																	- Văn hóa, đời sống tinh thần  
																</label>
																<div class="col-lg-6 col-md-8 col-sm-12">
																	<div class='starrr' id='star4'>
																		<input type='hidden' name='case4' value='<?php echo intval($totalCase_4) ?>' id='case4' />
																	</div>
																	<span class="m-form__help class_label_4 fmlb"> <?php echo $labelCASE_4; ?><?php //echo intval($totalCase_4) ?></span>
																	<p class='class_label  m-form__help'>		
																	</p>
																	<p class='your-choice-was4 m-form__help' style='display: none;'>
																			Bạn đã đánh giá : <span class='choice4'></span> sao.
																	</p>
																</div>
																
															</div>
															
															<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-6 col-sm-12">
																	Đề xuất làm việc ở đây
																</label>
																<div class="m-checkbox-inline">
																		<a id="like" data-id="1" data-company="<?php echo $_GET['id'] ?>" href="#" onclick="return false" class="m-like">
																			<i class="fa fa-thumbs-o-up"></i>
																				Có(<span class="totalLike"><?php echo $like['COUNT(1)'] ?></span>)
																			
																		</a>
																		<a id="unlike" data-id="0" data-company="<?php echo $_GET['id'] ?>" href="#" onclick="return false" class="m-Unlike">
																			<i class="fa fa-thumbs-o-down"></i>
																				Không (<span class="totalUnLike"><?php echo $unlike['COUNT(1)'] ?></span>)
																			
																		</a>
																	</div>
															</div>
															<!-- # Note -->
															<!--<div class="form-group m-form__group row">
																<label class="col-form-label col-lg-12 col-sm-12 m--font-info">
																	* Ghi chú :   
																</label>
																<div class="col-lg-12 col-md-12 col-sm-12">
																	<div class="row">
																			<div class="col-md-2">
																				<div class="m-demo-icon__class fm_13px m--font-warning">
																						1 Sao : rất tệ
																					</div>
																			</div>
																			<div class="col-md-3">
																				<div class="m-demo-icon__class fm_13px m--font-warning">
																					2 Sao: cần cải thiện nhiều
																				</div>
																			</div>
																			<div class="col-md-2 ">
																				<div class="m-demo-icon__class fm_13px m--font-warning">
																					3 Sao: tốt
																				</div>
																			
																			</div>
																			<div class="col-md-2">
																				<div class="m-demo-icon__class fm_13px m--font-warning">
																					4 Sao: rất tốt
																				</div>
																			</div>
																			<div class="col-md-2">
																				<div class="m-demo-icon__class fm_13px m--font-warning">
																					5 Sao: tuyệt vời
																				</div>
																			</div>
																	</div>
																</div>
															</div> -->
														</div>
												</div>
											</div>
											<!-- #2 END load data starr -->
											<!--<div class="tab-pane" id="job_review" role="tabpanel">
													<form class="m-form m-form--fit m-form--label-align-right">
														<div class="m-portlet__body">
															<div class="form-group m-form__group m--margin-top-10">
																<div class="alert m-alert m-alert--default" role="alert">
																	Gửi ý kiến / Đề xuất làm việc / Thông tin về công ty
																</div>
															</div>
														<div class="form-group m-form__group">
															<label for="exampleInputEmail1">
																Tiêu đề
															</label>
															<input type="text" class="form-control m-input m-input--air" id="title" placeholder="Nhập tiêu đề">
															<span class="m-form__help">
																We'll never share your email with anyone else.
															</span>
														</div>
														<div class="form-group m-form__group">
															<label for="exampleTextarea">
																Nội dung : 
															</label>
															  <textarea class="form-control" id="m_maxlength_5" maxlength="800"  placeholder="Nhập nội dung" rows="6"></textarea>
														</div>
													</div>
													<div class="m-portlet__foot m-portlet__foot--fit">
														<div class="m-form__actions">
															<button type="reset" class="btn btn-accent">
																Gửi nội dung
															</button>
															<button type="reset" class="btn btn-secondary">
																Thoát
															</button>
														</div>
													</div>
												</form>
											</div> -->
									</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<?php }?>
	<?php 
		if(
			str_replace("image/noimage.jpg", "", $row["hinhgioithieu1"]) != "" &&
			str_replace("image/noimage.jpg", "", $row["hinhgioithieu2"]) != "" &&
			str_replace("image/noimage.jpg", "", $row["hinhgioithieu3"]) != "" &&
			str_replace("image/noimage.jpg", "", $row["hinhgioithieu4"]) != "" &&
			str_replace("image/noimage.jpg", "", $row["hinhgioithieu5"]) != "" &&
			str_replace("image/noimage.jpg", "", $row["hinhgioithieu6"]) != "" &&
			str_replace("image/noimage.jpg", "", $row["hinhgioithieu7"]) != "" &&
			str_replace("image/noimage.jpg", "", $row["hinhgioithieu8"])
		){ 
	?>
    <div class="cp_tab_content cp_our_office_section" id="office">
		<div class="row">
			<div class="col-sm-12 cp_header_section">
				<h2>
					Hình ảnh tổng quan
					<span class="cp_under_line" style="background-color: <?php echo $row["chude"] ?>"></span>
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 cp_container_section">
				<div class="container">
					<div class="row">
						<ul class="cp_our_office">
							<?php if(!empty($row["hinhgioithieu1"])){ ?>
							<li class="col-xs-12 col-sm-4 cp_office_item">
								<div class="cp_our_office_img cp_img-container" style="background: url(<?php echo $row["hinhgioithieu1"] ?>)"></div>
							</li>
							<?php }?>
							<?php if(!empty($row["hinhgioithieu2"])){ ?>
							<li class="col-xs-12 col-sm-4 cp_office_item">
								<div class="cp_our_office_img cp_img-container" style="background: url(<?php echo $row["hinhgioithieu2"] ?>)"></div>
							</li>
							<?php }?>
							<?php if(!empty($row["hinhgioithieu3"])){ ?>
							<li class="col-xs-12 col-sm-4 cp_office_item">
								<div class="cp_our_office_img cp_img-container" style="background: url(<?php echo $row["hinhgioithieu3"] ?>)"></div>
							</li>
							<?php }?>
							<?php if(!empty($row["hinhgioithieu4"])){ ?>
							<li class="col-xs-12 col-sm-4 cp_office_item">
								<div class="cp_our_office_img cp_img-container" style="background: url(<?php echo $row["hinhgioithieu4"] ?>)"></div>
							</li>
							<?php }?>
							<li class="col-xs-12 col-sm-4 cp_office_item">
								<div class="cp_our_office_img cp_address-container" style="background-color: <?php echo $row["chude"] ?>">
									<h3>GIỚI THIỆU</h3>
									<p><?php echo $row["gioithieungan"] ?></p>
								</div>
							</li>
							<?php if(!empty($row["hinhgioithieu5"])){ ?>
							<li class="col-xs-12 col-sm-4 cp_office_item">
								<div class="cp_our_office_img cp_img-container" style="background: url(<?php echo $row["hinhgioithieu5"] ?>)"></div>
							</li>
							<?php }?>
							<?php if(!empty($row["hinhgioithieu6"])){ ?>
							<li class="col-xs-12 col-sm-4 cp_office_item">
								<div class="cp_our_office_img cp_img-container" style="background: url(<?php echo $row["hinhgioithieu6"] ?>)"></div>
							</li>
							<?php }?>
							<?php if(!empty($row["hinhgioithieu7"])){ ?>
							<li class="col-xs-12 col-sm-4 cp_office_item">
								<div class="cp_our_office_img cp_img-container" style="background: url(<?php echo $row["hinhgioithieu7"] ?>)"></div>
							</li>
							<?php }?>
							<?php if(!empty($row["hinhgioithieu8"])){ ?>
							<li class="col-xs-12 col-sm-4 cp_office_item">
								<div class="cp_our_office_img cp_img-container" style="background: url(<?php echo $row["hinhgioithieu8"] ?>)"></div>
							</li>
							<?php }?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
	<?php 
		if(
			!empty($row["tieudegioithieu1"]) &&
			!empty($row["tieudegioithieu2"]) &&
			!empty($row["tieudegioithieu3"]) &&
			!empty($row["tieudegioithieu4"]) &&
			!empty($row["tieudegioithieu5"])
		){ 
	?>
    <div class="cp_tab_content cp_our_story_section" id="stories">
		<div class="row">
			<div class="col-sm-12 cp_header_section">
				<h2>
					Giới Thiệu Tổng Quát
					<span class="cp_under_line" style="background-color: <?php echo $row["chude"] ?>"></span>
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="cp_container_section">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 cp_our_story_container">
							<?php if(!empty($row["tieudegioithieu1"]) && !empty($row["noidunggioithieu1"])){ ?>
							<div class="row">
								<div class="cp_our_story_item_option">
									<div class="cp_story_item">
										<div class="col-xs-12 <?php echo empty($row["idyoutube"]) ? "col-sm-12" : "col-sm-6" ?> cp_story_item_content" style="border-color: <?php echo $row["chude"] ?>">
											<h2 style="color: <?php echo $row["chude"] ?>"><?php echo $row["tieudegioithieu1"] ?></h2>
											<p><?php echo $row["noidunggioithieu1"] ?></p>
										</div>
										<?php if(!empty($row["idyoutube"])){ ?>
										<div class="col-xs-12 col-sm-6 cp_story_item_media" style="border-color: <?php echo $row["chude"] ?>">
											<iframe src="https://www.youtube.com/embed/<?php echo $row["idyoutube"] ?>" width="100%" height="411" frameborder="0" allowfullscreen></iframe>
										</div>
										<?php }?>
									</div>
								</div>
							</div>
							<?php }?>
							<?php if(!empty($row["tieudegioithieu2"]) && !empty($row["noidunggioithieu2"])){ ?>
							<div class="row">
								<div class="cp_our_story_item_option">
									<div class="cp_story_item">
										<?php if(!empty($row["hinhanhgioithieu2"])){ ?>
										<div class="col-xs-12 col-sm-6 cp_story_item_media" style="border-color: <?php echo $row["chude"] ?>">
											<img src="<?php echo $row["hinhanhgioithieu2"] ?>" width="100%"/>
										</div>
										<?php }?>
										<div class="col-xs-12 <?php echo empty($row["hinhanhgioithieu2"]) ? "col-sm-12" : "col-sm-6" ?> cp_story_item_content" style="border-color: <?php echo $row["chude"] ?>">
											<h2 style="color: <?php echo $row["chude"] ?>"><?php echo $row["tieudegioithieu2"] ?></h2>
											<p><?php echo $row["noidunggioithieu2"] ?></p>
										</div>
									</div>
								</div>
							</div>
							<?php }?>
							<div class="row">
								<div class="cp_our_story_item_option cp_our_story_item_option3">
									<?php if(!empty($row["tieudegioithieu3"]) && !empty($row["noidunggioithieu3"])){ ?>
									<div class="cp_story_item_3 cp_story_item">
										<div class="col-xs-12 col-sm-4 cp_story_item_content" style="border-color: <?php echo $row["chude"] ?>">
											<h2 style="color: <?php echo $row["chude"] ?>"><?php echo $row["tieudegioithieu3"] ?></h2>
											<p><?php echo $row["noidunggioithieu3"] ?></p>
										</div>
									</div>
									<?php }?>
									<?php if(!empty($row["tieudegioithieu4"]) && !empty($row["noidunggioithieu4"])){ ?>
									<div class="cp_story_item_3 cp_story_item">
										<div class="col-xs-12 col-sm-4 cp_story_item_content" style="border-color: <?php echo $row["chude"] ?>">
											<h2 style="color: <?php echo $row["chude"] ?>"><?php echo $row["tieudegioithieu4"] ?></h2>
											<p><?php echo $row["noidunggioithieu4"] ?></p>
										</div>
									</div>
									<?php }?>
									<?php if(!empty($row["tieudegioithieu5"]) && !empty($row["noidunggioithieu5"])){ ?>
									<div class="cp_story_item_3 cp_story_item">
										<div class="col-xs-12 col-sm-4 cp_story_item_content" style="border-color: <?php echo $row["chude"] ?>">
											<h2 style="color: <?php echo $row["chude"] ?>"><?php echo $row["tieudegioithieu5"] ?></h2>
											<p><?php echo $row["noidunggioithieu5"] ?></p>
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
	<?php }?>
	<?php if(!empty($row["tennhanvien1"]) && !empty($row["tennhanvien2"]) && !empty($row["tennhanvien3"])){ ?>
    <div class="cp_tab_content cp_our_people_section" id="people">
		<div class="row">
			<div class="col-sm-12 cp_header_section">
				<h2>
					Nhân sự tại <?php echo $row["tencongty"] ?>
					<span class="cp_under_line" style="background-color: <?php echo $row["chude"] ?>"></span>
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 cp_container_section">
				<div class="container">
					<div class="cp_our_people_container">
						<div class="row">
							<?php if(!empty($row["tennhanvien1"]) && !empty($row["gioithieunhanvien1"])){ ?>
							<div class="cp_our_people_option_0">
								<div class="cp_our_people_item">
									<div class="col-xs-12 <?php echo empty($row["hinhanhnhanvien1"]) ? "col-sm-12" : "col-sm-4" ?> cp_our_people_item_content">
										<h2><?php echo $row["tennhanvien1"] ?></h2>
										<h3><?php echo $row["chucvunhanvien1"] ?><br></h3>
										<p><?php echo $row["gioithieunhanvien1"] ?></p>
									</div>
									<?php if(!empty($row["hinhanhnhanvien1"])){ ?>
									<div class="col-xs-12 col-sm-8 cp_our_people_item_media">
										<img src="<?php echo $row["hinhanhnhanvien1"] ?>" alt="<?php echo $row["tennhanvien1"] ?>">
									</div>
									<?php }?>
								</div>
							</div>
							<?php }?>
							<?php if(!empty($row["tennhanvien2"]) && !empty($row["gioithieunhanvien2"])){ ?>
							<div class="cp_our_people_option_1">
								<div class="cp_our_people_item">
									<div class="col-xs-12 <?php echo empty($row["hinhanhnhanvien2"]) ? "col-sm-12" : "col-sm-4" ?> cp_our_people_item_content">
										<h2><?php echo $row["tennhanvien2"] ?></h2>
										<h3><?php echo $row["chucvunhanvien2"] ?><br></h3>
										<p><?php echo $row["gioithieunhanvien2"] ?></p>
									</div>
									<?php if(!empty($row["hinhanhnhanvien2"])){ ?>
									<div class="col-xs-12 col-sm-8 cp_our_people_item_media">
										<img src="<?php echo $row["hinhanhnhanvien2"] ?>" alt="<?php echo $row["tennhanvien2"] ?>">
									</div>
									<?php }?>
								</div>
							</div>
							<?php }?>
							<?php if(!empty($row["tennhanvien3"]) && !empty($row["gioithieunhanvien3"])){ ?>
							<div class="cp_our_people_option_0">
								<div class="cp_our_people_item">
									<div class="col-xs-12 <?php echo empty($row["hinhanhnhanvien3"]) ? "col-sm-12" : "col-sm-4" ?> cp_our_people_item_content">
										<h2><?php echo $row["tennhanvien3"] ?></h2>
										<h3><?php echo $row["chucvunhanvien3"] ?><br></h3>
										<p><?php echo $row["gioithieunhanvien3"] ?></p>
									</div>
									<?php if(!empty($row["hinhanhnhanvien3"])){ ?>
									<div class="col-xs-12 col-sm-8 cp_our_people_item_media">
										<img src="<?php echo $row["hinhanhnhanvien3"] ?>" alt="<?php echo $row["tennhanvien3"] ?>">
									</div>
									<?php }?>
								</div>
							</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
	<?php 
		if(
			!empty($row["tieudephucloi1"])
			//!empty($row["tieudephucloi2"]) && 
			//!empty($row["tieudephucloi3"]) && 
			//!empty($row["tieudephucloi4"]) && 
			//!empty($row["tieudephucloi5"]) && 
			//!empty($row["tieudephucloi6"])
		){ 
	?>
		<div class="cp_tab_content cp_our_benefits_section" id="benefits">
			<div class="row">
				<div class="col-sm-12 cp_header_section">
					<h2>
						Phúc lợi
						<span class="cp_under_line" style="background-color: <?php echo $row["chude"] ?>"></span>
					</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 cp_container_section">
					<div class="container">
						<div class="row">
							<div class="cp_our_benefits_container">
							
								<?php 
									for($i=1;$i<=6;$i++){
										if(!empty($row["tieudephucloi".$i]) && !empty($row["noidungphucloi".$i])){ 
								?>
								<div class="col-xs-12 col-sm-4 cp_our_benefit_item ">
									<div class="cp_our_benefit_item_container">
										<div class="cp_benefit_icon">
											<span style="background-color: <?php echo $row["chude"] ?>">
											<?php echo $core_class->getValueFrom("mst_loaiphucloi", "content", "loaiphucloi_id=".$row["loaiphucloi_id".$i]) ?>
											</span>
										</div>
										<div class="cp_benefit_name">
											<h3><?php echo $row["tieudephucloi".$i] ?></h3>
											<span class="under-line" style="background-color: <?php echo $row["chude"] ?>"></span>
										</div>
										<div class="cp_benefit_description">
											<p><?php echo $row["noidungphucloi".$i] ?></p>
										</div>
									</div>
								</div>
								<?php 
										}
									}
								?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div> 
		<?php }?>
    </div>
</section>
<!-- Footer -->    
<footer>
    <div class="yteviec-footer">
        <div class="container">
			<div class="float-table-wrapper">
				<div class="pull-right go-top">
					<span class="fa-stack fa-1x">
						<a href="#top"><i class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i></a>
					</span>
				</div>
			</div>
			<div class="row">
				<?php $core_class->load_module("bottom"); ?>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-12 col-sm-8 col-xs-12">
							<div class="row">
								
								<div class="col-sm-6 col-md-12 home-social">
									<h5>Kết Nối Với Y Tế Việc</h5>
									<a href="<?php echo $_APP['config']['contact']['yahoo']['yahoo1'] ?>" class="blog" target="_blank" title="yteviec Blog"></a>
									<a href="<?php echo $_APP['config']['contact']['yahoo']['yahoo2'] ?>" class="linkedin" target="_blank" title="LinkedIn"></a>
									<a href="<?php echo $_APP['config']['contact']['yahoo']['yahoo3'] ?>" class="facebook" target="_blank" title="Facebook"></a>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="container">
			<hr class="hidden-sm hidden-xs"/>
			<div class="copyright">
				<p class="text-muted text-center">Copyright © <?php echo $_APP['config']['contact']['company_name'] ?>
					<br>
					Địa Chỉ: <?php echo $_APP['config']['contact']['address']['address1'] ?>
				</p>
			</div>
		</div>
    </div>
	<div class="modal fade global__sign-in-modal" id="Login_modal" data-current-url="" tabindex="-1" role="dialog">
     <div class="modal-dialog md_login" role="document">
        <div class="modal-content step-1">
            <div class="modal-body">
				<div class="step-1 animated fadeIn">
					<button type="button" class="close" >
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="sitemap-header text-primary">ĐĂNG NHẬP</h3>
				</div>
				<div class="bg_white p_15 r_corners m_bottom_20">
					<div class="f_none" style="margin:0 auto;">
						<form autocomplete="off" class="awe-check" name="phpFormLogin" method="post" id="phpFormLogin">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="loginemail" id="loginemail" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Mật khẩu</label>
										<input maxlength="50" type="password" name="loginpassword" id="loginpassword" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<!--<div class="col-md-12 col-xs-12 text-right">
									<a class="inline m-t-sm forgot-password clickable" onClick="event.preventDefault(); globalForgotPasswordModal.showModal();">Quên mật khẩu?</a>
								</div>-->
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<button type="button" class="career_login btn btn-primary full-width btn-lg">
											<span>Đăng nhập</span>
										</button>
									</div>
								</div>
							</div>
						</form> 
					</div>
				
					<div class="">
						<p class="text-center m-b-none sign-in">&nbsp;</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" id="currentlink" value="<?php echo $core_class->getFullLink(); ?>">
</footer> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="plugins/sweetalert/sweet-alert.js"></script>
<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/plugins.js"></script>
<script src="<?php echo $index.$template_folder; ?>/js/vendor.js"></script>
<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/jquery.knob.min.js"></script>
<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/starrr.js"></script>
<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/like_unlike.js"></script>
<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/jquery-simple-mobilemenu.js"></script>
<script>
   var $s1input = $('#case1');
   var $s2input = $('#case2');
   var $s3input = $('#case3');
   var $s4input = $('#case4');
   var $OverViewinput = $('#caseOverView');
   // case OverView
    $('#starOverView').starrr({
      max: 5,
      rating: $OverViewinput.val(),
	  readOnly:false,
      change: function(e, value){
		  $OverViewinput.val(value).trigger('input');
		  $.ajax({
			url: "raitingUrl",
			type: "POST",
			dataType: "JSON",
	   		async: true,
			data: {	
				act : "raitingOverView",
				id_company:<?php echo $_GET["id"] ?>,
			    value_rating:value
			},
			success: function(jsonRS){
				if(jsonRS['IsError'] == 1)
				{
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
					})
					  $('.your-choice-was_OverView').show();
						$('.choiceOverView').text(value);
						$('#caseOverView').val(value);
				       $(".choiceOverView").text(jsonRS['Tongquan']);
				       $(".total_overview").text(jsonRS['tongtrungbinh']);
					  
				}else if(jsonRS['IsError'] == 2)
				{
					// Login OverView
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
				}, function(){
				  //window.location.href = "//yteviec.com";
				  $('#Login_modal').modal('show');
				   $('.close').on('click', function () {
						$('#Login_modal').modal('hide');
				})
				$(".career_login").click(function(){
					var frm = $(this).parents("form").first().attr("id");
					var email = $("#" + frm + " input[name=loginemail]").val();
					var password = $("#" + frm + " input[name=loginpassword]").val();
					if(password.length < 6 || password.length > 50){
						swal({
							title: "Lỗi",
							text: "Mật khẩu có độ dài từ 6 đến 50 ký tự",
							type: "warning"
						})
						return false;
					}
					$.ajax({
						url: "login",
						type: "POST",
						data: {do: "login", email: email, password: password},
						success: function(rs){
							if(rs == 1){
								swal({
									title: "",
									text: "Đăng nhập thành công",
									type: "success"
								}, function (){
									window.location = $("#currentlink").val();
								})
										}else{
											swal({
												title: "",
												text: "Địa chỉ email hoặc mật khẩu không đúng",
												type: "warning"
											})
										}
									}
								})
							})
					});
					
				}else
				{
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
					})
				}
			}
		})
      }
    });
   // case 1
    $('#star1').starrr({
      max: 5,
      rating: $s1input.val(),
	  readOnly:false,
      change: function(e, value){
          $s2input.val(value).trigger('input');
		  $.ajax({
			url: "raitingUrl",
			type: "POST",
			dataType: "JSON",
	   		async: true,
			data: {	
				act : "raitingStar",
				id_company:<?php echo $_GET["id"] ?>,
				case_mode: "Case_1",
			    value_rating:value
			},
			success: function(jsonRS){
				if(jsonRS['IsError'] == 1)
				{
						$('.your-choice-was1').show();
						$('.choice1').text(value);
						$('#case1').val(value);
						$('.class_label_1').text(jsonRS['labelName']);
						$(".total_1").text(jsonRS['tongtrungbinh']);
				}else if(jsonRS['IsError'] == 2)
				{
					// Login OverView
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
			}, function(){
				  //window.location.href = "//yteviec.com";
				  $('#Login_modal').modal('show');
				   $('.close').on('click', function () {
						$('#Login_modal').modal('hide');
				})
				$(".career_login").click(function(){
					var frm = $(this).parents("form").first().attr("id");
					var email = $("#" + frm + " input[name=loginemail]").val();
					var password = $("#" + frm + " input[name=loginpassword]").val();
					if(password.length < 6 || password.length > 50){
						swal({
							title: "Lỗi",
							text: "Mật khẩu có độ dài từ 6 đến 50 ký tự",
							type: "warning"
						})
						return false;
					}
					$.ajax({
						url: "login",
						type: "POST",
						data: {do: "login", email: email, password: password},
						success: function(rs){
							if(rs == 1){
								swal({
									title: "",
									text: "Đăng nhập thành công",
									type: "success"
								}, function (){
									window.location = $("#currentlink").val();
								})
										}else{
											swal({
												title: "",
												text: "Địa chỉ email hoặc mật khẩu không đúng",
												type: "warning"
											})
										}
									}
								})
							})
					});
					
				}else
				{
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
					})
				}
			}
		})
      }
    });
	// case 2
	 $('#star2').starrr({
      max: 5,
      rating: $s2input.val(),
	  readOnly:false,
      change: function(e, value){
        $s2input.val(value).trigger('input');
		   $.ajax({
			url: "raitingUrl",
			type: "POST",
			dataType: "JSON",
	   		async: true,
			data: {	
				act : "raitingStar",
				id_company:<?php echo $_GET["id"] ?>,
				case_mode: "Case_2",
			    value_rating:value
			},
			success: function(jsonRS){
				if(jsonRS['IsError'] == 1)
				{
					
						$('.your-choice-was2').show();
						$('.choice2').text(value);
						$('#case2').val(value);
						$('.class_label_2').text(jsonRS['labelName']);
						$(".total_2").text(jsonRS['tongtrungbinh']);
				}else if(jsonRS['IsError'] == 2)
				{
					// Login OverView
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
			}, function(){
				  //window.location.href = "//yteviec.com";
				  $('#Login_modal').modal('show');
				   $('.close').on('click', function () {
						$('#Login_modal').modal('hide');
				})
				$(".career_login").click(function(){
					var frm = $(this).parents("form").first().attr("id");
					var email = $("#" + frm + " input[name=loginemail]").val();
					var password = $("#" + frm + " input[name=loginpassword]").val();
					if(password.length < 6 || password.length > 50){
						swal({
							title: "Lỗi",
							text: "Mật khẩu có độ dài từ 6 đến 50 ký tự",
							type: "warning"
						})
						return false;
					}
					$.ajax({
						url: "login",
						type: "POST",
						data: {do: "login", email: email, password: password},
						success: function(rs){
							if(rs == 1){
								swal({
									title: "",
									text: "Đăng nhập thành công",
									type: "success"
								}, function (){
									window.location = $("#currentlink").val();
								})
										}else{
											swal({
												title: "",
												text: "Địa chỉ email hoặc mật khẩu không đúng",
												type: "warning"
											})
										}
									}
								})
							})
					});
					
				}else
				{
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
					})
				}
			}
		})
      }
    });
	// case 3 
	 $('#star3').starrr({
      max: 5,
      rating: $s3input.val(),
	  readOnly:false,
      change: function(e, value){
        $s2input.val(value).trigger('input');
		  $.ajax({
			url: "raitingUrl",
			type: "POST",
			dataType: "JSON",
	   		async: true,
			data: {	
				act : "raitingStar",
				id_company:<?php echo $_GET["id"] ?>,
				case_mode: "Case_3",
			    value_rating:value
			},
			success: function(jsonRS){
				if(jsonRS['IsError'] == 1)
				{
					
						$('.your-choice-was3').show();
						$('.choice3').text(value);
						$('#case3').val(value);
						$('.class_label_3').text(jsonRS['labelName']);
						$(".total_3").text(jsonRS['tongtrungbinh']);
				}else if(jsonRS['IsError'] == 2)
				{
					// Login OverView
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
			}, function(){
				  //window.location.href = "//yteviec.com";
				  $('#Login_modal').modal('show');
				   $('.close').on('click', function () {
						$('#Login_modal').modal('hide');
				})
				$(".career_login").click(function(){
					var frm = $(this).parents("form").first().attr("id");
					var email = $("#" + frm + " input[name=loginemail]").val();
					var password = $("#" + frm + " input[name=loginpassword]").val();
					if(password.length < 6 || password.length > 50){
						swal({
							title: "Lỗi",
							text: "Mật khẩu có độ dài từ 6 đến 50 ký tự",
							type: "warning"
						})
						return false;
					}
					$.ajax({
						url: "login",
						type: "POST",
						data: {do: "login", email: email, password: password},
						success: function(rs){
							if(rs == 1){
								swal({
									title: "",
									text: "Đăng nhập thành công",
									type: "success"
								}, function (){
									window.location = $("#currentlink").val();
								})
										}else{
											swal({
												title: "",
												text: "Địa chỉ email hoặc mật khẩu không đúng",
												type: "warning"
											})
										}
									}
								})
							})
					});
					
				}else
				{
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
					})
				}
			}
		})
      }
    });
	// case 4
	 $('#star4').starrr({
      max: 5,
      rating: $s4input.val(),
	  readOnly:false,
      change: function(e, value){
        $s2input.val(value).trigger('input');
		  $.ajax({
			url: "raitingUrl",
			type: "POST",
			dataType: "JSON",
	   		async: true,
			data: {	
				act : "raitingStar",
				id_company:<?php echo $_GET["id"] ?>,
				case_mode: "Case_4",
			    value_rating:value
			},
			success: function(jsonRS){
				if(jsonRS['IsError'] == 1)
				{
						$('.your-choice-was4').show();
						$('.choice4').text(value);
						$('#case4').val(value);
						$('.class_label_4').text(jsonRS['labelName']);
						$(".total_4").text(jsonRS['tongtrungbinh']);
				}else if(jsonRS['IsError'] == 2)
				{
					// Login OverView
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
			}, function(){
				  //window.location.href = "//yteviec.com";
				  $('#Login_modal').modal('show');
				   $('.close').on('click', function () {
						$('#Login_modal').modal('hide');
				})
				$(".career_login").click(function(){
					var frm = $(this).parents("form").first().attr("id");
					var email = $("#" + frm + " input[name=loginemail]").val();
					var password = $("#" + frm + " input[name=loginpassword]").val();
					if(password.length < 6 || password.length > 50){
						swal({
							title: "Lỗi",
							text: "Mật khẩu có độ dài từ 6 đến 50 ký tự",
							type: "warning"
						})
						return false;
					}
					$.ajax({
						url: "login",
						type: "POST",
						data: {do: "login", email: email, password: password},
						success: function(rs){
							if(rs == 1){
								swal({
									title: "",
									text: "Đăng nhập thành công",
									type: "success"
								}, function (){
									window.location = $("#currentlink").val();
								})
										}else{
											swal({
												title: "",
												text: "Địa chỉ email hoặc mật khẩu không đúng",
												type: "warning"
											})
										}
									}
								})
							})
					});
					
				}else
				{
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
					})
				}
			}
		})
      }
    });
 </script>
 <script type="text/javascript">
 //#999 load more
	$(document).ready(function(){
		$(document).on('click','.show_more',function(){
			var ID = $(this).attr('id');
			$('.show_more').hide();
			$('.loading').show();
			$.ajax({
				url: "load_more",
				type: "POST",
				async: true,
				data: {
					act : "load_more",
					id_company:<?php echo $_GET["id"] ?>,
					id:ID,
				  },
				success:function(html){
						$('#show_more_main'+ID).remove();
					   $('.jobs_listing_block').append(html);
				}
			});
		});
	});
</script>
<script>
// #1 Login
$(document).ready(function(){
	 $('#follow_').click(function() {
			swal({
			  title: "",
			  text: "Bạn chưa đăng nhập",
			  type: "info",
			}, function(){
				  //window.location.href = "//yteviec.com";
				  $('#Login_modal').modal('show');
				   $('.close').on('click', function () {
						$('#Login_modal').modal('hide');
				})
				$(".career_login").click(function(){
					var frm = $(this).parents("form").first().attr("id");
					var email = $("#" + frm + " input[name=loginemail]").val();
					var password = $("#" + frm + " input[name=loginpassword]").val();
					if(password.length < 6 || password.length > 50){
						swal({
							title: "Lỗi",
							text: "Mật khẩu có độ dài từ 6 đến 50 ký tự",
							type: "warning"
						})
						return false;
					}
					$.ajax({
						url: "login",
						type: "POST",
						data: {do: "login", email: email, password: password},
						success: function(rs){
							if(rs == 1){
								swal({
									title: "",
									text: "Đăng nhập thành công",
									type: "success"
								}, function (){
									window.location = $("#currentlink").val();
								})
										}else{
											swal({
												title: "",
												text: "Địa chỉ email hoặc mật khẩu không đúng",
												type: "warning"
											})
										}
									}
								})
							})
					});
    });
    $('#follow_add').click(function() {
		var btn = $(this);
		$.ajax({
			url: "follow",
			type: "POST",
			dataType: "JSON",
	   		async: true,
			data: {
				act : "followInsert",
			    id_company:<?php echo $_GET["id"] ?>
			},
			success: function(jsonRS){
				// console.log(result);
				swal({
					title:"",
					text: jsonRS['msg'],
					type: "info"
				})
				 btn.attr('id','follow_remove');
				 $(".countfl").text(jsonRS['totalFL']);
				 $("#follow_text").text(jsonRS['lbname']);
				//$(".chuyenkhoa").html(result);
			}
		})
    });
	$('#follow_remove').click(function() {
		var btn = $("#follow_remove");
		$.ajax({
			url: "follow",
			type: "POST",
			dataType: "JSON",
	   		async: true,
			data: {
				
				act : "followRemove",
			    id_company:<?php echo $_GET["id"] ?>
				
			},
			success: function(jsonRS){
				//$(".chuyenkhoa").html(result);
				swal({
					title:"",
					text: jsonRS['msg'],
					type: "info"
				})
				 btn.attr('id','follow_add');
				  $(".countfl").text(jsonRS['totalFL']);
				 $("#follow_text").text(jsonRS['lbname']);
			}
		})
    });
 });
</script>
<script>
        $(function($) {

            $(".knob").knob({
                change : function (value) {
                    //console.log("change : " + value);
                },
                release : function (value) {
                    //console.log(this.$.attr('value'));
                    console.log("release : " + value);
                },
                cancel : function () {
                    console.log("cancel : ", this);
                },
                /*format : function (value) {
                 return value + '%';
                 },*/
                draw : function () {

                    // "tron" case
                    if(this.$.data('skin') == 'tron') {

                        this.cursorExt = 0.3;

                        var a = this.arc(this.cv)  // Arc
                                , pa                   // Previous arc
                                , r = 1;

                        this.g.lineWidth = this.lineWidth;

                        if (this.o.displayPrevious) {
                            pa = this.arc(this.v);
                            this.g.beginPath();
                            this.g.strokeStyle = this.pColor;
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                            this.g.stroke();
                        }

                        this.g.beginPath();
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                        this.g.stroke();

                        this.g.lineWidth = 2;
                        this.g.beginPath();
                        this.g.strokeStyle = this.o.fgColor;
                        this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                        this.g.stroke();

                        return false;
                    }
                }
            });

            // Example of infinite knob, iPod click wheel
            var v, up=0,down=0,i=0
                    ,$idir = $("div.idir")
                    ,$ival = $("div.ival")
                    ,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
                    ,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
            $("input.infinite").knob(
                    {
                        min : 0
                        , max : 20
                        , stopper : false
                        , change : function () {
                        if(v > this.cv){
                            if(up){
                                decr();
                                up=0;
                            }else{up=1;down=0;}
                        } else {
                            if(v < this.cv){
                                if(down){
                                    incr();
                                    down=0;
                                }else{down=1;up=0;}
                            }
                        }
                        v = this.cv;
                    }
                    });
        });
    </script>