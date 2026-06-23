<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );



    class process_product_category extends modules_models

    {

		function lay_danhmucsanpham_parent($parent_id){

			$sql = "select * from product_category where parent_id = ? limit 4";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($parent_id));

            return $result;

		}
		function get_is_child($id){
			$sql = "select count(cat_id) as tongcong from product_category where parent_id=?";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($id));
			$row = $result->fetch();
			return $row["tongcong"];
		}
		function lay_danhmucsanpham_child($product_category_id){

			$sql = "select * from product_category where cat_id = ?";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($product_category_id));

            return $result;

		}

        public function category_multi_level($parentid, $lang_code)

        {

            $sql = "

                    SELECT
							*

                    FROM

                            `product_category`

                    WHERE

                            `parent_id` = ?

                            AND `lang_code` = ?
					

            ";

            

            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));

            

            return $result;

        }

        

        public function get_category_list($id, $delim = ' » ', $col = 'title', $lang_code)

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

                                                    AND `lang_code` = ?

                                            LIMIT 0,1

                                        ) as a

                                WHERE

                                		`product_category`.`left` <= a.`left`

                                		AND `product_category`.`right` >= a.`right`

                                		AND `product_category`.`lang_code` = ?

                ) as c

                GROUP BY c.`tmp_col`

            

            ", array($id, $lang_code, $lang_code));

            

            if ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                return $row['result'];

            }

            else {

                return '';

            }

        }

    }