<?php
/*
	Simple database class - Version 1.0
	Release Date: 16/11/2011
	Author: mientay24h
*/
//include connetion
include_once("mysql_connect.php");

class classDb{
	
	public $connect;
	
	function __construct()
	{
		$this->connect = new classConnect();
	}
	
	/*
    ** Query mysql and output result
    ** 
    */ 
	public function SqlQueryOutputResult($Query, $parameterValues)
	{
		$PDOobjdata = $this->connect->mysqlConnect();
        $PDOobjdata->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
		$result = $PDOobjdata->prepare( $Query );
		if($result->execute($parameterValues) <> FALSE){
			return $result;
		} else {
			if ($result->errorCode(  )<>'00000') {
			 die("<label style=color:#FF0000>Báo lỗi: ".implode(': ',$result->errorInfo(  ))."<label><br><br>");
			 return false;
		   }
		}
	}
	
	/*
    ** Query mysql and input values
    ** 
    */ 
	public function SqlQueryInputResult($Query, $parameterValues){
		$PDOobjdata = $this->connect->mysqlConnect();
        $PDOobjdata->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
		$result = $PDOobjdata->prepare( $Query );
		if($result->execute($parameterValues) <> FALSE) {
            $PDOobjdata->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
			return true;
		} else {
			if ($result->errorCode(  )<>'00000') {
                $PDOobjdata->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);
		        die("<label style=color:#FF0000>Báo lỗi: ".implode(': ',$result->errorInfo(  ))."<label><br><br>");
		        return false;
		    }
	    }
	}
	
	/*
    ** Query mysql and return last insert id
    ** 
    */ 
	public function last_insert_id($Query, $parameterValues){        
       $PDOobjdata = $this->connect->mysqlConnect();
		$result = $PDOobjdata->prepare( $Query );
		if($result->execute($parameterValues) <> FALSE){
			return $PDOobjdata->lastInsertId();
		} else {
			if ($result->errorCode(  )<>'00000') {
			 die("<label style=color:#FF0000>Báo lỗi: ".implode(': ',$result->errorInfo(  ))."<label><br><br>");
			 return 0;
		   }
		}
    }
	
	/*
    ** Query mysql and return row count
    ** 
    */ 
	public function row_count($Query, $parameterValues){
		$dbObj = new classDb();
		$result = $dbObj->SqlQueryOutputResult($Query, array($parameterValues));
		return $result->rowCount();
	}
	
	/*
    ** Query mysql and return max id query
    ** 
    */ 
	public function maxid($table, $column){
		$dbObj = new classDb();
		$sql = "select MAX(`$column`)+1 As `MaxId` from `$table`;";
		$result = $dbObj->SqlQueryOutputResult($sql, array(0));
		if($row = $result->fetch()){
			if($row["MaxId"] == 0)	return 1;
			else return $row["MaxId"];
		}
	}
	
	public function fix_quotes_dquotes($text)
	{
		$tmp = str_replace(array('\"', "\'"), array('"', "'"), $text);
		return str_replace(array('"', '\''), array('″', '′'), $tmp);
	}
	
	public function get_max_allowed_packet()
	{
		$db = new classDb();
		
		$result = $db->SqlQueryOutputResult("SHOW VARIABLES LIKE 'max_allowed_packet'", array());
		
		if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			return intval($row['Value'] * 8 / 10);
		}
		else {
			return 0;
		}
	}
}