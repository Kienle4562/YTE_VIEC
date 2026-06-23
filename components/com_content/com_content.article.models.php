<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	
    class process_article extends com_content
	{
		public function get_article( $news_id )
		{
			$sql = "
                    SELECT 
						    `news`.`news_id`,
                            `news`.`title`,
                            `news`.`description`,
                            `news`.`content`,
                            `news`.`img_file`,
						    `news`.`date_add`,
                            `news`.`num_view`,
							`news`.`keyword`,
							`news`.`keyword_desc`,
							`news`.`tags`,
                            `news`.`alias`,
                            `news`.`category_id`,
							`news`.`comment`,
							`account`.`userName`,
							`account`.`fullName`,
							`category`.`title` as `cat_title`
					FROM 
                            news
					INNER JOIN account ON account.Ac_Id = news.acc_id
					INNER JOIN category ON news.category_id = category.cat_id 
					AND news.category_id = category.cat_id 
					AND news.category_id = category.cat_id AND news.category_id = category.cat_id
					WHERE 
                            `news`.`news_id` = ?
                            AND `news`.`lang_code` = ?
					ORDER BY 
                            `news`.`ordering` DESC			
					LIMIT 1
            ";
			
			return $this->dbObj->SqlQueryOutputResult($sql, array( $news_id, $GLOBALS['LANG'] ));
		}
		
		public function get_other_news($news_id)
		{
			$sql = "
                    SELECT 
			                `news`.`news_id`,
                            `news`.`title`,
                            `news`.`alias`,
                            `news`.`category_id`,
                            `news`.`date_add`
							
					FROM 
							`news`
					
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
                                                    `cat_id` IN (
                                                        SELECT `category_id`
                                                        FROM `news`
                                                        WHERE `news_id` = ?
                                                    )
                                            LIMIT 0,1
                                        ) as a
                                WHERE
                                        `category`.`left` >= a.`left` 
                                        AND `category`.`right` <= a.`right`
                                        AND `category`.`enabled` = 1
                                        AND `category`.`lang_code` = ?
                            )
                            AND `news`.`enabled` = 1
                            AND `news`.`news_id` != ?
						
					ORDER BY 
							`news`.`ordering` DESC 
						
			";
			
			return $this->dbObj->SqlQueryOutputResult($sql, array($news_id, $GLOBALS['LANG'], $news_id));
		}
	}
?>
