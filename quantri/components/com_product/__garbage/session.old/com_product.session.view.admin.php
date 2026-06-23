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
					<a href=".?com=com_product&view=session&task=add" class="toolbar">
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
				
				<div class="header icon-48-sections">Sản phẩm » <small>Chủng loại » </small><small><small>Danh sách</small></small></div>

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
			<?php
				$myProcess = new process();
				$result = $myProcess->getSessionList();
				$session_total_row = $result->rowCount();
				$s = 1;
			?>
			<tr>
				<th width="3%"> <a href="javascript:void(0)">STT</a></th>
				<th width="3%" nowrap="nowrap"><a href="javascript:void(0)">ID</a></th>				
				<th class="title" style="width:80%;text-align:left;"><a href="javascript:void(0)">Chủng loại</a></th>
				<th width="5%"><a href="javascript:void(0)">Hiển thị</a></th>
				<th width="14%" nowrap="nowrap"><a href="javascript:void(0)">Sắp xếp</a> <a href="javascript:checkAllByOrder(<?php echo $session_total_row; ?>);submitbutton('order');">[Save]</a></th>
				<th width="19%" nowrap="nowrap" style="text-align:left;"><input name="toggle" value="" onclick="checkAll(<?php echo $session_total_row; ?>);" type="checkbox"></th>
				
			</tr>
		</thead>
		
		<tbody>
		<?php while($row = $result->fetch())
		{
			extract($row);
			?>
			<tr class="row0">
				<td align="center"><?php echo $s ?></td>
				<td align="center"><?php echo $Id ?></td>				
				<td>
					<span class="editlinktip hasTip" title="<?php echo $session_name ?> ">
						<a href=".?com=com_product&view=session&task=edit&id=<?php echo $Id ?>"><?php echo $session_name ?></a>
					</span>
				</td>
				<td align="center">
					<?php if($status == 1) { ?>
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $s ?>','unpublish')">
							<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php } else if ($status == 0) { ?>			
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $s ?>','publish')">
							<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php }	?>
				</td>
				<td class="order">
					<?php if($session_total_row > 1){ ?>
	
						<?php if($s == 1){ ?>
							<span> &nbsp; </span>
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $s ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
							<input name="order[]" size="5" value="<?php echo $s ?>" class="text_area" style="text-align: center;" type="text">
	
						<?php } else if($s == $session_total_row){ ?>
							
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $s ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
							<span> &nbsp; </span>
							<input name="order[]" size="5" value="<?php echo $s ?>" class="text_area" style="text-align: center;" type="text">
	
						<?php }	else {?>
	
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $s ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $s ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
							<input name="order[]" size="5" value="<?php echo $s ?>" class="text_area" style="text-align: center;" type="text">
	
						<?php } ?>		
	
					<?php } else { ?>

						<span><a href="javascript:void(0);" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>						
						<input name="order[]" size="5" value="<?php echo $s ?>" class="text_area" style="text-align: center;" type="text">
	
					<?php } ?>
				</td>
				<td><input type="checkbox" id="cb<?php echo $s ?>" name="sid[]" value="<?php echo $Id ?>" onclick="isChecked(this.checked);" /></td>			
			</tr>

			
		<?php $s++;	} ?>
		</tbody>
		</table>

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
			!Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị
		</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
<div id="border-bottom"><div><div></div></div></div>
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