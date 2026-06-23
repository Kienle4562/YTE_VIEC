<?php 
/* $arraySource = array(
		'dist/component/dangtuyen/dangtuyen.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.min.js' => 'js',
	);
	$core_class->loadSource($arraySource); */
?>
<style>
	.bootstrap-tagsinput{
		width: 100%;
	}
	.m-typeahead .twitter-typeahead{
		position: relative;
		display: inline-block !important;
		width: 100px;
	}
</style>
<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" 
	role="form" method="post" id="formDataInsert">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="required">Tên dịch vụ:</label>
				<input type="text" id="service_name" name="service_name" class="form-control m-input"
					placeholder="Tên dịch vụ" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Mã dịch vụ:</label>
				<div class="input-group">
					<input type="text" id="service_code" name="service_code" class="form-control m-input"
						placeholder="Mã dịch vụ" required maxlength="50">
				</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Giá dịch vụ:</label>
				<input type="text" id="service_price" name="service_price" class="form-control m-input currency"
					placeholder="Giá dịch vụ" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Ngày hiển thị:</label>
				<input type="text" id="operation" name="operation" class="form-control m-input currency"
					placeholder="Số ngày sử dụng, hiển thị" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label >Loại giảm: </label>
					<select class="form-control m-bootstrap-select m_selectpicker" name="type_discount" id="type_discount" >
					    <option value="0" class="ng-binding"> --Chọn loại giảm-- </option>
						<option value="1" class="ng-binding"> --Giảm phần trăm -- </option>
						<option  value="2" class="ng-binding"> -- Giảm tiền trực tiếp-- </option>
					</select>
				<p class="has-error"></p>
			</div>

			<div class="col-lg-4">
				<label>Giảm giá:</label>
				<input type="text" id="discount" name="discount" class="form-control m-input"
					placeholder="Giảm giá" maxlength="50">
				<p class="has-error"></p>
			</div>
			
			<div class="col-lg-4">
				<label>Mô tả gói dịch vụ:</label>
				<textarea data-provide="markdown" name="description" class="form-control"></textarea>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Điểm dịch vụ:</label>
				<input type="text" id="point" name="point" class="form-control m-input"
					placeholder="Điểm dịch vụ "  maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Icon:</label>
				<input type="text" id="icon" name="icon" class="form-control m-input" placeholder="flaticon-search"  maxlength="50">
				<p class="has-error"></p>
			</div>
				
			<div class="col-lg-4">
				<label class="">Trạng thái:</label>
				<div class="m-checkbox-list">
					<label class="m-checkbox">
						<input name="status" value="1" type="checkbox" checked>
						Check vào ô
						<span></span>
					</label>
				</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4"></div>
			<div class="col-lg-12 m_top_15">
				<!--begin::Portlet-->
				<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair m-portlet--head-sm m_bottom_10">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Tính năng dịch vụ
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<div id="m_tree_add">
						
							<ul>
								<?php
									$myprocess = new process();
									$resultQuyenHan = $myprocess->get_chucnang();
									while ($rowQuyenHan = $resultQuyenHan->fetch(PDO::FETCH_ASSOC)){
								?>
								<li data-parent="<?php echo $rowQuyenHan["id_function"]; ?>"  data-code="<?php echo $rowQuyenHan["attrib_function"]; ?>"  data-jstree='{"id" :<?php echo $rowQuyenHan["id_function"]; ?>}'>
									<?php echo $rowQuyenHan["label_function"]; ?>
								</li>
								<?php } ?>
							</ul>
						</div>
						<input type="hidden" name="AUTH_PER">
						<input type="hidden" name="code_function">
					</div>
				</div>
				<!--end::Portlet-->
			</div>
		</div>
	</div>

</form>
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
				var parentCode = $('li[data-parent]').map(function(){
					if($(this).find('.jstree-clicked').length > 0){
						return $(this).data('code');
					}
				}).get();
				$("[name=code_function]").val(parentCode);
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
	$(".currency").keyup(function(){
		$(this).val(format($(this).val()));
	});


</script>