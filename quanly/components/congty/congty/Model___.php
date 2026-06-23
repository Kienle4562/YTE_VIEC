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
    $com_name = "congty";
	$title = "CÔNG TY";
	$mota = "danh sách công ty";
	$db_name = "trn_congty";
	$primary_key = "congty_id";
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
			$column = "tencongty,CASE WHEN Tendangnhap  IS NULL  THEN trn_congty.email ELSE Tendangnhap END Tendangnhap,trn_congty.hinhanh,diachicongty,DATE_FORMAT(trn_congty.DISORDER, '%d/%m/%Y %H:%i:%s') AS ngayposttin,user_id,";
			$join = "LEFT JOIN taikhoan ON trn_congty.user_id = taikhoan.taikhoan_id";
			$column .= "congty_id,congty_id as action_id,congty_id as IDcty";
			$condition = " ";
			$trang_thai = " " ;
			$user = " " ;
			$tu_ngay = " ";
			$den_ngay = " ";
			if(isset($_REQUEST["status"]) && is_numeric($_REQUEST["status"])){
				$trang_thai = $_REQUEST["status"];
				$condition .= " AND trn_congty.trangthai ='".$trang_thai."'"; 
			}
			if(isset($_REQUEST["user"])){
				$user = $_REQUEST["user"];
				$condition .= " AND trn_congty.user_id ='".$user."'"; 
			}
			if(isset($_REQUEST["tu_ngay"])){
				$tu_ngay = $_REQUEST["tu_ngay"];
				$condition .= " AND trn_congty.DISORDER >='".$core_class->_formatdate($tu_ngay)." 00:00:00'"; 
			}
			if(isset($_REQUEST["den_ngay"])){
				$den_ngay = $_REQUEST["den_ngay"];
				$condition .= " AND trn_congty.DISORDER <='".$core_class->_formatdate($den_ngay)." 23:59:59'"; 
			}
			if($_SESSION["session"]['Id'] !=4)
			{
				$condition .='AND user_id ='.$_SESSION["session"]['Id'];
			}
			/*if($_SESSION["session"]['Id'] !=4)
			{
				$where ='AND user_id ='.$_SESSION["session"]['Id'];
			}*/
			$condition .=' ORDER BY trn_congty.DISORDER DESC';
			//echo $condition;
			echo $core_class->getValueFromTableToJSON_Multiple($db_name, $column,$join,$condition);
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }