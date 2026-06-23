<?php defined( '_VALID_MOS' ) or die( include("404.php") ); ?>
<div id="content-box">
<div class="border">
		<div class="padding">

		<!-- toolbar -->
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
						<td class="button" id="toolbar-save">
							<a href="#" onclick="javascript: submitbutton('save')" class="toolbar">
								<span class="icon-32-save" title="Lưu"></span>Lưu và thoát
							</a>
						</td>
						
						<td class="button" id="toolbar-apply">
							<a href="#" onclick="javascript: submitbutton('apply')" class="toolbar">
								<span class="icon-32-apply" title="Lưu và thoát"></span>Lưu
							</a>
						</td>
						
						<td class="button" id="toolbar-cancel">
							<a href=".?com=com_menu" class="toolbar">
								<span class="icon-32-cancel" title="Hủy"></span>Hủy
							</a>
						</td>
						
						<td class="button" id="toolbar-help">
							<a href="#" onclick="popupWindow('http://help.joomla.org/index2.php?option=com_content&amp;task=findkey&amp;tmpl=component;1&amp;keyref=screen.users.edit.15', 'Trợ giúp', 640, 480, 1)" class="toolbar">
								<span class="icon-32-help" title="Trợ giúp"></span>Trợ giúp
							</a>
						</td>
					</tr>
				</table>
			</div>
			<div class="header icon-48-menumgr">Menus » <small>Tạo mới</small></div>

		<div class="clr"></div>
		</div>
		
		<div class="b">
			<div class="b">
				<div class="b"></div>
			</div>
		</div>
	</div>
	
	<!-- end toolbar -->
	
	
	<div class="clr"></div>
			
	<div id="element-box">
		<div class="t">
			<div class="t">
				<div class="t"></div>
			</div>
		</div>
		
	<div class="m">

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.phpForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (trim(form.title.value) == "") {
			alert( "Bạn phải khai báo tiêu đề." );
			form.title.focus();
			return;
		} else {
			if(form.alias.value == ''){
				form.alias.value = form.title.value;
			}
			submitform(pressbutton);
		}
	}
</script>
<form method="post" name="phpForm">
	<div>
		<fieldset class="adminform">
		<legend>Thông tin menu</legend>
			<table class="admintable" cellspacing="1">
			<tr>
				<td class="key">
					<label for="title">Tiêu đề </label>
				</td>
				<td>
					<input type="text" name="title" id="title" class="inputbox" size="40" value="" autocomplete="off" /> 
					<span class="editlinktip hasTip" title="tiêu đề hiển thị của menu::tiêu đề hiển thị của menu">
						<img src="template/images/help16x16.gif" />
					</span>
				</td>
			</tr>
			<tr>
				<td class="key" nowrap="nowrap">Ngôn ngữ:</td>
				<td colspan="2">
					<select name="lang_code">
						<?php
							foreach ($GLOBALS['LANG_LIST'] as $key => $item)
							{
								echo 	'<option value="', $key, '"', (($key == 'vi') ? ' selected="selected"' : ''), '>',
											$item['lang_name'],
										'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="150" class="key"><label for="alias">Định danh (alias) </label>
				</td>
				<td>
					<input type="text" name="alias" id="alias" class="inputbox" size="40" value="" /> 
					<span class="editlinktip hasTip" title="Định danh(alias)::tên định danh menu dùng hiển thị khi tạo template (lưu ý: không nên có khoảng cách và dấu)">
						<img src="template/images/help16x16.gif" />
					</span>
				</td>
			</tr>
			<tr>
				<td class="key">
					<label for="title">Cho phép hiển thị </label>
				</td>
				<td>
					<label for="published0">No</label>
					<input type="radio" name="published" id="published0" value="0" />
					<label for="published1">Yes</label>
					<input type="radio" name="published" id="published1" value="1" checked="checked" />
				</td>
			</tr>
			</table>
		</fieldset>
	</div>		
	<div class="clr"></div>

	<input type="hidden" name="hidden" value="submit_com_menu_main_menu_add" />
	<input type="hidden" name="task"/>
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