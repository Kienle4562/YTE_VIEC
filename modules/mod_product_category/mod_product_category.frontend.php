<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
include_once("mod_product_category.models.php");
if (count($GLOBALS['LANG_LIST']) > 1){
	$__append = $GLOBALS['LANG'] . '/';
}
else{
	$__append = '';
}
if (empty($params) || $params == "undefine") {
	$params = array(
	'cat_id' => 0,
	'max_level' => 0
	);
}else {
	$params = unserialize($params);
} ?>
<?php if($this->isMobile()){ ?>
<script>
$(document).ready(function(e) {
	$("#open_menu").click(function(){
		$('#side_menu').addClass("active");
		$("#side_menu").animate({
			'right':'0px'
		});
	})
	$("#side_menu a").click(function(e){
		if($(this).closest('li').has('ul').length){
			if($(this).closest('li').children('ul.submenu').hasClass("activesubmenu")){
				$(this).closest('li').children('ul.submenu').removeClass("activesubmenu");
				$(this).closest('li').children('ul.submenu').addClass("d_xs_none");
			}else{
				$(this).closest('li').children('ul.submenu').removeClass("d_xs_none");
				$(this).closest('li').children('ul.submenu').addClass("activesubmenu");
			}
		}
		window.location = e.target;
		return false;
	})
    $(".wide_layout").click(function(e){
		if ($('#side_menu').hasClass('active')) {
			if($('#side_menu').hasClass('activemenu')){
				$("#side_menu").animate({
					'right':'-280px'
				});
				$('#side_menu').removeClass("activemenu");
				$('#side_menu').removeClass("active");
			}else{
				$('#side_menu').addClass("activemenu");
			}
		}
	})
});
</script>
<div class="container">
	<div class="row background_top">
        <section id="menutop" class="header_bottom_part bg_blue transbox">
        	<span class="gradient_line"></span>
            <section class="header_bottom_part">
                <div class="w_full d_xs_block">
                    <div class="padding_top_15 padding_bottom_5">
                        <!--side menu-->
                        <button id="open_menu" class="openmenubtn icon_wrap_size_10 r_corners tr_all d_xs_block">
                            <i class="icon-menu"></i>
                        </button>
                        
                        <div id="side_menu">
                            <!--side menu-->
                            <nav class="menu_tren cbp-spmenu-vertical cbp-spmenu">
                                <ul class="side_main_menu fw_light main_menu">
                                
                                    <?php
                                        if (!function_exists("mod_product_category"))
                                        {
                                            function mod_product_category($parentid = 0, $group_menu_id, $ext, $max_level, $current_level, &$params)
                                            {
                                                $myprocess = new process_product_category();                
												$result = $myprocess->category_multi_level($parentid, $GLOBALS['LANG']);
												$total = $result->rowCount();
                
                                                if ($total > 0)
                                                {
                                                    if($current_level > 1){
                                                        echo '<ul class="submenu">';
                                                    }
                                                    
                                                    if (count($GLOBALS['LANG_LIST']) > 1)
                                                    {
                                                        $__home = $GLOBALS['LANG'] . $GLOBALS['EXT'];
                                                        $__append = $GLOBALS['LANG'] . '/';
                                                    }
                                                    else
                                                    {
                                                        $__home = '';
                                                        $__append = '';
                                                    }
                                                    
                                                    while ( $row = $result->fetch( ) )
                                                    {
                                                        if ( $row['link'] == '.' )
                                                        {
                                                            $link = $GLOBALS['INDEX'] . $__home;
                                                        }
                                                        else if ( $row['type'] == 'linkout' )
                                                        {
                                                            $tmp = strtolower( $row['link'] );
                                                            
                                                            if ( substr( $tmp, 0, 7 ) == "http://"
                                                                || substr( $tmp, 0, 8 ) == "https://"
                                                                || substr( $tmp, 0, 7 ) == "mailto:"
                                                                || substr( $tmp, 0, 6 ) == "ftp://" )
                                                            {
                                                                $link = $row['link'];
                                                            }
                                                            else {
                                                                $link = $GLOBALS['INDEX'] . $__append . $row['link'];
                                                            }
                                                        }
                                                        else if ( $row['type'] == 'null' )
                                                        {
                                                            $link = $row['link'];
                                                        }
                                                        else
                                                        {
                                                            $link = $GLOBALS['INDEX'] . $__append . $row['link'] . $GLOBALS['EXT'];
                                                        }
                                                        
                                                        if($current_level == 1){
                                                            echo '<li class="container3d relative f_xs_none m_xs_bottom_5">';		
                                                            echo '<h2>';										
                                                            echo '<a class="color_light relative r_xs_corners" href="', $GLOBALS['INDEX'], $__append, $myprocess->get_category_list($row['cat_id'], '/', 'alias', $GLOBALS['LANG']), '/cp', $row['cat_id'], $GLOBALS['EXT'], '" target="', $row['target'], '">';																					
                                                            echo $row["title"];
                                                            if ( $myprocess->get_is_child($row["cat_id"])>0 ){
                                                                echo '&nbsp;&nbsp;<i class="icon-angle-down d_inline_m"></i>';
                                                            }
                                                            echo '</a>';
                                                            echo '</h2>';
                                                            if ( $current_level < $max_level || $max_level == 0 )
                                                            {
                                                                mod_product_category( $row["cat_id"], $group_menu_id, $ext, $max_level, $current_level + 1, $params );
                                                            }												
                                                            echo '</li>';
                                                        } else {
                                                            echo '<li>';								
                                                            echo '<a class="d_block color_light relative" href="', $GLOBALS['INDEX'], $__append, $myprocess->get_category_list($row['cat_id'], '/', 'alias', $GLOBALS['LANG']), '/cp', $row['cat_id'], $GLOBALS['EXT'], '" target="', $row['target'], '">';																						
                                                            echo $row["title"];
                                                            if ( $myprocess->get_is_child($row["cat_id"])>0 ){
                                                                echo '&nbsp;&nbsp;<i class="icon-angle-right"></i>';
                                                            }
                                                            echo '</a>';
                                                            if ( $current_level < $max_level || $max_level == 0 )
                                                            {
                                                                mod_product_category( $row["cat_id"], $group_menu_id, $ext, $max_level, $current_level + 1, $params );
                                                            }												
                                                            echo '</li>';
                                                        }
                                                        
                                                        $i++;
                                                    }
                                                    if($current_level > 1){
                                                        echo '</ul>';
                                                    }
                                                }
                                            }
                                        }
                
                                        mod_product_category( 0, $params['menu_type_id'], $GLOBALS['EXT'], $params['max_level'], 1, $params );
                                    ?>                                           
                                    </ul>
                                </nav>
                            </div>
                        <div class="clearfix"></div>                      
                    </div>
                </div>
            </section>
		</section>
	</div>
</div>
<?php }else{?>
<div class="main-nav">
    <div class="container">
        <nav class="main-nav-wrap header-navigation">
            <a href="javascript:void" class="main-nav-toggle">
                <!-- <i class="ico ico-burger-menu"></i> -->
                <img src="/templates/<?= mapping('template') ?>/images/icons/ic-burger-menu.png">
                <span class="long">DANH MỤC SẢN PHẨM</span>
                <span class="short">DANH MỤC</span>
            </a>
    		<ul>
            <?php
				if (!function_exists("mod_product_category"))
				{
					function mod_product_category(&$__append, $parentid = 0, $max_level, $current_level)
					{
						$myprocess = new process_product_category();                
						$result = $myprocess->category_multi_level($parentid, $GLOBALS['LANG']);
						$total = $result->rowCount();
						if ($total > 0){
							if($current_level == 2){
								echo '<div class="nav-sub">';
									echo '<ul>';
										
							}
							while($row = $result->fetch())
							{
								if($current_level == 1) {
									echo '<li>';                                               
									echo  '<a title="',$row['title'],'" href="', $GLOBALS['INDEX'], $__append, $myprocess->get_category_list($row['cat_id'], '/', 'alias', $GLOBALS['LANG']), '/cp', $row['cat_id'], $GLOBALS['EXT'], '">';
									echo	'<i class="tiki-icons ',$row['image'],'"></i>';
									echo	'<span>',$row["title"],'</span>';
									echo	'<i class="iconright icon-angle-right d_inline_m"></i>';
									echo  '</a>';
									if ($current_level < $max_level || $max_level == 0) {
										mod_product_category(&$__append, $row["cat_id"], $max_level, $current_level + 1);
									}                                               
									
								} else {
									if($current_level == 2){
										echo '<li>';
											echo '<div class="nav-sub-list-box">';
										 		echo '<a title="',$row['title'],'" href="', $GLOBALS['INDEX'], $__append, $myprocess->get_category_list($row['cat_id'], '/', 'alias', $GLOBALS['LANG']), '/cp', $row['cat_id'], $GLOBALS['EXT'], '"><h2>';                                                                                       
													echo $row["title"], '</h2></a>';
									}else{
										echo '<a title="',$row['title'],'" href="', $GLOBALS['INDEX'], $__append, $myprocess->get_category_list($row['cat_id'], '/', 'alias', $GLOBALS['LANG']), '/cp', $row['cat_id'], $GLOBALS['EXT'], '">', $row['title'], '</a>';
									}
									if ( $current_level < $max_level || $max_level == 0 )
									{
										mod_product_category(&$__append, $row["cat_id"], $max_level, $current_level + 1);
									}
								}
							} 
							
							if($current_level == 2){
										echo '</div>';		
									echo '</ul>';
								echo '</li>';	
							}
						}					
					}
				}
			?>
    		<?php mod_product_category(&$__append, $params['cat_id'], $params['max_level'], 1); ?>
            </ul>
        </nav>
	</div>
</div>
<div class="clearfix"></div>
<script>
$(document).ready(function(e) {
    $(".header-navigation>ul>li").mouseover(function(e){
		$(this).find("a").first().addClass("active");
		$(this).find(".nav-sub").attr("style","display:block");
	})
	$(".header-navigation>ul>li").mouseout(function(e){
		$(this).find("a").first().removeClass("active");
		$(this).find(".nav-sub").removeAttr("style");
	})
});
</script>
<?php }?>