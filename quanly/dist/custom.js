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
	jQuery('.check_active_link a[href="'+location.href+'"]').parents('li').addClass('m-menu__item--active m-menu__item--open');
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
	$(".currency").val(0);
	$(".currency").click(function(){
		$(this).select();
	});
	$(".currency").keyup(function(){
		$(this).val(format($(this).val()));
	});
	// Xử lý checkbox
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
	
	$("body").keydown(function (key) {
		if (key.which == 112) { // F1 key
			window.location.href = "nhatro.html";
			return false;
		}
		if (key.which == 113) { // F2 key
			window.location.href = "phongtro.html";
			return false;
		}
		else if (key.which == 114) { // F3 key
			window.location.href = "setdichvu.html";
			return false;
		}
		else if (key.which == 115) { // F4 key
			window.location.href = "thiet-bi.html";
			return false;
		}
		else if (key.which == 116) { // F5 key
			window.location.href  = $('#top-toolbar-f5').attr('href');
			return false;
		}
		else if (key.which == 117) { // F6 key
			window.location.href  = $('#top-toolbar-f6').attr('href');
			return false;
		}
		else if (key.which == 118) { // F7 key
			window.location.href  = $('#top-toolbar-f7').attr('href');
			return false;
		}
		else if (key.which == 119) { // F8 key
			window.location.href  = $('#top-toolbar-f8').attr('href');
			return false;
		}
		else if (key.which == 120) { // F9 key
			window.location.href  = $('#top-toolbar-f9').attr('href');
			return false;
		}
		else if (key.which == 121) { // F10 key
			window.location.href  = $('#top-toolbar-f10').attr('href');
			return false;
		}
		else if (key.which == 122) { // F11 key
			window.location.href  = $('#top-toolbar-f11').attr('href');
			return false;
		}
		else if (key.which == 999) { // F12 key 123
			window.location.href  = $('#top-toolbar-f12').attr('href');
			return false;
		}
	});
});