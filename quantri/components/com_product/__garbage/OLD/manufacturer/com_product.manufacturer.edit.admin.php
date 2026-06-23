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
Lưu và đóng
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
<a href="#" onclick="popupWindow('', 'Trợ giúp', 640, 480, 1)" class="toolbar">
<span class="icon-32-help" title="Trợ giúp">
</span>
Trợ giúp
</a>
</td>

</tr></tbody></table>
</div>
<div class="header icon-48-sections">
Danh mục sản phẩm: <small><small>[ Chỉnh sữa ]</small></small><br>
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
		<script language="javascript" type="text/javascript">
		function submitbutton(pressbutton) {
			var form = document.phpForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}

			if ( form.manufacturer_name.value == '' ){
				alert("Vui lòng nhập tên nhà sản xuất");
				form.manufacturer_name.focus();
				return;
			}  else {
				if(form.alias.value == ''){
					form.alias.value = form.manufacturer_name.value;
				}
				submitform(pressbutton);
			}
		}
		</script>
		
		<script type="text/javascript" src="../myeditor/myfinder/ckfinder.js"></script>
		<script language="javascript" type="text/javascript">
			function BrowseServer( inputId )
			{
				var finder = new CKFinder() ;
				finder.StartupPath  = "Company_logo:/company_logo/";
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

		<div>
			<fieldset class="adminform">
				<legend>Chi tiết</legend>
<?php 
	include("../protected/dbconnect.php");
	$sql = "SELECT `book_manufacturers`.`Id`, `book_manufacturers`.`title`,
				  `book_manufacturers`.`alias`, `book_manufacturers`.`description`,
				  `book_manufacturers`.`content`, `book_manufacturers`.`logo`,
				  `book_manufacturers`.`website`, `book_manufacturers`.`yahoo`,
				  `book_manufacturers`.`skype`, `book_manufacturers`.`email`,
				  `book_manufacturers`.`representative`,`book_manufacturers`.`phone`,
				  `book_manufacturers`.`address`,`book_manufacturers`.`status`,
				  `book_manufacturers`.`sticky`, `book_manufacturers`.`date_add`,
				  `book_manufacturers`.`order_num`
			FROM `book_manufacturers`
			WHERE `book_manufacturers`.`Id` = ?";
	$cmd = $mysqli->prepare($sql);
	$cmd->bind_param("s", $_GET["id"]);
	$cmd->execute();
	$cmd->bind_result($Id, $title, $alias, $description, $content, $logo, $website, $yahoo, $skype, $email, $representative, $phone, $address, $status, $sticky, $date_add, $order_num);
	if($cmd->fetch()){		
?>
				<table class="admintable" width="100%">
				<tbody><tr>
					<td class="key" width="100">Phạm vi:</td>
					<td colspan="2"><strong>Nhà sản xuất</strong></td>
				</tr>
				<tr>
					<td class="key"><label for="title">Nhà cung cấp: <font color="#FF0000">(*)</font></label></td>
					<td colspan="2">
						<input class="text_area" name="manufacturer_name" id="manufacturer_name" value="<?php echo $title; ?>" size="50" maxlength="250" title="Tiêu đề cho thông tin của bạn" type="text">
					</td>
				</tr>
				<tr>
					<td class="key" nowrap="nowrap">
						<label for="alias">
							Alias:
						</label>
					</td>
					<td colspan="2">
						<input class="text_area" name="alias" id="alias" value="<?php echo $alias; ?>" size="50" maxlength="255" title="Tên cho thông tin của bạn" type="text">
					</td>
				</tr>
				<tr>
					<td class="key" nowrap="nowrap">
						<label for="alias">Logo </label>
					</td>
					<td>
						<div style="float: left;">
						<input style="background: #ffffff;" type="text" id="image_file" name="image_file" value="<?php echo $logo; ?>" size="50" />
						</div>
						<div class="button2-left">
							<div class="blank">
							<a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('image_file');">Lựa chọn</a>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="title">Website:</label></td>
					<td colspan="2">
						<input class="text_area" name="txt_website" id="txt_website" value="<?php echo $website; ?>" size="50" maxlength="250" title="Website nhà sản xuất" type="text">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="title">yahoo:</label></td>
					<td colspan="2">
						<input class="text_area" name="txt_yahoo" id="txt_yahoo" value="<?php echo $yahoo; ?>" size="50" maxlength="250" title="yahoo nhà sản xuất" type="text">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="title">skype:</label></td>
					<td colspan="2">
						<input class="text_area" name="txt_skype" id="txt_skype" value="<?php echo $skype; ?>" size="50" maxlength="250" title="skype nhà sản xuất" type="text">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="title">Email :</label></td>
					<td colspan="2">
						<input class="text_area" name="txt_Email" id="txt_Email" value="<?php echo $email; ?>" size="50" maxlength="250" title="skype nhà sản xuất" type="text">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="title">Người đại diện :</label></td>
					<td colspan="2">
						<input class="text_area" name="txt_representative" id="txt_representative" value="<?php echo $representative; ?>" size="50" maxlength="250" title="skype nhà sản xuất" type="text">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="title">Số điện thoại :</label></td>
					<td colspan="2">
						<input class="text_area" name="txt_phone" id="txt_phone" value="<?php echo $phone; ?>" size="50" maxlength="250" title="skype nhà sản xuất" type="text">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="title">Địa chỉ :</label></td>
					<td colspan="2">
						<input class="text_area" name="txt_address" id="txt_address" value="<?php echo $address; ?>" size="50" maxlength="250" title="skype nhà sản xuất" type="text">
					</td>
				</tr>
				<tr>
					<td class="key"><label for="title">Thông tin mô tả:</label></td>
					<td colspan="2">
						<script type="text/javascript" src="../myeditor/ckeditor.js"></script>
						<textarea name="html_description"><?php echo $description; ?></textarea>
						<script type="text/javascript">
							CKEDITOR.replace( 'html_description' );
						</script>
					</td>
				</tr>
				<tr>
					<td class="key"><label for="title">Thông tin chi tiết:</label></td>
					<td colspan="2">
						<textarea name="html_content"><?php echo $content; ?></textarea>
						<script type="text/javascript">
							CKEDITOR.replace( 'html_content' , {height : '400px'});
						</script>
					</td>
				</tr>
				<tr>
					<td class="key">
						Đã được bật: 
					</td>
					<td colspan="2">
						<?php if($status){ ?>
						<input name="published" id="published0" value="0" class="inputbox" type="radio">
						<label for="published0">Không</label>
						<input name="published" id="published1" value="1" checked="checked" class="inputbox" type="radio">
						<label for="published1">Yes</label>
						<?php } else { ?>
						<input name="published" id="published0" value="0" checked="checked" class="inputbox" type="radio">
						<label for="published0">Không</label>
						<input name="published" id="published1" value="1" class="inputbox" type="radio">
						<label for="published1">Yes</label>
						<?php } ?>
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="ordering">
							Ngày thêm chủ đề: 
						</label>
					</td>
					<td colspan="2">
						<input readonly="true" class="text_area" name="date_add" id="date_add" value="<?php echo date('d/m/Y', $date_add)?>" size="20" maxlength="10" title="ngày bản tin được thêm" type="text">						
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
				</tbody></table>
			</fieldset>


			<input type="hidden" name="cid" value="<?php echo $Id ?>" />
			
		<?php } ?>
		
		</div>
		<div class="clr"></div>

		<input type="hidden" name="hidden" value="submit_com_product_manufacturer_edit" />
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
		<noscript>!Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id="border-bottom"><div><div></div></div></div>