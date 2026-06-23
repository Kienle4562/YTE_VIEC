<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process
    {
	    public $dbObj;
	    
	    function __construct()
	    {
		     $this->dbObj = new classDb();
	    }		

	    // hàm xử lý thêm một mẩu tin vào bảng module
	    function process_addmodules($title, $module, $ordering, $position, $published, $numviews, $access, $showtitle, $params, $iscore, $menu_id, $lang_code){
		    $myprocess = new process;
		    $sql = "insert into modules (`title`, `module`, `ordering`, `position`, `enabled`, `numviews`, `access`, `showtitle`, `params`, `iscore`, `menu_id`, `lang_code`) 
			    values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		    if($this->dbObj->SqlQueryInputResult($sql, array($title, $module, $ordering, $position, $published, $numviews, $access, $showtitle, $params, $iscore, $menu_id, $lang_code)) <> FALSE){
			    return true;
		    }
	    }
	    
	    // ham su lay so thu tu lon nhat cho moi mau tin
	    function process_getmaxid($table, $column){
		    $sql = "select MAX(`$column`)+1 As `MaxId` from `$table`;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    if($row = $result->fetch()){
			    if($row['MaxId'] == 0)	return 1;
			    else return $row['MaxId'];
		    }
	    }
	    
	    public function get_module_type()
	    {
		    $sql = "SELECT `Id`, `module`, `module_name`, `module_description`
				    FROM `sys_module`
				    WHERE `sys_module`.`enabled` = 1
				    ORDER BY `sys_module`.`ordering` DESC;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    return $result;
	    }
	    
	    public function get_position()
	    {
		    $sql = "SELECT `module_position_id`, `position_name`, `position` FROM `module_position`;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    return $result;
	    }
	    
	    public function get_group_menu()
	    {
		    $sql = "SELECT `menu_type`.`Id`, `menu_type`.`title` FROM `menu_type`";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    return $result;
	    }
	    
	    function list_menu ($parentid = 0, $menu_type_id) {
		    $sql = "SELECT `Id`, CONCAT(`link` , `link_id`) as `link`, `title`, `type`, `target` 
				    FROM `menu` 
				    WHERE parent_Id = ? AND `menu_type_id` = ?
				    ORDER BY order_num;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $menu_type_id));
		    return $result;
	    }
	    
    }