<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
class process_com_gallery_view_group {
	
	public $dbObj;
	
	function __construct()
	{
		 $this->dbObj = new classDb();
	}
	
	public function gallery_view_group(  )
	{
		$sql = "SELECT `Id`, `title`, `img_file`, `date_add`, `status`, `order_num`
				FROM `mod_gallery_group` 
				WHERE `status` = 1 
				ORDER BY `order_num` desc";
		$result = $this->dbObj->SqlQueryOutputResult($sql, array( 0 ));
		return $result;
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