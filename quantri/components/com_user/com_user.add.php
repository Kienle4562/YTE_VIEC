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
                        <table class="toolbar"><tbody><tr>
                                    <td class="button" id="toolbar-save">
                                        <a href="#" onclick="javascript: submitbutton('save')" class="toolbar">
                                            <span class="icon-32-save" title="Lưu và thoát"></span>
                                            Lưu và thoát
                                        </a>
                                    </td>

                                    <td class="button" id="toolbar-apply">
                                        <a href="#" onclick="javascript: submitbutton('apply')" class="toolbar">
                                            <span class="icon-32-apply" title="Áp dụng"></span>
                                            Lưu
                                        </a>
                                    </td>

                                    <td class="button" id="toolbar-cancel">
                                        <a href=".?com=com_user&view=view" class="toolbar">
                                            <span class="icon-32-cancel" title="Hủy"></span>
                                            Hủy
                                        </a>
                                    </td>

                                    <td class="button" id="toolbar-help">
                                        <a href="#" onclick="popupWindow('', 'Trợ giúp', 640, 480, 1)" class="toolbar">
                                            <span class="icon-32-help" title="Trợ giúp"></span>
                                            Trợ giúp
                                        </a>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="header icon-48-user">
                        Người dùng: <small><small>[ Thêm mới ]</small></small><br>
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
                    <script language="javascript" type="text/javascript">
                        function submitbutton(pressbutton) {
                            var form = document.phpForm;
                            var r = new RegExp("[\<|\>|\"|\'|\%|\;|\(|\)|\&|\+|\-]", "i");

                            if ( trim(form.name.value) == "" ){
                                alert( "Vui lòng nhập tên đầy đủ của user." );
                                form.name.focus();
                                return;
                            } else if (form.username.value == "") {
                                alert( "Vui lòng nhập tên đăng nhập user." );
                                form.username.focus();
                                return;
                            } else if (r.exec(form.username.value)) {
                                alert( "Tên đang nhập không được có ký tự đặc biệt." );
                                form.username.focus();
                                return;
                            } else if (form.username.value.length < 5) {
                                alert( "Tên đang nhập phải lớn hơn 5 ký tự." );
                                form.username.focus();
                                return;
                            } else if (trim(form.email.value) == "") {
                                alert( "Vui lòng nhập địa chỉ Email." );	
                                form.email.focus();
                                return;
                            } else if (trim(form.password.value) == ""){
                                alert( "Vui lòng nhập mật khẩu." );
                                form.password.focus();
                                return;
                            } else if (form.password.value != form.password2.value){
                                alert( "Mật khẩu xác nhận không chính xác." );
                                form.password2.focus();
                                return;
                            } else if (trim(form.password.value) != "" && form.password.length < 5){
                                alert("Mật khẩu không được nhỏ hơn 5 ký tự");
                                form.password.focus();
                                return;
                            }  else {
                                submitform(pressbutton);
                            }		
                        }
                    </script>

                    <form method="post" name="phpForm">

                        <div>
                            <fieldset class="adminform">
                                <legend>Thông tin người dùng</legend>				
                                <table class="admintable">
                                    <tbody>
                                        <tr>
                                            <td class="key" width="100">Phạm vi:</td>
                                            <td colspan="2"><strong>người dùng </strong></td>
                                        </tr>
                                        <tr>
                                            <td class="key" nowrap="nowrap">
                                                <label for="username">Tên đăng nhập: </label>
                                            </td>
                                            <td colspan="2">
                                                <input class="text_area" name="username" id="username" value="" size="50" maxlength="50" title="Định danh người dùng khi đăng nhập" type="text">
                                            </td>
                                        </tr>				
                                        <tr>
                                            <td class="key"><label for="FullName">Tên đầy đủ:</label></td>
                                            <td colspan="2">
                                                <input class="text_area" name="name" id="title" value="" size="50" maxlength="255" title="Tên đầy đủ của người dùng" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                <label for="email">Email: </label>
                                            </td>
                                            <td colspan="2">
                                                <input class="text_area" name="email" id="email" value="" size="50" maxlength="255" title="Đaị chỉ Email " type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                <label for="email">Phone: </label>
                                            </td>
                                            <td colspan="2">
                                                <input class="text_area" name="phone" id="phone" value="" size="50" maxlength="15" title="phone" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                <label for="email">Address: </label>
                                            </td>
                                            <td colspan="2">
                                                <input class="text_area" name="address" id="address" value="" size="50" maxlength="255" title="address" type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                <label for="password">Mật khẩu: </label>
                                            </td>
                                            <td colspan="2"><input class="text_area" name="password" id="password" value="" size="50" maxlength="50" title="Đaị chỉ Email " type="password"></td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                <label for="password2">Xác nhận mật khẩu:</label>
                                            </td>
                                            <td colspan="2"><input class="text_area" name="password2" id="password2" value="" size="50" maxlength="50" title="Đaị chỉ Email " type="password"></td>
                                        </tr>
                                        <tr>
                                            <td class="key">
                                                <label for="login">Cho phép đăng nhập:</label>
                                            </td>
                                            <td colspan="2">
                                                <input type="radio" name="block" id="block0" value="0" checked="checked" />
                                                <label for="block0">No</label>
                                                <input type="radio" name="block" id="block1" value="1" />
                                                <label for="block1">Yes</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </fieldset>			
                        </div>
                        <div class="clr"></div>
                        <input type="hidden" name="hidden" value="submit_com_user_add" />
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