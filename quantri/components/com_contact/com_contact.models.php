<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    // <--2
    class process_contact
    {
        private $dbObj;
        
        function __construct()
        {
            $this->dbObj = new classDb();
        }
        
        public function add_contact($name, $email, $company, $telephone, $fax, $address, $title, $content)
        {
            return $this->dbObj->SqlQueryInputResult(
                "INSERT INTO 
                        `contact` (name, email, company, phone, fax, address, title, content, date_add, status)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
                array($name, $email, $company, $telephone, $fax, $address, $title, $content, time(), 0)
            );
        }
        
        public function render_client_information($raw = false)
        {
            $name           =   $_POST['name'];
            $email          =   $_POST['email'];
            $company        =   $_POST['company'];
            $telephone      =   $_POST['telephone'];
            $fax            =   $_POST['fax'];
            $address        =   $_POST['address'];
            $title          =   $_POST['title'];
            $content        =   $_POST['content'];
            
            $_html = array();
            
            $_html['html'] = <<<CI
                <table class="user_information" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="col_1">Họ và tên <span class="warning">*</span></td>
                        <td class="col_2">{$name}&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="col_1">Email <span class="warning">*</span></td>
                        <td class="col_2">{$email}&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="col_1">Công ty</td>
                        <td class="col_2">{$company}&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="col_1">Số điện thoại</td>
                        <td class="col_2">{$telephone}&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="col_1">Fax</td>
                        <td class="col_2">{$fax}&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="col_1">Địa chỉ</td>
                        <td class="col_2">{$address}&nbsp;</td>
                    </tr>
                    
                    <tr>
                        <td class="col_1">Tiêu đề <span class="warning">*</span></td>
                        <td class="col_2">{$title}&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="col_1">Nội dung <span class="warning">*</span></td>
                        <td class="col_2">{$content}&nbsp;</td>
                    </tr>
                </table>
CI;
            if ($raw)
            {
                $_html['text'] = <<<CI
                    Họ và tên: {$name}
                    Email: {$email}
                    Công ty: {$company}
                    Số điện thoại: {$telephone}
                    Fax: {$fax}
                    Địa chỉ: {$address}
                    Tiêu đề: {$title}
                    Nội dung: {$content}
CI;
            }
            
            return $_html;
        }
        
        public function send_email($client_information, $to)
        {
            $_html_mail = ' 
                <html>
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                        <title>Thông tin liên hệ</title>
                        <style type="text/css">
                            body{font-family:Tahoma, sans-serif;font-size:12px;margin:0;padding:10px;}.container{display:block;width:712px;background:#F9FCFE;border:solid 1px #ddd;margin:10px auto;padding:0;}.container .content{display:block;padding:0 10px 10px;}.title{display:block;font-size:16px;font-weight:bold;background:#F5FAFE;line-height:32px;text-align:center;border-bottom:solid 1px #ddd;color:#549DC7;}p{font-weight:bold;font-size:12px;text-align:left;display:block;width:690px;color:#549DC7;margin:10px 0;padding:0;}.com_cart table.cart{width:690px;border-top:solid 1px #ddd;border-left:solid 1px #ddd;background:white;margin:10px 0 0;}.com_cart table.cart td{border-bottom:solid 1px #ddd;border-right:solid 1px #ddd;padding:5px;}.com_cart table.cart thead td{font-weight:bold;text-decoration:underline;text-align:center!important;}.com_cart table.cart tfoot td{font-weight:bold;text-align:right!important;}.com_cart table.user_information{width:690px;border-top:solid 1px #ddd;border-right:solid 1px #ddd;}.com_cart table.user_information td{line-height:24px;border-left:solid 1px #ddd;border-bottom:solid 1px #ddd;background:white;}.com_cart table.user_information .col_1{width:200px;vertical-align:top;text-align:right;font-weight:bold;}.com_cart table.user_information .col_2{vertical-align:top;}.com_cart table.user_information input[type=text],.com_cart table.user_information textarea{width:300px;border:solid 1px #999;}.com_cart table.user_information textarea[name=information]{height:100px;}.com_cart table.user_information .col_2 label{color:red;display:block;padding-left:2px;}.com_cart table.user_information .warning{color:red;}.com_cart_order table.user_information td{padding:0 5px;}.com_cart_order table.user_information .col_1{text-align:left;width:130px;}.com_cart table.cart *,.com_cart table.user_information *{font-size:11px;}.com_cart table.cart .col_1,.com_cart table.cart .col_3,.com_cart table.user_information .information{text-align:center;}.com_cart table.cart .col_4,.com_cart table.cart .col_5,.com_cart table.cart .col_6{text-align:right;}
                        </style>
                    </head>
                    <body class="com_cart com_cart_order">
                        <div class="container">
                            <div class="title">THÔNG TIN LIÊN HỆ</div>
                            <div class="content">
                                <p>THÔNG TIN KHÁCH HÀNG</p>
                                ' . $client_information['html'] . '
                            </div>
                        </div>
                    </body>
                </html>';
                
            $_text_mail = $client_information['text'];
            
            date_default_timezone_set('Asia/Ho_Chi_Minh'); 

            require_once('libraries/mailler/class.phpmailer.php');
            require_once('libraries/mailler/class.smtp.php');

            $mail             = new PHPMailer();
            
            $mail->IsSMTP();
            $mail->SMTPDebug  = 2;                                 // enables SMTP debug information (for testing)
                                                                // 1 = errors and messages
                                                                // 2 = messages only
            $mail->SMTPAuth   = true;                              // enable SMTP authentication
            
            $mail->Host       = $_APP['config']['smtp']['host'];             // "221.133.1.59"; sets GMAIL as the SMTP server
            $mail->Port       = $_APP['config']['smtp']['port']; //465;                             // 25; set the SMTP port for the GMAIL server
            $mail->Username   = $_APP['config']['smtp']['username'];    // GMAIL username
            $mail->Password   = $_APP['config']['smtp']['password']; // GMAIL password
            
            $mail->SetFrom($_APP['APP']['config']['smtp']['username'], $_APP['APP']['config']['smtp']['display_name']);        // Định danh người gửi
            
            $mail->Subject    = 'Thông tin liên hệ - Khách hàng: ' . $_POST['name'];            // Tiêu đề Mail
            
            $mail->AltBody    = $_text_mail;                             // Để xem tin này, vui lòng bật tương thích chế độ hiển thị mã HTML!";
                                                                // optional, comment out and test
            
            $mail->MsgHTML($_html_mail);

            $mail->AddAddress($to);                 //Gửi tới ai ?
            
            if(!$mail->Send()) {
                echo $mail->ErrorInfo;
                return false;
            }
            else {
                return true;
            }
        }
    }
    // 2-->
    
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */
    
    if (!empty($_POST['do']))
    {
        // <--1.1
        switch ($_POST['do'])
        {
            //  ______________
            // |              |
            // |    Contact   |
            // |______________|
            //
            // <--1.1.1
            case 'contact':
            {				
                if (strtolower($_POST['cf_anti_spam']) == $_SESSION['randomnr2']){
					
                    if (!empty($_POST['cf_name'])
                            && !empty($_POST['cf_email'])
                            && $core_class->isValidEmail($_POST['cf_email'])
                            && !empty($_POST['cf_message']))
                    {
                        $myprocess = new process_contact();

                        $name           =   $_POST['cf_name'];
                        $email          =   $_POST['cf_email'];
                        $company        =   "undifined";
                        $telephone      =   "undifined";
                        $fax            =   "undifined";
                        $address        =   "undifined";
                        $title          =   $_POST['cf_subject'];
                        $content        =   $_POST['cf_message'];
                        
                        if ($myprocess->add_contact($name, $email, $company, $telephone, $fax, $address, $title, $content)) {
                            //$_html = $myprocess->render_client_information();
                            //if ($myprocess->send_email($_html, $_APP['config']['admin-email'])) {
								echo 1;
                            //} else {
							//	echo "-2";
							//}
                        } else {
							echo "-2";
						}
                    }
                    else {
                        echo "-2";
                    }
                }
                else {
                    echo "-1";
                }
            }
            break;
            // 1.1.1-->
        }
        // 1.1-->
    }
    // 1-->