<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	$arraySource = array(
		'dist/component/employee/css/employee.css' => 'css',
		'dist/component/employee/js/employee.js' => 'js',
	);
	$core_class->loadSource($arraySource);

	$arrayLoaiNhanVien = array(
		1 => "Chính thức",
		2 => "Cộng tác",
		3 => "Thử việc",
	);
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
							<div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
								data-dropdown-toggle="hover" aria-expanded="true">
								<a href="javascript:void(0)"
									class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
									<i class="la la-gear m--font-brand"></i>
								</a>
								<div class="m-dropdown__wrapper">
									<span
										class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
									<div class="m-dropdown__inner">
										<div class="m-dropdown__body">
											<div class="m-dropdown__content">
												<ul class="m-nav">
													<li class="m-nav__section m-nav__section--first">
														<span class="m-nav__section-text">
															CÔNG CỤ
														</span>
													</li>
													<li style="display:none" class="m-nav__item">
														<a href="javascript:void(0)" class="m-nav__link">
															<i class="m-nav__link-icon fa fa-plus"></i>
															<span onclick="openFormInsert()" data-toggle="modal"
																data-backdrop="static" data-keyboard="false"
																data-target="#Dialog_ThemMoi" class="m-nav__link-text">
																Thêm mới
															</span>
														</a>
													</li>
													<!-- <li class="m-nav__item">
														<a href="javascript:void(0)" class="m-nav__link">
															<i class="m-nav__link-icon fa fa-file-excel-o"></i>
															<span id="btnExportExcel" class="m-nav__link-text">
																Export Excel
															</span>
														</a>
													</li> -->
													<li class="m-nav__item">
														<a href="javascript:void(0)" class="m-nav__link">
															<i class="m-nav__link-icon fa fa-remove"></i>
															<span id="btnDeleteData" class="m-nav__link-text">
																Xóa nhiều
															</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
					<button class="addEmployee headTool btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air" >
						<span>
							<i class="la la-cart-plus"></i>
							<span>
								Thêm mới
							</span>
						</span>
					</button>
				</div>
			</div>
			<div class="m-portlet__body">
				<!--begin: Search Form -->
				<div class="m-form m-form--label-align-right m--margin-bottom-10">
					<div class="row align-items-center m_top_10">
						<div class="col-xl-12 order-2 order-xl-1">
							<div class="form-group m-form__group row align-items-center">
								<div class="col-md-3">
									<div class="form-group m-form__group row align-items-center">
										<div class="col-md-12">
											<div class="m-input-icon m-input-icon--left">
												<input type="text" class="form-control m-input"
													placeholder="Tìm kiếm..." id="generalSearch">
												<span class="m-input-icon__icon m-input-icon__icon--left">
													<span>
														<i class="la la-search"></i>
													</span>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="m-form__group m-form__group--inline">
										<div class="m-form__label">
											<label style="width: 80px;">
												Trạng thái:
											</label>
										</div>
										<div class="m-form__control">
											<select class="form-control m-bootstrap-select m_selectpicker" id="trangthai">
												<option value="">
													All
												</option>
												<option value="1">
													Active
												</option>
												<option value="0">
													InActive
												</option>
											</select>
										</div>
									</div>
									<div class="d-md-none m--margin-bottom-10"></div>
								</div>
								<div class="col-md-3">
									<div class="m-form__group m-form__group--inline">
										<div class="m-form__label">
											<label style="width: 60px;">
												Chức vụ:
											</label>
										</div>
										<div class="m-form__control">
											<?php echo $core_class->createSelectBox5("mst_chucvu", "tenchucvu", "tenchucvu", "", "m-bootstrap-select m_selectpicker w_full", "filter_chuc_vu_id"); ?>
										</div>
									</div>
									<div class="d-md-none m--margin-bottom-10"></div>
								</div>
								<div class="col-md-3">
									<div class="m-form__group m-form__group--inline">
										<div class="m-form__label">
											<label style="width: 80px;">
												Loại NV:
											</label>
										</div>
										<div class="m-form__control">
											<?php echo $core_class->createSelectBoxWithArray($arrayLoaiNhanVien, "", "", true, "m-bootstrap-select m_selectpicker w_full", "filter_loai_nv"); ?>
										</div>
									</div>
									<div class="d-md-none m--margin-bottom-10"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end: Search Form -->
				<!--begin: Datatable -->
				<div class="table" id="local_record_selection"></div>
				<!--end: Datatable -->
			</div>
		</div>
	</div>
</div>

<?php // modal add ?>
<div class="modal fade" id="Dialog_ThemMoi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-slg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					<i class="flaticon-user-add"></i> Thêm mới nhân viên
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
				</button>
			</div>
			<div id="loadAddContent">
				<form></form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btnInsert">
					Lưu thông tin
				</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					Đóng
				</button>
			</div>
		</div>
	</div>
</div>

<?php // modal edit ?>
<div class="modal fade" id="Dialog_CapNhat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-slg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">
					<i class="flaticon-user-add"></i> Cập nhật nhân viên
				</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">
						&times;
					</span>
				</button>
			</div>
			<div id="loadEditContent">
				<form></form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btnUpdate">
					Cập nhật thông tin
				</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
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
		sortable: true,
		pagination: true,
		// columns definition
		columns: [{
			field: 'taikhoan_id',
			title: '#',
			sortable: false,
			width: 20,
			textAlign: 'center',
			selector: {
				class: 'm-checkbox--solid m-checkbox--brand'
			},
		}, {
			field: 'trangthai',
			title: 'Trạng thái',
			width: 100,
			template: function(row) {
				var status = {
					0: {
						'title': 'InActive',
						'class': 'm-badge--metal'
					},
					1: {
						'title': 'Active',
						'class': ' m-badge--brand'
					}
				};
				if (typeof status[row.trangthai] != "undefined") {
					return '<span class="m-badge ' + status[row.trangthai].class +' m-badge--wide">' + status[row.trangthai].title + '</span>';
				} else {
					return "";
				}
			}
		}, {
			field: 'Tendangnhap',
			title: 'Tài khoản',
			width: 140
		}, {
			field: 'Hoten',
			title: 'Họ tên',
			width: 140
		}, {
			field: 'Didong',
			title: 'Di động',
			width: 140
		}, {
			field: 'chucvu',
			title: 'Chức vụ',
			width: 140
		}, {
			field: 'loai_nv',
			title: 'Loại nhân viên',
			width: 100,
			template: function(row) {
				if (row.loai_nv == 1) {
					return "Chính thức";
				} else  if (row.loai_nv == 2) {
					return "Cộng tác";
				} else  if (row.loai_nv == 3) {
					return "Thử việc";
				}else {
					return "Chưa xác định";
				}
			}
		},{
			field: 'email',
			title: 'Email',
			width: 250
		}, {
			field: 'action_id',
			width: 30,
			title: '&nbsp;',
			sortable: false,
			overflow: 'visible',
			template: function(row, index, datatable) {
				var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';
				return '\
						<button data-id="' + row.action_id + '" class="btnEdit btn m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="CHI TIẾT <?php echo $title ?>">\
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

		datatable.on('m-datatable--on-check m-datatable--on-uncheck m-datatable--on-layout-updated', function(
			e) {
			var checkedNodes = datatable.rows('.m-datatable__row--active').nodes();
			var count = checkedNodes.length;
			$('#m_datatable_selected_number').html(count);
			if (count > 0) {
				$('#m_datatable_group_action_form').collapse('show');
			} else {
				$('#m_datatable_group_action_form').collapse('hide');
			}
		});

		// delete data
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
			if (array.length > 0) {
				deleteData(array, '<?php echo $com_name ?>');
			} else {
				toastr["warning"]("Bạn chưa chọn vào mục nào", "Lỗi");
			}
		});

		// export data
		$('#btnExportExcel').on('click', function(e) {
			var ids = datatable.rows('.m-datatable__row--active').
			nodes().
			find('.m-checkbox--single > [type="checkbox"]').
			map(function(i, chk) {
				return $(chk).val();
			});
			var array = $.map(ids, function(value, index) {
				return [value];
			});
			if (array.length > 0) {
				exportExcel(array, '<?php echo $com_name ?>');
			} else {
				toastr["warning"]("Bạn chưa chọn vào mục nào", "Lỗi");
			}
		});

		var query = datatable.getDataSourceQuery();

		$('#trangthai').on('change', function() {
			var query = datatable.getDataSourceQuery();
			query.trangthai = $(this).val().toLowerCase();
			datatable.setDataSourceQuery(query);
			datatable.load();
		}).val(typeof query.trangthai !== 'undefined' ? query.trangthai : '');

		$('[name=filter_chuc_vu_id]').on('change', function() {
			var query = datatable.getDataSourceQuery();
			query.chucvu = $(this).val().toLowerCase();
			datatable.setDataSourceQuery(query);
			datatable.load();
		}).val(typeof query.chucvu !== 'undefined' ? query.chucvu : '');
		
		$('[name=filter_loai_nv]').on('change', function() {
			var query = datatable.getDataSourceQuery();
			query.loai_nv = $(this).val().toLowerCase();
			datatable.setDataSourceQuery(query);
			datatable.load();
		}).val(typeof query.loai_nv !== 'undefined' ? query.loai_nv : '');
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
	$('#btnInsert').click(function(event) {
	  insertData(event, '<?php echo $com_name ?>', this.id);
	});

	$('#btnUpdate').click(function(event) {
		updateData(event, '<?php echo $com_name ?>', this.id);
	});

	$('#formDataInsert input[type=file]').on('change', function(event) {
		uploadImage(event, '<?php echo $com_name ?>', this.id, 0);
	});

	$('#formDataUpdate input[type=file]').on('change', function(event) {
		uploadImage(event, '<?php echo $com_name ?>', this.id, 1);
	});

	$("input:invalid, select:invalid").on("change", function() {
		$(this).parents("div[class^='col']").first().find("p.has-error").empty();
	})
});

// random mat khau
function randomPassword(length) {
	var chars = "abcdefghijklmnopqrstuvwxyz!@#$%^&*()-+<>ABCDEFGHIJKLMNOP1234567890";
	var pass = "";
	for (var x = 0; x < length; x++) {
		var i = Math.floor(Math.random() * chars.length);
		pass += chars.charAt(i);
	}
	return pass;
}

function generate() {
	formDataInsert.passWd.value = randomPassword(formDataInsert.length.value);
	//alert(formDataInsert.passWd.value);
}
function generateUpdate() {
	formDataUpdate.passWd.value = randomPassword(formDataUpdate.length.value);
	//alert(formDataInsert.passWd.value);
}

// xuly autocopy
document.getElementById("passWd").onclick = function() {
  this.select();
  document.execCommand('copy');
	toastr.options = {
	"closeButton": false,
	"debug": false,
	"newestOnTop": false,
	"progressBar": false,
	"positionClass": "toast-top-right",
	"preventDuplicates": false,
	"onclick": null,
	"showDuration": "300",
	"hideDuration": "1000",
	"timeOut": "5000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
	};
	toastr.success("Copy password !");
}
</script>