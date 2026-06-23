<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_category.models.php"); 
	
	if (empty($params) || $params == "undefine") {
        $params = array(           
            'class' => '',
			'content' => ''
        );
    }
    else {
        $params = unserialize($params);
    }
	
	$mod_product = new mod_category_process();
    $result = $mod_product->get_category_list();
	
?>    
<div class="clearfix"></div>
<div class="clearfix m_bottom_10 mod_product <?php echo $div_class; ?> <?php if ($params['class'] != '') { echo 'mod_product_' . $params['class']; } ?>">
 					   <div class="f_left f_xs_none m_xs_bottom_10 fix_style_font fix_padding_top_bt">
									<h1><?php echo $module_title; ?>
              					  <?php $this->add_component_translate_button($row['module']); ?></h1>
								</div>
                                
                                
    </div>
     <hr class="m_bottom_10">
    <!--title & nav-->
<section class="portfolio_isotope_container two_columns without_text m_xs_bottom_15 m_bottom_35" data-isotope-options='{"itemSelector" : ".portfolio_item","layoutMode" : "fitRows","transitionDuration":"0.7s"}'>
			<?php  
			while ($row = $result->fetch()){ 
			$link = $GLOBALS['INDEX'] . $__append .$row['alias']."/cp".$row['cat_id']. $GLOBALS['EXT'];
			?>
            	  <figure class="portfolio_item three_dimensional">
							<!--image & description-->
							<div class="popup_wrap relative r_corners wrapper db_xs_centered">
								<img src="<?php echo $row['image'] ?>" alt="">
								<div class="project_description vc_child t_align_c tr_all_long"><div class="d_inline_m">
									<h4 class="lh_inherit"><a href="<?php echo $link ?>" class="color_light tr_all not_hover"><?php echo $row['title'] ?></a></h4>
								</div></div>
							</div>
						</figure>
            <?php } ?>
	</section>
