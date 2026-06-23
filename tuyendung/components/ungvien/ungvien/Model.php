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
    $com_name = "ungvien";
	$title = "ỨNG VIÊN";
	$mota = "danh sách ứng viên";
	$db_name = "trn_ungtuyen";
	$primary_key = "ungtuyen_id";
	$where_common =  $primary_key."='" . $_POST[$primary_key] . "' AND email='".$_SESSION["session"]["Tendangnhap"]."'";
	
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