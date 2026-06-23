<div id="content-box">
		<div class="border">
			<div class="padding">
				
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
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="9">
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
					<a style="cursor:pointer" onClick="window.parent.jSelectArticle(<?php echo "'$Id', '$title' , 'id'"; ?>)"><?php echo $title ?> </a>
				</td>
				<td>
					<a href="<?php echo $website; ?>"><?php echo $website; ?></a>
				</td>						
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