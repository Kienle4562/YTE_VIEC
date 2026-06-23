<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process
    {
	    public $dbObj;
	    
	    function __construct()
	    {
		     $this->dbObj = new classDb();
	    }
	    
	    // ham su ly di chuyen mau tin xuong phia duoi cua item menu
	    function process_get_list_item_menu($parentid, $menutypeid){
		    $sql = "SELECT id, title, activated, order_num, link, link_id, type, target, menu_type_Id, parent_Id 
				    FROM `menu`
				    WHERE parent_Id = ? AND menu_type_id = ? order by `order_num`";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $menutypeid));
		    return $result;
	    }
	    
	    /* ham su ly go bo mot item menu */
	    function process_remove_item_menu_view($values){
		    $sql = "Delete from menu where Id = ?";
		    $result = $this->dbObj->SqlQueryInputResult($sql, array($values));
		    if($result)
			    return true;
		    else
			    return false;
	    }
	    
	    /* ham su ly xuat ban va khong xuat ban muc item menu */
	    function process_pulish_and_un_publish_item_menu($check, $values){
		    if($check == 0)
		    $sql = "Update menu Set `activated` = 0 Where Id = ?";
		    else $sql = "Update menu Set `activated` = 1 Where Id = ?";
		    $result = $this->dbObj->SqlQueryInputResult($sql, array($values));
		    if($result > 0)
			    return true;
		    else
			    return false;
	    }
	    
	    // ham su ly di chuyen mau tin xuong phia tren cua item menu
	    function process_orderup_item_menu($pnewsid){
		    $sql = "	SELECT (	SELECT 
										    `order_num` 
								    FROM 
										    menu 
								    WHERE 
										    Id = $pnewsid
							    ) As `currenOrder`,
					    
					    (SELECT 
							    max(`order_num`) 
					    FROM 
							    menu 
					    WHERE 
							    `parent_Id` = (	SELECT 
													    `parent_Id` 
											    FROM 
													    menu 
											    WHERE Id = $pnewsid
											    )
							    AND menu_type_Id = (SELECT menu_type_Id from menu WHERE `Id` = $pnewsid) 
							    AND `order_num` < (SELECT `order_num` from menu WHERE Id = $pnewsid) 
					    ORDER BY 
							    `order_num` LIMIT 1) As `preOrder`, 
					    
					    (SELECT 
							    Id 
					    FROM 
							    menu 
					    WHERE 
							    `order_num` = (	SELECT 
													    max(`order_num`) 
											    FROM 
													    menu WHERE `parent_Id` = (SELECT `parent_Id` from menu WHERE Id = $pnewsid)
													    AND menu_type_Id = (SELECT menu_type_Id from menu WHERE `Id` = $pnewsid) 
													    AND `order_num` < (SELECT `order_num` from menu WHERE Id = $pnewsid) 
											    ORDER BY 
													    `order_num` LIMIT 1)) As `preSesid`
				    ";
	    
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    if($row = $result->fetch()){
			    $sql1 = "update menu set `order_num` = ? where `Id` = ?";
			    $result1 = $this->dbObj->SqlQueryInputResult($sql1, array($row['currenOrder'], $row['preSesid']));
			    if($result1 > 0){
				    $sql2 = "update menu set `order_num` = ? where `Id` = ?";
				    $result2 = $this->dbObj->SqlQueryInputResult($sql1, array($row['preOrder'], $pnewsid));
				    if($result2 > 0){
					    return true;
				    }
				    else return false;
				    return true;						
			    }				 
			    else return false;
		    }		
	    }
	    
	    // ham su ly di chuyen mau tin xuong phia duoi cua item menu
	    function process_orderdown_item_menu($pnewsid){
		    $sql = "SELECT (SELECT `order_num` from menu WHERE Id = $pnewsid) As `currenOrder`,
				    (SELECT `order_num` from menu WHERE `parent_Id` = (SELECT `parent_Id` from menu WHERE Id = $pnewsid)
				    AND menu_type_Id = (SELECT menu_type_Id from menu WHERE `Id` = $pnewsid) AND `order_num` > (SELECT `order_num` from menu WHERE Id = $pnewsid) 
				    Order by `order_num` LIMIT 1) As `preOrder`, 
				    (SELECT Id from menu WHERE `order_num` = (SELECT `order_num` from menu WHERE `parent_Id` = (SELECT `parent_Id` from menu WHERE Id = $pnewsid)
				    AND menu_type_Id = (SELECT menu_type_Id from menu WHERE `Id` = $pnewsid) AND `order_num` > (SELECT `order_num` from menu WHERE Id = $pnewsid) 
				    Order by `order_num` LIMIT 1)) As `preSesid`";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    if($row = $result->fetch()){
			    $sql1 = "update menu set `order_num` = ? where `Id` = ?";
			    $result1 = $this->dbObj->SqlQueryInputResult($sql1, array($row['currenOrder'], $row['preSesid']));
			    if($result1 > 0){
				    $sql2 = "update menu set `order_num` = ? where `Id` = ?";
				    $result2 = $this->dbObj->SqlQueryInputResult($sql1, array($row['preOrder'], $pnewsid));
				    if($result2 > 0){
					    return true;
				    }
				    else return false;
				    return true;						
			    }				 
			    else return false;
		    }					
	    }
	    
	    public function get_main_menu_edit($menu_type_id)
	    {
		    $sql = "SELECT `Id`, `lang_code`, `title`, `alias`, `isroot`, `activated` FROM `menu_type` WHERE `Id` = ?";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($menu_type_id));
		    return $result;
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
        
        case "submit_com_menu_item_menu_view";
            if($_POST["task"] == "remove"){
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_remove_item_menu_view($values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE)
                $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị ! !!! ";
            } else if($_POST["task"] == "unpublish"){
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_pulish_and_un_publish_item_menu("0", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE)
                $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
            else if($_POST["task"] == "publish"){
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_pulish_and_un_publish_item_menu("1", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE)
                $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
            else if($_POST["task"] == "orderup"){
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_orderup_item_menu($values[$row]) <> FALSE)
                    $GLOBALS['msg'] = "";
                    else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
                }
            }
            else if($_POST["task"] == "orderdown"){
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_orderdown_item_menu($values[$row]) <> FALSE)                    
                    $GLOBALS['msg'] = "";
                    else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
                }
            }
        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }