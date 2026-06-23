<?php defined( '_VALID_MOS' ) or die( include("404.php") );

    class core_class
    {
        public $index;
        
        function __construct()
        {
            $this->index = $index;
		}

		function latest_version($file_name){
			echo $file_name."?ver=".filemtime($file_name);
		}

		function loadSource($arraySource){
			foreach($arraySource as $key => $value){
				if($value == "css"){
					echo '<link href="'.$key."?ver=".filemtime($key).'" rel="stylesheet" type="text/css" />'.PHP_EOL;
				}else{
					echo '<script src="'.$key."?ver=".filemtime($key).'"></script>'.PHP_EOL;
				}
			}
		}
		function createSelectBox_3($columnId, $selected = "", $required = "", $class = "m-bootstrap-select m_selectpicker", $mainTb = "mst")
		{	
			$dbObj = new classDb();
			$sql = "select * FROM `".$mainTb."_" . substr($columnId, 0, -3) ."`";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<select '.$required.' name="' .$columnId. '" class="form-control '.$class.'" data-live-search="true" id="' .$columnId. '"> ';
				$html .= "<option value=''>Chọn</option>";
			while($row = $result->fetch()){
				$select = $row[0] == $selected ? "selected" : "";
				$html .= "<option ".$select." value='" .$row[0]. "'>" .$row[1]. "</option>";
			}
			$html .= '</select>';
			return $html;
		}
		function createSelectBoxWithArray($arrayDT, $selected = "", $required = "", $showValue = true, $class = "m-bootstrap-select m_selectpicker", $name="")
		{
			$html = '<select '.$required.' name="' .$name. '" class="form-control '.$class.'"> ';
				$html .= "<option value=''>Chọn</option>";
			foreach($arrayDT as $key => $values){
				$select = $key == $selected ? "selected" : "";
				if($showValue){
					$html .= "<option ".$select." value='" .$key. "'>" .$values. "</option>";
				}else{
					$html .= "<option ".$select." value='" .$key. "'>" .$key. "</option>";
				}
			}
			$html .= '</select>';
			return $html;
		}
		 function insert($tables, $rows = array())
        {
            $values = array();
            $fmt = "INTO {$tables} (%s) VALUES (%s)";
            $outside = "INSERT %s";
            $columns = array();
            $bind_vars = array();
            foreach ($rows as $column => $val) {
                array_push($columns, $column);
                array_push($bind_vars, '?');
                array_push($values, $val);
            }
            $sql = sprintf($outside, sprintf($fmt, join(", ", $columns), join(", ", $bind_vars)));
			$dbObj = new classDb();
			return $dbObj->SqlQueryInputResult($sql, $values);
        }
		function find($tables, $column = null, $where = array(), $option = null, $findAll = false)
		{
			$dbObj = new classDb();
			$filter = array();
			$params = array();
			if (!is_array($column)) {
				if ($column == 'all' || $column == null) {
					$sql = "SELECT * FROM ".$tables;
				} elseif ($column == 'count') {
					$sql = "SELECT COUNT(1) FROM ".$tables;
				} else {
					$sql = $this->$column;
				}
			} else {
				$columns = join(", ", $column);
				$sql = "SELECT $columns FROM ".$tables;
			}

			if (is_array($where) && count($where) > 0) {
				foreach($where as $key => $val){
					array_push($filter, "$key = ?");
					array_push($params, $val);
				}
			}

			if (count($filter) > 0) {
				$sql .= " WHERE " . join(" AND ", $filter);
			}
			if ($option != null) {
				$sql .= " $option";
			}
			$result = $dbObj->SqlQueryOutputResult($sql, $params);
			$row = $result->fetchAll(PDO::FETCH_ASSOC);
			if(!$findAll){
				return $row[0];
			}else{
				return $row;
			}
		}

		// convert string to number
		function ctoInt($str){
			return intval(str_replace(",", "", $str));
		}

		// Insert common 
		function lastID_insert($tables, $rows = array())
		{
			$values = array();
			$fmt = "INTO {$tables} (%s) VALUES (%s)";
			$outside = "INSERT %s";
			$columns = array();
			$bind_vars = array();
			foreach ($rows as $column => $val) {
				array_push($columns, $column);
				array_push($bind_vars, '?');
				array_push($values, $val);
			}
			$sql = sprintf($outside, sprintf($fmt, join(", ", $columns), join(", ", $bind_vars)));
			$dbObj = new classDb();
			$LastID = $dbObj->last_insert_id($sql, $values);
			 if($LastID > 0){
				return $LastID;
			} else {
				return -1;
			}
		}

		function findValues($tables, $column, $where)
		{
			$dbObj = new classDb();
			$filter = array();
			$params = array();
			$sql = "SELECT ".$column." FROM ".$tables;
			foreach($where as $key => $val){
				array_push($filter, "$key = ?");
				array_push($params, $val);
			}
			$sql .= " WHERE " . join(" AND ", $filter);
			$result = $dbObj->SqlQueryOutputResult($sql, $params);
			$row = $result->fetch();
			return $row[0];
		}
		
		// Update common
        public function update($tables, $sets = array(), $where = array())
        {
            $update_parts = array();
            $vals = array();
            foreach($sets as $keySets => $valSets){
                array_push($update_parts, "$keySets = ?");
                array_push($vals, $valSets);
            }
            $filter = array();
            foreach($where as $keyWhere => $valWhere){
                array_push($filter, "$keyWhere = ?");
                array_push($vals, $valWhere);
            }
            $sql = "UPDATE {$tables} SET ".join(", ", $update_parts)." WHERE ".join(" AND ", $filter);
            $dbObj = new classDb();
			return $dbObj->SqlQueryInputResult($sql, $vals);
        }
		
		// Hàm lấy data từ cột chuyển thành dạng JSON
        function getValueFromTableToJSON($table, $column, $where = "")
        {
			$dbObj = new classDb();
			$sql = "SELECT {$column} FROM {$table} WHERE 1=1 {$where} ORDER BY DISORDER DESC";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$row = $result->fetchAll(PDO::FETCH_ASSOC);
			return json_encode($row);
		}
		 function getValueFromTableToJSON_Multiple($table, $column, $join, $where = "")
        {
			$dbObj = new classDb();
			$sql = "SELECT {$column} FROM {$table} {$join} WHERE 1=1 {$where}";
			//echo $sql;
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$row = $result->fetchAll(PDO::FETCH_ASSOC);
			return json_encode($row);
		}
		// Hàm lấy data chuyển thành JSON
        function sqlToJSON($sql)
        {
			$dbObj = new classDb();
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$row = $result->fetchAll(PDO::FETCH_ASSOC);
			return json_encode($row);
		}
		
		// Hàm lấy data từ cột
        function getValueFrom($table, $column, $where)
        {
			$dbObj = new classDb();
			$sql = "SELECT {$column} FROM {$table} WHERE {$where}";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$row = $result->fetch();
			return $row[$column];
		}
		
		// Hàm lấy data từ cột
        function getValueFrom2($table, $column, $where)
        {
			$dbObj = new classDb();
			$sql = "SELECT {$column} FROM {$table} WHERE {$where}";
			return $result = $dbObj->SqlQueryOutputResult($sql, array());
		}

		// Hàm lấy data từ cột
        function getValueFrom3($sql)
        {
			$dbObj = new classDb();
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			return $result->fetchAll();
		}
		
		// Hàm delete common
        function deleteTable($table, $where)
        {
			$dbObj = new classDb();
			$sql = "DELETE FROM {$table} WHERE {$where}";
			return $dbObj->SqlQueryInputResult($sql, array());
		}
		// Hàm load data để edit dạng JSON
        function loadJSONDataList($table, $strColumn, $where)
        {
			$column = explode(",", $strColumn);
			$sql = "SELECT {$strColumn} FROM {$table} WHERE 1=1 {$where}";
			$dbObj = new classDb();
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$JSON = "{";
			while($row = $result->fetch()){
				for($col = 0; $col < count($column); $col++){
					$JSON .= '"'.$column[$col].'": ';
					$JSON .= '"'.$row[$column[$col]].'", ';
				}
			}
			$JSON .= "}";
			$JSON = str_replace(", }","}",$JSON);
			echo $JSON;
		}
		
		// Hàm load data để edit dạng JSON
        function loadJSONDataList2($table, $where)
        {
			$dbObj = new classDb();
			$sql = "SELECT * FROM {$table} WHERE 1=1 {$where}";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$row = $result->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($row[0]);
		}
		
		// Hàm select Common 2
        function createTableList2($table, $primary_key, $strColumn, $strheaderColumn, $component = "", $leftJoin="", $repColumJoin="")
        {
			$column = explode(",", $strColumn);
			$headerColumn = explode(",", $strheaderColumn);
			$sql = "SELECT {$primary_key},{$strColumn} FROM {$table} {$leftJoin} ORDER BY INSERT_DATE DESC";
			$dbObj = new classDb();
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<table class="table table-hover table-expandable table-bordered table-striped" id="ListData">';
			$html .= "<thead><tr>";
			for($col = 0; $col < count($headerColumn); $col++){
				if($headerColumn[$col]!="###"){
					$html .= '<th>';
					$html .= $headerColumn[$col];
					$html .= '</th>';
				}
			}
			if($component != ""){
				$html .= '<th></th>';
			}
			$html .= "</tr></thead><tbody>";
			if($result->rowCount() > 0){
				while($row = $result->fetch()){
					$html .= '<tr>';
					for($col = 0; $col < count($column); $col++){
						if($column[$col] != $table.".INSERT_DATE"){
							$html .= '<td colname="'.$column[$col].'" class="td_' .$column[$col]. '">';
							if($repColumJoin != ""){
								$arrRepColumJoin = explode(",", $repColumJoin);
								if(strrpos($column[$col], " as ") > 0){
									$array_strTb = explode(" ", $column[$col]);
									$html .= $row[$array_strTb[count($array_strTb)-1]];
								}else{
									for($numRepColJoin = 0; $numRepColJoin < count($arrRepColumJoin); $numRepColJoin++){
										$html .= $row[str_replace($arrRepColumJoin[$numRepColJoin].".","",$column[$col])];
									}
								}
							}else{
								$html .= $row[str_replace($table.".","",$column[$col])];
							}
							$html .= '</td>';
						}
					}
						$html .= '<td colname="'.$primary_key.'">';
							$html .= '<input type=hidden id="'.$primary_key.'" name="'.$primary_key.'" value="'.$row[$primary_key].'"/>';
							$html .= $component;
						$html .= '</td>';
					$html .= '</tr>';
				}
			}
			$html .= '</tbody></table>';
			echo $html;
		}
		
		// Hàm Tạo form xử lý data
        function createForm($table, $title, $classModal = "", $col = 6)
        {
			$formArray = array("formDataInsert", "formDataUpdate");
			foreach($formArray as $form){
				$dialog = $form == "formDataInsert" ? "Dialog_ThemMoi" : "Dialog_CapNhat";
				$titleDialog = $form == "formDataInsert" ? "THÊM MỚI THÔNG TIN ".$title : "CẬP NHẬT THÔNG TIN ".$title;
				//$pattern = "*";
				$pattern = "[";
				$pattern .= "0-9a-zA-Z";
				$pattern .= "ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêếềìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳýỵỷỹ";
				$pattern .= "\s@;_.,-]*";
				$primary_key = "";
				$strColumn = "";
				$strColumnDataType = "";
				$dataType = "";
				$arrayStrNameColPhone = array("sodienthoai", "phone", "sodienthoainguoithan");
				$dbObj = new classDb();
				$db_name = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['db_schema'];
				$sqlGetColumnInTable = "SELECT COLUMN_NAME, COLUMN_COMMENT, DATA_TYPE, IS_NULLABLE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION FROM information_schema.COLUMNS ";
				$sqlGetColumnInTable .= "WHERE TABLE_NAME = '{$table}' AND table_schema = '{$db_name}' AND COLUMN_COMMENT <> ''";
				$resultGetColumnInTable = $dbObj->SqlQueryOutputResult($sqlGetColumnInTable, array());
				$html = '<div class="modal fade" id="'.$dialog.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
					$html .= '<div class="modal-dialog '.$classModal.'" role="document">';
						$html .= '<div class="modal-content">';
							$html .= '<div class="modal-header">';
								$html .= '<h5 class="modal-title">'.$titleDialog.'</h5>';
								$html .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
							$html .= '</div>';
							$html .= '<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" role="form" method="post" id="'.$form.'">';
								$html .= '<div class="m-portlet__body">';
									$html .= '<div class="form-group m-form__group row">';
									while($rowGetColumnInTable = $resultGetColumnInTable->fetch()){
										if($rowGetColumnInTable["COLUMN_COMMENT"] == "pk"){
											$primary_key = $rowGetColumnInTable["COLUMN_NAME"];
										}else{
											$dataType = $this->covertToInputHtml($rowGetColumnInTable["DATA_TYPE"], $rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"]);
											$require = $rowGetColumnInTable["IS_NULLABLE"] == "YES" ? "required" : "";
											$maxlength = $rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"] != "" ? "maxlength='".$rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"]."'" : "maxlength='".$rowGetColumnInTable["NUMERIC_PRECISION"]."'";
											$textRequire = $rowGetColumnInTable["IS_NULLABLE"] == "YES" ? "<font color=red>Bắt buộc nhập</font><br>" : "";
											
											$html .= '<div class="col-lg-'.$col.'">';
												$html .= '<label class="'.$require.'">'.$rowGetColumnInTable["COLUMN_COMMENT"].':</label>';
												if($rowGetColumnInTable["DATA_TYPE"] == "smallint"){
													$require = $rowGetColumnInTable["IS_NULLABLE"] == "YES" ? "required" : "";
													$html .= $this->createSelectBox3($rowGetColumnInTable["COLUMN_NAME"],$require );
												}else if($rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"] == "199"){
													$html .= $this->createCheckBox($rowGetColumnInTable["COLUMN_NAME"]);
													$html .= '<input style="display:none" type="inputCheckBox" name="'.$rowGetColumnInTable["COLUMN_NAME"].'">';
												}else if($rowGetColumnInTable["DATA_TYPE"] == "int"){
													$html .= '<input pattern="[0-9,]*" type="text" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input currency" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'>';
												}else if($rowGetColumnInTable["COLUMN_NAME"] == "email"){
													$html .= '<div class="input-group">';
														$html .= '<input type="email" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'>';
														$html .= '<div class="input-group-append">';
															$html .= '<span class="input-group-text">';
																$html .= '<i class="fa fa-envelope-o"></i>';
															$html .= '</span>';
														$html .= '</div>';
													$html .= '</div>';
												}else if($rowGetColumnInTable["COLUMN_NAME"] == "password"){
													$html .= '<div class="input-group">';
														$html .= '<input type="password" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'>';
														$html .= '<div class="input-group-append">';
															$html .= '<span class="input-group-text">';
																$html .= '<i class="fa fa-lock"></i>';
															$html .= '</span>';
														$html .= '</div>';
													$html .= '</div>';
												}else if(preg_match('/web|url/', $rowGetColumnInTable["COLUMN_NAME"])){
													$html .= '<div class="input-group">';
														$html .= '<input type="url" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="Nhập theo định hạng http://...." '.$require.' '.$maxlength.'>';
														$html .= '<div class="input-group-append">';
															$html .= '<span class="input-group-text">';
																$html .= '<i class="fa fa-globe"></i>';
															$html .= '</span>';
														$html .= '</div>';
													$html .= '</div>';
												}else if(in_array($rowGetColumnInTable["COLUMN_NAME"], $arrayStrNameColPhone)){
													$html .= '<div class="input-group">';
														$html .= '<input pattern="[0-9]*" data-content="'.$textRequire.' Nhập số điện thoại, độ dài tối đa <code>'.$rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"].'</code> ký tự" type="tel" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'>';
														$html .= '<div class="input-group-append">';
															$html .= '<span class="input-group-text">';
																$html .= '<i class="fa fa-phone"></i>';
															$html .= '</span>';
														$html .= '</div>';
													$html .= '</div>';
												}else if($rowGetColumnInTable["DATA_TYPE"] == "date"){
													$html .= '<div class="input-group date">';
														$html .= '<input type="text" value="'.date("Y-m-d").'" readonly id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input datepicker" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.'>';
														$html .= '<div class="input-group-append">';
															$html .= '<span class="input-group-text">';
																$html .= '<i class="la la-calendar-check-o"></i>';
															$html .= '</span>';
														$html .= '</div>';
													$html .= '</div>';
												}else if($rowGetColumnInTable["DATA_TYPE"] == "tinyint"){
													$html .= '<div class="m-checkbox-list">';
														$html .= '<label class="m-checkbox">';
															$html .= '<input id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" value="1" type="checkbox"> Check vào ô';
															$html .= '<span></span>';
														$html .= '</label>';
													$html .= '</div>';
												}else if($rowGetColumnInTable["DATA_TYPE"] == "char"){
													$html .= $this->createRadioBox($rowGetColumnInTable["COLUMN_NAME"]);
												}else if($rowGetColumnInTable["DATA_TYPE"] == "text"){
													$html .= '<input accept="image/*" type="file" id="file_'.$rowGetColumnInTable["COLUMN_NAME"].'" name="file_'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.'>';
													$html .= '<div style="display:none" class="progressLoadImg_'.$rowGetColumnInTable["COLUMN_NAME"].' m-loader m-loader--danger" style="width: 30px; display: inline-block;"></div>';
													$html .= '<div class="loadImg">';
														$html .= '<img class="m_top_10" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" width=100% src="image/noimage.jpg"/>';
													$html .= '</div>';
													$html .= '<input id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" type="hidden">';
												}else if($rowGetColumnInTable["DATA_TYPE"] == "tinytext"){
													$html .= '<input id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" type="color">';
												}else if($rowGetColumnInTable["DATA_TYPE"] == "mediumtext"){
													$html .= '<textarea data-provide="markdown" type="'.$dataType.'" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'></textarea>';
												}else{
													if($dataType == "textarea"){
														$html .= '<textarea data-provide="markdown" type="'.$dataType.'" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'></textarea>';
													}else{
														$html .= '<input type="'.$dataType.'" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'>';
													}
												}
												$html .= '<input type=hidden id="user_id" name="user_id" value ="'.$_SESSION["session"]['Id'].'"/>';
												$html .= '<p class="has-error"></p>';
											$html .= '</div>';
										}
									}
									$html .= '</div>';
								$html .= '</div>';
								$html .= '<div class="modal-footer">';
									$button = "btnInsert";
									if($form == "formDataUpdate"){
										$button = "btnUpdate";
										$html .= '<input type=hidden id="'.$primary_key.'" name="'.$primary_key.'"/>';
									}
									$html .= '<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" id="'.$button.'" type="button"><i class="fa fa-print"></i> Lưu</button>';
									$html .= '<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning Close" data-dismiss="modal" type="button"><i class="fa fa-ban"></i> Hủy bỏ</button>';
								$html .= '</div>';
							$html .= '</form>';
						$html .= '</div>';
					$html .= '</div>';
				$html .= '</div>';
				echo $html;
			}
		}

		// tạo radio box theo id của cột
		function createCheckBox2(
			$table, // table
			$column1, // column1
			$column2, // column2
			$attribute = "", // required
			$where = "", // where
			$arrayData = array(), // split, data
			$content = "", // content
			$name = ""
		){
			$dbObj = new classDb();
			$sql = "select ".$column1.",".$column2." FROM `". $table ."` $where";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<div class="m-checkbox-inline">';
			$_name = !empty($name) ? $name : $column1;

			$array_data = array();
			if(!empty($arrayData)){
				$array_data = explode($arrayData[0], $arrayData[1]);
			}
			
			while($row = $result->fetch()){
				$checked = in_array($row[0], $array_data) ? " checked " : "";
				$attribute = (empty($checked) && !empty($arrayData[1])) ? str_replace("required", "", $attribute) : $attribute;
				$html .= '<label class="m-checkbox">';
					$html .= '<input '.$attribute.' '.$checked.' type="checkbox" value="' .$row[0]. '" name="'.$_name.'" class="chkCheckBox">';
					$html .= $row[$content]." ";
					$html .= $row[1];
					$html .= '<span></span>';
				$html .= '</label>';
			}
			$html .= '</div>';
			return $html;
        }

		// tạo select box theo id của cột
		function createSelectBox5(
			$table, 
			$column1, 
			$column2, 
			$attribute = "", 
			$class = "m-bootstrap-select m_selectpicker", 
			$name="",
			$where="",
			$columnData = array(),
			$selected = array()
		){
			$dbObj = new classDb();
			$columnOption = "";
			if(!is_array($columnData)){
				if(!empty($columnData)){
					$columnOption = ",".$columnData;
				}
			}else{
				for($i = 0; $i < count($columnData); $i++){
					$columnOption .= ",".$columnData[$i];
				}
			}
			$sql = "select ".$column1.",".$column2.$columnOption." FROM `". $table ."` $where";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<select '.$attribute.' id="' .$name. '" name="' .$name. '" class="form-control '.$class.'" data-live-search="true"> ';
			if(!is_array($selected)){
				//$html .= "<option value=''>Chọn</option>";
			}
			while($row = $result->fetch()){
				$select = "";
				if(is_array($selected)){
					$select = in_array($row[$column1], $selected) ? "selected" : "";
				}else{
					$select = $row[$column1] == $selected ? "selected" : "";
				}
				if(!is_array($columnData)){
					if(!empty($columnData)){
						$html .= "<option data-option='".$row[$columnData]."' ".$select." value='" .$row[$column1]. "'>" .$row[$column2]. "</option>";
					}else{
						$html .= "<option ".$select." value='" .$row[$column1]. "'>" .$row[$column2]. "</option>";
					}
				}else{
					$option_data = "";
					for($i = 0; $i < count($columnData); $i++){
						$option_data .= "data-option".$i."='".$row[$columnData[$i]]."' ";
					}
					$html .= "<option ".$option_data." ".$select." value='" .$row[$column1]. "'>" .$row[$column2]. "</option>";
				}
			}
			$html .= '</select>';
			return $html;
		}
		
		// Hàm tạo form Edit
		function createFormEdit($table, $title, $classModal = "", $col = 6)
		{
			$pattern = "[";
			$pattern .= "0-9a-zA-Z";
			$pattern .= "ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêếềìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ";
			$pattern .= "\s@_.,-]*";
			$primary_key = "";
			$strColumn = "";
			$strColumnDataType = "";
			$dataType = "";
			$dbObj = new classDb();
			$db_name = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['db_schema'];
			$sqlGetColumnInTable = "SELECT COLUMN_NAME, COLUMN_COMMENT, DATA_TYPE, IS_NULLABLE, CHARACTER_MAXIMUM_LENGTH, NUMERIC_PRECISION FROM information_schema.COLUMNS ";
			$sqlGetColumnInTable .= "WHERE TABLE_NAME = '{$table}' AND table_schema = '{$db_name}' AND COLUMN_COMMENT <> ''";
			$resultGetColumnInTable = $dbObj->SqlQueryOutputResult($sqlGetColumnInTable, array());
			$html = '<div class="modal fade" id="Dialog_CapNhat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
				$html .= '<div class="modal-dialog '.$classModal.'" role="document">';
					$html .= '<div class="modal-content">';
						$html .= '<div class="modal-header">';
							$html .= '<h5 class="modal-title">CẬP NHẬT THÔNG TIN '.$title.'</h5>';
							$html .= '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
						$html .= '</div>';
						$html .= '<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" role="form" method="post" id="formDataUpdate">';
							$html .= '<div class="m-portlet__body">';
								$html .= '<div class="form-group m-form__group row">';
								while($rowGetColumnInTable = $resultGetColumnInTable->fetch()){
									if($rowGetColumnInTable["COLUMN_COMMENT"] == "pk"){
										$primary_key = $rowGetColumnInTable["COLUMN_NAME"];
									}else{
										$dataType = $this->covertToInputHtml($rowGetColumnInTable["DATA_TYPE"], $rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"]);
										$require = $rowGetColumnInTable["IS_NULLABLE"] == "YES" ? "required" : "";
										$maxlength = $rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"] != "" ? "maxlength='".$rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"]."'" : "maxlength='".$rowGetColumnInTable["NUMERIC_PRECISION"]."'";
										$textRequire = $rowGetColumnInTable["IS_NULLABLE"] == "YES" ? "<font color=red>Bắt buộc nhập</font><br>" : "";
										
										$html .= '<div class="col-lg-'.$col.'">';
											$html .= '<label class="'.$require.'">'.$rowGetColumnInTable["COLUMN_COMMENT"].':</label>';
											if($rowGetColumnInTable["DATA_TYPE"] == "smallint"){
												
												$html .= $this->createSelectBox3($rowGetColumnInTable["COLUMN_NAME"]);
											}else if($rowGetColumnInTable["DATA_TYPE"] == "int"){
												$html .= '<input pattern="[0-9,]*" data-content="'.$textRequire.' Nhập kiểu số, độ dài tối đa <code>'.$rowGetColumnInTable["NUMERIC_PRECISION"].'</code> ký tự" type="text" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input currency" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'>';
											}else{
												if($dataType == "textarea"){
													$html .= '<textarea data-content="'.$textRequire.' Cho phép nhập tối đa <code>'.$rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"].$rowGetColumnInTable["NUMERIC_PRECISION"].'</code> ký tự" type="'.$dataType.'" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'></textarea>';
												}else{
													$html .= '<input pattern="'.$pattern.'" data-content="'.$textRequire.' Cho phép nhập tối đa <code>'.$rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"].$rowGetColumnInTable["NUMERIC_PRECISION"].'</code> ký tự" type="'.$dataType.'" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'>';
												}
											}
											$html .= '<p class="has-error"></p>';
										$html .= '</div>';
									}
								}
								$html .= '</div>';
							$html .= '</div>';
							$html .= '<div class="modal-footer">';
								$html .= '<input type=hidden id="'.$primary_key.'" name="'.$primary_key.'"/>';
								$html .= '<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-primary m-btn--gradient-to-info" id="btnUpdate" type="button"><i class="fa fa-print"></i> Lưu</button>';
								$html .= '<button class="btn m-btn--pill m-btn--air m-btn m-btn--gradient-from-danger m-btn--gradient-to-warning Close" data-dismiss="modal" type="button"><i class="fa fa-ban"></i> Hủy bỏ</button>';
							$html .= '</div>';
						$html .= '</form>';
					$html .= '</div>';
				$html .= '</div>';
			$html .= '</div>';
			echo $html;
		}
		
		function covertToInputHtml($dataType, $maxlength = 0)
        {
			if($dataType == "varchar" && $maxlength > 100){
				return "textarea";
			}else if($dataType == "varchar"){
				return "text";
			} 
		}
		
		// Hàm upload file
		function uploadFile()
        {
			$location = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['location'];
			$frontpage = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['frontpage'];
			if ( 0 < $_FILES['file']['error'] ) {
				echo 'Error: ' . $_FILES['file']['error'] . '<br>';
			}
			else {
				$src_hinhanh = date('y-m-d-H-i-s')."_".$_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], $location.'/file_upload/' .$src_hinhanh);
				echo $frontpage.'/file_upload/' .$src_hinhanh;
			}
		}
		
		// Hàm select Common
        function createTableList($table, $com_name, $WHERE = "")
        {
			$primary_key = "";
			$strColumn = "";
			$strColumnDataType = "";
			//$component = '<button  data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#Dialog_CapNhat" class="btn btn-primary btn-xs btnLoadDataEdit"><i class="fa fa-pencil"></i></button>';
			//$component = '<a href="#" onclick="loadDataEdit(this,\''.$com_name.'\')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Xem chi tiết"><i class="la la-edit"></i></a>';
			//$component .= ' <button onclick="deleteData(this,\''.$com_name.'\')" class="btn btn-danger btn-xs btnDelete"><i class="fa fa-trash-o "></i></button>';
			//$component .= ' <a href="#" onclick="deleteData(this,\''.$com_name.'\')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
			$dbObj = new classDb();
			$db_name = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['db_schema'];
			$sqlGetColumnInTable = "SELECT COLUMN_NAME, COLUMN_COMMENT, DATA_TYPE FROM information_schema.COLUMNS ";
			$sqlGetColumnInTable .= "WHERE TABLE_NAME = '{$table}' AND table_schema = '{$db_name}' AND COLUMN_COMMENT <> ''";
			$resultGetColumnInTable = $dbObj->SqlQueryOutputResult($sqlGetColumnInTable, array());
			$html = '<table class="m-datatable" id="html_table" width="100%">';
			$html .= "<thead><tr>";
			while($rowGetColumnInTable = $resultGetColumnInTable->fetch()){
				if($rowGetColumnInTable["COLUMN_COMMENT"] == "pk"){
					$primary_key = $rowGetColumnInTable["COLUMN_NAME"];
				}else{
					$strColumn .= $rowGetColumnInTable["COLUMN_NAME"]. ",";
					$strColumnDataType .= $rowGetColumnInTable["DATA_TYPE"]. ",";
					$html .= '<th>';
					$html .= $rowGetColumnInTable["COLUMN_COMMENT"];
					$html .= '</th>';
				}
			}
			$strColumn = substr($strColumn, 0, strlen($strColumn)-1);
			$strColumnDataType = substr($strColumnDataType, 0, strlen($strColumnDataType)-1);
			$column = explode(",", $strColumn);
			$dataType = explode(",", $strColumnDataType);
			//$html .= '<th></th>';
			$html .= "</tr></thead><tbody>";
			$sql = "SELECT {$primary_key},{$strColumn} FROM {$table} {$WHERE} ORDER BY INSERT_DATE DESC";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			while($row = $result->fetch()){
				for($col = 0; $col < count($column); $col++){
					$html .= '<td>';
					$html .= $row[$column[$col]];
					$html .= '</td>';
				}
				$html .= '<td colname="'.$primary_key.'">';
						$html .= '<input type=hidden id="'.$primary_key.'" name="'.$primary_key.'" value="'.$row[$primary_key].'"/>';
						$html .= $component;
					$html .= '</td>';
				$html .= '</tr>';
			}
			$html .= '</tbody></table>';
			echo $html;
		}
		
		// Hàm tạo danh sách array để hiển thị trên datalist
        function createArrayList($table)
        {
			$dbObj = new classDb();
			$string = "";
			$sql = "SELECT * FROM {$table}";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			while($row = $result->fetch()){
				$string .= $row[0].":{'title':'".$row[1]."'},";
			}
			return $string;
		}
		
		// Hàm Insert Common
        function insertTable($table)
        {
			$fields = array();
			$values = array();
			if (isset($_POST) && !empty($_POST)) {
				foreach ($_POST as $key => $val) {
					$fields[] = $key;
					$values[] = $val;
				}
			}
			array_splice($fields, -1, 1);
			array_splice($values, -1, 1);
			$numFields = count($fields);
			$numValues = count($values);

			if($numFields === 0 or $numValues === 0)
				throw new Exception("At least one field and value is required.");
			if($numFields !== $numValues)
				throw new Exception("Mismatched number of field and value arguments.");
			
			$fields = '`' . implode('`,`', $fields) . '`';
			$values = "'" . implode("','", $values) . "'";
			$sql = "INSERT INTO {$table} ($fields) VALUES($values)";
			$dbObj = new classDb();
			if ($dbObj->SqlQueryInputResult($sql, array())){
				return true;
			}else{
				return false;
			}
        }
		
		// Hàm Update Common
        function updateTable($table, $where="")
        {
			$fields = array();
			//print_r($_POST);
			if (isset($_POST) && !empty($_POST)) {
				foreach ($_POST as $key => $val) {
					$fields[] = $key . "='" . $val ."'";
				}
			}
			array_splice($fields, -1, 1);
			$numFields = count($fields);
			$fields = implode(', ', $fields);
			print_r($fields);
			$sql = "Update {$table} SET {$fields} WHERE {$where}";
			$dbObj = new classDb();
			if ($dbObj->SqlQueryInputResult($sql, array())){
				return true;
			}else{
				return false;
			}
        }
		 function updateTable_($table, $where="")
        {
			$fields = array();
			//print_r($_POST);
			if (isset($_POST) && !empty($_POST)) {
				foreach ($_POST as $key => $val) {
					$fields[] = $key . "='" . $val ."'";
				}
			}
			//array_splice($fields, -1, 1);
			$numFields = count($fields);
			$fields = implode(', ', $fields);
		//	print_r($fields);
			$sql = "Update {$table} SET {$fields} WHERE {$where}";
			$dbObj = new classDb();
			if ($dbObj->SqlQueryInputResult($sql, array())){
				return true;
			}else{
				return false;
			}
        }
		// tạo select box theo bảng master
        function createSelectBox($MstTable, $Name, $class="", $where="")
        {
			$table = explode("_", $MstTable);
			$column = "`".$table[1]."_value`, `".$table[1]."_name`";
			$dbObj = new classDb();
            $sql = "select " .$column. " from `" . $MstTable ."` Where DELETE_FLAG = 0 {$where} order by DISP_ORDER";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<select name="' .$Name. '" class="' .$class. '" id="' .$Name. '"> ';
			while($row = $result->fetch()){
				$html .= "<option value='" .$row[0]. "'>" .$row[1]. "</option>";
			}
			$html .= '</select>';
			echo $html;
        }
		
		function createSelectSL($MstTable, $Name, $class="", $where="", $selected = "")
		{
			$dbObj = new classDb();
			$sql = "select * from `" . $MstTable ."` {$where}";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<select name="' .$Name. '" class="' .$class. '"> ';
			while($row = $result->fetch()){
				$select = $row[0] == $selected ? "selected" : "";
				$html .= "<option ".$select." value='" .$row[0]. "'>" .$row[1]. "</option>";
			}
			$html .= '</select>';
			echo $html;
		}
		// tạo select box theo id của cột
        function createSelectBox3($columnId, $required = "")
        {	
			$db_name = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['db_schema'];
			$arrayCol = explode("_", $columnId);
			$dbObj = new classDb();
			$sqlSelectTable = "SELECT table_name FROM information_schema.tables ";
			$sqlSelectTable .= "WHERE table_schema = '".$db_name."' ";
			$sqlSelectTable .= "AND table_name like '%".$arrayCol[0]."%' LIMIT 1";
			$resultSelectTable = $dbObj->SqlQueryOutputResult($sqlSelectTable, array());
			$rowSelectTable = $resultSelectTable->fetch();
			$table = $rowSelectTable["table_name"];
            $sql = "select * FROM `" . $table ."`";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<select '.$required.' name="' .$columnId. '" class="form-control m-bootstrap-select m_selectpicker" data-live-search="true" id="' .$columnId. '"> ';
				$html .= "<option value=''>Chọn</option>";
			while($row = $result->fetch()){
				$html .= "<option value='" .$row[0]. "'>" .$row[1]. "</option>";
			}
			$html .= '</select>';
			return $html;
        }
		function createSelectDM($columnId, $required = "", $options = "", $class = "form-control m-bootstrap-select m_selectpicker")
		{	
			$db_name = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['db_schema'];
			$arrayCol = explode("_", $columnId);
			$dbObj = new classDb();
			$sqlSelectTable = "SELECT table_name FROM information_schema.tables ";
			$sqlSelectTable .= "WHERE table_schema = '".$db_name."' ";
			$sqlSelectTable .= "AND table_name like '%".$arrayCol[0]."%' LIMIT 1";
			$resultSelectTable = $dbObj->SqlQueryOutputResult($sqlSelectTable, array());
			$rowSelectTable = $resultSelectTable->fetch();
			$table = $rowSelectTable["table_name"];
			$sql = "select * FROM `" . $table ."` ".$options;
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<select '.$required.' name="' .$columnId. '" class="'.$class.'" data-live-search="true" id="' .$columnId. '"> ';
			while($row = $result->fetch()){
				$html .= "<option value='" .$row[0]. "'>" .$row[1]. "</option>";
			}
			$html .= '</select>';
			return $html;
		}
		// tạo radio box theo id của cột
        function createRadioBox($columnId)
        {	
			$db_name = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['db_schema'];
			$arrayCol = explode("_", $columnId);
			$dbObj = new classDb();
			$sqlSelectTable = "SELECT table_name FROM information_schema.tables ";
			$sqlSelectTable .= "WHERE table_schema = '".$db_name."' ";
			$sqlSelectTable .= "AND table_name like '%".$arrayCol[0]."%' LIMIT 1";
			$resultSelectTable = $dbObj->SqlQueryOutputResult($sqlSelectTable, array());
			$rowSelectTable = $resultSelectTable->fetch();
			$table = $rowSelectTable["table_name"];
            $sql = "select * FROM `" . $table ."`";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<div class="m-radio-inline">';
			while($row = $result->fetch()){
				$html .= '<label class="m-radio">';
					$html .= '<input type="radio" value="' .$row[1]. '" name="' .$columnId. '" id="' .$columnId. '" value="1">';
					$html .= $row[1];
					$html .= '<span></span>';
				$html .= '</label>';
			}
			$html .= '</div>';
			return $html;
        }
		
		// tạo radio box theo id của cột
        function createCheckBox($columnId, $content = "")
        {	
			$db_name = $GLOBALS['MAP'][$_SERVER['SERVER_NAME']]['db_schema'];
			$arrayCol = explode("_", $columnId);
			$dbObj = new classDb();
			$sqlSelectTable = "SELECT table_name FROM information_schema.tables WHERE table_schema = '".$db_name."' ";
			$sqlSelectTable .= "AND table_name like '%".$arrayCol[0]."%' LIMIT 1";
			$resultSelectTable = $dbObj->SqlQueryOutputResult($sqlSelectTable, array());
			$rowSelectTable = $resultSelectTable->fetch();
			$table = $rowSelectTable["table_name"];
            $sql = "select * FROM `" . $table ."`";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<div class="m-checkbox-inline">';
			while($row = $result->fetch()){
				$html .= '<label class="m-checkbox">';
					$html .= '<input type="checkbox" value="' .$row[0]. '" class="chkCheckBox ' .$columnId. '">';
					$html .= $row[$content]." ";
					$html .= $row[1];
					$html .= '<span></span>';
				$html .= '</label>';
			}
			$html .= '</div>';
			return $html;
		}
		
		// tạo select box theo bảng khác
        function createSelectBox2($table, $column, $Name="", $class="", $required="")
        {
			$dbObj = new classDb();
			$array = explode(",", $column);
            $sql = "select " .$column. " from `" . $table ."`";
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$html = '<select '.$required.' name="' .$Name. '" class="' .$class. '" id="' .$Name. '"> ';
			$html .= "<option value=''>Tất cả</option>";
			while($row = $result->fetch()){
				$html .= "<option value='" .$row[0]. "'>" .$row[1]. "</option>";
			}
			$html .= '</select>';
			echo $html;
        }
		
		// đếm dữ liệu
        function countColumnInTable($table, $column, $where="")
        {
			$dbObj = new classDb();
            $sql = "SELECT COUNT({$column}) as total FROM {$table} {$where}";
			//echo $sql;
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$row = $result->fetch();
			return $row["total"];
        }
        
		function getMaxLengthAttr($table, $column){
			$sql = "SELECT CHARACTER_MAXIMUM_LENGTH ";
			$sql .= "FROM information_schema.columns ";
			$sql .= "WHERE table_schema = DATABASE() AND ";
			$sql .= "table_name = '".$table."' AND COLUMN_NAME = '".$column."'";
			$dbObj = new classDb();
			$result = $dbObj->SqlQueryOutputResult($sql, array());
			$row = $result->fetch();
			echo $row[0];
		}
		
        // ham kiem tra su hop le cua file(kiem tra file co ton tai)
        function _routers( $file_path )
        {
            if( file_exists( $file_path ) ){
                return true;
            } else {
                return false;
            }
        }

        // ham nay tra ve tap hop mang la cac gia tri trong tung cap the / cua URL
        function _extract_url( $uri, $split )
        {
            $url = strip_tags( $uri );
            $url_array = explode($split, $url);
            // loai bo 1 gia tri dau trong URI
            //array_shift($url_array);
            return $url_array;
        }

        /* ham chuyen trang */
        function _redirect( $url )
        {
            /*kiem tra neu header already by send thi chuyen trang = script nguoc lai chuyen trang = code server*/
            if (headers_sent()) {
                echo "<script>document.location.href='$url';</script>\n";
            } else {
                ob_end_clean(); // clear output buffer
                header( 'HTTP/1.1 301 Moved Permanently' );
                header( "Location: $url" );
            }
            exit();
        }
        // ham dinh dang kieu ngay thang
        function _formatdatetime( $date )
        {
            //return substr($date, -4) ."/". substr($date, 3, 2) ."/". substr($date, 0, 2) . " ".  date('h:i:s');
			$month = intval(substr($date, 3, 2)); $day = intval(substr($date, 0, 2)); $year = intval(substr($date, 6, 4));
			$hour = intval(substr($date, 11, 2)); $minute = intval(substr($date, 14, 2)); $second = intval(substr($date, -2));
            return mktime($hour, $minute, $second, $month, $day, $year);
        }

        // ham dinh dang kieu nagy thang
        function _formatdate($stringDate)
        {
            $date = str_replace('/', '-', $stringDate);
			$date = date("Y-m-d", strtotime($date));
			return $date;
        }
		// ham dinh dang kieu nagy thang
        function getLastDayOfMonth($year, $month)
        {
            return $date = date('t', strtotime($year."-".substr("0".$month, -2)."-01"));
        }
		/*
		function datediff( $date1, $date2 )
        {
            //$month = intval(substr($date, 3, 2)); $day = intval(substr($date, 0, 2)); $year = intval(substr($date, -4));
			$date1 = intval(substr($date1, 3, 2))."/".intval(substr($date1, 0, 2))."/".intval(substr($date1, -4));
			$date2 = intval(substr($date2, 3, 2))."/".intval(substr($date2, 0, 2))."/".intval(substr($date2, -4));
			return round(abs(strtotime($date1) - strtotime($date2))/86400);
        }
		*/
		// ham su ly lay so giay giua khoang thoi gian bat dau va thoi gian ket thuc
		// $start_date: datatype = mktime
		// $end_date: datatype = mktime
		function time_diff($start_date, $end_date){
			$start_date = date('U', $start_date);
			$end_date	= date('U', $end_date);
			return ($end_date - $start_date);
		
		}
		// ham su ly lay so ngay giua khoang thoi gian bat dau va thoi gian ket thuc
		function date_diff($start, $end="NOW")
		{
			$sdate = strtotime($start);
			$edate = strtotime($end);
	
			$time = $edate - $sdate;
			if($time>=0 && $time<=59) {
					// Seconds
					$timeshift = $time.' seconds ';
	
			} elseif($time>=60 && $time<=3599) {
					// Minutes + Seconds
					$pmin = ($edate - $sdate) / 60;
					$premin = explode('.', $pmin);
					
					$presec = $pmin-$premin[0];
					$sec = $presec*60;
					
					$timeshift = $premin[0].' min '.round($sec,0).' sec ';
	
			} elseif($time>=3600 && $time<=86399) {
					// Hours + Minutes
					$phour = ($edate - $sdate) / 3600;
					$prehour = explode('.',$phour);
					
					$premin = $phour-$prehour[0];
					$min = explode('.',$premin*60);
					
					$presec = '0.'.$min[1];
					$sec = $presec*60;
	
					$timeshift = $prehour[0].' hrs '.$min[0].' min '.round($sec,0).' sec ';
	
			} elseif($time>=86400) {
					// Days + Hours + Minutes
					$pday = ($edate - $sdate) / 86400;
					$preday = explode('.',$pday);
	
					$phour = $pday-$preday[0];
					$prehour = explode('.',$phour*24); 
	
					$premin = ($phour*24)-$prehour[0];
					$min = explode('.',$premin*60);
					
					$presec = '0.'.$min[1];
					$sec = $presec*60;
					
					$timeshift = $preday[0].' days '.$prehour[0].' hrs '.$min[0].' min '.round($sec,0).' sec ';
	
			}
			return $timeshift;
		}

		// Nhấp vào lick trong email là kích hoạt tài khoản
		function active($makichhoat)
        {
			$count = $this->countColumnInTable("taikhoan", "makichhoat", "WHERE makichhoat = '".$makichhoat."'");
			if($count>0){
				$dbObj = new classDb();
				$sql = "UPDATE taikhoan SET Trangthai = 1, makichhoat = 0 WHERE makichhoat = ? AND makichhoat <> 0";
				$dbObj->SqlQueryInputResult($sql, array($makichhoat));
				return true;
			}else{
				return false;
			}
		}
		
        // ham loai bo ky tu dac biet trong chuoi khi lay ra
        function txt_htmlspecialchars($data="")
        {
            // Fix &entity\n;
			$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
			$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
			$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
			$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

			// Remove any attribute starting with "on" or xmlns
			$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

			// Remove javascript: and vbscript: protocols
			$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
			$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
			$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

			// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
			$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
			$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
			$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

			// Remove namespaced elements (we do not need them)
			$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
			$data = preg_replace( "'<script[^>]*>.*?</script>'si", "", $data );
            $data = preg_replace( '/{.+?}/', '', $data);

            $data = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is','\2', $data );

            // replace line breaking tags with whitespace
            $data = preg_replace( "'<(br[^/>]*?/|hr[^/>]*?/|/(div|h[1-6]|li|p|td))>'si", ' ', $data );
			do
			{
				// Remove really unwanted tags
				$old_data = $data;
				$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
			}
			while ($old_data !== $data);

			// we are done...
			return $data;
        }

        // ham go bo dau cua 1 chuoi
        function _removesigns($text, $remove_space = true)
        {
            //global $ibforums;<BR>//Charachters must be in ASCII and certain ones aint allowed
            $text = html_entity_decode ($text);
            $text = preg_replace('/(ä|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $text);
            $text = str_replace('ç','c',$text);
            $text = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $text);
            $text = preg_replace('/(ì|í|î|ị|ỉ|ĩ)/', 'i', $text);
            $text = preg_replace('/(ö|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $text);
            $text = preg_replace('/(ü|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $text);
            $text = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $text);
            $text = preg_replace('/(đ)/', 'd', $text);
            //CHU HOA
            $text = preg_replace('/(Ä|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/', 'A', $text);
            $text = str_replace('Ç','C',$text);
            $text = preg_replace('/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/', 'E', $text);
            $text = preg_replace('/(Ì|Í|Ị|Ỉ|Ĩ)/', 'I', $text);
            $text = preg_replace('/(Ö|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/', 'O', $text);
            $text = preg_replace('/(Ü|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/', 'U', $text);
            $text = preg_replace('/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/', 'Y', $text);
            $text = preg_replace('/(Đ)/', 'D', $text);
            //Special string
            
            //$text = preg_replace('/( |!|”|#|$|%|’)/', ', $text);
            //$text = preg_replace('/(̀|́|̉|$|&gt;)/', ', $text);
            //$text = preg_replace (''&lt;[\/\!]*?[^&lt;&gt;]*?&gt;'si', '', $text);
            

            $text = str_replace(' / ','-',$text);
			$text = str_replace('(','',$text);
			$text = str_replace(')','',$text);
			$text = str_replace(',','',$text);
			$text = str_replace(';','',$text);
			$text = str_replace('.','',$text);
            $text = str_replace('/','-',$text);
            $text = str_replace(' - ','-',$text);
			$text = str_replace('_','-',$text);
			$text = str_replace(':','-',$text);
            
            if ($remove_space) {
            	$text = str_replace(' ','-',$text);
			}
            
            $text = str_replace( 'ß', 'ss', $text);
            $text = str_replace( '&amp;', '', $text);
            $text = str_replace( '%', '', $text);
            $text = preg_replace('[^A-Za-z0-9-]', '', $text);
			$text = strtolower($text);

            $text = str_replace('—-','-',$text);
            $text = str_replace('—','-',$text);
            $text = str_replace('–','-',$text);
            return $text;
        }

        function SmartContent( $text, $length=200 )
        {
            // strips tags won't remove the actual jscript
            $text = preg_replace( "'<script[^>]*>.*?</script>'si", "", $text );
            $text = preg_replace( '/{.+?}/', '', $text);

            $text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is','\2', $text );

            // replace line breaking tags with whitespace
            $text = preg_replace( "'<(br[^/>]*?/|hr[^/>]*?/|/(div|h[1-6]|li|p|td))>'si", ' ', $text );

            $text = core_class::SmartSubstr( strip_tags( $text ), $length );

            return $text;
        }

        function SmartSubstr($text, $length=200)
        {
            $strlength = strlen($text);
            if ($strlength > $length) {
                $str = substr($text, 0, $length);
                $text = substr( $str, 0, strrpos($str, " ") );
                return $text . " ...";
            } else {
                return $text;
            }
        }

        function convertIntToMoney($y)
        {
            $y = strrev($y);
            $x = str_split($y, 3);
            $len = count($x);
            $pos = 0;
            $y = "";
            while($pos+1 != $len)
            {
                $y = $y.$x[$pos].',';
                $pos++;
            }
            $y = $y.$x[$pos];
            $y = strrev($y);
            return $y;
        }
		
		// ma hoa password
        function enscriptPass( $pass )
        {            
            return md5(sha1(md5($pass)));
        }

        function convertXmlObjToArr($obj, &$arr) 
        { 
            $children = $obj->children(); 
            foreach ($children as $elementName => $node) 
            { 
                $nextIdx = count($arr); 
                $arr[$nextIdx] = array(); 
                $arr[$nextIdx]['@name'] = strtolower((string)$elementName); 
                $arr[$nextIdx]['@attributes'] = array(); 
                $attributes = $node->attributes(); 
                foreach ($attributes as $attributeName => $attributeValue) 
                { 
                    $attribName = strtolower(trim((string)$attributeName)); 
                    $attribVal = trim((string)$attributeValue); 
                    $arr[$nextIdx]['@attributes'][$attribName] = $attribVal; 
                } 
                $text = (string)$node; 
                $text = trim($text); 
                if (strlen($text) > 0)
                { 
                    $arr[$nextIdx]['@text'] = $text; 
                } 
                $arr[$nextIdx]['@children'] = array(); 
                core_class::convertXmlObjToArr($node, $arr[$nextIdx]['@children']); 
            } 
            return; 
        }

        // convert string to array
        function convertStrToArr( $str, $split )
        {
            $array = explode( $split, $str );
            return $array; 
        }

        function match_url($input)
        {
            preg_match('@^(?:http://)?([^/]+)@i', $input, $matches);
            return $matches[1];
        }

        function isValidEmail($email)
        {
            return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email);
        }
		
	// ham php send mail SMTP cho ung vien
	public function smtpSendMailCandidate($EmailSubject, $MailContent, $EmailSendToAddress) {	
		
		date_default_timezone_set('Asia/Ho_Chi_Minh');	
		require_once('libraries/mailler/class.phpmailer.php');
		$mail             = new PHPMailer();
		$body             = $MailContent;
		$mail->IsSMTP();
		$mail->SMTPDebug  = 2;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host       = "smtp.yandex.com";
		$mail->Port       = 465;
		$mail->Username   = "info@yteviec.com"; 
		$mail->Password   = "Pass!212";		
		$mail->Subject    = $EmailSubject;
		$mail->AltBody    = "Để xem tin này, vui lòng bật tương thích chế độ hiển thị mã HTML!";
		$mail->MsgHTML($MailContent);
		$mail->SetFrom('info@yteviec.com', 'Y Tế Việc');
		$address = $EmailSendToAddress; 
		$mail->AddAddress($address, "Customer");
		return $mail->Send();
	}

	function sendMailWithTemplate($titleMail, $mailContent){
		ob_start();
		include_once("protected/emailcontent.php");
		$mail_content = ob_get_contents();
		ob_end_clean();
		return $mail_content;
	}
	
	public function smtpSendMailContact($EmailSubject, $MailContent, $EmailSendToAddress, $EmailSendToName) {
		date_default_timezone_set('Asia/Krasnoyarsk');
		require_once('libraries/mailler/class.phpmailer.php');
        require_once('libraries/mailler/class.smtp.php');
		$mail             = new PHPMailer();
		$body             = $MailContent;
		$body             = eregi_replace("[\]",'',$body);
		$mail->IsSMTP();
		$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		
		/*
		$mail->SMTPSecure = "ssl";               // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";        // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = $MailAccount;  			// GMAIL username
		$mail->Password   = $MailPass;            // GMAIL password
		*/
		
		$mail->Host       = $GLOBALS['APP']['config']['smtp']['host'];             // "221.133.1.59"; sets GMAIL as the SMTP server
		$mail->Port       = $GLOBALS['APP']['config']['smtp']['port']; //465;                             // 25; set the SMTP port for the GMAIL server
		$mail->Username   = $GLOBALS['APP']['config']['smtp']['username'];    // GMAIL username
		$mail->Password   = $GLOBALS['APP']['config']['smtp']['password']; // GMAIL password
		
		$mail->SetFrom($EmailSendToAddress, $EmailSendToName);        // Định danh người gửi		
		
		$mail->AddReplyTo($EmailSendToAddress, $EmailSendToName); //Định danh người sẽ nhận trả lời
		
		$mail->Subject    = $EmailSubject; //Tiêu đề Mail
		
		$mail->AltBody    = "Để xem tin này, vui lòng bật tương thích chế độ hiển thị mã HTML!"; // optional, comment out and test
		
		$mail->MsgHTML($MailContent);
		
		$address = $EmailSendToAddress; //Địa chỉ mail cần gửi tới
		$mail->AddAddress($address, $EmailSendToName); //Gửi tới ai ?
		
		//$mail->AddAttachment("dinhkem/02.jpg");      // Đính kèm
		//$mail->AddAttachment("dinhkem/200_100.jpg"); // Đính kèm
		
		if(!$mail->Send()) {	
			return false;
			//echo "Lỗi gửi mail: " . $mail->ErrorInfo;
		} else {
			return true;
			//echo "moi thu ok ma: " . $mail->ErrorInfo;
		}

	}
	
	// ham php send mail SMTP cho ung vien
	public function smtpSendMailEmployer($MailAccount, $MailPass, $EmailSubject, $MailContent, $EmailSendToAddress, $EmailSendToName) {
		date_default_timezone_set('Asia/Krasnoyarsk');
		require_once('../mailler/class.phpmailer.php');
		//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
		$mail             = new PHPMailer();
		$body             = $MailContent;
		$body             = preg_replace("[\]",'',$body);
		
		$mail->IsSMTP();
		$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";               // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";        // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = $MailAccount;  			// GMAIL username
		$mail->Password   = $MailPass;            // GMAIL password
		
		$mail->SetFrom($MailAccount, 'www.teacher24h.vn'); //Định danh người gửi
		
		$mail->AddReplyTo($MailAccount,"www.teacher24h.vn"); //Định danh người sẽ nhận trả lời
		
		$mail->Subject    = $EmailSubject; //Tiêu đề Mail
		
		$mail->AltBody    = "Để xem tin này, vui lòng bật tương thích chế độ hiển thị mã HTML!"; // optional, comment out and test
		
		$mail->MsgHTML($body);
		
		$address = $EmailSendToAddress; //Địa chỉ mail cần gửi tới
		$mail->AddAddress($address, $EmailSendToName); //Gửi tới ai ?
		
		//$mail->AddAttachment("dinhkem/02.jpg");      // Đính kèm
		//$mail->AddAttachment("dinhkem/200_100.jpg"); // Đính kèm
		
		if(!$mail->Send()) {	
			return false;
			//echo "Lỗi gửi mail: " . $mail->ErrorInfo;
		} else {
			return true;
			//echo "moi thu ok ma: " . $mail->ErrorInfo;
		}

	}
		
		function genRandomString($length) {
			$length = $length;// chieu dai chuoi ky tu random
			$characters = '0123456789';
			$string = null;    
			for ($p = 0; $p < $length; $p++) {
				$string .= $characters[mt_rand(0, strlen($characters) -1)];
			}
			return $string;
		}

        //Phương thức chống SQL Injection
        public function sqlQuote( $value )
        {
            //Kiểm tra xem version PHP bạn sử dụng có hiểu hàm mysql_real_escape_string() hay ko

            if ($this->real_escape_string_exists) {
                //Trường hợp sử dụng PHP v4.3.0 trở lên
                //PHP hiểu hàm mysql_real_escape_string()

                if( $this->magic_quotes_active ) { 
                    //Trong trường hợp PHP đã hỗ trợ hàm get_magic_quotes_gpc()
                    //Ta sử dụng hàm stripslashes để bỏ qua các dấu slashes
                    $value = stripslashes( $value ); 
                }
                $value = mysql_real_escape_string( $value );
            } 
            else {
                //Trường hợp dùng cho các version PHP dưới 4.3.0
                //PHP không hiểu hàm mysql_real_escape_string()

                if( !$this->magic_quotes_active ){ 
                    //Trong trường hợp PHP không hỗ trợ hàm get_magic_quotes_gpc()
                    //Ta sử dụng hàm addslashes để thêm các dấu slashes vào giá trị
                    $value = addslashes( $value ); 
                }
                // Nếu hàm get_magic_quotes_gpc() đã active có nghĩa là các dấu slashes đã tồn tại rồi
            }
            return $value;
        } 

        function xss_clean($var)
        {
            static
            $preg_find    = array('#^javascript#i', '#^vbscript#i'),
            $preg_replace = array('java script',   'vb script');

            return preg_replace($preg_find, $preg_replace, htmlspecialchars(trim($var)));
        }

        function htmlsql_cleans($s)
        {		
            $s = preg_replace("#&(?!\#[0-9]+;)#si", "&amp;", $s); // Fix & but allow unicode
            $s = str_replace('<javascript>', 'java script', $s);
            $s = str_replace('<vbscript>',   'vb script', $s);
            $s = str_replace("<","&lt;",$s);
            $s = str_replace(">","&gt;",$s);
            $s = str_replace('"','\"',$s);
            $s = str_replace("  ", "&nbsp;&nbsp;", $s);
            $s = str_replace("'","\'",$s);
            return strip_tags($s);
        }


        // #############################################################################
        /**
        * Unicode-safe version of htmlspecialchars()
        *
        * @param	string	Text to be made html-safe
        *
        * @return	string
        */
        function htmlspecialchars_uni($text, $entities = true)
        {
            return str_replace(
                // replace special html characters
                array('<', '>', '"'),
                array('&lt;', '&gt;', '&quot;'),
                preg_replace(
                    // translates all non-unicode entities
                    '/&(?!' . ($entities ? '#[0-9]+|shy' : '(#[0-9]+|[a-z]+)') . ';)/si',
                    '&amp;',
                    $text
                )
            );
        }

        // #############################################################################
        /**
        * so sanh gia tri id trong 1 mang gia tri id _checkIdinArray()()
        *
        * @param	id , array id
        *
        * @return	true/false
        */
        function _checkIdinArray( $id, $array )
        {
            $arrayId = explode(",", $array);
            for($i = 0; $i < count($arrayId); $i++){
                if( $id == $arrayId[$i]) return true;
            }
        }
		
		// #############################################################################
        /**
        * lay gia tri cot so thu tu lon nhat trong ban dc chi dinh
        *
        * @param	colum , table
        *
        * @return	max id
        */
		function process_getmaxid($table, $column)
        {
            $sql = "select MAX(`$column`)+1 As `MaxId` from `$table`;";
			
			$dbObj = new classDb();
			
            $result = $dbObj->SqlQueryOutputResult($sql, array(0));

            if ($row = $result->fetch()) {
                if ($row['MaxId'] == 0) {
                    return 1;
                }
                else {
                    return $row['MaxId'];
                }
            }
        }
		
		function process_get_code($table, $column)
        {
            $sql = "select MAX(`$column`) As `code` from `$table`;";
			
			$dbObj = new classDb();
			
            $result = $dbObj->SqlQueryOutputResult($sql, array(0));

            if ($row = $result->fetch()) {
                if ($row['code'] == "") {
                    return "";
                }
                else {
                    return $row['code'];
                }
            }
        }
		
        // #############################################################################
        /**
        * load cac module trong hệ thống
        *
        * @param	id , array id
        *
        * @return	module html
        */
        public function load_module($position)
        {
            /*if ($GLOBALS['CURRENT_MENU'] != '')
            {
                $cond = '';
                $cond2 = '';
                $menu_list = explode(',', $GLOBALS['CURRENT_MENU']);
                
                foreach ($menu_list as $val)
                {
                    $cond .= " OR (CONCAT(','  ,  `modules`.`menu_id`  ,  ',') LIKE '%," . intval($val) . ",%')";
                    $cond2 .= " OR (CONCAT(','  ,  `modules`.`menu_id`  ,  ',') NOT LIKE '%," . -intval($val) . ",%')";
                }
                
                $cond = "AND ((`modules`.`menu_id` = 'all') OR ((`modules`.`menu_id` <> 'all') AND (" . substr($cond, 4) . ")) OR ((`modules`.`menu_id` <> 'all') AND (" . substr($cond2, 4) . ")))";
            }
            else
            {
                $cond = "AND (`modules`.`menu_id` = 'all')";
            }*/

            $dbObj = new classDb();

            $sql = "
                    SELECT 
                                `modules`.`module_id`,
								`modules`.`module_path`,
                                `modules`.`module`,
                                `modules`.`position`,
                                `modules`.`title`,
                                `modules`.`showtitle`,
                                `modules`.`params`,
                                `modules`.`menu_id`
                    FROM 
                                `modules`
                                LEFT JOIN `module_position` ON `module_position`.`module_position_id` = `modules`.`position`
                    WHERE 
                                `module_position`.`position` = ? 
                                " . (!$GLOBALS['ADMIN'] ? "AND `modules`.`enabled` = 1 " : "") . "
                                /*" . $cond . "*/
                                AND `modules`.`lang_code` = ?
                    ORDER BY 
                                `modules`.`ordering` DESC
            ";

            $data_module_123456789 = $dbObj->SqlQueryOutputResult($sql, array($position, $GLOBALS['LANG']));

            $i_module_123456789 = 1;

            $_CURRENT_MENU = explode(',', $GLOBALS['CURRENT_MENU']);			
			
            while($row = $data_module_123456789->fetch())
            {
            	$_LOAD = FALSE;

            	if ($row['menu_id'] == 'all')
            	{
					$_LOAD = TRUE;
            	}
            	elseif (strpos($row['menu_id'], ',') > 0 || is_numeric($row['menu_id']))
            	{
					
					$_menu = explode(',', $row['menu_id']);
					$_found = FALSE;

					foreach ($_menu as $_menu_id)
					{
						if (in_array(abs($_menu_id), $_CURRENT_MENU))
						{
							
							$_found = TRUE;

							if ($_menu_id < 0)
							{
								$_LOAD = FALSE;
							}
							else
							{
								$_LOAD = TRUE;
							}
							
							break;
						}
					}
					if (!$_LOAD && !$_found && substr($row['menu_id'], 0, 1) == '-')
					{
						$_LOAD = TRUE;
					}
            	}

            	if ($_LOAD)
            	{
	                if ($row["showtitle"])
	                {
	                    $module_title = $row["title"];
	                }
	                else
	                {
	                    $module_title = "";
	                }
	                
	                $params = $row["params"];
	                $module_id = $row["module_id"];	                	                
	                
	                if ($GLOBALS['ADMIN'] && $GLOBALS['ADMIN_EDIT_MODULE'])
	                {
	                    // $module_tooltip = '
						echo '<div class="content_module">';
	                    echo '
	                        <form name="frm_module_', $module_id, '" id="frm_module_', $module_id, '" method="post">
	                            <input type="hidden" name="module_id" value="', $module_id, '">
	                            <input type="hidden" name="task" id="task">
	                            <input type="hidden" name="position" id="position" value="', $row["position"], '">
	                        </form>
	                        <script language="javascript">
	                            jQuery(document).ready(function ()
	                            {
	                                jQuery(".btn_mnu_tooltip_', $module_id, '").click(function ()
	                                {
	                                    jQuery("ul.module_tooltip").slideUp(1);
	                                    jQuery("ul.module_tooltip_', $module_id, '").stop(true,true).slideToggle("fast", function()
	                                    {
	                                        if (jQuery("ul.module_tooltip_', $module_id, '").css("display") == "none" || jQuery("ul.module_tooltip_', $module_id, '").height() < 10)
	                                        {
	                                            if (jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index") == 10000) {
	                                                jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index", 100);
	                                            }
	                                            else {
	                                                jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index", 1);
	                                            }
	                                        }
	                                        else
	                                        {
	                                            if (jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index") == 100 || jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index") == 10000) {
	                                                jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index", 10000);
	                                            }
	                                            else {
	                                                jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index", 9999);
	                                            }
	                                            
	                                            jQuery(document).one("click", function()
	                                            {
	                                                jQuery("ul.module_tooltip_', $module_id, '").stop(true,true).slideUp("fast", function()
	                                                {
	                                                    if (jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index") == 10000 || jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index") == 100) {
	                                                        jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index", 100);
	                                                    }
	                                                    else {
	                                                        jQuery("ul.module_tooltip_', $module_id, '").parent().css("z-index", 1);
	                                                    }
	                                                });
	                                            });
	                                        }
	                                    });
	                                    
	                                    return false;
	                                });
	                                
	                                jQuery(".btn_mnu_tooltip_', $module_id, '").parent().find("ul a").click(function ()
	                                {
	                                    jQuery(".btn_mnu_tooltip_', $module_id, '").click();
	                                });
	                            });
	                        </script> 
	                        <div class="content_module_tooltip">
	                            <a class="btn_mnu_tooltip_', $module_id, '" href="javascript:void(0);">
	                                <img src="images/icons/arrow_normal.png" border="0" />
	                            </a>	
	                            <ul class="module_tooltip module_tooltip_', $module_id, '">
	                                <li class="icon_edit">
	                                    <a class="fancybox" href="./module/', $row["module"], '/', $module_id, '.html">
	                                        Chỉnh sửa chức năng
	                                    </a>
	                                </li>
	                                <li class="icon_delete">
	                                    <a href="javascript:void(0);" onclick="javascript:module_process(', $module_id, ', 439353, ', $row["position"], ')">
	                                        Xóa chức năng
	                                    </a>
	                                </li>
	                                <li class="icon_translate">
	                                    <a href="javascript:void(0);" onclick="javascript:module_translate(', $module_id, ', this, \'', $row['module'], '\', \'', $GLOBALS['LANG'], '\')">
	                                        Biên dịch
	                                    </a>
	                                </li>';
	                    
	                                if($i_module_123456789 > 1) {
	                                    // $module_tooltip .= '
	                                    echo '
	                                    <li class="icon_up">
	                                        <a href="javascript:void(0);" onclick="javascript:module_process(', $module_id, ', 9365436, ', $row["position"], ')">
	                                            Lên trên
	                                        </a>
	                                    </li>';
	                                }
	                                
	                                if ($i_module_123456789 < $data_module_123456789->rowCount()) {
	                                    // $module_tooltip .= '
	                                    echo '
	                                    <li class="icon_down">
	                                        <a href="javascript:void(0);" onclick="javascript:module_process(', $module_id, ', 379753798, ', $row["position"], ')">
	                                            Xuống dưới
	                                        </a>
	                                    </li>';
	                                }
	                                
	                                // $module_tooltip .='
	                                echo '
	                                <li class="icon_move">
	                                    <a href="javascript:void(0);">Di chuyễn tới</a> 
	                                    <ul>';
	                        
	                                    $sql = "
	                                            SELECT `module_position_id`, `position_name`, `position`
	                                            FROM `module_position`
	                                            WHERE `module_position`.`enabled` = 1
	                                    ";
	                            
	                                    $data_module_0987654321 = $dbObj->SqlQueryOutputResult($sql, array(0));
	                            
	                                    while ($row1 = $data_module_0987654321->fetch()) {
	                                        // $module_tooltip .= '
	                                        echo '
	                                        <li class="icon_move">
	                                            <a href="javascript:void(0);" onclick="javascript:module_process(', $module_id, ', 79430273, ', $row1["module_position_id"], ')">',
	                                                $row1["position_name"],
	                                            '</a>
	                                        </li>';
	                                    }
	                                    
	                                    // $module_tooltip .='
	                                    echo '
	                                    </ul>
	                                </li>
	                            </ul>
	                        </div>';
							
							include($row["module_path"] . "/" . $row["module"] ."/". $row["module"] . ".frontend.php");
							
	                    	echo "</div>";
	                        // echo $module_tooltip;
	                } else {
						include($row["module_path"] . "/" . $row["module"] ."/". $row["module"] . ".frontend.php");
					}
	                
	                $i_module_123456789++;
	                
				}
            }
        }

        public function current_menu()
        {
            $dbObj = new classDb();
            
            if ($GLOBALS['MULTI_LANG']) {
				$lang_prefix = $GLOBALS['LANG'];
				$lang_prefix_a = $GLOBALS['LANG'] . '/';
            }
            else {
				$lang_prefix = '';
				$lang_prefix_a = '';
            }
            
            $sql = "
                
                SELECT
                            `id`,
                            `link_id`,
                            `type`
                FROM
                            `menu`
                WHERE
                            (
                                (`type` <> 'linkout')
                                OR (`type` = 'linkout' AND (
                                        LEFT(`link_id`, 7) <> 'http://'
                                        || LEFT(`link_id`, 8) <> 'https://'
                                        || LEFT(`link_id`, 7) <> 'mailto:'
                                        || LEFT(`link_id`, 6) <> 'ftp://'
                                ))
                            )
                            AND `activated` = 1
                
            ";
            
            $menu_items = $dbObj->SqlQueryOutputResult($sql, array());
            
            $current_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
            
            $id_list = '';
            
            while ($item = $menu_items->fetch(PDO::FETCH_ASSOC))
            {
                if ($item['link_id'] == '.') {
                	if ($_SERVER['REQUEST_URI'] == '/') {
						$item['link_id'] = '';
                	}
                	else {
                    	$item['link_id'] = $lang_prefix . $GLOBALS['EXT'];
					}
                }

                if (
                		($item['type'] != 'linkout'
                			&& $GLOBALS['INDEX'] . $lang_prefix_a . $item['link_id'] . $GLOBALS['EXT'] == $current_url)
                    	|| ($item['type'] == 'linkout' 
                    		&& $GLOBALS['INDEX'] . $lang_prefix_a . $item['link_id'] == $current_url)
                    	|| ($item['type'] == 'linkout' 
                    		&& $GLOBALS['INDEX'] . $lang_prefix . $GLOBALS['EXT'] == $current_url)
                    	|| ($item['type'] == 'linkout' 
                    		&& $GLOBALS['INDEX'] == $current_url)
                )
                {
                    $id_list .= ',' . $item['id'];
                }
            }
            
            if ($id_list != '')
            {
                $id_list = substr($id_list, 1);
            }
            
            return $id_list;
        }
        
        public function is_visited($type, $key, $release_time)
        {
            // Nếu có tồn tại cookie đánh dấu viếng thăm
            if (!empty($_COOKIE[$type . '-' . $key])) {
                // Nếu thời gian viếng thăm đã không còn nằm trong thời gian giới hạn
                if (time() - $_COOKIE[$type . '-' . $key] > $release_time) {
                    // Đặt lại thời gian mới và trả về là chưa viếng thăm
                    setcookie($type . '-' . $key, time(), time() + 2592000);
                    $_SESSION[$type . '-' . $key] = time();
                    return false;
                }
                // Nếu thời gian viếng thăm còn nằm trong khoảng thời gian giới hạn
                else {
                    // Trả về là đã viếng thăm
                    return true;
                }
            }
            // Nếu không tồn tại cookie đánh dấu viếng thăm,
            // kiểm tra xem có session đánh dấu viếng thăm hay không?
            else
            {
                // Nếu có tồn tại session đánh dấu viếng thăm
                if (!empty($_SESSION[$type . '-' . $key]))
                {
                    // Kiểm tra xem thời gian viếng thăm có còn nằm trong thời gian giới hạn hay không?
                    if (time() - $_SESSION[$type . '-' . $key] > $release_time) {
                        // Đặt lại thời gian mới và trả về là chưa viếng thăm
                        setcookie($type . '-' . $key, time(), time() + 2592000);
                        $_SESSION[$type . '-' . $key] = time();
                        return false;
                    }
                    // Nếu còn nằm trong thời gian giới hạn, đặt lại thời gian vào cookie
                    // và trả về là đã viếng thăm
                    else {
                        // Đặt lại thời gian cho cookie và trả lời là đã viếng thăm
                        setcookie($type . '-' . $key, $_SESSION[$type . '-' . $key], time() + 2592000);
                        return true;
                    }
                }
                else
                {
                    setcookie($type . '-' . $key, time(), time() + 2592000);
                    $_SESSION[$type . '-' . $key] = time();
                    return false;
                }
            }
        }
        
        public function reload()
        {
			$this->_redirect('http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
        }
        
        public function load_module_language($module_name, $lang = vi)
        {
			$lang_file = LANG_PATH . $lang . '.' . $module_name;

			if (file_exists($lang_file)) {				
				return unserialize(file_get_contents($lang_file));
			}
			else {
				return array();
			}
        }
        
        public function add_component_translate_button($com_name)
        {
			if ($GLOBALS['ADMIN'] && $GLOBALS['ADMIN_EDIT_MODULE'])
            {
				echo ' <a href="javascript:void(0)" onclick="component_translate(jQuery(\'.', $com_name, '\'), \'', $com_name, '\', \'', $GLOBALS['LANG'], '\')">',
						'<img src="images/icons/selection_input.jpg" border="0" align="absmiddle" width="16" height="16" />',
						'</a>';
            }
        }
        
        public function get_flags_list()
        {
			$dbObj = new classDb();
            
            $sql = "
                    SELECT 
                                `languages`.`lang_code`,
                                `languages`.`lang_name`,
                                `languages`.`lang_flag`
                    FROM 
                                `languages`
            ";
            
            if (!$GLOBALS['MULTI_LANG']) {
				$sql .= 'WHERE `languages`.`lang_code` = \'vi\'';
            }
            
            $result = $dbObj->SqlQueryOutputResult($sql, array());
            
            $return = array();
            
            while ($row = $result->fetch(PDO::FETCH_ASSOC))
            {
				$return[$row['lang_code']] = array(
					'lang_name'	=>	$row['lang_name'],
					'lang_flag'	=>	$row['lang_flag']
				);
            }
            
            return $return;
        }
        
        public function create_lang_flag($lang_code, $size, $return = false)
        {
        	if ($GLOBALS['MULTI_LANG'] == TRUE) {
        		$html = '<img src="' . $GLOBALS['INDEX'] . 'images/flags/' .
	                        $GLOBALS['LANG_LIST'][$lang_code]['lang_flag'] .
	                        '" align="absmiddle" height="' . $size . '" class="lang_flags" origin="core_class" />';
			}
			else
			{
				$html = '';
			}
        	
        	if ($return)
        	{
        		return $html;
			}
			else
			{
				echo $html;
			}
        }
    }