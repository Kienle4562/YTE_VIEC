<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process_mod_company extends modules_models
    {
        public function getData()
        {
            $sql = "SELECT
			trn_congty.hinhanh,
			trn_congty.tencongty,
			trn_congty.congty_id,
			trn_congty.web,
			trn_congty.diachicongty,
			trn_congty.DISORDER
			FROM
			trn_congty WHERE trn_congty.bvhangdau = 1 ORDER BY DISORDER DESC LIMIT 10";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array());
            return $result;
        }

		public function get_category_list($id, $limit, $lang_code)
        {
        	$limit_query = "";
            
            if (is_numeric($limit) && $limit > 0) {
                $limit_query = "LIMIT " . $limit;
            }
            
            if ($id == 0) {
				$cond = '';
				$sql_params = array($lang_code);
            }
            else {
				$cond = 'AND `category_id` IN
						(
							SELECT
								`category`.`cat_id`
							FROM
								`category`,
								(
									SELECT
											`left`,
											`right`
									FROM
											`category`
									WHERE
											`category`.`cat_id` = ?
									LIMIT 0,1
								) as a
							WHERE
									`category`.`left` >= a.`left`
									AND `category`.`right` <= a.`right` 
									AND `category`.`lang_code` = ?
						)';
				
				$sql_params = array($lang_code, $id, $lang_code);
            }
		 	
			 $sql = "SELECT * FROM `news` WHERE `lang_code` = ? AND `enabled` = 1
			 		 {$cond}
					 order by ordering desc
					 {$limit_query} ";
			$result = $this->dbObj->SqlQueryOutputResult($sql, $sql_params);
			
			return $result;
        }
		
		public function get_category_list_by_newsid($id, $limit, $lang_code)
        {
        	$limit_query = "";
            
            if (is_numeric($limit) && $limit > 0) {
                $limit_query = "LIMIT " . $limit;
            }
            
            if ($id == 0) {
				$cond = '';
				$sql_params = array($lang_code);
            }
            else {
				$cond = 'AND `news`.`news_id` = ?';
				
				$sql_params = array($lang_code, $id);
            }
		 	
			 $sql = "SELECT * FROM `news` WHERE `lang_code` = ? AND `enabled` = 1
			 		 {$cond}
					 order by ordering desc
					 {$limit_query} ";
			$result = $this->dbObj->SqlQueryOutputResult($sql, $sql_params);
			
			return $result;
        }
		
		public function category_list($id, $delim = ' » ', $col = 'title')
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
    }