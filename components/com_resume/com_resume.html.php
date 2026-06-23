<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    include('com_resume.models.php');
	switch (trim($_GET["view"])) {
		case "":
			include_once("com_resume.view.php");
		break;	
		case "edit-resume":
			include_once("com_resume.edit.php");
		break;	
		default:
			$core_class->_redirect("$index");
		break;
	}