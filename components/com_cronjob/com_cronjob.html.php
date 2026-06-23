<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    include('com_cronjob.models.php.php');
    
	switch (trim($_GET["view"])) {
	
		case "":
			//include_once("com_cronjob.view.php");
		break;
		case "deleteOld":
			include_once("lockold.view.php");
		break;

		default:
			$core_class->_redirect("$index");
		break;
	
	}