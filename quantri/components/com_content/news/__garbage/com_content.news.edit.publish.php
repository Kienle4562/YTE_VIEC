<?php defined( '_VALID_MOS' ) or die( include("404.php") );
if($_SESSION["session"]["key"] == "Publisher") { ?>
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
						Lưu và đóng
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
			} else if (form.sectionid.value == "0"){
				alert("Vui lòng chọn chủ đề cha");
				return;
			} else if (form.catid.value == "0"){
				alert("Vui lòng chọn chủ đề con");
				return;
			} else if (form.catid.value == ""){
				alert("Vui lòng chọn chủ đề con");
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
<?php

	include("../protected/dbconnect.php");	

	$sql = "SELECT
			  `news`.`News_Id`, `news`.`AccID`, `news`.`Title`,
			  `news`.`Description`, `news`.`Content`, `session`.`Ses_Id`,
			  `category`.`Cat_Id`, `news`.`Status`, `news`.`Focus`, `news`.`alias`,
			  `news`.`img_file`, Date_FORMAT(`news`.`Date`, '%d/%m/%Y') As `date_add`, `news`.`img_status`, `news`.`num_view`
			FROM
			  `session` INNER JOIN
			  `category` ON `session`.`Ses_Id` = `category`.`SesID` INNER JOIN
			  `news` ON `category`.`Cat_Id` = `news`.`CatID`
			Where `news`.`News_Id` = ? ";

	$cmd = $mysqli->prepare($sql);
	$cmd->bind_param("s", $_GET["id"]);
	$cmd->execute();
	$cmd->bind_result($News_Id, $AccID, $newsTitle, $Description, $Content, $Ses_Id, $Cat_Id, $Status, $Focus, $alias, $img_file, $date_add, $img_status, $num_view);
	if($cmd->fetch()){
?>
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td valign="top">
		<table  class="adminform">
		<tr>
			<td>
				<label for="title">Tiêu đề	</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="title" id="title" size="40" maxlength="255" value="<?php echo $newsTitle ?>" />
			</td>
			<td>
				<label>Đã được bật </label>
			</td>
			<td>
			<?php if($Status == 1){ ?>
				<input type="radio" name="state" id="state0" value="0"/>
				<label for="state0">No</label>
				<input type="radio" name="state" id="state1" value="1" checked="checked"/>
				<label for="state1">Yes</label>
			<?php } else { ?>
				<input type="radio" name="state" id="state0" value="0" checked="checked"/>
				<label for="state0">No</label>
				<input type="radio" name="state" id="state1" value="1"/>
				<label for="state1">Yes</label>
			<?php } ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="alias">Alias </label>
			</td>
			<td>
				<input class="inputbox" type="text" name="alias" id="alias" size="40" maxlength="255" value="<?php echo $alias ?>" />
			</td>
			<td>
				<label>Tin tiêu điểm </label>
			</td>
			<td>
			<?php if($Focus == 1){ ?>
				<input type="radio" name="frontpage" id="frontpage0" value="0"  />
				<label for="frontpage0">No</label>
				<input type="radio" name="frontpage" id="frontpage1" value="1" checked="checked" />
				<label for="frontpage1">Yes</label>
				<?php } else { ?>
				<input type="radio" name="frontpage" id="frontpage0" value="0" checked="checked"  />
				<label for="frontpage0">No</label>
				<input type="radio" name="frontpage" id="frontpage1" value="1"  />
				<label for="frontpage1">Yes</label>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="alias">Hình ảnh </label>
			</td>
			<td>
				<div style="float: left;">
				<input style="background: #ffffff;" type="text" id="id_name" name="id_name" value="<?php echo $img_file; ?>" disabled="disabled" size="55" />
				</div>
				<div class="button2-left">
					<div class="blank">
					<!--<a class="modal" title="Chọn một bài viết"  href=".?com=com_upload&view=upload&path=product" rel="{handler: 'iframe', size: {x: 750, y: 550}}">Lựa chọn</a>-->
					<a title="Chọn một bài viết"  href="javascript:void(0)" onClick="javascript:BrowseServer();">Lựa chọn</a>
					</div>
				</div>
				<input type="hidden" id="id_id" name="image_file" value="<?php echo $img_file; ?>" />
			</td>
			<td>
				<label>Hiển thị </label>
			</td>
			<td>
				<?php if($img_status == 1){?>
					<input type="radio" name="img_status" id="img_status0" value="0" />
					<label for="img_status0">No</label>
					<input type="radio" name="img_status" id="img_status1" value="1"  checked="checked" />
					<label for="img_status1">Yes</label>
				<?php } else { ?>
					<input type="radio" name="img_status" id="img_status0" value="0" checked="checked"  />
					<label for="img_status0">No</label>
					<input type="radio" name="img_status" id="img_status1" value="1"  />
					<label for="img_status1">Yes</label>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="sectionid">Chủ đề </label>
			</td>
			<td>
				<SELECT class=inputbox onchange="changeDynaList( 'catid', sectioncategories, document.phpForm.sectionid.options[document.phpForm.sectionid.selectedIndex].value, 0, 0);" size=1 name="sectionid">
					<?php
					include("../protected/dbconnect.php");
					$cmd = $mysqli->prepare("Select `Ses_Id`, `Title` From `session`");
					$cmd->execute();
					$cmd->bind_result($SesSes_Id, $Title);
					while($cmd->fetch()){
						if($SesSes_Id == $Ses_Id)
						echo "<OPTION id=$SesSes_Id value=$SesSes_Id selected>$Title</OPTION>";
						else
						echo "<OPTION id=$SesSes_Id value=$SesSes_Id>$Title</OPTION>";
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
					 <?php
						include("../protected/dbconnect.php");
						$sql = "SELECT `category`.`Cat_Id`, `category`.`CatName`
								FROM `session` INNER JOIN `category` ON `session`.`Ses_Id` = `category`.`SesID`
								WHERE `category`.`SesID` = ".$Ses_Id;
					
						$cmd = $mysqli->prepare($sql);
						$cmd->execute();
						$cmd->bind_result($CatCat_Id, $CatName);
						while($cmd->fetch()){
							if($CatCat_Id == $Cat_Id)
							echo "<OPTION id=$CatCat_Id value=$CatCat_Id selected>$CatName</OPTION>";
							else
							echo "<OPTION id=$CatCat_Id value=$CatCat_Id>$CatName</OPTION>";
						}
						$cmd->close();
						$mysqli->close();						
					?>
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
			<table width="100%" class="paramlist admintable" cellspacing="1">
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
								if($Ac_Id == $AccID){ ?>
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
						<input class="text_area" name="date_add" id="date_add" value="<?php echo $date_add?>" size="20" maxlength="255" title="ngày chủ đề được thêm" type="text" readonly="true">
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
					<?php
						include("../freeeditor/fckeditor.php") ;
						$oFCKeditor = new FCKeditor('description') ;
						$oFCKeditor->Config['ToolbarStartExpanded'] = false ;
						$oFCKeditor->BasePath = "../freeeditor/";
						$oFCKeditor->Config["AutoDetectLanguage"] = false ;
						$oFCKeditor->Config["DefaultLanguage"]    = "vi" ;
						$oFCKeditor->Height = 200 ;
						$oFCKeditor->Value = ($Description) ;
						$oFCKeditor->Config["EnterMode"]		= 'div' ;
						$oFCKeditor->Config["ShiftEnterMode"]	= 'br' ;
						$oFCKeditor->Create() ;
					?>
					<br>
					<label style="font-weight:bold ">Nội dung chi tiết: (thông tin tùy chọn có thể để trống)</label> <br><br>
					<?php 
						$oFCKeditor = new FCKeditor('content') ;
						$oFCKeditor->Config['ToolbarStartExpanded'] = false ;
						$oFCKeditor->BasePath = "../freeeditor/";
						$oFCKeditor->Config["AutoDetectLanguage"] = false ;
						$oFCKeditor->Config["DefaultLanguage"]    = "vi" ;
						$oFCKeditor->Height = 400 ;
						$oFCKeditor->Value = ($Content) ;
						$oFCKeditor->Config["EnterMode"]		= 'div' ;
						$oFCKeditor->Config["ShiftEnterMode"]	= 'br' ;
						$oFCKeditor->Create() ;
					?>					
				</td>
			</tr>
		</table>
		<INPUT type=hidden name=newsid value="<?php echo $News_Id ?>">
		<?php } ?>
		<input type="hidden" id="hidden" name="hidden" value="submit_com_content_news_edit" />
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