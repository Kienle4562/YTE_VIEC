<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process
    {

	    public $dbObj;
	    
	    function __construct()
	    {
		     $this->dbObj = new classDb();
	    }
	    
	    //Lấy loại menu
	    function process_getMenuType_Add_Article($Id){
		    $sql = "SELECT `menu_type`.`Id`, `menu_type`.`title` FROM `menu_type` WHERE `menu_type`.`Id` = ?;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($Id));
		    return $result;
	    }
	    
	    function list_menu ($parentid = 0, $menutypeid) {
		    $sql = "SELECT `Id`, CONCAT(`link` , `link_id`) as `link`, `title`, `type`, `target` 
				    FROM `menu` 
				    WHERE parent_Id = ? 
				    AND `menu_type_Id` = ?
				    ORDER BY order_num;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $menutypeid));
		    return $result;
	    }
	    
	    function get_category_view($parentid, $lang_code)
	    {
		    $sql = "SELECT
				      `category`.`cat_id`, `category`.`alias`, `category`.`title`, `category`.`date_add`, `category`.`enabled`, `category`.`ordering`, `category`.`num_view`
				    FROM `category`
				    WHERE parent_id = ? AND `lang_code` = ?";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
		    return $result;
	    }
        
        function get_product_category_view($parentid, $lang_code)
        {
            $sql = "
                    SELECT
                            `product_category`.`cat_id`,
                            `product_category`.`alias`,
                            `product_category`.`title`,
                            `product_category`.`date_add`,
                            `product_category`.`enabled`,
                            `product_category`.`ordering`,
                            `product_category`.`num_view`
                    FROM
                            `product_category`
                    WHERE
                            `parent_id` = ? AND `lang_code` = ?
                    ORDER BY
                    		`ordering`, `cat_id`
            ";

            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
            return $result;
        }
	    
	    function category_parent_tree($catid = 0, $trees = NULL){
		    $myprocess = new process();												
		    $result = $myprocess->get_category_parent_tree($catid);
		    if(!$trees) $trees = array();
		    while($row = $result->fetch()){
			    $trees = process::category_parent_tree($row["parent_id"], $trees);
			    $trees[] = array('id'=>$row["cat_id"], 'title'=>$row["alias"]);
		    }				
		    return $trees;
	    }			
	    
	    function get_category_parent_tree($catid)
	    {
		    $sql = "SELECT `category`.`cat_id`, `category`.`alias`, `category`.`parent_id`, `category`.`title`
				    FROM `category`
				    WHERE cat_id = ?";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($catid));
		    return $result;
	    }
        
        function product_category_parent_tree($catid = 0, $trees = NULL){
            $myprocess = new process();                                                
            $result = $myprocess->product_get_category_parent_tree($catid);
            if(!$trees) $trees = array();
            while($row = $result->fetch()){
                $trees = process::product_category_parent_tree($row["parent_id"], $trees);
                $trees[] = array('id'=>$row["cat_id"], 'title'=>$row["alias"]);
            }                
            return $trees;
        }            
        
        function product_get_category_parent_tree($catid)
        {
            $sql = "SELECT `product_category`.`cat_id`, `product_category`.`alias`, `product_category`.`parent_id`, `product_category`.`title`
                    FROM `product_category`
                    WHERE cat_id = ?";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($catid));
            return $result;
        }
	    
	    function process_add_item_menu( $root, $parent_Id, $title, $link, $link_id, $type, $target, $activated, $order_num, $menu_type_Id ){
		    $sql = "INSERT into menu (`root`, `parent_Id`, `title`, `link`, `link_id`, `type`, `target`, `activated`, `order_num`, `menu_type_Id`)
				    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		    $result = $this->dbObj->SqlQueryInputResult($sql, array($root, $parent_Id, $title, $link, $link_id, $type, $target, $activated, $order_num, $menu_type_Id));
		    if($result > 0){
			    return true;
		    }
		    else return false;
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
	    
	    public function get_main_menu_edit($menu_type_id)
	    {
		    $sql = "SELECT `Id`, `lang_code`, `title`, `alias`, `isroot`, `activated` FROM `menu_type` WHERE `Id` = ?";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($menu_type_id));
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
        
        /* khoi su ly su kien them item menu moi */
        case "submit_com_menu_item_menu_add";
            $myprocess = new process;
            
            $root = "1";
            $menu_item     = $_POST["parent"];
            $title         = $_POST["title"];                
            $link_key	   = $_POST['icon'];
                    
            if($_POST["rdotype"] == "rdoNewsCategories"){
            
                // $link_key     = "news/";
                $link_url     = $_POST["select_news_category_page"];
                $menu_type     = "news-category";								
                
            } else if($_POST["rdotype"] == "rdoNewsArticle"){
            
                // $link_key     = "news/";
                /*
                $category = process::category_parent_tree(intval($_POST["select_news_article_page"]));
        
                foreach($category as $k=>$rs) { 
                    $link_url .= $rs['title'] . "/";
                }
                
                $link_url .= $_POST["news_alias"];
                */
				
				$link_url = $_POST["news_alias"];
                $menu_type     = "news-article";
                
            } else if($_POST["rdotype"] == "rdoProductCategories"){
            
                // $link_key     = "product/";
                $link_url     = $_POST["select_product_category_page"];
                $menu_type     = "product-category";
                
            }
			else if($_POST["rdotype"] == "rdoProductCategories2"){
            
                // $link_key     = "product/";
                $link_url     = $_POST["select_product_category_page_2"];
                $menu_type     = "product-category";
                
            }
			 else if($_POST["rdotype"] == "rdoProductDetail") {
                
                // $link_key     = "product/";
                
                $category = process::product_category_parent_tree(intval($_POST["select_product_page"]));
        
                foreach ($category as $k => $rs) { 
                    $link_url .= $rs['title'] . "/";
                }
                
                $link_url     .= $_POST["product_alias"];
                
                $menu_type     = "product-detail";
                
            } else if($_POST["rdotype"] == "rdoExternal"){
                // $link_key     = "";
                $link_url     = $_POST["txt_url"];
                $menu_type     = "linkout";
            } else if($_POST["rdotype"] == "rdoNull"){
                // $link_key     = "";
                $link_url     = "javascript:void(0)";
                $menu_type     = "null";
            } else if($_POST["rdotype"] == "rdoCart"){
                // $link_key     = "cart/";
                $link_url     = "gio-hang";
                $menu_type     = "cart";
            } else if($_POST["rdotype"] == "rdoContact"){
                // $link_key     = "contact/";
                $link_url     = "lien-he";
                $menu_type     = "contact";
            }
                
            $target     = $_POST["browserNav"];
            $enabled     = $_POST["published"];
            $order_num  = $myprocess->process_getmaxid("menu", "order_num");
            $group_menu = $_POST["menutype"];

            if($_POST["task"] == "save"){
                if($myprocess->process_add_item_menu(
                
                    $root, 
                    $menu_item, 
                    $title, 
                    $link_key, 
                    $link_url, 
                    $menu_type, 
                    $target, 
                    $enabled, 
                    $order_num, 
                    $group_menu
                    
                ) <> FALSE){
                    $core_class->_redirect(".?com=com_menu&view=item_menu&task=view&menutypeid=".$_POST["menutype"]);
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            } else if ($_POST["task"] == "apply"){
                if($myprocess->process_add_item_menu(
                
                    $root, 
                    $menu_item, 
                    $title, 
                    $link_key, 
                    $link_url, 
                    $menu_type, 
                    $target, 
                    $enabled, 
                    $order_num, 
                    $group_menu
                    
                ) <> FALSE){
                    $GLOBALS['msg'] = "Chủ đề đã được thêm thành công!";
                    $core_class->_redirect(".?com=com_menu&view=item_menu&task=news.add&menutypeid=".$_POST["menutype"]);
                    exit();
                } else {
                    $GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
                }
            } else if($_POST["task"] == "cancel"){
                $core_class->_redirect(".?com=com_menu&view=item_menu&task=view&menutypeid=".$_POST["menutype"]);
                exit;
            }

        break;
        
        default:
            $core_class->_redirect(".");exit();
        break;
    }