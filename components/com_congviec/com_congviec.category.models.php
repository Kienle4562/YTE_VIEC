<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
class process_danhmuc_congviec extends com_content
{
	public function get_danhmuc_job($condition, $offset, $limit)
	{
		$sql = "
		SELECT
			trn_congviec.tencongviec,
			trn_congviec.quyenloi,
			trn_congviec.congviec_id,
			trn_congviec.disorder as ngaydang,
			trn_congty.hinhanh,
			trn_congty.tencongty,
			mst_tinhthanh.ten_tinhthanh as diadiemlamviec,
			trn_congviec.mucluongtoithieu,
			trn_congviec.mucluongtoida,
			trn_congviec.loaitien_id,
			trn_congviec.power_job
		FROM
			trn_congviec
		LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
		LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
		LEFT Join trn_danhmuccv ON trn_congviec.danhmuccv_id = trn_danhmuccv.danhmuccv_id
		WHERE trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0 {$condition}  AND trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0 ORDER BY trn_congviec.power_job DESC ,trn_congviec.congviec_id DESC LIMIT $offset, $limit;";
		
		return $this->dbObj->SqlQueryOutputResult($sql, array());
		
	}
	public function get_danhmuc_job_fee($condition, $offset, $limit)
	{
		$sql = "SELECT
		trn_congviec.tencongviec,
		trn_congviec.quyenloi,
		trn_congviec.congviec_id,
		trn_congviec.disorder as ngaydang,
		trn_congty.hinhanh,
		trn_congty.tencongty,
		mst_tinhthanh.ten_tinhthanh as diadiemlamviec,
		trn_congviec.mucluongtoithieu,
		trn_congviec.mucluongtoida,
		trn_congviec.loaitien_id
		FROM
		trn_congviec
		LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
		LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
		LEFT Join trn_danhmuccv ON trn_congviec.danhmuccv_id = trn_danhmuccv.danhmuccv_id
		WHERE trn_congviec.trangthai = 1 AND trn_congviec.power_job = 1  AND trn_congviec.DELETE_FLG = 0 {$condition} ORDER BY trn_congviec.congviec_id DESC LIMIT $offset, $limit;";
		
		return $this->dbObj->SqlQueryOutputResult($sql, array());
		
	}
	function getChuyenKhoa($danhmucId){
		$sql = "SELECT * FROM mst_chuyenkhoa WHERE danhmuccv_id = ?";
		$result = $this->dbObj->SqlQueryOutputResult($sql, array($danhmucId));
		return $result;
	}
	
	public function get_danhmuc_count($condition)
	{
		$sql = "SELECT
			count(*) as tongcong
		FROM
		trn_congviec
		LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
		LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
		LEFT Join trn_danhmuccv ON trn_congviec.danhmuccv_id = trn_danhmuccv.danhmuccv_id
		WHERE trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0 {$condition} AND trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0 ";
		$result = $this->dbObj->SqlQueryOutputResult($sql, array());
		$row = $result->fetch();
		return $row["tongcong"];
	}
	
	function getDanhmuccv(){
		$sql = "SELECT * FROM trn_danhmuccv ORDER BY DISORDER";
		$result = $this->dbObj->SqlQueryOutputResult($sql, array());
		return $result;
	}

	function getTinhThanh(){
		$sql = "SELECT * FROM mst_tinhthanh ORDER BY DISORDER DESC";
		$result = $this->dbObj->SqlQueryOutputResult($sql, array());
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
				$html .= '<span>&nbsp;&nbsp;</span>';
				$html .= $row[2];
				$html .= '<span></span>';
			$html .= '</label>';
			$html .= "<span class='f_right'>(".$row[0].")</span>";
			$html .= '</li>';
		}
		$html .= '</div>';
		return $html;
	}

	// tạo radio mức lương filter
	function createRadioSalary()
	{	
		$arrayFilter = array(
			3 => 'Từ 3.000.000 đ',
			5 => 'Từ 5.000.000 đ',
			7 => 'Từ 7.000.000 đ',
			10 => 'Từ 10.000.000 đ',
			15 => 'Từ 15.000.000 đ',
			20 => 'Từ 20.000.000 đ',
			30 => 'Từ 30.000.000 đ',
		);
		$html = '<div class="m-checkbox-inline">';
		foreach($arrayFilter as $key => $value){
			$html .= '<li>';
			$html .= '<label class="m-checkbox">';
				$html .= '<input type="radio" value="' .$key. '" class="radioBox" name="filterSalary">';
				$html .= '<span>&nbsp;&nbsp;</span>';
				$html .= $value;
				$html .= '<span></span>';
			$html .= '</label>';
			$html .= '</li>';
		}
		$html .= '</div>';
		return $html;
	}
}