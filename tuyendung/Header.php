<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Trang quản trị Y Tế Việc">
    <meta name="keyword" content="Trang quản trị Y Tế Việc">
    <link rel="shortcut icon" href="image/icon.ico">
    <title>Trang quản trị Y Tế Việc</title>
	<script src="<?php echo $index ?>dist/assets/app/js/jquery.js"></script>
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
	<!--end::Web font -->
	<?php include_once("dist/myCSS.php");?>
</head>
	<!-- begin::Body -->
	<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<!-- begin::Page loader -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<!-- begin::Header -->
			<?php include_once("TopMenu.php"); ?>
			<!-- end::Header -->
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">