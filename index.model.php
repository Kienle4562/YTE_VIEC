<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class index
    {
	    public $dbObj;
	    
	    function __construct()
	    {
		     $this->dbObj = new classDb();
	    }
	    
	    // hàm xử lý thêm một mẩu tin vào bảng mod_customHTML
	    function process_delete_module($module_id)
        {
		    $sql = "
		    		DELETE FROM `mod_slideshow` WHERE `module_id` = ?;
		    		
		    		DELETE FROM `modules` WHERE `module_id` = ?;
		    ";
		    
		    if ($this->dbObj->SqlQueryInputResult($sql, array($module_id, $module_id)) <> FALSE)
		    {
			    return true;
		    }
		    else
		    {
			    return false;
		    }
	    }
	    
	    // hàm xử lý order up bảng modules
	    function process_order_up_module($module_id)
        {
		    $sql = "
                        SELECT 
                            (SELECT 
                                    ordering
                                from
                                    modules
                                WHERE
                                    module_id = ?) As num_current,
                            (SELECT 
                                    ordering
                                from
                                    modules
                                WHERE
                                    ordering > (SELECT 
                                            ordering
                                        from
                                            modules
                                        WHERE
                                            module_id = ?)
                                    AND position IN (SELECT 
                                            position
                                        from
                                            modules
                                        WHERE
                                            module_id = ?
                                    )
                                    AND lang_code = '{$GLOBALS['LANG']}'
                                Order by ordering ASC
                                LIMIT 1) As num_up,
                            (SELECT 
                                    module_id
                                from
                                    modules
                                WHERE
                                    ordering = (SELECT 
                                            ordering
                                        from
                                            modules
                                        WHERE
                                            ordering > (SELECT 
                                                    ordering
                                                from
                                                    modules
                                                WHERE
                                                    module_id = ?
                                                    AND position IN (SELECT 
                                                            position
                                                        from
                                                            modules
                                                        WHERE
                                                            module_id = ?
                                                    )
                                            )
                                            AND position IN (SELECT 
                                                    position
                                                from
                                                    modules
                                                WHERE
                                                    module_id = ?
                                            )
                                            AND lang_code = '{$GLOBALS['LANG']}'
                                        Order by ordering ASC
                                        LIMIT 1)
                                    AND lang_code = '{$GLOBALS['LANG']}'
                            ) As id_up
            ";
		    
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($module_id, $module_id, $module_id, $module_id, $module_id, $module_id));
		    
            if($row = $result->fetch())
            {
			    $sql = "UPDATE `modules` SET `ordering` = ? WHERE `module_id` = ?";
			    
                if ($this->dbObj->SqlQueryInputResult($sql, array($row["num_up"], $module_id)) <> FALSE)
                {
				    if ($this->dbObj->SqlQueryInputResult($sql, array($row["num_current"], $row["id_up"])) <> FALSE)
                    {
					    return true;
				    }
			    }
		    }
	    }
	    
	    // hàm xử lý order down bảng modules
	    function process_order_down_module($module_id)
        {
		    $sql = "
                        SELECT 
                            (SELECT 
                                    ordering
                                from
                                    modules
                                WHERE
                                    module_id = ?) As num_current,
                            
                            
                            (SELECT 
                                    ordering
                                from
                                    modules
                                WHERE
                                    ordering < (SELECT 
                                            ordering
                                        from
                                            modules
                                        WHERE
                                            module_id = ?
                                    )
                                    AND position IN (SELECT 
                                            position
                                        from
                                            modules
                                        WHERE
                                            module_id = ?
                                    )
                                    AND lang_code = '{$GLOBALS['LANG']}'
                                Order by ordering DESC
                                LIMIT 0,1) As num_down,
                            
                            
                            (SELECT 
                                    module_id
                                from
                                    modules
                                WHERE
                                    ordering = (SELECT 
                                            ordering
                                        from
                                            modules
                                        WHERE
                                            ordering < (SELECT 
                                                    ordering
                                                from
                                                    modules
                                                WHERE
                                                    module_id = ?
                                                    AND position IN (SELECT 
                                                            position
                                                        from
                                                            modules
                                                        WHERE
                                                            module_id = ?
                                                    )
                                            )
                                            AND position IN (SELECT 
                                                    position
                                                from
                                                    modules
                                                WHERE
                                                    module_id = ?
                                            )
                                            AND lang_code = '{$GLOBALS['LANG']}'
                                        Order by ordering DESC
                                        LIMIT 1
                                    )
                                    AND lang_code = '{$GLOBALS['LANG']}'
                            ) As id_down
            ";
		    
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($module_id, $module_id, $module_id, $module_id, $module_id, $module_id));
		    
            if ($row = $result->fetch())
            {
			    $sql = "UPDATE `modules` SET `ordering` = ? WHERE `module_id` = ?";
			    
                if ($this->dbObj->SqlQueryInputResult($sql, array($row["num_down"], $module_id)) <> FALSE)
                {
				    if ($this->dbObj->SqlQueryInputResult($sql, array($row["num_current"], $row["id_down"])) <> FALSE)
                    {
					    return true;
				    }
			    }
		    }
	    }
	    
	    // hàm xử lý thay doi vùng hiển thị
	    function process_move_zone($module_id, $position)
        {
		    $sql = "UPDATE `modules` SET `position` = ? WHERE `module_id` = ?";			
		    if($this->dbObj->SqlQueryInputResult($sql, array($position, $module_id)) <> FALSE){
			    return true;
		    }
	    }

    }

    switch($_POST["task"])
    {
        case "";
        	// khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        // xu ly xoa
        case "439353";
            $myprocess = new index;
            $module_id = intval($_POST["module_id"]);
            
            if($myprocess->process_delete_module($module_id) <> FALSE){
                $core_class->reload();
                exit();
            }
        break;
        
        // xu ly order down
        case "379753798";
            $myprocess = new index;
            $module_id = intval($_POST["module_id"]);
            
            if($myprocess->process_order_down_module($module_id) <> FALSE){
                $core_class->reload();
                exit();
            }
        break;
        
        // xu ly order up
        case "9365436";
            $myprocess = new index;
            $module_id = intval($_POST["module_id"]);
            
            if($myprocess->process_order_up_module($module_id) <> FALSE){
                $core_class->reload();
                exit();
            }
        break;
        
        // xu ly di chuyễn vùng hiển thị
        case "79430273";
            $myprocess = new index;
            $module_id = intval($_POST["module_id"]);
            $position = intval($_POST["position"]);

            if($myprocess->process_move_zone($module_id, $position) <> FALSE){
                $core_class->reload();
                exit();
            }

        break;
        
        case "092010":
            if (!empty($_POST['allow_edit_module']) && $_POST['allow_edit_module'] == 1) {
                $_SESSION['allow_edit_module'] = true;
            }
            else {
                unset($_SESSION['allow_edit_module']);
            }
            
            $core_class->reload();
            exit();
        break;
        
        /* Đã chuyển chức năng traslate qua ajax
    	case "789744":
    		$module_name = $_POST['module_name'];
    		
    		unset($_POST['task']);
    		unset($_POST['module_name']);
    		
    		file_put_contents(LANG_PATH . $GLOBALS['LANG'] . '.' . $module_name, serialize($_POST));

    		$core_class->reload();
            exit();
    	break;
        */
        
        default:
            $core_class->_redirect(".");
            exit();
        break;
    }