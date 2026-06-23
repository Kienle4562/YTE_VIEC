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
				
			$web_root = "https://www.nuskin.com";
			$values = array();

			//Parse it. Here we use loadHTML as a static method
			//to parse the HTML and create the DOM object in one go.
			@$dom = DOMDocument::loadHTML($html);
			 
			//Init the XPath object
			$xpath = new DOMXpath($dom);
			
			// lay gia tri dau tien
			$title = $xpath->query('//*[@class="nodePropertyEditor"]')->item(0);
			$title = $title ->textContent;
			
			// neu gia tri dau la ko null thi chay di lay noi dung
			if($title != ""){
				
				$title = $xpath->query('//*[@class="nodePropertyEditor"]')->item(0);
				$title = $title ->textContent;
				$values["product_title"] = $title;
				echo $title;					
				
				$productImage = $xpath->query("//div[contains(@class, 'productImage')]/img")->item(0);
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
				if (!file_exists("E:/xampp/htdocs/file_upload/cms3.nuskin/images/".$img_folder)) {
					mkdir("E:/xampp/htdocs/file_upload/cms3.nuskin/images/".$img_folder, 0777, true);
				}
				
				// copy image from url
				copy($web_root . $img_src, "E:/xampp/htdocs/file_upload/cms3.nuskin/images/".$img_folder."/".$img_file);	
				
				$nodes = $xpath->query("//*[contains(@class, 'longDescription')]")->item(0);
				
				$tmp_doc = new DOMDocument();
				$tmp_doc->appendChild($tmp_doc->importNode($nodes,true));
				// in ra product description
				$values["description"] = $tmp_doc->saveHTML();
				
				$itemnoValue = $xpath->query('//*[@id="itemnoValue"]')->item(0);
				$itemnoValue = $itemnoValue ->textContent;
				// in ra product code
				$values["itemnoValue"] = $itemnoValue;
				
				$sizeValue = $xpath->query('//*[@id="sizeValue"]')->item(0);
				$sizeValue = $sizeValue ->textContent;
				// in ra sizeValue
				$values["sizeValue"] = $sizeValue;
									
				$priceValue = $xpath->query("//script[contains(@language, 'javascript')]")->item(0);
				$priceValue = $priceValue ->textContent;
				
				$img_array = explode("\"", $priceValue);
				
				//print_r($img_array);
				
				for($i =0; $i < count($img_array); $i++)
				{
					
					// EN
					
					if($img_array[$i] == "Price"){
						$values["priceValue"] = $img_array[$i+2];
					}
					if($img_array[$i] == "PSV"){
						$values["PSV"] = $img_array[$i+2];
					}
					if($img_array[$i] == "CSV"){
						$values["CSV"] = $img_array[$i+2];
					}
					
					// VN
					/*
					if($img_array[$i] == "Giá trên Web"){
						$values["priceValue"] = $img_array[$i+2];
					}
					if($img_array[$i] == "doanh số cá nhân PSV"){
						$values["PSV"] = $img_array[$i+2];
					}
					if($img_array[$i] == "CSV"){
						$values["CSV"] = $img_array[$i+2];
					}
					*/
				}
				
				
				$webPriceValue = $xpath->query("//*[contains(@class, 'webPriceValue_20 itemnoValue')]")->item(0);
				$webPriceValue = $webPriceValue ->textContent;
				// in ra priceValue
				$values["webPriceValue"] = intval($webPriceValue);
				
				$contentSections = $xpath->query('//*[@class="contentSections"]')->item(0);
				$contentSections = $contentSections ->textContent;
				
				$contentSection_title = $xpath->query('//div[contains(@class, "contentSection")]/li/a');
					
				$i = 0;
				
				$contentSection_title_array = array();
				$contentSection_text_array = array();
				
				foreach ($contentSection_title as $contentSection_title) {	
					// in ra title properties pure text
					$contentSection_title_array[] = $contentSection_title->nodeValue;
					
					$contentSectionContainer = $xpath->query("//div[contains(@class, 'sectionContent')]")->item($i);
					$contentSectionContainer_doc = new DOMDocument();
					$contentSectionContainer_doc->appendChild($contentSectionContainer_doc->importNode($contentSectionContainer,true));
					
					// edit src image in html
					$html = new DOMDocument();
					$html->loadHTML($contentSectionContainer_doc->saveHTML());
					
					//$img = $dom1->getElementsByTagName('img')->item(0)->getAttribute('src');
					
					foreach ($html->getElementsByTagName("img") as $element) { 
						$src = $element->getAttribute('src');
						$element->removeAttribute('src');
						$element->setAttribute("src", $web_root . $src);
					}
					
					// xu ly cat bo dau ngat dong de dua vao loa bo cac ma code ko can thiet
					$string_no_line =  preg_replace( "/\r|\n/", "", $this->innerHTML($html->documentElement));
					// in ra html sau khi da xu ly hoan chinh
					$contentSection_text_array[] = $this->strip_selected_tags($string_no_line, "style","script");		
							
					$i++;
				}
				
				$values["contentSection_title"] = $contentSection_title_array;
				$values["contentSection_text"] = $contentSection_text_array;
			
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
			
			$danhmuccha = 388;
			
			$html = file_get_contents('https://www.nuskin.com/en_AU/products/pharmanex/view_all_products.html');
			//Parse it. Here we use loadHTML as a static method
			//to parse the HTML and create the DOM object in one go.
			@$dom = DOMDocument::loadHTML($html);
			 
			//Init the XPath object
			$xpath = new DOMXpath($dom);
			
			// EN
			$contentSection_title = $xpath->query('//div[contains(@class, "title section")]/h3');
			// VN
			//$contentSection_title = $xpath->query('//div[contains(@class, "title section")]/h2');
			
			$i = 0;
			
			$myprocess = new process();
            
            $_SESSION['amdin']['com_product']['category']['lang_code'] = 'vi';

            if ($_POST["task"] == "save")
            {
				ini_set('max_execution_time', 2000); //300 seconds = 5 minutes
				
                foreach ($contentSection_title as $contentSection_title) {
					
					echo "category: ".$contentSection_title->nodeValue. "<br><br>";
					
					/* --- insert category ---- */
					$parent      	= 	$danhmuccha;
					$title          = 	$contentSection_title->nodeValue;
					$alias          = 	$core_class->_removesigns( $contentSection_title->nodeValue );
					
					$image			=   "Chọn file hình ảnh cần thêm .. ";
					
					$description 	= 	"Nuskin";
					$date_add      	= 	$core_class->_formatdate(time());
					$ordering      	= 	$myprocess->process_getmaxid("category", "ordering");
					$enabled      	= 	1;

					$max_catid = $myprocess->process_addcategories( $parent, $title, $alias, $description, $image, $date_add, $date_add, $ordering, $enabled );
					if ($max_catid > 0)
					{
							
						$myprocess->reset_left_right_value();
					
						/* --- insert category ---- */
						$html_links = $xpath->query('//div[contains(@class, "parbase list section")]')->item($i);
					
						$tmp_html = new DOMDocument();
						$tmp_html->appendChild($tmp_html->importNode($html_links,true));
						//echo  $tmp_html->saveHTML() . "<br>";
						
						@$dom = DOMDocument::loadHTML($tmp_html->saveHTML());
						
						$xpath1 = new DOMXpath(@$dom);
						
						$product_links = $xpath1->query('//div[contains(@class, "parbase list section")]/ul/li/p/a');
						
						foreach ($product_links as $product_link) {
							
							$link = $product_link->getAttribute("href");
							
							$link_array = explode("/", $link);
							
							$num = explode(".", $link_array[count($link_array)-1]);
							
							if( is_numeric( $num[0] ) ){
								
								$content = file_get_contents("https://www.nuskin.com" . $product_link->getAttribute("href"));
								$html = mb_convert_encoding('<meta http-equiv="content-type" content="text/html; charset=utf-8">' . $content, 'UTF-8', 
															mb_detect_encoding($content, 'UTF-8, ISO-8859-1', TRUE));
								
								//$html = file_get_contents($link);
													
								if ($html === "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">") {
									echo "!!!!!!!!!!!!!!!!!!!!!!1 link kết bị gãy !!!!!!!!!!!!!!!!!!!!!!!111";
									continue;
								} else {
									
									$values = $myprocess->productValue($html);
																	
									echo $values["product_title"] . "<br><br><br>";
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
									$book_category_id = $max_catid;
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
					
									}
									
								}										
							
							}
						}
													
					} //end if
					
					$i++;
				}	// end foreach
				
            }
            else if ($_POST["task"] == "apply")
            {
				$link_array = explode("/", "https://www.nuskin.com/en_AU/products/nuskin/ageloc/45433543.html");
							
				$num = explode(".", $link_array[count($link_array)-1]);
				print_r($num) . "<br>";
				echo $num[0];
				
				if( is_numeric( $num[0] ) ){
					echo "nummeric";	
				}
				
				/*
				$values = $myprocess->productValue("https://www.nuskin.com/en_AU/products/nuskin/ageloc/ageLOCbeforeandafter.html");
																	
				echo $values["product_title"] . "<br><br><br>";
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