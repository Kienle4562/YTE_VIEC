<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    include_once("mod_menu.models.php");
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
	$myproces = new process_menu();
?>
<ul class="nav navbar-nav navbar-left">
	<?php
												if (!function_exists(menu))
												{
													function menu($parentid = 0, $group_menu_id, $ext, $max_level, $current_level, &$params)
													{
														$myprocess = new process_menu();
														$result = $myprocess->get_data_menu($parentid, $group_menu_id);
														
														$total = $result->rowCount();

														if ($total > 0)
														{
															if($current_level > 1){
																echo '<ul class="sub_menu  bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">';
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
																	echo '<a class="color_light relative " href="', $link, '" target="', $row['target'], '">';																						
																	echo $row["title"], '</a>';
																	
																	if ( $current_level < $max_level || $max_level == 0 )
																	{
																		menu( $row["Id"], $group_menu_id, $ext, $max_level, $current_level + 1, $params );
																	}												
																	echo '</li>';
																} else {
																	echo '<li>';								
																	echo '<a class="d_block color_light relative" href="', $link, '" target="', $row['target'], '">';																						
																	echo $row["title"], '</a>';
																	
																	if ( $current_level < $max_level || $max_level == 0 )
																	{
																		menu( $row["Id"], $group_menu_id, $ext, $max_level, $current_level + 1, $params );
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

												menu( 0, $params['menu_type_id'], $GLOBALS['EXT'], $params['max_level'], 1, $params );
											?>
</ul>