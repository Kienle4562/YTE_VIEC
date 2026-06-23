<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );



    class process

    {

        public $dbObj;

        

        function __construct()

        {

            $this->dbObj = new classDb();

        }

		

		function update_OldNews()

           {	

		    $sql = " 

		    UPDATE trn_congviec SET trangthai = 0 , DELETE_FLG = 1 

		    WHERE DISORDER < DATE_SUB(NOW(), INTERVAL 60 DAY)";

            if ($this->dbObj->SqlQueryInputResult($sql,array())<> FALSE) 

				{

				   return true;

				} else {

				   return false;

				}

			}

    }

