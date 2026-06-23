<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    include('com_content.models.php');
    
	switch (trim($_GET["view"])) {
	
		case "":
			$core_class->_redirect("$index");
		break;

		case "category":
			include_once("com_content.category.view.php");
		break;
		
		case "article":
			include_once("com_content.article.view.php");
		break;
		
		case "hosting":
			include_once("com_content.article.hosting.php");
			//include_once("com_content.hostingfaq.view.php");			
		break;
		
		case "domain":
			include_once("com_content.article.domain.php");
			//include_once("com_content.banggiahosting.view.php");
			//include_once("com_content.tenmienvn.php");
			//include_once("com_content.banggiadomain.view.php");			
		break;
		
		case "website":
			include_once("com_content.article.website.php");
			//include_once("com_content.portfolio.view.php");			
			//include_once("com_content.websitefaq.view.php");
			//include_once("com_content.banggiatkw.view.php");
		break;
		
		case "service":
			include_once("com_content.article.service.php");
			//include_once("com_content.service_techsupport.view.php");
		break;
		
		case "portfolio":
			include_once("com_content.portfolio.view.php");
		break;
		
		default:
			$core_class->_redirect("$index");
		break;
	
	}