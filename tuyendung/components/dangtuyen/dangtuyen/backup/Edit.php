<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	include_once("Model.php");
	$myprocess = new process();
	$title = "";
	$action = "";
	$btn = "";
	$congviec_id = empty($_REQUEST["id"]) ? 0 : $_REQUEST["id"];
	$congty_id = $_SESSION["session"]["Id"];
	$title = "Cập Nhật Tin Tuyển Dụng";
	$action = "Update";
	$btn = "Cập nhật";
	 $dich_vu = 0;
	$arraySource = array(
		'dist/assets/component/dangtuyen/dangtuyen.css' => 'css',
		'dist/assets/component/dangtuyen/dangtuyen.js' => 'js',
		'dist/assets/component/dangtuyen/bootstrap-tagsinput.css' => 'css',
		'dist/assets/component/dangtuyen/bootstrap-tagsinput.min.js' => 'js',
	);
	$core_class->loadSource($arraySource);
	$row = $core_class->find("trn_congviec", array(
		'congviec_id',
		'tencongviec',
		'nguoilienhe',
		'email',
		'congty_id',
		'loaihinhcongviec_id',
		'gioitinh_id',
		'dotuoi',
		'kinhnghiem_id',
		'sonamkinhnghiem',
		'yeucauhoso_id',
		'capbac_id',
		'bangcap_id',
		'phucloi_id',
		'mucluongtoithieu',
		'mucluongtoida',
		'loaitien_id',
		'tinhthanh_id',
		'tentinhthanh',
		'noilamviec',
		'motacongviec',
		'chuyenmonyeucau',
		'quyenloi',
		'yeucauhoso',
		'nophoso',
		'soluongcantuyen',
		'danhmuccv_id',
		'chuyenkhoa_id',
		'chuyenkhoakhac',
		'ngaydang',
		'ngayhethan',
		'hot_job',
		'btn_ungtuyen',
		'trangthai',
		'power_job',
		'post_basic',
		'id_order',
	), array(
		'congviec_id' => $congviec_id
	));
	// load công việc

	if($row['power_job'] >0 || $row['hot_job'] >0)
	{
		$dich_vu = 1;
	}
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
			<div  class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							<?php echo $title ?>
						</h3>
					</div>
				</div>
				
			</div>
			<!--end: Portlet Head-->
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
													<input required type="text" name="tencongviec" value="<?php echo $row['tencongviec'] ?>" class="form-control m-input" placeholder="VD: Bác Sỹ Nội Trú" disabled>
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
													<textarea required data-provide="markdown" class="form-control m-input" name="motacongviec"> <?php echo $row['motacongviec'] ?></textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Yêu cầu công việc:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea required data-provide="markdown" class="form-control m-input" name="chuyenmonyeucau"> <?php echo $row['chuyenmonyeucau'] ?></textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Nộp hồ sơ:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea data-provide="markdown" class="form-control m-input" name="nophoso"> <?php echo $row['nophoso'] ?></textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													Yêu cầu hồ sơ:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea data-provide="markdown" class="form-control m-input" name="yeucauhoso"><?php echo $row['yeucauhoso'] ?> </textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													Quyền lợi:
												</label>
												<div class="col-xl-9 col-lg-9">
													<textarea data-provide="markdown" class="form-control m-input" name="quyenloi"><?php echo $row['quyenloi'] ?></textarea>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													Số lượng cần tuyển:
												</label>
												<div class="col-xl-9 col-lg-9">
													<input type="number" maxlength="50" name="soluongcantuyen" value="<?php echo $row['soluongcantuyen'] ?>" class="form-control m-input">
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Danh mục công việc:
												</label>
												<div class="col-xl-4 col-lg-3">
													<?php
														echo $core_class->createSelectBox5(
															"trn_danhmuccv",
															"danhmuccv_id",
															"tendanhmuccv",
															"required", // $attribute
															"form-control m-bootstrap-select m_selectpicker",
															"danhmuccv_id", // name
															"", // where
															array(),
															$row['danhmuccv_id']
														);
													?>
												</div>
												<label class="col-xl-2 col-lg-2 col-form-label">
													<span class="red">*</span><span class="lbaction"> Chọn chuyên khoa </span>:
												</label>
												<div class="col-xl-3 col-lg-3">
													<div class="chuyenkhoa">
													<?php
															echo $core_class->createSelectBox5(
																"mst_chuyenkhoa",
																"chuyenkhoa_id",
																"chuyenkhoa_name",
																"required", // $attribute
																"form-control m-bootstrap-select m_selectpicker",
																"chuyenkhoa_id", // name
																"", // where
																array(),
																$row['chuyenkhoa_id']
															);
														?>
													</div>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-3 col-lg-3 col-form-label">
													<span class="red">*</span> Nơi làm việc (tối đa 3 địa điểm):
												</label>
												<div class="col-xl-9 col-lg-9 m-typeahead">
													<script>
														$(document).ready(function(){
																var dataTH = '<?php echo $row['tentinhthanh'] ?>';
																var tinhthanhArray = dataTH.split(",");
												
															$("#tentinhthanh").val(tinhthanhArray).trigger('change');
														});
													</script>
													<!--<input required type="text" placeholder="Nhập chữ có dấu" value="<?php echo $rows['noilamviec'] ?>" data-role="tagsinput" class="form-control tagsinput" name="noilamviec">-->
													<select class="form-control m-select2" id="tentinhthanh" name="tentinhthanh[]" multiple>
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
															
															echo $core_class->createSelectBox5(
																"mst_loaitien",
																"loaitien_id",
																"tenloaitien",
																"", // $attribute
																"col-lg-2 f_left",
																"loaitien_id", // name
																"", // where
																array(),
																$row['loaitien_id']
															);
														?>
														<span class="col-lg-2 f_left m_top_10">tối thiểu:</span>
													<div class="f_left col-lg-2">
														<input type="text" name="mucluongtoithieu" value="<?php echo number_format($row['mucluongtoithieu'], 0) ?>" class="form-control m-input currency">
													</div>
													<span class="col-lg-2 f_left m_top_10">tối đa:</span>
													<div class="f_left col-lg-2">
														<input type="text" name="mucluongtoida" value="<?php echo number_format($row['mucluongtoida'], 0) ?>" class="form-control m-input currency">
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
														$loaihinhcongviec_id = str_replace("/","|",$row['loaihinhcongviec_id']);
														echo $core_class->createCheckBox2(
															"mst_loaihinhcongviec", // table
															"loaihinhcongviec_id", // column1
															"tenloaihinhcongviec", // column2
															"required", // $attribute
															"", // where
															array('|', $loaihinhcongviec_id), // split, data
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
														<input type="text" id="ngayhethan" name="ngayhethan" class="form-control m-input" value="<?php echo date("d/m/Y", strtotime($row['ngayhethan'])) ?>" readonly >
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
														<input type="text" class="form-control m-input" name="email" value="<?php echo $row['email'] ?>"  id="email" data-role="tagsinput" size="150">
													</div>
												</div>
											</div>
										</div>
									
										<div class="m-separator m-separator--dashed m-separator--lg"></div>
										<div class="m-form__section">
											<div class="m-form__heading">
												<h3 class="m-form__heading-title">
													Phúc lợi
												</h3>
											</div>
											<div class="form-group m-form__group row">
												<div class="col-xl-12 col-lg-12">
													
													<?php
														$phucloi_id = str_replace("/","|",$row['phucloi_id']);
														echo $core_class->createCheckBox2(
															"mst_loaiphucloi", // table
															"loaiphucloi_id", // column1
															"tenloaiphucloi", // column2
															"required", // $attribute
															"", // where
															array('|', $phucloi_id), // split, data
															"", // content
															"phucloi_id[]"
														);
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
														echo $core_class->createSelectBox5(
															"mst_gioitinh",
															"gioitinh_id",
															"gioitinh",
															"required", // $attribute
															"form-control",
															"gioitinh_id", // name
															"", // where
															array(),
															$row['gioitinh_id']
														);
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													Tuổi:
												</label>
												<div class="col-xl-9 col-lg-9">
													<input type="text" name="dotuoi" value="<?php echo $row['dotuoi'] ?>" placeholder="VD: tuổi từ 19 đến 35" class="form-control m-input">
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													<span class="red">*</span> Kinh nghiệm:
												</label>
												<div class="col-xl-6 col-lg-6">
													<?php
														echo $core_class->createSelectBox5(
															"mst_kinhnghiem",
															"kinhnghiem_id",
															"tenkinhnghiem",
															"required", // $attribute
															"form-control",
															"kinhnghiem_id", // name
															"", // where
															array(),
															$row['kinhnghiem_id']
														);
													?>
												</div>
												<div class="col-xl-3 col-lg-3">
													<?php if(!empty($row['sonamkinhnghiem'])){ ?>
														<input type="text" name="sonamkinhnghiem" value="<?php echo $row['sonamkinhnghiem'] ?>" placeholder="Vd : 1-5 năm" class="form-control m-input">
													<?php }else{ ?>
													<input type="text" name="sonamkinhnghiem"  placeholder="Vd : 1-5 năm" class="form-control m-input" style="display:none">
													<?php } ?>
													
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													<span class="red">*</span> Cấp bậc:
												</label>
												<div class="col-xl-9 col-lg-9">
													<?php
														echo $core_class->createSelectBox5(
															"mst_capbac",
															"capbac_id",
															"tencapbac",
															"required", // $attribute
															"form-control",
															"capbac_id", // name
															"", // where
															array(),
															$row['capbac_id']
														);
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													Bằng cấp:
												</label>
												<div class="col-xl-9 col-lg-9">
													
													<?php
														echo $core_class->createSelectBox5(
															"mst_bangcap",
															"bangcap_id",
															"tenbangcap",
															"required", // $attribute
															"form-control",
															"bangcap_id", // name
															"", // where
															array(),
															$row['bangcap_id']
														);
													?>
												</div>
											</div>
											<div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													<span class="red">*</span>  Ngôn ngữ yêu cầu:
												</label>
												<div class="col-xl-9 col-lg-9">
													
													<?php
														$yeucauhoso_id = str_replace("/","|",$row['yeucauhoso_id']);
														echo $core_class->createCheckBox2(
															"mst_yeucauhoso", // table
															"yeucauhoso_id", // column1
															"tenyeucauhoso", // column2
															"required", // $attribute
															"", // where
															array('|',$yeucauhoso_id), // split, data
															"", // content
															"yeucauhoso_id[]"
														);
													?>
												</div>
											 </div>
											 <div class="form-group m-form__group row">
												<label class="col-xl-2 col-lg-2 col-form-label">
													 Trạng thái:
												</label>
												<div class="col-xl-9 col-lg-9">
													<label class="m-checkbox">
														<input name="public" id="public" value="1" <?php if($row['trangthai'] == 1) { echo 'checked';} ?> type="checkbox">
														 <strong> Online bài viết</strong>
														<span></span>
													</label>
												</div>
											 </div>
											 
									   <?php
											if( intval($dich_vu) == 0){
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
												
												<?php }else { ?>
													<p> Đã sử dụng hết dịch vụ . Bạn chỉ được đăng tin thường</p>
													<input type="hidden" value="0" name="dich_vu_select">
												<?php } ?>
											</div>
										  </div>
										</div>
										<?php }else { ?>
										
											<input type="hidden" value="0" name="dich_vu_select">
										<?php } 
										 }else {
										?>
										     <input type="hidden" id="customer_detail_id" name="dich_vu_select" value='-1'>
											
										 <?php } ?>
											<div class="m-separator m-separator--dashed m-separator--lg"></div>
											<div class="congty_edit">
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
												<!--<div class="form-group m-form__group row">
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
												</div>-->
                                                
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
							</div>
							<!--end: Form Wizard Step 1-->
							<!--begin: Form Wizard Step 2-->
							<input type="hidden" id="act" value="<?php echo $action ?>"/>
							<input type="hidden" name="congviec_id" value="<?php echo $_REQUEST["id"] ?>"/>
							 <input type="hidden" id="dich_vu" name ="dich_vu" value="<?php echo $dich_vu ?>"/>
											 
							<input type="hidden" name="type_post" value=""/>
							<!--end: Form Wizard Step 2--> 
						</div>
						<!--end: Form Body -->
	<!--begin: Form Actions -->
						<div class="m-portlet__foot  m--margin-top-40">
							<div class="m-form__actions">
								<div class="row">
									<div class="col-lg-2"></div>
									<div class="col-lg-5 m--align-right"></div>
									<div class="col-lg-4 m--align-right">
									  <!-- <a href="#" class="btn btn-outline-info m-btn m-btn--custom m-btn--icon draft-submit">
											<span>
												<i class="flaticon-file-1"></i>
												&nbsp;&nbsp;
												<span>
													Lưu bản nháp
												</span>
											</span>
										</a>-->
										<a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon edit-submit">
											<span>
												<i class="la la-check"></i>
												&nbsp;&nbsp;
												<span>
													<?php echo $btn ?>
												</span>
											</span>
										</a>
									</div>
									
								</div>
							</div>
						</div>
						<!--end: Form Actions -->
					</form>
				
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
					url: "process-draft.ajax?act=draft-edit",
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
			//ps 
			 $(".edit-submit").click(function() {
				var data= $('#m_form').serialize();
				$.ajax({
					url: "process-edit.ajax?act=Update",
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
	

	// Tags Input
	
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