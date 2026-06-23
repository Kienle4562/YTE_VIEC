<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		
		public function get_chucnang()
			{
				$query = "SELECT
								trn_function.id_function,
								trn_function.label_function,
								trn_function.note_function,
								trn_function.attrib_function
							FROM
								trn_function
							WHERE trn_function.status_function = 1";
				$result = $this->dbObj->SqlQueryOutputResult($query, array());
				return $result;
			}
    }
	
	// Khai báo chung
    $com_name = "dichvu";
	$title = "KHAI BÁO GÓI DỊCH VỤ";
	$mota = "danh sách gói dịch vụ";
	$db_name = "mst_service";
	$primary_key = "service_id";
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
		
		case "load_modal_add":
			
			include_once("Add.php");
		break;

		case "load_modal_edit":
			include_once("Edit.php");
		break;
		
		case "Insert";
		 //var_dump($_POST);
			 $myObj = new \stdClass();
			 $myprocess = new process;
			  $INSERT_DATE = date('Y-m-d H:i:s');
			  $service_name     = $_POST['service_name'];
			  $service_code     = $_POST['service_code'];
			  $service_price    = $_POST['service_price']; 
			  $discount         = $_POST['discount'];
			  $type_discount    = $_POST['type_discount']; 
			  $description      = $_POST['description'];
			  $id_function      = $_POST['AUTH_PER'];
			  $status           = $_POST['status'];
			  $operation        = $_POST['operation'];
			  $point            = $_POST['point'];
			  $icon            = $_POST['icon'];
			  $code_function    = $_POST['code_function'];
			  $arrayInput = array(
				'id_function' => $id_function,
				'code_function' => $code_function,
				'service_name' => $service_name,
				'service_code' => $service_code,
				'service_price' => $core_class->ctoInt($service_price),
				'discount' => $core_class->ctoInt($discount),
				'type_discount' => $type_discount,
				'description' => $description,
				'operation'   => $operation,
				'point'       => $point,
				'icon'       => $icon,
				'status' => $status,
				'DELETE_FLG' => 0,
				'user_id' => $_SESSION["session"]['Id'],
				'DISORDER' => $INSERT_DATE,
			);
			$flagInsert = $core_class->lastID_insert("mst_service", $arrayInput);
			if($flagInsert > 0){
				$myObj->isError = 1;
				$myObj->msg = "Thêm dịch vụ thành công";
			}else{
				$myObj->isError = 0;
				$myObj->msg = "Lỗi, xin vui lòng kiểm tra lại";
			}
			$myJSON = json_encode($myObj);
			echo $myJSON;
			
		break;
		
		case "Update";
				$myObj = new \stdClass();
				$myprocess = new process;
					$service_name     = $_POST['service_name'];
					$service_code     = $_POST['service_code'];
					$service_price    = $_POST['service_price']; 
					$discount         = $_POST['discount'];
					$type_discount    = $_POST['type_discount']; 
					$description      = $_POST['description'];
					$status           = $_POST['status'];
					$operation        = $_POST['operation'];
					$point            = $_POST['point'];
					$icon            = $_POST['icon'];
					$service_id            = $_POST['service_id'];
					$arrayInput = array(
						'service_name' => $service_name,
						'service_code' => $service_code,
						'service_price' => $core_class->ctoInt($service_price),
						'discount'      => $core_class->ctoInt($discount),
						'type_discount' => $type_discount,
						'description' => $description,
						'operation'   => $operation,
						'point'       => $point,
						'icon'       => $icon,
						'status' => $status,
						'user_id' => $_SESSION["session"]['Id'],
					);
					$flagUpdate = $core_class->update("mst_service", $arrayInput, array(
					'service_id' => $service_id
				));
					if($flagUpdate > 0){
						$myObj->isError = 1;
						$myObj->msg = "Cập nhật thành công";
					}else{
						$myObj->isError = 0;
						$myObj->msg = "Lỗi, xin vui lòng kiểm tra lại";
					}
				$myJSON = json_encode($myObj);
				echo $myJSON;
			/*if($core_class->updateTable($db_name, $where_common)){
				echo "1";
			}else{
				echo "0";
			}*/
		break;
		
		case "Delete";
			if($core_class->deleteTable($db_name, $primary_key." IN(" . $_REQUEST["id"] .")")){
				echo "1";
			}else{
				echo "0";
			}
		break;
		
		case "Upload";
			$core_class->uploadFile();
		break;
		
		case "LoadDataEdit";
			$core_class->loadJSONDataList2($db_name,"AND ".$primary_key."=".$_REQUEST["id"]);
		break;
		
		case "LoadList";
			$column = "service_name,service_code,FORMAT(service_price,0) AS service_price,description,status,";
			$column .= "service_id,service_id as action_id";
			echo $core_class->getValueFromTableToJSON($db_name, $column);
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }