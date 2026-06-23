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
				<div class="header icon-48-sections">Sản phẩm » <small>Danh mục » </small><small><small>Danh sách</small></small></div>

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
			<SELECT class="inputbox" onchange="window.open('.?com=com_product&view=category&task=view&id='+this.options[this.selectedIndex].value,'_self');this.options[0].selected=true" size="1" name="sectionid">
				<OPTION value="0" selected>- Chọn chủng loại sản phẩm -</OPTION>
				  <?php
					$myProcess = new process();
					$result = $myProcess->getCompactSessionList();
					
					while($row = $result->fetch())
					{
						extract($row);
						if($Id == $_GET["id"]){?>
						<OPTION selected value="<?php echo $Id ?>"><?php echo $session_name ?></OPTION>
						<?php } else { ?>
							<OPTION value="<?php echo $Id ?>"><?php echo $session_name ?></OPTION>
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
		<?php 
		include("../protected/back_end_paging.php");
		/* include("../protected/dbconnect.php");
		$sql = "SELECT `tb1`.*,`tb`.`book_session_group` FROM (
				SELECT `book_category`.`Id`, `book_category`.`category_name`, `book_category`.`date_add`, `book_category`.`status`,
				`book_category`.`order_num`, `book_session`.`session_name`, `book_session_id`
				FROM `book_session` INNER JOIN `book_category` ON `book_session`.`Id` = `book_category`.`book_session_id`) 
				as `tb1` LEFT JOIN (SELECT `book_session_id`, COUNT(book_session_id) as `book_session_group` from `book_category` GROUP BY `book_session_id`) 
				as `tb` ON `tb`.`book_session_id` = `tb1`.`book_session_id`
				WHERE `tb`.`book_session_id` LIKE ?
				ORDER BY `tb1`.`book_session_id`, `tb1`.`order_num` DESC";
		$cmd = $mysqli->prepare($sql);*/
		
		$myProcess = new process();
		
		if (intval($_GET["id"]) == 0) 
		{
			$filter = "%%";
		}
		else
		{
			$filter = "%" . intval($_GET["id"]) . "%";
		}

		/*$cmd->bind_param("s", $filter);
		$cmd->execute();
		$cmd->bind_result($id, $category_name, $date_add, $status, $order_num, $session_name, $book_session_id, $book_session_group);
		$cmd->store_result();*/
		
		$result = $myProcess->getCategoryList($filter);
		
		$i = 1; $stt = 1; $order_icon = 0;
		
		while ($row = $result->fetch())
		{
			extract($row);
			if ($i == 1 && $book_session_group != 1) { $order_icon = 1; }
			else if($i == $book_session_group && $book_session_group != 1){ $order_icon = 2; $i = 0;}
			else if($book_session_group !=1){ $order_icon = 3; }
			else { $order_icon = 0; $i = 0;}
			
			$table_result[] = array(
				'stt'=>$stt++, 
				'id'=>$id, 
				'category_name'=>$category_name, 
				'date_add'=>$date_add, 
				'status'=>$status, 
				'order_num'=>$order_num,
				'order_icon'=>$order_icon,
			 	'session_name'=>$session_name, 
				'book_session_id'=>$book_session_id
			);
			$i++;
		}
		
		/* ---  lay tong so dong du lieu --- */
		$category_total_row = count($table_result);
		/* ---  chuan bi cho phan trang --- */
		if(!isset($_POST["limit"])) $r = 10; else $r = intval($_POST["limit"]);
		if(!isset($_POST["page"])) $p = 1; else $p = intval($_POST["page"]);
		$pager = Pager::getPagerData($category_total_row, $r, $p);
		$k = 1; $i = 1; 
		?>
			<tr>
				<th width="3%"> <a href="#">STT</a> </th>
				<th width="3%" nowrap="nowrap"><a href="#">ID</a></th>
				<th class="title" nowrap="nowrap"><a href="#">Chủng loại</a></th>
				<th class="title" style="width:60%"><a href="#">Danh mục sản phẩm</a></th>
				<th width="5%"><a href="#">Hiển thị</a></th>
				<th width="8%" nowrap="nowrap"><a href="#">Sắp xếp</a><a href="javascript:checkAllByOrder(<?php echo $r; ?>, '', 'order');"><img src="template/images/icon-32-revert.png"></a> </th>
				<th width="10"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
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
		<?php 
		if($category_total_row > 0){
			foreach($table_result as $k=>$rs) {
				if($rs['stt'] > $pager->offset && $rs['stt'] <= $pager->limit){ ?>
				<tr class="row0">
					<td align="center"><?php echo $rs['stt']; ?> </td>
					<td align="center"><?php echo $rs['id']; ?> </td>
					<td align="right"><a href="?com=com_product&view=session&task=edit&id=<?php echo $rs['book_session_id']; ?>" title="<?php echo $rs['session_name']; ?>"><?php echo $rs['session_name']; ?> =></a> </td>
					<td><span class="editlinktip hasTip"><a href="?com=com_product&view=category&task=edit&id=<?php echo $rs['id']; ?>" title="<?php echo $rs['category_name']; ?>"><?php echo $rs['category_name']; ?> </a></span>
					</td>
					<td align="center">
						<?php if($rs['status'] == 1) { ?>
							<span class="editlinktip hasTip">
								<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt']; ?>','unpublish')">
								<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
								</a>
							</span>
						<?php } else if ($rs['status'] == 0) { ?>			
							<span class="editlinktip hasTip">
								<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt']; ?>','publish')">
								<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
								</a>
							</span>
						<?php }	?>
					</td>
					<td class="order">
	
						<?php if($rs['order_icon'] == 1){ ?>
							<span> &nbsp; </span>
							<span><a href="javascript:void(0);" onclick="return OrderDown('cb<?php echo $rs['stt']; ?>', 'cb<?php echo $rs['stt']+1; ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
							<input name="order[]" size="5" value="<?php echo $rs['order_num']; ?>" class="text_area" style="text-align: center;" type="text">
							
						<?php } else if($rs['order_icon'] == 2){ ?>
							
							<span><a href="javascript:void(0);" onclick="return OrderUp('cb<?php echo $rs['stt']; ?>', 'cb<?php echo $rs['stt']-1; ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
							<span> &nbsp; </span>
							<input name="order[]" size="5" value="<?php echo $rs['order_num']; ?>" class="text_area" style="text-align: center;" type="text">
	
						<?php }	else if($rs['order_icon'] == 3){ ?>
	
							<span><a href="javascript:void(0);" onclick="return OrderUp('cb<?php echo $rs['stt']; ?>', 'cb<?php echo $rs['stt']-1; ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
							<span><a href="javascript:void(0);" onclick="return OrderDown('cb<?php echo $rs['stt']; ?>', 'cb<?php echo $rs['stt']+1; ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
							<input name="order[]" size="5" value="<?php echo $rs['order_num']; ?>" class="text_area" style="text-align: center;" type="text">
						
						<?php }	else { ?>
							<span> &nbsp; </span>
							<span> &nbsp; </span>
							<input name="order[]" size="5" value="<?php echo $rs['order_num']; ?>" class="text_area" style="text-align: center;" type="text">
						<?php } ?>
	
					</td>				
					<td><input id="cb<?php echo $rs['stt']; ?>" name="cid[]" value="<?php echo $rs['id']; ?>" onclick="isChecked(this.checked);" type="checkbox"></td>
				</tr>
					<?php 
	
				}
			}
		}?>
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