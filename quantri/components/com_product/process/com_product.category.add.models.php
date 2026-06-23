<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process extends com_product_category
    {
	    // ham su ly them mot mau tin cua danh sach ( category )
	    function process_addcategories($parent_id, $catname, $alias, $hinhanh, $description, $date_add, $date_modify, $ordering, $enabled,$checked,$type_p){
		    $sql = "INSERT INTO product_category (`parent_id`, `title`, `alias`, `image`, `description`, `date_add`, `date_modify`, `ordering`, `enabled`,`checked`,`type_category`) 
				    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
		    $max_catid = $this->dbObj->last_insert_id($sql, array($parent_id, $this->dbObj->fix_quotes_dquotes($catname), $alias, $hinhanh, $description,  $date_add, $date_modify, $ordering, $enabled,$checked,$type_p));
		    if($max_catid > 0){
			    return $max_catid;
		    } else {
			    return -1;
		    }
	    }
	    
	    // ham su ly update catid_array hien tai ( category )
        /*
	    function process_update_catid_array_categories( $catid_array, $cat_id ){
		    $sql = "UPDATE product_category SET `catid_array` = ? WHERE `cat_id` = ?";
		    if($this->dbObj->SqlQueryInputResult($sql, array( $catid_array, $cat_id )) <> FALSE){
			    return true;
		    }
	    }
	    */
	    /* ham xu ly tao danh sach cac id con cua danh muc duoc tao */
        /*
	    function category_array($parentid = 0, &$list = ''){
		    $myprocess = new process();										
		    $result = $myprocess->category_multi_level($parentid);
		    while($row = $result->fetch()){
			    $list .= "," . $row['cat_id'];
			    $myprocess->category_array($row["cat_id"], $list);
		    }				
		    return $list;
	    }
	    */
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
				      `product_category`.`cat_id`, `product_category`.`title`, `product_category`.`date_add`, `product_category`.`enabled`, `product_category`.`ordering`, `product_category`.`num_view`
				    FROM `product_category`
				    WHERE parent_id = ? and `lang_code` = ?
				    ORDER BY `ordering`;";
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
        
        case "submit_com_product_category_add";
        
            $myprocess = new process();
            
            $parent      	= 	$_POST["parent"];        
            $title          = 	$_POST["title"];
			$image          = 	$_POST["image_file"];
            $alias          = 	$core_class->_removesigns($_POST["alias"]);
            $description 	= 	$_POST["description"];
            $date_add      	= 	$core_class->_formatdate($_POST["date_add"]);
            $ordering      	= 	$myprocess->process_getmaxid("category", "ordering");
            $enabled      	= 	$_POST["enabled"];
			$type_p      	= 	$_POST["type_p"];
			$hinhanh		= $_POST['image_file'];
			$checked = 0;
            
            $_SESSION['amdin']['com_product']['category']['lang_code'] = 'vi';
            
            if ($_POST["task"] == "save")
            {
                $max_catid = $myprocess->process_addcategories( $parent, $title, $alias, $hinhanh, $description, $date_add, $date_add, $ordering, $enabled,$checked,$type_p);
                if ($max_catid > 0)
                {
                    $myprocess->reset_left_right_value();
                    $core_class->_redirect(".?com=com_product&view=category&task=view");
                    exit();
                }
                else
                {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            }
            else if ($_POST["task"] == "apply")
            {
                $max_catid = $myprocess->process_addcategories( $parent, $title, $alias, $hinhanh, $description,  $date_add, $date_add, $ordering, $enabled,$checked,$type_p);
                if ($max_catid > 0)
                {
                    $myprocess->reset_left_right_value();
                    $core_class->_redirect(".?com=com_product&view=category&task=add");
                    exit();
                }
                else
                {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            }
            else if($_POST["task"] == "cancel")
            {
                $core_class->_redirect(".?com=com_product&view=category&task=view");
                exit;
            }

        break;
        
        default:
            $core_class->_redirect(".");
            exit();
        break;
    }