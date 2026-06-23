<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    include_once("mod_product_khachhangyeuthich.models.php");
    
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
            'cat_id' => 0,
            'max_level' => 0
        );
    }
    else {
        $params = unserialize($params);
    } ?>

	<div class="clearfix"></div>
    <div class="bg_gach2ben f_xs_none m_xs_bottom_10 fix_style_font t_align_c m_top_20 m_bottom_20">
        <h1 class="tieudeh1 fw_ex_bold">
			<?php echo $module_title; ?>
        	<?php $this->add_component_translate_button($row['module']); ?>
        </h1>
    </div>
    <!--products-->
    <div class="row products">
    <?php
		for($number=1;$number<=5;$number++){
			if(substr($params["khung".$number."_linkurl"], -5)!=".html"){
				$params["khung".$number."_linkurl"] = $params["khung".$number."_linkurl"].".html";
			}
	?>
    	<?php 
			if($number!=2){
		?>
    	<figure class="t_xs_align_c col-lg-4 col-xs-6 <?= ($i==5)?'col-xs-12':'col-xs-6' ?>">
        <?php }?>
        	<figcaption>
                <h4 class="m_bottom_5">
                	<a href="<?= $params["khung".$number."_linkurl"] ?>" class="color_dark title_product"><?= $params["khung".$number."_title"] ?></a>
                </h4>
            </figcaption>
            <!--image container-->
            <div class="popup_wrap relative wrapper m_bottom_10 d_xs_inline_b d_mxs_block">
                <a class="<?= ($number!=3)? "modxuhuong":'' ?>" href="<?= $params["khung".$number."_linkurl"] ?>"><img src="<?= $params["khung".$number."_image"] ?>" onerror='this.src="templates/anthy/images/anthy_logo.png"'/></a>
                <div class="popup_buttons tr_all_long">
                    <a href="<?= $params["khung".$number."_linkurl"] ?>" class="mau_trang n_sc_hover d_block linkurl f_left m_right_10">
                        XEM THÊM
                    </a>
                </div>
            </div>
     	<?php 
				if($number!=1){
		?>
        	</figure>
        <?php  }?>
	<?php } ?>   
     </div>
     
     
<script>
$('.thumb').hover(function() {
		$(this).find("img:last").fadeToggle();
	});
</script>