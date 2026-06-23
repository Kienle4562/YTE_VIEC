<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
   	class process_dangky
    {
        private $dbObj;        
        function __construct()
        {
            $this->dbObj = new classDb();
        }        
        public function add_career($fullname, $email, $password, $danhmuccv_id, $tinhthanh_id)
        {
            return $this->dbObj->SqlQueryInputResult(
                "INSERT INTO 
                        trn_career (fullname, email, password, danhmuccv_id, tinhthanh_id)
                        VALUES (?,?,?,?,?)", 
                array($fullname, $email, $password, $danhmuccv_id, $tinhthanh_id)
            );
        }
		
		public function updatePassword($email, $password)
        {
            return $this->dbObj->SqlQueryInputResult(
                "UPDATE trn_career 
                        SET password = ?
				WHERE email = ?", 
                array(md5($password), $email)
            );
        }
    }
    if (!empty($_POST['do']))
    {
        // <--1.1
        switch ($_POST['do'])
        {
            case 'forgot':
            {
				$email = $_POST["email"];
				$count = $core_class->countColumnInTable("trn_career", "email", "WHERE email='".$email."'");
				if($count == 0){
					$myObj->status = 1001;
					$myObj->message = "Email không tồn tại";
				}else{
					$myObj->status = 200;
					$myObj->message = "Sent mail";
					$makichhoat = $core_class->getValueFrom("trn_career", "password", "email='".$email."'");
					$subject = "Hướng dẫn tạo mật khẩu mới tại Y Tế Việc";
					$mailHTML = "Chào ". $email .",<br><br>";
					$mailHTML .= "Đây là email giúp bạn tạo mật khẩu mới cho tài khoản trên Yteviec.com. <br>";
					//$mailHTML .= "<b>Mã xác nhận để tạo lại mật khẩu mới: ".$makichhoat."</b><br>";
					$mailHTML .= "Vui lòng <a target='_blank' href='".$_SERVER['HTTP_HOST']."/forgot.html?code=$makichhoat&email=$email'>Click vào đây</a> để tạo mật khẩu mới.<br>";
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
            }
            break;
			
			case 'newpassword':
            {
				$email = $_POST["frmemail"];
				$maxacnhan = $_POST["forgot"];
				$password = $_POST["frmpassword"];
				$repassword = $_POST["frmrepassword"];
				$style = "";
				$_GET['error_message'] = "";
				if(
					empty($email) || 
					empty($maxacnhan) || 
					empty($password)
				){
					$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
					$_GET['error_message'] = "Bạn chưa nhập đủ các trường yêu cầu";
				}else {
					if($core_class->countColumnInTable("trn_career", "email", "WHERE email='".$email."'") == 0){
						$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
						$_GET['error_message'] = "Địa chỉ email không tồn tại";
					}else{
						if($core_class->countColumnInTable("trn_career", "password", "WHERE password='".$maxacnhan."' AND email='".$email."'") == 0){
							$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
							$_GET['error_message'] = "Mã xác nhận không đúng";
						}else{
							if(
								strlen($password) < 6 || strlen($password) > 50
							){
								$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
								$_GET['error_message'] = "Mật khẩu phải có từ 6 đến 50 ký tự";
							}else{
								if(
									$password != $repassword
								){
									$style = "alert alert-danger animated fadeIn no-break-out token-expired-error help-text";
									$_GET['error_message'] = "Nhập lại mật khẩu không đúng";
								}else{
									$style = "alert alert-success animated fadeIn no-break-out token-expired-error help-text";
									$_GET['error_message'] = "Mật khẩu đã được tạo lại thành công";
									$process = new process_dangky();
									$process->updatePassword($email, $password);
									unset($_POST);
								}
							}
						}
					}
				}
            }
            break;
        }

        // 1.1-->

    }

    // 1-->