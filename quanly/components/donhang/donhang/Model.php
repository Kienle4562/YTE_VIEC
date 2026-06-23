<?php defined( '_VALID_MOS' ) or die( include("404.php") );
    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		
		
		public function getSuggesst($email){
				$sql = "SELECT
							trn_congty.congty_id, 
							trn_congty.tencongty, 
							trn_congty.email, 
							trn_congty.nguoilienhe, 
							trn_congty.sdthoai
						FROM
							trn_congty
							WHERE trn_congty.email LIKE '%$email%' AND trn_congty.trangthai = 1 ORDER BY trn_congty.congty_id DESC
							limit 0,10";
			return $this->dbObj->SqlQueryOutputResult($sql, array($email));
		}
		public function get_dichvu(){
			$sql = "SELECT
						mst_service.service_id,
						mst_service.id_function,
						mst_service.service_name,
						mst_service.service_code,
						FORMAT(service_price,0) AS service_price,
						mst_service.description,
						mst_service.operation,
						mst_service.discount,
						mst_service.type_discount,
						mst_service.`status`,
						mst_service.icon,
						mst_service.note
					FROM
						mst_service
						WHERE mst_service.`status` = 1";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		/*Update đơn hàng*/
		function Update_donhang($expiry_date,$activation_date,$payment_stt,$status,$user_id,$UPDATE_DATE,$customer_id)
        {	
		    $sql = "Update trn_customer Set
						expiry_date = ?,
						activation_date = ?,
						payment_stt = ?,
						status = ?,
						user_id = ?,
						UPDATE_DATE = ?
					  WHERE trn_customer.customer_id = ? ";
            if ($this->dbObj->SqlQueryInputResult($sql,array($expiry_date,$activation_date,$payment_stt,$status,$user_id,$UPDATE_DATE,$customer_id))<> FALSE) 
				{
				   return true;
				} else {
				   return false;
				}
			}
		/*END update*/
		/*Update chi tiết đơn hàng*/
		function Update_donhang_detail($trang_thai,$user_id,$UPDATE_DATE,$customer_detail_id)
          {	
		    $sql = "Update trn_customer_detail Set
						trang_thai = ?,
						user_id = ?,
						UPDATE_DATE = ?
					  WHERE trn_customer_detail.customer_detail_id = ? ";
            if ($this->dbObj->SqlQueryInputResult($sql,array($trang_thai,$user_id,$UPDATE_DATE,$customer_detail_id))<> FALSE) 
				{
				   return true;
				} else {
				   return false;
				}
			}
			/*Update chi tiết đơn hàng*/

			/*Update điểm cho cty*/
		function Update_congcty($point,$id_cty)
          {	
		    $sql = "Update trn_congty Set
						point_activer = point_activer + ?
					  WHERE trn_congty.congty_id = ? ";
            if ($this->dbObj->SqlQueryInputResult($sql,array($point,$id_cty))<> FALSE) 
				{
				   return true;
				} else {
				   return false;
				}
			}
			/*Update điểm cho cty*/
		function insert_customer_detail($customer_id,$service_id,$name_function,$function_id,$qty,$don_gia,$trang_thai,$user_id,$INSERT_DATE)
          {	
		    $sql = "INSERT INTO 
                        `trn_customer_detail` ( `customer_id`, `service_id`, `name_function` ,`function_id`,`qty`,`don_gia`,`trang_thai`,`user_id`,`INSERT_DATE`)
                        VALUES (?,?,?,?,?,?,?,?,?)";
            if ($this->dbObj->SqlQueryInputResult($sql,array($customer_id,$service_id,$name_function,$function_id,$qty,$don_gia,$trang_thai,$user_id,$INSERT_DATE))<> FALSE) 
				{
				   return true;
				} else {
				   return false;
				}
			}
			/*Insert don hang 0 dong*/
		function is_add_custom($ma_don_hang,$congty_id,$ten_cong_ty,$email_cong_ty,$phone,$nguoilienhe,$expiry_date,$activation_date,$registration_date,$tong_tien,$payment_stt,$status,$note,$user_id,$DISORDER)
        {	
		    $sql = "INSERT INTO 
                        `trn_customer` ( `ma_don_hang`, `congty_id`, `ten_cong_ty`, `email_cong_ty`, `phone`, `nguoilienhe`,`expiry_date`,`activation_date`,`registration_date`,`tong_tien`,`payment_stt`,`status` ,`note`,`user_id`,DISORDER)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $Id_booking = $this->dbObj->last_insert_id($sql, array($ma_don_hang,$congty_id,$ten_cong_ty,$email_cong_ty,$phone,$nguoilienhe,$expiry_date,$activation_date,$registration_date,$tong_tien,$payment_stt,$status,$note,$user_id,$DISORDER));
		    if($Id_booking > 0){
			    return $Id_booking;
		    } else {
			    return -1;
		    }
		}
		/*END update*/
		
		private function array2list($arr)
			{
				$list = '';
				foreach($arr as $value) {
					$list .= ',' . $value;
				}
				if ($value != '') {
					$list = substr($list, 1);
				}
				return $list;
			}
		public function is_product_exist($id)

        {

            $result = $this->dbObj->SqlQueryOutputResult("

            

                SELECT

                        COUNT(*) as `count`

                FROM

                        `mst_service`

                WHERE

                        `service_id` = ?

            ", array($id));

            if ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                return intval($row['count']);

            }

            else {

                return 0;

            }

        }
		
		public function get_cart_data($cart_array)
			{	
				if (!empty($cart_array)) {
					$id = array_keys($cart_array);
				}else {
					$id = array();
				}					
				if (count($id) > 0){
					$id_list = $this->array2list($id);
					//echo $id_list;
					return $this->dbObj->SqlQueryOutputResult("
						SELECT
							mst_service.service_id,
							mst_service.id_function,
							mst_service.service_name,
							mst_service.service_code,
							mst_service.note,
							mst_service.service_price,
							mst_service.operation,
							mst_service.description,
							mst_service.discount,
							mst_service.type_discount
						FROM
							mst_service
						WHERE
								`service_id` IN ({$id_list})
					", array());
				}else{
					return null;
				}
			}
			
		function generateRandomString($length = 6) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		
		 public function add_to_cart($id, $qty)
			{			

				if (!is_array($_SESSION['cart'])) {

					$_SESSION['cart'] = array();

				}

				if (!empty($_SESSION['cart'][$id])) {

					$_SESSION['cart'][$id]["qty"] += $qty;

				}
				else {

					$_SESSION['cart'][$id]["qty"] = $qty;

				}
				

			}
			
		public function get_order_detail($id)
        {
            $sql = "
				SELECT
					trn_customer.ma_don_hang,
					trn_customer.congty_id,
					trn_customer.ten_cong_ty,
					trn_customer.email_cong_ty,
					trn_customer.phone,
					trn_customer.nguoilienhe,
					FORMAT(tong_tien,0) AS tong_tien,
					FORMAT(gia_tri_giam,0) AS gia_tri_giam,
					FORMAT(giam_km,0) AS giam_km,
					trn_customer.ma_giam,
					trn_customer.kieu_giam  AS style_giam,
					trn_customer.payment_stt,
					trn_customer.payment_method,
					trn_customer.`status`,
					DATE_FORMAT(expiry_date, '%d/%m/%Y') AS ngayhethan,
					DATE_FORMAT(activation_date, '%d/%m/%Y') AS ngaykichhoat,
					from_unixtime(registration_date, '%d/%m/%Y') AS ngaydangky,
					trn_customer.customer_id,
					mst_service.service_name,
					trn_customer_detail.service_id,
					trn_customer_detail.qty,
					trn_customer_detail.giam_gia,
					trn_customer_detail.kieu_giam,
					trn_customer_detail.thanh_tien,
					mst_service.service_code,
					trn_customer_detail.don_gia,
					trn_customer_detail.customer_detail_id,
					trn_customer_detail.so_ngay_sd,
					mst_service.point,
					mst_service.code_function
				FROM
					trn_customer
				INNER JOIN trn_customer_detail ON trn_customer.customer_id = trn_customer_detail.customer_id
				INNER JOIN mst_service ON trn_customer_detail.service_id = mst_service.service_id
				WHERE trn_customer.customer_id = ?
				";
            
            return $this->dbObj->SqlQueryOutputResult($sql, array($id));
        }
		public function order_insert($result,$ma_don_hang,$congty_id,$ten_cong_ty,$email_cong_ty,$phone,$nguoilienhe,$tong_tien,$payment_stt,$payment_method)

        {

            if ($result == null || $result->rowCount() == 0) {

                return false;

            }

            // Sử dụng session_id() và time() làm khoá để Query lại những thông tin

            // của đơn đặt hàng mới sau khi nó đã được thêm vào CSDL.

            $session_id = session_id() . microtime(true);

            $current_time = time();
			$INSERT_DATE = date('Y-m-d H:i:s');
            // Tạo đơn đặt hàng mới
            $is_order_added = $this->dbObj->SqlQueryInputResult(
                "INSERT INTO 
                        `trn_customer` ( `ma_don_hang`, `congty_id`, `ten_cong_ty`, `email_cong_ty`, `phone`, `nguoilienhe`, `registration_date`, `tong_tien`,`payment_stt`, `payment_method`,`status`,`session_id`,`DISORDER`)
                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)", 

                array($ma_don_hang, $congty_id, $ten_cong_ty,$email_cong_ty,$phone,$nguoilienhe,$current_time,$tong_tien,$payment_stt,$payment_method,0,$session_id,$INSERT_DATE)

            );
            // Kiểm tra xem quá trình tạo đơn đặt hàng có thành công hay không?
            if ($is_order_added)

            {

                // Query lại những thông tin của đơn đặt hàng mới để lấy ID và xác nhận chắc

                // chắn rằng nó đã tồn tại trong CSDL.

                $new_order_result = $this->dbObj->SqlQueryOutputResult(

                    "SELECT * FROM `trn_customer` WHERE `session_id` = ? AND `registration_date` = ?", 

                    array($session_id, $current_time)

                );
                // Lấy thông tin đơn đặt hàng mới lưu vào biến $new_order

                if ($new_order = $new_order_result->fetch(PDO::FETCH_ASSOC))

                {

                    $order_detail_sql = "INSERT INTO `trn_customer_detail` (customer_id,service_id,function_id,qty,don_gia,giam_gia,kieu_giam,thanh_tien,trang_thai,INSERT_DATE) VALUES (?,?,?,?,?,?,?,?,?,?)";

                    $total = 0;
                    $sub_total = 0;
                    // Thêm chi tiết đơn đặt hàng vào CSDL

                    while ($row = $result->fetch(PDO::FETCH_ASSOC))

                    {

                        $qty = $_SESSION['cart'][$row['service_id']]["qty"];
                        $discount = $row['discount'];
                        if ($discount !=0) {

                            if ($row['type_discount'] == 2) {
								$giatien     = $row['service_price'] - $discount;
								$total 		  = $giatien * $qty;
                            }
                            elseif ($row['type_discount'] == 1) {
								$giampt  = ($row['service_price'] * $discount)/100;
								$giatien = $row['service_price'] - $giampt;
								$total 	  = $giatien * $qty;
                            }

                        }else
						{
							$total = $row['service_price'] * $qty;
						}
                       
                        $this->dbObj->SqlQueryInputResult(

                            $order_detail_sql,
							array($new_order['customer_id'],$row['service_id'],$row['id_function'],$qty,$row['service_price'],$row['discount'],$row['type_discount'],$total,0,$INSERT_DATE)
                        
                        );

                    }
                    /*

                    // Cập nhật lại giá trị đơn đặt hàng

                    $this->dbObj->SqlQueryInputResult(

                        "UPDATE `book_order` SET `total_order` = ? WHERE `id` = ?",

                        array($total, $new_order['id'])

                    );

                    */
                    $_SESSION['POST'] = $_POST;

					$_SESSION['order_info']['session_id'] = $session_id;

					$_SESSION['order_info']['current_time'] = $current_time;

					$_SESSION['order_info']['order_id'] = $new_order['id'];

					$_SESSION['order_info']['total'] = $total;

					$_SESSION['order_info']['email'] = $email;

                    return true;

                }

                else

                {

                    return false;

                }

            }

            else

            {

                return false;

            }

        }
		
		
    }
	
	// Khai báo chung
    $com_name = "donhang";
	$title = "Danh sách đơn hàng";
	$title_2 = "Đăng ký dịch vụ";
	$mota = "danh sách đơn hàng";
	$db_name = "trn_customer";
	$primary_key = "customer_id";
	$where_common =  $primary_key."='" . $_POST[$primary_key] . "'";
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch(@$_REQUEST["act"]){

        case "";
        	//Action rỗng thì không làm gì cả
        break;
		case "Insert";
		//last_insert_id
          $myprocess = new process();
		  $myObj = new \stdClass();
		  //	$activation_date = date('Y-m-d H:i:s');
		    $activation_date = $core_class->_formatdate($_POST['ngaykichhoat']);
			$current_time = time();
			$dich_vu = $_POST["dich_vu"]; 
			$quantity = $_POST["quantity"];
			$don_gia = $_POST["don_gia"];
			$service_id = $_POST["service_id"];
			$user_id = $_SESSION["session"]["Id"];
			$expiry_date = $core_class->_formatdate($_POST['ngayhethan']);
			$subject = "Đơn hàng Yteviec";
			//$ma_don_hang,$congty_id,$ten_cong_ty,$email_cong_ty,$phone,$nguoilienhe,$expiry_date,$activation_date,$registration_date,$tong_tien,$payment_stt,$status,$note,$user_id
		  if(!empty($_POST['email'])) {
			  $Id_booking = $myprocess->is_add_custom(
						$_POST['ma_don_hang'],
						$_POST['congty_id'],
						$_POST['tencongty'],
						$_POST['email'],
						$_POST['phone'],
						$_POST['nguoilienhe'],
						$expiry_date,
						$activation_date,
						$current_time,
						$_POST['tong_tien'], // tổng tiền
						1, // activer payment_method
						1 ,// trang thai
						$_POST['note'],
						$user_id,
						$activation_date
						); 
				 if($Id_booking > 0)
					{
						for ($i = 0; $i < count($dich_vu); $i++){
						     if($myprocess->insert_customer_detail($Id_booking,$service_id[$i],$dich_vu[$i],$service_id[$i],$quantity[$i],intval($don_gia[$i]),1,$user_id,$activation_date) <> FALSE)
								$check = TRUE;
							}
						//
						ob_start();
						//$cart_data = $myprocess->get_cart_data($_SESSION['cart']);
						include_once("send_emai_order.php");
						$_html_order_information = ob_get_contents();	
						ob_end_clean();
						$core_class->smtpSendMailCandidate($subject, $_html_order_information,$_POST['email']);
					    echo '1';
					}else
						{
							echo '0';
						}  
		  }
        break;
		 case "getSuggesst";
			$myprocess = new process();
			$name = $_POST['name'];
			if(!empty($name)) {
				
				 $result = $myprocess->getSuggesst($name);
				 while($row = $result->fetch()){
					 
					 $data_cty[] = array("congty_id" 	=> $row['congty_id'], 
										"tencongty" 		=> $row['tencongty'],
										"email" 	    	=> $row['email'],
										"nguoilienhe" 		=> $row['nguoilienhe'],
										"sdthoai" 			=> $row['sdthoai']
										);
					}
					 echo json_encode($data_cty);
   				     exit;
			}
        break;
		
	    case "Delete";
			if($core_class->deleteTable($db_name, $primary_key." IN(" . $_REQUEST["id"] .")")){
				echo "1";
			}else{
				echo "0";
			}
		break;
		 
		 case "load_modal_view_service";
			include_once("view.detail.php");
		 break;
		 
		 case "load_modal_add_order";
		   
			include_once("Add.php");
		 break;
		 
		 case "Update";
			 //  var_dump($_POST);
				$INSERT_DATE = date('Y-m-d H:i:s');
			    $myprocess = new process();
				$myObj = new \stdClass();
				$value_sv_array= $_POST['value_sv'];
				$expiry_date_array = $_POST['ngayhethan'];
				$activation_date = date('Y-m-d H:i:s');
				$payment_stt = $_POST['trang_thai_tt'];
				$status  = $_POST['status'];
				$user_id = $_SESSION["session"]["Id"];
				$UPDATE_DATE =  date('Y-m-d H:i:s');
				$customer_id = $_POST['donhang_id'];
				$code_function_array =  $_POST['code_function'];
				$id_cty = $_POST['id_cty'];
				$point_array = $_POST['point'];
				//$link ="http://tuyendung.yteviec.com/";
			if($resultUpdate = $myprocess->Update_donhang($expiry_date,$activation_date,$payment_stt,$status,$user_id,$UPDATE_DATE,$customer_id))
			 {
				for ($i = 0; $i < count($value_sv_array); $i++){
					$expiry_date[$i] = $core_class->_formatdate($expiry_date_array[$i]);
					//$point = $point_array[$i];
				    $resultUpdateDetail = $myprocess-> Update_donhang_detail(1, $user_id,$UPDATE_DATE,$value_sv_array[$i]);
					//if($code_function_array[$i]== "search_cv")
					//{
					//		$resultUpdatecty = $myprocess->Update_congcty($point_array[$i],$id_cty);
					//	}
			     }
				 if(!empty($_POST['email_cong_ty'])){
					//$makichhoat = md5(sha1(md5(sha1($_POST['email']))));
					$subject = "Kích hoạt đơn hàng tại Y Tế Việc";
					$mailHTML = "Chào ".$_POST['email_cong_ty'].",<br><br>";
					$mailHTML .= "Chúc mừng bạn, dưới đây là thông tin đơn hàng đã được tạo. <br>";
					//$mailHTML .= "Với mã đơn hàng:".$_POST['ma_don_hang'].",<br><br>";
					$mailHTML .= '<a style="background-color: #7087A3; font-size: 18px; padding: 15px 15px; color: #fff;display: table;margin: 10px auto; text-decoration: none;border-radius: 5px;">Mã đơn hàng: '.$_POST['ma_don_hang'].'</a>';
					$mailHTML .= "Đơn hàng đã được duyệt, chúc bạn có những trải nghiệm tuyệt vời tại Yteviec.com!<br>";
					//$mailHTML .= '<a href="'.$link.'?active='.$makichhoat.'" style="background-color: #f7941d; font-size: 18px; padding: 15px 15px; color: #fff; text-decoration: none;display: table;margin: 10px auto;border-radius: 5px;">KÍCH HOẠT TÀI KHOẢN</a>';

					$mailContent = $core_class->sendMailWithTemplate($subject, $mailHTML);
					$emailTo = $_POST['email_cong_ty'];
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
		 break;
		 
		 case "LoadList";
			$condition = "WHERE trn_customer.DELETE_FLG = 0 ";
			if(isset($_REQUEST["status"]) && is_numeric($_REQUEST["status"])){
				$trang_thai = $_REQUEST["status"];
				$condition .= " AND trn_customer.status ='".$trang_thai."'"; 
			}
			
			if(isset($_REQUEST["tu_ngay"])){
				$tu_ngay = $_REQUEST["tu_ngay"];
				$condition .= " AND trn_customer.DISORDER >='".$core_class->_formatdate($tu_ngay)." 00:00:00'"; 
			}
			if(isset($_REQUEST["den_ngay"])){
				$den_ngay = $_REQUEST["den_ngay"];
				$condition .= " AND trn_customer.DISORDER <='".$core_class->_formatdate($den_ngay)." 23:59:59'"; 
			}
			
			$sql = "SELECT
							trn_customer.customer_id,
							trn_customer.customer_id AS action_id,
							trn_customer.ma_don_hang,
							trn_customer.ten_cong_ty,
							trn_customer.email_cong_ty,
							trn_customer.phone,
							trn_customer.nguoilienhe,
							DATE_FORMAT(expiry_date, '%d/%m/%Y') AS ngayhethan,
							DATE_FORMAT(activation_date, '%d/%m/%Y') AS ngaykichhoat,
							from_unixtime(registration_date, '%d/%m/%Y') AS ngaydangky,
							FORMAT(tong_tien,0) AS tong_tien,
							FORMAT(gia_tri_giam,0) AS gia_tri_giam,
							FORMAT(giam_km,0) AS giam_km,
							trn_customer.ma_giam,
							trn_customer.kieu_giam  AS style_giam,
							trn_customer.payment_stt,
							trn_customer.payment_method,
							trn_customer.`status` as trangthai
						FROM
							trn_customer $condition ORDER BY  trn_customer.customer_id DESC";
							
		echo $core_class->sqlToJSON($sql);
		break;
			 
        default:
            $core_class->_redirect(".");
        break;
    }