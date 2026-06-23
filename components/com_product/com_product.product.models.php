<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process_product extends com_product
    {
        function get_product($id, $lang_code)
        {
            $sql = "
                    SELECT
                            `book_product`.`id`,
							`book_product`.SPID,
                            `book_product`.`alias`,
                            `book_product`.`product_name`,
                            `book_product`.`product_image`,
							 book_product.size_product,
							 book_product.color_product,
                            `book_product`.`book_category_id`,
                            `book_product`.`price`,
                            `book_product`.`discounts`,
                            `book_product`.`discount_type`,
                            `book_product`.`spid`,
                            `book_product`.`author`,
                            `book_product`.`attach_info`,
                            `book_product`.`quality`,
                            `book_product`.`origin`,
                            `book_product`.`shipping_costs`,
                            `book_product`.`description`,
                            `book_product`.`content`,
                            `book_product`.`properties_name`,
                            `book_product`.`properties_value`,
                            `book_product`.`status_product`,
                            `book_product`.`show_comment`,
                            `book_product`.`num_view`,
							`product_category`.`type_category`	
                    FROM
                            `book_product`
                            INNER JOIN `product_category` ON `product_category`.`cat_id` = `book_product`.`book_category_id`
                    WHERE 
                            `product_category`.`enabled` = 1
                            AND `book_product`.`status` = 1
                            AND `book_product`.`id` = ?
							AND `book_product`.`lang_code` = ?
                    LIMIT 
                            0, 1;
            ";
            
            return $this->dbObj->SqlQueryOutputResult($sql, array($id, $lang_code));
        }
        
        public function increase_num_view($id)
        {
            $sql = "
                    UPDATE
                            `book_product`
                    SET
                            `book_product`.`num_view` = `book_product`.`num_view` + 1
                    WHERE 
                            `book_product`.`id` = ?
            ";
            
            return $this->dbObj->SqlQueryInputResult($sql, array($id));
        }
        
        public function get_tabs($product_id)
        {
            $sql = "
                    SELECT `id`,`title`,`content`,`product_id`,`status`
                    FROM `book_product_tabs`
                    WHERE `product_id` = ?
                            AND `status` = 1";
            
            return $this->dbObj->SqlQueryOutputResult($sql, array($product_id));
        }
        
        public function get_related_products($category_id, $product_id)
        {
            $sql = "
                    SELECT
						book_product.Id,
						book_product.alias,
						book_product.product_name,
						book_product.size_product,
						book_product.product_image,
						book_product.book_category_id,
						book_product.price,
						book_product.quality,
						product_category.title as `category_title`,
						book_product.num_view
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
                                                    `cat_id` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                		`product_category`.`left` >= a.`left`
                                		AND `product_category`.`right` <= a.`right`
                                		AND `product_category`.`lang_code` = ?
                                
                            )
                            AND `product_category`.`enabled` = 1
                            AND `book_product`.`status` = 1
                            AND `book_product`.`id` <> ?
                    ORDER BY 
                            RAND()
                    LIMIT 
                            0, 10;
            ";
            
            return $this->dbObj->SqlQueryOutputResult($sql, array($category_id, $GLOBALS['LANG'], $product_id));
        }
    }