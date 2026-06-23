<?php defined( '_VALID_MOS' ) or die( include_once("404.php") );
	
	class process{
	
		public $dbObj;
		
		function __construct()
		{
			 $this->dbObj = new classDb();
		}
		
		function processSignUp($Hoten, $Email, $MatKhau, $inviteid)
        {
			$makichhoat = md5(sha1(md5(sha1($Email))));
			ob_start();
			include_once("emailcontent.php");
			$mail_content = ob_get_contents();
			ob_end_clean();
			$mail_subject = "K&#1085;ch ho&#7841;t t&#1072;i kho&#7843;n t&#7841;i VietPoll";
			$core_class = new core_class();
			$core_class->smtpSendMailCandidate($mail_subject, $mail_content, $Email);
			$sql = "INSERT INTO taikhoan(Hoten, Email, MatKhau, Trangthai, Ngaysinh, makichhoat, inviteid) ";
			$sql .= "VALUES(?, ?, ?, 0, sysdate(), ?, ?)";
			if ($this->dbObj->SqlQueryInputResult($sql, array($Hoten, $Email, $MatKhau, $makichhoat, $inviteid))){
				return true;
			}else{
				return false;
			}
		}
		
		function process_login($TenDangNhap, $MatKhau)
        {
			$sql = "SELECT * FROM taikhoan ";
			$sql .= "WHERE Tendangnhap = ? And Matkhau = ? AND taikhoan.Trangthai = 1";
			return $this->dbObj->SqlQueryOutputResult($sql, array($TenDangNhap, $MatKhau));
		}
		
		function process_getthongtin($makichhoat)
        {
			$sql = "SELECT taikhoan_id, Email, Hoten, Hinhanh from taikhoan WHERE makichhoat = ?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($makichhoat));
		}
	}
    
    /*  ___________________________
       |                                                      |
       |          HANDLER                           |
       |___________________________|
    */
    
    switch($_REQUEST["hidden"])
    {
        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
		
		case "sign-up";
			$myprocess = new process;			
			$Hoten = $core_class->txt_htmlspecialchars($_REQUEST["fullname"]);
			$Email = $core_class->txt_htmlspecialchars($_REQUEST["email"]);
			$MatKhau = $core_class->enscriptPass($_REQUEST["password"]);
			$inviteid = $core_class->txt_htmlspecialchars($_REQUEST["inviteid"]);
			if($inviteid != 0){
				$accountExits = $core_class->countColumnInTable("taikhoan", "taikhoan_id", "WHERE taikhoan_id = '".$inviteid."'");
				if($accountExits > 0){
					if($myprocess->processSignUp($Hoten, $Email, $MatKhau, $inviteid) <> FALSE)
					{
						echo 1;
					}
				}else{
					echo -1;
				}
			}else{
				$accountExits = $core_class->countColumnInTable("taikhoan", "Email", "WHERE Email = '".$Email."'");
				if($accountExits == 0){
					if($myprocess->processSignUp($Hoten, $Email, $MatKhau, 0) <> FALSE)
					{
						echo 1;
					}
				}else{
					echo 0;
				}
			}
        break;
        
        case "login":
            $myprocess = new process;
			$TenDangNhap = $_REQUEST["TenDangNhap"];      
			$MatKhau = $core_class->enscriptPass($_REQUEST["password"]);
			$result = $myprocess->process_login($TenDangNhap, $MatKhau);
            if($result->rowCount()>0){
				$row = $result->fetch();
				$_SESSION["session"] = array( 
					"Id" => $row["taikhoan_id"],
					"Tendangnhap" => $TenDangNhap,
					"Hoten" => $row["Hoten"],
					"AUTH_PER" => $row["AUTH_PER"],
					"AUTH_FUNC" => $row["AUTH_FUNC"],
					"Hinhanh" => $row["Hinhanh"]==""?"dist/assets/app/media/img/users/user.png":$row["Hinhanh"]
                                );
				echo 1;

			}else{
				echo 0;
			}
			
        break;
		
        default:
			
            //$core_class->_redirect(".");exit();
        break;
    }