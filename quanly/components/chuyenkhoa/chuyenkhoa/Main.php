<?php defined( '_VALID_MOS' ) or die( include("404.php") );
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
				<div class="col-lg-12 m_top_15">
				<!--begin::Portlet-->
				<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair m-portlet--head-sm m_bottom_10">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Danh mục chuyên khoa
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div id="m_tree_add">
						<?php
							//$myprocess = new process();
							$resultDanhmuc = $myprocess->get_danhmuc();
						?>
							<ul>
								<?php
									while ($rowDanhmuc = $resultDanhmuc->fetch(PDO::FETCH_ASSOC)){
								?>
								<li data-parent="<?php echo $rowDanhmuc["danhmuccv_id"]; ?>" data-jstree='{ "id" : <?php echo $rowDanhmuc["danhmuccv_id"]; ?> }'>
									<?php echo $rowDanhmuc["tendanhmuccv"]; ?>
									<ul>
										<?php
											$result_cn = $myprocess->get_chuyenkhoa($rowDanhmuc['danhmuccv_id']);
											while ($rowcn = $result_cn->fetch(PDO::FETCH_ASSOC)){
										?>
										<li data-id="<?php echo $rowcn["chuyenkhoa_id"]; ?>" data-jstree='{ "id" : <?php echo $rowcn["chuyenkhoa_id"]; ?> }'>
											<a  onclick="showDialogEdit(this)" data-id="<?php echo $rowcn['chuyenkhoa_id'] ?>"  data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhat" title="CẬP NHẬT <?php echo $title ?>" href="javascript:;">
												<?php echo $rowcn['chuyenkhoa_name'] ?>
											</a>
										</li>
										
										<?php } ?>
									</ul>
								</li>
								<?php }?>
							</ul>
						</div>
						<input type="hidden" name="AUTH_PER">
						<input type="hidden" name="AUTH_FUNC">
					</div>
				</div>
				<!--end::Portlet-->
			</div>
				<!--end: Datatable -->
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="Dialog_ThemMoi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">THÊM MỚI THÔNG TIN DANH MỤC CÔNG VIỆC</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
         </div>
         <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" role="form" method="post" id="formDataInsert">
            <div class="m-portlet__body">
               <div class="form-group m-form__group row">
                  <div class="col-lg-12">
                     <label class="">Danh mục công việc:</label>
					 <?php
							echo $core_class->createSelectDM("danhmuccv_id", "required", "ORDER BY DISORDER");
					?>
                     <p class="has-error"></p>
                  </div>
                 
                  <div class="col-lg-12">
                     <label class="">Tên chuyên khoa:</label><input type="text" id="chuyenkhoa_name" name="chuyenkhoa_name" class="form-control m-input" placeholder="Chuyên khoa" maxlength="10">
                     <p class="has-error"></p>
                  </div>
               </div>
            </div>
            <div class="modal-footer"><button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" id="btnInsert" type="button"><i class="fa fa-print"></i> Lưu</button><button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning Close" data-dismiss="modal" type="button"><i class="fa fa-ban"></i> Hủy bỏ</button></div>
         </form>
      </div>
   </div>
</div>
<div class="modal fade" id="Dialog_CapNhat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
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
<script>
	var Treeview = function () {
		var createTree = function () {
			$('#m_tree_add').jstree({
				'plugins': ["wholerow", "checkbox", "types"],
				'core': {
					"themes" : {
						"responsive": false
					},
				},
				"types" : {
					"default" : {
						"icon" : "fa fa-folder m--font-warning"
					},
					"file" : {
						"icon" : "fa fa-file  m--font-warning"
					}
				},
			});
			$('#m_tree_add').on('changed.jstree', function (e, data) {
				var parentValue = $('li[data-parent]').map(function(){
					if($(this).find('.jstree-clicked').length > 0){
						return $(this).data('parent');
					}
				}).get();
				$("[name=AUTH_PER]").val(parentValue);
				var childValue = [];
				data.selected.forEach(function(elm){
					$("#" + elm).data("id") ? childValue.push($("#" + elm).data("id")) : '';
				});
				$("[name=AUTH_FUNC]").val(childValue);
			})
		}
		return {
			init: function () {
				createTree();
			}
		};
	}();

	$(function(){
		Treeview.init();
		// run selectpicker
		BootstrapSelect.init();
		$('#Ngaysinh').datepicker({
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
	})
	
	$(document).ready(function(){
			 $('#auth_per2').select2({
					placeholder: "Chọn user",
					maximumSelectionLength: 5,
					width: '100%'
					
			});
		
		});
function showDialogEdit(elm){
	var btn = $(elm);
	var chuyenkhoa_id = btn.data("id");
	$.ajax({
		url: "Model_chuyenkhoa.ajax",
		data: {
			act: "load_edit_chuyenkhoa",
			chuyenkhoa_id: chuyenkhoa_id,
		},
		type: "POST",
		async: true,
		beforeSend: function(){
			btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
		},
		success: function(resultHTML){
			btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
			$("#loadContentEdit").html(resultHTML);

			$("#btnUpdate").prop('disabled', false);
			$("#Dialog_CapNhat").modal('show');
		}
	})
}
jQuery(document).ready(function() {
	$('#btnInsert, .btnInsert').click(function(event){
		insertData(event, '<?php echo $com_name ?>', this.id);
	});
	
	/* $('#btnUpdate').click(function(event){
		
		updateData(event, '<?php echo $com_name ?>', this.id);
	}); */
	
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