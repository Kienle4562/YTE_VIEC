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
            $text = ereg_replace('[^A-Za-z0-9-]', '', $text);

            /*$text = str_replace('—-','-',$text);
            $text = str_replace('—','-',$text);
            $text = str_replace('–','-',$text);*/
            return strtolower($text);
        }
		
		function productValue($html){
				
			$web_root = "http://berkeleybeauty.com/";
			$values = array();

			//Parse it. Here we use loadHTML as a static method
			//to parse the HTML and create the DOM object in one go.
			@$dom = DOMDocument::loadHTML($html);
			 
			//Init the XPath object
			$xpath = new DOMXpath($dom);
			
			// lay gia tri dau tien
			$title = $xpath->query('//div[@class="detailsku"]')->item(0);
			$title = $title ->textContent;		
			
			// neu gia tri dau la ko null thi chay di lay noi dung
			if($title != ""){
				
				$itemCode = $xpath->query('//div[@class="detailsku"]')->item(0);
				$itemCode = $itemCode ->textContent;
				$values["itemCode"] = $itemCode;
				if(trim($title) == ""){ $values["product_title"] = "null"; }
								
				$title = $xpath->query('//div[@class="detailname"]')->item(0);
				$title = $title ->textContent;
				$values["product_title"] = $title;
				if(trim($title) == ""){ $values["product_title"] = "no value"; }
				
				
				$productImage = $xpath->query("//img[contains(@class, 'prodimage')]")->item(1);
				
				$values["img_file"] = "Chọn file hình ảnh cần thêm .. ";
				
				if (is_object($productImage)){
					$img_src = $productImage->getAttribute("src");
					
					$img_array = explode("/", $img_src);
				
					// file name
					$img_file = $img_array[count($img_array) - 1];
					// folder VN
					//$img_folder = "product/vi_VN/" . $this->_removesigns($title) ;
					// folder EN
					$img_folder = "product/en_AU/" . $this->_removesigns($title) ;
						
					$values["img_file"] = "/files/images/" . $img_folder."/".$img_file;
					
					// create folder
					if (!file_exists("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder)) {
						mkdir("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder, 0777, true);
					}
					
					// copy image from url
					copy($web_root . $img_src, "E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder."/".$img_file);
					
				}		
				
				$nodes = $xpath->query("//div[contains(@class, 'TabbedPanelsContentGroup')]")->item(0);
				if (is_object($nodes)){
					$tmp_doc = new DOMDocument();
					$tmp_doc->appendChild($tmp_doc->importNode($nodes,true));
					// in ra product description
					$values["description"] = $tmp_doc->saveHTML();
				}
				
				return $values;
				
			}	
						
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
			
			$danhmuccha = 1;
			
			$html = file_get_contents('http://berkeleybeauty.com/categories.php?cat=1');					
			//Parse it. Here we use loadHTML as a static method
			//to parse the HTML and create the DOM object in one go.
			@$dom = DOMDocument::loadHTML($html);
			 
			//Init the XPath object
			$xpath = new DOMXpath($dom);
			
			// EN
			$contentSection_title = $xpath->query('//p[contains(@class, "catname")]/strong/a');
			// VN
			//$contentSection_title = $xpath->query('//div[contains(@class, "title section")]/h2');
			
			$i = 0;
			
			$myprocess = new process();
            
            $_SESSION['amdin']['com_product']['category']['lang_code'] = 'vi';

            if ($_POST["task"] == "save")
            {
				ini_set('max_execution_time', 2000); //300 seconds = 5 minutes
				
				$web_root = "http://berkeleybeauty.com/";
				
                foreach ($contentSection_title as $contentSection_title) {
					
					$catgoryTitle = "no value";
					$catgoryTitle = $contentSection_title->nodeValue;
					echo "<strong>--> category: ". $catgoryTitle . "<br><br></strong>";
					//echo "link: ".$contentSection_title->getAttribute("href"). "<br><br>";
					
					$categoryImage = $xpath->query("//td[contains(@class, 'catname')]/a/img")->item(0);
					//$img_src = $categoryImage->getAttribute("src");
					//echo "image: ".$img_src. "<br><br>";
					$values["img_file"] = "Chọn file hình ảnh cần thêm .. ";
					if (is_object($categoryImage)){
						$img_src = $categoryImage->getAttribute("src");
						
						$img_array = explode("/", $img_src);
					
						// file name
						$img_file = $img_array[count($img_array) - 1];
						// folder VN
						//$img_folder = "product/vi_VN/" . $this->_removesigns($title) ;
						// folder EN
						$img_folder = "product/en_AU/category/" . $myprocess->_removesigns($contentSection_title->nodeValue) ;
							
						$values["img_file"] = "/files/images/" . $img_folder."/".$img_file;
						
						// create folder
						if (!file_exists("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder)) {
							mkdir("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder, 0777, true);
						}
						
						// copy image from url
						copy($web_root . $img_src, "E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder."/".$img_file);
						
					}
					
					$parent      	= 	$danhmuccha;
					$title          = 	$catgoryTitle;
					$alias          = 	$core_class->_removesigns( $contentSection_title->nodeValue );
					
					$image			=   $img_src;
					
					$description 	= 	"LeighNailsSupply";
					$date_add      	= 	$core_class->_formatdate(time());
					$ordering      	= 	$myprocess->process_getmaxid("category", "ordering");
					$enabled      	= 	1;
					
					$max_catid = $myprocess->process_addcategories( $parent, $title, $alias, $description, $image, $date_add, $date_add, $ordering, $enabled );
					if ($max_catid > 0)
					{
						$myprocess->reset_left_right_value();
					}
					
										
					
						// lay danh muc chi tiet cap con 1
						$html1 = file_get_contents("http://berkeleybeauty.com/".$contentSection_title->getAttribute("href"));
						if($html1 === ""){
							echo "!!!!!!!!!!!!!!!!!!!!!!1 link kết bị gãy !!!!!!!!!!!!!!!!!!!!!!!111";
							continue;	
						}
						//Parse it. Here we use loadHTML as a static method
						//to parse the HTML and create the DOM object in one go.
						@$dom1 = DOMDocument::loadHTML($html1);
						 
						//Init the XPath object
						$xpath1 = new DOMXpath($dom1);
						
						// EN
						$items_code = $xpath1->query('//div[contains(@class, "prodname")]/a')->item(0);
						// kiem tra truoc neu ko phai link toi chi tiet sp
						if(trim($items_code->nodeValue) == "")
						{
							// tiep theo la danh category ko phai la sp
							echo "tiep theo la danh muc". "<br><br>";
							
							//Parse it. Here we use loadHTML as a static method
							//to parse the HTML and create the DOM object in one go.
							@$dom2 = DOMDocument::loadHTML($html1);
							 
							//Init the XPath object
							$xpath = new DOMXpath($dom2);
							
							// EN
							$category_child_titles = $xpath->query('//p[contains(@class, "catname")]/strong/a');
							// duyet qua tat ca cac danh muc
							foreach ($category_child_titles as $category_child_title) {
								
								$catgoryTitle = "no value";
								$catgoryTitle = $contentSection_title->nodeValue;
								echo "<strong>----> category: ".$catgoryTitle. "<br><br></strong>";
								
								$categoryImage = $xpath->query("//td[contains(@class, 'catname')]/a/img")->item(0);
								$img_src = $categoryImage->getAttribute("src");
								
								echo "img_src: " . $img_src . "<br><br>";
								$values["img_file"] = "Chọn file hình ảnh cần thêm .. ";
								if (is_object($categoryImage)){
									$img_src = $categoryImage->getAttribute("src");
									
									$img_array = explode("/", $img_src);
								
									// file name
									$img_file = $img_array[count($img_array) - 1];
									// folder VN
									//$img_folder = "product/vi_VN/" . $this->_removesigns($title) ;
									// folder EN
									$img_folder = "product/en_AU/category/" . $myprocess->_removesigns($contentSection_title->nodeValue) ;
										
									$values["img_file"] = "/files/images/" . $img_folder."/".$img_file;
									
									// create folder
									if (!file_exists("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder)) {
										mkdir("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder, 0777, true);
									}
									
									// copy image from url
									copy($web_root . $img_src, "E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder."/".$img_file);
									
								}

								
								$parent      	= 	$max_catid;
								$title          = 	$catgoryTitle;
								$alias          = 	$core_class->_removesigns( $category_child_title->nodeValue );
								
								$image			=   $img_src;
								
								$description 	= 	"LeighNailsSupply";
								$date_add      	= 	$core_class->_formatdate(time());
								$ordering      	= 	$myprocess->process_getmaxid("category", "ordering");
								$enabled      	= 	1;
								
								$max_catid1 = $myprocess->process_addcategories( $parent, $title, $alias, $description, $image, $date_add, $date_add, $ordering, $enabled );
								if ($max_catid > 0)
								{
									$myprocess->reset_left_right_value();
								}
								
								
									// START CATEGORY CHILD
								
									// lay danh muc chi tiet cap con 2
									$html2 = file_get_contents("http://berkeleybeauty.com/" . $category_child_title->getAttribute("href"));
									if($html2 === ""){
										echo "!!!!!!!!!!!!!!!!!!!!!!1 link kết bị gãy !!!!!!!!!!!!!!!!!!!!!!!111";
										continue;	
									}
									//Parse it. Here we use loadHTML as a static method
									//to parse the HTML and create the DOM object in one go.
									@$dom2 = DOMDocument::loadHTML($html2);
									 
									//Init the XPath object
									$xpath2 = new DOMXpath($dom2);
									
									// EN
									$items_code2 = $xpath2->query('//div[contains(@class, "prodname")]/a')->item(0);
									// kiem tra truoc neu ko phai link toi chi tiet sp
									if(trim($items_code2->nodeValue) == "")
									{
										// tiep theo la danh category ko phai la sp
										echo "tiep theo la danh muc: <br><br>";
										
										$category1_child_titles = $xpath2->query('//p[contains(@class, "catname")]/strong/a');
										
										foreach ($category1_child_titles as $category1_child_title) {
											
											$catgoryTitle = "no value";
											$catgoryTitle = $contentSection_title->nodeValue;
											echo "<strong>------> category: ".$catgoryTitle. "<br><br></strong>";
								
											$categoryImage = $xpath->query("//td[contains(@class, 'catname')]/a/img")->item(0);
											$img_src = $categoryImage->getAttribute("src");
											
											echo "img_src: " . $img_src . "<br><br>";
											$values["img_file"] = "Chọn file hình ảnh cần thêm .. ";
											if (is_object($categoryImage)){
												$img_src = $categoryImage->getAttribute("src");
												
												$img_array = explode("/", $img_src);
											
												// file name
												$img_file = $img_array[count($img_array) - 1];
												// folder VN
												//$img_folder = "product/vi_VN/" . $this->_removesigns($title) ;
												// folder EN
												$img_folder = "product/en_AU/category/" . $myprocess->_removesigns($contentSection_title->nodeValue) ;
													
												$values["img_file"] = "/files/images/" . $img_folder."/".$img_file;
												
												// create folder
												if (!file_exists("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder)) {
													mkdir("E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder, 0777, true);
												}
												
												// copy image from url
												copy($web_root . $img_src, "E:/xampp/htdocs/file_upload/cms3.leighnails/images/".$img_folder."/".$img_file);
												
											}
											
											$parent      	= 	$max_catid1;
											$title          = 	$catgoryTitle;
											$alias          = 	$core_class->_removesigns( $category1_child_title->nodeValue );
											
											$image			=   $img_src;
											
											$description 	= 	"LeighNailsSupply";
											$date_add      	= 	$core_class->_formatdate(time());
											$ordering      	= 	$myprocess->process_getmaxid("category", "ordering");
											$enabled      	= 	1;
											
											$max_catid2 = $myprocess->process_addcategories( $parent, $title, $alias, $description, $image, $date_add, $date_add, $ordering, $enabled );
											if ($max_catid > 0)
											{
												$myprocess->reset_left_right_value();
											}
											
											// sp
											//echo $category1_child_title->getAttribute("href") . "<br><br>";
											
											
											// lay danh muc chi tiet cap con 1
											$html1 = file_get_contents("http://berkeleybeauty.com/" . $category1_child_title->getAttribute("href"));
											if($html1 === ""){
												echo "!!!!!!!!!!!!!!!!!!!!!!1 link kết bị gãy !!!!!!!!!!!!!!!!!!!!!!!111";
												continue;	
											}
											//Parse it. Here we use loadHTML as a static method
											//to parse the HTML and create the DOM object in one go.
											@$dom1 = DOMDocument::loadHTML($html1);
											 
											//Init the XPath object
											$xpath1 = new DOMXpath($dom1);
											
											// EN
											//$items_code = $xpath1->query('//div[contains(@class, "prodname")]/a')->item(0);
											$product_details = $xpath1->query('//div[contains(@class, "prodname")]/a');
											foreach ($product_details as $product_detail) {
												
												$html2 = file_get_contents("http://berkeleybeauty.com/".$product_detail->getAttribute("href"));
												if($html2 === ""){
													echo "!!!!!!!!!!!!!!!!!!!!!!1 link kết bị gãy !!!!!!!!!!!!!!!!!!!!!!!111";
													continue;	
												}
												$values = $myprocess->productValue($html2);
																									
												echo "-------------------------------> Product code: ".str_replace("Item Code:","",$values["itemCode"]) . "<br><br><br>";
												echo "-------------------------------> Product name: ".$values["product_title"] . "<br><br><br>";
												
												$SPID 		  = str_replace("Item Code:","",str_replace("Item Code:","",$values["itemCode"]));
												$product_name = $values["product_title"];
												$alias 		  = $core_class->_removesigns($values["product_title"]);
												$product_image= $values["img_file"];
												$attach_info  = "";
												$price		  = 0;
												$discounts    = 0;
												$discount_type= 1;
												$properties_name	= "||";
												$properties_value	= "||";
												$description  = $myprocess->txt_htmlspecialchars($values["description"]);
												$content	  = $myprocess->txt_htmlspecialchars($values["description"]);
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
											}

										}
										
									} else {
										
										
										// lay danh muc chi tiet cap con 1
										$html1 = file_get_contents("http://berkeleybeauty.com/" . $category_child_title->getAttribute("href"));
										if($html1 === ""){
											echo "!!!!!!!!!!!!!!!!!!!!!!1 link kết bị gãy !!!!!!!!!!!!!!!!!!!!!!!111";
											continue;	
										}
										//Parse it. Here we use loadHTML as a static method
										//to parse the HTML and create the DOM object in one go.
										@$dom1 = DOMDocument::loadHTML($html1);
										 
										//Init the XPath object
										$xpath1 = new DOMXpath($dom1);
										
										// EN
										//$items_code = $xpath1->query('//div[contains(@class, "prodname")]/a')->item(0);
										$product_details = $xpath1->query('//div[contains(@class, "prodname")]/a');
										foreach ($product_details as $product_detail) {
											
											$html2 = file_get_contents("http://berkeleybeauty.com/".$product_detail->getAttribute("href"));
											if($html2 === ""){
												echo "!!!!!!!!!!!!!!!!!!!!!!1 link kết bị gãy !!!!!!!!!!!!!!!!!!!!!!!111";
												continue;	
											}
											$values = $myprocess->productValue($html2);
																								
											echo "-------------------------------> Product code: ".str_replace("Item Code:","",str_replace("Item Code:","",$values["itemCode"])) . "<br><br><br>";
											echo "-------------------------------> Product name: ".$values["product_title"] . "<br><br><br>";
											
											$SPID 		  = str_replace("Item Code:","",str_replace("Item Code:","",$values["itemCode"]));
											$product_name = $values["product_title"];
											$alias 		  = $core_class->_removesigns($values["product_title"]);
											$product_image= $values["img_file"];
											$attach_info  = "";
											$price		  = 0;
											$discounts    = 0;
											$discount_type= 1;
											$properties_name	= "||";
											$properties_value	= "||";
											$description  = $myprocess->txt_htmlspecialchars($values["description"]);
											$content	  = $myprocess->txt_htmlspecialchars($values["description"]);
											$hot_product  = 0;
											$num_view	  = 1;
											$status		  = 1;
											$status_product = 1;
											$date_add		= $core_class->_formatdate(time());
											$order_num		= $myprocess->process_getmaxid("book_product", "order_num");
											$book_category_id = $max_catid1;
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
											
											
										}
										
										
									}
							}
							
						} else {
							// tiep theo la sp
							// duyet qua cac gia tri product detail
							
							$product_details = $xpath1->query('//div[contains(@class, "prodname")]/a');
							foreach ($product_details as $product_detail) {
								
								$html2 = file_get_contents("http://berkeleybeauty.com/".$product_detail->getAttribute("href"));
								if($html2 === ""){
									echo "!!!!!!!!!!!!!!!!!!!!!!1 link kết bị gãy !!!!!!!!!!!!!!!!!!!!!!!111";
									continue;	
								}
								$values = $myprocess->productValue($html2);
																					
								echo "-------------------------------> Product code: ".str_replace("Item Code:","",str_replace("Item Code:","",$values["itemCode"])) . "<br><br><br>";
								echo "-------------------------------> Product name: ".$values["product_title"] . "<br><br><br>";
								
								//echo "img_file: ".$values["img_file"] . "<br><br><br>";
								//echo "description: ".$values["description"]. "<br><br><br>";
								
								
								$SPID 		  = str_replace("Item Code:","",str_replace("Item Code:","",$values["itemCode"]));
								$product_name = $values["product_title"];
								$alias 		  = $core_class->_removesigns($values["product_title"]);
								$product_image= $values["img_file"];
								$attach_info  = "";
								$price		  = 0;
								$discounts    = 0;
								$discount_type= 1;
								$properties_name	= "||";
								$properties_value	= "||";
								$description  = $myprocess->txt_htmlspecialchars($values["description"]);
								$content	  = $myprocess->txt_htmlspecialchars($values["description"]);
								$hot_product  = 0;
								$num_view	  = 1;
								$status		  = 1;
								$status_product = 1;
								$date_add		= $core_class->_formatdate(time());
								$order_num		= $myprocess->process_getmaxid("book_product", "order_num");
								$book_category_id = $max_catid;
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
								
								
							}
							
						}
						/*
						foreach ($items_code as $item_code) {
							//echo "child category ------------: " . $item_code->nodeValue. "<br><br>";
							echo "child link ------------: " . $item_code->getAttribute("href") . "<br><br>";
						}
						*/
						// end lay danh muc chi tiet cap con 1
						
					$i++;
				}	// end foreach
				
            }
            else if ($_POST["task"] == "apply")
            {				
				
				$html = file_get_contents("http://berkeleybeauty.com/proddetail.php?prod=AP101-C");
				
				$values = $myprocess->productValue($html);
																	
				echo "Product code: ".str_replace("Item Code:","",str_replace("Item Code:","",$values["itemCode"])) . "<br><br><br>";
				echo "Product name: ".$values["product_title"] . "<br><br><br>";
				
				echo "img_file: ".$values["img_file"] . "<br><br><br>";
				echo "description: ".$values["description"]. "<br><br><br>";
				/*
				echo $values["img_file"] . "<br><br><br>";
				echo $values["description"] . "<br><br><br>";
				echo $values["itemnoValue"] . "<br><br><br>";
				echo preg_replace("/[^0-9\s]/", "", $values["priceValue"]) . "<br><br><br>";
				echo $values["PSV"] . " PSV<br><br><br>";
				echo $values["CSV"] . " CSV<br><br><br>";
				
				echo "START------------------------------------------------ <br><br><br>";
				echo var_dump($values["contentSection_title"]) . "<br>";
				
				echo "END------------------------------------------------ <br><br><br>";
				echo "START------------------------------------------------ <br><br><br>";
				
				echo var_dump($values["contentSection_text"]) . "<br>";
				echo "END------------------------------------------------ <br><br><br>";
				*/
				/*
				$SPID 		  = $values["itemnoValue"];
				$product_name = $values["product_title"];
				$alias 		  = $core_class->_removesigns($values["product_title"]);
				$product_image= $values["img_file"];
				$attach_info  = $values["CSV"];
				$price		  = preg_replace("/[^0-9\s]/", "", $values["priceValue"]);
				$discounts    = 0;
				$discount_type= 1;
				$properties_name	= "||";
				$properties_value	= "||";
				$description  = $myprocess->txt_htmlspecialchars($values["description"]);
				$content	  = $myprocess->txt_htmlspecialchars($values["description"]);
				$hot_product  = 0;
				$num_view	  = 1;
				$status		  = 1;
				$status_product = 1;
				$date_add		= $core_class->_formatdate(time());
				$order_num		= $myprocess->process_getmaxid("book_product", "order_num");
				$book_category_id = 200;
				$book_author_id	  = $values["PSV"];
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
						
					for($j = 0; $j < count($values["contentSection_title"]); $j++){
						$myprocess->process_addtabs($max_proid, trim($values["contentSection_title"][$j]), $values["contentSection_text"][$j], 1);
					}

				}*/
				
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