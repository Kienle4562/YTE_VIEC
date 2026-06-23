<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); ?>
<html>

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title>Thông tin đặt hàng</title>

        <style type="text/css">

           body{font-family:Tahoma, sans-serif;font-size:12px;margin:0;padding:10px;}

		   .container{display:block;width:712px;background:#F9FCFE;border:solid 1px #ddd;margin:10px auto;padding:0;}

		   .container .content{display:block;padding:0 10px 10px;}

		   .title{display:block;font-size:16px;font-weight:bold;background:#F5FAFE;line-height:32px;text-align:center;border-bottom:solid 1px #ddd;color:#549DC7;}

		   p{font-weight:bold;font-size:12px;text-align:left;display:block;width:690px;color:#549DC7;margin:10px 0;padding:0;}

		   .com_cart table.cart{width:690px;border-top:solid 1px #ddd;border-left:solid 1px #ddd;background:white;margin:10px 0 0;}

		   .com_cart table.cart td{border-bottom:solid 1px #ddd;border-right:solid 1px #ddd;padding:5px;}

		   .com_cart table.cart thead td{font-weight:bold;text-decoration:underline;text-align:center!important;}

		   .com_cart table.cart tfoot td{font-weight:bold;text-align:right!important;}

		   .com_cart table.user_information{width:690px;border-top:solid 1px #ddd;border-right:solid 1px #ddd;}

		   .com_cart table.user_information td{line-height:24px;border-left:solid 1px #ddd;border-bottom:solid 1px #ddd;background:white;}

		   .com_cart table.user_information .col_1{width:200px;vertical-align:top;text-align:right;font-weight:bold;}

		   .com_cart table.user_information .col_2{vertical-align:top;}

		   .com_cart table.user_information input[type=text],.com_cart table.user_information textarea{width:300px;border:solid 1px #999;}

		   .com_cart table.user_information textarea[name=information]{height:100px;}

		   .com_cart table.user_information .col_2 label{color:red;display:block;padding-left:2px;}

		   .com_cart table.user_information .warning{color:red;}

		   .com_cart_order table.user_information td{padding:0 5px;}

		   .com_cart_order table.user_information .col_1{text-align:left;width:130px;}

		   .com_cart table.cart *,.com_cart table.user_information *{font-size:11px;}

		   .com_cart table.cart .col_1,.com_cart table.cart .col_3,.com_cart table.user_information .information{text-align:center;}

		   .com_cart table.cart .col_4,.com_cart table.cart .col_5,.com_cart table.cart .col_6{text-align:right;}

        </style>

    </head>

    <body class="com_cart com_cart_order" style="font-family:Tahoma, sans-serif;font-size:12px;margin:0;padding:10px;">

        <div class="container" style="display:block;width:100%;background:#F9FCFE;border:solid 1px #ddd;margin:10px auto;padding:0;">

            <div class="title" style="display:block;font-size:16px;font-weight:bold;background:#F5FAFE;line-height:32px;text-align:center;border-bottom:solid 1px #ddd;color:#549DC7;">ĐƠN ĐẶT HÀNG ( <?php echo $ma_don_hang ?>)</div>

            <div class="content" style="display:block;padding:0 10px 10px;">

                <p style="font-weight:bold;font-size:12px;text-align:left;display:block;width:690px;color:#549DC7;margin:10px 0;padding:0;">Thanh toán</p>

                <?php

                	$payment_method = $_POST['delivery'];
					$payment_stt = $_POST['payment_ok'];
					$phone = $_POST['phone'];
					$nguoilienhe = $_POST['nguoilienhe'];
					$congty_id = $_SESSION["session"]['Id'];
					$ten_cong_ty = $_SESSION["session"]['tencongty'];
					$email_cong_ty = $_SESSION["session"]['Tendangnhap'];
					$nguoilienhe = $_POST['nguoilienhe'];
					$tong_tien = $_POST['tong_tien'];

				?>

                <table class="user_information" cellpadding="5" cellspacing="0" border="1" style="width:100%;border:solid 1px #ddd;background:white;margin:10px 0 0;border-collapse:collapse;">

					<tr>

						<td class="information col_2" colspan="2"><strong><big><big><u>Thông tin</u></big></big></strong></td>

					</tr>

                    <tr>

                        <td class="col_1"><span class="text2translate" alt="fullname">Mã đơn hàng</span></td>

                        <td class="col_2"><?php echo $ma_don_hang ?></td>

                    </tr>
                    <tr>

                        <td class="col_1"><span class="text2translate" alt="fullname">Công ty</span></td>

                        <td class="col_2"><?= $ten_cong_ty; ?></td>

                    </tr>

                    <tr>

                        <td class="col_1"><span class="text2translate" alt="fullname">Số điện thoai</span></td>

                        <td class="col_2"><?= $phone; ?></td>

                    </tr>

                    <tr>

                        <td class="col_1"><span class="text2translate" alt="fullname">Người liên hệ</span></td>

                        <td class="col_2"><?= $nguoilienhe; ?></td>

                    </tr>

                                     

                    <tr>

                        <td class="col_1"><span class="text2translate" alt="fullname">Email Address</span></td>

                        <td class="col_2"><?= $email_cong_ty; ?></td>

                    </tr>        
                    <tr>

                        <td class="col_1"><span class="text2translate" alt="fullname">Hình thức thanh toán</span></td>

                        <?php if($payment_method == 'VCB'){ ?>

                        <td class="col_2">	
							Vietcombank : Ngân hàng thương mại cổ phần Ngoại thương Việt Nam	
							- Chủ tài khoản : Lâm Văn Trung <br>
							- Số tài khoản : 0111000191511 <br>
							- Chi nhánh : Cần Thơ 
                        </td>

                        <?php }else if($payment_method == 'TECH'){?>

                        <td class="col_2">
							Techcombank - Ngân hàng thương mại cổ phần Kỹ Thương Việt Nam
							- Chủ tài khoản : Lâm Văn Trung <br>
							- Số tài khoản : 19034098279019 <br>
							- Chi nhánh : Hà Nội 
						</td>
                        <?php } else if ($payment_method == 'SCB' ){?>
                        <td class="col_2">
							
							SCB - Ngân hàng Thương mại Cổ phần Sài gòn
							- Chủ tài khoản : Lâm Văn Trung <br>
							- Số tài khoản : 1250110015790001 <br>
							- Chi nhánh : TP.HCM
						</td>

                        <?php }else if ($payment_method == 'Wallet' ){ ?>
						<td class="col_2">
							Ví điện tử MOMO & VINID
							- Chủ tài khoản : Lâm Văn Trung
							- Số điện thoại : 0909995224
						</td>
						<?php } ?>
                    </tr>
					<tr>

                        <td class="col_1"><span class="text2translate" alt="fullname">Trạng thái thanh toán</span></td>

                        <td class="col_2"><?php if($payment_stt ==0){ echo 'Chưa thanh toán';}else{echo 'Đã thanh toán';}; ?></td>

                    </tr>   
                </table>                

                

                <p style="font-weight:bold;font-size:12px;text-align:left;display:block;width:690px;color:#549DC7;margin:10px 0;padding:0;">Chi tiết đơn hàng</p>

                

                <table cellpadding="0" cellspacing="0" border="1" class="cart" style="width:100%;border:solid 1px #ddd;background:white;margin:10px 0 0;border-collapse:collapse;">

                    <thead>

                        <tr>

                            <td class="col_1"><span class="text2translate" alt="product_name">Tên dịch vụ</span></td>

                            <td class="col_2"><span class="text2translate" alt="quantity">Mã dịch vụ</span></td>

                            <td class="col_2"><span class="text2translate" alt="quantity">Thời gian</span></td>

                            <td class="col_3"><span class="text2translate" alt="quantity">Số Lượng</span></td>

                            <td class="col_4"><span class="text2translate" alt="product_price">Đơn Giá</span></td>
							<td class="col_4"><span class="text2translate" alt="product_price">Thành tiền</span></td>
                            <td class="col_4"><span class="text2translate" alt="product_price">Giảm</span></td>

                            <td class="col_5"><span class="text2translate" alt="total">Thành tiền</span></td>

                        </tr>

                    </thead>

                    <tbody>

                    	<?php while ($row = $cart_data->fetch(PDO::FETCH_ASSOC)){ 

							$productId 	  = $row['service_id'];

							$product_code = $row['service_code'];

							$product_name = $row['service_name'];
							$operation    = $row['operation'];
							$price 		  = $row['service_price'];

							$giamgia 	  = $row['discount'];

							$kieugiam 	  = $row['type_discount'];

							$qty 		  = $_SESSION['cart'][$row['service_id']]["qty"];

							if($giamgia !=0)

							{

								if($kieugiam == 2)

								{

									

									$giatien = $price - $giamgia;

									$total 		  = $giatien * $qty;

								}

								else if($kieugiam == 1)

								{

									$giampt  = ($price * $giamgia)/100;

									$giatien = $price- $giampt;

									$total 	  = $giatien * $qty;

								}

							}else

							{

								$total 		  = $price * $qty;

							}
							

							$total_a	  += $total;

							$total_bill = $total_a + 0;
							$total_bill_2 += $total;
							if($_SESSION["khuyen-mai"]['loai_giam_km'] == "PHAN_TRAM")
								{
									
									$giam_km = ($total_bill *intval($_SESSION["khuyen-mai"]['gia_tri_giam']))/100;
									$total_bill = $total_bill - $giam_km;
								}else if($_SESSION["khuyen-mai"]['loai_giam_km'] == "TIEN_MAT")
								{
									$giam_km = intval($_SESSION["khuyen-mai"]['gia_tri_giam']);
									$total_bill = $total_bill - $giam_km ;
								}else
								{
									$total_bill = $total_bill;
								}
							
						?>

                        <tr>

                            <td class="col_1">                                                                                                        
								<?= $product_name; ?>
                            </td>

                            <td class="col_2">
								<?= $product_code; ?>
                            </td>

                            <td class="col_2">

                                <div class="properties">
                                  
								<div class="card_product_2"><?= $operation; ?> Ngày</div>
                                </div>

                            </td>

                            <td class="col_3">                                    

                            	<?= $qty; ?>

                            </td>

                            <td class="col_4"><?= number_format($price,0)."đ"; ?></td>
							<td class="col_4"><?= number_format($total,0)."đ"; ?></td>
                            <td class="col_4"> <?php if($giamgia !=0){if($kieugiam ==2){ echo number_format($giamgia, 0) . " đ"; }else { echo $giamgia. "%"; }} ?></td>

                            	<td class="col_5"><strong><?= number_format($total, 0)."đ"; ?></strong></td>

                        </tr>

                        <?php } ?>

                    </tbody>
						
					
                    <tfoot>

                        <tr class="grand_total">

                            <td colspan="7">Tổng cộng</td>

                            <td><?= number_format($total_bill , 2); ?></td>

                        </tr>

                    </tfoot>
					<?php 
					if(!empty($_SESSION["khuyen-mai"]["code_km"])) {
						      
					?>
					<tfoot>
                    <tr class="grand_total">
                        <td colspan="7">Mã Khuyến mãi: <span style="color:blue"><?php echo $_SESSION["khuyen-mai"]["code_km"] ?></span></td>
						<?php if( $_SESSION["khuyen-mai"]["loai_giam_km"] == "PHAN_TRAM") { ?>
                        <td>
							Giảm <?php echo  $_SESSION["khuyen-mai"]["gia_tri_giam"].'%' ?> <br>
							
						</td>
						<?php }else { ?>
						 <td>
							Giảm: <strong> - <?php echo $_SESSION["khuyen-mai"]["gia_tri_giam"]. " VNĐ";  ?> </strong>
						</td>
						<?php } ?>
                    </tr>
                </tfoot>
					<?php } ?>
               </table>

                

            </div>

        </div>

    </body>

</html>