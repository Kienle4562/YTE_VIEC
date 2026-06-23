<?php defined( '_VALID_MOS' ) or die( include("404.php") );
/* 	$arraySource = array(
		'dist/assets/component/thanhtoan/bootstrap-touchspin.js' => 'js',
	);
	$core_class->loadSource($arraySource); */
	include("Model.php");
	//unset($_SESSION['cart']);
	$myprocess = new process();	
	if($view == "Success"){
		$title = "ĐẶT HÀNG THÀNH CÔNG";
		$action = "dangky";
		$btn = "Đăng ký";
	}
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<!--Begin::Main Portlet-->
		<div class="m-portlet m-portlet--full-height">
			<!--begin: Portlet Head-->
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<h3 class="m-portlet__head-text">
							<?php echo $title ?>
						</h3>
					</div>
				</div>
				<div class="m-portlet__head-tools">
					<ul class="m-portlet__nav">
						<li class="m-portlet__nav-item">
							<a href="#" data-toggle="m-tooltip" class="m-portlet__nav-link m-portlet__nav-link--icon" data-direction="left" data-width="auto" title="Đặt hàng thành công ! chờ hệ thống xét duyệt">
								<i class="flaticon-info m--icon-font-size-lg3"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--end: Portlet Head-->
			<!--begin: Form Wizard-->
			<div class="m-wizard m-wizard--2 m-wizard--success" id="m_wizard">
				<!--begin: Message container -->
				<div class="m-portlet__padding-x">
					<!-- Here you can put a message or alert -->
				</div>
				<!--end: Message container -->
				<!--begin: Form Wizard Head -->
				<div class="m-wizard__head m-portlet__padding-x">
					<!--begin: Form Wizard Progress -->
					<div class="m-wizard__progress">
						<div class="progress">
							<div class="progress-bar" role="progressbar"  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
						</div>
					</div>
					<!--end: Form Wizard Progress -->  
					<!--begin: Form Wizard Nav -->
					     <div class="m-wizard__nav">
										<div class="m-wizard__steps">
											<div class="m-wizard__step m-wizard__step--current m_wizard_form_step_1" >
												<a href="#"  class="m-wizard__step-number">
													<span>
														<i class="fa  flaticon-placeholder"></i>
													</span>
												</a>
												<div class="m-wizard__step-info">
													<div class="m-wizard__step-title">
														1. Đăng ký dịch vụ
													</div>
													<div class="m-wizard__step-desc">
														Khai báo thông tin đầy đủ và
														<br>
														thực hiện thanh toán
													</div>
												</div>
											</div>
											<!--<div class="m-wizard__step" data-wizard-target="#m_wizard_form_step_2">
												<a href="#" class="m-wizard__step-number">
													<span>
														<i class="fa  flaticon-layers"></i>
													</span>
												</a>
												<div class="m-wizard__step-info">
													<div class="m-wizard__step-title">
														2. Xác nhận đơn hàng
													</div>
													<div class="m-wizard__step-desc">
														Kiểm tra đơn hàng
														<br>
														xác nhận với Yteviec bạn đã chọn đúng dịch vụ
													</div>
												</div>
											</div>-->
											<div class="m-wizard__step m-wizard__step--current">
												<a href="#" class="m-wizard__step-number">
													<span>
														<i class="fa  flaticon-layers"></i>
													</span>
												</a>
												<div class="m-wizard__step-info">
													<div class="m-wizard__step-title">
														3. Đăng ký thành công
													</div>
													<div class="m-wizard__step-desc">
														Kiểm tra email khi đăng ký thành công
													</div>
												</div>
											</div>
										</div>
									</div>
							<!--end: Form Wizard Nav -->
							<div class="m-section">
								<div class="m-portlet__body">
									<div class="m-section__content">
										<div class="form-group m-form__group m--margin-top-10">
												<div class="alert m-alert m-alert--default" role="alert">
													Bạn đã đặt hàng thành công . Vui lòng check mail để nhận thông tin đặt hàng<br>
													Yteviec  sẽ xét duyệt và kích hoạt dịch vụ trong thời gian sớm nhất
												</div>
											</div>
									</div>
								</div>
							</div>
				       </div>
				<!--end: Form Wizard Head --> 
				      
				<!--begin: Form Wizard Form-->
				
				<!--end: Form Wizard Form-->
			</div>
			<!--end: Form Wizard-->
		</div>
		<!--End::Main Portlet-->
	</div>
</div>

