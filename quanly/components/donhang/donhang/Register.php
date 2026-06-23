<?php defined( '_VALID_MOS' ) or die( include("404.php") );
/* 	$arraySource = array(
		'dist/assets/component/thanhtoan/bootstrap-touchspin.js' => 'js',
	);
	$core_class->loadSource($arraySource); */
	include("Model.php");
	//unset($_SESSION['cart']);
	$myprocess = new process();	
	$result = $myprocess->get_cart_data($_SESSION['cart']);
	if(!empty($_SESSION['cart']) && $_SESSION['cart'] != null) { foreach($_SESSION['cart'] as $val){ $sum_qty += $val["qty"]; } }
	$_SESSION['count_item'] = $sum_qty;
	if($view == "Register"){
		$title = "ĐĂNG KÝ DỊCH VỤ";
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
							<a href="#" data-toggle="m-tooltip" class="m-portlet__nav-link m-portlet__nav-link--icon" data-direction="left" data-width="auto" title="Đăng ký dịch vụ để sử dụng tính năng tốt nhất">
								<i class="flaticon-info m--icon-font-size-lg3"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--end: Portlet Head-->
			<!--begin: Form Wizard-->
			<?php if (empty($_SESSION['cart']) || count($_SESSION['cart']) == 0){ ?>
									<div class="alert alert-warning" role="alert">
												<strong>
													Thông báo!
												</strong>
												 Chưa có dịch vụ nào được chọn
											</div>
			 <?php }else { ?>
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
							<div class="progress-bar" role="progressbar"  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
					<!--end: Form Wizard Progress -->  
					<!--begin: Form Wizard Nav -->
						
					     <div class="m-wizard__nav">
										<div class="m-wizard__steps">
											<div class="m-wizard__step m-wizard__step--current m_wizard_form_step_1"  data-wizard-target="#m_wizard_form_step_1">
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
											<div class="m-wizard__step">
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
									<div class="m-section__content">
									
										<table class="table table-striped m-table" align="center">
											<thead>
												<tr>
													<th>
														Mã dịch vụ
													</th>
													<th width="13%">
														Tên dịch vụ
													</th>
													<th  width="20%">
														Nội dung
													</th>
													<th>
														Hạn sử dụng
													</th>
													<th  width="13%">
														Số lượng
													</th>
													<th>
													  Đơn giá
													</th>
													<th>
													 Thành tiền
													</th>
													<th>
														Thao tác
													</th>
												</tr>
											</thead>
											<tbody>
												
											  <?php 
											 
												while ($row = $result->fetch(PDO::FETCH_ASSOC)){
													$service_id       = $row['service_id'];
													$service_name     = $row['service_name'];
													$note     		  = $row['note'];
													$service_price    = $row['service_price'];
													$operation 	      = $row['operation'];
													$description      = $row['description'];
													$discount 	      = $row['discount'];
													$type_discount 	  = $row['type_discount'];
													$qty 		  = $_SESSION['cart'][$row['service_id']]["qty"];
													$service_code 	  = $row['service_code'];
													
													if($discount != 0)
													{
														if($type_discount == 2)
														{
															$giatien = $service_price - $discount;
															$total 		  = $giatien * $qty;
														}else if($type_discount == 1){
															$giampt  = ($service_price * $discount)/100;
															$giatien = $service_price- $giampt;
															$total 	  = $giatien * $qty;
														}
													}else{
														$total = $service_price * $qty;
													}
																					
														$total_bill	  += $total;
														
												  ?>
													<tr>
													<th scope="row">
														<?php echo $service_code; ?>
													</th>
													<td>
														<strong><?php echo $service_name ?></strong> <br>
														<small><?php echo $note ?></small>
													</td>
													<td>
														<?php echo $description ?>
													</td>
													<td>
														<?php echo $operation ?>  ngày
													</td>
													<td>
												     <form id="cart_update_<?php echo $service_id ?>" method="post">
															<div class="form-group">
																<input id="touchspin" type="text" name="quantity" value="<?= $qty; ?>" class="col-md-4 form-control quantity_<?= $service_id; ?>">
															</div>
															<button type="button" onclick="update_qty(<?php echo $service_id ?>)" class="btn btn-outline-info btn-sm fx_center">
																		Cập nhật
															</button>

																<input type="hidden" id="productId_<?= $service_id; ?>" value="<?= $service_id; ?>" />
																<input type="hidden" name="act" value="change_qty" />
														</form>
													</td>
													<td>
														<?= number_format($service_price, 0) . " VNĐ"; ?>
													</td>
													<td>
														<?= number_format($total, 0) . " VNĐ"; ?>
													</td>
													<td>
														<a data-id="<?php echo $service_id ?>"  data-backdrop="static" data-keyboard="false"  class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill delete_item" title="Xóa <?php echo $title ?>">
															<i class="fa fa-remove"></i>
														</a>
													</td>
													
												</tr>
											  <?php } ?>
												<tr class="bg_light_2">

													<td colspan="6" class="v_align_m">

														<div class="d_table w_full">

															<div class="col-lg-3 col-md-3 col-sm-1 v_align_m d_table_cell d_xs_block f_none t_align_r fw_ex_bold color_red t_xs_align_c ">

																Tổng tiền:		

															</div>

														</div>

													</td>

													<td colspan="2" class="fw_ex_bold color_red v_align_m tong_tien white-space"><?= number_format($total_bill, 0) . " VNĐ"; ?></td>

												</tr>
											
											</tbody>
										</table>
									
									</div>
								</div>
				       </div>
				<!--end: Form Wizard Head --> 
				       <div class="m-wizard__form">
									<form class="m-form m-form--label-align-left- m-form--state-" id="m_form">
										<!--begin: Form Body -->
										<div class="m-portlet__body">
											<!--begin: Form Wizard Step 1-->
											<div class="m-wizard__form-step m-wizard__form-step--current" id="m_wizard_form_step_1">
												<div class="row">
													<div class="col-xl-8 offset-xl-2">
														<div class="m-form__section m-form__section--first">
															<div class="m-form__heading">
																<h3 class="m-form__heading-title">
																	Thông tin đăng ký
																</h3>
															</div>
															<div class="form-group m-form__group row">
																<label class="col-xl-3 col-lg-3 col-form-label">
																	* Tên công ty:
																</label>
																<div class="col-xl-9 col-lg-9">
																	<input type="text" name="name" class="form-control m-input" placeholder="" value="<?php echo $_SESSION["session"]['tencongty'] ?>" readonly>
																	<span class="m-form__help">
																		
																	</span>
																</div>
															</div>
															<div class="form-group m-form__group row">
																<label class="col-xl-3 col-lg-3 col-form-label">
																	* Email:
																</label>
																<div class="col-xl-9 col-lg-9">
																	<input type="email" name="email" class="form-control m-input" placeholder="" value="<?php echo $_SESSION["session"]['Tendangnhap'] ?>" readonly>
																	<span class="m-form__help">
																		
																	</span>
																</div>
															</div>
															<div class="form-group m-form__group row">
																<label class="col-xl-3 col-lg-3 col-form-label">
																	* Số điện thoại
																</label>
																<div class="col-xl-9 col-lg-9">
																	<div class="input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-phone"></i>
																			</span>
																		</div>
																		<input type="text" name="phone" class="form-control m-input" placeholder="" value="<?php echo $_SESSION["session"]['sdthoai'] ?>">
																	</div>
																	<span class="m-form__help">
																		
																	</span>
																</div>
															</div>
															<div class="form-group m-form__group row">
																<label class="col-xl-3 col-lg-3 col-form-label">
																	* Người liên hệ
																</label>
																<div class="col-xl-9 col-lg-9">
																	<div class="input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text">
																				<i class="la la-phone"></i>
																			</span>
																		</div>
																		<input type="text" name="nguoilienhe" class="form-control m-input" placeholder="" value="<?php echo $_SESSION["session"]['nguoilienhe'] ?>">
																	</div>
																	<span class="m-form__help">
																		
																	</span>
																</div>
															</div>
														</div>
														<div class="m-separator m-separator--dashed m-separator--lg"></div>
														
														<div class="m-form__section">
															<div class="m-form__heading">
																<h3 class="m-form__heading-title">
																	Thông tin thanh toán
																	<i data-toggle="m-tooltip" data-width="auto" class="m-form__heading-help-icon flaticon-info" title="Chuyển khoản thanh toán và gửi yêu cầu cho Yteviec"></i>
																</h3>
															</div>
															<div class="form-group m-form__group row">
																	<div class="m-form__section">
															<div class="form-group m-form__group">
																<div class="row">
																	<div class="col-lg-6">
																		<label class="m-option">
																			<span class="m-option__control">
																				<span class="m-radio m-radio--state-brand">
																					<input type="radio" name="billing_delivery" value="VCB" checked>
																					<span></span>
																				</span>
																			</span>
																			<span class="m-option__label">
																				<span class="m-option__head">
																					<span class="m-option__title">
																						Vietcombank : Ngân hàng thương mại cổ phần Ngoại thương Việt Nam
																					</span>
																					<span class="m-option__focus">
																						<img src="">
																					</span>
																				</span>
																				<span class="m-option__body">
																					- Chủ tài khoản : Lâm Văn Trung 
																				</span>
																				<span class="m-option__body">
																					- Số tài khoản : 0111000191511
																				</span>
																				<span class="m-option__body">
																					Chi nhánh :  Cần Thơ
																				</span>
																			</span>
																		</label>
																	</div>
																	<div class="col-lg-6">
																		<label class="m-option">
																			<span class="m-option__control">
																				<span class="m-radio m-radio--state-brand">
																					<input type="radio" name="billing_delivery" value="TECH">
																					<span></span>
																				</span>
																			</span>
																			<span class="m-option__label">
																				<span class="m-option__head">
																					<span class="m-option__title">
																						Techcombank - Ngân hàng thương mại cổ phần Kỹ Thương Việt Nam
																					</span>
																					
																				</span>
																				<span class="m-option__body">
																					- Chủ tài khoản : Lâm Văn Trung
																				</span>
																				<span class="m-option__body">
																					- Số tài khoản : 19034098279019 
																				</span>
																				<span class="m-option__body">
																					- Chi nhánh : Hà Nội
																				</span>
																			</span>
																		</label>
																	</div>
																	
																	<div class="col-lg-6">
																		<label class="m-option">
																			<span class="m-option__control">
																				<span class="m-radio m-radio--state-brand">
																					<input type="radio" name="billing_delivery" value="SCB">
																					<span></span>
																				</span>
																			</span>
																			<span class="m-option__label">
																				<span class="m-option__head">
																					<span class="m-option__title">
																						SCB - Ngân hàng Thương mại Cổ phần Sài gòn
																					</span>
																					
																				</span>
																				<span class="m-option__body">
																					- Chủ tài khoản : Lâm Văn Trung
																				</span>
																				<span class="m-option__body">
																					- Số tài khoản : 1250110015790001
																				</span>
																				<span class="m-option__body">
																					- Chi nhánh : TP.HCM
																				</span>
																			</span>
																		</label>
																	</div>
																	<div class="col-lg-6">
																		<label class="m-option">
																			<span class="m-option__control">
																				<span class="m-radio m-radio--state-brand">
																					<input type="radio" name="billing_delivery" value="Wallet">
																					<span></span>
																				</span>
																			</span>
																			<span class="m-option__label">
																				<span class="m-option__head">
																					<span class="m-option__title">
																						Ví điện tử MOMO & VINID
																					</span>
																					
																				</span>
																				<span class="m-option__body">
																					- Chủ tài khoản : Lâm Văn Trung
																				</span>
																				<span class="m-option__body">
																					- Số điện thoại : 0909995224
																				</span>
																				<span class="m-option__body">
																					Nếu quý khách đã có sử dụng ví điện tử MOMO hoặc VINID thì Quý khách có thể sử dụng chuyển khoản trực tiếp trên ứng dụng qua số điện thoại
																				</span>
																			</span>
																		</label>
																	</div>
																</div>
																<div class="m-form__help">
																	<div class="row form-group m-form__group m-login__form-sub">
																		<div class="col m--align-left">
																			<label class="m-checkbox m-checkbox--focus fx_mss">
																				<input type="checkbox" name="payment_ok">
																					Xác nhận với Yteviec bạn đã chuyển khoản trước khi đặt hàng để hệ thống duyệt nhanh hơn
																				
																				<span></span>
																			</label>
																			<span class="m-form__help"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!--end: Form Wizard Step 1-->
                                        
										</div>
										<!--end: Form Body -->
										
                <!--begin: Form Actions -->
										<div class="m-portlet__foot m-portlet__foot--fit m--margin-top-40">
											<div class="m-form__actions">
												<div class="row">
													<div class="col-lg-2"></div>
													<div class="col-lg-5 m--align-left">
														<span class="label"><span><strong>Tổng cộng</strong> <i>(Chưa bao gồm 10% thuế VAT): </i></span></span><span class="price text-primary"> <?= number_format($total_bill, 0) . " VNĐ"; ?></span>
														<input type="hidden" name="tong_tien" value="<?php echo $total_bill ?>">
													</div>
													<div class="col-lg-3 m--align-right">
														
														<a href="#" class="btn btn-warning m-btn m-btn--custom m-btn--icon payment-submit">
															<span>
																<i class="la la-cart-arrow-down"></i>
																<span>
																	ĐẶT HÀNG
																</span>
																&nbsp;&nbsp;
																
															</span>
														</a>
														
													</div>
													<div class="col-lg-2"></div>
												</div>
											</div>
										</div>
										<!--end: Form Actions -->
									</form>
								</div>
				<!--begin: Form Wizard Form-->
				
				<!--end: Form Wizard Form-->
			</div><?php } ?>
			<!--end: Form Wizard-->
		</div>
		<!--End::Main Portlet-->
	</div>
</div>
<script src="dist/assets/web/custom/components/forms/wizard/wizard.js" type="text/javascript"></script>
<script>
	$(document).ready(function() {
	  $("input[name='quantity']").TouchSpin({
		min: 1,
		max: 1000,
		step: 1,
		maxboostedstep: 10000000,
		buttondown_class: "btn btn-link",
		buttonup_class: "btn btn-link",
		initval: 1,
	  });
	});
	function update_qty(service_id)
		{
			var productId = $("#productId_"+service_id).val();
			var quantity = $(".quantity_"+service_id).val();
			var link = window.location.pathname;
			var data= $('#cart_update_'+service_id).serialize()+'&act=change_qty&productId='+productId+'&quantity='+quantity;
			$.ajax({
			url: "process-payment.ajax",
			async:true,
			data:data,
			type: "POST",
			dataType: "JSON",
		    success: function(jsonRs){
				if(jsonRs["isError"] == "0"){
							alert(jsonRs['msg']);
							location.reload();
						}else{
							alert(jsonRs['msg']);
							$(".btn-payment").find('div').remove();
							$(".btn-payment").attr('disabled', false);
						}
			}
		 })
	}
 jQuery(document).ready(function() {
    $(".delete_item").click(function() {
		    var productId = $(this).data("id");
		    var data= 'productId='+productId;
			var x = confirm("Bạn có chắn xóa đơn hàng này không ?");
			if(x){
			$.ajax({
			url: "process-payment.ajax?act=remove-item",
			async:true,
			data:data,
			type: "POST",
			dataType: "JSON",
		    success: function(jsonRs){
				if(jsonRs["isError"] == "0"){
							alert(jsonRs['msg']);
							location.reload();
						}else{
							alert(jsonRs['msg']);
							$(".btn-payment").find('div').remove();
							$(".btn-payment").attr('disabled', false);
						}
			}
		 })
		}
    });
	$(".m_wizard_form_step_1").click(function() {
		  window.location = 'dangkydonhang.html';
    });
	$(".payment-submit").click(function() {
		var billing_delivery = $("input[name='billing_delivery']:checked").val();
		var payment_ok = 0;
		var phone = $("input[name='phone']").val();
		var nguoilienhe = $("input[name='nguoilienhe']").val();
		var tong_tien = $("input[name='tong_tien']").val();
		if( $("input[name='payment_ok']").is(":checked")){
            payment_ok = 1;
          }
		var data= 'delivery='+billing_delivery+'&payment_ok='+payment_ok+'&phone='+phone+'&nguoilienhe='+nguoilienhe+'&tong_tien='+tong_tien;  
		$.ajax({
			url: "process-payment.ajax?act=payment-process",
			async:true,
			data:data,
			type: "POST",
			dataType: "JSON",
		    success: function(jsonRs){
				if(jsonRs["isError"] == "0"){
							alert(jsonRs['msg']);
							 window.location = 'thanh-cong.html';
						}else{
							alert(jsonRs['msg']);
							$(".btn-payment").find('div').remove();
							$(".btn-payment").attr('disabled', false);
						}
			}
		 })
		//alert(payment_ok);
    });
});
</script>