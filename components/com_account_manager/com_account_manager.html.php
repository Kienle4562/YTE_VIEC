<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
include('com_account_manager.models.php');
if(!empty($_SESSION["career"]["career_id"]) && $_SESSION["career"]["career_id"] !=NULL)
{
    switch (trim($_GET["view"])) {
        case "editaccount":
        	include_once("com_account_manager.editacc.php");
        break;
        case "editpass":
			include_once("com_account_manager.editpass.php");
        break;
		case "myjob":
			include_once("com_account_manager.myjob.php");
        break;
        default:
            $core_class->_redirect($index);
        break;
    }
}else 
{
	  $core_class->_redirect($index);
}