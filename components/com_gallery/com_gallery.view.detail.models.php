<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
class process_com_gallery_view_detail {
	
	public $dbObj;
	
	function __construct()
	{
		 $this->dbObj = new classDb();
	}
	
	public function gallery_view_detail( $id )
	{
		$sql = "SELECT `Id`, `title`, `link`,`image_file`, `date_add`
				FROM `mod_gallery` WHERE  gallery_group_id = ? AND `status` = 1 ORDER BY `order_num` desc";
		$result = $this->dbObj->SqlQueryOutputResult($sql, array( $id ));
		return $result;
	}

	
}
?>