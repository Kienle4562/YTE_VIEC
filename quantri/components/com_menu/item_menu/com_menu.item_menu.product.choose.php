<?php defined( '_VALID_MOS' ) or die( include("404.php") );

if($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator")
{
    $myprocess = new process();
    ?>
    <script language="javascript">
        function filter_data(){
            var catid = jQuery('#catid').attr("value");
            var authorid = jQuery('#authorid').attr("value");
            location.href = ".?com=com_menu&view=item_menu&task=news.choose&lang_code=<?php echo $_GET['lang_code']; ?>&catid=" + catid + "&authorid=" + authorid;
        }
    </script>
                        <form method="post" name="phpForm" id="phpForm">
                            <table>
                                <tbody>
                                    <tr>
                                        <td width="100%"></td>
                                        <td nowrap="nowrap">
                                            <select class="inputbox" size="1" name="catid" id="catid">
                                                <option value=0 selected>- Chọn danh mục sản phẩm -</option>
                                                <?php 
                                                    function category($parentid = 0, $level = 1)
                                                    {
                                                        global $myprocess;                            
                                                        $result = $myprocess->category_multi_level($parentid, $_GET['lang_code']);
                                                        while ($row = $result->fetch())
                                                        {
                                                            echo '<option ';
                                                            if ($row['cat_id'] == intval($_GET["catid"]))
                                                            {
                                                            	echo 'selected="selected" ';
                                                            }

                                                            echo ' value=', $row['cat_id'], '>', str_repeat('&nbsp;&nbsp;|____', $level), $row['title'], '</option>';
                                                            category($row["cat_id"], $level + 1);
                                                        }
                                                    }
                                                    category(0);
                                                ?>
                                            </select>
                                            
                                            <select class="inputbox" size="1" name="authorid" id="authorid">
                                                <option value="0" selected>- Chọn người đăng sản phẩm -</option>
                                                <?php
                                                    $result_author = $myprocess->get_author_list();
                                                    while($row_author = $result_author->fetch()){ ?>
                                                        <option <?php if($row_author['Ac_Id'] == intval($_GET["authorid"])){echo "selected";} ?> value="<?php echo $row_author['Ac_Id'] ?>"><?php echo $row_author['UserName'] . "[". $row_author['fullName'] . "]" ?></option>
                                                <?php } ?>     
                                
                                            </select>
                                            <input onclick="javascript:filter_data();" class="btn" type="button" name="btn_filter" value="Lọc kết quả" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            <table class="adminlist">
                            <thead>
                            
                                <?php 
                                    include("../protected/back_end_paging.php");
                                    
                                    $conditions = array();
                                    
                                    if (isset($_GET["catid"]) && $_GET["catid"] != 0 && is_numeric($_GET["catid"])) {
                                        $conditions['cat_id'] = $_GET["catid"];
                                    }
                                    
                                    if (isset($_GET["authorid"]) && $_GET["authorid"] != 0 && is_numeric($_GET["authorid"])) {
                                        $conditions['author_id'] = $_GET["authorid"];
                                    }
                                    
                                    $result = $myprocess->get_article_view($conditions, $_GET['lang_code']);
                        
                                    $i = 1; $stt = 1; $order_icon = 0;
                                    while($row = $result->fetch()){
                                        if($i == 1 && $row['news_category_group'] != 1){ $order_icon = 1; }
                                        else if($i == $row['news_category_group'] && $row['news_category_group'] != 1){ $order_icon = 2; $i = 0;}
                                        else if($row['news_category_group'] !=1){ $order_icon = 3; }
                                        else { $order_icon = 0; $i = 0;}
                                        
                                        $table_result[] = array(
                                            'stt'=>$stt++, 
                                            'id'=>$row['Id'], 
                                            'alias'=>$row['alias'], 
                                            'cat_title'=>$row['cat_title'],
                                            'news_title'=>$row['product_name'],
                                            'focus'=>$row['hot_product'], 
                                            'num_view'=>$row['num_view'], 
                                            'enabled'=>$row['status'], 
                                            'date_add'=>$row['date_add'], 
                                            'ordering'=>$row['order_num'],
                                            'fullname'=>$row['fullName'],
                                            'order_icon'=>$order_icon,
                                            'category_id'=>$row['book_category_id'],
                                            'Ac_Id'=>$row['Ac_Id']
                                        );
                                        $i++;
                                    }
                                    
                                    /* ---  lay tong so dong du lieu --- */
                                    $news_total_row = count($table_result);
                                
                                    if(!isset($_POST["limit"])) $r = 10; else $r = $_POST["limit"];
                                    if(!isset($_POST["page"])) $p = 1; else $p = $_POST["page"];
                                    $pager = Pager::getPagerData($news_total_row, $r, $p);
                                    $i = 1; 
                                ?>
                                <tr>
                                    <th width="3%"><a href="javascript:void(0)">STT</a></th>
                                    <th class="title" width="3%"><a href="javascript:void(0)">ID</a></th>
                                    <th class="title"><a href="javascript:void(0)">Tên sản phẩm</a></th>
                                    <th width="1%" nowrap="nowrap"><a href="javascript:void(0)">Tiêu điểm</a></th>
                                    <th width="1%" nowrap="nowrap"><a href="javascript:void(0)">Hiển thị</a></th>
                                    <th class="title" width="8%" nowrap="nowrap"><a href="javascript:void(0)">Tác giả</a></th>
                                    <th align="center" width="10"><a href="javascript:void(0)">Ngày thêm</a></th>
                                    <th align="center" width="10"><a href="javascript:void(0)">Lần xem</a></th>
                                    <th width="5" style="display:none"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="13">
                                            <div class="pagination">
                                                Bạn đang xem trang: <?php echo $pager->page ?> của tổng số <?php echo $pager->numPages ?> trang <br>
                                                <?php echo $pager->paging ?> <br>
                                                Hiển thị #
                                                <select name="limit" class="inputbox" size="1" onchange="document.phpForm.submit();">
                                                    <?php 
                                                        for($j = 5; $j <= 100; $j = $j + 5){ 
                                                            if($j == $r){ ?>
                                                                <option value="<?php echo $j ?>" selected><?php echo $j ?></option>
                                                            <?php } else { ?>
                                                                <option value="<?php echo $j ?>"><?php echo $j ?></option>
                                                            <?php }
                                                        }
                                                    ?>
                                                </select>
                                                mẫu tin trên mỗi trang
                                            </div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php 
                                if($news_total_row > 0){
                                foreach($table_result as $k=>$rs) {
                                    if($rs['stt'] > $pager->offset && $rs['stt'] <= $pager->limit){ ?>
                                        <tr class="row<?php if($rs['stt'] % 2 == 0){echo "0";}else{ echo "1";}?>">
                                            <td align="center"><?php echo $rs['stt'] ?></td>
                                            <td align="center"><?php echo $rs['id'] ?></td>
                                            <td>
                                                <div style="padding-bottom:8px;">
                                                	<?php echo $rs['cat_title'] ?>
                                                </div>
                                                <strong>&nbsp;&nbsp;|____ </strong> &nbsp;
                                                <a style="cursor:pointer" onClick="window.parent.jSelectProduct(<?php echo "'" . $rs['category_id'] . "', '" . $rs['alias'] . "/p" . $rs['id'] . "', '" . str_replace("'", "\\'", $rs['news_title']) . "'"; ?>)" href="javascript:void(0)">
                                                    <?php echo $rs['news_title'] ?>
                                                </a>
                                            </td>
                                            <td align="center">
                                            <?php if($rs['focus'] == 1) { ?>
                                                <span class="editlinktip">
                                                    <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','unpublishfocus')">
                                                    <img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
                                                    </a>
                                                </span>
                                            <?php } else if ($rs['focus'] == 0) { ?>            
                                                <span class="editlinktip">
                                                    <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','publishfocus')">
                                                    <img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
                                                    </a>
                                                </span>
                                            <?php }    ?>
                                            </td>
                                            <td align="center">
                                        
                                            <?php if($rs['enabled'] == 1) { ?>
                                                <span class="editlinktip">
                                                    <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','unpublish')">
                                                    <img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
                                                    </a>
                                                </span>
                                            <?php } else if ($rs['enabled'] == 0) { ?>            
                                                <span class="editlinktip">
                                                    <a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','publish')">
                                                    <img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
                                                    </a>
                                                </span>
                                            <?php }    ?>
                                                    
                                            </td>
                                            <td><?php echo $rs['fullname'] ?></td>
                                            <td nowrap="nowrap"><?php echo date('d/m/Y', $rs['date_add']) ?></td>
                                            <td align="center" nowrap="nowrap"><?php echo $rs['num_view'] ?></td>
                                            <td align="center" style="display:none;"><input id="cb<?php echo $rs['stt'] ?>" name="cid[]" value="<?php echo $rs['id'] ?>" onclick="isChecked(this.checked);" type="checkbox"></td>
                                        </tr>
                                <?php 
                                        }
                                    }
                                } ?>
                                </tbody>
                            </table>
                            <input type="hidden" name="page" value="<?php echo $p; ?>">
                            <INPUT type="hidden" value="submit_com_content_news_view" name="hidden">
                            <INPUT type="hidden" value="0" name="boxchecked">
                            <INPUT type="hidden" name="task">
                        </form>
        <noscript>!Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị</noscript>
        
    <?php
}