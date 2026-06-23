<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    include('com_congviec.models.php');
    
	switch (trim($_GET["view"])) {
	
		case "":
			$core_class->_redirect("$index");
		break;

		case "category":
			include_once("com_congviec.category.view.php");
		break;
		
		case "chitiet":
			include_once("com_congviec.article.view.php");
		break;
		
		case "danhmuc":
			include_once("com_congviec.danhmuc.view.php");		
		break;
		
		case "domain":
			include_once("com_congviec.article.domain.php");		
		break;
		
		case "website":
			include_once("com_congviec.article.website.php");
		break;
		
		case "service":
			include_once("com_congviec.article.service.php");
		break;
		
		case "portfolio":
			include_once("com_congviec.portfolio.view.php");
		break;
		
		default:
			$core_class->_redirect("$index");
		break;
	
	}