<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
   	class process
    {
        private $dbObj;        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		
		function get_user_edit()
        {
            $sql = "SELECT * FROM trn_career WHERE trn_career.career_id = ?;";
            return $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));
        }

		function get_khuvuc()
        {
            $sql = "SELECT
							khuvuc.id,
							khuvuc.makhuvuc,
							khuvuc.khuvuc
						FROM
							khuvuc
						WHERE khuvuc.trangthai = 1;";
            return $this->dbObj->SqlQueryOutputResult($sql, array());
        }  

		function get_pass_show($id)
        {
            $sql = "SELECT
			khachhang.`passWord`,
			khachhang.Ac_Id
			FROM
			khachhang
			WHERE khachhang.Ac_Id = ?;";
            return $this->dbObj->SqlQueryOutputResult($sql, array($id));
        }
		
		function get_pass($id)
        {
            $sql = "SELECT
						khachhang.`passWord`,
						khachhang.Ac_Id
						FROM
						khachhang
						WHERE khachhang.Ac_Id = ?;";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($id));
            if ($row = $result->fetch()) {
                return $row['passWord'];
            }
        }            

		function edit_user( $fullName, $gioitinh, $address, $phone,$khuvuc, $idaccount){
		    $sql = "Update khachhang Set 
					    `fullName` = ?, 
					    `gioitinh` = ?,  
					    `address` = ?,
						`phone` = ? ,
						`khuvuc` = ? 
				    Where Ac_Id = ?";
		    if($this->dbObj->SqlQueryInputResult($sql, array($fullName, $gioitinh, $address, $phone,$khuvuc, $idaccount)) <> FALSE){
			    return true;
		    }
	    }

		function get_order_detail()
        {
            $sql = "
                SELECT
				trn_congviec.tencongviec,
				trn_congviec.congviec_id,
				trn_congviec.ngayhethan,
				trn_ungtuyen.DISORDER,
				trn_congty.tencongty,
				trn_congty.hinhanh
				FROM
				trn_ungtuyen
				Inner Join trn_congviec ON trn_congviec.congviec_id = trn_ungtuyen.congviec_id
				Inner Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
                WHERE trn_ungtuyen.career_id = ?
            ";
            return $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));
        }

		//edit pass

		function edit_pass($passWord,$idaccount){

		    $sql = "Update khachhang Set 

					    `passWord` = ?

				    Where Ac_Id = ?";

		    if($this->dbObj->SqlQueryInputResult($sql, array($passWord,$idaccount)) <> FALSE){

			    return true;

		    }

	    }

    }
	
    if (!empty($_POST['do']))
    {
        switch ($_POST['do'])
        {
			case "editprofile":
				$arrayPost = array(
					"do" => "",
					"fullname" => "",
					"ngaysinh" => "",
					"gioitinh_id" => "",
					"tinhthanh_id" => "",
					"danhmuccv_id" => "",
					"chuyenkhoa_id" => "",
					"chuyenkhoakhac" => "",
					"sonamkinhnghiem" => "",
					"capbac_id" => "",
					"bangcap_id" => "",
					"ngoaingu" => "",
					"mongmuon_capbac_id" => "",
					"mucluongmongmuon" => "",
					"loaihinhcongviec_id" => "",
					"oldpassword" => "",
					"password" => "",
					"repassword" => "",
				);
				$where = "career_id = ".$_SESSION["career"]["career_id"];

				if(isset($_POST['chuyenkhoa_id'])){
					unset($arrayPost["chuyenkhoakhac"]);
				}else{
					unset($arrayPost["chuyenkhoa_id"]);
				}

				if(!empty($_POST)){
					if(!$core_class->checkKeyPost($arrayPost)){
						echo "Error";
					}else{
						$_POST = array_intersect_key($_POST, $arrayPost);
						$core_class->clearSpecialHtml($arrayPost);
						if(!empty($_POST["oldpassword"]) || !empty($_POST["password"])){
							if($_POST["password"] == $_POST["repassword"]){
								$where_ = "WHERE career_id = ".$_SESSION["career"]["career_id"];
								$where_ .= " AND password = '".md5($_POST["oldpassword"])."'";
								$checkPassword = $core_class->countColumnInTable("trn_career", "password", $where_);
								if($checkPassword > 0){
									if(strlen($_POST["password"]) < 6){
										echo "Mật khẩu của bạn quá ngắn";
									}else{
										unset($_POST["oldpassword"]);
										unset($_POST["repassword"]);
										$_POST["password"] = md5($_POST["password"]);
										$core_class->updateTable("trn_career", $where);
										echo "Cập nhật thành công";
									}
								}else{
									echo "Mật khẩu cũ không đúng";
								}
							}else{
								echo "Nhập lại mật khẩu không đúng";
							}
						}else{
							unset($_POST["password"]);
							unset($_POST["oldpassword"]);
							unset($_POST["repassword"]);
							if(empty($_POST["fullname"])){
								echo "Bạn chưa nhập tên";
							}else if(strlen($_POST["fullname"]) < 6){
								echo "Tên bạn nhập quá ngắn";
							}else{
								$core_class->updateTable("trn_career", $where);
								echo "Cập nhật thành công";
							}
						}
					}
				}
			break;

			case "loadchuyenkhoa":
				$danhmuccvId = $_POST["danhmuccv_id"];
				$danhMucKhac = $core_class->findValues("trn_career", "chuyenkhoakhac", array("career_id" => $_SESSION["career"]['career_id']));
				if($danhmuccvId == "4"){
					$html = '<input type="text" maxlength="250" name="chuyenkhoakhac" class="form-control" value="'.$danhMucKhac.'" required="required">';
					echo $html;
				}else{
					$where = "WHERE danhmuccv_id = " .$danhmuccvId;
					echo $core_class->createSelectBox("mst_chuyenkhoa", "chuyenkhoa_id", "form-control m-bootstrap-select m_selectpicker", $where, $row['chuyenkhoa_id']);
				}
			break;
		}
    }

    // 1-->