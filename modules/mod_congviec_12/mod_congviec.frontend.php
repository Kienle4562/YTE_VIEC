<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    include_once("mod_congviec.models.php");
    
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
<section class="feature container home__jobs-you-will-love">
	<div class="col-lg-12 col-xs-12">
		<h1 class="text-center">Việc Làm Bạn Sẽ Thích</h1>
		<div class="tabs-container">
			<ul class="nav nav-tabs no-border" role="tablist">
				<li role="presentation" class="text-center no-padding active">
					<a id="topJobTab" href="#topJobs" aria-controls="topJobs" role="tab" data-toggle="tab" aria-expanded="true">
						<h3 class="no-padding no-margin">Việc Làm Mới Nhất</h3></a>
				</li>
				<li id="recommendJobTab" role="presentation" class="text-center no-padding">
					<a href="#recommendedJobs" aria-controls="recommendedJobs" role="tab" data-toggle="tab"
					   aria-expanded="false"><h3 class="no-padding no-margin">Việc Làm Lương Cao</h3></a>
				</li>
			</ul>
				<div class="tab-content">
						<!-- Top Jobs -->
						<div class="tab-pane tab-job active" id="topJobs">
							<div class="panel-content">
								<!-- Carousel -->
									<div class="job-carousels">
										<?php 
											 $number = 1;
											 $total = 1;
											 $process_congviec = new process_congviec();
											 $rs_cty = $process_congviec ->get_cty();
											 while($rowcty = $rs_cty->fetch())
											{  
										?>	
										<?php if($number == 1){ ?>
											<div class="job-page">
												<div class="row">
										<?php } ?>	
								
									<!-- item --->
									<div class="col-md-6">
										<div class="job hot-job row">
											<div class="col-xs-2 col-logo">
												<!-- Logo -->
												<div class="logo-box">
													<a href="<?php echo $link ?>" target="_blank" title="<?php echo $row["tencongviec"]. " - " . $row["tencongty"]; ?>">
														<img class="img-responsive logo" src="https://yteviec.com/file_upload/20-11-07-13-36-51_a 2.png" alt="<?php echo $row["tencongviec"]; ?>">
													</a>
												</div>
											</div>
											<div class="col-xs-10 col-content">
												<!-- Job Description-->
												<a href="<?php echo $link ?>" target="_blank" title="<?php echo $row["tencongviec"]. " - " . $row["tencongty"]; ?>">
													<p class="title text-clip job-title">Tên công việc</p>
													<div class="text-gray-light text-light company-info">
														<span class="company text-clip text-uppercase">
															tên công ty
														</span>
														<span class="hidden-xs">-</span>
														<span class="location hidden-xs"><?php echo $row["diadiemlamviec"]; ?></span>
													</div>
												</a>
											</div>
											<span class="hot-job-badge">Hot</span>
										</div>
									</div>
									<!-- end item -->
							
										<?php if($number ==12|| $total == $rs_cty->rowCount()){ ?>		
												</div>
											</div>
										<?php 
													$number = 0;
												}
												$number++;
												$total++;
												?>
									<?php } ?>
									</div>
							</div>
						</div>
				<div class="tab-pane tab-company" id="recommendedJobs">
					<div class="panel-content">
						<div class="row">
							<?php
								$process_congviec = new process_congviec();
								$where = "WHERE trn_congviec.mucluongtoithieu > 20000000 ";
								$where .= "AND trn_congviec.trangthai = 1";
								$result = $process_congviec->getData($where);
								if($result->rowCount() > 0){
								while($row = $result->fetch()){
									$link = $this->_removesigns($row["tencongviec"])."-".$row["congviec_id"]."-cv.html";
									$srcHinhanh = "/images/logo.png";
									if(!empty($row["hinhanh"]) && strpos($row["hinhanh"], "noimage") == false){
										$srcHinhanh = $row["hinhanh"];
									}
							?>
							<div class="col-md-6">
								<div class="job row">
									<div class="col-xs-2 col-logo">
										<!-- Logo -->
										<div class="logo-box">
											<a href="<?php echo $link ?>" target="_blank" title="<?php echo $row["tencongviec"]. " - " . $row["tencongty"]; ?>">
												<img class="img-responsive logo" src="<?php echo $srcHinhanh ?>" alt="<?php echo $row["tencongviec"]; ?>">
											</a>
										</div>
									</div>
									<div class="col-xs-10 col-content">
										<!-- Job Description-->
										<a href="<?php echo $link ?>" target="_blank" title="<?php echo $row["tencongviec"]. " - " . $row["tencongty"]; ?>">
											<p class="title text-clip job-title"><?php echo $row["tencongviec"]; ?></p>
											<div class="text-gray-light text-light company-info">
												<span class="company text-clip text-uppercase"><?php echo $row["tencongty"]; ?></span>
												<span class="hidden-xs">-</span>
												<span class="location hidden-xs"><?php echo $row["diadiemlamviec"]; ?></span>
											</div>
										</a>
									</div>
								</div>
							</div>
							<?php 
									}
								}else{
							?>
								<p>Không có công việc nào thích hợp</p>
							<?php	
								}
							?>
						</div>
					</div>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<a target="_blank" href="tat-ca-viec-lam.html" class="w_full btn btn-primary" tabindex="-1">XEM TẤT CẢ VIỆC LÀM</a>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</div>
	<!--<div class="col-lg-3 col-xs-12">
		<?php $this->load_module("right"); ?>
	</div> -->
</section>
