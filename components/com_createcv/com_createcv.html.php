<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    include('com_createcv.models.php');
	
	switch (trim($_GET["view"])) {
	
		case "":
			/*if(!empty($_REQUEST["temp"])){
				if(!empty($_REQUEST["profile"])){
					// update thông tin cv
					$_SESSION['career']['profile'] = $_REQUEST["profile"];
					$_SESSION['career']['temp'] = $_REQUEST["temp"];
					include_once("com_createcv.view.php");
				}else{
					// chọn hồ sơ
					include_once("com_createcv.myprofile.php");
				}
			}else{
				// chọn template
				include_once("com_createcv.profilecv.php");
			}*/
			
		break;
		case "createcv":
        	include_once("com_createcv.add.php");
        break;

		case "choosen-theme":
        	include_once("com_createcv.theme.php");
        break;

		case "editCV":
        	include_once("com_createcv.edit.php");
        break;

		case "manage":
		     //	include_once("com_createcv.manage.php");
	    	include_once("com_createcv.profilecv.php");
		break;
		
		default:
			$core_class->_redirect("$index");
		break;
	
	}