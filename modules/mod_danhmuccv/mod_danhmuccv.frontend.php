<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
    include_once("mod_danhmuccv.models.php");
    if (empty($params) || $params == "undefine") {
        $params = array(
            'menu_type_id' => 0,
            'max_level' => 0,
            'class' => '',
            'show_icon' => FALSE
        );
    }
    else {
        $params = unserialize($params);
    } 
    if (empty($params['show_icon'])) {
		$params['show_icon'] = FALSE;
    }
	$myprocess = new process_danhmuccv();
?>
<a class="title">
	<i class="fa fa-chevron-down pull-right hidden-md hidden-lg"></i>
	<h5><?php echo $module_title ?></h5>
</a>
<div class="link-listing">
	<ul class="list-group dmcvul">
	<?php
		$i = 1;
		$result = $myprocess->getdata();
		while($row = $result->fetch()){
			$link = "tim-kiem.html?search=&location=".$row["id"];
			if($i == 1){
				echo '<div class="col-md-2">';
			}
	?>
		<li>
			<a href="<?php echo $link ?>"><?php echo $row["ten_tinhthanh"]; ?> (<?php echo $row['NUM'] ?>)</a>
		</li>
	<?php 
			if($i == 11){
				echo '</div>';
				$i = 1;
			}else{
				$i++;
			}
		}
	?>
	</ul>
</div>