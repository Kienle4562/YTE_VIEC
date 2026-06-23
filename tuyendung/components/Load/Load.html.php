<?php 
	include("modal.php");
	$myprocess = new com_process();
?>
<div class="row state-overview">
  <div class="col-lg-3 col-sm-6">
    <section class="panel">
      <div class="symbol blue"> <i class="fa fa-bar-chart-o"></i> </div>
      <div class="value">
        <h1><?php echo $core_class->countColumnInTable("trn_CongTyDuLich", "CTDL_id"); ?></h1>
        <p>Tổng Số Công Ty Du Lịch</p>
      </div>
    </section>
  </div>
</div>
<?php include_once("Library.php");?>