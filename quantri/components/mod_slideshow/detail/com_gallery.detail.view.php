<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    $myprocess = new process(); ?>

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
                                        <a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn 1 mục từ danh sách để');}else{  submitbutton('publish')}" class="toolbar">
                                            <span class="icon-32-publish" title="Bật">
                                            </span>
                                            Bật
                                        </a>
                                    </td>

                                    <td class="button" id="toolbar-unpublish">
                                        <a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn 1 mục từ danh sách để');}else{  submitbutton('unpublish')}" class="toolbar">
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
                                        <a href=".?com=mod_slideshow&view=detail&task=add&id=<?php echo $_GET["id"]; ?>" class="toolbar">
                                            <span class="icon-32-new" title="Thêm mới">
                                            </span>
                                            Thêm mới
                                        </a>
                                    </td>
                                    
                                    <td class="button" id="toolbar-new">
                                        <a href=".?com=mod_slideshow&view=folder&task=view" class="toolbar">
                                            <span class="icon-32-back" title="Quay lại">
                                            </span>
                                            Quay lại
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
                        <div class="header icon-48-gallery">
                        	<?php $__mod = $myprocess->get_module_info($_GET['id'])->fetch(PDO::FETCH_ASSOC); ?>
                            Modules » <small>[Trình diễn ảnh] » <?php $core_class->create_lang_flag($__mod['lang_code'], 24); ?> <?php echo $__mod['title']; ?> » Danh sách ảnh</small>
                        </div>

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
                                        $result = $myprocess->process_getallgallery($_GET["id"]);

                                        if(!isset($_POST["limit"])) $r = 10; else $r = $_POST["limit"];
                                        if(!isset($_POST["page"])) $p = 1; else $p = $_POST["page"];
                                        $total_row = $result->rowCount();
                                        $pager = Pager::getPagerData($total_row, $r, $p);
                                        $i = 1;
                                    ?>
                                    <tr>
                                        <th width="10"># </th>
                                        <th width="10"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
                                        <th class="title"><a href="javascript:void(0)">Tập tin ảnh</a></th>
                                        <th width="10%"><a href="javascript:void(0)">Ngày thêm</a></th>
                                        <th width="10%"><a href="javascript:void(0)">Đã được bật</a></th>
                                        <th width="5%" nowrap="nowrap"><a href="javascript:void(0)">Sắp xếp</a></th>
                                        <th width="5%" nowrap="nowrap"><a href="javascript:void(0)">ID</a></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="100">
                                            <!--<del class="container">-->
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
                                            <!--</del>-->
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php while($row = $result->fetch()){ 
                                            if($i > $pager->offset && $i <= $pager->limit){
                                            ?>
                                            <tr class="row0">
                                                <td align="center"><?php echo $i ?></td>
                                                <td><input type="checkbox" id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $row['Id'] ?>" onclick="isChecked(this.checked);" /></td>
                                                <td>
                                                    <a href=".?com=mod_slideshow&view=detail&task=edit&id=<?php echo $row['Id'] ?>">
                                                        <img width="220" src="<?php echo $row['image_file'] ?>">
                                                    </a>			
                                                </td>
                                                <td align="center"><?php echo $row['date_add'] ?></td>
                                                <td align="center">
                                                    <?php if($row['activated'] == 1) { ?>
                                                        <span>
                                                            <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','unpublish')">
                                                                <img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
                                                            </a>
                                                        </span>
                                                        <?php } else if ($row['activated'] == 0) { ?>			
                                                        <span>
                                                            <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','publish')">
                                                                <img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
                                                            </a>
                                                        </span>
                                                        <?php }	?>
                                                </td>
                                                <td class="order">
                                                    <?php if($total_row > 1){ ?>
                                                        <?php if($i == 1){ ?>
                                                            <span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span><br>
                                                            <!--<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text" readonly="true">-->
                                                            <?php } else if($i == $total_row){ ?>
                                                            <span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span><br>
                                                            <!--<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text" readonly="true">-->
                                                            <?php }	else {?>
                                                            <span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span><br>
                                                            <!--<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text" readonly="true">-->
                                                            <span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span><br>
                                                            <?php } ?>		
                                                        <?php } else { ?>
                                                        <span><a href="javascript:void(0);" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
                                                        <!--<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text" readonly="true">-->
                                                        <?php } ?>
                                                </td>
                                                <td align="center"><?php echo $Id ?></td>
                                            </tr>
                                            <?php }	
                                            $i++;
                                    } ?>
                                </tbody>
                            </table>

                            <input type="hidden" name="page" value=<?php echo $p; ?>>
                            <INPUT type="hidden" value="submit_com_gallery_detail_view" name="hidden">
                            <input type="hidden" name="group_type_id" value="<?php echo $_GET["id"]; ?>"/>
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