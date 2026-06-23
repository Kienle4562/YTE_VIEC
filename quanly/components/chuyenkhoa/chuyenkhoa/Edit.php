<?php
	$chuyenkhoa_id = $_POST['chuyenkhoa_id'];
	$row = $core_class->find("mst_chuyenkhoa", array(
		'chuyenkhoa_id',
		'chuyenkhoa_name',
		'danhmuccv_id',
		'DISORDER',
	), array(
		'chuyenkhoa_id' => $chuyenkhoa_id
	))
?>

<style>
	.bootstrap-tagsinput{
		width: 100%;
	}
	
</style>
 <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" role="form" method="post" id="formDataUpdate">
	<div class="modal fade" id="Dialog_CapNhat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	   <div class="modal-dialog " role="document">
		  <div class="modal-content">
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
						 <label class="">Tên chuyên khoa:</label><input type="text" value="<?php echo $row['chuyenkhoa_name'] ?>" id="chuyenkhoa_name" name="chuyenkhoa_name" class="form-control m-input" placeholder="Chuyên khoa" maxlength="10">
						 <p class="has-error"></p>
					  </div>
					 
				   </div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="danhmuccv_id" name="danhmuccv_id">
					<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" id="btnUpdate" type="button">
						<i class="fa fa-print"></i> Lưu
					</button>
						<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning Close" data-dismiss="modal" type="button"><i class="fa fa-ban"></i>Hủy bỏ</button>
				</div>
			
		  </div>
	   </div>
</div>
	<input type="hidden" name="act" value="update_job">
	<input type="hidden" name="congviec_id" value="<?php echo $row['congviec_id'] ?>">
	<input type="hidden" name="ck_id" value="<?php echo $row['chuyenkhoa_id'] ?>">
</form>
<script>
	$('#formDataUpdate .m_selectpicker').val();
	$('#formDataUpdate .m_selectpicker').selectpicker();
	$(".currency").keyup(function(){
		$(this).val(format($(this).val()));
	});

</script>