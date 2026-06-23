<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

   	class process_contact
    {

        private $dbObj;        

        function __construct()
        {
            $this->dbObj = new classDb();
        }        

        public function add_contact($name,$username,$pass, $brithday, $address, $telephone, $email, $Date_add, $status)
        {
            return $this->dbObj->SqlQueryInputResult(
                "INSERT INTO 
                        `dangky` (Name,username,password, Brithday, Address, Phone, Email, Date_add, Status)
                        VALUES (?,?,?,?,?,?,?,?,?)", 
                array($name,$username,$pass, $brithday, $address, $telephone, $email, $Date_add, $status)
            );
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

            case 'dangky':
            {
                include('libraries/securimage/securimage.php');
                $captcha = new Securimage();                

                if ($captcha->check($_POST['captcha']) == true) {						

                    if (!empty($_POST['name'])
                            && !empty($_POST['email'])
                            && $core_class->isValidEmail($_POST['email'])
                            && !empty($_POST['datepicker'])
                            && !empty($_POST['telephone']))
                    {						

                        $myprocess = new process_contact();						

                        $name           =   $_POST['name'];
						$username		=	$_POST['username'];
						$pass			=   md5($_POST['password']);
						$brithday      	=	$core_class->_formatdate(date("d/m/y"),$_POST['datepicker']); 
						$address        =   $_POST['address'];
						$telephone      =   $_POST['telephone'];
                        $email          =   $_POST['email'];
                        /*$company        =   $_POST['company'];*/

						$date			= time();
                        $status				= 1;                        

                        if ($myprocess->add_contact($name,$username,$pass, $brithday, $address, $telephone, $email,$date, $status)) {
							$_SESSION['contact_success_message'] = $lang_text['msg_success'];
							$core_class->_redirect($GLOBALS['INDEX'] . 'dang-ky' . $GLOBALS['EXT']);
							exit();
                        }
                    }
                    else {
                        $_POST['error_message'] = $lang_text['msg_require_info'];
                    }
                }
                else {
                    $_POST['error_message'] = $lang_text['msg_wrong_captcha'];
                }
            }

            break;
            // 1.1.1-->
        }
        // 1.1-->
    }
    // 1-->