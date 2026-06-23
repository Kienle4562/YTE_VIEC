<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process_coutcate extends modules_models
    {
        public function getData()
        {
            $sql = "SELECT * FROM(SELECT
			trn_congviec.congviec_id,
			trn_danhmuccv.tendanhmuccv,
			trn_danhmuccv.hinhanh,
			trn_danhmuccv.danhmuccv_id,
            trn_danhmuccv.DISORDER,
			count(trn_danhmuccv.danhmuccv_id) as total
			FROM
			trn_danhmuccv
			Inner Join trn_congviec ON trn_congviec.danhmuccv_id = trn_danhmuccv.danhmuccv_id
			WHERE trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0
			GROUP BY danhmuccv_id
			LIMIT 4) tt ORDER BY tt.DISORDER
			";
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