<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include_once('com_gallery.view.group.models.php');
	$myprocess = new process_com_gallery_view_group();
?>

<div class="section_offset">
    <div class="container clearfix">        
        <section class="portfolio_isotope_container three_columns without_text masonry m_xs_bottom_15 m_bottom_35" data-isotope-options='{"itemSelector" : ".portfolio_item","layoutMode" : "masonry","transitionDuration":"0.7s","masonry" : {"columnWidth":".portfolio_item"}}'>
			<?php
                $result = $myprocess->gallery_view_group( );
                while($row = $result->fetch()){ ?>
                
                <figure class="portfolio_item three_dimensional">                
                    <!--image-->
                    <div class="popup_wrap relative db_xs_centered r_corners wrapper">
                        <img src="<?= $row['img_file'];?>" alt="">
                        <div class="project_description vc_child t_align_c tr_all_long">
                        <div class="d_inline_m">
                            <h4 class="lh_inherit m_md_bottom_5 d_sm_none d_xs_block m_bottom_15">
                                <a href="#" class="color_light tr_all not_hover"><?= $row['title'];?></a>
                            </h4>
                            <div class="d_inline_b clearfix">s
                                <a href="<?= $row['img_file'];?>" data-group="gal-group-<?= $row['Id']; ?>" data-title="Title 1" class="jackbox icon_wrap_size_3 color_light n_sc_hover d_block circle f_left m_right_10">
                                    <i class="icon-plus"></i>
                                </a>
                                <div class="d_none">
                                	<?php
									$result1 = $myprocess->gallery_view_detail( $row['Id'] );
									while($row1 = $result1->fetch()){ ?>
                                    <a data-group="gal-group-<?= $row['Id']; ?>" href="<?= $row1["image_file"]; ?>" data-title="<?= $row1["title"]; ?>" class="jackbox"></a>                                   
                                    <?php } ?>
                                </div>
                            </div>
                        </div></div>
                    </div>
                </figure>
                
            <?php } ?>                                                                        
        </section>       
    </div>
</div>