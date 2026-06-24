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
				field: 'tencongviec',
				title: 'Tên công việc',
				width: 140
			}, {
				field: 'fullname',
				title: 'Tên ứng viên',
				width: 140
			},{
				field: 'sodienthoai',
				title: 'Số điện thoại',
				width: 140
			},{
				field: 'gioithieungan',
				title: 'Giới thiệu ngắn',
				width: 140,
				template: function (row) {
					return '<a href="javascript: void(0);" class="m-badge m-badge--accent m-badge--wide" onclick="swal(\'Giới thiệu ngắn\', \''+row.gioithieungan.replace(/\n|'|"/g, "")+'\')">Click me</a>';
					
				}
			},{
				field: 'hoso',
				title: 'Hồ sơ ứng viên',
				width: 140,
				template: function (row) {
					return '<a href="https://yteviec.com/'+row.hoso+'" class="m-badge m-badge--accent m-badge--wide">Tải về</a>';
				}
			},{
				field: 'email',
				title: 'Email ứng viên',
				width: 140,
				template: function (row) {
					return '<span data-toggle="m-popover" title="" data-content="'+row.email+'">'+row.email+'</span>';
				}
			},{
				field: 'tinhthanh_id',
				title: 'Tỉnh thành',
				width: 140,
				template: function (row) {
					var arrayList = {
						<?php echo $core_class->createArrayList("mst_tinhthanh"); ?>
					};
					if(typeof arrayList[row.tinhthanh_id] != "undefined"){
						return arrayList[row.tinhthanh_id].title;
					}else{
						return "";
					}
				}
			},{
				field: 'gioitinh_id',
				title: 'Giới tính',
				width: 140,
				template: function (row) {
					var arrayList = {
						<?php echo $core_class->createArrayList("mst_gioitinh"); ?>
					};
					if(typeof arrayList[row.gioitinh_id] != "undefined"){
						return arrayList[row.gioitinh_id].title;
					}else{
						return "";
					}
				}
			},{
				field: 'ngayungtuyen',
				title: 'Ngày ứng tuyển',
				width: 140,
				template: function (row) {
					return formatDateVN(row.ngayhethan);
				}
			},{
				field: 'ngayhethan',
				title: 'Ngày hết hạn',
				width: 140,
				template: function (row) {
					return formatDateVN(row.ngayhethan);
				}
			}
		],
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
jQuery(document).ready(function() {
	DatatableRecordSelection.init();
	$("input:invalid").on("keyup", function(){
		$("input:valid").next("p.has-error").empty();
	})
});
</script>