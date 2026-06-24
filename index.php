<?php if (!defined('_VALID_MOS')) define( '_VALID_MOS', 1 );
	session_start();
	ob_start();
	ini_set('zlib_output_compression','On');
	ini_set('zlib_output_compression_level','5');
	header('Content-Type: text/html; charset=utf-8');
	define('REAL_PATH', str_replace('\\', '/', dirname(__FILE__)));
	include_once("protected/global_config.php");
	include_once("protected/core_class.php");
	include_once("protected/db_class.php");
	include_once("modules/modules.models.php");
	$core_class = new core_class();
	// Router
	$url = $core_class->_extract_url($_GET['params'], '/');
	$GLOBALS['url'] = $url;
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	if (count($GLOBALS['LANG_LIST']) > 1) {
		$lang_keys = array_keys($GLOBALS['LANG_LIST']);
		if (in_array($url[0], $lang_keys)) {
			$GLOBALS['LANG'] = $url[0];
			array_shift($url);
		}
		else {
			$GLOBALS['LANG'] = 'vi';
		}
	}
	else {
		$GLOBALS['LANG'] = 'vi';
	}
	$_GET['params'] = implode('/', $url);
	switch ($_GET['params'])
	{
		case 'lien-he':
			$_GET['com'] = 'com_contact';
		break;
		
		case 'quick_upload_resume':
			$_GET['com'] = 'com_resume';
		break;
		
		case 'dang-ky':
			$_GET['com'] = 'com_register';
			$_GET['view'] = 'register';
		break;
		case 'dang-nhap':
			$_GET['com'] = 'com_login';
			$_GET['view'] = 'login';
		break;
		case 'dang-xuat':
			$_GET['com'] = 'com_logout';
			$_GET['view'] = 'dang-xuat';
		break;
		case 'profile':
			$_GET['com'] = 'com_account_manager';
			$_GET['view'] = 'editaccount';
		break;
		case 'myjob':
			$_GET['com'] = 'com_account_manager';
			$_GET['view'] = 'myjob';
		break;
		case 'edit-resume':
			$_GET['com'] = 'com_resume';
			$_GET['view'] = 'edit-resume';
		break;
		case 'doi-mat-khau':
			$_GET['com'] = 'com_account_manager';
			$_GET['view'] = 'editpass';
		break;
		case 'tim-kiem':
			$_GET['com'] = 'com_congviec';
			$_GET['view'] = 'category';
		break;
		case 'tat-ca-viec-lam':
			$_GET['com'] = 'com_congviec';
			$_GET['view'] = 'category';
		break;
		case 'employeer':
			$_GET['com'] = 'com_employeer';
		break;
		case 'tim-ung-vien':
			$_GET['com'] = 'com_ungvien';
		break;
		case 'forgot':
			$_GET['com'] = 'com_forgot';
		break;
		case 'tao-cv':
			$_GET['com'] = 'com_createcv';
			$_GET['view'] = 'createcv';
		break;
		case 'edit-cv':
			$_GET['com'] = 'com_createcv';
			$_GET['view'] = 'editCV';
		break;
		case 'chon-theme':
			$_GET['com'] = 'com_createcv';
			$_GET['view'] = 'choosen-theme';
		break;
		case 'view-cv':
			$_GET['com'] = 'com_createcv';
			$_GET['view'] = 'manage';
		break; 
		
		case 'benh-vien':
		case 'benh-vien-cong':
		case 'benh-vien-tu':
		case 'phong-kham':
		case 'cong-ty':
		case 'phong-kham-nha-khoa':
		case 'phong-kham-da-khoa':
		case 'phong-kham-chuyen-khoa':
		case 'cong-ty-duoc':
		case 'cong-ty-thiet-bi-y-te':
		case 'cong-ty-y-te':
		case 'nha-thuoc':
		case 'spa-tham-my-vien':
		case 'tra-cuu-co-so-y-te':
		case 'tra-cuu-tat-ca-cty':
			$_GET['com'] = 'com_company';
		break;

		case 'tai-lieu-y-khoa':
			$_GET['com'] = 'com_tailieuykhoa';
		break;

		default:				
			$key = $url[count($url) - 1];						
			$arr = explode("-", $key);
			if($arr[count($arr)-1]== "cv"){
				$_GET['com'] = "com_congviec";
				$_GET['view'] = "chitiet";
				$_GET['id'] = $arr[count($arr)-2];
			}
			else if($arr[count($arr)-1]== "client") {				
				$_GET['com'] = "com_congty";
				$_GET['view'] = "chitiet";
				$_GET['id'] = $arr[count($arr)-2];
			}
			else if($arr[count($arr)-1]== "dmcv") {				
				$_GET['com'] = "com_congviec";
				$_GET['view'] = "danhmuc";
				$_GET['id'] = $arr[count($arr)-2];
			}
			else if(strpos($key, "career") > -1) {				
				$_GET['com'] = "com_career";
				$_GET['view'] = "career";
				$_GET['id'] = substr($arr[count($arr)-1], strlen("career"));
			}
			// tag search
			else if ($_GET['com'] == "tag") {				
				$_GET['com'] = "com_tags";
				$_GET['view'] = 'category';
				unset($url[count($url) - 1]);
			}
			// News
			else if (substr($key, 0, 1) == 'n') {
				$_GET['com'] = 'com_content';
				$_GET['view'] = 'article';
				$_GET['id'] = intval(substr($key, 1));
			}
			// News Category
			else if (substr($key, 0, 2) == 'cn') {				
				$_GET['com'] = 'com_content';
				$_GET['view'] = 'category';
				$_GET['id'] = intval(substr($key, 2));
			}
			// Product Category
			else if (substr($key, 0, 2) == 'cp') {
				$_GET['com'] = 'com_product';
				$_GET['view'] = 'category';
				$_GET['id'] = intval(substr($key, 2));
			}
			// Product
			else if (substr($key, 0, 1) == 'p') {
				$_GET['com'] = 'com_product';
				$_GET['view'] = 'product';
				$_GET['id'] = intval(substr($key, 1));
			}
			// Product Category
			else if (substr($key, 0, 3) == 'moi') {
				$_GET['com'] = 'com_product';
				$_GET['view'] = 'hotproduct';
				$_GET['id'] = intval(substr($key, 3));
			}
			// Gallery
			else if (substr($key, 0, 1) == 'g') {
				$_GET['com'] = 'com_gallery';
				$_GET['view'] = 'detail';
				$_GET['id'] = intval(substr($key, 1));
			}
			//tim kiem
			elseif (substr($key, 0, 6) == 'search') {
				$_GET['com'] = 'com_search';
				if (strlen($key) > 6) {
					$_GET['id'] = intval(substr($key, 6));
				}
				unset($url[count($url) - 1]);
			}
			// Gallery Category
			else if (substr($key, 0, 2) == 'cg') {
				$_GET['com'] = 'com_gallery';
				$_GET['view'] = 'category';
				$_GET['id'] = intval(substr($key, 2));
			}
		break;
	}
	// End Router
	if (!empty($_APP['config']['system-state']))
	{
		$GLOBALS['CURRENT_MENU'] = $core_class->current_menu();
		$GLOBALS['APP'] = $_APP;
		$meta_title = $_APP['config']['title'][$GLOBALS['LANG']];
		$meta_keyword = $_APP['config']['meta-keyword'][$GLOBALS['LANG']];
		$meta_description = $_APP['config']['meta-description'][$GLOBALS['LANG']];
		$meta_img = $index . 'images/logo.png';
		$meta_url = $index;
		if (!empty($_SESSION['allow_edit_module']) && $_SESSION['allow_edit_module']) {
			$GLOBALS['ADMIN_EDIT_MODULE'] = 1;
		}
		if (isset($_SESSION["session"]["uid"]) && ($_SESSION["session"]["uid"] == "admin")) {
			$GLOBALS['ADMIN'] = 1;
			include_once("index.model.php");				
			include_once($template_folder . "/index.php");
			//include_once("modules/mod_jixedbar/mod_jixedbar.php");
		} else {
			$GLOBALS['ADMIN'] = 0;
			include_once($template_folder . "/index.php");
		}
		$html_content = ob_get_contents();
		ob_end_clean();
		print(str_replace(
				array("<!--wti>{meta_title}</wti-->",
				"<!--wti>{meta_keyword}</wti-->",
				"<!--wti>{meta_description}</wti-->",
				"<!--wti>{meta_image}</wti-->",
				"<!--wti>{meta_url}</wti-->",
				"<wti>{image_bg}</wti>",
				"<wti>{title}</wti>",
				"<wti>{pathway}</wti>"),
				array($meta_title, 
				$meta_keyword, 
				$meta_description,
				$meta_image,
				$meta_url,
				$image_bg,
				$meta_title,
				$pathway_text),					
				$html_content)
			);
	} else {
		echo <<<MSG
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>{$_APP['config']['title']}</title>
			</head>
			<body>
				{$_APP['config']['system-maintenance-message']}
			</body>
			</html>
MSG;
	}