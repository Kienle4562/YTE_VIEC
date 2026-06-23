<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    include_once('mod_banner.models.php');
    $params = unserialize($params);
    $myprocess = new process_mod_banner();
?>
<h1 class="text-center">&nbsp;</h1>
<div style="margin-bottom: 15px" class="col-lg-12 col-xs-12">
	<a target="_blank" href="<?php echo $params["urlbanner1"] ?>">
		<img style="width: 100%" src="<?php echo $params['banner1']; ?>" alt="" title="" border="0">
	</a>
</div>