<?php defined( '_VALID_MOS' ) or die( include_once("404.php") );
	if(isset($_SESSION["session"]) || !empty($_SESSION["session"])){		
		include("dangtuyen/Model.php");
		include("dangtuyen/Main.php");
	}
?>