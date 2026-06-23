<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    $myprocess = new process_mod_company();
    
    switch($_POST["hidden"])
    {
        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        case "submit_mod_show_option";
        
            $title = $_POST["title"];
            $enabled = $_POST["enabled"];        
            $showtitle = $_POST["showtitle"];
            $position = $_POST["position"];
            // xử lý dữ liệu cho các item menu được chọn
            $menu_id = "";
            
            $menus = $_POST["menus"];
            
            if ($menus == "all") {
                $menu_id = "all";
            }
            elseif ($menus == "select") {
                $mnuArray = $_POST["selections"];
                for ($i = 0; $i < count($mnuArray); $i++) {
                    $menu_id .= "," . $mnuArray[$i];
                }
                $menu_id = substr($menu_id, 1);
            }
            
            if (!is_numeric($_POST['max_level']) || $_POST['max_level'] < 0) {
                $_POST['max_level'] = 0;
            }

            $params = array(
                'cat_id' 				 => $_POST['cat_id'],
                'sub_number' 			 => $_POST['sub_number'],
				'news_id' 			 	 => $_POST['news_id'],
				'subdec_number' 		 => $_POST['subdec_number'],
				'layout_boostrap' 		 => $_POST['layout_boostrap'],
                'class' 				 => $_POST['class'],
				'show_option_type_choose' => $_POST['show_option_type_choose'],
				'show_option_type_value' => $_POST['show_option_type_value']
            );
            
            $params = serialize($params);

            $date_add = $core_class->_formatdate(date("d/m/Y"));
            
            $module_id = intval($_POST["module_id"]);
            
            if ($_POST["task"] == "save") {
                if ($myprocess->process_updatemodules($title, $enabled, $showtitle, $params, $menu_id, $position, $module_id) <> FALSE) {
                    $_SESSION["sys_message"]["error"] = "Đã thay đổi chức năng thành công!";
                    $core_class->_redirect($index."/module/mod_company/" . $module_id . ".html");
                    exit();
                }
                else {
                    $_SESSION["sys_message"]["error"] = "Đã có lỗi thay đổi chức năng, vui lòng làm lại!";
                    $core_class->_redirect($index."/module/mod_company/" . $module_id . ".html");
                }
            }
        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }