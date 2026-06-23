<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    include_once("mod_news.models.php");
    
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

    if (empty($params) || $params == "undefine") {
        $params = array();
    }
    else {
        $params = unserialize($params);
    }
?>
<section class="home__hr-insider">
	<h1 class="text-center"><?php echo $module_title ?></h1>
	<div class="container">
		<div class="row article-contain">
		</div>
	</div>
</section>