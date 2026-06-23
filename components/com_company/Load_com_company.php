	<?php
				$valueSearch = $_POST['case_mode'];
				$offset = 0;
				$limit = 12;
				$condition = "AND ( trn_congty.tencongty LIKE '%".$valueSearch."%' )";
				$resultUngVien = $myprocess->get_list_company_fix($condition, intval($offset), intval($limit));
				//$resultUngVien = $myprocess->get_list_company_fix($condition, intval($pager->offset), intval($pager->limit));
				while($row = $resultUngVien->fetch()){
					$link = $core_class->_removesigns($row["tencongty"])."-".$row["congty_id"]."-client.html";
					
			?>
				<div class="job-item">
					<div class="relative">
					<div class="row d-flex-sm">
						<div class="col-md-3 job-search__logo-col d-flex-center-sm companylogo">
							<div class="logo job-search__logo">
								<a>
									<?php
										$srcHinhanh = "/images/logo.png";
										if(!empty($row["hinhanh"]) && strpos($row["hinhanh"], "noimage") == false){
											$srcHinhanh = $row["hinhanh"];
										}
									?>
									<img title="Y Tế Việc" class="img-responsive" src="<?php echo $srcHinhanh ?>">
								</a>
							</div>
						</div>
						<div class="col-md-9 job-search__job-info-col">
							<div class="job-item-info relative">
								<h3 class="job-title">
									<a href="<?php echo $link ?>" target="_blank"><?php echo $row["tencongty"] ?></a>
								</h3>
								
								<div>
									<span class="job-search__location gray-light">
										<i class="fa fa-map-marker" aria-hidden="true"></i> 
										<strong title="<?php echo $row["diachicongty"] ?>"> <?php echo $row["diachicongty"] ?></strong>
									</span>
								</div>
								<?php if(!empty($row["sdthoai"])) { ?>
								<!--<div>
									<span class="job-search__location gray-light">
										<i class="fa fa-phone-square" aria-hidden="true"></i>
										<strong title="Số điện thoại"> <?php echo $row["sdthoai"] ?></strong>
									</span>
								</div> -->
								<?php } ?>
								<div class="benefits">
									<div class="benefit">
										<a target="_blank" href="<?php echo $row["web"] ?>"><?php echo substr($row["web"],0, 40) ?></a>
									</div>
									<?php
										$chkTuyenDung = $myprocess->checkTuyenDung($row["congty_id"]);
										if($chkTuyenDung){
									?>
									<div class="benefits">
										<a target="_blank" class="btn-search btn btn-lg btn-primary" href="<?php echo $link ?>#jobs">TUYỂN DỤNG</a>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php 
			}
	?>
									
								
						