<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

	include_once('com_createcv.models.php');

	include_once('protected/paging.php');

	$myprocess =  new process();

//	echo $_SESSION["career"]["career_id"];

?>

<style>

.view img {

    display: block;

    position: relative;

    width: 100%;

    height: 310px;

}

</style>


<?php 
	//echo $_SESSION["career"]["career_id"];

	if(!empty($_SESSION["career"]["career_id"]) && $_SESSION["career"]["career_id"] !=NULL){  ?>

    <div style="padding: 50px 0px 0;" class="sitemap-container container">

    <div class="clearfix m_xs_bottom_10">

		<div class="bg_white p_15 r_corners m_bottom_20">

        	<h1 class="sitemap-header text-primary text-format-center">CHỌN HỒ SƠ CỦA BẠN</h1>

            <div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">

               <div class="box-sm note_cv">

                   <h3>Lưu ý khi tạo hồ sơ</h3>

                   <ul>

                       <li> Bạn được tạo tối đa <span class="cls-red">02 hồ sơ  </li>

                       <li> Trong đó chỉ có <span class="cls-red"> 1 hồ sơ </span> được "<span class="cls-red"> Cho phép tìm kiếm </span>" bởi nhà tuyển dụng. </li>

                       <li> Tất cả các hồ sơ ở trạng thái "Đã duyệt" đều có thể sử dụng để "Nộp hồ sơ" trực tuyến. </li>

                       <li> Hồ sơ được viết bằng tiếng Việt có dấu, ý nghĩa rõ ràng, không viết tắt </li>

                       <li> Hồ sơ sẽ được duyệt trong 24 giờ. Những hồ sơ không không đúng quy định, không đạt chất lượng, nội dung không nghiêm túc sẽ không được hiển thị. </li>

                   </ul>

                   

				</div>

				<div class="box-lg">

                    <button type="button" class="btn btn-primary btn-lg bg_green m_bottom_20" id="createCV">TẠO HỒ SƠ ONLINE </button>

					<button type="button" class="btn btn-primary btn-lg bg_green m_bottom_20" id="UploadHS">UPLOAD HỒ SƠ</button>

					<button type="button" class="btn btn-primary btn-lg bg_green m_bottom_20" id="theme-cv">CHỌN MẨU CV</button>

					<!--<a type="button" href="/quick_upload_resume.html" class="btn btn-primary btn-lg bg_green m_bottom_20" id="createCV">UPLOAD HỒ SƠ</a>-->

					<div class="res-table animated fadeIn">

						<span>

							<?php
								$result = $myprocess->get_myprofile_cv_online($_SESSION["career"]["career_id"]);

								while($row = $result->fetch()){
								//$link = $core_class->_removesigns($row["tencongviec"])."-".$row["congviec_id"]."-cv.html";
							?>
										
					<!-- Show danh sach CV đã tạo -->
								
					<div class="table-responsive">
					<table class="table">
						<tr>
							<th>Loại hồ sơ</th>
							<th>Tên hồ sơ</th>
							<th>Ngày tạo</th>
							<th>Tìm kiếm</th>
							<th>Lượt xem</th>
							<th>Thao tác</th>
						</tr>
						<tbody>
							<tr>
								<td>
									<span class="badge bg-success" style="background-color: green; font-size: 15px;">ONLINE</span>
								</td>
								<td>
									<a href="javascript:void" id="id_theme" data-id="<?php echo $row['theme_id'] ?>" onclick="xem_truoc(this)" class="info">
										<strong>
											<?php echo $row['tenprofilecv'] ?>
										</strong>
									</a>
								</td>
								<td>
									<?php echo date("d/m/Y", strtotime($row["INSERT_DATE"])) ?></div>
								</td>
								<td>
									<input type="checkbox" class="trangthai" value="<?php echo  $row['profilecv_id'] ?>" 
										<?php if ($row['tim_kiem'] == '1') 
										{
											echo 'checked';
										} else {} ?> 
										name="check_status" data-id="<?php echo $row['profilecv_id'] ?>" onclick="onlyOne(this)">
								</td>

								<td>
									<?php if (intval($row['luot_xem']) <= 0)
									{
										echo "Chưa có lượt xem nào";
									}else{
										echo intval($row['luot_xem']);
									}
									?>
								</td>

								<td>
									<!-- Chỉnh sửa CV -->	
									<?php if(!empty($_REQUEST['temp']))
									{
										$valueTheme = $_REQUEST['temp'];
									}else{
										$valueTheme = $row['theme_id'];
									} ?>
									<a class="btn btn-primary" href="edit-cv.html?profile=<?php echo $row['profilecv_id'] ?>&id=<?php echo $row["thongtincanhan_id"] ?>">
										<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
									</a>
									<!-- End Chỉnh sửa CV -->
									
									<!-- Xem CV -->
									<?php if($row['loai_cv']== 'ONLINE'){ ?>

									<?php if($row['theme_id'] > 0) { ?>

									<a class="btn btn-success" href="javascript:void" id="id_theme" data-id="<?php echo $row['theme_id'] ?>" onclick="xem_truoc(this)" >
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>

									<?php }else { ?>

									<a class="btn btn-success" href="javascript:void" id="id_theme" onclick="return alert_notheme()" class="info">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>

									<?php } ?>

									<?php }else { ?>

									<a class="btn btn-success" href="javascript:void" id="id_theme" data-id="0" onclick="xem_truoc(this)" class="info">
										<i class="fa fa-eye" aria-hidden="true"></i>
									</a>

									<?php } ?>
									<!-- End Xem CV -->
									
									<!-- Xóa CV -->
									<a class="btn btn-danger del_cv" data-id="<?php echo $row['thongtincanhan_id']?>" data-profileID="<?php echo $row['profilecv_id']?>">
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</a>

									

									
									<!--<a target='_blank' href='downloadcv?temp=<?php echo $row['theme_id'] ?>&career_id=<?php echo $_SESSION["career"]["career_id"] ?>&profile=<?php echo $row['profilecv_id'] ?>&email=<?php echo $_SESSION["career"]["email"] ?>' class="btn btn-primary btn-lg bg_green">

										<span>TẢI VỀ</span>

									</a>-->
					</div>
								</td>
							</tr>
						</tbody>
					</table>
					
					</div>
									
								<?php 

										}

								?>

						</span>

					</div>

				</div>

        	</div>

        </div>

	</div>

</div>

<div class="modal fade global__sign-in-modal" id="preview_modal" tabindex="-1" role="dialog">

	<div class="modal-dialog md_login modal-lg" role="document">

		<div class="modal-content step-1">

			<div style="padding: 10px" class="modal-body">


				<div class="step-1 animated fadeIn">

					<button type="button" class="close">

						<span aria-hidden="true">&times;</span>

					</button>

					<h3 class="sitemap-header text-primary">XEM TRƯỚC</h3> <small></small>

				</div>

				<div class="bg_white p_15 r_corners m_bottom_20">

					<div class="preview_content">

						<iframe src="/preview" id="previewCV" title="Preview CV" width="100%" height="600"></iframe>

					</div>

				</div>

            

			</div>

		</div>

	</div>

</div>

 <?php }else { ?>

    
<!-- Đăng nhập tạo hồ sơ -->

<div 
	style="
		max-width: 600px; 
		border-radius: 10px; 
		box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);" 
	class="sitemap-container container m_bottom_20">

    <div class="clearfix m_xs_bottom_10">

		<div class="bg_white p_15 r_corners m_bottom_20">

			<div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">

				<div class="step-1 animated fadeIn">

					<h1 class="sitemap-header text-primary">ĐĂNG NHẬP</h1>

				</div>

				<div class="bg_white p_15 r_corners m_bottom_20">

					<div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">

						<form autocomplete="off" class="awe-check" name="frmLogin" id="frmLogin" method="post">

							<div class="row">

								<div class="col-sm-12">

									<div class="form-group">

										<i class="fa fa-envelope"></i>

										<label>Email đăng nhập</label>

										<input type="email" name="loginemail" class="form-control" required placeholder="Nhập địa chỉ email đã đăng ký">

									</div>

								</div>

							</div>

							<div class="row">

								<div class="col-sm-12">

									<div class="form-group">

										<i class="fa fa-lock"></i>

										<label>Mật khẩu</label>

										<input maxlength="50" type="password" name="loginpassword" class="form-control" required placeholder="Nhập mật khẩu">

									</div>

								</div>

							</div>				

							<div class="row">

								<div class="col-sm-12">

									<div class="form-group">

										<button type="button" class="career_login btn btn-primary full-width btn-lg">

											<span>Đăng nhập</span>

										</button>

									</div>

								</div>

							</div>
											
							Bạn chưa có tài khoản ?
							<a class="inline m-t-sm forgot-password clickable" 

								onclick="event.preventDefault(); globalRegistrationModal.showModal();">

								Đăng ký

							</a>
							<br>
							Quên mật khẩu, chọn vào đây
							<a class="inline m-t-sm forgot-password clickable" 

								onclick="event.preventDefault(); globalForgotPasswordModal.showModal();">

								Quên mật khẩu

							</a>



						</form> 

					</div>

					<hr class="hidden-xs"/>

					<div class="">

						<p class="text-center m-b-none sign-in">&nbsp;</p>

					</div>

				</div>

        	</div>

        </div>

	</div>

</div>


    <?php  } ?>

<script>

    

	function onlyOne(checkbox) {

		var checkboxes = document.getElementsByName('check_status')

		checkboxes.forEach((item) => {

			if (item !== checkbox) item.checked = false

		})

	}

	

$('.trangthai').click( function() {

	var letters = $('input[name="check_status"]:checked').map(function(){

	return this.value;

	}).get()

	$.ajax({

	url: 'customer-createprofile',

	type: 'POST',

	dataType: 'JSON',

	data: {do: 'checkApply',trangthai:letters},

	success: function(response){}
	}).done(function(response) {
	swal({
		title: "Thành công", text: "Cập nhật thành công trạng thái hồ sơ", type: "success"},
		function(){ location.reload();}
	);
	})
	.error(function(response) {
	swal({
		title: "Thất bại", text: "Đã xảy ra lỗi", type: "warning"},
		function(){ location.reload();}
	);
	});
});


$('.del_cv').click(function(){
	var btn = $(this);
	var id  = $(this).attr("data-id") ;
	var profileID  = $(this).attr("data-profileID") ;
	swal({
    title: "Xác nhận xóa hồ sơ",
    text: "Dữ liệu sẽ bị xóa khỏi hệ thống sau khi xác nhận xóa!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#DD6B55",
    confirmButtonText: "Xóa hồ sơ",
    closeOnConfirm: false
  },
  function() {
    $.ajax({
        type: "POST",
        url: "delete-cv",
        data: {do: 'delete-cv',idTT:id,profileID:profileID},
		dataType: 'JSON',
        success: function(response) {}
      })
      .done(function(response) {
		swal({
			title: "Thành công", text: "Đã xóa hồ sơ khỏi hệ thống", type: "success"},
			function(){ location.reload();}
		);
      })
      .error(function(response) {
        swal({
			title: "Thất bại", text: "Đã xảy ra lỗi", type: "warning"},
			function(){ location.reload();}
		);
      });
  }
);
});

// $('.del_cv').click( function() {
// 			var btn = $(this);
// 			//var idTT = animal.getAttribute("data-id"); 
// 			var id  = $(this).attr("data-id") ;
// 			var profileID  = $(this).attr("data-profileID") ;
// 			$.ajax({

// 				url: 'delete-cv',

// 				type: 'POST',

// 				dataType: 'JSON',

// 				data: {do: 'delete-cv',idTT:id,profileID:profileID},

// 				success: function(response){

// 					if(response.status == 1){

// 						alert(response.message);

// 						window.location = 'tao-cv.html';

// 					}else{

// 						btn.prop("disabled", false);

// 						alert(response.message);

// 					}	

// 				}

// 			})

// 	});


     $("#createCV").click(function(){

        var btn = $(this);

        $.ajax({

            url: 'customer-createprofile',

            type: 'POST',

            dataType: 'JSON',

            data: {do: 'createprofile'},

            beaforeSend: function(){

            	btn.prop("disabled", true);

            },

            success: function(response){

                if(response.status == 1){

                    btn.prop("disabled", false);

					window.location = 'tao-cv.html';

                }else{

                    btn.prop("disabled", false);

                    alert(response.message);

                }

            }

        })

    })

	 $("#UploadHS").click(function(){

        var btn = $(this);

        $.ajax({

            url: 'resume-createprofile',

            type: 'POST',

            dataType: 'JSON',

            data: {do: 'CheckUploadF'},

            beaforeSend: function(){

            	btn.prop("disabled", true);

            },

            success: function(response){

                if(response.status == 1){

                    btn.prop("disabled", false);

					window.location = '/quick_upload_resume.html';

                }else{

                    btn.prop("disabled", false);

                    alert(response.message);

                }

            }

        })

    }) 

	$("#theme-cv").click(function(){

        var btn = $(this);

        $.ajax({

            url: 'theme-cv',

            type: 'POST',

            dataType: 'JSON',

            data: {do: 'theme-cv'},

            beaforeSend: function(){

            	btn.prop("disabled", true);

            },

            success: function(response){

                if(response.status == 1){

                    btn.prop("disabled", false);

					window.location = '/chon-theme.html';

                }else{

                    btn.prop("disabled", false);

                    alert(response.message);

                }

            }

        })

    })

function xem_truoc(animal){

    var idTheme = animal.getAttribute("data-id"); 

    var iframe = $('#previewCV');

    $(".apply_theme").attr("data-id", idTheme);

    iframe.attr('src', '/preview?idTheme='+idTheme);

    $("#preview_modal").modal('show');


 }

 function alert_notheme(){
	const choose_theme = document.createElement("a");
	choose_theme.href = 'http://google.com';
	swal({
          title: 'Chưa chọn theme cho hồ sơ',
          type: 'info',
		  text: 'Để bật chức năng cho phép tìm kiếm, hãy lựa chọn mẫu CV mà bạn muốn' 
        })


 }

</script>