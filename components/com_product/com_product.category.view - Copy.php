<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

   $lang_text = $core_class->load_module_language('com_product_category_view', $GLOBALS['LANG']);

    include_once('com_product.category.models.php');
    include_once('protected/paging.php');
    
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

    $categoryProc =  new process_category();
	
    /* predefine something */
    $cat_id = intval( $_GET['id'] );	
    
    /* get total row */
    $totalrow = $categoryProc->get_category_count($cat_id);
    
    /* config items per page */
    $itemPerPage = 12;
    
    /* phan trang */
    if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);
    $pager = Pager::getPagerData( $totalrow, $itemPerPage, $currentPage, $__append . $_GET["params"] . $GLOBALS['EXT'] );
    
    //$page_title = $categoryProc->get_category_list($cat_id, ' » ', 'title');    
    //$meta_title = $page_title . ' - ' . $meta_title;
	
	$category_title = $categoryProc->get_category_title($cat_id);    
    $meta_title = $category_title;
    
    if ( $totalrow > 0 )
    {
		$pathways = $categoryProc->get_pathway($cat_id);
		
		for($i = 0; $i < count($pathways) - 1; $i++){
			$link .= "/" . $pathways[$i]["alias"]. "/cp". $pathways[$i]["cat_id"] . $GLOBALS['EXT'];
			$pathway_text .= "<li class=\"m_right_8 f_xs_none\"><a href=\"$link\" class=\"color_dark d_inline_m m_right_10\">" . $pathways[$i]["title"] . "</a><i class=\"icon-angle-right d_inline_m color_default fs_small\"></i></li>";
		}
		
        /* Get category items */
        $result = $categoryProc->get_category($cat_id, intval($pager->offset), intval($pager->limit) ); ?>
        
        <!--filter-->
        <div class="clearfix m_bottom_10">
            <!--breadcrumbs-->        
            <ul class="hr_list fs_large d_inline_m">
                <li class="m_right_8 f_xs_none"><a href="." class="color_dark d_inline_m m_right_10">Trang chủ</a><i class="icon-angle-right d_inline_m color_default fs_small"></i></li>
                <?= $pathway_text; ?>
                <li><a class="color_dark d_inline_m"><?= $category_title; ?></a></li>           
            </ul>
            
            <ul class="hr_list f_right fs_medium paginations t_align_c f_xs_none">
                <li class="active">
                    <a href="portfolio_classic_1_column.html" data-shop-layout="grid" class="rc_first_hr color_dark">
                        <i class="icon-layout fs_large"></i>
                    </a>
                </li>
                <li>
                    <a href="#" class="rc_last_hr color_dark" data-shop-layout="list">
                        <i class="icon-menu"></i>
                    </a>
                </li>
            </ul>
        </div>
        <hr class="m_bottom_10">
        <div class="row">            
            <div class="col-lg-12 col-md-12 col-sm-12 m_bottom_15 t_align_r t_xs_align_l">
                <ul class="hr_list d_inline_b fs_medium paginations t_align_c">
                    <?= $pager->paging; ?>
                </ul>
            </div>
        </div>
        <!--products-->
        <div class="shop_isotope_container t_xs_align_c three_columns m_bottom_15" data-isotope-options='{"itemSelector" : ".shop_isotope_item","layoutMode" : "fitRows","transitionDuration":"0.7s"}'>
        <?php 
			$i = 0;

			while ($row = $result->fetch())
			{
				$i++;
				$Link = $GLOBALS['INDEX'] . $__append . $categoryProc->get_category_list($row['book_category_id'], '/', 'alias') . "/" . $row["alias"] . "/p" . $row["id"] . $GLOBALS['EXT'];
				
		?>
        	<div class="shop_isotope_item d_xs_inline_b">
                <!--product-->
                <figure class="fp_item t_align_c d_xs_inline_b">
                    <div class="relative max_height_200 r_corners d_xs_inline_b d_mxs_block wrapper m_bottom_23 t_xs_align_c">
                        <!--images container-->
                        <div class="relative">
                        	<a href="<?php echo $Link; ?>">             	
                                <?php
									$image_list = explode('|', $row['product_image']);
									
									if (!empty($image_list)
											&& ($image_list[0] != 'Chọn file hình ảnh cần thêm .. ')
											&& (trim($image_list[0]) != '')
										)
									{
										if ($GLOBALS['APP']['config']['use-thumbnail'] == 1) {
											?><img src="<?php echo str_replace('/files/', '/files/_thumbs/', $image_list[0]); ?>" alt="" class="tr_all"><?php
										} else {
											?><img src="<?php echo $image_list[0]; ?>" alt="" class="tr_all"><?php
										}
									}
									else {
										?><img src="images/no-image.jpg" alt="" class="tr_all" /><?php
									}
								?>
                            </a>
                        </div>
                        <!--labels-->
                        <!--<div class="labels_container">
                            <a href="#" class="d_block label color_scheme tt_uppercase fs_ex_small circle m_bottom_5 vc_child t_align_c"><span class="d_inline_m">New</span></a>
                        </div>-->
                    </div>
                    <figcaption>
                        <h6 class="m_bottom_5"><a href="<?php echo $Link; ?>" class="color_dark"><?php echo $row['product_name']; ?></a></h6>
                        <a href="#" class="fs_medium color_grey d_inline_b m_bottom_3"><i><?= $row["category_title"]; ?></i></a>
                        <div class="im_half_container m_bottom_10">
                            <p class="color_dark d_sm_block w_sm_full d_xs_inline_m w_xs_half_column fw_ex_bold half_column d_inline_m t_align_c tr_all animate_fctl fp_price with_ie">
								<?php
                                    if ($row['price'] > 0) {
                                        if($GLOBALS['LANG'] == "vi"){
                                            echo number_format($row['price'], 0) . ' VNĐ';
                                        } else {
                                            echo "S$" . number_format($row['price']/100, 2);
                                        }
                                    }
                                    else {
                                        if($GLOBALS['LANG'] == "vi"){
                                            echo 'Liên hệ';
                                        } else {
                                            echo 'Contact';
                                        }                                                                            
                                    }
                                ?>
                            </p>	
                            <div class="half_column d_sm_block w_sm_full d_xs_inline_m w_xs_half_column t_sm_align_c t_xs_align_r d_inline_m t_align_r tr_all animate_fctr with_ie">                                
                                <a href="#" class="reviews fs_medium color_dark m_left_5 tr_all">Xem (2)</a>
                            </div>
                        </div>
                        <div class="clearfix fp_buttons">
                            <div class="half_column w_md_full animate_fctl tr_all f_left with_ie f_md_none m_md_bottom_10">
                            	<a href="<?= $Link; ?>" class="button_type_6 d_inline_b color_purple transparent r_corners vc_child tr_all add_to_cart_button"><span class="d_inline_m clerarfix"><i class="icon-zoom-in f_left m_right_10 fs_large"></i><span class="fs_medium">Xem chi tiết</span></span></a>
                            </div>
                            <div class="half_column w_md_full animate_fctr tr_all f_right clearfix with_ie f_md_none">
                                <form name="frmCart" id="frmCart" method="post" action="./cart.html">
                                    <button class="button_type_6 d_inline_b color_purple transparent r_corners vc_child tr_all add_to_cart_button"><span class="d_inline_m clerarfix"><i class="icon-basket f_left m_right_10"></i><span class="fs_medium">Đặt hàng</span></span></button>                                
                                    <input type="hidden" name="productId" value="<?= $row['id']; ?>" />
                                    <input type="hidden" name="do" value="add_to_cart" />
                                </form>
                            </div>
                        </div>
                    </figcaption>
                </figure>
            </div>
		<?php } ?>
        
        </div>
        <div class="row">            
            <div class="col-lg-12 col-md-12 col-sm-12 t_align_r t_xs_align_l">
                <ul class="hr_list d_inline_b fs_medium paginations t_align_c">
                    <?= $pager->paging; ?>
                </ul>
            </div>
        </div>
        <?php
    }