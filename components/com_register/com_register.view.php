<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	session_start();
    $lang_text = $core_class->load_module_language('com_register', $GLOBALS['LANG']);
	//var_dump($lang_text);
    $meta_title = $lang_text['component_name'] . ' - ' . $meta_title;
    include_once('com_register.models.php');
	$myprocess = new process_dangky();
   if(!empty($_POST['error_message']))
   {
	   $alert = ' <div class="alert_box error r_corners relative fs_medium m_bottom_12"><p> '.$_POST['error_message'].'</p></div>';
   }else
   {
	   $alert = '';
   }
?><div class="sitemap-container container">
    <div class="clearfix m_xs_bottom_10">
		<div class="bg_white p_15 r_corners m_bottom_20">
        	<h1 class="sitemap-header text-primary">ĐĂNG KÝ TÀI KHOẢN</h1>
        	<div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">
           	 <?php echo $alert ?>
                <form autocomplete="off" class="awe-check" name="phpForm" method="post" id="phpForm">					<div class="row">                        <div class="col-sm-6">                            <div class="form-group">                                <label>Họ và tên</label>								<input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $_POST['taikhoan'] ?>" required>							</div>						</div>						<div class="col-sm-6">                            <div class="form-group">                                <label>Email</label>								<input type="email" name="email" id="email" class="form-control" value="<?php echo $_POST['email'] ?>" required>							</div>						</div>					</div>					<div class="row">                        <div class="col-sm-6">                            <div class="form-group">                                <label>Mật khẩu</label>								<input type="password" name="password" id="password" class="form-control" value="<?php echo $_POST['password'] ?>" required>								<small class="help-text text-gray password-hint">Mật khẩu từ 6 đến 50 ký tự</small>							</div>						</div>						<div class="col-sm-6">                            <div class="form-group">                                <label>Nhập lại mật khẩu</label>								<input type="password" name="repassword" id="repassword" class="form-control" value="<?php echo $_POST['repassword'] ?>" required>							</div>						</div>					</div>					<div class="row">                        <div class="col-sm-12">                            <div class="form-group">                                <input type="hidden" name="do" value="dangky" />								<button type="submit" class="btn btn-primary btn-register full-width btn-lg ">									<i class="fa fa-lg fa-pulse fa-spinner" style="display: none"></i>									<span>Đăng ký</span>								</button>							</div>						</div>					</div>
                </form> 
        	</div>
        </div>
	</div></div>
    <script type="text/javascript">
	$(function() {
		$('input[name="birthdate"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true
		});
	});
	</script>
    <script type="text/javascript">
	  jQuery('form[name=phpForm]').validate({
			rules: {
						username: "required",
						pass: {
								required: true,
								minlength: 5
						},
						pass_config: {
								required: true,
								minlength: 5,
								equalTo: "#pass"
						},
						email: {
							required: true,
							email: true
						},
						fullname: "required",
						phonenumber: {
							required: true,
							checkPhoneNumber: true
						}
					},
			messages: { 
				username: "Vui lòng nhập tài khoản",
				pass: {
					required:'Vui lòng nhập mật khẩu',
					minlength: 'Mật khẩu nhiều hơn 5 ký tự'
				},
				pass_config: {
					required:'Vui lòng xác nhận mật khẩu',
					minlength: 'Mật khẩu nhiều hơn 5 ký tự',
					equalTo: "Mật khẩu không trùng khớp"
				},
				email: "Vui lòng nhập email !",
				fullname: "Vui lòng nhập tên đầy đủ ",
				phonenumber: "vui lòng nhập số điện thoại"
			}
		});
	</script>   