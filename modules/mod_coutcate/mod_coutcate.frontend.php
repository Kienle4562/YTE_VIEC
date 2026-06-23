<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    

    include_once("mod_coutcate.models.php");

    

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

        $params = array();

    }

    else {

        $params = unserialize($params);

    }

?>

<section class="home__top-management-jobs container">

	<h1 class="text-center">

		<span><?php echo $module_title ?></span>

	</h1>

	<div>

		<div class="row channel-content">

			<?php

				$myprocess = new process_coutcate();

				$result = $myprocess->getData();

				while($row = $result->fetch()){

					$link = $this->_removesigns($row["tendanhmuccv"])."-".$row["danhmuccv_id"]."-dmcv.html";

			?>

			<div class="col-sm-3 channel">

				<div style="background:url(<?php echo $row["hinhanh"] ?>)" class="bg_cate tmj-channel"></div>

				<div style="display: block;" class="overlay"></div>

				<div class="content tmj-content">

					<div class="channel-label"><?php echo $row["tendanhmuccv"] ?></div>

					<div class="number-jobs"><?php echo $row["total"] ?> Việc Làm</div>

					<a target="_blank" href="<?php echo $link ?>" class="btn btn-primary">Xem</a>

				</div>

			</div>

			<?php }?>

		</div>

	</div>

</section>