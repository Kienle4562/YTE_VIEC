<?php defined( '_VALID_MOS' ) or die( include("../phone/404.php") );?>
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
                    <td class="button" id="toolbar-save" style="display:none;">
                    <a href="#" onclick="javascript: submitbutton('save')" class="toolbar">
                    <span class="icon-32-save" title="Lưu và thoát">
                    </span>
                    Lưu và thoát
                    </a>
                    </td>
                    
                    <td class="button" id="toolbar-apply">
                    <a href="#" onclick="javascript: submitbutton('apply')" class="toolbar">
                    <span class="icon-32-apply" title="Lưu">
                    </span>
                    Lưu
                    </a>
                    </td>
                    
                    <td class="button" id="toolbar-cancel">
                    <a href="#" onclick="javascript: submitbutton('cancel')" class="toolbar">
                    <span class="icon-32-cancel" title="Hủy">
                    </span>
                    Hủy
                    </a>
                    </td>
                    
                    <td class="button" id="toolbar-help">
                    <a href="#" class="toolbar">
                    <span class="icon-32-help" title="Trợ giúp">
                    </span>
                    Trợ giúp
                    </a>
                    </td>
                    
                    </tr></tbody></table>
            </div>
            <div class="header icon-48-config">
                Cấu hình website » <small>[Thiết lập]</small>
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
   		
   		<?php
   			if (!isset($_SESSION['amdin']['com_caidat']['information']['lang_code']))
			{
				$_SESSION['amdin']['com_caidat']['information']['lang_code'] = 'vi';
			}
   		?>
   		
   		<?php if ($GLOBALS['MULTI_LANG']) { ?>
   			<div id="element-box" style="margin-bottom:10px;">
				<div class="t">
					<div class="t">
						<div class="t"></div>
					</div>
				</div>
				<div class="m">
					<div style="float: right">
						<form method="post" name="phpFormTop">
							<strong>Ngôn ngữ:</strong>
							<select name="lang_code" onchange="document.phpFormTop.submit()">
								<?php
									foreach ($GLOBALS['LANG_LIST'] as $key => $item)
									{
										if (isset($_SESSION['amdin']['com_caidat']['information']['lang_code']) && $_SESSION['amdin']['com_caidat']['information']['lang_code'] == $key)
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
							<input type='hidden' value='submit_com_caidat_information_add' name='hidden'>
						    <input type='hidden' value='change_lang_code' name='task'>
						</form>
					</div>
					<div class="clr"></div>
				</div>
				<div class="b">
					<div class="b">
						<div class="b"></div>
					</div>
				</div>
			</div>
		<?php } ?>
				
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
			
			 else {
				submitform(pressbutton);
			}
		}
		</script>

		<form method="post" name="phpForm">

		<div>
        	<fieldset class="adminform">
            	<legend>Logo</legend>
				<table class="admintable">
					<tbody>
                    	<tr>
                            <td class="key">
                                Logo website
                            </td>
                            <td valign="top">
                                <div style="float: left;">
                                    <input style="background: #ffffff;" type="text" id="img_logo" name="img_logo" value="<?= $_APP['config']['logo']['img_logo']; ?>" size="25" />
                                </div>
                                <div class="button2-left">
                                    <div class="blank">
                                    <a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('img_logo');">Lựa chọn</a>
                                    </div>
                                </div>
                            </td>                                        
                        </tr>
                        
					</tbody>
				</table>
            </fieldset>
        	<fieldset class="adminform">
            	<legend>Cấu hình website</legend>
				<table class="admintable">
					<tbody>
                    	<tr>
							<td colspan="2" class="key">
								Hoạt động website
							</td>
							<td colspan="2" valign="top">
                            	<?php
									if (!empty($_APP['config']['system-state']))
									{
										?>
                                        <input type="radio" name="system-state" checked="checked" value="1" /> Hoạt động
                                        <input type="radio" name="system-state" value="0" /> Bảo trì
                                        <?php
									}
									else
									{
										?>
                                        <input type="radio" name="system-state" value="1" /> Hoạt động
                                        <input type="radio" name="system-state" checked="checked" value="0" /> Bảo trì
                                        <?php
									}
								?>
							</td>
						</tr>
                        <tr>
							<td colspan="2" class="key">
								Sử dụng trang intro
							</td>
							<td colspan="2" valign="top">
                            	<?php
									if (!empty($_APP['config']['system-intro']))
									{
										?>
                                        <input type="radio" name="system-intro" checked="checked" value="1" /> Sử dụng
                                        <input type="radio" name="system-intro" value="0" /> Không sử dụng
                                        <?php
									}
									else
									{
										?>
                                        <input type="radio" name="system-intro" value="1" /> Sử dụng
                                        <input type="radio" name="system-intro" checked="checked" value="0" /> Không sử dụng
                                        <?php
									}
								?>
							</td>
						</tr>
                        <tr>
							<td colspan="2" class="key">
								Nội dung bảo trì:
							</td>
							<td colspan="2" valign="top">
                            	<textarea name="system-maintenance-message" style="width: 400px; height: 60px; "><?php 
									echo $_APP['config']['system-maintenance-message']; 
								?></textarea>
							</td>
						</tr>
                        <tr>
							<td colspan="2" class="key">
								Tiêu đề website: <?php $core_class->create_lang_flag($_SESSION['amdin']['com_caidat']['information']['lang_code'], 16); ?>
							</td>
							<td colspan="2" valign="top">
                            	<input name="config-title" type="text" value="<?php echo $_APP['config']['title'][$_SESSION['amdin']['com_caidat']['information']['lang_code']]; ?>" size="60" />
							</td>
						</tr>
                        <tr>
							<td colspan="2" class="key">
								Thông tin Keywords: <?php $core_class->create_lang_flag($_SESSION['amdin']['com_caidat']['information']['lang_code'], 16); ?>
							</td>
							<td colspan="2" valign="top">
                            	<textarea name="meta-keyword" style="width: 400px; height: 60px; "><?php 
									echo $_APP['config']['meta-keyword'][$_SESSION['amdin']['com_caidat']['information']['lang_code']]; 
								?></textarea>
							</td>
						</tr>
                        <tr>
							<td colspan="2" class="key">
								Thông tin Description: <?php $core_class->create_lang_flag($_SESSION['amdin']['com_caidat']['information']['lang_code'], 16); ?>
							</td>
							<td colspan="2" valign="top">
                            	<textarea name="meta-description" style="width: 400px; height: 60px; "><?php 
									echo $_APP['config']['meta-description'][$_SESSION['amdin']['com_caidat']['information']['lang_code']]; 
								?></textarea>
							</td>
						</tr>
                        <tr>
                            <td colspan="2" class="key">
                                Sử dụng ảnh thu nhỏ
                            </td>
                            <td colspan="2" valign="top">
                                <?php
                                    if (!empty($_APP['config']['use-thumbnail']))
                                    {
                                        ?>
                                        <input type="radio" name="use-thumbnail" checked="checked" value="1" /> Sử dụng
                                        <input type="radio" name="use-thumbnail" value="0" /> Không sử dụng
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <input type="radio" name="use-thumbnail" value="1" /> Sử dụng
                                        <input type="radio" name="use-thumbnail" checked="checked" value="0" /> Không sử dụng
                                        <?php
                                    }
                                ?>
                            </td>
                        </tr>
					</tbody>
				</table>
            </fieldset>
            <fieldset class="adminform">
            	<legend>Thông tin website</legend>
				<table class="admintable">
					<tbody>
						<tr>
							<td colspan="2" class="key" valign="top">
								Email quản trị viên:
							</td>
							<td colspan="2">
								<input name="email" type="text" value="<?php echo $_APP['config']['admin-email']; ?>" size="50" />
								<p style="color: #888;">
									Trong trường hợp có đơn đặt hàng mới, một email thông báo sẽ được gửi đến địa chỉ này.
								</p>
							</td>
						</tr>
					</tbody>
				</table>
            </fieldset>
            <fieldset class="adminform">
            	<legend>Cấu hình SMTP</legend>
				<table class="admintable">
					<tbody>
						<tr>
							<td colspan="2" class="key" valign="top">
								Máy chủ:
							</td>
							<td colspan="2">
								<input name="smtp_host" type="text" value="<?php echo $_APP['config']['smtp']['host']; ?>" size="50" />
								<p style="color: #888;">
									Địa chỉ máy chủ SMTP, có thể là IP hoặc tên miền.
								</p>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="key" valign="top">
								Cổng:
							</td>
							<td colspan="2">
								<input name="smtp_port" type="text" value="<?php echo $_APP['config']['smtp']['port']; ?>" size="10" />
							</td>
						</tr>
						<tr>
							<td colspan="2" class="key" valign="top">
								Tài khoản:
							</td>
							<td colspan="2">
								<input name="smtp_username" type="text" value="<?php echo $_APP['config']['smtp']['username']; ?>" size="50" />
							</td>
						</tr>
						<tr>
							<td colspan="2" class="key" valign="top">
								Mật khẩu:
							</td>
							<td colspan="2">
								<input name="smtp_password" type="password" value="<?php echo $_APP['config']['smtp']['password']; ?>" size="50" />
							</td>
						</tr>
						<tr>
							<td colspan="2" class="key" valign="top">
								Tên người gửi:
							</td>
							<td colspan="2">
								<input name="smtp_display_name" type="text" value="<?php echo $_APP['config']['smtp']['display_name']; ?>" size="50" />
							</td>
						</tr>
					</tbody>
				</table>
            </fieldset>
            <fieldset class="adminform">
            	<legend>Cấu hình nội dung</legend>
				<table class="admintable">
					<tbody>
						<tr>
							<td colspan="2" class="key" valign="top">
								Hiển thị ngày cập nhật nội dung:
							</td>
							<td colspan="2">
								<?php
                                    if (!empty($_APP['config']['com_content']['show_updated_date']))
                                    {
                                        ?>
                                        <input type="radio" name="com_content_show_updated_date" checked="checked" value="1" /> Hiển thị
                                        <input type="radio" name="com_content_show_updated_date" value="0" /> Không hiển thị
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <input type="radio" name="com_content_show_updated_date" value="1" /> Hiển thị
                                        <input type="radio" name="com_content_show_updated_date" checked="checked" value="0" /> Không hiển thị
                                        <?php
                                    }
                                ?>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="key" valign="top">
								Hiển thị nội dung cũ hơn:
							</td>
							<td colspan="2">
								<?php
                                    if (!empty($_APP['config']['com_content']['show_older_news']))
                                    {
                                        ?>
                                        <input type="radio" name="com_content_show_older_news" checked="checked" value="1" /> Hiển thị
                                        <input type="radio" name="com_content_show_older_news" value="0" /> Không hiển thị
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <input type="radio" name="com_content_show_older_news" value="1" /> Hiển thị
                                        <input type="radio" name="com_content_show_older_news" checked="checked" value="0" /> Không hiển thị
                                        <?php
                                    }
                                ?>
							</td>
						</tr>
					</tbody>
				</table>
            </fieldset>
            <fieldset class="adminform">
            	<legend>Cấu hình sản phẩm</legend>
				<table class="admintable">
					<tbody>
						<tr>
							<td colspan="2" class="key" valign="top">
								Kiểu hiển thị danh mục:
							</td>
							<td colspan="2">
								<?php
                                    if (!empty($_APP['config']['com_product']['category_view_type']))
                                    {
                                        ?>
                                        <input type="radio" name="com_product_category_view_type" checked="checked" value="1" /> Danh mục con
                                        <input type="radio" name="com_product_category_view_type" value="0" /> Sản phẩm
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <input type="radio" name="com_product_category_view_type" value="1" /> Danh mục con
                                        <input type="radio" name="com_product_category_view_type" checked="checked" value="0" /> Sản phẩm
                                        <?php
                                    }
                                ?>
							</td>
						</tr>
						<tr>
							<td colspan="2" class="key" valign="top">
								Số lượng sản phẩm khi hiển thị danh mục con:
							</td>
							<td colspan="2">
								<input name="com_product_category_view_type_1" type="text" value="<?php echo $_APP['config']['com_product']['category_view_type_1']; ?>" size="50" />
							</td>
						</tr>
					</tbody>
				</table>
            </fieldset>
		</div>
		<div class="clr"></div>

		<input type="hidden" name="hidden" value="submit_com_caidat_information_add" />
		<input type="hidden" name="task"/>
		</form>
		
		<script type="text/javascript" src="../myeditor/myfinder/ckfinder.js"></script>
        <script language="javascript" type="text/javascript">
        function BrowseServer( inputId )
        {
            var finder = new CKFinder() ;
            finder.StartupPath  = "Product:/product/";
            finder.selectActionFunction = SetFileField ;
            finder.selectActionData = inputId ;
            finder.popup();
        }
        
        // This is a sample function which is called when a file is selected in CKFinder.
        function SetFileField( fileUrl, data )
        {
            document.getElementById( data["selectActionData"] ).value = fileUrl;
        }
        </script>
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
   		</div>
		<noscript>
			!Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị
		</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id="border-bottom"><div><div></div></div></div>