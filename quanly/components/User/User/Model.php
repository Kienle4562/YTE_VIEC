<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		public function load_land_tinhthanh()
		{
			$sql = "SELECT
						id,
						ten_tinhthanh
					FROM
						MST_tinhthanh";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array( 0 ));
			return $result;
		}
		function info_User(){
			$sql = "
					Select
						*
					From
						taikhoan
					Where
						taikhoan_id = ?
			";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["session"]["taikhoan_id"]));
			return $result;
		}
		function Edit_User($HoTen, $DiDong, $ChungMinhThu, $DiaChi, $tinhthanh_id, $quanhuyen_id, $NgaySinh, $IdUser)
        {	
		    $sql = "Update taikhoan Set
						Hoten = ?,
						Didong = ?,
						Cmnd = ?,
						tinhthanh_id = ?,
						quanhuyen_id = ?,
						Diachi = ?,
						Ngaysinh = ?
					  Where taikhoan_id = ?
				";
            if ($this->dbObj->SqlQueryInputResult($sql, array($HoTen, $DiDong, $ChungMinhThu, $DiaChi, $tinhthanh_id, $quanhuyen_id, $NgaySinh, $IdUser)) <> FALSE) {
               return true;
            } else {
               return false;
            }
	    }
		function Check_MatKhau($MatKhauCu, $IdUser)
        {			
		    $sql = " Select Matkhau From taikhoan Where Matkhau = ? AND taikhoan_id = ?";
            $Result = $this->dbObj->SqlQueryOutputResult($sql, array($MatKhauCu, $IdUser));
			if ($Result->fetch())
            {
				return true;
			} else {
				return false;
			}
	    }
		function Edit_User_Account_All($MatKhauMoi, $Avatar, $IdUser)
        {			
		    $sql = " Update taikhoan Set
						Matkhau = ?,
						Hinhanh = ?
					  Where taikhoan_id = ?
				";
            if ($this->dbObj->SqlQueryInputResult($sql, array($MatKhauMoi, $Avatar, $IdUser)) <> FALSE) {
               return true;
            } else {
               return false;
            }
	    }
		function Edit_User_Account_MK($MatKhauMoi, $IdUser)
        {			
		    $sql = " Update taikhoan Set
						Matkhau = ?
					  Where taikhoan_id = ?
				";
            if ($this->dbObj->SqlQueryInputResult($sql, array($MatKhauMoi, $IdUser)) <> FALSE) {
               return true;
            } else {
               return false;
            }
	    }
		function updatetamtrang($tamtrang, $IdUser)
        {			
		    $sql = "
					Update taikhoan Set
						Camxuc = ?
					Where taikhoan_id = ?
				   ";
           $this->dbObj->SqlQueryInputResult($sql, array($tamtrang, $IdUser));
	    }
		function Edit_User_Account_Ava($Avatar, $IdUser)
        {			
		    $sql = " Update taikhoan Set
						Hinhanh = ?
					  Where taikhoan_id = ?
				";
            if ($this->dbObj->SqlQueryInputResult($sql, array($Avatar, $IdUser)) <> FALSE) {
               return true;
            } else {
               return false;
            }
	    }
		function updateAvatarProfile($idUser, $Hinhanh){
			$sql = "update taikhoan set Hinhanh = ? where taikhoan_id = ?";
			$this->dbObj->SqlQueryInputResult($sql, array($Hinhanh, $idUser));
		}
		function checkPassOld($IdUser, $MatKhau){
			$sql = "Select count(*) as 'tongcong' From taikhoan Where taikhoan_id = ? AND Matkhau = ?";
            $Result = $this->dbObj->SqlQueryOutputResult($sql, array($IdUser, $MatKhau));
			$row = $Result->fetch();
			return $row["tongcong"];
		}
    }
    
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch(@$_POST["act"]){

        case "";
        	//Action rỗng thì không làm zì cả
        break;
		
		case "dangtamtrang";
			$myprocess		= new process();
			$IdUser = $_SESSION["session"]["Id"];
			$tamtrang = $_POST["tamtrang"];
			if($tamtrang==""){
				$tamtrang = "Whats in your mind today?";
			}
			$myprocess->updatetamtrang($tamtrang, $IdUser);
        break;
		
		case "changepass";
			$myprocess		= new process();
			$IdUser = $_SESSION["session"]["Id"];
			$MatKhauCu = $core_class->enscriptPass($_POST["MatKhauCu"]);
			$MatKhauMoi = $core_class->enscriptPass($_POST["MatKhauMoi"]);
        	if($myprocess->checkPassOld($IdUser, $MatKhauCu)==0){
				echo 0;
			}else{
				$myprocess->Edit_User_Account_MK($MatKhauMoi, $IdUser);
				echo 1;
			}
        break;
		
		case "UploadAvatarProfile";
			$myprocess		= new process();
			if ($_FILES["LinkAvatar"]["error"] > 0) {
			  echo "Error: " . $_FILES["LinkAvatar"]["error"] . "<br>";
			}
			else {
			  echo "Upload: " . $_FILES["LinkAvatar"]["name"] . "<br>";
			  echo "Type: " . $_FILES["LinkAvatar"]["type"] . "<br>";
			  echo "Size: " . ($_FILES["LinkAvatar"]["size"] / 1024) . " kB<br>";
			  echo "Stored in: " . $_FILES["LinkAvatar"]["tmp_name"];
			  // Save file
			  move_uploaded_file($_FILES["LinkAvatar"]["tmp_name"], "file_upload/" . $_FILES["LinkAvatar"]["name"]);
			  $IdUser = $_SESSION["session"]["Id"];
			  $myprocess->updateAvatarProfile($IdUser,"file_upload/" . $_FILES["LinkAvatar"]["name"]);
			  echo "Stored in: " . "file_upload/" . $_FILES["LinkAvatar"]["name"];
			}
			
		break;
    	
		case "ProcessEditProfile";
			$myprocess = new process();
			$IdUser			= $_SESSION["session"]["Id"];
			$Hoten 			= $_POST["Hoten"];
			$Didong 		= $_POST["Didong"];
			$Diachi			= $_POST["Diachi"];
			$NgaySinh 		= $core_class->_formatdate($_POST["Ngaysinh"]);
			$Cmnd 			= $_POST["Cmnd"];
			$tinhthanh 		= $_POST["tinhthanh"];
			$quanhuyen 		= $_POST["quanhuyen"];
			$Result = $myprocess->Edit_User($Hoten, $Didong, $Cmnd, $tinhthanh, $quanhuyen, $Diachi, $NgaySinh, $IdUser);
			if($Result == true){
				echo "0";
			}else{
				echo "1";
			}
        break;
		
		case "EditAccount";
			$myprocess		= new process();
			$IdUser			= $_SESSION["session"]["Id"];
			$MatKhauCu 		= $core_class->enscriptPass($_POST["MatKhauCu"]);
			$MatKhauMoi		= $_POST["MatKhauMoi"];
			$Avatar			= $_POST["AnhDaiDien"];
			//Tinh chỉnh File Upload

			
			
			
			$CheckMK		= $myprocess->Check_MatKhau($MatKhauCu, $IdUser);
			if($CheckMK == true){
				//Cập nhật cả Mật khẩu & Ảnh đại diện
				if($MatKhauMoi != "" && $Avatar != ""){	
					$Result 	= $myprocess->Edit_User_Account_All($core_class->enscriptPass($MatKhauMoi), $Avatar, $IdUser);
				//Chỉ cập nhật Mật khẩu
				}else if($MatKhauMoi != "" && $Avatar == ""){
					$Result 	= $myprocess->Edit_User_Account_MK($core_class->enscriptPass($MatKhauMoi), $IdUser);
				//Chỉ cập nhật Ảnh đại diện
				}else if($Avatar != "" && $MatKhauMoi == ""){
					$Result 	= $myprocess->Edit_User_Account_Ava($Avatar, $IdUser);
				}		
				if($Result == true){
					echo "0";
				}else{
					echo "1";
				}
			}else{
				echo "2";
			}
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }