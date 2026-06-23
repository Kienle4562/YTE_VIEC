<?php if (!defined("_VALID_MOS")) define( "_VALID_MOS", 1 );	
    session_start();
	define('REAL_PATH', str_replace('\\', '/', dirname(__FILE__)));
	include_once("protected/global_config.php");
	include_once("protected/db_class.php");
	include_once("protected/core_class.php");
    include_once("modules/modules.models.php");
	$core_class = new core_class();
	$url = $core_class->_extract_url($_GET["params"], "/");
    ob_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="index, follow" />
	<title> Bảng điều khiển </title>
	<link href="<?php echo $index_backend; ?>css/icon.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $index_backend; ?>css/template.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $index_backend; ?>css/rounded.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $index_backend; ?>css/type.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $index_backend; ?>css/modal.css" rel="stylesheet" type="text/css" />
	<!--[if IE 7]>
	<link href="<?php echo $index_backend; ?>css/ie7.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<!--[if lte IE 6]>
	<link href="<?php echo $index_backend; ?>css/ie6.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	<script language="javascript" type="text/javascript" src="<?php echo $index_backend; ?>javascript/javascript.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $index_backend; ?>javascript/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $index_backend; ?>javascript/mootools.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $index_backend; ?>javascript/menu.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $index_backend; ?>javascript/index.js"></script>
	<script language="javascript" type="text/javascript" src="calendar/popcalendar.js"></script>
	<script type="text/javascript"> 
		window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: true}); });
	</script>
</head>
<body>
<?php 
	if(!isset($_SESSION["session"]["uid"]) && !isset($_SESSION["session"]["key"]) && !isset($_SESSION["session"]["per"])){
		echo '<h3>Bạn không được quyền truy xuất chức năng này, vui lòng đăng nhập để có thể tiếp tục <br> <a href="'.$index_backend.'" target="_blank">Click vào đây</a> để vào trang đăng nhập</h3>';
		exit();
	}	

	$module = trim( $url[0] );
	//echo $module.'aaa';
	switch ( $module ) {
		case "":
			echo '<h3>Liên kết bị gãy, vui lòng nhập liên kết khác</h3>';
		break;
		
		default:
			$file_path = "modules/$module/$module.backend.php";
			
			if($core_class->_routers( $file_path )){
				include_once( $file_path );
			} else{
				
				include_once("404.php");
			}
		break;
	} 
?>
</body>
</html>

<?php 
	$html_content = ob_get_contents();
	ob_end_clean();
	print($html_content);