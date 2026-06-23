<?php
include_once("mysql_connect.php");
class classDb{
	//include connetion
	public $connect;
	
	function __construct()
	{
		$this->connect = new classConnect();
	}
	// output result use  sql query
	public function SqlQueryOutputResult($Query, $parameterValues){
		$PDOobjdata = $this->connect->mysqlConnect();
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
	
	// input result use  sql query
	public function SqlQueryInputResult($Query, $parameterValues){
		$PDOobjdata = $this->connect->mysqlConnect();
		$result = $PDOobjdata->prepare( $Query );
		if($result->execute($parameterValues) <> FALSE){
			return true;
		} else {
			if ($result->errorCode(  )<>'00000') {
			 $str_error = str_replace("Duplicate entry", "Mục nhập trùng lặp", $result->errorInfo());
			 $str_error = str_replace("for key", "tại trường", $str_error);
			 die($str_error[2]);
			 return false;
		   }
		}
	}
	
	// output result use procedure
	public function _getResultset($procedureName, $parameter, $parameterValues){
		$PDOobjdata = $this->connect->mysqlConnect();
		$result = $PDOobjdata->prepare("call ".$procedureName."(".$parameter.")");
		if($result->execute($parameterValues) <> FALSE){
			return $result;
		} else {
			if ($result->errorCode(  )<>'00000') {
			 die("<label style=color:#FF0000>Báo lỗi: ".implode(': ',$result->errorInfo(  ))."<label><br><br>");
			 return false;
		   }
		}
	}
	// input result use procedure
	public function _bindResult($procedureName, $parameter, $parameterValues){
		$PDOobjdata = $this->connect->mysqlConnect();
		$result = $PDOobjdata->prepare("call ".$procedureName."(".$parameter.")");
		if($result->execute($parameterValues) <> FALSE){
			$GLOBALS['err_msg'] = "bien toan cuc ne";
			return true;
		} else {
			if ($result->errorCode(  )<>'00000') {
			 //die("<label style=color:#FF0000>Báo lỗi: ".implode(': ',$result->errorInfo(  ))."<label><br><br>");
			 $GLOBALS['msg'] = "<label style=color:#FF0000>Báo lỗi: ".implode(': ',$result->errorInfo(  ))."<label><br><br>";
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
		} else {
			return 0;
		}
	}
}
?>


<?php  

	//dung de hien thi resultset tu procedure
	/*
	$dbObj = new classDb();
	
	$result = $myclass->getResultset("sp_select_account", "?", array("2"));
	echo "totalrow:  " , $result->rowCount() , "<br><br>";	
	
	foreach($result as $row) {
		echo "username: ".$row[uid]. "<br>";
		echo "fullname: " . $row[fullname] . "<br>";
		echo "<br>";
	}

	unset( $result );
	
	//dung de hien thi resultset tu sql query
	
	$result = $dbObj->SqlQueryOutputResult("SELECT
										  `account`.`Ac_Id`, `account`.`PerID`, `account`.`UserName`,
										  `account`.`FullName`, `account`.`Mail`, `account`.`PassWord`,
										  `account`.`Status`
										FROM
										  `account` WHERE `account`.`Ac_Id` = ?", array("1"));
										  
	echo "totalrow:  " , $result->rowCount() , "<br><br>";	

	foreach($result as $row) {
		echo "username: ".$row["UserName"]. "<br>";
		echo "fullname: " . $row["FullName"] . "<br>";
		echo "<br>";
	}
	/*
	// OR
	
	while($row = $result->fetch(  )) {
		printf("%d %s \n",$row['UserName'],$row['FullName']);
   }

	unset( $result );
	*/
?>