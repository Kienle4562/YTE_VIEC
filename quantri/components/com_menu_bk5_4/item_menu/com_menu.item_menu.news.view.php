<?php defined( '_VALID_MOS' ) or die( include("404.php") ); ?>
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
								<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một mục Menu từ danh sách để');}else{  submitbutton('publish')}" class="toolbar">
									<span class="icon-32-publish" title="Bật"></span>Bật
								</a>
							</td>
							<td class="button" id="toolbar-unpublish">
								<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một mục Menu từ danh sách để');}else{  submitbutton('unpublish')}" class="toolbar">
									<span class="icon-32-unpublish" title="Tắt"></span>Tắt
								</a>
							</td>
							<td class="button" id="toolbar-trash">
								<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một mục Menu từ danh sách để');}else{  submitbutton('remove')}" class="toolbar">
									<span class="icon-32-trash" title="Sọt rác"></span>Sọt rác
								</a>
							</td>
							<td class="button" id="toolbar-new">
								<a href=".?com=com_menu&view=item_menu&task=news.add&menutypeid=<?php echo $_GET["menutypeid"]; ?>" class="toolbar">
									<span class="icon-32-new" title="Thêm mới"></span>Thêm mới
								</a>
							</td>
							<td class="button" id="toolbar-cancel">
								<a href=".?com=com_menu" class="toolbar">
									<span class="icon-32-back" title="Hủy"></span>Quay lại
								</a>
							</td>
							<td class="button" id="toolbar-help">
								<a href="#" onclick="popupWindow('', 'Trợ giúp', 640, 480, 1)" class="toolbar">
									<span class="icon-32-help" title="Trợ giúp"></span>Trợ giúp
								</a>
							</td>
						</tr>
					</table>
				</div>
				<div class="header icon-48-menu">
					<?php
						$myprocess = new process();
						$__menu = $myprocess->get_main_menu_edit($_GET['menutypeid'])->fetch(PDO::FETCH_ASSOC);
					?>
					Menus » 
						<small><?php $core_class->create_lang_flag($__menu['lang_code'], 20); ?> <?php echo $__menu['title']; ?></small>
				</div>
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
				<?php
					function Menu($parentid = 0, $menutypeid = 0, $space = '&nbsp;&nbsp;', $trees = NULL){
						$myprocess = new process();
						$result = $myprocess->process_get_list_item_menu($parentid, $menutypeid);
						if(!$trees) $trees = array(); $k=1;
						while($row = $result->fetch()){	
							$trees[] = array('id'=>$row["id"], 'space'=>$space, 'k'=>$k++, 'num_row'=>$result->rowCount(), 'activated'=>$row["activated"], 'order_num'=>$row["order_num"], 
							'link'=>$row["link"], 'link_id'=>$row["link_id"], 'type'=>$row["type"], 'target'=>$row["target"], 'menu_type_id'=>$row["menu_type_Id"], 'parent'=>$row["parent_Id"], 'title'=>$space.$row["title"]);
							$trees = Menu($row["id"], $menutypeid, $space.'_|__ &nbsp;&nbsp;', $trees);
						}				
						return $trees;
					}
					$Menu = Menu(0, intval($_GET["menutypeid"]));
				?>
				<form method="post" name="phpForm">					
					<table class="adminlist">
						<thead>
							<tr>
								<th width="3%"># </th>
								<th width="3%"><input name="toggle" value="" onclick="checkAll(<?php echo count($Menu); ?>);" type="checkbox"></th>
								<th width="30%"><a href="javascript:void(0)">Danh mục menu</a></th>
								<th width="5%" nowrap="nowrap"><a href="javascript:void(0)">Đã được bật</a></th>
								<th width="15%" nowrap="nowrap"><a href="javascript:void(0)">Sắp xếp</a></th>
								<th width="25%" class="title"><a href="javascript:void(0)">Liên kết</a></th>
								<th width="5%" class="title"><a href="javascript:void(0)">Target</a></th>
								<th width="3%" nowrap="nowrap"><a href="javascript:void(0)">ID</a></th>
							</tr>
						</thead>	
						<tbody>
						<?php 
						$i=1;
						foreach($Menu as $k=>$rs) {
						?>
							<tr class="row<?php if($i % 2 == 0){echo "odd_row";}else{ echo "1";}?>">
								<td align="center"><?php echo $i ?></td>
								<td align="center"><input type="checkbox" id="cb<?php echo $i ?>" name="cid[]" value="<?php echo $rs['id']; ?>" onclick="isChecked(this.checked);" /></td>
								<td nowrap="nowrap">
								<span class="editlinktip hasTip" title="Nhấp chuột để sửa đổi mục Menu này::<?php echo $rs['title']; ?>">
									<img src="<?php echo $rs['link']; ?>" height="16px" align="absmiddle" />
									<a href=".?com=com_menu&view=item_menu&task=news.edit&id=<?php echo $rs['id']; ?>"><?php echo $rs['title']; ?></a>
								</span>
								</td>
								<td align="center">			
									<?php if($rs['activated'] == 1) { ?>
										<span class="editlinktip hasTip" title="Đã được bật">
											<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','unpublish')">
											<img src="template/images/tick.png" alt="Đã được bật" border="0" width="16" height="16">
											</a>
										</span>
									<?php } else if ($rs['activated'] == 0) { ?>			
										<span class="editlinktip hasTip" title="Chưa được bật">
											<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','publish')">
											<img src="template/images/publish_r.png" alt="Chưa được bật" border="0" width="16" height="16">
											</a>
										</span>
									<?php }	?>
								</td>
								<td class="order">
									<?php if($rs['num_row'] > 1){ ?>
					
										<?php if($rs['k'] == 1){ ?>
						
											<span>&nbsp;</span>
											<span><?php echo $rs['space']; ?><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
					
										<?php } else if($rs['k'] == $rs['num_row']){ ?>
											
											<span>&nbsp;</span>
											<span><?php echo $rs['space']; ?><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
					
										<?php }	else {?>
					
											<span>&nbsp;</span>
											<span><?php echo $rs['space']; ?><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
											<span><a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
					
										<?php } ?>		
					
									<?php } else { ?>
										
										<span>&nbsp;</span>
										<span><?php echo $rs['space']; ?><a href="javascript:void(0);" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
					
									<?php } ?>
								</td>
								<td>
									<span class="editlinktip"><?php echo $rs['link_id']; ?></span>
								</td>
								<td align="center"><?php echo $rs['target']; ?> </td>
								<td align="center"><?php echo $rs['id']; ?> </td>
							</tr>
						<?php $i++;} ?>
						</tbody>
						</table>
					<INPUT type="hidden" value="submit_com_menu_item_menu_view" name="hidden">
					<INPUT type="hidden" value="0" name="boxchecked">
					<INPUT type="hidden" name="task">
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