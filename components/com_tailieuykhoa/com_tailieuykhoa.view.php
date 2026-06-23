<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
include_once('com_tailieuykhoa.models.php');
include_once('protected/paging.php');
$myprocess =  new process();

/* predefine something */
$condition = "";
$key = "";
$category = "";
if(!empty($_REQUEST["search"]) && $_REQUEST["search"] != ""){
	$key = substr(htmlentities($_REQUEST["search"], ENT_QUOTES, "UTF-8"), 0, 50);
	$condition .= "AND (trn_archive.archive_name LIKE '%".$key."%' OR mst_chuyenkhoa.chuyenkhoa_name LIKE '%".$key."%') ";
}

if(!empty($_REQUEST["category"]) && $_REQUEST["category"] != -1){
	$category = substr($_REQUEST["category"], 0, 2);
	if(!is_numeric($category)){
		$condition = "";
	}else{
		$condition .= "AND trn_archive.chuyenkhoa_id = $category ";
	}
}
/* get total row */
$totalrow = $myprocess->get_count($condition);	
$resultData = $myprocess->get_list($condition);
/* config items per page */
$itemPerPage = 12;

/* phan trang */
if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);
$pager = Pager::getPagerData( $totalrow, $itemPerPage, $currentPage, $__append . $_GET["params"] . $GLOBALS['EXT'] . "?" );

//$category_title = $categoryProc->get_category_title($cat_id);    
$meta_title = $key == "" ? "Tất cả tài liệu về y khoa có tại Y Tế Việc" : "Tìm kiếm tài liệu y khoa với từ khóa \"$key\"";
?>
<section id="ungvien">
	<div id="search-widget-wrapper">
		<div id="search-widget" class="collapse m-t-md in">
			<div class="search-form container">
				<div class="bg-blue">
					<div class="row">
						<div class="search-widget-area col-sm-12" id="search-box">
							<form name="timkiemungvien" action="">
								<div class="col-sm-8">
									<div class="row">
										<div class="col-sm-8 keyword-search-wrapper">
											<div class="textbox">
												<span class="col-xs-12 no-padding">
													<span class="twitter-typeahead">
														<input value="<?php echo $key ?>" name="search" type="text" class="form-control search-all input-lg text-clip search-job-title tt-input" placeholder="Tên tài liệu, tên danh mục..." style="position: relative; vertical-align: top;">
													</span>
												</span>
											</div>
										</div>
										<div class="col-sm-4 cate-search">
											<div class="textbox">
												<span class="col-xs-12 no-padding">
													<select class="select-category" name="category">
														<option value="-1">Tất cả</option>
														<?php
															$result = $myprocess->getcategory();
															while($row = $result->fetch()){
														?>
															<option <?php echo $category == $row["chuyenkhoa_id"] ? "selected" : "" ?> value="<?php echo $row["chuyenkhoa_id"] ?>"><?php echo $row["chuyenkhoa_name"] ?></option>
														<?php
															}
														?>
													</select>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<button class="btn-search btn btn-lg btn-primary" type="submit">
										Tìm kiếm
									</button>
								</div>
								<div class="col-sm-2">
									<button class="btn-search btn btn-lg btn-primary" type="button">
										Ôn tập nội trú
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="container">
	<div id="main-career-list" class="job-search__main-job-list">
		<div class="job-search-body" title="">
			<div class="job-list job-list-page_boxed">
				<div id="job-list">
					<div class="ais-hits">
						<div class="job-list" id="job-list">
							<div class="box p-t-none p-b-none top-level-job-list">
								<div class="box-top-level clearfix">
									<?php
										if ($totalrow > 0){
											while($row = $resultData->fetch()){
									?>
									<div class="job-item item2">
										<div class="relative">
											<div class="row d-flex-sm">
												<div class="col-md-3 job-search__logo-col d-flex-center-sm">
													<div class="logo job-search__logo">
														<a>
															<?php
																$srcHinhanh = "/images/logo.png";
																if(!empty($row["archive_image"]) && strpos($row["archive_image"], "noimage") == false){
																	$srcHinhanh = $row["archive_image"];
																}
															?>
															<img title="Y Tế Việc" class="img-responsive" src="<?php echo $srcHinhanh ?>">
														</a>
													</div>
												</div>
												<div class="col-md-8 job-search__job-info-col">
													<div class="job-item-info relative">
														<h4 class="job-title">
															<a href="archive<?php echo $row["archive_id"] ?>.html" target="_blank"><?php echo $row["archive_name"] ?></a>
														</h4>
														<div class="gray-light">
															<span class="job-search__company" title="<?php echo $row["chuyenkhoa_name"] ?>">
																<?php echo $row["chuyenkhoa_name"] ?>
															</span>
														</div>
														<p><?php echo $core_class->SmartContent($row["archive_content"], 120); ?></p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php 
											}
										}
										else{ 
									?>
									<h3>Không tìm thấy kết quả nào</h3>
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