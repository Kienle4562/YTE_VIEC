<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	
	$lang_text = $core_class->load_module_language('com_content_category_view', $GLOBALS['LANG']);
	
	include_once('com_content.category.models.php');
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
    $cat_id = intval($_GET['id']);
	
	/* get total row */
	$totalrow = $categoryProc->get_category_count($cat_id);	
	
    /* config items per page */
	$itemPerPage = 12;
	
	/* phan trang */
	if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);
	$pager = Pager::getPagerData( $totalrow, $itemPerPage, $currentPage, $__append . $_GET["params"] . $GLOBALS['EXT'] . "?" );

    $category_title = $categoryProc->get_category_title($cat_id);    
    $meta_title = $category_title;

	if ( $totalrow > 0 )
    {
		$pathways = $categoryProc->get_pathway($cat_id);				
		
		for($i = 0; $i < count($pathways) - 1; $i++){
			$link .= "/" . $pathways[$i]["alias"]. "/cn". $pathways[$i]["cat_id"] . $GLOBALS['EXT'];
			$pathway_text .= "<li class=\"m_right_8 f_xs_none\"><a href=\"$link\" class=\"color_dark d_inline_m m_right_10\">" . $pathways[$i]["title"] . "</a><i class=\"icon-angle-right d_inline_m color_default fs_small\"></i></li>";
		}
		
		/* Get category items */
		$result = $categoryProc->get_category($cat_id, intval($pager->offset), intval($pager->limit) ); ?>        
		
        <!--breadcrumbs-->        
        <ul class="hr_list fs_large d_inline_m">
            <li class="m_right_8 f_xs_none"><a href="." class="color_dark d_inline_m m_right_10">Trang chủ</a><i class="icon-angle-right d_inline_m color_default fs_small"></i></li>
			<?= $pathway_text; ?>
            <li><a class="color_dark d_inline_m"><?= $category_title; ?></a></li>           
        </ul>
        
        <hr class="m_bottom_15" />
        
        <section class="blog_isotope_container three_columns type_2 m_bottom_35 m_xs_bottom_15" data-isotope-options='{"itemSelector" : ".blog_isotope_item","layoutMode" : "masonry","transitionDuration":"0.7s","masonry" : {"columnWidth":".blog_isotope_item"}}'>

            <?php 
			while ($row = $result->fetch())
			{
				$Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT'];  ?>
                
            <div class="blog_isotope_item">
                <!--post-->
                <article class="r_corners border_grey">
                
                    <!--post content-->
                    <figure>
                    	<?php if (($row['img_file'] != 'Chọn file hình ảnh cần upload ...') && (trim($row['img_file']) != '') ) { ?>
                        <a href="<?= $Link; ?>" class="d_block wrapper r_corners m_bottom_23">
                            <img src="<?php echo $row['img_file']; ?>" alt="<?php echo $row['img_file']; ?>">
                        </a>
                        <?php } ?>
                        <figcaption>
                            <h6 class="m_bottom_8">                            
                            	<a href="<?php echo $Link; ?>" class="color_dark tr_all"><?php echo $row['title']; ?></a>
                            </h6>
                            <ul class="dotted_list m_bottom_8 color_grey_light_2 lh_ex_small">                                
                                <li class="m_right_15 relative d_inline_m">
                                    <a href="#" class="color_grey fs_small">
                                        <i><?= date("d/m/Y", $row['date_add']); ?></i>
                                    </a>
                                </li>
                                <li class="m_right_15 relative d_inline_m">
                                    <a href="#" class="color_grey fs_small">
                                        <i>Đăng bởi: <?= $row['fullName']; ?></i>
                                    </a>
                                </li>
                                <li class="m_right_15 relative d_inline_m">
                                    <a href="#" class="fs_medium color_grey"><i><?= $row['cat_title']; ?></i></a>
                                </li>
                            </ul>
                            <p class="fw_light m_bottom_12"><?php echo $row['description']; ?></p>
                            <a href="<?php echo $Link; ?>" class="color_purple d_inline_b color_pink_hover d_block m_right_20 fw_light">
                                <span class="d_inline_m m_right_5 icon_wrap_size_0 circle color_grey_light tr_all">
                                    <i class="icon-angle-right"></i>
                                </span>
                                Xem chi tiết
                            </a>
                        </figcaption>
                    </figure>
                </article>
            </div>
            <?php } ?>            
        </section>
        <div class="clearfix t_align_c">
            <button id="load_more" class="button_type_2 color_dark r_corners transparent fs_medium bg_color_purple_hover tr_all">Xem thêm</button>
        </div>

        <?php
    }