<?php
	if (!defined('_VALID_MOS')) define( '_VALID_MOS', 1 );

    session_start();

    define('REAL_PATH', str_replace('\\', '/', dirname(dirname(__FILE__))));

	include_once("../protected/global_config.php");
	
	if(!isset($_SESSION["session"]["uid"]) && !isset($_SESSION["session"]["key"]) && !isset($_SESSION["session"]["per"])){
		include_once("$com_folder/com_login/com_login.html.php");
		exit();
	}
	
	$com = trim( $_GET["com"] );
	
	switch ( $com ) {
		case "":	
			include_once("components/com_panel/com_panel.html.php");
		break;
		
		default:
			
			$file_path = "$com_folder/$com/$com.html.php";
			
			if ( $core_class->_routers( $file_path ) || ( $GLOBALS['MULTI_LANG'] && $com == 'com_languages' ) ) {
				include_once( $file_path );
			} else{
				include_once("404.php");
			}			
		break;
	}

    if (trim($GLOBALS['msg']) != "") {
        echo "<script type=\"text/javascript\">alert('" . $GLOBALS['msg'] . "');</script>";
        $GLOBALS['msg'] = "";
    }
    
    /*
    echo "<pre>";
    var_dump($_APP);
    echo "</pre>";*/