//các hàm do NhatPhongCr viết ^_^
function deleteData(arrayId, com_name){
	swal({
		title: "Xóa dữ liệu?",
		text: "Bạn có chắc muốn xóa dữ liệu này",
		icon: "success",

		confirmButtonText: "<span><i class='la la-thumbs-up'></i><span>Đồng ý</span></span>",
		confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--air m-btn--icon",

		showCancelButton: true,
		cancelButtonText: "<span><i class='la la-thumbs-down'></i><span>Hủy bỏ</span></span>",
		cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
	}).then(function(result){
		if (result.value) {
			$.ajax({
				url: "Model_"+com_name+".ajax",
				type: "POST",
				data: "id=" + arrayId + "&act=Delete",
				success: function(result){
					if(result == 1){
						$('.m_datatable').mDatatable('reload');
						toastr["success"]("Đã cập nhật!", "Xóa dữ liệu thành công!");
					}else{
						toastr["warning"]("Lỗi", "Xin kiểm tra lại");
					}
				}
			})
		}
	});
}

// Hàm upload common
function uploadImage(event, com_name, elm, i){
	var formName = "";
	if(i == 0){
		formName = "formDataInsert";
	}else{
		formName = "formDataUpdate";
	}
	var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
	var file_data = $('#' + formName + " #" + elm).prop('files')[0];
	var fileType = $('#' + formName + " #" + elm).prop('files')[0].type;
	if ($.inArray(fileType, ValidImageTypes) < 0) {
		 toastr["warning"]("Lỗi", "Bạn chỉ nên upload file ảnh");
	}else{
		var form_data = new FormData();                  
		form_data.append('file', file_data);	
		$.ajax({
			url: 'Model_'+com_name+'.ajax?act=Upload',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                         
			type: 'post',
			beforeSend: function(){
				$('#' + formName + " .progressLoadImg_"+ elm.replace("file_", "")).removeAttr('style');
				$('#' + formName + " img#" + elm.replace("file_", "")).attr('style', 'display:none');
			},
			success: function(result){
				$('#' + formName + " .progressLoadImg_"+ elm.replace("file_", "")).attr('style', 'display:none');
				$('#' + formName + " img#" + elm.replace("file_", "")).removeAttr('style');
				$('#' + formName + " #" + elm.replace("file_", "")).val(result.trim());
				$('#' + formName + " img#" + elm.replace("file_", "")).attr('src', result);
				$('#' + formName + " #" + elm).val('');
			}
		});
	}
}

function uploadImageCompany(event, com_name, elm, i){
	var formName = "";
	if(i == 0){
		formName = "formDataUpdateCompany";
	}else{
		formName = "formDataUpdateCompany";
	}
	var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
	var file_data = $('#' + formName + " #" + elm).prop('files')[0];
	var fileType = $('#' + formName + " #" + elm).prop('files')[0].type;
	if ($.inArray(fileType, ValidImageTypes) < 0) {
		 toastr["warning"]("Lỗi", "Bạn chỉ nên upload file ảnh");
	}else{
		var form_data = new FormData();                  
		form_data.append('file', file_data);	
		$.ajax({
			url: 'Model_'+com_name+'.ajax?act=Upload',
			dataType: 'text',
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                         
			type: 'post',
			beforeSend: function(){
				$('#' + formName + " .progressLoadImg_"+ elm.replace("file_", "")).removeAttr('style');
				$('#' + formName + " img#" + elm.replace("file_", "")).attr('style', 'display:none');
			},
			success: function(result){
				$('#' + formName + " .progressLoadImg_"+ elm.replace("file_", "")).attr('style', 'display:none');
				$('#' + formName + " img#" + elm.replace("file_", "")).removeAttr('style');
				$('#' + formName + " #" + elm.replace("file_", "")).val(result.trim());
				$('#' + formName + " img#" + elm.replace("file_", "")).attr('src', result);
				$('#' + formName + " #" + elm).val('');
			}
		});
	}
}

function loadDataEdit(id, com_name){
	$.getJSON('Model_'+com_name+'.ajax?id='+id+"&act=LoadDataEdit", function(data) {
		for (var i in data) {
			var $el = $('#formDataUpdate [name="'+i+'"]'),
			type = $el.attr('type');
			if(isNaN(data[i]) == false && i.indexOf("dongia") >= 0&& i.indexOf("mucluongtoithieu") >= 0&& i.indexOf("mucluongtoida") >= 0){
				data[i] = format(data[i]);
			}
			switch(type){
				case 'inputCheckBox':
					$('#formDataUpdate .' + i).prop('checked', false);
					var arrayList = data[i].split("/");
					arrayList.forEach(function(elm){
						$('#formDataUpdate .' + i + '[value="'+elm+'"]').prop('checked', true);
					})
					$('#formDataUpdate input[name="'+i+'"]').val(data[i]);
				break;
				case 'checkbox':
					$el.prop('checked', false);
					if(data[i] == 1){
						$el.prop('checked', true);
					}
				break;
				case 'password':
					$('#formDataUpdate input[name="'+i+'"]').val('');
				break;
				case 'radio':
					$el.prop('checked', false);
					$el.filter('[value="'+data[i]+'"]').prop('checked', true);
				break;
				case 'hidden':
					if(data[i].length == 0){
						data[i] = "image/noimage.jpg";
					}
					$('#formDataUpdate img#'+i).attr("src", data[i]);
					$('#formDataUpdate input[name="'+i+'"][type=hidden]').val(data[i]);
					$('#formDataUpdate input[name="'+i+'"][type=file]').val(data[i]);
				break;
				default: 
					$('#formDataUpdate input[name="'+i+'"],#formDataUpdate select[name="'+i+'"],#formDataUpdate textarea[name="'+i+'"]').val(data[i]).change();
					$('#formDataUpdate .m_selectpicker').selectpicker('refresh');
			}
		}
	});
}

function loadDataCopy(id, com_name){
	$.getJSON('Model_'+com_name+'.ajax?id='+id+"&act=LoadDataEdit", function(data) {
		for (var i in data) {
			var $el = $('#formDataInsert [name="'+i+'"]'),
			type = $el.attr('type');
			if(isNaN(data[i]) == false && i.indexOf("dongia") >= 0){
				data[i] = format(data[i]);
			}
			switch(type){
				case 'inputCheckBox':
					$('#formDataInsert .' + i).prop('checked', false);
					var arrayList = data[i].split("/");
					arrayList.forEach(function(elm){
						$('#formDataInsert .' + i + '[value="'+elm+'"]').prop('checked', true);
					})
					$('#formDataInsert input[name="'+i+'"]').val(data[i]);
				break;
				case 'checkbox':
					$el.removeAttr('checked');
					if(data[i] == 1){
						$el.prop('checked', true);
					}
				break;
				case 'radio':
					$el.prop('checked', false);
					$el.filter('[value="'+data[i]+'"]').prop('checked', true);
				break;
				case 'hidden':
					if(data[i].length == 0){
						data[i] = "image/noimage.jpg";
					}
					$('#formDataInsert img#'+i).attr("src", data[i]);
					$('#formDataInsert input[name="'+i+'"][type=hidden]').val(data[i]);
				break;
				default: 
					$('#formDataInsert input[name="'+i+'"],#formDataInsert select[name="'+i+'"],#formDataInsert textarea[name="'+i+'"]').val(data[i]).change();
					$('#formDataInsert .m_selectpicker').selectpicker('refresh');
			}
		}
	});
}
function updateData_cty(event, com_name, elm){
	var btn = $("#"+elm);
		$("#formDataUpdate .currency").each(function(){
			$(this).val($(this).val().replace(/,/g,""));
		})
		var valueCheckBox = "";
		$("#formDataUpdate input[type=checkbox]:not(:checked)").each(function(){
			valueCheckBox += '&'+this.name+'=0';
		})
		$.ajax({
			url: "Model_"+com_name+".ajax",
			type: "POST",
			data: $("#formDataUpdate").serialize() + valueCheckBox + "&act=Update",
			beforeSend: function(){
				btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
			},
			success: function(result){
				setTimeout(function() {
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
					if(result == 1){
						if($('#formDataUpdate .currency').length > 0){
							$("#formDataUpdate .currency").val(format($("#formDataUpdate .currency").val()));
						}
						toastr["success"]("Đã cập nhật!", "Cập nhật dữ liệu thành công!");
						$('.m_datatable').mDatatable('reload');
						$("#Dialog_CapNhat").modal('hide');
					}else{
						toastr["warning"]("Lỗi", "Xin kiểm tra lại");
					}
				}, 1000);
			}
		})
}
function updateData_cty2(event, com_name, elm){
	var btn = $("#"+elm);
		$("#formDataUpdateCompany .currency").each(function(){
			$(this).val($(this).val().replace(/,/g,""));
		})
		var valueCheckBox = "";
		$("#formDataUpdateCompany input[type=checkbox]:not(:checked)").each(function(){
			valueCheckBox += '&'+this.name+'=0';
		})
		$.ajax({
			url: "Model_"+com_name+".ajax",
			type: "POST",
			data: $("#formDataUpdateCompany").serialize() + valueCheckBox + "&act=Update",
			beforeSend: function(){
				btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
			},
			success: function(result){
				setTimeout(function() {
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
					if(result == 1){
						if($('#formDataUpdateCompany .currency').length > 0){
							$("#formDataUpdateCompany .currency").val(format($("#formDataUpdateCompany .currency").val()));
						}
						toastr["success"]("Đã cập nhật!", "Cập nhật dữ liệu thành công!");
						$('.m_datatable').mDatatable('reload');
						$("#Dialog_CapNhat").modal('hide');
					}else{
						toastr["warning"]("Lỗi", "Xin kiểm tra lại");
					}
				}, 1000);
			}
		})
}
function updateData(event, com_name, elm){
	var btn = $("#"+elm);
	if($("form")[1].checkValidity()) {
		$("#formDataUpdate .currency").each(function(){
			$(this).val($(this).val().replace(/,/g,""));
		})
		
		var valueCheckBox = "";
		$("#formDataUpdate input[type=checkbox]:not(:checked)").each(function(){
			valueCheckBox += '&'+this.name+'=0';
		})
		
		$.ajax({
			url: "Model_"+com_name+".ajax",
			type: "POST",
			data: $("#formDataUpdate").serialize() + valueCheckBox + "&act=Update",
			beforeSend: function(){
				btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
			},
			success: function(result){
				setTimeout(function() {
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
					if(result == 1){
						if($('#formDataUpdate .currency').length > 0){
							$("#formDataUpdate .currency").val(format($("#formDataUpdate .currency").val()));
						}
						toastr["success"]("Đã cập nhật!", "Cập nhật dữ liệu thành công!");
						$('.m_datatable').mDatatable('reload');
						$("#Dialog_CapNhat").modal('hide');
					}else{
						toastr["warning"]("Lỗi", "Xin kiểm tra lại");
					}
				}, 1000);
			}
		})
	}else{
		$("#formDataUpdate").find(":invalid").addClass('required').first().focus();
		$("#formDataUpdate").find(":invalid").each(function(index, node) {
			$(this).next("p.has-error").html(node.validationMessage);
		})
		event.preventDefault();
	}
}


function updateDataKM(event, com_name, elm){
	var btn = $("#"+elm);
	if($("form")[0].checkValidity()) {
		$("#formDataUpdate .currency").each(function(){
			$(this).val($(this).val().replace(/,/g,""));
		})
		
		var valueCheckBox = "";
		$("#formDataUpdate input[type=checkbox]:not(:checked)").each(function(){
			valueCheckBox += '&'+this.name+'=0';
		})
		
		$.ajax({
			url: "Model_"+com_name+".ajax",
			type: "POST",
			data: $("#formDataUpdate").serialize() + valueCheckBox + "&act=Update",
			beforeSend: function(){
				btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
			},
			success: function(result){
				setTimeout(function() {
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
					if(result == 1){
						if($('#formDataUpdate .currency').length > 0){
							$("#formDataUpdate .currency").val(format($("#formDataUpdate .currency").val()));
						}
						toastr["success"]("Đã cập nhật!", "Cập nhật dữ liệu thành công!");
						$('.m_datatable').mDatatable('reload');
						$("#Dialog_CapNhat").modal('hide');
					}else{
						toastr["warning"]("Lỗi", "Xin kiểm tra lại");
					}
				}, 1000);
			}
		})
	}else{
		$("#formDataUpdate").find(":invalid").addClass('required').first().focus();
		$("#formDataUpdate").find(":invalid").each(function(index, node) {
			$(this).next("p.has-error").html(node.validationMessage);
		})
		event.preventDefault();
	}
}

function openFormInsert(){
	var valueSelectPicker = $('#formDataInsert .m_selectpicker option:first-child').attr("value");
	$('#formDataInsert .m_selectpicker').val(valueSelectPicker);
	$('#formDataInsert .m_selectpicker').selectpicker('refresh');
	$('#formDataInsert img').attr("src", "image/noimage.jpg");
	$('#formDataInsert input[type=checkbox], #formDataInsert input[type=radio]').removeAttr("checked");
	$('#formDataInsert')[0].reset();
}

function insertData(event, com_name, elm){
	var btn = $("#"+elm);
	if($("form")[0].checkValidity()) {
		$("#formDataInsert .currency").each(function(){
			$(this).val($(this).val().replace(/,/g,""));
		})
		$.ajax({
			url: "Model_"+com_name+".ajax",
			type: "POST",
			data: $("#formDataInsert").serialize() + "&act=Insert",
			beforeSend: function(){
				btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
			},
			success: function(response, status, xhr, $form){
				setTimeout(function() {
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
					if(response == 1){
						var valueSelectPicker = $('#formDataInsert .m_selectpicker option:first-child').attr("value");
						$('#formDataInsert .m_selectpicker').val(valueSelectPicker);
						$('#formDataInsert .m_selectpicker').selectpicker('refresh');
						$('#formDataInsert')[0].reset();
						toastr["success"]("Đã thêm mới!", "Thêm dữ liệu thành công!");
						$('.m_datatable').mDatatable('reload');
						$("#Dialog_ThemMoi").modal('hide');
					}else{
					
						toastr["warning"]("Lỗi", "Xin kiểm tra lại");
					}
				}, 1000);
			}
		})
	}else{
		$("#formDataInsert").find(":invalid").addClass('required').first().focus();
		$("#formDataInsert").find(":invalid").each(function(index, node) {
			$(this).next("p.has-error").html(node.validationMessage);
		})
		event.preventDefault();
	}
}

// Export Excel Common
function exportExcelData(elm, com_name, index = "ajax"){
	var ids = $(elm).parents("td").find("input[type=hidden]").val();
	var nameLastCol = $(elm).parents("tr").find("td").last().attr("colname");
	$.ajax({
		url: "Model_"+com_name+"."+index,
		type: "POST",
		data: nameLastCol + "=" + ids + "&act=ExportExcel",
		beforeSend: function(){
			toastr["info"]("Xử lý dữ liệu", "Hệ thống đang xử lý, xin hãy đợi...");
		},
		success: function(result){
			window.location = result;
		}
	})
}

// Hàm định dạng tiền
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
// Hàm chỉ cho phép nhập số
function keypress(e) {
	var keypressed = null;
	if (window.event) {
		keypressed = window.event.keyCode;
	}
	else {
		keypressed = e.which;
	}
	if (keypressed < 48 || keypressed > 57) {
		if (keypressed == 8 || keypressed == 127 || keypressed == 0) { return; }
		return false;
	}
}
// Hàm chỉ cho phép nhập số và dấu chấm
function keypress_cus(e){
	var theEvent = e || window.event;
	var Key = theEvent.keyCode || theEvent.which;
	Key = String.fromCharCode(Key);
	var Regex = /[0-9]|\./;
	if(!Regex.test(Key)){
		theEvent.returnValue = true;
		if(theEvent.preventDefault)
		theEvent.preventDefault();
	}
}

// Validate cho thẻ textarea
function validateTextarea() {
    var errorMsg = "Vui lòng khớp với định dạng được yêu cầu.";
    var textarea = this;
    var pattern = new RegExp('^' + $(textarea).attr('pattern') + '$');
    // check each line of text
    $.each($(this).val().split("\n"), function () {
        // check if the line matches the pattern
        var hasError = !this.match(pattern);
        if (typeof textarea.setCustomValidity === 'function') {
            textarea.setCustomValidity(hasError ? errorMsg : '');
			$(textarea).next("p.has-error").html(hasError ? errorMsg : '');
        } else {
            // Not supported by the browser, fallback to manual error display...
            $(textarea).toggleClass('error', !!hasError);
            $(textarea).toggleClass('ok', !hasError);
            if (hasError) {
                $(textarea).attr('title', errorMsg);
            } else {
                $(textarea).removeAttr('title');
            }
        }
        return !hasError;
    });
}

// Định dạng ngày tháng kiểu VN
function formatDateVN(inputDate) {
    var date = new Date(inputDate);
    if (!isNaN(date.getTime())) {
        var day = date.getDate().toString();
        var month = (date.getMonth() + 1).toString();
        // Months use 0 index.

        return  (day[1] ? day : '0' + day[0]) + '/' + (month[1] ? month : '0' + month[0]) + '/' + date.getFullYear();
    }
}