<?php
if($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator"){
    include_once("process/com_content.category.models.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow" />
	<title> Bảng điều khiển </title>
	
	<link href="css/icon.css" rel="stylesheet" type="text/css" />
	<link href="css/template.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/rounded.css" />
     <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap-tagsinput.css" />
	<link href="../calendar/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" media="screen" />
	
	<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	
	<!--[if lte IE 6]>
	<link href="css/ie6.css" rel="stylesheet" type="text/css" />
	<![endif]-->
    <script src="bootstrap/jquery.min.js" type="text/javascript"></script>
   <script type="text/javascript" src="bootstrap/bootstrap.min.js"></script>
   <script type="text/javascript" src="bootstrap/bootstrap-tagsinput.js"></script>
	<script src="javascript/jquery.js" type="text/javascript"></script> 
	<script language="javascript" src="javascript/javascript.js"></script>
	
	<script type="text/javascript" src="javascript/mootools.js"></script>
	<script type="text/javascript" src="javascript/menu.js"></script>
	<script type="text/javascript" src="javascript/index.js"></script>
	<script language="javascript" type="text/javascript" src="calendar/popcalendar.js"></script>
	
	
</head>
<body id="minwidth-body">
<?php include("$com_folder/com_header/com_header.html.php");?>
<?php
	switch (trim($_GET["view"])) {	
	
		case "":
			include_once("404.php");
		break;

		case "category":
			
			$roles = $_SESSION["session"]["key"];
		
			switch ( $roles ) {
			
				case "Supper Administrator":
				case "Administrator":
					
					switch (trim($_GET["task"])) {
			
						case "":
							include_once("process/com_content.category.view.models.php");
							include_once("category/com_content.category.view.admin.php");
						break;
		
						case "view":
							include_once("process/com_content.category.view.models.php");
							include_once("category/com_content.category.view.admin.php");
						break;
						
						case "add":
							include_once("process/com_content.category.add.models.php");
							include_once("category/com_content.category.add.admin.php");
						break;
						
						case "edit":
							include_once("process/com_content.category.edit.models.php");
							include_once("category/com_content.category.edit.admin.php");
						break;
						
						default:
							include_once("process/com_content.category.view.models.php");
							include_once("category/com_content.category.view.admin.php");
						break;
						
					}
				
				break;
			}
				
			break;
			
		break;
		
		case "news":
		
		$roles = $_SESSION["session"]["key"];
			
			switch ( $roles ) {
				
				case "Supper Administrator":
				case "Administrator":
					
					switch (trim($_GET["task"])) {
					
						case "":
							include_once("process/com_content.article.view.models.php");
							include_once("news/com_content.news.view.admin.php");
						break;
					
						case "view":
							include_once("process/com_content.article.view.models.php");
							include_once("news/com_content.news.view.admin.php");
						break;
						
						case "add":
							include_once("process/com_content.article.add.models.php");
							include_once("news/com_content.news.add.admin.php");
						break;
						
						case "edit":
							include_once("process/com_content.article.edit.models.php");
							include_once("news/com_content.news.edit.admin.php");
						break;
						
						case "copy":
							include_once("process/com_content.article.copy.models.php");
							include_once("news/com_content.news.copy.admin.php");
						break;
						
						default:
							include_once("process/com_content.article.view.models.php");
							include_once("news/com_content.news.view.admin.php");
						break;
						
					}
					
				break;			
				
			}
				
		break;
		
		default:
			include_once("404.php");
		break;
	
	}
?>
<?php include("$com_folder/com_footer/com_footer.html.php");?>
</body>
</html>
<?php
} else {
	include("404.php");
	exit();
}
?>
<?php if( trim($GLOBALS['msg']) != "" ){ 
		echo "<script type=\"text/javascript\">alert('".$GLOBALS['msg']."');</script>"; 
} ?>