<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
		}

		function checkTuyenDung($congtyId){
			$sql = "SELECT
				COUNT(congviec_id)
			FROM
				trn_congviec
			WHERE congty_id = ? AND ngayhethan >= SYSDATE()";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($congtyId));
			$row = $result->fetch();
			if($row[0] > 0){
				return true;
			}
			return false;
		}
		
		function checkCongty($congtyId){
			$sql = "SELECT
				COUNT(congty_id) AS congty
			FROM
				trn_congty
			WHERE loaihinhhoatdong_id = ? ";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($congtyId));
			return $result;
		}
		
		// tạo radio box theo id của cột
        function createCheckBox($sql)
        {	
			$result = $this->dbObj->SqlQueryOutputResult($sql, array());
			$html = '<div class="m-checkbox-inline">';
			while($row = $result->fetch()){
				$html .= '<li>';
				$html .= '<label class="m-checkbox">';
					$html .= '<input type="checkbox" value="' .$row[1]. '" class="chkCheckBox ' .$columnId. '">';
					$html .= $row[$content]." ";
					$html .= $row[2];
					$html .= '<span></span>';
				$html .= '</label>';
				$html .= "<span class='f_right'>(".$row[0].")</span>";
				$html .= '</li>';
			}
			$html .= '</div>';
			return $html;
        }
		
		function getDanhmuccv(){
		    $sql = "SELECT * FROM trn_danhmuccv";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array());
		    return $result;
	    }
		
		function getTinhThanh(){
		    $sql = "SELECT * FROM mst_tinhthanh ORDER BY DISORDER DESC";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array());
		    return $result;
	    }
        
        public function get_list_company($condition)
		{
			$sql = "SELECT
			trn_congty.congty_id,
			trn_congty.tencongty,
			trn_congty.hinhanh,
			trn_congty.diachicongty
			FROM
			trn_congty
			Left Join mst_tinhthanh ON mst_tinhthanh.id = trn_congty.tinhthanh_id
			Left Join mst_loaihinhhoatdong ON mst_loaihinhhoatdong.loaihinhhoatdong_id = trn_congty.loaihinhhoatdong_id
			WHERE 1=1 {$condition}";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		
		 public function get_list_company_fix($condition,$offset, $limit)
			{
			$sql = "SELECT
						trn_congty.congty_id,
						trn_congty.tencongty,
						trn_congty.hinhanh,
						trn_congty.diachicongty,
						trn_congviec.ngayhethan,
						trn_congty.loaihinhhoatdong_id,
						trn_congty.sdthoai
						FROM
						trn_congty
						LEFT JOIN mst_tinhthanh ON mst_tinhthanh.id = trn_congty.tinhthanh_id
						LEFT JOIN mst_loaihinhhoatdong ON mst_loaihinhhoatdong.loaihinhhoatdong_id = trn_congty.loaihinhhoatdong_id
						LEFT JOIN trn_congviec ON trn_congviec.congty_id = trn_congty.congty_id
						WHERE
						1 = 1 {$condition} GROUP BY trn_congty.congty_id ORDER BY  trn_congviec.ngayhethan >= SYSDATE() DESC  LIMIT 
                            $offset, $limit";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		public function get_company_count($condition)
		{
			 $sql = "SELECT
				count(trn_congty.congty_id) as tongcong
			FROM
			trn_congty
			Left Join mst_tinhthanh ON mst_tinhthanh.id = trn_congty.tinhthanh_id
			Left Join mst_loaihinhhoatdong ON mst_loaihinhhoatdong.loaihinhhoatdong_id = trn_congty.loaihinhhoatdong_id
			WHERE 1=1 {$condition}";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array());
			$row = $result->fetch();
			return $row["tongcong"];
		}
		
    }
	if (!empty($_POST['act']))
    {
		switch ($_POST['act'])
        {
			case "benhvien":
				//var_dump($_POST);
				$myprocess = new process();
				include_once('Load_com_company.php');
			break;
			case "phongkham":
			//	var_dump($_POST);
				$myprocess = new process();
				include_once('Load_com_company.php');
			break;
			case "congtyyte":
				//var_dump($_POST);
				$myprocess = new process();
				include_once('Load_com_company.php');
			break;
			case "timtruongyvacosoytekhac":
			//	var_dump($_POST);
				$myprocess = new process();
				include_once('Load_com_company.php');
			break;
			
			case "loaihinhhoatdong":
				//var_dump($_POST);
				$myprocess = new process();
				include_once('Load_loai_hinh.php');
			break;
			// Loai hinh
			
		}
	}