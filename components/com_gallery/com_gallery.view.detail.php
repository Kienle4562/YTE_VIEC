<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include_once('com_gallery.view.detail.models.php');
	$myprocess = new process_com_gallery_view_detail();
?>
<div class="components com_gallery_detail">

    <div class="box_top_left"></div>
    <div class="box_top_center">
        <div class="top_text">Album ảnh</div>
    </div>
    <div class="box_top_right"></div>
    <div class="clear"></div>
    <div class="sub_box">
        <div class="box_content_left">
            <div class="box_content_right">
                <div class="box_content_center">

                     <div class="gallery">
                        <ul>
                            <?php
                            $result = $myprocess->gallery_view_detail( intval($_GET['id']) );
							if($result->rowCount()>0){
                             while($row = $result->fetch()){ ?>
                            <li>
                                <a rel="fancybox_group" href="<?php echo $row['image_file'];?>" title="<?php echo $row['title'];?>">
                                    <img src="<?php echo $row['image_file'];?>" />
                                    <p class="image_title"><?php echo $row['title'];?></p>
                                </a>                                        
                            </li>
                           <?php }
							}
						   else{ echo 'Chưa có hình ảnh trong album';}
						   ?>
                        </ul>
                        <script type="text/javascript" src="javascript/jcarousel/jquery.jcarousel.min.js"></script>
										
						<script type="text/javascript">
                            jQuery(document).ready(function() {
                                jQuery('#mod_gallery_<?php echo $module_id; ?>').jcarousel({
                                    wrap: 'circular',
                                    auto: true
                                });
                            });
                            
                            jQuery("a[rel=fancybox_group]").fancybox({
                                'transitionIn'		: 'none',
                                'transitionOut'		: 'none',
                                'titlePosition' 	: 'over',
                                'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
                                    return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                                }
                            });

                        </script>
                    </div>
                    
                    <div class="clear"></div>

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