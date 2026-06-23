<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	include_once("Model.php");
	$myprocess = new process();
	$title = "";
	$action = "";
	$btn = "";
	$congviec_id = empty($_REQUEST["id"]) ? 0 : $_REQUEST["id"];
	$congty_id = $_SESSION["session"]["Id"];
	if($view == "Add"){
		$title = "Đăng Tuyển Dụng";
		$action = "dangtin";
		$btn = "Đăng tin";
	}else{
		$title = "Cập Nhật Thông Tin Tuyển Dụng";
		$action = "Update";
		$btn = "Cập nhật";
	}
	$arraySource = array(
		'dist/assets/component/dangtuyen/dangtuyen.css' => 'css',
		'dist/assets/component/dangtuyen/dangtuyen.js' => 'js',
		'dist/assets/component/dangtuyen/bootstrap-tagsinput.css' => 'css',
		'dist/assets/component/dangtuyen/bootstrap-tagsinput.min.js' => 'js',
	);
	$core_class->loadSource($arraySource);

	// load công việc
	$columns = array(
		'noilamviec',
	);
	$wheres = array(
		"congviec_id" => $congviec_id
	);
	$rows = $core_class->find('trn_congviec', $columns, $wheres);

	// load công ty
	$columns = array(
		'nguoilienhe',
		"loaihinhhoatdong_id",
		"loaihinhhoatdong2_id",
		"loaihinhhoatdong3_id",
		"loaihinhhoatdongkhac",
		"loaihinhhoatdongkhac2",
		"loaihinhhoatdongkhac3",
	);
	$wheres = array(
		"congty_id" => $congty_id
	);
	$rowcomp = $core_class->find('trn_congty', $columns, $wheres);
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
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<!--Begin::Main Portlet-->
		<div class="m-portlet m-portlet--full-height">
			<!--begin: Portlet Head-->
			<div style="display:none" class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							<?php echo $title ?>
						</h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						<li class="m-portlet__nav-item">
							<a href="#" data-toggle="m-tooltip" class="m-portlet__nav-link m-portlet__nav-link--icon" data-direction="left" data-width="auto" title="Đăng tin tuyển dụng của bạn">
								<i class="flaticon-info m--icon-font-size-lg3"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--end: Portlet Head-->
			<!--begin: Form Wizard-->
			<div class="m-wizard m-wizard--2 m-wizard--success" id="m_wizard">
				<!--begin: Message container -->
				<div class="m-portlet__padding-x">
					<!-- Here you can put a message or alert -->
				</div>
				<!--end: Message container -->
				<!--begin: Form Wizard Head -->
				<div class="m-wizard__head m-portlet__padding-x">
					<!--begin: Form Wizard Progress -->
					<div class="m-wizard__progress">
						<div class="progress">
							<div class="progress-bar" role="progressbar"  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
					<!--end: Form Wizard Progress -->  
					<!--begin: Form Wizard Nav -->
					<div class="m-wizard__nav">
						<div class="m-wizard__steps">
							<div class="m-wizard__step m-wizard__step--current"  data-wizard-target="#m_wizard_form_step_1">
								<a href="#"  class="m-wizard__step-number">
									<span>
										<i class="fa flaticon-imac"></i>
									</span>
								</a>
								<div class="m-wizard__step-info">
									<div class="m-wizard__step-title">
										Thông tin tuyển dụng
									</div>
								</div>
							</div>
							<div class="m-wizard__step" data-wizard-target="#m_wizard_form_step_2">
								<a href="#" class="m-wizard__step-number">
									<span>
										<i class="fa flaticon-chat-1"></i>
									</span>
								</a>
								<div class="m-wizard__step-info">
									<div class="m-wizard__step-title">
										Thông tin liên hệ
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end: Form Wizard Nav -->
				</div>
				<!--end: Form Wizard Head -->  
				<!--begin: Form Wizard Form-->
				<div class="m-wizard__form">
					<form class="m-form m-form--label-align-left- m-form--state-" id="m_form" method="post">
						<!--begin: Form Body -->
						<div id='loader' class="loading-process" style='display: none;'>
									 <img src='/image/loading.gif'>
						</div>
						<div class="m-portlet__body">
							<!--begin: Form Wizard Step 1-->
							<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
								<div class="row">
									<div class="col-xl-10 offset-xl-1">
										<div class="m-form__section m-form__section--first">
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Chức danh tuyển dụng:
												</label>
												<div class="col-xl-9 col-lg-9">
													<input required type="text" name="tencongviec" class="form-control m-input" placeholder="VD: Bác Sỹ Nội Trú">
													<span class="m-form__help">
														<b>Lưu ý :</b>
														<div>- Bạn nên đặt tên vị trí/chức danh phổ biến, đơn giản như “Trưởng phòng”, “Nhân viên”.</div>
														<div>- Đây là yếu tố quan trọng thu hút các ứng viên ứng tuyển và chúng tôi gợi ý các hồ sơ phù hợp.</div>
													</span>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Mô tả công việc:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea required data-provide="markdown" class="form-control m-input" name="motacongviec"></textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Yêu cầu công việc:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea required data-provide="markdown" class="form-control m-input" name="chuyenmonyeucau"></textarea>
												</div>
											</div>
											<!--<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Nộp hồ sơ:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea data-provide="markdown" class="form-control m-input" name="nophoso"></textarea>
												</div>
											</div>-->
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													Yêu cầu hồ sơ:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea data-provide="markdown" class="form-control m-input" name="yeucauhoso" required></textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													Quyền lợi:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea data-provide="markdown" class="form-control m-input" name="quyenloi" required></textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
												<span class="red">*</span> Số lượng cần tuyển:
												</label>
												<div class="col-xl-9 col-lg-9">
													<input type="number" maxlength="50" name="soluongcantuyen" class="form-control m-input" required>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Danh mục công việc:
												</label>
												<div class="col-xl-4 col-lg-3">
													<?php
														echo $core_class->createSelectBox3("danhmuccv_id", "required", "ORDER BY DISORDER");
													?>
												</div>
												<label class="col-xl-2 col-lg-2 col-form-label">
													<span class="red">*</span><span class="lbaction"> Chọn chuyên khoa </span>:
												</label>
												<div class="col-xl-3 col-lg-3">
													<div class="chuyenkhoa">
													<?php
														echo $core_class->createSelectBox3("chuyenkhoa_id", "required", "ORDER BY DISORDER");
													?>
													</div>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Nơi làm việc (tối đa 3 địa điểm):
												</label>
												<div class="col-xl-9 col-lg-9 m-typeahead">
													<!--<input required type="text" placeholder="Nhập chữ có dấu" value="<?php echo $rows['noilamviec'] ?>" data-role="tagsinput" class="form-control tagsinput" name="noilamviec">-->
													<select class="form-control m-select2" id="tentinhthanh" name="tentinhthanh[]" multiple required>
															<?php
																	$myprocess = new process();
																	$rsTT = $myprocess->loadTinhThanh();
																	while($rowTT = $rsTT->fetch())
															{?>
																	<option value="<?php echo $rowTT['ten_tinhthanh'] ?>"><?php echo $rowTT['ten_tinhthanh'] ?></option>		
														   <?php	} 
																?>
													</select>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													Mức lương hàng tháng:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createSelectBox3("loaitien_id", "required", "ORDER BY DISORDER", "form-control col-lg-2 f_left");
													?>
													<span class="col-lg-2 f_left m_top_10">tối thiểu:</span>
													<div class="f_left col-lg-2">
														<input type="text" name="mucluongtoithieu" class="form-control m-input currency">
													</div>
													<span class="col-lg-2 f_left m_top_10">tối đa:</span>
													<div class="f_left col-lg-2">
														<input type="text" name="mucluongtoida" class="form-control m-input currency">
													</div>
												</div>
											</div>
											<div class="form-group m-form__group">
												<div class="alert m-alert m-alert--default" role="alert">
													<div>Bỏ trống cả hai nếu bạn muốn để mức lương là thỏa thuận.</div>
												</div>
											</div>
											<div class="form-group m-form__group">
												<div class="alert m-alert m-alert--default" role="alert">
													<code>Lưu ý:</code>
													<div>- 72% ứng viên chia sẻ rằng thông tin lương ảnh hưởng đến quyết định ứng tuyển của họ. </div>
													<div>- Bạn có thể quyết định “hiển thị thông tin lương” để thu hút thêm nhiều hồ sơ ứng tuyển vào vị trí tuyển dụng.</div>
													<div class="red">- Bạn nên nhập cả hai mức lương tối thiểu và tối đa cho vị trí cần đăng tuyển.</div>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Hình thức:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														$next_due_date = date('d/m/Y', strtotime("+30 days"));

														//echo $core_class->createCheckBox("loaihinhcongviec_id");
														echo $core_class->createCheckBox2(
															"mst_loaihinhcongviec", // table
															"loaihinhcongviec_id", // column1
															"tenloaihinhcongviec", // column2
															"required", // $attribute
															"", // where
															array(), // split, data
															"", // content
															"loaihinhcongviec_id[]"
														);
													?>
													
												</div>
												<p class="has-error"></p>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Hạn nhận hồ sơ:
												</label>
												<div class="col-xl-5 col-lg-5">
													<div class="input-group date">
														<!--<input type="text" id="ngayhethan" name="ngayhethan" class="form-control m-input datepicker" value="<?php echo $next_due_date; ?>" readonly > -->
														<input type="text" id="ngayhethan" name="ngayhethan" class="form-control m-input" value="<?php echo $next_due_date; ?>" readonly >
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-calendar-check-o"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Email nhận hồ sơ:
												</label>
												<div class="col-xl-5 col-lg-5">
													<div class="input-group">
														<input type="text" class="form-control m-input" name="email" id="email" value="<?php echo $_SESSION["session"]["Tendangnhap"] ?>" data-role="tagsinput" size="150">
													</div>
												</div>
											</div>
										</div>
									
										<div class="m-separator m-separator--dashed m-separator--lg"></div>
										<div class="m-form__section">
											<div class="m-form__heading">
												<h3 class="m-form__heading-title">
													<span class="red">*</span> Phúc lợi
												</h3>
											</div>
											<div class="form-group m-form__group row">
												<div class="col-xl-12 col-lg-12">
													<?php
														echo $core_class->createCheckBox("phucloi_id", "content");
													?>
												</div>
											</div>
										</div>
									
										<div class="m-separator m-separator--dashed m-separator--lg"></div>
											<div class="m-form__section">
												<div class="m-form__heading">
													<h3 class="m-form__heading-title">
														Yêu cầu chung
													</h3>
												</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													Giới tính:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createRadioBox("gioitinh_id");
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													Tuổi:
												</label>
												<div class="col-xl-9 col-lg-9">
													<input type="text" name="dotuoi" placeholder="ví dụ nhập : 19 - 25" class="form-control m-input" required>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													<span class="red">*</span> Kinh nghiệm:
												</label>
												<div class="col-xl-6 col-lg-6">
													<?php
														echo $core_class->createSelectBox3("kinhnghiem_id");
													?>
												</div>
												<div class="col-xl-3 col-lg-3">
													<input type="text" name="sonamkinhnghiem" placeholder="Vd : 1-5 năm" class="form-control m-input red" style="display:none">
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													<span class="red">*</span> Cấp bậc:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createSelectBox3("capbac_id");
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													Bằng cấp:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createSelectBox3("bangcap_id");
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													<span class="red">*</span>  Ngôn ngữ yêu cầu:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														//echo $core_class->createCheckBox("yeucauhoso_id");
														echo $core_class->createCheckBox2(
															"mst_yeucauhoso", // table
															"yeucauhoso_id", // column1
															"tenyeucauhoso", // column2
															"required", // $attribute
															"", // where
															array(), // split, data
															"", // content
															"yeucauhoso_id[]"
														);
													?>
												</div>
											</div>
											<?php
										$result_service = $myprocess->get_dichvu();
										if($result_service->rowCount()>0){
										
									 ?>
									<div class="m-separator m-separator--dashed m-separator--lg"></div>
									  <div class="bg_blue_light">
										<div class="m-form__section">
											<div class="m-form__heading">
												<h3 class="m-form__heading-title">
													Dịch vụ đang sử dụng
												</h3>
											</div>
											<div class="m-checkbox-inline" id="dichvu_id">
													<?php 
														//$row_s = $result_service->fetch();
														$count = 0;
														$total_c = 0;
														while($row_s = $result_service->fetch()) {
														 
														    $count = $row_s['qty'] - $row_s['qty_ext']; 
															$total_c += $row_s['qty'] - $row_s['qty_ext'];
															if($count >0){
													?>
														<label class="m-checkbox">
															<input type="checkbox" value="<?php echo $row_s['customer_id']?>" name="<?php echo $row_s['attrib_function'] ?>" class="chkCheckBoxSevicer" data-detail="<?php echo $row_s['customer_detail_id'] ?>">
															  	<?php if($row_s['attrib_function'] =='hot_job') { echo 'Hot Job';}else if($row_s['attrib_function'] =='power_job'){ echo 'Power Job'; }else{echo 'Post basic';} ?> <span></span><p class="m-badge m-badge--success"><?php echo $count ?></p>
														</label>
														
												<?php }
														}
												?>
												<?php if($total_c > 0) { ?>
												<input type="hidden" id="customer_detail_id" name="dich_vu_select" value='0'>
												<input type="hidden" name="fee" value='1'>
												<?php }else { ?>
													<p> Đã sử dụng hết dịch vụ . Bạn chỉ được đăng tin thường</p>
													<input type="hidden" value="0" name="dich_vu_select">
												<?php } ?>
											</div>
										  </div>
										</div>
										<?php }else { ?>
										
											<input type="hidden" value="0" name="dich_vu_select">
										<?php } ?>
											<?php
												// đăng tin lần đầu tiên sẽ hiển thị thông tin này
												$countCongViec = $myprocess->countCongViec();
											?>
											<div style="<?php echo $countCongViec > 0 ? "display:none" : "" ?>" class="m-separator m-separator--dashed m-separator--lg"></div>
											<div style="<?php echo $countCongViec > 0 ? "display:none" : "" ?>">
												<div class="m-form__heading">
													<h3 class="m-form__heading-title">
														Cập nhật công ty
													</h3>
												</div>
												<div class="form-group m-form__group row">
													<label class="col-xl-2 col-lg-2 col-form-label">
														Người liên hệ:
													</label>
													<div class="col-xl-9 col-lg-9">
														<input type="text" name="nguoilienhe" placeholder="Nhân sự" value="<?php echo empty($rowcomp['nguoilienhe']) ? "Nhân sự" : $rowcomp['nguoilienhe'] ?>" class="form-control m-input">
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label class="col-xl-2 col-lg-2 col-form-label">
														Loại hình hoạt động:
													</label>
													<div id="LHHD1" class="col-xl-3 col-lg-3">
														<?php
															echo $myprocess->CreateSelectBoxLHHD($rowcomp['loaihinhhoatdong_id'], "loaihinhhoatdong_id", "loaihinhhoatdongkhac");
														?>
													</div>
													<div style="<?php echo $rowcomp['loaihinhhoatdong2_id'] == 0 ? "display:none" : "" ?>" id="LHHD2" class="col-xl-3 col-lg-3">
														<?php
															echo $myprocess->CreateSelectBoxLHHD($rowcomp['loaihinhhoatdong2_id'], "loaihinhhoatdong2_id", "loaihinhhoatdongkhac2");
														?>
														<div class="showicon" style="padding-top: 10px">
															<span class="ic_remove"></span>
															<span>
																<a href="javascript:void(0);" onclick="removeLHHD('LHHD2')">Xóa</a>
															</span>
														</div>
													</div>
													<div style="<?php echo $rowcomp['loaihinhhoatdong3_id'] == 0 ? "display:none" : "" ?>" id="LHHD3" class="col-xl-3 col-lg-3">
														<?php
															echo $myprocess->CreateSelectBoxLHHD($rowcomp['loaihinhhoatdong3_id'], "loaihinhhoatdong3_id", "loaihinhhoatdongkhac3");
														?>
														<div class="showicon" style="padding-top: 10px">
															<span class="ic_remove"></span>
															<span>
																<a href="javascript:void(0);" onclick="removeLHHD('LHHD3')">Xóa</a>
															</span>
														</div>
													</div>
													<div class="f_left" id="addLHHD" style="padding-top: 10px;<?php echo (!empty($rowcomp['loaihinhhoatdong3_id']) && !empty($rowcomp['loaihinhhoatdong2_id'])) ? "display:none" : "" ?>"> 
														<span class="ic_add"></span>
														<span>
															<a href="javascript:void(0);" onclick="addLHHD()">Thêm </a>
														</span>
													</div>
												</div>
												<div class="form-group m-form__group row">
													<label class="col-xl-2 col-lg-2 col-form-label">
														Loại hình hoạt động (Khác):
													</label>
													<div class="col-xl-3 col-lg-3" style="<?php echo $rowcomp['loaihinhhoatdong1_id'] == 0 ? "display:none" : "" ?>">
														<textarea <?php echo $rowcomp['loaihinhhoatdong_id'] != 9 ? "" : "" ?> maxlength=50 name="loaihinhhoatdongkhac" class="form-control"><?php echo $rowcomp['loaihinhhoatdongkhac'] ?></textarea>
													</div>
													<div style="<?php echo $rowcomp['loaihinhhoatdong2_id'] == 0 ? "display:none" : "" ?>" class="col-xl-3 col-lg-3">
														<textarea <?php echo $rowcomp['loaihinhhoatdong2_id'] != 9 ? "" : "" ?> maxlength=50 name="loaihinhhoatdongkhac2" class="form-control"><?php echo $rowcomp['loaihinhhoatdongkhac2'] ?></textarea>
													</div>
													<div style="<?php echo $rowcomp['loaihinhhoatdong3_id'] == 0 ? "display:none" : "" ?>" class="col-xl-3 col-lg-3">
														<textarea <?php echo $rowcomp['loaihinhhoatdong3_id'] != 9 ? "" : "" ?> maxlength=50 name="loaihinhhoatdongkhac3" class="form-control"><?php echo $rowcomp['loaihinhhoatdongkhac3'] ?></textarea>
													</div>
												</div>
                                                
                                                <div class="form-group m-form__group row">
													<label class="col-xl-2 col-lg-2 col-form-label">
														Logo:
													</label>
													<div class="col-xl-3 col-lg-3">
														<input accept="image/*" type="file" id="file_hinhanh" name="file_hinhanh" class="form-control">
                                                        <div style="display:none" class="progressLoadImg_hinhanh m-loader m-loader--danger" style="width: 30px; display: inline-block;"></div>
                                                       
                                                        <input name="hinhanh" type="hidden">
                                                        <p class="has-error"></p>
													</div>
                                                    
												</div>
                                                 <div class="form-group m-form__group row">
													<label class="col-xl-2 col-lg-2 col-form-label">
														Hình ảnh:
													</label>
													<div class="col-xl-3 col-lg-3">
														<input accept="image/*" type="file" id="file_hinhanh1" name="file_hinhanh1" class="form-control">
                                                        <div style="display:none" class="progressLoadImg_hinhanh m-loader m-loader--danger" style="width: 30px; display: inline-block;"></div>
                                                       
                                                        <input name="hinhanh1" type="hidden">
                                                        <p class="has-error"></p>
													</div>
                                                    
                                                    <div class="col-xl-3 col-lg-3">
														<input accept="image/*" type="file" id="file_hinhanh2" name="file_hinhanh2" class="form-control">
                                                        <div style="display:none" class="progressLoadImg_hinhanh m-loader m-loader--danger" style="width: 30px; display: inline-block;"></div>
                                                       
                                                        <input name="hinhanh2" type="hidden">
                                                        <p class="has-error"></p>
													</div>
                                                    <div class="col-xl-3 col-lg-3">
														<input accept="image/*" type="file" id="file_hinhanh3" name="file_hinhanh3" class="form-control">
                                                        <div style="display:none" class="progressLoadImg_hinhanh m-loader m-loader--danger" style="width: 30px; display: inline-block;"></div>
                                                       
                                                        <input name="hinhanh3" type="hidden">
                                                        <p class="has-error"></p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--end: Form Wizard Step 1-->
							<!--begin: Form Wizard Step 2-->
							<div class="m-wizard__form-step" id="m_wizard_form_step_2">
								<div class="row">
									<div class="col-xl-8 offset-xl-2">
										<div class="m-form__section m-form__section--first">
											<div class="m-form__heading">
												<h3 class="m-form__heading-title">
													Thông tin liên hệ
												</h3>
											</div>
											<div class="form-group m-form__group row">
												<div class="col-lg-6">
													<label class="form-control-label">
														Tên công ty:
													</label>
													<?php echo $_SESSION["session"]["tencongty"] ?>
												</div>
												<div class="col-lg-6 m-form__group-sub">
													<label class="form-control-label">
														Email:
													</label>
													<?php echo $_SESSION["session"]["Tendangnhap"] ?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<div class="col-lg-6 m-form__group-sub">
													<label class="form-control-label">
														Địa chỉ:
													</label>
													<?php echo $_SESSION["session"]["diachicongty"] ?>
												</div>
												<div class="col-lg-6 m-form__group-sub">
													<label class="form-control-label">
														Người liên hệ:
													</label>
													<span class="showNLH"><?php echo $rowcomp['nguoilienhe'] ?></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<input type="hidden" id="act" value="<?php echo $action ?>"/>
							<?php 
								if($view == "Edit"){
							?>
							<input type="hidden" name="congviec_id" value="<?php echo $_REQUEST["id"] ?>"/>
							<input type="hidden" name="type_post" value=""/>
							<?php
								}
							?>
							<!--end: Form Wizard Step 2--> 
						</div>
						<!--end: Form Body -->
	<!--begin: Form Actions -->
						<div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
							<div class="m-form__actions">
								<div class="row">
									<div class="col-lg-2"></div>
									<div class="col-lg-4 m--align-left">
										<a href="#" class="btn btn-secondary m-btn m-btn--custom m-btn--icon" data-wizard-action="prev">
											<span>
												<i class="la la-arrow-left"></i>
												&nbsp;&nbsp;
												<span>
													Trở lại
												</span>
											</span>
										</a>
									</div>
									<div class="col-lg-4 m--align-right">
									<a href="#" class="btn btn-outline-info m-btn m-btn--custom m-btn--icon draft-submit">
											<span>
												<i class="flaticon-file-1"></i>
												&nbsp;&nbsp;
												<span>
													Lưu bản nháp
												</span>
											</span>
										</a>
										<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon" data-wizard-action="submit">
											<span>
												<i class="la la-check"></i>
												&nbsp;&nbsp;
												<span>
													<?php echo $btn ?>
												</span>
											</span>
										</a>
										<?php 
										$where = "congty_id =".$_SESSION["session"]["Id"];
										$postBs_get = $core_class->getValueFrom('trn_congty','post_basic',$where);
										$total_POST = $total_c + $postBs_get;
										 if($total_POST > 0){
										?>
										<a href="#" class="btn btn-warning m-btn m-btn--custom m-btn--icon" data-wizard-action="next">
											<span>
												<span>
													Tiếp tục
												</span>
												&nbsp;&nbsp;
												<i class="la la-arrow-right"></i>
											</span>
										</a>
										 <?php }else {  ?>
											<button href="#" class="btn btn-outline-metal active" type="button" class="">
												Tiếp tục
												<i class="la la-arrow-right"></i><br>
												<small style="color:red;">Đăng ký dịch vụ để sử dụng</small>
											</button>
										 <?php } ?>
										
									</div>
									<div class="col-lg-2"></div>
								</div>
							</div>
						</div>
						<!--end: Form Actions -->
					</form>
				</div>
				<!--end: Form Wizard Form-->
			</div>
			<!--end: Form Wizard-->
		</div>
		<!--End::Main Portlet-->
	</div>
</div>
<script src="dist/assets/web/custom/components/forms/wizard/wizard.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script>
		$(document).ready(function(){
			 $('#tentinhthanh').select2({
					placeholder: "Chọn tỉnh thành",
					maximumSelectionLength: 3,
					width: '100%'
					
			});
			
		   
		   	$("#dichvu_id  input:checkbox").change(function() {
				var idDetail = $("#dichvu_id input:checkbox:checked").map(function () {
					return $(this).data('detail')
				}).get();
			  $("#customer_detail_id").val(idDetail);
			});
		  $(".draft-submit").click(function() {
				var data= $('#m_form').serialize();
				$.ajax({
					url: "process-draft.ajax?act=draft-save",
					async:true,
					data:data,
					type: "POST",
					dataType: "JSON",
					beforeSend: function(){
						$("#loader").show();
					   },
					success: function(jsonRs){
						if(jsonRs["isError"] == "0"){
									alert(jsonRs['msg']);
									window.location = 'dangtuyen.html';
								}else{
									alert(jsonRs['msg']);
									$(".draft-submit").find('div').remove();
									$(".draft-submit").attr('disabled', false);
								}
					}
				 })
				//alert(payment_ok); */
			});
				
		});
	<?php 
		if($view == "Edit"){
	?>
		   /*var Values = new Array();
			Values.push("Cao Bằng");
			Values.push("Cần Thơ");
			Values.push("Kiên Giang");
			*/
			
	function loadDataEdit(id, com_name){
		$.getJSON('Model_'+com_name+'.ajax?id='+id+"&act=LoadDataEdit", function(data) {
				var tinhthanhArray = data["tentinhthanh"].split(",");
				//console.log(tinhthanhArray);
				$("#tentinhthanh").val(tinhthanhArray).trigger('change');
			for (var i in data) {
				var $el = $('#m_form [name="'+i+'"]'),
				type = $el.attr('type');
				if(isNaN(data[i]) == false && i.indexOf("dongia") >= 0){
					data[i] = format(data[i]);
				}
				
				switch(type){
					case 'hidden':
						$('#m_form .' + i).prop('checked', false);
						var arrayList = data[i].split("|");
						arrayList.forEach(function(elm){
							$('#m_form .' + i + '[value="'+elm+'"]').prop('checked', true);
						})
						$('#m_form input[name="'+i+'"]').val(data[i]);
					break;
					case 'checkbox':
						$el.prop('checked', false);
						if(data[i] == 1){
							$el.prop('checked', true);
						}
					break;
					case 'radio':
						$el.prop('checked', false);
						$el.filter('[value="'+data[i]+'"]').prop('checked', true);
					break;
					default: 
						$('#m_form input[name="'+i+'"],#m_form select[name="'+i+'"],#m_form textarea[name="'+i+'"]').val(data[i]).change();
						
				}
			}
		});
	}
	loadDataEdit('<?php echo $_REQUEST["id"] ?>', 'dangtuyen');
	
	<?php
		}
	?>

	// Tags Input
	<?php
			/*$rsTT = $myprocess->loadTinhThanh();
			$ListTT = "";
			while($rowTT = $rsTT->fetch())
			{
				$ListTT .= "'".$rowTT['ten_tinhthanh']."',";
			} */
	?>
		function substringMatcher(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };

	function loadChuyenKhoa(values){
		$.ajax({
			url: "Model_dangtuyen.ajax",
			type: "POST",
			data: {
				act : "loadchuyenkhoa",
				danhmuccv_id : values,
				congviec_id: <?php echo empty($_REQUEST["id"]) ? 0 : $_REQUEST["id"] ?>
			},
			success: function(result){
				$(".chuyenkhoa").html(result);
				$("[name=chuyenkhoa_id]").selectpicker();
			}
		})
	}

</script>