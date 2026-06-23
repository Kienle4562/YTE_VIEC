<?php defined( '_VALID_MOS' ) or die( include("404.php") );
    class process
    {
        public $dbObj;
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		function getInfoCV($id){
			$sql = "SELECT
						trn_candidate_profiles.id,
						trn_candidate_profiles.id AS action_id, 
						trn_candidate_profiles.full_name, 
						trn_candidate_profiles.email,
						trn_candidate_profiles.dob,
						trn_candidate_profiles.phone,
						trn_candidate_profiles.address,
						trn_candidate_profiles.occupation,
						trn_candidate_profiles.workplace
				FROM
					trn_candidate_profiles
				WHERE trn_candidate_profiles.id=?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($id));
		}	
    }
	// Khai báo chung
    $com_name = "candidate_profile";
	$title = "HỒ SƠ ỨNG VIÊN";
	$mota = "Danh sách hồ sơ ứng viên";
	$db_name = "trn_candidate_profiles";
	$primary_key = "id";
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


		case "load_modal_profile_detail";
			//$core_class->uploadFile();
			//var_dump($_POST);
			include_once("profile_detail.php");
		break;

		case "LoadList";
			$column = "
				trn_candidate_profiles.id,
				trn_candidate_profiles.id AS action_id, 
				trn_candidate_profiles.full_name, 
				trn_candidate_profiles.email,
				trn_candidate_profiles.dob,
				trn_candidate_profiles.phone,
				trn_candidate_profiles.address,
				trn_candidate_profiles.occupation,
				trn_candidate_profiles.workplace";
			$condition = " ";
			$trang_thai = " " ;
			$user = " " ;
			$tu_ngay = " ";
			$den_ngay = " ";
	    	
			
			if($_SESSION["session"]['Id'] !=4)
			{
				$condition .='AND user_id ='.$_SESSION["session"]['Id'];
			}
			
			echo $core_class->getValueFromTableToJSON_Multiple($db_name, $column,$join,$condition);
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }