<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    include_once("mod_company.models.php");
    
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
<div class="ntdHD">
	<div class="col-md-12 col-sm-12 col-xs-12 m_bottom_20 title">
		<?php echo $module_title ?>
	</div>
<?php
	$process_mod_company = new process_mod_company();
	$result = $process_mod_company->getData();
	while($row = $result->fetch()){
?>
<div class="col-md-6 col-sm-6 col-xs-6">
	<a style="margin-top:25px;display:block" class="single-bnr" target="_blank" href="<?php echo $this->_removesigns($row["tencongty"])."-".$row["congty_id"]."-client.html"; ?>">
		<img class="salesLogoImage" src="<?php echo $row["hinhanh"] ?>" height="60">
	</a>
</div>
<?php 
	}
?>
</div>