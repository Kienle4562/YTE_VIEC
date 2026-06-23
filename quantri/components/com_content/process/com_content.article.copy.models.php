<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process {

	    public $dbObj;
	    
	    function __construct()
	    {
		     $this->dbObj = new classDb();
	    }

	    // ham su them mot mau tin cua chu de cha ( session )
	    function process_copy_news($cat_id, $account, $title, $alias, $description, $content, $date_add, $date_mofify, $img_file, $img_status, $enabled, $focus){
		    $myprocess = new process;
		    $sql = "Insert into news(`category_id`, `acc_id`, `title`, `alias`, `description`, `content`, `date_add`, `date_modify`, `img_file`, `img_status`, `enabled`, `ordering`, `focus`) 
				    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		    if($this->dbObj->SqlQueryInputResult($sql, array($cat_id, $account, $this->dbObj->fix_quotes_dquotes($title), $alias, $description, $content, $date_add, $date_mofify, $img_file, $img_status, $enabled, $myprocess->process_getmaxid("news", "ordering"), $focus)) <> FALSE){
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
	    
	    public function get_article_edit($news_id)
	    {
		    $sql = "SELECT 
					    `news`.`category_id`, `news`.`news_id`, `news`.`acc_id`, `news`.`title`, `news`.`alias`, `news`.`description`, `news`.`content`, `news`.`enabled`, 
					    `news`.`focus`, `news`.`img_file`, `news`.`date_add`, `news`.`img_status`, `news`.`num_view`
				    FROM
					    `news`
				    Where `news`.`news_id` = ?;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($news_id));
		    return $result;
	    }
	    
	    public function category_multi_level($parentid)
	    {
		    $sql = "SELECT `cat_id`, `title`, `date_add`, `enabled`, `num_view`, `ordering`, `parent_id` FROM `category` WHERE parent_id = ? order by `ordering`";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid));
		    return $result;
	    }
	    
	    public function get_author_list()
	    {
		    $sql = "Select `Ac_Id`, `userName` From `account`";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    return $result;
	    }
		    
	    // ham loai bo ky tu dac biet trong chuoi khi lay ra
	    function txt_htmlspecialchars($t="")
	    {
		    // Use forward look up to only convert & not &#123;
		    //$t = str_replace( "<", "&lt;"  , $t );
		    //$t = str_replace( ">", "&gt;"  , $t );
		    $t = str_replace( "\\", ""  , $t );
		    //$t = str_replace( '"', "", $t );
		    
		    return $t; // A nice cup of?
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
        
        case "submit_com_content_news_copy";
            $myprocess = new process;
            if($_POST["task"] == "save"){                
                if($myprocess->process_copy_news(
                
                        $_POST["catid"], 
                        $_POST["created_by"], 
                        $myprocess->txt_htmlspecialchars($_POST["title"]), 
                        $core_class->_removesigns($_POST["alias"]), 
                        $myprocess->txt_htmlspecialchars($_POST["html_description"]), 
                        $myprocess->txt_htmlspecialchars($_POST["html_content"]),                     
                        $core_class->_formatdate($_POST["date_add"]), 
                        $core_class->_formatdate($_POST["date_add"]), 
                        $_POST["image_file"], 
                        $_POST["img_status"], 
                        $_POST["state"], 
                        $_POST["frontpage"]
                        
                    ) <> FALSE){
                    $core_class->_redirect(".?com=com_content&view=news&task=view");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            } else if ($_POST["task"] == "apply"){
                if($myprocess->process_addnews(
                
                    $_POST["catid"], 
                    $_POST["created_by"], 
                    $myprocess->txt_htmlspecialchars($_POST["title"]), 
                    $core_class->_removesigns($_POST["alias"]), 
                    $myprocess->txt_htmlspecialchars($_POST["html_description"]), 
                    $myprocess->txt_htmlspecialchars($_POST["html_content"]),                     
                    $core_class->_formatdate($_POST["date_add"]), 
                    $core_class->_formatdate($_POST["date_add"]), 
                    $_POST["image_file"], 
                    $_POST["img_status"], 
                    $_POST["state"], 
                    $_POST["frontpage"]
                        
                ) <> FALSE){
                    $GLOBALS['msg'] = "Chủ đề đã được thêm thành công!";
                    $core_class->_redirect(".?com=com_content&view=news&task=add");
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
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