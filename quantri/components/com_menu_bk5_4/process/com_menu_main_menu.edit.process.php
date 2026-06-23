<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    class process
    {
	    public $dbObj;
	    function __construct()
	    {
		     $this->dbObj = new classDb();
	    }
	    
	    public function get_main_menu_edit($menu_type_id)
	    {
		    $sql = "SELECT `Id`, `lang_code`, `title`, `alias`, `isroot`, `activated` FROM `menu_type` WHERE `Id` = ?";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($menu_type_id));
		    return $result;
	    }
	    
	    // ham su ly them main menu
	    function process_edit_main_menu( $title, $lang_code, $alias, $activated, $menu_type_id){
		    $sql = "UPDATE `menu_type` SET
				    `title` = ?,
				    `lang_code` = ?, 
				    `alias` = ?, 
				    `activated` = ?
				    WHERE `Id` = ?";
		    $result = $this->dbObj->SqlQueryInputResult($sql, array($title, $lang_code, $alias, $activated, $menu_type_id));
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
        case "submit_com_menu_main_menu_edit";
            $myprocess = new process;
            if($_POST["task"] == "save"){
                if($myprocess->process_edit_main_menu($_POST["title"], "vi", $core_class->_removesigns($_POST["alias"]), $_POST["published"], $_POST["menu_type_id"]) <> FALSE){
                    $core_class->_redirect(".?com=com_menu");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            } else if ($_POST["task"] == "apply"){
                if($myprocess->process_edit_main_menu($_POST["title"], "vi", $core_class->_removesigns($_POST["alias"]), $_POST["published"], $_POST["menu_type_id"]) <> FALSE){
                    $GLOBALS['msg'] = "Chủ đề đã được thêm thành công!";
                    $core_class->_redirect(".?com=com_menu&view=main_menu&task=edit&id=".$_POST["menu_type_id"]);
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