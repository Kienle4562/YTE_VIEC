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
								trn_function.note_function
							FROM
								trn_function
							WHERE trn_function.status_function = 1";
				$result = $this->dbObj->SqlQueryOutputResult($query, array());
				return $result;
			}
    }
	
	// Khai báo chung
    $com_name = "khuyenmai";
	$title = "DANH SÁCH KHUYẾN MÃI";
	//$mota = "danh sách khuyến mãi";
	$db_name = "mst_khuyen_mai";
	$primary_key = "khuyenmai_id";
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
		  //   var_dump($_POST);
			 $myObj = new \stdClass();
			 $myprocess = new process;
			  $code_km              = $_POST['code_km'];
			  $ten_km               = $_POST['ten_km'];
			  $gia_tri_giam         = $_POST['gia_tri_giam']; 
			  $ngay_het_han         =  $core_class->_formatdate($_POST['ngay_het_han']);
			  $so_luong_ma          = $_POST['so_luong_ma']; 
			  $loai_giam_km        = $_POST['type_discount'];
			  $ghi_chu              = $_POST['ghi_chu'];
			  $status               = $_POST['status'];
			//  $operation        = $_POST['operation'];
			  
			  $arrayInput = array(
				'code_km' => $code_km,
				'ten_km' => $ten_km,
				'gia_tri_giam' => $gia_tri_giam,
				'ngay_het_han' => $ngay_het_han,
				'so_luong_ma' => $so_luong_ma,
				'loai_giam_km' => $loai_giam_km,
				'ghi_chu'      => $ghi_chu,
				'status' => $status,
				'DELETE_FLG' => 0,
				'user_id' => $_SESSION["session"]['Id'],
				'DISORDER' => date('Y-m-d H:i:s')
			);
			$flagInsert = $core_class->lastID_insert("mst_khuyen_mai", $arrayInput);
			if($flagInsert > 0){
				echo '1';
			}else{
				echo '0';
			}
			/* $myJSON = json_encode($myObj);
			echo $myJSON; */
			
		break;
		
		case "Update";
		//	var_dump($_POST);
			if($core_class->updateTable($db_name, $where_common)){
				echo "1";
			}else{
				echo "0";
			}
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
			//$core_class->loadJSONDataList2($db_name,"AND ".$primary_key."=".$_REQUEST["id"]);
		break;
		
		case "LoadList";
			$column = "code_km,ten_km,loai_giam_km,gia_tri_giam,DATE_FORMAT(mst_khuyen_mai.ngay_het_han, '%d/%m/%Y %H:%i:%s') AS ngay_het_han,status,";
			$column .= "khuyenmai_id,khuyenmai_id as action_id";
			echo $core_class->getValueFromTableToJSON($db_name, $column);
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }