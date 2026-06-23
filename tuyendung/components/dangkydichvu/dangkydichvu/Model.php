<?php defined( '_VALID_MOS' ) or die( include("404.php") );
    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		
		public function get_dichvu(){
			$sql = "SELECT
						mst_service.service_id,
						mst_service.id_function,
						mst_service.service_name,
						mst_service.service_code,
						mst_service.service_price,
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
    }
	
	// Khai báo chung
    $com_name = "dangkydichvu";
	$title= "Đăng ký dịch vụ";
	$mota = "danh sách ứng viên";
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
	
			 
		case "LoadList";
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
			trn_ungtuyen.DISORDER as ngayungtuyen
			FROM
			trn_ungtuyen
			Inner Join trn_congviec ON trn_congviec.congviec_id = trn_ungtuyen.congviec_id
			Inner Join trn_career ON trn_career.career_id = trn_ungtuyen.career_id
			Inner Join trn_congty ON trn_congviec.congty_id = trn_congty.congty_id
			WHERE trn_congty.email = '".$_SESSION["session"]["Tendangnhap"]."'";
			echo $core_class->sqlToJSON($sql);
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }