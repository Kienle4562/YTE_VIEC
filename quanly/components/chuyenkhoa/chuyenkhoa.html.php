<?php defined( '_VALID_MOS' ) or die( include_once("404.php") );
	if(isset($_SESSION["session"]) || !empty($_SESSION["session"])){		
		include("chuyenkhoa/Model.php");
		include("chuyenkhoa/Main.php");
	}
?>