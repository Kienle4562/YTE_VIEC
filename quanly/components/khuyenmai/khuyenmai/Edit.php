<?php
	$arraySource = array(
		'dist/component/dangtuyen/dangtuyen.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.min.js' => 'js',
	);
	$core_class->loadSource($arraySource);
	$khuyenmai_id = $_POST['khuyenmai_id']."aaa";
	$row = $core_class->find("mst_khuyen_mai", array(
		'khuyenmai_id',
		'code_km',
		'ten_km',
		'loai_giam_km',
		'gia_tri_giam',
		'ngay_het_han',
		'so_luong_ma',
		'ghi_chu',
		'status',
	), array(
		'khuyenmai_id' => $khuyenmai_id
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
				<label class="required">Mã khuyến mãi:</label>
				<input type="text" id="code_km" name="code_km" value="<?php echo $row['code_km'] ?>" class="form-control m-input"
					placeholder="Mã dịch vụ" readonly maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Tên khuyến mãi:</label>
				<div class="input-group">
					<input type="text" id="ten_km" value="<?php echo $row['ten_km'] ?>"  name="ten_km" class="form-control m-input"
						placeholder="Tên khuyến mãi" required maxlength="50">
				</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Giá giảm:</label>
				<input type="text" id="gia_tri_giam" value="<?php echo $row['gia_tri_giam'] ?>"  name="gia_tri_giam" class="form-control m-input currency"
					placeholder="Giá dịch vụ" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Ngày hết hạn:</label>
				<input type="text" id="ngay_het_han" name="ngay_het_han" value="<?php echo $row['ngay_het_han'] ?>"  class="form-control m-input currency" placeholder="nhập số ngày hiển thị dịch vụ" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Số lượng mã:</label>
				<input type="text" id="so_luong_ma" value="<?php echo $row['so_luong_ma'] ?>"  name="so_luong_ma" class="form-control m-input"
					placeholder="Số lượng mã" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label >Loại giảm: </label>
					<select class="form-control m-bootstrap-select m_selectpicker" name="type_discount" id="type_discount" >
						<option  value="PHAN_TRAM" class="ng-binding"> -- Giảm phần trăm -- </option>
						<option  value="TIEN_MAT" class="ng-binding"> -- Giảm tiền trực tiếp-- </option>
					</select>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Mô tả khuyến mãi:</label>
				<textarea data-provide="markdown" name="ghi_chu" class="form-control"> <?php echo $row['ghi_chu'] ?> </textarea>
				<p class="has-error"></p>
			</div>
			
			<div class="col-lg-4">
				<label class="">Trạng thái:</label>
				<div class="m-checkbox-list">
					<label class="m-checkbox">
						<input name="status" <?php if($row['status'] == 1){echo 'checked';}else{echo '';} ?>  value="1" type="checkbox" checked>
						Check vào ô
						<span></span>
					</label>
				</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>
	<input type="hidden" name="khuyenmai_id" value="<?php echo $row['khuyenmai_id'] ?>">
</form>
<script>
	
	$(function(){
		
		BootstrapSelect.init();
		$('#ngay_het_han').datepicker({
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