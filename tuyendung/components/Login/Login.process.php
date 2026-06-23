<?php defined( '_VALID_MOS' ) or die( include_once("404.php") );
	
	class process{
	
		public $dbObj;
		
		function __construct()
		{
			 $this->dbObj = new classDb();
		}
		
		function processSignUp($Email, $MatKhau, $tencongty, $quymo_id, $gioithieungan, $diachicongty,$sdthoai,$tinhthanh_id,$post_basic,$trangthai)
        {
			$core_class = new core_class();
			$makichhoat = md5(sha1(md5(sha1($Email))));
			$subject = "Kích hoạt tài khoản tại Y Tế Việc";
			$mailHTML = "Chào ". $Email .",<br><br>";
			$mailHTML .= "Chúc mừng bạn, dưới đây là thông tin tài khoản đã được tạo. <br>";
			$mailHTML .= '<a style="background-color: #7087A3; font-size: 18px; padding: 15px 15px; color: #fff;display: table;margin: 10px auto; text-decoration: none;border-radius: 5px;">Tài khoản: '.$Email.'</a>';
			$mailHTML .= "Chỉ thêm một bước nữa, bạn có thể tham gia vào cộng đồng tuyển dụng chuyên nghiệp lớn nhất Việt Nam, Hãy kích hoạt tài khoản của bạn và bắt đầu tuyển dụng ngay hôm nay<br>";
			$mailHTML .= '<a href="'.$_SERVER['HTTP_HOST'].'?active='.$makichhoat.'" style="background-color: #f7941d; font-size: 18px; padding: 15px 15px; color: #fff; text-decoration: none;display: table;margin: 10px auto;border-radius: 5px;">KÍCH HOẠT TÀI KHOẢN</a>';
			$mailHTML .= 'Hoặc click vào link này: '.$_SERVER['HTTP_HOST'].'?active='.$makichhoat.'';

			$mailContent = $core_class->sendMailWithTemplate($subject, $mailHTML);
			$emailTo = $Email;
			if(!empty($emailTo)){
				$core_class->smtpSendMailCandidate($subject, $mailContent, $emailTo);
			}

			$sql = "INSERT INTO trn_congty(email, password, makichhoat";
			$sql .= ",tencongty,quymo_id,gioithieungan,diachicongty,sdthoai,tinhthanh_id,post_basic,trangthai";
			$sql .= ")VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
			if ($this->dbObj->SqlQueryInputResult(
						$sql, 
						array(
							$Email, $MatKhau, $makichhoat, $tencongty, $quymo_id
							,$gioithieungan
							,$diachicongty
							,$sdthoai
							,$tinhthanh_id
							,$post_basic
							,$trangthai
						)
					)
				)
			{
				return true;
			}else{
				return false;
			}
		}
		
		function process_login($Email, $MatKhau)
        {
			$sql = "SELECT congty_id, email, hinhanh, diachicongty, nguoilienhe, tencongty,sdthoai,post_basic FROM trn_congty ";
			$sql .= "WHERE email = ? And password = ? AND trn_congty.trangthai = 1";
			return $this->dbObj->SqlQueryOutputResult($sql, array($Email, $MatKhau));
		}
		
		function process_getthongtin($makichhoat)
        {
			$sql = "SELECT congty_id, email from trn_congty WHERE makichhoat = ?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($makichhoat));
		}
		
		public function updatePassword($email, $password)
        {
			$core_class = new core_class();
            return $this->dbObj->SqlQueryInputResult(
                "UPDATE trn_congty 
                        SET password = ?
				WHERE email = ?", 
                array($core_class->enscriptPass($password), $email)
            );
        }
	}
    
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch($_REQUEST["hidden"])
    {
        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
		
		case "sign-up";
			$myprocess = new process;			
			$Email = $core_class->txt_htmlspecialchars($_POST["email"]);
			$MatKhau = $core_class->enscriptPass($_POST["password"]);
			$tencongty = $core_class->txt_htmlspecialchars($_POST["tencongty"]);
			$quymo_id = $core_class->txt_htmlspecialchars($_POST["quymo_id"]);
			$gioithieungan = $core_class->txt_htmlspecialchars($_POST["gioithieungan"]);
			$diachicongty = $core_class->txt_htmlspecialchars($_POST["diachicongty"]);
			$sdthoai = $core_class->txt_htmlspecialchars($_POST["sdthoai"]);
			$tinhthanh_id = $core_class->txt_htmlspecialchars($_POST["location_id"]);
			$trangthai = 0;
			$post_basic = 20;
			$maxacnhan = $core_class->txt_htmlspecialchars($_POST["maxacnhan"]);
			if($maxacnhan == $_SESSION['randomnr2']){
				$accountExits = $core_class->countColumnInTable("trn_congty", "email", "WHERE email = '".$Email."'");
				if($accountExits == 0){
					if($myprocess->processSignUp($Email, $MatKhau, $tencongty, $quymo_id, $gioithieungan, $diachicongty,$sdthoai,$tinhthanh_id,$post_basic,$trangthai) <> FALSE)
					{
						echo 1;
					}
				}else{
					echo 0;
				}
			}else{
				echo -1;
			}
        break;
		
		case 'newpassword':
		{
			$email = $_POST["email"];
			$maxacnhan = $_POST["maxacnhan"];
			$password = $_POST["password"];
			$repassword = $_POST["repassword"];
			$style = "";
			$_GET['error_message'] = "";
			if(
				empty($email) || 
				empty($maxacnhan) || 
				empty($password)
			){
				$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
				$myObj->status = 1001;
				$myObj->message = "Bạn chưa nhập đủ các trường yêu cầu";
			}else {
				if($core_class->countColumnInTable("trn_congty", "email", "WHERE email='".$email."'") == 0){
					$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
					$myObj->status = 1001;
					$myObj->message = "Địa chỉ email không tồn tại";
				}else{
					if($core_class->countColumnInTable("trn_congty", "password", "WHERE password='".$maxacnhan."' AND email='".$email."'") == 0){
						$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
						$myObj->status = 1001;
						$myObj->message = "Mã xác nhận không đúng";
					}else{
						if(
							strlen($password) < 6 || strlen($password) > 50
						){
							$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
							$myObj->status = 1001;
							$myObj->message = "Mật khẩu phải có từ 6 đến 50 ký tự";
						}else{
							if(
								$password != $repassword
							){
								$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
								$myObj->status = 1001;
								$myObj->message = "Nhập lại mật khẩu không đúng";
							}else if( $maxacnhan == $core_class->enscriptPass($password))
							{
								$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
								$myObj->status = 1001;
								$myObj->message = "Mật khẩu này không cập nhật được";
							}
							else{
								$style = "alert alert-success animated fadeIn no-break-out token-expired-error help-text";
								$myObj->status = 200;
								$myObj->message = "Mật khẩu đã được tạo lại thành công";
								$process = new process();
								$process->updatePassword($email, $password);
								unset($_POST);
							}
						}
					}
				}
			}
			$myJSON = json_encode($myObj);
			echo $myJSON;
		}
		break;
        
        case "login":
            $myprocess = new process;
			$Email = $_POST["email"];
			$MatKhau = $core_class->enscriptPass($_POST["password"]);
			$result = $myprocess->process_login($Email, $MatKhau);
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
		
		case 'forget':
			$email = $_POST["email"];
			$count = $core_class->countColumnInTable("trn_congty", "email", "WHERE email='".$email."'");
			if($count == 0){
				$myObj->status = 1001;
				$myObj->message = "Email không tồn tại";
			}else{
				$myObj->status = 200;
				$myObj->message = "Một email đã được gửi, bạn hãy check mail và làm theo hướng dẫn để lấy lại mật khẩu nhé";
				$makichhoat = $core_class->findValues("trn_congty", "password", array("email" => $email));
				
				$subject = "Hướng dẫn tạo mật khẩu mới tại Y Tế Việc";
				$mailHTML = "Chào ". $email .",<br><br>";
				$mailHTML .= "Đây là email giúp bạn tạo mật khẩu mới cho tài khoản trên Yteviec.com. <br>";
				//$mailHTML .= "<b>Mã xác nhận để tạo lại mật khẩu mới: ".$makichhoat."</b><br>";
				$mailHTML .= "Vui lòng <a target='_blank' href='".$_SERVER['HTTP_HOST']."?page=forget&code=$makichhoat&email=$email'>Click vào đây</a> để tạo mật khẩu mới.<br>";
				$mailHTML .= "<font color=red>Lưu ý: Nếu bạn không gửi yêu cầu đến chúng tôi, vui lòng bỏ qua email này.</font>";

				$mailContent = $core_class->sendMailWithTemplate($subject, $mailHTML);
				$emailTo = $email;
				if(!empty($emailTo)){
					$core_class->smtpSendMailCandidate($subject, $mailContent, $emailTo);
				}
			}
			$myObj->data = array(
				"email" => $email
			);
			$myJSON = json_encode($myObj);
			echo $myJSON;
		break;
		
        default:
            $core_class->_redirect(".");exit();
        break;
    }