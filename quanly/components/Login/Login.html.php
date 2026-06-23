<?php defined( '_VALID_MOS' ) or die( include("404.php") ); 

    include("Login.process.php");

?>

<!DOCTYPE html>

<html lang="en" >

	<!-- begin::Head -->

	<head>

		<meta charset="utf-8" />

		<title>

			Trang quản trị Y Tế Việc

		</title>

		<meta name="keywords" content="Trang quản trị Y Tế Việc" />

		<meta name="description" content="Trang quản trị Y Tế Việc" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Web font -->

		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>

		<script>

          WebFont.load({

            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},

            active: function() {

                sessionStorage.fonts = true;

            }

          });

		</script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script src="dist/custom.js" type="text/javascript"></script>

		

		<link href="dist/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

		<link href="dist/assets/web/base/style.bundle.css" rel="stylesheet" type="text/css" />

		<link href="dist/custom.css?ver=<?php echo date("Y_m_d") ?>" rel="stylesheet" type="text/css" />

		<link rel="shortcut icon" href="image/logo.png" />

	</head>

	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >

        <?php

            switch ( trim( $conf['geturl']["view"] ) ) {

                case "":
					//echo $_SESSION["session"]["Tendangnhap"]."dddddd";
                    include_once("Login.login.php");

                    break;

                case "Login":
					//echo $_SESSION["session"]["Tendangnhap"]."wwwwww";
                    include_once("Login.login.php");

                    break;



                case "Logout":

                    include_once("Login.logout.php");

                break;



                default:

                    include_once("Login.login.php");

                break;

            }

        ?>

		

		<script src="dist/assets/vendors/base/vendors.bundle.js?ver=<?php echo date("dmY")?>" type="text/javascript"></script>

		<script src="dist/assets/web/base/scripts.bundle.js?ver=<?php echo date("dmY")?>" type="text/javascript"></script>

		<script src="dist/assets/snippets/pages/user/login.js?ver=<?php echo date("dmY")?>" type="text/javascript"></script>

		

    </body>

</html>

