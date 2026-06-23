<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    include_once("mod_menu_3.models.php");

    if (empty($params) || $params == "undefine") {
        $params = array(
            'menu_type_id' => 0,
            'max_level' => 0,
            'class' => '',
            'show_icon' => FALSE
        );
    }
    else {
        $params = unserialize($params);
    }
    
    if (empty($params['show_icon'])) {
		$params['show_icon'] = FALSE;
    }
    
?>
<div class="col-md-4 hidden-sm hidden-xs">
	<?php if( !empty($module_title) ) { ?>
    	<h5><?php echo $module_title; ?></h5>
    <?php } ?>
	<ul class="list-unstyled">
		<?php
        if (!function_exists(menu3))
        {
            function menu3($parentid = 0, $group_menu_id, $ext, $max_level, $current_level, &$params)
            {
                $myprocess = new process_menu_3();
                $result = $myprocess->get_data_menu($parentid, $group_menu_id);
                
                $total = $result->rowCount();

                if ($total > 0)
                {
                    if($c3urrent_level > 1){
                        echo '<ul class="fw_light d_none">';
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
                        
                        echo '<li class="m_bottom_12">';	
						echo '<a class="color_dark d_inline_b" href="', $link, '" target="', $row['target'], '">';	
						echo '<span class="icon_wrap_size_0 circle color_grey_light_5 d_block tr_inherit f_left">
								<i class="icon-angle-right"></i>
							</span>';																					
						
						echo $row["title"], '</a>';
						
						if ( $current_level < $max_level || $max_level == 0 )
						{
							menu3( $row["Id"], $group_menu_id, $ext, $max_level, $current_level + 1, $params );
						}												
						echo '</li>';
                        
                        $i++;
                    }
                    if($current_level > 1){
                        echo '</ul>';
                    }
                }
            }
        }
        menu3( 0, $params['menu_type_id'], $GLOBALS['EXT'], $params['max_level'], 1, $params );
    ?>
	</ul>
</div>