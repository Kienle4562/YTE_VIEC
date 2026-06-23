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
<table class="toolbar"><tr>
<td class="button" id="toolbar-publish">
<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn 1 mục từ danh sách để');}else{  submitbutton('publish')}" class="toolbar">
<span class="icon-32-publish" title="Bật">
</span>
Bật
</a>
</td>

<td class="button" id="toolbar-unpublish">
<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn 1 mục từ danh sách để');}else{  submitbutton('unpublish')}" class="toolbar">
<span class="icon-32-unpublish" title="Tắt">
</span>
Tắt
</a>
</td>

<td class="button" id="toolbar-delete">
<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn 1 mục từ danh sách để');}else{  submitbutton('remove')}" class="toolbar">
<span class="icon-32-delete" title="Xóa">
</span>
Xóa
</a>
</td>

<td class="button" id="toolbar-new">
<a href=".?com=com_content&view=session&task=add" class="toolbar">
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

</tr></table>
</div>
<div class="header icon-48-sections">Quản lý chủ đề</div>

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
		<table class="adminlist">
		<thead>
		<?php include("../protected/dbconnect.php");
			include("../protected/back_end_paging.php");
			
			$sql = "Select `Ses_Id`, `Title`, `Description`, `Status`, `Order` From `session` order by `Order` desc";
			$cmd = $mysqli->prepare($sql);
			$cmd->execute();
			$cmd->bind_result($Ses_Id, $Title, $Description, $Status, $Order);
			$cmd->store_result();
			if(!isset($_POST["limit"])) $r = 10; else $r = $_POST["limit"];
			if(!isset($_POST["page"])) $p = 1; else $p = $_POST["page"];
			$pager = Pager::getPagerData($cmd->num_rows, $r, $p);
			$i = 1;
		?>
			<tr>
				<th width="10"># </th>
				<th width="10"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
				<th class="title" style="width:80% "><a href="javascript:void(0)">Tiêu đề</a></th>
				<th width="10%"><a href="javascript:void(0)">Đã được bật</a></th>
				<th width="8%" nowrap="nowrap"><a href="javascript:void(0)">Sắp xếp</a></th>
				<th width="1%" nowrap="nowrap"><a href="javascript:void(0)">ID</a></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="13">
					<del class="container">
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
		<?php while($cmd->fetch()){ 
			if($i > $pager->offset && $i <= $pager->limit){
		?>
			<tr class="row0">
			<td align="center"><?php echo $i ?></td>
			<td><input type="checkbox" id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $Ses_Id ?>" onclick="isChecked(this.checked);" /></td>
			<td>
				<span class="editlinktip hasTip" title="<?php echo $Title ?> ">
					<a href=".?com=com_content&view=session&task=edit&id=<?php echo $Ses_Id ?>"><?php echo $Title ?> </a>
				</span>
			</td>
			<td align="center">
				<?php if($Status == 1) { ?>
					<span class="editlinktip hasTip">
						<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','unpublish')">
						<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
						</a>
						a
					</span>
				<?php } else if ($Status == 0) { ?>			
					<span class="editlinktip hasTip">
						<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','publish')">
						<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
						</a>
						b
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
			<td align="center"><?php echo $Ses_Id ?></td>
			</tr>
		<?php }	
		$i++;
		} ?>
		</tbody>
		</table>

		<input type=hidden name=page value=<?php echo $p; ?>>
		<INPUT type=hidden value=submit_com_content_session_view name=hidden>
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
			!Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị				</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id="border-bottom"><div><div></div></div></div>
<?php
	if (!empty($GLOBALS['msg']))
	{
		?>
			<script language="javascript">
				alert('<?php echo $GLOBALS['msg']; ?>');
			</script>
		<?php
	}
?>