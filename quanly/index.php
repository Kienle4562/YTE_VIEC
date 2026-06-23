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

	include_once("Menu.php");

	@$com = trim( $conf['geturl']["com"] );

	switch ( $com ) {

		case "":

			include_once($conf['components_path'] . "/congviec/congviec.html.php");

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