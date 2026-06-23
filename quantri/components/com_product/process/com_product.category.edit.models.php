<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process extends com_product_category
    {
	    // ham su ly chinh sua mot mau tin cua danh muc ( category )
	    function process_edit_category($parent_id, $title, $alias, $description,$hinhanh, $date_add, $date_modify, $enabled, $id, $display_type,$type_p)
	    {
		    $sql = " Update product_category SET
					    `parent_id` = ?, 
					    `title` = ?, 
					    `alias` = ?, 
					    `description` = ?,
						`image` = ?, 
					    `date_add` = ?, 
					    `date_modify` = ?, 
					    `enabled` = ?,
						`type_category` = ?
				    WHERE cat_id = ?";
		    if($this->dbObj->SqlQueryInputResult($sql, array($parent_id, $this->dbObj->fix_quotes_dquotes($title), $alias, $description, $hinhanh, $date_add, $date_modify, $enabled,$type_p,$id)) <> FALSE){
			    return true;
		    }
	    }
			    
	    public function get_category_edit($cat_id)
	    {
		    $sql = "SELECT `cat_id`, `parent_id`, `title`, `alias`, `description`,`image`, `date_add`, `enabled`, `lang_code`, `type_category`
				    FROM `product_category` where `cat_id` = ?;";
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
        
        case "submit_com_product_category_edit";
            $myprocess = new process;
            
            $parent       = $_POST["parent"];
            $title           = $_POST["title"];
            $alias           = $core_class->_removesigns($_POST["alias"]);
            $description  = $_POST["description"];
            $date_add       = $core_class->_formatdate($_POST["date_add"]);
            $date_modify  = $core_class->_formatdate(date("d/m/Y"));
            $published       = $_POST["published"];
            $cid           = intval($_POST["cid"]);
            $display_type  = intval($_POST["display_type"]);
            
            $old_parentid = intval($_POST["old_parentid"]);
			$hinhanh = $_POST['image_file'];
            $type_p      	= 	$_POST["type_p"];
            if ($_POST["task"] == "save")
            {
                if ($myprocess->process_edit_category( $parent, $title, $alias, $description,$hinhanh, $date_add, $date_modify, $published, $cid, $display_type,$type_p) <> FALSE)
                {
                	if ($display_type == -1) {
						unset($_APP['config']['com_product']['display_type'][$alias]);
	    			}
	    			else {
						$_APP['config']['com_product']['display_type'][$alias] = $display_type;
	    			}	    	
	    			application_end();
                    
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
                if ($myprocess->process_edit_category( $parent, $title, $alias, $description,$hinhanh, $date_add, $date_modify, $published, $cid, $display_type,$type_p) <> FALSE)
                {
                	if ($display_type == -1) {
						unset($_APP['config']['com_product']['display_type'][$alias]);
	    			}
	    			else {
						$_APP['config']['com_product']['display_type'][$alias] = $display_type;
	    			}	    	
	    			application_end();

                    $myprocess->reset_left_right_value();                    
                    $core_class->_redirect(".?com=com_product&view=category&task=edit&id=" . $cid);
                    exit();
                }
                else
                {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            }
            else if ($_POST["task"] == "cancel")
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