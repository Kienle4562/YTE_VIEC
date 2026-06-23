<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	
	class process{
	
		public $dbObj;
		
		function __construct()
		{
			 $this->dbObj = new classDb();
		}
		
		function process_login($uid, $pass)
        {
			$sql = "SELECT 1 as `Per_Id`, `account`.`userName`, `account`.`fullName`, 'Supper Administrator' as `KeyWord`, 'Supper Administrator' as `Description`, `account`.`Ac_Id`
					FROM `account`
					Where `account`.`userName` = ? And `account`.`passWord` = ? AND Status = 1";
	
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($uid, md5($pass)));
		
			if ($row = $result->fetch())
            {
				$_SESSION["session"] = array(   "Per_Id" => $row['Per_Id'],
                                                "uid" => $row['userName'],
                                                "fullname" => $row['fullName'],
                                                "key" => $row['KeyWord'],
                                                "des" => $row['Description'],
                                                "id" => $row['Ac_Id']
                );
				
                if (isset($_SESSION["session"]["Per_Id"]) && isset($_SESSION["session"]["uid"]) && isset($_SESSION["session"]["fullname"]) && isset($_SESSION["session"]["key"]) && isset($_SESSION["session"]["des"])) {
				    return true;
                }
			} else {
				return false;
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
        
        case "login":
            $myprocess = new process;
            if($myprocess->process_login($_POST["uid"], $_POST["pass"]) <> FALSE)
            {
                $core_class->_redirect(".");exit();
            } else {
                $GLOBALS['msg'] = "Lỗi đăng nhập, sai username hoặc password";
                $core_class->_redirect(".");exit();
            }
        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }