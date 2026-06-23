<?php if (!defined('_VALID_MOS')) define( '_VALID_MOS', 1 );
    session_start();
    ob_start();
    define('REAL_PATH', str_replace('\\', '/', dirname(__FILE__)));
    include_once("protected/global_config.php");
    include_once("protected/core_class.php");
    include_once("protected/db_class.php");
	date_default_timezone_set('Asia/Ho_Chi_Minh');
    switch (trim($_GET["com"]))
    {
	    case "captcha":
        {
		    include_once("libraries/capcha/capcha.php");
		    break;
        }
		case "register":
        {
		    include_once("components/com_register/com_register.models.php");
		    break;
        }
		case "uploadhoso":
        {
			include_once("components/com_congviec/com_congviec.models.php");
		    include_once("components/com_congviec/com_congviec.article.models.php");
		    break;
		}
		case "forgot":
        {
			include_once("components/com_forgot/com_forgot.models.php");
		    break;
		}
		case "ungtuyen":
			{
				include_once("components/com_congviec/com_congviec.models.php");
				include_once("components/com_congviec/com_congviec.article.models.php");
				break;
			}
		case "editprofile":
		case "loadchuyenkhoa":
			{
				include_once("components/com_account_manager/com_account_manager.models.php");
				break;
			}
		
		case "login":
			{
				include_once("components/com_login/com_login.models.php");
				break;
			}
		case "login-ntd":
			{
				include_once("components/com_login/com_login.models.php");
				break;
			}
		case "fillter-cv":
				{
					
					include_once("components/com_ungvien/com_ungvien.models.php");
					break;
				}
		
		case "loadnews":
			{
				include_once("components/com_content/com_content.models.php");
				include_once("components/com_content/com_content.category.loadnews.php");
				break;
			}
		
		case "customer-contact":
			{
				include_once("components/com_contact/com_contact.models.php");
				break;
			}

		case "customer-createcv":
			{
				include_once("components/com_createcv/com_createcv.models.php");
				break;
			}
		case "apply-theme":
			{
				include_once("components/com_createcv/com_createcv.models.php");
				break;
			}
		case "deleteOld":
			{
				include_once("components/com_cronjob/com_cronjob.models.php");
				include_once("components/com_cronjob/lockold.view.php");
				break;
			}	
		case "editcv":
			{
				include_once("components/com_createcv/com_createcv.models.php");
				break;
			}
		case "viewInfoBuy":
				{
					include_once("components/com_career/com_career.models.php");
					break;
				}
		case "theme-cv":
			{
				include_once("components/com_createcv/com_createcv.models.php");
				break;
			}
		case "follow":
			{
				include_once("components/com_congty/com_congty.article.models.php");
				break;
			}
		
		case "load_more":
			{
				include_once("components/com_congty/com_congty.article.models.php");
				break;
			}
		
		case "raitingUrl":
			{
				include_once("components/com_congty/com_congty.article.models.php");
				break;
			}
		
		case "filtercompany":
			{
				include_once("components/com_company/com_company.models.php");
				break;
			}
		
		case "vote":
			{
				include_once("components/com_congty/com_congty.article.models.php");
				break;
			}
		case "upload_resume":
		case "uploadImageResume":
		case "createresume":
			{
				include_once("components/com_resume/com_resume.models.php");
				break;
			}
		case "editresume":
			{
				include_once("components/com_resume/com_resume.editmodels.php");
				break;
			}
		case "customer-createprofile":
			{
				include_once("components/com_createcv/com_createcv.models.php");
				break;
			}
	   case "delete-cv":
			{
				include_once("components/com_createcv/com_createcv.models.php");
				break;
			}	
		case "resume-createprofile":
			{
				include_once("components/com_resume/com_resume.models.php");
				break;
			}
		case "uploadimage":
			{
				$core_class->uploadFile();
				break;
			}
		case "preview":
			{
				$_POST['do'] = 'preview';
				include_once("components/com_createcv/com_createcv.models.php");
				break;
			}
		case "viewCV":
			{
				$_REQUEST['do'] = 'viewCV';
				include_once("components/com_career/com_career.models.php");
				break;
			}
		case "download":
			{
				$_POST['do'] = 'download';
				include_once("components/com_createcv/com_createcv.models.php");
				break;
			}
		case "downloadcv":
        {
			$temp = $_REQUEST['temp'];
			$career_id = $_REQUEST['career_id'];
			$email = $_REQUEST['email'];
			$profile = $_REQUEST['profile'];
			$webPageWidth = 0;
			switch($temp){
				case 1:
				case 2:
				case 4:
					$webPageWidth = 815;
				break;

				case 3:
					$webPageWidth = 785;
				break;

				case 5:
					$webPageWidth = 794;
				break;

				case 8:
					$webPageWidth = 768;
				break;

				default:
					$webPageWidth = 815;
				break;
			}

			include_once("components/com_createcv/com_createcv.models.php");
			$myprocess = new process();
			if(!empty($career_id) && $career_id !=NULL){
				if($myprocess->checkTemplate($temp)){
					if(!$myprocess->checkProfile($profile, $career_id)){
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
			// Set parameters
			$email_arr = explode('@', $_SESSION['career']['email']);

			$apikey = '1b424579-7d5e-49f6-a677-2b080c3445ae';
			$value = $_SERVER['HTTP_HOST'].'/download?temp='.$temp.'&career_id='.$career_id.'&profile='.$profile.'&email='.$email;
			$result = file_get_contents("http://viecyte.com/param?api_key=".urlencode($apikey)."&url=" . urlencode($value) . "&fileName=&webPageWidth=".$webPageWidth);
			header('Content-Description: File Transfer');
			header('Content-Type: application/pdf');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . strlen($result));
			header('Content-Disposition: attachment; filename=' . $email_arr[0].".pdf" );
			echo $result;

		    break;
        }
	    /* Lưu nội dung [Biên dịch] vào file */
	    case "translate":
	    {

	    	if (isset($_SESSION["session"]["uid"]) && ($_SESSION["session"]["uid"] == "admin")) {
	    		$lang_list = array_keys($GLOBALS['LANG_LIST']);
				$module_name = $_POST['module_name'];
    			unset($_POST['task']);
    			unset($_POST['module_name']);
    			if (in_array($_GET['lang'], $lang_list)) {
    				file_put_contents(LANG_PATH . $_GET['lang'] . '.' . $module_name, serialize($_POST));
    				ob_clean();
    				echo '1';
				}else {
					ob_clean();
					echo '0';
				}
			}else {
				echo '0';
			}
			break;
	    }
	    /* Lấy danh sách các trường ẩn (thông báo, nhãn của các nút...) cho chức năng [Biên dịch] */
	    case "translate_get_hidden":
	    {
	    	/* Kiểm tra xem có quyền truy xuất đến file cấu hình không */
	    	if (!empty($_SESSION['allow_edit_module']) && $_SESSION['allow_edit_module'] && !empty($_GET['f']))
	    	{
	    		$config_path = dirname(LANG_PATH) . '/config/';
	    		$lang_list = array_keys($GLOBALS['LANG_LIST']);
	    		/* Lọc bỏ các ký tự nguy hiểm */
	    		$f = str_replace(array('/', '\\', '..', '.'), '', $_GET['f']);
	    		/* Kiểm tra chuỗi đầu vào có hợp lệ hay không? */
	    		if ($f == $_GET['f'] && in_array($_GET['lang'], $lang_list))
	    		{
	    			$core_class = new core_class();
	    			$lang = $core_class->load_module_language($f, $_GET['lang']);
	    			$f = $config_path . $f . '.php';
					/* Kiểm tra xem file cấu hình có tồn tại không? */
					if ($core_class->_routers($f))
					{
						include($f);
						$count = count($list);
						for ($i = 0; $i < $count; $i++)
						{
							/* Khoá và giá trị cách nhau bởi ký tự [Tab] */
							echo $list[$i], "\t", $lang[$list[$i]];
							/* Các cặp khoá và giá trị này cách nhau bởi ký tự [Newline] */
							if ($i < $count - 1)
							{
								echo "\n";
							}
						}
					}
	    		}
			}
			else
			{
				include('404.php');
			}
			break;
		}
		
		case "": 
		default:
        {
		    break;
        }
    }
    ob_end_flush();