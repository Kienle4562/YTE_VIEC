<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
include_once('com_congviec.category.models.php');
include_once('protected/paging.php');
$myprocess =  new process_danhmuc_congviec();

/* predefine something */
$condition = "";
$key = "";
$searchkey = "";
$currentLink = $__append . $_GET["params"] . $GLOBALS['EXT']. "?";
if(!empty($_REQUEST["search"])){
	$key = $core_class->txt_htmlspecialchars($_REQUEST["search"]);
	$searchkey = $core_class->txt_htmlspecialchars($_REQUEST["search"]);
	$searchkey = $core_class->_removesigns($key);
	$condition .= ' AND (trn_congviec.search_key LIKE CONCAT("%", CONVERT("'.$searchkey.'", BINARY), "%")) ';
	//$condition .= 'OR trn_danhmuccv.search_key LIKE CONCAT("%", CONVERT("'.$searchkey.'", BINARY), "%")) ';
	$currentLink .= "&search=".$searchkey;
}
if(!empty($_REQUEST["location"]) && $_REQUEST["location"] != -1  && is_numeric($_REQUEST["location"])){
	$location = htmlentities($_REQUEST["location"], ENT_QUOTES, "UTF-8");
	$condition .= " AND trn_congviec.tinhthanh_id IN ($location) ";
	$currentLink .= "&location=".$location;
}
if(!empty($_REQUEST["job"]) && $_REQUEST["job"] != -1  && is_numeric($_REQUEST["job"])){
	$job = htmlentities($_REQUEST["job"], ENT_QUOTES, "UTF-8");
	$condition .= " AND trn_danhmuccv.danhmuccv_id IN ($job) ";
	$currentLink .= "&job=".$job;
}
if(!empty($_REQUEST["danhmuccv"]) && $_REQUEST["danhmuccv"] != -1  && is_numeric($_REQUEST["danhmuccv"])){
	$danhmuccv = htmlentities($_REQUEST["danhmuccv"], ENT_QUOTES, "UTF-8");
	$condition .= " AND trn_congviec.chuyenkhoa_id = $danhmuccv";
	$currentLink .= "&danhmuccv=".$danhmuccv;
}
if(!empty($_REQUEST["BangCap"])){
	$BangCap = htmlentities($_REQUEST["BangCap"], ENT_QUOTES, "UTF-8");
	$condition .= "AND trn_congviec.bangcap_id IN ($BangCap) ";
	$currentLink .= "&BangCap=".$BangCap;
}
if(!empty($_REQUEST["salary"]) && $_REQUEST["salary"] != -1 && is_numeric($_REQUEST["salary"])){
	$arrayFilter = array(
		3 => '3000000',
		5 => '5000000',
		7 => '7000000',
		10 => '10000000',
		15 => '15000000',
		20 => '20000000',
		30 => '30000000',
	);
	$salary = htmlentities($_REQUEST["salary"], ENT_QUOTES, "UTF-8");
	$condition .= ' AND trn_congviec.mucluongtoithieu LIKE CONCAT("%", CONVERT("'.$arrayFilter[$salary].'", BINARY), "") ';
	$currentLink .= "&salary=".$salary;
}
if(!empty($_REQUEST["loaihinhcv"]) && $_REQUEST["loaihinhcv"] != -1  && is_numeric($_REQUEST["loaihinhcv"])){
	$loaihinhcv = htmlentities($_REQUEST["loaihinhcv"], ENT_QUOTES, "UTF-8");
	$condition .= " AND trn_congviec.loaihinhcongviec_id = $loaihinhcv ";
	$currentLink .= "&loaihinhcv=".$loaihinhcv;
}
if(!empty($_REQUEST["trinhdo"]) && $_REQUEST["trinhdo"] != -1  && is_numeric($_REQUEST["trinhdo"])){
	$trinhdo = htmlentities($_REQUEST["trinhdo"], ENT_QUOTES, "UTF-8");
	$condition .= " AND trn_congviec.bangcap_id = $trinhdo ";
	$currentLink .= "&trinhdo=".$trinhdo;
}
if(!empty($_REQUEST["HTCV"])){
	$HTCV = str_replace(",", "/", htmlentities($_REQUEST["HTCV"], ENT_QUOTES, "UTF-8"));
	$condition .= " AND INSTR(trn_congviec.loaihinhcongviec_id, $HTCV) > 0 ";
	$currentLink .= "&HTCV=".$HTCV;
}
// sql cho checkbox filter theo tỉnh thành
$sqlFilterTT = "
	SELECT
		COUNT(trn_congviec.congviec_id) AS NUM,
		mst_tinhthanh.id,
		mst_tinhthanh.ten_tinhthanh
	FROM
		mst_tinhthanh
	Inner Join trn_congviec ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
	GROUP BY mst_tinhthanh.ten_tinhthanh
	ORDER BY NUM DESC, mst_tinhthanh.DISORDER DESC
";
// sql cho filter theo dmcv
$sqlFilterDMCV = "
	SELECT
	Count(trn_congviec.congviec_id) AS NUM,
	trn_danhmuccv.danhmuccv_id,
	trn_danhmuccv.tendanhmuccv
	FROM
	trn_congviec
	Inner Join trn_danhmuccv ON trn_congviec.danhmuccv_id = trn_danhmuccv.danhmuccv_id
	GROUP BY trn_danhmuccv.tendanhmuccv
	ORDER BY trn_danhmuccv.DISORDER, NUM DESC
";
// sql cho filter theo hình thức công việc
$sqlFilterHTCV = "
	SELECT
		Count(tcv.congviec_id) AS NUM,
		mlhcv.loaihinhcongviec_id,
		mlhcv.tenloaihinhcongviec
	FROM
		mst_loaihinhcongviec mlhcv
	Inner JOIN (SELECT * FROM trn_congviec) tcv ON INSTR(tcv.loaihinhcongviec_id,mlhcv.loaihinhcongviec_id)>0
	GROUP BY mlhcv.tenloaihinhcongviec
	ORDER BY NUM DESC
";
// sql cho filter theo bằng cấp
$sqlFilterBangCap = "
	SELECT
	Count(trn_congviec.bangcap_id) AS NUM,
	mst_bangcap.bangcap_id,
	mst_bangcap.tenbangcap
	FROM
	trn_congviec
	INNER Join mst_bangcap ON trn_congviec.bangcap_id = mst_bangcap.bangcap_id
	GROUP BY mst_bangcap.tenbangcap
	ORDER BY NUM DESC
";
$currentLink .= "&";
/* config items per page */
$itemPerPage = 10;
/* get total row */
$totalrow = $myprocess->get_danhmuc_count($condition);	
/* phan trang */
if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);

//echo $currentLink;
$pager = Pager::getPagerData( $totalrow, $itemPerPage, $currentPage, $currentLink);

$result = $myprocess->get_danhmuc_job($condition, intval($pager->offset), intval($pager->limit));

//$category_title = $categoryProc->get_category_title($cat_id);
$title_search = $key == "" ? "Tất cả công việc có tại Y Tế Việc" : "Có <font color=yellow> $totalrow </font> Việc làm  <font color=yellow>$key</font>  Đang tuyển dụng";
$meta_title_c = $key == "" ? "Tất cả công việc có tại Y Tế Việc" : "Có <font color=yellow> $totalrow </font> Việc làm <font color=yellow>$key</font>  Đang tuyển dụng";
?>
<section id="ungvien">
	<div id="search-widget-wrapper">
		<div style="margin-top: 5px;" id="search-widget" class="collapse m-t-md in">
			<div class="search-form container">
				<div class="bg-blue">
					<div class="row">
						<div class="search-widget-area col-sm-12" id="search-box">
							<form name="timkiemungvien" action="">
								<div class="col-sm-10">
									<div class="row">
										<div class="col-sm-4 keyword-search-wrapper">
											<div class="textbox">
												<span class="col-xs-12 no-padding">
													<span class="twitter-typeahead">
														<input value="<?php echo $key ?>" name="search" type="text" class="form-control search-all input-lg text-clip search-job-title tt-input" placeholder="Nhập chức danh, vị trí, kỹ năng..." style="position: relative; vertical-align: top;">
													</span>
												</span>
											</div>
										</div>
										<div class="col-sm-4 level-search-category">
											<div class="textbox">
												<span class="col-xs-12 no-padding">
													<select class="select-category" data-search-input-placeholder="Tìm kiếm theo ngành nghề" name="danhmuccv" id="danhmuccv" data-placeholder="Chọn ngành nghề">
														<option value="-1">Tất cả các khoa, ngành</option>
														<?php
															$resultDMCV = $myprocess->getDanhmuccv();
															$selected = "";
															while($rowDMCV = $resultDMCV->fetch()){
																$resultCK = $myprocess->getChuyenKhoa($rowDMCV["danhmuccv_id"]);
																if($resultCK->rowCount() > 0){
														?>
															<optgroup label="<?php echo $rowDMCV["tendanhmuccv"] ?>">
																<?php
																	while($rowCK = $resultCK->fetch()){
																		$selected = $rowCK["chuyenkhoa_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";
																?>
																	<option <?php echo $selected ?> value="<?php echo $rowCK["chuyenkhoa_id"] ?>"><?php echo $rowCK["chuyenkhoa_name"] ?></option>
																<?php
																	}
																?>
															</optgroup>
														<?php
																}else{
																	$selected = $rowDMCV["danhmuccv_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";
														?>
																	<option <?php echo $selected ?> value="<?php echo $rowDMCV["danhmuccv_id"] ?>"><?php echo $rowDMCV["tendanhmuccv"] ?></option>
														<?php
																}
															}
														?>
													</select>
												</span>
											</div>
										</div>
										<div class="col-sm-4 level-search-category">
											<div class="textbox">
												<span class="col-xs-12 no-padding">
													<select class="select-category" data-search-input-placeholder="Nhập tỉnh thành" name="location" id="location" data-placeholder="Chọn tỉnh thành">
														<option value="-1">Tất cả</option>
														<?php
															$resultTT = $myprocess->getTinhThanh();
															while($rowTT = $resultTT->fetch()){
														?>
															<option <?php echo ($location == $rowTT["id"]) ? 'selected' : '' ?> value="<?php echo $rowTT["id"] ?>"><?php echo $rowTT["ten_tinhthanh"] ?></option>
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
										<i></i>
										Tìm kiếm
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
<?php
	if ($totalrow > 0)
	{
?>
<div id="job-search" class="job-search intern">
	<div style="margin-bottom: 10px" class="blank d-flex-center-sm">
		<div class="container">
			<div class="row"> 
				<div class="main-wrapper__breadcrumbs breadcrumbs-wrapper color_while">
					<div class="col-sm-12 col-md-12 col-lg-12">
				
						<h4><?php echo $title_search ?></h4>
					</div>
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
		<div id="main-job-list" class="col-md-9 job-search__main-job-list">
			<div class="job-search-body" title="">
				<div class="job-list job-list-page_boxed">
					<div id="job-list">
						<div class="ais-hits">
							<div class="job-list" id="job-list">
								<div class="box p-t-none p-b-none top-level-job-list">
									<div class="box-top-level clearfix">
										<?php
											while($row = $result->fetch()){
												$link = $core_class->_removesigns($row["tencongviec"])."-".$row["congviec_id"]."-cv.html";
										?>
										<div class="job-item">
											<div class="relative">
												<div class="row d-flex-sm">
													<div class="col-md-3 job-search__logo-col d-flex-center-sm">
														<div class="logo job-search__logo">
															<a href="<?php echo $link ?>" class="" target="_blank">
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
																			//$mucluong = $row['mucluongtoithieu'];
																			$mucluong =  number_format($row['mucluongtoithieu'], 0).$loaitien;
																		}
																		else if(!empty($row['mucluongtoithieu']) && !empty($row['mucluongtoida'])){
																			/*$mucluong = "Từ ".number_format($row['mucluongtoithieu'], 0);
																			$mucluong .= " Đến ".number_format($row['mucluongtoida'], 0);*/
																				$mucluong = "Từ ". number_format($row['mucluongtoithieu'], 0).$loaitien;
																				$mucluong .= " Đến ".number_format($row['mucluongtoida'], 0).$loaitien;
																		}
																		else if(empty($row['mucluongtoithieu']) && !empty($row['mucluongtoida'])){
																			$mucluong = "Cao nhất ".number_format($row['mucluongtoida'], 0).$loaitien;
																		}
																		echo '<a class="clickable">'.$mucluong.'</a>';
																	?>
																	
																</span>
																<!--<span class="salary text-primary">
																	<?php
																		if(isset($_SESSION["career"]["email"])){  
																		$mucluong = "Thỏa thuận";
																		$loaitien= "";
																		if($row['loaitien_id'] == 2)
																		{
																			$loaitien = "USD";
																		}else{
																			$loaitien = "VNĐ";
																		}
																		if(!empty($row['mucluongtoithieu']) && empty($row['mucluongtoida'])){
																			//$mucluong = number_format($row['mucluongtoithieu'], 0);
																			//$mucluong = $row['mucluongtoithieu'];
																			$mucluong =  number_format($row['mucluongtoithieu'], 0).$loaitien;
																		}
																		else if(!empty($row['mucluongtoithieu']) && !empty($row['mucluongtoida'])){
																			/*$mucluong = "Từ ".number_format($row['mucluongtoithieu'], 0);
																			$mucluong .= " Đến ".number_format($row['mucluongtoida'], 0);*/
																				$mucluong = "Từ ". number_format($row['mucluongtoithieu'], 0).$loaitien;
																				$mucluong .= " Đến ".number_format($row['mucluongtoida'], 0).$loaitien;
																		}
																		else if(empty($row['mucluongtoithieu']) && !empty($row['mucluongtoida'])){
																			$mucluong = "Cao nhất ".number_format($row['mucluongtoida'], 0).$loaitien;
																		}
																		echo '<a class="clickable">'.$mucluong.'</a>';
																	 }else{
																	?>
																	<a onclick="globalLogInModal.showModal();" class="clickable">Đăng nhập để xem mức lương</a>
																	<?php 
																	}
																	?>
																</span>-->
																<span class="hidden-sm hidden-xs text-gray-a separator">|</span>
                                                                <?php if(!empty($row["diadiemlamviec"])) { ?>
																<span class="hidden-sm hidden-xs extraLabel">Khu vực:</span>
																<span class="job-search__location gray-light">
																	<strong class="" title="<?php echo $row["diadiemlamviec"] ?>"> <?php echo $row["diadiemlamviec"] ?></strong>
																</span>
																<span class="hidden-sm hidden-xs text-gray-a separator">|</span>
                                                                 <?php } ?>
																<span class="extraLabel">Ngày đăng:</span>
																<span class="hidden-sm hidden-xs job-search__date-posted gray-light">
																	<strong> <?php echo $core_class->time_ago(strtotime($row["ngaydang"])); ?></strong>
																</span>
															</div>
															<!--<div class="benefits">
																<div class="benefit row">
																	<div class="benefit-name col-xs-11 text-clip"><?php echo $row["quyenloi"] ?></div>
																</div>
															</div>-->
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
		<div class="col-sm-12 col-md-3 col-filterJob" style="display: block;">
			<div class="box-shadow super-search-filter">
				<div class="facet open-filters">
					<button type="button" class="btn btn-primary w_full resetFilter">
						<i class="fa fa-refresh"></i>Reset Filter
					</button>
				</div>
				<div class="FilterTTContent">
					<h5 class="ais-header">
						Địa điểm
					</h5>
					<div class="ais-refinement-list" style="overflow: hidden;">
						<ul style="height: 190px;overflow: hidden;" class="filterTT">
							<?php
								echo $myprocess->createCheckBox($sqlFilterTT); 
							?>
						</ul>
						<input type="hidden" value="<?php echo $_REQUEST['location'] ?>" name="locationFilter">
						<div class="more">
							<a class="showlocation" href="javascript:void(0);">Xem thêm</a>
							<a class="shortcut" style="float:right;display:none" href="javascript:void(0);">Rút gọn</a>
						</div>
					</div>
				</div>
				<div class="FilterHTCVContent">
					<h5 class="ais-header">
						Hình thức
					</h5>
					<div class="ais-refinement-list" style="overflow: hidden;">
						<ul class="filterHTCV">
							<?php
								echo $myprocess->createCheckBox($sqlFilterHTCV); 
							?>
						</ul>
						<input type="hidden" value="<?php echo $_REQUEST['HTCV'] ?>" name="HTCVFilter">
					</div>
				</div>
				<div class="FilterDMCVContent">
					<h5 class="ais-header">
						Ngành nghề
					</h5>
					<div class="ais-refinement-list" style="overflow: hidden;">
						<ul class="filterDMCV">
							<?php
								echo $myprocess->createCheckBox($sqlFilterDMCV); 
							?>
						</ul>
						<input type="hidden" value="<?php echo $_REQUEST['job'] ?>" name="DMCVFilter">
					</div>
				</div>
				<div class="FilterSalaryContent">
					<h5 class="ais-header">
						Mức lương
					</h5>
					<div class="ais-refinement-list" style="overflow: hidden;">
						<ul class="filterSalary">
							<?php
								echo $myprocess->createRadioSalary(); 
							?>
						</ul>
						<input type="hidden" value="<?php echo $_REQUEST['salary'] ?>" name="SalaryFilter">
					</div>
				</div>
				<div class="FilterBangCapContent">
					<h5 class="ais-header">
						Bằng cấp
					</h5>
					<div class="ais-refinement-list" style="overflow: hidden;">
						<ul class="filterBangCap">
							<?php
								echo $myprocess->createCheckBox($sqlFilterBangCap); 
							?>
						</ul>
						<input type="hidden" value="<?php echo $_REQUEST['BangCap'] ?>" name="BangCapFilter">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	}else{
?>
<div id="job-search" class="job-search intern">
	<div style="margin-bottom: 10px" class="blank d-flex-center-sm">
	 <div class="container">
		<div class="main-wrapper__breadcrumbs breadcrumbs-wrapper">
			<div class="col-sm-12 col-md-12 col-lg-12">
				<h4><?php echo $meta_title_c ?></h4>
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
						Không tìm thấy công việc thích hợp với từ khóa của bạn.
					</h2>
				</div>
			</div>
		</div>
	</div>
	<div style="margin-bottom: 10px" class="row">
		<div class="col-md-12">
			<div class="box box-md m-b-none">
				<div id="no-results-message">
					<h1 class="text-center text-lg">
						Các việc làm khác có tại Y Tế Việc
					</h1>
				</div>
			</div>
		</div>
	</div>
	<div id="main-job-list" class="job-search__main-job-list col-md-9">
		<div class="job-search-body" title="">
			<div class="job-list job-list-page_boxed">
				<div id="job-list">
					<div class="ais-hits">
						<div class="job-list" id="job-list">
							<div class="box p-t-none p-b-none top-level-job-list">
								<div class="box-top-level clearfix">
									<?php
										$totalrow = $myprocess->get_danhmuc_count("");	
										$result = $myprocess->get_danhmuc_job("", intval($pager->offset), intval($pager->limit));
										/* config items per page */
										$itemPerPage = 12;

										/* phan trang */
										if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);
										$pager = Pager::getPagerData( $totalrow, $itemPerPage, $currentPage, $__append . $_GET["params"] . $GLOBALS['EXT'] . "?" );
										while($row = $result->fetch()){
											$link = $core_class->_removesigns($row["tencongviec"])."-".$row["congviec_id"]."-cv.html";
									?>
									<div class="job-item">
										<div class="relative">
											<div class="row d-flex-sm">
												<div class="col-md-3 job-search__logo-col d-flex-center-sm">
													<div class="logo job-search__logo">
														<a href="<?php echo $link ?>" class="" target="_blank">
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
																<?php
																	$mucluong = "Thỏa thuận";
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
															 <!--<span class="salary text-primary">
																<?php
																	if(isset($_SESSION["career"]["email"])){  
																	$mucluong = "Thỏa thuận";
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
																 }else{
																?>
																<a onclick="globalLogInModal.showModal();" class="clickable">Đăng nhập để xem mức lương</a>
																<?php 
																}
																?>
															</span>-->
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
														<!--<div class="benefits">
															<div class="benefit row">
																<div class="benefit-name col-xs-11 text-clip"><?php echo $row["quyenloi"] ?></div>
															</div>
														</div>-->
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
	<div class="col-sm-12 col-md-3 col-filterJob" style="display: block;">
		<div class="box-shadow super-search-filter">
			<div class="facet open-filters">
				<button type="button" class="btn btn-primary w_full resetFilter">
					<i class="fa fa-refresh"></i>Reset Filter
				</button>
			</div>
			<div class="FilterTTContent">
				<h5 class="ais-header">
					Địa điểm
				</h5>
				<div class="ais-refinement-list" style="overflow: hidden;">
					<ul style="height: 190px;overflow: hidden;" class="filterTT">
						<?php
							echo $myprocess->createCheckBox($sqlFilterTT); 
						?>
					</ul>
					<input type="hidden" value="<?php echo $_REQUEST['location'] ?>" name="locationFilter">
					<div class="more">
						<a class="showlocation" href="javascript:void(0);">Xem thêm</a>
						<a class="shortcut" style="float:right;display:none" href="javascript:void(0);">Rút gọn</a>
					</div>
				</div>
			</div>
			<div class="FilterHTCVContent">
				<h5 class="ais-header">
					Hình thức
				</h5>
				<div class="ais-refinement-list" style="overflow: hidden;">
					<ul class="filterHTCV">
						<?php
							echo $myprocess->createCheckBox($sqlFilterHTCV); 
						?>
					</ul>
					<input type="hidden" value="<?php echo $_REQUEST['HTCV'] ?>" name="HTCVFilter">
				</div>
			</div>
			<div class="FilterDMCVContent">
				<h5 class="ais-header">
					Ngành nghề
				</h5>
				<div class="ais-refinement-list" style="overflow: hidden;">
					<ul class="filterDMCV">
						<?php
							echo $myprocess->createCheckBox($sqlFilterDMCV); 
						?>
					</ul>
					<input type="hidden" value="<?php echo $_REQUEST['job'] ?>" name="DMCVFilter">
				</div>
			</div>
			<div class="FilterSalaryContent">
				<h5 class="ais-header">
					Mức lương
				</h5>
				<div class="ais-refinement-list" style="overflow: hidden;">
					<ul class="filterSalary">
						<?php
							echo $myprocess->createRadioSalary(); 
						?>
					</ul>
					<input type="hidden" value="<?php echo $_REQUEST['salary'] ?>" name="SalaryFilter">
				</div>
			</div>
			<div class="FilterBangCapContent">
				<h5 class="ais-header">
					Bằng cấp
				</h5>
				<div class="ais-refinement-list" style="overflow: hidden;">
					<ul class="filterBangCap">
						<?php
							echo $myprocess->createCheckBox($sqlFilterBangCap); 
						?>
					</ul>
					<input type="hidden" value="<?php echo $_REQUEST['BangCap'] ?>" name="BangCapFilter">
				</div>
			</div>
		</div>
	</div>
</div>
<?php }?>
<script>
var style = $(".filterTT").attr('style');
var numDisp = 7;
var numLi = $(".filterTT li").length;
var heightDiv = $(".m-checkbox-inline").height() / numDisp;
$(function(){
	var mCheckboxLnline = $(".m-checkbox-inline").height();
	if($(".m-checkbox-inline").html() == ""){
		$(".FilterTTContent").remove();
	}else{
		filter();
		$(".FilterTTContent").show();
	}
	$(".showlocation").click(function(){
		var heightCBList = $(".filterTT").height();
		var height = mCheckboxLnline/numDisp+heightCBList;
		if(height < mCheckboxLnline){
			$(".filterTT").height(height);
		}else{
			$(".filterTT").height(mCheckboxLnline);
			$('.showlocation').hide();
		}
		$('.shortcut').show();
	})

	$(".shortcut").click(function(){
		var heightCBList = $(".filterTT").height();		
		var height = heightCBList-heightDiv;
		if(height > heightDiv){
			$(".filterTT").height(height);
		}else{
			$(".filterTT").height(heightDiv);
			$('.shortcut').hide();
		}
		$('.showlocation').show();
	})

	function filter(){
		var heightCBList = $(".filterTT").height();
		var filterTT = $(".filterTT");
		var locationFilter = $("input[name=locationFilter]");
		var arrayLF = locationFilter.val().split(",");
		arrayLF.forEach(function(val){
			$(".filterTT .chkCheckBox[value='"+val+"']").prop('checked', true);
		})

		var DMCVFilter = $("input[name=DMCVFilter]");
		var arrayDMCV = DMCVFilter.val().split(",");
		arrayDMCV.forEach(function(val){
			$(".filterDMCV .chkCheckBox[value='"+val+"']").prop('checked', true);
		})

		var HTCVFilter = $("input[name=HTCVFilter]");
		var arrayHTCV = HTCVFilter.val().split(",");
		arrayHTCV.forEach(function(val){
			$(".filterHTCV .chkCheckBox[value='"+val+"']").prop('checked', true);
		})

		var BangCapFilter = $("input[name=BangCapFilter]");
		var arrayBangCap = BangCapFilter.val().split(",");
		arrayBangCap.forEach(function(val){
			$(".filterBangCap .chkCheckBox[value='"+val+"']").prop('checked', true);
		})
		
		var salary =  $("input[name=SalaryFilter]").val();
		$(".filterSalary .radioBox[value='"+salary+"']").prop('checked', true);
		if(!locationFilter.val()){
			filterTT.attr('style', style);
			$(".shortcut").hide();
		}
		if(mCheckboxLnline < heightCBList){
			$(".filterTT").removeAttr('style');
			$('.showlocation').hide();
		}
	}
	var cLink = "<?php echo $_GET['params'] ?>.html?";
	var danhmuccv =  $('#danhmuccv option').filter(':selected').val();
	//alert(danhmuccv);
	$(".filterTT .chkCheckBox").click(function(){
		var locationFilter = $(".filterTT .chkCheckBox:checked").map(function(){
			return $(this).val();
		}).get().join(',');
		var DMCVFilter = $("input[name=DMCVFilter]").val();
		var HTCVFilter = $("input[name=HTCVFilter]").val();
		var BangCapFilter = $("input[name=BangCapFilter]").val();
		var salary =  $("input[name=SalaryFilter]").val();
		cLink += "&job=" + DMCVFilter + "&location=" + locationFilter + "&salary="+salary+"&HTCV="+HTCVFilter+"&BangCap="+BangCapFilter+"&danhmuccv="+danhmuccv;
		setLinkFilter(cLink);
	})

	$(".filterDMCV .chkCheckBox").click(function(){
		var DMCVFilter = $(".filterDMCV .chkCheckBox:checked").map(function(){
			return $(this).val();
		}).get().join(',');
		var locationFilter = $("input[name=locationFilter]").val();
		var salary =  $("input[name=SalaryFilter]").val();
		var HTCVFilter = $("input[name=HTCVFilter]").val();
		var BangCapFilter = $("input[name=BangCapFilter]").val();
		cLink += "&job=" + DMCVFilter + "&location=" + locationFilter + "&salary="+salary+"&HTCV="+HTCVFilter+"&BangCap="+BangCapFilter+"&danhmuccv="+danhmuccv;
		setLinkFilter(cLink);
	})

	$(".filterHTCV .chkCheckBox").click(function(){
		var locationFilter = $("input[name=locationFilter]").val();
		var DMCVFilter = $("input[name=DMCVFilter]").val();
		var salary =  $("input[name=SalaryFilter]").val();
		var filterHTCV = $(".filterHTCV .chkCheckBox:checked").map(function(){
			return $(this).val();
		}).get().join(',');
		var BangCapFilter = $("input[name=BangCapFilter]").val();
		cLink += "&job=" + DMCVFilter + "&location=" + locationFilter + "&salary="+salary+"&HTCV="+filterHTCV+"&BangCap="+BangCapFilter+"&danhmuccv="+danhmuccv;
		setLinkFilter(cLink);
	})

	$(".filterBangCap .chkCheckBox").click(function(){
		var locationFilter = $("input[name=locationFilter]").val();
		var DMCVFilter = $("input[name=DMCVFilter]").val();
		var salary =  $("input[name=SalaryFilter]").val();
		var HTCVFilter = $("input[name=HTCVFilter]").val();
		var filterBangCap = $(".filterBangCap .chkCheckBox:checked").map(function(){
			return $(this).val();
		}).get().join(',');
		cLink += "&job=" + DMCVFilter + "&location=" + locationFilter + "&salary="+salary+"&HTCV="+HTCVFilter+"&BangCap="+filterBangCap+"&danhmuccv="+danhmuccv;
		setLinkFilter(cLink);
	})

	$("input[name=filterSalary]").click(function(){
		var salary =  $(this).val();
		var locationFilter = $("input[name=locationFilter]").val();
		var DMCVFilter = $("input[name=DMCVFilter]").val();
		var HTCVFilter = $("input[name=HTCVFilter]").val();
		var BangCapFilter = $("input[name=BangCapFilter]").val();
		cLink += "&job=" + DMCVFilter + "&location=" + locationFilter + "&salary="+salary+"&HTCV="+HTCVFilter+"&BangCap="+BangCapFilter+"&danhmuccv="+danhmuccv;
		setLinkFilter(cLink);
	})

	function setLinkFilter(vals){
		window.location.href = vals;
	}

	$(".resetFilter").click(function(){
		window.location.href = "<?php echo $_GET['params'] ?>.html";
	})
})
</script>