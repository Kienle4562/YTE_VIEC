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
						<td class="button" id="toolbar-delete">
							<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một items từ danh sách để');}else if(confirm('Bạn có chắc chắn muốn xóa những items được chọn không? ')){  submitbutton('remove')}" class="toolbar">
								<span class="icon-32-delete" title="Xóa"></span>Xóa
							</a>
						</td>					
						<td class="button" id="toolbar-new">
							<a href="?com=com_menu&view=main_menu&task=add" class="toolbar">
								<span class="icon-32-new" title="Thêm mới"></span>Thêm mới
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
			<div class="header icon-48-menumgr">Menus</div>

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
				
			<script language="javascript" type="text/javascript">
			<!--
				function submitbutton(task)
				{
					var f = document.phpForm;
					if (task == 'deleteconfirm') {
						id = radioGetCheckedValue( f.id );
						//document.popup.show('index.php?option=com_menus&tmpl=component&task=deleteconfirm&id='+id, 700, 500, null);
					} else {
						submitform(task);
					}
				}
			
				function menu_listItemTask( id, task, option )
				{
					var f = document.phpForm;
					cb = eval( 'f.' + id );
					if (cb) {
						cb.checked = true;
						submitbutton(task);
					}
					return false;
				}
			//-->
			</script>

			<form method="post" name="phpForm">
			<?php
				$myprocess = new process();
				$result = $myprocess->get_main_menu();
				$i = 1;
			?>
				<table class="adminlist">
				<thead>
					<tr>
						<th width="20">#</th>
						<th width="20"><input name="toggle" value="" onclick="checkAll(<?php echo count($result); ?>);" type="checkbox"></th>
						<th class="title" nowrap="nowrap">Tên nhóm</th>
						<th width="15%">Định danh (alias)</th>
						<th width="5%" nowrap="nowrap">Items menu</th>
						<th width="3%">ID</th>
					</tr>
				</thead>
				<tbody>
				<?php while($row = $result->fetch()){ ?>
					<tr class="row0">
						<td align="center" width="30"><?php echo $i ?></td>
						<td width="30" align="center">
							<?php if($row["isroot"] == 1){ ?>
								<a href="javascript:void(0);"><img src="template/security.png" /></a>
							<?php } else { ?>
								<input id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $row['Id']; ?>" onclick="isChecked(this.checked);" type="checkbox">
							<?php } ?>
						</td>
						<td>
							<?php $core_class->create_lang_flag($row['lang_code'], 20); ?>
							<span class="editlinktip hasTip" title="<?php echo $row["title"]; ?>::click vào để thay đổi nhóm menu">
								<a href=".?com=com_menu&view=main_menu&task=edit&id=<?php echo $row["Id"]; ?>"><?php echo $row["title"]; ?></a>
							</span>
						</td>
						<td align="center"><?php echo $row["alias"]; ?></td>
						<td align="center">
							<a href=".?com=com_menu&view=item_menu&task=view&menutypeid=<?php echo $row["Id"]; ?>" title="Sửa các mục Menu">
								<img src="template/mainmenu.png" border="0" />
							</a>
						</td>
						<td align="center"><?php echo $row["Id"]; ?></td>
					</tr>
				<?php 
				$i++;
				}?>
				</tbody>
			</table>
		
			<input type=hidden name=page value=<?php echo $p; ?>>
			<INPUT type=hidden value=submit_com_menu_main_menu_view name=hidden>
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