<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class mod_topbar_process extends modules_models
    {
		public function category_multi_level(){
            $sql = "SELECT * FROM `product_category` where parent_id = 0";
            $result = $this->dbObj->SqlQueryOutputResult($sql, array());
            return $result;
        }
		private function array2list($arr)
        {
            $list = '';
            foreach($arr as $value) {
                $list .= ',' . $value;
            }
            if ($value != '') {
                $list = substr($list, 1);
            }
            return $list;
        }
	    public function get_cart_data($cart_array)
        {	
            if (!empty($cart_array)) {
                $id = array_keys($cart_array);
            }else {
				$id = array();
			}					
            if (count($id) > 0){
				$id_list = $this->array2list($id);
				//echo $id_list;
                return $this->dbObj->SqlQueryOutputResult("
                    SELECT
                            `id`,
							`SPID`,
                            `product_name`,
                            `price`,
							`size_product`,
							`color_product`,
                            `discounts`,							
                            `discount_type`,
                            `product_image`
                    FROM
                            `book_product`
                    WHERE
                            `id` IN ({$id_list})
                ", array());
            }else{
                return null;
            }
        }
    }