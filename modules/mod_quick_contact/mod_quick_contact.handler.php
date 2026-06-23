<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    $myprocess = new mod_quick_contact_process();

    switch ($_POST["hidden"])
    {
        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        case "submit_mod_quick_contact";
            
            $title 		= $_POST["title"];
            $enabled 	= $_POST["enabled"];        
            $showtitle 	= $_POST["showtitle"];
            $position 	= $_POST["position"];
            
            // xử lý dữ liệu cho các item menu được chọn
            $menu_id =     "";
            
            $menus = $_POST["menus"];
            if($menus == "all") {
                $menu_id = "all";
            } else if($menus == "select") {
                $mnuArray = $_POST["selections"];
                for ($i = 0; $i < count($mnuArray); $i++) {
                    $menu_id .= "," . $mnuArray[$i];
                }
                $menu_id = substr($menu_id, 1);
            }
            
            $module_id = intval($_POST["module_id"]);
            
            $params = array(
				'class' 				 => $_POST['class'],
                'content' => $core_class->txt_htmlspecialchars($_POST['html_content'])
            );
            
            $params = serialize($params);
            
            if ($_POST["task"] == "save") {
                if ($myprocess->process_updatemodules($title, $enabled, $showtitle, $params, $menu_id, $position, $module_id) <> FALSE) {
                    $_SESSION["sys_message"]["error"] = "Đã thay đổi chức năng thành công!";
                    $core_class->_redirect($index."/module/mod_customhtml/" . $module_id . ".wti");
                    exit();
                }
                else {
                    $_SESSION["sys_message"]["error"] = "Đã có lỗi thay đổi chức năng, vui lòng làm lại!";
                    $core_class->_redirect($index."/module/mod_customhtml/" . $module_id . ".wti");
                }
            }
        
        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }