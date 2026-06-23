<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" name="formDataUpdate" role="form" method="post" id="formDataUpdate">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
		<!-- 	<div class="col-lg-4">
				<label class="required">Chọn văn phòng: </label>
				<select class="form-control m-bootstrap-select m_selectpicker" name="vanphong" id="vanphong" >
					<option <?php echo $result['vanphong'] == 1 ? 'selected' : '' ?> value="1" class="ng-binding"> -- Văn phòng chính -- </option>
					<option <?php echo $result['vanphong'] == 2 ? 'selected' : '' ?> value="2" class="ng-binding"> -- Chi nhánh -- </option>
				</select>
				<p class="has-error"></p>
			</div> -->
			<!-- <div class="col-lg-4">
				<label class="required">Chức vụ:</label>
				<?php echo $core_class->createSelectBox_3("chucvu_id", $result['chucvu_id'], "required", "w_full form-control m-bootstrap-select m_selectpicker"); ?>
				<p class="has-error"></p>
			</div> -->
			<div class="col-lg-4">
				<label class="required">Loại nhân viên: </label>
					<select class="form-control m-bootstrap-select m_selectpicker" name="loai_nv" id="loai_nv" >
						<option <?php echo $result['loai_nv'] == 1 ? 'selected' : '' ?> value="1" class="ng-binding"> --Nhân viên chính thức -- </option>
						<option <?php echo $result['loai_nv'] == 2 ? 'selected' : '' ?> value="2" class="ng-binding"> -- Nhân viên cộng tác -- </option>
						<option <?php echo $result['loai_nv'] == 3 ? 'selected' : '' ?> value="3" class="ng-binding"> -- Nhân viên thử việc -- </option>
					</select>
				<p class="has-error"></p>
			</div>
		</div>
	</div>
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="required">Tên tài khoản:</label>
				<input value="<?php echo $result['Tendangnhap'] ?>" type="text" id="taikhoan" name="taikhoan" class="form-control m-input"
					placeholder="Tên tài khoản" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Mật khẩu :</label>
				<div class="input-group">
					<input type="text" id="passWd" name="passWd" class="form-control m-input"
						placeholder="Mật khẩu" maxlength="50">
					<div class="input-group-append">
						<input type="button"
							class="btn m-btn m-btn--gradient-from-warning m-btn--gradient-to-danger"
							value="Generate" onClick="generateUpdate();" tabindex="2">
					</div>
				</div>
				<input type="hidden" name="length" value="10">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Họ tên:</label>
				<input value="<?php echo $result['Hoten'] ?>" type="text" id="Hoten" name="Hoten" class="form-control m-input"
					placeholder="Họ tên" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Ngày sinh:</label>
				<div class="input-group date">
				<input required id="Ngaysinh" name="Ngaysinh" value="<?php echo date("d/m/Y",strtotime($result['Ngaysinh'])) ?>" class="form-control w_full datepicker" type="text">
								</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Điện thoại:</label>
				<input value="<?php echo $result['Didong'] ?>" type="text" id="Didong" name="Didong" class="form-control m-input"
					placeholder="Điện thoại nhập số" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Email:</label>
				<input value="<?php echo $result['Email'] ?>" type="email" id="email" name="email" class="form-control m-input" placeholder="Email"
					required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>CMND:</label>
				<input type="text" id="cmnd" name="cmnd" class="form-control m-input" placeholder="nhập CMND" required="" maxlength="50" value ="<?php echo $result['Cmnd'] ?>">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Địa chỉ :</label>
				<input value="<?php echo $result['Diachi'] ?>" type="text" id="Diachi" name="Diachi" class="form-control m-input" placeholder="Địa chỉ" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Trạng thái :</label>
				<div style="margin-top: -5px;" class="m-radio-inline">
					<label class="m-radio">
						<input type="radio" id="rdb1" <?php echo $result['Trangthai'] == 1 ? 'checked' : '' ?> name="Trangthai" value="1">
								Activer tài khoản
						<span></span>
					</label>
					<label class="m-radio">
						<input type="radio" id="rdb2" <?php echo $result['Trangthai'] == 0 ? 'checked' : '' ?> name="Trangthai" value="0">
						Khóa tài khoản
						<span></span>
					</label>
				</div>
			</div>
			<div class="col-lg-12 m_top_15">
				<!--begin::Portlet-->
				<div class="m-portlet m-portlet--bordered m-portlet--rounded m-portlet--unair m-portlet--head-sm m_bottom_10">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title">
								<h3 class="m-portlet__head-text">
									Phân quyền
								</h3>
							</div>
						</div>
					</div>
					<div class="m-portlet__body">
						<?php
							$myprocess = new process();
							$resultQuyenHan = $myprocess->get_quyenhan();
							$arrayAUTHPER = explode(",", $result['AUTH_PER']);
							$arrayAUTHFUNC = explode(",", $result['AUTH_FUNC']);
						?>
						<div id="m_tree_edit">
							<ul>
								<?php
									while ($rowQuyenHan = $resultQuyenHan->fetch(PDO::FETCH_ASSOC)){
										// get child -> AUTH_FUNC
										$result_cn = $myprocess->get_chucnang($rowQuyenHan['Id']);

										$isExits = in_array($rowQuyenHan["Id"], $arrayAUTHPER);
										$opened = "";
										if($isExits && $result_cn->rowCount() == 0){
											$opened = '{ "selected" : true }';
										}
								?>
								<li data-jstree='<?php echo $opened ?>' data-parent="<?php echo $rowQuyenHan["Id"]; ?>">
									<?php echo $rowQuyenHan["tenquyen"]; ?>
									<ul>
										<?php
											while ($rowcn = $result_cn->fetch(PDO::FETCH_ASSOC)){
												$isExits = in_array($rowcn["Id"], $arrayAUTHFUNC);
												$opened = "";
												if($isExits){
													$opened = '{ "selected" : true }';
												}
										?>
										<li data-jstree='<?php echo $opened ?>' data-id="<?php echo $rowcn["Id"]; ?>">
											<a href="javascript:;">
												<?php echo $rowcn['chucnang'] ?>
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
		</div>
	</div>
	<input type="hidden" name="taikhoan_id" id="taikhoan_id" value="<?php echo $_POST['employee_id'] ?>" />
	<input type="hidden" name="userid" id="userid" value="<?= $_SESSION["session"]["taikhoan_id"] ?>" />
</form>
<script>
	var Treeview = function () {
		var createTree = function () {
			$('#m_tree_edit').jstree({
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
			$('#m_tree_edit').on('changed.jstree', function (e, data) {
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
</script>