<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process_mod_product_new extends modules_models
    {
        public function category_multi_level($parentid, $lang_code)
        {
            $sql = "
                    SELECT
                            `cat_id`,
                            `title`
                    FROM
                            `product_category`
                    WHERE
                            `parent_id` = ?
                            AND `lang_code` = ?
            ";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
            return $result;
        }
		
        function get_category($cat_id, $limit, $lang_code)
        {
            $limit_query = "";
            if (is_numeric($limit) && $limit > 0) {
                $limit_query = "LIMIT 0," . $limit;
            }
			$query_sp_noibat = "";
			if ($cat_id == "-1") {
                $query_sp_noibat = "AND `book_product`.`hot_product` = 1";
            }

            $sql = "
                    SELECT
                            `book_product`.`id`,
                            `book_product`.`alias`,
                            `book_product`.`product_name`,
                            `book_product`.`product_image`,
                            `book_product`.`book_category_id`,
                            `book_product`.`price`,
                            `book_product`.`discounts`,
                            `book_product`.`discount_type`,
							`book_product`.`origin`,
							`book_product`.`author`,`book_product`.`attach_info`
                    FROM
                            `product_category` 
                            INNER JOIN `book_product` ON `product_category`.`cat_id` = `book_product`.`book_category_id`
                    WHERE
                            " . (($cat_id > 0) ? "`book_product`.`book_category_id` IN (
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
                                		AND `product_category`.`lang_code` = '" . $lang_code . "'

                            )
                            AND " : "") . " `product_category`.`enabled` = 1
                            AND `book_product`.`status` = 1
                            AND `book_product`.`lang_code` = '" . $lang_code . "'
							$query_sp_noibat
                    ORDER BY 
                             `book_product`.`order_num` DESC
                    {$limit_query}
            ";

			if ($cat_id > 0) {
				return $this->dbObj->SqlQueryOutputResult($sql, array($cat_id));
			}
			else {
				return $this->dbObj->SqlQueryOutputResult($sql, array());
			}
        }

        public function get_category_list($id, $delim = ' » ', $col = 'title', $lang_code = 'vi')
        {
            $cond = '';
            if (is_numeric($id)) {
                $cond = '`cat_id` = ?';
            }
            else {
                $cond = '`alias` = ?';
            }
            $result = $this->dbObj->SqlQueryOutputResult("
                SELECT REPLACE(GROUP_CONCAT(c.`{$col}` ORDER BY c.`left` ASC), ',', '{$delim}') as `result`
                FROM (

                                SELECT

                                        `product_category`.`{$col}`,


                                        '1' as `tmp_col`,


                                        `product_category`.`left`


                                FROM


                                        `product_category`,


                                        (


                                            SELECT


                                                    `left`,


                                                    `right`


                                            FROM


                                                    `product_category`


                                            WHERE


                                                    {$cond}


                                                    AND `lang_code` = '{$lang_code}'


                                            LIMIT 0,1


                                        ) as a


                                WHERE


                                		`product_category`.`left` <= a.`left` 


                                		AND `product_category`.`right` >= a.`right`


                                		AND `product_category`.`lang_code` = '{$lang_code}'


                ) as c


                GROUP BY c.`tmp_col`


            


            ", array($id));


            


            if ($row = $result->fetch(PDO::FETCH_ASSOC)) {


                return $row['result'];


            }


            else {


                return '';


            }


        }


    }