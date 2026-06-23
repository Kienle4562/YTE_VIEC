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

                                <td class="button" id="toolbar-save">
                                    <a href="#" onclick="javascript:submitbutton('save')" class="toolbar">
                                        <span class="icon-32-save" title="Lưu">
                                        </span>
                                        Lưu
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
                    <div class="header icon-48-config">Bố cục website</div>

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
                                    $myprocess = new com_layout_process();

                                    $result_1 = $myprocess->get_components_list();
                                    
                                    $result_layout = $myprocess->get_layout_list();
                                    $layout_list = array();
                                    while ($row = $result_layout->fetch(PDO::FETCH_ASSOC))
                                    {
										$layout_list[] = array(
											'name'	=>	$row['name'],
											'id'	=>	$row['id']
										);
                                    }
                                    
                                    $i = 0;
                                ?>
                                <tr>
                                    <th width="10">STT</th>
                                    <th class="title"><a href="javascript:void(0)">Tên trang</a></th>
                                    <th class="title" style="width:20%"><a href="javascript:void(0)">Bố cục</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($row_1 = $result_1->fetch(PDO::FETCH_ASSOC))
                                    {
                                    	$i++;
	                                    ?>
		                                    <tr class="row0">
		                                        <td align="center">
		                                        	<?php echo $i ?>
		                                        	<input type="hidden" name="component_key[<?php echo $i; ?>]" value="<?php echo $row_1['component_key']; ?>" />
		                                        </td>
		                                        <td>
		                                            <?php echo $row_1['component_title']; ?>
		                                        </td>
		                                        <td align="center">
		                                        	<?php // echo $row['layout_id']; ?>
		                                        	<select name="layout_id[<?php echo $i; ?>]">
		                                            <?php
		                                            	foreach ($layout_list as $item)
		                                            	{
															?>
															<option <?php
																	if ($row_1['layout_id'] == $item['id']) {
																		echo "selected=\"selected\"";
																	}
																?> value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
															<?php
		                                            	}
		                                            ?>
		                                            </select>
		                                        </td>
		                                    </tr>
	                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <input type="hidden" value="submit_com_layout_view_list" name="hidden">
                        <input type="hidden" name="task">
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