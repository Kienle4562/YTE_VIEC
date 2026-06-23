<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); ?>
<!--<script type="text/javascript" src="<?php echo $index; ?>javascript/jquery-1.7.2.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="<?php echo $index; ?>javascript/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo $index; ?>javascript/jixedbar/themes/default/jx.stylesheet.css" />
<script type="text/javascript" src="<?php echo $index; ?>javascript/jixedbar/jquery.jixedbar.min.js"></script>
<script type="text/javascript" src="<?php echo $index; ?>javascript/jquery.fancybox-1.3.4/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo $index; ?>javascript/jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<script type="text/javascript">
    var DOMAIN = '<?php echo $_SERVER['SERVER_NAME']; ?>';
</script>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#demo-bar").jixedbar();
		jQuery(".jx-bar-button-right[id!='jx-hid-con-id'] li").unbind('click');
		jQuery(".fancybox").fancybox({
			'width'				: '90%',
			'height'			: '98%',
			'autoScale'			: false,
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'type'				: 'iframe',
			'onClosed'			: function() { window.location.reload(); }
		});
	}); 
</script>

<div id="demo-bar">
    <ul>
        <li title="Trang quản trị">
            <a href="<?php echo $index_backend; ?>">
                <img src="javascript/jixedbar/themes/icons/home.png" alt="" />
            </a>
        </li>
    </ul>
    <span class="jx-separator-left"></span>
    <ul>        
        <li title="Truy cập nhanh"><a href="#"><img src="javascript/jixedbar/themes/icons/link1.png" alt="Truy cập nhanh" /></a>
            <ul>
                <li>
                    <a href="<?php echo $index_backend; ?>?com=com_caidat&view=phone" alt="">
                        <img src="javascript/jixedbar/themes/icons/config.png" alt="" />&nbsp;&nbsp;&nbsp;Cấu hình hệ thống
                    </a>
                </li>
                <?php /*
                <li><a href="#" alt=""><img src="javascript/jixedbar/themes/icons/banner.png" alt="" />&nbsp;&nbsp;&nbsp;Thiết lập giao diện</a></li>
                <li><a href="#" alt=""><img src="javascript/jixedbar/themes/icons/template.png" alt="" />&nbsp;&nbsp;&nbsp;Thiết lập Logo & Banner</a></li>
                <li><a href="#" alt=""><img src="javascript/jixedbar/themes/icons/footer.png" alt="" />&nbsp;&nbsp;&nbsp;Thay đổi Footer</a></li>
                */ ?>
                <li>
                    <a href="<?php echo $index_backend; ?>?com=com_product&view=product&task=view" alt="">
                        <img src="javascript/jixedbar/themes/icons/product.png" alt="" />&nbsp;&nbsp;&nbsp;Quản lý sản phẩm
                    </a>
                </li>
                <li>
                    <a href="<?php echo $index_backend; ?>?com=com_order&view=master" alt="">
                        <img src="javascript/jixedbar/themes/icons/order.png" alt="" />&nbsp;&nbsp;&nbsp;Đơn đặt hàng
                    </a>
                </li>
                <li>
                    <a href="<?php echo $index_backend; ?>?com=com_content&view=news&task=view" alt="">
                        <img src="javascript/jixedbar/themes/icons/news2.png" alt="" />&nbsp;&nbsp;&nbsp;Quản lý tin tức
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <span class="jx-separator-left"></span>
    <ul>
        <li title="Thêm sản phẩm mới">
            <a href="<?php echo $index_backend; ?>?com=com_product&view=product&task=add">
                <img src="javascript/jixedbar/themes/icons/product.png" alt="" />&nbsp;&nbsp;&nbsp;Thêm sản phẩm mới
            </a>
        </li>			
    </ul>
    <span class="jx-separator-left"></span>
    <ul>
        <li title="Thêm tin mới">
            <a href="<?php echo $index_backend; ?>?com=com_content&view=news&task=add">
                <img src="javascript/jixedbar/themes/icons/addnews1.png" alt="" />&nbsp;&nbsp;&nbsp;Thêm tin mới
            </a>
        </li>					
    </ul>
    <span class="jx-separator-left"></span>
    <form name="modForm" method="post">
	    <ul class="jx-bar-button-right">
	        <li title="Thêm Module">
	            <input style="width:auto;margin:4px;-webkit-appearance: checkbox;box-sizing: border-box;" type="checkbox" name="allow_edit_module" value="1" onclick="document.forms['modForm'].submit()" <?php if ($GLOBALS['ADMIN_EDIT_MODULE']) { echo 'checked="checked"'; } ?> /><label for="allow_edit_module" onclick="jQuery('input[name=allow_edit_module]').attr('checked',!jQuery('input[name=allow_edit_module]').attr('checked')); document.forms['modForm'].submit()">Bật chỉnh sửa module</label>
	            <input type="hidden" name="task" value="092010" />
	        </li>
	    </ul>
    </form>
    <?php
        if ($GLOBALS['ADMIN_EDIT_MODULE'])
        {
            ?>
            <span class="jx-separator-right"></span>
            <ul class="jx-bar-button-right">
                <li title="Thêm Module">
                    <a class="fancybox" href="./module/mod_module.html?lang=<?php echo $GLOBALS['LANG']; ?>">
                        <img src="javascript/jixedbar/themes/icons/block.png" alt="" />&nbsp;&nbsp;&nbsp;Thêm Module
                    </a>
                </li>
            </ul>
            <?php
        }
    ?>
    <span class="jx-separator-right"></span>
    <ul class="jx-bar-button-right">
        <li title="Trợ giúp"><a href="#"><img src="javascript/jixedbar/themes/icons/group.png" alt="" />&nbsp;&nbsp;&nbsp;Trợ giúp</a>
            <ul>
                <li title="Trợ giúp">
                    <a href="javascript:void(0);" alt="">
                        <img src="javascript/jixedbar/themes/icons/help3.png" alt="" />&nbsp;&nbsp;&nbsp;Trợ giúp
                    </a>
                </li>
                <li>
                    <a href="#">
                        <img alt="" src="javascript/jixedbar/themes/icons/telephone.png">
                        &nbsp;<b>Hỗ trợ qua điện thoại</b>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HTKT: <b style="color: #DF490A;">0919 374 479</b>
                        
                    </a>
                </li>
               
            </ul>
        </li>
    </ul>				
    <span class="jx-separator-right"></span>
</div>