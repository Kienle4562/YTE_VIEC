<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	
	if (!isset($_SESSION['amdin']['com_product']['category']['lang_code']))
	{
		$_SESSION['amdin']['com_product']['category']['lang_code'] = 'vi';
	}
	
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
								<?php if ($GLOBALS['MULTI_LANG']) { ?>
									<td class="button" id="toolbar-synch">
										<a href="#" class="toolbar" onclick="javascript:submitbutton('synch')">
										<span class="icon-32-synch" title="Đồng bộ ngôn ngữ"></span>
										Đồng bộ ngôn ngữ
										</a>
									</td>
								<?php } ?>
								<td class="button" id="toolbar-publish">
									<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một Chủ đề từ danh sách để');}else{  submitbutton('publish')}" class="toolbar">
									<span class="icon-32-publish" title="Bật"></span>Bật
									</a>
								</td>
								<td class="button" id="toolbar-unpublish">
									<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một Chủ đề từ danh sách để');}else{  submitbutton('unpublish')}" class="toolbar">
									<span class="icon-32-unpublish" title="Tắt"></span>Tắt
									</a>
								</td>
								<td class="button" id="toolbar-delete">
									<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một Chủ đề từ danh sách để');}else{  submitbutton('remove')}" class="toolbar">
										<span class="icon-32-delete" title="Xóa"></span>Xóa
									</a>
								</td>
							
								<td class="button" id="toolbar-new">
									<a href="#" onclick="javascript:submitbutton('add')" class="toolbar">
									<span class="icon-32-new" title="Thêm mới"></span>Thêm mới
									</a>
								</td>
							
								<td class="button" id="toolbar-help">
									<a href="#" onclick="popupWindow('', 'Trợ giúp', 640, 480, 1)" class="toolbar">
									<span class="icon-32-help" title="Trợ giúp"></span>Trợ giúp
									</a>
								</td>
							
							</tr>
						</tbody>
					</table>
				</div>
				
			<div class="header icon-48-sections">Quản lý danh mục sản phẩm</div>

				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
  		</div>
   		<div class="clr"></div>
				
		<div id="element-box" style="margin-bottom:10px;">
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
			
				<strong>
                    <a href=".?com=com_product&view=category&task=view">Danh mục</a> |
                    <a href=".?com=com_product&view=product&task=view">Sản phẩm</a> |
                    <a href=".?com=com_product&view=comment&task=view">Bình luận</a>
                </strong>
				
				<?php if ($GLOBALS['MULTI_LANG']) { ?>
					<div style="float: right">
						<form method="post" name="phpFormTop">
							<strong>Ngôn ngữ:</strong>
							<select name="lang_code" onchange="document.phpFormTop.submit()">
								<?php
									foreach ($GLOBALS['LANG_LIST'] as $key => $item)
									{
										if (isset($_SESSION['amdin']['com_product']['category']['lang_code']) && $_SESSION['amdin']['com_product']['category']['lang_code'] == $key)
										{
											echo '<option value="', $key, '" selected="selected">', $item['lang_name'], '</option>';
										}
										else
										{
											echo '<option value="', $key, '">', $item['lang_name'], '</option>';
										}
									}
								?>
							</select>
							<input type='hidden' value='submit_com_product_category_view' name='hidden'>
						    <input type='hidden' value='change_lang_code' name='task'>
						</form>
					</div>
				<?php } ?>
				
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
		</div>	
			
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
						$myprocess = new process();
						function category($parentid = 0, $level, &$trees)
						{
							global $myprocess;
							$result = $myprocess->get_category_view($parentid, $_SESSION['amdin']['com_product']['category']['lang_code']);
							$k = 1;
							
							while ($row = $result->fetch())
							{
								$trees[] = array(
                                    'id'		=>	$row['cat_id'],
                                    'title'		=>	$row["title"],
                                    'space'		=>	$level,
                                    'k'			=>	$k++,
                                    'num_row'	=>	$result->rowCount(), 
								    'date_add'	=>	$row["date_add"],
                                    'enabled'	=>	$row["enabled"],
									'checked'	    =>	$row["checked"],
                                    'order_num'	=>	$row["ordering"],
                                    'num_view'	=>	$row["num_view"],
                                    'lang_code'	=>	$row['lang_code']
                                );
								category($row["cat_id"], $level + 1, &$trees);
							}
							
							unset($result, $row);
						}
						
						$category = array();
						category(0, 0, &$category);
					?>
						<tr>
							<th width="3%"><a href="#">STT</a></th>
							<th width="3%" nowrap="nowrap"><a href="#">ID</a></th>
							<?php if ($GLOBALS['MULTI_LANG']) { ?>
								<th width="3%" nowrap="nowrap"><a href="#">Ngôn ngữ</a></th>
							<?php } ?>
							<th class="title"><a href="#">Danh mục</a></th>
                            <th width="5%"><a href="#">Kiểu danh mục</a></th>
							<th width="5%"><a href="#">Hiển thị</a></th>
                            
							<th width="5%"><a href="#">Ngày tạo</a></th>							
							<th width="3%"><input name="toggle" value="" onclick="checkAll(<?php echo count($category); ?>);" type="checkbox"></th>		
						</tr>
					</thead>
					
					<tbody>
					<?php
					$total = count($category);
					
					for ($i = 0; $i < $total; $i++) {
					?>
						<tr class="row<?php if ($i % 2 == 0) { echo "0"; } else { echo "1"; } ?>">
							<td align="center"><?php echo $i + 1; ?></td>
							<td align="center"><?php echo $category[$i]['id']; ?></td>
							<?php if ($GLOBALS['MULTI_LANG']) { ?>
								<td align="center"><?php echo $category[$i]['left']; $core_class->create_lang_flag($category[$i]['lang_code'], 16); echo $category[$i]['right']; ?></td>
							<?php } ?>
							<td nowrap="nowrap">
								<span class="editlinktip hasTip" title="Nhấp chuột để sửa đổi danh mục sản phẩm này::<?php echo $category[$i]['title']; ?>">
									&nbsp;&nbsp;<?php echo str_repeat('|_____', $category[$i]['space']); ?>
									<span>
										<?php 
											if ($category[$i]['num_row'] > 1)
											{
												if ($category[$i]['k'] == 1)
												{
													?>
													<img src="template/images/uparrow0.png" alt="Đi Lên" border="0" width="16" height="16">
													<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i + 1; ?>','orderdown')" title="Đi Xuống"><img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a>
													<?php
												}
												else if ($category[$i]['k'] == $category[$i]['num_row'])
												{
													?>
													<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i + 1; ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi Lên" border="0" width="16" height="16"></a>
													<img src="template/images/downarrow0.png" alt="Đi Xuống" border="0" width="16" height="16">
													<?php
												}
												else
												{
													?>
													<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i + 1; ?>','orderup')" title="Đi lên"><img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i + 1; ?>','orderdown')" title="Đi Xuống"><img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a>
													<?php
												}
											}
											else
											{
												?>
												<img src="template/images/downarrow0.png" alt="Đi Xuống" border="0" width="16" height="16">
												<img src="template/images/uparrow0.png" alt="Đi Lên" border="0" width="16" height="16">
												<?php
											}
										?>
									</span>
									<a href=".?com=com_product&view=category&task=edit&id=<?php echo $category[$i]['id']; ?>"><?php echo $category[$i]['title']; ?></a>
								</span>
							</td>
                            <td align="center">			
								<?php
									if ($category[$i]['checked'] == 1)
									{
										?>
										<span class="editlinktip hasTip" title="Đã được bật">
											<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i + 1; ?>','unpublish_c')">
											<img src="template/images/tick.png" alt="Đã được bật" border="0" width="16" height="16">
											</a>
										</span>
										<?php
									}
									elseif ($category[$i]['checked'] == 0)
									{
										?>
										<span class="editlinktip hasTip" title="Chưa được bật">
											<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i + 1; ?>','publish_c')">
											<img src="template/images/publish_r.png" alt="Chưa được bật" border="0" width="16" height="16">
											</a>
										</span>
										<?php
									}
								?>
							</td>
							<td align="center">			
								<?php
									if ($category[$i]['enabled'] == 1)
									{
										?>
										<span class="editlinktip hasTip" title="Đã được bật">
											<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i + 1; ?>','unpublish')">
											<img src="template/images/tick.png" alt="Đã được bật" border="0" width="16" height="16">
											</a>
										</span>
										<?php
									}
									elseif ($category[$i]['enabled'] == 0)
									{
										?>
										<span class="editlinktip hasTip" title="Chưa được bật">
											<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i + 1; ?>','publish')">
											<img src="template/images/publish_r.png" alt="Chưa được bật" border="0" width="16" height="16">
											</a>
										</span>
										<?php
									}
								?>
							</td>
							<td><?php echo date("d/m/Y", $category[$i]['date_add']); ?></td>
							<td align="center"><input type="checkbox" id="cb<?php echo $i + 1; ?>" name="cid[]" value="<?php echo $category[$i]['id']; ?>" onclick="isChecked(this.checked);" /></td>
						</tr>
					<?php } ?>
					</tbody>
					</table>

				    <INPUT type='hidden' value='submit_com_product_category_view' name='hidden'>
				    <INPUT type='hidden' value='0' name='boxchecked'>
				    <INPUT type='hidden' name='task'>
				</form>
		
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
   		</div>
		<noscript>!Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
<div id="border-bottom"><div><div></div></div></div>