<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class com_search
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
    }