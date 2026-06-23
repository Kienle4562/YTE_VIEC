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
                            `tb`.`news_category_group`
                    FROM
                    (
						SELECT
                                `news`.`news_id`,
                                `category`.`title` as `cat_title`,
                                `news`.`title`,
                                `news`.`focus`,
                                `news`.`enabled`,
                                `news`.`ordering`,
                                `account`.`fullName`,
                                `news`.`date_add`,
                                `news`.`num_view`,
                                `news`.`category_id`,
                                `news`.`lang_code`,
                                `account`.`Ac_Id`
						FROM
                                `category`
                                INNER JOIN `news` ON `category`.`cat_id` = `news`.`category_id`
                                INNER JOIN `account` ON `account`.`Ac_Id` = `news`.`acc_id`
					    WHERE
                                `news`.`lang_code` = ?
                                $conditions
					)
                    as `tb1`
                        LEFT JOIN (SELECT `category_id`, COUNT(category_id) as `news_category_group` from `news` GROUP BY `category_id`) as `tb` 
					ON `tb`.`category_id` = `tb1`.`category_id`
					ORDER BY `tb1`.`category_id`, `tb1`.`ordering` DESC
            ";
			
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($lang_code));
			return $result;
		}
		
		public function category_multi_level($parentid, $lang_code)
		{
			$sql = "
                    SELECT
                            `cat_id`,
                            `title`,
                            `date_add`,
                            `enabled`,
                            `num_view`,
                            `ordering`,
                            `parent_id`,
                            `lang_code`,
                            A.`cnt`
                    FROM
                            `category`
                            LEFT JOIN (
                                select `category_id`, count(*) as `cnt`
                                from `news`
                                group by `category_id`
                            ) as A ON `category`.`cat_id` = A.`category_id`
                    WHERE 
                            `parent_id` = ?
                            AND `lang_code` = ?
                    ORDER BY 
                            `ordering`
            ";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
			return $result;
		}
		
		public function get_author_list()
		{
			$sql = "Select `Ac_Id`, `UserName`, `fullName` From `account`;";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
			return $result;
		}
		
		public function get_category_list()
		{
			$sql = "Select `cat_id`, `title` From `category`";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
			return $result;
		}
		
		function process_pulish_and_un_publish_news($check, $values)
		{
			if($check == 0)
			$sql = "Update news Set `enabled` = 0 Where news_id = ?";
			else $sql = "Update news Set `enabled` = 1 Where news_id = ?";
			if($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE){
				return true;
			}
		}
		
		function process_pulish_and_un_publish_news_focus($check, $values)
		{
			if($check == 0)
			$sql = "Update news Set `focus` = 0 Where news_id = ?";
			else $sql = "Update news Set `focus` = 1 Where news_id = ?";
			if($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE){
				return true;
			}
		}
		
		// ham su ly di chuyen mau tin len xuong cua category
		function process_order_news($id_up, $id_down)
		{
			$sql = "SELECT (SELECT `ordering` FROM `news` WHERE  `news_id` = ?) AS `num_up`, `ordering` as `num_down` FROM `news` WHERE `news_id` = ?";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($id_up, $id_down));
			if($row = $result->fetch()){
				$sql = "update `news` set `ordering` = ? where `news_id` = ? ";
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
		function process_order_all_news($order_id, $checked_id)
		{
			$sql = "update `news` set `Order` = ? where `News_Id` = ?";
			if($this->dbObj->SqlQueryInputResult($sql, array($order_id, $checked_id)) <> FALSE) return true;
			else return false;
		}
		
		// ham su ly go bo mau tin trong chu de cha(session)
		function process_remove_news($values)
		{
			$myprocess = new process();
			$sql = "Delete from news where news_id = ?";
			if($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE) return true;
			else return false;
			
		}
		
		/**
	    * Hàm cập nhật giá trị `parent_id` cho các category đã được
	    * đồng bộ bằng hàm [copy_category].
	    * 
	    * - Giá trị đầu vào là câu lệnh SQL mà khi query sẽ trả về
	    * các nhóm giá trị [`lang_code`, `cat_id`, `parent_id`].
	    * 
	    * - Từ các nhóm giá trị này sẽ tạo ra các câu SQL để update
	    * giá trị `parent_id` cho các record mới.
	    * 
	    * - Hàm này không cần kiểm tra xem câu lệnh SQL có lớn hơn giá
	    * trị giới hạn của SQL hay không. Vì mỗi câu lệnh UNION từ hàm
	    * [copy_category] chỉ cho ra 1 nhóm giá trị, ứng với mỗi nhóm
	    * giá trị này sẽ là một câu UPDATE, và câu lệnh UPDATE này ngắn
	    * hơn câu lệnh UNION nhiều.
	    * 
	    * - Hàm này không trả về kết quả, chỉ thực thi!
	    */
	    function copy_news_update(&$sql_union)
	    {
			$result_update = $this->dbObj->SqlQueryOutputResult(substr($sql_union, 6), array());
			$sql_update = "";
			
			while ($row_update = $result_update->fetch(PDO::FETCH_ASSOC))
			{
				// $sql_update .= "UPDATE `product_category` SET `parent_id` = " . $row_update['parent_id'] . " WHERE `cat_id` = " . $row_update['cat_id'] . ";";
				$sql_update = "UPDATE `news` SET `category_id` = " . $row_update['cat_id'] . ", `enabled` = 0 WHERE `news_id` = " . $row_update['news_id'] . ";";
				$this->dbObj->SqlQueryInputResult($sql_update, array()); // 13.3360378742
			}
			
			unset($result_update);
	    }
	    
	    /**
	     * - Dùng hàm INSERT kết hợp với SELECT để đồng bộ ngôn ngữ,
	     * mỗi record mới sẽ được chèn thêm dòng chữ [Sao chép] vào
	     * phía sau, để đánh dấu record này là record được đồng bộ.
	     * 
	     * - Record mới này được gán `enabled` = -2, để đánh dấu
	     * rằng nó chưa được gán `category_id` (giá trị này sẽ được
	     * cập nhật sau).
	     * 
	     * - Lấy danh sách tất cả các record có `enabled` = -2 ra,
	     * sau đó tạo câu lệnh SQL để truy vấn ra giá trị `category_id`
	     * chính xác (dựa vào `assoc_id`).
	     * 
	     * - Lưu ý: trong quá trình tạo ra câu lệnh SQL này có thể phát
	     * sinh trường hợp là câu lệnh SQL lớn hơn giới hạn của MySQL
	     * (max_allowed_packet - mặc định là 1MB). Cho nên câu lệnh sẽ
	     * được chia nhỏ ra nhiều lần để đảm bảo không thể lớn hơn giá
	     * trị giới hạn này.
	     * 
	     * - Chuyển câu lệnh này sang hàm [copy_news_update] để tiếp
	     * tục xử lý.
	     * 
	     */
	    function copy_news()
	    {
	    	if (!ini_get('safe_mode')) {
	    		set_time_limit(0);
			}

	    	$max_packet = $this->dbObj->get_max_allowed_packet();

	    	$start_time = microtime(true);

	    	foreach ($GLOBALS['LANG_LIST'] as $key => $item)
	    	{
	    		if ($key != 'vi')
	    		{
					$this->dbObj->SqlQueryInputResult("INSERT IGNORE INTO `news`(`lang_code`,`category_id`,`acc_id`,`title`,`alias`,`description`,`content`,`date_add`,`date_modify`,`img_file`,`img_status`,`enabled`,`ordering`,`focus`,`num_view`,`assoc_id`) (SELECT '" . $key . "' as `lang_code`,`category_id`,`acc_id`,CONCAT(`title`, ' (Sao chép lúc ', CURDATE(), ' ', CURTIME(), ')') as `title`,`alias`,`description`,`content`," . time() . " as `date_add`,NULL as `date_modify`,`img_file`,`img_status`,-2 as `enabled`,`ordering`,`focus`,0 as `num_view`,`news_id` as `assoc_id` FROM `news` WHERE `lang_code` = 'vi' AND `news_id` NOT IN (SELECT `assoc_id` FROM `news` WHERE `lang_code` = '" . $key . "') AND `category_id` IN (SELECT `assoc_id` FROM `category` WHERE `lang_code` = '" . $key . "'));", array());
				}
			}

			$result = $this->dbObj->SqlQueryOutputResult("SELECT `news_id`, `category_id`, `lang_code` FROM `news` WHERE `enabled` = -2", array());

			if ($result->rowCount() > 0)
			{
				$sql_union = "";
				$packet_size = 0;

				while ($row = $result->fetch(PDO::FETCH_ASSOC))
				{
					$sql_single = "UNION (SELECT C1.`cat_id`, " . $row['news_id'] . " as `news_id` FROM `category` as C1 WHERE C1.`assoc_id` = " . $row['category_id'] . " AND `lang_code` = '" . $row['lang_code'] . "') ";
					
					if ($packet_size + mb_strlen($sql_single) > $max_packet)
					{
						$this->copy_news_update(&$sql_union);
						$sql_union = '';
						$packet_size = mb_strlen($sql_single);
					}
					else
					{
						$packet_size += mb_strlen($sql_single);
					}
					
					$sql_union .= $sql_single;
				}
				
				unset($result);
				
				if ($sql_union != '') {
					$this->copy_news_update(&$sql_union);
				}
			}

			$end_time = microtime(true);
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
            if($_POST["task"] == "unpublish") {
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
            else if($_POST["task"] == "publish") {
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
            else if($_POST["task"] == "unpublishfocus") {
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
            else if($_POST["task"] == "publishfocus") {
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
            else if($_POST["task"] == "orderup") {
                $values = $_POST["cid"];
                $myprocess = new process;
                if($myprocess->process_order_news($values[0], $values[1]) <> FALSE)
                $GLOBALS['msg'] = "";                
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
            else if($_POST["task"] == "orderdown") {
                $values = $_POST["cid"];
                $myprocess = new process;
                if($myprocess->process_order_news($values[0], $values[1]) <> FALSE)
                $GLOBALS['msg'] = "";                
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
            else if($_POST["task"] == "order") {
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
            else if($_POST["task"] == "remove") {
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
            else if ($_POST['task'] == 'change_lang_code') {
				$_SESSION['amdin']['com_content']['news']['lang_code'] = $_POST['lang_code'];
				$core_class->_redirect('?com=com_content&view=news&task=view');
				exit();
            }
            else if ($_POST['task'] == 'synch') {
				$myprocess = new process();
				$myprocess->copy_news();
				$core_class->_redirect('?com=com_content&view=news&task=view');
				exit();
            }
        break;
        
        default:
            $core_class->_redirect(".");
            exit();
        break;
    }