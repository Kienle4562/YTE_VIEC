<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    include_once("mod_product.models.php");
    if (count($GLOBALS['LANG_LIST']) > 1)
	{
		$__append = $GLOBALS['LANG'] . '/';
	}
	else
	{
		$__append = '';
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
    $mod_product = new process_mod_product();
    $result = $mod_product->get_category($params['cat_id'], $params['limit'], $GLOBALS['LANG']); 
?>
<!--products-->
<h5 class="fw_light color_dark m_bottom_23"><?php echo $module_title ?></h5>
<div class="shop_isotope_container t_xs_align_c three_columns m_bottom_15" data-isotope-options='{"itemSelector" : ".shop_isotope_item","layoutMode" : "fitRows","transitionDuration":"0.7s"}'>
	<?php
		while ($row = $result->fetch()){
			$image_list = explode('|', $row['product_image']);
			$Link = $GLOBALS['INDEX'] . $__append . $mod_product->get_category_list_hot($row['book_category_id'], '/', 'alias', $GLOBALS['LANG']) . "/" . $row["alias"] . "/p" . $row["id"] . $GLOBALS['EXT'];
	?>
    <div class="shop_isotope_item d_xs_inline_b">
        <!--product-->
        <figure class="fp_item t_align_c d_xs_inline_b">
            <div class="relative r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23 t_xs_align_c">
                <!--images container-->
                <div onclick="location.href='<?php echo $Link ?>'" style="cursor:pointer" class="fp_images relative">
                    <img title="<?php echo $rel_row['product_name']; ?>" src="<?php echo $image_list[0]; ?>" alt="<?php echo $rel_row['product_name']; ?>" class="tr_all">
                    <img title="<?php echo $rel_row['product_name']; ?>" src="<?php echo ($image_list[1] == '')?$image_list[0]:$image_list[1]; ?>" alt="<?php echo $rel_row['product_name']; ?>" class="tr_all">
                </div>
                <!--labels-->
                <div class="labels_container">
                    <a href="<?php echo $Link ?>" class="d_block label color_scheme tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">New</span></a>
                </div>
            </div>
            <figcaption>
                <h6 class="m_bottom_5"><a href="#" class="color_dark"><?php echo $row['product_name']; ?></a></h6>
                <div class="im_half_container m_bottom_10">
                    <p class="color_dark d_sm_block w_sm_full d_xs_inline_m w_xs_half_column fw_ex_bold half_column d_inline_m t_align_c tr_all animate_fctl fp_price with_ie">
                    <?php
						if($row["discounts"]>0){
							$giacu = $row["price"];
							$giamoi = $giacu-$row["discounts"];
							echo number_format($giamoi).'đ';
							echo ' <s class="fw_normal color_grey">'.number_format($giacu).'đ</s>';
						}else{
							echo number_format($row["price"]).'đ';
						}
					?>
                    </p>	
                    <div class="half_column d_sm_block w_sm_full d_xs_inline_m w_xs_half_column t_sm_align_c t_xs_align_r d_inline_m t_align_r tr_all animate_fctr with_ie">
                        <ul class="rating_list d_inline_m hr_list tr_all">
                           
                        </ul>
                        <a href="#" class="d_none reviews fs_medium color_dark m_left_5 tr_all"></a>
                    </div>
                </div>
                <div class="product_description d_none m_bottom_20">
                    <hr class="m_bottom_12"><hr>
                </div>
                <div class="clearfix fp_buttons">
                    <div class="half_column w_md_full m_md_bottom_10 animate_fctl tr_all f_left f_md_none with_ie">
                        <a href="<?php echo $Link ?>"" class="button_type_6 d_inline_b color_dark r_corners vc_child tr_all add_to_cart_button"><span class="d_inline_m clerarfix"><i class="icon-basket f_left m_right_10 fs_large"></i><span class="fs_medium">Xem chi tiết</span></span></a>
                    </div>
                    <div class="half_column w_md_full animate_fctr tr_all f_left f_md_none clearfix with_ie">
                        <a href="<?php echo $GLOBALS['APP']['config']['contact']['yahoo']["yahoo1"]; ?>" class="button_type_6 relative tooltip_container f_right f_md_none d_md_inline_b d_block color_dark r_corners vc_child tr_all color_blue_hover t_align_c"><i class="icon-facebook-1 d_inline_m fs_large"></i><span class="d_block r_corners color_default tooltip fs_small fw_normal tr_all">Facebook của chúng tôi</span></a>
                        <!--<a href="#" class="button_type_6 m_left_5 relative tooltip_container f_right f_md_none d_md_inline_b d_block color_dark r_corners vc_child tr_all color_purple_hover t_align_c m_right_5 m_md_right_0"><i class="icon-heart d_inline_m fs_large"></i><span class="d_block r_corners color_default tooltip fs_small fw_normal tr_all">Add to Wishlist</span></a>-->
                    </div>
                </div>
            </figcaption>
        </figure>
    </div>
    <?php }?>
</div>

	