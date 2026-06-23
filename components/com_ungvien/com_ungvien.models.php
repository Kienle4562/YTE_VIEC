<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );



    class process

    {

        public $dbObj;

        

        function __construct()

        {

            $this->dbObj = new classDb();

        }

		

		function getDanhmuccv(){

		    $sql = "SELECT * FROM trn_danhmuccv ORDER BY DISORDER";

		    $result = $this->dbObj->SqlQueryOutputResult($sql, array());

		    return $result;

		}



		function getChuyenKhoa($danhmucId){

		    $sql = "SELECT * FROM mst_chuyenkhoa WHERE danhmuccv_id = ?";

		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($danhmucId));

		    return $result;

	    }



		function get_boloc($id_cty){

		    $sql = "SELECT

						trn_congty.congty_id, 

						trn_congty.bo_loc

					FROM

						trn_congty

						WHERE  trn_congty.congty_id = ?";

		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($id_cty));

		    return $result;

	    }

		function getTinhThanh(){

		    $sql = "SELECT * FROM mst_tinhthanh ORDER BY DISORDER DESC";

		    $result = $this->dbObj->SqlQueryOutputResult($sql, array());

		    return $result;

	    }

        function update_fillter($bo_loc,$Id_cty){

		    $sql = "Update trn_congty Set 

					    `bo_loc` = ? 

				    Where congty_id = ?";

		    if($this->dbObj->SqlQueryInputResult($sql, array($bo_loc,$Id_cty)) <> FALSE){

			    return true;

		    }

	    }


		public function test()
		{
			$sqlTest = "SELECT * from mst_tinhthanh";
			return $this->dbObj->SqlQueryOutputResult($sqlTest, array());
		}

        public function get_list_career($condition, $offset, $limit)

		{

		$sql = "

				SELECT

						trn_profilecv.career_id,

						trn_profilecv.tenprofilecv,

						trn_profilecv.tim_kiem,

						ttcn.thongtincanhan_id,

						ttcn.fileresume,

						ttcn.hinhanh,

						CONCAT(ttcn.lastname,' ',ttcn.firstname) as fullname,

						ttcn.gender,

						ttcn.email,

						ttcn.birthday,

						ttcn.mobile,

						ttcn.diachi,

						ttcn.trinhdongoaingu,

						ttcn.vitrichucdanh,

						ttcn.kinhnghiem,

						ttcn.noilamviecmongmuon,

						ttcn.bangcap1,

						ttcn.capbacmongmuon,

						ttcn.tinhtranghonnhan,

						ttcn.INSERTDATE

					FROM

						trn_profilecv

					INNER JOIN trn_thongtincanhan ttcn ON trn_profilecv.thongtincanhan_id = ttcn.thongtincanhan_id

						WHERE trn_profilecv.tim_kiem = 1 {$condition} LIMIT $offset, $limit;

			";

			return $this->dbObj->SqlQueryOutputResult($sql, array());

		}

		public function count_cv_tim_kiem()

		{

			$sql = "SELECT

				count(1) as tongcong

			FROM

			trn_profilecv 

			WHERE tim_kiem= 1";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array());

			$row = $result->fetch();

			return $row["tongcong"];

		}



		public function get_career_count($condition)

		{

			$sql = "SELECT

				count(1) as tongcong

			FROM  

				trn_profilecv

		    INNER JOIN trn_thongtincanhan  ttcn ON trn_profilecv.thongtincanhan_id = ttcn.thongtincanhan_id

			WHERE 1=1 {$condition}";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array());

			$row = $result->fetch();

			return $row["tongcong"];

		}

		public function get_test()
		{
			# code...
		}

    }

	

	if (!empty($_REQUEST['do']))

	{

	
		switch ($_REQUEST['do'])

		{

			case 'setup-fillter':

			   // var_dump($_POST);

				$myprocess = new process;

				$myObj = new \stdClass();

				parse_str($_POST['data'], $output);

		    	$fillter = array(

					// 'type_money'     => $output['type_money'],

				  	// 'muc_luong_tu'   => $output['muc_luong_tu'],

				 	// 'muc_luong_den'  => $output['muc_luong_den'],

				    'kinhnghiem_tu'  => $output['kinhnghiem_tu'],

				    'kinhnghiem_den' => $output['kinhnghiem_den'],

				    // 'trinhdonn'      => $output['trinhdonn'],

					'gender'         => $output['gender'],

					// 'tuoi_tu'        => $output['tuoi_tu'],

					// 'tuoi_den'       => $output['tuoi_den']

				);

				$fillter = serialize($fillter);

				//echo $fillter;

				if($myprocess->update_fillter($fillter,$_SESSION["session"]["Id"]) <> FALSE)

            	{

					$myObj->status = 1;

					$myObj->message = "Update thành công !!!";

           		}else {

						$myObj->status = 0;

						$myObj->message = "Update lỗi !!!";

          	  		  }

				$myJSON = json_encode($myObj);

				echo $myJSON;

			break;

		}

	}