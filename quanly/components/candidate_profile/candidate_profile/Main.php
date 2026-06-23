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
			// if(isset($_REQUEST["status"]) && is_numeric($_REQUEST["status"])){
			// 	$trang_thai = $_REQUEST["status"];
			// 	$urlRect .="&status=".$trang_thai."";	
			// }
			// if(isset($_REQUEST["user"])){
			// 	$user = $_REQUEST["user"];
			// 	$urlRect .="&user=".$user."";	
			// }
			// if(isset($_REQUEST["tu_ngay"])){
			// 	$tu_ngay = $_REQUEST["tu_ngay"];
			// 	$urlRect .="&tu_ngay=".$tu_ngay."";	
			// }
			// if(isset($_REQUEST["den_ngay"])){
			// 	$den_ngay = $_REQUEST["den_ngay"];
			// 	$urlRect .="&den_ngay=".$den_ngay."";	
			// }
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
								
							</div>
						</li>
					</ul>
					
					
					
				</div>
			</div>
			<div class="m-portlet__body">
				
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
		//$core_class->createForm($db_name, $title, "modal-slg", 4);
	?>
	<div class="modal fade" id="Dialog_CapNhat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-slg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">CHI TIẾT HỒ SƠ</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="loadContentEdit"></div>
				<div class="modal-footer">
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning Close" data-dismiss="modal" type="button">
						Đóng
					</button>
				</div>
			</div>
		</div>
	</div>

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
				field: 'id',
				title: '#',
				sortable: false,
				width: 40,
				// textAlign: 'center',
				// selector: {class: 'm-checkbox--solid m-checkbox--brand'},
			},{
				field: 'full_name',
				title: 'Họ và tên',
				width: 140
			},
			{
				field: 'email',
				title: 'Địa chỉ email',
				width: 140
			}, {
				field: 'dob',
				title: 'Ngày sinh',
				width: 140,
				template: function(row) {
					if (row.dob && row.dob !== 'Chưa cập nhật') {
						return moment(row.dob).format('DD-MM-YYYY');
					} else {
						return 'Chưa cập nhật';
					}
				}
			}
			, {
				field: 'phone',
				title: 'Số điện thoại',
				width: 140
			}
			, {
				field: 'address',
				title: 'Địa chỉ',
				width: 140
			}, {
				field: 'occupation',
				title: 'Nghề nghiệp',
				width: 140,
				
			}
			,{
				field: 'workplace',
				title: 'Nơi công tác',
				width: 140
			},{
				field: 'action_id',
				width: 110,
				title: 'Chi tiết',
				sortable: false,
				overflow: 'visible',
				template: function (row, index, datatable) {
					var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';
					return '\
						<button onclick="showDialoginfo(this)" data-id="'+row.action_id+'" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhat" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="CHI TIẾT <?php echo $title ?>">\
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
function showDialoginfo(elm){
	var btn = $(elm);
	var profile_id = btn.data("id");
	$.ajax({
		url: "Model_candidate_profile.ajax",
		data: {
			act: "load_modal_profile_detail",
			profile_id: profile_id,
		},
		type: "POST",
		async: true,
		beforeSend: function(){
			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
		},
		success: function(resultHTML){
			console.log(resultHTML);
			btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
			$("#loadContentEdit").html(resultHTML);

			$("#btnPrintReceipt, #btnPrintConfirm, #btnPrintReceipt_Update, #btnPrintConfirm_Update").prop('disabled', false);
			$("#Dialog_CapNhat").modal('show');
		}
	})
}
</script>