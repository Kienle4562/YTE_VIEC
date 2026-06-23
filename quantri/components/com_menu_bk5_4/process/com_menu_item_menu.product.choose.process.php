<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process
    {
        public $dbObj;
        function __construct()
        {
             $this->dbObj = new classDb();
        }

        public function get_article_view($conditions, $lang_code)
        {
            $sql = "
                    SELECT
                            `tb1`.*,
                            `tb`.`product_category_group`
                    FROM (
                            SELECT
                                    `book_product`.`Id`,
                                    `book_product`.`alias`,
                                    `product_category`.`title` as `cat_title`,
                                    `book_product`.`product_name`,
                                    `book_product`.`hot_product`,
                                    `book_product`.`status`,
                                    `book_product`.`order_num`,
                                    `account`.`fullName`,
                                    `book_product`.`date_add`,
                                    `book_product`.`num_view`,
                                    `book_product`.`book_category_id`,
                                    `account`.`Ac_Id`
                            FROM
                                    `product_category`
                                            INNER JOIN `book_product` ON `product_category`.`cat_id` = `book_product`.`book_category_id`
                                            INNER JOIN `account` ON `account`.`Ac_Id` = `book_product`.`account_id`
                            WHERE
                                    `book_product`.`lang_code` = '" . $lang_code . "' " . 
                                    /* Nếu có lọc theo chuyên mục */
                                    ((isset($conditions['cat_id'])) ? "
                                        AND `product_category`.`cat_id` IN
                                        (
                                            SELECT
                                                    `product_category`.`cat_id`
                                            FROM
                                                    `product_category`,
                                                    (
                                                        SELECT
                                                                `left`,
                                                                `right`
                                                        FROM
                                                                `product_category`
                                                        WHERE
                                                                `product_category`.`cat_id` = {$conditions['cat_id']}
                                                        LIMIT 0,1
                                                    ) as a
                                            WHERE
                                                    `product_category`.`left` >= a.`left`
                                                    AND `product_category`.`right` <= a.`right`
                                                    AND `product_category`.`lang_code` = '" . $lang_code . "'
                                        )
                                    " : "") . 
                                    /* END */
                                    
                                    /* Nếu có lọc theo tác giả */
                                    ((isset($conditions['author_id'])) ? "
                                        AND `account`.`Ac_Id` = {$conditions['author_id']}
                                    " : "").
                                    /* END */
                                    "
                        ) 
                        as `tb1` LEFT JOIN (
                            SELECT `book_category_id`, COUNT(book_category_id) as `product_category_group` from `book_product` WHERE `lang_code` = '" . $lang_code . "' GROUP BY `book_category_id`
                        ) 
                        as `tb` 
                        ON `tb`.`book_category_id` = `tb1`.`book_category_id`
                    ORDER BY `tb1`.`book_category_id`, `tb1`.`order_num` DESC";

            $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
            return $result;
        }
        
        public function category_multi_level($parentid, $lang_code)
        {
            $sql = "SELECT `cat_id`, `title`, `date_add`, `enabled`, `num_view`, `ordering`, `parent_id` FROM `product_category` WHERE parent_id = ? and `lang_code` = ? order by `ordering`";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
            return $result;
        }
        
        public function get_author_list()
        {
            $sql = "Select `Ac_Id`, `UserName`, `fullName` From `account`;";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
            return $result;
        }
        
        public function get_category_list($lang_code)
        {
            $sql = "Select `cat_id`, `title` From `product_category` WHERE `lang_code` = ?";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($lang_code));
            return $result;
        }
        
        function process_pulish_and_un_publish_news($check, $values){
            if($check == 0)
            $sql = "Update book_product Set `status` = 0 Where Id = ?";
            else $sql = "Update book_product Set `status` = 1 Where Id = ?";
            if($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE){
                return true;
            }
        }
        
        function process_pulish_and_un_publish_news_focus($check, $values){
            if($check == 0)
            $sql = "Update book_product Set `hot_product` = 0 Where Id = ?";
            else $sql = "Update book_product Set `hot_product` = 1 Where Id = ?";
            if($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE){
                return true;
            }
        }
        
        // ham su ly di chuyen mau tin len xuong cua category
        function process_order_news($id_up, $id_down){
            $sql = "SELECT (SELECT `order_num` FROM `book_product` WHERE  `Id` = ?) AS `num_up`, `order_num` as `num_down` FROM `book_product` WHERE `Id` = ?";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($id_up, $id_down));
            if($row = $result->fetch()){
                $sql = "update `book_product` set `order_num` = ? where `Id` = ? ";
                if($this->dbObj->SqlQueryInputResult($sql, array($row['num_down'], $id_up)) <> FALSE){
                    if($this->dbObj->SqlQueryInputResult($sql, array($row['num_up'], $id_down)) <> FALSE){
                        return true;
                    }            
                }
                else echo $mysqli->error;
            }                    
            $cmd->close();
            $mysqli->close();
        }
        
        /* ham su ly order all ban tin */
        function process_order_all_news($order_id, $checked_id){
            $sql = "update `book_product` set `order_num` = ? where `Id` = ?";
            if($this->dbObj->SqlQueryInputResult($sql, array($order_id, $checked_id)) <> FALSE) return true;
            else return false;
        }
        
        // ham su ly go bo mau tin trong chu de cha(session)
        function process_remove_news($values){
            $myprocess = new process();
            $sql = "Delete from book_product where Id = ?";
            if($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE) return true;
            else return false;
            
        }
    }
    
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch($_POST["hidden"])
    {
        case "";
        // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        /* khoi su ly su kien submit form news */
        case "submit_com_content_news_view";
            if($_POST["task"] == "unpublish"){
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_pulish_and_un_publish_news("0", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE) $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !";
            }
            else if($_POST["task"] == "publish"){
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_pulish_and_un_publish_news("1", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE) $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗii, vui lòng liên hệ quản trị !";
            }
            
            if($_POST["task"] == "unpublishfocus"){
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_pulish_and_un_publish_news_focus("0", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE) $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
            }
            else if($_POST["task"] == "publishfocus"){
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_pulish_and_un_publish_news_focus("1", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE) $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
            }        
            else if($_POST["task"] == "orderup"){
                $values = $_POST["cid"];
                $myprocess = new process;
                if($myprocess->process_order_news($values[0], $values[1]) <> FALSE)
                $GLOBALS['msg'] = "";                
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
            else if($_POST["task"] == "orderdown"){
                $values = $_POST["cid"];
                $myprocess = new process;
                if($myprocess->process_order_news($values[0], $values[1]) <> FALSE)
                $GLOBALS['msg'] = "";                
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
            else if($_POST["task"] == "order"){
                $check = FALSE;
                $checked_id = $_POST["cid"]; $order_id = $_POST["order"];
                $myprocess = new process;
                for ($row = 0; $row < count($order_id); $row++){
                    if($myprocess->process_order_all_news($order_id[$row], $checked_id[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE)
                $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
            }

            else if($_POST["task"] == "remove"){
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_remove_news($values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE)
                $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
            }

        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }