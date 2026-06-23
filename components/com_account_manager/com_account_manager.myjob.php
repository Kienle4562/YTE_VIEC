<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include_once('com_account_manager.models.php');
  	$myprocess = new process();
	$result = $myprocess->get_order_detail();
?>
<div style="padding: 50px 0px 0;" class="sitemap-container container">
    <div class="clearfix m_xs_bottom_10">
		<div class="bg_white p_15 r_corners m_bottom_20">
        	<h1 class="sitemap-header text-primary">Việc Làm Của Tôi</h1>
        	<div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">
				<div class="box-lg">
					<div class="res-table animated fadeIn">
						<span>
							<div class="res-table__row row animated">
								<?php
									if($result->rowCount() > 0){
									while($row = $result->fetch()){
										$link = $core_class->_removesigns($row["tencongviec"])."-".$row["congviec_id"]."-cv.html";
										$srcHinhanh = "/images/logo.png";
										if(!empty($row["hinhanh"]) && strpos($row["hinhanh"], "noimage") == false){
											$srcHinhanh = $row["hinhanh"];
										}
								?>
								<div class="col-md-1 col-xs-12 logo text-center">
									<img class="img-responsive" src="<?php echo $srcHinhanh ?>" alt="Company Logo">
								</div>
								<div class="col-md-7 col-xs-12 job-info">
									<div class="name">
										<a target="_blank" href="<?php echo $link ?>"><?php echo $row["tencongviec"] ?></a>
									</div>
									<span class="salary text-light"><?php echo $row["tencongty"] ?></span>
								</div>
								<div class="col-md-2 col-xs-12 expiry">
									<div class="text-light">
										Ngày hết hạn
										<span class="hidden-md hidden-lg m-r-xs">:</span>
									</div>
									<div class="text-strong"><?php echo date("d/m/Y", strtotime($row["ngayhethan"])) ?></div>
								</div>
								<div class="col-md-2 col-xs-12 applied">
									<div class="text-light">
										Đã ứng tuyển
										<span class="hidden-md hidden-lg m-r-xs">:</span>
									</div>
									<div class="text-strong"><?php echo date("d/m/Y", strtotime($row["DISORDER"])) ?></div>
								</div>
								<?php 
										}
									}
									else
									{
								?>
								<div class="col-md-12 col-xs-12 job-info">
									<h3>Bạn vẫn chưa ứng tuyển vào công việc vào, hãy tìm kiếm cho mình một công việc thích hợp nhé</h3>
								</div>
								<?php
									}
								?>
							</div>
						</span>
					</div>
				</div>
        	</div>
        </div>
	</div>
</div>

