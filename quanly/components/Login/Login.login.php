<?php
	// Tạo biến page để kiểm tra link
?>
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
		<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
			<div class="m-stack m-stack--hor m-stack--desktop">
				<div class="m-stack__item m-stack__item--fluid">
					<div class="m-login__wrapper">
						<div class="m-login__logo">
							<a href="#">
								<img height="135" src="image/logo.png">
							</a>
						</div>
						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title">
									ĐĂNG NHẬP VÀO HỆ THỐNG
								</h3>
							</div>
							<form class="m-login__form m-form" action="">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Username" name="TenDangNhap" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
								</div>
								<div class="m-login__form-action">
									<input type="hidden" value="login" name="hidden"/>
									<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
										Đăng nhập
									</button>
								</div>
							</form>
						</div>

					</div>
				</div>
				
			</div>
		</div>
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url(dist/assets/app/media/img/bg/bg-4.jpg)">
			<div class="m-grid__item m-grid__item--middle">
				<h3 class="m-login__welcome">
					Y Tế Việc
				</h3>
				<p class="m-login__msg">
					<?php echo $core_class->getValueFrom("MST_CATCH", "CATCH", "id = 1"); ?>
				</p>
			</div>
		</div>
	</div>
</div>
	<script>
	$(function(){
		// Hiển thị mật khẩu
		$('.vpassword, .vpassword2').bind("mousedown mouseup", function(){
			var inputPassword = $(this).parent().prev();
			if('password' == $(inputPassword).attr('type')){
				$(inputPassword).prop('type', 'text');
			}else{
				$(inputPassword).prop('type', 'password');
			}
		});
		
		$('.vpassword, .vpassword2').bind("mouseleave", function(){
			var inputPassword = $(this).parent().prev();
			$(inputPassword).prop('type', 'password');
		});
	})
		</script>		