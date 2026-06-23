<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    $myprocess = new process_menumobile();
    
    switch($_POST["hidden"])
    {
        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        case "submit_mod_menumobile";
        
            $title = $_POST["title"];
            $enabled = $_POST["enabled"];        
            $shohtmltle = $_POST["shohtmltle"];
            $position = $_POST["position"];
            
            // xử lý dữ liệu cho các item menumobile được chọn
            $menumobile_id = "";
            
            $menumobiles = $_POST["menumobiles"];
            
            if ($menumobiles == "all") {
                $menumobile_id = "all";
            }
            elseif ($menumobiles == "select") {
                $mnuArray = $_POST["selections"];
                for ($i = 0; $i < count($mnuArray); $i++) {
                    $menumobile_id .= "," . $mnuArray[$i];
                }
                $menumobile_id = substr($menumobile_id, 1);
            }

            $params = array(
                'menu_type_id' => $_POST['menu_type_id'],
                'max_level' => $_POST['max_level'],
                'class' => $_POST['class'],
                'show_icon' => $_POST['show_icon']
            );
            
            $params = serialize($params);

            $date_add = $core_class->_formatdate(date("d/m/Y"));
            
            $module_id = intval($_POST["module_id"]);
            
            if ($_POST["task"] == "save") {
                if ($myprocess->process_updatemodules($title, $enabled, $shohtmltle, $params, $menumobile_id, $position, $module_id) <> FALSE) {
                    $_SESSION["sys_message"]["error"] = "Đã thay đổi chức năng thành công!";
                    $core_class->_redirect($index."/module/mod_menumobile/" . $module_id . ".html");
                    exit();
                }
                else {
                    $_SESSION["sys_message"]["error"] = "Đã có lỗi thay đổi chức năng, vui lòng làm lại!";
                    $core_class->_redirect($index."/module/mod_menumobile/" . $module_id . ".html");
                }
            }
        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }