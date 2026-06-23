<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    include_once("mod_congty.models.php");
    $process_mod_congty = new process_mod_congty();
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
<style>
	#add-resume {
		padding: 40px 0;
		background: #FFF;
		margin-bottom: px;
		text-align:center;
		margin-top: 40px;
		border-radius: 5px;
	}

</style>
<!-- <div id="add-resume">
  	<div class="container">
	  	<ul class="col-xs-12 col-sm-9 col-md-6 alert-resumes-area">
			<li><i class="fa fa-envelope-o"></i><a href="javascript:void(0)" class="btnSubscribe"> Thông báo việc làm</a></li>
            <?php if(!empty($_SESSION["career"]["career_id"]) && $_SESSION["career"]["career_id"] !=NULL) { ?>
				<li><i class="fa fa-heart-o"></i><a href="myjob.html">Việc làm đã lưu</a></li>
            <?php }else { ?>
            
           		 <li><i class="fa fa-heart-o"></i><a href="#" onclick="onAlert();">Việc làm đã lưu</a></li>
            <?php } ?>
			<li><i class="fa fa-rss"></i><a href="#"> Following</a></li> 
		</ul>
		<div class="col-xs-12 col-sm-3 col-md-6 upload-resumes-area">
			<b>Upload hồ sơ để ứng tuyển mọi lúc mọi nơi</b>
			<button class="btn btn-primary" onclick="window.location='quick_upload_resume.html'">
				<i class="fa fa-cloud-upload"></i> Đăng Hồ Sơ
			</button>
		</div> 
	</div>
</div> -->



<?php if($process_mod_congty->isMobile()){ ?>
<section class="bnrs container home__featured-companies">
	<!-- <div id="ads_TOP_COMPANIES_HORISONTAL" class="row home__top-management-jobs" style="margin-top:-53px"> -->
		<div id="ads_TOP_COMPANIES_HORISONTAL" class="row home__top-management-jobs" >
	
<!-- 	<div id="add-resume">
  	<div class="container">
	  	<ul class="col-xs-12 col-sm-9 col-md-6 alert-resumes-area">
			<li>
				<i class="fa fa-envelope-o"></i>
				<a href="javascript:void(0)" class="btnSubscribe"> Thông báo việc làm</a>
			</li>
            <?php if(!empty($_SESSION["career"]["career_id"]) && $_SESSION["career"]["career_id"] !=NULL) { ?>
				<li>
					<i class="fa fa-heart-o"></i><a href="myjob.html">Việc làm đã lưu</a>
				</li>
            <?php }else { ?>
            
           		 <li>
           		 	<i class="fa fa-heart-o"></i><a href="#" onclick="onAlert();">Việc làm đã lưu</a>
           		 </li>
            <?php } ?>
			<li>
				<i class="fa fa-rss"></i><a href="#"> Following</a>
			</li> 
		</ul>
		<div class="col-xs-12 col-sm-3 col-md-6 upload-resumes-area">
			<b>Upload hồ sơ để ứng tuyển mọi lúc mọi nơi</b>
			<button class="btn btn-primary" onclick="window.location='quick_upload_resume.html'">
				<i class="fa fa-cloud-upload"></i> Đăng Hồ Sơ
			</button>
		</div> 
	</div>
</div> -->

		<h2><?php echo $module_title ?></h2>
		<div class="animated fadeIn featured-companies channel-content">
			<?php
				
				$result = $process_mod_congty->getData();
				while($row = $result->fetch()){
			?>
				<div class="companyBlock channel" style="flex-basis: 33.33%;">
					<a href="<?php echo $this->_removesigns($row["tencongty"])."-".$row["congty_id"]."-client.html"; ?>" target="_blank">
						<div class="companyBlock__box" role="img" aria-label="<?php echo $row["tencongty"] ?>">
							 <?php if(!empty($row["hinhanh"])){ ?>
									<img  src="<?php echo $row["hinhanh"] ?>">
								 <?php }else { ?>
										<img class="salesLogoImage" src="/images/logo.png">
								 <?php } ?>
								<div class="companyBlock__content">
									<div class="companyBlock__name is-uppercase"><?php echo $row["tencongty"] ?></div>
									<span class="companyBlock__tag">Việc mới</span>
								</div>
						</div>
					</a>
				</div>
			<?php 
				}
			?>
		</div>		
	</div>
</section>
<?php }else{ ?>
<section class="bnrs container home__featured-companies">

<!-- <div id="add-resume">
  	<div class="container">
	  	<ul class="col-xs-12 col-sm-9 col-md-6 alert-resumes-area">
			<li>
				<i class="fa fa-envelope-o"></i>
				<a href="javascript:void(0)" class="btnSubscribe"> Thông báo việc làm</a>
			</li>
            <?php if(!empty($_SESSION["career"]["career_id"]) && $_SESSION["career"]["career_id"] !=NULL) { ?>
				<li>
					<i class="fa fa-heart-o"></i>
					<a href="myjob.html">Việc làm đã lưu</a>
				</li>
            <?php }else { ?>
            
           		 <li>
           		 	<i class="fa fa-heart-o"></i>
           		 	<a href="#" onclick="onAlert();">Việc làm đã lưu</a>
           		 </li>
            <?php } ?>
			<li>
				<i class="fa fa-rss"></i>
				<a href="#"> Following</a>
			</li> 
		</ul>
		<div class="col-xs-12 col-sm-9 col-md-6 alert-resumes-area">
			<b>Upload hồ sơ để ứng tuyển mọi lúc mọi nơi</b>
			<button class="btn btn-primary" onclick="window.location='quick_upload_resume.html'">
				<i class="fa fa-cloud-upload"></i> Đăng Hồ Sơ
			</button>
		</div> 
	</div>
</div> -->



	<div id="ads_TOP_COMPANIES_HORISONTAL" class="row" style="margin-top:20px">
		<h2><?php echo $module_title ?></h2>
		<div class="animated fadeIn featured-companies">
			<?php
				$process_mod_congty = new process_mod_congty();
				$result = $process_mod_congty->getData();
				while($row = $result->fetch()){
			?>
				<div class="companyBlock" style="flex-basis: 33.33%;">
					<a href="<?php echo $this->_removesigns($row["tencongty"])."-".$row["congty_id"]."-client.html"; ?>" target="_blank">
						<div class="companyBlock__box" role="img" aria-label="<?php echo $row["tencongty"] ?>">
							 <?php if(!empty($row["hinhanh"])){ ?>
									<img  src="<?php echo $row["hinhanh"] ?>">
								 <?php }else { ?>
										<img class="salesLogoImage" src="/images/logo.png">
								 <?php } ?>
								<div class="companyBlock__content">
									<div class="companyBlock__name is-uppercase"><?php echo $row["tencongty"] ?></div>
									<span class="companyBlock__tag">Việc mới</span>
								</div>
						</div>
					</a>
				</div>
			<?php 
				}
			?>
		</div>		
	</div>
</section>
<?php } ?>