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
