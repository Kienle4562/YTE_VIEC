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
					<a href=".?com=com_product&view=product&task=publisher.add" class="toolbar">
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
		
<div class="header icon-48-article">Quản lý nhà xuất bản</div>

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
	<table class="adminlist" cellspacing="1">
	<thead>
	<?php include("../protected/dbconnect.php");
		include("../protected/back_end_paging.php");
		$sql = "SELECT `book_publishers`.`Id`, `book_publishers`.`publisher_name`, `book_publishers`.`date_add`, `book_publishers`.`status`
				FROM `book_publishers` Order by `book_publishers`.`Id` desc";
			$cmd = $mysqli->prepare($sql);
			$cmd->execute();
			$cmd->bind_result($Id, $publisher_name, $date_add, $status);
			$cmd->store_result();
			if(!isset($_POST["limit"])) $r = 10; else $r = $_POST["limit"];
			if(!isset($_POST["page"])) $p = 1; else $p = $_POST["page"];
			$pager = Pager::getPagerData($cmd->num_rows, $r, $p);
			$i = 1; 
		?>
		<tr>
			<th width="5">#</th>
			<th class="title"><a href="javascript:void(0)">Nhà xuất bản</a></th>
			<th class="title" width="8%" nowrap="nowrap"><a href="javascript:void(0)">Ngày thêm</a></th>
			<th class="title" width="8%" nowrap="nowrap"><a href="javascript:void(0)">Hiển thị</a></th>
			<th class="title" width="8%" nowrap="nowrap"><a href="javascript:void(0)">Sửa</a></th>
			<th width="10"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
		</tr>
	</thead>
	<tfoot>
	<tr>
		<td colspan="15">
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
			<td><a style="cursor:pointer" onClick="window.parent.jSelectArticle(<?php echo "'$Id', '$publisher_name' , 'id'"; ?>)"><?php echo $publisher_name ?> </a></td>
			<td><a title="Sửa chủ đề"><?php echo date('d/m/Y',$date_add); ?> </a></td>
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
			<td align="center"><a title="Sữa thông tin nhà xuất bản" href=".?com=com_product&view=product&task=publisher.edit&id=<?php echo $Id; ?>">Sữa </a></td>
			<td><input type="checkbox" id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $Id ?>" onclick="isChecked(this.checked);" /></td>
		</tr>
		<?php }	
		$i++;
		} ?>
		</tbody>
	</table>
	<input type=hidden name=page value=<?php echo $p; ?>>
	<INPUT type=hidden value=submit_com_publisher_view name=hidden>
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