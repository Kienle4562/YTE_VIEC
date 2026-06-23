<?php defined( '_VALID_MOS' ) or die( include("404.php") ); 
    include("com_login.process.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="index, follow" />
        <title>  Bảng điều khiển  </title>
        <LINK href="dangnhap_skin/style.css" type=text/css rel=stylesheet>
        <script language="javascript" src="javascript/javascript.js"></script>
    </head>
    <body leftmargin="0" topmargin="0">
        <?php
            switch (trim($_GET["view"])) {

                case "":
                    include_once("com_login.login.php");
                    break;

                case "login":
                    include_once("com_login.login.php");
                    break;

                case "logout":
                    include_once("com_login.logout.php");
                    break;

                default:
                    include_once("com_login.login.php");
                    break;

            }
        ?>
    </body>
</html>
