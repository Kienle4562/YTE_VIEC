<?php defined( '_VALID_MOS' ) or die( include("404.php") ); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta name="robots" content="index, follow" />

        <title>Bảng điều khiển</title>	

        <link href="css/icon.css" rel="stylesheet" type="text/css" />

        <link href="css/template.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="css/rounded.css" />

        <link rel="stylesheet" type="text/css" href="css/type.css" />



        <!--[if IE 7]>

        <link href="css/ie7.css" rel="stylesheet" type="text/css" />

        <![endif]-->



        <!--[if lte IE 6]>

        <link href="css/ie6.css" rel="stylesheet" type="text/css" />

        <![endif]-->

        <script type="text/javascript" src="javascript/mootools.js"></script>

        <script type="text/javascript" src="javascript/menu.js"></script>

        <script type="text/javascript" src="javascript/index.js"></script>



    </head>

    <body id="minwidth-body">

        <?php 

		include("$com_folder/com_header/com_header.html.php");

		include("com_panel.models.php");

        $myprocess = new com_panel_process();

		?>	

        <div id="content-box">

            <div class="border">

                <div class="padding">

                    <div id="element-box">





                        <div class="t">

                            <div class="t">

                                <div class="t"></div>

                            </div>

                        </div>





                        <div class="m">

                            <!-----------------------------

                            <!-- Right Column

                            <!-------------------------- -->

                            <div style="float: right; width: 29%;">



                                <!-------------------------

                                <!-- Web knowledge & news

                                <!---------------------- -->

                                <div class="pane-sliders" style="margin-bottom: 13px;">

                                    <div class="panel">

                                        <h3 class="title jpane-toggler-down">

                                            <span>Modules TOP</span>

                                        </h3>

                                        <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding-top: 0px; padding-bottom: 0px;" class="jpane-slider content">

                                            <ul class="news_list news">

                                            	<?php

													$rs_modules = $myprocess->getmoduletop();								

													while($r_modules = $rs_modules->fetch())

													{

												?>

                                                <li class="row_tip">

                                                	<a title="<?php echo $r_modules["title"] ?>" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/module/<?php echo $r_modules["module"] ?>/<?php echo $r_modules["module_id"].".html" ?>" target="_blank"> <?php echo $r_modules["title"]." (".$r_modules["module"].")" ?></a> - 

                                                	<?php

														if($r_modules["enabled"]==1){

															echo "<span style='color:green'>Đang bật</span>";

														}else{echo "<span style='color:red'>Đã tắt</span>";}

													?>

                                                </li>

                                            	<?php } ?>

                                            </ul>

                                        </div>

                                    </div>
                                    
                                    <div class="panel">

                                        <h3 class="title jpane-toggler-down">

                                            <span style="color:#F00">Modules Giữa</span>

                                        </h3>

                                        <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding-top: 0px; padding-bottom: 0px;" class="jpane-slider content">

                                            <ul class="news_list news">

                                            	<?php

													$rs_modules = $myprocess->getmodulegiua();								

													while($r_modules = $rs_modules->fetch())

													{

												?>

                                                <li class="row_tip">

                                                	<a title="<?php echo $r_modules["title"] ?>" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/module/<?php echo $r_modules["module"] ?>/<?php echo $r_modules["module_id"].".html" ?>" target="_blank"> <?php echo $r_modules["title"]." (".$r_modules["module"].")" ?></a> - 

                                                	<?php

														if($r_modules["enabled"]==1){

															echo "<span style='color:green'>Đang bật</span>";

														}else{echo "<span style='color:red'>Đã tắt</span>";}

													?>

                                                </li>

                                            	<?php } ?>

                                            </ul>

                                        </div>

                                    </div>
									<div class="panel">

                                        <h3 class="title jpane-toggler-down">

                                            <span>Modules Dưới Cùng</span>

                                        </h3>

                                        <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding-top: 0px; padding-bottom: 0px;" class="jpane-slider content">

                                            <ul class="news_list news">

                                            	<?php

													$rs_modules = $myprocess->getmoduleduoi();								

													while($r_modules = $rs_modules->fetch())

													{

												?>

                                                <li class="row_tip">

                                                	<a title="<?php echo $r_modules["title"] ?>" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/module/<?php echo $r_modules["module"] ?>/<?php echo $r_modules["module_id"].".html" ?>" target="_blank"> <?php echo $r_modules["title"]." (".$r_modules["module"].")" ?></a> - 

                                                	<?php

														if($r_modules["enabled"]==1){

															echo "<span style='color:green'>Đang bật</span>";

														}else{echo "<span style='color:red'>Đã tắt</span>";}

													?>

                                                </li>

                                            	<?php } ?>

                                            </ul>

                                        </div>

                                    </div>
                                    <div class="panel">

                                        <h3 class="title jpane-toggler-down">

                                            <span>Modules Cột Trái</span>

                                        </h3>

                                        <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding-top: 0px; padding-bottom: 0px;" class="jpane-slider content">

                                            <ul class="news_list news">

                                            	<?php

													$rs_modules = $myprocess->getmoduletrai();								

													while($r_modules = $rs_modules->fetch())

													{

												?>

                                                <li class="row_tip">

                                                	<a title="<?php echo $r_modules["title"] ?>" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/module/<?php echo $r_modules["module"] ?>/<?php echo $r_modules["module_id"].".html" ?>" target="_blank"> <?php echo $r_modules["title"]." (".$r_modules["module"].")" ?></a> - 

                                                	<?php

														if($r_modules["enabled"]==1){

															echo "<span style='color:green'>Đang bật</span>";

														}else{echo "<span style='color:red'>Đã tắt</span>";}

													?>

                                                </li>

                                            	<?php } ?>

                                            </ul>

                                        </div>

                                    </div>
                                    <div class="panel">

                                        <h3 class="title jpane-toggler-down">

                                            <span>Modules Cột Phải</span>

                                        </h3>

                                        <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding-top: 0px; padding-bottom: 0px;" class="jpane-slider content">

                                            <ul class="news_list news">

                                            	<?php

													$rs_modules = $myprocess->getmodulephai();								

													while($r_modules = $rs_modules->fetch())

													{

												?>

                                                <li class="row_tip">

                                                	<a title="<?php echo $r_modules["title"] ?>" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/module/<?php echo $r_modules["module"] ?>/<?php echo $r_modules["module_id"].".html" ?>" target="_blank"> <?php echo $r_modules["title"]." (".$r_modules["module"].")" ?></a> - 

                                                	<?php

														if($r_modules["enabled"]==1){

															echo "<span style='color:green'>Đang bật</span>";

														}else{echo "<span style='color:red'>Đã tắt</span>";}

													?>

                                                </li>

                                            	<?php } ?>

                                            </ul>

                                        </div>

                                    </div>
                                    <div class="panel">

                                        <h3 class="title jpane-toggler-down">

                                            <span>Modules vị trí khác</span>

                                        </h3>

                                        <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding-top: 0px; padding-bottom: 0px;" class="jpane-slider content">

                                            <ul class="news_list news">

                                            	<?php

													$rs_modules = $myprocess->getmodulekhac();								

													while($r_modules = $rs_modules->fetch())

													{

												?>

                                                <li class="row_tip">

                                                	<a title="<?php echo $r_modules["title"] ?>" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/module/<?php echo $r_modules["module"] ?>/<?php echo $r_modules["module_id"].".html" ?>" target="_blank"> <?php echo $r_modules["title"]." (".$r_modules["module"].")" ?></a> - 

                                                	<?php

														if($r_modules["enabled"]==1){

															echo "<span style='color:green'>Đang bật</span>";

														}else{echo "<span style='color:red'>Đã tắt</span>";}

													?>

                                                </li>

                                            	<?php } ?>

                                            </ul>

                                        </div>

                                    </div>
                                </div>

                                <!-------------------------

                                <!-- {/} Web knowledge & news

                                <!---------------------- -->                               



                            </div>

                            <!-----------------------------

                            <!-- {/} Right Column

                            <!-------------------------- -->





                            <!-----------------------------

                            <!-- Left Column

                            <!-------------------------- -->

                            <div style="float: left; width: 70%">



                                <!-------------------------

                                <!-- Quick Statistics

                                <!---------------------- -->

                                <?php

                                    

                                    $result = $myprocess->get_statistics($lang);								

                                    while($row = $result->fetch())

                                    {

                                ?>



                                <div id="statistics" style="margin-bottom: 13px;">

                                    <div class="pane-sliders">

                                        <div class="panel">

                                            <h3 class="title jpane-toggler-down">

                                                <span>Thống kê</span>

                                            </h3>

                                            <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding: 10px;" class="jpane-slider content">

                                                <div class="quick-stats" style="text-align: center;">

                                                    <a href=".?com=com_order&view=master">

                                                        <span class="counter-number"><?php echo intval($row["cart_count"]); ?></span> Đơn đặt hàng mới

                                                    </a>

                                                    &nbsp;&nbsp;&nbsp;&nbsp;

                                                    <a href=".?com=com_content&view=news&task=view">

                                                        <span class="counter-number"><?php echo intval($row["article_count"]); ?></span> Bài viết

                                                    </a>

                                                    &nbsp;&nbsp;&nbsp;&nbsp;

                                                    <a href=".?com=com_product&view=product&task=view">

                                                        <span class="counter-number"><?php echo intval($row["product_count"]); ?></span> Sản phẩm

                                                    </a>

                                                    &nbsp;&nbsp;&nbsp;&nbsp;

                                                    <a href=".?com=com_product&view=category&task=view">

                                                        <span class="counter-number"><?php echo intval($row["product_category_count"]); ?></span> Danh mục Sản phẩm

                                                    </a>

                                                    &nbsp;&nbsp;&nbsp;&nbsp;

                                                    <a href=".?com=com_contact&view=master">

                                                        <span class="counter-number"><?php echo intval($row["contact_count"]); ?></span> Liên hệ mới

                                                    </a>

                                                </div>

                                                <!--

                                                <div class="server-info">

                                                    <div style="width: 48%; float: left; border: solid 1px #ddd; padding: 3px 5px; text-align: left; background: #F1FFD9; background: url('images/domain.png') 5px 50% no-repeat; text-indent: 25px;">

                                                        <strong>Ngày đăng ký hosting:</strong> 01/11/2011, <strong>ngày hết hạn:</strong> 01/11/2012

                                                    </div>

                                                    <div style="width: 48%; float: right; border: solid 1px #ddd; padding: 3px 5px; text-align: left; background: #FFEFEA; background: url('images/host.png') 5px 50% no-repeat; text-indent: 25px;">

                                                        <strong>Ngày đăng ký domain:</strong> 01/12/2010, <strong>ngày hết hạn:</strong> 01/12/2011

                                                    </div>

                                                    <div class="clr"></div>

                                                </div>

                                                -->

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <?php } ?>

                                <!-------------------------

                                <!-- {/} Quick Statistics

                                <!---------------------- -->





                                <div class="clr"></div>







                                <!-------------------------

                                <!-- Quick Notes

                                <!---------------------- -->

                                <div id="statistics" style="margin-bottom: 13px;">

                                    <div class="pane-sliders">

                                        <div class="panel">

                                            <?php

                                                if (!empty($_POST) && $_POST['task'] == 'save_quick_notes')

                                                {

                                                    $_APP['quick_notes'][$_SESSION['session']['uid']] = $_POST['notes'];

                                                    application_end();

                                                    $core_class->_redirect('.');

                                                }

                                            ?>

                                            <h3 class="title jpane-toggler-down">

                                                <span>Ghi chú nhanh</span>

                                            </h3>

                                            <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding: 10px;" class="jpane-slider content">

                                                <form name="quickNotes" method="post">

                                                    <textarea name="notes" style="width:100%; height: 150px;"><?php

                                                            echo $_APP['quick_notes'][$_SESSION['session']['uid']];

                                                    ?></textarea>

                                                    <div style="text-align:right; padding-top: 5px;">

                                                        <input type="submit" value="Lưu ghi chú" />

                                                    </div>

                                                    <input type="hidden" name="task" value="save_quick_notes" />

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-------------------------

                                <!-- {/} Quick Notes

                                <!---------------------- -->





                                <div class="clr"></div>





                                <!-------------------------

                                <!-- Control Panel

                                <!---------------------- -->

                                <div style="margin-bottom: 13px;">

                                    <div class="pane-sliders">

                                        <div class="panel">

                                            <h3 class="title jpane-toggler-down">

                                                <span>Truy cập nhanh</span>

                                            </h3>

                                            <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding: 10px;" class="jpane-slider content">

                                                <div id="cpanel">

                                                    <?php



                                                        if ($_SESSION["session"]["key"] == "Supper Administrator"

                                                            || $_SESSION["session"]["key"] == "Administrator")

                                                        { 

                                                            $buttons = array(	array('text' => 'Quản lý Bài viết', 

                                                                    'link' => '.?com=com_content&view=news&task=view', 

                                                                    'icon' => 'template/header_icons/icon-48-news.png' ),



                                                                array('text' => 'Thêm Bài viết', 

                                                                    'link' => '.?com=com_content&view=news&task=add', 

                                                                    'icon' => 'template/header_icons/icon-48-news-add.png' ),



                                                                array('text' => 'Quản lý Sản phẩm', 

                                                                    'link' => '.?com=com_product&view=product&task=view', 

                                                                    'icon' => 'template/header_icons/icon-48-product.png' ),



                                                                array('text' => 'Thêm Sản phẩm', 

                                                                    'link' => '.?com=com_product&view=product&task=add', 

                                                                    'icon' => 'template/header_icons/icon-48-product-add.png' ),



                                                                array('text' => 'Xem nội dung liên hệ', 

                                                                    'link' => '.?com=com_contact&view=master', 

                                                                    'icon' => 'template/header_icons/icon-48-contact.png' )

                                                            );

                                                        }

                                                        else 

                                                        {

                                                            echo 'Bạn không có quyền thao tác trên hệ thống này!';

                                                        } 



                                                        $totalButton = count($buttons);



                                                        for ($i = 0; $i < $totalButton; $i++)

                                                        {

                                                            echo <<<EOL

														<div style="float: left;">

															<div class="icon">

																<a href="{$buttons[$i]['link']}">

																	<img src="{$buttons[$i]['icon']}" alt="{$buttons[$i]['text']}">

																	<span>{$buttons[$i]['text']}</span>

																</a>

															</div>

														</div>

EOL;

                                                        }



                                                    ?>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-------------------------

                                <!-- {/} Control Panel

                                <!---------------------- -->





                                <div class="clr"></div>





                                <!-------------------------

                                <!-- Bottom News

                                <!---------------------- -->

                                <!--

                                <div id="bottom_news">

                                    <div class="pane-sliders" style="margin-bottom: 13px; float: left; width: 49%;">

                                        <div class="panel">

                                            <h3 class="title jpane-toggler-down">

                                                <span>Trợ giúp: Vấn đề thường gặp</span>

                                            </h3>

                                            <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding-top: 0px; padding-bottom: 0px;" class="jpane-slider content">

                                                <ul class="news_list news">

                                                    <li class="row_tip"><a href="#">Đăng ký gói giải pháp bán hàng trực tuyến</a></li>

                                                    <li class="row_tip"><a href="#">Đăng ký tên miền trực tuyến</a></li>

                                                    <li class="row_tip"><a href="#">Đăng ký quảng cáo Google Adwords</a></li>

                                                    <li class="row_tip"><a href="#">Đăng ký dịch vụ thiết kế web đồ họa</a></li>

                                                    <li class="row_tip"><a href="#">Đăng nhập hệ thống quản trị</a></li>

                                                    <li class="row_tip"><a href="#">Các dịch vụ MiềnTây24h WebShop cung cấp</a></li>

                                                    <li class="row_tip"><a href="#">MiềnTây24h WebShop là gì?</a></li>

                                                    <li class="row_tip"><a href="#">Lý do lựa chọn MiềnTây24h WebShop</a></li>

                                                    <li class="row_tip"><a href="#">Quy định sử dụng</a></li>

                                                    <li class="row_tip"><a href="#">Chính sách bảo mật</a></li>

                                                </ul>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="pane-sliders" style="margin-bottom: 13px; float: right; width: 49%;">

                                        <div class="panel">

                                            <h3 class="title jpane-toggler-down">

                                                <span>Email makerting</span>

                                            </h3>

                                            <div style="border-top: medium none; border-bottom: medium none; overflow: hidden; padding-top: 0px; padding-bottom: 0px;" class="jpane-slider content">

                                                <ul class="news_list news">

                                                    <li class="row_tip"><a href="#">Những mong đợi sai lầm khi Maketers sử dụng email</a></li>

                                                    <li class="row_tip"><a href="#">Chiến lược từ khâu soạn email marketing</a></li>

                                                    <li class="row_tip"><a href="#">Người dùng email marketing cần biết</a></li>

                                                    <li class="row_tip"><a href="#">Cách soạn email marketing hiệu quả</a></li>

                                                    <li class="row_tip"><a href="#">Email marketing – Ưu, Nhược, Ngộ</a></li>

                                                    <li class="row_tip"><a href="#">6 cách để subscriber trung thành với email của bạn</a></li>

                                                    <li class="row_tip"><a href="#">Email marketing: Con số thống kê và chiến lược mới cho email marketing</a></li>

                                                    <li class="row_tip"><a href="#">Welcome email – Bài giới thiệu 30s trong email …</a></li>

                                                    <li class="row_tip"><a href="#">5 ý tưởng quà tặng để tăng database khách hàng</a></li>

                                                    <li class="row_tip"><a href="#">Welcome Email – Lời chào cao hơn mâm cỗ!</a></li>

                                                </ul>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                -->

                                <!-------------------------

                                <!-- {/} Bottom News

                                <!---------------------- -->



                            </div>

                            <!-----------------------------

                            <!-- {/} Right Column

                            <!-------------------------- -->

                            <div class="clr"></div>

                        </div>





                        <div class="b">

                            <div class="b">

                                <div class="b"></div>

                            </div>

                        </div>





                    </div>

                    <noscript>

                        !Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị

                    </noscript>

                    <div class="clr"></div>

                </div>

            </div>

        </div>

        <div id="border-bottom"><div><div></div></div></div>

        <?php include("$com_folder/com_footer/com_footer.html.php");?>

    </body>

</html>