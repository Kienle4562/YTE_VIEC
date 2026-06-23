<?php defined( '_VALID_MOS' ) or die( include("404.php") );

switch($_POST["hidden"])
{

	case "";
	// khoi dau trang khong co gia tri submit. khong lam zi ca
	break;
	
	

	
	
	case "submit_com_product_manufacturer_edit";
		$myprocess = new process;
		if($_POST["task"] == "save"){
			if($myprocess->process_editmanufacturer(
			intval($_POST["cid"]),
			$_POST["manufacturer_name"],
			$core_class->_removesigns($_POST["alias"]),
			$_POST["html_description"],
			$_POST["html_content"],
			$_POST["image_file"],
			$_POST["txt_website"],
			$_POST["txt_yahoo"] ,
			$_POST["txt_skype"],
			$_POST["txt_Email"],
			$_POST["txt_representative"],
			$_POST["txt_phone"],
			$_POST["txt_address"],		
			$_POST["published"],
			0,
			$core_class->_formatdate($_POST["date_add"])) <> FALSE){
				$core_class->_redirect(".?com=com_product&view=manufacturer&task=view");
				exit();
			} else {
				$GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
			}
		} else if ($_POST["task"] == "apply"){
			if($myprocess->process_editmanufacturer(
			intval($_POST["cid"]),
			$_POST["manufacturer_name"],
			$core_class->_removesigns($_POST["alias"]),
			$_POST["html_description"],
			$_POST["html_content"],
			$_POST["image_file"],
			$_POST["txt_website"],
			$_POST["txt_yahoo"] ,
			$_POST["txt_skype"],	
			$_POST["txt_Email"],
			$_POST["txt_representative"],
			$_POST["txt_phone"],
			$_POST["txt_address"],	
			$_POST["published"],
			0,
			$core_class->_formatdate($_POST["date_add"])) <> FALSE){
				$GLOBALS['msg'] = "Nhà sản xuất đã được thêm thành công!";
				$core_class->_redirect(".?com=com_product&view=manufacturer&task=edit&id=".intval($_POST["cid"]));
				exit();
			} else {
				$GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
			}
			
			
		} else if($_POST["task"] == "cancel"){
			$core_class->_redirect(".?com=com_product&view=manufacturer&task=view");
			exit;
		}

	break;
	
	
	
	/* khoi su ly su kien submit form publisher view */
	case "submit_com_publisher_view";
		if($_POST["task"] == "unpublish"){
			$check = FALSE;
			$values = $_POST["cid"];
			$myprocess = new process;
			for ($row = 0; $row < count($values); $row++){
				if($myprocess->process_pulish_and_un_publish_publisher("0", $values[$row]) <> FALSE)
				$check = TRUE;
			}
			if($check == TRUE)
			$GLOBALS['msg'] = "";
			else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
		}
		else if($_POST["task"] == "publish"){
			$check = FALSE;
			$values = $_POST["cid"];
			$myprocess = new process;
			for ($row = 0; $row < count($values); $row++){
				if($myprocess->process_pulish_and_un_publish_publisher("1", $values[$row]) <> FALSE)
				$check = TRUE;
			}
			if($check == TRUE)
			$GLOBALS['msg'] = "";
			else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
		}
		
		else if($_POST["task"] == "remove"){
			$check = FALSE;
			$values = $_POST["cid"];
			$myprocess = new process;
			for ($row = 0; $row < count($values); $row++){
				if($myprocess->process_remove_publisher($values[$row]) <> FALSE)
				$check = TRUE;
			}
			if($check == TRUE){}
			else $GLOBALS['msg'] = "Hiện tại hệ thống đang gặp lỗi, vui lòng liên hệ quản trị !!! ";
		}
	break;
	
	case "submit_com_publisher_add";
	
		$myprocess = new process;
		if($_POST["task"] == "save"){		
			if($myprocess->process_add_publisher(
			$_POST["publisher"], 
			$core_class->_formatdate($_POST["date_add"]), 
			$_POST["published"]) <> FALSE){
				$core_class->_redirect(".?com=com_product&view=product&task=publisher.choose");
				exit();
			} else {
				$GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
			}
		} else if ($_POST["task"] == "apply"){
			if($myprocess->process_add_publisher(
			$_POST["publisher"], 
			$core_class->_formatdate($_POST["date_add"]), 
			$_POST["published"]) <> FALSE){
				$GLOBALS['msg'] = "nhà xuất bản đã được thêm thành công!";
				$core_class->_redirect(".?com=com_product&view=product&task=publisher.add");
				exit();
			} else {
				$GLOBALS['msg'] = "Đã có lỗi thêm danh mục, vui lòng làm lại!";
			}
		} else if($_POST["task"] == "cancel"){
			$core_class->_redirect(".?com=com_product&view=product&task=publisher.choose");exit;
		}

	break;
	
	case "submit_com_publisher_edit";
	
		$myprocess = new process;
		if($_POST["task"] == "save"){		
			if($myprocess->process_edit_publisher(
			$_POST["publisher"], 
			$core_class->_formatdate($_POST["date_add"]), 
			$_POST["published"],
			intval($_POST["id"])) <> FALSE){
				$core_class->_redirect(".?com=com_product&view=product&task=publisher.choose");
				exit();
			} else {
				$GLOBALS['msg'] = "Đã có lỗi thêm chủ đề, vui lòng làm lại!";
			}
		} else if ($_POST["task"] == "apply"){
			if($myprocess->process_edit_publisher(
			$_POST["publisher"], 
			$core_class->_formatdate($_POST["date_add"]), 
			$_POST["published"],
			intval($_POST["id"])) <> FALSE){
				$GLOBALS['msg'] = "nhà xuất bản đã được thay đổi thành công!";
				$core_class->_redirect(".?com=com_product&view=product&task=publisher.edit&id=" . intval($_POST["id"]));
				exit();
			} else {
				$GLOBALS['msg'] = "Đã có lỗi thêm danh mục, vui lòng làm lại!";
			}
		} else if($_POST["task"] == "cancel"){
			$core_class->_redirect(".?com=com_product&view=product&task=publisher.choose");exit;
		}

	break;
	
	default:
		$core_class->_redirect(".");exit();
	break;
}

class process{

	
	
	// ham su ly edit nha san xuat
	function process_editmanufacturer($Id, $title, $alias, $description, $content, $logo, $website, $yahoo, $skype, $email, $representative, $phone,$address,$status, $sticky, $date_add){
		$myprocess = new process;
		include("../protected/dbconnect.php");
		$sql = " UPDATE `book_manufacturers` SET
				`book_manufacturers`.`title` = ? , 
				`book_manufacturers`.`alias` = ? , 
				`book_manufacturers`.`description` = ? ,
				`book_manufacturers`.`content` = ? , 
				`book_manufacturers`.`logo` = ? ,
				`book_manufacturers`.`website` = ? , 
				`book_manufacturers`.`yahoo` = ? ,
				`book_manufacturers`.`skype` = ? , 
				`book_manufacturers`.`email` = ?,
				`book_manufacturers`.`representative` = ?,
				`book_manufacturers`.`phone` = ?,
				`book_manufacturers`.`address` = ?,
				`book_manufacturers`.`status` = ? ,
				`book_manufacturers`.`sticky` = ? , 
				`book_manufacturers`.`date_add` = ?
		WHERE `book_manufacturers`.`Id` = ?";
		$cmd = $mysqli->prepare($sql);
		$cmd->bind_param("ssssssssssssssss", $title, $alias, $description, $content, $logo, $website, $yahoo, $skype, $email, $representative, $phone,$address,$status, $sticky, $date_add, $Id);
		if($cmd->execute() <> FALSE) return true; 
		else echo $mysqli->error;
		$cmd->close();
		$mysqli->close();				
	}

	
	
	// ham loai bo ky tu dac biet trong chuoi khi lay ra
	function txt_htmlspecialchars($t="")
	{
		// Use forward look up to only convert & not &#123;
		//$t = str_replace( "<", "&lt;"  , $t );
		//$t = str_replace( ">", "&gt;"  , $t );
		$t = str_replace( "\\", ""  , $t );
		//$t = str_replace( '"', "", $t );
		
		return $t; // A nice cup of?
	}
	
	
	
	

	
	
/*	------------------	khoi nay la cac ham su ly cua chu de cha(session)	--------------------	*/
	
	
	
	
	
	
	
	
	
/*	------------------	ket thuc cac ham su ly cua chu de con(category)	--------------------	*/
	
/*	------------------	khoi nay la cac ham su ly cua chu de con(category)	--------------------	*/
	
	
	
	
	
	
	// ham su ly di chuyen mau tin len xuong cua category
	

	
	
	
	
	
	
	
	
	
/*	------------------	ket thuc cac ham su ly cua chu de con(category)	--------------------	*/

/*	------------------	khoi nay la cac ham su ly cua san pham	--------------------	*/
	

	
	
	
	
	
	
	// ham su them moi nha xuat ban
	function process_add_publisher($publisher, $date_add, $status){
		$myprocess = new process;
		include("../protected/dbconnect.php");
		$sql = " Insert Into book_publishers(`publisher_name`, `date_add`, `status`) values (?, ?, ?)";
		$cmd = $mysqli->prepare($sql);
		$cmd->bind_param("sss", $publisher, $date_add, $status);
		if($cmd->execute() <> FALSE) return true;
		else echo $mysqli->error;
		$cmd->close();
		$mysqli->close();
	}
	
	// ham su chinh sua thong tin nha xuat ban
	function process_edit_publisher($publisher, $date_add, $status, $id){
		$myprocess = new process;
		include("../protected/dbconnect.php");
		$sql = " update book_publishers SET `publisher_name` = ? , `date_add` = ? , `status` = ? WHERE `Id` = ?";
		$cmd = $mysqli->prepare($sql);
		$cmd->bind_param("ssss", $publisher, $date_add, $status, $id);
		if($cmd->execute() <> FALSE) return true;
		else echo $mysqli->error;
		$cmd->close();
		$mysqli->close();
	}
	
	/* ham su ly go bo nha xuat ban */
	function process_remove_publisher($values){
		include("../protected/dbconnect.php");
		$sql = "Delete FROM `book_publishers` where `Id` = ?";
		$cmd = $mysqli->prepare($sql);
		$cmd->bind_param("s", $values);
		if($cmd->execute() <> FALSE) return true;
		else echo $mysqli->error;
		$cmd->close();
		$mysqli->close();
	}
	
	function process_pulish_and_un_publish_publisher($check, $values){
		include("../protected/dbconnect.php");
		if($check == 0)
		$sql = "Update book_publishers Set `status` = 0 Where Id = ?";
		else $sql = "Update book_publishers Set `status` = 1 Where Id = ?";
		$cmd = $mysqli->prepare($sql);
		$cmd->bind_param("s", $values);
		if($cmd->execute() <> FALSE) return true;
		else echo $mysqli->error;
		$cmd->close();
		$mysqli->close();
	}
/*	------------------	ket thuc cac ham su ly cua ban tin	--------------------	*/
}
?>