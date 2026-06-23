<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include_once('com_account_manager.models.php');
  	$myprocess = new process_manager_bds();
?>


<div class="section_offset counter bg_light">
        <div class="container">
        	
            <div class="im_half_container m_bottom_10">
                <div class="half_column d_inline_m w_xs_full m_xs_bottom_10">
                    <p class="fw_ex_bold">Lịch sử mua hàng</p>
                </div>
               
            </div>
            <div class="r_corners wrapper border_grey m_bottom_50 m_xs_bottom_30">
           <table cellpadding="0" cellspacing="0" border="0" class="table_type_1 responsive_table w_full t_align_l ">
                <thead>
                    <tr class="bg_light_2 color_dark">
                        <td class="col_1">#</td>
                        <td class="col_2">Sản phẩm</td>
                        <td class="col_2">Ngày mua</td>
                         <td class="col_2">Kích thước</td>
                        <td class="col_2">Màu sắc</td>
                        <td class="col_3">Số lượng</td>
                        <td class="col_4">Giá</td>
                        <td class="col_5">Giảm giá</td>
                        <td class="col_6">Trạng thái</td>
                        <td class="col_6">Thành tiền</td>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $result = $myprocess->get_order_detail($_SESSION["member"]["Ac_Id"]);
                        $i = 0;
                        
                        while ($row_detail = $result->fetch(PDO::FETCH_ASSOC))
                        {
                            $i++;
                            ?>
                            <tr class="tr_delay">
                                <td ><?php echo $i; ?></td>
                                <td ><?php echo $row_detail['product_name']; ?><br /> Mã sp ( <?php echo $row_detail['SPID']; ?>)</td>
                                 <td ><?php echo date('d/m/Y H:i:s',$row_detail['date_add']) ?></td>
                                <td ><?php echo $row_detail['size']; ?></td>
                                <td ><?php echo $row_detail['color']; ?></td>
                                <td ><?php echo $row_detail['quantity']; ?></td>
                                <td ><?php echo number_format($row_detail['unit_price'], 0); ?></td>
                                <td ><?php if($row_detail['discount_type'] ==1) {echo $row_detail['discounts']."%";}else if($row_detail['discount_type'] ==0){ echo number_format($row_detail['discounts'], 0) . " đ";} ?></td>
                                <td >
                              			  <?php
                                                    if ($row_detail['status'] == 0) {
                                                        echo '<span style="color:#666;">Chưa xem</span>';
                                                    }
                                                    elseif ($row_detail['status'] == 1) {
                                                        echo '<span style="color:#00a;">Đã xem</span>';
                                                    }
                                                    elseif ($row_detail['status'] == 2) {
                                                        echo '<span style="color:#0a0;">Đã giao hàng</span>';
                                                    }
                                                    elseif ($row_detail['status'] == 3) {
                                                        echo '<span style="color:#a00;">Đã huỷ</span>';
                                                    }
                                                ?>
                                </td>
                                <td><?php echo number_format($row_detail['total'], 0); ?></td>
                                
                            </tr>
                            <?php
							 $tongtien += $row_detail['total'];
                        }
                    ?>
                     <!--<tr class="bg_light_2">
                            <td colspan="9" class="v_align_m">
                                <div class="d_table w_full">
                                    <div class="col-lg-3 col-md-3 col-sm-1 v_align_m d_table_cell d_xs_block f_none t_align_r fw_ex_bold color_red t_xs_align_c">
                                        Tổng tiền:		
                                    </div>
                                </div>
                            </td>
                            <td colspan="2" class="fw_ex_bold color_red v_align_m"><?php 
						
						echo number_format($tongtien, 0); ?></td>
                        </tr>-->
                </tbody>
               
            </table>
            </div>
			
           
        </div>
    </div>
