<?php defined( '_VALID_MOS' ) or die( include("404.php") );
switch($_POST["hidden"])
{
	case "";
		// khoi dau trang khong co gia tri submit. khong lam zi ca
		break;
	
	/* khoi su ly su kien submit form chỉnh sửa thông tin cơ bản */
	case "submit_com_caidat_information_add";
        if ($_POST["task"] == "apply")
        {
        	$lang_code = $_SESSION['amdin']['com_caidat']['information']['lang_code'];
        	
            $_APP['db_schema'] = $_POST["db_schema"];

            $_APP['config']['admin-email'] = $_POST["email"];
            
            if (!is_array($_APP['config']['title'])) { $_APP['config']['title'] = array(); }
            if (!is_array($_APP['config']['meta-keyword'])) { $_APP['config']['meta-keyword'] = array(); }
            if (!is_array($_APP['config']['meta-description'])) { $_APP['config']['meta-description'] = array(); }
            
            $_APP['config']['title'][$lang_code] = $_POST['config-title'];
            $_APP['config']['meta-keyword'][$lang_code] = $_POST['meta-keyword'];
            $_APP['config']['meta-description'][$lang_code] = $_POST['meta-description'];
            
            $_APP['config']['system-state'] = $_POST['system-state'];
			$_APP['config']['system-intro'] = $_POST['system-intro'];
            $_APP['config']['system-maintenance-message'] = $_POST['system-maintenance-message'];
            
            $_APP['config']['use-thumbnail'] = $_POST['use-thumbnail'];
            
            $_APP['config']['smtp']['host'] = $_POST['smtp_host'];
            $_APP['config']['smtp']['port'] = $_POST['smtp_port'];
            $_APP['config']['smtp']['username'] = $_POST['smtp_username'];
            $_APP['config']['smtp']['password'] = $_POST['smtp_password'];
            $_APP['config']['smtp']['display_name'] = $_POST['smtp_display_name'];
            
            $_APP['config']['com_content']['show_updated_date'] = $_POST['com_content_show_updated_date'];
            $_APP['config']['com_content']['show_older_news'] = $_POST['com_content_show_older_news'];
            
            $_APP['config']['com_product']['category_view_type'] = $_POST['com_product_category_view_type'];
            $_APP['config']['com_product']['category_view_type_1'] = $_POST['com_product_category_view_type_1'];
			
			$_APP['config']['logo']['img_logo'] = $_POST['img_logo'];
            
            application_end();
            $core_class->_redirect("./?com=com_caidat&view=information");
        }
        else if($_POST["task"] == "cancel")
        {
            $core_class->_redirect("./");
            exit();
        }
        else if ($_POST['task'] == 'change_lang_code')
        {
			$_SESSION['amdin']['com_caidat']['information']['lang_code'] = $_POST['lang_code'];
			$core_class->_redirect("./?com=com_caidat&view=information");
        }
        break;

    case "submit_com_caidat_contact";
		if ($_POST["task"] == "apply")
		{
			if (!is_array($_APP['config']['contact']['contact_content'])) { $_APP['config']['contact']['contact_content'] = array(); }
			
			$_APP['config']['contact']['company_name'] = $_POST['company'];
			$_APP['config']['contact']['phone'] = array("phone1" => $_POST['phone1'], "phone2" => $_POST['phone2'], "phone3" => $_POST['phone3']);
			$_APP['config']['contact']['mobile'] = array("mobile1" => $_POST['mobile1'], "mobile2" => $_POST['mobile2'], "mobile3" => $_POST['mobile3']);
			$_APP['config']['contact']['email'] = array("email1" => $_POST['email1'], "email2" => $_POST['email2'], "email3" => $_POST['email3']);
			$_APP['config']['contact']['skype'] = array("skype1" => $_POST['skype1'], "skype2" => $_POST['skype2'], "skype3" => $_POST['skype3']);
			$_APP['config']['contact']['yahoo'] = array("yahoo1" => $_POST['yahoo1'], "yahoo2" => $_POST['yahoo2'], "yahoo3" => $_POST['yahoo3']);
			$_APP['config']['contact']['address'] = array("address1" => $_POST['address1'], "address2" => $_POST['address2'], "address3" => $_POST['address3']);
			
            $_APP['config']['contact']['maps_code'][$_SESSION['amdin']['com_caidat']['contact']['lang_code']] = $core_class->txt_htmlspecialchars($_POST['contact_content']);
			 $_APP['config']['contact']['taikhoan'] = $core_class->txt_htmlspecialchars($_POST['taikhoan_content']);
            
            $_APP['config']['contact']['show_map'] = $_POST['show_map'];
			
			application_end();
			$core_class->_redirect("./?com=com_caidat&view=contact");
		}
		else if($_POST["task"] == "cancel")
		{
			$core_class->_redirect("./");
			exit();
		}
		else if ($_POST['task'] == 'change_lang_code')
        {
			$_SESSION['amdin']['com_caidat']['contact']['lang_code'] = $_POST['lang_code'];
			$core_class->_redirect("./?com=com_caidat&view=contact");
        }
		break;

	default:
		$core_class->_redirect(".");exit();
		break;
}