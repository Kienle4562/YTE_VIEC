<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		
		public function get_danhmuc()
			{
				$query = "SELECT
								trn_danhmuccv.danhmuccv_id,
								trn_danhmuccv.tendanhmuccv,
								trn_danhmuccv.search_key,
								trn_danhmuccv.hinhanh,
								trn_danhmuccv.user_id,
								trn_danhmuccv.DISORDER
							FROM
								trn_danhmuccv";
				$result = $this->dbObj->SqlQueryOutputResult($query, array($quyenhan_id));
				return $result;
			}
			
		public function get_chuyenkhoa($id_danhmuc)
			{
				$query = "SELECT
								mst_chuyenkhoa.chuyenkhoa_id,
								mst_chuyenkhoa.chuyenkhoa_name,
								mst_chuyenkhoa.danhmuccv_id,
								mst_chuyenkhoa.DISORDER,
								mst_chuyenkhoa.DELETE_DATE
							FROM
								mst_chuyenkhoa WHERE mst_chuyenkhoa.danhmuccv_id = ?";
				$result = $this->dbObj->SqlQueryOutputResult($query, array($id_danhmuc));
				return $result;
			}	
    }
	
	// Khai báo chung
    $com_name = "chuyenkhoa";
	$title = "CHUYÊN KHOA";
	$mota = "DANH SÁCH CHUYÊN KHOA";
	$db_name = "mst_chuyenkhoa";
	$primary_key = "chuyenkhoa_id";
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
			if($core_class->insertTable($db_name)){
				echo "1";
			}else{
				echo "0";
			}
		break;
		
		case "load_edit_chuyenkhoa";
			include_once("Edit.php");
		break;
		
		case "Update";
			echo $where_common;
			/* if($core_class->updateTable($db_name, $where_common)){
				echo "1";
			}else{
				echo "0";
			} */
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
			$column = "tendanhmuccv,";
			$column .= "danhmuccv_id,danhmuccv_id as action_id";
			echo $core_class->getValueFromTableToJSON($db_name, $column);
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }