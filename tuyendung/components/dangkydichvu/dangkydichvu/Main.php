<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	//var_dump($_SESSION['cart']);
	if(!empty($_SESSION['cart']) && $_SESSION['cart'] != null)
	{ 
		foreach($_SESSION['cart'] as $val){ 
			$sum_qty += $val["qty"]; 
		}
	}
	$_SESSION['count_item'] = $sum_qty;
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="m-portlet">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<span class="m-portlet__head-icon">
											<i class="la la-leaf"></i>
										</span>
										<h3 class="m-portlet__head-text">
											DỊCH VỤ CỦA CHÚNG TÔI
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<div class="m-pricing-table-1">
									<div class="m-pricing-table-1__items row">
									<?php
										$myprocess = new process();
										$result = $myprocess ->get_dichvu();
										while($row = $result->fetch()){ 
									?>
										<!-- item -->
										<div class="m-pricing-table-1__item col-lg-3">
											<div class="m-pricing-table-1__visual">
												<div class="m-pricing-table-1__hexagon1"></div>
												<div class="m-pricing-table-1__hexagon2"></div>
												<span class="m-pricing-table-1__icon m--font-brand">
													<i class="<?php echo $row['icon'] ?>"></i>
												</span>
											</div>
											<span class="m-pricing-table-1__price">
												<?php echo $row['service_name'] ?>
											</span>
											
											<h2 class="m-pricing-table-1__subtitle">
												<?php echo $row['note'] ?>
											</h2>
											<span class="m-pricing-table-1__description">
												<?php echo $row['description'] ?>
											</span>
											<span class="m-pricing-table__price">
												<?php echo $core_class->convertIntToMoney($row['service_price']) ?> VNĐ / <?php echo $row['operation'] ?> ngày
											</span>
											<div class="m-pricing-table-1__btn">
											<form id="frmCart_<?= $row['service_id']; ?>" method="post" action="">
												<div class="col-lg-6 offset-lg-3 form-group m-form__group"><input  type="text" name="quantity" id="qty_<?= $row['service_id']; ?>" value="1" class="col-md-4 form-control quantity_<?= $service_id; ?>"></div>
												<button type="button" onclick="payment(<?= $row['service_id']; ?>)" class="btn btn-brand m-btn m-btn--custom m-btn--pill m-btn--wide m-btn--uppercase m-btn--bolder m-btn--sm btn-payment">
													Mua dịch vụ
												</button>
												 <input type="hidden" id="productId_<?= $row['service_id']; ?>" value="<?= $row['service_id']; ?>" />
												 <!--<input type="hidden" id="qty_<?= $row['service_id']; ?>" value="1" /> -->
												 <input type="hidden" name="act" value="add_to_cart" />
										   </form>
											</div>
										</div>
										<!-- end item -->
										<?php } ?>
									</div>
								</div>
								<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<span class="m-portlet__head-icon">
											<i class="flaticon-download"></i>
										</span>
										<h3 class="m-portlet__head-text">
											GIẢM GIÁ KHI MUA NHIỀU DỊCH VỤ
										</h3>
									</div>
								</div>
							</div>
								<div class="m-section">
									<div class="m-section__content">
										<table class="table m-table m-table--head-bg-success">
											<thead>
												<tr>
													<th>
														Số lượng ( cùng loại )
													</th>
													<th>
														 2 gói
													</th>
													<th>
														3 - 4 gói
													</th>
													<th>
														5 - 9 gói
													</th>
													<th>
														10 - 19 gói
													</th>
													<th>
														20 - 49 gói
													</th>
													<th>
														Từ 50 gói trở lên
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row">
														Chiếc khấu giảm giá (%)
													</th>
													<td>
														<strong>10%</strong>
													</td>
													<td>
														<strong> 15% </strong>
													</td>
													<td>
														<strong> 20%</strong>
													</td>
													<td>
														<strong> 25% </strong>
													</td>
													<td>
														<strong> 30% </strong>
													</td>
													<td>
														<strong> 50% </strong>
													</td>
												</tr>
												
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
	   </div>
</div>
<div class="chat-fixed corner_5 boxshadow" onclick="show_cart();" title="Giỏ hàng" style="display: block; margin-bottom: 0px;">
		
        <span id="popup_msg_30s" style="display: block; position: absolute; top: -10px; right:0px; background: rgb(51, 153, 51); padding: 3px 8px; border-radius: 50%; color: rgb(255, 255, 255); font-size: 15px;"><?= intval($_SESSION['count_item']); ?></span>
        <div class="inside"></div>
</div>
<!-- Library JS -->
<script type="text/javascript">
		$(document).ready(function() {
			  $("input[name='quantity']").TouchSpin({
				min: 1,
				max: 1000,
				step: 1,
				maxboostedstep: 10000000,
				buttondown_class: "btn btn-link btn-secondary",
				buttonup_class: "btn btn-link btn-secondary",
				initval: 1,
			  });
		});
       function payment(service_id)
		{
			var productId = $("#productId_"+service_id).val();
			var qty = $("#qty_"+service_id).val();
			
			var data= $('#frmCart_'+service_id).serialize()+'&act=add_to_cart&productId='+productId+'&qty='+qty;
			$.ajax({
			url: "process-payment.ajax",
			async:true,
			data:data,
			type: "POST",
			dataType: "JSON",
		    success: function(jsonRs){
				if(jsonRs["isError"] == "0"){
							//alert(jsonRs['msg']);
							 swal({
									"title": "Đã chọn dịch vụ", 
									"text": "Dịch vụ đã thêm vào giỏ hàng thành công", 
									"type": "success",
									"confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
								}).then(function() {
									location.reload();
								});
							
						}else{
							//alert(jsonRs['msg']);
							swal({
									"title": "Lỗi hệ thống", 
									"text": "Lỗi mua dịch vụ , liên hệ với hỗ trợ mua hàng", 
									"type": "error",
									"confirmButtonClass": "btn btn-secondary m-btn m-btn--wide"
								});
							$(".btn-payment").find('div').remove();
							$(".btn-payment").attr('disabled', false);
						}
			}
		})
		}
		 function show_cart()
		{
			window.location = 'thanh-toan-dich-vu.html';
		}
</script>