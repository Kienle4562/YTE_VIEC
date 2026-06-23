<?php defined( '_VALID_MOS' ) or die( include("404.php") );
if($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator"){ 
$myprocess = new process();
?>
<div id="content-box">
	<div class="border">
		<div class="padding">
			<div id="toolbar-box">
				<div class="t">
					<div class="t">
						<div class="t"></div>
					</div>
				</div>
				<div class="m">
					<div class="toolbar" id="toolbar">
						<table class="toolbar">
							<tbody>
								<tr>
									<td class="button" id="toolbar-publish">
										<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một bài viết từ danh sách để');}else{  submitbutton('publish')}" class="toolbar">
											<span class="icon-32-publish" title="Bật"></span>Bật
										</a>
									</td>
									
									<td class="button" id="toolbar-unpublish">
										<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một bài viết từ danh sách để');}else{  submitbutton('unpublish')}" class="toolbar">
											<span class="icon-32-unpublish" title="Tắt"></span>Tắt
										</a>
									</td>
									
									<td class="button" id="toolbar-trash">
										<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một bài viết từ danh sách để');}else if(confirm('Bạn có chắc chắn muốn xóa những mẫu tin được chọn không? ')){  submitbutton('remove')}" class="toolbar">
										<span class="icon-32-trash" title="Sọt rác"></span>Sọt rác
										</a>
									</td>
													
									<td class="button" id="toolbar-new">
										<a href="javascript:submitbutton('add');" class="toolbar">
											<span class="icon-32-new" title="Thêm mới"></span>Thêm mới
										</a>
									</td>
									
									<td class="button" id="toolbar-help">
										<a href="#" onclick="popupWindow('', 'Trợ giúp', 640, 480, 1)" class="toolbar">
											<span class="icon-32-help" title="Trợ giúp"></span>Trợ giúp
										</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
			
					<div class="header icon-48-article">Quản lý bài viết</div>
		
					<div class="clr"></div>
				</div>
				<div class="b">
					<div class="b">
						<div class="b"></div>
					</div>
				</div>
			</div>
			<div class="clr"></div>
			
			
	<div id="element-box">
		<div class="t">
			<div class="t">
				<div class="t"></div>
			</div>
		</div>
		<div class="m">
			<form method="post" name="phpForm">
				<!-------------------------------->
				<link rel="stylesheet" href="css/jquery.treeview.css" />
				<link href="css/msdn.css" rel="stylesheet" type="text/css" />
				<script src="javascript/jquery.treeview.js" type="text/javascript"></script>
				
				<script type="text/javascript"> 
					jQuery(function() {
						jQuery("#tree").treeview({
							collapsed: true,
							animated: "medium",
							control:"#sidetreecontrol",
							persist: "location"
						});
					})
				</script> 
				<div class="contentPlaceHolder"> 
				  <div class="navigation" id="Navigation" style="width:280px;"> 
					<div class="searchcontainer"> 

						<div class="searchBoxContainer"> 
						  <table class="searchBox" cellpadding="0" cellspacing="0" border="0"> 
							<tr> 
							  <td class="searchTextBoxTd"> 
								<input id="SearchInput" type="text" maxlength="200" class="searchTextBox" name="query" /> 
							  </td> 
							  <td class="searchButtonTd"> 
								  <input type="image" src="template/images/search_button.gif" style="position: relative;" title="Search " /> 
							  </td> 
							</tr> 
						  </table> 
						</div> 
						
						<div id="sidetree" style="padding-left:10px;"> 
						<div class="treeheader">&nbsp;</div> 
						<div id="sidetreecontrol"><a href="?#">Collapse All</a> | <a href="?#">Expand All</a></div> 
							
							<?php		
								function categories ($parentid = 0, &$html = '') {	
								$myprocess = new process();
								$result = $myprocess->category($parentid);
								
								$total = $result->rowCount();
						
									if($total > 0) {
										$html .= '<ul id="tree">';
											while($row = $result->fetch()){
												$html .= '<li>';
												if($parentid == 0){
													$html .= '<a href="?com=com_news&view=item_menu&catid='.$row["cat_id"].'"><strong>' . $row["title"] . '</strong></a>';
												} else {
													$html .= '<a href="?com=com_news&view=item_menu&catid='.$row["cat_id"].'">' . $row["title"] . '</a>';
												}
												categories($row["cat_id"], $html);
												$html .= '</li>';
												$i++;
											}
										$html .= '</ul>';
									}
									return $html;	
												
								}
								echo categories(0);
							?>	
						</div>
						
					</div> 
				  </div> 
				  
				  <div id="tocResizeContainer" style="visibility:hidden;"> 
					  <a href="#" class="tocResize" id="TocResize" style="left:280px"> 
						<img id="ResizeImageIncrease" class="cl_nav_resize_open" src="template/images/arraw_resize.png" title="Mở rộng" alt="Mở rộng" /> 
						<img id="ResizeImageReset" class="cl_nav_resize_close" src="template/images/arraw_resize.png" style="display:none" title="Thu nhỏ" alt="Thu nhỏ" /> 
					  </a> 
				  </div> 
				  <div style="float:right;overflow:auto;width:75%;">
						
						<table>
							<tbody>
								<tr>
									<td width="100%"></td>
									<td nowrap="nowrap">
										<select class=inputbox onchange="document.phpForm.submit( );" size=1 name="catid">
											<option value=0 selected>- Chọn danh mục bài viết -</option>
											<?php 
												function Menu($parentid = 0,$space = '&nbsp;&nbsp;&nbsp;/_ ', &$html = ''){
													$myprocess = new process();										
													$result = $myprocess->category($parentid);
													while($row = $result->fetch()){													
														$html .= '<option value='.$row['cat_id'].'>'.$space . $row['title'].'</option>';
														Menu($row["cat_id"], $space.'&nbsp;/_&nbsp;', $html);
													}				
													return $html;
												}
												echo Menu(0);
											?>											
										</select>
										
										<select class="inputbox" onchange="document.phpForm.submit();" size="1" name="authorid">
											<option value="0" selected>- Chọn tác giả bài viết -</option>
											<?php
												$result_author = $myprocess->get_author_list();
												while($row_author = $result_author->fetch()){ ?>
													<option  <?php if($row_author['Ac_Id'] == $author_id_choose){echo "selected";} ?> value="<?php echo $row_author['Ac_Id'] ?>"><?php echo $row_author['UserName'] . "[". $row_author['fullName'] . "]" ?></option>
											<?php } ?>	 
							
										</select>
										&nbsp;&nbsp;&nbsp; Từ ngày: 
										<input type="text" name="start_date" maxlength="10" size="12" readonly="true" value="<?php echo $_POST["start_date"]; ?>" />
										<script type="text/javascript" src="../calendar/javascript/dhtmlgoodies_calendar.js?random=20060118"></script>
										<img src="../calendar/images/calendar.gif" class="mar_img" align="top" onClick="displayCalendar(document.phpForm.start_date,'dd/mm/yyyy',this);"  />
										&nbsp;&nbsp;&nbsp; Đến ngày: 
										<input type="text" name="from_date" maxlength="10" size="12" readonly="true" value="<?php echo $_POST["from_date"]; ?>" />
										<script type="text/javascript" src="../calendar/javascript/dhtmlgoodies_calendar.js?random=20060118"></script>
										<img src="../calendar/images/calendar.gif" class="mar_img" align="top" onClick="displayCalendar(document.phpForm.from_date,'dd/mm/yyyy',this);"  />
										&nbsp;&nbsp;&nbsp; <input class="btn" type="submit" name="filter" value="Lọc kết quả" />
									</td>
									</tr>
							</tbody>
						</table>
						
						<table class="adminlist">
						<thead>
						
						<?php 
							include("../protected/back_end_paging.php");
							$result = $myprocess->get_article_view();
					
								$i = 1; $stt = 1; $order_icon = 0;
								while($row = $result->fetch()){
									if($i == 1 && $row['news_category_group'] != 1){ $order_icon = 1; }
									else if($i == $row['news_category_group'] && $row['news_category_group'] != 1){ $order_icon = 2; $i = 0;}
									else if($row['news_category_group'] !=1){ $order_icon = 3; }
									else { $order_icon = 0; $i = 0;}
									
									$table_result[] = array(
										'stt'=>$stt++, 
										'id'=>$row['news_id'], 
										'cat_title'=>$row['cat_title'],
										'news_title'=>$row['title'],
										'focus'=>$row['focus'], 
										'num_view'=>$row['num_view'], 
										'enabled'=>$row['enabled'], 
										'date_add'=>$row['date_add'], 
										'ordering'=>$row['ordering'],
										'fullname'=>$row['fullName'],
										'order_icon'=>$order_icon,
										'category_id'=>$row['category_id'],
										'Ac_Id'=>$row['Ac_Id']
									);
									$i++;
								}
								
								/* ---  lay tong so dong du lieu --- */
								$news_total_row = count($table_result);
							
								if(!isset($_POST["limit"])) $r = 10; else $r = $_POST["limit"];
								if(!isset($_POST["page"])) $p = 1; else $p = $_POST["page"];
								$pager = Pager::getPagerData($news_total_row, $r, $p);
								$i = 1; 
							?>
							<tr>
								<th width="3%"><a href="javascript:void(0)">STT</a></th>
								<th class="title" width="3%"><a href="javascript:void(0)">ID</a></th>
								<th class="title"><a href="javascript:void(0)">Tiêu đề bài viết</a></th>
								<th width="1%" nowrap="nowrap"><a href="javascript:void(0)">Tiêu điểm</a></th>
								<th width="1%" nowrap="nowrap"><a href="javascript:void(0)">Hiển thị</a></th>
								<th width="8%" nowrap="nowrap"><a href="#">Sắp xếp</a><a href="javascript:checkAllByOrder(<?php echo $r; ?>, '', 'order');"><img src="template/images/icon-32-revert.png"></a> </th>
								<th class="title" width="8%" nowrap="nowrap"><a href="javascript:void(0)">Tác giả</a></th>
								<th align="center" width="10"><a href="javascript:void(0)">Ngày thêm</a></th>
								<th align="center" width="10"><a href="javascript:void(0)">Lần xem</a></th>
								<th align="center" width="10"><a href="javascript:void(0)">Copy</a></th>
								<th width="5"><input name="toggle" value="" onclick="checkAll(<?php echo $r; ?>);" type="checkbox"></th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="13">
									<del class="container">
										<div class="pagination">
											Bạn đang xem trang: <?php echo $pager->page ?> của tổng số <?php echo $pager->numPages ?> trang <br>
											<?php echo $pager->paging ?> <br>
											Hiển thị #
											<select name="limit" class="inputbox" size="1" onchange="document.phpForm.submit();">
												<?php 
													for($j = 5; $j <= 100; $j = $j + 5){ 
														if($j == $r){ ?>
															<option value="<?php echo $j ?>" selected><?php echo $j ?></option>
														<?php } else { ?>
															<option value="<?php echo $j ?>"><?php echo $j ?></option>
														<?php }
													}
												?>
											</select>
											mẫu tin trên mỗi trang
										</div>
									</del>
								</td>
							</tr>
						</tfoot>
						<tbody>
							<?php 
							if($news_total_row > 0){
							foreach($table_result as $k=>$rs) {
								if($rs['stt'] > $pager->offset && $rs['stt'] <= $pager->limit){ ?>
									<tr class="row<?php if($rs['stt'] % 2 == 0){echo "odd_row";}else{ echo "1";}?>">
										<td align="center"><?php echo $rs['stt'] ?></td>
										<td align="center"><?php echo $rs['id'] ?></td>
										<td>
											<div style="padding-bottom:8px;">
												<a href=".?com=com_content&view=news&task=edit&id=<?php echo $rs['id'] ?>">
													<?php echo $rs['cat_title'] ?>
												</a>
											</div>
											<strong>/__</strong> &nbsp;
											<a href=".?com=com_content&view=news&task=edit&id=<?php echo $rs['id'] ?>">
												<?php echo $rs['news_title'] ?>
											</a>
										</td>
										<td align="center">
										<?php if($rs['focus'] == 1) { ?>
											<span class="editlinktip hasTip">
												<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','unpublishfocus')">
												<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
												</a>
											</span>
										<?php } else if ($rs['focus'] == 0) { ?>			
											<span class="editlinktip hasTip">
												<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','publishfocus')">
												<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
												</a>
											</span>
										<?php }	?>
										</td>
										<td align="center">
									
										<?php if($rs['enabled'] == 1) { ?>
											<span class="editlinktip hasTip">
												<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','unpublish')">
												<img src="template/images/publish_g.png" alt="Đã được bật" border="0" width="16" height="16">
												</a>
											</span>
										<?php } else if ($rs['enabled'] == 0) { ?>			
											<span class="editlinktip hasTip">
												<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $rs['stt'] ?>','publish')">
												<img src="template/images/publish_r.png" alt="Đã được bật" border="0" width="16" height="16">
												</a>
											</span>
										<?php }	?>
												
										</td>
										<td class="order">
							
											<?php if($rs['order_icon'] == 1){ ?>
												<span> &nbsp; </span>
												<span><a href="javascript:void(0);" onclick="return OrderDown('cb<?php echo $rs['stt']; ?>', 'cb<?php echo $rs['stt']+1; ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
												<input name="order[]" size="5" value="<?php echo $rs['ordering']; ?>" class="text_area" style="text-align: center;" type="text">
												
											<?php } else if($rs['order_icon'] == 2){ ?>
												
												<span><a href="javascript:void(0);" onclick="return OrderUp('cb<?php echo $rs['stt']; ?>', 'cb<?php echo $rs['stt']-1; ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
												<span> &nbsp; </span>
												<input name="order[]" size="5" value="<?php echo $rs['ordering']; ?>" class="text_area" style="text-align: center;" type="text">
							
											<?php }	else if($rs['order_icon'] == 3){ ?>
							
												<span><a href="javascript:void(0);" onclick="return OrderUp('cb<?php echo $rs['stt']; ?>', 'cb<?php echo $rs['stt']-1; ?>','orderup')" title="Đi lên">  <img src="template/images/uparrow.png" alt="Đi lên" border="0" width="16" height="16"></a></span>
												<span><a href="javascript:void(0);" onclick="return OrderDown('cb<?php echo $rs['stt']; ?>', 'cb<?php echo $rs['stt']+1; ?>','orderdown')" title="Đi Xuống">  <img src="template/images/downarrow.png" alt="Đi Xuống" border="0" width="16" height="16"></a></span>
												<input name="order[]" size="5" value="<?php echo $rs['ordering']; ?>" class="text_area" style="text-align: center;" type="text">
											
											<?php }	else { ?>
												<span> &nbsp; </span>
												<span> &nbsp; </span>
												<input name="order[]" size="5" value="<?php echo $rs['ordering']; ?>" class="text_area" style="text-align: center;" type="text">
											<?php } ?>
							
										</td>					
										<td><a href=".?com=com_content&view=news&task=view&sesid=<?php echo $rs['Ses_Id'] ?>&catid=<?php echo $rs['CatID'];?>&authorid=<?php echo $rs['AccID'];?>" title="<?php echo $rs['fullname'] ?>"><?php echo $rs['fullname'] ?></a></td>
										<td nowrap="nowrap"><?php echo date('d/m/Y', $rs['date_add']) ?></td>
										<td align="center" nowrap="nowrap"><?php echo $rs['num_view'] ?></td>
										<td align="center" nowrap="nowrap"><a href=".?com=com_content&view=news&task=copy&id=<?php echo $rs['id'] ?>"><img width="23" src="template/images/copy_f2.png"></a></td>
										<td align="center"><input id="cb<?php echo $rs['stt'] ?>" name="cid[]" value="<?php echo $rs['id'] ?>" onclick="isChecked(this.checked);" type="checkbox"></td>
									</tr>
							<?php 
									}
								}
							} ?>
							</tbody>
						</table>
				  	</div>
				</div>
			  	<script type="text/javascript" src="javascript/msdn.js"></script>
				<!-------------------------------->
			
				<input type=hidden name=page value=<?php echo $p; ?>>
				<INPUT type=hidden value=submit_com_content_news_view name=hidden>
				<INPUT type=hidden value=0 name=boxchecked>
				<INPUT type=hidden name=task>
			</form>
	
			<div class="clr"></div>
		</div>
		<div class="b">
			<div class="b">
				<div class="b"></div>
			</div>
		</div>
	</div>
	
	<noscript>!Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị</noscript>
	
	<div class="clr"></div>
</div>
<div class="clr"></div>
</div>
</div>
<div id="border-bottom"><div><div></div></div></div>
<?php } ?>