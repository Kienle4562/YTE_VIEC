<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_tags.models.php"); 
	
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

<div class="m_bottom_45 m_xs_bottom_30">
    <h5 class="fw_light color_dark m_bottom_23">Tags</h5>
    <!--tags list-->
    <ul class="hr_list tags_list">
        <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium">thiet ke web can tho</a></li>
        <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium">thiet ke web soc trang</a></li>
        <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium">thiet ke web ca mau</a></li>
        <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium">marketing</a></li>
        <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium">press</a></li>
        <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium">projects</a></li>
        <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium">resources</a></li>
        <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium">tips</a></li>
        <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium">tricks</a></li>
        <li class="m_right_5 m_bottom_5"><a href="#" class="r_corners button_type_2 d_block color_dark color_pink_hover fs_medium">web</a></li>
    </ul>
</div>