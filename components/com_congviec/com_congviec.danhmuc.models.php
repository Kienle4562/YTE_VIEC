<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
class process_danhmuc_congviec extends com_content
{
	public function get_danhmuc_job($danhmuccv_id, $offset, $limit)
	{
		$sql = "SELECT
		trn_congviec.tencongviec,
		trn_congviec.quyenloi,
		trn_congviec.congviec_id,
		trn_congviec.disorder as ngaydang,
		trn_congty.hinhanh,
		trn_congty.tencongty,
		mst_tinhthanh.ten_tinhthanh as diadiemlamviec,
		CONCAT('Từ ',trn_congviec.mucluongtoithieu, ' đến ',trn_congviec.mucluongtoida) as mucluong
		FROM
		trn_congviec
		LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
		LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
		WHERE trn_congviec.danhmuccv_id = ? AND trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0 ORDER BY trn_congviec.congviec_id DESC LIMIT $offset, $limit;";
		//echo $sql;
		return $this->dbObj->SqlQueryOutputResult($sql, array($danhmuccv_id));
	}
	
	public function get_danhmuc_count($danhmuccv_id)
	{
		$sql = "SELECT
			count(*) as tongcong
		FROM
		trn_congviec
		LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
		LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
		WHERE trn_congviec.danhmuccv_id = ? AND trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0";
		$result = $this->dbObj->SqlQueryOutputResult($sql, array($danhmuccv_id));
		$row = $result->fetch();
		return $row["tongcong"];
	}
}