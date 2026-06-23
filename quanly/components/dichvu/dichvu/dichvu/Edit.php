<?php
	$arraySource = array(
		'dist/component/dangtuyen/dangtuyen.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.min.js' => 'js',
	);
	$core_class->loadSource($arraySource);
	$service_id = $_POST['service_id'];
	$row = $core_class->find("mst_service", array(
		'service_id',
		'id_function',
		'code_function',
		'service_name',
		'note',
		'service_code',
		'service_price',
		'description',
		'operation',
		'point',
		'discount',
		'type_discount',
		'status',
		'icon',
	), array(
		'service_id' => $service_id
	))
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
	role="form" method="post" id="formDataUpdate">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="required">Tên dịch vụ:</label>
				<input type="text" id="service_name" name="service_name" class="form-control m-input"
					placeholder="Tên dịch vụ" required value="<?php echo $row['service_name'] ?>" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Mã dịch vụ:</label>
				<div class="input-group">
					<input type="text" id="service_code" name="service_code" class="form-control m-input"
						placeholder="Mã dịch vụ" value="<?php echo $row['service_code'] ?>" required maxlength="50">
				</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Giá dịch vụ:</label>
				<input type="text" id="service_price" name="service_price" class="form-control m-input currency"
					placeholder="Giá dịch vụ" required value="<?php echo number_format($row['service_price'], 0); ?>" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Ngày hiển thị:</label>
				<input type="text" id="operation" name="operation" class="form-control m-input currency"
					placeholder="Số ngày sử dụng, hiển thị" value="<?php echo $row['operation'] ?>"  required maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label >Loại giảm: </label>
					<select class="form-control m-bootstrap-select m_selectpicker" name="type_discount" id="type_discount" >
					    <option <?php echo $row['type_discount'] == 0 ? 'selected' : '' ?> value="0" class="ng-binding"> --Chọn loại giảm-- </option>
						<option <?php echo $row['type_discount'] == 1 ? 'selected' : '' ?> value="1" class="ng-binding"> --Giảm phần trăm -- </option>
						<option <?php echo $row['type_discount'] == 2 ? 'selected' : '' ?> value="2" class="ng-binding"> -- Giảm tiền trực tiếp-- </option>
					</select>
				<p class="has-error"></p>
			</div>

			<div class="col-lg-4">
				<label>Giảm giá:</label>
				<input type="text" id="discount" name="discount" class="form-control m-input" placeholder="Giảm giá" value="<?php echo $row['discount'] ?>" maxlength="50">
				<p class="has-error"></p>
			</div>
			
			<div class="col-lg-4">
				<label>Mô tả gói dịch vụ:</label>
				<textarea data-provide="markdown" name="description" class="form-control"><?php echo $row['description'] ?></textarea>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Điểm dịch vụ:</label>
				<input type="text" id="point" name="point" class="form-control m-input"placeholder="Điểm dịch vụ " value="<?php echo $row['point'] ?>"  maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Icon:</label>
					<input type="text" id="icon" name="icon" class="form-control m-input" placeholder="flaticon-search"  value="<?php echo $row['icon'] ?>"  maxlength="50">
				<p class="has-error"></p>
			</div>
				
			<div class="col-lg-4">
				<label class="">Trạng thái:</label>
				<div class="m-checkbox-list">
					<label class="m-checkbox">
						<input name="status" <?php echo $row['status'] == 1 ? 'checked' : '' ?> value="1" type="checkbox" checked>
							Check vào ô
						<span></span>
					</label>
				</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4"></div>
			<input type="hidden" name="act" value="Update">
			<input type="hidden" name="service_id" value="<?php echo $row['service_id'] ?>">
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