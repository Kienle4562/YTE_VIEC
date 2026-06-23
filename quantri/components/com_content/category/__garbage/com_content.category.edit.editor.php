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
Chủ đề con: <small><small>[ Thêm mới ]</small></small><br>
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

			if ( form.title.value == '' ){
				alert("Chọn Phải Có Một Tiêu Đề");
			} else if(form.sectionid.value == "0"){
				alert("Chọn phải có một chủ đề cha");
			} else {
				if(form.alias.value == ''){
					form.alias.value = form.title.value;
				}
				submitform(pressbutton);
			}
		}
		</script>

		<form method="post" name="phpForm">

		<div>
			<fieldset class="adminform">
				<legend>Chi tiết</legend>
<?php 
	include("../protected/dbconnect.php");
	$sql = "SELECT `Cat_Id`, `SesID`, `CatName`, `alias`, `Description`, Date_FORMAT(`category`.`date_add`, '%d/%m/%Y') As `date_add`, `Status`
			From `category` where `Cat_Id` = ?";
	$cmd = $mysqli->prepare($sql);
	$cmd->bind_param("s", $_GET["id"]);
	$cmd->execute();
	$cmd->bind_result($Cat_Id, $SesID, $CatName, $alias, $Description, $date_add, $Status);
	if($cmd->fetch()){		
?>
				<table class="admintable">
				<tbody><tr>
					<td class="key" width="100">Phạm vi:</td>
					<td colspan="2"><strong>content	</strong></td>
				</tr>
				<tr>
					<td class="key"><label for="title">Tiêu đề:</label></td>
					<td colspan="2">
						<input class="text_area" name="title" id="title" value="<?php echo $CatName ?>" size="50" maxlength="50" title="Tiêu đề cho thông tin của bạn" type="text">
					</td>
				</tr>
				<tr>
					<td class="key" nowrap="nowrap">
						<label for="alias">
							Alias:
						</label>
					</td>
					<td colspan="2">
						<input class="text_area" name="alias" id="alias" value="<?php echo $alias ?>" size="50" maxlength="255" title="Định danh thông tin của bạn" type="text">
					</td>
				</tr>
				<tr>
					<td class="key">
						Đã được bật: 
					</td>
					<td colspan="2">
					Không hiệu lực với tài khoản này
					<div style="display:none ">
						<?php if($Status == 1){?>
						<input name="published" id="published0" value="0" class="inputbox" type="radio">
						<label for="published0">Không</label>
						<input name="published" id="published1" value="1" checked="checked" class="inputbox" type="radio">
						<label for="published1">Yes</label>
						<?php } else {?>
						<input name="published" id="published0" value="0" checked="checked" class="inputbox" type="radio">
						<label for="published0">Không</label>
						<input name="published" id="published1" value="1" class="inputbox" type="radio">
						<label for="published1">Yes</label>
						<?php }?>
					</div>
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="ordering">
							Ngày thêm chủ đề: 
						</label>
					</td>
					<td colspan="2">
						<input class="text_area" name="date_add" id="date_add" value="<?php echo $date_add ?>" size="15" maxlength="255" title="ngày chủ đề được thêm" type="text">
						<a onclick="javascript:popUpCalendar(this, date_add, 'dd/mm/yyyy')"><img src="calendar/images/calendar.gif" width="20" height="20"></a>
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="ordering">
							Chủ đề cha: 
						</label>
					</td>
					<td colspan="2">
						<SELECT class=inputbox size=1 name=sectionid>
						  <OPTION value=0 selected>- Chọn chủ đề -</OPTION>
						  <?php
							include("../protected/dbconnect.php");
							$sql = "Select `Ses_Id`, `Title` From `session`";
							$cmd = $mysqli->prepare($sql);
							$cmd->execute();
							$cmd->bind_result($Ses_Id, $Title);
							while($cmd->fetch()){
								if($Ses_Id == $SesID){
									echo "<OPTION selected value=$Ses_Id>$Title</OPTION>";
								} else {
									echo "<OPTION value=$Ses_Id>$Title</OPTION>";
								}
							}
						  ?>	  
						</SELECT>
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

			<fieldset class="adminform">
				<legend>Sự miêu tả</legend>

				<table class="admintable">
				<tbody><tr>
					<td colspan="3" valign="top">
					<script type="text/javascript" src="../freeeditor/fckeditor.js"></script>
						<script type="text/javascript">
							<!--
							var sBasePath = "../freeeditor/";
							var oFCKeditor = new FCKeditor( 'description' ) ;
							oFCKeditor.BasePath	= sBasePath ;
							oFCKeditor.ToolbarSet = "Basic";
							oFCKeditor.Height	= 110 ;
							oFCKeditor.Width	= 895 ;
							oFCKeditor.Value = "<?php echo $Description?>" ;
							oFCKeditor.Create() ;
							//-->
						</script>
					</td>
				</tr>
				</tbody>
			</table>
			<input type="hidden" name="cid" value="<?php echo $Cat_Id ?>" />
			<?php } ?>
			</fieldset>
		</div>
		<div class="clr"></div>

		<input type="hidden" name="hidden" value="submit_com_content_category_edit" />
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