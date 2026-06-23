<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class com_layout_process
    {
    	public $dbObj;
    
        function __construct()
        {
             $this->dbObj = new classDb();
        }
        
	    function get_components_list()
	    {
			$sql = "SELECT * FROM `layout_components` ORDER BY `component_title` ASC";
		    return $this->dbObj->SqlQueryOutputResult($sql, array());
	    }
	    
	    function get_layout_list()
	    {
			$sql = "SELECT * FROM `layout` ORDER BY `name` ASC";
		    return $this->dbObj->SqlQueryOutputResult($sql, array());
	    }
	    
	    function update_layout()
	    {
			$keys = array_keys($_POST['component_key']);
			$sql = "";
			$sql_params = array();
                
            foreach ($keys as $k)
            {
				$sql .= "
							UPDATE
									`layout_components`
							SET
									`layout_id` = ?
							WHERE
									`component_key` = ?;
				";
				
				$sql_params[] = $_POST['layout_id'][$k];
				$sql_params[] = $_POST['component_key'][$k];
            }
            
            return $this->dbObj->SqlQueryInputResult($sql, $sql_params);
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

        case "submit_com_layout_view_list";
            if ($_POST["task"] == "save")
            {
            	$myprocess = new com_layout_process();
                $myprocess->update_layout();
                $core_class->_redirect("./?com=com_layout&view=done");
                exit();
            }
        break;

        default:
            $core_class->_redirect(".");
            exit();
        break;
    }