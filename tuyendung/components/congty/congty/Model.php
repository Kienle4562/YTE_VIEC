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
		
		case "Update";
			$arrayPost = array(
				"tencongty" => "",
				"nguoilienhe" => "",
				"quymo_id" => "",
				"web" => "",
				"diachicongty" => "",
				"sdthoai" => "",
				"urlfacebook" => "",
				"idyoutube" => "",
				"loaihinhhoatdong_id" => "",
				"hinhanh" => "",
				"banner" => "",
				"gioithieungan" => "",
				"tinhthanh_id" => "",
			);
			// Kiểm tra có key nào không nằm trong list post, nếu có thì trả lỗi
			if(!$core_class->checkKeyPost($arrayPost)){		
				echo "-1";
			}
			else
			{
				// Xóa key không nằm trong list, không cần thiết nhưng để đảm bảo nên có đoạn này
				$_POST = array_intersect_key($_POST, $arrayPost);
				$_POST['trangthai'] = 0;
				if($core_class->updateTable($db_name, "email='".$_SESSION["session"]["Tendangnhap"]."'")){
					echo "1";
				}else{
					echo "0";
				}
			}
		break;
		
		case "Delete";
			if($core_class->deleteTable($db_name, $primary_key." IN(" . $_REQUEST["id"] .") AND email='".$_SESSION["session"]["Tendangnhap"]."'")){
				echo "1";
			}else{
				echo "0";
			}
		break;
		
		case "Upload";
			$core_class->uploadFile();
		break;
		
		case "LoadDataEdit";
				$column = "tencongty,sdthoai,nguoilienhe,quymo_id,hinhanh,
				web,chude,diachicongty,banner,
				urlfacebook,gioithieungan,idyoutube,loaihinhhoatdong_id,tinhthanh_id
			";
			$core_class->loadJSONDataList2($db_name, $column,"AND email='".$_SESSION["session"]["Tendangnhap"]."'");
		break;
		
		case "LoadList";
			$column = "tencongviec,soluongcantuyen,ngayhethan,tinhthanh_id,loaihinhcongviec_id,trangthai as status,";
			$column .= "congviec_id,congviec_id as action_id";
			echo $core_class->getValueFromTableToJSON($db_name, $column, "AND email='".$_SESSION["session"]["Tendangnhap"]."'");
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }