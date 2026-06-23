//== Class Definition
var SnippetLogin = function() {

    var login = $('#m_login');

    var showErrorMsg = function(form, type, msg) {
        var alert = $('<div class="m-alert m-alert--outline alert alert-' + type + ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        alert.animateClass('fadeIn animated');
        alert.find('span').html(msg);
    }

    //== Private Functions

    var displaySignUpForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signin');

        login.addClass('m-login--signup');
        login.find('.m-login__signup').animateClass('flipInX animated');
    }

    var displaySignInForm = function() {
        login.removeClass('m-login--forget-password');
        login.removeClass('m-login--signup');

        login.addClass('m-login--signin');
        login.find('.m-login__signin').animateClass('flipInX animated');
    }

    var displayForgetPasswordForm = function() {
        login.removeClass('m-login--signin');
        login.removeClass('m-login--signup');

        login.addClass('m-login--forget-password');
        login.find('.m-login__forget-password').animateClass('flipInX animated');
    }

    var handleFormSwitch = function() {
        $('#m_login_forget_password').click(function(e) {
            e.preventDefault();
            displayForgetPasswordForm();
        });

        $('#m_login_forget_password_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });

        $('#m_login_signup').click(function(e) {
            e.preventDefault();
            displaySignUpForm();
        });

        $('#m_login_signup_cancel').click(function(e) {
            e.preventDefault();
            displaySignInForm();
        });
    }

    var handleSignInFormSubmit = function() {
        $('#m_login_signin_submit').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    TenDangNhap: {
                        required: true
                    },
                    password: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: 'login.send?',
				type: "POST",
                success: function(response, status, xhr, $form) {
                	// similate 2s delay
                	setTimeout(function() {
	                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
	                    if(response == 1){
							showErrorMsg(form, 'success', "Chúc mừng bạn đã đăng nhập thành công!!!");
							window.location = ".";
						}else{
							showErrorMsg(form, 'danger', "Tài khoản hoặc mật khẩu không chính xác. Vui lòng thử lại.");
						}
                    }, 2000);
                }
            });
        });
    }

    var handleSignUpFormSubmit = function() {
        $('#m_login_signup_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
						maxlength: 100,
						minlength: 6
                    },
                    password: {
                        required: true,
						maxlength: 50,
						minlength: 6
                    },
                    rpassword: {
                        required: true,
						equalTo : "form.signupForm input[name=password]"
                    },
					tencongty: {
                        required: true,
						maxlength: 100,
						minlength: 6
                    },
					gioithieungan: {
                        required: true,
						minlength: 6
                    },
					diachicongty: {
                        required: true,
						maxlength: 100,
						minlength: 6
                    },
					sdthoai: {
                        required: true,
						number:true,
						maxlength: 12,
						minlength: 9
                    },
					maxacnhan: {
						required: true
					},
                    agree: {
                        required: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: 'sign-up.send?',
				type: "POST",
                success: function(response, status, xhr, $form) {
                	// similate 2s delay
                	setTimeout(function() {
	                    btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
	                    //form.clearForm();
	                    //form.validate().resetForm();
	                    var signInForm = login.find('.m-login__signin form');
	                    signInForm.clearForm();
	                    signInForm.validate().resetForm();
						if(response == 0){
							showErrorMsg(form, 'danger', "Email này đã có người sử dụng, bạn hãy chọn một email khác nhé!");
							document.getElementById('form_register_captcha').src = 'capcha.php';
						}else if(response == -1){
							showErrorMsg(form, 'danger', "Mã xác nhận không đúng. Vui lòng thử lại.");
							document.getElementById('form_register_captcha').src = 'capcha.php';
						}else{
							// display signup form
							displaySignInForm();
							showErrorMsg(signInForm, 'success', 'Cảm ơn bạn. Để hoàn thành đăng ký của bạn, vui lòng kiểm tra Email và làm theo hướng dẫn. <br><b style="color:red">Nếu không thấy Email kích hoạt tài khoản trong hộp thư đến, vui lòng kiểm tra hộp thư Spam</b>');
							document.getElementById('form_register_captcha').src = 'capcha.php';
						}
					}, 2000);
                }
            });
        });
    }

    var handleForgetPasswordFormSubmit = function() {
        $('#m_login_forget_password_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form.forgetpass');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: 'forget.send',
				type: 'POST',
                success: function(response, status, xhr, $form) { 
                	// similate 2s delay
                	setTimeout(function() {
						var json = $.parseJSON(response);
						btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
						if(json.status == 200){
							form.clearForm(); // clear form
							form.validate().resetForm(); // reset validation states
							// display signup form
							displaySignInForm();
							var signInForm = login.find('.m-login__signin form');
							signInForm.clearForm();
							signInForm.validate().resetForm();
							showErrorMsg(signInForm, 'success', json.message);
						}else if(json.status == 1001){
							showErrorMsg(form, 'danger', json.message);
						}else{
							showErrorMsg(form, 'danger', 'Lỗi không xác định');
						}
                	}, 2000);
                }
            });
        });
    }
	
	// Tạo lại mật khẩu
	var handleCreateNewPasswordFormSubmit = function() {
        $('#m_login_create_new_password_submit').click(function(e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form.newpass');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
					password: {
                        required: true,
						maxlength: 50,
						minlength: 6
                    },
                    repassword: {
                        required: true,
						equalTo : "form.newpass input[name=password]"
                    }
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            form.ajaxSubmit({
                url: 'newpassword.send',
				type: 'POST',
                success: function(response, status, xhr, $form) { 
                	// similate 2s delay
                	setTimeout(function() {
						var json = $.parseJSON(response);
						btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
						if(json.status == 200){
							form.clearForm(); // clear form
							form.validate().resetForm(); // reset validation states
							showErrorMsg(form, 'success', json.message);
							swal({
								title:"",
								text: json.message,
								type: "info"
							}).then(function() {
								window.location = ".";
							});
							//$("#btnBackLogin").removeAttr("style");
						}else if(json.status == 1001){
							showErrorMsg(form, 'danger', json.message);
						}else{
							showErrorMsg(form, 'danger', 'Lỗi không xác định');
						}
                	}, 2000);
                }
            });
        });
    }

    //== Public Functions
    return {
        // public functions
        init: function() {
            handleFormSwitch();
            handleSignInFormSubmit();
            handleSignUpFormSubmit();
            handleForgetPasswordFormSubmit();
			handleCreateNewPasswordFormSubmit();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    SnippetLogin.init();
});