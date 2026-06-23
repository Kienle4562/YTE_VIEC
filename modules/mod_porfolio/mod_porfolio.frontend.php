<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_porfolio.models.php"); 
	
	if (empty($params) || $params == "undefine") {
        $params = array(           
            'class' => '',
			'content' => ''
        );
    }
    else {
        $params = unserialize($params);
    }
	
?>    
<div class="<?php if (!empty($params['class'])) echo $params['class']; ?>">
    <?php if( !empty($module_title) ) { ?><h5 class="fw_light color_dark m_bottom_20"><?php echo $module_title; ?></h5><?php } ?>
        
    <!--our featured projects-->
    <div class="section_offset">
        <div class="container clearfix">
            <h3 class="color_dark m_bottom_15 t_align_c">Những dự án đã thực hiện</h3>
            <p class="m_bottom_35 t_align_c">Các dự án nổi bật Web Tiện Ích đã thực hiện cho khách hàng.</p>

            <section class="portfolio_isotope_container three_columns without_text m_xs_bottom_15 m_bottom_35" data-isotope-options='{"itemSelector" : ".portfolio_item","layoutMode" : "fitRows","transitionDuration":"0.7s"}'>
                <figure class="portfolio_item three_dimensional">
                    <!--image-->
                    <div class="popup_wrap relative r_corners wrapper db_xs_centered">
                        <img src="images/portfolio/caphephale.png" alt="">
                        <div class="project_description vc_child t_align_c tr_all_long"><div class="d_inline_m">
                            <h4 class="lh_inherit m_md_bottom_5 d_sm_none d_xs_block"><a href="#" class="color_light tr_all not_hover">DNTN Du lịch nhiệt đới</a></h4>
                            <!--project's info-->
                            <ul class="dotted_list m_bottom_5 color_light d_md_none d_xs_block">										
                                <li class="m_right_15 relative d_inline_m category">											
                                    <a href="#" class="fs_medium color_light not_hover"><i>www.johntour.com</i></a>
                                </li>										
                            </ul>
                            <div class="d_inline_b clearfix">
                            	<a href="images/portfolio/caphephale.png" data-group="portfolio" data-title="Title 1" class="jackbox icon_wrap_size_3 color_light n_sc_hover d_block circle f_left m_right_10">
                                    <i class="icon-plus"></i>
                                </a>
                                <a href="#" class="icon_wrap_size_3 color_light n_sc_hover d_block circle f_left">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div></div>
                    </div>
                </figure>
                <figure class="portfolio_item web">
                    <!--image-->
                    <div class="popup_wrap relative r_corners wrapper db_xs_centered">
                        <img src="images/portfolio/paradiseResort.png" alt="">
                        <div class="project_description vc_child t_align_c tr_all_long"><div class="d_inline_m">
                            <h4 class="lh_inherit m_md_bottom_5 d_sm_none d_xs_block"><a href="#" class="color_light tr_all not_hover">Công ty TNHH MTV 622 - Xí nghiệp 406</a></h4>
                            <!--project's info-->
                            <ul class="dotted_list m_bottom_5 color_light d_md_none d_xs_block">										
                                <li class="m_right_15 relative d_inline_m category">											
                                    <a href="#" class="fs_medium color_light not_hover"><i>www.xinghiep406.vn</i></a>
                                </li>										
                            </ul>
                            <div class="d_inline_b clearfix">
                                <a href="images/portfolio/paradiseResort.png" data-group="portfolio" data-title="Title 2" class="jackbox icon_wrap_size_3 color_light n_sc_hover d_block circle f_left m_right_10">
                                    <i class="icon-play"></i>
                                </a>
                                <a href="#" class="icon_wrap_size_3 color_light n_sc_hover d_block circle f_left">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div></div>
                    </div>
                </figure>
                <figure class="portfolio_item photography">
                    <!--image-->
                    <div class="popup_wrap relative r_corners wrapper db_xs_centered">
                        <img src="images/portfolio/lopexco.png" alt="">
                        <div class="project_description vc_child t_align_c tr_all_long"><div class="d_inline_m">
                            <h4 class="lh_inherit m_md_bottom_5 d_sm_none d_xs_block"><a href="#" class="color_light tr_all not_hover">Cty TNHH TM - DV - XD Tiện Ích</a></h4>
                            <!--project's info-->
                            <ul class="dotted_list m_bottom_5 color_light d_md_none d_xs_block">										
                                <li class="m_right_15 relative d_inline_m category">											
                                    <a href="#" class="fs_medium color_light not_hover"><i>www.vemaybaytienich.com</i></a>
                                </li>										
                            </ul>
                            <div class="d_inline_b clearfix">
                                <a href="images/portfolio/lopexco.png" data-group="portfolio" data-title="Title 3" class="jackbox icon_wrap_size_3 color_light n_sc_hover d_block circle f_left m_right_10">
                                    <i class="icon-plus"></i>
                                </a>
                                <a href="#" class="icon_wrap_size_3 color_light n_sc_hover d_block circle f_left">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div></div>
                    </div>
                </figure>
                <figure class="portfolio_item illustration">
                    <!--image-->
                    <div class="popup_wrap relative r_corners wrapper db_xs_centered">
                        <img src="images/portfolio/universalPharmacy.png" alt="">
                        <div class="project_description vc_child t_align_c tr_all_long"><div class="d_inline_m">
                            <h4 class="lh_inherit m_md_bottom_5 d_sm_none d_xs_block"><a href="#" class="color_light tr_all not_hover">Ut tellus dolor, dapibus eget</a></h4>
                            <!--project's info-->
                            <ul class="dotted_list m_bottom_5 color_light d_md_none d_xs_block">
                                <li class="m_right_15 relative d_inline_m">
                                    <a href="#" class="color_light not_hover fs_small">
                                        <i class="icon-video"></i>
                                    </a>
                                </li>
                                <li class="m_right_15 relative d_inline_m category">
                                    <a href="#" class="fs_medium color_light not_hover">
                                        <i>Mobile</i></a>, 
                                    <a href="#" class="fs_medium color_light not_hover"><i>Technology</i>
                                    </a>
                                </li>
                                <li class="m_right_15 relative d_inline_m">
                                    <a href="#" class="color_red_hover">
                                        <i class="icon-heart-empty-1 m_right_2 color_light tr_all"></i><i class="fs_medium color_light tr_all">56</i>
                                    </a>
                                </li>
                            </ul>
                            <div class="d_inline_b clearfix">
                                <a href="http://vimeo.com/61099540" data-group="portfolio" data-title="Title 4" class="jackbox icon_wrap_size_3 color_light n_sc_hover d_block circle f_left m_right_10">
                                    <i class="icon-play"></i>
                                </a>
                                <a href="#" class="icon_wrap_size_3 color_light n_sc_hover d_block circle f_left">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div></div>
                    </div>
                </figure>
                <figure class="portfolio_item three_dimensional">
                    <!--image-->
                    <div class="popup_wrap relative r_corners wrapper db_xs_centered">
                        <img src="images/portfolio/vemaybaytienich.png" alt="">
                        <div class="project_description vc_child t_align_c tr_all_long"><div class="d_inline_m">
                            <h4 class="lh_inherit m_md_bottom_5 d_sm_none d_xs_block"><a href="#" class="color_light tr_all not_hover">Sed ut perspiciatis unde omnis iste natus</a></h4>
                            <!--project's info-->
                            <ul class="dotted_list m_bottom_5 color_light d_md_none d_xs_block">
                                <li class="m_right_15 relative d_inline_m">
                                    <a href="#" class="color_light not_hover fs_small">
                                        <i class="icon-picture"></i>
                                    </a>
                                </li>
                                <li class="m_right_15 relative d_inline_m category">
                                    <a href="#" class="fs_medium color_light not_hover">
                                        <i>Mobile</i></a>, 
                                    <a href="#" class="fs_medium color_light not_hover"><i>Technology</i>
                                    </a>
                                </li>
                                <li class="m_right_15 relative d_inline_m">
                                    <a href="#" class="color_red_hover">
                                        <i class="icon-heart-empty-1 m_right_2 color_light tr_all"></i><i class="fs_medium color_light tr_all">9</i>
                                    </a>
                                </li>
                            </ul>
                            <div class="d_inline_b clearfix">
                                <a href="images/portfolio_img_1.jpg" data-group="portfolio" data-title="Title 5" class="jackbox icon_wrap_size_3 color_light n_sc_hover d_block circle f_left m_right_10">
                                    <i class="icon-plus"></i>
                                </a>
                                <a href="#" class="icon_wrap_size_3 color_light n_sc_hover d_block circle f_left">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div></div>
                    </div>
                </figure>
                <figure class="portfolio_item web">
                    <!--image-->
                    <div class="popup_wrap relative r_corners wrapper db_xs_centered">
                        <img src="images/portfolio/vietpoll.png" alt="">
                        <div class="project_description vc_child t_align_c tr_all_long"><div class="d_inline_m">
                            <h4 class="lh_inherit m_md_bottom_5 d_sm_none d_xs_block"><a href="#" class="color_light tr_all not_hover">Donec sagittis euismod</a></h4>
                            <!--project's info-->
                            <ul class="dotted_list m_bottom_5 color_light d_md_none d_xs_block">
                                <li class="m_right_15 relative d_inline_m">
                                    <a href="#" class="color_light not_hover fs_small">
                                        <i class="icon-picture"></i>
                                    </a>
                                </li>
                                <li class="m_right_15 relative d_inline_m category">
                                    <a href="#" class="fs_medium color_light not_hover">
                                        <i>Mobile</i></a>, 
                                    <a href="#" class="fs_medium color_light not_hover"><i>Technology</i>
                                    </a>
                                </li>
                                <li class="m_right_15 relative d_inline_m">
                                    <a href="#" class="color_red_hover">
                                        <i class="icon-heart-empty-1 m_right_2 color_light tr_all"></i><i class="fs_medium color_light tr_all">60</i>
                                    </a>
                                </li>
                            </ul>
                            <div class="d_inline_b clearfix">
                                <a href="images/portfolio_img_2.jpg" data-group="portfolio" data-title="Title 6" class="jackbox icon_wrap_size_3 color_light n_sc_hover d_block circle f_left m_right_10">
                                    <i class="icon-plus"></i>
                                </a>
                                <a href="#" class="icon_wrap_size_3 color_light n_sc_hover d_block circle f_left">
                                    <i class="icon-link"></i>
                                </a>
                            </div>
                        </div></div>
                    </div>
                </figure>
            </section>
            <div class="clearfix t_align_c">
                <a href="./website/cac-du-an-da-thuc-hien/wp1314.html" class="button_type_3 color_dark r_corners transparent fs_medium bg_color_purple_hover tr_all">Xem thêm</a>
            </div>
        </div>
    </div>
    
</div>