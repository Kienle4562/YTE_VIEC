<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		
		function getCategory(){
		    $sql = "SELECT * FROM mst_chuyenkhoa";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array());
		    return $result;
	    }
		
		function getTinhThanh(){
		    $sql = "SELECT * FROM mst_tinhthanh ORDER BY DISORDER";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array());
		    return $result;
	    }
        
        public function get_list($condition)
		{
			$sql = "SELECT
			trn_archive.archive_id,
			trn_archive.archive_name,
			trn_archive.archive_image,
			trn_archive.archive_content,
			mst_chuyenkhoa.chuyenkhoa_name
			FROM
			trn_archive
			Left Join mst_chuyenkhoa ON mst_chuyenkhoa.chuyenkhoa_id = trn_archive.chuyenkhoa_id	
			WHERE 1=1 {$condition}";
			return $this->dbObj->SqlQueryOutputResult($sql, array());
		}
		
		public function get_count($condition)
		{
			$sql = "SELECT
				count(*) as tongcong
			FROM
			trn_archive
			Left Join mst_chuyenkhoa ON mst_chuyenkhoa.chuyenkhoa_id = trn_archive.chuyenkhoa_id	
			WHERE 1=1 {$condition}";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array());
			$row = $result->fetch();
			return $row["tongcong"];
		}
    }