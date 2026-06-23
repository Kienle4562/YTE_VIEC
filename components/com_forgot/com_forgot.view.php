<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	session_start();
    $lang_text = $core_class->load_module_language('com_forgot', $GLOBALS['LANG']);
	//var_dump($lang_text);
    $meta_title = $lang_text['component_name'] . ' - ' . $meta_title;
    include_once('com_forgot.models.php');
	$myprocess = new process_dangky();
   if(!empty($_GET['error_message']))
   {
	   $alert = '<div class="'.$style.'"><strong> '.$_GET['error_message'].'</strong></div>';
   }else
   {
	   $alert = '';
   }
?><div style="max-width:600px" class="sitemap-container container">
    <div class="clearfix m_xs_bottom_10">
		<div class="bg_white p_15 r_corners m_bottom_20">
        	<h1 class="sitemap-header text-primary">TẠO MẬT KHẨU MỚI</h1>
        	<div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">
				<?php echo $alert ?>
                <form autocomplete="off" class="awe-check" name="" method="post" id="">					<div class="row">                        <div class="col-sm-6">                            <div class="form-group">                                <label>Nhập mã xác nhận</label>								<input type="text" required name="forgot" id="forgot" class="form-control" value="<?php echo $_GET['code'] ?>">							</div>						</div>						<div class="col-sm-6">                            <div class="form-group">                                <label>Email</label>								<input type="email" required name="frmemail" id="frmemail" class="form-control" value="<?php echo $_GET['email'] ?>" readonly>							</div>						</div>					</div>					<div class="row">                        <div class="col-sm-6">                            <div class="form-group">                                <label>Mật khẩu</label>								<input pattern=".{6,50}" required title="Mật khẩu từ 6 đến 50 ký tự" type="password" name="frmpassword" id="frmpassword" class="form-control" value="<?php echo $_POST['frmpassword'] ?>">								<small class="help-text text-gray password-hint">Mật khẩu từ 6 đến 50 ký tự</small>							</div>						</div>						<div class="col-sm-6">                            <div class="form-group">                                <label>Nhập lại mật khẩu</label>								<input type="password" required name="frmrepassword" id="frmrepassword" class="form-control" value="<?php echo $_POST['frmrepassword'] ?>">							</div>						</div>					</div>					<div class="row">                        <div class="col-sm-12">                            <div class="form-group">                                <input type="hidden" name="do" value="newpassword" />								<button type="submit" class="btn btn-primary btn-register full-width btn-lg ">									<i class="fa fa-lg fa-pulse fa-spinner" style="display: none"></i>									<span>Tạo mật khẩu mới</span>								</button>							</div>						</div>					</div>
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