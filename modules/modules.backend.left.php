<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); ?>

    <style type="text/css">
        .backend_link {
            display: block;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            width: 250px;
            margin: 0 auto;
            border: solid 1px #ddd;
            background: #f9f9f9;
            padding: 10px 5px;
            margin-top: 5px;
        }
    </style>

    <fieldset class="adminform">
        <legend>Thông tin chức năng</legend>

        <table class="admintable" cellspacing="1">
            <tbody>
                <tr>
                    <td class="key">
                        <label for="title">
                            Tiêu đề chức năng:
                        </label>
                    </td>
                    <td>
                        <input class="text_area" type="text" name="title" id="title" size="35" value="<?php echo $row_detail["title"]; ?>">                                        
                    </td>
                    <td>
                        <span class="editlinktip hasTip" title="Tiêu đề chức năng::Tiêu đề text hiển thị chức năng"><a href="javascript:void(0);"> Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" /></a></span>
                    </td>
                </tr>
                <tr>
                    <td width="100" class="key">
                        Show tiêu đề chức năng:
                    </td>
                    <td>
                        <input type="radio" name="showtitle" id="showtitle0" value="0" class="inputbox" <?php if($row_detail["showtitle"] == 0) { echo 'checked="checked"'; } ?>>
                        <label for="showtitle0">Không</label>
                        <input type="radio" name="showtitle" id="showtitle1" value="1" class="inputbox" <?php if($row_detail["showtitle"] == 1) { echo 'checked="checked"'; } ?>>
                        <label for="showtitle1">Có</label>
                    </td>
                    <td>
                        <span class="editlinktip hasTip" title="Hiển thị text trên tiêu đề::Lựa chọn cho phép text tiêu để được hiển thị hay không"><a href="javascript:void(0);"> Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" /></a></span>
                    </td>
                        
                </tr>
                <tr>
                    <td valign="top" class="key">
                        Hiển thị chức năng:
                    </td>
                    <td>
                        <input type="radio" name="enabled" id="enabled0" value="0" class="inputbox" <?php if($row_detail["enabled"] == 0) { echo 'checked="checked"'; } ?>>
                        <label for="enabled0">Không</label>
                        <input type="radio" name="enabled" id="enabled1" value="1" class="inputbox" <?php if($row_detail["enabled"] == 1) { echo 'checked="checked"'; } ?>>
                        <label for="enabled1">Có</label>
                    </td>
                    <td>
                        <span class="editlinktip hasTip" title="Hiển thị chức năng::Lựa chọn cho phép chức năng có được hiển thị hay không"><a href="javascript:void(0);"> Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" /></a></span>
                    </td>
                </tr>                                                                                    
            </tbody>
        </table>
    </fieldset>
    
    <fieldset class="adminform">
        <legend>Danh sách Menu được chọn liên kết</legend>
        <script type="text/javascript">
            function allselections() {
                var e = document.getElementById('selections');
                    e.disabled = true;
                var i = 0;
                var n = e.options.length;
                for (i = 0; i < n; i++) {
                    e.options[i].disabled = true;
                    e.options[i].selected = true;
                }
            }
            function disableselections() {
                var e = document.getElementById('selections');
                    e.disabled = true;
                var i = 0;
                var n = e.options.length;
                for (i = 0; i < n; i++) {
                    e.options[i].disabled = true;
                    e.options[i].selected = false;
                }
            }
            function enableselections() {
                var e = document.getElementById('selections');
                    e.disabled = false;
                var i = 0;
                var n = e.options.length;
                for (i = 0; i < n; i++) {
                    e.options[i].disabled = false;
                }
            }
        </script>
        <table class="admintable" cellspacing="1">
            <tbody>
                <tr>
                    <td valign="top" class="key">
                        Menus:
                    </td>
                    <td>
                        <label for="menus-all"><input id="menus-all" type="radio" name="menus" value="all" onclick="allselections();" <?php if($row_detail["menu_id"] == "all") { echo 'checked="checked"'; } ?>>Tất cả</label>
                        <label for="menus-select"><input id="menus-select" type="radio" name="menus" value="select" onclick="enableselections();" <?php if($row_detail["menu_id"] != "all") { echo 'checked="checked"'; } ?>>Chọn Menu Item(s) từ danh sách</label>
                        <br />
                        <label for="menus-not-select"><input id="menus-not-select" type="radio" name="menus" value="not-select" onclick="enableselections();" <?php if(substr($row_detail["menu_id"], 0, 1) == "-") { echo 'checked="checked"'; } ?>>Không hiển thị tại những menu dưới đây</label>
                    </td>
                </tr>
                <tr>
                    <td valign="top" class="key">
                        Chọn Menu:
                    </td>
                    <td>                                                                                
                        <select name="selections[]" id="selections" class="inputbox" size="15" multiple="multiple" disabled="">
                            <?php
                            function menu($parentid = 0, $menu_type_id, $menu_id, $space = '&nbsp;&nbsp;&nbsp;|_ _ _ ', &$html = ''){
                                $myprocess = new modules_models();
                                $result = $myprocess->list_menu($parentid, $menu_type_id);
                                while($row = $result->fetch()){
                                
                                    if(core_class::_checkIdinArray($row["Id"], $menu_id)){
                                        $html .= '<option selected="selected" value="'.$row['Id'].'">'. $space . $row['title'].'</option>';
                                    } else {
                                        $html .= '<option value="'.$row['Id'].'">'. $space . $row['title'].'</option>';
                                    }
                                    menu($row["Id"], $menu_type_id, $menu_id, $space.'&nbsp;|_ _ _&nbsp;', $html);
                                    
                                }                
                                return $html;
                            }

                            $result = $myprocess->get_group_menu(); 
                            while($row = $result->fetch()){ ?>
                            <optgroup label="<?php echo $row["title"]; ?>">
                                <?php
                                    echo menu(0, $row["group_menu_id"], $row_detail["menu_id"]);
                                ?>
                            </optgroup>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <script type="text/javascript">
            <?php 
                if ($row_detail["menu_id"] == "all") { 
                    echo 'allselections();'; 
                }
                else {
                    echo 'enableselections();';
                }
            ?>
        </script>
    </fieldset>
    <fieldset class="adminform">
        <legend>Tùy chọn chức năng</legend>
        <style type="text/css">
            #divAddModule div {
                padding: 5px;
            }
            div.moduleDescription {
                float: left;
                width: 240px;
                border: solid 1px #B8CCE4;
                background: #DAEEF3;
                min-height: 145px;
            }
            table.description {
                border-collapse: collapse;
                display: table;
                border-spacing: 2px;
                border-color: gray;
                width:100%;
            }
            table.description td {
                padding: 10px 20px;
                border: solid 2px gray;
                text-align: center;
            }
        </style>
        <table class="admintable" cellspacing="1">
            <tbody>
                <tr>
                    <td valign="top" class="key">
                        Vị trí xuất hiện:
                    </td>
                    <td>
                        <select name="position" id="combobox-position-select" style="width:240px;">
                            <option value="0"> --- Chọn vị trí --- </option>
                            <?php 
                            $result = $myprocess->get_position(); 
                            while ($row = $result->fetch()) {
                                if ($row['module_position_id'] == $row_detail['position']) {
                                    ?>
                                    <option value="<?php echo $row["module_position_id"]; ?>" selected="selected"><?php echo $row["position_name"]; ?></option>
                                    <?php
                                }
                                else {
                                    ?>
                                    <option value="<?php echo $row["module_position_id"]; ?>"><?php echo $row["position_name"]; ?></option>
                                    <?php
                                }
                            } ?>
                        </select>
                    </td>
                    <td>                                        
                        <span class="editlinktip hasTip" title="Vị trí xuất hiện::Vị trí chức năng sẽ xuất hiện trên giao diện trang chủ frontend"><a href="javascript:void(0);"> Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" /></a></span>
                    </td>
                </tr>
                <tr>
                    <td valign="top" class="key">&nbsp;</td>
                    <td>
                        <table class="description" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <div id="position_top">Trên cùng</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div id="position_menu">Menu chức năng</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="position_left">Trái</div>
                                    </td>
                                    <td>
                                        <div id="position_center">Giữa</div>
                                    </td>
                                    <td>
                                        <div id="position_right">Phải</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div id="position_bottom">Dưới cùng</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>                                
                    </td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </fieldset>