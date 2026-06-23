jQuery(document).ready(function ($) {



	// Äá»‹nh dáº¡ng tiá»n tá»‡

	$(".formatnumber").keyup(function(){

		$(this).val(format($(this).val()));

	});



	$('.datepicker').datepicker();

	var maxWidth = jQuery(window).width();

	$(".hero-banner-item").css("width", maxWidth);

	

	moveRight();

	setInterval(function () {moveRight();}, 10000);

  

	var slideCount = $('#slider .hero-banner-list .hero-banner-item').length;

	var slideWidth = $('#slider .hero-banner-list .hero-banner-item').width();

	var slideHeight = $('#slider .hero-banner-list .hero-banner-item').height();

	var sliderUlWidth = slideCount * slideWidth;

	

	//$('#slider').css({ width: slideWidth, height: slideHeight });

	

	$('#slider .hero-banner-list').css({ width: sliderUlWidth, marginLeft: - slideWidth });

	

    $('#slider .hero-banner-list .hero-banner-item:last-child').prependTo('#slider .hero-banner-list');



    function moveLeft() {

        $('#slider .hero-banner-list').animate({

            left: + slideWidth

        }, 200, function () {

            $('#slider .hero-banner-list .hero-banner-item:last-child').prependTo('#slider .hero-banner-list');

            $('#slider .hero-banner-list').css('left', '');

        });

    };



    function moveRight() {

        $('#slider .hero-banner-list').animate({

            left: - slideWidth

        }, 200, function () {

            $('#slider .hero-banner-list .hero-banner-item:first-child').appendTo('#slider .hero-banner-list');

            $('#slider .hero-banner-list').css('left', '');

        });

    };

	$(".career_register").click(function(){

		register();

	})

	$(".career_login").click(function(){

		var frm = $(this).parents("form").first().attr("id");

		var email = $("#" + frm + " input[name=loginemail]").val();

		var password = $("#" + frm + " input[name=loginpassword]").val();

		if(password.length < 6 || password.length > 50){

			swal({

				title: "Lỗi",

				text: "Mật khẩu có độ dài từ 6 đến 50 ký tự",

				type: "warning"

			})

			return false;

		}

		$.ajax({

			url: "login",

			type: "POST",

			data: {do: "login", email: email, password: password},

			success: function(rs){

				if(rs == 1){

					swal({

						title: "",

						text: "Đăng nhập thành công",

						type: "success"

					}, function (){

						window.location = $("#currentlink").val();

					})

				}else{

					swal({

						title: "",

						text: "Địa chỉ email hoặc mật khẩu không đúng",

						type: "warning"

					})

				}

			}

		})

	})

	$("#applySendProcessBtn").click(function(){

		var btn = $(this);

		var sodienthoai = $("#sodienthoai").val();

		var congviec_id = $("#congviec_id").val();

		if (sodienthoai.length < 10 || isNaN(sodienthoai)) {

			swal({

				title: "Lỗi",

				text: "Số điện thoại không đúng định dạng",

				type: "warning"

			})

			return false;

		}

		//var gioithieungan = $("#gioithieungan").val();

		/* if(gioithieungan.length > 500){

			swal({

				title: "Lỗi",

				text: "Giới thiệu ngắn không được quá 500 ký tự",

				type: "warning"

			})

			return false;

		} */

		var hoso = $('input[name=hoso]').val();

		if(hoso.length == 0){

			swal({

				title: "",

				text: "Bạn cần chọn hồ sơ",

				type: "warning"

			})

			return false;

		}

		$.ajax({

			url: "ungtuyen",

			type: "POST",

			data: {do: "ungtuyen", sodienthoai: sodienthoai, congviec_id: congviec_id, hoso:hoso, tinhthanh_id: $("#tinhthanh").val(), congty_id: $("#congty").val()},

			beforeSend: function(){

				btn.find("i").show();

				btn.prop("disabled", true);

			},

			success: function(rs){

				if(rs == 1){

					btn.find("i").hide();

					btn.prop("disabled", true);

					swal({

						title: "Đã đăng ký ứng tuyển",

						text: "Hồ sơ của bạn đã được gửi lên hệ thống, chúc bạn may mắn tìm được công việc yêu thích",

						type: "success"

					}, function (){

						location.reload();

					})

				}else if(rs == 0){

					swal({

						title: "Lỗi",

						text: "Có lỗi xảy ra trong quá trình nộp hồ sơ mong bạn thử lại",

						type: "warning"

					})

					btn.find("i").hide();

					btn.prop("disabled", false);

				}else if(rs == -1){

					swal({

						title: "Lỗi",

						text: "Bạn chưa nhập đầy đủ thông cần thiết",

						type: "warning"

					})

					btn.find("i").hide();

					btn.prop("disabled", false);

				}

			}

		})

	})

	$("#hoso").change(function(event){

		var myfile = $(this).val();

		var file_data = $(this).prop('files')[0];

		var ext = myfile.split('.').pop();

		var filesize = Math.round($(this)[0].files[0].size / 1024);

		if(ext != "pdf" && ext != "docx" && ext != "doc"){

			$(this).val('');

			swal({

				title: "",

				text: "Vui lòng chọn tập tin đính kèm với định dạng .doc, .docx, .pdf",

				type: "warning"

			})

		} else if(filesize > 2048){

			$(this).val('');

			swal({

				title: "",

				text: "Vui lòng chọn tập tin đính kèm nhỏ hơn 2048KB",

				type: "warning"

			})

		}else{

			var form_data = new FormData();                  

			form_data.append('file', file_data);

			$.ajax({

				url: 'uploadhoso?do=uploadhoso',

				dataType: 'text',

				cache: false,

				contentType: false,

				processData: false,

				data: form_data,                         

				type: 'post',

				success: function(result){

					$('input[name=hoso]').val(result);

				}

			});

		}

	})



	// var textVal = "";

	// $("form[name=formDangKy] [name=danhmuccv_id] option").each(function(){

	// 	textVal = $(this).text();

	// 	textVal = textVal.replace("Việc làm", "");

	// 	textVal = textVal.replace("Việc Làm", "");

	// 	$(this).text(textVal);

	// })



	// $("form[name=formDangKy] [name=jobstatus_id]").change(function(){

	// 	var value = $(this).val();

	// 	// 1: sinh viên, 2: đã đi làm

	// 	if(value == 1){

	// 		$("form[name=formDangKy] [name=chuyenkhoa_id]").show();

	// 		$("form[name=formDangKy] [name=danhmuccv_id]").hide();

	// 		$("#slJS").html("Chọn ngành");

	// 	}else{

	// 		$("form[name=formDangKy] [name=chuyenkhoa_id]").hide();

	// 		$("form[name=formDangKy] [name=danhmuccv_id]").show();

	// 		$("#slJS").html("Chọn chuyên ngành");

	// 	}

	// })

});



function register(){

	$.ajax({

		url: "register",

		type: "POST",

		dataType: "json",

		data: $("form[name=formDangKy]").serialize(),

		success: function(result){

			swal({

				title: result.title,

				text: result.message,

				type: result.type

			}, function (){

				if(result.status){

					window.location = ".";

				}else{

					setTimeout(function(){

						$("form[name=formDangKy] [name="+result.focus+"]").focus();

					}, 100);

				}

			})

		}

	})

}



function initApplyForm() {

	$('#ApplyForm').modal('show');

}



function clearAllValues(classParentElm){

	$("."+ classParentElm).last().find("input, select, textarea").each(function(){

		$(this).val('');

		$(this).find("option[value='']").prop('selected', true);

	})

}



function uploadImage(){

	var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];

	var file_data = $("#formUpload #uploadImage").prop('files')[0];

	var fileType = $("#formUpload #uploadImage").prop('files')[0].type;

	if ($.inArray(fileType, ValidImageTypes) < 0) {

		 alert("Bạn cần chọn file ảnh");

	}else{

		var form_data = new FormData();                  

		form_data.append('file', file_data);	

		$.ajax({

			url: 'uploadimage?profilecv_id='+$("input[name=profilecv_id]").val(),

			dataType: 'text',

			cache: false,

			contentType: false,

			processData: false,

			data: form_data,                         

			type: 'post',

			success: function(result){

				var d = new Date();

				$("#formUpload img").attr('src', result+"?"+d.getTime());

				$("input[name=hinhanh]").val(result);

			}

		});

	}

}



// HĂ m Ä‘á»‹nh dáº¡ng tiá»n

var format = function(num){

	var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;

	if(str.indexOf(".") > 0) {

		parts = str.split(".");

		str = parts[0];

	}

	str = str.split("").reverse();

	for(var j = 0, len = str.length; j < len; j++) {

		if(str[j] != ",") {

			output.push(str[j]);

			if(i%3 == 0 && j < (len - 1)) {

				output.push(",");

			}

			i++;

		}

	}

	formatted = output.reverse().join("");

	return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));

};








