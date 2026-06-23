<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include_once('mod_slideshow.models.php');
	$myprocess = new process_mod_slideshow();
?>
<style>
	.tt-suggestion:hover{
		background: #ccc;
		cursor: pointer;
	}
</style>
<div id="search-widget-wrapper" class="relative">
	<!-- Hero Banner -->
	<?php if($myprocess->isMobile()){ ?>
	
		<div class="jcarousel-wrapper">
                <div class="jcarousel bg_white">
                    <ul>
						<?php
							$module_data = $myprocess->get_slideshow_content($module_id);
							$i=0;
							while ($row = $module_data->fetch(PDO::FETCH_ASSOC)) {
								$i++;
						?>
						 <li>
							<img src="<?php echo $row['image_file']; ?>" alt="">
						<?php if(!empty($row['title_name'])) { ?>
							<div class="col-sm-12">
								<div class="col-sm-2 fl_left">
									<img class="img-responsive_1" src="<?php echo $row['logo_company'] ?>" width="70" alt="">
								</div>
								<div class="col-sm-9 fl_right">
									<div class="title_cty"><?php echo $row['title_name'] ?></div>
									<div class="description_content"><?php echo $row['description'] ?></div>
								</div>
							</div>
						<?php } ?>
						</li>
							
						<?php } ?>
                       
                    </ul>
                </div>

                

                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                <a href="#" class="jcarousel-control-next">&rsaquo;</a>
                
                <p class="jcarousel-pagination">    
                </p>
            </div>
			<div class="container search-widget-container">
				<div class="border-text-box fix_w_767 input-icons" style="margin-top:325px; margin-left: 60px;">
					<i class="fa fa-search icon"></i>
					<input type="text" name="search_s" value=""  class="ModalSearchWork form-control input-field" placeholder="Tìm kiếm công việc....">
				</div>
			</div>
			<div id="ModalSearchWork" class="modal fade">
				<div class="modal-dialog search-widget-container" role="document">
					<div class="modal-content modal-content_2" style="width:100%; height: auto;">
						<div id="search-widget" class="modal-body">
							<form class="form-inline form-adjacent" name="search" action="tim-kiem.html" method="get">
							<div class="search-group">
								<div class="form-group col-sm-4 keyword-search no-padding">
									<i class="fa fa-user-md" aria-hidden="true"></i>
									<label>Vị trí - Chức danh - Kỹ năng</label>					
									<div class="border-text-box">

										<input 
										autocomplete="off" 
										
										type="text" name="search" value="" 
										
										class="input-field form-control job-typeahead" 
										
										placeholder="">

										<div class="tt-menu" style="width: 98.6%;color: white;background: rgb(85, 85, 85);position: absolute; top: 100%; z-index: 100;display:none">
											<div class="loadSuggess tt-dataset tt-dataset-states">
												<div data-value="Bác sĩ" class="tt-suggestion tt-selectable">Bác sĩ</div>
												<div data-value="Dược sĩ" class="tt-suggestion tt-selectable">Dược sĩ</div>
												<div data-value="Điều dưỡng" class="tt-suggestion tt-selectable">Điều dưỡng</div>
												<div data-value="Kỹ thuật viên" class="tt-suggestion tt-selectable">Kỹ thuật viên</div>
												<div data-value="Hộ sinh/Hộ lý" class="tt-suggestion tt-selectable">Hộ sinh/Hộ lý</div>
												<div data-value="Y sĩ/Y tế cộng đồng" class="tt-suggestion tt-selectable">Y sĩ/Y tế cộng đồng</div>
												<div data-value="Thư ký y khoa" class="tt-suggestion tt-selectable">Thư ký y khoa</div>
											</div>


										</div>
									</div>
								</div>
								<div class="form-group cate-search col-sm-3 no-padding m_bottom_10">
									<i class="fa fa-list-alt" aria-hidden="true"></i>
									<label>Tìm theo ngành nghề</label>
									<div class="border-text-box">
										<select class="select-category" data-search-input-placeholder="Tìm kiếm theo ngành nghề" name="danhmuccv" data-placeholder="Chọn ngành nghề">
											<option value="-1">Tất Cả Ngành Nghề</option>
											<?php
												$result = $myprocess->getDanhmuccv();
												$selected = "";
												
												while($row = $result->fetch()){
													$resultCK = $myprocess->getChuyenKhoa($row["danhmuccv_id"]);
													if($resultCK->rowCount() > 0){
											?>
												<optgroup label="<?php echo $row["tendanhmuccv"] ?>">
													<?php
														while($rowCK = $resultCK->fetch()){
															$selected = $rowCK["chuyenkhoa_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";
													?>
														<option <?php echo $selected ?> value="<?php echo $rowCK["chuyenkhoa_id"] ?>"><?php echo $rowCK["chuyenkhoa_name"] ?></option>
													<?php
														}
													?>
												</optgroup>
											<?php
													}else{
														$selected = $row["danhmuccv_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";
											?>
														<option <?php echo $selected ?> value="<?php echo $row["danhmuccv_id"] ?>"><?php echo $row["tendanhmuccv"] ?></option>
											<?php
													}
												}
											?>
										</select>
									</div>
								</div>

								<div class="form-group location-search col-sm-3 no-padding">
									<i class="fa fa-square" aria-hidden="true"></i>
									<label>Tìm theo địa điểm</label>
									<div class="border-text-box">
										<select
											style="width: 100%; height:45px" 
											class="select-location" 
											data-search-input-placeholder="Tìm kiếm địa điểm" 
											name="location" 
											data-placeholder="Chọn địa điểm làm việc">
												<option value="-1">Tất cả địa điểm</option>
												<?php
													$result = $myprocess->getTinhThanh();
													while($row = $result->fetch()){
												?>
													<option value="<?php echo $row["id"] ?>"><?php echo $row["ten_tinhthanh"] ?></option>
												<?php
													}
												?>
										</select>
									</div>
								</div>

								<div class="form-group col-sm-2 text-center no-padding">
									<button type="submit" class="btn btn-primary btn-search-all" style="margin-top:20px">
										Tìm Việc
									</button>
								</div>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
						
	<?php }else{ ?>
	<div class="slider single-item slider_item" id="slider_slick">
			<?php
				 $module_data = $myprocess->get_slideshow_content($module_id);                                             
				 while ($row = $module_data->fetch(PDO::FETCH_ASSOC)) {
			?>
				<div>
					<img src="<?php echo $row['image_file']; ?>">
						<?php if(!empty($row['title_name'])) { ?>
							<div class="col-sm-12 com_load_pa">
								<a class="hot-corner hidden-xs" target="_blank" href="<?php echo $row['link'] ?>">
								<div class="col-sm-4 hot-corner__logo">
									<img class="img-responsive_1" src="<?php echo $row['logo_company'] ?>" alt="">
								</div>
								 <div class="col-sm-8">
										<div class="hot-corner__description no-break-out"><?php echo $row['title_name'] ?></div>
										<div class="hot-corner__description no-break-out"><?php echo $row['description'] ?></div>
										<div class="hot-corner__view-link">
											<img alt="View more image" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAACXBIWXMAAAsTAAALEwEAmpwYAAA5pmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxMzIgNzkuMTU5Mjg0LCAyMDE2LzA0LzE5LTEzOjEzOjQwICAgICAgICAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iCiAgICAgICAgICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgICAgICAgICB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIKICAgICAgICAgICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgICAgICAgICAgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIgogICAgICAgICAgICB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iCiAgICAgICAgICAgIHhtbG5zOnRpZmY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vdGlmZi8xLjAvIgogICAgICAgICAgICB4bWxuczpleGlmPSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wLyI+CiAgICAgICAgIDx4bXA6Q3JlYXRvclRvb2w+QWRvYmUgUGhvdG9zaG9wIENDIDIwMTUuNSAoTWFjaW50b3NoKTwveG1wOkNyZWF0b3JUb29sPgogICAgICAgICA8eG1wOkNyZWF0ZURhdGU+MjAxNi0xMS0wMVQxMTowNjozNCswNzowMDwveG1wOkNyZWF0ZURhdGU+CiAgICAgICAgIDx4bXA6TW9kaWZ5RGF0ZT4yMDE2LTExLTAxVDExOjA5OjAyKzA3OjAwPC94bXA6TW9kaWZ5RGF0ZT4KICAgICAgICAgPHhtcDpNZXRhZGF0YURhdGU+MjAxNi0xMS0wMVQxMTowOTowMiswNzowMDwveG1wOk1ldGFkYXRhRGF0ZT4KICAgICAgICAgPHhtcE1NOkluc3RhbmNlSUQ+eG1wLmlpZDpmYTAxN2VmNi0xNDc3LTRkMmItYmI4ZS1kYWMyNzlmNWE4Yjg8L3htcE1NOkluc3RhbmNlSUQ+CiAgICAgICAgIDx4bXBNTTpEb2N1bWVudElEPnhtcC5kaWQ6RUI4ODgwRkE5ODBDMTFFNjgxM0JDRUFFMzExNEE4MDM8L3htcE1NOkRvY3VtZW50SUQ+CiAgICAgICAgIDx4bXBNTTpEZXJpdmVkRnJvbSByZGY6cGFyc2VUeXBlPSJSZXNvdXJjZSI+CiAgICAgICAgICAgIDxzdFJlZjppbnN0YW5jZUlEPnhtcC5paWQ6RUI4ODgwRjc5ODBDMTFFNjgxM0JDRUFFMzExNEE4MDM8L3N0UmVmOmluc3RhbmNlSUQ+CiAgICAgICAgICAgIDxzdFJlZjpkb2N1bWVudElEPnhtcC5kaWQ6RUI4ODgwRjg5ODBDMTFFNjgxM0JDRUFFMzExNEE4MDM8L3N0UmVmOmRvY3VtZW50SUQ+CiAgICAgICAgIDwveG1wTU06RGVyaXZlZEZyb20+CiAgICAgICAgIDx4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ+eG1wLmRpZDpFQjg4ODBGQTk4MEMxMUU2ODEzQkNFQUUzMTE0QTgwMzwveG1wTU06T3JpZ2luYWxEb2N1bWVudElEPgogICAgICAgICA8eG1wTU06SGlzdG9yeT4KICAgICAgICAgICAgPHJkZjpTZXE+CiAgICAgICAgICAgICAgIDxyZGY6bGkgcmRmOnBhcnNlVHlwZT0iUmVzb3VyY2UiPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6YWN0aW9uPnNhdmVkPC9zdEV2dDphY3Rpb24+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDppbnN0YW5jZUlEPnhtcC5paWQ6ZmEwMTdlZjYtMTQ3Ny00ZDJiLWJiOGUtZGFjMjc5ZjVhOGI4PC9zdEV2dDppbnN0YW5jZUlEPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6d2hlbj4yMDE2LTExLTAxVDExOjA5OjAyKzA3OjAwPC9zdEV2dDp3aGVuPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6c29mdHdhcmVBZ2VudD5BZG9iZSBQaG90b3Nob3AgQ0MgMjAxNS41IChNYWNpbnRvc2gpPC9zdEV2dDpzb2Z0d2FyZUFnZW50PgogICAgICAgICAgICAgICAgICA8c3RFdnQ6Y2hhbmdlZD4vPC9zdEV2dDpjaGFuZ2VkPgogICAgICAgICAgICAgICA8L3JkZjpsaT4KICAgICAgICAgICAgPC9yZGY6U2VxPgogICAgICAgICA8L3htcE1NOkhpc3Rvcnk+CiAgICAgICAgIDxkYzpmb3JtYXQ+aW1hZ2UvcG5nPC9kYzpmb3JtYXQ+CiAgICAgICAgIDxwaG90b3Nob3A6Q29sb3JNb2RlPjI8L3Bob3Rvc2hvcDpDb2xvck1vZGU+CiAgICAgICAgIDx0aWZmOk9yaWVudGF0aW9uPjE8L3RpZmY6T3JpZW50YXRpb24+CiAgICAgICAgIDx0aWZmOlhSZXNvbHV0aW9uPjcyMDAwMC8xMDAwMDwvdGlmZjpYUmVzb2x1dGlvbj4KICAgICAgICAgPHRpZmY6WVJlc29sdXRpb24+NzIwMDAwLzEwMDAwPC90aWZmOllSZXNvbHV0aW9uPgogICAgICAgICA8dGlmZjpSZXNvbHV0aW9uVW5pdD4yPC90aWZmOlJlc29sdXRpb25Vbml0PgogICAgICAgICA8ZXhpZjpDb2xvclNwYWNlPjY1NTM1PC9leGlmOkNvbG9yU3BhY2U+CiAgICAgICAgIDxleGlmOlBpeGVsWERpbWVuc2lvbj4zMjwvZXhpZjpQaXhlbFhEaW1lbnNpb24+CiAgICAgICAgIDxleGlmOlBpeGVsWURpbWVuc2lvbj4zMjwvZXhpZjpQaXhlbFlEaW1lbnNpb24+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgIAo8P3hwYWNrZXQgZW5kPSJ3Ij8+o3IIbAAAACBjSFJNAAB6JQAAgIMAAPn/AACA6QAAdTAAAOpgAAA6mAAAF2+SX8VGAAADAFBMVEX///////8CAgIDAwMEBAQFBQUGBgYHBwcICAgJCQkKCgoLCwsMDAwNDQ0ODg4PDw8QEBARERESEhITExMUFBQVFRUWFhYXFxcYGBgZGRkaGhobGxscHBwdHR0eHh4fHx8gICAhISEiIiIjIyMkJCQlJSUmJiYnJycoKCgpKSkqKiorKyssLCwtLS0uLi4vLy8wMDAxMTEyMjIzMzM0NDQ1NTU2NjY3Nzc4ODg5OTk6Ojo7Ozs8PDw9PT0+Pj4/Pz9AQEBBQUFCQkJDQ0NERERFRUVGRkZHR0dISEhJSUlKSkpLS0tMTExNTU1OTk5PT09QUFBRUVFSUlJTU1NUVFRVVVVWVlZXV1dYWFhZWVlaWlpbW1tcXFxdXV1eXl5fX19gYGBhYWFiYmJjY2NkZGRlZWVmZmZnZ2doaGhpaWlqampra2tsbGxtbW1ubm5vb29wcHBxcXFycnJzc3N0dHR1dXV2dnZ3d3d4eHh5eXl6enp7e3t8fHx9fX1+fn5/f3+AgICBgYGCgoKDg4OEhISFhYWGhoaHh4eIiIiJiYmKioqLi4uMjIyNjY2Ojo6Pj4+QkJCRkZGSkpKTk5OUlJSVlZWWlpaXl5eYmJiZmZmampqbm5ucnJydnZ2enp6fn5+goKChoaGioqKjo6OkpKSlpaWmpqanp6eoqKipqamqqqqrq6usrKytra2urq6vr6+wsLCxsbGysrKzs7O0tLS1tbW2tra3t7e4uLi5ubm6urq7u7u8vLy9vb2+vr6/v7/AwMDBwcHCwsLDw8PExMTFxcXGxsbHx8fIyMjJycnKysrLy8vMzMzNzc3Ozs7Pz8/Q0NDR0dHS0tLT09PU1NTV1dXW1tbX19fY2NjZ2dna2trb29vc3Nzd3d3e3t7f39/g4ODh4eHi4uLj4+Pk5OTl5eXm5ubn5+fo6Ojp6enq6urr6+vs7Ozt7e3u7u7v7+/w8PDx8fHy8vLz8/P09PT19fX29vb39/f4+Pj5+fn6+vr7+/v8/Pz9/f3+/v7///9BN/q1AAAAAnRSTlP/AOW3MEoAAABySURBVHjanJNHEsAwCAPF/z+dSwpFZCfhZnltuuI0hbdLl/QOhBbkERciaZ7IkiWK4ogqGKKdJzEedGL6bIQJuxIu80LY4mXC1z8RWw9vQgFf/HJBQVKaVCgqNXUT5oEmimaSppr2gjZru/+yvMv6HwMAUVYDjKwj6zsAAAAASUVORK5CYII=">
										</div>
								</div>
							 </a>
							</div>
						<?php } ?>					
				</div>
			 <?php  } ?>		
	</div>
	
	<!--/ Hero Banner -->
	
	<div class="container search-widget-container">
		<div id="search-widget" class="collapse in search-widget col-sm-11">

			<div class="stylized-tab search-tabs clearfix search-form">
				<!-- Tab panes -->
				<div class="tab-content">
					<!-- Jobs -->
					<div role="tabpanel" class="tab-pane tab-job active" id="home">
						<form class="form-inline form-adjacent" name="search" action="tim-kiem.html" method="get">
							<div class="search-group">
								<div class="form-group col-sm-4 keyword-search no-padding">
									<i hidden class="fa fa-long-arrow-left clickable keyword-search__close"></i>
									<i class="fa fa-close clear-keyword clickable absolute"></i>
									<div class="border-text-box">									
										<input 
											autocomplete="off" 
											type="text" 
											name="search" 
											value="" 
											class="form-control job-typeahead input-radius" 
											placeholder="Nhập chức danh, vị trí, kỹ năng...">
										<div class="tt-menu" style="width: 98.6%;color: #000;background: #FFF;position: absolute; top: 100%; z-index: 100;display:none">
											<div class="loadSuggess tt-dataset tt-dataset-states">
												<div data-value="Bác sĩ" class="tt-suggestion tt-selectable">Bác sĩ</div>
												<div data-value="Dược sĩ" class="tt-suggestion tt-selectable">Dược sĩ</div>
												<div data-value="Điều dưỡng" class="tt-suggestion tt-selectable">Điều dưỡng</div>
												<div data-value="Kỹ thuật viên" class="tt-suggestion tt-selectable">Kỹ thuật viên</div>
												<div data-value="Hộ sinh/Hộ lý" class="tt-suggestion tt-selectable">Hộ sinh/Hộ lý</div>
												<div data-value="Y sĩ/Y tế cộng đồng" class="tt-suggestion tt-selectable">Y sĩ/Y tế cộng đồng</div>
												<div data-value="Thư ký y khoa" class="tt-suggestion tt-selectable">Thư ký y khoa</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group cate-search col-sm-3 no-padding m_bottom_10">
									<div class="border-text-box">
										<select class="select-category" data-search-input-placeholder="Tìm kiếm theo ngành nghề" name="danhmuccv" data-placeholder="Chọn ngành nghề">
											<option value="-1">Tất Cả Ngành Nghề</option>
											<?php
												$result = $myprocess->getDanhmuccv();
												$selected = "";
												
												while($row = $result->fetch()){
													$resultCK = $myprocess->getChuyenKhoa($row["danhmuccv_id"]);
													if($resultCK->rowCount() > 0){
											?>
												<optgroup label="<?php echo $row["tendanhmuccv"] ?>">
													<?php
														while($rowCK = $resultCK->fetch()){
															$selected = $rowCK["chuyenkhoa_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";
													?>
														<option <?php echo $selected ?> value="<?php echo $rowCK["chuyenkhoa_id"] ?>"><?php echo $rowCK["chuyenkhoa_name"] ?></option>
													<?php
														}
													?>
												</optgroup>
											<?php
													}else{
														$selected = $row["danhmuccv_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";
											?>
														<option <?php echo $selected ?> value="<?php echo $row["danhmuccv_id"] ?>"><?php echo $row["tendanhmuccv"] ?></option>
											<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group location-search col-sm-3 no-padding">
									<div class="border-text-box">
										<select class="select-location-2" data-search-input-placeholder="Tìm kiếm địa điểm" name="location" data-placeholder="Chọn địa điểm làm việc">
											<option value="1">Tất cả địa điểm</option>
											<?php
												$result = $myprocess->getTinhThanh();
												while($row = $result->fetch()){
											?>
												<option value="<?php echo $row["id"] ?>"><?php echo $row["ten_tinhthanh"] ?></option>
											<?php
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group col-sm-2 text-center no-padding">
									<button type="submit" class="btn btn-primary btn-search-all">
										Tìm Việc
									</button>
								</div>
							</div>
						</form>
					</div>
					<!--/ Jobs -->
				</div>
			</div>
			<p class="text-right m-t-sm m-b-n-sm">
				<label class="upload-resume relative m-b-none">
					<a class="text-white btnSearchAdvenced" href="javascript:void(0)">Tìm kiếm nâng cao</a>
				</label>
			</p>


			<div class="back-to-search-box">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle fa-stack-2x"></i> <i class="fa fa-chevron-down fa-stack-1x"></i>
				</span>
			</div>
		</div>
	</div>
	<?php } ?>
	
	
</div>
<script>
	/*  */
</script>
<script type="text/javascript">
	
	$(".ModalSearchWork").click(function(){
		$("#ModalSearchWork").modal("show");
	})
	function searchPremiumJob(isPremium) {
		$('#searchBoxPremiumJob').val(isPremium);
		$('#frm_block_quick_search').submit();
	}

	function companySearch() {
		if ($.trim($('#companyName').val()) != '') {
			if ($('#companyName').val() != $('#keywordCompanySearch').val()){
				$('#companyId').val('');
			}
			$('#frm_company_quick_search').submit();
		}
	}
	

	$(document).ready(function() {
		
		/*js click scroll */
		
		 $('.jcarousel-control')
        .on('jcarouselpagination:active', 'li', function() {
            $(this).addClass('active');
        })
        .on('jcarouselpagination:inactive', 'li', function() {
            $(this).removeClass('active');
        })
        .jcarouselPagination({
            'perPage':1,
            'item': function(page, carouselItems) {
                return '<li class="' + (page == 1 ? "active" : "") + '"><a href="#' + page + '"></a></li>';
            }
        });

			$('.mycarousel-prev').jcarouselControl({target:'-=1'});
			$('.mycarousel-next').jcarouselControl({target:'+=1'});
		/*end js click */
		//$('#upload-progress').hide();
		$('#resumeFile').change(function(){
			uploadFile();
		})

		$("[name=search]").focusin(function(){
			$(this).next().show();
		})

		$(".tt-suggestion").click(function(){
			var values = $(this).data('value');
			$(this).parents(".tt-menu").hide().first().prev().val(values);
		})

		$("[name=search]").focusout(function(){
			setTimeout(function(){
				$("[name=search]").next().hide();
			}, 200);
		})
	});

	function uploadFile(){
		var options = {
			beforeSubmit: clearErrorMessage,
			success: postAjaxSubmit,  // post-submit callback
			error: function (xhr, status, error) {
				handleError(xhr);
			},
			type: 'post',        // 'get' or 'post', override for form's 'method' attribute
			dataType: 'json'        // 'xml', 'script', or 'json' (expected server response type)
		};
		$('#upload-resume').ajaxSubmit(options);
	}

	function clearErrorMessage() {
		$("#upload-error").hide();
		$('#upload-success').hide();
		$('#upload-progress').show();
	}

	function handleError(xhr){
		if(xhr.status==413){
			$('#upload-status').slideUp();
			$('#upload-error').html('<em>Vui lòng đính kèm tệp tin dưới định dạng .doc, .docx hoặc .pdf kích thước nhỏ hơn 2048KB.</em>').slideDown();
		}else{
			$('#upload-error').slideDown();
			setTimeout(function () {
				$('#upload-success').slideUp();
				$('#upload-status').slideDown();
			}, 5000);
		}
		$('#upload-progress').hide();
	}

	function postAjaxSubmit(data) {
		if (data.status == 'REDIRECT') {
			window.location.href = data.redirectUrl;
		} else if (data.status == 'ERROR'|| data.status=='UPLOAD_ERROR') {
			$('#upload-status').slideUp();
			$('#upload-error').html('<em>' + data.error + '</em>').slideDown();
			setTimeout(function () {
				$('#upload-success').slideUp();
				$('#upload-status').slideDown();
			}, 5000);
		} else { // SUCCESS
			$('#upload-status').slideUp().html('<em>Hồ sơ của bạn ' + data.fileName +  ' đã được đăng tải vào ngày ' + data.lastDateUpdated +'</em>');
			$('#upload-success').html('<em>Hồ sơ của bạn ' + data.fileName +  ' đã được đăng tải thành công!</em>').slideDown();
			setTimeout(function () {
				$('#upload-success').slideUp();
				$('#upload-status').slideDown();
				$('#upload-resume').fadeOut();
			}, 5000);
		}

		$('#upload-progress').hide();
	}
</script>