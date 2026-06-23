<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	
	class process
	{
	
		public $dbObj;
		
		function __construct()
		{
			$this->dbObj = new classDb();
		}

		function txt_htmlspecialchars($t="")
		{
			// Use forward look up to only convert & not &#123;
			// $t = str_replace( "<", "&lt;"  , $t );
			// $t = str_replace( ">", "&gt;"  , $t );
			$t = str_replace( "\\", ""  , $t );
			//$t = str_replace( '"', "", $t );
			
			return $t; // A nice cup of?
		}

		/* Them san pham */
		function process_addnews(	$SPID, 
									$product_name,
									$alias,
									$product_image,
									$product_size,
									$product_color, 
									$attach_info, 
									$price, 
									$discounts, 
									$discount_type, 
									$properties_name, 
									$properties_value, 
									$description,
									$content,
									$hot_product,
									$new_product,
									$num_view,
									$status,
									$status_product,
									$date_add,
									$order_num,
									$book_category_id,
									$book_author_id,
									$quality,
									$shipping_costs,
									$origin,
									$account_id,
									$manufacturer_id,
                                    $keyword,
                                    $show_comment)
		{
			$sql = " INSERT INTO book_product(	`SPID`, 
												`product_name`,
												`alias`,
												`product_image`,
												`size_product`,
												`color_product`, 
												`attach_info`,
												`price`, 
												`discounts`,
												`discount_type`, 
												`properties_name`, 
												`properties_value`,
												`description`, 
												`content`,
												`hot_product`,
												 `new_product`,
												`num_view`,
												`status`, 
												`status_product`,
												`date_add`, 
												`order_num`,
												`book_category_id`, 
												`author`,
												`quality`,
												`shipping_costs`,
												`origin`,
												`account_id`,
                                                `keyword`,
                                                `show_comment`)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)";

			$result = $this->dbObj->SqlQueryInputResult($sql, array(	$SPID, 
																		$this->dbObj->fix_quotes_dquotes($product_name), 
																		$alias,
																		$product_image,
																		$product_size,
																		$product_color,  
																		$attach_info, 
																		$price, 
																		$discounts, 
																		$discount_type, 
																		$properties_name, 
																		$properties_value,
																		$this->txt_htmlspecialchars($description),
																		$this->txt_htmlspecialchars($content),
																		$hot_product,
																		$new_product,
																		$num_view,
																		$status,
																		$status_product,
																		$date_add,
																		$this->process_getmaxid("book_product", "order_num"),
																		$book_category_id,
																		$book_author_id,
																		$quality,
																		$shipping_costs,
																		$origin,
																		$account_id,
                                                                        $keyword,
                                                                        $show_comment), $lang);
				
			if ($result != false)
			{
				return true;
			}
			else
			{
				return false;
			}		
		}
        
        function process_addtabs($product_id, $tabs_title, $tabs_content, $tabs_active)
        {
            $tabs_count = count($tabs_title);
            
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
            
            for ($i = 0; $i < $tabs_count; $i++)
            {
                $this->dbObj->SqlQueryInputResult($sql, array(
                                        $this->dbObj->fix_quotes_dquotes($tabs_title[$i]),
                                        $this->txt_htmlspecialchars($tabs_content[$i]),
                                        $product_id,
                                        $tabs_active[$i])
                );
            }
        }
		
		/* Lay gia tri lon nhat cua cot trong bang */
		function process_getmaxid($table, $column)
		{
			$sql = "select MAX(`$column`) + 1 As `maxID` from `$table`";		
			
			$result = $this->dbObj->SqlQueryOutputResult($sql, array(0), $lang);
			
			if ($row = $result->fetch())
			{
				if ($row["maxID"] == 0)
				{
					return 1;
				}
				else 
				{
					return $row["maxID"];
				}
			}
		}
        
        public function category_multi_level($parentid, $lang_code)
        {
            $sql = "SELECT `cat_id`, `title`, `date_add`, `enabled`, `num_view`, `ordering`, `parent_id` FROM `product_category` WHERE parent_id = ? AND `lang_code` = ? order by `ordering`";
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
        
        case "submit_com_product_add":
            
            $myProcess = new process;
            
            /* Neu chon save hoac apply */
            
            if ($_POST["task"] == "save" || $_POST["task"] == "apply")
            {
                // Thuộc tính sản phẩm
                $properties_name_array = $_POST["properties_name"];
                $properties_value_array = $_POST["properties_value"];
                
                $properties_name = "";
                $properties_value = "";

                for ($i=0; $i < count($properties_name_array); $i++)
                {
                    if (!empty($properties_name_array[$i]) && !empty($properties_value_array[$i]))
                    {
                        $properties_name .= (($i > 0) ? "|" : "") . $properties_name_array[$i];
                        $properties_value .= (($i > 0) ? "|" : "") . $properties_value_array[$i];
                    }
                }
                
                // Hình ảnh sản phẩm
                $image_array = $_POST["image_file"];
                $image_source = "";

                for ($i=0; $i < count($image_array); $i++)
                {
                    if (!empty($image_array[$i]))
                    {
                        $image_source .= (($i > 0) ? "|" : "") . $image_array[$i];
                    }
                }
                
              //var_dump($_POST);
			    if ($myProcess->process_addnews(    $_POST["product_code"],//$SPID
                                                    $_POST["product_name"],//$product_name
                                                    $core_class->_removesigns($_POST["alias"]),    //$alias
                                                    $image_source,//$product_image
													$_POST["size"],
													$_POST["color"],
                                                    $_POST["attach_info"],//$attach_info
                                                    $_POST["product_price"] ,//$price
                                                    $_POST["discounts"],//$discounts
                                                    $_POST["discount_type"],//$discount_type
                                                    $properties_name,//$properties_name
                                                    $properties_value,//$properties_value
                                                    $_POST["html_description"],//$description
                                                    $_POST["html_content"],//$content
                                                    $_POST["hot_product"],//$hot_product
													$_POST["new_product"],
                                                    1,//$num_view
                                                    $_POST["published"],//$status
                                                    $_POST["cheked_product"] ,//$status_product
                                                    $core_class->_formatdate($_POST["date_add"]),//$date_add
                                                    $myProcess->process_getmaxid("book_product", "order_num"),//$order_num
                                                    $_POST["catid"],//$book_category_id
                                                    $_POST["author"],//$book_author_id
                                                    $_POST["quality"],//$quality
                                                    $_POST["shipping_costs"],//$shipping_costs
                                                    $_POST["origin"],//$origin
                                                    $_SESSION['session']['id'],//$account_id
                                                    1,//$manufacturer_id
                                                    $_POST["keyword"],//$keyword
                                                    $_POST["show_comment"]//$show_comment
                                                ) != false)
                {
                    $new_product = $myProcess->process_getmaxid('book_product', 'Id') - 1;
                    $myProcess->process_addtabs($new_product, $_POST['html_tab_title'], $_POST['html_tabs'], $_POST['html_tab_active']);
                    
                    if ($_POST["task"] == "save")
                    {
                        $core_class->_redirect(".?com=com_product&view=product&task=view&catid=".$_POST["catid"]);
                    }
                    else
                    {
                        $core_class->_redirect(".?com=com_product&view=product&task=add");
                    }
                    
                    $_SESSION['msg'] = "Sản phẩm mới đã được thêm thành công!";
                    
                    exit();
                }
                else 
                {
                    $_SESSION['msg'] = "Đã có lỗi trong lúc thêm Sản phẩm, vui lòng làm lại!";
                }
            } 
            /* Neu chon huy bo */
            else if ($_POST["task"] == "cancel")
            {
                $core_class->_redirect(".?com=com_product&view=product&task=view&catid=" . intval($_POST["catid"]));
                exit;
            }
            
            break;
        
        default:
            $core_class->_redirect(".");
            exit();
            break;
    }