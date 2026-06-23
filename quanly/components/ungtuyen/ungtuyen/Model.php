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
    $com_name = "ungtuyen";
	$title = "ỨNG TUYỂN";
	$mota = "danh sách ứng tuyển";
	$db_name = "trn_ungtuyen";
	$primary_key = "ungtuyen_id";
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
			/* if($core_class->insertTable($db_name)){
				echo "1";
			}else{
				echo "0";
			} */
		break;
		
		case "Update";
			/* if($core_class->updateTable($db_name, $where_common)){
				echo "1";
			}else{
				echo "0";
			} */
		break;
		
		case "Delete";
			/* if($core_class->deleteTable($db_name, $primary_key." IN(" . $_REQUEST["id"] .")")){
				echo "1";
			}else{
				echo "0";
			} */
		break;
		
		case "Upload";
			//$core_class->uploadFile();
		break;
		case "LoadDataEdit";
			//$core_class->loadJSONDataList2($db_name,"AND ".$primary_key."=".$_REQUEST["id"]);
		break;
		
		case "LoadList";
			$column = "trn_congty.tencongty,trn_career.email,trn_career.fullname,trn_career.gioitinh_id,trn_career.ngaysinh,trn_ungtuyen.hoso,trn_ungtuyen.sodienthoai,trn_ungtuyen.gioithieungan,trn_congviec.tencongviec,trn_congviec.congviec_id as IDNews,trn_congviec.ngayhethan,trn_ungtuyen.DISORDER AS ngayungtuyen";
			$join = "LEFT JOIN trn_congviec ON trn_congviec.congviec_id = trn_ungtuyen.congviec_id";
			$join .= " LEFT JOIN trn_career ON trn_career.career_id = trn_ungtuyen.career_id";
			$join .= " LEFT JOIN trn_congty ON trn_congviec.congty_id = trn_congty.congty_id";
			//$column .= "ungtuyen_id,ungtuyen_id as action_id,ungtuyen_id as IDcty";
			$condition = " ";
			$trang_thai = " " ;
			$user = " " ;
			$tu_ngay = " ";
			$den_ngay = " ";
	    	
			if(isset($_REQUEST["user"])){
				$user = $_REQUEST["user"];
				$condition .= " AND trn_congty.congty_id ='".$user."'"; 
			}
			if(isset($_REQUEST["tu_ngay"])){
				$tu_ngay = $_REQUEST["tu_ngay"];
				$condition .= " AND trn_ungtuyen.DISORDER >='".$core_class->_formatdate($tu_ngay)." 00:00:00'"; 
			}
			if(isset($_REQUEST["den_ngay"])){
				$den_ngay = $_REQUEST["den_ngay"];
				$condition .= " AND trn_ungtuyen.DISORDER <='".$core_class->_formatdate($den_ngay)." 23:59:59'"; 
			}
			if($_SESSION["session"]['Id'] !=4)
			{
				$condition .='AND user_id ='.$_SESSION["session"]['Id'];
			}
			/*if($_SESSION["session"]['Id'] !=4)
			{
				$where ='AND user_id ='.$_SESSION["session"]['Id'];
			}*/
			$condition .=' ORDER BY trn_ungtuyen.DISORDER DESC';
			//echo $condition;
			echo $core_class->getValueFromTableToJSON_Multiple($db_name, $column,$join,$condition);
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }