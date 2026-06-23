<!DOCTYPE html>
<?php 
	$result = $core_class->getValueFrom2("trn_congty", "*", "congty_id = ".intval($_GET["id"]));
	$row = $result->fetch();
	$totalJob = $core_class->countColumnInTable("trn_congviec", "congviec_id", "WHERE congty_id =".intval($_GET["id"])." AND trn_congviec.draft_stt = 0 AND trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0" );
	if(empty($row)){
		include("404.php");
	}else{
?>
<html lang="en">
<head>
    <title><?php echo $row["tencongty"] ?> đang có <?php echo $totalJob ?> công việc. Ứng tuyển ngay!</title>
    <!-- Latest compiled and minified CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo $row["gioithieungan"] ?>">
    <meta name="keywords" content="Tìm kiếm công việc tại <?php echo $row["tencongty"] ?>">
    <meta name="author" content="Y Tế Việc giới thiệu việc làm tại <?php echo $row["tencongty"] ?>">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <meta name="format-detection" content="telephone=no">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo $index.$template_folder; ?>/css/app.css"/>     
    <meta property="og:image" content="<?php echo $row["hinhanh"] ?>">
    <meta property="og:image" content="<?php echo $row["banner"] ?>">
    <meta property="og:image:secure_url" content="<?php echo $row["banner"] ?>">
    <meta property="og:image:width" content="526"/>
    <meta property="og:image:height" content="275"/>
    <meta property="og:title" content="<?php echo $row["tencongty"] ?> đang có <?php echo $totalJob ?> công việc. Ứng tuyển ngay!">
    <meta property="og:description" content="<?php echo $row["gioithieungan"] ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $index.substr($_SERVER[REQUEST_URI], 1) ?>">
	<style>
        a{
            color: #0041c0;
        }
        .cp_follow_survey a{
            color: #fff;
        }
        .cp_our_job_item:hover h4 a{
            color: #0041c0;
        }
        .cp_job_view_detail a:hover{
            border-color: #0041c0;
            background-color: #0041c0;
            color: #fff;
        }
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover, .nav-tabs>li>a:hover{
            border-color: #0041c0;
            border-bottom-color: #ecf0f1;
        }
        .cp_follow_survey a.following{color: #0041c0 !important; border-color: #0041c0}
    </style>
</head>
	<?php
		include_once("components/com_congty/com_congty.html.php");
	?>
</body>
</html>
<?php }?>
