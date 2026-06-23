<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    include('com_ungvien.models.php');
    
	switch (trim($_GET["view"])) {
	
		case "":
			include_once("com_ungvien.view.php");
		break;
		
		default:
			$core_class->_redirect("$index");
		break;
	
	}