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
                        <table class="toolbar"><tr>
                                <td class="button" id="toolbar-publish">
                                    <a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn 1 mục từ danh sách để');}else{  submitbutton('unblock')}" class="toolbar">
                                        <span class="icon-32-publish" title="Bật">
                                        </span>
                                        Bật
                                    </a>
                                </td>

                                <td class="button" id="toolbar-unpublish">
                                    <a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn 1 mục từ danh sách để');}else{  submitbutton('block')}" class="toolbar">
                                        <span class="icon-32-unpublish" title="Tắt">
                                        </span>
                                        Tắt
                                    </a>
                                </td>

                                <td class="button" id="toolbar-delete">
                                    <a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn 1 mục từ danh sách để');}else{  submitbutton('remove')}" class="toolbar">
                                        <span class="icon-32-delete" title="Xóa">
                                        </span>
                                        Xóa
                                    </a>
                                </td>

                                <td class="button" id="toolbar-new">
                                    <a href=".?com=com_user&view=add" class="toolbar">
                                        <span class="icon-32-new" title="Thêm mới">
                                        </span>
                                        Thêm mới
                                    </a>
                                </td>

                                <td class="button" id="toolbar-help">
                                    <a href="#" onclick="popupWindow('', 'Trợ giúp', 640, 480, 1)" class="toolbar">
                                        <span class="icon-32-help" title="Trợ giúp">
                                        </span>
                                        Trợ giúp
                                    </a>
                                </td>

                            </tr></table>
                    </div>
                    <div class="header icon-48-user">Quản lý thành viên</div>

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
                                    include("../protected/back_end_paging.php");
                                    include_once("com_user.process.php");
                                    
                                    $myprocess = new process();

                                    $sql = "SELECT
													khachhang.Ac_Id,
													khachhang.userName,
													khachhang.fullName,
													khachhang.mail,
													khachhang.gioitinh,
													khachhang.status,
													khachhang.address,
													khachhang.phone,
													khachhang.register_date,
													khachhang.last_visit_date,
													khachhang.type
												FROM
													khachhang
												 ORDER BY  khachhang.Ac_Id DESC ";
                                    
                                    $result = $myprocess->dbObj->SqlQueryOutputResult($sql, array());
                                    
                                    if (!isset($_POST["limit"])) {
                                        $r = 10; 
                                    } else {
                                        $r = $_POST["limit"];
                                    }
                                    
                                    if (!isset($_POST["page"])) {
                                        $p = 1; 
                                    } else {
                                        $p = $_POST["page"];
                                    }
                                    
                                    $pager = Pager::getPagerData($result->rowCount(), $r, $p);
                                    
                                    $i = 1;
                                ?>
                                <tr>
                                    <th width="10"># </th>
                                    <th width="10"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
                                    <th class="title" style="width:10% "><a href="javascript:void(0)">Tên đăng nhập</a></th>
                                    <th class="title" style="width:20% "><a href="javascript:void(0)">Tên đầy đủ</a></th>
                                    <th class="title" style="width:10% "><a href="javascript:void(0)">Email</a></th>
                                    <th class="title" style="width:10% "><a href="javascript:void(0)">Số điện thoại</a></th>
                                    <th class="title" style="width:30% "><a href="javascript:void(0)">Địa chỉ</a></th>
                                    <th width="10%"><a href="javascript:void(0)">Đã được bật</a></th>                                    
                                    <th width="1%" nowrap="nowrap"><a href="javascript:void(0)">ID</a></th>
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
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                        if ($i > $pager->offset && $i <= $pager->limit) {
                                            extract($row);
                                            ?>
                                            <tr class="row0">
                                                <td align="center"><?php echo $i ?></td>
                                                <td align="center"><input type="checkbox" id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $Ac_Id; ?>" onclick="isChecked(this.checked);" /></td>
                                                <td>
                                                    <span class="editlinktip hasTip" title="<?php echo $userName; ?> ">
                                                        <a href=".?com=com_user&view=edit.user&id=<?php echo $Ac_Id; ?>"><?php echo $userName; ?> </a>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="editlinktip hasTip" title="<?php echo $fullName; ?> "><?php echo $fullName; ?></span>
                                                </td>			                                                
                                                <td><span class="editlinktip hasTip" title="<?php echo $mail; ?> "><?php echo $mail; ?></span></td>
                                                <td><span class="editlinktip hasTip" title="<?php echo $phone; ?> "><?php echo $phone; ?></span></td>
                                                <td><span class="editlinktip hasTip" title="<?php echo $address; ?> "><?php echo $address; ?></span></td>
                                                <td align="center">
                                                    <?php if($status == 1) { ?>
                                                        <span class="editlinktip hasTip">
                                                            <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','block')">
                                                                <img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
                                                            </a>
                                                        </span>
                                                        <?php } else if ($status == 0) { ?>			
                                                        <span class="editlinktip hasTip">
                                                            <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','unblock')">
                                                                <img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
                                                            </a>
                                                        </span>
                                                        <?php }	?>
                                                </td>
                                                <td align="center"><?php echo $Ac_Id; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        $i++;
                                    }
                                ?>
                            </tbody>
                        </table>

                        <input type="hidden" name="page" value="<?php echo $p; ?>">
                        <INPUT type="hidden" value="submit_com_user_view" name="hidden">
                        <INPUT type="hidden" value="0" name="boxchecked">
                        <INPUT type="hidden" name="task">
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