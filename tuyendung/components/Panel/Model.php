<?php defined( '_VALID_MOS' ) or die( include("404.php") );

	class process
	{
		public $dbObj;
        
        function __construct()
        {
             $this->dbObj = new classDb();
        }
	}