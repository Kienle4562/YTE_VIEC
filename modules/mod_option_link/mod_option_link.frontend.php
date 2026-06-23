<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_option_link.models.php"); 
	
	if (empty($params) || $params == "undefine") {
        $params = array(           
            'class' => '',
			'content' => ''
        );
    }
    else {
        $params = unserialize($params);
    }
	
?>

<div class="m_bottom_40 m_xs_bottom_30">
    <?php if( !empty($module_title) ) { ?><h5 class="color_dark fw_light m_bottom_20"><?= $module_title; ?></h5><?php } ?>
    <ul class="categories_list">
        <li>
            <a href="#" class="color_dark tr_all d_block">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                Women
            </a>
            <ul class="fw_light d_none">
                <li>
                    <a href="#" class="d_block color_dark">
                    	<i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i>
                        <span class="d_inline_m">Dresses</span>
                    </a>                    
                </li>
                <li>
                    <a href="#" class="d_block color_dark">
                    	<i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_smal tr_inheritl"></i>
                        <span class="d_inline_m">Tops</span>
                    </a>
                    <ul class="fw_light fs_medium d_none">
                        <li>
                            <a href="#" class="d_block color_dark">
                            	<i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i>
                                <span class="d_inline_m">Casual</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Coctail</span></a>
                        </li>
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Summer</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Skirts</span></a>
                    <ul class="fw_light fs_medium d_none">
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Casual</span></a>
                        </li>
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Coctail</span></a>
                        </li>
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Summer</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Jeans</span></a>
                    <ul class="fw_light fs_medium d_none">
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Casual</span></a>
                        </li>
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Coctail</span></a>
                        </li>
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Summer</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Shorts</span></a>
                    <ul class="fw_light fs_medium d_none">
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Casual</span></a>
                        </li>
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Coctail</span></a>
                        </li>
                        <li>
                            <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 tr_inherit"></i><span class="d_inline_m">Summer</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="color_dark tr_all d_block">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                Men
            </a>
            <ul class="fw_light d_none">
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Dresses</span></a>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_smal tr_inheritl"></i><span class="d_inline_m">Tops</span></a>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Skirts</span></a>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Jeans</span></a>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Shorts</span></a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="color_dark tr_all d_block">
                <span class="icon_wrap_size_0 circle d_inline_m m_right_8 color_grey_light_5 tr_inherit">
                    <i class="icon-angle-right"></i>
                </span>
                Kids
            </a>
            <ul class="fw_light d_none">
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Dresses</span></a>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_smal tr_inheritl"></i><span class="d_inline_m">Tops</span></a>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Skirts</span></a>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Jeans</span></a>
                </li>
                <li>
                    <a href="#" class="d_block color_dark"><i class="icon-angle-right d_inline_m m_right_8 color_grey_light_5 fs_small tr_inherit"></i><span class="d_inline_m">Shorts</span></a>
                </li>
            </ul>
        </li>
    </ul>
</div>