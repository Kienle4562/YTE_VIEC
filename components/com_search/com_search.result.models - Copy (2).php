<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process_category extends com_search
    {
        function get_category($conditon, $offset, $limit)
        {
            $sql = "	
					SELECT
                            `book_product`.`id`,
                            `book_product`.`alias`,
                            `book_product`.`product_name`,
                            `book_product`.`product_image`,
                            `book_product`.`book_category_id`,
                            `book_product`.`price`,
							`book_product`.`thongtinsl`,
                            `book_product`.`discounts`,
                            `book_product`.`discount_type`
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
                                                    `lang_code` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                		`product_category`.`left` >= a.`left` 
                                		AND `product_category`.`right` <= a.`right`
                                		AND `product_category`.`lang_code` = ?
                                
                            )
							$conditon
                            AND `product_category`.`enabled` = 1
                            AND `book_product`.`status` = 1
                    ORDER BY 
                            `book_product`.`order_num` DESC
                    LIMIT 
                            $offset, $limit;
            ";

            return $this->dbObj->SqlQueryOutputResult($sql, array($GLOBALS['LANG'], $GLOBALS['LANG']));
        }
        public function get_category_count( $conditon )
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
                                                    `lang_code` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                		`product_category`.`left` >= a.`left` 
                                		AND `product_category`.`right` <= a.`right`
                                		AND `product_category`.`lang_code` = ?
                            )
							$conditon
                            AND `product_category`.`enabled` = 1
                            AND `book_product`.`status` = 1;
            ";
            
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($GLOBALS['LANG'], $GLOBALS['LANG']));
            
            if ($row = $result->fetch()) {
                return $row['totalrow'];
            }
        }

    }