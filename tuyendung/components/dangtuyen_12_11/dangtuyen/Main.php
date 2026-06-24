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
						
							<?php 
								$result_service = $myprocess->get_dichvu();
								$count = 0;
								$where = "congty_id =".$_SESSION["session"]["Id"];
							    $postBs_get = $core_class->getValueFrom('trn_congty','post_basic',$where);
								while($row_s = $result_service->fetch()) {
									 $count += $row_s['qty'];
								}
								
								//echo $count;
								$total_sub = $count+$postBs_get;
								
								if($total_sub>0){
							?>
							<button onclick="openFormInsert()" class="btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air">
								<a style="color:#FFF" href="themmoidangtuyen.html">
									<i class="la la-plus"></i>
									<span>
										Thêm mới
									</span>
								</a>
							</button>
						<?php }else {?>
							<button href="#" class="btn btn-outline-metal active" type="button" class="">
												Tiếp tục
												<i class="la la-arrow-right"></i><br>
												<small style="color:red;">Đăng ký dịch vụ để sử dụng</small>
							</button>
						<?php } ?>
							<div class="m-separator m-separator--dashed d-xl-none"></div>
						</div>
					</div>
				</div>
				<!--end: Search Form -->
				<!--begin: Datatable -->
			<div class="showDataTable table">
				<table id="cashFlowTable" class="m-datatable__table table-bordered m_datatable">
									<thead>
										<tr>
											<?php
												$arrayHeader = array(
													'congviec_id' => '',
													'Mã công việc' => '',
													'Tên công việc' => '',
													'Dịch vụ' => '',
													'Nơi làm việc' => '',
													'Ngày đăng' => '',
													'Ngày hết hạn' => '',
													'Lượt xem' => '',
													'CV Apply' => '',
													'Trạng thái' => '',
													'Thao tác' => '',
												);
												foreach($arrayHeader as $keyHeader => $valueHeader){
													echo '<th class="'.$valueHeader.'" nowrap>'.$keyHeader.'</th>';
												}
											?>
										</tr>
									</thead>
									
									<tbody>
										<?php 
											
											$result= $myprocess->get_job_list($_SESSION["session"]["Id"]);
											while($rowcs = $result->fetch(PDO::FETCH_ASSOC)){
											
										?>
										
										<tr>
											<td>
												<strong><?php echo $rowcs['congviec_id'] ?></strong>
											</td>
											<td>
												<strong><?php echo $rowcs['congviec_id'] ?></strong>
											</td>
											<td>
											<a href="https://yteviec.com/<?php echo $rowcs['congviec_id'] ?>-cv.html" target="_blank"><?php echo $rowcs['tencongviec'] ?></a>
												
											</td>
											<td>
												<?php 
												  if($rowcs['power_job'] == 1)
												  {
													  echo '<p class="m-badge m-badge--success m-badge--wide">Power Job</p> <br>';
												  }
												  if($rowcs['hot_job'] == 1)
												  {
													  echo '<p class="m-badge m-badge--success m-badge--wide">Hot Job</p> <br>';
												  }else
												  {
													  echo '<p class="m-badge m-badge--success m-badge--wide">Post Basic</p> <br>';
												  }
												?>
											</td>
											<td>
												<?php echo $rowcs['noilamviec'] ?>
											</td>
											<td>
												<?php echo $rowcs['ngayhethan'] ?>
											</td>
											<td>
												<?php echo $rowcs['ngayhethan'] ?>
											</td>
											<td>
												<?php echo intval($rowcs['luotxem']) ?>
											</td>
											<td>
												<?php echo intval(0) ?>
											</td>
											<td>
												<?php if($rowcs['trangthai'] == 1) { ?>
												     <p class="m-badge m-badge--success m-badge--wide">Đã duyệt</p> <br>
												<?php }else if($rowcs['trangthai'] == 2){ ?>
													 <p class="m-badge m-badge--warning m-badge--wide">Bản nháp</p> <br>
												<?php }else{ ?>
												 <p class="m-badge m-badge--metal m-badge--wide">Chưa duyệt</p> 
												<?php } ?>
											</td>
											<td>
												<button onclick="update(<?php echo $rowcs['congviec_id'] ?>)" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhat" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="CHI TIẾT <?php echo $rowcs['congviec_id'] ?>">
													<i class="la la-edit"></i>
												</button>
												<button onclick="copytin(<?php echo $rowcs['congviec_id'] ?>)" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhat" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="CHI TIẾT <?php echo $rowcs['congviec_id'] ?>">
													<i class="la la-copy"></i>
												</button>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
					</div>
				<!--end: Datatable -->
			</div>
		</div>
	</div>
</div>

<!-- Library JS -->
<script>
var DatatableHtmlTable = function() {
	//== Private functions
	var options = {
		sortable: false,
		data: {
			saveState: {cookie: false},
		},
		// layout definition
		layout: {
			theme: 'default', // datatable theme
			class: '', // custom wrapper class
			scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
			height: 550, // datatable's body's fixed height
			footer: false // display/hide footer
		},
		columns: [
			{
				field: 'congviec_id',
				title: '#',
				width: 10,
				textAlign: 'center',
				selector: {
					class: 'm-checkbox--solid m-checkbox--brand'
				},
			},
			{
				field: 'tencongviec',
				title: 'Tên công việc',
				width: 140
			},
			{
				field: 'tencongty',
				title: 'Công ty',
				width: 140
			},
			{
				field: 'Thao tác',
				title: 'Thao tác',
				width: 80
			}
		],
	};

	var localSelector = function() {
        options.search = {
            input: $('#generalSearch'),
        };
		var datatable = $('#cashFlowTable').mDatatable(options);
		
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
		//== Public functions
		init: function() {
			localSelector();
		},
	};
}();
jQuery(document).ready(function () {
	BootstrapSelect.init();
	DatatableHtmlTable.init();
});
function update(id){
	window.location.href = 'chinhsuadangtuyen.html?id='+id;
}
function copytin(id){
	window.location.href = 'copytin.html?id='+id;
}
jQuery(document).ready(function() {
	$("input:invalid").on("keyup", function(){
		$("input:valid").next("p.has-error").empty();
	})
});
</script>