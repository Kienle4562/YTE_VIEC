<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
   	class process_dangky
    {
        private $dbObj;        
        function __construct()
        {
            $this->dbObj = new classDb();
        } 
	}
	

    if (!empty($_POST['do']))
    {
        // <--1.1
        switch ($_POST['do'])
        {
            case 'dangky':
            {
				$myObj = new \stdClass();
				$myObj->title = "";
                $myObj->message = "";
                $myObj->status = true;
				$myObj->type = "";
				$myObj->focus = "";
				$arrayPost = array(
					"fullname" => "Bạn chưa nhập họ và tên",
					"email" => "Bạn chưa nhập email",
					//"danhmuccv_id" => "Bạn chưa chọn ngành nghề",
					//"tinhthanh_id" => "Bạn chưa chọn tỉnh thành",
					"password" => "Bạn chưa nhập mật khẩu",
					//"ngaysinh" => "Bạn chưa nhập ngày sinh",
					//"sodienthoai" => "Bạn chưa nhập số điện thoại",
					//"jobstatus_id" => "Bạn chưa chọn trạng thái công việc hiện tại",
					//"chuyenkhoa_id" => "Bạn chưa chọn chuyên khoa",
					//"danhmuccv_id" => "Bạn chưa chọn chuyên ngành",
				);

				$flagPostNotEmpty = true;
				foreach($arrayPost as $key => $value){
					if (empty($_POST[$key])){
						$myObj->title = "Lỗi";
						$myObj->message = $value;
						$myObj->status = false;
						$myObj->type = "warning";
						$myObj->focus = $key;
						$flagPostNotEmpty = false;
						break;
					}
				}
				
				if($flagPostNotEmpty){
					if ($_POST['repassword'] != $_POST['password']){
						$myObj->title = "Lỗi";
						$myObj->message = "Nhập lại mật khẩu không đúng vui lòng thử lại";
						$myObj->status = false;
						$myObj->type = "warning";
						$myObj->focus = "repassword";
					}else if(strlen($_POST['password']) < 6 || strlen($_POST['password']) > 50){
						$myObj->title = "Lỗi";
						$myObj->message = "Mật khẩu có độ dài từ 6 đến 50 ký tự";
						$myObj->status = false;
						$myObj->type = "warning";
						$myObj->focus = "password";
					}else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
						$myObj->title = "Lỗi";
						$myObj->message = "Địa chỉ email không đúng định dạng";
						$myObj->status = false;
						$myObj->type = "warning";
						$myObj->focus = "email";
					//}else if(!preg_match("/^\+?(84|0)(1\d{9}|9\d{8})$/", $_POST['sodienthoai'])){
					///	$myObj->title = "Lỗi";
					//	$myObj->message = "Số điện thoại không đúng định dạng";
					//	$myObj->status = false;
					//	$myObj->type = "warning";
					//	$myObj->focus = "sodienthoai";
					}else{
						$myprocess = new process_dangky();
						$email = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
						$fullname = htmlspecialchars($_POST['fullname'], ENT_QUOTES, "UTF-8");
						$accCount_row = $core_class->countColumnInTable("trn_career", "email", "WHERE email='".$email."'");
						if($accCount_row > 0)
						{
							$myObj->title = "Lỗi";
							$myObj->message = "Địa chỉ email này đã có người sử dụng, bạn hãy chọn một địa chỉ email khác";
							$myObj->status = false;
							$myObj->type = "warning";
							$myObj->focus = "email";
						}else
						{


							$arrayInsert = array(
								"fullname" => htmlspecialchars($_POST['fullname'], ENT_QUOTES, "UTF-8"),
								"password" => md5($_POST['password']),
								"email" => $_POST['email'],
								//"danhmuccv_id" => $_POST['danhmuccv_id'],
								//"tinhthanh_id" => $_POST['tinhthanh_id'],
								//"ngaysinh" => date("Y-m-d", strtotime(str_replace("/", "-", $_POST['ngaysinh']))),
								//"sodienthoai" => $_POST['sodienthoai'],
								//"diachi" => htmlspecialchars($_POST['diachi'], ENT_QUOTES, "UTF-8"),
								// jobstatus_id => 1: sinh viên, 2: đi làm
								//"jobstatus_id" => $_POST['jobstatus_id'],
								//"chuyenkhoa_id" => $_POST['jobstatus_id']  != 1 ? 0 : $_POST['chuyenkhoa_id'],
								//"danhmuccv_id" => $_POST['jobstatus_id']  != 2 ? 4 : $_POST['danhmuccv_id'],
								//"dinhhuong" => htmlspecialchars($_POST['dinhhuong'], ENT_QUOTES, "UTF-8"),
							);

							if ($core_class->insert("trn_career", $arrayInsert)) {
								$_SESSION["career"] = array(
									"career_id" => $core_class->getValueFrom("trn_career", "career_id", "email='".$email."'"),
									"email" => $email,
									"fullname" => $fullname
								);
								$myObj->title = "Đăng ký thành công";
								$myObj->message = "Đăng ký tài khoản thành công";
								$myObj->status = true;
								$myObj->type = "success";
								$myObj->focus = "";
							}else{
								$myObj->title = "Lỗi";
								$myObj->message = "Đã có lỗi xảy ra vui lòng thử lại";
								$myObj->status = false;
								$myObj->type = "warning";
								$myObj->focus = "";
							}
						}
					}
				}
				$myJSON = json_encode($myObj);
			    echo $myJSON;
            }
            break;
        }

        // 1.1-->

    }

    // 1-->