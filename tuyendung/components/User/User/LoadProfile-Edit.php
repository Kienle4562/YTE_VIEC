<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	$myprocess = new process();
	$result = $myprocess->info_User();
	$row = $result -> fetch();
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title ">
					Thông tin tài khoản của tôi
				</h3>
			</div>
		</div>
	</div>
	<!-- END: Subheader -->
	<div class="m-content">
		<div class="row">
			<div class="col-xl-3 col-lg-4">
				<div class="m-portlet m-portlet--full-height  ">
					<div class="m-portlet__body">
						<div class="m-card-profile">
							<div class="m-card-profile__pic">
								<div class="m-card-profile__pic-wrapper">
									<img src="<?php echo $_SESSION["session"]["Hinhanh"]; ?>" onerror="this.src='dist/assets/app/media/img/users/user.png'" alt=""/>
								</div>
							</div>
							<div class="m-card-profile__details">
								<span class="m-card-profile__name">
									<?php echo $_SESSION["session"]["Hoten"]; ?>
								</span>
								<a href="" class="m-card-profile__email m-link">
									<?php echo $_SESSION["session"]["Tendangnhap"]; ?>
								</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<?php
				// panel cập nhật thông tin
			?>
			<div class="col-xl-4 col-lg-4">
				<div class="m-portlet m-portlet--full-height">
					<div class="tab-content">
						<div class="tab-pane active" id="m_user_profile_tab_1">
							<form class="m-form m-form--fit m-form--label-align-right">
								<div class="m-portlet__body">
									<div class="form-group m-form__group row">
										<div class="col-10 ml-auto">
											<h3 class="m-form__section">
												CẬP NHẬT MẬT KHẨU
											</h3>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-4 col-form-label">
											Mật khẩu cũ
										</label>
										<div class="col-8">
											<input class="form-control m-input" type="password" id="txtMatKhauCu" name="txtMatKhauCu">
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-4 col-form-label">
											Mật khẩu mới
										</label>
										<div class="col-8">
											<input class="form-control m-input" type="password" id="txtMatKhauMoi" name="txtMatKhauMoi">
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-4 col-form-label">
											XN mật khẩu mới
										</label>
										<div class="col-8">
											<input class="form-control m-input" type="password" id="txtXnMatKhau" name="txtXnMatKhau">
										</div>
									</div>
									<div class="m-portlet__foot m-portlet__foot--fit">
										<div class="m-form__actions">
											<div class="row">
												<div class="col-2"></div>
												<div class="col-7">
													<button type="button" onclick="changepass()" class="btn btn-accent m-btn m-btn--air m-btn--custom">
														Lưu thay đổi
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4">
				<div class="m-portlet m-portlet--full-height">
					<div class="tab-content">
						<div class="tab-pane active" id="m_user_profile_tab_1">
							<form class="m-form m-form--fit m-form--label-align-right" id="form-upload" action="UploadAvatarProfile.ajax" enctype="multipart/form-data" role="form" method="post" name="FrmAccount">
								<div class="m-portlet__body">
									<div class="form-group m-form__group row">
										<div class="col-10 ml-auto">
											<h3 class="m-form__section">
												CẬP NHẬT ẢNH ĐẠI DIỆN
											</h3>
										</div>
									</div>
									<div class="form-group m-form__group row">
										<label for="example-text-input" class="col-4 col-form-label">
											&nbsp;
										</label>
										<div class="col-8" style="position:relative">
											<button type="button" id="btnUpload" class="btn btn-primary btn-icon glyphicons fileUpload"> <i class="fa fa-plus-square"> Chọn ảnh </i></button> 
											<input type="file" class="file-input" id="Link_Avatar" name="LinkAvatar" value="<?=$row["Hinhanh"];?>" onChange="checkUpload(this.value)">
										</div>
									</div>
									<div class="form-group m-form__group row">
										<div class="col-12">
											<img src="<?php if($row["Hinhanh"] != ""){?> <?= $row["Hinhanh"];}else{?> <?="dist/assets/app/media/img/users/user.png";}?>" id="Preview" width="100%" />
										</div>
									</div>
									<div style="padding: 0 20px 10px 20px;">
										<div class="progress progress-xs">
											<div id="bar" class="progress-bar bg-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
											</div>
											<span id="percent" class="sr-only">60%</span>
										</div>
										<div id="result"></div>
									</div>
									<div class="m-portlet__foot m-portlet__foot--fit">
										<div class="m-form__actions">
											<div class="row">
												<div class="col-2"></div>
												<div class="col-7">
													<input type="hidden" value="UploadAvatarProfile" name="act" />
													<button disabled="disabled" type="submit" id="submit-upload" class="btn btn-success">Upload</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="dist/assets/app/js/jquery.form.min.js"></script>
<script>
  $('#form-upload').ajaxForm({
    complete: function(xhr) {
      // Add response text to div #result
      $('#result').html(xhr.responseText);
    }
  });
</script>
<script>
	function loadQuanHuyen(ids){
		var tinhthanh_id = $("#tinhthanh").val();
		$.ajax({
			url: "loadquanhuyen.send",
			type: "POST",
			data: {act: "loadquanhuyen", tinhthanh: tinhthanh_id, id : ids},
			success: function(rs){
				$("#quanhuyen").html(rs);
			}
		})
	}
	loadQuanHuyen(<?php echo $row["quanhuyen_id"] ?>);
	function changepass(){
		var txtMatKhauCu = $("#txtMatKhauCu").val();
		var txtMatKhauMoi = $("#txtMatKhauMoi").val();
		var txtXnMatKhau = $("#txtXnMatKhau").val();
		if(txtMatKhauMoi=="" || (/^\s*$/).test(txtMatKhauMoi)){
			toastr["error"]("Bạn chưa nhập mật khẩu mới!", "Lỗi nhập liệu");
			$("#txtMatKhauMoi").focus();
			return false;
		}else if(txtMatKhauMoi.length < 6){
			toastr["error"]("Mật khẩu mới phải có ít nhất 6 ký tự!", "Lỗi nhập liệu");
			$("#txtMatKhauMoi").focus();
			return false;
		}else if(txtMatKhauMoi!=txtXnMatKhau){
			toastr["error"]("Nhập lại mật khẩu không đúng!", "Lỗi nhập liệu");
			$("#txtXnMatKhau").focus();
			return false;
		}else{
			$.ajax({
				url: "Changepass.ajax",
				type: "POST",
				data: "act=changepass"+"&MatKhauCu="+txtMatKhauCu+"&MatKhauMoi="+txtMatKhauMoi,
				success: function(rs){
					if(rs==0){
						toastr["error"]("Mật khẩu cũ không đúng!", "Lỗi nhập liệu");
						$("#txtMatKhauCu").focus();
					}else{
						toastr["success"]("Đã cập nhật mật khẩu!", "Cập nhật dữ liệu thành công!");
						$("#txtMatKhauCu").val('');
						$("#txtMatKhauMoi").val('');
						$("#txtXnMatKhau").val('');
					}
				}
			})
		}
	}
	function checkUpload(file) {
      var ext = file.split(".");
      ext = ext[ext.length-1].toLowerCase();      
      var arrayExtensions = ["jpg" , "jpeg", "png", "bmp"];
	  var file_size = $('#Link_Avatar')[0].files[0].size;
  	  if (arrayExtensions.lastIndexOf(ext) == -1) {
		 	var msg = "File không đúng định dạng hình ảnh (JPEG, JPG, PNG, BMP)";
		 	var $toast = toastr[shortCutFunction](msg, title);
   	     	$("#Link_Avatar").val("");
			$("#submit-upload").attr("disabled","disabled");
  	  }else if( document.getElementById("Link_Avatar").files.length == 0 ){
			var msg = "File rỗng";
		  	var $toast = toastr[shortCutFunction](msg, title);
			$("#submit-upload").attr("disabled","disabled");
	  }else{
	  		$("#submit-upload").removeAttr("disabled");
	  }
	}
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function (e) {
				$('#Preview').attr('src', e.target.result);
			}
	
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$("#Link_Avatar").change(function(){
		readURL(this);
	});
	function updateProfile(){
		var Hoten = $("#Hoten").val();
		var Didong = $("#Didong").val();
		var Diachi = $("#Diachi").val();
		var Ngaysinh = $("#Ngaysinh").val();
		var Cmnd = $("#Cmnd").val();
		var tinhthanh = $("#tinhthanh").val();
		var quanhuyen = $("#quanhuyen").val();
		var Data = {act: "ProcessEditProfile", Hoten: Hoten, Didong:Didong, Diachi:Diachi, Ngaysinh: Ngaysinh, Cmnd:Cmnd,tinhthanh : tinhthanh, quanhuyen: quanhuyen};
		if(Hoten=="" || (/^\s*$/).test(Hoten)){
			toastr["error"]("Bạn chưa nhập họ tên!", "Lỗi nhập liệu");
			$("#Hoten").focus();
			return false;
		}else if(Didong=="" || (/^\s*$/).test(Didong)){
			toastr["error"]("Bạn chưa nhập số di động!", "Lỗi nhập liệu");
			$("#Didong").focus();
			return false;
		}else if(Diachi=="" || (/^\s*$/).test(Diachi)){
			toastr["error"]("Bạn chưa nhập Địa chỉ!", "Lỗi nhập liệu");
			$("#Diachi").focus();
			return false;
		}else if(tinhthanh==0){
			toastr["error"]("Bạn chưa chọn tỉnh thành!", "Lỗi nhập liệu");
			$("#tinhthanh").focus();
			return false;
		}else if(quanhuyen==0){
			toastr["error"]("Bạn chưa chọn quận huyện!", "Lỗi nhập liệu");
			$("#quanhuyen").focus();
			return false;
		}else if(Ngaysinh=="" || (/^\s*$/).test(Ngaysinh)){
			toastr["error"]("Bạn chưa nhập Ngày sinh!", "Lỗi nhập liệu");
			$("#Ngaysinh").focus();
			return false;
		}else if(Cmnd=="" || (/^\s*$/).test(Cmnd)){
			toastr["error"]("Bạn chưa nhập Chứng minh nhân dân!", "Lỗi nhập liệu");
			$("#Cmnd").focus();
			return false;
		}else{
			$.ajax({
				url: "ProcessEditProfile.ajax",
				type: "POST",
				data: Data,
				success: function(){
					$("#htusername").html(Hoten);
					toastr["success"]("Đã cập nhật thông tin!", "Cập nhật dữ liệu thành công!");
				}
			})
		}
	}
</script>
<script>
  var bar = $('#bar');
  var percent = $('#percent');
  var result = $('#result');
  var percentValue = "0%";
  $('#form-upload').ajaxForm({
      // Do something before uploading
      beforeUpload: function() {
        result.empty();
        percentValue = "0%";
        bar.width = percentValue;
        percent.html(percentValue);
      },
      // Do somthing while uploading
      uploadProgress: function(event, position, total, percentComplete) {
        var percentValue = percentComplete + '%';
        bar.width(percentValue)
        percent.html(percentValue);
      },
      // Do something while uploading file finish
      success: function() {
        var percentValue = '100%';
        bar.width(percentValue)
        percent.html(percentValue);
      },
      // Add response text to div #result when uploading complete
      complete: function(xhr) {
		toastr["success"](xhr.responseText, "Cập nhật dữ liệu thành công!");
		var HoTen = $("#HoTen").val();
		//Notification all		
		$.ajax({
			url: "LoadProfileUserEdit.ajax",
			success: function(rs) {
				$("#Load_ProfileEdit").html(rs);
			}
		})
      }
  });
</script>