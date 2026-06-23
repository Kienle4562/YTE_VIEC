<?php defined( '_VALID_MOS' ) or die( include("404.php") );
if($_SESSION["session"]["key"] == "Editor") { ?>
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
						<a href="#" onclick="javascript: submitbutton('save')" class="toolbar">
						<span class="icon-32-save" title="Lưu">
						</span>
						Lưu và thoát
						</a>
						</td>
						
						<td class="button" id="toolbar-apply">
						<a href="#" onclick="javascript: submitbutton('apply')" class="toolbar">
						<span class="icon-32-apply" title="Áp dụng">
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
					
					</tr>
					</table>
			</div>
<div class="header icon-48-addedit">
Bài viết: <small><small>[ Thêm mới ]</small></small>
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
		<script type="text/javascript" src="../freeeditor/editor/ckfinder/ckfinder.js"></script>
		<script language="javascript" type="text/javascript">
		<!--
		var sectioncategories = new Array;
		<?php include("../protected/dbconnect.php");
		$sql = "SELECT `SesID`, `Cat_Id`, `CatName` From category";
		$cmd = $mysqli->prepare($sql);
		$cmd->execute();
		$cmd->bind_result($SesID, $Cat_Id, $CatName);
		$r = 0;
		while($cmd->fetch()){
			echo "sectioncategories[$r] = new Array( '$SesID', '$Cat_Id', '$CatName' );";
			$r++;
		}
		$cmd->close();
		$mysqli->close();					
		?>
		
		function fckValid()
		{
			// Get the editor instance that we want to interact with.
			var oEditor = FCKeditorAPI.GetInstance('description') ;
			return oEditor.EditorDocument.body.innerHTML;
		}
	
		function submitbutton(pressbutton)
		{
			var form = document.phpForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			
			if (form.title.value == ""){
				alert("Vui lòng nhập tiêu đề");
				form.title.focus();
				return;
			} else if (form.filter_sectionid.value == "0"){
				alert("Vui lòng chọn chủ đề cha");
				return;
			} else if (form.catid.value == "0"){
				alert("Vui lòng chọn chủ đề con");
				return;
			} else if (form.catid.value == ""){
				alert("Vui lòng chọn chủ đề con");
				return;
			} else if(fckValid() == "<P></P>"){
				alert("vui lòng nhập mô tả cho bản tin");
				return;
			} else if(fckValid() == "<P>&nbsp;</P>"){
				alert("vui lòng nhập mô tả cho bản tin");
				return;
			} else {
				if(form.alias.value == ''){
					form.alias.value = form.title.value;					
				}
				submitform(pressbutton);
			}
		}
		function BrowseServer() {
			/*CKFinder.Popup( '../freeeditor/editor/ckfinder/', null, null, SetFileField ) ;*/
			var finder = new CKFinder() ;
			finder.BasePath = '../freeeditor/editor/ckfinder/' ;
			finder.StartupPath  = "Images:/image/"
			finder.SelectFunction = SetFileField ;			
			finder.Popup() ;
		}
		
		function SetFileField( fileUrl ) {
			document.getElementById( 'id_name' ).value = fileUrl ;
			document.getElementById( 'id_id' ).value = fileUrl ;
		}
		//-->
		</script>

		<form method="post" name="phpForm">

		<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td valign="top">
		<table  class="adminform">
		<tr>
			<td>
				<label for="title">Tiêu đề	</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="title" id="title" size="70" maxlength="255" value="" />
			</td>
			<td>
				<label>Đã được bật </label>
			</td>
			<td>
			Không hiệu lực
			<div style="display:none">
				<input type="radio" name="state" id="state0" value="0" checked="checked" />
				<label for="state0">Tắt</label>
				<input type="radio" name="state" id="state1" value="1" />
				<label for="state1">Bật</label>
			</div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="alias">Alias </label>
			</td>
			<td>
				<input class="inputbox" type="text" name="alias" id="alias" size="70" maxlength="255" value="" />
			</td>
			<td>
				<label>Tin tiêu điểm </label>
			</td>
			<td>
			Không hiệu lực
			<div style="display:none">
				<input type="radio" name="frontpage" id="frontpage0" value="0" checked="checked"  />
				<label for="frontpage0">Tắt</label>
				<input type="radio" name="frontpage" id="frontpage1" value="1"  />
				<label for="frontpage1">Bật</label>
			</div>
			</td>
		</tr>
		<tr>
			<td>
				<label for="alias">Hình ảnh </label>
			</td>
			<td>
				<div style="float: left;">
				<input style="background: #ffffff;" type="text" id="id_name" name="id_name" value="Chọn file hình ảnh cần upload ..." disabled="disabled" size="55" />
				</div>
				<div class="button2-left">
					<div class="blank">
					<!--<a class="modal" title="Chọn một bài viết"  href=".?com=com_upload&view=upload&path=product" rel="{handler: 'iframe', size: {x: 750, y: 550}}">Lựa chọn</a>-->
					<a title="Chọn một bài viết"  href="javascript:void(0)" onClick="javascript:BrowseServer();">Lựa chọn</a>
					</div>
				</div>
				<input type="hidden" id="id_id" name="image_file" value="/pgd-omon/file_upload/image/no_image.jpg" />
			</td>
			<td>
				<label>Hiển thị </label>
			</td>
			<td>
				<input type="radio" name="img_status" id="newsimg0" value="0"  />
				<label for="newsimg0">No</label>
				<input type="radio" name="img_status" id="newsimg1" value="1" checked="checked"  />
				<label for="newsimg1">Yes</label>
			</td>
		</tr>
		<tr>
			<td>
				<label for="sectionid">Chủ đề </label>
			</td>
			<td>
				<SELECT class=inputbox onchange="changeDynaList( 'catid', sectioncategories, document.phpForm.filter_sectionid.options[document.phpForm.filter_sectionid.selectedIndex].value, 0, 0);" size=1 name="filter_sectionid">
					<OPTION id=0 value=0 selected>- Chọn chủ đề</OPTION>"
					<?php include("../protected/dbconnect.php");
					$cmd = $mysqli->prepare("Select `Ses_Id`, `Title` From `session`");
					$cmd->execute();
					$cmd->bind_result($Ses_Id, $Title);
					if(isset($_GET["sesid"])){
						while($cmd->fetch()){
							if($_GET["sesid"] == $Ses_Id){
								echo "<OPTION selected id=$Ses_Id value=$Ses_Id>$Title</OPTION>";
							} else {
								echo "<OPTION id=$Ses_Id value=$Ses_Id>$Title</OPTION>";
							}
						}
					} else {
						while($cmd->fetch()){
							echo "<OPTION id=$Ses_Id value=$Ses_Id>$Title</OPTION>";
						}
					}
					$cmd->close();
					$mysqli->close();						
					?>
				</SELECT>
			</td>
			<td>
				<label for="catid">Chủ đề con </label>
			</td>
			<td>
				<SELECT class=inputbox size=1 name=catid>
					<OPTION id=0 value=0 selected>Chọn chủ đề con</OPTION>
					<?php
					include("../protected/dbconnect.php");
					if(isset($_GET["sesid"])){
						$sql = "Select `Cat_Id`, `CatName` From `category` where SesID = " . $_GET["sesid"];
					} else {
						$sql = "Select `Cat_Id`, `CatName` From `category`";
					}
					$cmd = $mysqli->prepare($sql);
					$cmd->execute();
					$cmd->bind_result($Cat_Id, $CatName);
					while($cmd->fetch()){
						if($Cat_Id == $_GET["catid"]){ ?>
							<OPTION selected value=<?php echo $Cat_Id ?>><?php echo $CatName ?></OPTION>
					<?php } else { ?>
							<OPTION value=<?php echo $Cat_Id ?>><?php echo $CatName ?></OPTION>
						<?php }	
					}?>
				</SELECT>
			</td>
		</tr>
		</table>
			
			</td>
			<td valign="top" width="320" style="padding: 7px 0 0 5px">
					
		<div id="content-pane" class="pane-sliders">
			<div class="panel">
			<h3 class="jpane-toggler title" id="detail-page">
			<span>Các thông số - bài viết</span>
			</h3>
			<div class="jpane-slider content">
			<table width="100%" class="paramlist admintable" cellspacing="1" height="81px;">
				<tr>
					<td width="40%" class="paramlist_key">
						<span class="editlinktip">
						<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="Tác giả::Tên tác giả">Tác giả</label>
						</span>
					</td>
					<td class="paramlist_value">
						<SELECT size="1" name="created_by" class="inputbox">
							<?php include("../protected/dbconnect.php");
							$sql = "Select `Ac_Id`, `UserName` From `account`";
							$cmd = $mysqli->prepare($sql);
							$cmd->execute();
							$cmd->bind_result($Ac_Id, $UserName);
							while($cmd->fetch()){
								if($UserName == $_SESSION["session"]["uid"]){ ?>
									<OPTION selected value=<?php echo $Ac_Id ?>><?php echo $UserName ?></OPTION>
							<?php } else { ?>
									<OPTION value=<?php echo $Ac_Id ?>><?php echo $UserName ?></OPTION>
								<?php }	
							}?>
						</SELECT>
					</td>
				</tr>
				<tr>
					<td width="40%" class="paramlist_key">
						<span class="editlinktip">
						<label id="detailscreated-lbl" for="detailscreated" class="hasTip" title="Ngày tạo::Ngày tạo bài viết này">Ngày tạo</label>
						</span>
					</td>
					<td class="paramlist_value">
						<input class="text_area" name="date_add" id="date_add" value="<?php echo date('d/m/Y')?>" size="20" maxlength="255" title="ngày chủ đề được thêm" type="text">
						<a onclick="javascript:popUpCalendar(this, date_add, 'dd/mm/yyyy')"><img src="calendar/images/calendar.gif" width="20" height="20"></a>
					</td>
				</tr>					
			</table>
			</td>
		</tr>
		</table>
		
		<table class="adminform">
			<tr>
				<td>
					<script type="text/javascript" src="../freeeditor/fckeditor.js"></script>
					<script type="text/javascript">
						function FCKeditor_OnComplete( editorInstance ){
							editorInstance.Events.AttachEvent( 'OnBlur'	, FCKeditor_OnBlur ) ;
							editorInstance.Events.AttachEvent( 'OnFocus', FCKeditor_OnFocus ) ;
						}
						
						function FCKeditor_OnBlur( editorInstance ){
							editorInstance.ToolbarSet.Collapse() ;
						}
						
						function FCKeditor_OnFocus( editorInstance ){
							editorInstance.ToolbarSet.Expand() ;
						}
					</script>
					<br>
					<label style="font-weight:bold ">Nội dung tổng quát:</label> <br><br>
					<script type="text/javascript">
						<!--
						var sBasePath = "../freeeditor/";						
						var oFCKeditor = new FCKeditor( 'description' ) ;
						oFCKeditor.Config['ToolbarStartExpanded'] = false ;
						oFCKeditor.BasePath	= sBasePath ;
						oFCKeditor.Config["AutoDetectLanguage"] = false ;
						oFCKeditor.Config["DefaultLanguage"]    = "vi" ;
						oFCKeditor.Height = 200 ;
						oFCKeditor.Value = '' ;
						oFCKeditor.Config["EnterMode"]		= 'div' ;
						oFCKeditor.Config["ShiftEnterMode"]	= 'br' ;
						oFCKeditor.Create() ;						
						//-->
					</script>
					<br>
					<label style="font-weight:bold ">Nội dung chi tiết: (thông tin tùy chọn có thể để trống)</label> <br><br>
					<script type="text/javascript">
					<!--
						oFCKeditor = new FCKeditor( 'content' ) ;
						oFCKeditor.Config['ToolbarStartExpanded'] = false ;
						oFCKeditor.BasePath	= sBasePath ;
						oFCKeditor.Config["AutoDetectLanguage"] = false ;
						oFCKeditor.Config["DefaultLanguage"]    = "vi" ;
						oFCKeditor.Height = 400 ;
						oFCKeditor.Value = '' ;
						oFCKeditor.Config["EnterMode"]		= 'div' ;
						oFCKeditor.Config["ShiftEnterMode"]	= 'br' ;
						oFCKeditor.Create() ;						
						//-->
					</script>
					
				</td>
			</tr>
		</table>

		<input type="hidden" name="hidden" value="submit_com_content_news_add" />
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
			!Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị		</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id="border-bottom"><div><div></div></div></div>
<?php } ?>