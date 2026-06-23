<?php 
	$myprocess = new process;
	$result = $myprocess->getCompany($_POST['value_search']);
	if($result->rowCount() > 0){
		while($row = $result->fetch()){
?>
<ul id="country-list">
	 <li>
		<?php echo $row['tencongty'] ?>
	</li>
</ul>
	<?php 
			}
			
			}else {
		echo 'Chưa có công trong hệ thống ';
	} ?>