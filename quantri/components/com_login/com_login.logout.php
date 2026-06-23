<?php
if( trim($_GET["view"]) == "logout" ){
	unset($_SESSION["session"]);
	if(!isset($_SESSION["session"])){
		$core_class->_redirect(".");exit();
	} else {
		$core_class->_redirect(".");exit();
	}
}
?>