<base href="<?php echo $index ?>">
<html lang="vi" class="ytev-home">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon"/>
    <title><!--wti>{meta_title}</wti--></title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,300&subset=latin,latin-ext,vietnamese' rel='stylesheet' type='text/css'>
    <meta name="robots" content="index, follow">
    <meta name="description" content="<!--wti>{meta_description}</wti--> , <!--wti>{meta_title}</wti-->">
    <meta name="keywords" content="<!--wti>{meta_keyword}</wti-->">
    <meta name="format-detection" content="telephone=no">
    <meta property="og:image" content="https://yteviec.com/images/logo.png"/>
	<meta property="og:image:secure_url" content="https://yteviec.com/images/logo.png"/>
	<meta property="og:image:width" content="636"/>
	<meta property="og:image:height" content="625"/>
	<meta property="og:title" content="<!--wti>{meta_title}</wti-->"/>
	<meta property="og:url" content="<!--wti>{meta_url}</wti-->"/>
	<meta property="og:title_name" content="<!--wti>{meta_title}</wti-->"/>
	<meta property="og:description" content="<!--wti>{meta_description}</wti--> , <!--wti>{meta_title}</wti-->"/>
	<meta name="yandex-verification" content="63b3b45a4a260573" />
	<link rel="canonical" href="<!--wti>{meta_url}</wti-->"/>
	<link rel="stylesheet" href="plugins/lightslider/lightslider.min.css"/>
	<link rel="stylesheet" type="text/css" href="plugins/sweetalert/sweet-alert.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $index.$template_folder; ?>/css/fontawesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/home.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/theme.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $index.$template_folder; ?>/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/danhmuccongviec.css") ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/custom.css"); ?>">
	<link rel="stylesheet" href="<?php echo $core_class->latest_version($template_folder."/css/bootstrap-select.min.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/custom2.css"); ?>">
	<!--<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/splide.min.css"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/splide-core.min.css"); ?>">-->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/slick-theme.css"); ?>">-->
	<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/slick.css"); ?>">

	<link rel="stylesheet" type="text/css" href="<?php echo $core_class->latest_version($template_folder."/css/jcarousel.responsive.css"); ?>">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/plugins.js"></script>
    <script src="<?php echo $index.$template_folder; ?>/js/vendor.js?ver=19102020"></script>
	<script type="text/javascript" src="<?php echo $core_class->latest_version($template_folder."/js/custom.js"); ?>"></script>
	<!--<script type="text/javascript" src="<?php echo $core_class->latest_version($template_folder."/js/splide.js"); ?>"></script>-->
	<script type="text/javascript" src="<?php echo $core_class->latest_version($template_folder."/js/slick.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo $core_class->latest_version($template_folder."/js/scripts_slick.js"); ?>"></script>
	<script type="text/javascript" src="<?php echo $core_class->latest_version($template_folder."/js/jcarousel.responsive.js"); ?>"></script>
	<script src="https://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>
	
	<style>
		form[name=formDangKy] [name=danhmuccv_id]{
			display: none;
		}
	</style>
	<script data-ad-client="ca-pub-2915996252675888" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body >
	<div data-role="page">
        <!-- Header -->
            <header>
            <nav class="navbar horizontal-navbar navbar-default">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand hidden-xs" href=".">
                            <img class="logo" src="images/logo.png"
                                 alt="yteviec - Job Search, career and employment in Vietnam"
                                 title="yteviec - Job Search, career and employment in Vietnam" height="40px">
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="hidden-xs">
						<?php $core_class->load_module("main_menu"); ?>
						<ul class="nav navbar-nav navbar-right">
							<?php 
							
							if(!isset($_SESSION["career"]["email"])){ ?>
							<li>
								<a class="clickable" rel="nofollow" onClick="globalLogInModal.showModal();">
									<i class="fa fa-fw fa-lg fa-sign-in"></i>Đăng Nhập
								</a>
							</li>
							<li>
								<a class="clickable" rel="nofollow" onClick="globalRegistrationModal.showModal();">
									<i class="fa fa-fw fa-lg fa-user"></i>Đăng Ký Ứng Viên
								</a>
							</li>
							<li id="CBlink" class="horizontal-navbar__employer-site">
								<a target="_blank" href="employeer.html">
									<strong class="text-white hidden-xs">NHÀ TUYỂN DỤNG</strong>
									<i style="color: #FFF" class="fa fa-angle-down"></i>
									<br/>
									<span class="text-white">Đăng Tuyển & Kiếm Nhân Tài</span>
								</a>
								<ul class="menuDown item highZIndex">
									<li><a href="http://tuyendung.yteviec.com/">Đăng nhập / Đăng ký</a></li>
									<li><a href="http://tuyendung.yteviec.com/themmoidangtuyen.html">Đăng Tuyển Dụng</a></li>
									<li><a href="tim-ung-vien.html">Tìm Ứng Viên</a></li>
								</ul>
							</li>
							<?php }else{?>
							<li id="CBlink" class="horizontal-navbar__employer-site">
								<a target="_blank" href="employeer.html">
									<strong class="text-white hidden-xs"><?php echo $_SESSION["career"]["fullname"]; ?></strong>
									<i style="color: #FFF" class="fa fa-angle-down"></i>
									<br/>
									<span class="text-white">Quản lý thông tin</span>
								</a>
								<ul class="menuDown item highZIndex">
									<li>
										<a href="profile.html" class="clickable" rel="nofollow">
											<i class="fa fa-fw fa-lg fa-user"></i> Thông tin tài khoản
										</a>
									</li>
									
									<li>
										<a href="myjob.html" class="clickable" rel="nofollow">
											<i class="fa fa-fw fa-lg fa-heart"></i> Việc làm của tôi
										</a>
									</li>
									<li>
										<a href="view-cv.html" class="clickable" rel="nofollow">
											<i class="fa fa-fw fa-lg fa-address-card"></i> CV của tôi
										</a>
									</li>
									<li>
										<a href="dang-xuat.html" class="clickable" rel="nofollow">
											<i class="fa fa-fw fa-lg fa-sign-out"></i>Đăng xuất
										</a>
									</li>
									<li style="display:none"><a href="http://tuyendung.yteviec.com/">Đăng nhập</a></li>
									<li style="display:none"><a href="http://tuyendung.yteviec.com/themmoidangtuyen.html">Đăng Tuyển Dụng</a></li>
									<!--<li><a href="tim-ung-vien.html">Tìm Ứng Viên</a></li>-->
								</ul>
							</li>
							<?php }?>
						</ul>
					</div><!-- /.navbar-collapse -->
                    <div class="visible-xs mobile-nav">
                        <ul>
                            <li class="pull-left mobile-logo">
                                <a href="/">
                                    <img class="visible-xs-inline" src="images/logo.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a onclick="menumobile()" class="menu-toggler"><i class="fa fa-lg fa-bars"></i></a>
                            </li>
                        </ul>
                    </div>
                </div><!-- /.container-fluid -->
            </nav>
        </header>
        <!-- Splitter Menu -->
        <?php $core_class->load_module("menu_mobile"); ?>
        <!-- End Splitter Menu -->
        

        <div class="popover fade bottom global__notification-popover" id="notification-popover" role="tooltip">
            <div class="arrow"></div>
            <h3 class="popover-title text-uppercase">Thông Báo</h3>
            <span class="close visible-xs visible-sm">&times;</span>
            <div id="notification-list" class="popover-content"></div>
        </div>

        <script>
            $('.menu-toggler').click(function () {
                $('#modal-menu').modal('show')
            });
        </script>
        <div class="main-wrapper home">
            <?php $core_class->load_module("slider"); ?>
			<?php include('protected/layout_parser.php'); ?>
		</div>
		<script type="text/javascript">
			var HOME_AB_TESTING = 'B';
			var homeRecoJobsSetting = {};
		</script>
<footer>
    <div class="global__top-category-location">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="link-listing-item">
							<?php $core_class->load_module("danhmuccv"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="float-table-wrapper">
            <div class="pull-right go-top">
                <span class="fa-stack fa-1x">
                    <a href="#top"><i class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-arrow-up fa-stack-1x fa-inverse"></i></a>
                </span>
            </div>
        </div>
        <div class="row">
            <?php $core_class->load_module("bottom"); ?>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-12 col-sm-8 col-xs-12">
                        <div class="row">
                            
                            <div class="col-sm-6 col-md-12 home-social">
                                <h5>Kết Nối Với Y Tế Việc</h5>
                                <a href="<?php echo $_APP['config']['contact']['yahoo']['yahoo1'] ?>" class="instagram" target="_blank" title="yteviec Youtube"></a>
                                <a href="<?php echo $_APP['config']['contact']['yahoo']['yahoo2'] ?>" class="linkedin" target="_blank" title="LinkedIn"></a>
                                <a href="<?php echo $_APP['config']['contact']['yahoo']['yahoo3'] ?>" class="facebook" target="_blank" title="Facebook"></a>
								
                            </div>
							<a href="https://www.freewebsubmission.com" class="url_order"> <b> FreeWebSubmission.com </ b> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <hr class="hidden-sm hidden-xs"/>
        <div class="copyright">
            <p class="text-muted text-center">Copyright © <?php echo $_APP['config']['contact']['company_name'] ?>
                <br>
                Địa Chỉ: <?php echo $_APP['config']['contact']['address']['address1'] ?>
				<br>
                Email: <?php echo $_APP['config']['contact']['email']['email2'] ?>
            </p>
        </div>
    </div>
</footer>
<?php
	// modal đăng ký
?>
<div class="modal fade global__registration-modal" data-current-url="" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="animated fadeIn">
					<button type="button" class="close" >
						<span aria-hidden="true">&times;</span>
					</button>
					<h2 class="sitemap-header text-primary">ĐĂNG KÝ ỨNG VIÊN</h2>
				</div>
				<div class="bg_white p_15 r_corners m_bottom_20">
					<div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">
						<form autocomplete="off" class="awe-check" name="formDangKy" method="post">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Họ và tên</label>
										<input type="text" name="fullname" class="form-control" value="<?php echo $_POST['taikhoan'] ?>" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" class="form-control" value="<?php echo $_POST['email'] ?>" required>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Mật khẩu</label>
										<input maxlength="50" type="password" name="password" id="password" class="form-control" value="<?php echo $_POST['password'] ?>" required>
										<small class="help-text text-gray password-hint">Mật khẩu từ 6 đến 50 ký tự</small>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Nhập lại mật khẩu</label>
										<input type="password" name="repassword" id="repassword" class="form-control" value="<?php echo $_POST['repassword'] ?>" required>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<input type="hidden" name="do" value="dangky">
										<button type="button" class="career_register btn btn-primary full-width btn-lg">
											<span>Đăng ký</span>
										</button>
									</div>
								</div>
							</div>
						</form> 
					</div>
					<p class="text-center text-light text-gray-light disclaimer">
						Nhấp chọn "Đăng ký", tôi đã đọc và đồng ý với các
						<br/>
						<a class="text-gray-light" href="#">Quy định bảo mật</a> và <a class="text-gray-light" href="#">Thỏa thuận sử dụng</a>
					</p>
					<hr class="hidden-xs"/>
					<div class="step-1 animated fadeIn">
						<p class="text-center m-b-none sign-in">Bạn là thành viên Y Tế Việc? <a class="clickable" onClick="event.preventDefault(); globalLogInModal.showModal();"><strong>Đăng nhập</strong></a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	// modal đăng nhập
?>
<div class="modal fade global__sign-in-modal" data-current-url="" tabindex="-1" role="dialog">
    <div class="modal-dialog md_login" role="document">
        <div class="modal-content step-1">
            <div class="modal-body">
				<div class="step-1 animated fadeIn">
					<button type="button" class="close" >
						<span aria-hidden="true">&times;</span>
					</button>
					<h2 class="sitemap-header text-primary">ĐĂNG NHẬP ỨNG VIÊN</h2>
				</div>
				<div class="bg_white p_15 r_corners m_bottom_20">
					<div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">
						<form autocomplete="off" class="awe-check" name="phpFormLogin" method="post" id="phpFormLogin">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="loginemail" id="loginemail" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label>Mật khẩu</label>
										<input maxlength="50" type="password" name="loginpassword" id="loginpassword" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-xs-12 text-right">
									<a class="inline m-t-sm forgot-password clickable" onClick="event.preventDefault(); globalForgotPasswordModal.showModal();">Quên mật khẩu?</a>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<button type="button" class="career_login btn btn-primary full-width btn-lg">
											<span>Đăng nhập</span>
										</button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
								<span class="text-right m-b-none register">Bạn chưa có tài khoản ? </span> 
									<a class="clickable" rel="nofollow" onClick="globalRegistrationModal.showModal();">
										Đăng Ký
									</a>
								</div>
							</div>
						</form> 
					</div>
					<hr class="hidden-xs"/>
					<div class="">
						<p class="text-center m-b-none sign-in">&nbsp;</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	// modal quên mật khẩu
?>
<div class="modal fade global__forgot-password-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="alert alert-danger animated fadeIn no-break-out token-expired-error help-text" hidden>
                    <strong>Phiên làm việc đã hết, vui lòng tải lại trang để tiếp tục.</strong>
                </div>
                <div class="text-center m-t-none modal-heading">Quên Mật Khẩu</div>
                <p class="instruction">Chúng tôi sẽ gửi hướng dẫn tạo mật khẩu mới đến email bạn bên dưới</p>
                <!-- Forgot Password Form -->
                <form class="awe-check">
                    <div class="form-group">
                        <label>Địa chỉ email</label>
                        <input type="email" class="form-control email" name="email">
                        <p class="help-text text-danger error__required-field animated fadeIn" hidden>Vui lòng nhập trường này</p>
                        <p class="help-text text-danger error__invalid-email animated fadeIn" hidden>Email không hợp lệ</p>
                        <p class="help-text text-danger error__not-exist-email animated fadeIn" hidden>Email không tồn tại</p>
                        <p class="help-text text-danger error__employer-email animated fadeIn" hidden>Bạn đã sử dụng email này cho tài khoản Nhà tuyển dụng.</p>
                    </div>
					<input type="hidden" name="do" value="forgot">
					<input type="hidden" id="form_csrf_token" name="csrf_token" value="lJZtxpaZnG1tZ2Nma5pqnWrKZJ5kx5ifmsaWl23Fa2dhmpOalJ5oZ7VqZpaVlnBsbJWZ">
                    <button type="submit" class="btn btn-primary btn-forgot-password full-width btn-lg"><i class="fa fa-lg fa-pulse fa-spinner" style="display: none"></i><span>Gửi hướng dẫn cho tôi</span></button>
                </form>
                <!--/ Sign In Form -->
                <hr class="hidden-xs"/>
                <div class="bottom-links">
                    <p class="text-center m-b-none login ">Bạn đã là thành viên? <a class="clickable" href="#"><strong>Đăng nhập</strong></a></p>
                    <p class="text-center m-b-none register">Bạn chưa có tài khoản? <a class=" clickable" href="#"><strong>Đăng ký!</strong></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Global: FORGOT PASSWORD MODAL -->
<!-- Global: AFTER FORGOT PASSWORD MODAL -->
<div class="modal fade global__after-forgot-pass-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="green-checked"></div>
                <h3 class="text-center m-t-none">Chúng tôi vừa gửi hướng dẫn thay đổi mật khẩu đến địa chỉ email <strong></strong></h3>
                <p class="instruction">Vui lòng kiểm tra hộp thư để xem hướng dẫn</p>
				<b style="color:red">Nếu không thấy Email kích hoạt tài khoản trong hợp thư đến, vui lòng kiểm tra hợp thư Spam</b>
                <!--/ Sign In Form -->
                <hr class="hidden-xs"/>
                <div class="bottom-links">
                    <p class="text-center m-b-none login ">Bạn đã là thành viên? <a class="clickable" href="#"><strong>Đăng nhập</strong></a></p>
                    <p class="text-center m-b-none register ">Bạn chưa có tài khoản? <a class="clickable" href="#"><strong>Đăng ký!</strong></a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Global: AFTER FORGOT PASSWORD MODAL -->
<?php if(!$core_class->isMobile()){ ?>
<div class="RightButtonFix">
	<div class="feedback-new" style="clear: both">		
		<a href="javascript:void(0)" id="btnSendFeedback"></a>
	</div>
</div>
<?php } ?>
<!-- Modal -->
<div id="ModalSendFeedback" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="SendFeedbackContent" class="modal-body">
				<form name="frmSendFeedback" method="post">
					<p style="color: #000; padding-bottom:10px; font-size: 16px">
					<img style="margin:0 auto;display:block" height="120" src="/images/logo.png"><br>
					<strong>Chia sẻ ý kiến với YTeViec.Com</strong></p>
					<p class="f_size12" style="color: #000; padding-bottom: 5px">
						Để nâng cao chất lượng dịch vụ và hỗ trợ tốt nhất cho người dùng, chúng tôi rất mong nhận được ý kiến của bạn về chức năng, giao diện web, nội dung, ...
					</p>
					<ul class="ulFeedBack">	
						<li>
							<div class="box_text">Nhập ý kiến của bạn tại đây:</div>
							<div class="box_frm">
								<textarea required name="content" cols="5" rows="9" class="form-control" maxlength="5000" style="width: 515px; font-size:12px"></textarea>
								<p class="has-error"></p>
								<p>(Vui lòng nhập tối đa không quá 5.000 ký tự)</p>
							</div>
						</li>
						<li>    
							<div class="box_text">Tên:</div>
							<div class="box_frm">
								<input required type="text" name="name" class="form-control" maxlength="50">
								<p class="has-error"></p>
							</div>
						</li>
						<li>    
							<div class="box_text">Email:</div>
							<div class="box_frm">
								<input required type="email" name="email" class="form-control" maxlength="50">
								<p class="has-error"></p>
							</div>
						</li>
						<li>    
							<div class="box_text">Captcha:</div>
							<div class="box_frm">
								<input type="text" name="cf_anti_spam" class="cf_anti_spam form-control">
								<img src="captcha" class="captcha">
								<p style="float:left;margin-left:5px;width:100%;color:red;display:block" class="has-error"></p>
							</div>
						</li>
						<li>
							<div class="box_frm" id="btn-submit" style="float:none;margin:0;">
								<div class="fl_left mar_right5">
									<span class="btn_submit">
										<input type="button" value="Gửi" class="btn btn-primary btn-lg" id="btnSendFeedBack">
									</span>
									<span class="btn_submit">
										<input type="hidden" name="do" value="contact">
										<input type="button" value="Đóng" data-dismiss="modal" aria-label="Close" class="btn btn-default btn-lg">
									</span>
								</div>
							</div>
						</li>                
					</ul>
				</form>
            </div>
        </div>
    </div>
</div>
<!-- load modal subcride -->
<div id="ModalSubscribe" class="modal fade">
    <div class="modal-dialog search-widget-container" role="document">
        <div class="modal-content">
            <div id="search-widget" class="modal-body">
				<form autocomplete="off" class="awe-check" name="phpFormLogin" method="post" id="phpFormLogin">
					<p style="color: #000; padding-bottom:10px; font-size: 16px;text-align:center">
					<img style="margin:0 auto;display:block" height="120" src="/images/logo.png"><br>
					<strong>ĐĂNG KÝ BẢNG TIN</strong></p>
					<ul class="ulFeedBack">	
						<li>    
							<div class="box_text">Nhập email:</div>
							<div class="box_frm">
								<input type="text" name="search" class="form-control" maxlength="50" value="<?php echo $_SESSION['career']['email'] ?>">
								<p class="has-error"></p>
							</div>
						</li>
						<li>
							<div class="box_text">Tất cả chuyên ngành, chuyên khoa:</div>
							<div class="form-group cate-search-advenced">
								<div class="border-text-box">
									<select class="select-category" data-search-input-placeholder="Tìm kiếm theo ngành nghề" name="danhmuccv" data-placeholder="Chọn ngành nghề">
										<option value="-1">Tất cả các khoa , ngành</option>
										<?php
											$result = $core_class->getDanhmuccv();
											$selected = "";
											while($row = $result->fetch()){
												$resultCK = $core_class->getChuyenKhoa($row["danhmuccv_id"]);
												if($resultCK->rowCount() > 0){
										?>
											<optgroup label="<?php echo $row["tendanhmuccv"] ?>">
												<?php
													while($rowCK = $resultCK->fetch()){
														$selected = $rowCK["chuyenkhoa_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";
												?>
													<option <?php echo $selected ?> value="<?php echo $rowCK["chuyenkhoa_id"] ?>"><?php echo $rowCK["chuyenkhoa_name"] ?></option>
												<?php
													}
												?>
											</optgroup>
										<?php
												}else{
													$selected = $row["danhmuccv_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";
										?>
													<option <?php echo $selected ?> value="<?php echo $row["danhmuccv_id"] ?>"><?php echo $row["tendanhmuccv"] ?></option>
										<?php
												}
											}
										?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="box_text">Mức lương:</div>
							<div class="form-group cate-search-advenced">
								<div class="border-text-box">
									<select class="select-category" data-search-input-placeholder="Tìm kiếm theo mức lương" name="salary" data-placeholder="Chọn mức lương">
										<option value="-1">Chọn mước lương</option>
										<option value="3">Từ 3.000.000 đ</option>
										<option value="5">Từ 5.000.000 đ</option>
										<option value="7">Từ 7.000.000 đ</option>
										<option value="10">Từ 10.000.000 đ</option>
										<option value="15">Từ 15.000.000 đ</option>
										<option value="20">Từ 20.000.000 đ</option>
										<option value="30">Từ 30.000.000 đ</option>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="box_text">Địa điểm:</div>
							<div class="form-group cate-search-advenced">
								<div class="border-text-box">
									<select class="select-location" data-search-input-placeholder="Tìm kiếm địa điểm" name="location" data-placeholder="Chọn địa điểm làm việc">
										<option value="-1">Tất cả địa điểm</option>
										<?php
											$result = $core_class->getTinhThanh();
											while($row = $result->fetch()){
										?>
											<option value="<?php echo $row["id"] ?>"><?php echo $row["ten_tinhthanh"] ?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="box_text">Loại hình công việc:</div>
							<div class="form-group cate-search-advenced">
								<div class="border-text-box">
									<select class="select-location" data-search-input-placeholder="Tìm kiếm theo loại hình làm việc" name="loaihinhcv" data-placeholder="Chọn loại hình làm việc">
										<option value="-1">Chọn loại hình công việc</option>
										<?php
											$result = $core_class->getLoaiHinhCongViec();
											while($row = $result->fetch()){
										?>
											<option value="<?php echo $row["loaihinhcongviec_id"] ?>"><?php echo $row["tenloaihinhcongviec"] ?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="box_text">Trình độ:</div>
							<div class="form-group cate-search-advenced">
								<div class="border-text-box">
									<select class="select-location" data-search-input-placeholder="Tìm kiếm theo trình độ" name="trinhdo" data-placeholder="Chọn bằng cấp">
										<option value="-1">Chọn bằng cấp</option>
										<?php
											$result = $core_class->getTrinhDo();
											while($row = $result->fetch()){
										?>
											<option value="<?php echo $row["bangcap_id"] ?>"><?php echo $row["tenbangcap"] ?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="box_frm" id="btn-submit" style="float:none;margin:0;">
								<div class="fl_left mar_right5">
									<span class="btn_submit">
										<input type="submit" value="ĐĂNG KÝ" class="btn btn-primary btn-lg" id="btnSendFeedBack">
									</span>
									<span class="btn_submit">
										<input type="button" value="Đóng" data-dismiss="modal" aria-label="Close" class="btn btn-default btn-lg">
									</span>
								</div>
							</div>
						</li>
					</ul>
				</form>
            </div>
        </div>
    </div>
</div>
<!--- END sub--->
<?php
	// modal search nâng cao
?>
<div id="ModalSearchAdvenced" class="modal fade">
    <div class="modal-dialog search-widget-container" role="document">
        <div class="modal-content">
            <div id="search-widget" class="modal-body">
				<form name="frmSearchAdvenced" action="tim-kiem.html" method="get">
					<p style="color: #000; padding-bottom:10px; font-size: 16px;text-align:center">
					<img style="margin:0 auto;display:block" height="120" src="/images/logo.png"><br>
					<strong>TÌM VIỆC NÂNG CAO</strong></p>
					<ul class="ulFeedBack">	
						<li>    
							<div class="box_text">Nhập từ khóa:</div>
							<div class="box_frm">
								<input type="text" name="search" class="form-control" maxlength="50">
								<p class="has-error"></p>
							</div>
						</li>
						<li>
							<div class="box_text">Tất cả chuyên ngành, chuyên khoa:</div>
							<div class="form-group cate-search-advenced">
								<div class="border-text-box">
									<select class="select-category" data-search-input-placeholder="Tìm kiếm theo ngành nghề" name="danhmuccv" data-placeholder="Chọn ngành nghề">
										<option value="-1">Tất cả các khoa, ngành</option>
										<?php
											$result = $core_class->getDanhmuccv();
											$selected = "";
											while($row = $result->fetch()){
												$resultCK = $core_class->getChuyenKhoa($row["danhmuccv_id"]);
												if($resultCK->rowCount() > 0){
										?>
											<optgroup label="<?php echo $row["tendanhmuccv"] ?>">
												<?php
													while($rowCK = $resultCK->fetch()){
														$selected = $rowCK["chuyenkhoa_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";
												?>
													<option <?php echo $selected ?> value="<?php echo $rowCK["chuyenkhoa_id"] ?>"><?php echo $rowCK["chuyenkhoa_name"] ?></option>
												<?php
													}
												?>
											</optgroup>
										<?php
												}else{
													$selected = $row["danhmuccv_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";
										?>
													<option <?php echo $selected ?> value="<?php echo $row["danhmuccv_id"] ?>"><?php echo $row["tendanhmuccv"] ?></option>
										<?php
												}
											}
										?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="box_text">Mức lương:</div>
							<div class="form-group cate-search-advenced">
								<div class="border-text-box">
									<select class="select-category" data-search-input-placeholder="Tìm kiếm theo mức lương" name="salary" data-placeholder="Chọn mức lương">
										<option value="-1">Chọn mức lương</option>
										<option value="3">Từ 3.000.000 đ</option>
										<option value="5">Từ 5.000.000 đ</option>
										<option value="7">Từ 7.000.000 đ</option>
										<option value="10">Từ 10.000.000 đ</option>
										<option value="15">Từ 15.000.000 đ</option>
										<option value="20">Từ 20.000.000 đ</option>
										<option value="30">Từ 30.000.000 đ</option>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="box_text">Địa điểm:</div>
							<div class="form-group cate-search-advenced">
								<div class="border-text-box">
									<select class="select-location" data-search-input-placeholder="Tìm kiếm địa điểm" name="location" data-placeholder="Chọn địa điểm làm việc">
										<option value="-1">Tất cả địa điểm</option>
										<?php
											$result = $core_class->getTinhThanh();
											while($row = $result->fetch()){
										?>
											<option value="<?php echo $row["id"] ?>"><?php echo $row["ten_tinhthanh"] ?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="box_text">Loại hình công việc:</div>
							<div class="form-group cate-search-advenced">
								<div class="border-text-box">
									<select class="select-location" data-search-input-placeholder="Tìm kiếm theo loại hình làm việc" name="loaihinhcv" data-placeholder="Chọn loại hình làm việc">
										<option value="-1">Chọn loại hình công việc</option>
										<?php
											$result = $core_class->getLoaiHinhCongViec();
											while($row = $result->fetch()){
										?>
											<option value="<?php echo $row["loaihinhcongviec_id"] ?>"><?php echo $row["tenloaihinhcongviec"] ?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="box_text">Trình độ:</div>
							<div class="form-group cate-search-advenced">
								<div class="border-text-box">
									<select class="select-location" data-search-input-placeholder="Tìm kiếm theo trình độ" name="trinhdo" data-placeholder="Chọn bằng cấp">
										<option value="-1">Chọn bằng cấp</option>
										<?php
											$result = $core_class->getTrinhDo();
											while($row = $result->fetch()){
										?>
											<option value="<?php echo $row["bangcap_id"] ?>"><?php echo $row["tenbangcap"] ?></option>
										<?php
											}
										?>
									</select>
								</div>
							</div>
						</li>
						<li>
							<div class="box_frm" id="btn-submit" style="float:none;margin:0;">
								<div class="fl_left mar_right5">
									<span class="btn_submit">
										<input type="submit" value="Tìm kiếm" class="btn btn-primary btn-lg" id="btnSendFeedBack">
									</span>
									<span class="btn_submit">
										<input type="button" value="Đóng" data-dismiss="modal" aria-label="Close" class="btn btn-default btn-lg">
									</span>
								</div>
							</div>
						</li>
					</ul>
				</form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="currentlink" value="<?php echo $core_class->getFullLink(); ?>">
<script>
	$("#btnSendFeedback").click(function(){
		$("#ModalSendFeedback").modal("show");
	})
	$(".btnSearchAdvenced").click(function(){
		$("#ModalSearchAdvenced").modal("show");
	})
	$(".btnSubscribe").click(function(){
		$("#ModalSubscribe").modal("show");
	})
</script>
<script type="text/javascript">
	var system_version = '';
	var APP_WEBROOT_JOBSEEKER = "https://www.yteviec.com/",
		language = 1,
		base_url = 'https://www.yteviec.com/';
    	var isIndexPage = 'true';
            	var isInnerShowTooltipPage = 'false';
        var showProfileModal = false;
        var redirectUserOnboard = null;
        var showLoginModal = false;
        var socialLoginError = null;
</script>
<script type="text/javascript">
    	window.___gcfg = {lang: 'vi'};
	(function() {
		var po = document.createElement('script');
		po.type = 'text/javascript';
		po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(po, s);
	})();
    	var _gaq = _gaq || [];


	(function() {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})();

	function customEvent(uniqueName, action, label, value) {
		if (_gaq) {
			_gaq.push(['_trackEvent', uniqueName, action, label], value || 1); // 'Videos', 'Play', 'First Birthday'
		}
	}
</script>
<!-- WhatsHelp.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "1334946549953982", // Facebook page ID
            call_to_action: "Message us", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /WhatsHelp.io widget -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-44427687-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-44427687-3');
</script>
<!-- insert Gravity -->
</div>
	<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/jquery.form.min.js"></script>
    <script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/tooltip.js"></script>
    <script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/popover.js"></script>
    <script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/bootstrap-editable.js"></script>
    <script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/switchery.js"></script>
    <script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/mobile-detect.min.js?ver=19102020"></script>
    <script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/bootstrap.3.3.2.min.js?ver=19102020"></script>
    <!--<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/jquery.select2.full-screen.min.js"></script> -->
    <!--<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/ui.footer.min.js"></script> -->
	<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/ui.footer2.js"></script>
    <script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/readmore.min.js"></script>
    <script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/jquery.jcarousel.min.js?ver=19102020"></script>
    <script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/handlebars.js?ver=19102020"></script>
    <script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/tracking.js"></script>
	<script type="text/javascript" src="<?php echo $core_class->latest_version($template_folder."/js/ui.js"); ?>"></script>
	<script type="text/javascript" defer src="<?php echo $index.$template_folder; ?>/js/globalOnBoardingModals.js"></script>
	<script type="text/javascript" defer src="<?php echo $index.$template_folder; ?>/js/globalForgotPassword.js"></script>
	<script src="plugins/sweetalert/sweet-alert.js"></script>
	<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/func.js"></script>
	<script type="text/javascript" src="<?php echo $index.$template_folder; ?>/js/paging.js"></script>
	<script src="<?php echo $index.$template_folder; ?>/js/bootstrap-select.min.js"></script>
</div>
</body>
</html>