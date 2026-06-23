<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_customer_partner.models.php"); 
	
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

<div class="clearfix"></div>

<div class="container">
<div class="<?php if (!empty($params['class'])) echo $params['class']; ?>">
    <?php if( !empty($module_title) ) { ?><h5 class="color_purple fw_light m_bottom_15 t_align_c font_UTMEremitage fw_ex_bold"><?php echo $module_title; ?></h5><?php } ?>           

    <div class="relative">
        <div class="t_xs_align_c">
            <div class="owl-carousel clients brands t_align_c" data-plugin-options='{"pagination":true,"transitionStyle" : "backSlide"}' data-nav="c_nav_">
                <!--item-->
                <div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_1.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_2.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_3.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_4.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_5.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_6.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--item-->
                <div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_1.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_2.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_3.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_4.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_5.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_6.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--item-->
                <div>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_1.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_2.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 m_bottom_20 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_3.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_4.jpg" alt="">
                                </a>
                            </div>
    
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_5.jpg" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 f_mxs_none w_mxs_full m_mxs_bottom_10">
                            <div class="clients_item db_xs_centered wrapper relative r_corners d_xs_block d_mxs_inline_b">
                                <a href="#" class="d_block translucent tr_all wrapper r_corners">
                                    <img src="images/client_logo_6.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--carousel nav-->
        <button class="icon_wrap_size_5 circle color_grey_light tr_all color_blue_hover c_nav_prev nav_type_2 d_md_none">
            <i class="icon-left-open-big"></i>
        </button>
        <button class="icon_wrap_size_5 circle color_grey_light tr_all color_blue_hover c_nav_next nav_type_2 d_md_none">
            <i class="icon-right-open-big"></i>
        </button>
    </div>

</div>

</div>