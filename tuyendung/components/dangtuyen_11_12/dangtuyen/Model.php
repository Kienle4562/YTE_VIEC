<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
		}
		
		// load quoc tich
		public function loadTinhThanh(){
			$sql = "SELECT
						ten_tinhthanh
					FROM
						mst_tinhthanh";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		
		public function get_dichvu(){
			$sql = "SELECT
							trn_customer_detail.customer_id,
							trn_customer_detail.customer_detail_id,
							trn_customer_detail.function_id,
							trn_customer_detail.service_id,
							SUM(qty) as qty,
							trn_customer_detail.qty_ext,
							trn_customer.expiry_date,
							trn_customer.`status`,
							trn_customer.congty_id,
							trn_function.attrib_function
						FROM
							trn_customer
						INNER JOIN trn_customer_detail ON trn_customer.customer_id = trn_customer_detail.customer_id
						INNER JOIN trn_function ON trn_customer_detail.function_id = trn_function.id_function
						WHERE
							trn_customer.expiry_date >= '".date('Y-m-d')."' AND
							trn_customer.congty_id = '".$_SESSION['session']['Id']."' AND
							trn_customer.`status` = 1 AND trn_customer_detail.`trang_thai` = 1 AND trn_function.type_function = 'job' AND trn_customer.expiry_date > SYSDATE() GROUP BY attrib_function";
				//echo $sql;		
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		
		 public function get_job_list($id_session){
			$sql = "SELECT
						trn_congviec.congviec_id, 
						trn_congviec.tencongviec, 
						trn_congviec.search_key,	
						trn_congviec.congty_id, 
						trn_congviec.loaihinhcongviec_id, 
						trn_congviec.noilamviec, 
						trn_congviec.luotxem, 
						DATE_FORMAT(ngaydang, '%d/%m/%Y') as ngaydang,
						DATE_FORMAT(ngayhethan, '%d/%m/%Y') as ngayhethan,
						trn_congviec.trangthai,
						trn_congviec.draft_stt,	
						trn_congviec.power_job, 
						trn_congviec.hot_job, 
						trn_congviec.post_basic, 
						trn_congviec.DISORDER
					FROM
						trn_congviec WHERE trn_congviec.congty_id = ? AND trn_congviec.DELETE_FLG = 0";
				//echo $sql;		
			return $this->dbObj->SqlQueryOutputResult($sql, array($id_session));
		}
		
		function getIDtinhthanh($tentinh){
			$sql = "SELECT
						mst_tinhthanh.ten_tinhthanh,
						mst_tinhthanh.id
					FROM
						mst_tinhthanh
					WHERE ten_tinhthanh LIKE '%$tentinh%'";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		
		function getCVApply($idCV){
			$sql = "SELECT
					trn_career.career_id,
					trn_career.email,
					trn_career.fullname,
					trn_career.gioitinh_id,
					trn_career.ngaysinh,
					trn_career.tinhthanh_id,
					trn_career.DISORDER,
					trn_ungtuyen.hoso,
					trn_ungtuyen.sodienthoai,
					trn_ungtuyen.gioithieungan,
					trn_congviec.tencongviec,
					trn_congviec.ngayhethan,
					trn_ungtuyen.congviec_id as action_id,
					trn_ungtuyen.DISORDER as ngayungtuyen,
					mst_tinhthanh.ten_tinhthanh
				FROM
				 trn_ungtuyen
					Inner Join trn_congviec ON trn_congviec.congviec_id = trn_ungtuyen.congviec_id
					Inner Join trn_career ON trn_career.career_id = trn_ungtuyen.career_id
					Inner Join trn_congty ON trn_congviec.congty_id = trn_congty.congty_id
					LEFT JOIN mst_tinhthanh ON trn_career.tinhthanh_id = mst_tinhthanh.id
					WHERE trn_congviec.congviec_id = ?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($idCV));
		}
		
		function countCongViec(){
			$congty_id = $_SESSION["session"]["Id"];
			$sql = "SELECT COUNT(congviec_id) FROM trn_congviec WHERE congty_id = ?";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($congty_id));
			$row = $result->fetch();
			return $row[0];
		}
		
		function countUngtuyen($id_cv){
			//$congty_id = $_SESSION["session"]["Id"];
			$sql = "SELECT COUNT(ungtuyen_id) AS SL FROM trn_ungtuyen WHERE congviec_id = ?";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($id_cv));
			$row = $result->fetch();
			return $row[0];
		}
		
		function CreateSelectBoxLHHD($loaihinhhoatdong_id, $name, $textarea = ""){
			$sql = "SELECT loaihinhhoatdong_id, tenloaihinhhoatdong FROM mst_loaihinhhoatdong ORDER BY DISORDER";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array());
			$html = '<select data-textarea="'.$textarea.'" name="'.$name.'" class="form-control wp85">';
			$selected = "";
			$html .= '<option value="0"> -- Loại hình hoạt động -- </option>';
			while($row = $result->fetch()){
				if($loaihinhhoatdong_id == $row['loaihinhhoatdong_id']){
					$selected = "selected";
				}else{
					$selected = "";
				}
				$html .= '<option '.$selected.' value="'.$row['loaihinhhoatdong_id'].'">'.$row['tenloaihinhhoatdong'].'</option>';
			}
			$html .= "</select>";
			return $html;
		}
    }
	
	// Khai báo chung
    $com_name = "dangtuyen";
	$title = "ĐĂNG TUYỂN";
	$mota = "danh sách đăng tuyển";
	$db_name = "trn_congviec";
	$primary_key = "congviec_id";
	$congviec_id = $_POST[$primary_key];
	$congty_id = $_SESSION["session"]["Id"];
	$where_common =  $primary_key."='" . $_POST[$primary_key] . "' AND email='".$_SESSION["session"]["Tendangnhap"]."'";
	
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch(@$_REQUEST["act"]){

        case "";
        	//Action rỗng thì không làm gì cả
        break;
		 case "load_detail_view";
			include_once("view.detailcustomer.php");
		 break;
		case "draft-edit";
			 $myObj = new \stdClass();
			 $myprocess = new process();
		     $post_basic = "";
			
			$tentinhthanhArray = $_POST['tentinhthanh'];
			for($i = 0 ; $i < count($tentinhthanhArray); $i++)
			{
				$result = $myprocess->getIDtinhthanh($tentinhthanhArray[$i]);
				if ($row = $result->fetch())
				{
					$idTinhthanh .= $row['id'].",";
					$tentinhthanh .= $tentinhthanhArray[$i].",";
				}
			}
			    $id_customerArray = $_POST['customer_id'];
				for($i = 0 ; $i < count($id_customerArray); $i++)
				{
					 $id_customer .= (($i > 0) ? "," : "") . $id_customerArray[$i];
				}
				//echo $id_customer;
				//$loaihinhcongviec = str_replace("/","|",$_POST['loaihinhcongviec_id']);
				$loaihinhcongviec = implode("|", $_POST['loaihinhcongviec_id']); 
				 $phucloi_id = implode("|",$_POST['phucloi_id']);
				//$yeucauhoso_id = str_replace("/","|",$_POST['yeucauhoso_id']);
			    $yeucauhoso_id = implode("|", $_POST['yeucauhoso_id']);
				$emailArray = explode(",", $_POST['email']);
				for($i = 0 ; $i < count($emailArray); $i++)
				{
					if (!filter_var($emailArray[$i], FILTER_VALIDATE_EMAIL)) {
						echo '0';
						exit();
					}
					$email .= (($i > 0) ? "," : "") . $emailArray[$i];
				}
			 $arrayPost = array(
				"motacongviec" => $_POST['motacongviec'],
				"chuyenmonyeucau" => $_POST['chuyenmonyeucau'],
				"yeucauhoso" => $_POST['yeucauhoso'],
				"nophoso" => $_POST['nophoso'],
				"tinhthanh_id" => substr($idTinhthanh,0,-1),
				"tentinhthanh" => substr($tentinhthanh,0,-1),
				"noilamviec" =>   substr($tentinhthanh,0,-1),
				"mucluongtoithieu" => intval(str_replace(",","",$_POST['mucluongtoithieu'])),
				"mucluongtoida" => intval(str_replace(",","",$_POST['mucluongtoida'])),
				//"loaihinhcongviec_id" => substr($loaihinhcongviec,0,-1),
				"loaihinhcongviec_id" => $loaihinhcongviec,
				"ngayhethan" => $_POST['ngayhethan'],
				"phucloi_id" => substr($phucloi_id,0,-1),
				"gioitinh_id" => empty($_POST['gioitinh_id']) ? 0 : $_POST['gioitinh_id'],
				"dotuoi" => $_POST['dotuoi'],
				"kinhnghiem_id" => $_POST['kinhnghiem_id'],
				"capbac_id" => $_POST['capbac_id'],
				"bangcap_id" => $_POST['bangcap_id'],
				//"yeucauhoso_id" => substr($yeucauhoso_id,0,-1),
				"yeucauhoso_id" => $yeucauhoso_id,
				"quyenloi" => $_POST['quyenloi'],
				"soluongcantuyen" => $_POST['soluongcantuyen'],
				"danhmuccv_id" => $_POST['danhmuccv_id'],
				"chuyenkhoa_id" => $_POST['chuyenkhoa_id'],
				"chuyenkhoakhac" => $_POST['chuyenkhoakhac'],
				"loaitien_id" => $_POST['loaitien_id'],
				"search_key" => $core_class->_removesigns($_POST["tencongviec"]),
				"draft_stt" => 1,
				"sonamkinhnghiem" => $_POST['sonamkinhnghiem'],
				"ngayhethan" => date("Y-m-d", strtotime(str_replace('/', '-', $_POST["ngayhethan"]))),
				'btn_ungtuyen' => 1,
				"email" => $email,
				"congty_id" => $congty_id,
				"ngaydang" => date("Y-m-d"),
			);

			$arrayPostCongTy = array(
				"nguoilienhe" => $_POST['nguoilienhe'],
				"loaihinhhoatdong_id" => $_POST['loaihinhhoatdong_id'],
				"loaihinhhoatdongkhac" => $_POST['loaihinhhoatdongkhac'],
				"loaihinhhoatdong2_id" => $_POST['loaihinhhoatdong2_id'],
				"loaihinhhoatdongkhac2" => $_POST['loaihinhhoatdongkhac2'],
				"loaihinhhoatdong3_id" => $_POST['loaihinhhoatdong3_id'],
				"loaihinhhoatdongkhac3" => $_POST['loaihinhhoatdongkhac3'],
			);

			if(isset($_POST['chuyenkhoa_id'])){
				unset($arrayPost["chuyenkhoakhac"]);
			}else{
				unset($arrayPost["chuyenkhoa_id"]);
			}
			if($core_class->update("trn_congviec", $arrayPost, array("congviec_id" =>$_POST['congviec_id']))){
				    $myObj->isError = 0;
					$myObj->msg = 'Lưu bảng nháp thành công !';
					$myObj->focus = '';
					$myJSON = json_encode($myObj);
					echo $myJSON;
					exit();
			}else{
				    $myObj->isError = 1;
					$myObj->msg = 'Thao tác lỗi!';
					$myObj->focus = '';
					$myJSON = json_encode($myObj);
					echo $myJSON;
					exit();
			} 
        break;
		
		case "draft-save";
			 $myObj = new \stdClass();
			 $myprocess = new process;
			  $trang_thai = 0;
			 $post_basic = 0;
			 $hot_job = 0;
			 $power_job = 0;
			 $customer_detail_id = $_POST['dich_vu_select'];
			
			 if($_POST['type_post'] =="copy_job")
			 {
				  $phucloi_id = implode("|",$_POST['phucloi_id']);
				  
			 }else{
				 $phucloi_id = str_replace("/","|",$_POST['phucloi_id']);
			 }
			 
			  /* if(intval($_POST['hot_job']) > 0)
			  {
				 $hot_job = 1; 
			  }
			  if(intval($_POST['power_job']) > 0)
			  {
				 $power_job = 1; 
			  } */
			  
			
			$tentinhthanhArray = $_POST['tentinhthanh'];
			for($i = 0 ; $i < count($tentinhthanhArray); $i++)
			{
				$result = $myprocess->getIDtinhthanh($tentinhthanhArray[$i]);
				if ($row = $result->fetch())
				{
					$idTinhthanh .= $row['id'].",";
					$tentinhthanh .= $tentinhthanhArray[$i].",";
				}
			}
			    $emailArray = explode(",", $_POST['email']);
				for($i = 0 ; $i < count($emailArray); $i++)
				{
					if (!filter_var($emailArray[$i], FILTER_VALIDATE_EMAIL)) {
						echo '0';
						exit();
					}
					$email .= (($i > 0) ? "," : "") . $emailArray[$i];
				}
				
				$loaihinhcongviec = implode("|", $_POST['loaihinhcongviec_id']); 
				//$phucloi_id = implode("|",$_POST['phucloi_id']);
			    $yeucauhoso_id = implode("|", $_POST['yeucauhoso_id']);
			    $arrayPost = array(
				"tencongviec" => $_POST['tencongviec'],
				"nguoilienhe" => $_POST['nguoilienhe'],
				"motacongviec" => $_POST['motacongviec'],
				"chuyenmonyeucau" => $_POST['chuyenmonyeucau'],
				"yeucauhoso" => $_POST['yeucauhoso'],
				"nophoso" => $_POST['nophoso'],
				"tinhthanh_id" => substr($idTinhthanh,0,-1),
				"tentinhthanh" => substr($tentinhthanh,0,-1),
				"noilamviec" =>   substr($tentinhthanh,0,-1),
				"mucluongtoithieu" => intval(str_replace(",","",$_POST['mucluongtoithieu'])),
				"mucluongtoida" => intval(str_replace(",","",$_POST['mucluongtoida'])),
				"loaihinhcongviec_id" => $loaihinhcongviec,
				"ngayhethan" => $_POST['ngayhethan'],
			//	"phucloi_id" => substr($phucloi_id,0,-1),
				"phucloi_id" => $phucloi_id,
				"gioitinh_id" => empty($_POST['gioitinh_id']) ? 0 : $_POST['gioitinh_id'],
				"dotuoi" => $_POST['dotuoi'],
				"kinhnghiem_id" => $_POST['kinhnghiem_id'],
				"capbac_id" => $_POST['capbac_id'],
				"bangcap_id" => $_POST['bangcap_id'],
				"yeucauhoso_id" => $yeucauhoso_id,
				"quyenloi" => $_POST['quyenloi'],
				"soluongcantuyen" => $_POST['soluongcantuyen'],
				"danhmuccv_id" => $_POST['danhmuccv_id'],
				//"congviec_id" => $_POST['congviec_id'],
				"chuyenkhoa_id" => $_POST['chuyenkhoa_id'],
				"chuyenkhoakhac" => $_POST['chuyenkhoakhac'],
				"loaitien_id" => $_POST['loaitien_id'],
				"search_key" => $core_class->_removesigns($_POST["tencongviec"]),
				"draft_stt" => 1,
				"trangthai" => 2,
				"DELETE_FLG" => 0,
				"post_basic" =>intval($post_basic),
				"sonamkinhnghiem" => $_POST['sonamkinhnghiem'],
				"ngayhethan" => date("Y-m-d", strtotime(str_replace('/', '-', $_POST["ngayhethan"]))),
				"btn_ungtuyen" => 1,
				"email" => $email,
				"congty_id" => $congty_id,
				"ngaydang" => date("Y-m-d"),
			);

			$arrayPostCongTy = array(
				"nguoilienhe" => $_POST['nguoilienhe'],
				"loaihinhhoatdong_id" => $_POST['loaihinhhoatdong_id'],
				"loaihinhhoatdongkhac" => $_POST['loaihinhhoatdongkhac'],
				"loaihinhhoatdong2_id" => $_POST['loaihinhhoatdong2_id'],
				"loaihinhhoatdongkhac2" => $_POST['loaihinhhoatdongkhac2'],
				"loaihinhhoatdong3_id" => $_POST['loaihinhhoatdong3_id'],
				"loaihinhhoatdongkhac3" => $_POST['loaihinhhoatdongkhac3'],
			);
			
			if(isset($_POST['chuyenkhoa_id'])){
				unset($arrayPost["chuyenkhoakhac"]);
			}else{
				unset($arrayPost["chuyenkhoa_id"]);
			}
			if($idInsert = $core_class->lastID_insert($db_name, $arrayPost))
			{
						$myObj->isError = 0;
						$myObj->msg = 'Lưu bảng nháp thành công !';
						$myObj->focus = '';
						$myJSON = json_encode($myObj);
						echo $myJSON;
						exit();
			}else
			{
				        $myObj->isError = 1;
						$myObj->msg = 'Thao tác lỗi!';
						$myObj->focus = '';
						$myJSON = json_encode($myObj);
						echo $myJSON;
						exit();
			}
        break;
		
		case "dangtin";
			//var_dump($_POST);
			$myprocess = new process;
			 $trang_thai = 0;
			 $post_basic = 0;
			 $hot_job = 0;
			 $power_job = 0;
			 $customer_detail_id = $_POST['dich_vu_select'];
			 $tentinhthanhArray = $_POST['tentinhthanh'];
			 for($i = 0 ; $i < count($tentinhthanhArray); $i++)
				{
					$result = $myprocess->getIDtinhthanh($tentinhthanhArray[$i]);
					if ($row = $result->fetch())
					{
						$idTinhthanh .= $row['id'].",";
						$tentinhthanh .= $tentinhthanhArray[$i].",";
					}
				}
				
			  $emailArray = explode(",", $_POST['email']);
				for($i = 0 ; $i < count($emailArray); $i++)
				{
					if (!filter_var($emailArray[$i], FILTER_VALIDATE_EMAIL)) {
						echo '0';
						exit();
					}
					$email .= (($i > 0) ? "," : "") . $emailArray[$i];
				}
				
				$loaihinhcongviec = implode("|", $_POST['loaihinhcongviec_id']); 
				$phucloi_id = str_replace("/","|",$_POST['phucloi_id']);
				$yeucauhoso_id = implode("|", $_POST['yeucauhoso_id']);
				 // set dịch vụ vào bảng tin
				if(intval($_POST['dich_vu_select']) > 0 )
				{
					if(intval($_POST['hot_job']) > 0)
					  {
						 $hot_job = 1; 
						 $trang_thai = 1;
					  }
					  if(intval($_POST['power_job']) > 0)
					  {
						  $power_job = 1; 
						  $trang_thai = 1;
					  }
				}else
				{
					$post_basic = 1;
					$trang_thai = 0;
				}
				
				$arrayPost = array(
						"tencongviec" => $_POST['tencongviec'],
						"nguoilienhe" => $_POST['nguoilienhe'],
						"motacongviec" => $_POST['motacongviec'],
						"chuyenmonyeucau" => $_POST['chuyenmonyeucau'],
						"yeucauhoso" => $_POST['yeucauhoso'],
						"nophoso" => $_POST['nophoso'],
						"tinhthanh_id" => substr($idTinhthanh,0,-1),
						"tentinhthanh" => substr($tentinhthanh,0,-1),
						"noilamviec" =>   substr($tentinhthanh,0,-1),
						"mucluongtoithieu" => intval(str_replace(",","",$_POST['mucluongtoithieu'])),
						"mucluongtoida" => intval(str_replace(",","",$_POST['mucluongtoida'])),
						"loaihinhcongviec_id" => $loaihinhcongviec,
						"ngayhethan" => $_POST['ngayhethan'],
						"phucloi_id" => substr($phucloi_id,0,-1),
						"gioitinh_id" => empty($_POST['gioitinh_id']) ? 0 : $_POST['gioitinh_id'],
						"dotuoi" => $_POST['dotuoi'],
						"kinhnghiem_id" => $_POST['kinhnghiem_id'],
						"capbac_id" => $_POST['capbac_id'],
						"bangcap_id" => $_POST['bangcap_id'],
						"yeucauhoso_id" => $yeucauhoso_id,
						"quyenloi" => $_POST['quyenloi'],
						"soluongcantuyen" => $_POST['soluongcantuyen'],
						"danhmuccv_id" => $_POST['danhmuccv_id'],
						"congviec_id" => $_POST['congviec_id'],
						"chuyenkhoa_id" => $_POST['chuyenkhoa_id'],
						"chuyenkhoakhac" => $_POST['chuyenkhoakhac'],
						"loaitien_id" => $_POST['loaitien_id'],
						"search_key" => $core_class->_removesigns($_POST["tencongviec"]),
						"draft_stt" => 0,
						"trangthai" => $trang_thai,
						"DELETE_FLG" => 0,
						"hot_job" => intval($hot_job),
						"power_job" =>intval($power_job),
						"post_basic" =>intval($post_basic),
						//"id_order" =>$id_customer,
						"sonamkinhnghiem" => $_POST['sonamkinhnghiem'],
						"ngayhethan" => date("Y-m-d", strtotime(str_replace('/', '-', $_POST["ngayhethan"]))),
						"btn_ungtuyen" => 1,
						"email" => $email,
						"congty_id" => $congty_id,
						"ngaydang" => date("Y-m-d"),
			    );
				
				$arrayPostCongTy = array(
					"nguoilienhe" => $_POST['nguoilienhe'],
					"loaihinhhoatdong_id" => $_POST['loaihinhhoatdong_id'],
					"loaihinhhoatdongkhac" => $_POST['loaihinhhoatdongkhac'],
					"loaihinhhoatdong2_id" => $_POST['loaihinhhoatdong2_id'],
					"loaihinhhoatdongkhac2" => $_POST['loaihinhhoatdongkhac2'],
					"loaihinhhoatdong3_id" => $_POST['loaihinhhoatdong3_id'],
					"loaihinhhoatdongkhac3" => $_POST['loaihinhhoatdongkhac3'],
				);
				if(isset($_POST['chuyenkhoa_id'])){
					unset($arrayPost["chuyenkhoakhac"]);
				}else{
					unset($arrayPost["chuyenkhoa_id"]);
				}
				
				if($idInsert = $core_class->lastID_insert($db_name, $arrayPost))
					{
					 $core_class->update("trn_congty", $arrayPostCongTy, array("congty_id" => $congty_id));
						if(intval($_POST['dich_vu_select']) > 0 )
							{
								$where = "customer_detail_id = ".$customer_detail_id; // id chuc nang
								$NumberPost = $core_class->getValueFrom('trn_customer_detail','qty_ext',$where);
								$ArrayIdPOST = $core_class->getValueFrom('trn_customer_detail','id_post',$where);
								$Array_value = explode(",", $ArrayIdPOST);
								$Array_value = array_filter($Array_value);
								array_push($Array_value, $idInsert);
								$qtyPost = $NumberPost+1;
								for($i = 0 ; $i < count($Array_value); $i++)
									{
										 $id_Post .= (($i > 0) ? "," : "") . $Array_value[$i];
									}
									 $arrayCustomerDetail = array(
										"qty_ext" =>$qtyPost,
										"id_post" => $id_Post,
									);
									if($core_class->update("trn_customer_detail", $arrayCustomerDetail, array("customer_detail_id" => $customer_detail_id)))
										{
											echo "1";
										}else
										{
											echo "0";
										} 
							}else if(intval($_POST['dich_vu_select']) == 0 )
							{
								$arraycty = array(
									"ex_post_basic" => 1
								); 
								if($core_class->update("trn_congty", $arraycty, array("congty_id" => $_SESSION["session"]["Id"])))
								{
									echo "1";
								}else
								{
									echo "0";
								} 
							}else{
								echo "1";
							}
					}else 
					{
						echo '0';
					}
		break;
		case "Update";
			 $myObj = new \stdClass();
			 $myprocess = new process;
			 $trang_thai = 0;
			 $post_basic = 0;
			 $hot_job = 0;
			 $power_job = 0;
			 $customer_detail_id = $_POST['dich_vu_select'];
			 $tentinhthanhArray = $_POST['tentinhthanh'];
			 for($i = 0 ; $i < count($tentinhthanhArray); $i++)
				{
					$result = $myprocess->getIDtinhthanh($tentinhthanhArray[$i]);
					if ($row = $result->fetch())
					{
						$idTinhthanh .= $row['id'].",";
						$tentinhthanh .= $tentinhthanhArray[$i].",";
					}
				}
			  $emailArray = explode(",", $_POST['email']);
				for($i = 0 ; $i < count($emailArray); $i++)
				{
					if (!filter_var($emailArray[$i], FILTER_VALIDATE_EMAIL)) {
						echo '0';
						exit();
					}
					$email .= (($i > 0) ? "," : "") . $emailArray[$i];
				}
			    $id_customerArray = $_POST['customer_id'];
				for($i = 0 ; $i < count($id_customerArray); $i++)
				{
					 $id_customer .= (($i > 0) ? "," : "") . $id_customerArray[$i];
				}
		    	 $loaihinhcongviec = implode("|", $_POST['loaihinhcongviec_id']); 
				 $phucloi_id = implode("|",$_POST['phucloi_id']);
			     $yeucauhoso_id = implode("|", $_POST['yeucauhoso_id']);
				 
				 if(intval($_POST['dich_vu_select']) > 0 && $_POST['dich_vu_select'] != -1)
				 {
					if(intval($_POST['hot_job']) > 0)
					  {
						 $hot_job = 1; 
						 $trang_thai = 1;
					  }
					  if(intval($_POST['power_job']) > 0)
					  {
						  $power_job = 1; 
						  $trang_thai = 1;
					  }
					   $arrayPost = array(
								"motacongviec" => $_POST['motacongviec'],
								"chuyenmonyeucau" => $_POST['chuyenmonyeucau'],
								"yeucauhoso" => $_POST['yeucauhoso'],
								"nophoso" => $_POST['nophoso'],
								"tinhthanh_id" => substr($idTinhthanh,0,-1),
								"tentinhthanh" => substr($tentinhthanh,0,-1),
								"noilamviec" =>   substr($tentinhthanh,0,-1),
								"mucluongtoithieu" => intval(str_replace(",","",$_POST['mucluongtoithieu'])),
								"mucluongtoida" => intval(str_replace(",","",$_POST['mucluongtoida'])),
								"loaihinhcongviec_id" => $loaihinhcongviec,
								"ngayhethan" => $_POST['ngayhethan'],
								//"phucloi_id" => substr($phucloi_id,0,-1),
								"phucloi_id" => $phucloi_id,
								"gioitinh_id" => empty($_POST['gioitinh_id']) ? 0 : $_POST['gioitinh_id'],
								"dotuoi" => $_POST['dotuoi'],
								"kinhnghiem_id" => $_POST['kinhnghiem_id'],
								"capbac_id" => $_POST['capbac_id'],
								"bangcap_id" => $_POST['bangcap_id'],
								"yeucauhoso_id" => $yeucauhoso_id,
								"quyenloi" => $_POST['quyenloi'],
								"soluongcantuyen" => $_POST['soluongcantuyen'],
								"danhmuccv_id" => $_POST['danhmuccv_id'],
								"chuyenkhoa_id" => $_POST['chuyenkhoa_id'],
								"chuyenkhoakhac" => $_POST['chuyenkhoakhac'],
								"loaitien_id" => $_POST['loaitien_id'],
								"search_key" => $core_class->_removesigns($_POST["tencongviec"]),
								"draft_stt" => 0,
								"trangthai" => $trang_thai,
								"DELETE_FLG" => 0,
								"hot_job" => intval($hot_job),
								"power_job" =>intval($power_job),
								"post_basic" =>intval($post_basic),
								 "sonamkinhnghiem" => $_POST['sonamkinhnghiem'],
								"ngayhethan" => date("Y-m-d", strtotime(str_replace('/', '-', $_POST["ngayhethan"]))),
								"email" => $email,
								"congty_id" => $congty_id,
								"ngaydang" => date("Y-m-d"),
							  );
				}else if($_POST['dich_vu_select'] == -1)
				{
					 $arrayPost = array(
								"motacongviec" => $_POST['motacongviec'],
								"chuyenmonyeucau" => $_POST['chuyenmonyeucau'],
								"yeucauhoso" => $_POST['yeucauhoso'],
								"nophoso" => $_POST['nophoso'],
								"tinhthanh_id" => substr($idTinhthanh,0,-1),
								"tentinhthanh" => substr($tentinhthanh,0,-1),
								"noilamviec" =>   substr($tentinhthanh,0,-1),
								"mucluongtoithieu" => intval(str_replace(",","",$_POST['mucluongtoithieu'])),
								"mucluongtoida" => intval(str_replace(",","",$_POST['mucluongtoida'])),
								"loaihinhcongviec_id" => $loaihinhcongviec,
								"ngayhethan" => $_POST['ngayhethan'],
								//"phucloi_id" => substr($phucloi_id,0,-1),
								"phucloi_id" => $phucloi_id,
								"gioitinh_id" => empty($_POST['gioitinh_id']) ? 0 : $_POST['gioitinh_id'],
								"dotuoi" => $_POST['dotuoi'],
								"kinhnghiem_id" => $_POST['kinhnghiem_id'],
								"capbac_id" => $_POST['capbac_id'],
								"bangcap_id" => $_POST['bangcap_id'],
								"yeucauhoso_id" => $yeucauhoso_id,
								"quyenloi" => $_POST['quyenloi'],
								"soluongcantuyen" => $_POST['soluongcantuyen'],
								"danhmuccv_id" => $_POST['danhmuccv_id'],
								"chuyenkhoa_id" => $_POST['chuyenkhoa_id'],
								"chuyenkhoakhac" => $_POST['chuyenkhoakhac'],
								"loaitien_id" => $_POST['loaitien_id'],
								"search_key" => $core_class->_removesigns($_POST["tencongviec"]),
								"draft_stt" => 0,
								"trangthai" => 1,
								"DELETE_FLG" => 0,
								 "sonamkinhnghiem" => $_POST['sonamkinhnghiem'],
								"ngayhethan" => date("Y-m-d", strtotime(str_replace('/', '-', $_POST["ngayhethan"]))),
								"email" => $email,
								"congty_id" => $congty_id,
								"ngaydang" => date("Y-m-d"),
							  );
				}else
				{
					$arrayPost = array(
								"motacongviec" => $_POST['motacongviec'],
								"chuyenmonyeucau" => $_POST['chuyenmonyeucau'],
								"yeucauhoso" => $_POST['yeucauhoso'],
								"nophoso" => $_POST['nophoso'],
								"tinhthanh_id" => substr($idTinhthanh,0,-1),
								"tentinhthanh" => substr($tentinhthanh,0,-1),
								"noilamviec" =>   substr($tentinhthanh,0,-1),
								"mucluongtoithieu" => intval(str_replace(",","",$_POST['mucluongtoithieu'])),
								"mucluongtoida" => intval(str_replace(",","",$_POST['mucluongtoida'])),
								"loaihinhcongviec_id" => $loaihinhcongviec,
								"ngayhethan" => $_POST['ngayhethan'],
								//"phucloi_id" => substr($phucloi_id,0,-1),
								"phucloi_id" => $phucloi_id,
								"gioitinh_id" => empty($_POST['gioitinh_id']) ? 0 : $_POST['gioitinh_id'],
								"dotuoi" => $_POST['dotuoi'],
								"kinhnghiem_id" => $_POST['kinhnghiem_id'],
								"capbac_id" => $_POST['capbac_id'],
								"bangcap_id" => $_POST['bangcap_id'],
								"yeucauhoso_id" => $yeucauhoso_id,
								"quyenloi" => $_POST['quyenloi'],
								"soluongcantuyen" => $_POST['soluongcantuyen'],
								"danhmuccv_id" => $_POST['danhmuccv_id'],
								"chuyenkhoa_id" => $_POST['chuyenkhoa_id'],
								"chuyenkhoakhac" => $_POST['chuyenkhoakhac'],
								"loaitien_id" => $_POST['loaitien_id'],
								"search_key" => $core_class->_removesigns($_POST["tencongviec"]),
								"draft_stt" => 0,
								"trangthai" => 0,
								"DELETE_FLG" => 0,
								 "sonamkinhnghiem" => $_POST['sonamkinhnghiem'],
								"ngayhethan" => date("Y-m-d", strtotime(str_replace('/', '-', $_POST["ngayhethan"]))),
								"email" => $email,
								"congty_id" => $congty_id,
								"ngaydang" => date("Y-m-d"),
							  );
				}
			
			  $arrayPostCongTy = array(
					"nguoilienhe" => $_POST['nguoilienhe'],
					"loaihinhhoatdong_id" => $_POST['loaihinhhoatdong_id'],
					"loaihinhhoatdongkhac" => $_POST['loaihinhhoatdongkhac'],
					"loaihinhhoatdong2_id" => $_POST['loaihinhhoatdong2_id'],
					"loaihinhhoatdongkhac2" => $_POST['loaihinhhoatdongkhac2'],
					"loaihinhhoatdong3_id" => $_POST['loaihinhhoatdong3_id'],
					"loaihinhhoatdongkhac3" => $_POST['loaihinhhoatdongkhac3'],
				);
				
			  if(isset($_POST['chuyenkhoa_id'])){
				unset($arrayPost["chuyenkhoakhac"]);
			  }else{
				unset($arrayPost["chuyenkhoa_id"]);
			  }	 
			 
			  if($core_class->update("trn_congviec", $arrayPost, array("congviec_id" =>$_POST['congviec_id']))){
				   $core_class->update("trn_congty", $arrayPostCongTy, array("congty_id" => $congty_id));
					if(intval($_POST['dich_vu_select']) > 0 && $_POST['dich_vu_select'] != -1 )
							{
								$where = "customer_detail_id = ".$customer_detail_id; // id chuc nang
								$NumberPost = $core_class->getValueFrom('trn_customer_detail','qty_ext',$where);
								$ArrayIdPOST = $core_class->getValueFrom('trn_customer_detail','id_post',$where);
								$Array_value = explode(",", $ArrayIdPOST);
								$Array_value = array_filter($Array_value);
								array_push($Array_value, $idInsert);
								$qtyPost = $NumberPost+1;
								for($i = 0 ; $i < count($Array_value); $i++)
									{
										 $id_Post .= (($i > 0) ? "," : "") . $Array_value[$i];
									}
									 $arrayCustomerDetail = array(
										"qty_ext" =>$qtyPost,
										"id_post" => $id_Post,
									);
									if($core_class->update("trn_customer_detail", $arrayCustomerDetail, array("customer_detail_id" => $customer_detail_id)))
										{
											$myObj->isError = 0;
											$myObj->msg = 'Cập nhật thành công !';
											$myObj->focus = '';
											$myJSON = json_encode($myObj);
											echo $myJSON;
											exit();
										}else
										{
											$myObj->isError = 1;
											$myObj->msg = 'Thao tác lỗi!';
											$myObj->focus = '';
											$myJSON = json_encode($myObj);
											echo $myJSON;
											exit();
										} 
							}else{
								    $myObj->isError = 0;
									$myObj->msg = 'Cập nhật thành công !';
									$myObj->focus = '';
									$myJSON = json_encode($myObj);
									echo $myJSON;
									exit();
							}
				   
			}else{
				    $myObj->isError = 1;
					$myObj->msg = 'Thao tác lỗi!';
					$myObj->focus = '';
					$myJSON = json_encode($myObj);
					echo $myJSON;
					exit();
			}
			  
		break;
		
		case "Delete";
	       if($core_class->Update_WhereTable($db_name, $primary_key." IN(".$_REQUEST["id"].")")){
				echo "1";
			}else{
				echo "0";
			} 
		break;
		
		case "Upload";
			$core_class->uploadFile();
		break;
		
		case "LoadDataEdit";
			$column = "tencongviec,motacongviec,chuyenmonyeucau,yeucauhoso,
			mucluongtoithieu,mucluongtoida,tentinhthanh,loaihinhcongviec_id,DATE_FORMAT(ngayhethan, '%d/%m/%Y') as ngayhethan,
			phucloi_id,gioitinh_id,dotuoi,kinhnghiem_id,capbac_id,bangcap_id,
			yeucauhoso_id,quyenloi,soluongcantuyen,danhmuccv_id,chuyenkhoa_id,chuyenkhoakhac,loaitien_id";
			//$core_class->loadJSONDataList2($db_name, $column,"AND ".$primary_key."=".$_REQUEST["id"]. " AND email='".$_SESSION["session"]["Tendangnhap"]."' OR congty_id = ".$congty_id);
		break;
		
		case "LoadList";
			$column = "tencongviec,soluongcantuyen,ngayhethan,noilamviec,loaihinhcongviec_id,trangthai as status,";
			$column .= "congviec_id,congviec_id as action_id,";
			$column .= "hot_job,power_job";
			echo $core_class->getValueFromTableToJSON($db_name, $column, "AND email='".$_SESSION["session"]["Tendangnhap"]."' OR congty_id = ".$congty_id);
		break;

		case "loadchuyenkhoa":
			$danhmuccvId = $_POST["danhmuccv_id"];
			if(empty($congviec_id)){
				$congviec_id = 0;
			}

			$danhMucKhac = $core_class->findValues("trn_congviec", "chuyenkhoakhac", array("congviec_id" => $congviec_id));
			if($danhmuccvId == "4"){
				$html = '<input type="text" maxlength="250" name="chuyenkhoakhac" class="form-control" value="'.$danhMucKhac.'" required="required">';
				echo $html;
			}else{
				$where = "WHERE danhmuccv_id = " .$danhmuccvId;
				echo $core_class->createSelectBox("mst_chuyenkhoa", "chuyenkhoa_id", "form-control m-bootstrap-select m_selectpicker", $where, "");
			}
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }