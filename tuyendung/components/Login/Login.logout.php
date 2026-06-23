<?php
if( trim( $conf['geturl']["view"] ) == "Logout" ){
	unset($_SESSION["session"]);
	if(!isset($_SESSION["session"])){
		$core_class->_redirect( $conf['rooturl'] );exit();
	} else {
		$core_class->_redirect( $conf['rooturl'] );exit();
	}
}
?>