<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include_once('com_createcv.models.php');
	include_once('protected/paging.php');
	$myprocess =  new process();
?>
<style>
.view img {
    display: block;
    position: relative;
    width: 100%;
    height: 310px;
}
</style>
<div class="sitemap-container container m_bottom_20 pv-profile-section-body">
    <div class="clearfix m_xs_bottom_10">
		<div class="bg_white p_15 r_corners m_bottom_20">
            <h1 class="sitemap-header text-primary color_green">CHỌN MẪU MÀ BẠN MUỐN</h1>
            <?php
                $result = $myprocess->get_career_cv();
                while($row = $result->fetch()){
            ?>
            <div class="col-md-3 column">
                <div class="view view-first cvBox">
                    <img src="<?php echo $row['template_image'] ?>" class="img-responsive">
                    <div class="cvtitle"><?php echo $row['template_name'] ?></div>
                    <div>
                        <a href="javascript:void" class="btn btn-primary full-width btn-lg bg_green" role="button">CHỌN MẪU NÀY</a>
                    </div>
					 <div class="mask">
                        <a href="javascript:void" id="id_theme" data-id="<?php echo $row['templatecv_id'] ?>" onclick="xem_truoc(this)" class="info">Chọn mẫu này</a>
                       </div>
                </div>
            </div>
            <?php }?>

        </div>
	</div>
</div>
<div class="modal fade global__sign-in-modal" id="preview_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog md_login modal-lg" role="document">
		<div class="modal-content step-1">
			<div style="padding: 10px" class="modal-body">

				<div class="step-1 animated fadeIn">
					<button type="button" class="close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="sitemap-header text-primary">XEM TRƯỚC</h3> <small></small>
				</div>
				<div class="bg_white p_15 r_corners m_bottom_20">
					<div class="preview_content">
						<iframe src="/preview" id="previewCV" title="Preview CV" width="100%" height="600"></iframe>
					</div>
				</div>
               <button type="button" class="apply_theme btn btn-primary full-width btn-lg" data-id="">
					<span>CHỌN MẪU NÀY</span>
				</button>
              
			</div>
		</div>
	</div>
</div>
<script>
function xem_truoc(animal){
    var idTheme = animal.getAttribute("data-id"); 
    var iframe = $('#previewCV');
    $(".apply_theme").attr("data-id", idTheme);
    iframe.attr('src', '/preview?idTheme='+idTheme);
    $("#preview_modal").modal('show');

 }

 $(".apply_theme").click(function(){
        var btn = $(this);
        var themeID = $(this).attr("data-id");
        $.ajax({
            url: 'apply-theme',
            type: 'POST',
            dataType: 'JSON',
            data: {do: 'applytheme', themeID:themeID},
            beaforeSend: function(){
            	btn.prop("disabled", true);
            },
            success: function(response){
                if(response.status == 1){
                    btn.prop("disabled", false);
                    alert(response.message);
                }else{
                    btn.prop("disabled", false);
                    alert(response.message);
                }
            }
        })
    })
</script>