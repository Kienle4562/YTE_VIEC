<?php defined( '_VALID_MOS' ) or die( include_once("404.php") );

	if( isset($_SESSION["session"]) || !empty($_SESSION["session"]) ){		

		$conf['geturl'] = $wti->get_url( "com|view|id" );	

		switch ( trim( $conf['geturl']["view"]) ) {

			case "":
				include_once("User/Profile.php");
				include_once("User/Model.php");
			break;

			case "Profile":
				include_once("User/Model.php");
				include_once("User/Profile.php");
			break;

			case "Profile-Activity":
				include_once("User/Profile-activity.php");
			break;
			
			case "Profile-Edit":
				include_once("User/Model.php");
				include_once("User/Profile-Edit.php");
			break;
			
			default:
				include_once("User/Profile.php");
				include_once("User/Model.php");
			break;
		}
		include_once("User/Library.php"); 
	}
?>