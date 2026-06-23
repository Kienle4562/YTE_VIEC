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
    $com_name = "cvuser";
	$title = "QUẢN LÝ CV";
	$mota = "danh sách CV";
	$db_name = "trn_profilecv";
	$primary_key = "profilecv_id";
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
			$column = "	trn_profilecv.profilecv_id,trn_profilecv.tenprofilecv,ttcn.lastname,ttcn.gender,ttcn.email,	ttcn.mobile,ttcn.capbacmongmuon, trn_profilecv.INSERT_DATE AS ngaytao";
			$join = "INNER JOIN trn_thongtincanhan  ttcn ON trn_profilecv.thongtincanhan_id = ttcn.thongtincanhan_id";
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
			//$condition .=' ORDER BY trn_ungtuyen.DISORDER DESC';
		//	echo $condition;
			echo $core_class->getValueFromTableToJSON_Multiple($db_name, $column,$join,$condition);
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }