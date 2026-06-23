<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process {

	    public $dbObj;
	    
	    function __construct()
	    {
		     $this->dbObj = new classDb();
	    }

	    // ham su them mot mau tin cua chu de cha ( session )
	    function process_addnews($cat_id, $account, $title, $alias, $description, $content, $date_add, $date_mofify, $img_file, $img_status, $enabled, $focus,$tags){
		    $myprocess = new process;
		    $sql = "Insert into news(`category_id`, `acc_id`, `title`, `alias`, `description`, `content`, `date_add`, `date_modify`, `img_file`, `img_status`, `enabled`, `ordering`, `focus`, `tags`) 
				    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		    if($this->dbObj->SqlQueryInputResult($sql, array($cat_id, $account, $this->dbObj->fix_quotes_dquotes($title), $alias, $description, $content, $date_add, $date_mofify, $img_file, $img_status, $enabled, $myprocess->process_getmaxid("news", "ordering"), $focus,$tags)) <> FALSE){
			    return true;
		    }
	    }
		    
	    // ham su lay so thu tu lon nhat cho moi mau tin
	    function process_getmaxid($table, $column){
		    $sql = "select MAX(`$column`)+1 As `MaxId` from `$table`;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    if($row = $result->fetch()){
			    if($row['MaxId'] == 0)	return 1;
			    else return $row['MaxId'];
		    }
	    }

	    public function get_author_list()
	    {
		    $sql = "Select `Ac_Id`, `userName` From `account`";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    return $result;
	    }
	    
	    public function category_multi_level($parentid, $lang_code)
	    {
		    $sql = "SELECT `cat_id`, `title`, `date_add`, `enabled`, `num_view`, `ordering`, `parent_id` FROM `category` WHERE parent_id = ? AND `lang_code` = ? order by `ordering`";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
		    return $result;
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
        
        case "submit_com_content_news_add";
        
            $myprocess = new process;

            $catid               = intval($_POST["catid"]);
            $created_by       = $_POST["created_by"];
            $title               = $core_class->txt_htmlspecialchars($_POST["title"]);
            $alias               = $core_class->_removesigns($_POST["alias"]);
            $html_description = $core_class->txt_htmlspecialchars($_POST["html_description"]);
            $html_content       = $core_class->txt_htmlspecialchars($_POST["html_content"]);                
            $date_add           = $core_class->_formatdate($_POST["date_add"]);
            $date_modify       = $date_add;
            $image_file       = $_POST["image_file"];
            $img_status       = $_POST["img_status"];
            $state               = $_POST["state"];
            $frontpage           = $_POST["frontpage"];
			$tags	           	 = $_POST["tags"];
            
            if($_POST["task"] == "save"){                
                if($myprocess->process_addnews(                    
                    $catid, $created_by, $title, $alias, $html_description, $html_content, $date_add, $date_modify, $image_file, $img_status, $state, $frontpage,$tags
                ) <> FALSE){
                    $core_class->_redirect(".?com=com_content&view=news&task=view");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm bài viết, vui lòng làm lại!";
                }
            } else if ($_POST["task"] == "apply"){
                if($myprocess->process_addnews(
                    $catid, $created_by, $title, $alias, $html_description, $html_content, $date_add, $date_modify, $image_file, $img_status, $state, $frontpage,$tags
                ) <> FALSE){
                    $GLOBALS['msg'] = "Chủ đề đã được thêm thành công!";
                    $core_class->_redirect(".?com=com_content&view=news&task=add");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm bài viết, vui lòng làm lại!";
                }
            } else if($_POST["task"] == "cancel"){
                $core_class->_redirect(".?com=com_content&view=news&task=view");
                exit;
            }

        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }