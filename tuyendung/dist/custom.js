// Hàm copy từ một thẻ Input
function copyTextFromInput(idInput) {
  var copyText = document.getElementById(idInput);
  copyText.select();
  document.execCommand("copy");
  toastr["success"]("Nội dung đã được copy", "Copy!!!");
}

// Hàm lấy param của link
function urlParam(name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	if (results==null){
	   return null;
	}
	else{
	   return decodeURI(results[1]) || 0;
	}
}

// Hàm tự set class active cho menu
function check_active_link(){
	if(window.location.pathname == "/"){
		jQuery('.check_active_link li:first-child').addClass('m-menu__item--active m-menu__item--open');
	}else{
		jQuery('.check_active_link a[href="'+location.href+'"]').parents('li').addClass('m-menu__item--active m-menu__item--open');
	}
}
setTimeout(function(){
	check_active_link();
}, 500);

// Khởi tạo selectpicker
var BootstrapSelect = function () {
    
    //== Private functions
    var selectPicker = function () {
        // minimum setup
        $('.m_selectpicker').selectpicker();
    }

    return {
        // public functions
        init: function() {
            selectPicker(); 
        }
    };
}();

// tạo phím tắt
$(document).ready(function () {
	// run selectpicker
	BootstrapSelect.init();
	
	// validate textarea
	//$('#formDataInsert textarea, #formDataUpdate textarea').keyup(validateTextarea);
	
	// Định dạng tiền tệ
	$(".currency").click(function(){
		$(this).select();
	});
	$(".currency").keyup(function(){
		//alert($(this).val());
		if($(this).val() < 1000000)
		{
			
		}
		$(this).val(format($(this).val()));
	});
	
	
});