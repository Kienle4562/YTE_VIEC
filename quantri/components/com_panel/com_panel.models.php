<?php defined( '_VALID_MOS' ) or die( include("404.php") );



	class com_panel_process

	{

		public $dbObj;

        

        function __construct()

        {

             $this->dbObj = new classDb();

        }

        

        function get_statistics()

		{

			$sql = "

					SELECT

							(SELECT count(*) FROM `book_order` WHERE `status` = 0) as `cart_count`,

							(SELECT count(*) FROM `news`) as `article_count`,

							(SELECT count(*) FROM `book_product`) as `product_count`,

							(SELECT count(*) FROM `product_category`) as `product_category_count`,

							(SELECT count(*) FROM `contact` WHERE `status` = 0) as `contact_count`

			";

			

			return $this->dbObj->SqlQueryOutputResult($sql, array());

		}

		function getmodulegiua(){

			$sql = "select * from modules where position = 3";

			return $this->dbObj->SqlQueryOutputResult($sql, array());

		}
		function getmoduletop(){

			$sql = "select * from modules where position = 1";

			return $this->dbObj->SqlQueryOutputResult($sql, array());

		}
		function getmoduleduoi(){

			$sql = "select * from modules where position = 5";

			return $this->dbObj->SqlQueryOutputResult($sql, array());

		}
		function getmoduletrai(){

			$sql = "select * from modules where position = 4";

			return $this->dbObj->SqlQueryOutputResult($sql, array());

		}
		function getmodulephai(){

			$sql = "select * from modules where position = 2";

			return $this->dbObj->SqlQueryOutputResult($sql, array());

		}
		function getmodulekhac(){

			$sql = "select * from modules where position != 2 AND position != 4 AND position != 5 AND position != 1 AND position != 3";

			return $this->dbObj->SqlQueryOutputResult($sql, array());

		}
	}