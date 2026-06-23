<?php defined( '_VALID_MOS' ) or die( include("404.php") );
if($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator"){ 
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
                    <table class="toolbar"><tbody><tr>
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
                <div class="header icon-48-sections">Sản phẩm: <small>[ Sao chép ]</small></div>

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
        <script language="javascript" type="text/javascript">
        
        <?php $myProcess = new process(); ?>
        
        function submitbutton(pressbutton) {
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
                alert("Vui lòng chọn logo file cần upload");
                form.image_file.focus();
                return;
            } else if(form.product_price.value == 0){
                alert("Vui lòng nhập giá sản phẩm");
                form.product_price.focus();
                return;
            } else if(!CheckNumber(form.product_price.value)){
                alert("Giá sản phẩm phải là kiểu số");
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
            if ((stringIn.indexOf("@") >= 0)||(stringIn.indexOf("<") >= 0)||(stringIn.indexOf(">") >= 0)||(stringIn.indexOf("!") >= 0)||(stringIn.indexOf("$") >= 0)||(stringIn.indexOf("%") >= 0)||(stringIn.indexOf("(") >= 0)||(stringIn.indexOf(")") >= 0)||(stringIn.indexOf("=") >= 0)||(stringIn.indexOf("#") >= 0)||(stringIn.indexOf("{") >= 0)||(stringIn.indexOf("}") >= 0)||(stringIn.indexOf("[") >= 0)||(stringIn.indexOf("]") >= 0)||(stringIn.indexOf("|") >= 0)||(stringIn.indexOf('"') >= 0) ||(stringIn.indexOf(".") >= 0) ||(stringIn.indexOf("?") >= 0) ||(stringIn.indexOf(",") >= 0) ||(stringIn.indexOf("+") >= 0) ||(stringIn.indexOf("&") >= 0) ||(stringIn.indexOf("\\") >= 0) ||(stringIn.indexOf("/") >= 0) ||(stringIn.indexOf("*") >= 0) ||(stringIn.indexOf("`") >= 0) ||(stringIn.indexOf("~") >= 0) ||(stringIn.indexOf("^") >= 0) ||(stringIn.indexOf("-") >= 0)||(stringIn.indexOf("_") >= 0))
            {
                return false;
            }
            return true;
        }
        
        // kiem tra so dien thoai
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
        </script>
        <script type="text/javascript" src="../myeditor/myfinder/ckfinder.js"></script>
        <script language="javascript" type="text/javascript">
            function BrowseServer( inputId )
            {
                var finder = new CKFinder() ;
                finder.StartupPath  = "Product:/product/";
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
        <form method="post" name="phpForm">
        <?php
            $result = $myProcess->getProduct($_GET['id']);
            if($row = $result->fetch())
            {
                extract($row);
        ?>
        <div>
            <fieldset class="adminform">
                <legend>Thông tin sản phẩm</legend>

                <table class="admintable" width="100%">
                <tbody><tr>
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
                        <input class="text_area" name="product_code" id="product_code" value="<?php echo $SPID; ?>" size="20" maxlength="10" title="Mã sản phẩm" type="text"> <strong>VD: SP001</strong>
                    </td>
                </tr>
                <tr>
                    <td class="key" nowrap="nowrap">
                        <label for="link">
                            Tên sản phẩm: <font color="red">(*)</font>
                        </label>
                    </td>
                    <td colspan="2">
                        <input class="text_area" name="product_name" id="product_name" value="<?php echo $product_name; ?>" size="50" maxlength="255" title="Tên sản phẩm" type="text">
                    </td>
                </tr>
                <tr>
                    <td class="key" nowrap="nowrap">
                        <label for="link">
                            Định danh:
                        </label>
                    </td>
                    <td colspan="2">
                        <input class="text_area" name="alias" id="alias" value="<?php echo $alias; ?>" size="50" maxlength="255" title="Tên sản phẩm" type="text">
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
                            <option id="0" value="0">- Chọn Danh mục</option>"
                            <?php 
                                function category($parentid = 0, $space = '&nbsp;&nbsp;&nbsp;|_ ', &$html = '', $selected = -1) {
                                    $myprocess = new process();                                        
                                    $result = $myprocess->category_multi_level($parentid);
                                    while ($row = $result->fetch()) {
                                        if ($row['cat_id'] == $selected) {
                                            $html .= '<option value='.$row['cat_id'].' selected="selected">'.$space . $row['title'].'</option>';
                                        }
                                        else {
                                            $html .= '<option value='.$row['cat_id'].'>'.$space . $row['title'].'</option>';
                                        }

                                        category($row["cat_id"], $space.'&nbsp;|_&nbsp;', $html);
                                    }                
                                    return $html;
                                }
                                
                                $html = '';
                                echo category(0, '&nbsp;&nbsp;&nbsp;|_ ', $html, $book_category_id);
                            ?>
                        </SELECT>
                    </td>
                </tr>
                <tr>
                    <td class="key">
                    <label for="title">Hình ảnh:</label> <font color="red">(*)</font></td>
                    <td colspan="2">
                                            
                        <?php $image_name_array = explode("|", $product_image); ?>
                        <input type="text" id="image_file" name="image_file[]" value="<?php echo $image_name_array[0]; ?>" style="width:250px;">
                        <input type="hidden" id="image_id" name="image_id[]" />
                        &nbsp;<a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('image_file');"> + Lựa chọn + </a>
                        &nbsp;&nbsp;&nbsp;<img src="templates/mt24h_admin/images/icons/plus_icon.gif" alt="" border="0" width="13" height="13"> 
                        <a href="javascript:void(0);" onclick="addImage('tblInnerHTML');return false;">Thêm hình ảnh</a>
                        <table id="tblInnerHTML" style="margin-top:5px;" cellpadding="0" cellspacing="0" border="0" width="100%"> 
                          <tbody>
                            <?php for($i=1; $i<count($image_name_array) ; $i++){ ?>
                                <tr>
                                    <td>
                                        <div style="float: left;">
                                        <input style="width:250px;" style="background: #ffffff;" type="text" id="image_file<?php echo $i-1; ?>" name="image_file[]" value="<?php echo $image_name_array[$i]; ?>" />
                                        <input type="hidden" id="image_id" name="image_id[]" />
                                        </div>
                                        &nbsp;<a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('image_file<?php echo $i-1; ?>');"> + Lựa chọn + </a>
                                        &nbsp;&nbsp;&nbsp; <a href='javascript:void(0);' onClick="removeRowFromTable('tblInnerHTML','<?php echo $i-1; ?>');return false;"> <img src="templates/mt24h_admin/images/icons/job_icon_delete_12x12.gif" alt="" width="13" height="13" border="0" /> Xóa</a>
                                    </td>
                                </tr>
                            <?php }    ?>
                          </tbody>
                        </table>
                        
                    </td>
                </tr>
                <tr>
                    <td class="key" nowrap="nowrap">
                        <label for="link">
                            Thời gian bảo hành:
                        </label>
                    </td>
                    <td colspan="2">
                        <input class="text_area" name="author" id="author" value="<?php echo $author; ?>" size="50" maxlength="255" title="Thông tin tác giả" type="text">
                    </td>
                </tr>                
                <tr>
                    <td class="key" nowrap="nowrap">
                        <label for="link">
                            Bộ bán sản phẩm:
                        </label>
                    </td>
                    <td colspan="2">
                        <input class="text_area" name="attach_info" id="attach_info" value="<?php echo $attach_info; ?>" size="50" maxlength="255" title="Thông tin thêm về sản phẩm" type="text">
                    </td>
                </tr>
                <tr>
                    <td class="key" nowrap="nowrap">
                        <label for="link">
                            Chất lượng:
                        </label>
                    </td>
                    <td colspan="2">
                        <input class="text_area" name="quality" id="quality" value="<?php echo $quality; ?>" size="50" maxlength="255" title="chất lượng sản phẩm" type="text">
                    </td>
                </tr>
                <tr>
                    <td class="key" nowrap="nowrap">
                        <label for="link">
                            Xuất xứ:
                        </label>
                    </td>
                    <td colspan="2">
                        <input class="text_area" name="origin" id="origin" value="<?php echo $origin; ?>" size="50" maxlength="255" title="xuất xứ sản phẩm" type="text">
                    </td>
                </tr>
                <tr>
                    <td class="key" nowrap="nowrap">
                        <label for="link">
                            Phí vận chuyển:
                        </label>
                    </td>
                    <td colspan="2">
                        <input class="text_area" name="shipping_costs" id="shipping_costs" value="<?php echo $shipping_costs; ?>" size="50" maxlength="255" title="Phí vận chuyển" type="text">
                    </td>
                </tr>
                <tr>
                    <td class="key" nowrap="nowrap">
                        <label for="link">
                            Giá sản phẩm: <font color="red">(*)</font>
                        </label>
                    </td>
                    <td colspan="2">
                        <input class="text_area" name="product_price" id="product_price" value="<?php echo $price; ?>" size="50" maxlength="255" title="Giá sản phẩm" type="text">
                    </td>
                </tr>
                <tr>
                    <td class="key" nowrap="nowrap">
                        <label for="link">
                            Loại giảm giá:
                        </label>
                    </td>
                    <td colspan="2">
                        <input class="text_area" name="discounts" id="discounts" value="<?php echo $discounts; ?>" size="30" maxlength="10" title="Tỉ lệ giảm giá" type="text">
                        <SELECT class="inputbox" size="1" name="discount_type">
                            <?php if($discount_type == 0){ ?>
                            <OPTION value="0" selected> - Số tiền - </OPTION>
                            <OPTION value="1"> - % - </OPTION>
                            <?php } else { ?>
                            <OPTION value="0"> - Số tiền - </OPTION>
                            <OPTION value="1" selected> - % - </OPTION>
                            <?php } ?>
                        </SELECT>
                    </td>
                </tr>
                
                <tr>
                    <td class="key" nowrap="nowrap">
                        <label for="link">
                            Thuộc tính khác
                        </label>
                    </td>
                    <td colspan="2">

                        <table cellpadding="0" cellspacing="0" border="0">
                                <tr><td>
                                    <div id="content_Language" class="none">
                                        <div class="box_frm">
                                            <?php 
                                                $properties_name_array = explode("|", $properties_name); array_shift($properties_name_array);
                                                $properties_value_array = explode("|", $properties_value); array_shift($properties_value_array);
                                            ?>
                                            <label class="key"> &nbsp;&nbsp;Tên: <input class="text_area" name="properties_name[]" id="properties_name" value="<?php echo $properties_name_array[0]; ?>" size="40" maxlength="255" title="Tỉ lệ giảm giá" type="text"></label>
                                            <label class="key"> &nbsp;&nbsp;Giá trị: <input class="text_area" name="properties_value[]" id="properties_value" value="<?php echo $properties_value_array[0]; ?>" size="40" maxlength="255" title="Tỉ lệ giảm giá" type="text"></label>
                                            <img src="../templates/default/images/icons/job_icon_add_13x13.gif" alt="" border="0" width="13" height="13"> <a href="javascript:void(0);" onclick="addLanguage('tblInnerHTML');return false;">Thêm thuộc tính</a>                                            
                                        </div>                                        
                                    </div>
                                </td></tr>
                                <tr><td>
                                    <table id="tblInnerHTML" style="margin-top:0px;" cellpadding="0" cellspacing="3" border="0"> 
                                      <tbody>                                          
                                            <?php for($i=1; $i<count($properties_name_array) -1; $i++){ ?>
                                                <tr>
                                                    <td>
                                                    <label class="key"> Tên: <input class="text_area" name="properties_name[]" id="properties_name" value="<?php echo $properties_name_array[$i]?>" size="40" maxlength="255" title="Tỉ lệ giảm giá" type="text"></label>
                                                    <label class="key"> &nbsp;&nbsp;Giá trị: <input class="text_area" name="properties_value[]" id="properties_value" value="<?php echo $properties_value_array[$i]?>" size="40" maxlength="255" title="Tỉ lệ giảm giá" type="text"></label>
                                                    <img src="../templates/default/images/icons/job_icon_delete_12x12.gif" alt="" width="13" border="0" height="13"> <a href="javascript:void(0);" onclick="removeRowFromTable('tblInnerHTML',<?php echo $i-1; ?>);return false;">Xóa</a>
                                                    </td>
                                                </tr>
                                            <?php }    ?>
                                      </tbody>
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
                        <textarea name="html_description"><?php echo $description; ?></textarea>
                        <script type="text/javascript">
                            CKEDITOR.replace( 'html_description' );
                        </script>
                    </td>
                </tr>                
                <tr>
                    <td class="key">
                        Sản phẩm nổi bật
                    </td>
                    <td colspan="2">                        
                        <?php if($hot_product == 0) {?>
                        <input name="hot_product" id="hot_product0" value="0" checked="checked" class="inputbox" type="radio">
                        <label for="hot_product0">Không</label>
                        <input name="hot_product" id="hot_product1" value="1" class="inputbox" type="radio">
                        <label for="hot_product1">Chọn</label>
                        <?php } else {?>
                        <input name="hot_product" id="hot_product0" value="0" class="inputbox" type="radio">
                        <label for="hot_product0">Không</label>
                        <input name="hot_product" id="hot_product1" value="1" checked="checked" class="inputbox" type="radio">
                        <label for="hot_product1">Chọn</label>
                        <?php } ?>
                    </td>
                </tr>            
                <tr>
                    <td class="key">
                        Cho phép hiển thị:
                    </td>
                    <td colspan="2">
                        <?php if($status == 0) {?>
                        <input name="published" id="published0" value="0" checked="checked" class="inputbox" type="radio">
                        <label for="published0">Không cho phép</label>
                        <input name="published" id="published1" value="1" class="inputbox" type="radio">
                        <label for="published1">Cho phép</label>
                        <?php } else {?>
                        <input name="published" id="published0" value="0" class="inputbox" type="radio">
                        <label for="published0">Không cho phép</label>
                        <input name="published" id="published1" value="1" checked="checked" class="inputbox" type="radio">
                        <label for="published1">Cho phép</label>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td class="key">
                        Trạng thái kho: 
                    </td>
                    <td colspan="2">                        
                        <?php if($status_product == 0) {?>
                        <input name="cheked_product" id="cheked_product0" value="0" checked="checked" class="inputbox" type="radio">
                        <label for="cheked_product0">hết hàng</label>
                        <input name="cheked_product" id="cheked_product1" value="1" class="inputbox" type="radio">
                        <label for="cheked_product1">Còn hàng</label>
                        <?php } else {?>
                        <input name="cheked_product" id="cheked_product0" value="0" class="inputbox" type="radio">
                        <label for="cheked_product0">hết hàng</label>
                        <input name="cheked_product" id="cheked_product1" value="1" checked="checked" class="inputbox" type="radio">
                        <label for="cheked_product1">Còn hàng</label>
                        <?php } ?>
                    </td>
                </tr>            
                <tr>
                    <td class="key">
                        <label for="date_add">
                            Ngày thêm sản phẩm: 
                        </label>
                    </td>
                    <td colspan="2">
                        <input class="text_area" name="date_add" id="date_add" value="<?php echo date('d/m/Y', $date_add)?>" size="15" maxlength="255" title="ngày logo được thêm" type="text" readonly="true">
                        <script type="text/javascript" src="../calendar/javascript/dhtmlgoodies_calendar.js?random=20060118"></script>
                        <img src="../calendar/images/calendar.gif" class="mar_img" align="top" onClick="displayCalendar(document.phpForm.date_add,'dd/mm/yyyy',this);"  />
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
        <div class="clr"></div>
        
        <span id="tab_temp" style="display:none">
            <span id="tab_skill_language_source">
            
                <label class="key"> Tên: <input class="text_area" name="properties_name[]" id="properties_name" value="" size="40" maxlength="255" title="Tỉ lệ giảm giá" type="text"></label>
                <label class="key"> &nbsp;&nbsp;Giá trị: <input class="text_area" name="properties_value[]" id="properties_value" value="" size="40" maxlength="255" title="Tỉ lệ giảm giá" type="text"></label>
                                                            
            </span>
        </span>
        <input type="hidden" id="id_id" name="manufacturer_id" value="13" />
        <input type="hidden" name="hidden" value="submit_com_product_add" />
        <input type="hidden" name="product_id" value="<?php echo $book_product_id; ?>"/>
        <input type="hidden" name="task"/>
        </form>
        <?php } ?>
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
var intRowActive = <?php echo $i-1; ?>;
function addImage(tblId)
{
    if(document.phpForm.image_id.length >= 20 && document.phpForm.image_id.length != 30)
    {
        return false;
    }
    
    var str = '<input type="text" id="image_file'+ intRowActive +'" name="image_file[]" value="Chọn file hình ảnh cần thêm .. " style="width:250px;" /><input type="hidden" id="image_id" name="image_id[]" />&nbsp;<a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('+"'image_file"+intRowActive+"'"+');"> + Lựa chọn + </a>';

    var tblBody = document.getElementById(tblId).tBodies[0];
    var newRow = tblBody.insertRow(-1);
    var newCell0 = newRow.insertCell(0);
    str += " &nbsp;&nbsp;&nbsp; <a href='javascript:void(0);' onClick=\"removeRowFromTable('tblInnerHTML',"+intRowActive+");return false;\"> <img src=\"templates/mt24h_admin/images/icons/job_icon_delete_12x12.gif\" alt=\"\" width=\"13\" height=\"13\" border=\"0\" /> Xóa</a>";
    newCell0.innerHTML = '<div style="margin-top:10px;">' + trim(str) + '<div>';
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
function addLanguage(tblId)
{
    if(document.phpForm.properties_value.length > 10 && document.phpForm.properties_value.length != 20)
    {
        return false;
    }
    
    var tblBody = document.getElementById(tblId).tBodies[0];
    var newRow = tblBody.insertRow(-1);
    var newCell0 = newRow.insertCell(0);
    newCell0.innerHTML = trim(document.getElementById('tab_skill_language_source').innerHTML) + " <img src=\"../templates/default/images/icons/job_icon_delete_12x12.gif\" alt=\"\" width=\"13\" height=\"13\" border=\"0\" /> <a href='javascript:void(0);' onClick=\"removeRowFromTable('tblInnerHTML',"+intRowActive+");return false;\">Xóa</a>";
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