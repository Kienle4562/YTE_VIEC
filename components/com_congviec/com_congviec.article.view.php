<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

	$lang_text = $core_class->load_module_language('com_content_article_view', $GLOBALS['LANG']);

	include_once('com_congviec.article.models.php');
	
	if (count($GLOBALS['LANG_LIST']) > 1)
	{
		$__home = $GLOBALS['LANG'] . $GLOBALS['EXT'];
		$__append = $GLOBALS['LANG'] . '/';
	}
	else
	{
		$__home = $GLOBALS['INDEX'];
		$__append = '';
	}
	$myprocess =  new process_article();
	$result = $myprocess->get_article(intval($_GET["id"]));
	if ($row = $result->fetch())
	{
		$pathway_text .= "<li class=\"m_right_8 f_xs_none\"><a href=\"$link\" class=\"color_dark d_inline_m\">" . $row['tencongty'] . "</a></li>";
        $pathway_text .= "<li class=\"m_right_8 f_xs_none\"><i class=\"icon-angle-right d_inline_m color_dark fs_small\"></i><a href=\"$link\" class=\"color_dark d_inline_m m_left_10\">" . $row['tencongviec'] . "</a></li>";
		$meta_title = $row['tencongviec'];
		$meta_url = "https://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		// Update lượt xem
		$core_class->updateColumnInTable("trn_congviec", "luotxem = luotxem + 1", "WHERE congviec_id = ".intval($_GET["id"]));
?>
<style type="text/css">#st-1 {
  font-family: "Helvetica Neue", Verdana, Helvetica, Arial, sans-serif;;
  direction: ltr;
  display: block;
  opacity: 1;
  text-align: center;
  z-index: 94034;
}
</style>

<link rel="stylesheet" type="text/css" href="<?php echo $index.$template_folder; ?>/css/theme.css">
<div class="page-job-detail page-job-detail_no-background">
	<style>
	.float-table-wrapper, .onesignal-bell-container{display:none !important}
	</style>
	<style>
		.page-background{
			background-image:url();
		}
		@media (max-width:991px){
			.page-job-detail__floating-header .box{
				background-image:url();
			}
		}
	</style>
	<div class="page-background">
		<div class="background-overlay"></div>
	</div>
	<div class="page-job-detail__floating-header">
		<div class="container box">
			<div class="background-overlay visible-xs visible-sm"></div>
			<div class="row">
				<!-- Employer Logo -->
				<div class="col-md-2 col-logo hidden-sm hidden-xs">
					<span class="center-block text-center logo-wrapper" style="height:80px;">
						<a class="track-event clickable" data-evt-type="view-other-jobs">
							<?php
								$srcHinhanh = "/images/logo.png";
								if(!empty($row["hinhanh"]) && strpos($row["hinhanh"], "noimage") == false){
									$srcHinhanh = $row["hinhanh"];
								}
							?>
							<img src="<?php echo $srcHinhanh;?>" alt="<?php echo $row['tencongty'];?> - <?php echo $row['diadiemlamviec'];?> recruitment" class="logo img-responsive" style="max-height: -webkit-fill-available;">
						</a>
					</span>
				</div>
				<!-- Job Header Info -->
				<div class="col-md-10 col-xs-12 col-info">
					<div class="row">
						<div class="col-lg-8 col-md-7 col-xs-12 col-content">
							<div class="job-header-info">
								<h2 class="job-title">
									<?php echo $row['tencongviec'];?>
								</h2>
								<div class="row hidden-xs hidden-sm">
									<div class="col-sm-12 company-name">
										<a href="cong-viec-y-te-o-<?php $core_class->_removesigns($row["diadiemlamviec"]) ?>-<?php echo $row["tinhthanh_id"] ?>-jobsin.html" class="track-event" data-evt-type="view-other-jobs">
											<?php echo $row['tencongty'];?>
										</a>
										<p>Địa điểm làm việc :  <?php echo $row['diadiemlamviec'];?></p>
									</div>
								</div>
							</div>
						</div>
						<!-- Hide this in mobile-->
						<div class="col-lg-4 col-md-5 hidden-sm hidden-xs col-btn">
							<div class="text-right">
								<button type="button" class="btn btn-primary btn-apply track-event" data-evt-type="apply">
									Ứng tuyển
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page-foreground container">
		<!-- Block: SHARE THIS -->
		<!-- <div class="page-job-detail__share">
			<div class="share-box inline">
				<div class="share-widget">
					<div class="m_bottom_20">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						
						<div class="clear">
							<div class="fb-send" data-href="<?= "http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"></div>
							<div class="fb-like" data-href="<?= "http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<g:plusone size='medium' ></g:plusone>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!--/ Block: SHARE THIS -->
		<!-- Section: HEADER -->
		<section class="page-job-detail__header">
			<div class="box box-md">
				<div class="absolute-right premium-popover-trigger"></div>
				<div class="row">
					<!-- Employer Logo -->
					<div class="col-md-2 col-logo">
						<span class="center-block text-center logo-wrapper" style="height:80px;">
							<a class="track-event clickable" data-evt-type="view-other-jobs">
								<img src="<?php echo $srcHinhanh;?>" alt="<?php echo $row['tencongty'];?> - <?php echo $row['diadiemlamviec'];?> recruitment" class="logo img-responsive" style = "max-height: -webkit-fill-available;;">
								</a>
							</span>
						</div>
						<!-- Job Header Info -->
						<div class="col-md-10 col-content-wrapper">
							<div class="row">
								<div class="col-lg-10 col-md-9 col-content">
									<div class="job-header-info">
										<h1 class="job-title"><?php echo $row['tencongviec'];?></h1>
										<div class="row">
											<div class="col-sm-12 company-name">
												<a 
													 href="<?php echo $core_class->_removesigns($row["tencongty"])."-".$row["congty_id"]."-client.html"; ?>" 

													 class="track-event" data-evt-type="view-other-jobs">

                           <?php echo $row['tencongty'];?>
                        </a>
												
												<p class="company-location">
													Địa điểm làm việc : <?php echo $row["diadiemlamviec"] ?>
												</p>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<span class="salary">
													<?php  
														
														$mucluong = "Thỏa thuận";
														$loaitien= "";
														if($row['loaitien_id'] == 2)
														{
															$loaitien = " USD";
														}else{
															$loaitien = " VNĐ";
														}
														if(!empty($row['mucluongtoithieu']) && empty($row['mucluongtoida'])){
															//$mucluong = number_format($row['mucluongtoithieu'], 0);
															$mucluong =  number_format($row['mucluongtoithieu'], 0).$loaitien;
														}
														else if(!empty($row['mucluongtoithieu']) && !empty($row['mucluongtoida'])){
															$mucluong = "Từ ". number_format($row['mucluongtoithieu'], 0).$loaitien;
															$mucluong .= " Đến ".number_format($row['mucluongtoida'], 0).$loaitien;
														}
														else if(empty($row['mucluongtoithieu']) && !empty($row['mucluongtoida'])){
															$mucluong = "Cao nhất ".number_format($row['mucluongtoida'], 0). $loaitien;
														}
														echo '<a class="clickable">'.$mucluong.'</a>';
													?>
												</span>
												<span class="view gray-light">
                           
                            <?php echo $row["luotxem"] ?> lượt xem

                        </span>
												<?php if(!empty($row["ngayhethan"])){ ?>
												<span class="gray-light m-l-xs m-r-xs">-</span>
												<span class="expiry gray-light">
														Hết hạn ngày: 
														<?php 
															$currentDate = strtotime("now");
															$ngayhethan = strtotime($row["ngayhethan"]);
															$compareDate = $ngayhethan - $currentDate;
															if($compareDate < 0){
																echo "<font color=red>".date("d/m/Y", strtotime($row["ngayhethan"]))." (Đã hết hạn)</font>";
															}else{
																echo date("d/m/Y", strtotime($row["ngayhethan"])); 
															}
															
														?>
												</span>
												<?php }?>
												<?php if(!empty($row["hyperlink"])){ ?>
												<span class="salary">
													<a href="<?php echo $row["hyperlink"]; ?>" class="clickable">Mẫu hồ sơ xin việc</a>
												</span>
												<?php }?>
											</div>
										</div>
									</div>
								</div>
								<!-- Hide this in mobile-->
								<!-- TODO: Use another class for case "not authenticated" -->
								<div class="col-lg-2 col-md-3 col-btn col-btn_saved">
									<div class="row">
										<input type="hidden" id="tinhthanh" value="<?php echo $row["tinhthanh_id"] ?>">
										<input type="hidden" id="congty" value="<?php echo $row["congty_id"] ?>">
										<?php if(!empty($row['email']) && $row['btn_ungtuyen'] == 1) { ?>
										<div class="col-xs-6 col-xs-push-6 col-md-12 col-md-push-0" style="line-height:40px">
											<?php
											
												$event = 'globalLogInModal.showModal();';
												if(isset($_SESSION["career"]["email"])){
													$event = 'initApplyForm();';
													$whereCount = "WHERE career_id = ".$_SESSION["career"]["career_id"];
													$whereCount .= " AND congviec_id = ".intval($_GET["id"]);
													$applyed = $core_class->countColumnInTable("trn_ungtuyen", "career_id", $whereCount);
													if($applyed > 0){
											?>
											<button type="button" class="btn btn-primary btn-block btn-apply track-event" disabled>

                          Đã nộp đơn

                      </button>
											<?php 

											}else{

											?>
												<button 
												  style="border-radius: 6px;"
													type="button" 
													class="btn btn-primary btn-block btn-apply track-event" 
													data-evt-type="apply" 
													onclick="<?php echo $event ?>">
													Ứng tuyển
												</button>
												<a href="view-cv.html" class="btn btn-success btn-block" style="border-radius: 6px;">Tạo CV ứng tuyển </a>
											<?php

													}

												}

												else

												{

											?>
												<button
													style="border-radius: 6px;" 
													type="button" 
													class="btn btn-primary btn-block btn-apply track-event" 
													data-evt-type="apply" 
													onclick="<?php echo $event ?>">
                          Ứng tuyển
	                      </button>
	                      <a href="view-cv.html" class="btn btn-success btn-block" style="border-radius: 6px;">Tạo CV ứng tuyển </a>
											<?php 
												}
											?>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--/ Section: HEADER -->
			<!-- Section: DETAIL -->
			<section class="page-job-detail__detail">
				<!-- Tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active animated fadeIn">
						<a href="#job-info" data-toggle="tab">
							<span class="hidden-sm hidden-xs">Thông tin công việc</span>
							<span class="visible-sm visible-xs">Công việc</span>
						</a>
					</li>
					<li class="animated fadeIn" role="presentation">
						<a href="#company-info" class="track-event" data-evt-type="view-tab-cominfo" role="tab" data-toggle="tab">
							<span class="hidden-sm hidden-xs">Thông tin công ty</span>
							<span class="visible-sm visible-xs">Công ty</span>
						</a>
					</li>
					<li class="animated fadeIn" role="presentation">
						<a href="#company-job" role="tab" data-toggle="tab">
							<span class="hidden-sm hidden-xs">Công việc khác từ công ty</span>
							<span class="visible-sm visible-xs">Việc</span>
						</a>
					</li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane tab-pane-job-info active box box-md animated fadeIn" id="job-info">
						<div class="row">
							<div class="col-md-4 col-sm-12 tab-sidebar">
								<div class="mobile-box">
									<!-- Box Summary -->
									<div class="box-summary link-list">
										
										<div class="row summary-item">
											<div class="col-xs-2 summary-icon">
												<i class="fa fa-calendar articles-icon-fix" aria-hidden="true"></i>
											</div>
											<div class="col-xs-10 summary-content">
												<span class="content-label">Ngày đăng</span>
												<span class="content">
													<?php echo date("d/m/Y", strtotime($row["ngaydang"])); ?>
                        </span>
											</div>
										</div>
										<?php
											if(!empty($row['soluongcantuyen'])){
										?>
										<div class="row summary-item">
											<div class="col-xs-2 summary-icon">
												<i class="fa fa-search articles-icon-fix" aria-hidden="true"></i>
											</div>
											<div class="col-xs-10 summary-content">
												<span class="content-label">Số lượng cần tuyển</span>
												<span class="content">
													<?php echo $row['soluongcantuyen'] ?>
                        </span>
											</div>
										</div>
										<?php }?>
										<div class="row summary-item">
											<div class="col-xs-2 summary-icon">
												<i class="fa fa-stethoscope articles-icon-fix " aria-hidden="true"></i>
											</div>
											<div class="col-xs-10 summary-content">
												<span class="content-label">Nghành nghề</span>
												<span class="content">
													<?php echo $row['tendanhmuccv']; ?>
                        </span>
											</div>
										</div>
										<?php if(!empty($row['chuyenkhoa_name'])) { ?>
										<div class="row summary-item">
											<div class="col-xs-2 summary-icon">
												<span class="icon icon-date-posted"></span>
											</div>
											<div class="col-xs-10 summary-content">
												<span class="content-label">
												<?php if($row['danhmuccv_id'] == 1) { ?>
													Chuyên khoa
												<?php }else
												{?>
													Chuyên ngành	
												<?php } ?>
												</span>
												<span class="content">
													<?php echo $row['chuyenkhoa_name']; ?>
                        </span>
											</div>
										</div>
										<?php } ?>
										<?php
											if(!empty($row['tenloaihinhcongviec'])){
										?>
										<div class="row summary-item">
											<div class="col-xs-2 summary-icon">
												<i class="fa fa-th-list articles-icon-fix" aria-hidden="true"></i>
											</div>
											<div class="col-xs-10 summary-content">
												<span class="content-label">Loại hình công việc</span>
												<span class="content">
													<?php echo $row['tenloaihinhcongviec'] ?>
												</span>
											</div>
										</div>
										<?php }?>
										<?php if(!empty($row['loaihinhcongviec_id'])){ ?>
										<!--div class="row summary-item">
                                            <div class="col-xs-2 summary-icon">
                                                <span class="icon icon-category-box"></span>
                                            </div>
                                            <div class="col-xs-10 summary-content">
                                                <span class="content-label">Hình thức</span>
                                                <span class="content">
													<?php
													
														echo $core_class->showDataWithArray($row["loaihinhcongviec_id"], "mst_loaihinhcongviec") 
													?>
												</span>
                                            </div>
                                        </div>-->
										<?php }?>
										<?php if(!empty($row['yeucauhoso_id'])){ ?>
										<div class="row summary-item">
											<div class="col-xs-2 summary-icon">
												<i class="fa fa-language articles-icon-fix" aria-hidden="true"></i>
											</div>
											<div class="col-xs-10 summary-content">
												<span class="content-label">Yêu cầu hồ sơ</span>
												<span class="content">
                        <?php
														
													echo substr($core_class->showDataWithArray($row["yeucauhoso_id"], "mst_yeucauhoso"),0,-1); 

												?>
                        </span>
											</div>
										</div>
										<?php }?>
										<div class="row summary-item">
                        <div class="col-xs-2 summary-icon">
                            <i class="fa fa-cogs articles-icon-fix" aria-hidden="true"></i>
                        </div>
                        <div class="col-xs-10 summary-content">
                            <span class="content-label">Khác</span>
                            <span class="content">
													<?php
														// Giới tính
														if(!empty($row["gioitinh_id"])){
															$where = "gioitinh_id=".$row["gioitinh_id"];
															echo "Giới tính: ".$core_class->getValueFrom("mst_gioitinh", "gioitinh", $where);
															echo "<br>";
														}
														// Tuổi
														if(!empty($row["dotuoi"])){
															echo "Độ tuổi: ".$row["dotuoi"];
															echo "<br>";
														}
														// Kinh nghiệm
														if(!empty($row["kinhnghiem_id"])){
															
															if($row["kinhnghiem_id"] == 2)
															{
																echo "Kinh nghiệm: ".$row['sonamkinhnghiem'];
																
															}else 
															{
																$where = "kinhnghiem_id=".$row["kinhnghiem_id"];
																echo "Kinh nghiệm: ".$core_class->getValueFrom("mst_kinhnghiem", "tenkinhnghiem", $where);
															}
															echo "<br>";
														}
														// Cấp bậc
														if(!empty($row["capbac_id"])){
															$where = "capbac_id=".$row["capbac_id"];
															echo "Cấp bậc: ".$core_class->getValueFrom("mst_capbac", "tencapbac", $where);
															echo "<br>";
														}
														// Bằng cấp
														if(!empty($row["bangcap_id"])){
															$where = "bangcap_id=".$row["bangcap_id"];
															echo "Bằng cấp: ".$core_class->getValueFrom("mst_bangcap", "tenbangcap", $where);
															echo "<br>";
														}
													?>
												</span>
                            </div>
                        </div>
									</div>
									<!--/ Box Summary -->
									<!--/ Box Jobs loving -->
									<div  id="loving-jobs" class="visible-lg"></div>
								</div>
							</div>
							<div class="col-md-8  col-sm-12 tab-main-content">

						<?php if(!empty($row['motacongviec'])){ ?>
						<h2 class="articles-title">Mô tả công việc</h2>

						<p class="articles-des-fix"><?php echo str_replace("\n","<br>", $row['motacongviec']);?></p>
						
					<?php }?>
							
								<hr>

								<?php if(!empty($row['chuyenmonyeucau'])){ ?>
									<h2 class="articles-title">Yêu cầu công việc</h2>
									<p class="articles-des-fix"><?php echo str_replace("\n","<br>", $row['chuyenmonyeucau']);?></p>
								<?php }?>

								<hr>

								<?php if(!empty($row['quyenloi'])){ ?>
									<h2 class="articles-title">Quyền lợi</h2>
									<p class="articles-des-fix"><?php echo str_replace("\n","<br>", $row['quyenloi']);?></p>
								<?php }?>

								<hr>
							
								<?php 
									
									if(!empty($row['phucloi_id'])){
										echo "<h2 class='articles-title'>Các Phúc Lợi Dành Cho Bạn</h2>";
										echo '<div class="benefits">';
										echo $core_class->showDataWithArray2($row["phucloi_id"], "|");
										echo '</div>';
									} 
								?>
								<hr>
								<?php if(!empty($row['yeucauhoso'])){ ?>
									<h2 class="articles-title">Yêu cầu hồ sơ</h2>
									<p class="articles-des-fix"><?php echo str_replace("\n","<br>", $row['yeucauhoso']);?></p>
								<?php }?>

								<?php if(!empty($row['nophoso'])){ ?>
									<h2>Nộp hồ sơ</h2>
									<p><?php echo str_replace("\n","<br>", $row['nophoso']);?></p>
								<?php }?>

							</div>
						</div>

						<!-- CÔNG VIỆC KHÁC -->


<!-- 						<section class="other-job" id="jobs">

							<div class="row-3">

								<div class="col-md-12 col-sm-12">

									<div class="job-card-other">			

										<div class="job-name-other">

											<img class="job-profile-other" src="/images/logo.png"> 

											<div class="job-detail-other">

												<h4>AAAAAAAAAA</h4>
												<h3>SAdasdsadasdasda</h3>
												
												<button type="button" class="btn btn-primary" data-evt-type="apply">
													Ứng tuyển
												</button>

											</div>

										</div>

									<div class="job-label-other">

										<a class="lable-other">HTML</a>			

									</div>

									<div class="job-posted-other">
										
									</div>

									</div>

								</div>

							</div>

						


							<button class="job-more-other">Xem thêm</button>

						</section> -->

						<!--END CONG VIEC KHAC-->




					</div>

					<div role="tabpanel" class="tab-pane tab-pane-company-info box box-md animated fadeIn" id="company-info">
						<div class="row">
							<div class="col-md-8 col-sm-12 tab-main-content">
								<?php
									$i = 0;
									if(
										!empty($row['hinhanhcongty1']) || 
										!empty($row['hinhanhcongty2']) || 
										!empty($row['hinhanhcongty3'])
									){
								?>
								<div class="mobile-box m_bottom_20">
									<div id="myCarousel" class="carousel slide" data-ride="carousel">
										<!-- Indicators -->
										
										<ol class="carousel-indicators">
											<?php if(!empty($row['hinhanhcongty1'])){ ?>
												<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
											<?php }?>
											<?php if(!empty($row['hinhanhcongty2'])){ ?>
												<li data-target="#myCarousel" data-slide-to="1"></li>
											<?php }?>
											<?php if(!empty($row['hinhanhcongty3'])){ ?>
												<li data-target="#myCarousel" data-slide-to="2"></li>
											<?php }?>
										</ol>


										<!-- Wrapper for slides -->
										<div class="carousel-inner">
											<?php if(!empty($row['hinhanhcongty1'])){ ?>
												<div class="item active">
													<img src="<?php echo $row['hinhanhcongty1'] ?>" alt="<?php echo $row['tencongviec']."-".$row['tencongty'];?>">
												</div>
											<?php }?>

											<?php if(!empty($row['hinhanhcongty2'])){ ?>
												<div class="item">
													<img src="<?php echo $row['hinhanhcongty2'] ?>" alt="<?php echo $row['tencongviec']."-".$row['tencongty'];?>">
												</div>
											<?php }?>

											<?php if(!empty($row['hinhanhcongty3'])){ ?>
												<div class="item">
													<img src="<?php echo $row['hinhanhcongty3'] ?>" alt="<?php echo $row['tencongviec']."-".$row['tencongty'];?>">
												</div>
											<?php }?>
										</div>
									</div>
								</div>
								<?php } ?>

								<div class="mobile-box">
									<div class="company-info">
										<?php if(!empty($row['gioithieungan'])){ ?>
										<p><?php echo str_replace("\n","<br>", $row['gioithieungan']);?></p>
										<?php }else{ ?>
										<p>Không có mô tả nào</p>
										<?php }?>
									</div>
								</div>
							</div>
							<div class="col-md-4 col-sm-12 tab-sidebar">
								<div class="mobile-box">
									<!-- Box Summary -->
									<div class="box-summary">
										<div class="row summary-item">
											<div class="col-xs-2 summary-icon">
												<i class="fa fa-users articles-icon-fix" aria-hidden="true"></i>
											</div>
											<div class="col-xs-10 summary-content">
												<span class="content-label">Quy mô công ty</span>
												<span class="content"><?php echo $row['quymo'];?></span>
											</div>
										</div>
										<div class="row summary-item">
											<div class="col-xs-2 summary-icon">
												<i class="fa fa-check-circle articles-icon-fix" aria-hidden="true"></i>
											</div>
											<div class="col-xs-10 summary-content">
												<span class="content-label">Loại hình hoạt động</span>
												<span class="content"><?php echo $row['tenloaihinhhoatdong'];?></span>
											</div>
										</div>
										<div class="row summary-item">
											<div class="col-xs-2 summary-icon">
												<i class="fa fa-user-circle-o articles-icon-fix" aria-hidden="true"></i>
											</div>
											<div class="col-xs-10 summary-content">
												<span class="content-label">Người liên hệ</span>
												<span class="content"><?php echo $row['nguoilienhe'];?></span>
											</div>
										</div>
										<div class="row summary-item">
											<div class="col-xs-2 summary-icon">
												<i class="fa fa-map-marker articles-icon-fix" aria-hidden="true"></i>
											</div>
											<div class="col-xs-10 summary-content">
												<span class="content-label">Địa chỉ công ty</span>
												<span class="content"><?php echo $row['diachicongty'];?></span>
											</div>
										</div>
									</div>
									<!--/ Box Summary -->
								</div>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane tab-pane-jobs box box-md animated fadeIn" id="company-job" hidden="">
						<div class="mobile-box">
							<div id="job-list-wrapper" class="animated fadeIn">
								<!-- Job List -->
								<div class="job-list list-border">
									<?php
										$resultOrder = $myprocess->get_other_job(intval($_GET["id"]), $row["congty_id"]);
										if($resultOrder->rowCount()>0){
											while($rowOrder = $resultOrder->fetch()){
												$link = $core_class->_removesigns($rowOrder["tencongviec"])."-".$rowOrder["congviec_id"]."-cv.html";
									?>
									<div class="job list-border__item">
										<a target="_blank" class="job-title" href="<?php echo $link ?>">
											<?php echo $rowOrder["tencongviec"]; ?>
										</a>
										<div class="job-info text-light">
											<span class="salary text-primary">
												<?php
													$mucluong = "Thỏa thuận";
													if(!empty($rowOrder['mucluongtoithieu']) && empty($rowOrder['mucluongtoida'])){
														$mucluong = $rowOrder['mucluongtoithieu'];
													}
													else if(!empty($rowOrder['mucluongtoithieu']) && !empty($rowOrder['mucluongtoida'])){
														$mucluong = "Từ ".$rowOrder['mucluongtoithieu'];
														$mucluong .= " Đến ".$rowOrder['mucluongtoida'];
													}
													else if(empty($rowOrder['mucluongtoithieu']) && !empty($rowOrder['mucluongtoida'])){
														$mucluong = "Cao nhất ".$rowOrder['mucluongtoida'];
													}
													echo '<a class="clickable">'.$mucluong.'</a>';
												?>
												
												
											</span>
											<span class="separator">|</span>
											<span class="location"><?php echo $rowOrder["diadiemlamviec"]; ?></span>
											<span class="separator">|</span>
											<span class="date-posted"><?php echo $core_class->time_ago(strtotime($rowOrder["ngaydang"])); ?></span>
										</div>
									</div>
									<?php 
											}
										}else{
									?>
									<div class="job list-border__item">
										<p>Không có công việc nào khác từ công ty này</p>
									</div>
									<?php }?>
								</div>
								<!--/ Job List -->
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
</div>
<?php if(isset($_SESSION["career"]["email"])){ ?>
<div class="modal fade apply-form-modal" id="ApplyForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form class="form-horizontal" id="applyJobForm" enctype="multipart/form-data" method="post" action="">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true" tabindex="8">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Bạn đang ứng tuyển cho vị trí
						<strong><?php echo $row['tencongviec'];?></strong>
					</h4>
				</div>
				<div class="modal-body">
					<div class="resume-header">
						<div class="row">
							<!-- Resume Avatar -->
							<div class="col-sm-3 col-xs-4 user-pic">
								<div class="avatar img-circle text-center">
									<div class="avatar-sample">
										<i class="fa fa-3x fa-user"></i>
									</div>
								</div>
							</div>
							<div class="col-sm-9 col-xs-8">
								<!-- Full Name -->
								<h4 class="m-t-md">
									<span><?php echo $_SESSION['career']['fullname'];?></span>
								</h4>
								<!-- Email Address -->
								<div class="m-t-xs app-title">
									<div class="form-control-static"><?php echo $_SESSION['career']['email'];?></div>
								</div>
							</div>
						</div>
					</div>
					<div id="resume" class="resume-body">
						<!-- Phone Number -->
						<div class="form-group m-t-sm">
							<label for="app-resume" class="col-sm-3 col-xs-12 control-label">Số điện thoại</label>
							<div class="col-sm-8 col-xs-12">
								<div class="form-control-static phone-number">
									<input type="text" class="form-control" name="sodienthoai" id="sodienthoai" value=""/>
								</div>
							</div>
						</div>
						<!-- <div class="form-group m-t-sm">
							<label for="app-resume" class="col-sm-3 col-xs-12 control-label">Giới thiệu bản thân</label>
							<div class="col-sm-8 col-xs-12">
								<div class="form-control-static phone-number">
									<textarea maxlength="500" class="form-control" name="gioithieungan" id="gioithieungan"></textarea>
								</div>
							</div>
						</div> -->
						<!-- Select Resume Block -->
						<div class="form-group awe-check select-resume">
							<label for="app-resume" class="col-sm-3 col-xs-12 control-label">
								Chọn hồ sơ mới
							</label>
							<div class="col-sm-8 col-xs-12">
								<input type="file" class="form-control" id="hoso"/>
								<input type="hidden" name="hoso">
								<span>Vui lòng chọn tập tin đính kèm với định dạng .doc, .docx, .pdf, nhỏ hơn 2048KB</span>
							</div>
						</div>
						<!-- Cover Letter -->   
						<span id="errorAppSystem" style="display: none;" class="error-message"></span>
					</div>
					<span id="errorAppSystem" style="display: none;" class="error-message"></span>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="congviec_id" id="congviec_id" value="<?php echo intval($_GET["id"]) ?>"/>
					<div class="pull-right">
						<button type="button" class="btn btn-defautl btn-outline track-event" data-evt-type="cancel-apply" tabindex="11" data-dismiss="modal">Trở Về</button>
						<button type="button" id="applySendProcessBtn" class="btn btn-primary " tabindex="11"><i style="display:none" class="fa fa-lg fa-pulse fa-spinner"></i>&nbsp;&nbsp;Nộp Đơn</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<?php }?>
<?php }else{?>
<div id="job-search" class="job-search intern">
	<div style="margin-bottom: 10px" class="blank d-flex-center-sm">
		<div class="container main-wrapper__breadcrumbs breadcrumbs-wrapper">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1>404 - Không tìm thấy</h1>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div style="margin-bottom: 10px" class="row">
		<div class="col-md-12">
			<div class="box box-md m-b-none">
				<div id="no-results-message">
					<h2 class="text-center text-lg">
						Không tìm thấy công việc thích hợp.
					</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<?php }?>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>