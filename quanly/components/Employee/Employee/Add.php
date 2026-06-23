<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed"
	name="formDataInsert" role="form" method="post" id="formDataInsert">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<!-- <div class="col-lg-4">
				<label class="required">Chọn văn phòng: </label>
				<select class="form-control m-bootstrap-select m_selectpicker" name="vanphong" id="vanphong" >
					<option value="1" class="ng-binding"> -- Văn phòng chính -- </option>
					<option value="2" class="ng-binding"> -- Chi nhánh -- </option>
				</select>
				<p class="has-error"></p>
			</div> -->
			<!-- <div class="col-lg-4">
				<label class="required">Chức vụ: </label>
				<?php echo $core_class->createSelectBox_3("chucvu_id", "", "required", "form-control m-bootstrap-select m_selectpicker"); ?>
				<p class="has-error"></p>
			</div> -->
			<div class="col-lg-4">
				<label class="required">Loại nhân viên: </label>
					<select class="form-control m-bootstrap-select m_selectpicker" name="loai_nv" id="loai_nv" >
						<option value="1" class="ng-binding"> --Nhân viên chính thức -- </option>
						<option  value="2" class="ng-binding"> -- Nhân viên cộng tác -- </option>
						<option  value="3" class="ng-binding"> -- Nhân viên thử việc -- </option>
					</select>
				<p class="has-error"></p>
			</div>
		</div>
	</div>
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="required">Tên tài khoản:</label>
				<input type="text" id="account" name="account" class="form-control m-input"
					placeholder="Tên tài khoản" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Mật khẩu :</label>
				<div class="input-group">
					<input type="text" id="passWd" name="passWd" class="form-control m-input"
						placeholder="Mật khẩu" required maxlength="50">
					<div class="input-group-append">
						<input type="button"
							class="btn m-btn m-btn--gradient-from-warning m-btn--gradient-to-danger"
							value="Generate" onClick="generate();" tabindex="2">
					</div>
				</div>
				<input type="hidden" name="length" value="10">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Họ tên:</label>
				<input type="text" id="fullname" name="fullname" class="form-control m-input"
					placeholder="Họ tên" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Ngày sinh:</label>
				<div class="input-group date">
				<input required id="Ngaysinh" name="Ngaysinh" class="form-control w_full datepicker" type="text">
								</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Điện thoại:</label>
				<input type="text" id="phoneNumber" name="phoneNumber" class="form-control m-input"
					placeholder="Điện thoại" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Email:</label>
				<input type="email" id="email" name="email" class="form-control m-input" placeholder="Email"
					required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>CMND:</label>
				<input type="text" id="cmnd" name="cmnd" class="form-control m-input" placeholder="CMND" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Địa chỉ :</label>
				<input type="text" id="address" name="address" class="form-control m-input" placeholder="Địa chỉ" required="" maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4"></div>
			<div class="col-lg-4"></div>
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
						<div id="m_tree_add">
						<?php
							$myprocess = new process();
							$resultQuyenHan = $myprocess->get_quyenhan();
						?>
							<ul>
								<?php
									while ($rowQuyenHan = $resultQuyenHan->fetch(PDO::FETCH_ASSOC)){
								?>
								<li data-parent="<?php echo $rowQuyenHan["Id"]; ?>" data-jstree='{ "id" : <?php echo $rowQuyenHan["Id"]; ?> }'>
									<?php echo $rowQuyenHan["tenquyen"]; ?>
									<ul>
										<?php
											$result_cn = $myprocess->get_chucnang($rowQuyenHan['Id']);
											while ($rowcn = $result_cn->fetch(PDO::FETCH_ASSOC)){
										?>
										<li data-id="<?php echo $rowcn["Id"]; ?>" data-jstree='{ "id" : <?php echo $rowcn["Id"]; ?> }'>
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
	<input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION["session"]["taikhoan_id"] ?>" />
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