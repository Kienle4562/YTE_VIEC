<?php defined('_VALID_MOS') or die(include_once("../../404.php"));



include_once("mod_congviec.models.php");



if (count($GLOBALS['LANG_LIST']) > 1) {

    $__home = $GLOBALS['LANG'] . $GLOBALS['EXT'];

    $__append = $GLOBALS['LANG'] . '/';
} else {

    $__home = $GLOBALS['INDEX'];

    $__append = '';
}



if (empty($params) || $params == "undefine") {

    $params = array();
} else {

    $params = unserialize($params);
}

?>

<section class="feature container home__jobs-you-will-love">

    <div class="col-lg-12 col-xs-12">

        <h1 class="text-center">Việc Làm Tốt Nhất</h1>

        <div class="tabs-container">

            <!--<ul class="nav nav-tabs no-border" role="tablist">

				<li role="presentation" class="text-center no-padding active">

					<a id="topJobTab" href="#topJobs" aria-controls="topJobs" role="tab" data-toggle="tab" aria-expanded="true">

						<h3 class="no-padding no-margin">Việc Làm Mới Nhất</h3></a>

				</li>

				<li id="recommendJobTab" role="presentation" class="text-center no-padding">

					<a href="#recommendedJobs" aria-controls="recommendedJobs" role="tab" data-toggle="tab"

					   aria-expanded="false"><h3 class="no-padding no-margin">Việc Làm Lương Cao</h3></a>

				</li>

			</ul>-->

            <div class="tab-content">

                <!-- Top Jobs -->

                <div class="tab-pane tab-job active" id="topJobs">

                    <div class="panel-content">

                        <!-- Carousel -->

                        <div class="tab-content">

                            <!-- Top Jobs -->

                            <div class="tab-pane tab-job active" id="topJobs">

                                <div class="panel-content">

                                    <!-- Carousel -->

                                    <div class="job-carousels">

                                        <?php

                                        $dateNow =  date('d-m-Y');

                                        $number = 1;

                                        $total = 1;

                                        $process_congviec = new process_congviec();

                                        $where = " 

                                            WHERE trn_congviec.hot_job = 1

                                            AND trn_congviec.trangthai = 1 

                                            AND trn_congviec.DELETE_FLG = 0 

                                            AND date_add(trn_congviec.ngayhethan, INTERVAL 60 DAY) > NOW()";

                                        $result = $process_congviec->getData($where);

                                        while ($row = $result->fetch()) {

                                            $link = $this->_removesigns($row["tencongviec"]) . "-" . $row["congviec_id"] . "-cv.html";

                                            $srcHinhanh = "/images/logo.png";

                                            if (!empty($row["hinhanh"]) && strpos($row["hinhanh"], "noimage") == false) {

                                                $srcHinhanh = $row["hinhanh"];
                                            }


                                            if ($number == 1) {

                                        ?>

                                                <div class="job-page">

                                                    <div class="row">


                                                    <?php }    ?>

                                                    <div class="col-md-6">

                                                        <div class="job hot-job row">

                                                            <div class="col-xs-2 col-logo">

                                                                <!-- Logo -->

                                                                <div class="logo-box">

                                                                    <a href="<?php echo $link ?>" target="_blank" title="<?php echo $row["tencongviec"] . " - " . $row["tencongty"]; ?>">

                                                                        <img class="img-responsive logo" src="<?php echo $srcHinhanh; ?>" alt="<?php echo $row["tencongviec"]; ?>">

                                                                    </a>



                                                                </div>

                                                            </div>


                                                            <div class="col-xs-10 col-content job-text-line-height">

                                                                <!-- Job Description-->


                                                                <a href="<?php echo $link ?>" target="_blank" title="<?php echo $row["tencongviec"] . " - " . $row["tencongty"]; ?>">

                                                                    <p class="title text-clip job-title">


                                                                        <!-- [<?php echo $row['diadiemlamviec'] ?>] -->

                                                                        <!-- <span class="hidden-xs">-</span> -->

                                                                        <!-- <?php echo strtolower($row["tencongviec"]); ?> -->
                                                                        <?php echo $row["tencongviec"]; ?>

                                                                    </p>

                                                                    <div class="text-gray-light text-light company-info">

                                                                        <span class="company text-clip text-uppercase">

                                                                            <?php echo $row["tencongty"]; ?>


                                                                        </span>

                                                                    </div>

                                                                    <span class="badge bg-success" style="background: #f7941d;">

                                                                        <!-- Ngày hết hạn: <?php echo date('d-m-Y', strtotime($row["ngayhethan"])) ?>  -->

                                                                        Khu vực: <?php echo $row['diadiemlamviec'] ?>

                                                                    </span>

                                                                </a>

                                                            </div>


                                                            <span class="hot-job-badge">Hot</span>

                                                        </div>

                                                        <hr>

                                                    </div>

                                                    <?php

                                                    if ($number == 10 || $total == $result->rowCount()) { ?>

                                                    </div>

                                                </div>

                                        <?php

                                                        $number = 0;
                                                    }

                                                    $number++;

                                                    $total++;
                                                }

                                        ?>


                                    </div>

                                </div>

                            </div>
                            <!-- <?php echo $total; ?> -->
                            <div class="col-md-4"></div>

                            <div class="col-md-4 btn-viewAll">

                                <a target="_blank" href="tat-ca-viec-lam.html" class="w_full btn btn-primary" tabindex="-1">XEM TẤT CẢ VIỆC LÀM</a>

                            </div>

                            <div class="col-md-4"></div>

                        </div>



                    </div>

                </div>

            </div>



        </div>


    </div>

    <!--<div class="col-lg-3 col-xs-12">

		<?php $this->load_module("right"); ?>

	</div> -->

</section>