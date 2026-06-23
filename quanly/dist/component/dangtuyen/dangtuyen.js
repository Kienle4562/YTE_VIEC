$(function(){
	checkLHHDAdd();

	var danhmuccv_id = $("[name=danhmuccv_id]").val();
	loadChuyenKhoa(danhmuccv_id);
	$("[name=danhmuccv_id]").change(function(){
		var values = $(this).val();
		if(values == 1)
		{
			$('.lbaction').text("Chọn chuyên khoa");
		}else if(values == 99)
		{
			$('.lbaction').text("Nhập chuyên ngành");
		}else
		{
			$('.lbaction').text("Chọn chuyên ngành");
		}
		loadChuyenKhoa(values);
	})
	
	$("[name=kinhnghiem_id]").change(function(){
		var values   = $(this).val();
	
		if(values != 2){
			$('[name=sonamkinhnghiem]').css('display','none');
		
		}else{
			$('[name=sonamkinhnghiem]').css('display','block');
		}
	})
	
	$("[name=loaihinhhoatdong_id], [name=loaihinhhoatdong2_id], [name=loaihinhhoatdong3_id]").change(function(){
		var values   = $(this).val();
		var textarea = $(this).data('textarea');
		//var name = $(this).attr("name");
		if(values != 9){
			//$("[name="+textarea+"]").prop("readonly", true).val('');
			$("[name="+textarea+"]").parent("div").hide();
		
		}else{
			//$("[name="+textarea+"]").prop("readonly", false);
			$("[name="+textarea+"]").parent("div").show();
			//$(this).attr("name").parent("div").hide();
		}
	})

	$("[name=nguoilienhe]").change(function(){
		nguoilienhe();
	})
})

function nguoilienhe(){
	var nguoilienhe = $("[name=nguoilienhe]").val();
	$(".showNLH").html(nguoilienhe);
}

function removeLHHD($idDiv){
	$("#"+$idDiv).hide();
	var textarea = $("#"+$idDiv).find("select").data('textarea');
	$("[name="+textarea+"]").val("").prop("readonly", false).parent("div").hide();
	checkLHHDAdd();
}

function addLHHD(){
	var LHHD2 = $("#LHHD2");
	var LHHD3 = $("#LHHD3");

	if(!LHHD2.is(":visible")){
		LHHD2.show();
		LHHD2.find('select').val(0);
	//$("[name=loaihinhhoatdongkhac2]").parent("div").show();
	}else if(!LHHD3.is(":visible")){
		LHHD3.show();
		LHHD3.find('select').val(0);
		//$("[name=loaihinhhoatdongkhac3]").parent("div").show();
	}
	checkLHHDAdd();
}
$(document).on("change", "[name=mucluongtoithieu], [name=mucluongtoida]", function(){
	var luongtoithieu = Number($(this).val().replace(/[^0-9.-]+/g,""));
	var mucluongtoida = Number($(this).val().replace(/[^0-9.-]+/g,""));
	  if(luongtoithieu < 1000000)
		{
			alert('Lương tối thiểu lớn phải lớn hơn 1 triệu');
			return false;
		}else if(mucluongtoida < 1000000)
		{
			alert('Lương tối đa lớn phải lớn hơn 1 triệu');
			return false;
		}else if(mucluongtoida < luongtoithieu)
		{
			alert('Lương tối thiểu  phải nhỏ hơn tối đa');
			return false;
		}
})


function checkLHHDAdd(){
	var LHHD2 = $("#LHHD2");
	var LHHD3 = $("#LHHD3");
	if(LHHD2.is(":visible") && LHHD3.is(":visible")){
		$("#addLHHD").hide();
	}else{
		$("#addLHHD").show();
	}
}

// Khai báo đối tượng timeout để dùng cho hàm
	// clearTimeout
	var timeout = null;
	var jsonData = {};
	$(document).on("keyup","[name=code_oder]", function(){
		var txt = $(this);
		// Xóa đi những gì ta đã thiết lập ở sự kiện
		// keyup của ký tự trước (nếu có)
		clearTimeout(timeout);
		// Sau khi xóa thì thiết lập lại timeout
		timeout = setTimeout(function (){
			var values = txt.val();
		 //	var type = txt.data('autocomplete');
			$.ajax({
				type: "POST",
				url: "Model_congviec.ajax",
				data: {
					act: 'getSuggesstOder',
					name: values,
				},
				async: true,
				dataType: 'json',
				beforeSend: function(){
					txt.css("background","#FFF url(image/loaderIcon.gif) no-repeat right");
				},
				success: function(data){
					jsonData = data;
					if(!isJsonEmpty(data)){
						txt.next().next().show();
						var html = "";
						for (var key in data) {
							html += '<div data-key="'+key+'" data-value="'+data[key]['ma_don_hang']+'" class="tt-suggestion tt-selectable">'+data[key]['ma_don_hang']+'</div>';
						}
						console.log(html);
						html += '<div data-value="" style="background:#ccc;text-align: center;margin-bottom: -5px;font-weight: bold;" class="tt-suggestion tt-selectable">HỦY</div>';
						txt.next().next().find(".loadSuggess").html(html);
						txt.css("background","#FFF"); 
					}else{
						
						txt.next().next().hide();
						txt.css("background","#FFF");
					}
				}
			});
		}, 500);
	});

 // END
 function isJsonEmpty(obj) {
	for(var key in obj) {
		if(obj.hasOwnProperty(key))
			return false;
	}
	return true;
}
	$(document).on("click", ".tt-suggestion", function(){
		var btn = $(this);
		var key = btn.data('key');
		var ma_don_hang  = jsonData[key]['ma_don_hang'];
		var congty_id	 = jsonData[key]['congty_id'];
		var attrib_function 	 = jsonData[key]['attrib_function'];
		
			$.ajax({
				url: "Model_congviec.ajax",
				type: "POST",
				data: {
					act: "getcheck",
					ma_don_hang: ma_don_hang,
					congty_id: congty_id,
					attrib_function: attrib_function
				},
				error: function(jqXHR, textStatus, errorThrown) {
					toastr["warning"](errorThrown, textStatus);
				},
				success: function(resultHTML){
				 ("#show_dichvu").html(resultHTML);
				}
			})
		/* $(".btnSaveAndPrintConfirmPT").prop("disabled", false);
		$(".btnSaveAndPrintConfirmPT").removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);	
		var congty_id  = jsonData[key]['congty_id'];
		var tencongty	 = jsonData[key]['tencongty'];
		var email 	 = jsonData[key]['email'];
		var nguoilienhe	 = jsonData[key]['nguoilienhe'];
		var sdthoai	  = jsonData[key]['sdthoai'];
			$("#email").val(email);
			$("#tencongty").val(tencongty);
		    $("#phone").val(sdthoai);
			$("#nguoilienhe").val(nguoilienhe);
			$("#congty_id").val(congty_id); */

		btn.parent().parent().hide();
	})