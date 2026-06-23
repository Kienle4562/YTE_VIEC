<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class com_product
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
        
        public function get_category_list($id, $delim = ' » ', $col = 'title')
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
            
            ", array($id, $GLOBALS['LANG'], $GLOBALS['LANG']));
            
            if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                return $row['result'];
            }
            else {
                return '';
            }
        }
		
		public function get_pathway($id)
        {
            $cond = '';

            if (is_numeric($id)) {
                $cond = '`cat_id` = ?';
            }
            else {
                $cond = '`alias` = ?';
            }

			$sql = "SELECT c.`title`, c.`alias`, c.`cat_id`
					FROM (
							SELECT
									`product_category`.`title`,
									`product_category`.`alias`,
									`product_category`.`cat_id`,
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
							ORDER BY `product_category`.`parent_id` ASC
					) as c";		
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($id, $GLOBALS['LANG'], $GLOBALS['LANG']));
            
            return $result->fetchAll();
        }
		
		public function get_category_title($id)
        {
            $cond = '';

            if (is_numeric($id)) {
                $cond = '`cat_id` = ?';
            }
            else {
                $cond = '`alias` = ?';
            }

            $result = $this->dbObj->SqlQueryOutputResult("
                                SELECT `product_category`.`title`
                                FROM `product_category`
                                WHERE {$cond} AND `product_category`.`lang_code` = ?
            ", array($id, $GLOBALS['LANG']));
            
            if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                return $row['title'];
            }
            else {
                return '';
            }
        }
		
    }