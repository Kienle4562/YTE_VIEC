<?php
	// Tạo biến page để kiểm tra link
?>
	<!-- begin:: Page -->
<style>
input:focus {
  background-color: yellow;
}
</style>
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
				<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
					<div class="m-stack m-stack--hor m-stack--desktop">
						<div class="m-stack__item m-stack__item--fluid">
							<div class="m-login__wrapper">
								<div class="m-login__logo">
									<a href="#">
										<img height="130" src="image/logo.png">
									</a>
								</div>
								<?php
									// Form đặt lại mật khẩu
									if($_REQUEST["page"] == "forget"){
								?>
								<div class="m-login__reset-password">
									<div class="m-login__head">
										<h3 class="m-login__title">
											Tạo lại mật khẩu cho tài khoản của bạn
										</h3>
										<div class="m-login__desc">
											Nhập vào các thông tin bên dưới để tạo lại mật khẩu
										</div>
									</div>
									<form class="m-login__form m-form newpass" action="">
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="email" placeholder="Email" name="email" id="email" value="<?php echo $_REQUEST["email"] ?>" autocomplete="off" readonly >
										</div>
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="hidden" placeholder="Mã xác nhận" value="<?php echo $_REQUEST["code"] ?>" name="maxacnhan" id="maxacnhan" autocomplete="off">
										</div>
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="password" placeholder="Nhập mật khẩu mới" name="password" id="password" autocomplete="off">
										</div>
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="password" placeholder="Nhập lại mật khẩu mới" name="repassword" id="repassword" autocomplete="off">
										</div>
										<div class="m-login__form-action">
											<input type="hidden" name="hidden" value="newpassword">
											<button id="m_login_create_new_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
												Gửi yêu cầu
											</button>
											<button id="btnBackLogin" type="button" onclick="window.location='.'" style="display:none" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
												Đăng nhập
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
								<?php }else{ ?>
								<div class="m-login__signin">
									<div class="m-login__head">
										<h3 class="m-login__title">
											Đăng nhập bằng tài khoản của bạn
										</h3>
									</div>
									<form class="m-login__form m-form" action="">
										<?php
											// Kiểm tra kích hoạt tài khoản qua email
											if(!empty($_REQUEST["active"])){
												$makichhoat = $_REQUEST["active"];
												if($core_class->active($makichhoat)){
										?>
											<div class="m-alert m-alert--outline alert alert-success alert-dismissible" role="alert">
												<span>Kích hoạt tài khoản thành công! mời bạn nhập thông tin vào ô bên dưới để đăng nhập.</span>
											</div>
										<?php
												}else{
										?>
											<div class="m-alert m-alert--outline alert alert-danger alert-dismissible" role="alert">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
												<span>Kích hoạt tài khoản không thành công! mã kích hoạt này không tồn tại, xin hãy thử lại.</span>
											</div>
										<?php 
												}
											}
										?>
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
										</div>
										<div class="input-group form-group m-form__group">
											<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
											<div class="input-group-prepend">
												<span class="input-group-text vpassword">
													<i class="flaticon-visible"></i>
												</span>
											</div>
										</div>
										<div class="row m-login__form-sub">
											<div class="col m--align-left">
												<label class="m-checkbox m-checkbox--focus">
													<input type="checkbox" name="remember">
													Ghi nhớ mật khẩu
													<span></span>
												</label>
											</div>
											<div class="col m--align-right">
												<a href="javascript:;" id="m_login_forget_password" class="m-link p-top">
													Bạn quên mật khẩu ?
												</a>
											</div>
										</div>
										<div class="m-login__form-action">
											<input type="hidden" value="login" name="hidden"/>
											<button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
												Đăng nhập
											</button>
										</div>
									</form>
								</div>
								<?php
									/* check link hoặc link là đăng ký */
								?>
								<div class="m-login__signup">
									<div class="m-login__head">
										<h3 class="m-login__title">
											Đăng Ký Tài Khoản Nhà Tuyển Dụng
										</h3>
										<div class="m-login__desc">
											<span class="red">*</span>
											Thông tin bắt buộc (Lưu ý: Độ dài của mật khẩu mới trong khoảng từ 6 đến 40 ký tự)
										</div>
									</div>
									<form class="m-login__form m-form signupForm" action="">
										<!--<div class="m-form__heading">
											<h3 class="m-form__heading-title">
												Thông Tin Đăng Nhập
											</h3>
											<p>Quý khách sử dụng thông tin tài khoản này để đăng nhập vào YTeViec.Com</p>
										</div>-->
										<div class="form-group m-form__group">
											<span class="req">*</span>
											<input class="form-control m-input bg_input" type="text" placeholder="Email" name="email" autocomplete="off">
										</div>
										<div class="form-group m-form__group">
											<span class="req">*</span>
											<input class="form-control m-input bg_input" type="password" placeholder="Password" name="password">
										</div>
										<div class="form-group m-form__group">
											<span class="req">*</span>
											<input class="form-control m-input m-login__form-input--last bg_input" type="password" placeholder="Nhập lại Password" name="rpassword">
										</div>
										<div class="m-form__heading">
											<h3 class="m-form__heading-title">
												Thông Tin Công Ty
											</h3>
											<div class="form-group m-form__group">
												<span class="req">*</span>
												<input class="form-control m-input bg_input bg_input" type="text" placeholder="Tên công ty" name="tencongty">
											</div>
											<div class="form-group m-form__group row">
												<?php
													echo $core_class->createSelectBox4("quymo_id", "Quy mô công ty - chọn số nhân viên");
												?>
											</div>
											<div class="form-group m-form__group row">
												<span class="req">*</span>
												<textarea class="form-control m-input" placeholder="Sơ lược về công ty" name="gioithieungan"></textarea>												
											</div>
											<div class="form-group m-form__group row">
												<span class="req">*</span>
												<textarea class="form-control m-input" placeholder="Địa chỉ công ty" name="diachicongty"></textarea>
											</div>
											<div class="form-group m-form__group">
												<span class="req">*</span>
												<?php
														echo $core_class->createSelectBox3("location_id", "required", "ORDER BY ten_tinhthanh asc");
												?>
											</div>
											<div class="form-group m-form__group row">
												<span class="req">*</span>
												<input class="form-control m-input bg_input" placeholder="Số điện thoại" name="sdthoai">
											</div>
											<div class="form-group m-form__group">
												<div class="row">
													<div class="col-sm-4">
														<span class="req">*</span>
														<input class="form-control m-input" type="text" placeholder="Mã xác nhận" name="maxacnhan">
													</div>
													<div class="col-sm-3">
														<img id="form_register_captcha" style="margin-top: 7px;" src="capcha.php">
													</div>
													<div class="col-sm-4">
														<a tabindex="-1" style="border-style: none;" href="javascript:void(0)" title="[Đổi mã mới]" onclick="document.getElementById('form_register_captcha').src = 'capcha.php'" class="change_captcha">
															<span class="text2translate" alt="change_image">[Đổi mã mới]</span>
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="row form-group m-form__group m-login__form-sub">
											<div class="col m--align-left">
												<label class="m-checkbox m-checkbox--focus">
													<input type="checkbox" name="agree">
													Bằng việc nhấp vào "Đăng Ký!", bạn đã đồng ý với các điều khoản ghi trong
													<a href="https://yteviec.com/thoa-thuan-su-dung/n1366.html" class="m-link">
														Thỏa thuận dịch vụ của YTeViec.com
													</a>
													.
													<span></span>
												</label>
												<span class="m-form__help"></span>
											</div>
										</div>
										<div class="m-login__form-action">
											<button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
												Đăng Ký
											</button>
											<button id="m_login_signup_cancel" class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom">
												Đăng Nhập
											</button>
										</div>
										<input type="hidden" value="sign-up" name="hidden"/>
										<input type="hidden" value="<?php echo $core_class->txt_htmlspecialchars($_REQUEST["invite"]) ?>" name="inviteid"/>
									</form>
								</div>
								<?php
									// form quên mật khẩu
								?>
								<div class="m-login__forget-password">
									<div class="m-login__head">
										<h3 class="m-login__title">
											Bạn đã quên mật khẩu tài khoản của mình ?
										</h3>
										<div class="m-login__desc">
											<p>Nhập vào email của bạn để tạo lại mật khẩu</p>
											<b style="color:red">Nếu không thấy Email kích hoạt tài khoản trong hộp thư đến, vui lòng kiểm tra hộp thư Spam</b>
										</div>
									</div>
									<form class="m-login__form m-form forgetpass" action="">
										<div class="form-group m-form__group">
											<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
										</div>
										<div class="m-login__form-action">
											<input type="hidden" name="hidden" value="forget">
											<button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">
												Gửi yêu cầu
											</button>
											<button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">
												Thoát ra
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="m-stack__item m-stack__item--center">
							<div class="m-login__account">
								<span class="m-login__account-msg">
									Bạn chưa có tài khoản, hãy nhấn đăng ký nhé!
								</span>
								&nbsp;&nbsp;
								<a href="javascript:;" id="m_login_signup" class="m-link m-link--focus m-login__account-link">
									Đăng ký
								</a>
							</div>
						</div>
						<?php }?>
					</div>
				</div>
				<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url(dist/assets/app/media/img/bg/background1.jpg);padding: 15px;">
					<div class="m-grid__item m-grid__item--middle titleFix">
						<h3 class="m-login__welcome t_align_center">
							Y Tế Việc <br> Việc Chất Ngành Y
						</h3>
						<div class="m-login__msg">
							<div class="right_register">
								<ul>
									<li>Webiste tuyển dụng hàng đầu ngành Y Tế</li>
									<li>Hơn 1 triệu lượt xem mỗi tháng</li>
									<li>Hơn 100 CV tham gia mỗi ngày</li>
									<li>Nhiều ứng viên tìm năng để lựa chọn</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			var page = urlParam("page");
			var login = $('#m_login');
			if(page == "sign-up"){
				login.removeClass('m-login--forget-password');
				login.removeClass('m-login--signin');

				login.addClass('m-login--signup');
				login.find('.m-login__signup').addClass('flipInX animated');
			}
			
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
		