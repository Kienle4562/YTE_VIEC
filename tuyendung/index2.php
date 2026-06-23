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
    
    if(isset($_SESSION["session"]["Id"]) && isset($_SESSION["session"]["Tendangnhap"])){
	    
		@$com = trim( $conf['geturl']["com"] );
		$ajaxCom = str_replace("Model_", "", $com);
	    switch ( @$com ) {
		    case "Model_".$ajaxCom:
			   include_once( $conf['components_path'] . "/".$ajaxCom."/".$ajaxCom."/Model.php");
		    break;
			// Người quản trị
			
			case "LoadProfileUserEdit":
			    include_once( $conf['components_path'] . "/User/User/Model.php");
			    include_once( $conf['components_path'] . "/User/User/LoadProfile-Edit.php");
		    break;
			
			case "ProcessEditProfile":
			    include_once( $conf['components_path'] . "/User/User/Model.php");
			break;
			
			case "LoadUserProfile":
				include_once( $conf['components_path'] . "/User/User/Model.php");
			    include_once( $conf['components_path'] . "/User/User/LoadProfile-Edit.php");
		    break;
			
			case "UploadAvatarProfile":
			    include_once( $conf['components_path'] . "/User/User/Model.php");
		    break;
			
			case "Changepass":
			    include_once( $conf['components_path'] . "/User/User/Model.php");
		    break;
			
			case "process-payment":
			    include_once( $conf['components_path'] . "/dichvu/dichvu/Model.php");
		    break;
			case "activer-servicer":
			    include_once( $conf['components_path'] . "/dichvu/dichvu/Model.php");
		    break;
			case "process-km":
			    include_once( $conf['components_path'] . "/dichvu/dichvu/Model.php");
		    break;
			case "process-draft":
			    include_once( $conf['components_path'] . "/dangtuyen/dangtuyen/Model.php");
		    break;
			
			case "process-edit":
			    include_once( $conf['components_path'] . "/dangtuyen/dangtuyen/Model.php");
		    break;
			case "dangtamtrang":
			    include_once( $conf['components_path'] . "/User/User/Model.php");
		    break;
			
		    default:
			    echo 'Kết nối tới server không thành công !';
		    break;
	    }
		
    } else{
	    echo "Cảnh báo: không có quyền truy cập !";
    }
	
	$html_content = ob_get_contents();
		
	ob_end_clean();

	print($html_content);