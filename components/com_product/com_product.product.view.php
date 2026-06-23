<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

$lang_text = $core_class->load_module_language('com_product_detail_view', $GLOBALS['LANG']);

include_once('com_product.product.models.php');

if (count($GLOBALS['LANG_LIST']) > 1)
{
  $__home = $GLOBALS['LANG'] . $GLOBALS['EXT'];
  $__append = $GLOBALS['LANG'] . '/';
}
else
{
  $__home = $GLOBALS['INDEX'];
  $__append = '';
}

$productProc = new process_product();

$currentProduct = $productProc->get_product(intval($_GET['id']), $GLOBALS['LANG']);

if ($row = $currentProduct->fetch(PDO::FETCH_ASSOC))
{				
  
	$pathways = $productProc->get_pathway($row['book_category_id']);				
  	for($i = 0; $i < count($pathways); $i++){
		$link .= "/" . $pathways[$i]["alias"]. "/cp". $pathways[$i]["cat_id"] . $GLOBALS['EXT'];
		$daumuiten = "";
		if($i==count($pathways)-1){
			$daumuiten = "";
		}else{
			$daumuiten = "<i class=\"icon-angle-right d_inline_m color_default fs_small\"></i>";
		}
		$pathway_text .= "<li class=\"m_right_8 f_xs_none\"><a href=\"$link\" class=\"color_default d_inline_m m_right_10\">" . $pathways[$i]["title"] . "</a>".$daumuiten."</li>";
	}

if (!$core_class->is_visited('product', $row['id'], 86400)) {
    $productProc->increase_num_view($row['id']);
    $row['num_view']++;
}

if( !empty($row['product_title']) ){ $meta_title = $row['product_title']; }
else { $meta_title = str_replace('-', ' ', $row['product_name']); }

if( !empty($row['product_keyword']) ){ $meta_keyword = $row['product_keyword']; }
else { $meta_keyword = str_replace('-', ' ', $row['alias']); }

if( !empty($row['product_desc']) ){ $meta_description = strip_tags($row['product_desc']); } 
else { $meta_description = str_replace(array("\n", "\t"), array("", ""), strip_tags($row['description'])); }

$image_list = explode('|', $row['product_image']); $i = 1;

$meta_image = $image_list[0];

?>         
<div class="clearfix m_bottom_45 m_xs_bottom_30">                
	<div class="f_left product_view f_sm_none m_sm_bottom_30">
		<div class="clearfix">
            <div class="thumbnails_carousel t_align_c f_left m_right_20">
                <ul id="thumbnails">                            	
                    <li>
                        <?php 
                        $image_list = explode('|', $row['product_image']); $i = 1;
                        foreach ($image_list as $src) { 
                            if( $i%6 == 0 ){?> </li><li><?php } ?>
                            <a href="#" data-zoom-image="<?php echo $src; ?>" data-image="<?php echo $src; ?>" id="<?php if($i==1){echo "click_to_zoom";}?>" class="<?php if($i==1){echo "active";}?> d_block wrapper r_corners tr_all translucent m_bottom_10"><img src="<?php echo str_replace('/files/', '/files/_thumbs/', $src); ?>" alt="" class="r_corners"></a>
                            <?php $i++; 
                        } 
                        $image_bg = "image_bg_news";

                        if(!empty($image_list[0])){
                            $meta_image = $image_list[0];
                        } else {
                            $meta_image = "./templates/khoquarung/images/icons/logo.png";
                        }
                        ?>
                    </li>
                </ul>
                <div class="helper-list"></div>
            </div>
            <div class="wrapper r_corners container_zoom_image relative">
                <img id="img_zoom" src="<?php echo $image_list[0]; ?>" data-zoom-image="<?php echo $image_list[0]; ?>" alt="">                            
            </div>
            <a href="#" class="open_product f_right button_type_6 d_block r_corners tr_all t_align_c">
                <i class="icon-resize-full"></i>
            </a>
        </div>
        	<!--share buttons-->
        <div class="m_top_15">
            <p class="fw_light d_inline_m m_right_8">Share: </p>
            <div class="m_bottom_20">
                <div id="fb-root"></div>
                <script>
                    (function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.0";
                      fjs.parentNode.insertBefore(js, fjs);
                  }(document, 'script', 'facebook-jssdk'));
              </script>

              <div class="clear">
                <div class="fb-send" data-href="<?php echo "http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                </div>                                
                <div class="fb-like" data-href="<?php echo "http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true">
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <g:plusone size='medium' ></g:plusone>
              </div>
        	</div>
    	</div>
	</div>
    <div class="f_right product_info f_sm_none w_sm_full">
        <div class="fw_ex_bold color_pink product_current_price m_bottom_15 lh_medium">
            <?php echo number_format($row['price'], 0) ." VNĐ"; ?>
        </div>
        <h4 class="title_sp color_dark f_ex_bold m_bottom_15">
            <?php echo $row['product_name']; ?>                       
        </h4>
        <!--<hr class="m_bottom_15">  -->        
        <!--<div class="color_grey fs_medium m_bottom_15"><?php if($row['attach_info']==""){echo "Không có mô tả nào cho sản phẩm này";}else{echo $row['attach_info'];} ?> </div>-->
        <hr class="m_bottom_12">
        <table class="color_grey fw_light table_type_9 m_bottom_15">
            <tr>
                <td colspan="2">
                    <span class="color_light_green">Có sẵn</span>
                </td>
            </tr>
            <tr>
                <td>
                    Mã sản phẩm:
                </td>
                <td>
                    <?php echo $row['SPID']; ?>
                </td>
            </tr>
            <tr>
                <td>
                    Danh mục:
                </td>
                <td>
                    <?php echo $pathways[count($pathways)-1]["title"] ?>
                </td>
            </tr>
        </table>
        <hr class="m_bottom_15">
        <form name="frmCart" id="frmCart" method="post" action="./cart.html">
        <table class="fw_light table_type_9 m_bottom_20">
            <tr>
                <td class="v_align_m color_grey">
                    Số lượng: 
                </td>
                <td class="color_grey">
                    <div class="wrapper d_inline_m fs_medium r_corners quantity type_2 clearfix">
                        <button type="button" class="f_left bg_light_3" data-count="minus">
                            <i class="icon-minus "></i>
                        </button>
                        <input type="text" name="quantity" readonly value="1" class="f_left color_grey bg_light">
                        <button type="button" class="f_left bg_light_3" data-count="plus">
                            <i class="icon-plus"></i>
                        </button>
                    </div>
                </td>
            </tr>
        </table>
        	<button class="button_type_7 m_mxs_bottom_5 d_inline_b m_right_2 tt_uppercase color_red r_corners vc_child tr_all add_to_cart_button"><span class="d_inline_m clerarfix"><i class="icon-basket f_left m_right_10 fs_large"></i><span class="fs_medium">Đặt hàng</span></span></button>
            <input type="hidden" name="productId" value="<?php echo $row['id']; ?>" />
            <input type="hidden" name="price" value="
            <?php 
             if($row['discounts']>0) echo $row['discounts']; else echo $row['price'];
            ?>" />
            <input type="hidden" name="do" value="add_to_cart" />
        </form>                           
            </div>
                </div>
                <div class="tabs m_bottom_40 m_xs_bottom_30">
                    <!--tabs nav-->
                    <ul class="tabs_nav hr_list d_inline_b d_xs_block m_bottom_23 m_xs_bottom_20">
                        <li class="f_xs_none"><a href="#tab-1" class="color_dark d_block n_sc_hover tr_all_medium">Thông tin sản phẩm</a></li>
                        <li class="f_xs_none"><a href="#tab-2" class="color_dark d_block n_sc_hover tr_all_medium">Bình luận</a></li>
                    </ul>
                    <!--tabs content-->
                    <div id="tab-1">
                        <?php if($row['description']==""){echo "Không có thông tin mô tả nào";}else {echo $row['description'];} ?>
                    </div>
                    <div id="tab-2">
                        <div class="fb-comments" data-href="<?php echo "http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" data-width="100%" data-numposts="10"></div>
                    </div>
                </div> 
    			<!-- Phần Slider -->
				<?php
                    $related_product = $productProc->get_related_products($row['book_category_id'], $row['id']);
                    if ($related_product->rowCount() > 0)
                    { 
                ?>
        		<!--title & nav-->
                <div class="clearfix m_bottom_23 m_sm_bottom_10 m_xs_bottom_20">
                    <h5 class="fw_ex_bold f_left f_xs_none color_dark m_xs_bottom_10">Các sản phẩm liên quan</h5>
                    <div class="f_right f_xs_none clearfix">
                        <button class="icon_wrap_size_5 circle color_grey_light f_left m_right_8 fproducts_nav_123_prev fn_type_2 color_scheme_hover tr_all">
                            <i class="icon-angle-left fs_large"></i>
                        </button>
                        <button class="icon_wrap_size_5 circle color_grey_light f_left fproducts_nav_123_next fn_type_2 color_scheme_hover tr_all">
                            <i class="icon-angle-right fs_large"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="featured_products owl-carousel t_xs_align_c m_bottom_45 m_xs_bottom_30 box_product_lienquan" data-plugin-options='{"singleItem":false,"itemsCustom":[[1200,3],[992,3],[768,3],[600,2],[10,2]],"autoPlay":true}' data-nav="fproducts_nav_123_">
                        <?php
                            while ($rel_row = $related_product->fetch(PDO::FETCH_ASSOC)){
                            $Link = $GLOBALS['INDEX'] . $__append . $productProc->get_category_list($rel_row['book_category_id'], '/', 'alias') . "/" . $rel_row["alias"] . "/p" . $rel_row["id"] . $GLOBALS['EXT']; 
                        ?>
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="ht_product m_bottom_30 border">
                                <div class="hinh_product m_bottom_20">
                                    <a href="<?php echo $Link; ?>"><img src="<?php $image_list = explode('|', $rel_row['product_image']); echo $image_list[0]; ?>" /></a>
                                </div>
                                <div class="khung_tieude_product">
                                    <h6 class="fw_light fs_custom m_bottom_5 t_align_c m_top_40"><a href="<?php echo $Link; ?>" class="color_dark"><?php echo $rel_row['product_name']; ?></a></h6>
                                </div>
                                <div class="clearfix t_align_c">
                                    <div class="w_md_full m_md_bottom_10 tr_all with_ie">
                                        <a href="<?php echo $Link; ?>" class="button_type_6_custom d_inline_b fw_ex_bold color_dark vc_child tr_all add_to_cart_button">
                                            <span class="d_inline_m clerarfix">
                                                <span class="fs_medium">Chi tiết</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
            	</div>            
            <?php }} ?>
		<script>
            setTimeout(function(){
                $("#click_to_zoom").click();
            },1000);
        </script>
