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

			$sql = "

				      SELECT * FROM trn_profilecv 

						LEFT JOIN trn_thongtincanhan ON trn_thongtincanhan.profilecv_id = trn_profilecv.profilecv_id

						WHERE trn_profilecv.career_id = ?  AND FIND_IN_SET('0',loai_cv) OR FIND_IN_SET('1',loai_cv) limit 0,2

			";

			

			return $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));

		}

		

		public function get_myprofile_cv_online()

		{

			$sql = "SELECT

						trn_thongtincanhan.capbacmongmuon,

						trn_profilecv.profilecv_id, 

						trn_profilecv.tenprofilecv, 

						trn_thongtincanhan.thongtincanhan_id,

						trn_profilecv.loai_cv,

						trn_profilecv.tim_kiem,

						trn_profilecv.theme_id,

						trn_thongtincanhan.lastname, 

						trn_thongtincanhan.firstname, 

						trn_thongtincanhan.email, 

						trn_thongtincanhan.vitrichucdanh, 

						trn_thongtincanhan.luotxem, 

						trn_profilecv.trang_thai, 

						trn_thongtincanhan.birthday, 

						trn_thongtincanhan.mobile,

						trn_profilecv.INSERT_DATE

		FROM

			trn_profilecv

			INNER JOIN

			trn_thongtincanhan

			ON 

				trn_profilecv.thongtincanhan_id = trn_thongtincanhan.thongtincanhan_id 

				WHERE trn_profilecv.career_id = ? AND trang_thai = 0

			";

			

			return $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));

		}

		

		public function get_myprofile_cv_offline()

		{

			$sql = "

				    SELECT * FROM trn_profilecv 

						LEFT JOIN trn_thongtincanhan ON trn_thongtincanhan.profilecv_id = trn_profilecv.profilecv_id

						WHERE trn_profilecv.career_id = ? AND trn_profilecv.loai_cv = 1 ORDER BY trn_profilecv.profilecv_id DESC LIMIT 1

			";

			

			return $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));

		}

		public function update_career_cv($content)

		{

			$sql = "UPDATE trn_career SET cv = ?

			WHERE career_id = ?";

			return $this->dbObj->SqlQueryInputResult($sql, array($content, $_SESSION["career"]["career_id"]));

		}

		public function update_apply_CV($id_profile)

		{

			$sql = "UPDATE trn_profilecv SET trang_thai = 1

			WHERE profilecv_id = ?";

			return $this->dbObj->SqlQueryInputResult($sql, array($id_profile));

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



		function noiLamViecMM_QuanHuyen($tinhthanh_id){

			$sql = "SELECT ten_quanhuyen FROM mst_quanhuyen WHERE tinhthanh_id = ?";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($tinhthanh_id));

			$arrayPush = array();

			while($row = $result->fetch()){

				array_push($arrayPush, $row['ten_quanhuyen']);

			}

			return implode(",", $arrayPush);

		}

		function getNewProfile(){

			$sql = "SELECT profilecv_id FROM trn_profilecv WHERE career_id = ? Order by profilecv_id desc limit 1";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));

			$row = $result->fetch();

			return $row['profilecv_id'];

		}



		function checkTemplate($temp){

			$sql = "SELECT count(templatecv_id) as total FROM trn_templatecv WHERE templatecv_id = ?";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($temp));

			$row = $result->fetch();

			if($row['total'] > 0){

				return $row['total'];

			}

		}

		function checkmanage(){

			$sql = "SELECT count(profilecv_id) as total FROM trn_profilecv WHERE career_id = ?";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));

			$row = $result->fetch();

			if($row['total'] > 0){

				return true;

			}

			return false;

		}

		function check_redirect_theme(){

			$sql = "SELECT count(profilecv_id) as total FROM trn_profilecv WHERE career_id = ? AND trn_profilecv.tim_kiem = 1 ";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));

			$row = $result->fetch();

			if($row['total'] > 0){

				return true;

			}

			return false;

		}

		function checkProfile($profileId, $career_id){

			$sql = "SELECT count(profilecv_id) as total FROM trn_profilecv WHERE profilecv_id = ? AND career_id = ?";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($profileId, $career_id));

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

		function getThongTinCaNhan(){

			$sql = "SELECT * FROM trn_profilecv

					INNER JOIN

					trn_thongtincanhan

					ON 

					trn_profilecv.thongtincanhan_id = trn_thongtincanhan.thongtincanhan_id 

					WHERE trn_profilecv.career_id = ? AND trn_profilecv.tim_kiem = 1";

			return $this->dbObj->SqlQueryOutputResult($sql, array($_SESSION["career"]["career_id"]));

		}

		function delete_cv($id){

			$sql = "UPDATE trn_profilecv SET trang_thai = 1

			WHERE profilecv_id = ?

			";

			return $this->dbObj->SqlQueryOutputResult($sql, array($id));

		}

		function delete_thongtin($id){

			$sql = "Delete from trn_thongtincanhan where thongtincanhan_id = ?";

			return $this->dbObj->SqlQueryOutputResult($sql, array($id));

		}

		

    }

	if (!empty($_POST['do']))

    {

        switch ($_POST['do'])

        {

            case 'createcv':

            {

				//var_dump($_POST);

				$myObj = new \stdClass();

				$myprocess = new process();

				$myObj->title = "";

                $myObj->message = "";

                $myObj->status = 0;

                $myObj->toastr = "";

				$thanhtichnoibat  = preg_replace("/\r\n|\r|\n/", '<br/>', $_POST['thanhtichnoibat']);

				$muctieunghenghiep  = preg_replace("/\r\n|\r|\n/", '<br/>', $_POST['muctieunghenghiep']);

				$motacongviec  = preg_replace("/\r\n|\r|\n/", '<br/>', $_POST['motacongviec']);

                $arrayPost = array(

					'loai_hoso' => 'ONLINE', // OFFLINE & ONLINE

					'career_id' => $_SESSION["career"]["career_id"],

					'hinhanh' => $_POST['hinhanh'],

                    'lastname' => $_POST['lastname'],

                    'firstname' => $_POST['firstname'],

                    'gender' => $_POST['gender'],

					'birthday' => $core_class->_formatdate($_POST['birthday']),

					'mobile' => $_POST['mobile'],

					'email' => $_POST['email'],

					'tinhtranghonnhan' => $_POST['tinhtranghonnhan'],

					//'tinhthanhpho' => $_POST['tinhthanhpho'],

					'diachi' => $_POST['diachi'],

					'muctieunghenghiep' => $muctieunghenghiep,

					'tieudehoso' => $_POST['tieudehoso'],

					'capbacmongmuon' => $_POST['capbacmongmuon'],

					'mucluong' => $_POST['mucluong'],

					'hinhthuclamviec' => $_POST['hinhthuclamviec'],

					'nganhnghe' => $_POST['nganhnghe'],

					'noilamviecmongmuon' => $_POST['noilamviecmongmuon'],

					'kinhnghiem' => $_POST['kinhnghiem'],

					'not_experence' => intval($_POST['kinh_nghiem_lv']),

					//'capbachientai' => $_POST['capbachientai'],

					'vitrichucdanh' => implode("|", $_POST['vitrichucdanh']),

					'kinhnghiemkhac' => implode("|", $_POST['kinhnghiemkhac']),

					'congty' => implode("|", $_POST['congty']),

					'thoigianlamviec' => implode("|", $_POST['thoigianlamviec']),

					'motacongviec' => implode("|", $motacongviec),

				//	'bangcapcaonhat' => $_POST['bangcapcaonhat'],

					'trinhdongoaingu' => $_POST['trinhdongoaingu'],

					'truongkhoahoc' => implode("|", $_POST['truongkhoahoc']),

					'bangcap1' => implode("|", $_POST['bangcap1']),

					'bangcap2' => implode("|", $_POST['bangcap2']),

					'bangcap1khac' => implode("|", $_POST['bangcap1Khac']),

					'bangcap2khac' => implode("|", $_POST['bangcap2Khac']),

					'thoigianhoc' => implode("|", $_POST['thoigianhoc']),

					//'motachitiet' => implode("|", $_POST['motachitiet']),

					//'kynangchuyenmon' => implode("|", $_POST['kynangchuyenmon']),

					//'motakynang' => implode("|", $_POST['motakynang']),

					//'mucdo' => implode("|", $_POST['mucdo']),

					'thanhtichnoibat' => $thanhtichnoibat,

					//'tennguoithamkhao' => implode("|", $_POST['tennguoithamkhao']),

					//'chucvunguoithamkhao' => implode("|", $_POST['chucvunguoithamkhao']),

					//'congtynguoithamkhao' => implode("|", $_POST['congtynguoithamkhao']),

					//'dienthoainguoithamkhao' => implode("|", $_POST['dienthoainguoithamkhao']),

					//'emailnguoithamkhao' => implode("|", $_POST['emailnguoithamkhao']),

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

								'tenprofilecv' => $_POST['capbacmongmuon'],

								'theme_id' => 0,

								'loai_cv' =>'ONLINE',

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

			case 'editcv':

		    //	var_dump($_POST);

		    	$myObj = new \stdClass();

				$myObj->title = "";

                $myObj->message = "";

                $myObj->status = 0;

                $myObj->toastr = "";

				$thanhtichnoibat  = preg_replace("/\r\n|\r|\n/", '<br/>', $_POST['thanhtichnoibat']);

				$muctieunghenghiep  = preg_replace("/\r\n|\r|\n/", '<br/>', $_POST['muctieunghenghiep']);

				$motacongviec  = preg_replace("/\r\n|\r|\n/", '<br/>', $_POST['motacongviec']);

               

				if($_POST['loai_hoso'] == 'OFFLINE')

				{

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

						'trinhdongoaingu' => $_POST['trinhdongoaingu'],

						'truongkhoahoc' => implode("|", $_POST['truongkhoahoc']),

						'bangcap1' => implode("|", $_POST['bangcap1']),

						'bangcap2' => implode("|", $_POST['bangcap2']),

						'thoigianhoc' => implode("|", $_POST['thoigianhoc']),

						);

				}else{

					$arrayPost = array(

						'career_id' => $_SESSION["career"]["career_id"],

						'hinhanh' => $_POST['hinhanh'],

						'lastname' => $_POST['lastname'],

						'firstname' => $_POST['firstname'],

						'gender' => $_POST['gender'],

						'birthday' => $core_class->_formatdate($_POST['birthday']),

						'mobile' => $_POST['mobile'],

						'email' => $_POST['email'],

						'tinhtranghonnhan' => $_POST['tinhtranghonnhan'],

						//'tinhthanhpho' => $_POST['tinhthanhpho'],

						'diachi' => $_POST['diachi'],

						'muctieunghenghiep' => $muctieunghenghiep,

						'tieudehoso' => $_POST['tieudehoso'],

						'capbacmongmuon' => $_POST['capbacmongmuon'],

						'mucluong' => $_POST['mucluong'],

						'hinhthuclamviec' => $_POST['hinhthuclamviec'],

						'nganhnghe' => $_POST['nganhnghe'],

						'noilamviecmongmuon' => $_POST['noilamviecmongmuon'],

						'kinhnghiem' => $_POST['kinhnghiem'],

						'not_experence' => intval($_POST['not_experence']),

						//'capbachientai' => $_POST['capbachientai'],

						'vitrichucdanh' => implode("|", $_POST['vitrichucdanh']),

						'kinhnghiemkhac' => implode("|", $_POST['kinhnghiemkhac']),

						'congty' => implode("|", $_POST['congty']),

						'thoigianlamviec' => implode("|", $_POST['thoigianlamviec']),

						'motacongviec' => implode("|", $motacongviec),

					//	'bangcapcaonhat' => $_POST['bangcapcaonhat'],

						'trinhdongoaingu' => $_POST['trinhdongoaingu'],

						'truongkhoahoc' => implode("|", $_POST['truongkhoahoc']),

						'bangcap1' => implode("|", $_POST['bangcap1']),

						'bangcap2' => implode("|", $_POST['bangcap2']),

						'bangcap1khac' => implode("|", $_POST['bangcap1Khac']),

						'bangcap2khac' => implode("|", $_POST['bangcap2Khac']),

						'thoigianhoc' => implode("|", $_POST['thoigianhoc']),

						//'motachitiet' => implode("|", $_POST['motachitiet']),

						//'kynangchuyenmon' => implode("|", $_POST['kynangchuyenmon']),

						//'motakynang' => implode("|", $_POST['motakynang']),

						//'mucdo' => implode("|", $_POST['mucdo']),

						'thanhtichnoibat' => $thanhtichnoibat,

						//'tennguoithamkhao' => implode("|", $_POST['tennguoithamkhao']),

						//'chucvunguoithamkhao' => implode("|", $_POST['chucvunguoithamkhao']),

						//'congtynguoithamkhao' => implode("|", $_POST['congtynguoithamkhao']),

						//'dienthoainguoithamkhao' => implode("|", $_POST['dienthoainguoithamkhao']),

						//'emailnguoithamkhao' => implode("|", $_POST['emailnguoithamkhao']),

					);

				}

				if(!empty($_POST['thongtincanhan_id'])){

					$core_class->update("trn_thongtincanhan", $arrayPost, array('thongtincanhan_id' => $_POST['thongtincanhan_id']));

					$core_class->update("trn_profilecv", array(

						'tenprofilecv' => $_POST['capbacmongmuon'],

						'INSERT_DATE' => date("Y-m-d")

					), array(

						'profilecv_id' => $_POST['profilecv_id']

					)); 

					$myObj->title = "";

					$myObj->message = "Cập nhật hồ sơ thành công";

					$myObj->status = 1;

				}else

				{

					$myObj->status = 0;

					$myObj->message = "Đã có lỗi xảy ra";

				}

				$myJSON = json_encode($myObj);

			    echo $myJSON;

			break;

			case 'createprofile':

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

			case 'delete-cv':

				{

					$myObj = new \stdClass();

					$myprocess = new process();

					$idTT = $_POST['idTT'];

					$profileID = $_POST['profileID'];

					if($myprocess->delete_cv($profileID)){

						

							$myObj->status = 0;

							$myObj->message = "Đã xóa CV";

						

					

					}else{

						$myObj->status = 1;

						$myObj->message = "Xóa CV không thảnh công";

					}



					$myJSON = json_encode($myObj);

			   	    echo $myJSON;

				}

			break;

			case 'checkApply':

				$myObj = new \stdClass();

				$myprocess = new process();

				$errorFlag = $core_class->update("trn_profilecv", array(

					'tim_kiem' => 0 //0: không cho phép tìm kiếm

				), array(

					'career_id' => $_SESSION["career"]["career_id"]

				));

				if($errorFlag){

					$updateOK = $core_class->update("trn_profilecv", array(

					'tim_kiem' => 1 // 0: cho phép tìm kiếm

					), array(

						'profilecv_id' => $_POST['trangthai'][0]

					));

					if($updateOK)

					{

						$myObj->status = 1;

						$myObj->message = 'Cập nhật thành công';

					}

				}else{

					

					$myObj->status = 0;

					$myObj->message = "Đã có lỗi xảy ra";

				}

				$myJSON = json_encode($myObj);

			    echo $myJSON;

			break;

			case 'theme-cv':

				{

				

					$myObj = new \stdClass();

					$myprocess = new process();

					$totalRow = $myprocess->check_redirect_theme();

					if($totalRow > 0)

					{

						$myObj->status = 1;

						$myObj->message = "Chuyển đến trang tạo CV online";

					}else

					{

						$myObj->status = 0;

						$myObj->message = "Tạo hồ sơ trước hoặc nếu đã có hãy chọn 1 hồ sơ tìm kiếm";

					}

					$myJSON = json_encode($myObj);

					echo $myJSON;

				}

			break;	

			case 'applytheme':

				//var_dump($_POST);

				$myObj = new \stdClass();

				$myprocess = new process();

				$errorFlag = $core_class->update("trn_profilecv", array(

					'theme_id' => $_POST['themeID'],

					'INSERT_THEME' => date("Y-m-d")

				), array(

					'career_id' => $_SESSION["career"]["career_id"],

					'tim_kiem' => 1,

					'loai_cv' => 'ONLINE',

				)); 

				if($errorFlag)

				{

					$myObj->status = 1;

					$myObj->message = "Cập nhật theme thành công";

				}else

				{

					$myObj->status = 0;

					$myObj->message = "Lỗi cập nhật";

				}

				$myJSON = json_encode($myObj);

				echo $myJSON;

			break;	

			case 'preview':

		       include("components/com_createcv/template/".$_GET['idTheme']."/index.php");

			break;



			case 'download':

				include("components/com_createcv/template/".$_REQUEST['temp']."/index.php");

			break;

        }

    }