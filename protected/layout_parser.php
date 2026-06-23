<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	
	
	class layout_parser
	{
		public $dbObj;
    
        function __construct()
        {
             $this->dbObj = new classDb();
        }

		public function get_component_key()
		{
			// Kiểm tra [component] hiện tại
			
			$layout_com = "";

			if (isset($_GET['com'])) {
				$layout_com = strtolower($_GET['com']);
			}
			else {
				$layout_com = "com_default";
			}


			// Kiểm tra [view] hiện tại
			
			$layout_view = "";
			
			if (isset($_GET['view'])) {
				$layout_view = strtolower($_GET['view']);
			}			
			
			// Tạo [component_key] để truy vấn [layout_id] hiện tại
			
			$layout_key = "";
			
			if ($layout_view != "") {
				$layout_key = $layout_com . ":" . $layout_view;
			}
			else {
				$layout_key = $layout_com;
			}
			
			return $layout_key;
		}
		
		public function get_layout_by_component_key($component_key)
		{
			$sql = "
					SELECT 
							`B`.`class`,
							`B`.`column_id`
					FROM
							`layout_components` as `A`
							LEFT JOIN `layout` as `B` ON `A`.`layout_id` = `B`.`id`
					WHERE
							`A`.`component_key` = ?
			";
			
			$result = $this->dbObj->SqlQueryOutputResult($sql, array($component_key));
			
			if ($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				return $row;
			}
			else
			{
				return null;
			}
		}
	}
	
	// Parse layout
	
	$layout_parser_var = new layout_parser();
	
	$component_key = $layout_parser_var->get_component_key();		
	
	$layout = $layout_parser_var->get_layout_by_component_key($component_key);
	
	if (empty($layout))
	{
		$layout = array(
			'class' => 'one_col_c',
			'column_id' => 'center'
		);
	}		

	if (!empty($layout))
	{		
		$columns 		= explode(',', $layout['column_id']);	
		$class_layout 	= explode(',', $layout['class']);

		if ($class_layout[0] == "row")
		{
			if ($component_key == "com_default"){
				echo '<div class="main-wrapper home">';
					echo '<div id="vnw-home" class="home-new">';
						$core_class->load_module("center");
					echo '</div>';
				echo '</div>';
			} else {
				include_once("{$GLOBALS['COM']}/com_routers/com_routers.html.php");
			}
		}
		else
		{

			foreach ($columns as $c){
				if ($c == "center"){
					if ($component_key == "com_default"){
						echo '<section class="' . $class_layout[$z] . '">';
						$core_class->load_module("center");
						echo '</section>';
					} else {
						include_once("{$GLOBALS['COM']}/com_routers/com_routers.html.php");
					}
				} else {
					echo '<aside class="' . $class_layout[$z] . '">';
						$core_class->load_module($c);
					echo '</aside>';
				}
			}
		}									

			/*				
			echo '<div class="section_offset">
					<div class="container">
						<div class="row">
							<div class="' . $class_layout[$z] . '">';

							if ($c == "center")
							{
								if ($component_key == "com_default")
								{
									$core_class->load_module($c);
								}
								else
								{
									include_once("{$GLOBALS['COM']}/com_routers/com_routers.html.php");
								}
							}
							else
							{
								$core_class->load_module($c);
							}
			
			echo "</div>
				</div>
				</div>
				</div>";
			*/
			

	}
	else
	{
		echo "LAYOUT EMPTY!";
	}