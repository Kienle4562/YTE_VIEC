<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    $myprocess = new process_product_khachhangyeuthich();
    
    switch($_POST["hidden"])
    {
        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        case "submit_mod_product_khachhangyeuthich";
        
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
			
			$khung1_linkurl = $_POST["khung1_link_url"];
			$khung2_linkurl = $_POST["khung2_link_url"];
			$khung3_linkurl = $_POST["khung3_link_url"];
			$khung4_linkurl = $_POST["khung4_link_url"];
			$khung5_linkurl = $_POST["khung5_link_url"];

            $params = array(
			
                'khung1_title' => $_POST['khung1_title'],
				'khung1_image' => $_POST['khung1_image'],
				'khung1_linkurl' => $khung1_linkurl,
				
				'khung2_title' => $_POST['khung2_title'],
				'khung2_image' => $_POST['khung2_image'],
				'khung2_linkurl' => $khung2_linkurl,

				'khung3_title' => $_POST['khung3_title'],
				'khung3_image' => $_POST['khung3_image'],
				'khung3_linkurl' => $khung3_linkurl,
				
				'khung4_title' => $_POST['khung4_title'],
				'khung4_image' => $_POST['khung4_image'],
				'khung4_linkurl' => $khung4_linkurl,
				
				'khung5_title' => $_POST['khung5_title'],
				'khung5_image' => $_POST['khung5_image'],
				'khung5_linkurl' => $khung5_linkurl,
				
            );
            
            $params = serialize($params);

            $date_add = $core_class->_formatdate(date("d/m/Y"));
            
            $module_id = intval($_POST["module_id"]);
            
            if ($_POST["task"] == "save") {
                if ($myprocess->process_updatemodules($title, $enabled, $showtitle, $params, $menu_id, $position, $module_id) <> FALSE) {
                    $_SESSION["sys_message"]["error"] = "Đã thay đổi chức năng thành công!";
                    $core_class->_redirect($index."/module/mod_product_khachhangyeuthich/".$module_id.".html");
                    exit();
                }
                else {
                    $_SESSION["sys_message"]["error"] = "Đã có lỗi thay đổi chức năng, vui lòng làm lại!";
                    $core_class->_redirect($index."/module/mod_product_khachhangyeuthich/".$module_id.".html");
                }
            }
        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }