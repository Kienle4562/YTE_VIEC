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
									$attach_info, 
									$price, 
									$discounts, 
									$discount_type, 
									$properties_name, 
									$properties_value, 
									$description,
									$content,
									$hot_product,
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
									$manufacturer_id)
		{
			$sql = " INSERT INTO book_product(	`SPID`, 
												`product_name`,
												`alias`,
												`product_image`, 
												`attach_info`,
												`price`, 
												`discounts`,
												`discount_type`, 
												`properties_name`, 
												`properties_value`,
												`description`, 
												`content`,
												`hot_product`, 
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
												`account_id`)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$result = $this->dbObj->SqlQueryInputResult($sql, array(	$SPID, 
																		$this->txt_htmlspecialchars($product_name), 
																		$alias,
																		$product_image, 
																		$attach_info, 
																		$price, 
																		$discounts, 
																		$discount_type, 
																		$properties_name, 
																		$properties_value, 
																		$this->txt_htmlspecialchars($description),
																		$this->txt_htmlspecialchars($content),
																		$hot_product,
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
																		$account_id), $lang);
				
			if ($result != false)
			{
				return true;
			}
			else
			{
				return false;
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
        
        public function category_multi_level($parentid)
        {
            $sql = "SELECT `cat_id`, `title`, `date_add`, `enabled`, `num_view`, `ordering`, `parent_id` FROM `product_category` WHERE parent_id = ? order by `ordering`";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid));
            return $result;
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
                      `book_product`.`attach_info`,
                      `book_product`.`price`,
                      `book_product`.`discounts`,
                      `book_product`.`discount_type`,
                      `book_product`.`properties_name`,
                      `book_product`.`properties_value`,
                      `book_product`.`description`,
                      `book_product`.`content`,
                      `book_product`.`hot_product`,
                      `book_product`.`num_view`,
                      `book_product`.`status`,
                      `book_product`.`status_product`,
                      `book_product`.`date_add`,
                      `book_product`.`order_num`,
                      `book_product`.`account_id`,
                      `book_product`.`author`,
                      `book_product`.`quality`,
                        `book_product`.`shipping_costs`,
                      `book_product`.`origin`
                    FROM
                      `book_product`
                    WHERE `book_product`.`Id`= ?";
            return $this->dbObj->SqlQueryOutputResult($sql, array($id));
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
                    if ($i == 0)
                    {
                        $image_source .= $image_array[$i];
                    } 
                    else 
                    {
                        $image_source .= "|" . $image_array[$i];
                    }
                }
                
                if ($myProcess->process_addnews(    $_POST["product_code"],
                                                    $_POST["product_name"],
                                                    $core_class->_removesigns($_POST["alias"]),            
                                                    $image_source,
                                                    $_POST["attach_info"],
                                                    $_POST["product_price"] ,
                                                    $_POST["discounts"],
                                                    $_POST["discount_type"],
                                                    $properties_name,
                                                    $properties_value,
                                                    $_POST["html_description"],
                                                    "Đang cập nhật",
                                                    $_POST["hot_product"],
                                                    1,
                                                    $_POST["published"],
                                                    $_POST["cheked_product"] ,
                                                    $core_class->_formatdate($_POST["date_add"]),
                                                    $myProcess->process_getmaxid("book_product", "order_num"),
                                                    $_POST["catid"],
                                                    $_POST["author"],
                                                    $_POST["quality"],
                                                    $_POST["origin"],
                                                    $_POST["shipping_costs"],
                                                    1
                                                ) != false)
                {
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
                $core_class->_redirect(".?com=com_product&view=product&task=view&catid=".intval($_POST["catid"]));
                exit;
            }
            
            break;
        
        default:
            $core_class->_redirect(".");exit();
            break;
    }