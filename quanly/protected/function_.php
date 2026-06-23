<?php
// Hàm Tạo form cập nhật (đã tạo 1 hàm dùng chung ->backup hàm này lại)
/* function createFormEdit($table, $title, $classModal = "", $col = 6)
{
	$pattern = "[";
	$pattern .= "0-9a-zA-Z";
	$pattern .= "ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ";
	$pattern .= "\s@,_.-]*";
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
										$html .= '<input pattern="[0-9,]*" data-toggle="m-popover" data-trigger="focus" data-html="true" data-content="'.$textRequire.' Nhập kiểu số, độ dài tối đa <code>'.$rowGetColumnInTable["NUMERIC_PRECISION"].'</code> ký tự" type="text" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input currency" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'>';
									}else{
										if($dataType == "textarea"){
											$html .= '<textarea pattern="'.$pattern.'" data-toggle="m-popover" data-trigger="focus" data-html="true" data-content="'.$textRequire.' Cho phép nhập tối đa <code>'.$rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"].$rowGetColumnInTable["NUMERIC_PRECISION"].'</code> ký tự" type="'.$dataType.'" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'></textarea>';
										}else{
											$html .= '<input pattern="'.$pattern.'" data-toggle="m-popover" data-trigger="focus" data-html="true" data-content="'.$textRequire.' Cho phép nhập tối đa <code>'.$rowGetColumnInTable["CHARACTER_MAXIMUM_LENGTH"].$rowGetColumnInTable["NUMERIC_PRECISION"].'</code> ký tự" type="'.$dataType.'" id="'.$rowGetColumnInTable["COLUMN_NAME"].'" name="'.$rowGetColumnInTable["COLUMN_NAME"].'" class="form-control m-input" placeholder="'.$rowGetColumnInTable["COLUMN_COMMENT"].'" '.$require.' '.$maxlength.'>';
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
} */