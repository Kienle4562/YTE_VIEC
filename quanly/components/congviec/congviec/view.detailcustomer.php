<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	//include_once("com_order.process.php");
    $myprocess = new process();
?>
        <style type="text/css">
				p {
				   font-weight: bold;
				   font-size: 14px;
				}
				p.title {
				   font-size: 24px;
				   text-align: center;
				   font-weight: bold;
				}
				.com_cart table.cart {
				   width: 100%;
				   border-top: solid 1px #ddd;
				   border-left: solid 1px #ddd;
				   background: white;
				   margin: 10px 0 0;
				}
				.com_cart table.cart td {
				   border-bottom: solid 1px #ddd;
				   border-right: solid 1px #ddd;
				   padding: 5px;
				}
				.com_cart table.cart thead td {
				   font-weight: bold;
				   text-decoration: underline;
				   text-align: center !important;
				}
				.com_cart table.cart tfoot td {
				   font-weight: bold;
				   text-align: right !important;
				}
				.com_cart table.user_information {
				   width: 100%;
				   border-top: solid 1px #ddd;
				   border-right: solid 1px #ddd;
				}
				.com_cart table.user_information td {
				   line-height: 24px;
				   border-left: solid 1px #ddd;
				   border-bottom: solid 1px #ddd;
				   background: white;
				}
				.com_cart table.user_information .col_1 {
				   width: 200px;
				   vertical-align: top;
				   text-align: right;
				   font-weight: bold;
				}
				.com_cart table.user_information .col_2 {
				   vertical-align: top;
				}
				.com_cart table.user_information input[type="text"],
				.com_cart table.user_information textarea {
				   width: 300px;
				   border: solid 1px #999;
				}
				.com_cart table.user_information textarea[name="information"] {
				   height: 100px;
				}
				.com_cart table.user_information .col_2 label {
				   color: red;
				   display: block;
				   padding-left: 2px;
				}
				.com_cart table.user_information .warning {
				   color: red;
				}
				.com_cart_order table.user_information td {
				   padding: 0 5px;
				}
				.com_cart_order table.user_information .col_1 {
				   text-align: left;
				   width: 130px;
				}
				.com_cart table.cart *,
				.com_cart table.user_information * {
				   font-size: 11px;
				}
				.com_cart table.cart .col_1,
				.com_cart table.cart .col_3,
				.com_cart table.user_information .information {
				   text-align: center;
				}
				.com_cart table.cart .col_4,
				.com_cart table.cart .col_5,
				.com_cart table.cart .col_6 {
				   text-align: right;
				}
				div.pager {
					text-align: center;
					margin: 1em 0;
				}

				div.pager span {
					display: inline-block;
					width: 1.8em;
					height: 1.8em;
					line-height: 1.8;
					text-align: center;
					cursor: pointer;
					background: #000;
					color: #fff;
					margin-right: 0.5em;
				}

				div.pager span.active {
					background: #c00;
				}
		</style>
	<div class="modal-body">
       <div class="m-portlet__body">
			 <div class="com_cart com_cart_order">
               <p class="title">CV APPLY</p>
            
           
           
            <table cellpadding="0" cellspacing="0" border="0" class="cart paginated">
                <thead>
                    <tr>
                        <td class="col_1">#</td>
                        <td class="col_2">Tên công việc</td>
                         <td class="col_2">Tên ứng viên</td>
						  <td class="col_2">Giới tính</td>
                          <td class="col_2">Số điện thoại</td>
                        <td class="col_3">Hồ sơ ứng viên</td>
                        <td class="col_4">Email ứng viên</td>
                        <td class="col_5">Tỉnh thành</td>
						<td class="col_5">Ngày ứng tuyển</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $result = $myprocess->getCVApply($_POST['detail_id']);
                        $i = 0;
                      if($result->rowCount() > 0){
                        while ($row_detail = $result->fetch(PDO::FETCH_ASSOC))
                        {
                            $i++;
                            ?>
                            <tr>
                                <td class="col_1"><?php echo $i; ?></td>
                                <td class="col_3"><strong><?php echo $row_detail['tencongviec']; ?></strong></td>
                                <td class="col_3"><?php echo $row_detail['fullname']; ?></td>
                                <td class="col_3"><?php if($row_detail['gioitinh_id'] == 1){ echo 'Nam';} else { echo 'Nữ';} ?></td>
                                <td class="col_5"><?php echo $row_detail['sodienthoai']; ?></td>
                                <td class="col_5"><a href="http://yteviec.com/<?php echo $row_detail['hoso'] ?>" class="m-badge m-badge--accent m-badge--wide">Tải về</a></td>
                                
                                <td class="col_5"><?php echo $row_detail['email']; ?></td>
								<td class="col_5"><?php echo $row_detail['ten_tinhthanh']; ?></td>
								<td class="col_5"><?php echo $row_detail['ngayungtuyen']; ?></td>
                            </tr>
                            <?php
                        }
					  }else{ ?>
						   <tr>
							  <td colspan="9" style="text-align:center; color:blue"> Chưa có CV nào apply!</td>
						   </tr>
					  <?php 
							}
                        ?>
                </tbody>
            </table>

        </div>
	   </div>
       </div> 
    <script>
$('table.paginated').each(function() {
    var currentPage = 0;
    var numPerPage = 10;
    var $table = $(this);
    $table.bind('repaginate', function() {
        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    var numRows = $table.find('tbody tr').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pager"></div>');
    for (var page = 0; page < numPages; page++) {
        $('<span class="page-number"></span>').text(page + 1).bind('click', {
            newPage: page
        }, function(event) {
            currentPage = event.data['newPage'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');
        }).appendTo($pager).addClass('clickable');
    }
    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
});
</script>