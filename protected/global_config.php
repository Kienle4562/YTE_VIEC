<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    $GLOBALS['MAP'] = array(
		'yteviec.blinkthor.com' => array(
                'db_schema' => 'ytvco_data',
                'db_host' => 'db',
                'db_user' => 'ytvco_user',
                'db_password' => 'kb3ABFNzY',
                'template' => 'yteviec'
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

    /* Application Data */
    define('APP_DATA_FILE', REAL_PATH . '/application_data/' . $_SERVER['SERVER_NAME'] . '.data');
    include_once(REAL_PATH . "/protected/app_variable.php");

	/* config for frontend */
	$index = "https://" . $_SERVER['SERVER_NAME'] . "/";
	$index_backend = "https://" . $_SERVER['SERVER_NAME'] . "/quantri/";

	/* config for backend */
	$moduleDir = 'modules/';

    /* frontend path component folder */
	$front_end_com_folder = "components";
	
    /* backend path component folder */
	$com_folder = 'components';
	
	$template_folder = 'templates/' . mapping('template');
	$template_admin = 'templates/adminplus/';
	
	include_once("core_class.php");
	include_once("db_class.php");
	
	$core_class = new core_class();
	
	$GLOBALS['EXT'] = ".html";
    $GLOBALS['INDEX'] = $index;
    $GLOBALS['COM'] = $front_end_com_folder;
    $GLOBALS['MULTI_LANG'] = FALSE; /* Under Construction */
    $GLOBALS['LANG_LIST'] = isset($GLOBALS['LANG_LIST']) ? $GLOBALS['LANG_LIST'] : array();
    //$GLOBALS['LANG_LIST'] = $core_class->get_flags_list();