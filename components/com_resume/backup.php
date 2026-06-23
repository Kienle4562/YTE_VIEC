<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include_once('com_resume.models.php');
	include_once('protected/paging.php');
	$myprocess =  new process();
?>
<style>
.green-checked {
    min-height: 40px;
    display: block;
    background-image: url(templates/yteviec/images/green-check.png);
    background-position: center;
    background-repeat: no-repeat;
    background-size: 47px;
    margin-bottom: 10px;
}
h3.thongbao {
    font-size: 22px;
    font-weight: 400;
    margin-bottom: 45px;
    padding: 0 30px 0;
    color: #1ab523;
}
.fileContainer{
    overflow: hidden;
    position: relative;
    background: #D4D0C8;
    border: 1px solid #aaa;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    float: left;
    font-size: 12px;
    color: #000;
    cursor: pointer;
    padding: 9px 8px;
}
.fromcomputer {
    background-image: url(templates/yteviec/images/folder_15x12.gif);
	padding-left: 35px;
    width: 170px;
    background-repeat: no-repeat;
    background-position: 10px center;
}
#upload_text1{
	margin-left: 10px;
    margin-top: 20px;
    display: inline-block;
}
</style>
<div class="sitemap-container container m_bottom_20 pv-profile-section-body">
    <div class="clearfix m_xs_bottom_10">
		<div class="bg_white p_15 r_corners m_bottom_20">
			<h1 class="sitemap-header text-primary color_green">TẠO NHANH HỒ SƠ</h1>
        	<div id="showResult" class="col-lg-8 col-md-8 col-sm-8 col-xs-12 f_none">
				<form autocomplete="off" class="awe-check" name="formResume" method="post" id="formResume">
					<header class="card-header">
						<h2 class="card-heading">
							<span class="iconheading">
								<i class="fa fa-briefcase"></i>
							</span>
							Hồ sơ
						</h2>
					</header>
					<div class="row">
						<label class="col-xs-12 col-sm-4">
							Hồ Sơ Đính Kèm<span class="red">*</span>
							<p>*.doc, *.docx, *.pdf, <2MB</p>
						</label>
						<div class="col-xs-12 col-sm-8">
							<label class="fileContainer fromcomputer" style="margin-top: 10px;">
								Chọn từ máy tính
								<input required type="file" value="" class="file" id="attach_file" onchange="return ajaxOnlyFile(this);" style="cursor: pointer; display: block; opacity: 0; position: absolute; right: 0px; text-align: right; top: -5px; height: auto; border-width: 0px 0px 10px 200px;">
								<p style="margin: 0px" class="has-error"></p>
								<input type="hidden" name="fileresume">
							</label>
							<span id="upload_text1"></span>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-4">
							Tiêu đề hồ sơ
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-8 datebox">
							<input value="" required type="text" class="form-control" name="tieudehoso" maxlength='100'>
							<p class="has-error"></p>
						</div>
					</div>
					<header class="card-header">
						<h2 class="card-heading">
							<span class="iconheading">
								<i class="fa fa-user"></i>
							</span>
							Thông tin cá nhân
						</h2>
					</header>
					<div class="row">
						<label class="col-xs-12 col-sm-4">
							Họ và Tên Lót 
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-8">
							<input value="" required type="text" class="form-control" name="lastname" maxlength="100">
							<p class="has-error"></p>
						</div>
					</div>
					<div style="display:none" class="row">
						<label class="col-xs-12 col-sm-4">
							Tên
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-8">
							<input value="" type="text" class="form-control" name="firstname" id="firstname" maxlength="100">
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-4">
							Giới tính
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-8">
							<label>
								<input required type="radio" name="gender" value="Nam">
								Nam
								<p class="has-error"></p>
							</label>
							<label>
								<input required type="radio" name="gender" value="Nữ">
								Nữ
								<p class="has-error"></p>
							</label>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-4">
							Ngày sinh
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-8 datebox">
							<input value="" required type="date" class="form-control date_month" name="birthday">
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-4">
							Số điện thoại
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-8 datebox">
							<input value="" required type="text" class="form-control" name="mobile" id="mobile">
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-4">
							Email
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-8 datebox">
							<input type="email" required class="form-control" name="email">
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-4">
							Tình trạng hôn nhân
						</label>
						<div class="col-xs-12 col-sm-8 datebox">
							<select class="form-control" name="tinhtranghonnhan">
								<option value="Đã kết hôn">Đã kết hôn</option>
								<option value="Độc thân" selected="selected">Độc thân</option>
							</select>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-4">
							Tỉnh / Thành phố
						</label>
						<div class="col-xs-12 col-sm-8 datebox">
							<?php echo $core_class->createSelectBox4("tinhthanh_id", "required", "", "tinhthanhpho"); ?>
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-4">
							Địa chỉ
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-8 datebox">
							<input value="" required type="text" class="form-control" name="diachi" id="diachi" maxlength='100'>
							<p class="has-error"></p>
						</div>
					</div>

					<header class="card-header">
						<h2 class="card-heading">
							<span class="iconheading">
								<i class="fa fa-flag"></i>
							</span>
							Mục tiêu nghề nghiệp
						</h2>
					</header>
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<textarea rows="9" class="form-control" name="muctieunghenghiep" id="muctieunghenghiep"><?php echo $row['muctieunghenghiep'] ?></textarea>
							<div class="note">Vui lòng nhập tối đa không quá 2000 ký tự</div>
						</div>
					</div>

					<header class="card-header">
						<h2 class="card-heading">
							<span class="iconheading">
								<i class="fa fa-briefcase"></i>
							</span>
							Công việc mong muốn
						</h2>
					</header>
					<div style="display:none" class="row">
						<label class="col-xs-12 col-sm-3">
							Tiêu đề hồ sơ
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9 datebox">
							<input value="<?php echo $row['tieudehoso'] ?>" type="text" class="form-control" name="tieudehoso" maxlength='100'>
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Cấp bậc mong muốn
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9 datebox">
							<?php echo $core_class->createSelectBox4("capbac_id", "required", $row['capbacmongmuon'], "capbacmongmuon"); ?>
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Mức lương
							<span class="red">*</span>
						</label>
						<div class="col-xs-3 col-sm-3">
							<select class="form-control" id="level_id">
								<option value="Thỏa thuận">Thỏa thuận</option>
								<option value="VNĐ">VNĐ</option>
								<option value="USD">USD</option>
							</select>
						</div>
						<div class="col-xs-1 col-sm-1">
							<label>Từ</label>
						</div>
						<div class="col-xs-2 col-sm-2">
							<input type="text" class="form-control formatnumber" id="levelFrom" maxlength="10">
							<p class="has-error"></p>
						</div>
						<div class="col-xs-1 col-sm-1">
							<label>Đến</label>
						</div>
						<div class="col-xs-2 col-sm-2">
							<input type="text" class="form-control formatnumber" id="levelTo" maxlength="10">
							<p class="has-error"></p>
						</div>
						<label class="col-xs-12 col-sm-3"></label>
						<label class="col-xs-12 col-sm-9">
							<div class="note">Vui lòng nhập mức lương mong muốn hàng tháng</div>
						</label>
						<input style="display:none" value="<?php echo $row['mucluong'] ?>" required type="text" name="mucluong">
						<p class="has-error"></p>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Hình thức làm việc
							<span class="red">*</span>
						</label>
						<div class="col-sm-9 htlv">
							<div class="form-group">
								<label class="checkbox-inline">
									<input type="checkbox" class="hinhthuclamviec" value="Chính thức (Full time)"/>Chính thức (Full time)
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" class="hinhthuclamviec" value="Ngoài giờ/Theo giờ (Part time)" />Ngoài giờ/Theo giờ (Part time)
								</label>
							</div>
							<div class="form-group">
								<label class="checkbox-inline">
									<input type="checkbox" class="hinhthuclamviec" value="Thực tập"/>Thực tập
								</label>
							</div>
							<input style="display:none" required value="<?php echo $row['hinhthuclamviec'] ?>" type="text" name="hinhthuclamviec">
							<p class="has-error"></p>
						</div>
					</div>
					<div style="display:none" class="row">
						<label class="col-xs-12 col-sm-3">
							Ngành nghề
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9 datebox">
							<?php echo $core_class->createSelectBox4("nganhnghe_id", "", $row['nganhnghe'], "nganhnghe"); ?>
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Nơi làm việc mong muốn
							<span class="red">*</span>
						</label>
						<?php
							$arrNLVMM = explode(", ", $row["noilamviecmongmuon"]);
						?>
						<div class="col-xs-12 col-sm-4">
							<select required class="form-control" id="blvmm_tt">
								<option data-quanhuyen="" value="">Chọn</option>
							<?php
								$resultTT = $myprocess->noiLamViecMM();
								while($rowTT = $resultTT->fetch()){
									$quanhuyen = $myprocess->noiLamViecMM_QuanHuyen($rowTT['tinhthanh_id']);
							?>
								<option <?php echo $arrNLVMM[0] == $rowTT['ten_tinhthanh'] ? 'selected' : '' ?> data-quanhuyen="<?php echo $quanhuyen ?>" value="<?php echo $rowTT['ten_tinhthanh'] ?>"><?php echo $rowTT['ten_tinhthanh'] ?></option>
							<?php }?>
							</select>
							<p class="has-error"></p>
						</div>
						<label class="col-xs-12 col-sm-2">
							Quận/Huyện
						</label>
						<div class="col-xs-12 col-sm-3">
							<select required class="form-control" id="blvmm_qh">
								<option value="">Chọn</option>
							<?php
								$resultQH = $myprocess->noiLamViecQH($arrNLVMM[0]);
								while($rowQH = $resultQH->fetch()){
							?>
								<option <?php echo $arrNLVMM[1] == $rowQH['ten_quanhuyen'] ? 'selected' : '' ?> value="<?php echo $rowQH['ten_quanhuyen'] ?>"><?php echo $rowQH['ten_quanhuyen'] ?></option>
							<?php } ?>
							</select>
							<p class="has-error"></p>
						</div>
						<input style="display:none" value="<?php echo $row['noilamviecmongmuon'] ?>" type="text" name="noilamviecmongmuon">
					</div>
					
					<header class="card-header">
						<h2 class="card-heading">
							<span class="iconheading">
								<i class="fa fa-briefcase"></i>
							</span>
							Thông tin công việc
						</h2>
					</header>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Cấp bậc mong muốn
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9 datebox">
							<?php echo $core_class->createSelectBox4("capbac_id", "required", "", "capbacmongmuon"); ?>
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Mức lương
							<span class="red">*</span>
						</label>
						<div class="col-xs-3 col-sm-3">
							<select class="form-control" id="level_id">
								<option value="Thỏa thuận">Thỏa thuận</option>
								<option value="VNĐ">VNĐ</option>
							</select>
						</div>
						<div class="col-xs-1 col-sm-1">
							<label>Từ</label>
						</div>
						<div class="col-xs-2 col-sm-2">
							<input type="number" class="form-control" id="levelFrom" maxlength="10">
							<p class="has-error"></p>
						</div>
						<div class="col-xs-1 col-sm-1">
							<label>Đến</label>
						</div>
						<div class="col-xs-2 col-sm-2">
							<input type="number" class="form-control" id="levelTo" maxlength="10">
							<p class="has-error"></p>
						</div>
						<label class="col-xs-12 col-sm-3"></label>
						<label class="col-xs-12 col-sm-9">
							<div class="note">Vui lòng nhập mức lương mong muốn hàng tháng</div>
						</label>
						<input style="display:none" required type="text" name="mucluong">
						<p class="has-error"></p>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Hình thức làm việc
							<span class="red">*</span>
						</label>
						<div class="col-sm-9 htlv">
							<div class="form-group">
								<label class="checkbox-inline">
									<input type="checkbox" class="hinhthuclamviec" value="Nhân viên chính thức"/>Nhân viên chính thức
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" class="hinhthuclamviec" value="Thời vụ/ Nghề tự do" />Thời vụ/ Nghề tự do
								</label>
							</div>
							<div class="form-group">
								<label class="checkbox-inline">
									<input type="checkbox" class="hinhthuclamviec" value="Bán thời gian" />Bán thời gian
								</label>
								<label class="checkbox-inline">
									<input type="checkbox" class="hinhthuclamviec" value="Thực tập"/>Thực tập
								</label>
							</div>
							<input style="display:none" required value="<?php echo $row['hinhthuclamviec'] ?>" type="text" name="hinhthuclamviec">
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Ngành nghề
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9 datebox">
							<?php echo $core_class->createSelectBox4("nganhnghe_id", "required", "", "nganhnghe"); ?>
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Nơi làm việc mong muốn
							<span class="red">*</span>
						</label>
						<?php
							$arrNLVMM = explode(", ", $row["noilamviecmongmuon"]);
						?>
						<div class="col-xs-12 col-sm-4">
							<select required class="form-control" id="blvmm_tt">
								<option data-quanhuyen="" value="">Chọn</option>
							<?php
								$resultTT = $myprocess->noiLamViecMM();
								while($rowTT = $resultTT->fetch()){
									$quanhuyen = $myprocess->noiLamViecMM_QuanHuyen($rowTT['tinhthanh_id']);
							?>
								<option <?php echo $arrNLVMM[0] == $rowTT['ten_tinhthanh'] ? 'selected' : '' ?> data-quanhuyen="<?php echo $quanhuyen ?>" value="<?php echo $rowTT['ten_tinhthanh'] ?>"><?php echo $rowTT['ten_tinhthanh'] ?></option>
							<?php }?>
							</select>
							<p class="has-error"></p>
						</div>
						<label class="col-xs-12 col-sm-2">
							Quận/Huyện
						</label>
						<div class="col-xs-12 col-sm-3">
							<select required class="form-control" id="blvmm_qh">
								<option value="">Chọn</option>
							<?php
								$resultQH = $myprocess->noiLamViecQH($arrNLVMM[0]);
								while($rowQH = $resultQH->fetch()){
							?>
								<option <?php echo $arrNLVMM[1] == $rowQH['ten_quanhuyen'] ? 'selected' : '' ?> value="<?php echo $rowQH['ten_quanhuyen'] ?>"><?php echo $rowQH['ten_quanhuyen'] ?></option>
							<?php } ?>
							</select>
							<p class="has-error"></p>
						</div>
						<input style="display:none" type="text" name="noilamviecmongmuon">
					</div>

					<header class="card-header">
						<h2 class="card-heading">
							<span class="iconheading">
								<i class="fa fa-briefcase"></i>
							</span>
							Kinh nghiệm làm việc
						</h2>
					</header>

					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Kinh Nghiệm
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-4">
							<input required type="number" class="form-control" name="kinhnghiem" max="30">
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Cấp bậc hiện tại
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9">
							<?php echo $core_class->createSelectBox4("capbac_id", "required", "", "capbachientai"); ?>
							<p class="has-error"></p>
						</div>
					</div>
				<div class="experienceSectionAppend">
					<i class="btn-remove-row deleteRow"></i>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Vị trí / Chức danh
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9">
							<input value="" required type="text" class="form-control" name="vitrichucdanh[]" maxlength="50">
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Công ty
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9">
							<input value="" required type="text" class="form-control" name="congty[]" maxlength="50">
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Thời gian làm việc
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-2">
							<?php echo $core_class->createSelectBoxMonth("Tháng", "required", "", "rexp_month_start"); ?>
							<p class="has-error"></p>
						</div>
						<div class="col-xs-12 col-sm-2">
							<?php echo $core_class->createSelectBoxYear("Năm", "required", "", "rexp_year_start"); ?>
							<p class="has-error"></p>
						</div>
						<label class="col-xs-12 col-sm-1">
							Đến
						</label>
						<div class="col-xs-12 col-sm-2">
							<?php echo $core_class->createSelectBoxMonth("Tháng", "required", "", "rexp_month_end"); ?>
							<p class="has-error"></p>
						</div>
						<div class="col-xs-12 col-sm-2">
							<?php echo $core_class->createSelectBoxYear("Năm", "required", "", "rexp_year_end"); ?>
							<p class="has-error"></p>
						</div>
						<input style="display:none" type="text" name="thoigianlamviec[]">
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Mô tả công việc
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9">
							<textarea rows="9" required type="text" class="form-control" name="motacongviec[]" maxlength="4000" placeholder="Vui lòng nhập tối đa không quá 4.000 ký tự"></textarea>
							<p class="has-error"></p>
						</div>
					</div>
				</div>
					<div class="row">
						<div class="col-xs-12 text-center">
							<button type="button" class="btn-add-more" id="experienceSectionAppend">Thêm</button>
						</div>
					</div>

					<header class="card-header">
						<h2 class="card-heading">
							<span class="iconheading">
								<i class="fa fa-list"></i>
							</span>
							Học vấn
						</h2>
					</header>

					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Bằng cấp cao nhất
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9">
							<?php echo $core_class->createSelectBox4("bangcap_id", "required", "", "bangcapcaonhat"); ?>
							<p class="has-error"></p>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Trình độ ngoại ngữ
						</label>
						<div class="col-sm-9">
							<div class="row showLVNN">
								<div class="col-xs-12 col-sm-4">
									<?php echo $core_class->createSelectBox5("ngoaingu_id", "required", "", "trinhdonn"); ?>
									<p class="has-error"></p>
								</div>
								<label class="t_align_r col-xs-12 col-sm-2">
									Trình độ:
								</label>
								<div class="col-xs-12 col-sm-4">
									<?php echo $core_class->createSelectBox5("levelbangcap_id", "required", "", "levelbangcap"); ?>
									<p class="has-error"></p>
								</div>
								<div class="col-xs-12 col-sm-2">
									<div class="fl_left" style="padding-top: 10px"> 
										<span class="ic_add"></span>
										<span class="addlangauge">
											<a href="javascript:void(0);" class="addLang">Thêm </a>
										</span>
									</div>
									<div class="fl_left" style="padding-top: 10px">
										<span class="ic_remove"></span>
										<span class="addlangauge">
											<a href="javascript:void(0);" class="removeLang">Xóa</a>
										</span>
									</div>
								</div>
							</div>
						</div>
						<input style="display:none" type="text" name="trinhdongoaingu">
					</div>
				<div class="education">
					<i class="btn-remove-row deleteRow"></i>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Trường / khóa học
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9">
							<input required type="text" class="form-control" name="truongkhoahoc[]" maxlength="50">
							<p class="has-error"></p>
						</div>
					</div>

					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Bằng cấp
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-3">
							<?php echo $core_class->createSelectBox4("bangcap_id", "required", "", "slbangcap"); ?>
							<p class="has-error"></p>
						</div>
						<label class="t_align_r col-xs-12 col-sm-2">
							Tốt nghiệp
						</label>
						<div class="col-xs-12 col-sm-2">
							<?php echo $core_class->createSelectBoxMonth("Tháng", "required", "", "bcmonth"); ?>
							<p class="has-error"></p>
						</div>
						<div class="col-xs-12 col-sm-2">
							<?php echo $core_class->createSelectBoxYear("Năm", "required", "", "bcyear"); ?>
							<p class="has-error"></p>
						</div>
						<input style="display:none" type="text" name="bangcap[]">
					</div>
					
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Mô tả chi tiết
						</label>
						<div class="col-xs-12 col-sm-9">
							<textarea rows="9" class="form-control" name="motachitiet[]" maxlength="4000" placeholder="Vui lòng nhập tối đa không quá 4.000 ký tự"></textarea>
							<p class="has-error"></p>
						</div>
					</div>
				</div>
					<div class="row">
						<div class="col-xs-12 text-center">
							<button type="button" class="btn-add-more" id="education">Thêm</button>
						</div>
					</div>

					<header class="card-header">
						<h2 class="card-heading">
							<span class="iconheading">
								<i class="fa fa-list"></i>
							</span>
							Kỹ năng chuyên môn
						</h2>
					</header>
				<div class="skill">
					<i class="btn-remove-row deleteRow"></i>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Kỹ năng, chuyên môn
							<span class="red">*</span>
						</label>
						<div class="col-xs-12 col-sm-9">
							<input required type="text" class="form-control" name="kynangchuyenmon[]" maxlength="50">
							<p class="has-error"></p>
						</div>
					</div>

					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Mô tả kỹ năng
						</label>
						<div class="col-xs-12 col-sm-9">
							<textarea rows="9" class="form-control" name="motakynang[]" maxlength="150"></textarea>
						</div>
					</div>
					<div class="row">
						<label class="col-xs-12 col-sm-3">
							Mức độ
						</label>
						<div class="col-xs-12 col-sm-9 relative">
							<div class="rangesliderFill"></div>
							<input type="range" min="0" max="5" value="3" name="mucdo[]" class="slider">
							<span>3/5</span>
						</div>
					</div>
				</div>
					<div class="row">
						<div class="col-xs-12 text-center">
							<button type="button" class="btn-add-more" id="skill">Thêm</button>
						</div>
					</div>

					<header class="card-header">
						<h2 class="card-heading">
							<span class="iconheading">
								<i class="fa fa-trophy"></i>
							</span>
							Thành tích nổi bật
						</h2>
					</header>
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<textarea rows="9" class="form-control" name="thanhtichnoibat" id="thanhtichnoibat" maxlength="4000"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4"></div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="do" value="createcv" />
								<input type="hidden" name="hinhanh" value="" />
								<input type="hidden" name="profilecv_id" value="" />
								<button type="button" id="createCV" class="btn btn-primary btn-lg bg_green">
									<span>Lưu và Tiếp Tục ></span>
								</button>
							</div>
						</div>
						<div class="col-sm-4"></div>
					</div>
                </form> 
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 f_none">
				<div style="border:0px" class="tabmenulinks">
					<div class="col-md-12">
						<form id="formUpload" method="post">
							<div class="EntityPhoto-circle-8">
								<img style="width:100%" src="images/logo.png">
							</div>
							<input style="margin-top:10px" class="form-control" type="file" name="uploadImage" id="uploadImage">
						</form>
					</div>
				</div>
			</div>
        </div>
	</div>
</div>
<script src="myeditor/ckeditor.js"></script>
<script type="text/javascript">
var flagLoad = true;
$(function(){
	loadSlider();
	setHinhThucLamViec();

	$(document).on("input mousemove", ".slider", function(){
		var values = $(this).val();
		var widths = $(this).width();
		$(this).next().html(values + "/" + $(this).attr("max"));
		var widthPercent = widths/$(this).attr("max");
		var widthFill = widthPercent*values;
		$(this).prev(".rangesliderFill").css("width", widthFill);
	})

	$('#formUpload input[type=file]').on('change', function(event){
		uploadImageResume();
	});
})

function loadSlider(){
	$(".rangesliderFill").each(function(){
		var slider = $(this).next("input[type=range]");
		var values = slider.val();
		var widths = slider.width();
		slider.next().html(values + "/" + slider.attr("max"));
		var widthPercent = widths/slider.attr("max");
		var widthFill = widthPercent*values;
		$(this).css("width", widthFill);
	})
}
$("#createCV").click(function(){
	var btn = $(this);
    var frm = $("form[name=formResume]");
    if($(frm)[0].checkValidity()) {
		$.ajax({
            url: 'createresume',
            type: 'POST',
            dataType: 'JSON',
            data: $(frm).serialize(),
            beaforeSend: function(){
            	btn.prop("disabled", true);
            },
            success: function(response){
                if(response.status == 1){
					btn.prop("disabled", false);
					$("#showResult").html(response.message);
					$("#showResult").next().remove();
					$("#showResult").attr("style", "width:100%");
					document.body.scrollTop = 0;
  					document.documentElement.scrollTop = 0;
                }else if(response.status == 0){
                    var elementError = $("input[name="+response.toastr+"]");
                    elementError.addClass('required').focus();
                    elementError.nextAll("p.has-error").html(response.message);
                }else{
					btn.prop("disabled", false);
					swal({
						title: "",
						text: response.message,
						type: "warning"
					})
                }
            }
        })
    }else{
		$(frm).find(":invalid").addClass('required').first().focus();
		$(frm).find(":invalid").each(function(index, node) {
			$(this).next("p.has-error").html(node.validationMessage);
		})
		event.preventDefault();
	}
})

$("input:checkbox").click(function(event){
	var elmName = $(this).attr("class");
	$("input[name="+elmName+"]").val($("."+elmName+":checked").map(function(){
		return this.value;
	}).get().join("|"));
});

$("#levelFrom, #levelTo").change(function(){
	var type = $("#level_id").val();
	var levelFrom = $("#levelFrom").val();
	var levelTo = $("#levelTo").val();
	var mucluong = levelFrom + " đến " + levelTo + " " + type;
	$("input[name=mucluong]").val(mucluong);
})

setMucLuong();
$("#level_id").change(function(){
	setMucLuong();
})

$("#blvmm_tt").change(function(){
	var arrQuanHuyen = $(this).find("option:selected").attr("data-quanhuyen").split(",");
	var strOption = '<option value="">Chọn</option>';
	arrQuanHuyen.forEach(function(elm){
		strOption += '<option value="'+elm+'">' + elm + '</option>';
	});
	$("#blvmm_qh").html(strOption);
	var workWA = $(this).val() + ", " + $("#blvmm_qh").val();
	$("input[name=noilamviecmongmuon]").val(workWA);
})

$("#blvmm_qh").change(function(){
	var workWA = $("#blvmm_tt").val() + ", " + $(this).val();
	$("input[name=noilamviecmongmuon]").val(workWA);
})

$(document).on("change", "select[name=rexp_month_start]," +
	"select[name=rexp_year_start]," +
	"select[name=rexp_month_end]," +
	"select[name=rexp_year_end]"
, function(){
	var parent = $(this).parents("div.row").first();
	var rexp_month_start = parent.find("select[name=rexp_month_start]").val();
	var rexp_yeah_start = parent.find("select[name=rexp_year_start]").val();
	var rexp_month_end = parent.find("select[name=rexp_month_end]").val();
	var rexp_year_end = parent.find("select[name=rexp_year_end]").val();
	var values = rexp_month_start + "/" + rexp_yeah_start + " đến " + rexp_month_end + "/" + rexp_year_end;
	var input = parent.find("input[name='thoigianlamviec[]']").first();
	input.val(values);
})

$(document).on("change", "select[name=slbangcap]," +
	"select[name=bcmonth]," +
	"select[name=bcyear]"
, function(){
	var parent = $(this).parents("div.row").first();
	var slbapcap = parent.find("select[name=slbangcap]").val();
	var bcmonth = parent.find("select[name=bcmonth]").val();
	var bcyear = parent.find("select[name=bcyear]").val();
	var values = slbapcap + ":" + bcmonth + "/" + bcyear;
	var input = parent.find("input[name='bangcap[]']").first();
	input.val(values);
})

$("#experienceSectionAppend, #skill, #education").click(function(){
	var className = $(this).attr("id");
	var content = document.getElementsByClassName(className)[0].outerHTML;
	$("." + className).last().after(content);
	clearAllValues(className);
	loadSlider();
})

$(document).on("click", ".deleteRow", function(){
	var parents = $(this).parents("div").first();
	parents.remove();
})

$(document).on("change", ".trinhdonn, .levelbangcap", function(){
	addLang();
})

function addLang(){
	$("input[name=trinhdongoaingu]").val($(".trinhdonn").map(function(){
		return this.value + ":" + $(this).parents("div.showLVNN").find(".levelbangcap").val();
	}).get().join(","));
}

$(document).on("click", ".addLang", function(){
	var content = document.getElementsByClassName("showLVNN")[0].outerHTML;
	$(".showLVNN").last().after(content);
})

$(document).on("click", ".removeLang", function(){
	var parents = $(this).parents("div.showLVNN").first();
	parents.remove();
	addLang();
})

function setMucLuong(){
	if(flagLoad){
		var values = $("input[name=mucluong]").val();
		if(values == "Thỏa thuận"){
			$("#level_id option[value='Thỏa thuận']").prop('selected', true);
		}else{
			$("#level_id option[value='VNĐ']").prop('selected', true);
		}
		var arrValues = values.replace(" VNĐ","").split(" đến ");
		$("#levelFrom").val(arrValues[0]);
		$("#levelTo").val(arrValues[1]);
		flagLoad = false;
	}
	if($("#level_id").val() == "VNĐ"){
		$("#levelFrom").prop("disabled", false);
		$("#levelTo").prop("disabled", false);
		$("#levelFrom").prop("required", true);
		$("#levelTo").prop("required", true);
	}else{
		$("#levelFrom").val('').prop("disabled", true);
		$("#levelTo").val('').prop("disabled", true);
		$("#levelFrom").prop("required", false);
		$("#levelTo").prop("required", false);
		$("input[name=mucluong]").val('Thỏa thuận');
	}
}

function setHinhThucLamViec(){
	var valuesArr = $("input[name=hinhthuclamviec]").val().split("|");
	valuesArr.forEach(function(value){
		$(".hinhthuclamviec[value='"+value+"']").prop('checked', true);
	})
}

function ajaxOnlyFile(e){
	var filePath = "";
	if(e.value != ''){
		filePath = e.value;
		filePath = filePath.replace(/C:\\fakepath\\/i, '');
		$('#upload_text1').html(filePath);
	}
}

$("#attach_file").change(function(event){
	var myfile = $(this).val();
	var file_data = $(this).prop('files')[0];
	var ext = myfile.split('.').pop();
	var filesize = Math.round($(this)[0].files[0].size / 1024);
	if(ext != "pdf" && ext != "docx" && ext != "doc"){
		$(this).val('');
		$('#upload_text1').html('Vui lòng chọn tập tin đính kèm với định dạng .doc, .docx, .pdf');
		swal({
			title: "",
			text: "Vui lòng chọn tập tin đính kèm với định dạng .doc, .docx, .pdf",
			type: "warning"
		})
	} else if(filesize > 2048){
		$(this).val('');
		$('#upload_text1').html('Vui lòng chọn tập tin đính kèm nhỏ hơn 2048KB');
		swal({
			title: "",
			text: "Vui lòng chọn tập tin đính kèm nhỏ hơn 2048KB",
			type: "warning"
		})
	}else{
		var form_data = new FormData();                  
		form_data.append('file', file_data);
		$.ajax({
			url: 'upload_resume?do=upload',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                         
			type: 'post',
			success: function(result){
				$('input[name=fileresume]').val(result);
			}
		});
	}
})

function uploadImageResume(){
	var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
	var file_data = $("#formUpload #uploadImage").prop('files')[0];
	var fileType = $("#formUpload #uploadImage").prop('files')[0].type;
	if ($.inArray(fileType, ValidImageTypes) < 0) {
		 alert("Bạn cần chọn file ảnh");
	}else{
		var form_data = new FormData();                  
		form_data.append('file', file_data);	
		$.ajax({
			url: 'uploadImageResume?do=uploadImage',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                         
			type: 'post',
			success: function(result){
				var d = new Date();
				$("#formUpload img").attr('src', result+"?"+d.getTime());
				$("input[name=hinhanh]").val(result);
			}
		});
	}
}
</script>