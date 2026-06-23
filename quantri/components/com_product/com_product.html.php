<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    if ($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator")
    {
    	session_start();
        include_once("process/com_product.category.models.php"); ?>
        
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" >
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="robots" content="index, follow" />
                <title> Bảng điều khiển </title>

                <link href="css/icon.css" rel="stylesheet" type="text/css" />
                <link href="css/template.css" rel="stylesheet" type="text/css" />
                <link rel="stylesheet" type="text/css" href="css/rounded.css" />
                <link rel="stylesheet" type="text/css" href="css/type.css" />
                <link rel="stylesheet" href="css/modal.css" type="text/css" />
                 <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap-tagsinput.css" />
                <link href="../calendar/css/dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" media="screen" />

                <!--[if IE 7]>
                <link href="css/ie7.css" rel="stylesheet" type="text/css" />
                <![endif]-->

                <!--[if lte IE 6]>
                <link href="css/ie6.css" rel="stylesheet" type="text/css" />
                <![endif]-->
				  <script src="bootstrap/jquery.min.js" type="text/javascript"></script>
				<script type="text/javascript" src="bootstrap/bootstrap.min.js"></script>
                <script type="text/javascript" src="bootstrap/bootstrap-tagsinput.js"></script>
                <script src="javascript/jquery.js" type="text/javascript"></script> 
                <script language="javascript" src="javascript/javascript.js"></script>	
                <script type="text/javascript" src="javascript/mootools.js"></script>
                <script type="text/javascript" src="javascript/menu.js"></script>
                <script type="text/javascript" src="javascript/index.js"></script>	
                <script language="javascript" type="text/javascript" src="calendar/popcalendar.js"></script>
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

            </head>
            <body id="minwidth-body">
                <?php

                    include("$com_folder/com_header/com_header.html.php");

                    switch (trim($_GET["view"])) 
                    {	
                        case "":
                            include_once("404.php");
                            break;

                        case "category":
                        $roles = $_SESSION["session"]["key"];
                        switch ( $roles ) 
                        {
                            case "Supper Administrator":
                            case "Administrator":
                            switch (trim($_GET["task"])) 
                            {
                                case "":
                                    include_once("process/com_product.category.view.models.php");
                                    include_once("category/com_product.category.view.admin.php");
                                    break;
                                case "view":
                                    include_once("process/com_product.category.view.models.php");
                                    include_once("category/com_product.category.view.admin.php");
                                    break;
                                case "add":
                                    include_once("process/com_product.category.add.models.php");
                                    include_once("category/com_product.category.add.admin.php");
                                    break;
                                case "edit":
                                    include_once("process/com_product.category.edit.models.php");
                                    include_once("category/com_product.category.edit.admin.php");
                                    break;
                                default:
                                    include_once("process/com_product.category.view.models.php");
                                    include_once("category/com_product.category.view.admin.php");
                                    break;
                            }
                            break;
                        }
                        break;

                        case "product":
                        $roles = $_SESSION["session"]["key"];
                        switch ( $roles ) 
                        {
                            case "Supper Administrator":
                            case "Administrator":        
                            switch (trim($_GET["task"])) 
                            {
                                case "add":
                                    include_once("process/com_product.product.add.admin.models.php");
                                    include_once("product/com_product.product.add.admin.php");
                                    break;
                                case "edit":
                                    include_once("process/com_product.product.edit.admin.models.php");
                                    include_once("product/com_product.product.edit.admin.php");
                                    break;
                                case "copy":
                                    include_once("process/com_product.product.copy.admin.models.php");
                                    include_once("product/com_product.product.copy.admin.php");
                                    break;
                                case "view":
                                default:
                                    include_once("process/com_product.product.view.admin.models.php");
                                    include_once("product/com_product.product.view.admin.php");
                                    break;
							 case "auto":
                                default:
                                   // include_once("process/com_product.product.add.admin.models.php");
                                    include_once("product/com_product.product.auto.admin.php");
                                    break;
                            }
                            break;
                        }
                        break;

                        case "comment":
                        $roles = $_SESSION["session"]["key"];
                        switch ( $roles ) 
                        {
                            case "Supper Administrator":
                            case "Administrator":		
                            switch (trim($_GET["task"])) 
                            {
                                /*case "add":
                                    include_once("process/com_product.product.add.admin.models.php");
                                    include_once("product/com_product.product.add.admin.php");
                                    break;
                                case "edit":
                                    include_once("process/com_product.product.edit.admin.models.php");
                                    include_once("product/com_product.product.edit.admin.php");
                                    break;
                                case "copy":
                                    include_once("process/com_product.product.copy.admin.models.php");
                                    include_once("product/com_product.product.copy.admin.php");
                                    break;*/
                                case "view":
                                default:
                                    include_once("process/com_product.comment.view.models.php");
                                    include_once("comment/com_product.comment.view.php");
                                    break;
                            }
                            break;
                        }
                        break;

                        default:
                            include_once("404.php");
                            break;
                    }
                ?>
                <?php include("$com_folder/com_footer/com_footer.html.php"); ?>
            </body>
        </html>
    <?php
    }
    else {
        include("404.php");
        exit();
    }