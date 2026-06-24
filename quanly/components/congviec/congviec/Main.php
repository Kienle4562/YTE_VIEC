<?php defined( '_VALID_MOS' ) or die( include("404.php") );?>
<?php
	$searchKey = "";
	$process =  new process();
	if(!empty($_REQUEST["date"])){
		$searchKey .= $_REQUEST["date"];
	}
			$trang_thai = " ";
			$tu_ngay = " ";
			$den_ngay = " ";
			$duyet_tin = " ";
			$urlRect = "";
			$condition ="";
			
			if(isset($_REQUEST["status"]) && is_numeric($_REQUEST["status"])){
				$trang_thai = $_REQUEST["status"];
				$urlRect .="&status=".$trang_thai."";	
				$condition .= " AND trn_congviec.trangthai ='".$trang_thai."'"; 
			}
			if(isset($_REQUEST["email"])){
				$email = $_REQUEST["email"];
				$urlRect .="&email=".$email."";	
				$condition .= " AND trn_congviec.email ='".$email."'"; 
			}
			if(isset($_REQUEST["tu_ngay"])){
				$tu_ngay = $_REQUEST["tu_ngay"];
				$urlRect .="&tu_ngay=".$tu_ngay."";	
				$condition .= " AND trn_congviec.DISORDER >='".$core_class->_formatdate($tu_ngay)." 00:00:00'"; 
			}
			if(isset($_REQUEST["den_ngay"])){
				$den_ngay = $_REQUEST["den_ngay"];
				$urlRect .="&den_ngay=".$den_ngay."";
				$condition .= " AND trn_congviec.DISORDER <='".$core_class->_formatdate($den_ngay)." 23:59:59'"; 
			}
			if(isset($_REQUEST["duyet_tin"])){
				$duyet_tin = $_REQUEST["duyet_tin"];
				$urlRect .="&duyet_tin=".$duyet_tin."";	
				$condition .= " AND trn_congviec.UPDATE_TIME >='".$core_class->_formatdate($duyet_tin)." 00:00:00'  AND trn_congviec.UPDATE_TIME <='".$core_class->_formatdate($duyet_tin)." 23:59:59'"; 
			}
			if(isset($_REQUEST["congty_id"])){
				$congty_id = $_REQUEST["congty_id"];
				$urlRect .="&congty_id=".$congty_id."";	
				$condition .= " AND trn_congviec.congty_id ='".$congty_id."'"; 
			}
			
			if($_SESSION["session"]['Id'] !=4)
			{
				$condition .=' AND trn_congviec.user_id ='.$_SESSION["session"]['Id'];
			}
			$condition .= " AND trn_congviec.trangthai != 2"; 
			$condition .=' AND trn_congviec.DELETE_FLG = 0 ORDER BY trn_congviec.DISORDER DESC';
		
?>
<script>
	/* $(document).ready(function() {
		$('.sonamkinhnghiem').css('display','none');
	}); */
</script>
<style>
	.d_none{
		display: none;
	}
	.w100{
		width: 100%;
	}
	.modal .modal-content .modal-header {
		padding: 20px 15px 15px 15px;
	}

	.m-form__group.row .m-checkbox-inline,
	.m-form__group.row .m-radio-inline {
		margin-top: 0px;
	}
	.m-form__group.row .m-checkbox-inline label{
		margin-top: 0px;
	}

	.m-form.m-form--fit .m-form__content,
	.m-form.m-form--fit .m-form__heading,
	.m-form.m-form--fit .m-form__group {
		padding-left: 10px;
		padding-right: 10px;
	}

	.m-form.m-form--group-seperator-dashed .m-form__group,
	.m-form.m-form--group-seperator .m-form__group {
		padding-top: 10px;
		padding-bottom: 10px;
	}

	.row {
		margin-right: 0;
		margin-left: 0;
	}
</style>

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
													<!-- <li class="m-nav__item">
														<a href="javascript:void(0)" class="m-nav__link">
															<i class="m-nav__link-icon fa fa-file-excel-o"></i>
															<span id="btnExportExcel" class="m-nav__link-text">
																Export Excel
															</span>
														</a>
													</li> -->
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
					<button onclick="showDialogInsert(this)" class="btn headTool btn btn-danger m-btn m-btn--custom m-btn--icon m-btn--air" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_ThemMoi">
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
										<input type="text" class="form-control m-input" placeholder="Tìm kiếm..." id="generalSearch" value="<?php echo $searchKey ?>">
										<span class="m-input-icon__icon m-input-icon__icon--left">
											<span>
												<i class="la la-search"></i>
											</span>
										</span>
									</div>
								</div>
							</div>
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
							</div>
						
					<?php } ?>
				</div>
				
			</div>
			<div class="m-portlet__body">
				<!--begin: Search Form -->
				<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
					<div class="row align-items-center">
						<div class="col-xl-4 order-2 order-xl-1">
							<?php if($_SESSION["session"]['Id'] == 4) { ?>
							<div class="m-form__group m-form__group--inline">
								<div class="m-form__label">
									<label style="width: 80px;">
										Chọn user:
									</label>
								</div>
								<?php
										$sql = "
												SELECT
													trn_congty.congty_id, 
													trn_congty.email, 
													trn_congty.trangthai, 
													trn_congty.hien_thi
										    	FROM
												   trn_congty WHERE trn_congty.trangthai = 1 AND trn_congty.email !='' ";
										$row = $core_class->getValueFrom3($sql);
									?>
								<div class="m-form__control">
									<select id="fillterUser" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true">
										<option value="">Chọn tài khoản</option>
										<option value="0">Người dùng</option>
										<?php
											foreach($row as $key){
												if($_REQUEST["email"] == $key['email']){
													$selected = 'selected="selected"';
												}else{
													$selected = "";
												}
												echo '<option '.$selected.' value="'.$key['email'].'">'.$key['email'].'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<?php } else { ?>
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
							<?php } ?>
							<div class="d-md-none m--margin-bottom-10"></div>
						</div>
								<div class="col-xl-2 order-2 order-xl-1">
									<div style="margin-bottom: 6px;" class="m-form__group m-form__group--inline w_full">
										
										<div class="m-form__control">
											<input class="form-control w_full datepickerCSS" id="tu_ngay" name="tu_ngay" type="text" value="<?php echo $_REQUEST["tu_ngay"] ?>" placeholder="Từ ngày">
										</div>
									</div>
									<div class="d-md-none m--margin-bottom-10"></div>
								</div>
								<div class="col-xl-2 order-2 order-xl-1">
									<div style="margin-bottom: 6px;" class="m-form__group m-form__group--inline w_full">
										
										<div class="m-form__control">
											<input class="form-control w_full datepickerCSS" id="den_ngay" name="den_ngay" placeholder="Đến ngày" type="text" value="<?php echo $_REQUEST["den_ngay"] ?>">
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
				<div class="showDataTable table">
					<table id="cashFlowTable" class="m-datatable__table table-bordered m_datatable">
						<thead>
							<tr>
								<?php
									$arrayHeader = array(
										'congviec_id' => '',
										'Mã ID' => '',
										'Trạng thái' => '',
										'Dịch vụ' => '',
										'Tên công việc' => '',
										'Công ty' => '',
										'Ngày thêm' => '',
										'Lượt xem' => '',
										'CV Apply' => '',
										'Người thêm' => '',
										'Thao tác' => ''
									);
									foreach($arrayHeader as $keyHeader => $valueHeader){
										echo '<th class="'.$valueHeader.'" nowrap>'.$keyHeader.'</th>';
									}
								?>
							</tr>
						</thead>
						<tbody>
							<?php
							
								$result = $process->getList_Job($condition);
								if($result->rowCount() > 0){
									$i = 0;
									while($row = $result->fetch()){
										$i++;
										$CountUngtuyen = $process->countUngtuyen($row['congviec_id']);
							?>
							<tr>
                            	<td nowrap>
									<?php echo $row['congviec_id'] ?>
								</td>
								<td nowrap>
									<a href="https://yteviec.com/<?php echo $row['congviec_id'] ?>-cv.html" target="_blank"><?php echo $row['congviec_id'] ?></a>
									
								</td>
								<td nowrap>
									<?php  if($row['trangthai'] == 1 )
											{
												echo '<p class="m-badge m-badge--info m-badge--wide">Đã duyệt </p>'; 
											}else
											{
												echo ' <p class="m-badge m-badge--metal m-badge--widem-badge m-badge--metal m-badge--wide"> Chưa duyệt </p>';
											}
									?>
								</td>
								<td nowrap>
									<?php 
												  if($row['power_job'] == 1)
												  {
													  echo '<p class="m-badge m-badge--warning m-badge--wide">Power Job</p> <br>';
												  }
												  if($row['hot_job'] == 1)
												  {
													  echo '<p class="m-badge m-badge--danger m-badge--wide">Hot Job</p> <br>';
												  }else
												  {
													  echo '<p class="m-badge m-badge--brand m-badge--wide">Post Basic</p> <br>';
												  }
												?>
								</td>
								<td nowrap>
									<?php echo $row['tencongviec'] ?>
								</td>
								<td nowrap>
									<a onclick="showDialogEditCompany(this)" data-id="<?php echo $row['congty_id'] ?>" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhatCompany" class="m-portlet__nav-link m--font-primary" title="CHI TIẾT"><?php echo $row['tencongty'] ?></a>
								</td>
								<td nowrap>
									<?php echo $row['ngaydang'] ?>
								</td>
								<td nowrap>
									<?php echo $row['luotxem'] ?>
								</td>
								<td nowrap>
									<p class="m-badge m-badge--success m-badge--wide"><a onclick="showDialogCvApply(this)" data-id="<?php echo $row['congviec_id'] ?>" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_Chitiet" ><?php echo $CountUngtuyen ?></a></p>
								</td>
								<td nowrap>
									<?php echo $row['Tendangnhap'] ?>
								</td>
								<td nowrap>
									<button onclick="showDialogEdit(this)" data-id="<?php echo $row['congviec_id'] ?>" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhat" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="CHI TIẾT">
											<i class="la la-edit"></i>
									</button>
									<button onclick="showDialogCopy(this)"  data-id="<?php echo $row['congviec_id'] ?>" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_ThemMoi" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="COPY">
											<i class="la la-copy"></i>
									</button>
								</td>
                            
							</tr>
							
						<?php }?>
						</tbody>
						<?php }?>
					
					</table>
				</div>
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
					<h5 class="modal-title">THÊM MỚI THÔNG TIN CÔNG VIỆC</h5>
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
					<h5 class="modal-title">CẬP NHẬT THÔNG TIN CÔNG VIỆC</h5>
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
	<div class="modal fade" id="Dialog_CapNhatCompany" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-slg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">CẬP NHẬT THÔNG TIN CÔNG TY</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="loadContentEditCompany"></div>
				<div class="modal-footer">
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" id="btnUpdateCompany" type="button">
						<i class="fa fa-print"></i> Lưu
					</button>
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning Close" data-dismiss="modal" type="button">
						<i class="fa fa-ban"></i> Hủy bỏ
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="Dialog_Copy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-slg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">SAO CHÉP THÔNG TIN CÔNG VIỆC</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="loadContentCopy"></div>
				<div class="modal-footer">
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" id="btnCopy" type="button">
						<i class="fa fa-print"></i> Lưu
					</button>
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning Close" data-dismiss="modal" type="button">
						<i class="fa fa-ban"></i> Hủy bỏ
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="Dialog_Chitiet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-slg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">CHI TIẾT APPLY CV</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div id="loadContentCVApply"></div>
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
			// init dmeo
			// loadDataTable();
		},
	};
}();

jQuery(document).ready(function() {
	BootstrapSelect.init();
	DatatableHtmlTable.init();
	$('#btnUpdateCompany').click(function(event){
		//alert('aaaa');
		updateData_cty2(event, '<?php echo $com_name ?>', this.id);
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
		
	
	$('#fillterStatus').on('change onload', function () {
			var query = datatable.getDataSourceQuery();
			query.trangthai = $(this).val().toLowerCase();
			datatable.setDataSourceQuery(query);
			datatable.load();
		});
	$('#fillterCom').on('change onload', function () {
			var query = datatable.getDataSourceQuery();
			query.idCom = $(this).val().toLowerCase();
			datatable.setDataSourceQuery(query);
			datatable.load();
		});
	$('#btnInsert').click(function(event){
		var btn = $(this);
		//alert($('#tinhthanh').val());
		if($('#tinhthanh').val() == "") {

			alert(" Nhập tỉnh thành");
			
			return false;
		}
		if($("form#formDataInsert")[0].checkValidity()) {
			$.ajax({
				url: "Model_congviec.ajax",
				data: $("#formDataInsert").serialize(),
				async: true,
				type: "POST",
				dataType: 'JSON',
				beforeSend: function(){
					btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
				},
				success: function(js){
					if(js['isError'] == "0"){
						toastr["success"]("Thành công", js['msg']);
						$("#Dialog_ThemMoi").modal('hide');
						$('.m_datatable').mDatatable('reload');
					}else{
						toastr["warning"]("Lỗi", js['msg']);
					}
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
				}
			})
		}else{
			$("#formDataInsert").find(":invalid").addClass('required').first().focus();
			$("#formDataInsert").find(":invalid").each(function(index, node) {
				$(this).parents("div[class^='col']").find("p.has-error").html(node.validationMessage);
			})
			event.preventDefault();
		}
	});
	
	$('#btnCopy').click(function(event){
		var btn = $(this);
		if($('#tinhthanh').val() == "") {

			alert(" Nhập tỉnh thành");
			
			return false;
		}
		if($("form#formDataCopy")[0].checkValidity()) {
			$.ajax({
				url: "Model_congviec.ajax",
				data: $("#formDataCopy").serialize(),
				async: true,
				type: "POST",
				dataType: 'JSON',
				beforeSend: function(){
					btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
				},
				success: function(js){
					if(js['isError'] == "0"){
						toastr["success"]("Thành công", js['msg']);
						$("#Dialog_Copy").modal('hide');
						$('.m_datatable').mDatatable('reload');
					}else{
						toastr["warning"]("Lỗi", js['msg']);
					}
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
				}
			})
		}else{
			$("#formDataCopy").find(":invalid").addClass('required').first().focus();
			$("#formDataCopy").find(":invalid").each(function(index, node) {
				$(this).parents("div[class^='col']").find("p.has-error").html(node.validationMessage);
			})
			event.preventDefault();
		}
	});
	
	$('#btnUpdate').click(function(event){
		var btn = $(this);
		if($('#tinhthanh').val() == "") {

			alert(" Nhập tỉnh thành");
			
			return false;
		}
		if($("form#formDataUpdate")[0].checkValidity()) {
			$.ajax({
				url: "Model_congviec.ajax",
				data: $("#formDataUpdate").serialize(),
				async: true,
				type: "POST",
				dataType: 'JSON',
				beforeSend: function(){
					btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
				},
				success: function(js){
					if(js['isError'] == "0"){
						btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
						toastr["success"]("Thành công", js['msg']);
						$("#Dialog_CapNhat").modal('hide');
						$('.m_datatable').mDatatable('reload');
					}else{
						toastr["warning"]("Lỗi", js['msg']);
					}
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
				}
			})
		}else{
			$("#formDataUpdate").find(":invalid").addClass('required').first().focus();
			$("#formDataUpdate").find(":invalid").each(function(index, node) {
				$(this).parents("div[class^='col']").find("p.has-error").html(node.validationMessage);
			})
			event.preventDefault();
		}
	});
	
	$('#formDataInsert input[type=file]').on('change', function(event){
		uploadImage(event, '<?php echo $com_name ?>', this.id, 0);
	});
	$('#formDataCopy input[type=file]').on('change', function(event){
		uploadImage(event, '<?php echo $com_name ?>', this.id, 0);
	});
	$('#formDataUpdate input[type=file]').on('change', function(event){
		uploadImage(event, '<?php echo $com_name ?>', this.id, 1);
	});

	$("input:invalid").on("keyup", function(){
		$("input:valid").next("p.has-error").empty();
	})
});

function showDialogInsert(elm){
	var btn = $(elm);
	$.ajax({
		url: "Model_congviec.ajax",
		data: {
			act: "load_modal_add_new_job",
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

function showDialogCopy(elm){
	
	var btn = $(elm);
	var congviec_id = btn.data("id");
	$.ajax({
		url: "Model_congviec.ajax",
		data: {
			act: "load_modal_copy_job",
			congviec_id: congviec_id,
		},
		type: "POST",
		async: true,
		beforeSend: function(){
			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
		},
		success: function(resultHTML){
			btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
			$("#loadContentCopy").html(resultHTML);
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
			$("#Dialog_Copy").modal('show');
		}
	})
}

function showDialogEdit(elm){
	var btn = $(elm);
	var congviec_id = btn.data("id");
	$.ajax({
		url: "Model_congviec.ajax",
		data: {
			act: "load_modal_edit_job",
			congviec_id: congviec_id,
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

function showDialogCvApply(elm){
	var btn = $(elm);
	var detail_id = btn.data("id");
	$.ajax({
		url: "Model_congviec.ajax",
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
			$("#loadContentCVApply").html(resultHTML);
			$("#Dialog_Chitiet").modal('show');
		}
	})
}

function showDialogEditCompany(elm){
	var btn = $(elm);
	var congty_id = btn.data("id");
	$.ajax({
		url: "Model_congviec.ajax",
		data: {
			act: "load_modal_edit_company",
			congty_id: congty_id,
		},
		type: "POST",
		async: true,
		beforeSend: function(){
			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
		},
		success: function(resultHTML){
			btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
			$("#loadContentEditCompany").html(resultHTML);
			$("#btnPrintReceipt, #btnPrintConfirm, #btnPrintReceipt_Update, #btnPrintConfirm_Update").prop('disabled', false);
			//$("#Dialog_CapNhatCompany").modal('show');
		}
	})
}


function filter(){
	var StatusFillter = $("select#fillterStatus").val();
	//var fillterCom = $("select#fillterCom").val();
	var StatusUser = $("select#fillterUser").val();
	var filter_tu_ngay = $("#tu_ngay").val();
	var filter_den_ngay = $("#den_ngay").val();
	//var filter_duyet_tin = $("#den_ngay").val();
	var link = window.location.pathname;
	var url = window.location.protocol + "//" + window.location.hostname + link + "?";
		if(StatusFillter != ""){ url += "&status=" + StatusFillter};
		//if(fillterCom != ""){ url += "&congty_id=" + fillterCom};
		if(StatusUser != "" && typeof StatusUser != "undefined"){ url += "&email=" + StatusUser};
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