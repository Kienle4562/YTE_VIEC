<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    

    class process_menumobile extends modules_models

    {
		function menumobile($parentid = 0, $group_menu_id, $ext, $max_level, $current_level, &$params)
		{
			$result = $this->get_data_menu($parentid, $group_menu_id);
			$total = $result->rowCount();
			if ($total > 0)
			{
				if($current_level > 1){
					echo '<ul class="m_submenu r_xs_corners bg_light vr_list tr_all tr_xs_none trf_xs_none bs_xs_none d_xs_none">';
				}			
				if (count($GLOBALS['LANG_LIST']) > 1)
				{
					$__home = $GLOBALS['LANG'] . $GLOBALS['EXT'];
					$__append = $GLOBALS['LANG'] . '/';
				}
				else
				{
					$__home = '';
					$__append = '';
				}			
				while ( $row = $result->fetch( ) )
				{
					if ( $row['link'] == '.' )
					{
						$link = $GLOBALS['INDEX'] . $__home;
					}
					else if ( $row['type'] == 'linkout' )
					{
						$tmp = strtolower( $row['link'] );
						if ( substr( $tmp, 0, 7 ) == "http://"
							|| substr( $tmp, 0, 8 ) == "https://"
							|| substr( $tmp, 0, 7 ) == "mailto:"
							|| substr( $tmp, 0, 6 ) == "ftp://" )
						{
							$link = $row['link'];
						}
						else {
							$link = $GLOBALS['INDEX'] . $__append . $row['link'];
						}
					}
					else if ( $row['type'] == 'null' )
					{
						$link = $row['link'];
					}
					else
					{
						$link = $GLOBALS['INDEX'] . $__append . $row['link'] . $GLOBALS['EXT'];
					}	
					if($current_level == 1){
						echo '<li class="no-icon">';												
						echo '<a class="color_light relative r_xs_corners" onclick="opensubmenu(this)" href="javascript:void(0)" target="', $row['target'], '">';																						
						echo $row["title"];
						if ($this->get_is_child($row["Id"])>0 ){
							echo '&nbsp;<i style="margin-left: 0;" class="fa fa-chevron-down"></i>';
						}
						if($row["Id"] == 420){
							echo '<img style="margin-bottom: 10px;" src="images/hot.gif">', '</a>';
						}
						
						if ( $current_level < $max_level || $max_level == 0 )
						{
							$this->menumobile( $row["Id"], $group_menu_id, $ext, $max_level, $current_level + 1, $params );
						}												
						echo '</li>';
					} else {
						echo '<li>';								
						echo '<a class="d_block color_light relative" href="', $link, '" target="', $row['target'], '">';																						
						echo '&nbsp;<i style="margin-left: 0;" class="fa fa-chevron-right"></i>';
						echo $row["title"], '</a>';
						
						if ( $current_level < $max_level || $max_level == 0 )
						{
							$this->menumobile( $row["Id"], $group_menu_id, $ext, $max_level, $current_level + 1, $params );
						}												
						echo '</li>';
					}
					$i++;
				}
				if($current_level > 1){
					echo '</ul>';
				}
			}
		}
	    function get_data_menu ($parentid = 0, $menu_type_id) {

		    $sql = "SELECT `Id`, `link_id` as `link`, `title`, `type`, `target`, `link` as `icon`

				    FROM `menu` 

				    WHERE parent_Id = ?  AND `menu_type_id` = ? AND `activated` = 1 order by order_num;";

		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $menu_type_id));	

		    return $result;

	    }
		function get_is_child($id){
			$sql = "select count(Id) as tongcong from menu where parent_id=? AND activated = 1";
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($id));
			$row = $result->fetch();
			return $row["tongcong"];
		}
        

        function get_menu_type_list($lang_code)

        {

            return $this->dbObj->SqlQueryOutputResult("

            

                SELECT

                        `id`,

                        `title`

                FROM

                        `menu_type`

                WHERE

                		`lang_code` = ?

            

            ", array($lang_code));

        }

		 public function get_cart_data($cart_array)

        {	

			

            if (!empty($cart_array)) {

                $id = array_keys($cart_array);

				

            }

            else {

                $id = array();

            }					

            

            if (count($id) > 0)

            {

				

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

            }

            else

            {

                return null;

            }

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

        

    }

	

	 if (!empty($_POST['do']))

    {

		// $myprocess = new process_menu();

		  switch ($_POST['do'])

			{

				 case 'remove':

            {

                if (isset($_SESSION['cart'][$_POST['productId']]))

                	{

					// remove item form cart

                    unset($_SESSION['cart'][$_POST['productId']]);

					

                   

                	}

				}

				break;

			}

	}