<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	$lang_text = $core_class->load_module_language('com_content_category_view', $GLOBALS['LANG']);
	include_once('com_content.category.models.php');
	$categoryProc =  new process_category();
	$result = $categoryProc->get_category(222, 0, 3);
	$arrayNews = array(
		"code" => 200,
		"message" => "Thành công",
		"data" => array()
	);
	$arr_ = array();
	while($row = $result->fetch()) {
		$Link = $GLOBALS['INDEX'] . $__append . $row["alias"] . "/n" . $row["news_id"] . $GLOBALS['EXT'];
		$arr_ = array (
			"picture" => $row['img_file'],
			"title" => $row['title'],
			"content" => $core_class->SmartContent($row['description'], 300),
			"url" => $Link
		);
		array_push($arrayNews["data"], $arr_);
	}
	echo json_encode($arrayNews);
?>        