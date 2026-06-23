<?php defined( '_VALID_MOS' ) or die( include("404.php") );

	class process 
	{
		public $dbObj;
		
		function __construct()
		{
			$this->dbObj = new classDb();
		}
		
		// ham su ly chinh sua san pham ( product )
		function process_editproduct($SPID, $product_name, $alias, $product_image,$size,$color, $attach_info, $price, $discounts, $discount_type, $properties_name, $properties_value, $description, $content, $hot_product, $new_product, $status, $status_product, $date_add, $account_id, $book_category_id, $author, $quality, $shipping_costs, $origin, $Id, $keyword, $show_comment)
		{
			$sql = "UPDATE `book_product` SET
					`book_product`.`SPID` = ?,
					`book_product`.`product_name` = ?, 
					`book_product`.`alias` = ?,
					`book_product`.`product_image` = ?, 
					 `book_product`.`size_product` = ?,
					 `book_product`.`color_product` = ?,
					`book_product`.`attach_info` = ?,
					`book_product`.`price` = ?, 
					`book_product`.`discounts` = ?,
					`book_product`.`discount_type` = ?, 
					`book_product`.`properties_name` = ?, 
					`book_product`.`properties_value` = ?,
					`book_product`.`description` = ?, 
					`book_product`.`content` = ?,
					`book_product`.`hot_product` = ?, 
					`book_product`.`new_product` = ?, 
					`book_product`.`status` = ?, 
					`book_product`.`status_product` = ?,
					`book_product`.`date_add` =? , 
					`book_product`.`account_id` = ?, 
					`book_product`.`book_category_id` = ?,
					`book_product`.`author` = ?,
					`book_product`.`quality` = ?,
					`book_product`.`shipping_costs` = ?,
					`book_product`.`origin` = ?,
                    `book_product`.`keyword` = ?,
                    `book_product`.`show_comment` = ?
					WHERE `book_product`.`Id` = ? ";
			
			$result = $this->dbObj->SqlQueryInputResult($sql, array( $SPID, $this->dbObj->fix_quotes_dquotes($product_name), $alias, $product_image,$size,$color, $attach_info, $price, $discounts, $discount_type, $properties_name, $properties_value, $this->txt_htmlspecialchars($description), $this->txt_htmlspecialchars($content), $hot_product,$new_product, $status, $status_product, $date_add, $account_id, $book_category_id, $author, $quality, $shipping_costs, $origin, $keyword, $show_comment,$Id), $lang);
			
			if ($result != false) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
        
        function process_addtab($product_id, $tab_title, $tab_content, $tab_active)
        {
            echo $product_id;
            
            $sql = "
                    INSERT INTO `book_product_tabs` (
                        `title`,
                        `content`,
                        `product_id`,
                        `status`
                    )
                    VALUES (
                        ?, ?, ?, ?
                    )
            ";
            
            $this->dbObj->SqlQueryInputResult($sql, array($this->dbObj->fix_quotes_dquotes($tab_title), $this->txt_htmlspecialchars($tab_content), $product_id, $tab_active));
        }
        
        function process_updatetab($tab_title, $tab_content, $tab_active, $tab_id)
        {
            $sql = "
                    UPDATE `book_product_tabs`
                    SET `title` = ?,
                        `content` = ?,
                        `status` = ?
                    WHERE `id` = ?";
            
            $this->dbObj->SqlQueryInputResult($sql, array($this->dbObj->fix_quotes_dquotes($tab_title), $this->txt_htmlspecialchars($tab_content), $tab_active, $tab_id));
        }
        
        function process_edittabs($tabs_title, $tabs_content, $tabs_active, $tabs_id, $product_id)
        {
            $count = count($tabs_title);

            if ($count > 0)
            {
                $sql = "
                        DELETE FROM `book_product_tabs`
                        WHERE `id` NOT IN (" . implode(',', $tabs_id) . ")
                                AND `product_id` = ?
                ";
                
                $this->dbObj->SqlQueryInputResult($sql, array($product_id));
                
                $keys = array_keys($tabs_title);
                
                for ($i = 0; $i < $count; $i++)
                {
                    if ($tabs_id[$keys[$i]] > -1)
                    {
                        $this->process_updatetab(
                                        $this->dbObj->fix_quotes_dquotes($tabs_title[$keys[$i]]),
                                        $this->txt_htmlspecialchars($tabs_content[$keys[$i]]),
                                        $tabs_active[$keys[$i]],
                                        $tabs_id[$keys[$i]]
                        );
                    }
                    else
                    {
                        $this->process_addtab(
                                        $product_id,
                                        $this->dbObj->fix_quotes_dquotes($tabs_title[$keys[$i]]),
                                        $this->txt_htmlspecialchars($tabs_content[$keys[$i]]),
                                        $tabs_active[$keys[$i]]
                        );
                    }
                }
            }
            else
            {
                $sql = "
                        DELETE FROM `book_product_tabs`
                        WHERE `product_id` = ?
                ";
                
                $this->dbObj->SqlQueryInputResult($sql, array($product_id));
            }
        }
		
		function txt_htmlspecialchars($t="")
		{
			// Use forward look up to only convert & not &#123;
			//$t = str_replace( "<", "&lt;"  , $t );
			//$t = str_replace( ">", "&gt;"  , $t );
			$t = str_replace( "\\", ""  , $t );
			//$t = str_replace( '"', "", $t );
			
			return $t; // A nice cup of?
		}
		
		function getProduct($id)
		{
			$sql = "SELECT
                      `book_product`.`book_category_id`,
                      `book_product`.`Id` AS `book_product_id`,
					  `book_product`.`SPID`,
                      `book_product`.`product_name`,
                      `book_product`.`alias`,
					  `book_product`.`product_image`,
					   `book_product`.`size_product`,
					   `book_product`.`color_product`,
                      `book_product`.`attach_info`,
					  `book_product`.`price`,
                      `book_product`.`discounts`,
					  `book_product`.`discount_type`,
                      `book_product`.`properties_name`,
                      `book_product`.`properties_value`,
					  `book_product`.`description`,
                      `book_product`.`content`,
					  `book_product`.`hot_product`,
					  `book_product`.`new_product`,
                      `book_product`.`num_view`,
					  `book_product`.`status`,
                      `book_product`.`status_product`,
					  `book_product`.`date_add`,
                      `book_product`.`order_num`,
					  `book_product`.`account_id`,
                      `book_product`.`author`,
                      `book_product`.`quality`,
  					  `book_product`.`shipping_costs`,
                      `book_product`.`origin`,
                      `book_product`.`keyword`,
                      `book_product`.`show_comment`,
                      `book_product`.`lang_code`
					FROM
					  `book_product`
					WHERE `book_product`.`Id`= ?";
			return $this->dbObj->SqlQueryOutputResult($sql, array($id));
		}
        
        public function get_tabs($product_id)
        {
            $sql = "
                    SELECT `id`,`title`,`content`,`product_id`,`status`
                    FROM `book_product_tabs`
                    WHERE `product_id` = ?";
            
            return $this->dbObj->SqlQueryOutputResult($sql, array($product_id));
        }
        
        public function category_multi_level($parentid, $lang_code)
        {
            $sql = "SELECT
                        `product_category`.`cat_id`,
                        `product_category`.`title`,
                        `product_category`.`date_add`,
                        `product_category`.`enabled`,
                        `product_category`.`ordering`,
                        `product_category`.`num_view`
                    FROM
                        `product_category`
                    WHERE
                        `parent_id` = ?
                        AND `lang_code` = ?
                    ORDER BY
                    	`ordering`";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
            return $result;
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
        
        case "submit_com_product_edit":
            
            $myProcess = new process();
            
            if($_POST["task"] == "save" || $_POST["task"] == "apply")
            {
                $properties_name_array = $_POST["properties_name"];
                $properties_value_array = $_POST["properties_value"];
                
                for ($i=0; $i < count($properties_name_array); $i++)
                {
                    $properties_name .= "|" . $properties_name_array[$i];
                    $properties_value .= "|" . $properties_value_array[$i];
                }
                
                $image_array = $_POST["image_file"];
                for ($i=0; $i < count($image_array); $i++)
                {
                    if($i == 0)
                    {
                        $image_source .= $image_array[$i];
                    }
                    else
                    {
                        $image_source .= "|" . $image_array[$i];
                    }
                }

                if ($myProcess->process_editproduct(    $_POST["product_code"],//$SPID
                                                        $myProcess->txt_htmlspecialchars($_POST["product_name"]),//$product_name
                                                        $core_class->_removesigns($_POST["alias"]),//$alias
                                                        $image_source,//$product_image
														$_POST["size"],
														$_POST["color"],
                                                        $_POST["attach_info"],//$attach_info
                                                        $_POST["product_price"],//$price
                                                        $_POST["discounts"],//$discounts
                                                        $_POST["discount_type"],//$discount_type
                                                        $properties_name,//$properties_name
                                                        $properties_value,//$properties_value
                                                        $_POST["html_description"],//$description
                                                        $_POST["html_content"],//$content
                                                        $_POST["hot_product"],//$hot_product
														$_POST["new_product"],
                                                        $_POST["published"],//$status
                                                        $_POST["cheked_product"],//$status_product
                                                        $core_class->_formatdate($_POST["date_add"]),//$date_add
                                                        1,//$account_id
                                                        $_POST["catid"],//$book_category_id
                                                        $_POST["author"],//$author
                                                        $_POST["quality"],//$quality
                                                        $_POST["shipping_costs"],//$shipping_costs
                                                        $_POST["origin"],//$origin
                                                        $_POST["product_id"],//$Id
                                                        $_POST["keyword"],//$keyword
                                                        $_POST["show_comment"]//$show_comment
                                                        ) <> FALSE)
                {
                    $myProcess->process_edittabs($_POST['html_tab_title'], $_POST['html_tabs'], $_POST['html_tab_active'], $_POST['html_tab_id'], $_POST["product_id"]);
                    
                    $_SESSION['msg'] = "Chỉnh sửa sản phẩm thành công!";
                    
                    if ($_POST["task"] == "apply")
                    {
                        $core_class->_redirect(".?com=com_product&view=product&task=edit&id=" . intval($_POST["product_id"]));
                    }
                    else
                    {
                        $core_class->_redirect(".?com=com_product&view=product&task=view&catid=" . intval($_POST["catid"]));
                    }
                    
                    exit();
                }
                else
                {
                    $_SESSION['msg'] = "Đã xảy ra lỗi trong quá trình chỉnh sửa sản phẩm!";
                }
            }
            else if ($_POST["task"] == "cancel")
            {
                $core_class->_redirect(".?com=com_product&view=product&task=view&catid=" . intval($_POST["catid"]));
            }

            break;
        
        default:
            $core_class->_redirect(".");
            exit();
            break;
    }