<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	        //include_once("com_order.process.php");
            $myprocess = new process();
            $result = $myprocess->get_order_detail($_POST['customer_id']);
            // echo $_GET['id'];
            if ($row = $result->fetch(PDO::FETCH_ASSOC))
            {
?>
        <style type="text/css">
            body{font-family:Tahoma, sans-serif;font-size:12px;margin:0;padding:10px;}p{font-weight:bold;font-size:14px;}p.title{font-size:24px;text-align:center;font-weight:bold;}.com_cart table.cart{width:100%;border-top:solid 1px #ddd;border-left:solid 1px #ddd;background:white;margin:10px 0 0;}.com_cart table.cart td{border-bottom:solid 1px #ddd;border-right:solid 1px #ddd;padding:5px;}.com_cart table.cart thead td{font-weight:bold;text-decoration:underline;text-align:center!important;}.com_cart table.cart tfoot td{font-weight:bold;text-align:right!important;}.com_cart table.user_information{width:100%;border-top:solid 1px #ddd;border-right:solid 1px #ddd;}.com_cart table.user_information td{line-height:24px;border-left:solid 1px #ddd;border-bottom:solid 1px #ddd;background:white;}.com_cart table.user_information .col_1{width:200px;vertical-align:top;text-align:right;font-weight:bold;}.com_cart table.user_information .col_2{vertical-align:top;}.com_cart table.user_information input[type=text],.com_cart table.user_information textarea{width:300px;border:solid 1px #999;}.com_cart table.user_information textarea[name=information]{height:100px;}.com_cart table.user_information .col_2 label{color:red;display:block;padding-left:2px;}.com_cart table.user_information .warning{color:red;}.com_cart_order table.user_information td{padding:0 5px;}.com_cart_order table.user_information .col_1{text-align:left;width:130px;}.com_cart table.cart *,.com_cart table.user_information *{font-size:11px;}.com_cart table.cart .col_1,.com_cart table.cart .col_3,.com_cart table.user_information .information{text-align:center;}.com_cart table.cart .col_4,.com_cart table.cart .col_5,.com_cart table.cart .col_6{text-align:right;}, .m-badge--wide{ margin-top:10px;}
        </style>
	<div class="modal-body">
       <div class="m-portlet__body">
			 <div class="com_cart com_cart_order">
            <p class="title">ĐƠN ĐẶT HÀNG</p>
            
            <p>TRẠNG THÁI ĐƠN HÀNG</p>
            <script src="javascript/jquery.js" type="text/javascript"></script>
            <form name="phpForm" method="post">
					<?php if ($row['status'] == 0){
						echo '<span class="m-badge m-badge--metal m-badge--wide">
								Chưa duyệt
							</span>'; 
						} ?>
						<?php if ($row['status'] == 1){

						echo '<span class="m-badge m-badge--success m-badge--wide">
								Đã duyệt
							</span>'; 
						
						} ?>
						<?php if ($row['status'] == 2){

						echo '<span class="m-badge m-badge--danger m-badge--wide">
								Đã hủy
							</span>'; 
						
						} ?>
                <!--<div>
                    <input type="radio" name="status" value="0" <?php if ($row['status'] == 0) { echo 'checked="checked"'; } ?> />
                    
                    <input type="radio" name="status" value="1" <?php if ($row['status'] == 1) { echo 'checked="checked"'; } ?> />
                    <span style="color:#00a;">Đã xem</span>
                    <input type="radio" name="status" value="2" <?php if ($row['status'] == 2) { echo 'checked="checked"'; } ?> />
                    <span style="color:#0a0;">Đã giao hàng</span>
                    <input type="radio" name="status" value="3" <?php if ($row['status'] == 3) { echo 'checked="checked"'; } ?> />
                    <span style="color:#a00;">Đã huỷ</span>
                </div>-->
                <?php /*
                <div style="margin-top: 10px;">
                    <input type="submit" value="Lưu trạng thái" />
                </div>
                */ ?>
            </form>
            <p>THÔNG TIN DỊCH VỤ</p>
            <table class="user_information" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td class="col_1">Mã đơn hàng<span class="warning">*</span></td>
                    <td class="col_2"><span class="m-badge m-badge--focus m-badge--wide">
								<?php echo $row['ma_don_hang']; ?>
							</span></td>
                </tr>
				<tr>
                    <td class="col_1">Tên công ty</td>
                    <td class="col_2"><?php echo $row['ten_cong_ty']; ?></td>
                </tr>
                <tr>
                    <td class="col_1">Email</td>
                    <td class="col_2"><?php echo $row['email_cong_ty']; ?></td>
                </tr>
                <tr>
                    <td class="col_1">Số điện thoại <span class="warning">*</span></td>
                    <td class="col_2"><?php echo $row['phone']; ?></td>
                </tr>
                <tr>
                    <td class="col_1">Người liên hệ<span class="warning">*</span></td>
                    <td class="col_2"><?php echo $row['nguoilienhe']; ?></td>
                </tr>
                <tr>
                    <td class="col_1">Tổng tiền</td>
                    <td class="col_2"><?php echo $row['tong_tien']; ?> đ ( chưa bao gồm VAT 10%)</td>
                </tr>
                <tr>
                    <td class="col_1">Thanh toán</td>
                    <?php if($row['payment_method'] == 'VCB'){ ?>

                        <td class="col_2">	
							Vietcombank : Ngân hàng thương mại cổ phần Ngoại thương Việt Nam	
							- Chủ tài khoản : Lâm Văn Trung <br>
							- Số tài khoản : 0111000191511 <br>
							- Chi nhánh : Cần Thơ 
                        </td>

                        <?php }else if($row['payment_method']  == 'TECH'){?>

                        <td class="col_2">
							Techcombank - Ngân hàng thương mại cổ phần Kỹ Thương Việt Nam
							- Chủ tài khoản : Lâm Văn Trung <br>
							- Số tài khoản : 19034098279019 <br>
							- Chi nhánh : Hà Nội 
						</td>
                        <?php } else if ($row['payment_method']  == 'SCB' ){?>
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
                    <td class="col_1">Trạng thái</td>
                    <td class="col_2">
					<?php if ($row['status'] == 0){
						echo '<span class="m-badge m-badge--metal m-badge--wide" style="margin-top: 10px;">
								Chưa thanh toán
							</span>'; 
						} ?>
						<?php if ($row['status'] == 1){

						echo '<span class="m-badge m-badge--success m-badge--wide" style="margin-top: 10px;">
								Đã thanh toán
							</span>'; 
						
						} ?>
					</td>
                </tr>
                 <tr>
                    <td class="col_1">Ngày đăng ký</td>
                    <td class="col_2"><?php echo $row['ngaydangky'] ?></td>
                </tr>
               
            </table>

            <p>CHI TIẾT ĐƠN HÀNG</p>
            <table cellpadding="0" cellspacing="0" border="0" class="cart">
                <thead>
                    <tr>
                        <td class="col_1">#</td>
                        <td class="col_2">Mã dịch vụ</td>
                         <td class="col_2">Tên dịch vụ</td>
                          <td class="col_2">Số lượng</td>
                          <td class="col_3">Đơn giá</td>
                          <td class="col_4">Giảm giá</td>
                          <td class="col_4">Ngày kích hoạt</td>
                          <td class="col_4">Ngày hết hạn</td>
                        <td class="col_5">Thành tiền</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $result = $myprocess->get_order_detail($_POST['customer_id']);
                        $i = 0;
                        $day = 180;
                        while ($row_detail = $result->fetch(PDO::FETCH_ASSOC))
                        {
                            $i++;
                            $day = $row_detail['so_ngay_sd'];
                            ?>
                            <tr>
                                <td class="col_1"><?php echo $i; ?></td>
                                <td class="col_3"><strong><?php echo $row_detail['service_code']; ?></strong></td>
                                <td class="col_3"><?php echo $row_detail['service_name']; ?></td>
                                <td class="col_3"><?php echo $row_detail['qty']; ?></td>
                                <td class="col_5"><?php echo number_format($row_detail['don_gia'], 0); ?> đ</td>
                                <td class="col_5"><?php if($row_detail['kieu_giam'] ==1) {echo $row_detail['giam_gia']."%";}else if($row_detail['kieu_giam'] ==0){ echo number_format($row_detail['giam_gia'], 0) . " đ";} ?></td>
                                <td class="col_5"> <?php if($row['ngaykichhoat'] == "") { ?> <?php echo date('d/m/Y') ?> <input type="checkbox" class="trangthai" value="<?php echo  $_POST['customer_id'] ?>" <?php if($row['status'] == 0) {echo ' disabled'; } ?> name="check_status" data-id="<?php echo $_POST['customer_id'] ?>" data-exdate="<?php echo date('d/m/Y', strtotime("+".$day."days"))  ?>" data-idcty="<?php echo $row['congty_id']; ?>" data-code="<?php echo $row_detail['code_function'] ?>" data-point="<?php echo $row_detail['point']; ?>"> <?php } else { ?> <?php echo $row_detail['ngaykichhoat'] ?><?php } ?></td>
                                <td class="col_5"><?php if($row['ngayhethan'] == ""){echo $day." ngày"; }else{ echo $row_detail['ngayhethan']; } ?> </td>
                                <td class="col_5"><?php echo number_format($row_detail['thanh_tien'], 0); ?> đ</td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="grand_total">
                        <td colspan="8">Tổng cộng</td>
                        <td><?php echo $row['tong_tien']; ?> đ</td>
                    </tr>
                </tfoot>
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
        <?php
    } ?>
    <script>
        $(".trangthai").click(function() {
            var customerID = $(this).data("id");
            var data_exdate = $(this).data("exdate");
            var codefuc = $(this).data("code");
            var point = $(this).data("point");
            var idCty = $(this).data("idcty");
            var data= 'customerID='+customerID+'&dateExt='+data_exdate+'&code='+codefuc+'&point='+point+'&idcty='+idCty;
			var x = confirm("Bạn có chắn kích hoạt dịch vụ ?");
			if(x){
			$.ajax({
			url: "activer-servicer.ajax?act=checkApply-activer",
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
						
						}
			}
		 })
		}
    });
    </script>