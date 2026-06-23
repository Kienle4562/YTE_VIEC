<?php defined( '_VALID_MOS' ) or die( include("404.php") );?>
<?php
	$searchKey = "";
	if(!empty($_REQUEST["date"])){
		$searchKey .= $_REQUEST["date"];
	}
			$trang_thai = " ";
			$tu_ngay = " ";
			$den_ngay = " ";
			$urlRect = "";
			if(isset($_REQUEST["status"]) && is_numeric($_REQUEST["status"])){
				$trang_thai = $_REQUEST["status"];
				$urlRect .="&status=".$trang_thai."";	
			}
			if(isset($_REQUEST["user"])){
				$user = $_REQUEST["user"];
				$urlRect .="&user=".$user."";	
			}
			if(isset($_REQUEST["tu_ngay"])){
				$tu_ngay = $_REQUEST["tu_ngay"];
				$urlRect .="&tu_ngay=".$tu_ngay."";	
			}
			if(isset($_REQUEST["den_ngay"])){
				$den_ngay = $_REQUEST["den_ngay"];
				$urlRect .="&den_ngay=".$den_ngay."";	
			}
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							<?php echo $title ?>
							<small>
								<?php echo $mota ?>
							</small>
						</h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						<li class="m-portlet__nav-item">
							<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
								<a href="javascript:void(0)" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
									<i class="la la-gear m--font-brand"></i>
								</a>
								<div class="m-dropdown__wrapper">
									<span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="m-nav">
													<li class="m-nav__section m-nav__section--first">
														<span class="m-nav__section-text">
															CÔNG CỤ
														</span>
													</li>
													<li class="m-nav__item">
														<a href="javascript:void(0)" class="m-nav__link">
															<i class="m-nav__link-icon fa fa-plus"></i>
															<span onclick="openFormInsert()" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_ThemMoi" class="m-nav__link-text">
																Thêm mới
															</span>
														</a>
													</li>
														<?php if($_SESSION["session"]['Id'] == 4){?>
														<li class="m-nav__item">
															<a href="javascript:void(0)" class="m-nav__link">
																<i class="m-nav__link-icon fa fa-remove"></i>
																<span id="btnDeleteData" class="m-nav__link-text">
																	Xóa nhiều
																</span>
															</a>
															
														</li>
													<?php } ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
					
					
					
				</div>
			</div>
			<div class="m-portlet__body">
				<!--begin: Search Form -->
				<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
					<div class="row align-items-center">
						<div class="col-xl-3 order-2 order-xl-1">
						<div class="form-group m-form__group row align-items-center headTool">
								<div class="col-md-12">
									<div class="m-input-icon m-input-icon--left">
										<input type="text" class="form-control m-input" placeholder="Tìm kiếm..." id="generalSearch">
										<span class="m-input-icon__icon m-input-icon__icon--left">
											<span>
												<i class="la la-search"></i>
											</span>
										</span>
									</div>
								</div>
							</div>
							<div class="d-md-none m--margin-bottom-10"></div>
						</div>
								<div class="col-xl-3 order-2 order-xl-1">
									<div style="margin-bottom: 6px;" class="m-form__group m-form__group--inline w_full">
										<div class="m-form__label wp40">
											<label style="width: 80px;">
												Từ ngày
											</label>
										</div>
										<div class="m-form__control">
											<input class="form-control w_full datepickerCSS" id="tu_ngay" name="tu_ngay" type="text" value="<?php echo $_REQUEST["tu_ngay"] ?>">
										</div>
									</div>
									<div class="d-md-none m--margin-bottom-10"></div>
								</div>
								<div class="col-xl-3 order-2 order-xl-1">
									<div style="margin-bottom: 6px;" class="m-form__group m-form__group--inline w_full">
										<div class="m-form__label wp40">
											<label style="width: 80px;">
												Đến ngày
											</label>
										</div>
										<div class="m-form__control">
											<input class="form-control w_full datepickerCSS" id="den_ngay" name="den_ngay" type="text" value="<?php echo $_REQUEST["den_ngay"] ?>">
										</div>
									</div>
									<div class="d-md-none m--margin-bottom-10"></div>
								</div>
								<div class="col-xl-3 order-2 order-xl-1">
									<div class="m-form__group m-form__group--inline w_full">
										<button class="Customer_Search btn btn-brand m-btn m-btn--icon m-btn--air">
											<span>
												<i class="flaticon-search-magnifier-interface-symbol"></i>
												<span>
													LỌC KẾT QUẢ
												</span>
											</span>
										</button>	
									</div>
									<div class="d-md-none m--margin-bottom-10"></div>
								</div>
					</div>
				</div>
				<!--end: Search Form -->
				<!--begin: Datatable -->
				  <div class="ketqua"> 
					<?php
						/*if(!empty($_REQUEST['user']))
						{
								$wherePT = "INNER JOIN trn_congviec cv ON tu.congviec_id = cv.congviec_id
									INNER JOIN trn_congty ct ON ct.congty_id = cv.congty_id
									WHERE  ct.congty_id = ".$_REQUEST['user']."
									GROUP BY ct.congty_id";
							$CheckCount_PT = $core_class->countColumnInTable("trn_ungtuyen tu",'ct.tencongty',$wherePT);
							echo " Có : <span class='m-badge m-badge--danger'> ".intval($CheckCount_PT) . " </span> ứng tuyển";
						}*/
					?>
				  </div>
				<div class="m_datatable" id="local_record_selection"></div>
				<!--end: Datatable -->
			</div>
		</div>
	</div>
</div>

	<?php 
		// Tạo modal form thêm mới và chỉnh sửa
		$core_class->createForm($db_name, $title, "modal-slg", 4);
	?>

<!-- Library JS -->
<script>

var DatatableRecordSelection = function() {
	var options = {
		data: {
			type: 'remote',
			source: {
				read: {
					url: 'Model_<?php echo $com_name ?>.ajax?act=LoadList<?php echo urldecode($urlRect) ?>',
				},
			},
			pageSize: 10,
			serverPaging: false,
			serverFiltering: false,
			serverSorting: false,
		},

		// layout definition
		layout: {
			theme: 'default', // datatable theme
			class: '', // custom wrapper class
			scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
			height: 550, // datatable's body's fixed height
			footer: false // display/hide footer
		},
		// column sorting
		sortable: true,
		pagination: true,
		// columns definition
		columns: [
			{
				field: 'profilecv_id',
				title: 'ID Profile',
				width: 110
			},{
				field: 'tenprofilecv',
				title: 'Tên profile',
				width: 140
			},
			{
				field: 'lastname',
				title: 'Họ tên',
				width: 140
			}, {
				field: 'gender',
				title: 'Giới tính',
				width: 140
			}
			, {
				field: 'email',
				title: 'Email',
				width: 140
			}
			, {
				field: 'mobile',
				title: 'Số điện thoại',
				width: 140
			}, {
				field: 'capbacmongmuon',
				title: 'Cấp bậc mong muốn',
				width: 140,
				
			}
			,{
				field: 'loai_cv',
				title: 'Loại CV',
				width: 140
			},{
				field: 'ngaytao',
				title: 'Ngày tạo',
				width: 140
			}],
	};

	var localSelector = function() {

		options.search = {
			input: $('#generalSearch'),
		};

		var datatable = $('#local_record_selection').mDatatable(options);

		datatable.on('m-datatable--on-check m-datatable--on-uncheck m-datatable--on-layout-updated', function(e) {
			var checkedNodes = datatable.rows('.m-datatable__row--active').nodes();
			var count = checkedNodes.length;
			$('#m_datatable_selected_number').html(count);
			if (count > 0) {
				$('#m_datatable_group_action_form').collapse('show');
			} else {
				$('#m_datatable_group_action_form').collapse('hide');
			}
		});

		$('#btnExportExcel').on('click', function(e) {
			var ids = datatable.rows('.m-datatable__row--active').
				nodes().
				find('.m-checkbox--single > [type="checkbox"]').
				map(function(i, chk) {
					return $(chk).val();
				});
			for (var i = 0; i < ids.length; i++) {
				alert(ids[i]);
			}
		});
		
		$('#btnDeleteData').on('click', function(e) {
			var ids = datatable.rows('.m-datatable__row--active').
				nodes().
				find('.m-checkbox--single > [type="checkbox"]').
				map(function(i, chk) {
					return $(chk).val();
				});
			var array = $.map(ids, function(value, index) {
				return [value];
			});
			if(array.length > 0){
				deleteData(array, '<?php echo $com_name ?>');
			}else{
				toastr["warning"]("Bạn chưa chọn vào mục nào", "Lỗi");
			}
		});

	};
	return {
		// public functions
		init: function() {
			localSelector();
		},
	};
}();
jQuery(document).ready(function() {
	DatatableRecordSelection.init();
	$('#btnInsert').click(function(event){
		insertData(event, '<?php echo $com_name ?>', this.id);
	});
	
	$('#btnUpdate').click(function(event){
		updateData(event, '<?php echo $com_name ?>', this.id);
	});
	
	$('#formDataInsert input[type=file]').on('change', function(event){
		uploadImage(event, '<?php echo $com_name ?>', this.id, 0);
	});
	
	$('#formDataUpdate input[type=file]').on('change', function(event){
		uploadImage(event, '<?php echo $com_name ?>', this.id, 1);
	});

	$("input:invalid").on("keyup", function(){
		$("input:valid").next("p.has-error").empty();
	})
});
function filter(){
	var StatusUser = $("select#fillterUser").val();
	var filter_tu_ngay = $("#tu_ngay").val();
	var filter_den_ngay = $("#den_ngay").val();
	var link = window.location.pathname;
	var url = window.location.protocol + "//" + window.location.hostname + link + "?";
		if(StatusUser != "" && typeof StatusUser != "undefined"){ url += "&user=" + StatusUser};
		if(filter_tu_ngay != ""){ url += "&tu_ngay=" + filter_tu_ngay};
		if(filter_den_ngay != ""){ url += "&den_ngay=" + filter_den_ngay};
	window.location = url;
}
$(document).ready(function() {
		$(".Customer_Search").click(function () {
			filter();
		});
    	$('#tu_ngay').datepicker({
					format: 'dd/mm/yyyy',
					todayBtn: "linked",
					clearBtn: true,
					todayHighlight: true,
					autoclose: true,
					templates: {
						leftArrow: '<i class="la la-angle-left"></i>',
						rightArrow: '<i class="la la-angle-right"></i>'
					}
				});
				$('#den_ngay').datepicker({
					format: 'dd/mm/yyyy',
					todayBtn: "linked",
					clearBtn: true,
					todayHighlight: true,
					autoclose: true,
					templates: {
						leftArrow: '<i class="la la-angle-left"></i>',
						rightArrow: '<i class="la la-angle-right"></i>'
					}
				});

});
</script>