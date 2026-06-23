<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
        
	    // ham su ly edit admin boi admin
	    function process_edit_admin($pfullname, $pmail, $ppassword, $puserid)
        {
		    $sql = "SELECT `account`.`passWord` FROM `account` WHERE `account`.`Ac_Id` = ?";
		    $sql1 = "Update `account` Set `fullName` = ?, `mail` = ?, `passWord` = ? Where `Ac_Id` = ?";
		    
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($puserid));
            
		    if($row = $result->fetch(PDO::FETCH_ASSOC))
            {
			    if ($row['passWord'] == $ppassword)
                {
				    if ($this->dbObj->SqlQueryInputResult($sql1, array($pfullname, $pmail, $ppassword, $puserid)) <> FALSE) {
					    return true;
				    } else {
                        return false;
                    }
			    } else {
                    if ($this->dbObj->SqlQueryInputResult($sql1, array($pfullname, $pmail, md5($ppassword), $puserid)) <> FALSE) {
                        return true;
                    } else {
                        return false;
                    }
			    }
		    }
	    }
		    
	    function process_adduser($UserName, $FullName, $Mail, $phone, $address, $PassWord, $Status)
        {
		    $sql = "Insert into account(`UserName`, `FullName`, `Mail`, `phone`, `address`, `PassWord`, `Status`)
				    VALUES (?, ?, ?, ?, ?, ?, ?)";

            if ($this->dbObj->SqlQueryInputResult($sql, array($UserName, $FullName, $Mail, $phone, $address, md5($PassWord), $Status)) <> FALSE) {
                return true;
            } else {
                return false;
            }
	    }
		    
	    function process_pulish_and_un_publish_user($check, $values)
        {
            if ($check == 0) {
		        $sql = "Update khachhang Set `status` = 0 Where Ac_Id = ?";
		    } else {
                $sql = "Update khachhang Set `status` = 1 Where Ac_Id = ?";
            }
            
            if ($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE) {
                return true;
            } else {
                return false;
            }
	    }

	    function process_remove_user($values)
        {
		    $sql = "Delete from account where Ac_Id = ?";
            
            if ($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE) {
                return true;
            } else {
                return false;
            }
	    }
	    
	    // ham su ly su kien edit user boi admin
	    function process_edit_user($pfullname, $pmail, $phone, $address, $ppassword, $puserid, $pPerID)
        {
		    $sql = "SELECT `account`.`PassWord` FROM `account` WHERE `account`.`Ac_Id` = ?;";
		    $sql1 = "Update `account` Set `FullName` = ?, `Mail` = ?, `phone` = ?, `address` = ?, `PassWord` = ? Where Ac_Id = ?";
            
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($puserid));
            
            if($row = $result->fetch(PDO::FETCH_ASSOC))
            {
                if ($row['Password'] == $ppassword)
                {
                    if ($this->dbObj->SqlQueryInputResult($sql1, array($pfullname, $pmail, $ppassword, $puserid)) <> FALSE) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    if ($this->dbObj->SqlQueryInputResult($sql1, array($pfullname, $pmail, $phone, $address, md5($ppassword), $puserid)) <> FALSE) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
	    }	
    }
    
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch($_POST["hidden"]){

        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        case "submit_com_user_view";
        if($_POST["task"] == "block"){
            $check = FALSE;
            $values = $_POST["cid"];
            $myprocess = new process;
            for ($row = 0; $row < count($values); $row++){
                if($myprocess->process_pulish_and_un_publish_user("0", $values[$row]) <> FALSE)
                $check = TRUE;
            }
            if($check == TRUE)
            $GLOBALS['msg'] = "";
            else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
        }
        else if($_POST["task"] == "unblock"){
            $check = FALSE;
            $values = $_POST["cid"];
            $myprocess = new process;
            for ($row = 0; $row < count($values); $row++){
                if($myprocess->process_pulish_and_un_publish_user("1", $values[$row]) <> FALSE)
                $check = TRUE;
            }
            if($check == TRUE)
            $GLOBALS['msg'] = "";
            else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
        }

        else if($_POST["task"] == "remove"){
            $check = FALSE;
            $values = $_POST["cid"];
            $myprocess = new process;
            for ($row = 0; $row < count($values); $row++){
                if($myprocess->process_remove_user($values[$row]) <> FALSE)
                $check = TRUE;
            }
            if($check == TRUE)
            $GLOBALS['msg'] = "";
            else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
        }

        else if($_POST["task"] == "changepage"){
            header("location: .?mod=manuser&r=".$_POST["limit"]);exit;
        }
        
        break;
        
        case "submit_com_user_edit":
            if($_POST["task"] == "save"){
                $myprocess = new process;
                if($myprocess->process_edit_user($_POST["name"], $_POST["email"], $_POST["phone"], $_POST["address"], $_POST["password"], $_POST["userid"], $_POST["gid"]) <> FALSE)
                {$core_class->_redirect(".?com=com_user&view=view");exit;}
                else {$core_class->_redirect(".");exit;}
            }
        break;
        
        case "submit_com_user_edit_admin":
            if($_POST["task"] == "save"){
                $myprocess = new process;
                if($myprocess->process_edit_admin($_POST["name"], $_POST["email"], $_POST["password"], $_POST["userid"]) <> FALSE)
                {// $core_class->_redirect(".");exit;
                }
                else {//$core_class->_redirect(".");exit;
                }
            }
        break;
        
        case "submit_com_user_add";
            if($_POST["task"] == "save"){
                $myprocess = new process;
                if($myprocess->process_adduser($_POST["username"], $_POST["name"], $_POST["email"], $_POST["phone"], $_POST["address"], $_POST["password"] , $_POST["block"]) <> FALSE)
                {$core_class->_redirect(".?com=com_user&view=view");exit;}
                else {$core_class->_redirect(".");exit;}
            } else if($_POST["task"] == "apply"){
                $myprocess = new process;
                if($myprocess->process_adduser($_POST["username"], $_POST["name"], $_POST["email"], $_POST["phone"], $_POST["address"], $_POST["password"] , $_POST["block"]) <> FALSE)
                {$core_class->_redirect(".?com=com_user&view=add");exit;}
                else {$core_class->_redirect(".");exit;}
            }
        break;

        
        default:
            $core_class->_redirect(".");
        break;
    }