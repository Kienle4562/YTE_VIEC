<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	$myprocess = new process();
	$result = $myprocess->get_user_edit();
	$row = $result->fetch();
?>
<div style="max-width:700px;margin-bottom:20px" class="sitemap-container container">
    <div class="clearfix m_xs_bottom_10">
		<div class="bg_white p_15 r_corners m_bottom_20">
        	<h1 class="sitemap-header text-primary">CẬP NHẬT THÔNG TIN TÀI KHOẢN</h1>
        	<div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">
           	 <?php echo $alert ?>
                <form autocomplete="off" class="awe-check" name="frmUpdateProfile" method="post" id="frmUpdateProfile">
					<div class="row">
						<div class="col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
								<input disabled type="text" class="form-control" value="<?php echo $_SESSION['career']['email'] ?>">
							</div>
						</div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Họ và tên</label>
								<input type="text" name="fullname" class="form-control" value="<?php echo $row['fullname'] ?>" required>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Ngày sinh</label>
								<input type="date" name="ngaysinh" class="form-control hasDatepicker" value="<?php echo $row['ngaysinh'] ?>" required>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Giới tính</label>
								<?php 
									echo $core_class->createSelectBox3("gioitinh_id", "" , $row['gioitinh_id']);
								?>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Nơi cư trú</label>
								<?php 
									echo $core_class->createSelectBox3("tinhthanh_id", "", $row['tinhthanh_id']);
								?>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Ngành nghề</label>
								<?php 
									echo $core_class->createSelectBox3("danhmuccv_id", "", $row['danhmuccv_id']);
								?>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Chuyên khoa</label>
								<div class="chuyenkhoa">
								<?php
									if($row['danhmuccv_id'] == "4"){
										$html = '<input type="text" maxlength="250" name="chuyenkhoakhac" class="form-control" value="'.$row['chuyenkhoakhac'].'" required="required">';
										echo $html;
									}else{
										$where = "WHERE danhmuccv_id = " .$row['danhmuccv_id'];
										echo $core_class->createSelectBox("mst_chuyenkhoa", "chuyenkhoa_id", "form-control m-bootstrap-select m_selectpicker", $where, $row['chuyenkhoa_id']);
									}
								?>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Cấp bậc hiện tại</label>
								<?php 
									echo $core_class->createSelectBox3("capbac_id", "", $row['capbac_id']);
								?>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Cấp bậc mong muốn</label>
								<?php 
									echo $core_class->createSelectBox3("capbac_id", "", $row['mongmuon_capbac_id'], "mongmuon_capbac_id");
								?>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Số năm kinh nghiệm</label>
								<input type="text" maxlength="50" name="sonamkinhnghiem" class="form-control" value="<?php echo $row['sonamkinhnghiem'] ?>" required>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Bằng cấp cao nhất</label>
								<?php 
									echo $core_class->createSelectBox3("bangcap_id", "", $row['bangcap_id']);
								?>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Ngoại ngữ</label>
								<input type="text" name="ngoaingu" maxlength="50" class="form-control" value="<?php echo $row['ngoaingu'] ?>" required>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Hình thức</label>
								<?php 
									echo $core_class->createSelectBox3("loaihinhcongviec_id", "", $row['loaihinhcongviec_id']);
								?>
							</div>
						</div>
						<div class="col-sm-12">
                            <div class="form-group">
                                <label>Mức lương mong muốn</label>
								<input type="text" name="mucluongmongmuon" maxlength="50" class="form-control" value="<?php echo $row['mucluongmongmuon'] ?>" required>
							</div>
						</div>
						<div class="col-sm-12">
                            <div class="form-group">
                                <label>Mật khẩu cũ</label>
								<input type="password" name="oldpassword" class="form-control" value="<?php echo $_POST['password'] ?>" required>
							</div>
						</div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Mật khẩu</label>
								<input type="password" name="password" class="form-control" value="<?php echo $_POST['password'] ?>" required>
								<small class="help-text text-gray password-hint">Mật khẩu từ 6 đến 50 ký tự</small>
							</div>
						</div>
						<div class="col-sm-6">
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
								<input type="password" name="repassword" class="form-control" value="<?php echo $_POST['repassword'] ?>" required>
							</div>
						</div>
					</div>
					<div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="do" value="editprofile" />
								<button type="button" id="btnUpdate" class="btn btn-primary btn-register full-width btn-lg ">
									<i class="fa fa-lg fa-pulse fa-spinner" style="display: none"></i>
									<span>Cập nhật</span>
								</button>
							</div>
						</div>
					</div>
                </form> 
        	</div>
        </div>
	</div>
</div>
<script>
$(document).ready(function(){
	$("#btnUpdate").click(function(){
		$.ajax({
			url: "editprofile",
			type: "POST",
			data: $("#frmUpdateProfile").serialize(),
			beforeSend: function(){
				$(".fa-spinner").show();
			},
			success: function(result){
				$(".fa-spinner").hide();
				swal({
					title: "",
					text: result,
					type: "info"
				})
				if(result == 'Cập nhật thành công'){
					$("#frmUpdateProfile input[type=password]").val('');
				}
			}
		})
	})

	$("[name=danhmuccv_id]").change(function(){
		var values = $(this).val();
		$.ajax({
			url: "loadchuyenkhoa",
			type: "POST",
			data: {
				do : "loadchuyenkhoa",
				danhmuccv_id : values
			},
			success: function(result){
				$(".chuyenkhoa").html(result);
			}
		})
	})
})
</script>