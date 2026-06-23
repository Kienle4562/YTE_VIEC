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
													<li class="m-nav__item">
														<a href="javascript:void(0)" class="m-nav__link">
															<i class="m-nav__link-icon fa fa-file-excel-o"></i>
															<span id="btnExportExcel" class="m-nav__link-text">
																Export Excel
															</span>
														</a>
													</li>
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
						<div class="col-xl-4 order-1 order-xl-2 m--align-right">
							<button onclick="openFormInsert()" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_ThemMoi">
								<span>
									<i class="la la-cart-plus"></i>
									<span>
										Thêm mới
									</span>
								</span>
							</button>
							<div class="m-separator m-separator--dashed d-xl-none"></div>
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

	<?php 
		// Tạo modal form thêm mới và chỉnh sửa
		$core_class->createForm($db_name, $title, "", 12); 
	?>

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
		columns: [
			{
				field: 'archive_id',
				title: '#',
				sortable: false,
				width: 40,
				textAlign: 'center',
				selector: {class: 'm-checkbox--solid m-checkbox--brand'},
			},{
				field: 'archive_name',
				title: 'Tiêu đề',
				width: 250
			},{
				field: 'action_id',
				width: 110,
				title: '&nbsp;',
				sortable: false,
				overflow: 'visible',
				template: function (row, index, datatable) {
					var dropup = (datatable.getPageSize() - index) <= 4 ? 'dropup' : '';
					return '\
						<button onclick="loadDataEdit('+row.action_id+',\'<?php echo $com_name ?>\')" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhat" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="CHI TIẾT <?php echo $title ?>">\
							<i class="la la-edit"></i>\
						</button>\
						<button onclick="loadDataCopy('+row.action_id+',\'<?php echo $com_name ?>\')" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_ThemMoi" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="COPY <?php echo $title ?>">\
							<i class="la la-copy"></i>\
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
	$('#btnInsert, .btnInsert').click(function(event){
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
</script>