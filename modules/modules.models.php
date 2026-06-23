<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class modules_models
    {
        public $dbObj;
        
        /*
         *
         */
        function __construct()
        {
             $this->dbObj = new classDb();
        }

        /*
         *
         */
        function process_updatemodules($title, $published, $showtitle, $params, $menu_id, $position, $module_id)
        {
            $myprocess = new modules_models();
            $sql = "
                    UPDATE
                            modules 
                    SET
                            `title` = ?, 
                            `enabled` = ?, 
                            `showtitle` = ?, 
                            `params` = ?, 
                            `menu_id` = ?,
                            `position` = ?
                    WHERE
                            `module_id` = ?
            ";
            
            if ($this->dbObj->SqlQueryInputResult($sql, array($title, $published, $showtitle, $params, $menu_id, $position, $module_id)) <> FALSE) {
                return true;
            }
        }
        
        /*
         *
         */
        public function get_module_edit($module_id)
        {
            $sql = "
                    SELECT
                            `module_id`,
                            `title`,
                            `ordering`,
                            `position`,
                            `enabled`,
                            `module`,
                            `numviews`,
                            `access`,
                            `showtitle`,
                            `params`,
                            `iscore`,
                            `menu_id`,
                            `lang_code`
                    FROM 
                            `modules` 
                    WHERE 
                            `module_id` = ?
            ";
            
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($module_id));
            return $result;
        }

        /*
         *
         */
        public function get_group_menu()
        {
            $sql = "
                    SELECT
                            `menu_type`.`Id` as `group_menu_id`,
                            `menu_type`.`title`
                    FROM 
                            `menu_type`
            ";
            
            $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
            return $result;
        }

        /*
         *
         */
        function list_menu ($parentid = 0, $menu_type_id)
        {
            $sql = "
                    SELECT
                            `Id`,
                            CONCAT(`link` , `link_id`) as `link`,
                            `title`,
                            `type`,
                            `target` 
                    FROM
                            `menu` 
                    WHERE
                            parent_Id = ? 
                            AND `menu_type_id` = ?
                    ORDER BY 
                            order_num
            ";
            
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $menu_type_id));
            return $result;
        }
        
        /*
         *
         */
        public function get_position()
        {
            $sql = "SELECT `module_position_id`, `position_name`, `position` FROM `module_position`;";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
            return $result;
        }
    }