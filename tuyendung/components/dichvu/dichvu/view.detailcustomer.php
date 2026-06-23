<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	//include_once("com_order.process.php");
    $myprocess = new process();
?>
        <style type="text/css">
            body{font-family:Tahoma, sans-serif;font-size:12px;margin:0;padding:10px;}p{font-weight:bold;font-size:14px;}p.title{font-size:24px;text-align:center;font-weight:bold;}.com_cart table.cart{width:100%;border-top:solid 1px #ddd;border-left:solid 1px #ddd;background:white;margin:10px 0 0;}.com_cart table.cart td{border-bottom:solid 1px #ddd;border-right:solid 1px #ddd;padding:5px;}.com_cart table.cart thead td{font-weight:bold;text-decoration:underline;text-align:center!important;}.com_cart table.cart tfoot td{font-weight:bold;text-align:right!important;}.com_cart table.user_information{width:100%;border-top:solid 1px #ddd;border-right:solid 1px #ddd;}.com_cart table.user_information td{line-height:24px;border-left:solid 1px #ddd;border-bottom:solid 1px #ddd;background:white;}.com_cart table.user_information .col_1{width:200px;vertical-align:top;text-align:right;font-weight:bold;}.com_cart table.user_information .col_2{vertical-align:top;}.com_cart table.user_information input[type=text],.com_cart table.user_information textarea{width:300px;border:solid 1px #999;}.com_cart table.user_information textarea[name=information]{height:100px;}.com_cart table.user_information .col_2 label{color:red;display:block;padding-left:2px;}.com_cart table.user_information .warning{color:red;}.com_cart_order table.user_information td{padding:0 5px;}.com_cart_order table.user_information .col_1{text-align:left;width:130px;}.com_cart table.cart *,.com_cart table.user_information *{font-size:11px;}.com_cart table.cart .col_1,.com_cart table.cart .col_3,.com_cart table.user_information .information{text-align:center;}.com_cart table.cart .col_4,.com_cart table.cart .col_5,.com_cart table.cart .col_6{text-align:right;}
        </style>
	<div class="modal-body">
       <div class="m-portlet__body">
			 <div class="com_cart com_cart_order">
               <p class="title">BÀI ĐĂNG DỊCH VỤ</p>
            
           
           
            <table cellpadding="0" cellspacing="0" border="0" class="cart">
                <thead>
                    <tr>
                        <td class="col_1">#</td>
                        <td class="col_2">Chức danh</td>
                         <td class="col_2">Ngày đăng</td>
                          <td class="col_2">Ngày hết hạn</td>
                        <td class="col_3">lượt xem</td>
                        <td class="col_4">Loại dịch vụ</td>
                        <td class="col_5">Trạng thái</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $result = $myprocess->get_job_customer($_POST['detail_id']);
                        $i = 0;
                        
                        while ($row_detail = $result->fetch(PDO::FETCH_ASSOC))
                        {
                            $i++;
                            ?>
                            <tr>
                                <td class="col_1"><?php echo $i; ?></td>
                                <td class="col_3"><strong><?php echo $row_detail['tencongviec']; ?></strong></td>
                                <td class="col_3"><?php echo $row_detail['ngaydang']; ?></td>
                                <td class="col_3"><?php echo $row_detail['ngayhethan']; ?></td>
                                <td class="col_5"><?php echo $row_detail['luotxem']; ?></td>
                                <td class="col_5">hot Job</td>
                                
                                <td class="col_5">Đang chạy</td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
				
               <!-- <tfoot>
                    <tr class="grand_total">
                        <td colspan="6">Tổng cộng</td>
                        <td><?php echo $row['tong_tien']; ?> đ</td>
                    </tr>
                </tfoot>-->
				<?php 
					if(!empty($row['ma_giam'])) {
				
					?>
				<tfoot>
                    <tr class="grand_total">
                        <td colspan="6">Mã Khuyến mãi: <span style="color:blue"><?php echo $row['ma_giam'] ?></span></td>
						<?php if($row['style_giam'] == "PHAN_TRAM") { ?>
                        <td>
							Giảm <?php echo $row['gia_tri_giam'].'%' ?> <br>
							<strong>(- <?php echo $row['giam_km']. " VNĐ";  ?>) </strong>
						</td>
						<?php }else { ?>
						 <td>
							Giảm: <strong> - <?php echo $row['giam_km']. " VNĐ";  ?> </strong>
						</td>
						<?php } ?>
                    </tr>
                </tfoot>
				<?php } ?>
            </table>

        </div>
	   </div>
       </div> 
    