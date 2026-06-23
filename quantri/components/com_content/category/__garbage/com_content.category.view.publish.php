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
<td class="button" id="toolbar-publish">
<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một Chủ đề từ danh sách để');}else{  submitbutton('publish')}" class="toolbar">
<span class="icon-32-publish" title="Bật">
</span>
Bật
</a>
</td>

<td class="button" id="toolbar-unpublish">
<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một Chủ đề từ danh sách để');}else{  submitbutton('unpublish')}" class="toolbar">
<span class="icon-32-unpublish" title="Tắt">
</span>
Tắt
</a>
</td>

<td class="button" id="toolbar-delete">
<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một Chủ đề từ danh sách để');}else{  submitbutton('remove')}" class="toolbar">
<span class="icon-32-delete" title="Xóa">
</span>
Xóa
</a>
</td>

<td class="button" id="toolbar-new">
<a href="#" onclick="javascript:submitbutton('add')" class="toolbar">
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

</tr></tbody></table>
</div>
<div class="header icon-48-sections">Quản lý Nhóm</div>

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
			<td align="left" width="100%"></td>
			<td nowrap="nowrap">
			<SELECT class=inputbox onchange=document.phpForm.submit(); size=1 name=sectionid>
				<OPTION value=0 selected>- Chọn chủ đề -</OPTION>
				  <?php
			
					include("../protected/dbconnect.php");
					$sql = "Select `Ses_Id`, `Title` From `session`";
					$cmd = $mysqli->prepare($sql);
					$cmd->execute();
					$cmd->bind_result($Ses_Id, $Title);
					if(isset($_POST["sectionid"])){
						while($cmd->fetch()){
						if($Ses_Id == $_POST["sectionid"]){?>
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
					}else {
						while($cmd->fetch()){ ?>
						<OPTION value=<?php echo $Ses_Id ?>><?php echo $Title ?></OPTION>
						<?php }
					}
					?>	  
				</SELECT>
			</td>
			</tr>
		</tbody>
		</table>
		
		<table class="adminlist">
		<thead>
		<?php include("../protected/dbconnect.php");
			include("../protected/back_end_paging.php");
		$sql = "SELECT `category`.`Cat_Id`, `category`.`SesID`, `category`.`CatName`, `category`.`Order`, `category`.`Status`, `session`.`Title`
				FROM `session` INNER JOIN `category` ON `session`.`Ses_Id` = `category`.`SesID`";
		if(!isset($_POST["sectionid"])){
			if(isset($_GET["sesid"]) && $_GET["sesid"] != 0){
			$sql .= " WHERE Ses_Id = " . $_GET["sesid"] . "
					order by `Order` desc";
			} else {
				$sql .= "order by `Order` desc";
			}
		} else if($_POST["sectionid"] == 0) { 
			$sql .= "order by `Order` desc";
		}else {
			$sql .= " WHERE Ses_Id = " . $_POST["sectionid"] . "
					order by `Order` desc";
		}
		$cmd = $mysqli->prepare($sql);
		$cmd->execute();
		$cmd->bind_result($Cat_Id, $SesID, $CatName, $Order, $Status, $Title);
		$cmd->store_result();
		if(!isset($_POST["limit"])) $r = 10; else $r = $_POST["limit"];
		if(!isset($_POST["page"])) $p = 1; else $p = $_POST["page"];
		$pager = Pager::getPagerData($cmd->num_rows, $r, $p);
		$i = 1; ?>
			<tr>
				<th width="10"># </th>
				<th width="10"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
				<th class="title" style="width:60%"><a href="#">Tiêu đề</a></th>
				<th width="10%"><a href="#">Đã được bật</a></th>
				<th width="8%" nowrap="nowrap"><a href="#">Sắp xếp</a></th>
				<th class="title" nowrap="nowrap"><a href="#">Chủ đề cha</a></th>
				<th width="1%" nowrap="nowrap"><a href="#" title="Nhấp chuột để sắp xếp theo cột này">ID</a></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="13">
					<del class="container">
						<div class="pagination">
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
					</del>
				</td>
			</tr>
		</tfoot>
		<tbody>
		<?php 
		while($cmd->fetch()){ 
			if($i > $pager->offset && $i <= $pager->limit){
		?>
			<tr class="row0">
				<td align="center"><?php echo $i ?> </td>
				<td><input id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $Cat_Id ?>" onclick="isChecked(this.checked);" type="checkbox"></td>
				<td><span class="editlinktip hasTip"><a href="?com=com_content&view=category&task=edit&id=<?php echo $Cat_Id ?>" title="<?php echo $CatName ?>"><?php echo $CatName ?> </a></span>
				</td>
				<td align="center">
					<?php if($Status == 1) { ?>
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','unpublish')">
							<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php } else if ($Status == 0) { ?>			
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','publish')">
							<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php }	?>
				</td>
				<td class="order">
					<?php if($cmd->num_rows > 1){ ?>

						<?php if($i == 1){ ?>
		
							<span>&nbsp;</span>
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
							<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text" readonly="true">
	
						<?php } else if($i == $cmd->num_rows){ ?>
							
							<span>&nbsp;</span>
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
							<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text" readonly="true">
	
						<?php }	else {?>
	
							<span>&nbsp;</span>
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
							<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text" readonly="true">
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
	
						<?php } ?>		
	
					<?php } else { ?>
						
						<span>&nbsp;</span>
						<span><a href="javascript:void(0);" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
						<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text" readonly="true">
	
					<?php } ?>
				</td>
				<td align="center"><?php echo $Title ?> </td>
				<td align="center"><?php echo $Cat_Id ?> </td>
			</tr>
			<?php }	
		$i++;
		} ?>
		</tbody>
		</table>

		<input type=hidden name=page value=<?php echo $p; ?>>
		<INPUT type=hidden value=submit_com_content_category_view name=hidden>
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