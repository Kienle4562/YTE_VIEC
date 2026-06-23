<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 

    include_once("mod_menu_3.models.php");
    include_once("mod_menu_3.handler.php");
    $myprocess = new process_menu_3();

    $result = $myprocess->get_module_edit(intval($url[1]));
    
    if ($row_detail = $result->fetch())
    {
        if (empty($row_detail["params"]) || $row_detail["params"] == "undefine") {
            $params = array(
                'menu_type_id' => 0,
                'max_level' => 0,
                'class' => '',
                'show_icon' => FALSE
            );
        }
        else {
            $params = unserialize($row_detail["params"]);
        }
        
        if (empty($params['show_icon'])) {
			$params['show_icon'] = FALSE;
        }
        
        ?>
        
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
                                        <td class="button" id="toolbar-save">
                                            <a href="#" onclick="javascript: submitbutton('save')" class="toolbar">
                                                <span class="icon-32-save" title="Lưu và thoát"></span> Lưu lại
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
                        <div class="header icon-48-sections">
                            Modules » <small>[Menu] » Chỉnh sửa module</small>
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
                
                <?php if(isset($_SESSION["sys_message"]["error"])) { ?>
                <div id="toolbar-box">
                    <div class="t"><div class="t"><div class="t"></div></div></div>
                    <div class="m">
                        <div style="text-align:center;font-size:18px;color:#FF0000;"><?php echo $_SESSION["sys_message"]["error"]; ?></div>
                    </div>
                    <div class="b"><div class="b"><div class="b"></div></div></div>
                </div>
                <?php unset($_SESSION["sys_message"]["error"]); } ?>
                
                <div id="element-box">
                    <div class="t">
                        <div class="t">
                            <div class="t"></div>
                        </div>
                    </div>
                    <div class="m">
                        <script language="javascript" type="text/javascript">
                            //<!--    
                            function submitbutton(pressbutton)
                            {
                                var form = document.phpForm;
                                if (pressbutton == 'cancel') {
                                    submitform( pressbutton );
                                    return;
                                }
                                
                                if (form.title.value == ""){
                                    alert("Vui lòng nhập tiêu đề module");
                                    form.title.focus();
                                    return;
                                } else {                            
                                    submitform(pressbutton);
                                }
                            }
                            //-->
                        </script>
                        <form method="post" name="phpForm" action="">
                            <div class="col width-50">
                                <?php include('modules/modules.backend.left.php'); ?>
                            </div>
                    
                            <div class="col width-50">
                                <fieldset class="adminform">
                                    <legend>Cấu hình</legend>
                                    <table class="admintable" width="100%">
                                        <tbody id="phone_container">
                                            <tr>
                                                <td class="key">
                                                    Hiển thị menu
                                                </td>
                                                <td>
                                                    <select name="menu_type_id">
                                                        <option value="0">--Chọn menu để hiển thị--</option>
                                                        <?php
                                                            $result = $myprocess->get_menu_type_list($row_detail['lang_code']);
                                                            
                                                            while ($row = $result->fetch(PDO::FETCH_ASSOC))
                                                            {
                                                                if ($row['id'] == $params['menu_type_id'])
                                                                {
                                                                    ?><option value="<?php echo $row['id']; ?>" selected="selected"><?php echo $row['title']; ?></option><?php
                                                                }
                                                                else
                                                                {
                                                                    ?><option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option><?php
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key">
                                                    Cấp độ tối đa
                                                </td>
                                                <td>
                                                    <input type="text" name="max_level" value="<?php echo $params['max_level']; ?>" />
                                                    <span class="editlinktip hasTip" title="Cấp độ tối đa::+ Nhập vào 0 nếu bạn muốn hiển thị tất cả các menu con.<br />+ Nếu nhập vào số lớn hơn 0 thì những menu con có cấp độ nhỏ hơn hoặc bằng giá trị này sẽ hiển thị.">
                                                        <a href="javascript:void(0);">
                                                            Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" />
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key">
                                                    CSS Class
                                                </td>
                                                <td>
                                                    <input type="text" name="class" value="<?php echo $params['class']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key">
                                                    Hiển thị biểu tượng
                                                </td>
                                                <td>
                                                    <?php if ($params['show_icon'] == TRUE) { ?>
                                                    	<input type="radio" id="show_icon_1" name="show_icon" value="0" />
                                                    	<label for="show_icon_1">Không hiển thị</label>
                                                    	<input type="radio" id="show_icon_2" name="show_icon" value="1" checked="" />
                                                    	<label for="show_icon_2">Hiển thị biểu tượng</label>
                                                    <?php } else { ?>
                                                    	<input type="radio" id="show_icon_1" name="show_icon" value="0" checked="" />
                                                    	<label for="show_icon_1">Không hiển thị</label>
                                                    	<input type="radio" id="show_icon_2" name="show_icon" value="1" />
                                                    	<label for="show_icon_2">Hiển thị biểu tượng</label>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                            <div class="clr"></div>            
                            <input type="hidden" name="hidden" value="submit_mod_menu_3" />
                            <input type="hidden" name="module_id" value="<?php echo $url[1]; ?>" />
                            <input type="hidden" name="task" value="" />
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
        <?php
    }