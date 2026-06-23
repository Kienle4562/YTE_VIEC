<?php defined( '_VALID_MOS' ) or die( include_once("404.php") );
	if(isset($_SESSION["session"]) || !empty($_SESSION["session"])){		
		include("dichvu/Model.php");
		include("dichvu/Main.php");
	}
?>