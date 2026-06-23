$(function(){
	$("#filter_tu_ngay, #filter_den_ngay, #filter_phiethu").change(function(){
		filter();
	})
	$(document).on("click", ".loadInfoBooking", function(){
		var bookingid = $(this).data("bookingid");
		loadContentInfoBooking(bookingid);
	})
	
	$(document).on("click", ".createPhieuThu", function(){
		//alert('aaa');
		loadContentStatusBill();
	})
	$(document).on("click", ".createCollectDebt", function(){
		//alert('LẬP PHIẾU THU CÔNG NỢ');
		loadcreateCollectDebt();
	})
	
	$(document).on("click", ".loadInfoPT", function(){
		var DailyReceiptId = $(this).data("code");
		loadContentInfo(DailyReceiptId);
	})
	
	// load phieu thu khac
	$(document).on("click", ".loadInfoDailyReceipt", function(){
		var DailyReceiptId = $(this).data("receiptid");
		loadContentInfoDailyReceipt(DailyReceiptId);
	})
	
	$(document).on("click", "#btnUpdateReceipt", function(){
		var btn = $(this);
		//alert(btn);
		if($("form#formDataUpdate")[0].checkValidity()) {
			$("#formDataUpdate .currency").each(function(){
				$(this).val($(this).val().replace(/,/g,""));
			})
			$.ajax({
				url: "Model_Receipt.ajax",
				type: "POST",
				data: $("#formDataUpdate").serialize() + "&act=UpdateReceipt",
				dataType: "JSON",
	   			async: true,
				beforeSend: function(){
					btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
				},
				success: function(jsonRS){
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
					if(jsonRS["IsError"] == 1){
						toastr["success"]("Đã cập nhật!", jsonRS["msg"]);
						$("#Dialog_UpdateReceipt").modal('hide');
						// update notification
					}
				}
			})
		}else{
			$("#formDataUpdate").find(":invalid").addClass('required').first().focus();
			$("#formDataUpdate").find(":invalid").each(function(index, node) {
				$(this).parents("div[class^='col']").first().find("div.has-error").html(node.validationMessage);
			})
			event.preventDefault();
		}
	})
	
	$(document).on("click", ".btnPrintReceipt", function(){
		var collectdebt_id = $(this).data("id");
		//alert(collectdebt_id);
	     trangin("Model_Receipt.ajax?act=PrintReceipt&IdReceipt="+collectdebt_id, "printFrame");
		//trangin("Model_CollectDebt.ajax?act=PrintCollectDebt&collectdebt_id="+collectdebt_id);
	})
	
	$(document).on("click", ".deleteRow", function(){
		var id_phieuthu = $(this).data("id");
		var ma_phieu = $(this).data("code");
		var btn = $(this);
		swal({
			title: "Xóa dữ liệu?",
			text: "Bạn có chắc muốn xóa mã phiếu : "+ ma_phieu,
			icon: "success",
			input: 'textarea',
			confirmButtonText: "<span><i class='la la-thumbs-up'></i><span>Đồng ý</span></span>",
			confirmButtonClass: "btn btn-danger m-btn m-btn--pill m-btn--air m-btn--icon",
			showCancelButton: true,
			cancelButtonText: "<span><i class='la la-thumbs-down'></i><span>Hủy bỏ</span></span>",
			cancelButtonClass: "btn btn-secondary m-btn m-btn--pill m-btn--icon"
		}).then(function(result){
			if (result.value) {
				$.ajax({
					url: "Model_Receipt.ajax",
					type: "POST",
					data: "id_phieuthu=" + id_phieuthu + "&noi_dung=" + result.value + "&ma_phieu=" + ma_phieu + "&act=Delete",
					dataType: "JSON",
					async: true,
					beforeSend: function(){
						btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
					},
					success: function(json){
						if(json['IsError'] == 1){
							btn.parents("tr").first().remove();
						    toastr["success"]("Xóa thành công !",json['msg']);
						}else{
							toastr["warning"]("Lỗi", "Xin kiểm tra lại");
						}
					}
				})
			}
		});
	})
$(document).on("click", ".btnEditReceipt", function(){
		var btn = $(this);
		var phieuthu_id = btn.data("id");
		//alert(phieuthu_id);
		$.ajax({
			url: "Model_Receipt.ajax",
			type: "POST",
			data: {
				act: 'modalUpdateReceipt',
				phieuthu_id: phieuthu_id
			},
			async: true,
			beforeSend: function(){
				btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
			},
			success: function(returnHTML){
				btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
				$("#Dialog_UpdateReceipt").find(".modal-body").html(returnHTML);
				BootstrapSelect.init();
				$("#Dialog_UpdateReceipt").modal("show");
			}
		})
	})
$(document).on("change", "[name=doitac_id], [name=collectdebt_fromdate], [name=collectdebt_todate]", function(){
		var fromDate = $("[name=collectdebt_fromdate]").val();
		var toDate = $("[name=collectdebt_todate]").val();
		var doitac_id = $("[name=doitac_id]").val();
		loadDataBooking(doitac_id, fromDate, toDate);
		
	})
})
	// lưu thông tin phiếu thu va in phiếu xác nhận
$(document).on("click", ".btnSaveAndPrintConfirmPT", function(){
	var loaipt_id = $('#loaipt_id').val();
	if(loaipt_id == 6){
		LuuPhieuThuKhachSan();
	}else{
		LuuPhieuThuTour();
	}
})

function LuuPhieuThuTour(){
	var btn = $(".btnSaveAndPrintConfirmPT");
	if($("form#frmAddBill")[0].checkValidity()) {
		$.ajax({
			url: "Model_Receipt.ajax",
			type: "POST",
			data: $("#frmAddBill").serialize() + "&act=INSERT_RECEIPTS",
			dataType: "JSON",
			async: true,
			beforeSend: function(){
				btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
			},
			success: function(jsonRS){
				setTimeout(function() {
					btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
						if(jsonRS["IsError"] == 1){
						$('#frmAddBill')[0].reset();
						toastr["success"]("Đang tiến hành in phiếu....", "Lưu Booking thành công!");
						$("#Dialog_CreateReceipt").modal('hide');
						trangin("Model_Receipt.ajax?act=InPhieuthu&IdReceipt="+jsonRS["ma_phieu"]+"&bookingCode="+jsonRS["bookingCode"]+"&tong_cong="+jsonRS["tong_cong"]+"&tra_truoc="+jsonRS["tra_truoc"]+"&sotienthu="+jsonRS["sotienthu"]+"&con_lai="+jsonRS["con_lai"]+"&hinhthuc_thanhtoan="+jsonRS["hinhthuc_thanhtoan"]+"&ghichu="+jsonRS["ghichu"], "printFrame");
						}else{
						toastr["warning"]("Lỗi phiếu thu", jsonRS);
					}
				}, 1000);
			}
		})
	}else{
		$("#frmAddBill").find(":invalid").addClass('required').first().focus();
		$("#frmAddBill").find(":invalid").each(function(index, node) {
			$(this).parents("div[class^='col']").first().find("div.has-error").html(node.validationMessage);
		})
		event.preventDefault();
	}
}

// Khai báo đối tượng timeout để dùng cho hàm
	// clearTimeout
	var timeout = null;
	var jsonData = {};
	$(document).on("keyup","[name=email]", function(){
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
				url: "Model_donhang.ajax",
				data: {
					act: 'getSuggesst',
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
							html += '<div data-key="'+key+'" data-value="'+data[key]['congty_id']+'" class="tt-suggestion tt-selectable">'+data[key]['email']+'</div>';
						}
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
	$(document).on("click", ".tt-suggestion", function(){
		var btn = $(this);
		var key = btn.data('key');
		$(".btnSaveAndPrintConfirmPT").prop("disabled", false);
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
			$("#congty_id").val(congty_id);

		btn.parent().parent().hide();
	})
	



function isJsonEmpty(obj) {
	for(var key in obj) {
		if(obj.hasOwnProperty(key))
			return false;
	}
	return true;
}


function setAutoNumeric(){
	$('.numeric').each(function(){
		if (AutoNumeric.getAutoNumericElement(this) === null) {
			new AutoNumeric(this, {
				allowDecimalPadding: false,
				decimalPlaces: 0,
				showWarnings: false,
				minimumValue: 0
			});
		}
	});
}
