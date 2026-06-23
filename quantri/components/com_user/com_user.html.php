<?php defined( '_VALID_MOS' ) or die( include("404.php") );
    include_once("com_user.process.php");	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Bảng điều khiển </title>

        <link href="css/icon.css" rel="stylesheet" type="text/css" />
        <link href="css/template.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/rounded.css" />

        <!--[if IE 7]>
        <link href="css/ie7.css" rel="stylesheet" type="text/css" />
        <![endif]-->

        <!--[if lte IE 6]>
        <link href="css/ie6.css" rel="stylesheet" type="text/css" />
        <![endif]-->

        <script language="javascript" src="javascript/javascript.js"></script>

        <script type="text/javascript" src="javascript/mootools.js"></script>
        <script type="text/javascript" src="javascript/menu.js"></script>
        <script type="text/javascript" src="javascript/index.js"></script>
        <script language="javascript" type="text/javascript" src="calendar/popcalendar.js"></script>
        <?php if( trim($GLOBALS['msg']) != "" ){ 
                echo "<script type=\"text/javascript\">alert('".$GLOBALS['msg']."');</script>"; 
        } ?>

    </head>
    <body id="minwidth-body">
        <?php include("$com_folder/com_header/com_header.html.php");?>
        <?php

            if($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator" || $_SESSION["session"]["key"] == "Manager"){

                switch (trim($_GET["view"])) {

                    case "":
                        include_once("404.php");
                        break;

                    case "view":
                        include_once("com_user.view.php");
                        break;

                    case "edit.user":
                        include_once("com_user.edit.user.php");
                        break;

                    case "edit.admin":
                        include_once("com_user.edit.admin.php");
                        break;

                    case "add":
                        include_once("com_user.add.php");
                        break;

                    default:
                        include_once("404.php");
                        break;

                }

            } else {
                switch (trim($_GET["view"])) {

                    case "":
                        include_once("404.php");
                        break;

                    case "edit.admin":
                        include_once("com_user.edit.admin.php");
                        break;

                    default:
                        include_once("404.php");
                        break;

                }
            }
        ?>
        <?php include("$com_folder/com_footer/com_footer.html.php");?>
    </body>
</html>