<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_revoslider.models.php"); 
	
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
<!--revolution slider-->
<section class="relative w_full m_bottom_15">
    <div class="r_slider">
        <ul>
            <li data-transition="fade" data-slotamount="10">
               <img src="images/slider/main_slide_01.png" alt="" data-bgfit="cover" data-bgposition="center center">               
            </li>
            <li data-transition="fade" data-slotamount="10">
               <img src="images/slider/main_slide_02.png" alt="" data-bgfit="cover" data-bgposition="center center">               
            </li>
            <li data-transition="fade" data-slotamount="10">
               <img src="images/slider/main_slide_03.png" alt="" data-bgfit="cover" data-bgposition="center center">
            </li>
        </ul>
    </div>
</section>