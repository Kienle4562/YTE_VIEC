<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
class process_danhmuccv extends modules_models
{
	public function getdata(){
		$sql = "SELECT
			COUNT(trn_congviec.congviec_id) AS NUM,
			mst_tinhthanh.id,
			mst_tinhthanh.ten_tinhthanh
		FROM
			mst_tinhthanh
		Left Join trn_congviec ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
		WHERE trn_congviec.trangthai =1 AND trn_congviec.DELETE_FLG=0
		GROUP BY mst_tinhthanh.ten_tinhthanh
		ORDER BY mst_tinhthanh.DISORDER DESC, mst_tinhthanh.ten_tinhthanh";
		$result = $this->dbObj->SqlQueryOutputResult($sql, array());
		return $result;
	}
}