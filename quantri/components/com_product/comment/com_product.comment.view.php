<?php defined( '_VALID_MOS' ) or die( include("404.php") );

if($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator")
{
    $myprocess = new process();
    
    $i=1;
    $result = $myprocess->get_comment_list(0);
    
    function renderNumberSelectOptions($total, $selected)
    {
        for ($i = 0; $i <= $total; $i++)
        {
            echo "<option value=\"$i\" " . (($i == $selected) ? "selected=\"selected\"" : "") . ">" . (($i < 10) ? "0" : "") . $i . "</option>";
        }
    }
    
    ?>
    
    <script type="text/javascript">
        function saveContent(id)
        {
            if (jQuery.trim(document.getElementById("content_" + id).value) != "")
            {
                document.tmpForm.comment_id.value = id;
                document.tmpForm.content.value = document.getElementById("content_" + id).value;
                document.tmpForm.hour.value = document.getElementById("hour_" + id).value;
                document.tmpForm.minute.value = document.getElementById("minute_" + id).value;
                document.tmpForm.date_add.value = document.getElementById("date_add_" + id).value;
                document.tmpForm.task.value = "change_content";
                document.tmpForm.submit();
            }
            else
            {
                alert('Xin vui lòng nhập vào nội dung bình luận');
            }
        }
    </script>

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
                                <tbody>
                                    <tr>
                                        <td class="button" id="toolbar-publish">
                                            <a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một sản phẩm từ danh sách để');}else{  submitbutton('publish')}" class="toolbar">
                                                <span class="icon-32-publish" title="Bật"></span>Bật
                                            </a>
                                        </td>
                                        
                                        <td class="button" id="toolbar-unpublish">
                                            <a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một sản phẩm từ danh sách để');}else{  submitbutton('unpublish')}" class="toolbar">
                                                <span class="icon-32-unpublish" title="Tắt"></span>Tắt
                                            </a>
                                        </td>
                                        
                                        <td class="button" id="toolbar-trash">
                                            <a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một sản phẩm từ danh sách để');}else if(confirm('Bạn có chắc chắn muốn xóa những mẫu tin được chọn không? ')){  submitbutton('remove')}" class="toolbar">
                                            <span class="icon-32-trash" title="Sọt rác"></span>Sọt rác
                                            </a>
                                        </td>
                                        
                                        <td class="button" id="toolbar-help">
                                            <a href="#" onclick="popupWindow('', 'Trợ giúp', 640, 480, 1)" class="toolbar">
                                                <span class="icon-32-help" title="Trợ giúp"></span>Trợ giúp
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                
                        <div class="header icon-48-comment">Sản phẩm: <small>[ Bình luận ]</small></div>
            
                        <div class="clr"></div>
                    </div>
                    <div class="b">
                        <div class="b">
                            <div class="b"></div>
                        </div>
                    </div>
                </div>
                <div class="clr"></div>
                        
                <div id="element-box" style="margin-bottom:10px;">
                    <div class="t">
                        <div class="t">
                            <div class="t"></div>
                        </div>
                    </div>
                    <div class="m">
                    
                        <strong>
                            <a href=".?com=com_product&view=category&task=view">Danh mục</a> |
                            <a href=".?com=com_product&view=product&task=view">Sản phẩm</a> |
                            <a href=".?com=com_product&view=comment&task=view">Bình luận</a>
                        </strong>
                        
                        <div class="clr"></div>
                    </div>
                    <div class="b">
                        <div class="b">
                            <div class="b"></div>
                        </div>
                    </div>
                </div>    
                
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
                                    <tr>
                                        <th width="3%"><a href="#">STT</a></th>
                                        <th width="3%" nowrap="nowrap"><a href="#">ID</a></th>
                                        <th class="title" style="width:73%"><a href="#">Nội dung</a></th>
                                        <th width="3%"><a href="#">Trạng thái</a></th>
                                        <th width="3%"><input name="toggle" value="" onclick="checkAll(<?php echo $result->rowCount(); ?>);" type="checkbox"></th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                <?php 
                                    while ($row = $result->fetch(PDO::FETCH_ASSOC))
                                    {
                                        ?>
                                        <tr class="row<?php if ($i % 2 == 0) { echo "0"; } else { echo "1"; } ?>">
                                            <td align="center" valign="top"><?php echo $i; ?></td>
                                            <td align="center" valign="top"><?php echo $row['id']; ?></td>
                                            <td>    
                                                <div style="background: url('images/quote.png') no-repeat; padding-left: 24px; display: block;">
                                                    <div style="font-weight:bold; font-size:13px;">
                                                        <?php
                                                            echo $row['name'];
                                                        ?>
                                                    </div>
                                                    <div style="border-left: solid 1px #ddd; display:block; padding: 5px; line-height: 18px;">
                                                        <div style="display:block; padding-bottom:5px;">
                                                            <strong>Bình luận sản phẩm:</strong>
                                                            <?php
                                                                echo $myprocess->get_category_list($row['book_category_id'], ' » ', 'title') . ' » ';
                                                                $link = $GLOBALS['INDEX']
                                                                            . $myprocess->get_category_list($row['book_category_id'], '/', 'alias')
                                                                            . '/' . $row['alias'] . '/p' . $row['book_product_id'] . $GLOBALS['EXT'];
                                                                echo '<a href="' . $link . '" target="_blank">';
                                                                echo $row['product_name'];
                                                                echo '</a>';
                                                            ?>
                                                        </div>
                                                        <textarea style="width:100%; height:50px; font-family:inherit;" id="content_<?php echo $row['id']; ?>"><?php echo $row['content']; ?></textarea>
                                                        <div style="float:left; margin-top:5px;">
                                                            Đăng vào lúc
                                                            <select id="hour_<?php echo $row['id']; ?>">
                                                                <?php renderNumberSelectOptions(23, date('H', $row['time'])); ?>
                                                            </select>
                                                            giờ
                                                            <select id="minute_<?php echo $row['id']; ?>">
                                                                <?php renderNumberSelectOptions(59, date('i', $row['time'])); ?>
                                                            </select>
                                                            phút, ngày
                                                            <input type="text" id="date_add_<?php echo $row['id']; ?>" name="date_add_<?php echo $row['id']; ?>" value="<?php echo date('d/m/Y', $row['time']); ?>" />
                                                            <script type="text/javascript" src="../calendar/javascript/dhtmlgoodies_calendar.js?random=20060118"></script>
                                                            <img src="../calendar/images/calendar.gif" class="mar_img" align="top" onClick="displayCalendar(document.phpForm.date_add_<?php echo $row['id']; ?>,'dd/mm/yyyy',this);"  />
                                                        </div>

                                                        <p style="text-align:right;">
                                                            <input type="button" value="Lưu" onclick="saveContent('<?php echo $row['id']; ?>')" />
                                                        </p>
                                                        
                                                        <div style="display: block; padding-left: 50px;">
                                                            <?php
                                                                $sub_comment = $myprocess->get_comment_list($row['id']);
                                                                
                                                                while ($sub_row = $sub_comment->fetch(PDO::FETCH_ASSOC))
                                                                {
                                                                    ?>
                                                                    <div style="background: url('images/quote.png') no-repeat; padding-left: 24px; display: block;">
                                                                        <div style="font-weight:bold; font-size:13px;">
                                                                            <?php
                                                                                echo $sub_row['name'];
                                                                            ?>
                                                                        </div>
                                                                        <div style="border-left: solid 1px #ddd; display:block; padding: 5px; line-height: 18px;">
                                                                            <textarea style="width:100%; height:50px; font-family:inherit;" id="content_<?php echo $sub_row['id']; ?>"><?php echo $sub_row['content']; ?></textarea>
                                                                            <div style="float:left; margin-top:5px;">
                                                                                Đăng vào lúc
                                                                                <select id="hour_<?php echo $sub_row['id']; ?>">
                                                                                    <?php renderNumberSelectOptions(23, date('H', $sub_row['time'])); ?>
                                                                                </select>
                                                                                giờ
                                                                                <select id="minute_<?php echo $sub_row['id']; ?>">
                                                                                    <?php renderNumberSelectOptions(59, date('i', $sub_row['time'])); ?>
                                                                                </select>
                                                                                phút, ngày
                                                                                <input type="text" id="date_add_<?php echo $sub_row['id']; ?>" name="date_add_<?php echo $sub_row['id']; ?>" value="<?php echo date('d/m/Y', $sub_row['time']); ?>" />
                                                                                <script type="text/javascript" src="../calendar/javascript/dhtmlgoodies_calendar.js?random=20060118"></script>
                                                                                <img src="../calendar/images/calendar.gif" class="mar_img" align="top" onClick="displayCalendar(document.phpForm.date_add_<?php echo $sub_row['id']; ?>,'dd/mm/yyyy',this);"  />
                                                                            </div>
                                                                            <p style="text-align:right;">
                                                                                <input type="button" value="Lưu" onclick="saveContent('<?php echo $sub_row['id']; ?>')" />
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </td>
                                            <td align="center" valign="top">
                                                <?php if ($row['status'] == 1) { ?>
                                                    <span class="editlinktip hasTip" title="Đã được bật">
                                                        <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','unpublish')">
                                                            <img src="template/images/tick.png" alt="Đã được bật" border="0" width="16" height="16">
                                                        </a>
                                                    </span>
                                                <?php } elseif ($row['status'] == 0) { ?>            
                                                    <span class="editlinktip hasTip" title="Chưa được bật">
                                                        <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','publish')">
                                                            <img src="template/images/publish_r.png" alt="Chưa được bật" border="0" width="16" height="16">
                                                        </a>
                                                    </span>
                                                <?php }    ?>
                                            </td>
                                            <td align="center" valign="top">
                                                <input type="checkbox" id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $row['id']; ?>" onclick="isChecked(this.checked);" />
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                ?>
                                </tbody>
                            </table>

                            <input type="hidden" value="submit_com_product_comment_view" name="hidden" />
                            <input type="hidden" value="0" name="boxchecked" />
                            <input type="hidden" name="task" />
                        </form>
                        <form name="tmpForm" method="post">
                            <input type="hidden" name="hidden" value="submit_com_product_comment_view" />
                            <input type="hidden" name="comment_id" />
                            <input type="hidden" name="content" />
                            <input type="hidden" name="hour" />
                            <input type="hidden" name="minute" />
                            <input type="hidden" name="date_add" />
                            <input type="hidden" name="task" />
                        </form>
                        <div class="clr"></div>
                    </div>
                    <div class="b">
                        <div class="b">
                            <div class="b"></div>
                        </div>
                    </div>
                </div>

                <noscript>!Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị</noscript>
                
                <div class="clr"></div>
            </div>
            
            <div class="clr"></div>
        </div>
    </div>
    <div id="border-bottom">
        <div>
            <div>
            </div>
        </div>
    </div>
<?php } ?>