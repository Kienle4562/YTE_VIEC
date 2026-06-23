<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class progress
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		public function loadMember(){
			$sql = "SELECT * FROM taikhoan WHERE permission <> 'admin'";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		public function loadDataExportExcel(){
			$sql = "SELECT * FROM taikhoan WHERE permission <> 'admin'";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		public function load_land_quanhuyen($tinhthanh_id)
		{
			$sql = "SELECT id, ten_quanhuyen FROM MST_quanhuyen WHERE tinhthanh_id = ?";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($tinhthanh_id));
			return $result;
		}
    }
	
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch(@$_REQUEST["act"]){

        case "";
        	//Action rỗng thì không làm gì cả
        break;
		
		case "loadquanhuyen";
			$id = $_REQUEST["id"];
			$tinhthanh_id = $_REQUEST["tinhthanh"];
			$content = "<option id=0 value=0 selected>- Chọn quận huyện -</option>";
        	$myprogress = new progress();
			$result = $myprogress->load_land_quanhuyen($tinhthanh_id);
			$selected = "";
			while($row = $result->fetch()){
				if($id == $row["id"]){
					$selected = "selected";
				}else{
					$selected = "";
				}
				$content .= '<option '.$selected.' value="'.$row["id"].'">';
				$content .= $row["ten_quanhuyen"];
				$content .= '</option>';
			}
			echo $content;
        break;
		
		case "ExportExcel";
        	include_once("exportExcel.php");
        break;
		
        default:
            $core_class->_redirect(".");
        break;
    }