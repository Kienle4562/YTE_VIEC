<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	
	$lang_text = $core_class->load_module_language('com_content_category_view', $GLOBALS['LANG']);
	
	include_once('com_tags.category.models.php');
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

	$categoryProc =  new process_category();
    
    /* predefine something */
    $this_cat_alias = "%".strip_tags($_GET["params"])."%";
	
	/* get total row */
	$totalrow = $categoryProc->get_category_count($this_cat_alias);
	
    /* config items per page */
	$itemPerPage = 5;
	
	/* phan trang */
	if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);
	$pager = Pager::getPagerData( $totalrow, $itemPerPage, $currentPage, $__append . "tag/" . $_GET["params"] . "?" );
	
	$i = 1;
    
    $page_title = $categoryProc->get_category_list($this_cat_alias, ' » ', 'title');
    
    $meta_title = $page_title . ' - ' . $meta_title;

	if ( $totalrow > 0 )
    {
		/* Get category items */
		$result = $categoryProc->get_category($this_cat_alias, intval($pager->offset), intval($pager->limit) ); ?>
        
        <div class="components com_content com_content_category_view">
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <div class="panel-heading">
                    <ol class="breadcrumb">
                        <li><a href=".">Trang chủ</a></li>
                        <li class="active"><?php echo $_GET["params"]; ?></li>
                    </ol>
                    <?php $core_class->add_component_translate_button('com_content_category_view'); ?>
                </div>
                <div class="panel-body">
                
                	<div class="row">               
						<?php while ($row = $result->fetch()){
                            $Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT']; ?>
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                
                                    <?php if (($row['img_file'] != 'Chọn file hình ảnh cần upload ...') && (trim($row['img_file']) != '') ) { ?>
                                        <img src="<?php echo $row['img_file']; ?>" alt="<?php echo $row['img_file']; ?>" onerror=""this.src='/files/images/tintuc/khach%20san/khach%20san%20vung%20tau/ksimperial.jpg'>
                                    <?php } ?>
                                    
                                    <div class="caption clearfix">
                                        <h3>
                                            <a href="<?php echo $Link; ?>" title="<?php echo $row['title']; ?>" class="Title">
                                                <?php echo $row['title']; ?>
                                            </a>
                                        </h3>
                                        <p style="text-align:justify;"><?php echo $row['description']; ?></p>
                                        <p><a href="<?php echo $Link; ?>" class="btn btn-link right strong">Xem chi tiết »</a></p>
                                    </div>
                                    
                                </div>
                            </div>         
                        <?php } ?>
                    </div>
                    
                    <?php 
						if ( $totalrow > $itemPerPage )
						{
							echo '<ul class="pagination pagination-sm right">' . $pager->paging . '</ul>';
						}
					?>                    
                </div>  
            </div>                  
        </div>

        <?php
    }