<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_product_hot.models.php"); 
	
	if (count($GLOBALS['LANG_LIST']) > 1)
	{
		$__append = $GLOBALS['LANG'] . '/';
	}
	else
	{
		$__append = '';
	}
    if ($this) {
    	$lang_text = $this->load_module_language($row['module'], $GLOBALS['LANG']);
	}
	elseif ($core_class) {
		$lang_text = $core_class->load_module_language($row['module'], $GLOBALS['LANG']);
	}
    if (empty($params) || $params == "undefine") {
        $params = array(
            'limit' => 3,
            'cat_id' => 0,
			'show_title' => 1,
            'with_effect' => 0,
            'class' => ''
        );
    }

    elseif ($this) {
    	$params = unserialize($params);
    }

	if ($params['with_effect'] == 3) {
        $div_class = "mod_slideshow_with_vertical_scroll";
    }
    elseif ($params['with_effect'] == 2) {
        $div_class = "mod_slideshow_with_scroll";

    }
    elseif ($params['with_effect'] == 1) {
        $div_class = "mod_slideshow_with_effect";

    }
    elseif ($params['with_effect'] == 0) {
        $div_class = "mod_slideshow_no_effect";
    }
	
    $mod_product = new process_mod_product_new();

    $result = $mod_product->get_category($params['cat_id'], $params['limit'], $GLOBALS['LANG']);
	
?>

<div class="m_bottom_30">
    <!--title & nav-->
    <div class="clearfix m_bottom_25 m_sm_bottom_10 m_xs_bottom_20">        
        <?php if( !empty($module_title) ) { ?><h5 class="fw_light f_left f_sm_none f_xs_left color_dark m_sm_bottom_5 m_xs_bottom_0"><?= $module_title; ?></h5><?php } ?>
        <div class="f_right f_sm_none f_xs_right clearfix">
            <button class="icon_wrap_size_0 circle color_grey_light f_left m_right_5 specials_<?= $module_id; ?>_prev color_pink_hover tr_all">
                <i class="icon-angle-left fs_large"></i>
            </button>
            <button class="icon_wrap_size_0 circle color_grey_light f_left m_right_5 specials_<?= $module_id; ?>_next color_pink_hover tr_all">
                <i class="icon-angle-right fs_large"></i>
            </button>
        </div>
    </div>
    <div class="owl-carousel t_xs_align_c" data-plugin-options='{"transitionStyle":"backSlide","autoPlay" : true}' data-nav="specials_<?= $module_id; ?>_">
    	<?php while ($row = $result->fetch()){
            $Link = $GLOBALS['INDEX'] . $__append . $mod_product->get_category_list($row['book_category_id'], '/', 'alias', $GLOBALS['LANG']) . "/" . $row["alias"] . "/p" . $row["id"] . $GLOBALS['EXT'];
        ?>
        <!--product-->
        <figure class="fp_item t_align_c d_xs_inline_b">
            <div class="relative max_height_200 r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23">
                <!--images container-->
                <div class="relative">                    
                    <a href="<?= $Link; ?>">
						<?php $image_list = explode('|', $row['product_image']); 
                            if (!empty($image_list) && ($image_list[0] != 'Chọn file hình ảnh cần thêm .. ') && (trim($image_list[0]) != ''))
                            {
                                if ($GLOBALS['APP']['config']['use-thumbnail'] == 1) {
                                    ?><img src="<?php echo str_replace('/files/', '/files/_thumbs/', $image_list[0]); ?>" alt="" class="tr_all" /><?php
                                } else {
                                    ?><img src="<?php echo $image_list[0]; ?>" alt="" class="tr_all" /><?php
                                }
                            }
                            else {
                                ?><img src="images/no-image.jpg" alt="" class="tr_all" /><?php
                            }
                        ?>
                    </a>
                </div>               
            </div>            
        </figure>
        <?php } ?>
    </div>
</div>