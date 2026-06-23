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
						trn_congty
					Where
						congty_id= ?
			";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["session"]["Id"]));
			return $result;
		}
		function Edit_User($HoTen, $DiDong, $ChungMinhThu, $DiaChi, $tinhthanh_id, $quanhuyen_id, $NgaySinh, $IdUser)
        {	
		    $sql = "Update trn_congty Set
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
		function Check_MatKhau($MatKhauCu, $email)
        {			
		    $sql = " Select password From trn_congty Where password = ? AND email = ?";
            $Result = $this->dbObj->SqlQueryOutputResult($sql, array($MatKhauCu, $email));
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
					  Where Id = ?
				";
            if ($this->dbObj->SqlQueryInputResult($sql, array($MatKhauMoi, $Avatar, $IdUser)) <> FALSE) {
               return true;
            } else {
               return false;
            }
	    }
		function Edit_User_Account_MK($MatKhauMoi, $email)
        {			
		    $sql = " Update trn_congty Set
						password = ?
					  Where email = ?
				";
            if ($this->dbObj->SqlQueryInputResult($sql, array($MatKhauMoi, $email)) <> FALSE) {
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
					Where Id = ?
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
		function updateAvatarProfile($Hinhanh,$idUser){
			$sql = "update trn_congty set hinhanh = ? where congty_id = ?";
			$this->dbObj->SqlQueryInputResult($sql, array($Hinhanh,$idUser));
		}
		function checkPassOld($email, $password){
			$sql = "Select count(*) as 'tongcong' From trn_congty Where email = ? AND password = ?";
            $Result = $this->dbObj->SqlQueryOutputResult($sql, array($email, $password));
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
			$email = $_SESSION["session"]["Tendangnhap"];
			$MatKhauCu = $core_class->enscriptPass($_POST["MatKhauCu"]);
			$MatKhauMoi = $core_class->enscriptPass($_POST["MatKhauMoi"]);
        	if($myprocess->checkPassOld($email, $MatKhauCu)==0){
				echo 0;
			}else{
				$myprocess->Edit_User_Account_MK($MatKhauMoi, $email);
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
			  $myprocess->updateAvatarProfile("file_upload/" . $_FILES["LinkAvatar"]["name"],$IdUser);
			 // echo "Stored in: " . "file_upload/" . $_FILES["LinkAvatar"]["name"]."&&&".$IdUser;
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
			$email			= $_SESSION["session"]["Tendangnhap"];
			$MatKhauCu 		= $core_class->enscriptPass($_POST["MatKhauCu"]);
			$MatKhauMoi		= $_POST["MatKhauMoi"];
			//Tinh chỉnh File Upload
			$CheckMK		= $myprocess->Check_MatKhau($MatKhauCu, $email);
			if($CheckMK == true){
				$Result 	= $myprocess->Edit_User_Account_MK($core_class->enscriptPass($MatKhauMoi), $email);
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