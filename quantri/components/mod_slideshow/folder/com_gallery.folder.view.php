<?php defined( '_VALID_MOS' ) or die( include("404.php") ); ?>

<div id="content-box">
    <div class="border">
        <div class="padding">
            <div id="toolbar-box">
                <div class="t">
                    <div class="t">
                        <div class="t"></div>
                    </div>
                </div>
                <div class="m">
                    <div class="toolbar" id="toolbar">
                        <table class="toolbar">
                            <tr>
                                <td class="button" id="toolbar-help">
                                    <a href="#" onclick="popupWindow('', 'Trợ giúp', 640, 480, 1)" class="toolbar">
                                        <span class="icon-32-help" title="Trợ giúp">
                                        </span>
                                        Trợ giúp
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="header icon-48-gallery">Modules » <small>[Trình diễn ảnh] » Danh sách</small></div>
                    <div class="clr"></div>
                </div>
                <div class="b">
                    <div class="b">
                        <div class="b"></div>
                    </div>
                </div>
            </div>
            <div class="clr"></div>
            <div id="element-box">
                <div class="t">
                    <div class="t">
                        <div class="t"></div>
                    </div>
                </div>
                <div class="m">
                    <form method="post" name="phpForm">
                        <table class="adminlist">
                            <thead>
                                <?php 
                                    $myprocess = new process();
                                    $result = $myprocess->get_mod_slideshow_list();
                                    $i = 0;
                                ?>
                                <tr>
                                    <th width="10">#</th>
                                    <th class="title"><a href="javascript:void(0)">Tiêu đề</a></th>
                                    <th width="10%"><a href="javascript:void(0)">Ngày thêm</a></th>
                                    <th width="10%"><a href="javascript:void(0)">Được hiển thị</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    while ($row = $result->fetch())
                                    {
                                        $i++;
                                        ?>
                                        <tr class="row0">
                                            <td align="center"><?php echo $i ?></td>
                                            <td>
                                            	<?php $core_class->create_lang_flag($row['lang_code'], 20); ?>
                                                <a href=".?com=mod_slideshow&view=detail&task=view&id=<?php echo $row['module_id'] ?>">
                                                    <?php echo $row['title'] ?>
                                                </a>
                                            </td>
                                            <td align="center"><?php echo date('d-m-Y', $row['date_add']); ?></td>
                                            <td align="center">
                                                <?php 
                                                    if ($row['enabled'] == 1)
                                                    { 
                                                        ?>
                                                        <span>
                                                            <img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
                                                        </span>
                                                        <?php 
                                                    } 
                                                    else
                                                    { 
                                                        ?>			
                                                        <span>
                                                            <img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
                                                        </span>
                                                        <?php 
                                                    }	
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </form>

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
        <div class="clr"></div>
    </div>
</div>
<div id="border-bottom"><div><div></div></div></div>