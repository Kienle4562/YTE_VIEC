<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process_contact
    {
        public $dbObj;
        
        function __construct()
        {
             $this->dbObj = new classDb();
        }
        
	    function process_remove_master_contact($values)
        {
		    $sql = "Delete from `contact` where `contact`.`id` = ?";
		    
            if ($this->dbObj->SqlQueryInputResult($sql, array($values)))
            {
			    return true;
		    }
		    else
            {
                return false;
            }
	    }
        
        public function get_contact_list()
        {
            return $this->dbObj->SqlQueryOutputResult("
                
                SELECT
                            `contact`.`id`,
                            `contact`.`name`,
                            `contact`.`email`,
                            `contact`.`address`,
                            `contact`.`phone`,
                            `contact`.`company`,
                            `contact`.`fax`,
                            `contact`.`title`,
                            `contact`.`content`,
                            `contact`.`date_add`,
                            `contact`.`status`
                FROM
                            `contact` 
                ORDER BY
                            `contact`.`date_add` DESC", array());
        }
        
        public function change_status($contact_id, $status)
        {
            $sql = "
                
                UPDATE
                            `contact`
                SET
                            `status` = ?
                WHERE
                            `id` = ?
            
            ";
            
            return $this->dbObj->SqlQueryInputResult($sql, array($status, $contact_id));
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
        
        case "submit_com_contact_view_master":
            if ($_POST["task"] == "remove")
            {
                $check = FALSE;
                $values = $_POST["cid"];
                
                $myprocess = new process_contact();
                
                for ($row = 0; $row < count($values); $row++)
                {
                    if ($myprocess->process_remove_master_contact($values[$row]) <> FALSE)
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
            elseif ($_POST["task"] == "change_status")
            {
				$myprocess = new process_contact();
	            $contact_id = intval($_POST["contact_id"]);
	            
	            if ($_POST['status'] == 0 || $_POST['status'] == 1) {
	            	$status = $_POST['status'];
	            	$myprocess->change_status($contact_id, $status);
				}
				
				$core_class->_redirect($index_backend . '?com=com_contact&view=master');
		        exit();
            }
        break;
        
        case "submit_com_contact_change_status":
            
        break;
        
        default:
            $core_class->_redirect(".");
        break;
    }