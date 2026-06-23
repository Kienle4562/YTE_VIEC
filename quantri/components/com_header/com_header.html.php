<?php defined( '_VALID_MOS' ) or die( include("404.php") ); ?>

<div id="border-top" class="h_green">
    <div>
        <div>
            <img src="images/logo.png" height="70" border="0" align="left" />
            <span class="version">
                <a href="./">Bảng điều khiển</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="../" target="_blank">Xem website</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href=".?com=com_user&view=view">Tài khoản quản trị</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
                <span>Chào mừng <strong><?php echo $_SESSION["session"]["fullname"]; ?></strong></span>
                <a href=".?com=com_user&view=edit.admin">[Thay đổi thông tin tài khoản]</a>&nbsp;
                <a href=".?com=com_login&view=logout">[Thoát]</a>
            </span>
            <span class="title">
                <span style="color: #ddd">|</span> <?php echo $_SERVER['SERVER_NAME']; ?>
            </span>
        </div>
    </div>
</div>

<div id="header-box">
    <div id="module-status">		

    </div>

    <div id="module-menu">

        <?php if ($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator") { ?>
            <ul id="menu">

                <li class="node"><a href=".">Bảng điều khiển</a></li>

                <li class="node"><a>Cấu hình website</a>
                    <ul>
                        <li style="width: 300px !important;">
                            <a class="icon-16-config" href="./?com=com_caidat&view=information">
                                Thiết lập
                                <span>
                                    Cấu hình một số thông tin cơ bản của website
                                </span>
                            </a>
                        </li>
                        <li style="width: 300px !important;">
                            <a class="icon-16-config" href="./?com=com_caidat&view=contact">
                                Thông tin liên hệ
                                <span>
                                    Cấu hình thông tin liên hệ
                                </span>
                            </a>
                        </li>
                        <?php if ($GLOBALS['MULTI_LANG']) { ?>
	                        <li style="width: 300px !important;">
	                            <a class="icon-16-config" href="./?com=com_languages&view=list">
	                                Ngôn ngữ
	                                <span>
	                                    Quản lý danh sách ngôn ngữ hiện tại của website
	                                </span>
	                            </a>
	                        </li>
	                    <?php } ?>
                    </ul>
                </li>

                <li class="node"><a>Giao diện</a>
                    <ul style="width: 300px;">
                        <li style="width: 300px !important;">
                            <a class="icon-16-menu" href=".?com=com_menu">
                                Quản lý Menu
                                <span>
                                    Chức năng quản lý menu của website
                                </span>
                            </a>
                        </li>
                        <li style="width: 300px !important;">
                            <a class="icon-16-menu" href=".?com=com_layout">
                                Bố cục website
                                <span>
                                    Tuỳ chọn bố cục cho từng trang của website
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="node"><a>Nội dung</a>
                    <ul style="width: 300px;">
                        <li>
                            <a class="icon-16-news-category" href=".?com=com_content&view=category&task=view">
                                Quản lý Nhóm tin
                                <span>
                                    Chức năng quản lý các nhóm tin tức của website, mỗi nhóm tin tức sẽ có nhiều bài viết tin tức
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="icon-16-news-news" href=".?com=com_content&view=news&task=view">
                                Quản lý tin tức
                                <span>
                                    Chức năng thêm, sửa, xoá và quản lý danh sách bài viết tin tức
                                </span>
                            </a>
                        </li>
                        <li class="separator"><span></span></li>
                        <li>
                            <a class="icon-16-news-add" href=".?com=com_content&view=news&task=add">
                                Thêm bài viết mới
                                <span>
                                    Chức năng viết bài tin tức
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                
               <!-- <li class="node"><a>Sản phẩm</a>
                    <ul style="width: 300px;">
                        <li>
                            <a class="icon-16-product-category" href=".?com=com_product&view=category&task=view">
                                Quản lý Danh mục sản phẩm
                                <span>
                                    Chức năng thêm, sửa, xoá danh sách Danh mục sản phẩm, mỗi danh mục sẽ có nhiều sản phẩm
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="icon-16-product-product" href=".?com=com_product&view=product&task=view">
                                Quản lý Sản phẩm
                                <span>
                                    Chức năng thêm, sửa, xoá thông tin và quản lý danh sách sản phẩm
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="icon-16-comment" href=".?com=com_product&view=comment&task=view">
                                Bình luận sản phẩm
                                <span>
                                    Chức năng xem và kiểm duyệt bình luận sản phẩm
                                </span>
                            </a>
                        </li>
                        <li class="separator"><span></span></li>
                        <li>
                            <a class="icon-16-product-product-add" href=".?com=com_product&view=product&task=add&sid=0&cid=0">
                                Thêm Sản phẩm
                                <span>
                                    Chức năng thêm mới một sản phẩm
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="icon-16-product-category" href=".?com=com_theloai">
                                Quản lý thể loại sản phẩm
                                <span>
                                    Chức năng thêm, sửa, xoá thể loại sản phẩm
                                </span>
                            </a>
                        </li>
                    </ul>
                </li> -->
                
                <li class="node"><a>Module</a>
                    <ul style="width: 300px;">
                        <li style="width: 300px !important;">
                            <a class="icon-16-gallery" href=".?com=mod_slideshow&view=folder&task=view">
                                Trình diễn ảnh
                                <span>
                                    Cập nhật ảnh cho các module trình diễn ảnh
                                </span>
                            </a>
                        </li>
                        <!--<li style="width: 300px !important;">
                            <a class="icon-16-gallery" href=".?com=com_gallery&view=folder">
                                Thư viện ảnh
                                <span>
                                    Cập nhật ảnh cho các module thư viện ảnh
                                </span>
                            </a>
                        </li> -->                       
                    </ul>
                </li>

                <li class="node"><a>Quản lý chung</a>
                    <ul style="width: 300px;">
                        <!--<li style="width: 300px !important;">
                            <a class="icon-16-product-cart" href=".?com=com_order&view=master">
                                Xem đơn đặt hàng
                                <span>
                                    Xem danh sách các đơn đặt hàng của khách
                                </span>
                            </a>
                        </li> -->
                        <li style="width: 300px !important;">
                            <a class="icon-16-contact" href=".?com=com_contact&view=master">
                                Danh sách liên hệ
                                <span>
                                    Xem các thông tin liên hệ do khách hàng gửi đến
                                </span>
                            </a>
                        </li>
                       <!-- <li style="width: 300px !important;">
                            <a class="icon-16-contact" href=".?com=com_user&view=view">
                                Quản lý tài khoản thành viên
                                <span>
                                    Xem các thông tin tài khoản thành viên
                                </span>
                            </a>
                        </li>  -->                                             
                    </ul>
                </li>

            </ul>
            <?php } else if ($_SESSION["session"]["key"] == "Administrator") {?>

            <?php } ?>

    </div>
    <div class="clr"></div>
</div>