<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    include_once("mod_nhatuyendungnoibat.models.php");
    
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

    if (empty($params) || $params == "undefine") {
        $params = array();
    }
    else {
        $params = unserialize($params);
    }
?>
<section class="home__company-spotlight animated fadeIn">
	<h1 class="text-center">
		<?php echo $module_title ?>
	</h1>
	<div class="container">
	
		<div class="company-list slick-initialized slick-slider slick-dotted" id="slider_Noibat">
			<div class="slick-list draggable">
				<div class="slick-track">
				
					<div class="slick-slide-item slick-slide slick-cloned" style="width: 100%">
						<div>
							<div class="company-item" data-rendered="true" style="width: 100%; display: inline-block;">
							<div class="background" style="background-image: url(https://images.vietnamworks.com/logo/banner.jpeg_103179.jpg)"></div>
							<div class="foreground">
								<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8">
										<div class="info-container box box-lg">
											<div class="row flex-center-xy">
												<div class="col-sm-3 logo">
													<a href="http://www.vietnamworks.com/tim-viec-lam/nha-tuyen-dung/-3360792/?utm_source=vnw_homepage&amp;utm_medium=companyspotlight&amp;utm_campaign=3360792" target="_blank" tabindex="-1">
														<img class="img-responsive" src="https://images.vietnamworks.com/logo/170x102-X_103179.jpg" alt="logo">
														</a>
													</div>
													<div class="col-sm-9 company-info">
														<a href="http://www.vietnamworks.com/tim-viec-lam/nha-tuyen-dung/-3360792/?utm_source=vnw_homepage&amp;utm_medium=companyspotlight&amp;utm_campaign=3360792" target="_blank" class="text-clip" tabindex="-1">
															<h2>Tek Experts</h2>
														</a>
														<p class="lead text-info">
															<em class="text-clip">My Career. My Future. My Tek Experts.</em>
														</p>
														<p class="description" style="word-wrap: break-word;">We are a growing international customer service and IT outsourcing company. From our 2 prestigious locations in central Hanoi we offer dynamic and nurturing environments where you can realize your full potential. We are looking for passionate, client-oriented and results-driven people like you!</p>
														<a target="_blank" href="http://www.vietnamworks.com/tim-viec-lam/nha-tuyen-dung/-3360792/?utm_source=vnw_homepage&amp;utm_medium=companyspotlight&amp;utm_campaign=3360792" class="btn btn-primary btn-outline btn-view-more btn-lg" tabindex="-1">
															Xem thêm
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-2"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
				</div>
			</div>		
		</div>
		
	</div>
</section>
