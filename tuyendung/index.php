<?php
	
	if (!defined('_VALID_MOS')) define( '_VALID_MOS', 1 );

    session_start();
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	ini_set('zlib_output_compression','On');
	ini_set('zlib_output_compression_level','5');
	header('Content-Type: text/html; charset=utf-8');

	define('REAL_PATH', str_replace('\\', '/', dirname(__FILE__)));

	include_once("protected/global_config.php");
	$wti = new wti_registry();
	
	if(!isset($_SESSION["session"]["Id"]) && !isset($_SESSION["session"]["Tendangnhap"])){
		include_once( $conf['components_path'] . "/Login/Login.html.php");
		exit();
	}
	include_once("Header.php");
	@$com = trim( $conf['geturl']["com"] );
	switch ( $com ) {
		case "":
			include_once($conf['components_path'] . "/dangtuyen/dangtuyen.html.php");
		break;
		
		case "themmoidangtuyen":
			$view = "Add";
			include_once($conf['components_path'] . "/dangtuyen/dangtuyen/Form.php");
		break;
		
		case "chinhsuadangtuyen":
			$view = "Edit";
			include_once($conf['components_path'] . "/dangtuyen/dangtuyen/Edit.php");
		break;
		case "copytin":
			$view = "Copy";
			include_once($conf['components_path'] . "/dangtuyen/dangtuyen/Copy.php");
		break;
		case "quanlydichvu":
			$view = "Manager";
			include_once($conf['components_path'] . "/dichvu/dichvu/Manager.php");
		break;
		
		case "thanh-toan-dich-vu":
			$view = "Register";
			include_once($conf['components_path'] . "/dichvu/dichvu/Register.php");
		break;
		case "thanh-cong":
			$view = "Success";
			include_once($conf['components_path'] . "/dichvu/dichvu/Success.php");
		break;
		// Hồ sơ người dùng
		case "profile":
			include_once( $conf['components_path'] . "/User/User/Model.php");
			include_once( $conf['components_path'] . "/User/User/LoadProfile-Edit.php");
		break;
		
		default:
			$file_path = $conf['components_path'] . "/$com/$com.html.php";
			if ( $core_class->_routers( $file_path ) ) {
				include_once( $file_path );
			} else{
				include_once("error.html");
			}
		break;
		
	}
	echo "</div>";
	include_once("Bottom.php");
?>