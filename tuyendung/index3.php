<?php if (!defined('_VALID_MOS')) define( '_VALID_MOS', 1 );

    session_start();	
	ob_start();	
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	ini_set('zlib_output_compression','On');
	ini_set('zlib_output_compression_level','5');
	header('Content-Type: text/html; charset=utf-8');

    define('REAL_PATH', str_replace('\\', '/', dirname(__FILE__)));
    
    include_once("protected/global_config.php");
	$wti = new wti_registry();
  
	@$com = trim( $conf['geturl']["com"] );
	
	switch ( @$com ) {
		case "":
			echo 'Kết nối tới server không thành công !';
		break;
		
		case "captcha":
			include_once("libraries/capcha/capcha.php");
		break;
		
		case "loadquanhuyen":
			include_once($conf['components_path'] . "/Member/Model.php");
		break;
		
		case "sign-up":
			include_once($conf['components_path'] . "/Login/Login.process.php");
		break;
		
		case "login":
			include_once($conf['components_path'] . "/Login/Login.process.php");
		break;
		
		case "Model_Member":
			include_once( $conf['components_path'] . "/Member/Model.php");
		break;
		
		case "forget":
			include_once($conf['components_path'] . "/Login/Login.process.php");
		break;
		
		case "newpassword":
			include_once($conf['components_path'] . "/Login/Login.process.php");
		break;
		
		default:
			echo 'Kết nối tới server không thành công !';
		break;
	}
	
	$html_content = ob_get_contents();
		
	ob_end_clean();

	print($html_content);