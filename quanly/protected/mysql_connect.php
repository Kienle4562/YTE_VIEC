<?php
// Connect to mysql database
class classConnect
{
	function mysqlConnect()
	{
		try
		{
			$PDOobjdata = new PDO(
				'mysql:host=' . mapping('db_host') . '; dbname=' . mapping('db_schema'),
				mapping('db_user'),
				mapping('db_password'),
				array(PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
			);
			
			return $PDOobjdata;
		}
		catch (PDOException $e)
		{
			die('Connection failed: ' . $e->getMessage());
		}
	}
}