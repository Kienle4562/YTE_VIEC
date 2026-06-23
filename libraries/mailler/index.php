<?php ob_start(); ?>
<h1>TEST GỬI MAIL</h1>
<?php 
$htmlBody = ob_get_contents();
ob_end_clean();
?>
<html>
	<head>
		<title>Gửi mail bằng PHP qua SMTP (Gmail)</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
<body>
<?php
error_reporting(E_ALL);
error_reporting(E_STRICT);
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
$mail             = new PHPMailer();
$body             = $htmlBody;
$body             = eregi_replace("[\]",'',$body);
$mail->IsSMTP();
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.yandex.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "info@ohgroup.vn";  // GMAIL username
$mail->Password   = "@!01234567";            // GMAIL password
$mail->SetFrom('info@ohgroup.vn', 'OHGroup'); //Định danh người gửi
$mail->AddReplyTo("info@ohgroup.vn","OhGroup"); //Định danh người sẽ nhận trả lời
$mail->Subject    = "OH Group"; //Tiêu đề Mail
$mail->AltBody    = "Để xem tin này, vui lòng bật tương thích chế độ hiển thị mã HTML!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = "mtvtrung@gmail.com"; //Địa chỉ mail cần gửi tới
$mail->AddAddress($address, "hathanhtrung"); //Gửi tới ai ?
//$mail->AddAttachment("dinhkem/02.jpg");      // Đính kèm
//$mail->AddAttachment("dinhkem/200_100.jpg"); // Đính kèm
if(!$mail->Send()) {
  //echo "Lỗi gửi mail: " . $mail->ErrorInfo;
} else {
  echo "Mail đã được gửi!";
}
?>
</body>
</html>