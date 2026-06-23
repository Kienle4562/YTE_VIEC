<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
include_once('com_congviec.danhmuc.models.php');
include_once('protected/paging.php');
$myprocess =  new process_danhmuc_congviec();

/* predefine something */
$cat_id = intval($_GET['id']);

/* get total row */
$totalrow = $myprocess->get_danhmuc_count($cat_id);	

/* config items per page */
$itemPerPage = 10;

/* phan trang */
if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);
$pager = Pager::getPagerData( $totalrow, $itemPerPage, $currentPage, $__append . $_GET["params"] . $GLOBALS['EXT'] . "?" );

//$category_title = $categoryProc->get_category_title($cat_id);    
$meta_title = "Việc làm ".$core_class->getValueFrom("trn_danhmuccv", "tendanhmuccv", "danhmuccv_id = ".$cat_id);

//if ($totalrow > 0)
//{
?>
<div id="job-search" class="job-search intern">
	<div class="main-wrapper__breadcrumbs blank d-flex-center-sm">
		<div class="container breadcrumbs-wrapper">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-8">
					<h1><?php echo $meta_title ?></h1>
				</div>
				<div style="display:none" class="col-sm-5 col-sm-push-1 col-md-4 col-lg-4 col-md-push-2 col-lg-push-0">
					<div class="search-bar hidden-xs">
						<div class="search-bar__label">TÌM VIỆC LÀM MỚI</div>
						<form class="form-inline search-bar__form">
							<div class="row">
								<div class="col-sm-8">
									<div class="form-group has-feedback">
										<input type="text" value="" class="search-bar__keyword form-control input-sm" placeholder="Nhập tên công việc">
										<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true" style="display: none;"></span>
										<div class="suggestion">
											<div class="dropdown">
												<ul class="dropdown-menu" style=""></ul>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button class="search-bar__search-btn btn btn-lg btn-primary btn-block">Tìm kiếm</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div id="main-job-list" class="job-search__main-job-list">
			<div class="job-search-body" title="">
				<div class="job-list job-list-page_boxed">
					<div id="job-list">
						<div class="ais-hits">
							<div class="job-list" id="job-list">
								<div class="box p-t-none p-b-none top-level-job-list">
									<div class="box-top-level clearfix">
										<?php
											$result = $myprocess->get_danhmuc_job($cat_id, intval($pager->offset), intval($pager->limit));
											while($row = $result->fetch()){
												$link = $core_class->_removesigns($row["tencongviec"])."-".$row["congviec_id"]."-cv.html";
										?>
										<div class="job-item item2">
											<div class="relative">
												<div class="row d-flex-sm">
													<div class="col-md-3 job-search__logo-col d-flex-center-sm">
														<div class="logo job-search__logo">
															<?php
																$srcHinhanh = "/images/logo.png";
																if(!empty($row["hinhanh"]) && strpos($row["hinhanh"], "noimage") == false){
																	$srcHinhanh = $row["hinhanh"];
																}
															?>
															<a href="<?php echo $link ?>" class="" target="_blank">
																<img title="Y Tế Việc" class="img-responsive" src="<?php echo $srcHinhanh ?>">
															</a>
														</div>
													</div>
													<div class="col-md-8 job-search__job-info-col">
														<div class="job-item-info relative">
															<h3 class="job-title">
																<a href="<?php echo $link ?>" target="_blank"><?php echo $row["tencongviec"] ?></a>
															</h3>
															<div class="company gray-light">
																<span class="job-search__company" title="<?php echo $row["tencongty"] ?>"><?php echo $row["tencongty"] ?></span>
															</div>
															<div class="extra-info">
																<span class="hidden-sm hidden-xs extraLabel">Lương:</span>
																<span class="salary text-primary">
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
																				$mucluong = $row['mucluongtoithieu'];
																			}
																			else if(!empty($row['mucluongtoithieu']) && !empty($row['mucluongtoida'])){
																				$mucluong = "Từ ".$row['mucluongtoithieu'];
																				$mucluong .= " Đến ".$row['mucluongtoida'];
																			}
																			else if(empty($row['mucluongtoithieu']) && !empty($row['mucluongtoida'])){
																				$mucluong = "Cao nhất ".$row['mucluongtoida'];
																			}
																			echo '<a class="clickable">'.$mucluong.'</a>';
																		?>
																	</span>
																</span>
																<span class="hidden-sm hidden-xs text-gray-a separator">|</span>
																<span class="hidden-sm hidden-xs extraLabel">Khu vực:</span>
																<span class="job-search__location gray-light">
																	<strong class="" title="<?php echo $row["diadiemlamviec"] ?>"> <?php echo $row["diadiemlamviec"] ?></strong>
																</span>
																<span class="hidden-sm hidden-xs text-gray-a separator">|</span>
																<span class="extraLabel">Ngày đăng:</span>
																<span class="hidden-sm hidden-xs job-search__date-posted gray-light">
																	<strong> <?php echo $core_class->time_ago(strtotime($row["ngaydang"])); ?></strong>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="text-center m-t-n m-b-lg">
						<ul class="pagination pagination-lg">
							<?php echo $pager->paging; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
//}
?>