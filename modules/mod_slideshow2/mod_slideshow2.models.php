<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );



    class process_mod_slideshow2 extends modules_models

    {
		//Lấy loại menu

	    function process_getMenuType_Add_Article($Id){

		    $sql = "SELECT `menu_type`.`Id`, `menu_type`.`title` FROM `menu_type` WHERE `menu_type`.`Id` = ?;";

		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($Id));

		    return $result;

	    }
		
		function getTinhThanh(){
		    $sql = "SELECT * FROM mst_tinhthanh ORDER BY DISORDER DESC";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array());
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

	    

	    function get_category_view($parentid)

	    {

		    $sql = "SELECT

				      `category`.`cat_id`, `category`.`alias`, `category`.`title`, `category`.`date_add`, `category`.`enabled`, `category`.`ordering`, `category`.`num_view`

				    FROM `category`

				    WHERE parent_id = ?";

		    $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid));

		    return $result;

	    }

        

        function get_product_category_view($parentid)

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

                            `parent_id` = ?

                    ORDER BY

                    		`ordering`, `cat_id`

            ";



            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid));

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

		function lay_danhmucsanpham_parent($parent_id){

			$sql = "select * from product_category where parent_id = ? limit 4";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($parent_id));

            return $result;

		}

		function lay_danhmucsanpham_child($product_category_id){

			$sql = "select * from product_category where cat_id = ?";

			$result = $this->dbObj->SqlQueryOutputResult($sql, array($product_category_id));

            return $result;

		}

        public function category_multi_level($parentid, $lang_code)

        {

            $sql = "

                    SELECT

                            `cat_id`,

                            `title`

                    FROM

                            `product_category`

                    WHERE

                            `parent_id` = ?

                            AND `lang_code` = ?

            ";

            

            $result = $this->dbObj->SqlQueryOutputResult($sql, array($parentid, $lang_code));

            

            return $result;

        }

        

        public function get_category_list($id, $delim = ' » ', $col = 'title', $lang_code)

        {

            $cond = '';



            if (is_numeric($id)) {

                $cond = '`cat_id` = ?';

            }

            else {

                $cond = '`alias` = ?';

            }

            

            $result = $this->dbObj->SqlQueryOutputResult("



                SELECT REPLACE(GROUP_CONCAT(c.`{$col}` ORDER BY c.`left` ASC), ',', '{$delim}') as `result`

                FROM (

                                SELECT

                                        `product_category`.`{$col}`,

                                        '1' as `tmp_col`,

                                        `product_category`.`left`

                                FROM

                                        `product_category`,

                                        (

                                            SELECT

                                                    `left`,

                                                    `right`

                                            FROM

                                                    `product_category`

                                            WHERE

                                                    {$cond}

                                                    AND `lang_code` = ?

                                            LIMIT 0,1

                                        ) as a

                                WHERE

                                		`product_category`.`left` <= a.`left`

                                		AND `product_category`.`right` >= a.`right`

                                		AND `product_category`.`lang_code` = ?

                ) as c

                GROUP BY c.`tmp_col`

            

            ", array($id, $lang_code, $lang_code));

            

            if ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                return $row['result'];

            }

            else {

                return '';

            }

        }
        function get_slideshow_content($module_id)

        {

            return $this->dbObj->SqlQueryOutputResult("

            

                SELECT

                        `image_file`,

                        `link`

                FROM

                        `mod_slideshow`

                WHERE

                        `module_id` = ?

                        AND `activated` = 1

                ORDER BY

                        `order_num` DESC

            

            ", array($module_id));

        }

    }