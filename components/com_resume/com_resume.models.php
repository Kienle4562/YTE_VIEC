<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }

		public function get_career_cv()
		{
			$sql = "SELECT 
				templatecv_id,
				template_name,
				template_image
			FROM trn_templatecv";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}

		public function get_myprofile()
		{
			$sql = "SELECT * FROM trn_profilecv WHERE career_id = ?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));
		}
		
		public function update_career_cv($content)
		{
			$sql = "UPDATE trn_career SET cv = ?
			WHERE career_id = ?";
			return $this->dbObj->SqlQueryInputResult($sql, array($content, $_SESSION["career"]["career_id"]));
		}
		
		
		
		function noiLamViecMM(){
			$sql = "SELECT id as tinhthanh_id, ten_tinhthanh FROM mst_tinhthanh";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}

		function noiLamViecQH($ten_tinhthanh){
			$sql = "
				SELECT 
					ten_quanhuyen 
				FROM 
					mst_quanhuyen 
					Left Join mst_tinhthanh ON mst_quanhuyen.tinhthanh_id = mst_tinhthanh.id
				WHERE 
					mst_tinhthanh.ten_tinhthanh = ?
			";
			return $this->dbObj->SqlQueryOutputResult($sql, array($ten_tinhthanh));
		}
		
		function getNewProfile(){
			$sql = "SELECT profilecv_id FROM trn_profilecv WHERE career_id = ? Order by profilecv_id desc limit 1";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));
			$row = $result->fetch();
			return $row['profilecv_id'];
		}
		
		function noiLamViecMM_QuanHuyen($tinhthanh_id){
			$sql = "SELECT ten_quanhuyen FROM mst_quanhuyen WHERE tinhthanh_id = ?";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($tinhthanh_id));
			$arrayPush = array();
			while($row = $result->fetch()){
				array_push($arrayPush, $row['ten_quanhuyen']);
			}
			return implode(",", $arrayPush);
		}

		
		function checkTemplate($temp){
			$sql = "SELECT count(templatecv_id) as total FROM trn_templatecv WHERE templatecv_id = ?";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($temp));
			$row = $result->fetch();
			if($row['total'] > 0){
				return true;
			}
			return false;
		}

		function checkProfile($profileId){
			$sql = "SELECT count(profilecv_id) as total FROM trn_profilecv WHERE profilecv_id = ? AND career_id = ?";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($profileId, $_SESSION["career"]["career_id"]));
			$row = $result->fetch();
			if($row['total'] > 0){
				return true;
			}
			return false;
		}
		function checkLimitProfile(){
			$sql = "SELECT count(profilecv_id) as total FROM trn_profilecv WHERE career_id = ? AND trang_thai = 0";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));
			$row = $result->fetch();
			if($row['total'] >= 2){
				return true;
			}
			return false;
		}
		function getThongTinCaNhan($profilecvId){
			$sql = "SELECT
					trn_profilecv.tenprofilecv,
					trn_thongtincanhan.thongtincanhan_id,
					trn_thongtincanhan.fileresume,
					trn_thongtincanhan.profilecv_id,
					trn_thongtincanhan.career_id,
					trn_thongtincanhan.hinhanh,
					trn_thongtincanhan.lastname,
					trn_thongtincanhan.firstname,
					trn_thongtincanhan.gender,
					trn_thongtincanhan.birthday,
					trn_thongtincanhan.mobile,
					trn_thongtincanhan.email,
					trn_thongtincanhan.tinhtranghonnhan,
					trn_thongtincanhan.tinhthanhpho,
					trn_thongtincanhan.diachi,
					trn_thongtincanhan.capbacmongmuon,
					trn_thongtincanhan.mucluong,
					trn_thongtincanhan.hinhthuclamviec,
					trn_thongtincanhan.nganhnghe,
					trn_thongtincanhan.noilamviecmongmuon,
					trn_thongtincanhan.kinhnghiem,
					trn_thongtincanhan.not_experence,
					trn_thongtincanhan.capbachientai,
					trn_thongtincanhan.vitrichucdanh,
					trn_thongtincanhan.kinhnghiemkhac,
					trn_thongtincanhan.congty,
					trn_thongtincanhan.thoigianlamviec,
					trn_thongtincanhan.motacongviec,
					trn_thongtincanhan.bangcapcaonhat,
					trn_thongtincanhan.trinhdongoaingu,
					trn_thongtincanhan.truongkhoahoc,
					trn_thongtincanhan.bangcap,
					trn_thongtincanhan.bangcap1,
					trn_thongtincanhan.bangcap1khac,
					trn_thongtincanhan.bangcap2,
					trn_thongtincanhan.bangcap2khac,
					trn_thongtincanhan.thoigianhoc,
					trn_thongtincanhan.motachitiet,
					trn_thongtincanhan.kynangchuyenmon,
					trn_thongtincanhan.motakynang,
					trn_thongtincanhan.mucdo,
					trn_thongtincanhan.thanhtichnoibat,
					trn_thongtincanhan.tennguoithamkhao,
					trn_thongtincanhan.chucvunguoithamkhao,
					trn_thongtincanhan.congtynguoithamkhao,
					trn_thongtincanhan.dienthoainguoithamkhao,
					trn_thongtincanhan.emailnguoithamkhao,
					trn_thongtincanhan.INSERTDATE,
					trn_thongtincanhan.DELETEDATE
					FROM
					trn_thongtincanhan
					INNER JOIN trn_profilecv ON trn_profilecv.profilecv_id = trn_thongtincanhan.profilecv_id WHERE trn_thongtincanhan.career_id = ? and trn_thongtincanhan.profilecv_id = ?";
			//echo  $profilecvId;
			return $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"], $profilecvId));
		}
    }
	
	if (!empty($_REQUEST['do']))
    {
        switch ($_REQUEST['do'])
        {
			 case 'editcv':
            {
				
			}
            case 'createcv':
            {
				$myprocess = new process();
				$myObj = new \stdClass();
				$myObj->title = "";
                $myObj->message = "";
                $myObj->status = 0;
                $myObj->toastr = "";
				$arrayPost = array(
					'loai_hoso' => 'OFFLINE',
					'career_id' => $_SESSION["career"]["career_id"], // tạo mới
					'hinhanh' => $_POST['hinhanh'],
					'lastname' => $_POST['lastname'],
					'firstname' => $_POST['firstname'],
					'gender' => $_POST['gender'],
					'birthday' => $core_class->_formatdate($_POST['birthday']),
					'mobile' => $_POST['mobile'],
					'email' => $_SESSION['career']['email'],
					'tinhtranghonnhan' => $_POST['tinhtranghonnhan'],
					'diachi' => $_POST['diachi'],
					'tieudehoso' => $_POST['tieudehoso'],
					'capbacmongmuon' => $_POST['capbacmongmuon'],
					'mucluong' => $_POST['mucluong'],
					'hinhthuclamviec' => $_POST['hinhthuclamviec'],
					'nganhnghe' => $_POST['nganhnghe'],
					'noilamviecmongmuon' => $_POST['noilamviecmongmuon'],
				//	'kinhnghiem' => $_POST['kinhnghiem'],
				//	'not_experence' => intval($_POST['not_experence']),
					//'kinhnghiem' => $_POST['kinhnghiem'],
					//'capbachientai' => $_POST['capbachientai'],
				//	'vitrichucdanh' => implode("|", $_POST['vitrichucdanh']),
					
					//'congty' => implode("|", $_POST['congty']),
					//'thoigianlamviec' => implode("|", $_POST['thoigianlamviec']),
					//'motacongviec' => implode("|", $_POST['motacongviec']),
					//'bangcapcaonhat' => $_POST['bangcapcaonhat'],
					'trinhdongoaingu' => $_POST['trinhdongoaingu'],
					'truongkhoahoc' => implode("|", $_POST['truongkhoahoc']),
					'bangcap1' => implode("|", $_POST['bangcap1']),
					'bangcap2' => implode("|", $_POST['bangcap2']),
					'thoigianhoc' => implode("|", $_POST['thoigianhoc']),
					//'kynangchuyenmon' => implode("|", $_POST['kynangchuyenmon']),
					//'motakynang' => implode("|", $_POST['motakynang']),
					//'mucdo' => implode("|", $_POST['mucdo']),
					//	'thanhtichnoibat' => $_POST['thanhtichnoibat'],
					);
					if($myprocess->checkLimitProfile()){
						
						$myObj->status = 0;
						$myObj->message = "Bạn chỉ được tạo tối đa 2 hồ sơ";

					}else{
						if(!empty($_POST['hinhanh']))
						{
						   $flagInsert = $core_class->lastID_insert("trn_thongtincanhan", $arrayPost);
						   if($flagInsert > 0)
							{
								$arrayCreater = array(
									'thongtincanhan_id' =>$flagInsert,
									'career_id' => $_SESSION["career"]["career_id"],
									'tenprofilecv' => $_POST['tieudehoso'],
									'theme_id' => 0,
									'loai_cv' =>'OFFLINE',
									'INSERT_DATE' => date("Y-m-d"),
								);
								$core_class->insert("trn_profilecv", $arrayCreater);
								$myObj->title = "";
								$myObj->message = "Tạo hồ sơ thành công";
								$myObj->status = 1;
							}else 
							{
								$myObj->status = 0;
								$myObj->message = "Đã có lỗi xảy ra";
							}
	   
						}else
						{
						   $myObj->message = "Chưa chọn hình ảnh";
						   $myObj->status = 0;
						}
					}
					 
				   $myJSON = json_encode($myObj);
				   echo $myJSON;
			}
			break;
			
			case 'CheckUploadF':
            {
				$myObj = new \stdClass();
				$myprocess = new process();
				if(!empty($_SESSION["career"])){
					
					if($myprocess->checkLimitProfile()){
						$myObj->status = 0;
						$myObj->message = "Bạn chỉ được tạo tối đa 2 hồ sơ";
					}else{
						$myObj->status = 1;
						$myObj->message = "Chuyển đến trang tạo CV online";
					}
				}else{
					$myObj->status = 0;
					$myObj->message = "Đã có lỗi xảy ra";
				}
				$myJSON = json_encode($myObj);
			    echo $myJSON;
			}
			break;
			case 'upload':
            {
				$allowed =  array('doc','docx','pdf');
				$filename = $_FILES['file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!in_array($ext, $allowed) ) {
					echo -1;
				}else{
					if ( 0 < $_FILES['file']['error'] ) {
						echo 'Error: ' . $_FILES['file']['error'] . '<br>';
					}
					else {
						$folder = 'hosoungvien/resume/'.date("Y_m_d")."/";
						if (!file_exists($folder)) {
							mkdir($folder, 0777, true);
						}
						$filename_ =  strtotime(date("Y-m-d H:i:s"))."_";
						$temp = explode(".", $filename);
						$newfilename = round(microtime(true)). "_". $_FILES['file']['name'];
						move_uploaded_file($_FILES['file']['tmp_name'], $folder . $newfilename);
						echo $folder . $newfilename;
					}
				}
				break;
			}
			
			case 'uploadImage':
				if ( 0 < $_FILES['file']['error'] ) {
					echo 'Error: ' . $_FILES['file']['error'] . '<br>';
				}
				else {
					move_uploaded_file($_FILES['file']['tmp_name'], 'file_upload/career/' . $_FILES['file']['name']);
					$filePath = 'file_upload/career/' . $_FILES['file']['name'];
					$fileArr = explode(".", $_FILES['file']['name']);
					$fileName = 'file_upload/career/resume_image_'.date("Y_m_d").'.'.$fileArr[1];
					$core_class->resize_image('max', $filePath, $fileName, 200,200);
					unlink($filePath);
					echo $fileName;
				}
			break;
        }
    }