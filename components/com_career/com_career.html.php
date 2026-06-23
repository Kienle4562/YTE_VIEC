<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include('com_career.models.php');
	switch (trim($_GET["view"])) {
        case "career":
        	include_once("com_career.view.php");
        break;
        default:
            $core_class->_redirect($index);
        break;
    }