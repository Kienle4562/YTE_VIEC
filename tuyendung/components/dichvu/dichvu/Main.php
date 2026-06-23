<?php defined( '_VALID_MOS' ) or die( include("404.php") );?>
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
			</div>
			<div class="m-portlet__body">
				<!--begin: Search Form -->
				<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
					<div class="row align-items-center">
						<div class="col-xl-8 order-2 order-xl-1">
							<div class="form-group m-form__group row align-items-center">
								<div class="col-md-6">
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
	<div class="modal fade" id="Dialog_CapNhat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-slg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">CHI TIẾT DỊCH VỤ</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="loadContentEdit"></div>
				<!---<div class="modal-footer">
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" id="btnUpdate" type="button">
						<i class="fa fa-print"></i> Lưu
					</button>
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning Close" data-dismiss="modal" type="button">
						<i class="fa fa-ban"></i> Hủy bỏ
					</button>
				</div> -->
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
					url: 'Model_<?php echo $com_name ?>.ajax?act=LoadList',
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
				field: 'ma_don_hang',
				title: 'Mã đơn hàng',
				width: 140,
				template: function(row) {
					
					return '<span class="m-badge ' +[row.ma_don_hang].class + ' m-badge--info m-badge--wide">' +row.ma_don_hang + '</span>';
				}
			},{
				field: 'ma_giam',
				title: 'Mã giảm',
				width: 140,
				template: function(row) {
					
					return '<span class="m-badge ' +[row.ma_giam].class + ' m-badge--accent m-badge--wide">' +row.ma_giam + '</span>';
				}
			},
			{
				field: 'ten_cong_ty',
				title: 'Tên công ty',
				width: 140
			}
			,{
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
jQuery(document).ready(function() {
	DatatableRecordSelection.init();
	$("input:invalid").on("keyup", function(){
		$("input:valid").next("p.has-error").empty();
	})
});
</script>