<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
//	include_once('com_cronjob.models.php')
    $myObj = new \stdClass();
	$myprocess = new process();
	if($deleOld = $myprocess->update_OldNews())
		{
			
			$myObj->status = 1;
			$myObj->message = "Success...!!!";

		}else
		{
			$myObj->status = 0;
			$myObj->message ='Error...!!';
		}
		$myJSON = json_encode($myObj);
		echo $myJSON;
?>