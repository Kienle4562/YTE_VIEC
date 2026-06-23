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
                        <table class="toolbar">
                            <tbody>
                                <tr>
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

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="header icon-48-config">
                        Cấu hình website » <small>[Thông tin liên hệ]</small>
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
            	if (!isset($_SESSION['amdin']['com_caidat']['contact']['lang_code']))
				{
					$_SESSION['amdin']['com_caidat']['contact']['lang_code'] = 'vi';
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
											if (isset($_SESSION['amdin']['com_caidat']['contact']['lang_code']) && $_SESSION['amdin']['com_caidat']['contact']['lang_code'] == $key)
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
								<input type='hidden' value='submit_com_caidat_contact' name='hidden'>
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
                                <legend>Cấu hình thông tin liên hệ</legend>
                                <table class="admintable" width="100%">
                                    <tbody>
                                    	<tr>
                                            <td class="key">
                                                Tên Cty/ Doanh nghiệp
                                            </td>
                                            <td valign="top" colspan="3">
                                                <input name="company" type="text" value="<?= $_APP['config']['contact']['company_name']; ?>" size="147" />
                                            </td>                                                                                  
                                        </tr>
                                    	<tr>
                                            <td class="key">
                                                Điện thoại bàn 1
                                            </td>
                                            <td valign="top">
                                                <input name="phone1" type="text" value="<?= $_APP['config']['contact']['phone']["phone1"]; ?>" size="50" />
                                            </td>                                        
                                            <td class="key">
                                                Điện thoại bàn 2
                                            </td>
                                            <td valign="top">
                                                <input name="phone2" type="text" value="<?= $_APP['config']['contact']['phone']["phone2"]; ?>" size="50" />
                                            </td>                                        
                                            <td class="key">
                                                Điện thoại bàn 3
                                            </td>
                                            <td valign="top">
                                                <input name="phone3" type="text" value="<?= $_APP['config']['contact']['phone']["phone3"]; ?>" size="50" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                Di động 1
                                            </td>
                                            <td valign="top">
                                                <input name="mobile1" type="text" value="<?= $_APP['config']['contact']['mobile']["mobile1"]; ?>" size="50" />
                                            </td>                                       
                                            <td class="key">
                                                Di động 2
                                            </td>
                                            <td valign="top">
                                                <input name="mobile2" type="text" value="<?= $_APP['config']['contact']['mobile']["mobile2"]; ?>" size="50" />
                                            </td>
                                            <td class="key">
                                                Di động 3
                                            </td>
                                            <td valign="top">
                                                <input name="mobile3" type="text" value="<?= $_APP['config']['contact']['mobile']["mobile3"]; ?>" size="50" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                Email 1
                                            </td>
                                            <td valign="top">
                                                <input name="email1" type="text" value="<?= $_APP['config']['contact']['email']["email1"]; ?>" size="50" />
                                            </td>
                                            <td class="key">
                                                Email 2
                                            </td>
                                            <td valign="top">
                                                <input name="email2" type="text" value="<?= $_APP['config']['contact']['email']["email2"]; ?>" size="50" />
                                            </td>
                                            <td class="key">
                                                Email 3
                                            </td>
                                            <td valign="top">
                                                <input name="email3" type="text" value="<?= $_APP['config']['contact']['email']["email3"]; ?>" size="50" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                Skype 1
                                            </td>
                                            <td valign="top">
                                                <input name="skype1" type="text" value="<?= $_APP['config']['contact']['skype']["skype1"]; ?>" size="50" />
                                            </td>
                                            <td class="key">
                                                Skype 2
                                            </td>
                                            <td valign="top">
                                                <input name="skype2" type="text" value="<?= $_APP['config']['contact']['skype']["skype2"]; ?>" size="50" />
                                            </td>
                                            <td class="key">
                                                Skype 3
                                            </td>
                                            <td valign="top">
                                                <input name="skype3" type="text" value="<?= $_APP['config']['contact']['skype']["skype3"]; ?>" size="50" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                Yahoo 1
                                            </td>
                                            <td valign="top">
                                                <input name="yahoo1" type="text" value="<?= $_APP['config']['contact']['yahoo']["yahoo1"]; ?>" size="50" />
                                            </td>
                                            <td class="key">
                                                Yahoo 2
                                            </td>
                                            <td valign="top">
                                                <input name="yahoo2" type="text" value="<?= $_APP['config']['contact']['yahoo']["yahoo2"]; ?>" size="50" />
                                            </td>
                                            <td class="key">
                                                Yahoo 3
                                            </td>
                                            <td valign="top">
                                                <input name="yahoo3" type="text" value="<?= $_APP['config']['contact']['yahoo']["yahoo3"]; ?>" size="50" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                Địa chỉ 1
                                            </td>
                                            <td valign="top">
                                                <input name="address1" type="text" value="<?= $_APP['config']['contact']['address']["address1"]; ?>" size="50" />
                                            </td>
                                            <td class="key">
                                                Địa chỉ 2
                                            </td>
                                            <td valign="top">
                                                <input name="address2" type="text" value="<?= $_APP['config']['contact']['address']["address2"]; ?>" size="50" />
                                            </td>
                                            <td class="key">
                                                Địa chỉ 3
                                            </td>
                                            <td valign="top">
                                                <input name="address3" type="text" value="<?= $_APP['config']['contact']['address']["address3"]; ?>" size="50" />
                                            </td>
                                        </tr>                                       
                                    </tbody>
                                </table>
                            </fieldset>
                            
                            <fieldset class="adminform">
                                <legend>Bản đồ đường đi</legend>
                                <table class="admintable" width="100%">
                                    <tbody>
                                        <tr>
                                            <td class="key">
                                                Hiển thị bản đồ
                                            </td>
                                            <td valign="top">
                                                <?php
                                                    if (isset($_APP['config']['contact']['show_map'])) {
                                                        if ($_APP['config']['contact']['show_map'] == 1) {
                                                            ?>
                                                            <input type="radio" name="show_map" id="show_map" value="1" checked="checked" />
                                                            <label for="show_map">Hiển thị</label>
                                                            <input type="radio" name="show_map" id="dont_show_map" value="0" />
                                                            <label for="dont_show_map">Không hiển thị</label>
                                                            <?php
                                                        }
                                                        elseif ($_APP['config']['contact']['show_map'] == 0) {
                                                            ?>
                                                            <input type="radio" name="show_map" id="show_map" value="1" />
                                                            <label for="show_map">Hiển thị</label>
                                                            <input type="radio" name="show_map" id="dont_show_map" value="0" checked="checked" />
                                                            <label for="dont_show_map">Không hiển thị</label>
                                                            <?php
                                                        }
                                                    }
                                                    else {
                                                        ?>
                                                        <input type="radio" name="show_map" id="show_map" value="1" checked="checked" />
                                                        <label for="show_map">Hiển thị</label>
                                                        <input type="radio" name="show_map" id="dont_show_map" value="0" />
                                                        <label for="dont_show_map">Không hiển thị</label>
                                                        <?php
                                                    }
                                                ?>                                                                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                <strong>Vị trí trên bản đồ</strong> <br><br> <font color="#FF0000">(copy mã nhúng từ google maps và dán vào khung soạn thảo văn bản)</font>
                                            </td>
                                            <td valign="top">
                                                <textarea id="contact_content" name="contact_content"><?php
                                                    if (is_array($_APP['config']['contact']['maps_code'])) {
                                                        echo $core_class->txt_htmlspecialchars($_APP['config']['contact']['maps_code'][$_SESSION['amdin']['com_caidat']['contact']['lang_code']]);
                                                    }
                                                ?></textarea>
                                                <script type="text/javascript" src="../myeditor/ckeditor.js"></script>
                                                <script type="text/javascript">
                                                    CKEDITOR.replace( 'contact_content' );
                                                </script>
                                            </td>
                                          
                                        </tr>
                                        <tr>
                                         <td class="key">
                                                <strong>Thông tin thanh toán</strong>
                                            </td>
                                          <td valign="top">
                                                <textarea id="taikhoan_content" name="taikhoan_content"><?php
                                               
                                                        echo $core_class->txt_htmlspecialchars( $_APP['config']['contact']['taikhoan'] );
                                                   
                                                ?></textarea>
                                               
                                                <script type="text/javascript">
                                                    CKEDITOR.replace( 'taikhoan_content' );
                                                </script>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>
                        </div>
                        <div class="clr"></div>

                        <input type="hidden" name="hidden" value="submit_com_caidat_contact" />
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
                !Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị
            </noscript>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
    </div>
</div>
    <div id="border-bottom"><div><div></div></div></div>