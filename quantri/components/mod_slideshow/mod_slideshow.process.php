<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class process
    {
        public $dbObj;


        function __construct()
        {
            $this->dbObj = new classDb();
        }


        function get_mod_slideshow_list()
        {
            return $this->dbObj->SqlQueryOutputResult("

                SELECT
                        `module_id`,
                        `title`,
                        `date_add`,
                        `enabled`,
                        `lang_code`
                FROM
                        `modules`
                WHERE
                        `module` = 'mod_slideshow'
                ORDER BY
                		`lang_code` ASC

                ", array(0));
        }


        // ham su ly di chuyen mau tin xuong phia duoi cua folder
        /*function process_orderdownfolder($psesid){
        $sql = "SELECT (SELECT `order` from group_gallery WHERE Id = $psesid) As `currenOrder`, 
        (SELECT `order` from group_gallery WHERE `order` > 
        (SELECT `order` from group_gallery WHERE Id = $psesid) 
        Order by `order` LIMIT 1) As `preOrder`,
        (SELECT Id from group_gallery WHERE `order` = 
        (SELECT `order` from group_gallery WHERE `order` > 
        (SELECT `order` from group_gallery WHERE Id = $psesid) 
        Order by `order` LIMIT 1) LIMIT 1) As `preSesid`";

        $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
        if($row = $result->fetch()){
        $sql1 = "update group_gallery set `order` = ? where `Id` = ?";
        $result1 = $this->dbObj->SqlQueryInputResult($sql1, array($row['currenOrder'], $row['preSesid']));
        if($result1 > 0){
        $sql2 = "update group_gallery set `order` = ? where `Id` = ?";
        $result2 = $this->dbObj->SqlQueryInputResult($sql1, array($row['preOrder'], $psesid));
        if($result2 > 0){
        return true;
        }
        else return false;
        return true;					
        }				 
        else return false;
        }					
        }*/


        // ham su ly di chuyen mau tin len phia tren cua folder
        /*function process_orderupfolder($psesid){
        $sql = "SELECT (SELECT `order` from group_gallery WHERE `Id` = $psesid) As `currenOrder`, 
        (SELECT `order` from group_gallery WHERE `order` < 
        (SELECT `order` from group_gallery WHERE `Id` = $psesid) 
        Order by `order` desc LIMIT 1) As `preOrder`,
        (SELECT `Id` from group_gallery WHERE `order` = 
        (SELECT `order` from group_gallery WHERE `order` < 
        (SELECT `order` from group_gallery WHERE `Id` = $psesid) 
        Order by `order` desc LIMIT 1) LIMIT 1) As `preSesid`";

        $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
        if($row = $result->fetch()){

        $result1 = $this->dbObj->SqlQueryInputResult($sql1, array($row['currenOrder'], $row['preSesid']));
        if($result1 > 0){
        $sql2 = "update group_gallery set `order` = ? where `Id` = ?";

        $result2 = $this->dbObj->SqlQueryInputResult($sql1, array($row['preOrder'], $psesid));
        if($result2 > 0){
        return true;
        }
        else return false;
        return true;						
        }				 
        else return false;
        }					
        }*/

        // ham su ly di chuyen mau tin xuong phia duoi cua hinh anh trong album
        function process_orderdowndetail($psesid){
            $sql = "SELECT (SELECT `order_num` from mod_slideshow WHERE Id = $psesid) As `currenOrder`, 
            (SELECT `order_num` from mod_slideshow WHERE `order_num` > 
            (SELECT `order_num` from mod_slideshow WHERE Id = $psesid) 
            Order by `order_num` LIMIT 1) As `preOrder`,
            (SELECT Id from mod_slideshow WHERE `order_num` = 
            (SELECT `order_num` from mod_slideshow WHERE `order_num` > 
            (SELECT `order_num` from mod_slideshow WHERE Id = $psesid) 
            Order by `order_num` LIMIT 1) LIMIT 1) As `preSesid`";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
            if($row = $result->fetch()){
                $sql1 = "update mod_slideshow set `order_num` = ? where `Id` = ?";

                $result1 = $this->dbObj->SqlQueryInputResult($sql1, array($row['currenOrder'], $row['preSesid']));
                if($result1 > 0){
                    $sql2 = "update mod_slideshow set `order_num` = ? where `Id` = ?";

                    $result2 = $this->dbObj->SqlQueryInputResult($sql1, array($row['preOrder'], $psesid));
                    if($result2 > 0){
                        return true;
                    }
                    else return false;
                    return true;						
                }				 
                else return false;
            }					
        }

        // ham su ly di chuyen mau tin len phia tren cua folder
        function process_orderupdetail($psesid){
            $sql = "SELECT (SELECT `order_num` from mod_slideshow WHERE `Id` = $psesid) As `currenOrder`, 
            (SELECT `order_num` from mod_slideshow WHERE `order_num` < 
            (SELECT `order_num` from mod_slideshow WHERE `Id` = $psesid) 
            Order by `order_num` desc LIMIT 1) As `preOrder`,
            (SELECT `Id` from mod_slideshow WHERE `order_num` = 
            (SELECT `order_num` from mod_slideshow WHERE `order_num` < 
            (SELECT `order_num` from mod_slideshow WHERE `Id` = $psesid) 
            Order by `order_num` desc LIMIT 1) LIMIT 1) As `preSesid`";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
            if($row = $result->fetch()){
                $sql1 = "update mod_slideshow set `order_num` = ? where `Id` = ?";

                $result1 = $this->dbObj->SqlQueryInputResult($sql1, array($row['currenOrder'], $row['preSesid']));
                if($result1 > 0){
                    $sql2 = "update mod_slideshow set `order_num` = ? where `Id` = ?";

                    $result2 = $this->dbObj->SqlQueryInputResult($sql1, array($row['preOrder'], $psesid));
                    if($result2 > 0){
                        return true;
                    }
                    else return false;
                    return true;						
                }				 
                else return false;
            }		
        }

        // ham su ly them thu muc album anh
        /*function process_addfoldergallery($title, $folder_icon, $description, $date_add, $status, $order){
        $sql = "INSERT into group_gallery (`title`, `folder_icon`, `description`, `date_add`, `status`, `order`) VALUES (?, ?, ?, ?, ?, ?)";	
        $result = $this->dbObj->SqlQueryInputResult($sql, array($title, $folder_icon, $description, $date_add, $status, $order));
        if($result > 0)
        return true;
        else
        return false;		
        }*/

        // ham su ly them hianh vo album
        function process_adddetailgallery(
				$module_id,
				$image_file, 
				$link,
				$title_name, 
				$description, 
				$logo_company,
				$target,
				$price, 
				$star_date, 
				$end_date, 
				$contact_customer, 
				$user_id, 
				$date_add, 
				$activated,  
				$order_num){

            $sql = "INSERT into mod_slideshow (
			`module_id`, 
			`image_file`,  
			`link`,
			`title_name`, 
			`description`, 
			`logo_company`, 
			`target`, 
			`price`,
			`star_date`, 
			`end_date`,
			`contact_customer`,
			`user_id`, 
			`date_add`,
			`activated`,  
			`order_num`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $result = $this->dbObj->SqlQueryInputResult($sql, array($module_id, $image_file,$link, $title_name, $description, $logo_company,$target, $price, $star_date, $end_date, $contact_customer, $user_id, $date_add, $activated,  $order_num));
            if($result > 0)
                return true;
            else
                return false;		
        }

        // ham su lay so thu tu lon nhat cho moi mau tin
        function process_getmaxid($table, $column)
        {
            $sql = "select MAX(`$column`)+1 As `MaxId` from `$table`;";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));

            if ($row = $result->fetch()) {
                if ($row['MaxId'] == 0) {
                    return 1;
                }
                else {
                    return $row['MaxId'];
                }
            }
        }

        // ham su ly su kien publish va khong publish album
        /*function process_pulish_and_un_publish_folder($check, $values){
        if($check == 0)
        $sql = "Update group_gallery Set `status` = 0 Where `Id` = ?";
        else $sql = "Update group_gallery Set `status` = 1 Where `Id` = ?";

        $result = $this->dbObj->SqlQueryInputResult($sql, array($values));

        if($result > 0){
        return true;
        }
        else
        return false;	

        }*/

        // ham su ly su kien publish va khong publish hinh anh trong album
        function process_pulish_and_un_publish_detail($check, $values){
            if($check == 0)
                $sql = "Update mod_slideshow Set `activated` = 0 Where `Id` = ?";
            else $sql = "Update mod_slideshow Set `activated` = 1 Where `Id` = ?";
            $result = $this->dbObj->SqlQueryInputResult($sql, array($values));
            if($result > 0)
                return true;
            else
                return false;
        }

        // ham su ly go bo album
        /*function process_remove_folder($values){
        $sql = "Delete from `group_gallery` where `Id` = ?";
        $result = $this->dbObj->SqlQueryInputResult($sql, array($values));
        if($result > 0)
        return true;
        else
        return false;
        }*/

        // ham su ly go bo hianh anh trong album
        function process_remove_detail($values){
            $sql = "Delete from `mod_slideshow` where `Id` = ?";
            $result = $this->dbObj->SqlQueryInputResult($sql, array($values));
            if($result > 0)
                return true;
            else
                return false;
        }

        // ham su ly chinh sua thu muc album
        /*function process_editfolder($title, $folder_icon, $description, $date_add, $activated, $Id){
        $sql = "UPDATE group_gallery SET `title` = ?, `folder_icon` = ?, `description` = ?, `date_add` = ?, `status` = ? WHERE Id = ?";
        $result = $this->dbObj->SqlQueryInputResult($sql, array($title, $folder_icon, $description, $date_add, $activated, $Id));
        if($result > 0)
        return true;
        else
        return false;
        }*/

        // ham su ly chinh sua anh trong allbum
        function process_editdetail($module_id, $image_file, $target, $link,$title_name,$description,$logo_company,$target,$price,$star_date,$end_date,$contact_customer,$date_add, $activated, $Id){
            $sql = "UPDATE mod_slideshow SET `module_id` = ?, `image_file` = ?, `target` = ?, `link` = ?, `title_name` = ?, `description` = ?, `logo_company` = ?,`target` = ?, `price` = ?, `star_date` = ?, `end_date` = ?, `contact_customer` = ?, `date_add` = ?, `activated` = ? WHERE Id = ?";
            $result = $this->dbObj->SqlQueryInputResult($sql, array($module_id, $image_file, $target, $link,$title_name,$description,$logo_company,$target,$price,$star_date,$end_date,$contact_customer,$date_add, $activated, $Id));
            if($result > 0)
                return true;
            else
                return false;
        }

        //Get detail information
        function process_getdetailinformation($id){
            $sql = "SELECT `Id`, `module_id`, `image_file`, `target`, `link`, `title_name`, `description`,`logo_company`,`price`,`star_date`,`end_date`,`contact_customer`,`user_id`,Date_FORMAT(`date_add`, '%d/%m/%Y') As `date_add`, `activated`, `order_num`
            FROM `mod_slideshow` where `Id` = ? ";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($id));
            return $result;
        }

        //Get folder detail information
        /*function process_getdetail_folder_information($id){
        $sql = "SELECT `Id`, `title`, `folder_icon`, `description`, Date_FORMAT(`date_add`, '%d/%m/%Y') As `date_add`, `status`, `order`
        FROM `group_gallery` WHERE `Id` = ?";
        $result = $this->dbObj->SqlQueryOutputResult($sql, array($id));
        return $result;
        }*/

        //Get gallery type information
        /*function process_gettypeinformation(){
        $sql = "SELECT `Id` as 'subid', `title` as 'subtitle' FROM `group_gallery`";
        $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
        return $result;
        }*/

        //Get all gallery information to gridview
        function process_getallgallery($gallery_type_id)
        {
            $sql = "

                    SELECT 
                            `Id`,
                            `image_file`, 
                            `link`,
                            Date_FORMAT(`date_add`, '%d/%m/%Y') As `date_add`, 
                            `activated`,
                            `order_num`
                    FROM
                            `mod_slideshow`
                    WHERE 
                            `module_id` = ?
                    ORDER BY 
                            `order_num` desc
            ";
            
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($gallery_type_id));
            return $result;
        }
        
        function get_module_info($id)
        {
            $sql = "

                    SELECT 
                            `title`,
                            `lang_code`
                    FROM
                            `modules`
                    WHERE 
                            `module_id` = ?
            ";
            
            return $this->dbObj->SqlQueryOutputResult($sql, array($id));
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

        case "submit_com_gallery_detail_add";
				$myprocess = new process;
				
            if($_POST["task"] == "save"){
				$myprocess = new process;
				$module_id = $_POST['gallery_id'];
				$image_file = $_POST['image_file'];
				$title_name = $_POST['title_name'];
				$description = $_POST['description']; 
				$logo_company = $_POST['logo_company']; 
				$price = $_POST['price']; 
				$link =$_POST['link']; 
				$star_date = $core_class->_formatdate($_POST["date_start_add"]); 
				$end_date = $core_class->_formatdate($_POST["date_end_add"]); 
				$contact_customer = $_POST['contact_customer']; 
				$user_id = $_SESSION["session"]["Per_Id"]; 
				$date_add = date("Y-m-d H:i:s");
				$activated = $_POST['published'];  
				$order_num =  $myprocess->process_getmaxid("mod_slideshow", "order_num");
                if ($myprocess->process_adddetailgallery($module_id, $image_file, $link, $title_name, $description, $logo_company, $target, $price, $star_date, $end_date, $contact_customer, $user_id, $date_add, $activated,  $order_num) <> FALSE) 
                {
                    $core_class->_redirect(".?com=mod_slideshow&view=detail&task=view&id=". $_POST["group_type_id"]);
                    exit();
                }
                else {
                    $GLOBALS['msg'] = "Đã có lỗi xảy ra, vui lòng làm lại";
                } 
            }
            elseif ($_POST["task"] == "apply") {
                 $myprocess = new process;
			    $module_id = $_POST['gallery_id'];
				$image_file = $_POST['image_file'];
				$title_name = $_POST['title_name'];
				$description = $_POST['description']; 
				$logo_company = $_POST['logo_company']; 
				$price = $_POST['price']; 
				$link =$_POST['link'];
				$target =$_POST['target']; 	
				$star_date = $core_class->_formatdate($_POST["date_start_add"]); 
				$end_date = $core_class->_formatdate($_POST["date_end_add"]); 
				$contact_customer = $_POST['contact_customer']; 
				$user_id = $_SESSION["session"]["Per_Id"]; 
				$date_add = date("Y-m-d H:i:s");
				$activated = $_POST['published'];  
				$order_num =  $myprocess->process_getmaxid("mod_slideshow", "order_num");
                if ($myprocess->process_adddetailgallery($module_id, $image_file, $link, $title_name, $description, $logo_company, $target, $price, $star_date, $end_date, $contact_customer, $user_id, $date_add, $activated,  $order_num) <> FALSE)
                {
                    $core_class->_redirect(".?com=mod_slideshow&view=detail&task=add&id=". $_POST["group_type_id"]);
                    exit();
                }
                else {
                    $GLOBALS['msg'] = "Đã có lỗi xảy ra, vui lòng làm lại";
                } 
            }
            elseif ($_POST["task"] == "cancel") {
                $core_class->_redirect(".?com=mod_slideshow&view=detail&task=view&id=". $_POST["group_type_id"]);
                exit();
            }
        break;

        case "submit_com_gallery_detail_view";
            if($_POST["task"] == "unpublish") {
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++) {
                    $myprocess->process_pulish_and_un_publish_detail("0", $values[$row]);
                }
                $core_class->_redirect(".?com=mod_slideshow&view=detail&task=view&id=".$_POST["group_type_id"]);
            }
            elseif ($_POST["task"] == "publish") {
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++) {
                    $myprocess->process_pulish_and_un_publish_detail("1", $values[$row]);
                }
                $core_class->_redirect(".?com=mod_slideshow&view=detail&task=view&id=".$_POST["group_type_id"]);
            }
            elseif($_POST["task"] == "orderup") {
                $values = $_POST["cid"];
                $myprocess = new process;

                for ($row = 0; $row < count($values); $row++) {
                    $myprocess->process_orderdowndetail($values[$row]);                
                }

                $core_class->_redirect(".?com=mod_slideshow&view=detail&task=view&id=".$_POST["group_type_id"]);
            }
            elseif ($_POST["task"] == "orderdown") {
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++) {
                    $myprocess->process_orderupdetail($values[$row]);            
                }
                //$core_class->_redirect(".?com=mod_slideshow&view=detail&task=view&id=".$_POST["group_type_id"]);
            }
            elseif ($_POST["task"] == "remove") {
                $check = FALSE;
                $values = $_POST["cid"];
                $myprocess = new process;
                for ($row = 0; $row < count($values); $row++) {
                    $myprocess->process_remove_detail($values[$row]);            
                }
                $core_class->_redirect(".?com=mod_slideshow&view=detail&task=view&id=".$_POST["group_type_id"]);
            }
        break;
				
        case "submit_com_gallery_detail_edit";
            if ($_POST["task"] == "save") {
                $myprocess = new process;
				$title_name = $_POST['title_name'];
				$description = $_POST['description']; 
				$logo_company = $_POST['logo_company']; 
				$price = $_POST['price']; 
				$link =$_POST['link'];
				$target =$_POST['target']; 	
				$star_date = $core_class->_formatdate($_POST["date_start_add"]); 
				$end_date = $core_class->_formatdate($_POST["date_end_add"]); 
				$contact_customer = $_POST['contact_customer'];
                if ($myprocess->process_editdetail($_POST["gallery_id"], $_POST["image_file"], $_POST["browserNav"], $_POST["link"],$title_name,$description,$logo_company,$target,$price,$star_date,$end_date,$contact_customer,$core_class->_formatdatetime($_POST["date_add"]), $_POST["published"], $_POST["Id"]) <> FALSE) {
                    $core_class->_redirect(".?com=mod_slideshow&view=detail&task=view&id=". $_POST["gallery_id"]);
                    exit();
                }
                else {
                    $GLOBALS['msg'] = "Đã có lỗi xảy ra, vui lòng làm lại";
                }
            }
            else if($_POST["task"] == "apply") {
                $myprocess = new process;
				$title_name = $_POST['title_name'];
				$description = $_POST['description']; 
				$logo_company = $_POST['logo_company']; 
				$price = $_POST['price']; 
				$link =$_POST['link'];
				$target =$_POST['target']; 	
				$star_date = $core_class->_formatdate($_POST["date_start_add"]); 
				$end_date = $core_class->_formatdate($_POST["date_end_add"]); 
				$contact_customer = $_POST['contact_customer'];
                 if ($myprocess->process_editdetail($_POST["gallery_id"], $_POST["image_file"], $_POST["browserNav"], $_POST["link"],$title_name,$description,$logo_company,$target,$price,$star_date,$end_date,$contact_customer,$core_class->_formatdatetime($_POST["date_add"]), $_POST["published"], $_POST["Id"]) <> FALSE) {
                    $core_class->_redirect(".?com=mod_slideshow&view=detail&task=edit&id=".$_POST["Id"]);
                    exit();
                }
                else {
                    $GLOBALS['msg'] = "Đã có lỗi xảy ra, vui lòng làm lại";
                }
            }
            else if($_POST["task"] == "cancel"){
                $core_class->_redirect(".?com=mod_slideshow&view=detail&task=view&id=".$_POST["gallery_id"]);
                exit();
            }
            break;

        default:
            $core_class->_redirect(".");
            exit();
            break;
    }