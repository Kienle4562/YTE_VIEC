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
    <?php
            $ma_don_hang = $_POST['ma_don_hang'];
            $payment_stt = $_POST['payment_ok'];
            $phone = $_POST['phone'];
            $nguoilienhe = $_POST['nguoilienhe'];
            $congty_id = $_SESSION["session"]['Id'];
            $ten_cong_ty = $_POST['tencongty'];
            $email_cong_ty = $_POST['email'];
            $nguoilienhe = $_POST['nguoilienhe'];
            $tong_tien = $_POST['tong_tien'];
            $activation_date = $_POST['ngaykichhoat'];
            $expiry_date = $_POST['ngayhethan'];
            ?>
        <div class="container" style="display:block;width:100%;background:#F9FCFE;border:solid 1px #ddd;margin:10px auto;padding:0;">

            <div class="title" style="display:block;font-size:16px;font-weight:bold;background:#F5FAFE;line-height:32px;text-align:center;border-bottom:solid 1px #ddd;color:#549DC7;">ĐƠN ĐẶT HÀNG ( <?php echo $ma_don_hang ?>)</div>

            <div class="content" style="display:block;padding:0 10px 10px;">

                <p style="font-weight:bold;font-size:12px;text-align:left;display:block;width:690px;color:#549DC7;margin:10px 0;padding:0;">Thanh toán</p>

                

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
                        <td class="col_1"><span class="text2translate" alt="fullname">Ngày đăng ký</span></td>
                        <td class="col_2"><?php echo $activation_date ?></td>
                    </tr>
                    <tr>
                        <td class="col_1"><span class="text2translate" alt="fullname">Ngày hết hạn</span></td>
                        <td class="col_2"><?php echo $expiry_date ?></td>
                    </tr>
					<tr>
                        <td class="col_1"><span class="text2translate" alt="fullname">Trạng thái</span></td>
                        <td class="col_2"> Đã kích hoạt </td>
                    </tr>

                </table>                

                

                <p style="font-weight:bold;font-size:12px;text-align:left;display:block;width:690px;color:#549DC7;margin:10px 0;padding:0;">Chi tiết đơn hàng</p>

                

                <table cellpadding="0" cellspacing="0" border="1" class="cart" style="width:100%;border:solid 1px #ddd;background:white;margin:10px 0 0;border-collapse:collapse;">

                    <thead>

                        <tr>

                            <td class="col_1"><span class="text2translate" alt="product_name">Tên dịch vụ</span></td>

                            <td class="col_2"><span class="text2translate" alt="quantity">Mã dịch vụ</span></td>

                            <td class="col_3"><span class="text2translate" alt="quantity">Số Lượng</span></td>
							<td class="col_4"><span class="text2translate" alt="product_price">Thành tiền</span></td>
                          

                        </tr>

                    </thead>

                    <tbody>

                    	<?php 	
									$activation_date = date('Y-m-d H:i:s');
                                    $dich_vu = $_POST["dich_vu"];
                                    $quantity = $_POST["quantity"];
                                    $don_gia = $_POST["don_gia"];
                                    $service_id = $_POST["service_id"];
                                    $expiry_date = $core_class->_formatdate($_POST['ngayhethan']);
                                    $tong_tien = $_POST['tong_tien'];
                                  
                                for ($i = 0; $i < count($dich_vu); $i++){
                                    
						 ?>

                        <tr>

                            <td class="col_1">                                                                                                        
								<?= $dich_vu[$i]; ?>
                            </td>

                            <td class="col_2">
								<?= $product_code; ?>
                            </td>
                            <td class="col_3">                                    

                            	<?= $quantity[$i]; ?>

                            </td>

							<td class="col_4"><?php echo number_format($don_gia[$i],0); ?></td>
                           
                        </tr>
                         <?php } ?>
                    </tbody>

                    <tfoot>

                        <tr class="grand_total">
                            <td colspan="3">Tổng cộng</td>

                            <td><?= number_format($tong_tien,0); ?></td>

                        </tr>

                    </tfoot>

               </table>

                

            </div>

        </div>

    </body>

</html>