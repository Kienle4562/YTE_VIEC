<?php defined( '_VALID_MOS' ) or die( include("404.php") );

	class process 
	{
		public $dbObj;
			
		function __construct()
		{
			$this->dbObj = new classDb();
		}
		
		function process_pulish_and_un_publish_product($check, $values)
		{
			if	($check == 0)
			{
				$sql = "Update `book_product` Set `status` = 0 Where `Id` = ?";
			}
			else
			{
				$sql = "Update `book_product` Set `Status` = 1 Where `Id` = ?";
			}
			
			$result = $this->dbObj->SqlQueryInputResult($sql, array($values), $lang);
			
			if ($result != false) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		/* ham su ly ban tin co la tin tieu diem hay khong */
		function process_pulish_and_un_publish_product_hot($check, $values)
		{
			if ($check == 0)
			{
				$sql = "Update `book_product` Set `hot_product` = 0 Where `Id` = ?";
			}
			else 
			{
				$sql = "Update `book_product` Set `hot_product` = 1 Where `Id` = ?";
			}
			
			$result = $this->dbObj->SqlQueryInputResult($sql, array($values), $lang);
			
			if ($result != false) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		/* ham su ly ban tin co la tin tieu diem hay khong */
		function move_to_category($cat, $values)
		{
			$sql = "Update `book_product` Set `book_category_id` = ? Where `Id` = ?";
			
			$result = $this->dbObj->SqlQueryInputResult($sql, array($cat, $values), $lang);
			
			if ($result != false) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		// ham su ly di chuyen mau tin xuong phia duoi cua san pham
		function process_order_product($id_up, $id_down)
		{
			$sql = "SELECT (SELECT `order_num` FROM `book_product` WHERE  `Id` = ?) AS `num_up`, `order_num` as `num_down` FROM `book_product` WHERE `Id` = ?";
			
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($id_up, $id_down), $lang);
			
			if ($row = $result->fetch())
			{
				$sql = "update `book_product` set `order_num` = ? where `Id` = ? ";
				
				$result_1 = $this->dbObj->SqlQueryInputResult($sql, array($row['num_down'], $id_up), $lang);
				
				if ($result_1 != false)
				{
					$result_2 = $this->dbObj->SqlQueryInputResult($sql, array($row['num_up'], $id_down), $lang);
					
					if ($result_2 != false)
					{
						return true;
					}
					else
					{
						return false;
					}
				}
				else
				{
					return false;
				}
			}
		}
		
		/* ham su ly order all ban tin */
		function process_order_all_product($order_id, $checked_id)
		{
			$sql = "update `book_product` set `order_num` = ? where `Id` = ?";
			
			$result = $this->dbObj->SqlQueryInputResult($sql, array($order_id, $checked_id), $lang);
			
			if ($result != false)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		
		/* ham su ly go bo mot ban tin */
		function process_remove_product($values)
		{
			$sql = "
					
					DELETE FROM `book_product_comment` WHERE `book_product_id` = ?;
					
					DELETE FROM `book_product_tabs` WHERE `product_id` = ?;
					
					DELETE FROM `book_order_detail` WHERE `book_product_id` = ?;
					
					DELETE FROM `book_product` WHERE `Id` = ?;
			";
			
			$result = $this->dbObj->SqlQueryInputResult($sql, array($values,$values,$values,$values), $lang);
			
			if ($result != false)
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
		
		function getCompactSessionList()
		{
			$sql = "Select `Id`, `session_name` from `book_session`";
			return $this->dbObj->SqlQueryOutputResult($sql, array(0));
		}
		
		function getCompactCategoryList($id = null)
		{
			if (!empty($id))
			{
				$sql = "Select `Id`, `category_name`, `book_session_id` From `book_category` where `book_session_id` = ?";
				return $this->dbObj->SqlQueryOutputResult($sql, array($id));
			}
			else
			{
				$sql = "Select `Id`, `category_name`, `book_session_id` From `book_category`";
				return $this->dbObj->SqlQueryOutputResult($sql, array(0));
			}
		}
		
		function getList($sid, $cid)
		{
			$sql = "SELECT `tb1`.*,`tb`.`book_category_group` FROM 
							(SELECT
							  `book_product`.`Id` as `book_product_id`, `book_product`.`SPID`, `book_session`.`session_name`, `book_category`.`category_name`, 
							  `book_product`.`product_name`, `book_product`.`price`,
							  `book_product`.`hot_product`, `book_product`.`num_view`, `book_product`.`status`, 
							  `book_product`.`date_add`, `book_product`.`order_num`, `account`.`FullName`, `book_session`.`Id` as `book_session_id`,
							  `book_product`.`book_category_id`
							FROM
							  `book_session` INNER JOIN `book_category` ON `book_session`.`Id` = `book_category`.`book_session_id`
							  INNER JOIN `book_product` ON `book_category`.`Id` = `book_product`.`book_category_id`
							  INNER JOIN `account` ON `account`.`Ac_Id` = `book_product`.`account_id`) as `tb1` 
							LEFT JOIN (SELECT `book_category_id`, COUNT(book_category_id) as `book_category_group` from `book_product` GROUP BY `book_category_id`) as `tb` 
					ON `tb`.`book_category_id` = `tb1`.`book_category_id`
					WHERE `tb1`.`book_session_id` LIKE ? AND `tb1`.`book_category_id` LIKE ?
					ORDER BY `tb1`.`book_session_id`, `tb1`.`book_category_id`, `tb1`.`order_num` DESC";
			return $this->dbObj->SqlQueryOutputResult($sql, array($sid, $cid));
		}
        
        public function category_multi_level($parentid, $lang_code)
        {
            $sql = "
                    SELECT
                            `cat_id`,
                            `title`,
                            `lang_code`,
                            `date_add`, 
                            `enabled`, 
                            `num_view`, 
                            `ordering`, 
                            `parent_id`,
                            A.`cnt`
                    FROM 
                            `product_category`
                            LEFT JOIN (
                                select `book_category_id`, count(*) as `cnt`
                                from `book_product`
                                group by `book_category_id`
                            ) as A ON `product_category`.`cat_id` = A.`book_category_id`
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
        
        public function get_article_view($conditions, $lang_code)
        {
            $sql = "SELECT `tb1`.*,`tb`.`news_category_group` FROM (
                        SELECT
                            `book_product`.`Id`,
                            `product_category`.`title` as `cat_title`,
                            `book_product`.`product_name`,
                            `book_product`.`hot_product`,
                             `book_product`.`product_image`,
							`book_product`.`status`,
                            `book_product`.`order_num`,
                            `account`.`fullName`,
                            `book_product`.`date_add`,
                            `book_product`.`num_view`,
                            `book_product`.`book_category_id`,
                            `account`.`Ac_Id`,
                            `book_product`.`lang_code`
                        FROM
                            `product_category` INNER JOIN
                            `book_product` ON `product_category`.`cat_id` = `book_product`.`book_category_id` INNER JOIN
                            `account` ON `account`.`Ac_Id` = `book_product`.`account_id`
                        WHERE `book_product`.`lang_code` = ? $conditions
                    ) 
                    as `tb1` LEFT JOIN (
                        SELECT `book_category_id`, COUNT(book_category_id) as `news_category_group` from `book_product` GROUP BY `book_category_id`
                    ) 
                    as `tb` 
                    ON `tb`.`book_category_id` = `tb1`.`book_category_id`
                    ORDER BY `tb1`.`book_category_id`, `tb1`.`order_num` DESC";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($lang_code));
            return $result;
        }
        
        /**
	    * Hàm cập nhật giá trị `book_category_id` cho các sản phẩm đã được
	    * đồng bộ bằng hàm [copy_product].
	    * 
	    * - Giá trị đầu vào là câu lệnh SQL mà khi query sẽ trả về
	    * các nhóm giá trị [`Id`, `book_category_id`, `lang_code`].
	    * 
	    * - Từ các nhóm giá trị này sẽ tạo ra các câu SQL để update
	    * giá trị `book_category_id` cho các record mới.
	    * 
	    * - Hàm này không cần kiểm tra xem câu lệnh SQL có lớn hơn giá
	    * trị giới hạn của SQL hay không. Vì mỗi câu lệnh UNION từ hàm
	    * [copy_category] chỉ cho ra 1 nhóm giá trị, ứng với mỗi nhóm
	    * giá trị này sẽ là một câu UPDATE, và câu lệnh UPDATE này ngắn
	    * hơn câu lệnh UNION nhiều.
	    * 
	    * - Hàm này không trả về kết quả, chỉ thực thi!
	    */
	    function copy_product_update(&$sql_union)
	    {
			$result_update = $this->dbObj->SqlQueryOutputResult(substr($sql_union, 6), array());
			$sql_update = "";
			
			while ($row_update = $result_update->fetch(PDO::FETCH_ASSOC))
			{
				// $sql_update .= "UPDATE `product_category` SET `parent_id` = " . $row_update['parent_id'] . " WHERE `cat_id` = " . $row_update['cat_id'] . ";";
				$sql_update = "UPDATE `book_product` SET `book_category_id` = " . $row_update['cat_id'] . ", `status` = 0 WHERE `Id` = " . $row_update['Id'] . ";";
				$this->dbObj->SqlQueryInputResult($sql_update, array()); // 13.3360378742
			}
			
			unset($result_update);
			// $this->dbObj->SqlQueryInputResult($sql_update, array()); // 0.700140953064
	    }
	    
	    /**
	     * - Dùng hàm INSERT kết hợp với SELECT để đồng bộ ngôn ngữ,
	     * mỗi record mới sẽ được chèn thêm dòng chữ [Sao chép] vào
	     * phía sau, để đánh dấu record này là record được đồng bộ.
	     * 
	     * - Record mới này được gán `status` = -2, để đánh dấu
	     * rằng nó chưa được gán `book_category_id` (giá trị này sẽ được
	     * cập nhật sau).
	     * 
	     * - Lấy danh sách tất cả các record có `status` = -2 ra,
	     * sau đó tạo câu lệnh SQL để truy vấn ra giá trị `book_category_id`
	     * chính xác (dựa vào `assoc_id`).
	     * 
	     * - Lưu ý: trong quá trình tạo ra câu lệnh SQL này có thể phát
	     * sinh trường hợp là câu lệnh SQL lớn hơn giới hạn của MySQL
	     * (max_allowed_packet - mặc định là 1MB). Cho nên câu lệnh sẽ
	     * được chia nhỏ ra nhiều lần để đảm bảo không thể lớn hơn giá
	     * trị giới hạn này.
	     * 
	     * - Chuyển câu lệnh này sang hàm [copy_product_update] để tiếp
	     * tục xử lý.
	     * 
	     */
	    function copy_product()
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
					$this->dbObj->SqlQueryInputResult("INSERT IGNORE INTO `book_product`(`lang_code`, `SPID`, `product_name`, `alias`, `product_image`, `attach_info`, `price`, `discounts`, `discount_type`, `properties_name`, `properties_value`, `description`, `content`, `hot_product`, `num_view`, `status`, `status_product`, `date_add`, `order_num`, `book_category_id`, `author`, `quality`, `shipping_costs`, `origin`, `account_id`, `keyword`, `show_comment`, `assoc_id`) (SELECT '" . $key . "' as `lang_code`, `SPID`, CONCAT(`product_name`, ' (Sao chép lúc ', CURDATE(), ' ', CURTIME(), ')'), `alias`, `product_image`, `attach_info`, `price`, `discounts`, `discount_type`, `properties_name`, `properties_value`, `description`, `content`, `hot_product`, 0 as `num_view`, -2 as `status`, `status_product`, " .time() . " as `date_add`, `order_num`, `book_category_id`, `author`, `quality`, `shipping_costs`, `origin`, `account_id`, `keyword`, `show_comment`, `Id` as `assoc_id` FROM `book_product` WHERE `lang_code` = 'vi' AND `Id` NOT IN (SELECT `assoc_id` FROM `book_product` WHERE `lang_code` = '" . $key . "') AND `book_category_id` IN (SELECT `assoc_id` FROM `product_category` WHERE `lang_code` = '" . $key . "'));", array());
				}
			}

			$result = $this->dbObj->SqlQueryOutputResult("SELECT `Id`, `book_category_id`, `lang_code` FROM `book_product` WHERE `status` = -2", array());

			if ($result->rowCount() > 0)
			{
				$sql_union = "";
				$packet_size = 0;

				while ($row = $result->fetch(PDO::FETCH_ASSOC))
				{
					$sql_single = "UNION (SELECT C1.`cat_id`, " . $row['Id'] . " as `Id` FROM `product_category` as C1 WHERE C1.`assoc_id` = " . $row['book_category_id'] . " AND `lang_code` = '" . $row['lang_code'] . "') ";
					
					if ($packet_size + mb_strlen($sql_single) > $max_packet)
					{
						$this->copy_product_update($sql_union);
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
					$this->copy_product_update($sql_union);
				}
				
				// $this->dbObj->SqlQueryInputResult('UPDATE `product_category` SET `parent_id` = 0 WHERE `parent_id` = -2', array());
			}

			$end_time = microtime(true);
	    }
	}
    
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    switch ($_POST["hidden"])
    {
        case "":
        break;

        case "submit_com_product_product_view";
            if ($_POST["task"] == "unpublish")
            {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                
                for ($row = 0; $row < count($values); $row++)
                {
                    if($myprocess->process_pulish_and_un_publish_product("0", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                
                if ($check == TRUE) 
                    $_SESSION['msg'] = "";
                else 
                    $_SESSION['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
            }
            elseif ($_POST["task"] == "publish")
            {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                
                for ($row = 0; $row < count($values); $row++)
                {
                    if ($myprocess->process_pulish_and_un_publish_product("1", $values[$row]) <> FALSE)
                        $check = TRUE;
                }
                
                if ($check == TRUE) 
                    $_SESSION['msg'] = "";
                else 
                    $_SESSION['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
            }
            elseif ($_POST["task"] == "unpublishfocus")
            {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                
                for ($row = 0; $row < count($values); $row++)
                {
                    if ($myprocess->process_pulish_and_un_publish_product_hot("0", $values[$row]) <> FALSE)
                        $check = TRUE;
                }
                
                if ($check == TRUE)
                    $_SESSION['msg'] = "";
                else 
                    $_SESSION['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
            }
            elseif ($_POST["task"] == "publishfocus")
            {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                
                for ($row = 0; $row < count($values); $row++)
                {
                    if ($myprocess->process_pulish_and_un_publish_product_hot("1", $values[$row]) <> FALSE)
                        $check = TRUE;
                }
                
                if ($check == TRUE) 
                    $_SESSION['msg'] = "";
                else 
                    $_SESSION['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !";
            } 
            elseif ($_POST["task"] == "orderup")
            {
                $values = $_POST["cid"];
                $myprocess = new process;
                
                if ($myprocess->process_order_product($values[0], $values[1]) <> FALSE)
                    $_SESSION['msg'] = "";
                else 
                    $_SESSION['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
            elseif ($_POST["task"] == "orderdown")
            {
                $values = $_POST["cid"];
                $myprocess = new process;
                
                if ($myprocess->process_order_product($values[0], $values[1]) <> FALSE)
                    $_SESSION['msg'] = "";
                else
                    $_SESSION['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
            elseif ($_POST["task"] == "order")
            {
                $check = FALSE;
                $checked_id = $_POST["cid"]; $order_id = $_POST["order"];
                $myprocess = new process;
                
                for ($row = 0; $row < count($order_id); $row++)
                {
                    if ($myprocess->process_order_all_product($order_id[$row], $checked_id[$row]) <> FALSE)
                        $check = TRUE;
                }
                
                if ($check == TRUE)
                    $_SESSION['msg'] = "";
                else 
                    $_SESSION['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
            }
            elseif ($_POST["task"] == "add")
            {
                $core_class->_redirect(".?com=com_product&view=product&task=add&sid=".$_POST["sectionid"]."&cid=".$_POST["catid"]);exit;
            }
            elseif ($_POST["task"] == "remove")
            {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                
                for ($row = 0; $row < count($values); $row++)
                {
                    if ($myprocess->process_remove_product($values[$row]) <> FALSE)
                        $check = TRUE;
                }
                
                if ($check == TRUE)
                    $_SESSION['msg'] = "Đã xoá các Sản phẩm được chọn!";
                else
                    $_SESSION['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !";
            }            
            elseif ($_POST['task'] == 'change_lang_code')
            {
				$_SESSION['amdin']['com_product']['product']['lang_code'] = $_POST['lang_code'];
				$core_class->_redirect('?com=com_product&view=product&task=view');
				exit();
            }
            else if ($_POST['task'] == 'synch')
            {
				$myprocess = new process();
				$myprocess->copy_product();
				$core_class->_redirect('?com=com_product&view=product&task=view');
				exit();
            }
            elseif ($_POST["task"] == "move")
            {
            	if (!empty($_POST['move_to_cat']))
            	{
	                $check = FALSE;
	                $values = $_POST["cid"];
	                $myprocess = new process;
	                
	                for ($row = 0; $row < count($values); $row++)
	                {
	                    if ($myprocess->move_to_category($_POST['move_to_cat'], $values[$row]) <> FALSE)
	                        $check = TRUE;
	                }
	                
	                if ($check == TRUE)
	                    $_SESSION['msg'] = "";
	                else 
	                    $_SESSION['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !";
				}
				else
				{
					$_SESSION['msg'] = "Xin vui lòng chọn Danh mục cần di chuyển sản phẩm đến";
				}
            }
        break;
        
        default:
            $core_class->_redirect(".");
            exit();
        break;
    }