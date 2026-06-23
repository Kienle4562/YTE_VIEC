<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process_order
    {
        public $dbObj;
        
        function __construct()
        {
             $this->dbObj = new classDb();
        }
        
	    function process_remove_master_order($values)
        {
			
			
			    $sql = "Update `book_order` Set `hiden` = 1 Where `id` = ?";
				
                if ($this->dbObj->SqlQueryInputResult($sql, array($values)))
                {
				    return true;
			    }else
				{
					 return false;
				}
		   /* $sql = "Delete from `book_order_detail` where `book_order_detail`.`book_order_id` = ?";
		    
            if ($this->dbObj->SqlQueryInputResult($sql, array($values)))
            {
			    $sql = "Delete from `book_order` where `book_order`.`Id` = ?";
			    
                if ($this->dbObj->SqlQueryInputResult($sql, array($values)))
                {
				    return true;
			    }
		    }
		    else
            {
                return false;
            }*/
	    }
        
        public function get_order_list()
        {
            return $this->dbObj->SqlQueryOutputResult("
                
                SELECT
                            `book_order`.`Id`,
                            `book_order`.`fullname`,
                            `book_order`.`email`,
                            `book_order`.`diachi1`,
                            `book_order`.`phone`,
                           
                            `book_order`.`total_order`,
                            `book_order`.`date_add`,
                            `book_order`.`status`
                FROM
                            `book_order` WHERE book_order.hiden = 0
                ORDER BY
                            `book_order`.`date_add` DESC", array());
        }
        
        public function get_order_detail($id)
        {
            $sql = "
            
                SELECT
                            `book_order`.`fullname`,
                            `book_order`.`email`,
                            `book_order`.`diachi1`,
                            `book_order`.`phone`,
                           	`book_order`.`diachi2`,
							`book_order`.`thongtin`,
                            `book_order`.`total_order`,
                            `book_order`.`date_add`,
                            `book_order`.`status`,
							`book_order`.`thanhtoan`,
							`book_order`.`nganhang`,
							`book_order`.`khuvuc`,
							`book_order`.`phichuyen`,
                            `book_order_detail`.`quantity`,
							`book_order_detail`.`size`,
							`book_order_detail`.`color`,
                            `book_order_detail`.`discounts`,
                            `book_order_detail`.`discount_type`,
                            `book_order_detail`.`unit_price`,
                            `book_order_detail`.`total`,
                            `book_product`.`product_name`,
							`book_product`.`SPID`
                FROM
                            `book_order`
                            INNER JOIN `book_order_detail` ON `book_order`.`Id` = `book_order_detail`.`book_order_id`
                            INNER JOIN `book_product` ON `book_product`.`Id` = `book_order_detail`.`book_product_id`
                WHERE
                            `book_order`.`Id` = ?
            ";
            
            return $this->dbObj->SqlQueryOutputResult($sql, array($id));
        }
        
		  function get_khuvuc_gia($id)
        {
            $sql = "SELECT
							banggia.gia,
							khuvuc.khuvuc,
							khuvuc.id
						FROM
							banggia
						INNER JOIN khuvuc ON banggia.id = khuvuc.idbanggia
						WHERE khuvuc.id = ?";
            
            return $this->dbObj->SqlQueryOutputResult($sql, array($id));
        }
        public function change_status($order_id, $status)
        {
            $sql = "
                
                UPDATE
                            `book_order`
                SET
                            `status` = ?
                WHERE
                            `id` = ?
            
            ";
            
            return $this->dbObj->SqlQueryInputResult($sql, array($status, $order_id));
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
            // khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        case "submit_com_order_view_master":
            if ($_POST["task"] == "remove")
            {
                $check = FALSE;
                $values = $_POST["cid"];
                
                $myprocess = new process_order;
                
                for ($row = 0; $row < count($values); $row++)
                {
                    if ($myprocess->process_remove_master_order($values[$row]) <> FALSE)
                    {
                        $check = TRUE;
                    }
                }
                
                if ($check == TRUE) {
                    $GLOBALS['msg'] = "";
                }
                else {
                    $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
                }
            }
        break;
        
        case "submit_com_order_change_status":
            $myprocess = new process_order();
            $myprocess->change_status($_GET['id'], $_POST['status']);
            $core_class->_redirect($index_backend . '?com=com_order&view=detail&id=' . $_GET['id']);
            exit();
        break;
        
        default:
            $core_class->_redirect(".");
        break;
    }