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
                        <table class="toolbar">
                            <tbody>
                                <tr>
                                    <td class="button" id="toolbar-save">
                                        <a href="#" onclick="javascript: submitbutton('save')" class="toolbar">
                                            <span class="icon-32-save" title="Lưu và thoát">
                                            </span>
                                            Lưu và thoát
                                        </a>
                                    </td>

                                    <td class="button" id="toolbar-apply">
                                        <a href="#" onclick="javascript: submitbutton('apply')" class="toolbar">
                                            <span class="icon-32-apply" title="Lưu">
                                            </span>
                                            Lưu
                                        </a>
                                    </td>

                                    <td class="button" id="toolbar-cancel">
                                        <a href="#" onclick="javascript: submitbutton('cancel')" class="toolbar">
                                            <span class="icon-32-cancel" title="Hủy">
                                            </span>
                                            Hủy
                                        </a>
                                    </td>

                                    <td class="button" id="toolbar-help">
                                        <a href="#" class="toolbar">
                                            <span class="icon-32-help" title="Trợ giúp">
                                            </span>
                                            Trợ giúp
                                        </a>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="header icon-48-gallery">
                    	<?php $__mod = $myprocess->get_module_info($_GET['id'])->fetch(PDO::FETCH_ASSOC); ?>
                        Modules » <small>[Trình diễn ảnh] » <?php $core_class->create_lang_flag($__mod['lang_code'], 24); ?> <?php echo $__mod['title']; ?> » Thêm ảnh</small>
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
                    <script type="text/javascript" src="../myeditor/myfinder/ckfinder.js"></script>
                    <script language="javascript" type="text/javascript">
                        function BrowseServer( inputId )
                        {
                            var finder = new CKFinder() ;
                            finder.StartupPath  = "Image:/image/";
                            finder.selectActionFunction = SetFileField ;
                            finder.selectActionData = inputId ;
                            finder.popup();
                        }
                        
                        // This is a sample function which is called when a file is selected in CKFinder.
                        function SetFileField( fileUrl, data )
                        {
                            document.getElementById( data["selectActionData"] ).value = fileUrl;
                        }
                    </script>
                    <script language="javascript" type="text/javascript">
                        function submitbutton(pressbutton) {
                            var form = document.phpForm;
                            if (pressbutton == 'cancel') {
                                submitform( pressbutton );
                                return;
                            }
                            else if(form.image_file.value == "Chọn hình ảnh cần thêm" || form.image_file.value == "") {
                                alert("Vui lòng chọn hình ảnh cần thêm");
                                form.image_file.focus();
                                return;
                            }
                            else {
                                submitform(pressbutton);
                            }
                        }
                    </script>

                    <form method="post" name="phpForm">
                        <div>
                            <fieldset class="adminform">
                                <legend>Thông tin hình ảnh</legend>
                                <input type="hidden" name="gallery_id" value="<?php echo $_GET['id']; ?>" />
                                <table class="admintable">
                                    <tbody>	
                                        <tr>
                                            <td class="key">
                                                <label for="title">Hình ảnh:</label>
                                            </td>
                                            <td colspan="2">
                                                <div style="float: left;">
                                                    <input style="background: #ffffff;" type="text" id="image_file" name="image_file" value="" size="150" /> 
                                                </div>
                                                <div class="button2-left">
                                                    <div class="blank">
                                                        <a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('image_file');">
                                                            Lựa chọn
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
										 <tr>
                                            <td class="key">
                                                <label for="title">Logo công ty:</label>
                                            </td>
                                            <td colspan="2">
                                                <div style="float: left;">
                                                    <input style="background: #ffffff;" type="text" id="logo_company" name="logo_company" value="" size="150" /> 
                                                </div>
                                                <div class="button2-left">
                                                    <div class="blank">
                                                        <a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('logo_company');">
                                                            Lựa chọn
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
										<tr>
                                            <td class="key">
                                                <label for="title">Tên công ty:</label>
                                            </td>
                                            <td colspan="2">
                                                <div style="float: left;">
                                                    <input style="background: #ffffff;" type="text" id="title_name" name="title_name" value="" size="150" /> 
                                                </div>
                                            </td>
                                        </tr>
										<tr>
                                            <td class="key">
                                                <label for="title">Ghi chú:</label>
                                            </td>
                                            <td colspan="2">
                                                <div style="float: left;">
                                                   <textarea name="description" style=" min-width:600px; max-width:100%;min-height:50px;height:100%;width:100%;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                <label for="title">Liên kết:</label>
                                            </td>
                                            <td colspan="2">
                                                <input style="background: #ffffff;" type="text" name="link" value="" size="150" />
                                                <br />
                                                <p>Nếu hình ảnh không có liên kết, vui lòng để trống mục này</p>
                                            </td>
                                        </tr>
										<tr>
                                            <td class="key">
                                                <label for="title">Target:</label>
                                            </td>
                                            <td colspan="2">
                                                <div style="float: left;">
                                                    <input style="background: #ffffff;" type="text" id="target" name="target" value="" size="150" /> 
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                <label for="date_add">
                                                    Ngày bắt đầu: 
                                                </label>
                                            </td>
                                            <td colspan="2">
                                                <input class="text_area" name="date_start_add" id="date_start_add" value="<?php echo date('d/m/Y')?>" size="15" maxlength="255" title="ngày logo được thêm" type="text" readonly="true">
                                                <script type="text/javascript" src="../calendar/javascript/dhtmlgoodies_calendar.js?random=20060118"></script>
                                                <input type="button" onclick="displayCalendar(document.phpForm.date_start_add,'dd/mm/yyyy',this);" value="Chọn ngày" />
                                            </td>
                                        </tr>
										<tr>
                                            <td class="key">
                                                <label for="date_add">
                                                    Ngày kết thúc: 
                                                </label>
                                            </td>
                                            <td colspan="2">
                                                <input class="text_area" name="date_end_add" id="date_end_add" value="<?php echo date('d/m/Y')?>" size="15" maxlength="255" title="ngày logo được thêm" type="text" readonly="true">
                                                <script type="text/javascript" src="../calendar/javascript/dhtmlgoodies_calendar.js?random=20060118"></script>
                                                <input type="button" onclick="displayCalendar(document.phpForm.date_end_add,'dd/mm/yyyy',this);" value="Chọn ngày" />
                                            </td>
                                        </tr>
										<tr>
                                            <td class="key">
                                                <label for="title">Giá tiền:</label>
                                            </td>
                                            <td colspan="2">
                                                <div style="float: left;">
                                                    <input style="background: #ffffff;" type="text" id="price" name="price" value="Giá tiền" size="150" /> 
                                                </div>
                                            </td>
                                        </tr>
										<tr>
                                            <td class="key">
                                                <label for="title">Liên hệ:</label>
                                            </td>
                                            <td colspan="2">
                                                <div style="float: left;">
                                                     <textarea name="contact_customer" style=" min-width:600px; max-width:100%;min-height:50px;height:100%;width:100%;"></textarea>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">Đã được bật: </td>
                                            <td colspan="2">
                                                <input name="published" id="published0" value="0" class="inputbox" type="radio">
                                                <label for="published0">Không</label>
                                                <input name="published" id="published1" value="1" checked="checked" class="inputbox" type="radio">
                                                <label for="published1">Yes</label>
                                            </td>
                                        </tr>   
																				
                                        <tr>
                                            <td class="key">Thứ tự: </td>
                                            <td colspan="2">
                                                Mặc định các chủ mới ở vị trí trên cùng. Thứ tự có thể thay đổi sau khi chủ đề này được lưu.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key" valign="top" align="right">
                                                    Khi click chuột, mở ra tại: 
                                            </td>
                                            <td>
                                                <select name="browserNav" id="browserNav" class="inputbox" size="3">
                                                    <option value="_self" <?php if($row['target'] == "_self"){ ?>  selected="selected" <?php } ?>>Hiển thị trong cửa sổ đang xem</option>
                                                    <option value="_blank" <?php if($row['target'] == "_blank"){ ?>  selected="selected" <?php } ?>>Hiển thị trong cửa sổ mới</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div class="clr"></div>
                        
                        <input type="hidden" name="hidden" value="submit_com_gallery_detail_add" />
                        <input type="hidden" name="group_type_id" value="<?php echo $_GET["id"]; ?>"/>
                        <input type="hidden" name="task"/>
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