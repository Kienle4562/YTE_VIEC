<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    include('com_product.models.php');

    switch (trim($_GET["view"])) {

        case "category":
        	include_once("com_product.category.view.php");
        break;
        
        case "product":
			include_once("com_product.product.view.php");
        break;
		
		case "hotproduct":
        	include_once("com_product.category.hot.php");
        break;
        
		default:
            $core_class->_redirect($index);
        break;
    }