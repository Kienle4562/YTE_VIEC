<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process_category extends com_product
    {
        function get_category($cat_id, $offset, $limit)
        {
            $sql = "
                    SELECT
                             `book_product`.`id`,
                            `book_product`.`alias`,
                            `book_product`.`product_name`,
                            `book_product`.`product_image`,
							`book_product`.`new_product`,
							`book_product`.`size_product`,
							`book_product`.`color_product`,
                            `book_product`.`book_category_id`,
                            `book_product`.`price`,
                            `book_product`.`discounts`,
							`book_product`.`quality`,
                            `book_product`.`discount_type`,
							`book_product`.`origin`,							
							`book_product`.`author`,
							`book_product`.`attach_info`,
							`book_product`.`properties_name`,
							`book_product`.`properties_value`,
							`book_product`.`description`,
							`product_category`.`type_category`					
                    FROM
                            `product_category` 
                            INNER JOIN `book_product` ON `product_category`.`cat_id` = `book_product`.`book_category_id`
                    WHERE
                            `book_product`.`book_category_id` IN (
                                
                                SELECT
                                        `product_category`.`cat_id`
                                FROM
                                        `product_category`,
                                        (
                                            SELECT
                                                    `left`,
                                                    `right`
                                            FROM
                                                    `product_category`
                                            WHERE
                                                    `product_category`.`cat_id` = ?
                                                    AND `lang_code` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                		`product_category`.`left` >= a.`left` 
                                		AND `product_category`.`right` <= a.`right`
                                		AND `product_category`.`lang_code` = ?
                                
                            )
                            AND `product_category`.`enabled` = 1
                            AND `book_product`.`status` = 1
                    ORDER BY 
                            `book_product`.`order_num` DESC
                    LIMIT 
                            $offset, $limit;
            ";
            return $this->dbObj->SqlQueryOutputResult($sql, array($cat_id, $GLOBALS['LANG'], $GLOBALS['LANG']));
        }
        
		function get_category_hot($cat_id, $offset, $limit)
        {
            $sql = "
                    SELECT
                             `book_product`.`id`,
                            `book_product`.`alias`,
                            `book_product`.`product_name`,
                            `book_product`.`product_image`,
							`book_product`.`new_product`,
							`book_product`.`size_product`,
							`book_product`.`color_product`,
                            `book_product`.`book_category_id`,
                            `book_product`.`price`,
                            `book_product`.`discounts`,
                            `book_product`.`discount_type`,
							`book_product`.`origin`,							
							`book_product`.`author`,
							`book_product`.`attach_info`,
							`book_product`.`properties_name`,
							`book_product`.`properties_value`,
							`book_product`.`description`					
                    FROM
                            `product_category` 
                            INNER JOIN `book_product` ON `product_category`.`cat_id` = `book_product`.`book_category_id`
                    WHERE
                            `book_product`.`book_category_id` IN (
                                
                                SELECT
                                        `product_category`.`cat_id`
                                FROM
                                        `product_category`,
                                        (
                                            SELECT
                                                    `left`,
                                                    `right`
                                            FROM
                                                    `product_category`
                                            WHERE
                                                    `product_category`.`cat_id` = ?
                                                    AND `lang_code` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                		`product_category`.`left` >= a.`left` 
                                		AND `product_category`.`right` <= a.`right`
                                		AND `product_category`.`lang_code` = ?
                                
                            )
                            AND `product_category`.`enabled` = 1
                            AND `book_product`.`status` = 1
						    AND `book_product`.`new_product` = 1
                    ORDER BY 
                            `book_product`.`order_num` DESC
                    LIMIT 
                            $offset, $limit;
            ";
            return $this->dbObj->SqlQueryOutputResult($sql, array($cat_id, $GLOBALS['LANG'], $GLOBALS['LANG']));
        }
        public function get_category_count( $cat_id )
        {
            $sql = "
                    SELECT
                            COUNT(`book_product`.`id`) as `totalrow`
                    FROM
                            `product_category` 
                            INNER JOIN `book_product` ON `product_category`.`cat_id` = `book_product`.`book_category_id` 
                            INNER JOIN `account` ON `account`.`Ac_Id` = `book_product`.`account_id`
                    WHERE
                            `book_product`.`book_category_id` IN (
                                
                                SELECT
                                        `product_category`.`cat_id`
                                FROM
                                        `product_category`,
                                        (
                                            SELECT
                                                    `left`,
                                                    `right`
                                            FROM
                                                    `product_category`
                                            WHERE
                                                    `product_category`.`cat_id` = ?
                                                    AND `lang_code` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                		`product_category`.`left` >= a.`left` 
                                		AND `product_category`.`right` <= a.`right`
                                		AND `product_category`.`lang_code` = ?
                            )
                            AND `product_category`.`enabled` = 1
                            AND `book_product`.`status` = 1;
            ";
            
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($cat_id, $GLOBALS['LANG'], $GLOBALS['LANG']));
            
            if ($row = $result->fetch()) {
                return $row['totalrow'];
            }
        }
		public function get_category_count_hot( $cat_id )
        {
            $sql = "
                    SELECT
                            COUNT(`book_product`.`id`) as `totalrow`
                    FROM
                            `product_category` 
                            INNER JOIN `book_product` ON `product_category`.`cat_id` = `book_product`.`book_category_id` 
                            INNER JOIN `account` ON `account`.`Ac_Id` = `book_product`.`account_id`
                    WHERE
                            `book_product`.`book_category_id` IN (
                                
                                SELECT
                                        `product_category`.`cat_id`
                                FROM
                                        `product_category`,
                                        (
                                            SELECT
                                                    `left`,
                                                    `right`
                                            FROM
                                                    `product_category`
                                            WHERE
                                                    `product_category`.`cat_id` = ?
                                                    AND `lang_code` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                		`product_category`.`left` >= a.`left` 
                                		AND `product_category`.`right` <= a.`right`
                                		AND `product_category`.`lang_code` = ?
                            )
                            AND `product_category`.`enabled` = 1
							AND `book_product`.`new_product` = 1
                            AND `book_product`.`status` = 1;
            ";
            
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($cat_id, $GLOBALS['LANG'], $GLOBALS['LANG']));
            
            if ($row = $result->fetch()) {
                return $row['totalrow'];
            }
        }
        
        public function get_sub_category( $startposition, $alias )
        {
            $sql = "
                    SELECT
                            `book_product`.`id`,
                            `product_category`.`title` as `cat_title`,
                            `book_product`.`product_name`, 
                            `book_product`.`description`, 
                            `book_product`.`product_image`, 
                            `book_product`.`date_add`, 
                            `book_product`.`num_view`,
                            `book_product`.`book_category_id`,
                            `book_product`.`alias`
                    FROM
                            `product_category` 
                            INNER JOIN `book_product` ON `product_category`.`cat_id` = `book_product`.`book_category_id` 
                    WHERE 
                            `book_product`.`book_category_id` IN (
                                
                                SELECT
                                        `product_category`.`cat_id`
                                FROM
                                        `product_category`,
                                        (
                                            SELECT
                                                    `left`,
                                                    `right`
                                            FROM
                                                    `product_category`
                                            WHERE
                                                    `alias` = ?
                                                    AND `lang_code` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                		`product_category`.`left` >= a.`left` 
                                		AND `product_category`.`right` <= a.`right`
                                		AND `product_category`.`lang_code` = ?
                                
                            )
                            AND `product_category`.`enabled` = 1
                            AND `book_product`.`status` = 1
                    ORDER BY 
                            `book_product`.`order_num` DESC
                    LIMIT 
                            $startposition, 10
            ";

            return $this->dbObj->SqlQueryOutputResult($sql, array($alias, $GLOBALS['LANG'], $GLOBALS['LANG']));
            
            /* find_in_set(`book_product`.`book_category_id`, (SELECT `catid_array` FROM `product_category` WHERE `product_category`.`alias` = ?)) */
        }
    }