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
	<?php $myproces->menu( 0, $params['menu_type_id'], $GLOBALS['EXT'], $params['max_level'], 1, $params ); ?>

</ul>