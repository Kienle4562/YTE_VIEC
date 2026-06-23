<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
include_once('com_company.models.php');
include_once('protected/paging.php');
$myprocess =  new process();
$myprocess_pager =  new Pager();
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
	'benhvien' => array('Bệnh viện', 'benh-vien.html'),
	'phongkham' => array('Phòng khám', 'phong-kham.html'),
	'congtyyte' => array('Công ty y tế', 'cong-ty-y-te.html'),
	// 'timtruongyvacosoytekhac' => array('Khác', 'tra-cuu-co-so-y-te.html'),
	// 'tatca' => array('Tất cả', 'tra-cuu-tat-ca-cty.html'),
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
$itemPerPage = 10;

/* phan trang */

if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);

$pager = $myprocess_pager->getPagerData( $totalrow, $itemPerPage, $currentPage, $__append . $_GET["params"] . $GLOBALS['EXT'] . "?key=".$activeTabSearch."&location=".$location."&" );  
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
					<div class="row" style="margin-top: 20px;">
						<div class="search-widget-area col-sm-12" id="search-box">
							<div class="col-sm-12">
								<!-- <img src='/images/test.jpg' style="max-width: 100%;"> -->
								<!-- <span>
									<div class="card-header">
										<h2>Khám phá công ty</h2>
									</div>
									
								</span> -->
								<ul class="nav nav-tabs m_bottom_5" style="">
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
																<input 
																name="search" type="text" 
																value="<?php echo $key ?>" 
																class="form-control search-all input-lg text-clip search-job-title tt-input" placeholder="Nhập từ khóa mà bạn cần tìm kiếm..." 
																style="position: relative; vertical-align: top;">
															</span>
														</span>
													</div>
												</div>
												<div class="col-sm-3 level-search-category">
													<div class="textbox">

														<span class="col-xs-12">
															<select style="height: 40px;" class="select-category" data-search-input-placeholder="Tìm kiếm địa điểm" name="location" data-placeholder="Chọn địa điểm làm việc">
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
									<?php }
									?>
									<!-- <span class="btn btn-primary" style="font-size: 15px; max-height: 40px; border-radius: 5px;">Công ty</span> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div id='loader' class="loading-process" style="display:none">
	<img src='/images/loading.gif'>
</div>
<div class="container" style="padding: 0;">
	<?php if($core_class->isMobile()){ ?>
		<div class="col-sm-12 col-md-3 col-filterJob2" style="display: block;">
			<div class="box-shadow super-search-filter">
				
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
									<div class="card-header" style="background: white; height: 90px; border-radius: 10px;">
										<h3 style="font-size: 24px; line-height: 60px; margin-left: 20px;">Kết Quả Tìm Kiếm</h2>
											<?php if($component == "benh-vien") : ?>
												<p style="margin-top:-20px; margin-left: 20px;">
													Có tổng cộng <span class="badge bg-success" style="background: red;color: white; font-weight:bold;"><?php echo $totalrow ?></span> Bệnh viện được tìm thấy
												</p>
											<?php elseif($component == "phong-kham") : ?>
													<p style="margin-top:-20px; margin-left: 20px;">
														Có tổng cộng <span class="badge bg-success" style="background: red;color: white; font-weight:bold;"><?php echo $totalrow ?></span> Phòng khám được tìm thấy
													</p>
											<?php elseif($component == "cong-ty-y-te") : ?>	
													<p style="margin-top:-20px; margin-left: 20px;">
														Có tổng cộng <span class="badge bg-success" style="background: red;color: white; font-weight:bold;"><?php echo $totalrow ?></span> Công ty y tế được tìm thấy
													</p>
											<?php endif; ?>
																				
									</div>

									<hr>
									<?php
										if ($totalrow > 0){
											
											$resultUngVien = $myprocess->get_list_company_fix($condition, intval($pager->offset), intval($pager->limit));
												while($row = $resultUngVien->fetch()){
													$link = $core_class->_removesigns($row["tencongty"])."-".$row["congty_id"]."-client.html";
													
											?>
												<div class="job-item">
													<div class="relative">
													<div class="row d-flex-sm job-item-fix">
														<div class="col-md-3 job-search__logo-col d-flex-center-sm companylogo">
															<div class="logo job-search__logo">
																<a>
																	<?php
																		$srcHinhanh = "/images/logo.png";
																		if(!empty($row["hinhanh"]) && strpos($row["hinhanh"], "noimage") == false){
																			$srcHinhanh = $row["hinhanh"];
																		}
																	?>
																	<img title="Y Tế Việc" class="img-responsive job-search-logo-fix" src="<?php echo $srcHinhanh ?>">
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
																		<strong title="<?php echo $row["diachicongty"] ?>"> 

																			<?php echo $row["diachicongty"] ?>
																				
																		</strong>
																	</span>
																</div>
																<?php if(!empty($row["sdthoai"])) { ?>
																<!--<div>
																	<span class="job-search__location gray-light">
																		<i class="fa fa-phone-square" aria-hidden="true"></i>
																		<strong title="Số điện thoại"> <?php echo $row["sdthoai"] ?></strong>
																	</span>
																</div>-->
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
			<!-- <span>
				Công Ty Hàng Đầu
			</span> -->
			<div class="box-shadow super-search-filter">
				<div class="FilterTTContent">
					<img src="https://i.imgur.com/sFypemy.png" width="280">
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


	$(document).ready(function(){
		
		$("#benhvien").click(function(){
			 $('#searchID').attr('action', 'benh-vien.html');
				$.ajax({
							url: "filtercompany",
							type: "POST",
							async: true,
							beforeSend: function(){
								// $("#loader").show();

								swal({
							       title: "Thành công", 

							       text: "Tra cứu thông tin hoàn tất", 

							       type: "success"
							     },

							   function(){ 

							      location.replace('benh-vien.html');
							      
							   });

							   },
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
							beforeSend: function(){
								// $("#loader").show();
								swal({
							       title: "Thành công", 

							       text: "Tra cứu thông tin hoàn tất", 

							       type: "success"
							     },

							   function(){ 

							      location.replace('phong-kham.html');

							   });
						   },
							data: {	
								act : "phongkham",
								case_mode: "Phòng khám"
							},
							success: function(returnHTML){
								$("#Load_list").html(returnHTML);
								loadLoaihinh('phongkham');
								// $("#loader").hide();

								// swal({

								// 	title: "Thành công",

								// 	text: "Đang hiển thị danh sách Phòng khám",

								// 	type: "success",			

								// })

								// location.replace('phong-kham.html');
								
							}

					})
		})
	
		$("#congtyyte").click(function(){
			 $('#searchID').attr('action', 'cong-ty-y-te.html');
						$.ajax({
							url: "filtercompany",
							type: "POST",
							async: true,
							beforeSend: function(){
								// $("#loader").show();

								swal({
							       title: "Thành công", 

							       text: "Tra cứu thông tin hoàn tất", 

							       type: "success"
							     },

							   function(){ 

							      location.replace('cong-ty-y-te.html');
							      
							   });

							   },
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
			$('#searchID').attr('action', 'nha-thuoc.html');
						$.ajax({
							url: "filtercompany",
							type: "POST",
							async: true,
							beforeSend: function(){
								$("#loader").show();
							   },
							data: {	
								act : "timtruongyvacosoytekhac",
								case_mode: "nhà thuốc"
							},
							success: function(returnHTML){
								$("#Load_list").html(returnHTML);
								loadLoaihinh('timtruongyvacosoytekhac');
								$("#loader").hide();

								// swal({

								// 	title: "Thành công",

								// 	text: "Tra cứu dữ liệu hoàn tất",

								// 	type: "success",			

								// })

								location.replace('nha-thuoc.html');
							}
					})
		})
		$("#tatca").click(function(){
			$('#searchID').attr('action', 'tra-cuu-tat-ca-cty.html');
						$.ajax({
							url: "filtercompany",
							type: "POST",
							async: true,
							beforeSend: function(){
								$("#loader").show();
							   },
							data: {	
								act : "tatca",
								case_mode: "Tất cả"
							},
							success: function(returnHTML){
								$("#Load_list").html(returnHTML);
								loadLoaihinh('tatca');
								$("#loader").hide();

								swal({

									title: "Thành công",

									text: "Tra cứu dữ liệu hoàn tất",

									type: "success",			

								})

								location.replace('tra-cuu-tat-ca-cty.html');
							}
					})
		})
	});
	
</script>