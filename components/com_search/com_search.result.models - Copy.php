<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

	class process_search extends com_search
	{
		function get_result($keyword, $offset, $limit)
		{
			/*
			$sql = "
                    SELECT
					        `news`.`news_id`,
                            `news`.`alias`,
                            `category`.`title` as `cat_title`,
                            `news`.`title`,
                            `news`.`description`,
					        `news`.`img_file`, 
                            `news`.`date_add`, 
                            `news`.`num_view`,
                            `news`.`category_id`
					FROM
						    `category` INNER JOIN `news` ON `category`.`cat_id` = `news`.`category_id`
					WHERE 
                            (
	                            `news`.`title` LIKE '%" . $this->dbObj->fix_quotes_dquotes($keyword) . "%'
	                            OR `news`.`description` LIKE '%" . $this->dbObj->fix_quotes_dquotes($keyword) . "%'
	                            OR `news`.`content` LIKE '%" . $this->dbObj->fix_quotes_dquotes($keyword) . "%'
                            )
                            AND `news`.`lang_code` = ?
					        AND `category`.`enabled` = 1
					        AND `news`.`enabled` = 1
					LIMIT 
                            $offset, $limit;
            ";
			*/
			$sql = "
                    SELECT
                            `book_product`.`id`,
                            `book_product`.`alias`,
                            `book_product`.`product_name`,
                            `book_product`.`product_image`,
                            `book_product`.`book_category_id`,
                            `book_product`.`price`,
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
                                                    `alias` = ?
                                                    AND `lang_code` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                		`product_category`.`left` >= a.`left` 
                                		AND `product_category`.`right` <= a.`right`
                                		AND `product_category`.`lang_code` = ?
                                
                            )
							AND (
	                            `book_product`.`product_name` LIKE '%" . $this->dbObj->fix_quotes_dquotes($keyword) . "%'
	                            OR `book_product`.`description` LIKE '%" . $this->dbObj->fix_quotes_dquotes($keyword) . "%'
                            )
                            AND `product_category`.`enabled` = 1
                            AND `book_product`.`status` = 1
                    ORDER BY 
                            `book_product`.`order_num` DESC
                    LIMIT 
                            $offset, $limit;
            ";
			return $this->dbObj->SqlQueryOutputResult($sql, array($GLOBALS['LANG']));
		}
		
		public function get_result_count($keyword)
		{
			$sql = "
                    SELECT
						    COUNT(`news`.`news_id`) as `totalrow`
					FROM
						    `category` INNER JOIN `news` ON `category`.`cat_id` = `news`.`category_id`
					WHERE 
                            (
	                            `news`.`title` LIKE '%" . $this->dbObj->fix_quotes_dquotes($keyword) . "%'
	                            OR `news`.`description` LIKE '%" . $this->dbObj->fix_quotes_dquotes($keyword) . "%'
	                            OR `news`.`content` LIKE '%" . $this->dbObj->fix_quotes_dquotes($keyword) . "%'
                            )
                            AND `news`.`lang_code` = ?
					        AND `category`.`enabled` = 1
					        AND `news`.`enabled` = 1;
            ";
			
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($GLOBALS['LANG']));
			
            if ($row = $result->fetch()) {
				return $row['totalrow'];
			}
		}
	}