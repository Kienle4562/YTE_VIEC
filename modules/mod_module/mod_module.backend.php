<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
include_once("mod_module.models.php");
include_once("mod_module.handler.php");
$myprocess = new process();
?>
<style type="text/css">
#divAddModule div {
	padding: 5px;
}
div.moduleDescription {
	float: left;
	width: 240px;
	border: solid 1px #B8CCE4;
	background: #DAEEF3;
	min-height: 145px;
}
table.description {
	border-collapse: collapse;
	display: table;
	border-spacing: 2px;
	border-color: gray;
	width:100%;
}
table.description td {
	padding: 10px 20px;
	border: solid 2px gray;
	text-align: center;
}
</style>

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
								<td class="button" id="toolbar-save">
									<a href="#" onclick="javascript: submitbutton('save')" class="toolbar">
										<span class="icon-32-save" title="Lưu và thoát"></span> Lưu lại
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
				<div class="header icon-48-sections">
					Modules » <small>Thêm mới module</small>
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
		
		<?php if(isset($_SESSION["sys_message"]["error"])) { ?>
		<div id="toolbar-box">
			<div class="t"><div class="t"><div class="t"></div></div></div>
			<div class="m">
				<div style="text-align:center;font-size:18px;color:#FF0000;"><?php echo $_SESSION["sys_message"]["error"]; ?></div>
			</div>
			<div class="b"><div class="b"><div class="b"></div></div></div>
		</div>
		<?php unset($_SESSION["sys_message"]["error"]); } ?>
		
		<div id="element-box">
			<div class="t">
				<div class="t">
					<div class="t"></div>
				</div>
			</div>
			<div class="m">
				<script language="javascript" type="text/javascript">
					<!--	
					function submitbutton(pressbutton)
					{
						var form = document.phpForm;					
						if (form.title.value == ""){
							alert("Vui lòng nhập tiêu đề module");
							form.title.focus();
							return;
						} else {							
							submitform(pressbutton);
						}						
					}		
					//-->
				</script>
				<form method="post" name="phpForm">
					<div class="col width-50">
						<fieldset class="adminform">
							<legend>Thông tin chức năng</legend>
			
							<table class="admintable" cellspacing="1">
								<tbody>
								<tr>
									<td class="key">
										<label for="title">
											Tiêu đề chức năng:
										</label>
									</td>
									<td>
										<input class="text_area" type="text" name="title" id="title" size="35" value="">										
									</td>
									<td>
										<span class="editlinktip hasTip" title="Tiêu đề chức năng::Tiêu đề text hiển thị chức năng"><a href="javascript:void(0);"> Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" /></a></span>
									</td>
								</tr>
								<tr>
									<td width="100" class="key">
										Show tiêu đề chức năng:
									</td>
									<td>
										<input type="radio" name="showtitle" id="showtitle0" value="0" class="inputbox">
										<label for="showtitle0">Không</label>
										<input type="radio" name="showtitle" id="showtitle1" value="1" checked="checked" class="inputbox">
										<label for="showtitle1">Có</label>										
									</td>
									<td>
										<span class="editlinktip hasTip" title="Hiển thị text trên tiêu đề::Lựa chọn cho phép text tiêu để được hiển thị hay không"><a href="javascript:void(0);"> Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" /></a></span>
									</td>
										
								</tr>
								<tr>
									<td valign="top" class="key">
										Hiển thị chức năng:
									</td>
									<td>
										<input type="radio" name="enabled" id="enabled0" value="0" class="inputbox">
										<label for="enabled0">Không</label>
										<input type="radio" name="enabled" id="enabled1" value="1" checked="checked" class="inputbox">
										<label for="enabled1">Có</label>										
									</td>
									<td>
										<span class="editlinktip hasTip" title="Hiển thị chức năng::Lựa chọn cho phép chức năng có được hiển thị hay không"><a href="javascript:void(0);"> Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" /></a></span>
									</td>
								</tr>																					
							</tbody>
						</table>
						</fieldset>
						<fieldset class="adminform">
							<legend>Danh sách Menu được chọn liên kết</legend>
							<script type="text/javascript">
								function allselections() {
									var e = document.getElementById('selections');
										e.disabled = true;
									var i = 0;
									var n = e.options.length;
									for (i = 0; i < n; i++) {
										e.options[i].disabled = true;
										e.options[i].selected = true;
									}
								}
								function disableselections() {
									var e = document.getElementById('selections');
										e.disabled = true;
									var i = 0;
									var n = e.options.length;
									for (i = 0; i < n; i++) {
										e.options[i].disabled = true;
										e.options[i].selected = false;
									}
								}
								function enableselections() {
									var e = document.getElementById('selections');
										e.disabled = false;
									var i = 0;
									var n = e.options.length;
									for (i = 0; i < n; i++) {
										e.options[i].disabled = false;
									}
								}
							</script>
							<table class="admintable" cellspacing="1">
								<tbody><tr>
									<td valign="top" class="key">
										Menus:
									</td>
									<td>
										<label for="menus-all"><input id="menus-all" type="radio" name="menus" value="all" onclick="allselections();" checked="checked">Tất cả</label>
										<label for="menus-select"><input id="menus-select" type="radio" name="menus" value="select" onclick="enableselections();">Chọn Menu Item(s) từ danh sách</label><br />
										<label for="menus-unselect"><input id="menus-unselect" type="radio" name="menus" value="unselect" onclick="enableselections();">Không hiển thị ở các menu</label>
									</td>
								</tr>
								<tr>
									<td valign="top" class="key">
										Chọn Menu:
									</td>
									<td>																				
										<select name="selections[]" id="selections" class="inputbox" size="15" multiple="multiple" disabled="">
											<?php
											
											function menu($parentid = 0, $menu_type_id, $space = '&nbsp;&nbsp;&nbsp;|_ _ _ ', &$html = ''){
												$myprocess = new process();
												$result = $myprocess->list_menu($parentid, $menu_type_id);
												while($row = $result->fetch()){
													$html .= '<option disabled="" value="'.$row['Id'].'">' . $space . $row['title'].'</option>';
													menu($row["Id"], $menu_type_id, $space.'&nbsp;|_ _ _&nbsp;', $html);
												}				
												return $html;
											}
											
											$result = $myprocess->get_group_menu();
											while($row = $result->fetch()){ ?>
											<optgroup label="<?php echo $row["title"]; ?>">
												<?php
													echo menu(0, $row["Id"]);
												?>
											</optgroup>
											<?php } ?>
										</select>						
									</td>
								</tr>
							</tbody>
						</table>
						<script type="text/javascript">allselections();</script>
						</fieldset>
					</div>
			
					<div class="col width-50">
						<fieldset class="adminform">
							<legend>Tùy chọn chức năng</legend>
							
								<table class="admintable" cellspacing="1">
									<tbody>
									<tr>
										<td valign="top" class="key">
											Loại chức năng:
										</td>
										<td>
											<script language="javascript" type="text/javascript">											
												var module_description = new Array;												
												module_description['0'] = "Vui lòng chọn loại module được hiển thị trên frontend";
												<?php 
													$result = $myprocess->get_module_type();
													while($row = $result->fetch()){
														echo "module_description['".$row["module"]."'] = '".$row["module_description"]."';";
													}
												?>
	
												function OnChangeModule(moduleId){
													jQuery("#moduleDescription").html( module_description[moduleId.value] );
												}
											</script>
											<select name="ddlModules" id="ddlModules" class="textInput" onchange="javascript:OnChangeModule(this);" style="width:240px;">
												<option value="0">--- Chọn module ---</option>
												<?php 
												$result = $myprocess->get_module_type();
												while($row = $result->fetch()){?>
												<option value="<?php echo $row["module"]; ?>"><?php echo $row["module_name"]; ?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<span class="editlinktip hasTip" title="Loại chức năng::Chọn loại chức năng tùy theo chức năng bạn muốn xuất hiện trên giao diện trang chủ frontend"><a href="javascript:void(0);"> Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" /></a></span>
										</td>
									</tr>
									<tr>
										<td valign="top" class="key"></td>
										<td>
											<div id="moduleDescription" class="moduleDescription">
												Vui lòng chọn loại chức năng được hiển thị trên frontend
											</div>
										</td>
										<td>&nbsp;</td>
									</tr>								
									<tr>
										<td valign="top" class="key">
											Vị trí xuất hiện:
										</td>
										<td>
											<select name="position" id="combobox-position-select" style="width:240px;">
												<option value="0"> --- Chọn vị trí --- </option>
												<?php 
												$result = $myprocess->get_position(); 
												while($row = $result->fetch()){?>
												<option value="<?php echo $row["module_position_id"]; ?>"><?php echo $row["position_name"]; ?></option>
												<?php } ?>
											</select>
										</td>
										<td>										
											<span class="editlinktip hasTip" title="Vị trí xuất hiện::Vị trí chức năng sẽ xuất hiện trên giao diện trang chủ frontend"><a href="javascript:void(0);"> Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" /></a></span>
										</td>
									</tr>
									<tr>
										<td valign="top" class="key">&nbsp;</td>
										<td>
											<table class="description" cellpadding="0" cellspacing="0">
												<tbody>
													<tr>
														<td colspan="3">
															<div id="position_top">Trên cùng</div>
														</td>
													</tr>
													<tr>
														<td colspan="3">
															<div id="position_menu">Menu chức năng</div>
														</td>
													</tr>
													<tr>
														<td>
															<div id="position_left">Trái</div>
														</td>
														<td>
															<div id="position_center">Giữa</div>
														</td>
														<td>
															<div id="position_right">Phải</div>
														</td>
													</tr>
													<tr>
														<td colspan="3">
															<div id="position_bottom">Dưới cùng</div>
														</td>
													</tr>
												</tbody>
											</table>								
										</td>
										<td>&nbsp;</td>
									</tr>
								</tbody>
							</table>
						
					</fieldset>
					</div>
					<div class="clr"></div>			
					<input type="hidden" name="hidden" value="submit_com_module_add">
					<input type="hidden" name="task" value="">
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