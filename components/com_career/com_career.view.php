<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

	$myprocess = new process();

	$idCareer = $_GET['id'];

	if(!is_numeric($idCareer)){

		echo "<h1 style='margin-top:160px'>Trang bạn truy cập không tồn tại</h1>";

		return false;

	}

	//echo $idCareer;

	$result = $myprocess->get_career($idCareer);

	$row = $result->fetch();



?>







<?php if(!empty($_SESSION["session"]["Id"]) && $_SESSION["session"]["Id"] !=NULL){

// echo $_SESSION["session"]["Id"];

   

?>





<div style="max-width:1200px;margin-bottom:20px" class="sitemap-container container">

	<!-- <?php

		$function = $myprocess->get_trangthai();

		while($checkviewcv = $function->fetch()){
			echo $checkviewcv['trang_thai'];

		}

		

	?> -->

	<!-- <hr style="margin-top: 5px;"> -->

    <div class="clearfix m_xs_bottom_10">

		<div class="bg_white p_15 r_corners m_bottom_20">

        	<h1 style="margin-bottom: 30px;" class="sitemap-header text-primary">THÔNG TIN ỨNG VIÊN</h1>

        	

        	<div class="col-lg-8 col-md-8 col-sm-8 f_none" style="margin:0 auto;">

                <form autocomplete="off" class="awe-check ThongTinUngVien">

					<div class="row">

						<div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">

						 <?php if($row['hinhanh'] =='') {?>

                            <img style="border: 1px solid #ccc;margin-bottom:10px"  width="120px" src="/images/career.png">

						 <?php }else { ?>

						  <img style="border: 1px solid #ccc;margin-bottom:10px" width="120px" src="<?php echo $row['hinhanh'] ?>">

						 <?php } ?>

						</div>

					</div>

					<div class="row">

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Ứng viên: </label>

								<span><?php echo $row['fullname'] ?></span>

							</div>

						</div>

                        <div class="col-sm-6">

                            <div class="form-group">

                                <label>Ngày sinh: </label>

								<span><?php echo date("d/m/Y", strtotime($row['birthday'])) ?> </span>

							</div>

						</div>

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Giới tính: </label>

								<span>

								<?php 

									//echo $core_class->getValueFrom("mst_gioitinh", "gioitinh", "gioitinh_id=".$row['gioitinh_id']);

									echo $row['gender'];

								?>

								</span>

							</div>

						</div>

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Hôn nhân: </label>

								<span>

								<?php 

									//echo $core_class->getValueFrom("mst_gioitinh", "gioitinh", "gioitinh_id=".$row['gioitinh_id']);

									echo $row['tinhtranghonnhan'];

								?>

								</span>

							</div>

						</div>

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Địa chỉ: </label>

								<span>

								<?php 

									//echo $core_class->getValueFrom("mst_gioitinh", "gioitinh", "gioitinh_id=".$row['gioitinh_id']);

									echo $row['diachi'];

								?>

								</span>

							</div>

						</div>

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Nơi làm việc mong muốn: </label>

								<span>

								<?php 

									//echo $core_class->getValueFrom("mst_tinhthanh", "ten_tinhthanh", "id=".$row['tinhthanh_id']);

									echo $row['noilamviecmongmuon'];

								?>

								</span>

							</div>

						</div>

						<!--<div class="col-sm-6">

                            <div class="form-group">

                                <label>Ngành nghề: </label>

								<span>

								<?php 

									//$nganhNghe = $core_class->getValueFrom("trn_danhmuccv", "tendanhmuccv", "danhmuccv_id=".$row['danhmuccv_id']);

									//$nganhNghe = str_replace("VIỆC LÀM", "", $nganhNghe);

									//echo $nganhNghe;

									echo $row['nganhnghe'];

								?>

								</span>

							</div>

						</div>-->

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Bằng cấp: </label>

								<span>

								<?php 

									$chuyenkhoa_arr = explode("|", $row["bangcap1"]);

									echo $bangcap_chinh = empty($row["bangcap1"]) ? "Chưa cập nhật" : $chuyenkhoa_arr[0];

								?>

								</span>

							</div>

						</div>

						

						<!--<div class="col-sm-6">

                            <div class="form-group">

                                <label>Chuyên môn: </label>

								<span>

								<?php 

									echo $chuyenkhoa   = $chuyenkhoa_arr[1];

								?>

								</span>

							</div>

						</div>-->

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Số năm kinh nghiệm: </label>

								<span><?php 

										if($row['kinhnghiem'] > 0)

										{

											echo $row['kinhnghiem'];

										}else{

											echo 'Chưa có kinh nghiệm';

										}

											

									  ?></span>

							</div>

						</div>

						<!--<div class="col-sm-6">

                            <div class="form-group">

                                <label>Cấp bậc hiện tại: </label>

								<span>

								<?php 

									//echo $core_class->getValueFrom("mst_capbac", "tencapbac", "capbac_id=".$row['capbac_id']);

									echo $row['capbachientai'];

								?>

								</span>

							</div>

						</div>-->

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Cấp bậc mong muốn:</label>

								<span>

								<?php 

									//echo $core_class->getValueFrom("mst_capbac", "tencapbac", "capbac_id=".$row['mongmuon_capbac_id']);

									echo $row['capbacmongmuon'];

								?>

								</span>

							</div>

						</div>

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Ngoại ngữ: </label>

								<span><?php echo $row['trinhdongoaingu'] ?></span>

							</div>

						</div>

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Hình thức: </label>

								<span>

								<?php 

									//echo $core_class->getValueFrom("mst_loaihinhcongviec", "tenloaihinhcongviec", "loaihinhcongviec_id=".$row['loaihinhcongviec_id']);

									echo $row['hinhthuclamviec'];

								?>

								</span>

							</div>

						</div>

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Mức lương mong muốn: </label>

								<span><?php echo $row['mucluong'] ?> <?php if($row['mucluong'] !='Thỏa thuận'){  ?>  <?php } ?></span>

							</div>

						</div>

						<div class="col-sm-6">

                            <div class="form-group">

                                <label>Kinh nghiệm làm việc: </label>

								<span>

								<?php

												

														$vitrichucdanh = explode("|", $row['vitrichucdanh']);

														$congty = explode("|", $row['congty']);

														$thoigianlamviec = explode("|", $row['thoigianlamviec']);

														$motacongviec = explode("|", $row['motacongviec']);

														for($num_ = 0; $num_ < count($vitrichucdanh); $num_++){

														

													?>

													<div class="exp text-edt">

														<div class="title_">

															- Công ty: <?php echo $congty[$num_] ?></br> 

															- Vị trí / Chức danh: <?php echo $vitrichucdanh[$num_] ?></br>

															- Thời gian làm việc: <?php echo $thoigianlamviec[$num_] ?>

														</div>

														<div class="content_fck">

															<p><?php echo $motacongviec[$num_] ?></p>

														</div>

													</div>

								<?php }?>

								</span>

							</div>

						</div>	

					</div>

                </form> 

        	</div>

			<div class="col-lg-4 col-md-4 col-sm-4 f_none" style="margin:0 auto;border:1px solid #ccc;padding:10px;background: #e4e6ea;">

				<div class="row">

					<div class="col-sm-12">

					<?php

					//	echo $_SESSION['session']['Id'];

						$result_check= $myprocess->check_info_ntd($_SESSION['session']['Id']);

						$result_view= $myprocess->check_da_xem($_SESSION['session']['Id']);

						$rowCheck = $result_check->fetch();

				      	$dateNow =  date('Y-m-d H:i:s');

							 // echo $rowCheck['ngay_het_han'];

					if($rowCheck['ngay_het_han'] >= $dateNow && $rowCheck['point_activer'] >= 3 )

				 	{
					
						$label = 'Số điểm của bạn : '.$rowCheck['point_activer'];

					?>

					<label> <?php echo $label ?> </label>

					<button 

						type="button" id="buyService" 

						class="btn btn-primary btn-register full-width btn-lg" 

						data-id="<?php echo $row['profilecv_id']?>" 

						data-theme ="<?php echo $row['theme_id']?>">

						<span>Xem thông tin ( - 3 điểm ) </span>

					</button>

					<?php 


					} else { 

						if($rowCheck['point_activer'] < 0 ){

							$label = 'Điểm hiện tại của bạn đã hết, vui lòng mua thêm dịch vụ để tiếp tục sử dụng';

						}
						else 
						{
							echo 'Số điểm của bạn : '.$rowCheck['point_activer'];
							$label = 
							'Để xem hồ sơ hoàn chỉnh của ứng viên, quý khách vui lòng sử dụng dịch vụ 
							 "Tìm hồ sơ" hoặc "Mua thêm điểm" ';
						}

					?>

					<label><?php echo $label ?></label>

					<button 

					type="button" id="buyService_res" 

					class="btn btn-primary btn-register full-width btn-lg" 

					data-id="<?php echo $row['profilecv_id']?>">

						<span>Mua dịch vụ </span>

					</button>


						<?php } ?>

					</div>

				</div>

        	</div>

			

			

        </div>

	</div>

</div>

<div class="container">

	<div id="main-career-list" class="job-search__main-job-list">

		<div class="job-search-body" title="">

			<h3> ỨNG VIÊN LIÊN QUAN </h3>

			<div class="job-list job-list-page_boxed">

				<div id="job-list">

					<div class="ais-hits">

						<div class="job-list" id="job-list">

							<div class="box p-t-none p-b-none top-level-job-list">

								<div class="box-top-level clearfix">

									<?php

									//	echo $bangcap_chinh;

									  $resultUngVien = $myprocess->get_list_career();

										    $thongtin_bangcap = "";

											while($row = $resultUngVien->fetch()){

												$tenDMCV = str_replace("VIỆC LÀM", "", $row["nganhnghe"]);

												$chuyenkhoa_arr = explode("|", $row["bangcap1"]);

												$bangcap_chinh = empty($row["bangcap1"]) ? "Chưa cập nhật" : $chuyenkhoa_arr[0];

												$chuyenkhoa   = $chuyenkhoa_arr[1];

									?>

									<div class="job-item item2">

										<div class="relative">

											<div class="row d-flex-sm">

												<div class="col-md-3 job-search__logo-col d-flex-center-sm">

													<div class="logo job-search__logo">

                                                      <?php 

															
															if($row['hinhanh'] == '') { ?>

														<a>

															<img title="Y Tế Việc" class="img-responsive" src="images/career.png">

														</a>

													  <?php }else  {?>

													  <a>

															<img title="Y Tế Việc" class="img-responsive" src="<?php echo $row['hinhanh'] ?>">

														</a>

													  <?php } ?>

													</div>

												</div>

												<div class="col-md-8 job-search__job-info-col" style="line-height:30px">

													<div class="job-item-info relative">

														<h3 class="job-title">

                                                        	<?php if($row["fullname"] !=" "){ ?>

																<a href="career<?php echo $row["thongtincanhan_id"] ?>.html"><?php echo $row["fullname"] == " " ? "Chưa cập nhật" : $row["fullname"] ?></a>

                                                            	<?php 	}else{ echo '<a href="javascript:void(0)" >CHƯA CẬP NHẬT </a>';} ?>

														</h3>

														<div class="company gray-light">

															<!--<span title="<?php echo $tenDMCV ?>">

																<?php echo $tenDMCV == "" ? " " : $tenDMCV ?>

															</span><br> -->

															<span title="Chuyên khoa: <?php echo $tenDMCV ?>">

																- Bằng cấp: <span style="font-weight: bold;"><?php echo $bangcap_chinh ?></span><br>

																<?php if(!empty($chuyenkhoa)) { 

																	?> - Chuyên môn :  
																	<span style="font-weight: bold;"><?php echo $chuyenkhoa ?> <?php } ?></span>
															</span>

														</div>

														<div class="gray-light">											

															<span class="job-search__location gray-light">

																<strong class="" title="
																<?php echo $row["noilamviecmongmuon"] ?>"> 

																- Khu vực: 
																<span style="font-weight: bold;"><?php echo $row["noilamviecmongmuon"] ?>																
																</span>
																		
																</strong>

															</span>

														</div>

														<div class="extra-info">

															

															<span class="job-search__location gray-light">

																- Ngày cập nhật: 
																<span style="font-weight: bold;">
																	<?php echo date("d/m/Y", strtotime($row["INSERTDATE"])) ?>
														
																</span>

															</span>

														</div>

														
														<div class="benefit">

															<div class="benefit row" style="margin-bottom:10px">

																<?php if($row["fullname"] !=" "){ ?>

																<a class="btn btn-primary" 

																	href="career<?php echo $row["thongtincanhan_id"] ?>.html">XEM HỒ SƠ ỨNG VIÊN
																</a>

																<?php }
																else
																	{ echo '<a href="javascript:void(0)" >ỨNG VIÊN CHƯA CẬP NHẬT </a>';
																	} 
																?>

															</div>
														</div>

													
													</div>

												</div>

											</div>

										</div>

									</div>

									<?php 

											}

					
									?>

								

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

</div>

</div>

<!-- <div class="modal fade global__sign-in-modal" id="preview_modal" tabindex="-1" role="dialog">

	<div class="modal-dialog md_login modal-lg" role="document">

		<div class="modal-content step-1">

			<div style="padding: 10px" class="modal-body">

				<div class="step-1 animated fadeIn">

					<button type="button" class="close">

						<span aria-hidden="true">&times;</span>

					</button>

					<h3 class="sitemap-header text-primary">XEM HỒ SƠ ỨNG VIÊN</h3><small></small>

				</div>

				<div class="bg_white p_15 r_corners m_bottom_20">

					<div class="preview_content">

						<iframe src="/preview" id="previewCV" title="Preview CV" width="100%" height="600"></iframe>

					</div>

				</div>

              

			</div>

		</div>

	</div>

</div> -->

<?php }else { ?>



	<div style="max-width: 600px" class="sitemap-container container m_bottom_20">

    <div class="clearfix m_xs_bottom_10">

		<div class="bg_white p_15 r_corners m_bottom_20">

			<div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">

				<div class="step-1 animated fadeIn">

					<h1 class="sitemap-header text-primary">ĐĂNG NHẬP NHÀ TUYỂN DỤNG</h1>

				</div>

				<div class="bg_white p_15 r_corners m_bottom_20">

					<div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">

						<form autocomplete="off" class="awe-check" name="frmLogin" id="frmLogin" method="post">

							<div class="row">

								<div class="col-sm-12">

									<div class="form-group">

										<label>Email</label>

										<input type="email" name="loginemail" class="form-control" required>

									</div>

								</div>

							</div>

							<div class="row">

								<div class="col-sm-12">

									<div class="form-group">

										<label>Mật khẩu</label>

										<input maxlength="50" type="password" name="loginpassword" class="form-control" required>

									</div>

								</div>

							</div>

							<div class="row">

								<div class="col-md-12 col-xs-12 text-right">

									<a class="inline m-t-sm forgot-password clickable" onclick="event.preventDefault(); globalForgotPasswordModal.showModal();">Quên mật khẩu?</a>

								</div>

							</div>

							<div class="row">

								<div class="col-sm-12">

									<div class="form-group">

										<button type="button" class="ntd_login btn btn-primary full-width btn-lg">

											<span>Đăng nhập</span>

										</button>

									</div>

								</div>

							</div>

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

<script>

$(".ntd_login").click(function(){

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

				url: "login-ntd",

				type: "POST",

				data: {do: "login-ntd", email: email, password: password},

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

</script>

<?php } ?>





<script>

	$(function(){

		$("#buyService").click(function(){

			var id  = $(this).attr("data-id") ;

			var idtheme  = $(this).attr("data-theme") ;

			$.ajax({

				url: 'viewInfoBuy',

				type: 'POST',

				dataType: 'JSON',

				data: {do: 'viewInfo',IDinfo:id,idtheme:idtheme},

				success: function(response){

					if(response.status == 1){

						var iframe = $('#previewCV');

				    	iframe.attr('src', '/viewCV?idProfile='+id+'&idTheme='+idtheme);

						$("#preview_modal").modal('show');



					}else{

						//btn.prop("disabled", false);

						alert(response.message);

					}	

				}

			})

		})

		$("#buyService_res").click(function(){

			swal({

				title: "",

				text: "Đăng ký mua dịch vụ",

				type: "info"

			}, function (){

						window.location = 'http://tuyendung.yteviec.com';

					})

		})

	})



/*function xem_truoc(animal){

    var idTheme = animal.getAttribute("data-id");

	alert(idTheme); 

    var iframe = $('#previewCV');

    iframe.attr('src', '/viewCV?idTheme='+idTheme);

    $("#preview_modal").modal('show');



 }*/

</script>