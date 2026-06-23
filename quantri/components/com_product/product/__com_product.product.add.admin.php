<?php defined( '_VALID_MOS' ) or die( include("404.php") );
    if ($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator"){ 
        // bat dau thuc thi voi quyen Supper Administrator va Administrator
    ?>
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
                                            <a href="javascript:addTabs()" class="toolbar">
                                                <span class="icon-32-new" title="Thêm nội dung">
                                                </span>
                                                Thêm nội dung
                                            </a>
                                        </td>

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

                                    </tr></tbody></table>
                        </div>
                        <div class="header icon-48-sections">Sản phẩm: <small>[ Thêm mới ]</small></div>

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
                        <script type="text/javascript" src="javascript/jquery-ui/jquery-ui-1.8.23.custom.min.js"></script>
                        <link rel="stylesheet" href="javascript/jquery-ui/css/cupertino/jquery-ui-1.8.23.custom.css" type="text/css" media="all" />
                        
                        <script language="javascript" type="text/javascript">
                            
                            var tabCount = 0;
                            
                            function submitbutton(pressbutton)
                            {
                                var form = document.phpForm;
                                if (pressbutton == 'cancel') {
                                    submitform( pressbutton );
                                    return;
                                }
                                if(form.product_code.value == ""){
                                    alert("Vui lòng nhập mã sản phẩm");
                                    form.product_code.focus();
                                    return;
                                } else if(form.product_name.value == ""){
                                    alert("Vui lòng nhập tên sản phẩm");
                                    form.product_name.focus();
                                    return;
                                } else if(form.catid.value == "0"){
                                    alert("Vui lòng chọn danh mục sản phẩm");
                                    form.catid.focus();
                                    return;
                                } else if(form.image_file.value == 0){
                                    alert("Vui lòng chọn hình ảnh sản phẩm");
                                    form.image_file.focus();
                                    return;
                                } else if(form.product_price.value < 0){
                                    alert("Vui lòng nhập giá sản phẩm");
                                    form.product_price.focus();
                                    return;
                                } else if(!CheckNumber(form.product_price.value)){
                                    alert("Giá sản phẩm phải là kiểu số, VD: 1230000");
                                    form.product_price.focus();
                                    return;
                                } else {
                                    if(form.alias.value == ''){
                                        form.alias.value = form.product_name.value;					
                                    }
                                    submitform(pressbutton);
                                }						

                            }

                            function CheckProductName(stringIn) 
                            {
                                if ((stringIn.indexOf("@") >= 0)||(stringIn.indexOf("<") >= 0)||(stringIn.indexOf(">") >= 0)||(stringIn.indexOf("!") >= 0)||(stringIn.indexOf("$") >= 0)||(stringIn.indexOf("%") >= 0)||(stringIn.indexOf("(") >= 0)||(stringIn.indexOf(")") >= 0)||(stringIn.indexOf("=") >= 0)||(stringIn.indexOf("#") >= 0)||(stringIn.indexOf("{") >= 0)||(stringIn.indexOf("}") >= 0)||(stringIn.indexOf("[") >= 0)||(stringIn.indexOf("]") >= 0)||(stringIn.indexOf("|") >= 0)||(stringIn.indexOf('"') >= 0) ||(stringIn.indexOf(".") >= 0) ||(stringIn.indexOf("?") >= 0) ||(stringIn.indexOf(",") >= 0) ||(stringIn.indexOf("+") >= 0) ||(stringIn.indexOf("&") >= 0) ||(stringIn.indexOf("\\") >= 0) ||(stringIn.indexOf("/") >= 0) ||(stringIn.indexOf("*") >= 0) ||(stringIn.indexOf("`") >= 0) ||(stringIn.indexOf("~") >= 0) ||(stringIn.indexOf("^") >= 0))
                                {
                                    return false;
                                }
                                return true;
                            }

                            function CheckNumber(str)
                            {
                                var pattern = "0123456789";
                                if (str.length > 0) {
                                    if (str.length < 1) {
                                        return false;
                                    } else {
                                        for (var a=0; a<pattern.length; a++) {
                                            if (pattern.indexOf(str.charAt(a),0) == -1) return false;
                                        }
                                    }
                                }
                                return true;	
                            }
                            
                            function addTabs()
                            {
                                jQuery("#tabs").tabs("add", "#new" + tabCount, "Nội dung " + (tabCount + 1));
                                CKEDITOR.replace('html_tab_' + tabCount);
                                tabCount++;
                            }
                            
                            function deleteCurrentTab()
                            {
                                var currentTabIndex = jQuery("#tabs").tabs("option", "selected");
                                
                                if (currentTabIndex > 0)
                                {
                                    if (confirm('Bạn có chắc chắn muốn xoá nội dung này không?')) {
                                        jQuery("#tabs").tabs("remove", currentTabIndex);
                                    }
                                }
                            }

                            function BrowseServer( inputId )
                            {
                                var finder = new CKFinder() ;
                                finder.StartupPath  = "Product:/product/";
                                finder.selectActionFunction = SetFileField ;
                                finder.selectActionData = inputId ;
                                finder.popup();
                            }
                            
                            function SetFileField( fileUrl, data )
                            {
                                document.getElementById( data["selectActionData"] ).value = fileUrl;
                            }

                            jQuery(function() {
                                jQuery("#tabs").tabs({
                                    add: function(event, ui) {
                                        jQuery(ui.panel).append('\
                                            <fieldset class="phpForm">\
                                                <legend>Thông tin sản phẩm</legend>\
                                                <table class="admintable" width="100%">\
                                                    <tbody>\
                                                        <tr>\
                                                            <td class="key" nowrap="nowrap">\
                                                                <label for="link">\
                                                                    Tiêu đề:\
                                                                </label>\
                                                            </td>\
                                                            <td colspan="2">\
                                                                <input class="text_area" name="html_tab_title[' + tabCount + ']" value="" size="80" maxlength="100" title="Tiêu đề thông tin" type="text">\
                                                                <a href="javascript:deleteCurrentTab()" class="deleteTab">Xoá thông tin này</a>\
                                                            </td>\
                                                        </tr>\
                                                        <tr>\
                                                            <td class="key" nowrap="nowrap">\
                                                                <label for="link">\
                                                                    Nội dung:\
                                                                </label>\
                                                            </td>\
                                                            <td colspan="2">\
                                                                <textarea name="html_tabs[' + tabCount + ']" id="html_tab_' + tabCount + '"></textarea>\
                                                            </td>\
                                                        </tr>\
                                                        <tr>\
                                                            <td class="key" nowrap="nowrap">\
                                                                <label for="link">\
                                                                    Cho phép hiển thị:\
                                                                </label>\
                                                            </td>\
                                                            <td colspan="2">\
                                                                <input name="html_tab_active[' + tabCount + ']" value="0" class="inputbox" type="radio">\
                                                                <label>Không cho phép</label>\
                                                                <input name="html_tab_active[' + tabCount + ']" value="1" checked="checked" class="inputbox" type="radio">\
                                                                <label>Cho phép</label>\
                                                            </td>\
                                                        </tr>\
                                                    </tbody>\
                                                </table>\
                                            </fieldset>');
                                    }
                                });
                            });
                        </script>
                        
                        <style type="text/css">
                            .deleteTab {
                                float: right;
                                padding: 5px 10px;
                                background: #aa0000;
                                color: #fff !important;
                            }
                        </style>

                        <form method="post" name="phpForm">
                        
                            <div id="tabs">
                                <ul>
                                    <li><a href="#info-main">Thông tin chung</a></li>
                                    <?php /* <li><a href="#html-detail">Chi tiết sản phẩm</a></li> */ ?>
                                </ul>
                                
                                <div id="info-main">
                                    <fieldset class="phpForm">
                                        <legend>Thông tin sản phẩm </legend>

                                        <table class="admintable" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td class="key" width="100">Phạm vi:</td>
                                                    <td colspan="2"><strong>Chi tiết thông tin sản phẩm </strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Mã sản phẩm: <font color="red">(*)</font>
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="product_code" id="product_code" value="" size="20" maxlength="10" title="Mã sản phẩm" type="text"> <strong>VD: SP001</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Tên sản phẩm: <font color="red">(*)</font>
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="product_name" id="product_name" value="" size="50" maxlength="255" title="Tên sản phẩm" type="text">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Định danh:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="alias" id="alias" value="" size="50" maxlength="255" title="Tên sản phẩm" type="text">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Danh mục sản phẩm: <font color="red">(*)</font>
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <SELECT class="inputbox" size="1" name="catid" id="catid" style="width:215px; ">
                                                            <option id="0" value="0" selected>- Chọn Danh mục -</option>"
                                                            <?php 
                                                                function category($parentid = 0, $level = 0)
                                                                {
                                                                    $myprocess = new process();
                                                                    $result = $myprocess->category_multi_level($parentid, 'vi');
                                                                    while ($row = $result->fetch())
                                                                    {                                                    
                                                                        echo '<option value=', $row['cat_id'], '>', str_repeat('&nbsp;&nbsp;|____', $level), $row['title'], '</option>';
                                                                        category($row["cat_id"], $level + 1);
                                                                    }
                                                                }
                                                                category(0);
                                                            ?>
                                                        </SELECT>
                                                    </td>
                                                </tr>				
                                                <tr>
                                                    <td class="key">
                                                        <label for="title">Hình ảnh:</label> <font color="red">(*)</font></td>
                                                    <td colspan="2">
                                                        <!--
                                                        <div style="float: left;">
                                                        <input style="background: #ffffff;" type="text" id="image_file" name="image_file" value="Chọn file hình ảnh cần thêm .. " size="50" />
                                                        </div>
                                                        <div class="button2-left">
                                                        <div class="blank">
                                                        <a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('image_file');">Lựa chọn</a>
                                                        </div>
                                                        </div>
                                                        -->

                                                        <input style="width:250px;" type="text" id="image_file" name="image_file[]" value="Chọn file hình ảnh cần thêm .. ">
                                                        <input type="hidden" id="image_id" name="image_id[]" />
                                                        &nbsp;<a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('image_file');"> + Lựa chọn + </a>
                                                        &nbsp;&nbsp;&nbsp;<img src="templates/mt24h_admin/images/icons/plus_icon.gif" alt="" border="0" width="13" height="13"> 
                                                        <a href="javascript:void(0);" onclick="addImage('tblInnerHTML_img');return false;">Thêm hình ảnh</a>
                                                        <table id="tblInnerHTML_img" style="margin-top:5px;" cellpadding="0" cellspacing="0" border="0" width="100%"> 
                                                            <tbody></tbody>
                                                        </table>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key">
                                                        <label for="date_add">
                                                            Thời gian bảo hành:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="author" id="author" size="50" maxlength="255" title="thời gian bảo hành" type="text">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Bộ bán sản phẩm:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="attach_info" id="attach_info" size="50" maxlength="255" title="Thông tin thêm về sản phẩm" type="text">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Chất lượng:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="quality" id="quality" size="50" maxlength="255" title="chất lượng sản phẩm" type="text">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Xuất xứ:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="origin" id="origin" size="50" maxlength="255" title="xuất xứ sản phẩm" type="text">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Phí vận chuyển:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="shipping_costs" id="shipping_costs" size="50" maxlength="255" title="Phí vận chuyển" type="text"> VNĐ
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Giá sản phẩm: <font color="red">(*)</font>
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="product_price" id="product_price" value="" size="50" maxlength="255" title="Giá sản phẩm" type="text">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Loại giảm giá:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="discounts" id="discounts" size="30" maxlength="10" title="Tỉ lệ giảm giá" type="text">
                                                        <SELECT class="inputbox" size="1" name="discount_type">
                                                            <OPTION value="0" selected> - Số tiền - </OPTION>
                                                            <OPTION value="1" selected> - % - </OPTION>
                                                        </SELECT>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Thuộc tính khác:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">

                                                        <table cellpadding="0" cellspacing="0" border="0">
                                                            <tr><td>
                                                                    <div id="content_Language" class="none">
                                                                        <div class="box_frm">
                                                                            <label class="key"> Tên: <input class="text_area" name="properties_name[]" id="properties_name" value="" size="40" maxlength="255" title="Tỉ lệ giảm giá" type="text"></label>
                                                                            <label class="key"> Giá trị: <input class="text_area" name="properties_value[]" id="properties_value" value="" size="40" maxlength="255" title="Tỉ lệ giảm giá" type="text"></label>
                                                                            <img src="../templates/default/images/icons/job_icon_add_13x13.gif" alt="" border="0" width="13" height="13"> 
                                                                            <a href="javascript:void(0);" onclick="addLanguage('tblInnerHTML');return false;">Thêm thuộc tính</a>
                                                                        </div>										
                                                                    </div>
                                                                </td></tr>
                                                            <tr><td>
                                                                    <table id="tblInnerHTML" style="margin-top:0px;" cellpadding="0" cellspacing="3" border="0"> 
                                                                        <tbody></tbody>
                                                                    </table>
                                                                </td></tr>
                                                        </table>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Mô tả sản phẩm:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <script type="text/javascript" src="../myeditor/ckeditor.js"></script>
                                                        <textarea name="html_description"></textarea>
                                                        <script type="text/javascript">
                                                            //CKEDITOR.replace( 'html_description' );
															CKEDITOR.replace( 'html_description' , {height : '500px', toolbar : 'Full'});
                                                        </script>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key">
                                                        Sản phẩm nổi bật
                                                    </td>
                                                    <td colspan="2">
                                                        <input name="hot_product" id="hot_product0" value="0" checked="checked" class="inputbox" type="radio">
                                                        <label for="hot_product0">Không</label>
                                                        <input name="hot_product" id="hot_product1" value="1" class="inputbox" type="radio">
                                                        <label for="hot_product1">Chọn</label>
                                                    </td>
                                                </tr>			
                                                <tr>
                                                    <td class="key">
                                                        Cho phép hiển thị:
                                                    </td>
                                                    <td colspan="2">
                                                        <input name="published" id="published0" value="0" class="inputbox" type="radio">
                                                        <label for="published0">Không cho phép</label>
                                                        <input name="published" id="published1" value="1" checked="checked" class="inputbox" type="radio">
                                                        <label for="published1">Cho phép</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key">
                                                        Trạng thái kho: 
                                                    </td>
                                                    <td colspan="2">
                                                        <input name="cheked_product" id="cheked_product0" value="0" class="inputbox" type="radio">
                                                        <label for="cheked_product0">hết hàng</label>
                                                        <input name="cheked_product" id="cheked_product1" value="1" checked="checked" class="inputbox" type="radio">
                                                        <label for="cheked_product1">Còn hàng</label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="key">
                                                        Cho phép bình luận: 
                                                    </td>
                                                    <td colspan="2">
                                                        <input name="show_comment" id="show_comment" value="1" checked="checked" class="inputbox" type="radio">
                                                        <label for="show_comment">Cho phép</label>
                                                        <input name="show_comment" id="dont_show_comment" value="0" class="inputbox" type="radio">
                                                        <label for="dont_show_comment">Không cho phép</label>
                                                    </td>
                                                </tr>			
                                                <tr>
                                                    <td class="key">
                                                        <label for="date_add">
                                                            Ngày thêm sản phẩm: 
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <input class="text_area" name="date_add" id="date_add" value="<?php echo date('d/m/Y')?>" size="15" maxlength="255" title="ngày logo được thêm" type="text" readonly="true">
                                                        <script type="text/javascript" src="../calendar/javascript/dhtmlgoodies_calendar.js?random=20060118"></script>
                                                        <img src="../calendar/images/calendar.gif" class="mar_img" align="top" onClick="displayCalendar(document.phpForm.date_add,'dd/mm/yyyy',this);"  />
                                                    </td>
                                                </tr>				
                                                <tr>
                                                    <td class="key">
                                                        <label for="date_add">
                                                            Từ khoá: 
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <textarea class="text_area" name="keyword" id="keyword" cols="60" rows="5"></textarea>
                                                    </td>
                                                </tr>                
                                                <tr>
                                                    <td class="key">
                                                        <label for="ordering">
                                                            Thứ tự:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        Mặc định các chủ mới ở vị trí trên cùng. Thứ tự có thể thay đổi sau khi chủ đề này được lưu.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div>
                                
                                <?php /* <div id="html-detail">
                                    <fieldset class="phpForm">
                                        <legend>Thông tin sản phẩm </legend>

                                        <table class="admintable" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td class="key" nowrap="nowrap">
                                                        <label for="link">
                                                            Thông tin chi tiết:
                                                        </label>
                                                    </td>
                                                    <td colspan="2">
                                                        <textarea name="html_content"></textarea>
                                                        <script type="text/javascript">
                                                            CKEDITOR.replace( 'html_content' );
                                                        </script>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </fieldset>
                                </div> */ ?>
                            </div>

                            <div class="clr"></div>

                            <span id="tab_temp" style="display:none">
                                <span id="tab_skill_language_source">

                                    <label class="key"> Tên: <input class="text_area" name="properties_name[]" id="properties_name" value="" size="40" maxlength="255" title="Tỉ lệ giảm giá" type="text"></label>
                                    <label class="key"> Giá trị: <input class="text_area" name="properties_value[]" id="properties_value" value="" size="40" maxlength="255" title="Tỉ lệ giảm giá" type="text"></label>

                                </span>
                            </span>
                            <input type="hidden" id="id_id" name="manufacturer_id" value="13" />
                            <input type="hidden" name="hidden" value="submit_com_product_add" />
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
    <?php } ?>	

<script language="javascript">
    /* add image */
    var intRowActive = 0;
    var intRowActive_img = 0;

    function addImage(tblId)
    {
        if(document.phpForm.image_id.length >= 20 && document.phpForm.image_id.length != 30)
            {
            return false;
        }

        var str = '<input type="text" id="image_file'+ intRowActive_img +'" name="image_file[]" value="Chọn file hình ảnh cần thêm .. " style="width:250px;" /><input type="hidden" id="image_id" name="image_id[]" />&nbsp;<a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('+"'image_file"+intRowActive_img+"'"+');"> + Lựa chọn + </a>';

        var tblBody = document.getElementById(tblId).tBodies[0];
        var newRow = tblBody.insertRow(-1);
        var newCell0 = newRow.insertCell(0);
        str += " &nbsp;&nbsp;&nbsp; <a href='javascript:void(0);' onClick=\"removeRowFromTable('" + tblId + "',"+intRowActive_img+");return false;\"> <img src=\"templates/mt24h_admin/images/icons/job_icon_delete_12x12.gif\" alt=\"\" width=\"13\" height=\"13\" border=\"0\" /> Xóa</a>";
        newCell0.innerHTML = '<div style="margin-top:10px;">' + trim(str) + '<div>';
        intRowActive_img++;
    }
    function removeRowFromTable(tblId,intDelRow)
    {
        if (navigator.appName == "Microsoft Internet Explorer"){
            intVersion = 0;
        } else {
            intVersion = 1;
        }
        var tblBody = document.getElementById(tblId).tBodies[0];
        if(intVersion == 0)
            {
            tblBody.rows[intDelRow].innerText = "";
        }
        else
            {
            tblBody.rows[intDelRow].innerHTML = "";
        }
        tblBody.rows[intDelRow].style.display = "none";
    }

    function addLanguage(tblId)
    {
        if(document.phpForm.properties_value.length > 10 && document.phpForm.properties_value.length != 20)
            {
            return false;
        }

        var tblBody = document.getElementById(tblId).tBodies[0];
        var newRow = tblBody.insertRow(-1);
        var newCell0 = newRow.insertCell(0);
        newCell0.innerHTML = trim(document.getElementById('tab_skill_language_source').innerHTML) + " <img src=\"../templates/default/images/icons/job_icon_delete_12x12.gif\" alt=\"\" width=\"13\" height=\"13\" border=\"0\" /> <a href='javascript:void(0);' onClick=\"removeRowFromTable('" + tblId + "',"+intRowActive+");return false;\">Xóa</a>";
        intRowActive ++;
    }
    function removeRowFromTable(tblId,intDelRow)
    {
        if (navigator.appName == "Microsoft Internet Explorer"){
            intVersion = 0;
        } else {
            intVersion = 1;
        }
        var tblBody = document.getElementById(tblId).tBodies[0];
        if(intVersion == 0)
            {
            tblBody.rows[intDelRow].innerText = "";
        }
        else
            {
            tblBody.rows[intDelRow].innerHTML = "";
        }
        tblBody.rows[intDelRow].style.display = "none";
    }
</script>
<?php
    if (!empty($_SESSION['msg']))
    {
    ?>
    <script language="javascript">
        alert('<?php echo $_SESSION['msg']; ?>');
    </script>
    <?php
        $_SESSION['msg'] = '';
    }
?>