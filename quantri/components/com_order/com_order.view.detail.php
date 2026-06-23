<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    $myprocess = new process_order();
    $result = $myprocess->get_order_detail($_GET['id']);
    
    // echo $_GET['id'];
    
    if ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
        ?>
        <style type="text/css">
            body{font-family:Tahoma, sans-serif;font-size:12px;margin:0;padding:10px;}p{font-weight:bold;font-size:14px;}p.title{font-size:24px;text-align:center;font-weight:bold;}.com_cart table.cart{width:100%;border-top:solid 1px #ddd;border-left:solid 1px #ddd;background:white;margin:10px 0 0;}.com_cart table.cart td{border-bottom:solid 1px #ddd;border-right:solid 1px #ddd;padding:5px;}.com_cart table.cart thead td{font-weight:bold;text-decoration:underline;text-align:center!important;}.com_cart table.cart tfoot td{font-weight:bold;text-align:right!important;}.com_cart table.user_information{width:100%;border-top:solid 1px #ddd;border-right:solid 1px #ddd;}.com_cart table.user_information td{line-height:24px;border-left:solid 1px #ddd;border-bottom:solid 1px #ddd;background:white;}.com_cart table.user_information .col_1{width:200px;vertical-align:top;text-align:right;font-weight:bold;}.com_cart table.user_information .col_2{vertical-align:top;}.com_cart table.user_information input[type=text],.com_cart table.user_information textarea{width:300px;border:solid 1px #999;}.com_cart table.user_information textarea[name=information]{height:100px;}.com_cart table.user_information .col_2 label{color:red;display:block;padding-left:2px;}.com_cart table.user_information .warning{color:red;}.com_cart_order table.user_information td{padding:0 5px;}.com_cart_order table.user_information .col_1{text-align:left;width:130px;}.com_cart table.cart *,.com_cart table.user_information *{font-size:11px;}.com_cart table.cart .col_1,.com_cart table.cart .col_3,.com_cart table.user_information .information{text-align:center;}.com_cart table.cart .col_4,.com_cart table.cart .col_5,.com_cart table.cart .col_6{text-align:right;}
        </style>

        <div class="com_cart com_cart_order">
            <p class="title">ĐƠN ĐẶT HÀNG</p>
            
            <p>TRẠNG THÁI ĐƠN HÀNG</p>
            <script src="javascript/jquery.js" type="text/javascript"></script>
            <form name="phpForm" method="post">
                <div>
                    <input type="radio" name="status" value="0" <?php if ($row['status'] == 0) { echo 'checked="checked"'; } ?> />
                    <span style="color:#666;">Chưa xem</span>
                    <input type="radio" name="status" value="1" <?php if ($row['status'] == 1) { echo 'checked="checked"'; } ?> />
                    <span style="color:#00a;">Đã xem</span>
                    <input type="radio" name="status" value="2" <?php if ($row['status'] == 2) { echo 'checked="checked"'; } ?> />
                    <span style="color:#0a0;">Đã giao hàng</span>
                    <input type="radio" name="status" value="3" <?php if ($row['status'] == 3) { echo 'checked="checked"'; } ?> />
                    <span style="color:#a00;">Đã huỷ</span>
                </div>
                <?php /*
                <div style="margin-top: 10px;">
                    <input type="submit" value="Lưu trạng thái" />
                </div>
                */ ?>
                <input type="hidden" name="hidden" value="submit_com_order_change_status" />
            </form>
            <script type="text/javascript">
                jQuery('input[name=status]').change(function(e){
                    document.forms['phpForm'].submit();
                })
            </script>
            
            <p>THÔNG TIN KHÁCH HÀNG</p>
            <table class="user_information" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td class="col_1">Họ và tên <span class="warning">*</span></td>
                    <td class="col_2"><?php echo $row['fullname']; ?></td>
                </tr>
                <tr>
                    <td class="col_1">Email</td>
                    <td class="col_2"><?php echo $row['email']; ?></td>
                </tr>
                <tr>
                    <td class="col_1">Số điện thoại <span class="warning">*</span></td>
                    <td class="col_2"><?php echo $row['phone']; ?></td>
                </tr>
                <tr>
                    <td class="col_1">Địa chỉ giao hàng <span class="warning">*</span></td>
                    <td class="col_2"><?php echo $row['diachi1']; ?></td>
                </tr>
                <tr>
                    <td class="col_1">Thông địa chỉ 2</td>
                    <td class="col_2"><?php echo $row['diachi2']; ?></td>
                </tr>
                <tr>
                    <td class="col_1">Thông tin khác</td>
                    <td class="col_2"><?php echo $row['thongtin']; ?></td>
                </tr>
                <tr>
                    <td class="col_1">Phí chuyển</td>
                    <td class="col_2"><?php echo $row['phichuyen']; ?></td>
                </tr>
                  <tr>
                    <td class="col_1">Khu vực</td>
                    <td class="col_2"><?php 
					$result2 = $myprocess->get_khuvuc_gia( $row['khuvuc']);
							if($row2 =$result2->fetch()){ 
								
								echo $row2['khuvuc'];
							}
					
					 ?></td>
                </tr>
                <?php if($row['thanhtoan'] == 1){ ?>
                <tr>
                    <td class="col_1">Chuyển khoản</td>
                    <td class="col_2">
                    <?php if($row['nganhang'] ==1) { ?>
                    	- Ngân hàng TMCP Đông Á - Chi nhánh Quận 9, TP. HCM <br />
                        - Chủ tài khoản: Huỳnh Thị Ánh <br />
                        - Số tài khoản: 0103038419 <br />
                    <?php }else if($row['nganhang'] ==2) { ?>
                    	- Ngân hàng TMCP Ngoại thương Việt Nam - Chi nhánh Cần Thơ <br />
                        - Chủ tài khoản: Huỳnh Thị Ánh <br />
                        - Số tài khoản:  0111000178492 <br />
                    <?php }else{ ?>
                      Xác nhận lại thông tin chuyển khoản
                    <?php } ?>
                    </td>
                </tr>
                <?php }else if($row['thanhtoan'] == 2){ ?>
                	<td class="col_1">Thanh toán tại</td>
                    <td class="col_2">- Địa chỉ 1 : <?= $_APP['config']['contact']['address']["address1"]; ?><br />
                               - Địa chỉ 2 : <?= $_APP['config']['contact']['address']["address2"]; ?><br /></td>
                <?php }else if($row['thanhtoan'] == 3){ ?>
                <td class="col_1">Giao hàng</td>
                    <td class="col_2">Chúng tôi sẽ giao hàng và nhận tiền</td>
                <?php } ?>
            </table>

            <p>CHI TIẾT ĐƠN HÀNG</p>
            <table cellpadding="0" cellspacing="0" border="0" class="cart">
                <thead>
                    <tr>
                        <td class="col_1">#</td>
                        <td class="col_2">Sản phẩm</td>
                         <td class="col_2">Kích thước</td>
                          <td class="col_2">Màu sắc</td>
                        <td class="col_3">Số lượng</td>
                        <td class="col_4">Giá</td>
                        <td class="col_5">Giảm giá</td>
                        <td class="col_6">Thành tiền</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $result = $myprocess->get_order_detail($_GET['id']);
                        $i = 0;
                        
                        while ($row_detail = $result->fetch(PDO::FETCH_ASSOC))
                        {
                            $i++;
                            ?>
                            <tr>
                                <td class="col_1"><?php echo $i; ?></td>
                                <td class="col_2"><?php echo $row_detail['product_name']; ?><br /> Mã sp ( <?php echo $row_detail['SPID']; ?>)</td>
                                <td class="col_2"><?php echo $row_detail['size']; ?></td>
                                <td class="col_2"><?php echo $row_detail['color']; ?></td>
                                <td class="col_3"><?php echo $row_detail['quantity']; ?></td>
                                <td class="col_4"><?php echo number_format($row_detail['unit_price'], 0); ?></td>
                                <td class="col_5">
                                <?php if($row_detail['discount_type'] ==1) {echo $row_detail['discounts']."%";}else if($row_detail['discount_type'] ==0){ echo number_format($row_detail['discounts'], 0) . " đ";} ?>
                                  
                                
                                </td>
                                <td class="col_6"><?php echo number_format($row_detail['total'], 0); ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="grand_total">
                        <td colspan="7">Tổng cộng</td>
                        <td><?php echo number_format($row['total_order'], 0); ?></td>
                    </tr>
                </tfoot>
            </table>

        </div>
        
        <?php
    }