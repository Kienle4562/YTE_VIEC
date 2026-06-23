<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_customhtml.models.php"); 
	
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
<div class="bg_gach2ben f_xs_none m_xs_bottom_10 fix_style_font t_align_c m_top_20 m_bottom_20">
    <h1 class="tieudeh1 fw_ex_bold">
        <?php echo $module_title; ?>
        <?php $this->add_component_translate_button($row['module']); ?>
    </h1>
</div>
<div class="<?php if (!empty($params['class'])) echo $params['class']; ?>">
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-body">
        	<?php if (is_array($params)) { echo $params['content']; } ?>
		</div>  
    </div>                  
</div>