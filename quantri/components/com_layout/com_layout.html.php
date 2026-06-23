<?php defined( '_VALID_MOS' ) or die( include("404.php") ); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> Bảng điều khiển </title>

        <link href="css/icon.css" rel="stylesheet" type="text/css" />
        <link href="css/template.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/rounded.css" />
        <link rel="stylesheet" href="css/modal.css" type="text/css" />

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
        <script type="text/javascript" src="javascript/modal.js"></script>
        <script type="text/javascript">
            window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });
            window.addEvent('domready', function(){ new Accordion($$('.panel h3.jpane-toggler'), $$('.panel div.jpane-slider'), {onActive: function(toggler, i) { toggler.addClass('jpane-toggler-down'); toggler.removeClass('jpane-toggler'); },onBackground: function(toggler, i) { toggler.addClass('jpane-toggler'); toggler.removeClass('jpane-toggler-down'); },duration: 300,opacity: false,alwaysHide: true}); });
        </script>
    </head>
    <body id="minwidth-body">
        <?php
            if ($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator")
            {
                switch (trim($_GET["view"])) {
                	case "done":
                		$core_class->_redirect("./?com=com_layout");
                		exit();
                		break;

                    default:
                        include("$com_folder/com_header/com_header.html.php");
                        include("$com_folder/com_layout/process/com_layout.list.process.php");
                        include("$com_folder/com_layout/list/com_layout.list.html.php");
                        include("$com_folder/com_footer/com_footer.html.php");
                        break;
                }
            }
        ?>
    </body>
</html>