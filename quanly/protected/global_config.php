<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    $GLOBALS['MAP'] = array(
		'quanly.yteviec.blinkthor.com' => array(
			'db_schema' => 'ytvco_data',
			'db_host' => 'db',
			'db_user' => 'ytvco_user',
			'db_password' => 'kb3ABFNzY',
				'location' => '../',
				'frontpage' => 'https://yteviec.blinkthor.com',
        ),
		'quanly.yteviec.com' => array(
			'db_schema' => 'ytvco_data',
			'db_host' => 'db',
			'db_user' => 'ytvco_user',
			'db_password' => 'kb3ABFNzY',
				'location' => '../',
				'frontpage' => 'https://yteviec.com',
        )
	);
    // Đọc thông tin về website
    
    function mapping($attr)
    {
        $cur = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']];
        
        if (!is_array($cur)) {
            $cur = $GLOBALS['MAP'][$cur];
        }
        
        if (is_array($cur)) {
            return $cur[$attr];
        }
        else {
            return null;
        }
    }
    
    // Tạo symlink đến thư mục chính nếu chưa có
    
    if (!is_array($GLOBALS['MAP'][$_SERVER['SERVER_NAME']]))
    {
    	define('LANG_PATH', REAL_PATH . '/languages/' . $GLOBALS['MAP'][$_SERVER['SERVER_NAME']] . '/');

    	$_real_folder = REAL_PATH . '/file_upload/' . $GLOBALS['MAP'][$_SERVER['SERVER_NAME']];
	    $_symlink = REAL_PATH . '/file_upload/' . $_SERVER['SERVER_NAME'];
	    
	    $_real_app = REAL_PATH . '/application_data/' . $GLOBALS['MAP'][$_SERVER['SERVER_NAME']] . '.data';
	    $_symlink_app = REAL_PATH . '/application_data/' . $_SERVER['SERVER_NAME'] . '.data';
	    
	    $_real_lang = REAL_PATH . '/languages/' . $GLOBALS['MAP'][$_SERVER['SERVER_NAME']];
	    $_symlink_lang = REAL_PATH . '/languages/' . $_SERVER['SERVER_NAME'];

    	if (!file_exists($_symlink)) {
			@symlink($_real_folder, $_symlink);
		}
		
		if (!file_exists($_symlink_app)) {
			@symlink($_real_app, $_symlink_app);
		}
		
		if (!file_exists($_symlink_lang)) {
			@symlink($_real_lang, $_symlink_lang);
		}
		
		unset($_real_app, $_real_folder, $_real_lang, $_symlink, $_symlink_app, $_symlink_lang);
    }
    else
    {
		define('LANG_PATH', REAL_PATH . '/languages/' . $_SERVER['SERVER_NAME'] . '/');
    }
	
	class wti_registry {
		
		public $conf = array( );
		
		public function wti_registry( ){
			
			global $conf;
			
			$conf['host']				= 'localhost';
			$conf['rooturl']			= "https://" . $_SERVER['SERVER_NAME'];
			$conf['rootpath']			= $_SERVER['DOCUMENT_ROOT'].'/';			
			
			$conf['ext']				= ".html";
			$conf['components_path']	= "components";
			$conf['modules_path']		= "modules";
			
			$chucnang_id = 9; // được phép cấu hình hệ thống
			$chucnang_list = $_SESSION["wti"]["chucnang"];
			if($this->_checkIdinArray( $chucnang_id, $chucnang_list) ){
				$conf['admin_edit_module']	= true;	
			}
			
			//onfig for frontend
			$conf['rooturl_backend'] 	= "https://" . $_SERVER['SERVER_NAME'] . "";
			// template path
			$conf['template_user'] 	 	= 'templates/' . mapping('template');
			$conf['template_admin']  	= 'templates/adminplus';
			// enable seo url
			$conf['seo_url']		 	= 1;
			
			// khai bao tham so url mặc định. Ví dụ: com=product&view=detail&id=1234
			$conf['geturl'] 		 	= $this->get_url( "com|view|id" );
		}
		
		function _checkIdinArray( $id, $array )
		{
			$arrayId = explode(",", $array);
			for($i = 0; $i < count($arrayId); $i++){
				if( $id == $arrayId[$i]) return true;
			}
		}
		
		function get_url( $keys = null, $values = null ){
			$values = explode( '/', $_GET['params']);
			$keys   = explode( '|', $keys);
			$arr_url = array(); $i = 0;	
			foreach ($keys as $key) {
				 $arr_url[$key] = $values[$i++];
			}			
			return $arr_url;
		}
			
	}

    /* Application Data */
    //define('APP_DATA_FILE', REAL_PATH . '/application_data/' . $_SERVER['SERVER_NAME'] . '.data');
    //include_once(REAL_PATH . "../protected/app_variable.php");
	
	define('UPLOAD_FOLDER', REAL_PATH . '/file_upload/' . $_SERVER['SERVER_NAME'] . '/uploads/');
    define('FOLDER_EXCEL', REAL_PATH . '/file_upload/excel/');
	define('IMG_FOLDER', '/files/uploads/');	

	/* config for frontend */
	$index = "https://" . $_SERVER['SERVER_NAME'] . "/";
	$index_backend = "https://" . $_SERVER['SERVER_NAME'] . "/";

	/* config for backend */
	$moduleDir = 'modules/';

    /* frontend path component folder */
	$front_end_com_folder = "components";
	
    /* backend path component folder */
	$com_folder = 'components';
	
	$template_folder = 'templates/' . mapping('template');
	$template_admin = 'templates/adminplus/';
	$frontpage = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['frontpage'];
	
	include_once("core_class.php");
	include_once("db_class.php");
	
	$core_class = new core_class();
	
	$GLOBALS['EXT'] = ".html";
    $GLOBALS['INDEX'] = $index;
    $GLOBALS['COM'] = $front_end_com_folder;
    $GLOBALS['MULTI_LANG'] = FALSE; /* Under Construction */
    //$GLOBALS['LANG_LIST'] = $core_class->get_flags_list();