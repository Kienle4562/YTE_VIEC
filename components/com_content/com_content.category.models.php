<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

class process_category extends com_content
{
        function getBaiVietNoiBat(){
                $sql = "SELECT news_id, img_file, alias, num_view, title, description FROM news WHERE category_id = 233 AND focus = 1 ORDER BY ordering DESC LIMIT 1";
                return $this->dbObj->SqlQueryOutputResult($sql, array());
        }
        
        function get_category($cat_id, $offset, $limit, $condition = "", $orderby = "ORDER BY  `news`.`ordering` DESC")
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
                        `news`.`category_id`,
                                                `account`.`userName`,
                                                `account`.`fullName`,
                                                `category`.`title` as `cat_title`
                                FROM
                                        category
                                                INNER JOIN news ON category.cat_id = news.category_id
                                                INNER JOIN account ON account.Ac_Id = news.acc_id
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
                                                `category`.`cat_id` = ?
                                        LIMIT 0,1
                                ) as a
                        WHERE
                                        `category`.`left` >= a.`left` 
                                        AND `category`.`right` <= a.`right`
                        
                        )
                        AND `category`.`enabled` = 1
                        AND `news`.`enabled` = 1
                        $condition
                        $orderby
                        LIMIT $offset, $limit;
        ";
                return $this->dbObj->SqlQueryOutputResult($sql, array($cat_id));
        }
        
        public function get_category_count( $cat_id )
        {
                $sql = "
                        SELECT
                        COUNT(`news`.`news_id`) as `totalrow`
                                FROM
                                                `category` 
                        INNER JOIN `news` ON `category`.`cat_id` = `news`.`category_id` 
                        INNER JOIN `account` ON `account`.`Ac_Id` = `news`.`acc_id`
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
                                                `category`.`cat_id` = ?
                                                AND `lang_code` = ?
                                        LIMIT 0,1
                                ) as a
                        WHERE
                                        `category`.`left` >= a.`left` 
                                        AND `category`.`right` <= a.`right`
                                        AND `lang_code` = ?
                        
                        )
                                        AND `category`.`enabled` = 1
                                        AND `news`.`enabled` = 1;
        ";
                
        $result = $this->dbObj->SqlQueryOutputResult($sql, array($cat_id, $GLOBALS['LANG'], $GLOBALS['LANG']));
                
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