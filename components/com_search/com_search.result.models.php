<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );



    class process_category extends com_search

    {

        function get_category($conditon, $offset, $limit)

        {

            $sql = "	

					SELECT

							product_category.title,

							product_category.alias,

							book_product.Id,

							book_product.lang_code,

							book_product.SPID,

							book_product.product_name,

							book_product.alias,
							book_product.quality,

							book_product.product_image,

							book_product.attach_info,

							book_product.price,

							book_product.discounts,

							book_product.discount_type,

						

							book_product.hot_product,

							book_product.num_view,

							book_product.status,

							book_product.status_product,

							book_product.`date_add`,

							book_product.order_num,

							book_product.book_category_id,

							book_product.author,

							book_product.shipping_costs,

							book_product.origin,

							book_product.account_id,

							book_product.keyword,

							book_product.show_comment,

							book_product.assoc_id

							FROM

							product_category

							Inner Join book_product ON product_category.cat_id = book_product.book_category_id

							Where  `product_category`.`enabled` = 1 AND `book_product`.`status` = 1 $conditon limit $offset,$limit

            ";



            return $this->dbObj->SqlQueryOutputResult($sql, array($GLOBALS['LANG'], $GLOBALS['LANG']));

        }

        public function get_category_count( $conditon )

        {

            $sql = "							

					SELECT

                            COUNT(`book_product`.`id`) as `totalrow`

                    FROM

                            `product_category` 

                            INNER JOIN `book_product` ON `product_category`.`cat_id` = `book_product`.`book_category_id` 

                       

                    WHERE

					     `product_category`.`enabled` = 1

                            $conditon

                            AND `book_product`.`status` = 1;

            ";

            

            $result = $this->dbObj->SqlQueryOutputResult($sql, array($GLOBALS['LANG'], $GLOBALS['LANG']));

            

            if ($row = $result->fetch()) {

                return $row['totalrow'];

            }

        }



    }