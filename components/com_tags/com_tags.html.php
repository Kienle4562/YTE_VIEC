<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    include('com_tags.models.php');
    
	switch (trim($_GET["view"])) {
	
		case "":
			$core_class->_redirect("$index");
		break;

		case "category":
		
			switch (trim($_GET["task"])) {
				case "":
				case "view":
				default:
					include_once("com_tags.category.view.php");
				break;
			}
			
		break;				
		
		default:
			$core_class->_redirect("$index");
		break;
	
	}