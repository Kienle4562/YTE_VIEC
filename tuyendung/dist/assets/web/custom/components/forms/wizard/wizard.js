//== Class definition
var WizardDemo = function () {
    //== Base elements
    var wizardEl = $('#m_wizard');
    var formEl = $('#m_form');
    var validator;
    var wizard;
    
    //== Private functions
    var initWizard = function () {
        //== Initialize form wizard
        wizard = wizardEl.mWizard({
            startStep: 1
        });

        //== Validation before going to next page
        wizard.on('beforeNext', function(wizard) {
            if (validator.form() !== true) {
                return false;  // don't go to the next step
            }
        })

        //== Change event
        wizard.on('change', function(wizard) {
            mApp.scrollTop();
        });
    }

    var initValidation = function() {
        validator = formEl.validate({
            //== Validate only visible fields
            ignore: ":hidden",

            //== Validation rules
            rules: {
                //=== Client Information(step 1)
                //== Client details
                tencongviec: {
                    required: true 
                },
                motacongviec: {
                    required: true
                },       
                chuyenmonyeucau: {
                    required: true
                },
				ngayhethan: {
                    required: true
                },
				kinhnghiem_id: {
                    required: true
                },
				capbac_id: {
                    required: true
                }
            },

            //== Validation messages
            messages: {
                'account_communication[]': {
                    required: 'You must select at least one communication option'
                },
                accept: {
                    required: "You must accept the Terms and Conditions agreement!"
                } 
            },
            
            //== Display error  
            invalidHandler: function(event, validator) {     
                mApp.scrollTop();

                swal({
                    "title": "", 
                    "text": "Có một số lỗi trong bài gửi của bạn. Vui lòng sửa chúng.", 
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
                });
            },

            //== Submit valid form
            submitHandler: function (form) {
                
            }
        });   
    }

    var initSubmit = function() {
        var btn = formEl.find('[data-wizard-action="submit"]');

        btn.on('click', function(e) {
            e.preventDefault();
            if (validator.form()) {
				btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                mApp.progress(btn);
                formEl.ajaxSubmit({
                    url: 'Model_dangtuyen.ajax?act='+$("#act").val(),
					type: "POST",
					success: function(response, status, xhr, $form) { 
						// similate 2s delay
						setTimeout(function() {
							btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false); // remove 
							formEl.clearForm(); // clear form
							formEl.validate().resetForm(); // reset validation states
							if(response.trim() == 1){
								swal({
									"title": "Y Tế Việc", 
									"text": "Tin của bạn đã được đăng lên hệ thống!", 
									"type": "success",
									"confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
								}).then(function() {
									window.location.href = ".";
								});
							}else{
								swal({
									"title": "Lỗi hệ thống", 
									"text": "Có một số lỗi trong bài gửi của bạn. Vui lòng thử lại.", 
									"type": "error",
									"confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
								});
							}
						}, 2000);
					}
                });
            }
        });
    }

    return {
        // public functions
        init: function() {
            wizardEl = $('#m_wizard');
            formEl = $('#m_form');

            initWizard(); 
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {    
    WizardDemo.init();
	$(".chkCheckBox").change(function(){
		var formId = $(this).parents("form").attr("id");
		var myClass = $(this).attr("class").replace("chkCheckBox ","");
		var val = "/";
		$("form#" + formId + " ." + myClass).each(function(){
			if($(this).is(":checked")){
				val += $(this).val() + "/";
			}
		})
		val = val.length == 1 ? "" : val;
		$("form#" + formId + " input[name=" + myClass + "]").val(val);
	})
});
jQuery(document).ready(function() {    
	$(".chkCheckBoxSevicer").change(function(){
		//var formId = $(this).parents("form").attr("id");
		$('input.chkCheckBoxSevicer').not(this).prop('checked', false);
		/* var myClass = $(this).attr("class").replace("chkCheckBoxSevicer ","");
		var val = "";
		$("form#" + formId + " ." + myClass).each(function(){
			if($(this).is(":checked")){
				val += $(this).val() + "";
			}
		})
		//val = val.length == 1 ? "" : val;
		$("form#" + formId + " input[name=" + myClass + "]").val(val); */
	})
});