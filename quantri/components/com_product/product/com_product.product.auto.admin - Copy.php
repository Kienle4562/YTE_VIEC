<?php defined( '_VALID_MOS' ) or die( include("404.php") );
//include_once("com_product.product.add.admin.models.php");
 class process
    {
		private $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
		 public function process_addnews($code,
										 $product_name,
										 $alias,
										 $img,
										 $categoryID
											
										)
        {
			 return $this->dbObj->SqlQueryInputResult(
                "INSERT INTO book_product(	`SPID`, 
										    `product_name`,
											`alias`,
											`product_image`,
											`book_category_id`
											)
												
					VALUES (?, ?,?,?,?)", 
                array($code,
					$product_name,$alias,$img,$categoryID)
            );
			
		}
	}

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
	 function _formatdate( $date )

        {

            $month = intval(substr($date, 3, 2)); $day = intval(substr($date, 0, 2)); $year = intval(substr($date, -4));

            return mktime(date('H'), date('i'), date('s'),$month, $day, $year);

        }
function list_files($directory = '.')
{
    if ($directory != '.')
    {
        $directory = rtrim($directory, '/') . '/';
    }
	//echo $directory;
    
    if ($handle = opendir($directory))
    {
		$idcategory = '16';
		$code ='';
		$lang ='vi';
		$product_name = '';
		$attach_info ='';
		$product_image ='';
		$price ='0';
		$discounts ='0';
		$discount_type ='1';
		$properties_name = '';
		$properties_value = '';
		$html_description = '';
		$html_content = '';
		$hot_product = '1';
		$num_view   ='1';
		$status = '1';
		$status_product = '1';
		$date_add = _formatdate(date('d/m/Y'));
		$order = '1';
		$shipping_costs = '0';
		$author = '';
		$quality = '';
		$account_id ='1';
		$show_comment ='1';
		$origin = '';
		$keyword = '';
		$manufacturer_id = '';
		$show_comment ='';
		$i = 0;
		$type = '/(.jpg)|(.gif)|(.jpeg)|(.pjpeg)|(.x-png)| (.png)/';
		$myprocess = new process();
        while (false !== ($file = readdir($handle)))
        {
            if ($file != '.' && $file != '..')
            { 
				$code ='code_'.$i;
				$product_name = preg_replace($type,'',$file);
				$product_image = "/files/images/".$file;
				$alias = _removesigns($product_name);
				$myprocess->process_addnews($code,
                            $product_name,$alias,$product_image, $idcategory);	
							

            }
			$i++;
        }
        closedir($handle);
    }
}
list_files('uploads/');
