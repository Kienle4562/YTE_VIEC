<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	
	$lang_text = $core_class->load_module_language('com_search_result_view', $GLOBALS['LANG']);
	
	include_once('com_search.result.models.php');
	include_once('protected/paging.php');
	
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

	$categoryProc =  new process_search();
    
    /* predefine something */
    if (isset($_POST['keyword'])) {
		$url[1] = trim($_POST['keyword']);
		$_GET["params"] = implode('/', $url);
    }
    
    $this_keyword = strip_tags($url[1]);
    
    if (trim($this_keyword) == '')
    {
		?>
		<div class="components com_search com_search_result_view">
		
			<div class="box_top_left"></div>
			<div class="box_top_center">
				<div class="top_text">
					<span class="text2translate" alt="component_name"><?php echo $lang_text['component_name']; ?></span>
					<?php $core_class->add_component_translate_button('com_search_result_view'); ?>
				</div>
			</div>
			<div class="box_top_right"></div>
			<div class="clear"></div>
			<div class="sub_box">
				<div class="box_content_left">
					<div class="box_content_right">
						<div class="box_content_center">
						
							<div class="keyword">
								<div>
									<?php echo $lang_text['keyword_empty']; ?>
								</div>
							</div>
							
						</div>
					</div>								
				</div>
			</div>
			<div class="content_bottom">
				<div class="box_bottom_left"></div>
				<div class="box_bottom_center"></div>
				<div class="box_bottom_right"></div>
			</div>
			<div class="clear"></div>
			
		</div>
		<?php
    }
	else
	{
		/* get total row */
		$totalrow = $categoryProc->get_result_count($this_keyword);
		
	    /* config items per page */
		$itemPerPage = 10;
		
		/* phan trang */
		if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);
		$pager = Pager::getPagerData( $totalrow, $itemPerPage, $currentPage, $__append . $_GET["params"] . $GLOBALS['EXT'] );
		
		$i = 1;
	    
	    $page_title = $lang_text['component_name'];
	    
	    $meta_title = $page_title . ' - ' . $meta_title;
	    
		if ( $totalrow > 0 )
	    {
			/* Get category items */
			$result = $categoryProc->get_result($this_keyword, intval($pager->offset), intval($pager->limit) ); ?>
			
			<div class="components com_search com_search_result_view">
			
				<div class="box_top_left"></div>
				<div class="box_top_center">
					<div class="top_text">
						<span class="text2translate" alt="component_name"><?php echo $lang_text['component_name']; ?></span>
						<?php $core_class->add_component_translate_button('com_search_result_view'); ?>
					</div>
				</div>
				<div class="box_top_right"></div>
				<div class="clear"></div>
				<div class="sub_box">
					<div class="box_content_left">
						<div class="box_content_right">
							<div class="box_content_center">
							
								<div class="keyword">
									<div>
										<strong><?php echo $lang_text['keyword_label']; ?></strong>
										<?php echo $this_keyword; ?>
									</div>
									<div>
										<strong><?php echo $lang_text['found']; ?></strong>
										<?php echo $totalrow; ?>
										<?php echo $lang_text['result_count']; ?>
									</div>
								</div>
								
								<?php 
								while ($row = $result->fetch())
	                            {
									$Link = $GLOBALS['INDEX'] . $__append . $categoryProc->get_category_list($row['category_id'], '/', 'alias') . "/" . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT'];
									
									?>
									<div class="category_content">
										<div class="item_right"><div class="item_left"><div class="item_middle">
											<div class="content">
												
												<div class="title">
													<a href="<?php echo $Link; ?>">
														<?php echo $row['title']; ?>
													</a>
												</div>
												
												<?php if ($_APP['config']['com_content']['show_updated_date'] == 1) { ?>
													<div class="date">
														<?php echo $lang_text['updated_date']; ?>
														<?php echo date("d/m/Y",$row['date_add']); ?>
													</div>
												<?php } ?>

												<?php 
													if (($row['img_file'] != 'Chọn file hình ảnh cần upload ...')
	                                                        && (trim($row['img_file']) != '')
	                                                    )
													{
														?>
														<div class="news_img">
															<a href="<?php echo $Link; ?>">
																<img src="<?php echo $row['img_file']; ?>" border="0" />
															</a>
														</div>
														<?php	
													} 
												?>
												<div class="news_content"><?php echo $row['description']; ?></div>
												<div class="clear"></div>
											</div>
											<div class="clear"></div>
										</div></div></div>
									</div>
								<?php 

								} 
								
								if ( $totalrow > $itemPerPage )
								{
									echo '<div class="page_num">' . $pager->paging . '</div>';
									echo '<div class="clear"></div>';
								}
								
								?>
								
							</div>
						</div>								
					</div>
				</div>
				<div class="content_bottom">
					<div class="box_bottom_left"></div>
					<div class="box_bottom_center"></div>
					<div class="box_bottom_right"></div>
				</div>
				<div class="clear"></div>
				
			</div>
	        <?php
	    }
	    else
	    {
			?>
			<div class="components com_search com_search_result_view">
			
				<div class="box_top_left"></div>
				<div class="box_top_center">
					<div class="top_text">
						<span class="text2translate" alt="component_name"><?php echo $lang_text['component_name']; ?></span>
						<?php $core_class->add_component_translate_button('com_search_result_view'); ?>
					</div>
				</div>
				<div class="box_top_right"></div>
				<div class="clear"></div>
				<div class="sub_box">
					<div class="box_content_left">
						<div class="box_content_right">
							<div class="box_content_center">
							
								<div class="keyword">
									<div>
										<?php echo $lang_text['not_found']; ?>
										<?php echo $this_keyword; ?>
									</div>
								</div>
								
							</div>
						</div>								
					</div>
				</div>
				<div class="content_bottom">
					<div class="box_bottom_left"></div>
					<div class="box_bottom_center"></div>
					<div class="box_bottom_right"></div>
				</div>
				<div class="clear"></div>
				
			</div>
			<?php
	    }
	}