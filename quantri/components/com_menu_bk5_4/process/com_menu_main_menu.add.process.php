<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    class process
    {
	    public $dbObj;
	    function __construct()
	    {
		     $this->dbObj = new classDb();
	    }
	    
	    // ham su ly them main menu
	    function process_add_main_menu( $title, $lang_code, $alias, $activated ){
		    $sql = "Insert into menu_type(`title`, `lang_code`, `alias`, `activated`) VALUES (?, ?, ?, ?)";
		    $result = $this->dbObj->SqlQueryInputResult($sql, array($title, $lang_code, $alias, $activated));
		    if($result > 0){
			    return true;
		    }
		    else return false;
	    }
    }
    
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch($_POST["hidden"])
    {

        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        /* khoi su ly su kien them menu moi */
        case "submit_com_menu_main_menu_add";
            $myprocess = new process;
            if($_POST["task"] == "save"){
                if($myprocess->process_add_main_menu($_POST["title"], "vi", $core_class->_removesigns($_POST["alias"]), $_POST["published"]) <> FALSE){
                    $core_class->_redirect(".?com=com_menu");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            } else if ($_POST["task"] == "apply"){
                if($myprocess->process_add_main_menu($_POST["title"], "vi", $core_class->_removesigns($_POST["alias"]), $_POST["published"]) <> FALSE){
                    $GLOBALS['msg'] = "Chủ đề đã được thêm thành công!";
                    $core_class->_redirect(".?com=com_menu&view=main_menu&task=add");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            } else if($_POST["task"] == "cancel"){
                $core_class->_redirect(".?com=com_menu");
                exit;
            }
        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }