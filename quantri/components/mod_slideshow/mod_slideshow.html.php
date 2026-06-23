<?php defined( '_VALID_MOS' ) or die( include("404.php") );
    include_once("mod_slideshow.process.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="index, follow" />
        <title>Bảng điều khiển</title>

        <link href="css/icon.css" rel="stylesheet" type="text/css" />
        <link href="css/template.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="css/rounded.css" />
        <link rel="stylesheet" type="text/css" href="css/type.css" />
        <link rel="stylesheet" href="css/modal.css" type="text/css" />
        <link href="../calendar/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" media="screen" />


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
            function jSelectArticle(id, title, object) {
                document.getElementById(object + '_id').value = id;
                document.getElementById(object + '_name').value = title;
                document.getElementById('sbox-window').close();
            }
            window.addEvent('domready', function() {

                    SqueezeBox.initialize({});

                    $$('a.modal').each(function(el) {
                            el.addEvent('click', function(e) {
                                    new Event(e).stop();
                                    SqueezeBox.fromElement(el);
                            });
                    });
            });
        </script>
        <?php
            if( trim($GLOBALS['msg']) != "" )
            {
                echo "<script type=\"text/javascript\">alert('".$GLOBALS['msg']."');</script>"; 
            }
        ?>
    </head>
    <body id="minwidth-body">
        <?php
            include("$com_folder/com_header/com_header.html.php");

            switch (trim($_GET["view"])) {

                case "":
                    include_once("404.php");
                    break;

                case "folder":

                    switch (trim($_GET["task"])) {
                        case "":
                            include_once("folder/com_gallery.folder.view.php");
                            break;

                        case "view":
                            include_once("folder/com_gallery.folder.view.php");
                            break;

                        case "add":
                            include_once("folder/com_gallery.folder.add.php");
                            break;

                        case "edit":
                            include_once("folder/com_gallery.folder.edit.php");
                            break;

                        default:
                            include_once("folder/com_gallery.folder.view.php");
                            break;
                    }

                    break;

                case "detail":

                    switch (trim($_GET["task"])) {
                        case "":
                            include_once("detail/com_gallery.detail.view.php");
                            break;

                        case "view":
                            include_once("detail/com_gallery.detail.view.php");
                            break;

                        case "add":
                            include_once("detail/com_gallery.detail.add.php");
                            break;

                        case "edit":
                            include_once("detail/com_gallery.detail.edit.php");
                            break;

                        default:
                            include_once("detail/com_gallery.detail.view.php");
                            break;
                    }

                    break;		

                default:
                    include_once("404.php");
                    break;

            }

            include("$com_folder/com_footer/com_footer.html.php");
        ?>
    </body>
</html>
