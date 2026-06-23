<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
include_once('com_company.models.php');
include_once('protected/paging.php');
$myprocess =  new process();
$component = $_GET['params'];
$companyType = array();
/* predefine something */
$condition = "";
if(!empty($_GET['location']))
{
	$location = $_GET['location'];
}
$key = "";
// 1: Phòng Khám Nha Khoa
// 2: Phòng Khám Đa Khoa
// 3: Phòng Khám Chuyên Khoa
// 4: Bệnh Viện Tư
// 5: Công Ty Dược
// 6: Công Ty Thiết Bị Y Tế
// 7: Spa & Thẩm Mỹ VIện
// 8: Bệnh viện công
// 9: Khác
$arrayTab = array(
	'benhvien' => array('Tìm bệnh viện', 'benh-vien.html'),
	'phongkham' => array('Tìm phòng khám', 'phong-kham.html'),
	'congtyyte' => array('Tìm công ty y tế', 'cong-ty-y-te.html'),
	'timtruongyvacosoytekhac' => array('Khác', 'tra-cuu-co-so-y-te.html'),
);
$activeTabSearch = "";
if ($component == "benh-vien"){
	$companyType = array("Bệnh viện");
	$companyTypeSearch = "4,8";
	$activeTabSearch = "benhvien";
}else if($component == "benh-vien-tu"){
	$companyType = array("Bệnh viện tư");
	$companyTypeSearch = "4";
	$activeTabSearch = "benhvien";
}else if($component == "benh-vien-cong"){
	$companyType = array("Bệnh viện công");
	$companyTypeSearch = "8";
	$activeTabSearch = "benhvien";
}else if($component == "phong-kham"){
	$companyType = array("phong kham");
	$companyTypeSearch = "1,2,3";
	$activeTabSearch = "phongkham";
}else if($component == "phong-kham-nha-khoa"){
	$companyType = array("nha khoa");
	$companyTypeSearch = "1";
	$activeTabSearch = "phongkham";
}else if($component == "cong-ty-duoc"){
	$companyType = array("Công Ty CP", "Công Ty CP Dược", "công ty dược");
	$companyTypeSearch = "5";
	$activeTabSearch = "congtyyte";
}else if($component == "cong-ty-thiet-bi-y-te"){
	$companyType = array("thiet bi");
	$companyTypeSearch = "6";
	$activeTabSearch = "congtyyte";
}else if($component == "cong-ty-y-te"){
	$companyType = array("cong ty");
	$companyTypeSearch = "5,6";
	$activeTabSearch = "congtyyte";
}else if($component == "phong-kham-da-khoa"){
	$companyType = array("đa khoa");
	$companyTypeSearch = "2";
	$activeTabSearch = "phongkham";
}else if($component == "phong-kham-chuyen-khoa"){
	$companyType = array("chuyên khoa");
	$companyTypeSearch = "3";
	$activeTabSearch = "phongkham";
}else if($component == "nha-thuoc"){
	$companyType = array("nhà thuốc", "nha thuoc");
	$companyTypeSearch = "10";
	$activeTabSearch = "timtruongyvacosoytekhac";
}else if($component == "spa-tham-my-vien"){
	$companyType = array("spa", "tham my");
	$companyTypeSearch = "7";
	$activeTabSearch = "timtruongyvacosoytekhac";
}else if($component == "tra-cuu-co-so-y-te"){
	$companyType = array("co so", "y te");
	$companyTypeSearch = "7,10,9";
	$activeTabSearch = "timtruongyvacosoytekhac";
}else{
	$companyType = array("Công ty");
	$companyTypeSearch = "7,10,9";
	$activeTabSearch = "congtyyte";
}

// sql cho checkbox filter theo tỉnh thành


/* get total row */
$idLoaihinh ="";
foreach($companyType as $valueSearch){
	if($valueSearch == "Bệnh viện tư")
	{
	  $condition ="AND trn_congty.loaihinhhoatdong_id = 4";
	 
	}else if($valueSearch == "Bệnh viện công")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id = 8";
	}else if($valueSearch == "Bệnh viện")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id in(4,8)";
	}
	else if($valueSearch == "phong kham")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id in(1,2,3)";
		
	}else if($valueSearch == "nha khoa")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id = 1";
	}else if($valueSearch == "đa khoa")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id = 2";
	}else if($valueSearch == "chuyên khoa")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id = 3";
	}else if($valueSearch == "Công ty" || $valueSearch == "cong ty" )
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id in(5,6)";
	}else if($valueSearch == "công ty dược")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id = 5";
	}else if($valueSearch == "thiet bi")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id = 6";
	}else if($valueSearch == "nha thuoc")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id = 10";
	}else if($valueSearch == "tham my")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id = 7";
	}
	else if($valueSearch == "y te")
	{
		$condition ="AND trn_congty.loaihinhhoatdong_id in(7,10,9)";
	}
}
	//$location = htmlentities($_request["location"], ent_quotes, "utf-8");
  if(!empty($_REQUEST["location"]) && $_REQUEST["location"] != -1 && empty($_REQUEST["search"]) && $_REQUEST["search"] == "")
	{
		//echo 'case 1 ' ;
	     $location = $_REQUEST["location"];
	     $condition .= " AND trn_congty.tinhthanh_id in($location)";
		//$condition .= "and trn_congty.loaihinhhoatdong_id in($companytypesearch)";
	
	}else if($_REQUEST["location"] == -1 && !empty($_REQUEST["search"]) && $_REQUEST["search"] != "")
	{
		 $condition .= " AND trn_congty.tencongty LIKE '%".$_REQUEST["search"]."%'";
		
	}else if($_REQUEST["location"] != -1 && !empty($_REQUEST["search"]) && $_REQUEST["search"] != "")
	{
		 $location = $_REQUEST["location"];
	     $condition .= " and trn_congty.tinhthanh_id in ($location)";
		 $condition .= " AND trn_congty.tencongty LIKE '%".$_REQUEST["search"]."%'"; 
	}
	
$totalrow = $myprocess->get_company_count($condition);

/* config items per page */
$itemPerPage = 12;

/* phan trang */

if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);

$pager = Pager::getPagerData( $totalrow, $itemPerPage, $currentPage, $__append . $_GET["params"] . $GLOBALS['EXT'] . "?key=".$activeTabSearch."&location=".$location."&" );  
$meta_title = $key == "" ? "Tất cả công việc có tại Y Tế Việc" : "Tìm kiếm việc làm với từ khóa \"$key\"";
	
	$sqlFilterTT = "
	SELECT
	COUNT(trn_congty.congty_id),
	mst_tinhthanh.id,
	mst_tinhthanh.ten_tinhthanh
	FROM
	mst_tinhthanh
	INNER Join trn_congty ON trn_congty.tinhthanh_id = mst_tinhthanh.id
	Left Join mst_loaihinhhoatdong ON mst_loaihinhhoatdong.loaihinhhoatdong_id = trn_congty.loaihinhhoatdong_id WHERE 1=1 ";
	$sqlFilterTT .= $condition;
	$sqlFilterTT .= " GROUP BY mst_tinhthanh.ten_tinhthanh ORDER BY mst_tinhthanh.DISORDER DESC";
//	echo $_GET["params"];
?>
<section id="ungvien">
	<div id="search-widget-wrapper">
		<div id="search-widget" class="collapse m-t-md in">
			<div class="search-form container">
				<div class="bg-blue">
					<div class="row">
						<div class="search-widget-area col-sm-12" id="search-box">
							<div class="col-sm-12">
								<ul class="nav nav-tabs m_bottom_5">
									<?php
										foreach($arrayTab as $tab => $valueTab){
											$active = "";
											if($tab == $activeTabSearch){
												$active = "active";
											}else{
												$active = "";
											}
									?>
									<li class="<?php echo $active ?>">
										<a data-toggle="tab" href="#<?php echo $tab ?>" id="<?php echo $tab ?>"><?php echo $valueTab[0] ?></a>
									</li>
									<?php
										}
									?>
								</ul>
								<div class="tab-content">
									<?php
										foreach($arrayTab as $tab => $valueTab){
											$active = "";
											if($tab == $activeTabSearch){
												$active = "active";
											}else{
												$active = "";
											}
									?>
									<div id="<?php echo $tab ?>" class="tab-pane fade in <?php echo $active ?>">
										<form method="GET" id="searchID" action="<?php echo $valueTab[1] ?>">
											<input name="key" type="hidden" value="<?= $activeTabSearch?>">
											<div class="row">
												<div class="col-sm-7 keyword-search-wrapper">
													<div class="textbox">
														<span class="col-xs-12 no-padding">
															<span class="twitter-typeahead">
																<input name="search" type="text" value="<?php echo $key ?>" class="form-control search-all input-lg text-clip search-job-title tt-input" placeholder="Nhập từ khóa mà bạn cần tìm kiếm..." style="position: relative; vertical-align: top;">
															</span>
														</span>
													</div>
												</div>
												<div class="col-sm-3 level-search">
													<div class="textbox">
														<span class="col-xs-12 no-padding">
															<select class="selectpicker" data-live-search="true" name ="location">
																<option value="-1">Tất cả</option>
																<?php
																  
																	$result = $myprocess->getTinhThanh();
																	while($row = $result->fetch()){
																		$selected = '';
																		if(strlen($_REQUEST['location']) == 2){
																			if($_REQUEST["location"] == $row["id"]){
																				$selected = 'selected';
																			}
																		}
																?>
																	<option <?php echo $selected ?> value="<?php echo $row["id"] ?>"><?php echo $row["ten_tinhthanh"] ?></option>
																<?php
																	}
																?>
															</select>
														</span>
													</div>
												</div>
												<div class="col-sm-2">
													<button class="btn-search btn btn-lg btn-primary" type="submit">
														<i></i>
														Tìm kiếm
													</button>
												</div>
											</div>
										</form>
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
</section>
<div class="container" style="padding: 0;">
	<?php if($core_class->isMobile()){ ?>
		<div class="col-sm-12 col-md-3 col-filterJob2" style="display: block;">
			<div class="box-shadow super-search-filter">
				<div class="FilterTTContent">
					<h5 class="ais-header">
						Loại hình hoạt động
					</h5>
					<div id="loaihinhLoad" class="ais-refinement-list" style="overflow: hidden;">
						<ul style="height: 80px;overflow: hidden;" class="filterTT2">
						  <?php if($_REQUEST['key'] =='benhvien' || $_REQUEST['key'] =='benhvien-1' || $_REQUEST['key'] =='benhvien-2' ) {
							 
							  // mst_loaihinhhoatdong 4: bệnh viện tư
								$resultBVtu = $myprocess -> checkCongty(4);
								  $rowBVtu = $resultBVtu->fetch();
								 // mst_loaihinhhoatdong 4: bệnh viện công
								$resultBVCong = $myprocess -> checkCongty(8); 
								$rowBVCong = $resultBVCong->fetch();
								
						  ?>

							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>benh-vien-tu.html?key=benhvien-1'" type="checkbox" <?php if($_REQUEST['key'] =='benhvien-1'){ echo 'checked';} ?> value="1" class="chkCheckBox "> Bệnh viện tư<span> (<?php echo $rowBVtu['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>benh-vien-cong.html?key=benhvien-2'" type="checkbox" <?php if($_REQUEST['key'] =='benhvien-2'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Bệnh viện Công<span> (<?php echo $rowBVCong['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/benh-vien.html?key=benhvien'" type="checkbox" value="50" class="chkCheckBox "> Danh sách bệnh viện<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
						  <?php }else if($_REQUEST['key'] =='phongkham' || $_REQUEST['key'] =='phongkham-1' || $_REQUEST['key'] =='phongkham-2' || $_REQUEST['key'] =='phongkham-3') {
							   // 1 : nha khoa , 2: đa khoa, ,3 chuyen khoa
								  $resultDakhoa = $myprocess -> checkCongty(2);
								  $rowDK = $resultDakhoa->fetch();
								 // mst_loaihinhhoatdong 4: bệnh viện công
								  $resultNK = $myprocess -> checkCongty(8); 
								  $rowNK	  = $resultNK->fetch();
								  
								  $resultCK = $myprocess -> checkCongty(8); 
								  $rowCK	  = $resultCK->fetch();
							  ?>
							<!-- <li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/phong-kham.html?key=phongkham'" type="checkbox" value="1" class="chkCheckBox ">Phòng khám<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>phong-kham-nha-khoa.html?key=phongkham-1'" type="checkbox" <?php if($_REQUEST['key'] =='phongkham-1'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Phòng Khám Nha Khoa<span> (<?php echo $rowNK['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>phong-kham-da-khoa.html?key=phongkham-2'" type="checkbox" <?php if($_REQUEST['key'] =='phongkham-2'){ echo 'checked';} ?> value="50" class="chkCheckBox ">  Phòng Khám Đa Khoa<span> (<?php echo $rowDK['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>phong-kham-chuyen-khoa.html?key=phongkham-3'" type="checkbox" <?php if($_REQUEST['key'] =='phongkham-3'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Phòng Khám Chuyên Khoa<span> (<?php echo $rowCK['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/phong-kham.html?key=phongkham'" type="checkbox" value="50" class="chkCheckBox "> Danh Sách Phòng Khám<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
						  <?php }else if($_REQUEST['key'] =='congtyyte' || $_REQUEST['key'] =='congtyyte-1' || $_REQUEST['key'] =='congtyyte-2') { 
									// 5: cty duoc
								  $result_ctDuoc = $myprocess -> checkCongty(5);
								  $rowDuoc = $result_ctDuoc->fetch();
								 // mst_loaihinhhoatdong 4: bệnh viện công
								  $resultTBYT = $myprocess -> checkCongty(6); 
								  $rowTBYT	  = $resultTBYT->fetch();
						  ?>
							<!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/cong-ty.html?key=congtyyte'" type="checkbox" value="1" class="chkCheckBox "> Công Ty<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>cong-ty-duoc.html?key=congtyyte-1'" type="checkbox" <?php if($_REQUEST['key'] =='congtyyte-1'){ echo 'checked';} ?>  value="50" class="chkCheckBox "> Công Ty Dược<span> (<?php echo $rowDuoc['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>cong-ty-thiet-bi-y-te.html?key=congtyyte-2'" type="checkbox" <?php if($_REQUEST['key'] =='congtyyte-2'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Công Ty Thiết Bị Y Tế<span> (<?php echo $rowTBYT['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/cong-ty-y-te.html?key=congtyyte'" type="checkbox" value="50" class="chkCheckBox "> Danh Sách Công Ty Y Tế<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
						   <?php }else if($_REQUEST['key'] =='timtruongyvacosoytekhac' || $_REQUEST['key'] =='timtruongyvacosoytekhac-1'|| $_REQUEST['key'] =='timtruongyvacosoytekhac-2') {
							   
							   $resultnhathuoc = $myprocess -> checkCongty(10); 
								  $rowNT	  = $resultnhathuoc->fetch();
								$resultSPA = $myprocess -> checkCongty(7); 
								  $rowSPA	  = $resultSPA->fetch();
							   ?>
						   <!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/tra-cuu-co-so-y-te.html?key=timtruongyvacosoytekhac'" type="checkbox" value="1" class="chkCheckBox ">Khác<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>nha-thuoc.html?key=timtruongyvacosoytekhac-1'" type="checkbox" <?php if($_REQUEST['key'] =='timtruongyvacosoytekhac-1'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Nhà Thuốc<span> (<?php echo $rowNT['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>spa-tham-my-vien.html?key=timtruongyvacosoytekhac-2'" type="checkbox" <?php if($_REQUEST['key'] =='timtruongyvacosoytekhac-2'){ echo 'checked';} ?>  value="50" class="chkCheckBox "> Spa & Thẩm Mỹ Viện<span> (<?php echo $rowSPA['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/tra-cuu-co-so-y-te.html?key=timtruongyvacosoytekhac'" type="checkbox" value="50" class="chkCheckBox "> Tra Cứu Cơ Sở Y Tế<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
						  <?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<hr class="style-two">
			
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
			</div>
		</div>
	<?php } ?>
	
	
	<div id="main-career-list" class="job-search__main-job-list col-md-9">
		<div class="job-search-body" title="">
			<div class="job-list job-list-page_boxed">
				<div id="job-list">
					<div class="ais-hits">
						<div class="job-list" id="job-list">
							<div class="box p-t-none p-b-none top-level-job-list">
								<div class="box-top-level clearfix" id="Load_list">
									<?php
										if ($totalrow > 0){
											
											$resultUngVien = $myprocess->get_list_company_fix($condition, intval($pager->offset), intval($pager->limit));
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
																<div>
																	<span class="job-search__location gray-light">
																		<i class="fa fa-phone-square" aria-hidden="true"></i>
																		<strong title="Số điện thoại"> <?php echo $row["sdthoai"] ?></strong>
																	</span>
																</div>
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
	<?php if(!$core_class->isMobile()){ ?>
		<div class="col-sm-12 col-md-3 col-filterJob" style="display: block;">
			<div class="box-shadow super-search-filter">
				<div class="FilterTTContent">
					<h5 class="ais-header">
						Loại hình hoạt động
					</h5>
					<div id="loaihinhLoad" class="ais-refinement-list" style="overflow: hidden;">
						<ul style="height: 80px;overflow: hidden;" class="filterTT2">
						  <?php if($_REQUEST['key'] =='benhvien' || $_REQUEST['key'] =='benhvien-1' || $_REQUEST['key'] =='benhvien-2' ) {
							 
							  // mst_loaihinhhoatdong 4: bệnh viện tư
								$resultBVtu = $myprocess -> checkCongty(4);
								  $rowBVtu = $resultBVtu->fetch();
								 // mst_loaihinhhoatdong 4: bệnh viện công
								$resultBVCong = $myprocess -> checkCongty(8); 
								$rowBVCong = $resultBVCong->fetch();
								
						  ?>

							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>benh-vien-tu.html?key=benhvien-1'" type="checkbox" <?php if($_REQUEST['key'] =='benhvien-1'){ echo 'checked';} ?> value="1" class="chkCheckBox "> Bệnh viện tư<span> (<?php echo $rowBVtu['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>benh-vien-cong.html?key=benhvien-2'" type="checkbox" <?php if($_REQUEST['key'] =='benhvien-2'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Bệnh viện Công<span> (<?php echo $rowBVCong['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/benh-vien.html?key=benhvien'" type="checkbox" value="50" class="chkCheckBox "> Danh sách bệnh viện<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
						  <?php }else if($_REQUEST['key'] =='phongkham' || $_REQUEST['key'] =='phongkham-1' || $_REQUEST['key'] =='phongkham-2' || $_REQUEST['key'] =='phongkham-3') {
							   // 1 : nha khoa , 2: đa khoa, ,3 chuyen khoa
								  $resultDakhoa = $myprocess -> checkCongty(2);
								  $rowDK = $resultDakhoa->fetch();
								 // mst_loaihinhhoatdong 4: bệnh viện công
								  $resultNK = $myprocess -> checkCongty(8); 
								  $rowNK	  = $resultNK->fetch();
								  
								  $resultCK = $myprocess -> checkCongty(8); 
								  $rowCK	  = $resultCK->fetch();
							  ?>
							<!-- <li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/phong-kham.html?key=phongkham'" type="checkbox" value="1" class="chkCheckBox ">Phòng khám<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>phong-kham-nha-khoa.html?key=phongkham-1'" type="checkbox" <?php if($_REQUEST['key'] =='phongkham-1'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Phòng Khám Nha Khoa<span> (<?php echo $rowNK['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>phong-kham-da-khoa.html?key=phongkham-2'" type="checkbox" <?php if($_REQUEST['key'] =='phongkham-2'){ echo 'checked';} ?> value="50" class="chkCheckBox ">  Phòng Khám Đa Khoa<span> (<?php echo $rowDK['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>phong-kham-chuyen-khoa.html?key=phongkham-3'" type="checkbox" <?php if($_REQUEST['key'] =='phongkham-3'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Phòng Khám Chuyên Khoa<span> (<?php echo $rowCK['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/phong-kham.html?key=phongkham'" type="checkbox" value="50" class="chkCheckBox "> Danh Sách Phòng Khám<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
						  <?php }else if($_REQUEST['key'] =='congtyyte' || $_REQUEST['key'] =='congtyyte-1' || $_REQUEST['key'] =='congtyyte-2') { 
									// 5: cty duoc
								  $result_ctDuoc = $myprocess -> checkCongty(5);
								  $rowDuoc = $result_ctDuoc->fetch();
								 // mst_loaihinhhoatdong 4: bệnh viện công
								  $resultTBYT = $myprocess -> checkCongty(6); 
								  $rowTBYT	  = $resultTBYT->fetch();
						  ?>
							<!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/cong-ty.html?key=congtyyte'" type="checkbox" value="1" class="chkCheckBox "> Công Ty<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>cong-ty-duoc.html?key=congtyyte-1'" type="checkbox" <?php if($_REQUEST['key'] =='congtyyte-1'){ echo 'checked';} ?>  value="50" class="chkCheckBox "> Công Ty Dược<span> (<?php echo $rowDuoc['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>cong-ty-thiet-bi-y-te.html?key=congtyyte-2'" type="checkbox" <?php if($_REQUEST['key'] =='congtyyte-2'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Công Ty Thiết Bị Y Tế<span> (<?php echo $rowTBYT['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/cong-ty-y-te.html?key=congtyyte'" type="checkbox" value="50" class="chkCheckBox "> Danh Sách Công Ty Y Tế<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
						   <?php }else if($_REQUEST['key'] =='timtruongyvacosoytekhac' || $_REQUEST['key'] =='timtruongyvacosoytekhac-1'|| $_REQUEST['key'] =='timtruongyvacosoytekhac-2') {
							   
							   $resultnhathuoc = $myprocess -> checkCongty(10); 
								  $rowNT	  = $resultnhathuoc->fetch();
								$resultSPA = $myprocess -> checkCongty(7); 
								  $rowSPA	  = $resultSPA->fetch();
							   ?>
						   <!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/tra-cuu-co-so-y-te.html?key=timtruongyvacosoytekhac'" type="checkbox" value="1" class="chkCheckBox ">Khác<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>nha-thuoc.html?key=timtruongyvacosoytekhac-1'" type="checkbox" <?php if($_REQUEST['key'] =='timtruongyvacosoytekhac-1'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Nhà Thuốc<span> (<?php echo $rowNT['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='<?php echo $index;?>spa-tham-my-vien.html?key=timtruongyvacosoytekhac-2'" type="checkbox" <?php if($_REQUEST['key'] =='timtruongyvacosoytekhac-2'){ echo 'checked';} ?>  value="50" class="chkCheckBox "> Spa & Thẩm Mỹ Viện<span> (<?php echo $rowSPA['congty']; ?>)</span>
								</label>
								<!--<span class="f_right">(0)</span>-->
							</li>
							<!--<li>
								<label class="m-checkbox">
									<input onchange="window.location.href='http://yteviec.com/tra-cuu-co-so-y-te.html?key=timtruongyvacosoytekhac'" type="checkbox" value="50" class="chkCheckBox "> Tra Cứu Cơ Sở Y Tế<span></span>
								</label>
								<span class="f_right">(0)</span>
							</li>-->
						  <?php } ?>
						</ul>
					</div>
				</div>
			</div>
			<hr class="style-two">
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
			</div>
			
		</div>
		
		<!--- Search ----->
		
	<?php } ?>
	<input type="hidden" value="<?php echo $activeTabSearch ?>" name="keyloaihinh" id="keyloaihinh">
</div>
<script>

function loadLoaihinh(typePack){
	
	//alert(typePack);
	$.ajax({
		url: "filtercompany",
		async: true,
		type: "POST",
		data: {
			act: "loaihinhhoatdong",
			typePack: typePack
		},
		success: function(resultHTML){
			$("#loaihinhLoad").html(resultHTML);
			$("#keyloaihinh").val(typePack);
		}
	})
}

var style = $(".filterTT").attr('style');
var numDisp = 7;
var numLi = $(".filterTT li").length;
var heightDiv = $(".m-checkbox-inline").height() / numDisp;
$(function(){
	var mCheckboxLnline = $(".m-checkbox-inline").height();
	if($(".m-checkbox-inline").html() == ""){
		$(".FilterTTContent").remove();
	}else{
		filterTT();
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

	function filterTT(){
		var heightCBList = $(".filterTT").height();
		var filterTT = $(".filterTT");
		var locationFilter = $("input[name=locationFilter]");
		var arrayLF = locationFilter.val().split(",");
		arrayLF.forEach(function(val){
			$(".filterTT .chkCheckBox[value='"+val+"']").prop('checked', true);
		})
		if(!locationFilter.val()){
			filterTT.attr('style', style);
			$(".shortcut").hide();
		}
		if(mCheckboxLnline < heightCBList){
			$(".filterTT").removeAttr('style');
			$('.showlocation').hide();
		}
	}
	$(".filterTT .chkCheckBox").click(function(){
		var keyLHHD =  $('#keyloaihinh').val();
		var locationFilter = $(".filterTT .chkCheckBox:checked").map(function(){
			return $(this).val();
		}).get().join(',');
		window.location.href = "<?php echo $_GET['params'] ?>.html?key="+keyLHHD+"&location=" + locationFilter;
	})

	$(".resetFilter").click(function(){
		window.location.href = "<?php echo $_GET['params'] ?>.html";
	})
})

	$(document).ready(function(){
		
		$("#benhvien").click(function(){
			 $('#searchID').attr('action', 'benh-vien.html');
				$.ajax({
							url: "filtercompany",
							type: "POST",
							async: true,
							data: {	
								act : "benhvien",
								case_mode: "Bệnh viện"
							},
							success: function(returnHTML){
								$("#Load_list").html(returnHTML);
								loadLoaihinh('benhvien');
							}
					})
		})
		$("#phongkham").click(function(){
				 $('#searchID').attr('action', 'phong-kham.html');
					$.ajax({
							url: "filtercompany",
							type: "POST",
							async: true,
							data: {	
								act : "phongkham",
								case_mode: "Phòng khám"
							},
							success: function(returnHTML){
								$("#Load_list").html(returnHTML);
								loadLoaihinh('phongkham');
							}
					})
		})
	
		$("#congtyyte").click(function(){
			 $('#searchID').attr('action', 'cong-ty-y-te.html');
						$.ajax({
							url: "filtercompany",
							type: "POST",
							async: true,
							data: {	
								act : "congtyyte",
								case_mode: "Công ty dược"
							},
							success: function(returnHTML){
								$("#Load_list").html(returnHTML);
								loadLoaihinh('congtyyte');
							}
					})
		})
		$("#timtruongyvacosoytekhac").click(function(){
			$('#searchID').attr('action', 'cong-ty-y-te.html');
						$.ajax({
							url: "filtercompany",
							type: "POST",
							async: true,
							data: {	
								act : "timtruongyvacosoytekhac",
								case_mode: "nhà thuốc"
							},
							success: function(returnHTML){
								$("#Load_list").html(returnHTML);
								loadLoaihinh('timtruongyvacosoytekhac');
							}
					})
		})
	});
	
</script>