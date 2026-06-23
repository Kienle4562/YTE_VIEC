<?php if (!defined('_VALID_MOS')) define( '_VALID_MOS', 1 );
	/**
	 * Ch? d?nh du?ng d?n d?n file ch?a n?i dung bi?n $_APP
	 */
	define('APP_DATA_FILE', 'protected/application.data');

	/**
	 * N?p thu vi?n kh?i t?o bi?n $_APP, thu vi?n s? t? d?ng g?i hàm
	 * application_start() d? n?p n?i dung bi?n $_APP
	 */
	include_once('protected/app_variable.php');
	include_once("protected/core_class.php");
	include_once("protected/global_config.php");
	include_once("protected/db_class.php");
	$bgimg = '/file_upload/image/hinhnen/bg_main.png';
	$core_class = new core_class();
	ob_start();
	ini_set('zlib_output_compression','On');
	session_start();
	$cookies_value_array = explode("|", $_COOKIE["city"]);
	$city_id    = $cookies_value_array[0];
	$city_alias = $cookies_value_array[1];
	include_once("templates/sweetdeal/index.php");
	$html_content = ob_get_contents();
	ob_end_clean();
	print(
	str_replace(
	array("<mt24h>{bgimg}</mt24h>","<mt24h>{meta_title}</mt24h>","<mt24h>{meta_keyword}</mt24h>","<mt24h>{meta_description}</mt24h>") , 
	array($bgimg, $meta_title, trim($_APP['config']['meta-keyword']), preg_replace('/s+/', ' ', str_replace("&nbsp;","",strip_tags(trim($_APP['config']['meta-description']))))), $html_content));
	application_end();
?>
