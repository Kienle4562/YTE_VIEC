<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
		}
		public function get_quyenhan()
			{
					$query = "SELECT
									trn_quyenhan.Id,
									trn_quyenhan.tenquyen,
									trn_quyenhan.alias,
									trn_quyenhan.mota,
									trn_quyenhan.ngaythem,
									trn_quyenhan.trangthai
							FROM
							trn_quyenhan Where trn_quyenhan.trangthai = 1";
				$result = $this->dbObj->SqlQueryOutputResult($query, array());
				return $result;
			}
		public function get_chucnang($quyenhan_id)
			{
				$query = "SELECT
							trn_chucnang.Id,
							trn_chucnang.quyenhan_id,
							trn_chucnang.chucnang
							FROM
							trn_chucnang WHERE trn_chucnang.quyenhan_id = ?";
				$result = $this->dbObj->SqlQueryOutputResult($query, array($quyenhan_id));
				return $result;
			}
	}
	
	// Khai báo chung
    $com_name = "Employee";
	$title = "Nhân Viên";
	$mota = "danh sách nhân viên";
	$db_name = "taikhoan";
	$primary_key = "taikhoan_id";

	$column = array(
		'Tendangnhap' 	  =>  $_POST['account'],
		'Matkhau'   	  =>  $core_class->enscriptPass($_POST['passWd']),
		'Hoten'    	      =>  $_POST['fullname'],
		'Didong'    	  =>  $_POST['phoneNumber'],
		'Ngaythem' 	      => date("Y-m-d H:i:s"),
        'Trangthai' 	  => 1,
        'Email' 	 	  => $_POST['email'] ,
		'Cmnd' 	 		  =>  $_POST['cmnd'],
        'Diachi'    	  =>  $_POST['address'],
		'Ngaysinh'  	  =>  $core_class->_formatdate($_POST['Ngaysinh']),
		'loai_nv'         =>  $_POST['loai_nv'],
        'AUTH_PER' 		  =>  $_POST['AUTH_PER'],
		'AUTH_FUNC' 	  =>  $_POST['AUTH_FUNC'],
	);
	$Editcolumn = array(
		'Tendangnhap' 	  =>  $_POST['taikhoan'],
		'Hoten'    	      =>  $_POST['Hoten'],
		'Didong'    	  =>  $_POST['Didong'],
		'Ngaythem' 	      => date("Y-m-d H:i:s"),
        'Trangthai' 	  => 1,
        'Email' 	 	  => $_POST['email'] ,
		'Cmnd' 	 		  =>  $_POST['cmnd'],
        'Diachi'    	  =>  $_POST['Diachi'],
		'Ngaysinh'  	  =>  $core_class->_formatdate($_POST['Ngaysinh']),
		'loai_nv'         =>  $_POST['loai_nv'],
        'AUTH_PER' 		  =>  $_POST['AUTH_PER'],
		'AUTH_FUNC' 	  =>  $_POST['AUTH_FUNC'],
	);
   $Editpass = array(
		'Matkhau'   	  =>  $core_class->enscriptPass($_POST['passWd']),
	);
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
			if($core_class->insert($db_name, $column)){
				
				echo "1";
			}else{
				echo "0";
			}
		break;
		
		case "Update";
			
			$where = array(
				$primary_key => $_POST[$primary_key]
			);
			
			if($core_class->update($db_name, $Editcolumn, $where)){
				if(!empty($_POST['passWd'])){
					   $core_class->update($db_name, $Editpass, $where);
					   echo "1";
					   
					}else
					{
						echo "1";
					}
			}else{
				echo "0";
			}
		
		break;
		
		case "ImportExcel";
			$myprocess = new process();
			$myprocess->importExcel();
		break;
		
		case "ExportExcel";
			
		break;
		
		case "Delete";
			if($core_class->deleteTable($db_name, $primary_key." IN(" . $_POST["id"] .")")){
				echo "1";
			}else{
				echo "0";
			}
		break;

		case "LoadList";
			$sql = "
				SELECT
					taikhoan.taikhoan_id,
					taikhoan.Tendangnhap,
					taikhoan.Hoten,
					taikhoan.Didong,
					taikhoan.Email,
					taikhoan.Cmnd,
					taikhoan.loai_nv,
					taikhoan.Trangthai as trangthai,
					mst_chucvu.tenchucvu as chucvu,
					taikhoan.taikhoan_id as action_id
				FROM
				taikhoan
				Left Join mst_chucvu on taikhoan.chucvu_id = mst_chucvu.chucvu_id
				WHERE taikhoan.taikhoan_id <> ".$_SESSION['session']['Id'];
			echo $core_class->sqlToJSON($sql);
		break;

		case "ModalEdit";
			$columnEdit = array(
				'taikhoan_id',
				'Tendangnhap',
				'Hoten',
				'Didong',
				'Ngaythem',
				'Trangthai',
				'Email',
				'Cmnd',
				'Diachi',
				'Ngaysinh',
				'loai_nv',
				'chucvu_id',
				'AUTH_PER',
				'AUTH_FUNC',
			);
			$where = array(
				'taikhoan_id' => $_POST['employee_id'],
			);
			$result = $core_class->find('taikhoan', $columnEdit, $where);
			include_once('Edit.php');
		break;

		case "ModalAdd";
			include_once('Add.php');
		break;
		
        default:
            $core_class->_redirect(".");
        break;
    }