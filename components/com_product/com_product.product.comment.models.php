<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class com_product_comment
    {
        public $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
        
        public function add_comment($name, $email, $content, $time, $status, $comment_id, $book_product_id)
        {
            return $this->dbObj->SqlQueryInputResult(
                "INSERT INTO 
                        `book_product_comment` (name, email, content, time, status, parent_id, book_product_id)
                        VALUES (?, ?, ?, ?, ?, ?, ?)", 
                array($name, $email, $content, $time, $status, $comment_id, $book_product_id)
            );
        }
        
        public function get_comments($book_product_id, $parent_id)
        {
            return $this->dbObj->SqlQueryOutputResult("
                SELECT
                        `id`,
                        `book_product_id`,
                        `name`,
                        `email`,
                        `content`,
                        `time`
                FROM
                        `book_product_comment`
                WHERE
                        `status` = 1
                        AND `book_product_id` = ?
                        AND `parent_id` = ?
            ", array($book_product_id, $parent_id));
        }
    }
    
    /*  ___________________________
     * |                           |
     * |          HANDLER          |
     * |___________________________|
     */
     
    if (isset($_POST['hidden']))
    {
        switch ($_POST['hidden'])
        {
            case "post_comment":
                include('libraries/securimage/securimage.php');
                $captcha = new Securimage();
                
                if ($captcha->check($_POST['captcha']) == true) {
                    if (!empty($_POST['name'])
                            && !empty($_POST['email'])
                            && $core_class->isValidEmail($_POST['email'])
                            && !empty($_POST['content']))
                    {
                        $myprocess = new com_product_comment();
                        $myprocess->add_comment($_POST['name'], $_POST['email'], $_POST['content'], time(), 1, $_POST['comment_id'], $_GET['id']);
                        $_SESSION['comment_success_message'] = "Xin cảm ơn quý khách đã bình luận về sản phẩm!";
                        $core_class->_redirect('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
                        exit();
                    }
                    else {
                        $_POST['error_message'] = "Quý khách vui lòng cung cấp đầy đủ các thông tin cần thiết. Xin cảm ơn!";
                    }
                }
                else {
                    $_POST['error_message'] = "Mã xác nhận không đúng";
                }
            break;
            
            default:
            break;
        }
    }