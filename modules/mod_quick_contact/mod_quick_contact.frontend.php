<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_quick_contact.models.php"); 
	
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
        
    <!--quick contact-->
    <section class="section_offset bg_light_2">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-9 col-sm-8 col-lg-offset-1" data-appear-animation="fadeInUp">
                    <h4 class="color_dark fw_light m_bottom_15">Bạn muốn được tư vấn <span class="color_green"><a href=".">Thiết kế web</a></span> hoàn toàn miễn phí</h3>
                    <p class="heading_4">Hãy gởi thông tin của bạn đến cho WTI, chúng tôi sẽ liên hệ lại quý khách trong 10 phút.</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4" data-appear-animation="fadeInUp" data-appear-animation-delay="150">
                    <a href="#" id="get_started" class="button_type_4 color_yellow r_corners tt_uppercase fs_large tr_all f_left m_right_10 m_md_bottom_10">Bắt đầu ngay</a>
                </div>
            </div>
        </div>
    </section>
    
</div>