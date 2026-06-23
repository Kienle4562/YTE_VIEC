<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    

    $myprocess = new process_mod_slideshow2();

    

    switch($_POST["hidden"])

    {

        case "";

        // khoi dau trang khong co gia tri submit. khong lam zi ca

        break;

        

        case "submit_mod_slideshow2";

        

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



            $date_add = $core_class->_formatdate(date("d/m/Y"));

            

            $module_id = intval($_POST["module_id"]);



            $params = serialize(array(

				'class' 	  => $_POST['class'],

                'control_nav' => $_POST['controlNav'],

                'with_effect' => $_POST['withEffect'],
				'banner1' => $_POST['banner1'],
				'banner2' => $_POST['banner2'],
				'banner3' => $_POST['banner3'],
				'urlbanner1' => $_POST['urlbanner1'],
				'urlbanner2' => $_POST['urlbanner2'],
				'urlbanner3' => $_POST['urlbanner3']

            ));

            

            if ($_POST["task"] == "save") {

                if ($myprocess->process_updatemodules($title, $enabled, $showtitle, $params, $menu_id, $position, $module_id) <> FALSE) {

                    $_SESSION["sys_message"]["error"] = "Đã thay đổi chức năng thành công!";

                    $core_class->_redirect($index."/module/mod_slideshow2/".$module_id.".html");

                    exit();

                }

                else {

                    $_SESSION["sys_message"]["error"] = "Đã có lỗi thay đổi chức năng, vui lòng làm lại!";

                    $core_class->_redirect($index."/module/mod_slideshow2/".$module_id.".html");

                }

            }

        break;

        

        default:

            $core_class->_redirect(".");

            exit();

        break;

    }