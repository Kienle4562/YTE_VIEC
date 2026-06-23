<?php
echo $_GET['view'];
if( trim($_GET["view"]) == "dang-xuat" ){
	unset($_SESSION["session"]);
	if(!isset($_SESSION["session"])){
		$core_class->_redirect(".");exit();
	} else {
		$core_class->_redirect(".");exit();
	}
}
?>