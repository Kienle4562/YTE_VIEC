<form name="frmSearch" id="frmSearch" class="ClassAddBooking m-form m-form--fit m-form--label-align-right" method="POST">
	<div class="modal-body">
		<div class="m-scrollable" data-scrollbar-shown="false" data-scrollable="false" data-max-height="400">
			<div class="row m_top_10">
				<div class="col-lg-12">
					<div class="m-portlet m-portlet--mobile">
						<div class="m-portlet__body">
							<div class="form-group m-form__group row align-items-center">
								<div class="col-md-6">
									<div class="form-group">
										<label for="recipient-name" class="form-control-label required">
											Từ ngày :
										</label>
											<input tabindex="1" required class="form-control w_full " id="tu_ngay" name="tu_ngay" type="text" value="<?php echo date("d/m/Y", strtotime("+1 days")); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="recipient-name" class="form-control-label required">
											Đến ngày : 
										</label>
										<input tabindex="1" required class="form-control w_full " id="den_ngay" name="den_ngay" type="text" value="<?php echo date("d/m/Y", strtotime("+1 days")); ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="recipient-name" class="form-control-label">
											Loại tour: 
										</label>
										<div class="dich_vu">
											<select name="loai_tour" id="loai_tour" style="margin-bottom: 0px" class="w_full form-control">
													<option value="0">Chọn Loại tour</option>
													<option value="1">Tour hằng ngày</option>
													<option value="2">Tour trọn gói</option>
											</select>
										</div>
									</div>
									
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="recipient-name" class="form-control-label">
											Loại dịch vụ: 
										</label>
										<div class="dich_vu">
											<?php echo $core_class->createSelectBox3("service_id", "", "", "w_full form-control m-bootstrap-select m_selectpicker", "trn"); ?>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="recipient-name" class="form-control-label">
											Kiểu tour : 
										</label>
											<select name="kieu_tour" id="kieu_tour" style="margin-bottom: 0px" class="w_full form-control">
													<option value="0">Chọn kiểu tour</option>
													<option value="1">Tour ghép</option>
													<option value="2">Tour riêng</option>
											</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="recipient-name" class="form-control-label">
											Mã đối tác: 
										</label>
										<div class="dich_vu">
											<input tabindex="3" class="form-control w_full" name="ma_doi_tac" id="ma_doi_tac" maxlength="100" type="text">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="recipient-name" class="form-control-label">
											Booking từ website: 
										</label>
										<div class="m-checkbox-list">
											<label class="m-checkbox m-checkbox--check-bold">
												<input value="1" name="filter_website" id="filter_website" type="checkbox" >
												Phuquoctrip.com
												<span></span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	 <div class="hidden">
		<input type="hidden" name="userid_add" value="<?php echo $_SESSION["session"]["taikhoan_id"]; ?>">
	</div>   
</form>

