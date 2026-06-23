<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    unset($_SESSION["career"]);
	unset($_SESSION["session"]);

	if(!isset($_SESSION["career"]) && !isset($_SESSION["session"])){
		$core_class->_redirect(".");exit();
	} else {
		$core_class->_redirect(".");exit();
	}
  