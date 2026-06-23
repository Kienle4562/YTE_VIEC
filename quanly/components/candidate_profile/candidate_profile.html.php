<?php defined( '_VALID_MOS' ) or die( include_once("404.php") );
	if(isset($_SESSION["session"]) || !empty($_SESSION["session"])){		
		include("candidate_profile/Model.php");
		include("candidate_profile/Main.php");
	}
?>