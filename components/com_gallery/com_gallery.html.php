<?php

	switch (trim($_GET["view"])) {
		
		case "":
			//$core_class->_redirect($index);
		break;
		
		case "category":
			include_once("com_gallery.view.group.models.php");
			include_once("com_gallery.view.group.php");
		break;
		
		case "detail":
			include_once("com_gallery.view.detail.models.php");
			include_once("com_gallery.view.detail.php");
		break;
		
		default:
			//$core_class->_redirect($index);
		break;
		
	}
?>