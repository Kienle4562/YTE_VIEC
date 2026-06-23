<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    
    include_once("mod_show_option_list.models.php");
    
    if (count($GLOBALS['LANG_LIST']) > 1)
	{
		$__home = $GLOBALS['LANG'] . $GLOBALS['EXT'];
		$__append = $GLOBALS['LANG'] . '/';
	}
	else
	{
		$__home = $GLOBALS['INDEX'];
		$__append = '';
	}

    if (empty($params) || $params == "undefine") {
        $params = array(
            'cat_id' => 0,
            'max_level' => 0,
            'class' => '',
			'subdec_number' =>100,
			'news_id' => 0,
			'layout_boostrap' => 2,
			'show_option_type_value' => 1
        );
    }
    else {
        $params = unserialize($params);
    }
    
    $lang_text = $this->load_module_language('mod_show_option_list', $GLOBALS['LANG']);
	
	$myprocess = new process_block_news();
	if( $params['news_id'] > 0){
		$result = $myprocess->get_category_list_by_newsid($params['news_id'], $params['sub_number'], $GLOBALS['LANG']);		
	} else {
		$result = $myprocess->get_category_list($params['cat_id'], $params['sub_number'], $GLOBALS['LANG']);
	}
	
?>
					
<?php if($params['show_option_type_value'] == 1){ 

	if($row = $result->fetch()) { 
		$Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT'];
	?>                            
	<div class="<?php if (!empty($params['class'])) echo $params['class']; ?>">        
		<div class="panel panel-default">
			<!-- Default panel contents -->
            <?php if( !empty($module_title) ) { ?><h6 class="fw_light f_xs_none color_white m_bottom_10 m_xs_bottom_10 fw_ex_bold"><?php echo $module_title; ?></h6><?php } ?>
			<div class="panel-body">				
				<?= $row['description']; ?>
			</div>
            <a class="f_right" href="<?= $Link; ?>">Xem thêm</a>
		</div>
	</div>                
<?php }
} else if($params['show_option_type_value'] == 2){ 
	
	if($row = $result->fetch()){
		 $Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT'];
	?>
									
		<div class="<?php if (!empty($params['class'])) echo $params['class']; ?> col-sm-6 col-md-4 box-none news">        
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<?php if( !empty($module_title) ) { ?><div class="panel-heading"><?php echo $module_title; ?></div> <?php } ?>
				<div class="panel-body"> 
					<a href="<?php echo $Link ?>"><?php echo $row['title'];?></a>                                       
					<?php if($row['img_status']){ ?>
						<img src="<?php echo $row['img_file'];?>" class="img-responsive">                             
					<?php } ?>
					<div class="caption">                                                
						<p><?php echo $this->SmartContent($row['description'], $params['subdec_number']); ?></p>
					</div>
				</div>  
			</div>                
		</div>
<?php }
} else if($params['show_option_type_value'] == 4){ 	?>

	<div class="<?php if (!empty($params['class'])) echo $params['class']; ?>">        
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<?php if( !empty($module_title) ) { ?><div class="panel-heading"><a href="./tin-tuc-hang-khong/n.wti"><?php echo $module_title; ?></a></div> <?php } ?>
			<div class="panel-body">
            	<?php while($row = $result->fetch()) { $i++;
				$Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT']; ?>
                <div class="caption">
					<a class="title" href="<?php echo $Link ?>"><?php echo $row['title'];?></a>
                    <p class="date"><?php echo date("d/m/Y", $row['date_add']); ?></p>
					<p class="desc"><?php echo $this->SmartContent($row['description'], $params['subdec_number']); ?></p>
                    <?php if($i>1) { ?><div style="text-align:right;"><a href="<?php echo $Link ?>" class="btn btn-default">Xem chi tiết</a></div> <?php } ?>
				</div>
                <?php } ?>
			</div>
		</div>      
	</div>

<?php
} else if($params['show_option_type_value'] == 5){ ?>

	<div class="<?php if (!empty($params['class'])) echo $params['class']; ?>">        
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<?php if( !empty($module_title) ) { ?><h6 class="fw_light f_xs_none color_white m_bottom_10 m_xs_bottom_10 font_UTMEremitage"><?php echo $module_title; ?></h6><?php } ?>
			<div class="panel-body">                                        
                <ul class="news-group">
                	<?php while($row = $result->fetch()) {
					$Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT']; ?>
                    <li class="news-group-item">
                    	<a class="color_dark" href="<?php echo $Link ?>"><?php echo $row['title'];?></a>
                        <br />
                        <span class="color_yellow fs_small"><?= date("d/m/Y", $row['date_add']); ?></span>
                    </li>
                    <?php } ?>
                </ul>
			</div>  
		</div>
	</div>	    

<?php } else { 
	if($row = $result->fetch()){
		 $Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT']; ?>
	<div class="<?php if (!empty($params['class'])) echo $params['class']; ?> col-sm-6 col-md-4 box-none news">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <?php if( !empty($module_title) ) { ?><div class="panel-heading"><?php echo $module_title; ?></div> <?php } ?>
            <div class="panel-body">             
                <a class="color_dark" href="<?php echo $Link ?>"><?php echo $row['title'];?></a>
            </div>  
        </div>                
    </div>
<?php }
} ?>