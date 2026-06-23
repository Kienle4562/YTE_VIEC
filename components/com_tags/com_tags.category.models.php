<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

	class process_category extends com_content
	{
		function get_category($title, $offset, $limit)
		{
			$sql = "
                    SELECT
					        `news`.`news_id`,
                            `news`.`alias`,
                            `news`.`title`,
                            `news`.`description`,
					        `news`.`img_file`, 
                            `news`.`date_add`, 
                            `news`.`num_view`,
                            `news`.`category_id`
					FROM
					        `news`                             
					WHERE 
                            `news`.`title` like ?
							AND `news`.`lang_code` = ?
							AND `news`.`enabled` = 1
					ORDER BY 
                            `news`.`ordering` DESC
					LIMIT 
                            $offset, $limit;
            ";
			return $this->dbObj->SqlQueryOutputResult($sql, array($title, $GLOBALS['LANG']));
		}
		
		public function get_category_count( $title )
		{
			$sql = "
                    SELECT
						COUNT(`news`.`news_id`) as `totalrow`
					FROM `news`
					WHERE
						`news`.`title` like ?
                        AND `news`.`lang_code` = ?
					    AND `news`.`enabled` = 1;";
			
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($title, $GLOBALS['LANG']));
			
            if ($row = $result->fetch()) {
				return $row['totalrow'];
			}
		}
		
		public function get_sub_category( $startposition, $alias )
		{
			$sql = "
                    SELECT
			                `news`.`news_id`,
                            `category`.`title` as `cat_title`,
                            `news`.`title`, 
                            `news`.`description`, 
					        `news`.`img_file`, 
                            `news`.`date_add`, 
                            `news`.`num_view`,
                            `news`.`category_id`,
                            `news`.`alias`
					FROM
					        `category` 
                            INNER JOIN `news` ON `category`.`cat_id` = `news`.`category_id` 
					WHERE
                            `news`.`category_id` IN (
                                
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
                                                    `alias` = ?
                                                    AND `lang_code` = ?
                                            LIMIT 0,1
                                        ) as a
                                WHERE 
                                		`category`.`left` >= a.`left` 
                                		AND `category`.`right` <= a.`right`
                                		AND `lang_code` = ?
                                
                            )
					        AND `category`.`enabled` = 1
					        AND `news`.`enabled` = 1
					ORDER BY 
                            `news`.`ordering` DESC
					LIMIT 
                            $startposition, 10
            ";

			return $this->dbObj->SqlQueryOutputResult($sql, array($alias, $GLOBALS['LANG'], $GLOBALS['LANG']));
		}
	}