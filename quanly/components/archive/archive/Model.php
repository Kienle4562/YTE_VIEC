<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
    }
	
	// Khai báo chung
    $com_name = "archive";
	$title = "TÀI LIỆU CHUYÊN KHOA";
	$mota = "danh sách tài liệu chuyên khoa";
	$db_name = "trn_archive";
	$primary_key = "archive_id";
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
		
		case "Update";
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
			$core_class->loadJSONDataList2($db_name,"AND ".$primary_key."=".$_REQUEST["id"]);
		break;
		
		case "LoadList";
			$column = "archive_name,";
			$column .= "archive_id,archive_id as action_id";
			echo $core_class->getValueFromTableToJSON($db_name, $column);
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }