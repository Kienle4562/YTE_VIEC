<?php

	$front_end_com = trim($_GET["com"]);

	switch ($front_end_com)
	{
		case "":
			include_once("$front_end_com/com_default/com_default.html.php");
		break;
		
		default:
			
			$file_path = "$front_end_com_folder/$front_end_com/$front_end_com.html.php";

			if ($core_class->_routers( $file_path )){
				include_once($file_path);
			} else {
				$core_class->_redirect($index);
			}
			
		break;
		
	}
?>