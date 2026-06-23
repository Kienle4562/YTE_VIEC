<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	include_once("Model.php");
	$myprocess = new process();
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="m-portlet m-portlet--mobile">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
								QUẢN LÝ DỊCH VỤ 
							<small>
								các dịch vụ đang được sử dụng
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
				<table class="m-datatable" id="html_table" width="100%">
									<thead>
										<tr>
											<th title="Field #1">
												Mã đơn hàng
											</th>
											<th title="Field #2">
												Tên dịch vụ
											</th>
											<th title="Field #3">
												Số lượng 
											</th>
											<th title="Field #4">
												Đã sử dụng
											</th>
											<th title="Field #4">
												Ngày hết hạn
											</th>
											<th title="Field #4">
												Ngày kích hoạt
											</th>
											<th title="Field #5">
												Chi tiết sử dụng
											</th>
										
										</tr>
									</thead>
									
									<tbody>
										<?php 
											$name_job = "";
											$result_cs = $myprocess->get_detail_customer($_SESSION["session"]["Id"]);
											while($rowcs = $result_cs->fetch(PDO::FETCH_ASSOC)){
											
										?>
										<tr>
											<td>
												<strong><?php echo $rowcs['ma_don_hang'] ?></strong>
											</td>
											<td>
												<?php echo $rowcs['name_function'] ?>
											</td>
											<td>
												<?php echo $rowcs['so_luong'] ?>
											</td>
											<td>
												<?php echo $rowcs['da_su_dung'] ?>
											</td>
											<td>
												<?php echo $rowcs['ngayhethan'] ?>
											</td>
											<td>
												<?php echo $rowcs['ngaykichhoat'] ?>
											</td>
											<td>
												<?php if(!empty($rowcs['id_post'])) { ?>
												   <a onclick="showDialogEdit(this)" data-id="<?php echo $rowcs['id_post'] ?>" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhat" class="m-portlet__nav-link btn"> Xem chi tiết </a>
												<?php }else{ ?>
													 <a onclick="javascript:void(0)" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhat" class="m-portlet__nav-link btn"> Xem chi tiết </a>
												<?php } ?>
											</td>
											
										</tr>
										<?php } ?>
									</tbody>
								</table>
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
//== Class definition

var DatatableHtmlTableDemo = function () {
	//== Private functions
	// demo initializer
	var demo = function () {
		var datatable = $('.m-datatable').mDatatable({
			search: {
				input: $('#generalSearch')
			},
			layout: {
				scroll: true,
				height: 400
			}
		});
	};
	return {
		//== Public functions
		init: function () {
			// init dmeo
			demo();
		}
	};
}();

jQuery(document).ready(function () {
	DatatableHtmlTableDemo.init();
});
function update(id){
	window.location.href = 'chinhsuadangtuyen.html?id='+id;
}

function showDialogEdit(elm){
	var btn = $(elm);
	var detail_id = btn.data("id");
	
	$.ajax({
		url: "Model_<?php echo $com_name ?>.ajax",
		data: {
			act: "load_detail_view",
			detail_id: detail_id,
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