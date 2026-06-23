<?php defined( '_VALID_MOS' ) or die( include("404.php") ); ?>

<div id="content-box">
    <div class="border">
        <div class="padding">
            <div id="toolbar-box">
                <div class="t">
                    <div class="t">
                        <div class="t"></div>
                    </div>
                </div>
                <div class="m">
                    <div class="toolbar" id="toolbar">
                        <table class="toolbar">
                            <tr>

                                <td class="button" id="toolbar-delete">
                                    <a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn 1 mục từ danh sách để');}else{  submitbutton('remove')}" class="toolbar">
                                        <span class="icon-32-delete" title="Xóa">
                                        </span>
                                        Xóa
                                    </a>
                                </td>

                                <td class="button" id="toolbar-help">
                                    <a href="#" onclick="popupWindow('', 'Trợ giúp', 640, 480, 1)" class="toolbar">
                                        <span class="icon-32-help" title="Trợ giúp">
                                        </span>
                                        Trợ giúp
                                    </a>
                                </td>

                            </tr>
                        </table>
                    </div>
                    <div class="header icon-48-product-cart">Danh sách đơn hàng</div>

                    <div class="clr"></div>
                </div>
                <div class="b">
                    <div class="b">
                        <div class="b"></div>
                    </div>
                </div>
            </div>
            <div class="clr"></div>


            <div id="element-box">
                <div class="t">
                    <div class="t">
                        <div class="t"></div>
                    </div>
                </div>
                <div class="m">
                    <form method="post" name="phpForm">
                        <table class="adminlist">
                            <thead>
                                <?php
                                    $myprocess = new process_order();

                                    $result = $myprocess->get_order_list();

                                    if (!isset($_POST["limit"])) $r = 20; else $r = $_POST["limit"];
                                    if (!isset($_POST["page"])) $p = 1; else $p = $_POST["page"];
                                    
                                    include("../protected/back_end_paging.php");
                                    $pager = Pager::getPagerData($result->rowCount(), $r, $p);
                                    
                                    $i = 1;
                                ?>
                                <tr>
                                    <th width="10">STT</th>
                                    <th width="1%" nowrap="nowrap"><a href="javascript:void(0)">ID</a></th>
                                    <th width="10"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
                                    <th class="title"><a href="javascript:void(0)">Họ tên</a></th>
                                    <th class="title" style="width:12% "><a href="javascript:void(0)">Trạng thái</a></th>                
                                    <th class="title" style="width:12% "><a href="javascript:void(0)">Email</a></th>				
                                    <th class="title" style="width:12% "><a href="javascript:void(0)">Điện thoại</a></th>
                                    <th class="title" style="width:12% "><a href="javascript:void(0)">Ngày đặt hàng</a></th>
                                    <th class="title" style="width:12% "><a href="javascript:void(0)">Tổng cộng</a></th>
                                    <th class="title" style="width:12% "><a href="javascript:void(0)">Xem đơn hàng</a></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="13">
                                        Bạn đang xem trang: <?php echo $pager->page ?> của tổng số <?php echo $pager->numPages ?> trang <br>
                                        <?php echo $pager->paging ?> <br>
                                        Hiển thị #
                                        <select name="limit" class="inputbox" size="1" onchange="document.phpForm.submit();">
                                            <?php 
                                                for($j = 5; $j <= 50; $j = $j + 5){ 
                                                    if($j == $r){ ?>
                                                    <option value="<?php echo $j ?>" selected><?php echo $j ?></option>
                                                    <?php } else { ?>
                                                    <option value="<?php echo $j ?>"><?php echo $j ?></option>
                                                    <?php }
                                                }
                                            ?>
                                        </select>
                                        mẫu tin trên mỗi trang
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC))
                                    {
                                        if ($i > $pager->offset && $i <= $pager->limit)
                                        {
                                        ?>
                                        <tr class="row0">
                                            <td align="center"><?php echo $i ?></td>
                                            <td align="center"><?php echo $row['Id']; ?></td>
                                            <td><input type="checkbox" id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $row['Id']; ?>" onclick="isChecked(this.checked);" /></td>
                                            <td>
                                                <?php
                                                    echo $row['fullname'];
                                                    
                                                    if ($row['status'] == 0) {
                                                        ?>&nbsp;<img src="images/new.gif" align="absmiddle" /><?php
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <?php
                                                    if ($row['status'] == 0) {
                                                        echo '<span style="color:#666;">Chưa xem</span>';
                                                    }
                                                    elseif ($row['status'] == 1) {
                                                        echo '<span style="color:#00a;">Đã xem</span>';
                                                    }
                                                    elseif ($row['status'] == 2) {
                                                        echo '<span style="color:#0a0;">Đã giao hàng</span>';
                                                    }
                                                    elseif ($row['status'] == 3) {
                                                        echo '<span style="color:#a00;">Đã huỷ</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td align="center">
                                                <span class="editlinktip hasTip" title="<?php echo $row['email']; ?> "><?php echo $row['email']; ?></span>
                                            </td>			
                                            <td align="center">
                                                <span class="editlinktip hasTip" title="<?php echo $row['phone']; ?> "><?php echo $row['phone']; ?></span>
                                            </td>
                                            <td align="center">
                                                <?php echo date('d/m/Y H:i:s', $row['date_add']); ?>
                                            </td>
                                            <td align="right">
                                                <?php echo number_format($row['total_order'], 0); ?> VNĐ
                                            </td>			
                                            <td align="center"><a class="modal" title="Chi tiết đơn hàng"  href=".?com=com_order&view=detail&id=<?php echo $row['Id']; ?>" rel="{handler: 'iframe', size: {x: 800, y: 550}}">Chi tiết</a></td>
                                        </tr>
                                        <?php
                                        }	
                                        $i++;
                                    }
                                ?>
                            </tbody>
                        </table>

                        <input type=hidden name=page value=<?php echo $p; ?>>
                        <INPUT type=hidden value=submit_com_order_view_master name=hidden>
                        <INPUT type=hidden value=0 name=boxchecked>
                        <INPUT type=hidden name=task>
                    </form>

                    <div class="clr"></div>
                </div>
                <div class="b">
                    <div class="b">
                        <div class="b"></div>
                    </div>
                </div>
            </div>
            <noscript>
                !Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị
            </noscript>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
</div>
<div id="border-bottom"><div><div></div></div></div>