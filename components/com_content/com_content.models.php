<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class com_content
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
                                        `category`.`{$col}`,
                                        '1' as `tmp_col`,
                                        `category`.`left`
                                FROM
                                        `category`,
                                        (
                                            SELECT
                                                    `left`,
                                                    `right`
                                            FROM
                                                    `category`
                                            WHERE
                                                    {$cond}
                                                    AND `lang_code` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                		`category`.`left` <= a.`left` 
                                		AND `category`.`right` >= a.`right`
                                		AND `category`.`lang_code` = ?
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
									`category`.`title`,
									`category`.`alias`,
									`category`.`cat_id`,
									`category`.`left`
							FROM
									`category`,
									(
											SELECT
															`left`,
															`right`
											FROM
															`category`
											WHERE
															{$cond}
															AND `lang_code` = ?
											LIMIT 0,1
									) as a
							WHERE
									`category`.`left` <= a.`left` 
									AND `category`.`right` >= a.`right`
									AND `category`.`lang_code` = ?
							ORDER BY `category`.`parent_id` ASC
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
                                SELECT `category`.`title`
                                FROM `category`
                                WHERE {$cond} AND `category`.`lang_code` = ?
            ", array($id, $GLOBALS['LANG']));
            
            if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                return $row['title'];
            }
            else {
                return '';
            }
        }
    }