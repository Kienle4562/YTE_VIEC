<?php
	session_start();
	$randomnr = rand(100000, 999999);
	$_SESSION['randomnr2'] = substr($randomnr, 0, 6);
	$im = imagecreatetruecolor(100, 40);
	$white = imagecolorallocate($im, 255, 255, 255);
	$grey = imagecolorallocate($im, 150, 150, 150);
	$black = imagecolorallocate($im, 0, 0, 0);
	imagefilledrectangle($im, 0, 0, 200, 35, $black);
	//path to font - this is just an example you can use any font you like:
	$font = 'libraries/capcha/font/karate/Karate.ttf';
	//imagettftext($im, 12, 4, 15, 20, $grey, $font, $randomnr);
	imagettftext($im, 16, 0, 10, 28, $white, $font, $_SESSION['randomnr2']);
	//prevent caching on client side:
	header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	header ("Content-type: image/gif");
	imagegif($im);
	imagedestroy($im);
?>