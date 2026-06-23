<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process extends com_product_category
    {
	    // ham su ly them mot mau tin cua danh sach ( category )
	    function process_addcategories($parent_id, $catname, $alias, $description, $image, $date_add, $date_modify, $ordering, $enabled){
		    $sql = "INSERT INTO product_category (`parent_id`, `title`, `alias`, `description`, `image`, `date_add`, `date_modify`, `ordering`, `enabled`) 
				    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
		    $max_catid = $this->dbObj->last_insert_id($sql, array($parent_id, $this->dbObj->fix_quotes_dquotes($catname), $alias, $description, $image, $date_add, $date_modify, $ordering, $enabled));
		    if($max_catid > 0){
			    return $max_catid;
		    } else {
			    return -1;
		    }
	    }
		
		function process_addproduct($SPID, $product_name, $alias, $product_image, $attach_info, $price, $discounts, $discount_type, 
									$properties_name, $properties_value, $description, $content, $hot_product, $num_view, $status,
									$status_product,$date_add,$order_num,$book_category_id,$book_author_id,$quality,$shipping_costs,
									$origin,$account_id,$keyword,$show_comment)
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
												`account_id`,
                                                `keyword`,
                                                `show_comment`)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$max_proid = $this->dbObj->last_insert_id($sql, array(	$SPID, 
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
                                                                        $keyword,
                                                                        $show_comment), $lang);
				
			if($max_proid > 0){
			    return $max_proid;
		    } else {
			    return -1;
		    }
		}
        
        function process_addtabs($product_id, $tabs_title, $tabs_content, $tabs_active)
        {            
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

			$this->dbObj->SqlQueryInputResult($sql, array(
									$this->dbObj->fix_quotes_dquotes($tabs_title),
									$this->txt_htmlspecialchars($tabs_content),
									$product_id,
									$tabs_active)
			);
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
		
		function txt_htmlspecialchars($t="")
		{
			// Use forward look up to only convert & not &#123;
			// $t = str_replace( "<", "&lt;"  , $t );
			// $t = str_replace( ">", "&gt;"  , $t );
			$t = str_replace( "\\", ""  , $t );
			//$t = str_replace( '"', "", $t );
			
			return $t; // A nice cup of?
		}
	    
	    public function get_category_view($parentid, $lang_code)
	    {
		    $sql = "SELECT
				      `product_category`.`cat_id`, `product_category`.`title`, `product_category`.`date_add`, `product_category`.`enabled`, `product_category`.`ordering`, `product_category`.`num_view`
				    FROM `product_category`
				    WHERE parent_id = ? and `lang_code` = ?
				    ORDER BY `ordering`;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));
		    return $result;
	    }
		
		// ham go bo dau cua 1 chuoi
        function _removesigns($text, $remove_space = true)
        {
            //global $ibforums;<BR>//Charachters must be in ASCII and certain ones aint allowed
            $text = html_entity_decode ($text);
            $text = preg_replace('/(ä|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $text);
            $text = str_replace('ç','c',$text);
            $text = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $text);
            $text = preg_replace('/(ì|í|î|ị|ỉ|ĩ)/', 'i', $text);
            $text = preg_replace('/(ö|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $text);
            $text = preg_replace('/(ü|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $text);
            $text = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $text);
            $text = preg_replace('/(đ)/', 'd', $text);
            //CHU HOA
            $text = preg_replace('/(Ä|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/', 'A', $text);
            $text = str_replace('Ç','C',$text);
            $text = preg_replace('/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/', 'E', $text);
            $text = preg_replace('/(Ì|Í|Ị|Ỉ|Ĩ)/', 'I', $text);
            $text = preg_replace('/(Ö|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/', 'O', $text);
            $text = preg_replace('/(Ü|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/', 'U', $text);
            $text = preg_replace('/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/', 'Y', $text);
            $text = preg_replace('/(Đ)/', 'D', $text);
            //Special string
            /*
            $text = preg_replace('/( |!|”|#|$|%|’)/', ', $text);
            $text = preg_replace('/(̀|́|̉|$|&gt;)/', ', $text);
            $text = preg_replace (''&lt;[\/\!]*?[^&lt;&gt;]*?&gt;'si', '', $text);
            */

            $text = str_replace(' / ','-',$text);
            $text = str_replace('/','-',$text);
            $text = str_replace(' - ','-',$text);
            $text = str_replace('_','-',$text);
            
            if ($remove_space) {
            	$text = str_replace(' ','-',$text);
			}
            
            $text = str_replace( 'ß', 'ss', $text);
            $text = str_replace( '&amp;', '', $text);
            $text = str_replace( '%', '', $text);
            //$text = ereg_replace('[^A-Za-z0-9-]', '', $text);

            /*$text = str_replace('—-','-',$text);
            $text = str_replace('—','-',$text);
            $text = str_replace('–','-',$text);*/
            return strtolower($text);
        }
		
		function categoryValue($link, $parent, $categoryTitle){
			
			$web_root = "http://www.tonynail.net";
			
			$core_class = new core_class();
			$process = new process();

			$html = file_get_contents($link);
			//Parse it. Here we use loadHTML as a static method
			//to parse the HTML and create the DOM object in one go.
			@$dom = DOMDocument::loadHTML($html);
			 
			//Init the XPath object
			$xpath = new DOMXpath($dom);
			
			// EN
			$contentSection_title = $xpath->query('//td[contains(@class, "imgCat")]/a');
			
			if($contentSection_title->length > 0){
				// insert category				
				foreach ($contentSection_title as $contentSection_title) {
				
					//$values["catgoryTitle"] = $contentSection_title->nodeValue
					
					$catgoryTitle = $contentSection_title->getAttribute("title");
					echo "catgoryTitle: " . $catgoryTitle . "<br><br>";
					
					$catgoryLink = $contentSection_title->getAttribute("href");
					echo "catgoryLink: " . $catgoryLink . "<br><br>";
	
					$tmp_html = new DOMDocument();
					$tmp_html->appendChild($tmp_html->importNode($contentSection_title,true));
					
					//echo  $tmp_html->saveHTML() . "<br>";
					
					@$dom = DOMDocument::loadHTML($tmp_html->saveHTML());
					
					$xpath1 = new DOMXpath(@$dom);
					
					$categoryImage = $xpath1->query('//a/img')->item(0);
					
					$img_src = $categoryImage->getAttribute("src");
					echo "categoryImage: " . $img_src . "<br><br>";

					if (is_object($categoryImage)){
	
						$img_src = $categoryImage->getAttribute("src");
						echo "categoryImage: " . $img_src . "<br><br>";
						
						$img_array = explode("/", $img_src);
					
						// file name
						$img_file = process::_removesigns($img_array[count($img_array) - 1]);
						// folder EN
						$img_folder = "product/en_AU/category/" . process::_removesigns($categoryTitle);
						
						// create folder
						if (!file_exists("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder)) {
							mkdir("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder, 0777, true);
						}
						
						// copy image from url
						copy($web_root . $img_src, "E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder."/".$img_file);
						
					}
					
					$title          = 	$catgoryTitle;
					$alias          = 	process::_removesigns( $catgoryTitle );
					
					$image			=   "/files/images/" . $img_folder."/".$img_file;
					
					$description 	= 	$catgoryTitle;
					$date_add      	= 	$core_class->_formatdate(time());
					$ordering      	= 	process::process_getmaxid("category", "ordering");
					$enabled      	= 	1;
					
					$max_catid = process::process_addcategories( $parent, $title, $alias, $description, $image, $date_add, $date_add, $ordering, $enabled );
					if ($max_catid > 0)
					{
						process::reset_left_right_value();
					}
					
					process::categoryValue($web_root . $catgoryLink, $max_catid, $categoryTitle);
				}
				
			} else {
				// insert product detail
				$web_root = "http://www.tonynail.net";
				
				$core_class = new core_class();
				$process = new process();
				
				$html = file_get_contents($link);
				//Parse it. Here we use loadHTML as a static method
				//to parse the HTML and create the DOM object in one go.
				@$dom = DOMDocument::loadHTML($html);
				 
				//Init the XPath object
				$xpath = new DOMXpath($dom);
				
				// EN
				$contentSection_title = $xpath->query('//td[contains(@class, "img")]/a');
				
				if($contentSection_title->length > 0){
					
					foreach ($contentSection_title as $contentSection_title) {
											
						$productLink = $contentSection_title->getAttribute("href");
						echo "Chi tiết sản phẩm: " . $web_root . $productLink . "<br><br>";
						process::productValue($web_root . $productLink, $categoryTitle);
						
						$values = process::productValue($web_root . $productLink, $categoryTitle);
				
						echo "product_title: " . $values["product_title"] . "<br><br><br>";
						echo "Product code: " . $values["itemCode"] . "<br><br><br>";
						echo "Sku Code: " . $values["skuCode"] . "<br><br><br>";
						echo "Weight: " . $values["Weight"] . "<br><br><br>";				
						echo "Description: " . $values["Description"] . "<br><br><br>";
						echo "Price: " . preg_replace("/[^0-9\s]/", "", $values["Price"]) . "<br><br><br>";
						echo "img_file: " . $values["img_file"] . "<br><br><br>";								
						
						$SPID 		  = $values["itemCode"];
						$product_name = $values["product_title"];
						$alias 		  = $core_class->_removesigns($values["product_title"]);
						$product_image= $values["img_file"];
						$attach_info  = $values["Weight"];
						$price		  = preg_replace("/[^0-9\s]/", "", $values["Price"]);
						$discounts    = 0;
						$discount_type= 1;
						$properties_name	= "||";
						$properties_value	= "||";
						$description  = process::txt_htmlspecialchars($values["Description"]);
						$content	  = process::txt_htmlspecialchars($values["Description"]);
						$hot_product  = 0;
						$num_view	  = 1;
						$status		  = 1;
						$status_product = 1;
						$date_add		= $core_class->_formatdate(time());
						$order_num		= process::process_getmaxid("book_product", "order_num");
						$book_category_id = $parent;
						$book_author_id	  = $values["skuCode"];
						$quality 		 = "updating";
						$shipping_costs	 = "";
						$origin			 = "";
						$account_id		 = 1;
						$keyword		 = $values["product_title"];
						$show_comment	 = 1;
		
						$max_proid = process::process_addproduct(
							$SPID, 
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
							$origin,$account_id,
							$keyword,
							$show_comment);
						
						if ($max_proid > 0){						
								
							echo "insert " . $values["product_title"] . "success ------------------------";
		
						}
						
						
					}
					
				}
				
			}
		}
		
		function productValue($link, $categoryTitle){
				
			$web_root = "http://www.tonynail.net";
			$values = array();
			
			$html = file_get_contents($link);

			//Parse it. Here we use loadHTML as a static method
			//to parse the HTML and create the DOM object in one go.
			@$dom = DOMDocument::loadHTML($html);
			 
			//Init the XPath object
			$xpath = new DOMXpath($dom);
			
			$product_title = $xpath->query('//div[@id="divInfo"]/h2/b')->item(0);
			$product_title = $product_title ->textContent;
			$values["product_title"] = $product_title;
			
			$Price = $xpath->query('//div[@class="div_price"]/span')->item(0);
			$Price  = $Price  ->textContent;
			$values["Price"] = $Price ;				
			if(trim($Price ) == ""){ $values["Price "] = "0"; }
			
			$itemCode = $xpath->query('//div[@class="boxInfo"]/table/tr/td')->item(2);
			$itemCode = $itemCode ->textContent;
			$values["itemCode"] = $itemCode;				
			if(trim($itemCode) == ""){ $values["itemCode"] = "null"; }
			
			$skuCode = $xpath->query('//div[@class="boxInfo"]/table/tr/td')->item(5);
			$skuCode = $skuCode ->textContent;
			$values["skuCode"] = $skuCode;
			if(trim($skuCode) == ""){ $values["skuCode"] = "no value"; }
			
			$Weight = $xpath->query('//div[@class="boxInfo"]/table/tr/td')->item(11);
			$Weight = $Weight ->textContent;
			$values["Weight"] = $Weight;
			if(trim($Weight) == ""){ $values["Weight"] = "no value"; }
			
			$Description = $xpath->query('//div[@class="desc"]')->item(0);
			
			$tmp_html = new DOMDocument();
			$tmp_html->appendChild($tmp_html->importNode($Description, true));				
			$Description = $tmp_html->saveHTML();
			$values["Description"] = $Description;
			if(trim($Description) == ""){ $values["Description"] = "no value"; }
			
			$productImage = $xpath->query('//a[@class="pic"]/img')->item(0);			
			
			if (is_object($productImage)){
				$img_src = $productImage->getAttribute("src");
				
				$img_array = explode("/", $img_src);
			
				// file name
				$img_file = process::_removesigns($img_array[count($img_array) - 1]);
				// folder EN
				$img_folder = "product/en_AU/" . process::_removesigns($categoryTitle);
					
				$values["img_file"] = "/files/images/" . $img_folder."/".$img_file;

				// create folder
				if (!file_exists("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder)) {
					mkdir("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder, 0777, true);
				}
				
				// copy image from url
				copy($web_root . $img_src, "E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder."/".$img_file);
			}	

			return $values;
						
		}
		
		function innerHTML($node){
			$doc = new DOMDocument();
			foreach ($node->childNodes as $child)
			$doc->appendChild($doc->importNode($child, true));
			
			return $doc->saveHTML();
		}
		
		function strip_selected_tags($text, $tags = array())
		{		
			$args = func_get_args();
			$text = array_shift($args);
			$tags = func_num_args() > 2 ? array_diff($args,array($text))  : (array)$tags;
			foreach ($tags as $tag){
				$text = preg_replace('/(<'.$tag.'[^>]*?>.+?)+(<\/'.$tag.'>)/i', '', $text);	
			}
			return $text;
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
        
        case "submit_com_product_category_add";
			
			$myprocess = new process();
            

            if ($_POST["task"] == "save")
            {
				ini_set('max_execution_time', 999999); //300 seconds = 5 minutes
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/acrylic-liquid-87.html", 0);
				$core_class = new core_class();
				$process = new process();
				
				$html = file_get_contents('http://www.tonynail.net/en/main.html');
				//Parse it. Here we use loadHTML as a static method
				//to parse the HTML and create the DOM object in one go.
				@$dom = DOMDocument::loadHTML($html);
				 
				//Init the XPath object
				$xpath = new DOMXpath($dom);
				
				// EN
				$contentSection_title = $xpath->query('//li[contains(@class, "menu")]/a');
					
				$web_root = "http://www.tonynail.net";
				
				foreach ($contentSection_title as $contentSection_title) {
					echo $contentSection_title->nodeValue . "<br><br></strong>";
					echo $web_root . $contentSection_title->getAttribute("href") . "<br><br></strong>";									
					
					$title          = 	substr($contentSection_title->nodeValue, 5);
					$alias          = 	$process->_removesigns( $contentSection_title->nodeValue );
					
					$image			=   "Chọn file hình ảnh cần thêm .. ";
					
					$description 	= 	$contentSection_title->nodeValue;
					$date_add      	= 	$core_class->_formatdate(time());
					$ordering      	= 	$process->process_getmaxid("category", "ordering");
					$enabled      	= 	1;
					
					$max_catid = $process->process_addcategories( 0, $title, $alias, $description, $image, $date_add, $date_add, $ordering, $enabled );
					if ($max_catid > 0)
					{
						$process->reset_left_right_value();
					}
					//$myprocess->categoryValue($web_root . $contentSection_title->getAttribute("href"), $max_catid, $title);
					
				}								
				
            }
            else if ($_POST["task"] == "apply")
            {	
				ini_set('max_execution_time', 999999); //300 seconds = 5 minutes
				/*
				$myprocess->categoryValue("http://www.tonynail.net/en/product/nail-polish-97.html", 24, "Nail Polish");				
				Warning: file_get_contents(http://www.tonynail.net/en/product/detail/ch-nail-lacquer--49-9354.html)
				*/
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/nail-tip-95.html", 25, "Nail Tip");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/nail-treatments-355.html", 26, "Nail Treatments");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/paraffin-99.html", 27, "Paraffin");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/salon-funiture-333.html", 29, "Salon Funiture");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/silk-wrap---fiberglass-86.html", 30, " Silk Wrap & Fiberglass");
				
				/*
				Warning: file_get_contents(http://www.tonynail.net/en/product/detail/neon-sign---open--10002-4000.html)
				*/
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/sign-634.html", 31, "Sign");
				
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/skin-care-54.html", 32, "Skin Care");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/spa-chair-100.html", 33, "Spa Chair");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/tattoo-83.html", 34, "Tattoo");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/top-coat---base-coat-98.html", 35, "Top Coat & Base Coat");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/uniform-153.html", 36, "Uniform");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/uv-product-84.html", 37, "UV Product");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/waxing-59.html", 38, "Waxing");
				/*
					Warning: file_get_contents(http://www.tonynail.net/en/product/detail/-iphone-4g-phone-case-s--s21-8335.html)
				*/
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/gift-shop-325.html", 39, "Gift Shop");
				
				//$myprocess->categoryValue("http://www.tonynail.net/en/product/natural-herbs-558.html", 40, "Natural Herbs");
				
				$myprocess->categoryValue("http://www.tonynail.net/en/product/on-sale-326.html", 41, "On Sale");
				/*
				$myprocess->categoryValue("http://www.tonynail.net/en/product/new-arrivals-327.html", 42, "New Arrivals");
				
				$myprocess->categoryValue("http://www.tonynail.net/en/product/best-seller-328.html", 43, "Best Seller");
				
				$myprocess->categoryValue("http://www.tonynail.net/en/product/clearance-948.html", 44, "Clearance");
				
				
				*/
				/*
				$link = "http://www.tonynail.net/en/product/detail/marcel-germaine-upholstery-cleaner--amp;-conditioner-15oz-3235.html";
				
				$values = $myprocess->productValue($link, "testFolder");
				
				echo "product_title: " . $values["product_title"] . "<br><br><br>";
				echo "Product code: " . $values["itemCode"] . "<br><br><br>";
				echo "Sku Code: " . $values["skuCode"] . "<br><br><br>";
				echo "Weight: " . $values["Weight"] . "<br><br><br>";				
				echo "Description: " . $values["Description"] . "<br><br><br>";
				echo "Price: " . preg_replace("/[^0-9\s]/", "", $values["Price"]) . "<br><br><br>";
				echo "img_file: " . $values["img_file"] . "<br><br><br>";								
				
				$SPID 		  = $values["itemCode"];
				$product_name = $values["product_title"];
				$alias 		  = $core_class->_removesigns($values["product_title"]);
				$product_image= $values["img_file"];
				$attach_info  = "";
				$price		  = preg_replace("/[^0-9\s]/", "", $values["Price"]);
				$discounts    = 0;
				$discount_type= 1;
				$properties_name	= "||";
				$properties_value	= "||";
				$description  = $myprocess->txt_htmlspecialchars($values["Description"]);
				$content	  = $myprocess->txt_htmlspecialchars($values["Description"]);
				$hot_product  = 0;
				$num_view	  = 1;
				$status		  = 1;
				$status_product = 1;
				$date_add		= $core_class->_formatdate(time());
				$order_num		= $myprocess->process_getmaxid("book_product", "order_num");
				$book_category_id = $max_catid2;
				$book_author_id	  = 0;
				$quality 		 = "updating";
				$shipping_costs	 = "";
				$origin			 = "";
				$account_id		 = 1;
				$keyword		 = $values["product_title"];
				$show_comment	 = 1;

				$max_proid = $myprocess->process_addproduct(
					$SPID, 
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
					$origin,$account_id,
					$keyword,
					$show_comment);
				
				if ($max_proid > 0){						
						
					echo "insert success ------------------------";

				}
				*/
            }
            else if($_POST["task"] == "cancel")
            {
                $core_class->_redirect(".?com=com_product&view=category&task=view");
                exit;
            }

        break;
        
        default:
            $core_class->_redirect(".");
            exit();
        break;
    }