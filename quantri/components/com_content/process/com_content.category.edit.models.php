<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process extends com_content_category
    {
	    // ham su ly chinh sua mot mau tin cua danh muc ( category )
	    function process_edit_category($parent_id, $title, $alias, $description, $date_add, $date_modify, $enabled, $id){
		    $sql = " Update category SET
					    `parent_id` = ?, 
					    `title` = ?, 
					    `alias` = ?, 
					    `description` = ?, 
					    `date_add` = ?, 
					    `date_modify` = ?, 
					    `enabled` = ?
				    WHERE cat_id = ?";
		    if($this->dbObj->SqlQueryInputResult($sql, array($parent_id, $this->dbObj->fix_quotes_dquotes($title), $alias, $description, $date_add, $date_modify, $enabled, $id)) <> FALSE){
			    return true;
		    }
	    }
	    
        /*
	    // ham su ly update catid_array danh mua cha danh muc dang update ( category )
	    function process_update_catid_array_categories( $catid_array, $cat_id ){
		    $sql = "UPDATE category SET `catid_array` = ? WHERE `cat_id` = ?";
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
    	    
	    public function get_category_edit($cat_id)
	    {
		    $sql = "SELECT `cat_id`, `parent_id`, `title`, `alias`, `description`, `date_add`, `enabled`, `lang_code`
				    FROM `category` where `cat_id` = ?;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($cat_id));
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
        
        case "submit_com_content_category_edit";
            $myprocess = new process;
            
            $parent       = $_POST["parent"];
            $title           = $_POST["title"];
            $alias           = $core_class->_removesigns($_POST["alias"]);
            $description  = $_POST["description"];
            $date_add       = $core_class->_formatdate($_POST["date_add"]);
            $date_modify  = $core_class->_formatdate(date("d/m/Y"));
            $published       = $_POST["published"];
            $cid           = intval($_POST["cid"]);
            
            $old_parentid = intval($_POST["old_parentid"]);
            
            if($_POST["task"] == "save"){
                        
                if($myprocess->process_edit_category( $parent, $title, $alias, $description, $date_add, $date_modify, $published, $cid) <> FALSE) {
                    // $myprocess->UpdateChildrenIdList();
                    $myprocess->reset_left_right_value();
                    $core_class->_redirect(".?com=com_content&view=category&task=view");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
                
            } else if ($_POST["task"] == "apply"){
                
                if($myprocess->process_edit_category( $parent, $title, $alias, $description, $date_add, $date_modify, $published, $cid) <> FALSE){
                    // $myprocess->UpdateChildrenIdList();
                    $myprocess->reset_left_right_value();
                    $core_class->_redirect(".?com=com_content&view=category&task=edit&id=" . $cid);
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            } else if($_POST["task"] == "cancel"){
            
                $core_class->_redirect(".?com=com_content&view=category&task=view");
                exit;
                
            }

        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }