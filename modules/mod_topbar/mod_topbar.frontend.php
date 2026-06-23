<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_topbar.models.php"); 
	
	if (empty($params) || $params == "undefine") {
        $params = array(           
            'class' => '',
			'content' => ''
        );
    }
    else {
        $params = unserialize($params);
    }
	$myprocess = new mod_topbar_process();
?>
<span class="black_line"></span>
<section class="header_top_part p_top_0 p_bottom_0">
    <div class="container">
        <div class="row">
            <!--contact info-->
            <div class="col-lg-12 col-md-12 col-sm-12 t_xs_align_c">
                <ul class="hr_list fs_small color_grey_light contact_info_list">
                    <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">
                        <a href="tel:<?php echo $GLOBALS['APP']['config']['contact']['phone']["phone1"]; ?>" class="color_grey_light d_inline_b color_black_hover"><span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-phone-1"></i></span><?php echo $GLOBALS['APP']['config']['contact']['phone']["phone1"]; ?></a>
                    </li>
                    <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">
                        <a href="mailto:<?php echo $GLOBALS['APP']['config']['contact']['email']["email1"]; ?>" class="color_grey_light d_inline_b color_black_hover"><span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-mail-alt"></i></span><?php echo $GLOBALS['APP']['config']['contact']['email']["email1"]; ?></a>
                    </li>
                    <li class="m_right_20 f_xs_none m_xs_right_0 m_xs_bottom_5">
                        <a href="<?php echo $GLOBALS['APP']['config']['contact']['yahoo']["yahoo1"]; ?>" class="color_grey_light d_inline_b color_black_hover"><span class="circle icon_wrap_size_1 d_inline_m m_right_8"><i class="icon-facebook-1"></i></span><?php echo $GLOBALS['APP']['config']['contact']['yahoo']["yahoo1"]; ?></a>
                    </li>
                </ul>
            </div>
            
        </div>
    </div>
</section>
<hr>
<!--header bottom part-->
<section class="header_bottom_part type_2 bg_light">
    <div class="container">
        <div class="d_table w_full d_xs_block">
            <!--logo-->
            <div class="col-lg-3 col-md-2 col-sm-3 d_table_cell d_xs_block f_none v_align_m logo t_xs_align_c">
                <a href="." class="d_inline_m m_xs_top_20 m_xs_bottom_20">
                    <img class="customlogo" height="120" src="/templates/<?= mapping('template') ?>/images/logo.png" alt="">
                </a>
            </div>
            <div class="p_t_30 col-lg-9 col-md-10 col-sm-9 d_table_cell d_xs_block f_none t_xs_align_c">
                <div class="custom_select t_xs_align_l f_left f_xs_none w_xs_full m_xs_right_0 m_xs_bottom_10 m_right_5 category_select">
                    <input type="text" placeholder="Địa điểm" name="location" class="r_corners fw_light bg_light w_full">
				</div>
                <!--searchform-->
                <form role="search" action="/tim-kiem/-1/search.html" method="post" onsubmit="check_mod_product_search_2(); return false;" class="relative type_2 f_left type_3 f_xs_none t_xs_align_l m_xs_bottom_15">
                    <input type="text" placeholder="Tìm kiếm..." name="keyword" class="r_corners fw_light bg_light w_full">
                    <button class="color_grey_light color_purple_hover tr_all">
                        <i class="icon-search"></i>
                    </button>
                </form>
                <div class="f_right clearfix f_xs_none d_xs_inline_b t_xs_align_l m_xs_bottom_15">
                    <!--shopping cart-->
                    <div class="relative f_right dropdown_2_container login">
                        <button onclick="location.href='lien-he.html'" class="icon_wrap_size_2 color_grey_light circle tr_all">
                            <i class="icon-flash color_grey_light_2 tr_inherit"></i>
                        </button>
                        ĐĂNG TIN TUYỂN DỤNG
                    </div>
                    <!--login-->
                    <!--<div class="relative f_right m_right_10 dropdown_2_container login">
                        <button class="icon_wrap_size_2 color_grey_light circle tr_all">
                            <i class="icon-lock color_grey_light_2 tr_inherit"></i>
                        </button>
                        Tài khoản
                        <div style="z-index:9999" class="dropdown_2 bg_light shadow_1 tr_all">
                            <h5 class="fw_light color_dark m_bottom_23">Login</h5>
                            <form class="login_form m_bottom_20">
                                <ul>
                                    <li class="m_bottom_10 relative">
                                        <i class="icon-user login_icon fs_medium color_grey_light_2"></i>
                                        <input type="text" placeholder="Username" class="r_corners color_grey w_full fw_light">
                                    </li>
                                    <li class="m_bottom_10 relative">
                                        <i class="icon-lock login_icon fs_medium color_grey_light_2"></i>
                                        <input type="password" placeholder="Password" class="r_corners color_grey w_full fw_light">
                                    </li>
                                    <li class="m_bottom_23">
                                        <input type="checkbox" checked id="checkbox_1" name="" class="d_none">
                                        <label for="checkbox_1" class="d_inline_m fs_medium fw_light">Remember me</label>
                                    </li>
                                    <li class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                            <button class="button_type_5 tr_all color_blue transparent fs_medium r_corners">Login</button>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 t_align_r lh_medium">
                                            <a href="#" class="color_scheme color_purple_hover fs_small">Forgot your password?</a><br>
                                            <a href="#" class="color_scheme color_purple_hover fs_small">Forgot your username?</a>
                                        </div>
                                    </li>
                                </ul>
                            </form>
                            <div class="bg_light_2 im_half_container sc_footer">
                                <h5 class="fw_light color_dark d_inline_m half_column">New Customer?</h5>
                                <div class="half_column t_align_r d_inline_m">
                                    <a href="#" class="button_type_5 t_xs_align_c d_inline_b tr_all r_corners color_purple transparent fs_medium">Create an Account</a>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</section>
<hr class="d_xs_none">