<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    include_once('mod_slideshow2.models.php');
    $myprocess = new process_mod_slideshow2();
?>
<style>
    ul{
        list-style: none outside none;
        padding-left: 0;
        margin: 0;
        margin-bottom: 60px;
    }
    .content-slider li{
        text-align: center;
        color: #FFF;
    }
</style>
<script src="plugins/lightslider/lightslider.min.js"></script>
<script>
    $(document).ready(function() {
        $("#content-slider").lightSlider({
            loop:true,
            keyPress:true,
            item: 5,
            speed: 400,
            auto: true,
            loop: true,
            slideEndAnimation: true,
            pause: 2000,
        });
    });
</script>
<div class="container">
	<div class="row">
        <div class="col-md-12">
            <h3 class="t_align_c lightslider"><?php echo $module_title; ?></h3>
            <div class="item">
                <ul id="content-slider" class="content-slider">
                    <?php
                        $module_data = $myprocess->get_slideshow_content($module_id);                                             
                        while ($row = $module_data->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <li>
                            <a href="<?php echo $row['link'] ?>">
                                <img src="<?php echo $row['image_file']; ?>" alt="Y Tế Việc">
                            </a>
                        </li>
                    <?php
                        } 
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>