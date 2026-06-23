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
<a href=".?com=com_product&view=manufacturer&task=add" class="toolbar">
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
<div class="header icon-48-sections">Danh sách nhà sản xuất</div>

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
		$sql = "SELECT `book_manufacturers`.`Id`, `book_manufacturers`.`title`, `book_manufacturers`.`description`, `book_manufacturers`.`logo`, `book_manufacturers`.`website`, 
				`book_manufacturers`.`yahoo`, `book_manufacturers`.`skype`, `book_manufacturers`.`status`,
				`book_manufacturers`.`sticky`, `book_manufacturers`.`date_add`, `book_manufacturers`.`order_num`
				FROM `book_manufacturers` ORDER BY `book_manufacturers`.`order_num` DESC";
		$cmd = $mysqli->prepare($sql);
		$cmd->execute();
		$cmd->bind_result($Id, $title, $description, $logo, $website, $yahoo, $skype, $status, $sticky, $date_add, $order_num);
		$cmd->store_result();
		$session_total_row = $cmd->num_rows;		
		if(!isset($_POST["limit"])) $r = 10; else $r = $_POST["limit"];
		if(!isset($_POST["page"])) $p = 1; else $p = $_POST["page"];
		$pager = Pager::getPagerData($cmd->num_rows, $r, $p);
		$i = 1;
		?>
			<tr>
				<th width="3%"> <a href="#">STT</a> </th>
				<th width="3%" nowrap="nowrap"><a href="#">ID</a></th>
				<th class="title" nowrap="nowrap"><a href="#">Logo</a></th>
				<th class="title" style="width:30%"><a href="#">Tên nhà sản xuất</a></th>
				<th class="title" nowrap="nowrap"><a href="#">Website</a></th>
				<th width="5%"><a href="#">Hiển thị</a></th>
				<th width="5%"><a href="#">Chọn VIP</a></th>
				<th width="8%" nowrap="nowrap"><a href="#">Sắp xếp</a><a href="javascript:checkAllByOrder(<?php echo $r; ?>, '', 'order');"><img src="template/images/icon-32-revert.png"></a> </th>
				<th align="center" width="10"><a href="javascript:void(0)">Copy</a></th>
				<th width="10"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="10">
					<del class="container">
						<div class="pagination">
							Bạn đang xem trang: <?php echo $pager->page ?> của tổng số <?php echo $pager->numPages ?> trang <br>
							<?php echo $pager->paging ?> <br>
							Hiển thị #
							<select name="limit" class="inputbox" size="1" onchange="document.phpForm.submit();">
								<?php 
									for($j = 5; $j <= 100; $j = $j + 5){ 
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
				<td align="center"><?php echo $Id ?></td>
				<td>
					<?php if($logo = "Chọn file logo cần upload ..."){ ?>
					<span class="editlinktip hasTip" title="<?php echo strip_tags($description); ?>">
						<img src="../images/no-logo.png" width="150" height="100" />
					</span>
					<?php } else { ?>
					<span class="editlinktip hasTip" title="<?php echo strip_tags($description); ?>">
						<img src="./<?php echo $logo ?>" />
					</span>
					<?php } ?>
				</td>
				<td>
					<a href=".?com=com_product&view=manufacturer&task=edit&id=<?php echo $Id ?>"><?php echo $title ?></a>
				</td>
				<td>
					<a href="<?php echo $website; ?>"><?php echo $website; ?></a>
				</td>
				<td align="center">
					<?php if($status == 1) { ?>
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','unpublish')">
							<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php } else if ($status == 0) { ?>			
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','publish')">
							<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php }	?>
				</td>
				<td align="center">
					<?php if($sticky == 1) { ?>
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','unsticky')">
							<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php } else if ($sticky == 0) { ?>	
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','sticky')">
							<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php }	?>
				</td>
				<td class="order">
					<?php if($session_total_row > 1){ ?>
	
						<?php if($i == 1){ ?>
							<span> &nbsp; </span>
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
							<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text">
	
						<?php } else if($i == $session_total_row){ ?>
							
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
							<span> &nbsp; </span>
							<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text">
	
						<?php }	else {?>
	
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
							<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
							<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text">
	
						<?php } ?>		
	
					<?php } else { ?>

						<span><a href="javascript:void(0);" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>						
						<input name="order[]" size="5" value="<?php echo $i ?>" class="text_area" style="text-align: center;" type="text">
	
					<?php } ?>
				</td>
				<td align="center" nowrap="nowrap"><a href=".?com=com_product&view=manufacturer&task=copy&id=<?php echo $Id; ?>"><img width="23" src="template/images/copy_f2.png"></a></td>
				<td><input type="checkbox" id="cb<?php echo $i ?>" name="sid[]" value="<?php echo $Id ?>" onclick="isChecked(this.checked);" /></td>			
			</tr>

			
		<?php }	
		$i++;
		} ?>
		</tbody>
		</table>

		<input type=hidden name=page value=<?php echo $p; ?>>
		<INPUT type=hidden value=submit_com_product_manufacturer_view name=hidden>
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