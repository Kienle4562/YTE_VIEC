<?php defined( '_VALID_MOS' ) or die( include("404.php") ); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow" />
	<title> Bảng điều khiển </title>
	
	<link href="css/icon.css" rel="stylesheet" type="text/css" />
	<link href="css/template.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/rounded.css" />
	<link rel="stylesheet" type="text/css" href="css/type.css" />
	<link rel="stylesheet" href="css/modal.css" type="text/css" />
	<link href="../calendar/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" media="screen" />
	
	<!--[if IE 7]>
	<link href="css/ie7.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	
	<!--[if lte IE 6]>
	<link href="css/ie6.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	
	<script language="javascript" src="javascript/javascript.js"></script>
	<script language="javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/mootools.js"></script>
	<script type="text/javascript" src="javascript/menu.js"></script>
	<script type="text/javascript" src="javascript/index.js"></script>
	<script language="javascript" type="text/javascript" src="calendar/popcalendar.js"></script>

	<script type="text/javascript" src="javascript/modal.js"></script>
	<script type="text/javascript">
		window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });
		window.addEvent('domready', function(){ new Accordion($$('.panel h3.jpane-toggler'), $$('.panel div.jpane-slider'), {onActive: function(toggler, i) { toggler.addClass('jpane-toggler-down'); toggler.removeClass('jpane-toggler'); },onBackground: function(toggler, i) { toggler.addClass('jpane-toggler'); toggler.removeClass('jpane-toggler-down'); },duration: 300,opacity: false,alwaysHide: true}); });		
		window.addEvent('domready', function() {

			SqueezeBox.initialize({});

			$$('a.modal').each(function(el) {
				el.addEvent('click', function(e) {
					new Event(e).stop();
					SqueezeBox.fromElement(el);
				});
			});
		});
  </script>
  
	<?php if( trim($GLOBALS['msg']) != "" ){ 
		echo "<script type=\"text/javascript\">alert('".$GLOBALS['msg']."');</script>"; 
	} ?>
	
</head>
<body id="minwidth-body">

<?php
	if (!(isset($_GET['view']) && $_GET['view'] == 'item_menu' && isset($_GET['task']) && ($_GET['task'] == 'news.choose' || $_GET['task'] == 'product.choose'))) {
        include_once("$com_folder/com_header/com_header.html.php");
    }
	
    
    switch (trim($_GET["view"])) {
	
		case "":
			include_once("process/com_menu_main_menu.view.process.php");
			include_once("main_menu/com_menu.main_menu.view.php");
		break;
		
		case "main_menu":
		
			switch (trim($_GET["task"])) {
				case "":
					include_once("process/com_menu_main_menu.view.process.php");
					include_once("main_menu/com_menu.main_menu.view.php");
				break;

				case "view":
					include_once("process/com_menu_main_menu.view.process.php");
					include_once("main_menu/com_menu.main_menu.view.php");
				break;
				
				case "add":
					include_once("process/com_menu_main_menu.add.process.php");
					include_once("main_menu/com_menu.main_menu.add.php");
				break;
				
				case "edit":
					include_once("process/com_menu_main_menu.edit.process.php");
					include_once("main_menu/com_menu.main_menu.edit.php");
				break;
				
				default:
					include_once("process/com_menu_main_menu.view.process.php");
					include_once("main_menu/com_menu.main_menu.view.php");
				break;
			}
			
		break;
		
		case "item_menu":
		
			switch (trim($_GET["task"])) {
				case "":
					include_once("process/com_menu.item_menu.news.view.process.php");
					include_once("item_menu/com_menu.item_menu.news.view.php");
				break;

				case "view":
					include_once("process/com_menu.item_menu.news.view.process.php");
					include_once("item_menu/com_menu.item_menu.news.view.php");
				break;								
				
				case "news.add":
					include_once("process/com_menu_item_menu.news.add.process.php");
					include_once("item_menu/com_menu.item_menu.news.add.php");
				break;
				
				case "news.choose":
                    include_once("process/com_menu_item_menu.news.choose.process.php");
                    include_once("item_menu/com_menu.item_menu.news.choose.php");
                break;
                
                case "product.choose":
					include_once("process/com_menu_item_menu.product.choose.process.php");
					include_once("item_menu/com_menu.item_menu.product.choose.php");
				break;
				
				case "news.edit":
					include_once("process/com_menu_item_menu.news.edit.process.php");
					include_once("item_menu/com_menu.item_menu.news.edit.php");
				break;
				
				default:
					include_once("process/com_menu.item_menu.news.view.process.php");
					include_once("item_menu/com_menu.item_menu.news.view.php");
				break;
			}
			
		break;		
		
		default:
			
			include_once("main_menu/com_menu.item_menu.news.view.php");
		break;
	
	}
    
    if (!(isset($_GET['view']) && $_GET['view'] == 'item_menu' && isset($_GET['task']) && $_GET['task'] == 'news.choose')) {
        include("$com_folder/com_footer/com_footer.html.php");
    }
?>
</body>
</html>
