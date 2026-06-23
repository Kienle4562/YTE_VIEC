<?php defined( '_VALID_MOS' ) or die( include("404.php") );
if($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator"){ 
// bat dau thuc thi voi quyen Supper Administrator va Administrator
?>
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
					<td class="button" id="toolbar-publish">
					<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một bài viết từ danh sách để');}else{  submitbutton('publish')}" class="toolbar">
					<span class="icon-32-publish" title="Bật">
					</span>
					Bật
					</a>
					</td>
					
					<td class="button" id="toolbar-unpublish">
					<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một bài viết từ danh sách để');}else{  submitbutton('unpublish')}" class="toolbar">
					<span class="icon-32-unpublish" title="Tắt">
					</span>
					Tắt
					</a>
					</td>
					
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
		
<div class="header icon-48-article">Sản phẩm » <small>Danh sách</small></div>

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
				<SELECT class="inputbox" onchange="document.phpForm.submit();" size="1" name="sectionid">
					<OPTION value="0" selected>- Chọn chủng loại sản phẩm -</OPTION>

					<?php
						$myProcess = new process();
						$result = $myProcess->getCompactSessionList();
						
						if (isset($_POST["sectionid"]))
						{
							while ($row = $result->fetch())
							{
								extract($row);
								
								if($Id == $_POST["sectionid"])
								{
									?><OPTION selected value=<?php echo $Id ?>><?php echo $session_name ?></OPTION><?php 
								} 
								else 
								{ 
									?><OPTION value=<?php echo $Id ?>><?php echo $session_name ?></OPTION><?php 
								}
							}
						} 
						else if (isset($_GET["sid"]))
						{
							while ($row = $result->fetch())
							{
								extract($row);
								if ($Id == $_GET["sid"])
								{
									?><OPTION selected value=<?php echo $Id ?>><?php echo $session_name ?></OPTION><?php 
								}
								else
								{
									?><OPTION value=<?php echo $Id ?>><?php echo $session_name ?></OPTION><?php
								}
							}
						}
						else
						{
							while ($row = $result->fetch())
							{
								extract($row);
								?><OPTION value=<?php echo $Id ?>><?php echo $session_name ?></OPTION><?php
							}
						}
					?>	 

				</SELECT>
				<SELECT class=inputbox onchange="document.phpForm.submit( );" size="1" name="catid">
					<OPTION value="0" selected>- Chọn danh mục sản phẩm -</OPTION>

					<?php 
						$tmpID = null;
						
						if (isset($_POST["sectionid"]) && $_POST["sectionid"] != 0)
						{
							$tmpID = intval($_POST["sectionid"]);
						}
						else if (isset($_GET["sid"]))
						{
							$tmpID = intval($_GET["sid"]);
						}
						
						$result = $myProcess->getCompactCategoryList($tmpID);
						
						if (isset($_POST["catid"]))
						{
							while ($row = $result->fetch())
							{
								extract($row);
								if ($Id == $_POST["catid"])
								{
									?><OPTION selected value=<?php echo $Id ?>><?php echo $category_name ?></OPTION><?php
								}
								else
								{
									?><OPTION value=<?php echo $Id ?>><?php echo $category_name ?></OPTION><?php
								}
							}
						}
						else if (isset($_GET["cid"]))
						{
							while ($row = $result->fetch())
							{
								extract($row);
								if ($Id == $_GET["cid"])
								{
									?><OPTION selected value=<?php echo $Id ?>><?php echo $category_name ?></OPTION><?php
								}
								else
								{
									?><OPTION value=<?php echo $Id ?>><?php echo $category_name ?></OPTION><?php
								}
							}
						}
						else
						{
							while ($row = $result->fetch())
							{
								extract($row);
								?><OPTION value=<?php echo $Id ?>><?php echo $category_name ?></OPTION><?php
							}
						}
					?>
				</SELECT>

			</td>
			</tr>
		</tbody>
	</table>
	<table class="adminlist" cellspacing="1">
	<thead>
	<?php 
		/*
		include("../protected/dbconnect.php");
		include("../protected/back_end_paging.php");
		$sql = "SELECT `tb1`.*,`tb`.`book_category_group` FROM (
				SELECT
				  `book_product`.`Id` as `book_product_id`, `book_product`.`SPID`, `book_session`.`session_name`, `book_category`.`category_name`, 
				  `book_product`.`product_name`, `book_product`.`price`,
				  `book_product`.`hot_product`, `book_product`.`num_view`, `book_product`.`status`, 
				  `book_product`.`date_add`, `book_product`.`order_num`, `account`.`FullName`, `book_session`.`Id` as `book_session_id`,
				  `book_product`.`book_category_id`
				FROM
				  `book_session` INNER JOIN `book_category` ON `book_session`.`Id` = `book_category`.`book_session_id`
				  INNER JOIN `book_product` ON `book_category`.`Id` = `book_product`.`book_category_id`
				  INNER JOIN `account` ON `account`.`Ac_Id` = `book_product`.`account_id`
				) 
				as `tb1` LEFT JOIN (
				SELECT `book_category_id`, COUNT(book_category_id) as `book_category_group` from `book_product` GROUP BY `book_category_id`
				) 
				as `tb` 
				ON `tb`.`book_category_id` = `tb1`.`book_category_id`
				WHERE `tb1`.`book_session_id` LIKE ? AND `tb1`.`book_category_id` LIKE ?
				ORDER BY `tb1`.`book_session_id`, `tb1`.`book_category_id`, `tb1`.`order_num` DESC";
			$cmd = $mysqli->prepare($sql);
			*/
			if(isset($_POST["sectionid"]) && isset($_POST["catid"])) {
				if(intval($_POST["sectionid"]) == 0){$sid = "%%";} else {$sid = intval($_POST["sectionid"]);}
				if(intval($_POST["catid"]) == 0){$cid = "%%";} else {$cid = intval($_POST["catid"]);}
			} else if(isset($_GET["sid"]) && isset($_GET["cid"])){
				if(intval($_GET["sid"]) == 0){$sid = "%%";} else {$sid = intval($_GET["sid"]);}
				if(intval($_GET["cid"]) == 0){$cid = "%%";} else {$cid = intval($_GET["cid"]);}
			} else {
				$sid = "%%"; $cid = "%%";
			}
			/*
			$cmd->bind_param("ss", $sid, $cid);
			$cmd->execute();
			$cmd->bind_result($book_product_id, $SPID, $session_name, $category_name, $product_name, $price, $hot_product, $num_view,
			$status, $date_add, $order_num, $FullName, $book_session_id, $book_category_id, $book_category_group);
			$cmd->store_result();
			*/
			$myProcess = new process();
			$result = $myProcess->getList($sid, $cid);
			$i = 1; $stt = 1; $order_icon = 0;
			while ($row = $result->fetch())
			{
				extract($row);
				if($i == 1 && $book_category_group != 1){ $order_icon = 1; }
				else if($i == $book_category_group && $book_category_group != 1){ $order_icon = 2; $i = 0;}
				else if($book_category_group !=1){ $order_icon = 3; }
				else { $order_icon = 0; $i = 0;}
				
				$table_result[] = array(
					'stt'=>$stt++, 
					'id'=>$book_product_id, 
					'SPID'=>$SPID, 
					'session_name'=>$session_name, 
					'category_name'=>$category_name, 
					'product_name'=>$product_name, 
					'price'=>$price, 
					'publication_date'=>$publication_date, 
					'hot_product'=>$hot_product, 
					'num_view'=>$num_view, 
					'status'=>$status, 
					'date_add'=>$date_add, 
					'order_num'=>$order_num,
					'FullName'=>$FullName,
					'order_icon'=>$order_icon,
					'book_category_id'=>$book_category_id,
					'book_session_id'=>$book_session_id
				);
				$i++;
			}
			
			/* ---  lay tong so dong du lieu --- */
			$product_total_row = count($table_result);
			
			include("../protected/back_end_paging.php");
			if(!isset($_POST["limit"])) $r = 10; else $r = $_POST["limit"];
			if(!isset($_POST["page"])) $p = 1; else $p = $_POST["page"];
			$pager = Pager::getPagerData($product_total_row, $r, $p);
			$i = 1; 
		?>
		<tr>
			<th width="3%">STT</th>
			<th class="title" width="3%"><a href="javascript:void(0)">ID</a></th>			
			<th class="title" width="10%" nowrap="nowrap"><a href="javascript:void(0)">Chủng loại</a></th>
			<th class="title" width="15%" nowrap="nowrap"><a href="javascript:void(0)">Danh mục</a></th>
			<th class="title"><a href="javascript:void(0)">Tên sản phẩm</a></th>
			<th width="8%" nowrap="nowrap"><a href="javascript:void(0)">Đơn giá</a></th>
			<th width="1%" nowrap="nowrap"><a href="javascript:void(0)">Tiêu điểm</a></th>
			<th width="1%" nowrap="nowrap"><a href="javascript:void(0)">Hiển thị</a></th>
			<th width="8%" nowrap="nowrap"><a href="#">Sắp xếp</a><a href="javascript:checkAllByOrder(<?php echo $r; ?>, '', 'order');"><img src="template/images/icon-32-revert.png"></a> </th>
			<th class="title" width="8%" nowrap="nowrap"><a href="javascript:void(0)">Tác giả</a></th>
			<th align="center" width="10"><a href="javascript:void(0)">Ngày thêm</a></th>
			<th align="center" width="10"><a href="javascript:void(0)">Lần xem</a></th>
			<th align="center" width="10"><a href="javascript:void(0)">Copy</a></th>
			<th width="5"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="14">
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
		if($product_total_row > 0){
		foreach($table_result as $k=>$rs) {
			if($rs['stt'] > $pager->offset && $rs['stt'] <= $pager->limit){ ?>
				<tr class="row0">
					<td align="center"><?php echo $rs['stt'] ?></td>
					<td align="center"><?php echo $rs['id'] ?></td>			
					<td align="right"><a href=".?com=com_product&view=product&task=view&sid=<?php echo $rs['book_session_id'] ?>&cid=<?php echo $rs['book_category_id'];?>" title="Chủng loại sản phẩmề"><?php echo $rs['session_name'] ?> =></a></td>
					<td align="right"><a href=".?com=com_product&view=product&task=view&sid=<?php echo $rs['book_session_id'] ?>&cid=<?php echo $rs['book_category_id'];?>" title="Danh mục sản phẩm"><?php echo $rs['category_name'] ?> =></a></td>
					<td><a href=".?com=com_product&view=product&task=edit&id=<?php echo $rs['id'] ?>"><?php echo $rs['product_name'] ?> </a></td>
					<td><a href="#" title="Danh mục sản phẩm"><?php echo $core_class->convertIntToMoney($rs['price']); ?> VNĐ</a></td>
					<td align="center">
					<?php if($rs['hot_product'] == 1) { ?>
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','unpublishfocus')">
							<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php } else if ($rs['hot_product'] == 0) { ?>			
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','publishfocus')">
							<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php }	?>
					</td>
					<td align="center">
				
					<?php if($rs['status'] == 1) { ?>
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','unpublish')">
							<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
							</a>
						</span>
					<?php } else if ($rs['status'] == 0) { ?>			
						<span class="editlinktip hasTip">
							<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','publish')">
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
					<td><a href="#" title="Sửa thành viên"><?php echo $rs['FullName'] ?></a></td>
					<td nowrap="nowrap"><?php echo date('d/m/Y', $rs['date_add']) ?></td>
					<td align="center" nowrap="nowrap"><?php echo $rs['num_view'] ?></td>
					<td align="center" nowrap="nowrap"><a href=".?com=com_product&view=product&task=copy&id=<?php echo $rs['id'] ?>"><img width="23" src="template/images/copy_f2.png"></a></td>
					<td align="center"><input id="cb<?php echo $rs['stt'] ?>" name="cid[]" value="<?php echo $rs['id'] ?>" onclick="isChecked(this.checked);" type="checkbox"></td>
				</tr>
		<?php 
				}
			}
		} ?>
		</tbody>
	</table>

		<input type=hidden name=page value=<?php echo $p; ?>>
		<INPUT type=hidden value=submit_com_content_product_view name=hidden>
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