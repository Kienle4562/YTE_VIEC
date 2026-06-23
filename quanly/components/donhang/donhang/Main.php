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
															<span onclick="showDialogInsert()" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_ThemMoi" class="m-nav__link-text">
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
					<button onclick="showDialogInsert(this)" class="btn headTool  btn-danger m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_ThemMoi">
								<span>
									<i class="la la-cart-plus"></i>
									<span>
										Thêm mới
									</span>
								</span>
					</button>
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
					
				</div>
			</div>
			<div class="m-portlet__body">
				<!--begin: Search Form -->
				<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
					<div class="row align-items-center">
						<div class="col-xl-3 order-2 order-xl-1">
							<?php if($_SESSION["session"]['Id'] == 4) { ?>
						<div class="form-group m-form__group row align-items-center headTool">
								<div class="col-md-12">
									
									<div class="m-input-icon m-input-icon--left">
										<?php
										$sql = "
											SELECT  
											 	tentrangthai as trangthai,
												CASE 
													WHEN tentrangthai = 0 Then 'Chưa duyệt'
													WHEN tentrangthai = 1 Then 'Đã duyệt'
												END tentrangthai
											FROM mst_trangthai";
										$row = $core_class->getValueFrom3($sql);
									?>
									<select id="fillterStatus" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true">
										<option value=""> -- Tất cả --</option>
										<?php
											foreach($row as $key){
												if($_REQUEST["trangthai"] == $key['trangthai']){
													$selected = 'selected="selected"';
												}else{
													$selected = "";
												}
												echo '<option '.$selected.' value="'.$key['trangthai'].'">'.$key['tentrangthai'].'</option>';
											}
										?>
									</select>
									</div>
								</div>
								
					</div>
							<?php }else{ ?>
							<div class="m-form__group m-form__group--inline">
								<div class="m-form__label">
									<label style="width: 80px;">
										Trạng thái:
									</label>
								</div>
								<div class="m-form__control">
									<?php
										$sql = "
											SELECT  
											 	tentrangthai as trangthai,
												CASE 
													WHEN tentrangthai = 0 Then 'Chưa duyệt'
													WHEN tentrangthai = 1 Then 'Đã duyệt'
												END tentrangthai
											FROM mst_trangthai";
										$row = $core_class->getValueFrom3($sql);
									?>
									<select id="fillterStatus" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true">
										<option value="">Tất cả</option>
										<?php
											foreach($row as $key){
												if($_REQUEST["trangthai"] == $key['trangthai']){
													$selected = 'selected="selected"';
												}else{
													$selected = "";
												}
												echo '<option '.$selected.' value="'.$key['trangthai'].'">'.$key['tentrangthai'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<input type="hidden" value="<?php echo $_SESSION["session"]['Id'] ?>" id="fillterUser">
							<?php } ?>
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
				<div class="m_datatable" id="local_record_selection"></div>
				<!--end: Datatable -->
			</div>
		</div>
	</div>
</div>
<!-- Library JS -->

	<div class="modal fade" id="Dialog_ThemMoi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-slg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">THÊM ĐƠN HÀNG</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="loadContentAdd"></div>
				<div class="modal-footer">
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" id="btnInsert" type="button">
						<i class="fa fa-print"></i> Lưu
					</button>
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning Close" data-dismiss="modal" type="button">
						<i class="fa fa-ban"></i> Hủy bỏ
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="Dialog_CapNhat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-slg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">KÍCH HOẠT DỊCH VỤ</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="loadContentEdit"></div>
				<div class="modal-footer">
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" id="btnUpdate" type="button">
						<i class="fa fa-print"></i> Lưu
					</button>
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning Close" data-dismiss="modal" type="button">
						<i class="fa fa-ban"></i> Hủy bỏ
					</button>
				</div>
			</div>
		</div>
	</div>
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
		sortable: false,
		pagination: true,
		// columns definition
		columns: [
			{
				field: 'customer_id',
				title: '#',
				sortable: false,
				width: 40,
				textAlign: 'center',
				selector: {class: 'm-checkbox--solid m-checkbox--brand'},
			},{
				field: 'ma_don_hang',
				title: 'Mã đơn hàng',
				width: 140
			}, {
				field: 'ma_giam',
				title: 'Mã giảm',
				width: 140
			}
			, {
				field: 'giam_km',
				title: 'Số tiền giảm',
				width: 140
			}
			, {
				field: 'ten_cong_ty',
				title: 'Tên công ty',
				width: 140
			},{
				field: 'email_cong_ty',
				title: 'Email đăng ký',
				width: 140
			},{
				field: 'tong_tien',
				title: 'Thành tiền ( VNĐ )',
				width: 140
			}
			,{
				field: 'ngaydangky',
				title: 'Ngày đăng ký',
				width: 140
			},{
				field: 'ngaykichhoat',
				title: 'Ngày kích hoạt',
				width: 140
			},{
				field: 'ngayhethan',
				title: 'Ngày hết hạn',
				width: 140
			},{
				field: 'trangthai',
				title: 'Trạng thái',
				width: 140,
				template: function(row) {
					var status = {
						0: {'title': 'Chưa duyệt', 'class': 'm-badge--metal'},
						1: {'title': 'Đã duyệt', 'class': ' m-badge--brand'},
						2: {'title': 'Hết hạn', 'class': ' m-badge--danger'}
					};
					return '<span class="m-badge ' + status[row.trangthai].class + ' m-badge--wide">' + status[row.trangthai].title + '</span>';
				}
			},{
				field: 'action_id',
				width: 110,
				title: 'Chi tiết',
				sortable: false,
				overflow: 'visible',
				template: function (row, index, datatable) {
					var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';
					return '\
						<button onclick="showDialogEdit(this)" data-id="'+row.action_id+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhat" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="CHI TIẾT <?php echo $title ?>">\
							<i class="la la-edit"></i>\
						</button>\
					';
				},
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
function update(id){
	window.location.href = 'chinhsuadangtuyen.html?id='+id;
}
function showDialogInsert(elm){
	var btn = $(elm);
	$.ajax({
		url: "Model_<?php echo $com_name ?>.ajax",
		data: {
			act: "load_modal_add_order",
		},
		type: "POST",
		async: true,
		beforeSend: function(){
			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
		},
		success: function(resultHTML){
			btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
			$("#loadContentAdd").html(resultHTML);

			$("#btnPrintReceipt, #btnPrintConfirm, #btnPrintReceipt_Update, #btnPrintConfirm_Update").prop('disabled', false);
			$('.datepicker').datepicker({
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
			 $('#tinhthanh').select2({
					placeholder: "Chọn tỉnh thành",
					maximumSelectionLength: 3,
					width: '100%'
			});
			$("#Dialog_ThemMoi").modal('show');
		}
	})
}
function showDialogEdit(elm){
	var btn = $(elm);
	
	var customer_id = btn.data("id");
	$.ajax({
		url: "Model_<?php echo $com_name ?>.ajax",
		data: {
			act: "load_modal_view_service",
			customer_id: customer_id,
		},
		type: "POST",
		async: true,
		beforeSend: function(){
			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
		},
		success: function(resultHTML){
			btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
			$("#loadContentEdit").html(resultHTML);

			$("#btnPrintReceipt, #btnPrintConfirm, #btnPrintReceipt_Update, #btnPrintConfirm_Update").prop('disabled', false);
			$('.datepicker').datepicker({
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
			$('#tinhthanh').select2({
					placeholder: "Chọn tỉnh thành",
					maximumSelectionLength: 3,
					width: '100%'
			});
			$("#Dialog_CapNhat").modal('show');
		}
	})
}
function filter(){
	var StatusFillter = $("select#fillterStatus").val();
	var filter_tu_ngay = $("#tu_ngay").val();
	var filter_den_ngay = $("#den_ngay").val();
	var link = window.location.pathname;
	var url = window.location.protocol + "//" + window.location.hostname + link + "?";
		if(StatusFillter != ""){ url += "&status=" + StatusFillter};
		if(filter_tu_ngay != ""){ url += "&tu_ngay=" + filter_tu_ngay};
		if(filter_den_ngay != ""){ url += "&den_ngay=" + filter_den_ngay};
	window.location = url;
}
jQuery(document).ready(function() {
	DatatableRecordSelection.init();
	$("input:invalid").on("keyup", function(){
		$("input:valid").next("p.has-error").empty();
	})
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