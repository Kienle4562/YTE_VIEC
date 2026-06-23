<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    switch($_POST["hidden"])
    {
        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        case "submit_com_module_add";
        
            $myprocess = new process;
            $dbObj = new classDb();
            
            $title = $_POST["title"];
            $module = $_POST["ddlModules"];
            $ordering = $dbObj->maxid("modules", "ordering");
            $position = $_POST["position"];
            $enabled = $_POST["enabled"];        
            $numviews = 1;
            $access = 1;
            $showtitle = $_POST["showtitle"];
            $params = "undefine";
            $iscore = 0;
            $menu_id = "";
            $lang_code = $_GET['lang'];
            
            $menus = $_POST["menus"];
            
            if ($menus == "all") {
                $menu_id = "all";
            }
            else if($menus == "select") {
                $mnuArray = $_POST["selections"];
                for ($i = 0; $i < count($mnuArray); $i++) {
                    $menu_id .= "," . $mnuArray[$i];
                }
                
                $menu_id = substr($menu_id, 1);
            }
            else if($menus == "unselect") {
                $mnuArray = $_POST["selections"];
                for ($i = 0; $i < count($mnuArray); $i++) {
                    $menu_id .= ",-" . $mnuArray[$i];
                }
                
                $menu_id = substr($menu_id, 1);
            }
                
            if ($_POST["task"] == "save") {
            
                if($myprocess->process_addmodules($title, $module, $ordering, $position, $enabled, $numviews, $access, $showtitle, $params, $iscore, $menu_id, $lang_code) <> FALSE) {
                    $_SESSION["sys_message"]["error"] = "Đã thêm mới module thành công!";
                    $core_class->_redirect($index."/module/mod_module.wti?lang=" . $lang_code);
                    exit();
                }
                else {
                    $_SESSION["sys_message"]["error"] = "Đã có lỗi thêm module, vui lòng làm lại!";
                }
            }
                    
        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }