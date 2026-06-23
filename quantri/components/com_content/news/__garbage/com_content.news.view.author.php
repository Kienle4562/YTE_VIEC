<?php defined( '_VALID_MOS' ) or die( include("404.php") );
if($_SESSION["session"]["key"] == "Author") { ?>
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
					
					<td class="button" id="toolbar-trash">
					<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một bài viết từ danh sách để');}else if(confirm('Bạn có chắc chắn muốn xóa những mẫu tin được chọn không? ')){  submitbutton('remove')}" class="toolbar">
					<span class="icon-32-trash" title="Sọt rác">
					</span>
					Sọt rác
					</a>
					</td>
									
					<td class="button" id="toolbar-new">
					<a href="javascript:submitbutton('add');" class="toolbar">
					<span class="icon-32-new" title="Thêm mới">
					</span>
					Thêm mới
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
				</tbody>
			</table>
		</div>
		
<div class="header icon-48-article">Quản lý bài viết</div>

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
	<table>
		<tbody>
		<tr>
			<td width="100%"></td>
			<td nowrap="nowrap">
				<SELECT class=inputbox onchange=document.phpForm.submit(); size=1 name=filter_sectionid>

					<OPTION value=0 selected>- Chọn chủ đề -</OPTION>

					<?php include("../protected/dbconnect.php");
						$sql = "Select `Ses_Id`, `Title` From `session`";
						$cmd = $mysqli->prepare($sql);
						$cmd->execute();
						$cmd->bind_result($Ses_Id, $Title);
						if(isset($_POST["filter_sectionid"])){
							while($cmd->fetch()){
							if($Ses_Id == $_POST["filter_sectionid"]){?>
									<OPTION selected value=<?php echo $Ses_Id ?>><?php echo $Title ?></OPTION>
								<?php } else { ?>
									<OPTION value=<?php echo $Ses_Id ?>><?php echo $Title ?></OPTION>
								<?php }
							}
						} else if(isset($_GET["sesid"])){
							while($cmd->fetch()){
							if($Ses_Id == $_GET["sesid"]){?>
									<OPTION selected value=<?php echo $Ses_Id ?>><?php echo $Title ?></OPTION>
								<?php } else { ?>
									<OPTION value=<?php echo $Ses_Id ?>><?php echo $Title ?></OPTION>
								<?php }
							}
						} else {
							while($cmd->fetch()){ ?>
								<OPTION value=<?php echo $Ses_Id ?>><?php echo $Title ?></OPTION>
							<?php }
						}
					?>	 

				</SELECT>
				
				<SELECT class=inputbox onchange="document.phpForm.submit( );" size=1 name=catid>

					<OPTION value=0 selected>- Chọn chủ đề con -</OPTION>

					<?php

					include("../protected/dbconnect.php");

					if(isset($_POST["filter_sectionid"]) && $_POST["filter_sectionid"] != 0){
						$sql = "Select `Cat_Id`, `CatName`, `SesID` From `category` where SesID = " . $_POST["filter_sectionid"];
					}
					else if(isset($_GET["sesid"])){
						$sql = "Select `Cat_Id`, `CatName`, `SesID` From `category` where SesID = " . $_GET["sesid"];
					}
					else {
						$sql = "Select `Cat_Id`, `CatName`, `SesID` From `category`";
					}

					$cmd = $mysqli->prepare($sql);
					$cmd->execute();
					$cmd->bind_result($Cat_Id, $CatName, $SesID);
						if(isset($_POST["catid"])){
							while($cmd->fetch()){
								if($Cat_Id == $_POST["catid"]){?>
									<OPTION selected value=<?php echo $Cat_Id ?>><?php echo $CatName ?></OPTION>
								<?php } else { ?>
									<OPTION value=<?php echo $Cat_Id ?>><?php echo $CatName ?></OPTION>
								<?php }
							}
						} else if(isset($_GET["catid"])){
							while($cmd->fetch()){
								if($Cat_Id == $_GET["catid"]){?>
									<OPTION selected value=<?php echo $Cat_Id ?>><?php echo $CatName ?></OPTION>
								<?php } else { ?>
									<OPTION value=<?php echo $Cat_Id ?>><?php echo $CatName ?></OPTION>
								<?php }
							}
						} else {
							while($cmd->fetch()){ ?>
								<OPTION value=<?php echo $Cat_Id ?>><?php echo $CatName ?></OPTION>
							<?php }
						}
					?>
				</SELECT>				
			</td>
			</tr>
		</tbody>
	</table>
	<table class="adminlist" cellspacing="1">
	<thead>
	<?php include("../protected/dbconnect.php");
		include("../protected/back_end_paging.php");
		$sql = "SELECT
				  `news`.`Title`, `news`.`Status`, `news`.`Order`, `news`.`News_Id`,
				  `session`.`Title`, `category`.`CatName`, `account`.`UserName`, Date_FORMAT(`news`.`Date`, '%d/%m/%Y') As Date, `news`.`Focus`
				FROM
				  `session` INNER JOIN
				  `category` ON `session`.`Ses_Id` = `category`.`SesID` INNER JOIN
				  `news` ON `category`.`Cat_Id` = `news`.`CatID` INNER JOIN
				  `account` ON `account`.`Ac_Id` = `news`.`AccID`";

			if(!isset($_POST["filter_sectionid"]) && !isset($_POST["catid"])){
				if( isset($_GET["sesid"]) && isset($_GET["catid"]) ){
					if( $_GET["sesid"] == 0 && $_GET["catid"] == 0 ){
						$sql .= " WHERE `account`.`UserName` = '" . $_SESSION["session"]["uid"] . "' Order by `news`.`Order` desc";
					} else if($_GET["sesid"] != 0 && $_GET["catid"] == 0){
						$sql .= " WHERE `account`.`UserName` = '" . $_SESSION["session"]["uid"] . "' AND Ses_Id = " . $_GET["sesid"] . " Order by `news`.`Order` desc";
					} else {
						$sql .= " WHERE `account`.`UserName` = '" . $_SESSION["session"]["uid"] . "' AND Ses_Id = " . $_GET["sesid"] . " AND Cat_Id = " . $_GET["catid"] . "
							Order by `news`.`Order` desc";
					}
				} else {
					$sql .= " WHERE `account`.`UserName` = '" . $_SESSION["session"]["uid"] . "' Order by `news`.`Order` desc";
				}		
			} else if($_POST["filter_sectionid"] != 0 && $_POST["catid"] == 0){
				$sql .= " WHERE `account`.`UserName` = '" . $_SESSION["session"]["uid"] . "' AND Ses_Id = " . $_POST["filter_sectionid"] . "
						Order by `news`.`Order` desc";
			} else if($_POST["filter_sectionid"] != 0 && $_POST["catid"] != 0){
				$sql .= " WHERE `account`.`UserName` = '" . $_SESSION["session"]["uid"] . "' AND Ses_Id = " . $_POST["filter_sectionid"] . " AND Cat_Id = " . $_POST["catid"] . "
						Order by `news`.`Order` desc";
			} else if($_POST["filter_sectionid"] == 0 && $_POST["catid"] != 0){
				$sql .= " WHERE `account`.`UserName` = '" . $_SESSION["session"]["uid"] . "' AND Cat_Id = " . $_POST["catid"] . "
						Order by `news`.`Order` desc";
			} else if($_POST["filter_sectionid"] == 0 && $_POST["catid"] == 0){
				$sql .= " WHERE `account`.`UserName` = '" . $_SESSION["session"]["uid"] . "' Order by `news`.`Order` desc";
			}
			$cmd = $mysqli->prepare($sql);
			$cmd->execute();
			$cmd->bind_result($newsTitle, $Status, $Order, $News_Id, $sessionTitle, $CatName, $UserName, $Date, $Focus);
			$cmd->store_result();
			if(!isset($_POST["limit"])) $r = 10; else $r = $_POST["limit"];
			if(!isset($_POST["page"])) $p = 1; else $p = $_POST["page"];
			$pager = Pager::getPagerData($cmd->num_rows, $r, $p);
			$i = 1;
		?>
		<tr>
			<th width="5">#</th>
			<th width="5"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
			<th class="title"><a href="javascript:void(0)">Tiêu đề</a></th>
			<th width="1%" nowrap="nowrap"><a href="javascript:void(0)">Tiêu điểm</a></th>
			<th width="1%" nowrap="nowrap"><a href="javascript:void(0)">Đã được bật</a></th>
			<th class="title" width="8%" nowrap="nowrap"><a href="javascript:void(0)">Chủ đề</a></th>
			<th class="title" width="8%" nowrap="nowrap"><a href="javascript:void(0)">Chủ đề con</a></th>
			<th class="title" width="8%" nowrap="nowrap"><a href="javascript:void(0)">Tác giả</a></th>
			<th align="center" width="10"><a href="javascript:void(0)">Ngày tháng</a></th>
			<th align="center" width="10"><a href="javascript:void(0)">Lần xem</a></th>
			<th class="title" width="1%"><a href="javascript:void(0)">ID</a></th>
		</tr>
	</thead>
	<tfoot>
	<tr>
		<td colspan="15">
			<del class="container">
				<div class="pagination">
					<div class="limit">
					Bạn đang xem trang: <?php echo $pager->page ?> của tổng số <?php echo $pager->numPages ?> trang <br>
						<?php echo $pager->paging ?> <br>
						Hiển thị #
						<select name="limit" class="inputbox" size="1" onchange="document.phpForm.submit();">
							<?php 
								for($j = 5; $j <= 50; $j = $j + 5){ 
									if($j == $r){ ?>
										<option value="<?php echo $j ?>" selected><?php echo $j ?></option>
									<?php } else { ?>
										<option value="<?php echo $j ?>"><?php echo $j ?></option>
									<?php }
								}
							?>
						</select>
						mẫu tin trên mỗi trang
					</div>
					<div class="limit"></div>
					<input name="limitstart" value="0" type="hidden">
				</div>
			</del>
		</td>
	</tr>
	</tfoot>
	<tbody>

		<?php while($cmd->fetch()){ 
			if($i > $pager->offset && $i <= $pager->limit){
		?>
		<tr class="row0">
			<td><?php echo $i ?></td>
			<td align="center"><input id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $News_Id ?>" onclick="isChecked(this.checked);" type="checkbox"></td>
			<td><a href=".?com=com_content&view=news&task=edit&id=<?php echo $News_Id ?>"><?php echo $newsTitle ?> </a></td>
			<td align="center">
			<?php if($Focus == 1) { ?>
				<span class="editlinktip hasTip">
					<a href="javascript:void(0);">
					<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
					</a>
				</span>
			<?php } else if ($Focus == 0) { ?>			
				<span class="editlinktip hasTip">
					<a href="javascript:void(0);">
					<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
					</a>
				</span>
			<?php }	?>
			</td>
			<td align="center">
		
			<?php if($Status == 1) { ?>
				<span class="editlinktip hasTip">
					<a href="javascript:void(0);">
					<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
					</a>
				</span>
			<?php } else if ($Status == 0) { ?>			
				<span class="editlinktip hasTip">
					<a href="javascript:void(0);">
					<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
					</a>
				</span>
			<?php }	?>
					
			</td>							
			<td><a href="#" title="Sửa chủ đề"><?php echo $sessionTitle ?> </a></td>
			<td>
				<a href="#" title="Sửa chủ đề con"><?php echo $CatName ?> </a>
			</td>
			<td><a href="#" title="Sửa thành viên"><?php echo $UserName ?></a></td>
			<td nowrap="nowrap"><?php echo $Date ?></td>
			<td align="center" nowrap="nowrap">14</td>
			<td><?php echo $News_Id ?></td>
		</tr>
		<?php }	
		$i++;
		} ?>
		</tbody>
	</table>
	<input type=hidden name=page value=<?php echo $p; ?>>
	<INPUT type=hidden value=submit_com_content_news_view name=hidden>
	<INPUT type=hidden value=0 name=boxchecked>
	<INPUT type=hidden name=task>
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