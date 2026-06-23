<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php"));

   	class process

	{

		private $dbObj;        

		function __construct()

		{

			$this->dbObj = new classDb();

		}

		function get_career($careerId)

		{

			$sql = "

						SELECT 

						CONCAT(ttcn.firstname,' ',ttcn.lastname) as fullname,

						ttcn.thongtincanhan_id,

						ttcn.nganhnghe,

						ttcn.birthday,

						ttcn.gender,

						ttcn.tinhtranghonnhan,

						ttcn.diachi,

						ttcn.hinhanh,

						ttcn.vitrichucdanh,

						ttcn.congty,

						ttcn.thoigianlamviec,

						ttcn.bangcap1,

						ttcn.tinhthanhpho,

						ttcn.kinhnghiem,

						ttcn.capbachientai,

						ttcn.capbacmongmuon,

						ttcn.noilamviecmongmuon,

						ttcn.trinhdongoaingu,

						ttcn.hinhthuclamviec,

						ttcn.mucluong,

						trn_profilecv.profilecv_id,

						ttcn.INSERTDATE,

						trn_profilecv.theme_id

				FROM

				trn_profilecv

						INNER JOIN trn_thongtincanhan  ttcn ON trn_profilecv.thongtincanhan_id = ttcn.thongtincanhan_id

					WHERE ttcn.thongtincanhan_id = ? AND trn_profilecv.tim_kiem = 1";

			return $this->dbObj->SqlQueryOutputResult($sql, array($careerId));

		}

		function updatePoint($point,$id_cty)

          {	

		    $sql = "Update trn_congty Set

						point_activer = point_activer - ?

					  WHERE trn_congty.congty_id = ? ";

            if ($this->dbObj->SqlQueryInputResult($sql,array($point,$id_cty))<> FALSE) 

				{

				   return true;

				} else {

				   return false;

				}

			}

		function check_info_ntd($idntd)

		{

			$sql = "SELECT

						trn_congty.congty_id, 

						trn_congty.tencongty, 

						trn_congty.email, 

						trn_customer.customer_id, 

						trn_customer.ma_don_hang, 

						trn_customer_detail.ngay_het_han, 

						trn_congty.point_activer

					FROM

						trn_congty

						INNER JOIN

						trn_customer

						ON 

							trn_congty.congty_id = trn_customer.congty_id

						INNER JOIN

						trn_customer_detail

						ON 

							trn_customer.customer_id = trn_customer_detail.customer_id

							WHERE name_function = 'search_cv' AND trn_congty.congty_id = ? ORDER BY ngay_het_han DESC Limit 0,1";

			return $this->dbObj->SqlQueryOutputResult($sql, array($idntd));

		}



		function check_redirect_theme($id){

			$sql = "SELECT count(profilecv_id) as total FROM trn_viewcv WHERE profilecv_id = ? ";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($id));

			$row = $result->fetch();

			if($row['total'] > 0){

				return true;

			}

			return false;

		}

		function check_da_xem($id){

			$sql = "SELECT count(Id_viewcv) as total FROM trn_viewcv WHERE congty_id = ? ";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($id));

			$row = $result->fetch();

			if($row['total'] > 0){

				return true;

			}

			return false;

		}

		

		function getThongTinCaNhan($id){

			$sql = "SELECT * FROM trn_profilecv

					INNER JOIN

					trn_thongtincanhan

					ON 

					trn_profilecv.thongtincanhan_id = trn_thongtincanhan.thongtincanhan_id 

					WHERE trn_profilecv.profilecv_id =  ? AND trn_profilecv.tim_kiem = 1";

			return $this->dbObj->SqlQueryOutputResult($sql, array($id));

		}

		// Lấy trạng thái trong bảng trn_viewcv để kiểm tra xem CV đó đã dc xem chưa
		function get_trangthai()
		{
			$sql = " SELECT trn_viewcv.profilecv_id, trn_viewcv.congty_id, trn_viewcv.trang_thai, trn_congty.congty_id from trn_viewcv join trn_congty on trn_viewcv.congty_id = trn_congty.congty_id ";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}

		public function get_list_career()

		{

			$sql = "

				SELECT

						trn_profilecv.career_id,

						trn_profilecv.tenprofilecv,

						ttcn.thongtincanhan_id,

						ttcn.fileresume,

						ttcn.hinhanh,

						CONCAT(ttcn.lastname,' ',ttcn.firstname) as fullname,

						ttcn.gender,

						ttcn.email,

						ttcn.birthday,

						ttcn.mobile,

						ttcn.diachi,

						ttcn.noilamviecmongmuon,

						ttcn.bangcap1,

						ttcn.tinhtranghonnhan,

						ttcn.INSERTDATE

					FROM

						trn_profilecv

					INNER JOIN trn_thongtincanhan  ttcn ON trn_profilecv.thongtincanhan_id = ttcn.thongtincanhan_id

						WHERE trn_profilecv.tim_kiem = 1 {$condition} LIMIT 10;

			";

			return $this->dbObj->SqlQueryOutputResult($sql, array());

		}

	}

	

	if (!empty($_REQUEST['do']))

	{

		switch ($_REQUEST['do'])

		{

			case 'viewInfo':

				$myObj = new \stdClass();

				$myprocess = new process();

				$totalRow = $myprocess->check_redirect_theme($_POST['IDinfo']);

				if($totalRow > 0)

					{

						$myObj->status = 1;

						$myObj->message = "Opending...";

						

					}else

					{

						$Arrayviewcv = array(

							'congty_id' =>$_SESSION["session"]["Id"],

							'profilecv_id' =>$_POST['IDinfo'],

							'full_name' => $_SESSION["session"]["tencongty"],

							'sodienthoai' => $_SESSION["session"]["sdthoai"],

							'email' =>$_SESSION["session"]["Tendangnhap"],

							'point' =>3,

							'trang_thai' => 0,

							//'action_code' =>'',

							'INSERT_DATE' => date('Y-m-d H:i:s')

						);

						if($core_class->insert("trn_viewcv", $Arrayviewcv))

						{

							$point = 3;

							$updatePoint = $myprocess->updatePoint($point,$_SESSION["session"]["Id"]);

							$myObj->status = 1;

							$myObj->message = "Opending...";



						}else

						{

							$myObj->status = 0;

							$myObj->message = "Lỗi xem CV";

						}



					}

				$myJSON = json_encode($myObj);

			    echo $myJSON;

			break;

			case 'viewCV':

				$idtheme = intval($_GET['idTheme']);

				if($idtheme == 0)

				{

					$idtheme = 5;

				}

				 include("components/com_career/template/".$idtheme."/index.php");

			 break;

			

		}

	}



	// 1-->