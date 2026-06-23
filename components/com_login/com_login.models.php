<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

	
	class process{
	
		public $dbObj;
		
		function __construct()
		{
			 $this->dbObj = new classDb();
		}
		
		function process_login($email, $password)
        {
			$sql = "SELECT
						email, fullname
					FROM
						trn_career
					WHERE email = ? AND password = ?";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($email, md5($password)));
			if ($row = $result->fetch())
            {
				$core_class = new core_class();
				$career_id = $core_class->getValueFrom("trn_career", "career_id", "email='".$email."'");
				$_SESSION["career"] = array(
					"career_id" => $career_id,
					"email" => $row["email"],
					"fullname" => $row["fullname"]
				);
				return true;
			} else {
				return false;
			}
		}
		
		function process_login_ntd($Email, $MatKhau)
        {
			$sql = "SELECT congty_id, email, hinhanh, diachicongty, nguoilienhe, tencongty,sdthoai,post_basic FROM trn_congty ";
			$sql .= "WHERE email = ? And password = ? AND trn_congty.trangthai = 1";
			return $this->dbObj->SqlQueryOutputResult($sql, array($Email, $MatKhau));
		}
	}
    

    /*  ___________________________

       |                           |

       |          HANDLER          |

       |___________________________|

    */

    

  switch($_POST["do"])
    {
        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        case "login":
            $myprocess = new process;
			unset($_SESSION["session"]);
            if($myprocess->process_login($_POST["email"], $_POST["password"]) <> FALSE)
            {
				echo 1;
            } else {
				echo 0;
            }
        break;
        case "login-ntd":
            $myprocess = new process;
			unset($_SESSION["career"]);
			$Email = $_POST["email"];
			$MatKhau = $core_class->enscriptPass($_POST["password"]);
			$result = $myprocess->process_login_ntd($Email, $MatKhau);
            if($result->rowCount()>0){
				$row = $result->fetch();
				$_SESSION["session"] = array( 
					"Id" => $row["congty_id"],
					"Tendangnhap" => $row["email"],
					"tencongty" => $row["tencongty"],
					"nguoilienhe" => $row["nguoilienhe"],
					"diachicongty" => $row["diachicongty"],
					"sdthoai" => $row["sdthoai"],
					"post_basic" => $row["post_basic"],
					"Hinhanh" => $row["hinhanh"]==""?"dist/assets/app/media/img/users/user.png":$row["hinhanh"]
                );
				echo 1;
			}else{
				echo 0;
			}
        break;
		
        default:
            $core_class->_redirect(".");exit();
        break;
    }