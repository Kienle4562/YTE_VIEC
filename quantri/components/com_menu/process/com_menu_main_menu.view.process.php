<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    class process
    {
	    public $dbObj;
	    
        function __construct()
	    {
		     $this->dbObj = new classDb();
	    }
	    
	    public function get_main_menu()
	    {
		    $sql = "SELECT `title`, `lang_code`, `alias`, `isroot`, `Id` FROM `menu_type`";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    return $result;
	    }
	    
	    // ham su ly go bo mau tin trong chu de cha(session)
	    function process_remove_main_menu($values){
		    $myprocess = new process();
		    if($myprocess->check_exist_main_menu_remove($values) > 0){
			    $GLOBALS['msg'] = "Nhóm menus này đang tồn tại menu con, vui lòng xóa menu con trước khi xóa nhóm menus này !!! ";
			    return true;
		    } else {
			    $sql = "Delete from `menu_type` where `Id` = ?";
			    if($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE) return true;
			    else return false;
		    }
	    }
	    
	    // ham kiem tra su hop le cua mau tin duoc xoa
	    function check_exist_main_menu_remove($menu_id){
		    $sql = "SELECT count(*) 'count' FROM `menu` WHERE `menu_type_id` = ?";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($menu_id));
		    if($row = $result->fetch()){
			    return $row['count'];
		    } 
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
        case "submit_com_menu_main_menu_view";
            $myprocess = new process;
            if($_POST["task"] == "save"){
                if($myprocess->process_add_main_menu($_POST["title"], $core_class->_removesigns($_POST["alias"]), $_POST["menutype"], $_POST["published"]) <> FALSE){
                    $core_class->_redirect(".?com=com_menu");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            } else if ($_POST["task"] == "apply"){
                if($myprocess->process_add_main_menu($_POST["title"], $core_class->_removesigns($_POST["alias"]), $_POST["menutype"], $_POST["published"]) <> FALSE){
                    $GLOBALS['msg'] = "Chủ đề đã được thêm thành công!";
                    $core_class->_redirect(".?com=com_menu&view=main_menu&task=add");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            } else if($_POST["task"] == "cancel"){
                $core_class->_redirect(".?com=com_menu");
                exit;
            } else if($_POST["task"] == "remove"){
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_remove_main_menu($values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE){}
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }