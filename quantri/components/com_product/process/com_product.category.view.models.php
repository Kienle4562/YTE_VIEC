<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process extends com_product_category
    {
	    public function get_category_view($parentid, $lang_code)
	    {
		    $sql = "
                    SELECT
			                `product_category`.`cat_id`,
                            `product_category`.`title`,
                            `product_category`.`date_add`,
                            `product_category`.`enabled`,
                            `product_category`.`ordering`,
                            `product_category`.`num_view`,
                            `product_category`.`lang_code`,
							`product_category`.`checked`
				    FROM
                            `product_category`
				    WHERE
                            `parent_id` = ?
                            AND `lang_code` = ?
                    ORDER BY 
                            `ordering`;
            ";

		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
		    return $result;
	    }
			    
	    function process_pulish_and_un_publish_category($check, $values)
	    {
		    if($check == 0)
		    $sql = "Update product_category Set `enabled` = 0 Where cat_id = ?";
		    else $sql = "Update product_category Set `enabled` = 1 Where cat_id = ?";
		    if($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE){
			    return true;
		    }
	    }
		
		function process_pulish_and_un_publish_category_c($check, $values)
	    {
		    if($check == 0)
		    $sql = "Update product_category Set `checked` = 0 Where cat_id = ?";
		    else $sql = "Update product_category Set `checked` = 1 Where cat_id = ?";
		    if($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE){
			    return true;
		    }
	    }
	    // ham su ly di chuyen mau tin xuong phia duoi cua item menu
	    function process_order_down_category($pnewsid, $lang_code)
	    {
		    $sql = "
		    			SELECT 
		    					(
		    						SELECT `ordering` 
		    						FROM product_category 
		    						WHERE cat_id = {$pnewsid}
		    					) As `currenOrder`,
				    
				    			(
				    				SELECT `ordering` 
				    				FROM product_category 
				    				WHERE 	`parent_id` = 	(
				    											SELECT `parent_id` 
				    											FROM product_category 
				    											WHERE cat_id = {$pnewsid}
				    										)
				    						AND `ordering` > 	(
				    												SELECT `ordering` 
				    												FROM product_category 
				    												WHERE cat_id = {$pnewsid}
				    											)
				    				ORDER BY `ordering`, `cat_id`
				    				LIMIT 1
				    			) As `preOrder`, 
				    
				    			(
				    				SELECT cat_id 
				    				FROM product_category 
				    				WHERE 	`ordering` = 	(
				    										SELECT `ordering` 
				    										FROM product_category 
				    										WHERE 	`parent_id` = 	(
				    																	SELECT `parent_id` 
				    																	FROM product_category 
				    																	WHERE cat_id = {$pnewsid}
				    																)
				    												AND `ordering` > 	(
				    																		SELECT `ordering` 
				    																		FROM product_category
				    																		WHERE cat_id = {$pnewsid}
				    																	)
				    										ORDER BY `ordering`, `cat_id`
				    										LIMIT 1
				    									)
				    						AND `lang_code` = ?
				    				ORDER BY `cat_id`
				    				LIMIT 1
				    			) As `preSesid`";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($lang_code));
		    
		    if ($row = $result->fetch())
		    {
			    $sql1 = "update product_category set `ordering` = ? where `cat_id` = ?";
			    $result1 = $this->dbObj->SqlQueryInputResult($sql1, array($row['currenOrder'], $row['preSesid']));
			    
			    if ($result1 > 0)
			    {
				    $sql2 = "update product_category set `ordering` = ? where `cat_id` = ?";
				    $result2 = $this->dbObj->SqlQueryInputResult($sql2, array($row['preOrder'], $pnewsid));
				    
				    if ($result2 > 0)
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
	    
	    // ham su ly di chuyen mau tin xuong phia tren cua item menu
	    function process_order_up_category($pnewsid, $lang_code)
	    {
		    $sql = "
		    			SELECT 
		    					(
		    						SELECT `ordering`
		    						FROM product_category
		    						WHERE cat_id = {$pnewsid}
		    					) As `currenOrder`,
				    			
				    			(
				    				SELECT max(`ordering`)
				    				FROM product_category 
				    				WHERE 	`parent_id` = 	(
				    											SELECT `parent_id` 
				    											FROM product_category 
				    											WHERE cat_id = {$pnewsid}
				    										)
				    						AND `ordering` < 	(
				    												SELECT `ordering`
				    												FROM product_category
				    												WHERE cat_id = {$pnewsid}
				    											)
				    				ORDER BY `ordering` LIMIT 1
				    			) As `preOrder`,
				    			
				    			(
				    				SELECT `cat_id`
				    				FROM product_category 
				    				WHERE `ordering` = 	(
				    										SELECT max(`ordering`) 
				    										FROM product_category 
				    										WHERE 	`parent_id` = 	(
				    																	SELECT `parent_id` 
				    																	FROM product_category 
				    																	WHERE cat_id = {$pnewsid}
				    																	LIMIT 1
				    																)
				    												AND `ordering` < 	(
				    																		SELECT `ordering` 
				    																		FROM product_category 
				    																		WHERE cat_id = {$pnewsid}
				    																		LIMIT 1
				    																	)
				    										ORDER BY `ordering`
				    										LIMIT 1
				    									)
				    						AND `lang_code` = ?
				    				LIMIT 1
				    			) As `preSesid`";
		    
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($lang_code));
		    
		    if ($row = $result->fetch())
		    {
			    $sql1 = "update product_category set `ordering` = ? where `cat_id` = ?";
			    $result1 = $this->dbObj->SqlQueryInputResult($sql1, array($row['currenOrder'], $row['preSesid']));
			    
			    if ($result1 > 0)
			    {
				    $sql2 = "update product_category set `ordering` = ? where `cat_id` = ?";
				    $result2 = $this->dbObj->SqlQueryInputResult($sql2, array($row['preOrder'], $pnewsid));
				    
				    if ($result2 > 0)
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

	    // ham su ly go bo mau tin trong chu de cha(session)
	    function process_remove_category($values)
	    {
		    $myprocess = new process();
		    
		    $result = $this->dbObj->SqlQueryOutputResult("
		    	
		    	SELECT
		    			GROUP_CONCAT(`product_category`.`cat_id`) as `id_list`
		    	FROM
		    			`product_category`,
		    			(SELECT `left`,`right` FROM `product_category` WHERE `cat_id` = ?) as A
		    	WHERE
		    			`product_category`.`left` > A.`left` 
		    			AND `product_category`.`right` < A.`right`
		    
		    ", array($values));
		    
		    if ($row = $result->fetch(PDO::FETCH_ASSOC))
		    {
		    	if (!empty($row['id_list']))
		    	{
		    		$result2 = $this->dbObj->SqlQueryOutputResult("
		    	
		    			SELECT
		    					GROUP_CONCAT(`book_product`.`Id`) as `id_list`
		    			FROM
		    					`book_product`
		    			WHERE
		    					`book_category_id` IN ({$row['id_list']})
				    
				    ", array($values));
				    
				    if ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
				    {
						if (!empty($row2['id_list']))
						{
							$sql = "
									
									DELETE FROM `book_product_comment` WHERE `book_product_id` IN ({$row2['id_list']});
									
									DELETE FROM `book_product_tabs` WHERE `product_id` IN ({$row2['id_list']});
									
									DELETE FROM `book_order_detail` WHERE `book_product_id` IN ({$row2['id_list']});
									
									DELETE FROM `book_product` WHERE `Id` IN ({$row2['id_list']});
							";
							
							$this->dbObj->SqlQueryInputResult($sql, array());
						}
				    }
				    
				    $sql = "DELETE FROM `product_category` WHERE `cat_id` IN ({$row['id_list']})";
				    
				    $this->dbObj->SqlQueryInputResult($sql, array());
				}
		    }
		    
		    if ($myprocess->check_exist_category_remove($values) > 0)
		    {
			    $GLOBALS['msg'] = "Danh mục này đang tồn tại danh mục con, vui lòng xóa danh mục con trước khi xóa danh mục này !!! ";
			    return true;
		    }
		    else
		    {
			    $sql = "Delete from product_category where cat_id = ?";
			    if ($this->dbObj->SqlQueryInputResult($sql, array($values)) <> FALSE) return true;
			    else return false;
		    }
	    }
	    
	    // ham kiem tra su hop le cua mau tin duoc xoa
	    function check_exist_category_remove($cat_id)
	    {
		    $sql = "SELECT count(cat_id) 'count' FROM `product_category` WHERE parent_id = ?";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($cat_id));
		    if($row = $result->fetch()){
			    return $row['count'];
		    } 
	    }
	    
	    // --- KHÔNG SỬ DỤNG NỮA ---
	    // Chèn uniqid vào các cột assoc_id rỗng của ngôn ngữ Tiếng Việt
	    function fix_null_assoc_id()
	    {
			$sql = "SELECT `cat_id` FROM `product_category` WHERE `lang_code` = 'vi' AND (`assoc_id` IS NULL OR `assoc_id` = '')";
			
			$null_list = $this->dbObj->SqlQueryOutputResult($sql, array());
			$exec_sql = '';
			
			while ($null_item = $null_list->fetch(PDO::FETCH_ASSOC))
			{
				$exec_sql .= 'UPDATE `product_category` SET `assoc_id` = "' . uniqid('', true) . '" WHERE `cat_id` = ' . $null_item['cat_id'] . ';';
			}
			
			if ($exec_sql == '') {
				return true;
			}
			else {
				return $this->dbObj->SqlQueryInputResult($exec_sql, array());
			}
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
	    function copy_category_update(&$sql_union)
	    {
			$result_update = $this->dbObj->SqlQueryOutputResult(substr($sql_union, 6), array());
			$sql_update = "";
			
			while ($row_update = $result_update->fetch(PDO::FETCH_ASSOC))
			{
				// $sql_update .= "UPDATE `product_category` SET `parent_id` = " . $row_update['parent_id'] . " WHERE `cat_id` = " . $row_update['cat_id'] . ";";
				$sql_update = "UPDATE `product_category` SET `parent_id` = " . $row_update['parent_id'] . " WHERE `cat_id` = " . $row_update['cat_id'] . ";";
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
	     * - Record mới này được gán `parent_id` = -2, để đánh dấu
	     * rằng nó chưa được gán `parent_id` (giá trị này sẽ được
	     * cập nhật sau).
	     * 
	     * - Lấy danh sách tất cả các record có `parent_id` = -2 ra,
	     * sau đó tạo câu lệnh SQL để truy vấn ra giá trị `parent_id`
	     * chính xác (dựa vào `assoc_id`).
	     * 
	     * - Lưu ý: trong quá trình tạo ra câu lệnh SQL này có thể phát
	     * sinh trường hợp là câu lệnh SQL lớn hơn giới hạn của MySQL
	     * (max_allowed_packet - mặc định là 1MB). Cho nên câu lệnh sẽ
	     * được chia nhỏ ra nhiều lần để đảm bảo không thể lớn hơn giá
	     * trị giới hạn này.
	     * 
	     * - Chuyển câu lệnh này sang hàm [copy_category_update] để tiếp
	     * tục xử lý.
	     * 
	     */
	    function copy_category()
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
					$this->dbObj->SqlQueryInputResult("INSERT IGNORE INTO `product_category`(`lang_code`, `parent_id`, `catid_array`, `root`, `title`, `alias`, `description`, `date_add`, `date_modify`, `ordering`, `enabled`, `num_view`, `left`, `right`, `assoc_id`) (SELECT '" . $key . "' as `lang_code`, -2 as `parent_id`, `catid_array`, `root`, CONCAT(`title`, ' (Sao chép lúc ', CURDATE(), ' ', CURTIME(), ')'), `alias`, `description`, `date_add`, `date_modify`, `ordering`, 0 as `enabled`, `num_view`, `left`, `right`, `cat_id` as `assoc_id` FROM `product_category` WHERE `lang_code` = 'vi' AND `cat_id` NOT IN (SELECT `assoc_id` FROM `product_category` WHERE `lang_code` = '" . $key . "'));", array());
				}
			}

			$result = $this->dbObj->SqlQueryOutputResult("SELECT `lang_code`, `cat_id`, `assoc_id` FROM `product_category` WHERE `parent_id` = -2", array());

			if ($result->rowCount() > 0)
			{
				$sql_union = "";
				$packet_size = 0;

				while ($row = $result->fetch(PDO::FETCH_ASSOC))
				{
					$sql_single = "UNION (SELECT '{$row['lang_code']}' as `lang_code`, '{$row['cat_id']}' as `cat_id`, R2.`cat_id` as `parent_id` FROM `product_category` as R2 WHERE R2.`assoc_id` = (SELECT R1.`parent_id` FROM `product_category` as R1 WHERE R1.`cat_id` = {$row['assoc_id']}) AND R2.`lang_code` = '{$row['lang_code']}') ";
					
					if ($packet_size + mb_strlen($sql_single) > $max_packet)
					{
						$this->copy_category_update($sql_union);
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
					$this->copy_category_update($sql_union);
				}
				
				$this->dbObj->SqlQueryInputResult('UPDATE `product_category` SET `parent_id` = 0 WHERE `parent_id` = -2', array());
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
        
        /* khoi su ly su kien submit form category */
        case "submit_com_product_category_view";
            
            if ($_POST["task"] == "unpublish") {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_pulish_and_un_publish_category("0", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE)
                $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }

            else if ($_POST["task"] == "publish") {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_pulish_and_un_publish_category("1", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE) $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
             else if ($_POST["task"] == "unpublish_c") {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_pulish_and_un_publish_category_c("0", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE)
                $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
			else if ($_POST["task"] == "publish_c") {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_pulish_and_un_publish_category_c("1", $values[$row]) <> FALSE)
                    $check = TRUE;
                }
                if($check == TRUE) $GLOBALS['msg'] = "";
                else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
            }
            else if ($_POST["task"] == "orderup") {
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++){
                    if($myprocess->process_order_up_category($values[$row], $_SESSION['amdin']['com_product']['category']['lang_code']) <> FALSE)
                    $GLOBALS['msg'] = "";
                    else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
                }
            }

            else if ($_POST["task"] == "orderdown") {
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++) {
                    if ($myprocess->process_order_down_category($values[$row], $_SESSION['amdin']['com_product']['category']['lang_code']) <> FALSE) {
                        $GLOBALS['msg'] = "";
                    } else {
                        $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
                    }
                }
            }
            
            else if ($_POST["task"] == "remove") {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                
                for ($row = 0; $row < count($values); $row++){
                    if ($myprocess->process_remove_category($values[$row]) <> FALSE) {
                        $check = TRUE;
                    }
                }
                
                // $myprocess->UpdateChildrenIdList();
                $myprocess->reset_left_right_value();
                
                if ($check != TRUE) {
                    $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
                }
            }
            
            else if ($_POST["task"] == "order") {
                $check = FALSE;
                $checked_id = $_POST["cid"];
                $order_id = $_POST["order"];
                $myprocess = new process;
                
                for ($row = 0; $row < count($order_id); $row++){
                    if ($myprocess->process_order_all_category($order_id[$row], $checked_id[$row]) <> FALSE) {
                        $check = TRUE;
                    }
                }
                
                if ($check != TRUE) {
                    $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỡi, vui lòng liên hệ quản trị !";
                }
            }
            
            else if ($_POST["task"] == "add") {
                //header("location: .?mod=newcategories&sesid=".$_POST["sectionid"]);exit;
                $core_class->_redirect(".?com=com_product&view=category&task=add");
                exit;
            }
            
            else if ($_POST['task'] == 'synch') {
				$myprocess = new process();
				$myprocess->copy_category();
				// $core_class->_redirect('?com=com_product&view=category&task=view');
				// exit();
            }
            
            else if ($_POST['task'] == 'change_lang_code') {
				$_SESSION['amdin']['com_product']['category']['lang_code'] = $_POST['lang_code'];
				$core_class->_redirect('?com=com_product&view=category&task=view');
				exit();
            }
        
        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }