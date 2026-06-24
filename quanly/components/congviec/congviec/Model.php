<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
		}
		
		function getListCongViec(){
			$sql = "SELECT congviec_id, tencongviec from trn_congviec";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		function countUngtuyen($id_cv){
			//$congty_id = $_SESSION["session"]["Id"];
			$sql = "SELECT COUNT(ungtuyen_id) AS SL FROM trn_ungtuyen WHERE congviec_id = ?";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($id_cv));
			$row = $result->fetch();
			return $row[0];
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
		public function getSuggesst($ma_don_hang){
				$sql = "SELECT
							trn_customer.ma_don_hang,
							SUM(qty) as qty,	
							trn_customer.congty_id,
							trn_function.attrib_function
						FROM
							trn_customer
						INNER JOIN trn_customer_detail ON trn_customer.customer_id = trn_customer_detail.customer_id
						INNER JOIN trn_function ON trn_customer_detail.function_id = trn_function.id_function
						WHERE
							trn_customer.expiry_date >= '".date('Y-m-d')."' AND
							trn_customer.ma_don_hang LIKE '%$ma_don_hang%' AND
							trn_customer.`status` = 1 AND trn_customer_detail.`trang_thai` = 1 AND trn_function.type_function = 'job' AND trn_customer.expiry_date > SYSDATE() GROUP BY attrib_function";
			return $this->dbObj->SqlQueryOutputResult($sql, array($ma_don_hang));
		}
		
		function getList_Job($condition){
			$sql = "SELECT
							trn_congviec.congviec_id, 
							trn_congviec.tencongviec, 
							trn_congviec.search_key, 
							trn_congviec.congty_id,
							trn_congty.tencongty,
							trn_congviec.noilamviec, 
							DATE_FORMAT(ngaydang, '%d/%m/%Y') AS ngaydang,
							CASE WHEN Tendangnhap  IS NULL  THEN trn_congty.email ELSE Tendangnhap END Tendangnhap,							
							DATE_FORMAT(ngayhethan, '%d/%m/%Y') AS ngayhethan,
							trn_congviec.luotxem,
							trn_congviec.trangthai, 
							trn_congviec.power_job, 
							trn_congviec.hot_job, 
							trn_congviec.post_basic, 
							trn_congviec.DISORDER
						FROM
							trn_congviec
							INNER JOIN	trn_congty ON trn_congviec.congty_id = trn_congty.congty_id
							LEFT JOIN taikhoan ON trn_congviec.user_id = taikhoan.taikhoan_id
							WHERE  trn_congviec.draft_stt =0 AND trn_congviec.DELETE_FLG = 0 $condition";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		
		function Update_company(
							$tencongty,
							$loaihinhhoatdong_id,
							$loaihinhhoatdongkhac,
							$email,
							$password,
							$trangthai,
							$guimail,
							$nguoilienhe,
							$quymo_id,
							$bvhangdau,
							$hinhanh,
							$web,
							$chude,
							$diachicongty,
							$sdthoai,
							$tinhthanh_id,
							$banner,
							$urlfacebook,
							$gioithieungan,
							$hinhanhcongty1,
							$hinhanhcongty2,
							$hinhanhcongty3,
							$user_update,
							$congty_id
							)
        {	
		    $sql = "Update trn_congty Set
						tencongty = ?,
						loaihinhhoatdong_id = ?,
						loaihinhhoatdongkhac = ?,
						email = ?,
						password = ?,
						trangthai = ?,
						guimail = ?,
						nguoilienhe = ?,
						quymo_id = ?,
						bvhangdau = ?,
						hinhanh = ?,
						web = ?,
						chude = ?,
						diachicongty = ?,
						sdthoai = ?,
						tinhthanh_id = ?,
						banner = ?,
						urlfacebook = ?,
						gioithieungan = ?,
						hinhanhcongty1 = ?,
						hinhanhcongty2 = ?,
						hinhanhcongty3 = ?,
						user_update = ?
					  Where congty_id = ?
				";
            if ($this->dbObj->SqlQueryInputResult($sql, 
				array($tencongty,
							$loaihinhhoatdong_id,
							$loaihinhhoatdongkhac,
							$email,
							$password,
							$trangthai,
							$guimail,
							$nguoilienhe,
							$quymo_id,
							$bvhangdau,
							$hinhanh,
							$web,
							$chude,
							$diachicongty,
							$sdthoai,
							$tinhthanh_id,
							$banner,
							$urlfacebook,
							$gioithieungan,
							$hinhanhcongty1,
							$hinhanhcongty2,
							$hinhanhcongty3,
							$user_update,
							$congty_id
							)
					) <> FALSE
				) 
				{
				   return true;
				} else {
				   return false;
				}
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
		public function loadTinhThanh(){
			$sql = "SELECT
						mst_tinhthanh.id,
						mst_tinhthanh.ten_tinhthanh
					FROM
						mst_tinhthanh";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}

    }
	
	// Khai báo chung
    $com_name = "congviec";
	$title = "CÔNG VIỆC";
	$mota = "danh sách công việc";
	$db_name = "trn_congviec";
	$primary_key = "congviec_id";
	$where_common =  $primary_key."='" . $_POST[$primary_key] . "'";
	
	$db_name_company = "trn_congty";
	$primary_keyCompany =  "congty_id";
	$where_commonCompany =  $primary_keyCompany."='" . $_POST[$primary_keyCompany] . "'";
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch(@$_REQUEST["act"]){

        case "";
        	//Action rỗng thì không làm gì cả
		break;
		
		case "load_modal_add_new_job":
			include_once("Add.php");
		break;
		
		case "getcheck":
				var_dump($_POST);
			//include_once("check_dichvu.php");
		break;
		
		 case "getSuggesstOder";
			//var_dump($_POST);
			$myprocess = new process();
			$name = $_POST['name'];
			if(!empty($name)) {
				
				 $result = $myprocess->getSuggesst($name);
				 while($row = $result->fetch()){
					 
					 $data_cty[] = array("ma_don_hang" 	  => $row['ma_don_hang'], 
										"qty" 		      => $row['qty'],
										"congty_id" 	  => $row['congty_id'],
										"attrib_function" => $row['attrib_function']
										);
					}
					 echo json_encode($data_cty);
   				     exit;
			}
        break;
		
		
		case "load_modal_edit_job":
			include_once("Edit.php");
		break;
		case "load_detail_view";
			include_once("view.detailcustomer.php");
		 break;
		case "load_modal_edit_company":
			include_once("Edit_company.php");
		break;
		
		case "loadchuyenkhoa":
		    $danhmuccvId	= $_POST["danhmuccv_id"];
			$chuyenkhoa_id 	= $_POST["valueckhac"];
			$textkhac 	   = $_POST["textkhac"];
			$congviec_id 	= $_POST["congviec_id"];
			if(empty($congviec_id)){
				$congviec_id = 0;
			}
			$danhMucKhac = $core_class->findValues("trn_congviec", "chuyenkhoakhac", array("congviec_id" => $congviec_id));
			if($danhmuccvId == "99"){
				$html = '<input type="text" maxlength="250" id="chuyenkhoakhac" name="chuyenkhoakhac" class="form-control" value="'.$textkhac.'" required="required">';
				echo $html;
			}else{
				if(empty($chuyenkhoa_id)){
					
					$where = "WHERE danhmuccv_id = " .$danhmuccvId;
				}else
				{
					$where = "WHERE danhmuccv_id = " .$danhmuccvId." AND chuyenkhoa_id = ".$chuyenkhoa_id;
				}
				echo $core_class->createSelectSL("mst_chuyenkhoa", "chuyenkhoa_id", "form-control m-bootstrap-select m_selectpicker", $where, "");
			}
		break;
		
		case "load_modal_copy_job":
			include_once("Copy.php");
		break;
		case "insert_job";
			$myObj = new \stdClass();
			// $_POST variable
			$myprocess 		 = new process;
			$tencongviec = $_POST['tencongviec'];
			$nguoilienhe = $_POST['nguoilienhe'];
			// $email = $_POST['email'];
			 $emailArray = explode(",", $_POST['email']);
				for($i = 0 ; $i < count($emailArray); $i++)
				{
					if (!filter_var($emailArray[$i], FILTER_VALIDATE_EMAIL)) {
						$myObj->isError = 1;
			        	$myObj->msg = "Lỗi, xin vui lòng kiểm tra lại";
						$myJSON = json_encode($myObj);
			            echo $myJSON;
						exit();
					}
					$email .= (($i > 0) ? "," : "") . $emailArray[$i];
				}
			$congty_id = $_POST['congty_id'];
			$loaihinhcongviec_id = implode("|", $_POST['loaihinhcongviec_id']); // Loại hình công việc
			$gioitinh_id = $_POST['gioitinh_id'];
			$dotuoi = $_POST['dotuoi'];
			$kinhnghiem_id = $_POST['kinhnghiem_id'];
			$sonamkinhnghiem = $_POST['sonamkinhnghiem'];
			$yeucauhoso_id = implode("|", $_POST['yeucauhoso_id']); // yêu cầu hồ sơ ngoại ngữ
			$capbac_id = $_POST['capbac_id'];
			$bangcap_id = $_POST['bangcap_id'];
			$phucloi_id = implode("|", $_POST['phucloi_id']); // danh sách phúc lợi
			$mucluongtoithieu = $_POST['mucluongtoithieu'];
			$mucluongtoida = $_POST['mucluongtoida'];
			//$tinhthanh_id = $_POST['tinhthanh_id']; // Địa điểm làm việc
			//$noilamviec = $_POST['noilamviec'];
			$motacongviec = $_POST['motacongviec'];
			$chuyenmonyeucau = $_POST['chuyenmonyeucau'];
			$quyenloi = $_POST['quyenloi'];
			$yeucauhoso = $_POST['yeucauhoso'];
			$nophoso = $_POST['nophoso'];
			$soluongcantuyen = $_POST['soluongcantuyen'];
			$danhmuccv_id = $_POST['danhmuccv_id'];
			$chuyenkhoa_id = $_POST['chuyenkhoa_id'];
			$ngaydang = $_POST['ngaydang'];
			$ngayhethan = $_POST['ngayhethan'];
			$goiy = $_POST['goiy']; // gợi ý người dùng
			$trangthai = $_POST['trangthai'];
			$chuyenkhoakhac = $_POST['chuyenkhoakhac'];
			$vip = $_POST['vip']; // hàng đầu
			$btn_ungtuyen = $_POST['btn_ungtuyen']; 
			$tentinhthanhArray = $_POST['noilamviec'];
			$loaitien_id = $_POST['loaitien_id'];
			$search_key = $core_class->_removesigns($tencongviec);
			$power_job = $_POST['power_job']; // power job
			$hot_job = $_POST['hot_job']; // hot job
			$post_basic = $_POST['post_basic']; // hot job
			$dang_ho = $_POST['dang_ho']; // hot job
			//echo $_POST['noilamviec'];
			//$tinhthanh_id = explode(",",$_POST['noilamviec']);
			//print_r($_POST['noilamviec']);
			for($i = 0 ; $i < count($tentinhthanhArray); $i++)
			{
				$result = $myprocess->getIDtinhthanh($tentinhthanhArray[$i]);
				if ($row = $result->fetch())
				{
					$idTinhthanh .= $row['id'].",";
					$tentinhthanh .= $tentinhthanhArray[$i].",";
				}
			}

		   // echo substr($idTinhthanh,0,-1)."__";
			//echo substr($tentinhthanh,0,-1);
			$arrayInput = array(
				'tencongviec' => $tencongviec,
				'search_key' => $search_key,
				'nguoilienhe' => $nguoilienhe,
				'email' => $email,
				'congty_id' => $congty_id,
				'loaihinhcongviec_id' => $loaihinhcongviec_id, // Loại hình công việc
				'gioitinh_id' => $gioitinh_id,
				'dotuoi' => $dotuoi,
				'kinhnghiem_id' => $kinhnghiem_id,
				'sonamkinhnghiem' => $sonamkinhnghiem,
				'yeucauhoso_id' => $yeucauhoso_id, // yêu cầu hồ sơ ngoại ngữ
				'capbac_id' => $capbac_id,
				'bangcap_id' => $bangcap_id,
				'phucloi_id' => $phucloi_id, // danh sách phúc lợi
				'mucluongtoithieu' => $core_class->ctoInt($mucluongtoithieu),
				'mucluongtoida' => $core_class->ctoInt($mucluongtoida),
				'loaitien_id' => $loaitien_id,
				'tinhthanh_id' => substr($idTinhthanh,0,-1), // Địa điểm làm việc
				'tentinhthanh' => substr($tentinhthanh,0,-1),
				'noilamviec'   => substr($tentinhthanh,0,-1),
				'motacongviec' => $motacongviec,
				'chuyenmonyeucau' => $chuyenmonyeucau,
				'quyenloi' => $quyenloi,
				'yeucauhoso' => $yeucauhoso,
				'soluongcantuyen' => $soluongcantuyen,
				'danhmuccv_id' => $danhmuccv_id,
				'chuyenkhoa_id' => intval($chuyenkhoa_id),
				'chuyenkhoakhac' => $chuyenkhoakhac,
				'ngaydang' => $core_class->_formatdate($ngaydang),
				'ngayhethan' => $core_class->_formatdate($ngayhethan),
				'hot_job' => $core_class->ctoInt($hot_job), // gợi ý người dùng 
				'btn_ungtuyen' => 1,
				'trangthai' => $core_class->ctoInt($trangthai),
				'power_job' => $core_class->ctoInt($power_job), // hàng đầu
				'post_basic' => $core_class->ctoInt($post_basic), // hàng đầu
				'dang_ho' => $core_class->ctoInt($dang_ho), // hàng đầu
				'DELETE_FLG' => 0,
				'vip' => $core_class->ctoInt($vip), // hàng đầu
				'user_id' => $_SESSION["session"]['Id'],
			);
			$flagInsert = $core_class->lastID_insert("trn_congviec", $arrayInput);
			if($flagInsert > 0){
				/* if($_POST['dang_ho'] == 1)
				{
					$CustomerArray = array(
						'ma_don_hang' => $ma_don_hang,
						'congty_id' => $congty_id,
						'ten_cong_ty' => $ten_cong_ty,
						'email_cong_ty' => $email,
						'nguoilienhe' => $nguoilienhe,
						'expiry_date' => $expiry_date, // ngày het han
						'activation_date' => $activation_date, // ngày kích hoạt
						'tong_tien' => $tong_tien,
						'payment_stt' => 1,  // đã ck
						'payment_method' => 'VCB',
						'user_id' => $_SESSION["session"]['Id'],
						'status' => 1, 
						'DISORDER' => date('Y-m-d H:i:s'), 
					);
				} */
				$myObj->isError = 0;
				$myObj->msg = "Thêm công việc mới thành công";
			}else{
				$myObj->isError = 1;
				$myObj->msg = "Lỗi, xin vui lòng kiểm tra lại";
			}
			$myJSON = json_encode($myObj);
			echo $myJSON;
		break;
		case "update_job";
			$myObj = new \stdClass();
			$__trangthai = $core_class->findValues("trn_congviec", "trangthai", array("congviec_id" => $_POST['congviec_id']));
			$myprocess 		 = new process;
			// $_POST variable
			$congviec_id = $_POST['congviec_id'];
			$tencongviec = $_POST['tencongviec'];
			$nguoilienhe = $_POST['nguoilienhe'];
			
			$emailArray = explode(",", $_POST['email']);
				for($i = 0 ; $i < count($emailArray); $i++)
				{
					if (!filter_var($emailArray[$i], FILTER_VALIDATE_EMAIL)) {
						$myObj->isError = 1;
			        	$myObj->msg = "Lỗi, xin vui lòng kiểm tra lại";
						$myJSON = json_encode($myObj);
			            echo $myJSON;
						exit();
					}
					$email .= (($i > 0) ? "," : "") . $emailArray[$i];
				}
			$congty_id = $_POST['congty_id'];
			$loaihinhcongviec_id = implode("|", $_POST['loaihinhcongviec_id']); // Loại hình công việc
			$gioitinh_id = $_POST['gioitinh_id'];
			$dotuoi = $_POST['dotuoi'];
			$kinhnghiem_id = $_POST['kinhnghiem_id'];
			$sonamkinhnghiem = $_POST['sonamkinhnghiem'];
			$yeucauhoso_id = implode("|", $_POST['yeucauhoso_id']); // yêu cầu hồ sơ ngoại ngữ
			$capbac_id = $_POST['capbac_id'];
			$bangcap_id = $_POST['bangcap_id'];
			$phucloi_id = implode("|", $_POST['phucloi_id']); // danh sách phúc lợi
			$mucluongtoithieu = $_POST['mucluongtoithieu'];
			$mucluongtoida = $_POST['mucluongtoida'];
			$loaitien_id = $_POST['loaitien_id'];
			//$tinhthanh_id = $_POST['tinhthanh_id']; // Địa điểm làm việc
			//$noilamviec = $_POST['noilamviec'];
			$chuyenkhoakhac = $_POST['chuyenkhoakhac'];
			$motacongviec = $_POST['motacongviec'];
			$chuyenmonyeucau = $_POST['chuyenmonyeucau'];
			$quyenloi = $_POST['quyenloi'];
			$yeucauhoso = $_POST['yeucauhoso'];
			$nophoso = $_POST['nophoso'];
			//$tentinhthanh = $_POST['noilamviec'];
			$soluongcantuyen = $_POST['soluongcantuyen'];
			$danhmuccv_id = $_POST['danhmuccv_id'];
			$chuyenkhoa_id = $_POST['chuyenkhoa_id'];
			$ngaydang = $_POST['ngaydang'];
			$ngayhethan = $_POST['ngayhethan'];
			$power_job = $_POST['power_job']; // power job
			$hot_job = $_POST['hot_job']; // hot job
			$post_basic = $_POST['post_basic']; // hot job
			$btn_ungtuyen = $_POST['btn_ungtuyen']; 
			$trangthai = $_POST['trangthai'];
			$vip = $_POST['vip']; // hàng đầu
			$id_order = explode(",", $_POST['id_order']);
			$search_key = $core_class->_removesigns($tencongviec);
			$tentinhthanhArray = $_POST['noilamviec'];
			
			for($i = 0 ; $i < count($tentinhthanhArray); $i++)
			{
				$result = $myprocess->getIDtinhthanh($tentinhthanhArray[$i]);
				if ($row = $result->fetch())
				{
					$idTinhthanh .= $row['id'].",";
					$tentinhthanh .= $tentinhthanhArray[$i].",";
				}
			}
			$arrayInput = array(
				'tencongviec' => $tencongviec,
				'search_key' => $search_key,
				'nguoilienhe' => $nguoilienhe,
				'email' => $email,
				'congty_id' => $congty_id,
				'loaihinhcongviec_id' => $loaihinhcongviec_id, // Loại hình công việc
				'gioitinh_id' => $gioitinh_id,
				'dotuoi' => $dotuoi,
				'kinhnghiem_id' => $kinhnghiem_id,
				'sonamkinhnghiem' => $sonamkinhnghiem,
				'yeucauhoso_id' => $yeucauhoso_id, // yêu cầu hồ sơ ngoại ngữ
				'capbac_id' => $capbac_id,
				'bangcap_id' => $bangcap_id,
				'phucloi_id' => $phucloi_id, // danh sách phúc lợi
				'mucluongtoithieu' => $core_class->ctoInt($mucluongtoithieu),
				'mucluongtoida' => $core_class->ctoInt($mucluongtoida),
				'loaitien_id' => $loaitien_id ,
				'tinhthanh_id' => substr($idTinhthanh,0,-1), // Địa điểm làm việc
				'tentinhthanh' => substr($tentinhthanh,0,-1),
				'noilamviec'   => substr($tentinhthanh,0,-1),
				'motacongviec' => $motacongviec,
				'chuyenmonyeucau' => $chuyenmonyeucau,
				'quyenloi' => $quyenloi,
				'yeucauhoso' => $yeucauhoso,
				'nophoso' => $nophoso,
				'soluongcantuyen' => $soluongcantuyen,
				'danhmuccv_id' => $danhmuccv_id,
				'chuyenkhoa_id' => $chuyenkhoa_id,
				'chuyenkhoakhac' => $chuyenkhoakhac,
				'ngaydang' => $core_class->_formatdate($ngaydang),
				'ngayhethan' => $core_class->_formatdate($ngayhethan),
				'hot_job' => $core_class->ctoInt($hot_job), // gợi ý người dùng
				'btn_ungtuyen' => 1,
				'trangthai' => $core_class->ctoInt($trangthai),
				'power_job' => $core_class->ctoInt($power_job), // hàng đầu
				'post_basic' => $core_class->ctoInt($post_basic), // hàng đầu
				'UPDATE_TIME' => date('Y-m-d H:i:s'),
			);
			 $flagUpdate = $core_class->update("trn_congviec", $arrayInput, array(
				'congviec_id' => $congviec_id
			));
			
			if($flagUpdate){
				/*  for($i=0; $i<count($id_order); $i++){
					 
					 $Update_donhang = $core_class->update("trn_customer_detail", $arrayDeatail_DH, array(
						'customer_id' => $id_order[$i]
					));
				  } */
				 if($__trangthai == 0 && $trangthai == 1){
					// Gửi mail khi duyệt tin
					$frontpage = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['frontpage'];
					$link = $frontpage."/".$core_class->_removesigns($_POST["tencongviec"])."-".$_POST["congviec_id"]."-cv.html";
					$subject = "Thông báo đăng tin tuyển dụng tại Y Tế Việc";
					
					$tenCongTy = $core_class->findValues("trn_congty", "tencongty", array("congty_id" => $_POST['congty_id']));
					$mailHTML = "Chào ". $tenCongTy .",<br><br>";
					$mailHTML .= "Xin chúc mừng!<br>";
					$mailHTML .= "Công việc mà bạn đăng lên Y Tế Việc là <b>".$_POST['tencongviec']."</b>, ";
					$mailHTML .= "đã được chúng tôi xác nhận và đưa lên trang web<br>";
					$mailHTML .= '<a target="_blank" style="background-color: #3b5998; font-size: 12px; padding: 10px 15px; color: #fff; text-decoration: none;width: auto;border-radius: 6px;display: inline-block;margin: 10px 0;" href="http://www.facebook.com/sharer/sharer.php?u='.$link.'">';
					$mailHTML .= '<img style="display: block;float: left;margin-right: 5px;" src="http://quanly.yteviec.com/dist/email-img/social-facebook.png" alt="facebook" width="16">';
					$mailHTML .= 'Chia sẻ để tuyển dụng nhanh hơn</a><br>';
					$mailHTML .= "Bạn có thể kiểm tra tin đăng của bạn tại đường link dưới đây.<br>";
					$mailHTML .= "Bạn có thể <a href='https://yteviec.com'>đăng nhập</a> vào tài khoản để cập nhật tài khoản và quản lý ứng viên ứng tuyển.<br>";
					$mailHTML .= $link;
					$mailContent = $core_class->sendMailWithTemplate($subject, $mailHTML);
					
					$emailTo = $_POST["email"];
					$core_class->smtpSendMailCandidate($subject, $mailContent, $emailTo);
				}
				$myObj->isError = 0;
				$myObj->msg = "Cập nhật công việc thành công";
			}else{
				$myObj->isError = 1;
				$myObj->msg = "Lỗi, xin vui lòng kiểm tra lại";
			}
			$myJSON = json_encode($myObj);
			echo $myJSON;
		break;
		
		
		case "Update";
			
			$myprocess		      = new process();
			$pass_update ="";
			$tencongty			  = $_POST['tencongty'];
			$loaihinhhoatdong_id  = $_POST['loaihinhhoatdong_id'];
			$loaihinhhoatdongkhac = $_POST['loaihinhhoatdongkhac'];
			$email				  = $_POST['email'];
			
			if(!empty($_POST['password']))
			{
				$pass_update = $core_class->enscriptPass($_POST['password']);
			}else 
			{
				$pass_update = $_POST['password_2'];
			}
			
			$trangthai		      = $_POST['trangthai'];
			$nguoilienhe          = $_POST['nguoilienhe'];
			$quymo_id             = $_POST['quymo_id'];
			$bvhangdau			  = $_POST['bvhangdau'];
			$hinhanh			  = $_POST['hinhanh'];
			$web				  = $_POST['web'];
			$chude				  = $_POST['chude'];
			$diachicongty		  = $_POST['diachicongty'];
			$sdthoai			  = $_POST['sdthoai'];
			$tinhthanh_id		  = $_POST['tinhthanh_id'];
			$banner				  = $_POST['banner'];
			$urlfacebook		  = $_POST['urlfacebook'];
			$gioithieungan		  = $_POST['gioithieungan'];
			$hinhanhcongty1		  = $_POST['hinhanhcongty1'];
			$hinhanhcongty2		  = $_POST['hinhanhcongty2'];
			$hinhanhcongty3		  = $_POST['hinhanhcongty3'];
			$congty_id		 	  = $_POST['congty_id'];
			$user_update		  = $_POST['user_update'];
			$guimail		      = $_POST['guimail'];
			$link ="http://tuyendung.yteviec.com/";
			if($resultUpdate = $myprocess->Update_company($tencongty,
												$loaihinhhoatdong_id,
												$loaihinhhoatdongkhac,
												$email,
												$pass_update,
												$trangthai,
												$guimail,
												$nguoilienhe,
												$quymo_id,
												$bvhangdau,
												$hinhanh,
												$web,
												$chude,
												$diachicongty,
												$sdthoai,
												$tinhthanh_id,
												$banner,
												$urlfacebook,
												$gioithieungan,
												$hinhanhcongty1,
												$hinhanhcongty2,
												$hinhanhcongty3,
												$user_update,
												$congty_id))
			{
				if(!empty($_POST['guimail'])){
					$makichhoat = md5(sha1(md5(sha1($_POST['email']))));
					$subject = "Kích hoạt tài khoản tại Y Tế Việc";
					$mailHTML = "Chào ".$_POST['email'].",<br><br>";
					$mailHTML .= "Chúc mừng bạn, dưới đây là thông tin tài khoản đã được tạo. <br>";
					$mailHTML .= "Với mật khẩu là:".$_POST['password'].",<br><br>";
					$mailHTML .= '<a style="background-color: #7087A3; font-size: 18px; padding: 15px 15px; color: #fff;display: table;margin: 10px auto; text-decoration: none;border-radius: 5px;">Tài khoản: '.$_POST['email'].'</a>';
					$mailHTML .= "Chỉ thêm một bước nữa, bạn có thể tham gia vào cộng đồng tuyển dụng chuyên nghiệp lớn nhất Việt Nam, Hãy kích hoạt tài khoản của bạn và bắt đầu tuyển dụng ngay hôm nay<br>";
					//$mailHTML .= '<a href="'.$link.'?active='.$makichhoat.'" style="background-color: #f7941d; font-size: 18px; padding: 15px 15px; color: #fff; text-decoration: none;display: table;margin: 10px auto;border-radius: 5px;">KÍCH HOẠT TÀI KHOẢN</a>';

					$mailContent = $core_class->sendMailWithTemplate($subject, $mailHTML);
					$emailTo = $_POST['email'];
						if(!empty($emailTo)){
							
								if($core_class->smtpSendMailCandidate($subject, $mailContent, $emailTo))
								{
									echo "1";
									
								}else
								{
									echo "0";
								}
							}
						}else
						{
							echo '1';
						}
			}else{
				echo "0";
			}
		    // var_dump($where_commonCompany);
			/*  $link ="http://tuyendung.yteviec.com/";
			if(!empty($_POST['guimail']) && !empty($_POST["password"])){
			$makichhoat = md5(sha1(md5(sha1($_POST['email']))));
			$subject = "Kích hoạt tài khoản tại Y Tế Việc";
			$mailHTML = "Chào ".$_POST['email'].",<br><br>";
			$mailHTML .= "Chúc mừng bạn, dưới đây là thông tin tài khoản đã được tạo. <br>";
			$mailHTML .= "Với mật khẩu là:".$_POST['password'].",<br><br>";
			$mailHTML .= '<a style="background-color: #7087A3; font-size: 18px; padding: 15px 15px; color: #fff;display: table;margin: 10px auto; text-decoration: none;border-radius: 5px;">Tài khoản: '.$_POST['email'].'</a>';
			$mailHTML .= "Chỉ thêm một bước nữa, bạn có thể tham gia vào cộng đồng tuyển dụng chuyên nghiệp lớn nhất Việt Nam, Hãy kích hoạt tài khoản của bạn và bắt đầu tuyển dụng ngay hôm nay<br>";
			//$mailHTML .= '<a href="'.$link.'?active='.$makichhoat.'" style="background-color: #f7941d; font-size: 18px; padding: 15px 15px; color: #fff; text-decoration: none;display: table;margin: 10px auto;border-radius: 5px;">KÍCH HOẠT TÀI KHOẢN</a>';

			$mailContent = $core_class->sendMailWithTemplate($subject, $mailHTML);
			$emailTo = $_POST['email'];
				if(!empty($emailTo)){
					$core_class->smtpSendMailCandidate($subject, $mailContent, $emailTo);
				}
			}
			if(!empty($_POST["password"]))
			{
				$_POST["password"] = $core_class->enscriptPass($_POST['password']);
			}
			unset($_POST['act']);
			if($core_class->updateTable_($db_name_company, $where_commonCompany)){
				echo "1";
			}else{
				echo "0";
			} */
		break;
		
		case "Delete";
			//var_dump($_POST);
			
			 if($core_class->Update_WhereTable($db_name, $primary_key." IN(" . $_REQUEST["id"] .")")){
				echo "1";
			}else{
				echo "0";
			}
		break;
		
		case "Upload";
			$core_class->uploadFile();
		break;
		
		case "LoadSearch":
			$process = new process();
			include_once("LoadSearch.php");
		break;
		
		case "LoadDataEdit";
			$core_class->loadJSONDataList2($db_name,"AND ".$primary_key."=".$_REQUEST["id"]);
		break;
		
		case "LoadList";
		  $join = "LEFT JOIN taikhoan ON trn_congviec.user_id = taikhoan.taikhoan_id
					 LEFT JOIN trn_congty ON trn_congty.congty_id = trn_congviec.congty_id";
			$column = "tencongviec,
			CASE WHEN Tendangnhap  IS NULL  THEN trn_congty.email ELSE Tendangnhap END Tendangnhap,trn_congviec.congty_id,loaihinhcongviec_id,trn_congviec.trangthai,
			CASE 
			WHEN trn_congviec.mucluongtoithieu <> '' AND trn_congviec.mucluongtoida <> '' THEN
				CONCAT('Từ ', FORMAT(REPLACE(trn_congviec.mucluongtoithieu,'.',''), 0), ' Đến ', FORMAT(REPLACE(trn_congviec.mucluongtoida,'.',''),0))
			WHEN trn_congviec.mucluongtoithieu <> '' THEN
				CONCAT('Tối thiểu ', FORMAT(REPLACE(trn_congviec.mucluongtoithieu,'.',''),0))
			WHEN trn_congviec.mucluongtoida  <> '' THEN
				CONCAT('Lên đến ', FORMAT(REPLACE(trn_congviec.mucluongtoida,'.',''),0))
			ELSE 'Thỏa thuận' END mucluong
			,soluongcantuyen,DATE_FORMAT(ngayhethan, '%d/%m/%Y') AS ngayhethan,DATE_FORMAT(ngaydang, '%d/%m/%Y') AS ngaydangtin,trn_congviec.user_id,DATE_FORMAT(trn_congviec.DISORDER, '%d/%m/%Y %H:%i:%s') AS ngayposttin,";
			$column .= "congviec_id,hot_job,power_job,congviec_id as action_id,congviec_id as IDNews,";
			$column .= "congviec_id as Link";
			$condition = " ";
			$trang_thai = " " ;
			$tu_ngay = " ";
			$den_ngay = " ";
			$duyet_tin = " ";
			if(isset($_REQUEST["duyet_tin"])){
				$duyet_tin = $_REQUEST["duyet_tin"];
				$condition .= " AND trn_congviec.UPDATE_TIME >='".$core_class->_formatdate($duyet_tin)." 00:00:00'  AND trn_congviec.UPDATE_TIME <='".$core_class->_formatdate($duyet_tin)." 23:59:59'"; 
			}
			if(isset($_REQUEST["status"]) && is_numeric($_REQUEST["status"])){
				$trang_thai = $_REQUEST["status"];
				$condition .= " AND trn_congviec.trangthai ='".$trang_thai."'"; 
			}
			if(isset($_REQUEST["user"])){
				$user = $_REQUEST["user"];
				$condition .= " AND trn_congviec.user_id ='".$user."'"; 
			}
			
			if(isset($_REQUEST["tu_ngay"])){
				$tu_ngay = $_REQUEST["tu_ngay"];
				$condition .= " AND trn_congviec.DISORDER >='".$core_class->_formatdate($tu_ngay)." 00:00:00'"; 
			}
			if(isset($_REQUEST["den_ngay"])){
				$den_ngay = $_REQUEST["den_ngay"];
				$condition .= " AND trn_congviec.DISORDER <='".$core_class->_formatdate($den_ngay)." 23:59:59'"; 
			}
			
			if($_SESSION["session"]['Id'] !=4)
			{
				$condition .='AND trn_congviec.user_id ='.$_SESSION["session"]['Id'];
			}
			$condition .= " AND trn_congviec.trangthai != 2"; 
			$condition .='  AND trn_congviec.DELETE_FLG = 0 ORDER BY trn_congviec.DISORDER DESC';
			//echo @$_REQUEST["den_ngay"];
			//echo $_REQUEST["date"]."aaaa";
		  //echo $_REQUEST["duyet_tin"];
		 //  echo $condition."aaa";
			echo $core_class->getValueFromTableToJSON_Multiple($db_name, $column,$join,$condition);
		break;

		case "search_key";
			$process = new process();
			$result = $process->getListCongViec();
			while($row = $result->fetch()){
				$core_class->update(
					'trn_congviec',
					array('search_key' => $core_class->_removesigns($row['tencongviec'])),
					array('congviec_id' => $row['congviec_id'])
				);
			}
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }