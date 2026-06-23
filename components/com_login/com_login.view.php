<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    session_start();
	include_once('com_login.models.php');
    $lang_text = $core_class->load_module_language('com_login', $GLOBALS['LANG']);
?>

<div class="clearfix m_xs_bottom_10">
	<div class="section_offset">
    	<div class="container">
        	<div class="row ">
            	<div class="col-lg-6 col-md-6 col-sm-6 m_bottom_50 m_xs_bottom_30 right_border">
                	 <form name="phpForm" method="post" id="phpForm">
                    <ul class="fs_medium m_top_10">
                        <li class="m_bottom_15 m_xs_bottom_15">
                            <label for="input_1" class="required d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">Tên đăng nhập:</label>
                            <input type="text" name="username" id="username" class="r_corners d_inline_m w_sm_full">
                        </li>
                        <li class="m_bottom_15 m_xs_bottom_15">
                            <label for="input_1" class="required d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">Mật khẩu:</label>
                            <input type="password" name="password" id="password" class="r_corners d_inline_m w_sm_full">
                        </li>                        
                        <li class="m_bottom_20 m_xs_bottom_15">
                            <label class="d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">&nbsp;</label>
                            <input type="checkbox" id="checkbox_1" name="" class="d_none">
                            <label for="checkbox_1" class="d_inline_m m_right_10">Nhớ tài khoản</label>                            
                        </li>
                        <li class="m_bottom_20 m_xs_bottom_15">
                          <label class="d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">&nbsp;</label>
							<div class="lh_medium d_inline_m m_right_10">
								<a href="#" class="color_scheme color_purple_hover d_inline_b m_bottom_3">Quên mật khẩu?</a><br>
							</div>
                         <div class="lh_medium d_inline_m m_right_10">
								<a href="#" class="color_scheme color_purple_hover d_inline_b m_bottom_3">Tạo tài khoản</a><br>
							</div>
                        </li> 
                        <li class="m_bottom_20 m_xs_bottom_15">
                            <label class="d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">&nbsp;</label>
                            <label for="checkbox_1" class="d_inline_m m_right_10">
                            	<input type="hidden" name="do" value="login" />
                           	 <button class="button_type_5 color_blue transparent r_corners fs_medium tr_all m_right_10 m_sm_bottom_10">Đăng nhập</button>
                                <br /><br />
                             
                            </label>
                             
                        </li> 
                        
                                                               
                    </ul>
                </form> 
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 m_bottom_50 m_xs_bottom_30 ">
                	<div class="login__registerNewAccount txtUpper">
                        <div class="fsml pbl t_sm_align_c">Bạn là khách hàng mới?</div>
                        <div class="box ptl m_top_20">
                            <a class="button_type_5 color_blue transparent r_corners fs_medium tr_all m_right_10 m_sm_bottom_10" href="/dang-ky.html" title="Đăng ký">Đăng ký                            </a>
                        </div>
                    </div>
                    
                    <div class="fbLoginContainer">
                           
                                <div class="fbCreatePageLabel">
                                    Đăng nhập thuận tiện bằng tài khoản Facebook
                                 </div>
                                <div class="fbLoginButton">
                                    <a class="btn btn--facebook" href="/customer/socialconnect/login?sconn=facebook">
                                        Sign in with facebook
                                    </a>
                                </div>
                                <div class="fbLoginNotes fs_ex_small">
                                  Anthy sẽ không bao giờ gửi bài viết hoặc chia sẻ thông tin mà chưa được sự dồng ý của bạn.
                                </div>
                         
					</div>
                </div>
            </div>
        </div>
    </div>	
</div>
	