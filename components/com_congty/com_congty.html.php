<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    //include('com_congty.models.php');
    
	switch (trim($_GET["view"])) {
	
		case "":
			$core_class->_redirect("$index");
		break;

		case "category":
			include_once("com_congty.category.view.php");
		break;
		
		case "chitiet":
			include_once("com_congty.article.view.php");
		break;
		
		case "hosting":
			include_once("com_congty.article.hosting.php");		
		break;
		
		case "domain":
			include_once("com_congty.article.domain.php");		
		break;
		
		case "website":
			include_once("com_congty.article.website.php");
		break;
		
		case "service":
			include_once("com_congty.article.service.php");
		break;
		
		case "portfolio":
			include_once("com_congty.portfolio.view.php");
		break;
		
		default:
			$core_class->_redirect("$index");
		break;
	
	}