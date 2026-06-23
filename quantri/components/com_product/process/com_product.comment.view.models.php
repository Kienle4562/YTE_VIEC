<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process extends com_product_category
    {
        public function get_comment_list($parent_id)
        {
            $sql = "
                    SELECT
                            `book_product_comment`.`id`,
                            `book_product`.`book_category_id`,
                            `book_product`.`product_name`,
                            `book_product`.`alias`,
                            `book_product_comment`.`book_product_id`,
                            `book_product_comment`.`name`,
                            `book_product_comment`.`email`,
                            `book_product_comment`.`content`,
                            `book_product_comment`.`time`,
                            `book_product_comment`.`status`,
                            `book_product_comment`.`time`
                    FROM
                            `book_product_comment`
                                LEFT JOIN `book_product` ON `book_product_comment`.`book_product_id` = `book_product`.`Id`
                    WHERE
                            `book_product_comment`.`parent_id` = ?
                    ORDER BY 
                            `time` DESC;
            ";

            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parent_id));
            return $result;
        }
                
        function process_pulish_and_un_publish_comment($check, $values)
        {
            if ($check == 0) {
                $sql = "Update `book_product_comment` Set `status` = 0 Where `id` = ?";
            }
            else {
                $sql = "Update `book_product_comment` Set `status` = 1 Where `id` = ?";
            }
            
            if ($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE) {
                return true;
            }
        }

        function process_remove_comment($values)
        {
            $sql = "Delete from `book_product_comment` where `parent_id` = ?";
            
            if ($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE) {
                $sql = "Delete from `book_product_comment` where `id` = ?";
                
                if ($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE) {
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
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
                                            LIMIT 0,1
                                        ) as a
                                WHERE `product_category`.`left` <= a.`left` AND `product_category`.`right` >= a.`right`
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
        
        function change_comment_content($id, $content, $time)
        {
            return $this->dbObj->SqlQueryInputResult("
                UPDATE `book_product_comment`
                SET `content` = ?, `time` = ?
                WHERE `id` = ?
            ", array($this->dbObj->fix_quotes_dquotes($content), $time, $id));
        }
    }
    
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch($_POST["hidden"])
    {
        case "":
            // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;

        case "submit_com_product_comment_view":
            if ($_POST["task"] == "unpublish") {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process();
                
                for ($row = 0; $row < count($values); $row++) {
                    if ($myprocess->process_pulish_and_un_publish_comment("0", $values[$row]) <> FALSE) {
                        $check = TRUE;
                    }
                }
                
                $core_class->_redirect('./?com=com_product&view=comment&task=view');
                exit();
            }
            elseif ($_POST["task"] == "publish") {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process();
                
                for ($row = 0; $row < count($values); $row++) {
                    if ($myprocess->process_pulish_and_un_publish_comment("1", $values[$row]) <> FALSE) {
                        $check = TRUE;
                    }
                }
                
                $core_class->_redirect('./?com=com_product&view=comment&task=view');
                exit();
            }
            elseif ($_POST["task"] == "remove") {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process();
                
                for ($row = 0; $row < count($values); $row++) {
                    if ($myprocess->process_remove_comment($values[$row]) <> FALSE) {
                        $check = TRUE;
                    }
                }
                
                $core_class->_redirect('./?com=com_product&view=comment&task=view');
                exit();
            }
            elseif ($_POST['task'] == "change_content") {
                $myprocess = new process();
                
                $day = substr($_POST['date_add'], 0, 2);
                $month = substr($_POST['date_add'], 3, 2);
                $year = substr($_POST['date_add'], 6, 4);
                
                if ($myprocess->change_comment_content($_POST['comment_id'], $_POST['content'], mktime($_POST['hour'], $_POST['minute'], 0, $month, $day, $year))) {
                    $core_class->_redirect('./?com=com_product&view=comment&task=view');
                    exit();
                }
            }
        break;
        
        default:
            $core_class->_redirect(".");
            exit();
        break;
    }