<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_bathway.models.php"); 
    
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
<?php
    $url = $this->_extract_url($_GET['params'], '/');
    $icon = '<i class="icon-angle-right d_inline_m color_light fs_small"></i>';
    if($url[0]=="san-pham" || count($url)==4 || count($url)==2 || count($url)==1){
        $icon = "";
    }
?>
<section class="page_title_2 bg_light_2 t_align_c relative wrapper" style="margin-top: 0px;">
	<div class="container">
		<h3 class="color_dark fw_light m_bottom_5"><wti>{title}</wti></h3>
		<!--breadcrumbs-->
		<ul class="hr_list d_inline_m breadcrumbs">
			<li class="m_right_8 f_xs_none">
            	<a href="." class="color_dark d_inline_m m_right_10">Trang chủ</a>
            	<i class="icon-angle-right d_inline_m color_default fs_small"></i>
            </li>
            <wti>{pathway}</wti>
		</ul>
	</div>
</section>