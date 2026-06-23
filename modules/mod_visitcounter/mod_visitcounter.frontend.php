<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    include_once('mod_visitcounter.models.php');
    $myprocess = new process_mod_visitcounter();
    
    $lang_text = $this->load_module_language($row['module'], $GLOBALS['LANG']);
    
    if (empty($params) || $params == "undefine") {
        $params = array(
            'today' => 1,
			'yesterday' => 1,
			'thisweek' => 1,
			'thismonth' => 1,
			'all' => 1,
			'online' => 1
        );
    }
    else {
        $params = unserialize($params);
    } 
?>
<nav class="d_inline_m m_right_10 m_xs_right_0 text_right f_right">
                    <ul class="hr_list stripe_list fs_small">
                        <li><a href="javascript:void(0);" class="color_dark ">Thông tin</a></li>
                        <li><a href="javascript:void(0);" class="color_dark ">Liên hệ</a></li>
                        <li><a href="javascript:void(0);" class="color_dark ">Trợ giúp</a></li>
                        <li><a href="javascript:void(0);" class="color_dark ">Chính sách bảo mật</a></li>
                         <li><a href="javascript:void(0);" class="color_dark ">Điều khoản & điều kiện</a></li>
                    </ul>
</nav>
<div class="clearfix"></div>
<div type="module" name="visitcounter" class="visit_counter_box col-lg-5 col-md-5 col-sm-5 m_bottom_20 m_sm_bottom_30 f_right" mod_title="<?= $mod_title; ?>" id="<?= $moduleid; ?>">
    <div class="<?= $params['panel']; ?> panel-default">
       <?php /*?> <?php if( !empty($module_title) ) { ?> <h6 class="color_dark m_bottom_10 fw_light">Lượt truy cập</h6><?php } ?><?php */?>
        <div class="panel-body fs_small">
        
        	<?php
				$myprocess->render($params['today'], $params['yesterday'], $params['thisweek'], $params['thismonth'], $params['all'], $params['online'], $lang_text);
			?>         

        </div>
 
                                        <a href="https://www.google.com/maps/d/viewer?mid=zaJ0sI0sICDA.k4xkkSlxe7t4" target="_blank" class="button_type_2 color_dark r_corners tr_all color_pink_hover d_inline_m fs_medium t_md_align_c w_break">Xem Trên Google Maps</a>
                                
    </div>
</div>