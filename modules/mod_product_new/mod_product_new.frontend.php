<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
	include_once("mod_product_new.models.php"); 
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
    $mod_product = new process_mod_product_new();
    $result = $mod_product->get_category($params['cat_id'], $params['limit'], $GLOBALS['LANG']);
?>
<div>
    <h5 class="fw_light color_dark m_bottom_23"><?php echo $module_title ?></h5>
    <ul>
    	<?php 
			while ($row = $result->fetch()){
            $Link = $GLOBALS['INDEX'] . $__append . $mod_product->get_category_list($row['book_category_id'], '/', 'alias', $GLOBALS['LANG']) . "/" . $row["alias"] . "/p" . $row["id"] . $GLOBALS['EXT'];
        	$image_list = explode('|', $row['product_image']); 
		?>
        <li class="clearfix m_bottom_35 m_xs_bottom_30">
            <a href="<?= $Link ?>" class="f_left d_block f_sm_none f_xs_left d_sm_inline_b m_sm_bottom_5 m_xs_bottom_0 r_corners wrapper m_right_20">
                <img height="80" onerror='this.src="<?= 'templates/' . mapping('template').'/images/'.mapping('template').'_logo.png'?>"' src="<?php echo str_replace('/files/', '/files/_thumbs/', $image_list[0]); ?>" alt="<?php echo $row['product_name']; ?>">
            </a>
            <a href="<?= $Link ?>" class="color_dark lh_small d_block m_bottom_10 tr_all"><?php echo $row['product_name']; ?></a>
            <p class="color_dark fs_medium fw_ex_bold fp_price m_bottom_3">
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
        </li>
        <?php }?>
    </ul>
</div>

