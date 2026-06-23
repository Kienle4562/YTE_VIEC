<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    class process_menu_3 extends modules_models
    {
	    function get_data_menu ($parentid = 0, $menu_type_id) {
		    $sql = "SELECT `Id`, `link_id` as `link`, `title`, `type`, `target`, `link` as `icon`
				    FROM `menu` 
				    WHERE parent_Id = ?  AND `menu_type_id` = ? AND `activated` = 1 order by order_num;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $menu_type_id));	
		    return $result;
	    }
        
        function get_menu_type_list($lang_code)
        {
            return $this->dbObj->SqlQueryOutputResult("
            
                SELECT
                        `id`,
                        `title`
                FROM
                        `menu_type`
                WHERE
                		`lang_code` = ?
            
            ", array($lang_code));
        }
    }