<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process extends com_content_category
    {
	    // ham su ly them mot mau tin cua danh sach ( category )
	    function process_addcategories($parent_id, $catname, $alias, $description, $date_add, $date_modify, $ordering, $enabled){
		    $sql = "INSERT INTO category (`parent_id`, `title`, `alias`, `description`, `date_add`, `date_modify`, `ordering`, `enabled`) 
				    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		    $max_catid = $this->dbObj->last_insert_id($sql, array($parent_id, $this->dbObj->fix_quotes_dquotes($catname), $alias, $description, $date_add, $date_modify, $ordering, $enabled));
		    if($max_catid > 0){
			    return $max_catid;
		    } else {
			    return -1;
		    }
	    }
	    
	    // ham su ly update catid_array hien tai ( category )
        /*
	    function process_update_catid_array_categories( $catid_array, $cat_id ) {
		    $sql = "UPDATE category SET `catid_array` = ? WHERE `cat_id` = ?";
		    if($this->dbObj->SqlQueryInputResult($sql, array( $catid_array, $cat_id )) <> FALSE){
			    return true;
		    }
	    }
        */
	    
	    /* ham xu ly tao danh sach cac id con cua danh muc duoc tao */
	    function category_array($parentid = 0, &$list = ''){
		    $myprocess = new process();										
		    $result = $myprocess->category_multi_level($parentid);
		    while($row = $result->fetch()){
			    $list .= "," . $row['cat_id'];
			    $myprocess->category_array($row["cat_id"], $list);
		    }
		    return $list;
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
	    
	    public function get_category_view($parentid, $lang_code)
	    {
		    $sql = "SELECT
				      `category`.`cat_id`, `category`.`title`, `category`.`date_add`, `category`.`enabled`, `category`.`ordering`, `category`.`num_view`
				    FROM `category`
				    WHERE parent_id = ? AND `lang_code` = ?
				    ORDER BY `ordering`";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
		    return $result;
	    }
    }
    
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch($_POST["hidden"])
    {
        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        case "submit_com_content_category_add";
        
            $myprocess = new process;
            
            $parent      = $_POST["parent"];        
            $title          = $_POST["title"];
            $alias          = $core_class->_removesigns($_POST["alias"]);
            $description = $_POST["description"];
            $date_add      = $core_class->_formatdate($_POST["date_add"]);
            $ordering      = $myprocess->process_getmaxid("category", "ordering");
            $enabled      = $_POST["enabled"];
            
            if ($_POST["task"] == "save") {
                $max_catid = $myprocess->process_addcategories( $parent, $title, $alias, $description, $date_add, $date_add, $ordering, $enabled );
                if ($max_catid > 0) {
                    // $myprocess->UpdateChildrenIdList();
                    $myprocess->reset_left_right_value();
                    $core_class->_redirect(".?com=com_content&view=category&task=view");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            } else if ($_POST["task"] == "apply") {
                $max_catid = $myprocess->process_addcategories( $parent, $title, $alias, $description, $date_add, $date_add, $ordering, $enabled );
                if ($max_catid > 0) {
                    /* update catid_array cho category vừa mới thêm */
                    // $myprocess->UpdateChildrenIdList();
                    $myprocess->reset_left_right_value();
                    $core_class->_redirect(".?com=com_content&view=category&task=add");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
                
            } else if($_POST["task"] == "cancel") {
                $core_class->_redirect(".?com=com_content&view=category&task=view");
                exit;
            }

        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }