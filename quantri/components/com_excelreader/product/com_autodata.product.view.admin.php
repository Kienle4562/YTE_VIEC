<?php defined( '_VALID_MOS' ) or die( include("404.php") );
if($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator")
{
	$myprocess = new process();
	
	if (!isset($_SESSION['amdin']['com_product']['product']['lang_code']))
	{
		$_SESSION['amdin']['com_product']['product']['lang_code'] = 'vi';
	} ?>

<!-- css and script split panel -->
<link type="text/css" rel="stylesheet" href="css/layout-default-latest.css" />
<script type="text/javascript" src="javascript/jquery-ui-latest.js"></script>
<script type="text/javascript" src="javascript/jquery.layout-latest.js"></script>
<script type="text/javascript">	
	var myLayout;
	
	jQuery(document).ready(function () {
		if (jQuery('.ui-layout-center').height() < 400)
		{
			jQuery('.split_panel').css('height', 450);
		}
		else
		{
			jQuery('.split_panel').css('height', jQuery('.ui-layout-center').height() + 100);
		}

		// this layout could be created with NO OPTIONS - but showing some here just as a sample...
		// myLayout = jQuery('body').layout(); -- syntax with No Options
		myLayout = jQuery('.split_panel').layout({
			//	enable showOverflow on west-pane so CSS popups will overlap north pane
			//	west__showOverflowOnHover: false
			//	reference only - these options are NOT required because 'true' is the default
				closable:				true	// pane can open & close
			,	resizable:				true	// when open, pane can be resized 
			,	slidable:				true	// when closed, pane can 'slide' open over other panes - closes on mouse-out	
			,   resizerDblClickToggle:  false
			//	some pane-size settings
			,	west__minSize:			100
			,	east__size:				300
			,	east__minSize:			200
			,	east__maxSize:			Math.floor(screen.availWidth / 2) // 1/2 screen width
			,	center__minWidth:		100
			,	useStateCookie:			true
		});
		
		// if there is no state-cookie, then DISABLE state management initially
		var cookieExists = false;
		for (var key in myLayout.getCookie()) {
			cookieExists = true;
			break
		}
	});
</script>
<!-- css and script tree explorer -->
<link rel="stylesheet" href="css/jquery.treeview.css" />
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
<script language="javascript">
	function filter_data(){
		var catid = jQuery('#catid').attr("value");
		var authorid = jQuery('#authorid').attr("value");
		var start_date = jQuery('#start_date').attr("value");
		var from_date = jQuery('#from_date').attr("value");
		if(start_date != "" && from_date != ""){
			location.href = ".?com=com_product&view=product&task=view&catid=" + catid + "&authorid=" + authorid + "&start_date=" + start_date + "&from_date=" + from_date;
		} else {
			location.href = ".?com=com_product&view=product&task=view&catid=" + catid + "&authorid=" + authorid;
		}
	}
</script>
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
									<?php if ($GLOBALS['MULTI_LANG']) { ?>
										<td class="button" id="toolbar-synch">
											<a href="#" class="toolbar" onclick="javascript:submitbutton('synch')">
											<span class="icon-32-synch" title="Đồng bộ ngôn ngữ"></span>
											Đồng bộ ngôn ngữ
											</a>
										</td>
									<?php } ?>
									<td class="button" id="toolbar-publish">
										<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một sản phẩm từ danh sách để');}else{  submitbutton('publish')}" class="toolbar">
											<span class="icon-32-publish" title="Bật"></span>Bật
										</a>
									</td>
									
									<td class="button" id="toolbar-unpublish">
										<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một sản phẩm từ danh sách để');}else{  submitbutton('unpublish')}" class="toolbar">
											<span class="icon-32-unpublish" title="Tắt"></span>Tắt
										</a>
									</td>
									
									<td class="button" id="toolbar-trash">
										<a href="#" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn một sản phẩm từ danh sách để');}else if(confirm('Bạn có chắc chắn muốn xóa những mẫu tin được chọn không? ')){  submitbutton('remove')}" class="toolbar">
										<span class="icon-32-trash" title="Sọt rác"></span>Sọt rác
										</a>
									</td>
													
									<td class="button" id="toolbar-new">
										<a href=".?com=com_product&view=product&task=add" class="toolbar">
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
			
					<div class="header icon-48-article">Sản phẩm: <small>[ Danh sách ]</small></div>
		
					<div class="clr"></div>
				</div>
				<div class="b">
					<div class="b">
						<div class="b"></div>
					</div>
				</div>
			</div>
			<div class="clr"></div>
					
			<div id="element-box" style="margin-bottom:10px;">
				<div class="t">
					<div class="t">
						<div class="t"></div>
					</div>
				</div>
				<div class="m">
				
					<strong>
                        <a href=".?com=com_product&view=category&task=view">Danh mục</a> |
                        <a href=".?com=com_product&view=product&task=view">Sản phẩm</a> |
                        <a href=".?com=com_product&view=comment&task=view">Bình luận</a>
                    </strong>
                    
                    <?php if ($GLOBALS['MULTI_LANG']) { ?>
	                    <div style="float: right">
							<form method="post" name="phpFormTop">
								<strong>Ngôn ngữ:</strong>
								<select name="lang_code" onchange="document.phpFormTop.submit()">
									<?php
										foreach ($GLOBALS['LANG_LIST'] as $key => $item)
										{
											if (isset($_SESSION['amdin']['com_product']['product']['lang_code']) && $_SESSION['amdin']['com_product']['product']['lang_code'] == $key)
											{
												echo '<option value="', $key, '" selected="selected">', $item['lang_name'], '</option>';
											}
											else
											{
												echo '<option value="', $key, '">', $item['lang_name'], '</option>';
											}
										}
									?>
								</select>
								<input type='hidden' value='submit_com_product_product_view' name='hidden'>
							    <input type='hidden' value='change_lang_code' name='task'>
							</form>
						</div>
					<?php } ?>
					
					<div class="clr"></div>
				</div>
				<div class="b">
					<div class="b">
						<div class="b"></div>
					</div>
				</div>
			</div>	
			
			<div id="element-box">
				<div class="t">
					<div class="t">
						<div class="t"></div>
					</div>
				</div>
				<div class="m">
					<form method="post" name="phpForm" id="phpForm">
						<div class="split_panel">
							<div class="ui-layout-west">
				
								<div id="sidetree" style="padding-left:10px;"> 
								<div class="treeheader">&nbsp;</div> 
								<div id="sidetreecontrol"><a href="?#">Collapse All</a> | <a href="?#">Expand All</a></div> 
									
									<?php		
										function categories ($parentid = 0)
                                        {
										    global $myprocess;
										    global $core_class;
										    
										    $result = $myprocess->category_multi_level($parentid, $_SESSION['amdin']['com_product']['product']['lang_code']);
										    
										    $total = $result->rowCount();
								
											if ($total > 0)
                                            {
												echo '<ul id="tree">';
												
                                                while($row = $result->fetch())
                                                {
													echo '<li>';
													
                                                    if ($parentid == 0) {
														echo '<a href="?com=com_product&view=product&task=view&catid=', $row["cat_id"], '"><strong>', $core_class->create_lang_flag($row['lang_code'], 16, true), ' ', $row["title"], '</strong></a>';
													}
                                                    else {
														echo '<a href="?com=com_product&view=product&task=view&catid=', $row["cat_id"], '">', $core_class->create_lang_flag($row['lang_code'], 16, true), ' ', $row["title"], '</a>';
													}
                                                    
                                                    if ($row['cnt'] > 0) {
                                                        echo ' <span class="number">(', $row['cnt'], ')</span>';
                                                    }
                                                    
													categories($row["cat_id"]);
													
                                                    echo '</li>';
													$i++;
												}
												
                                                echo '</ul>';
											}
										}
										
                                        categories(0);
									?>	
								</div>
							
							</div>
							
							<div class="ui-layout-center">
							
								<table>
									<tbody>
										<tr>
											<td width="100%"></td>
											<td nowrap="nowrap">
												<p>
													<select class="inputbox" size="1" name="catid" id="catid">
														<option value=0 selected>- Chọn danh mục sản phẩm -</option>
														<?php 
															function category($parentid = 0, $k = 0)
															{
																global $myprocess;
																										
																$result = $myprocess->category_multi_level($parentid, $_SESSION['amdin']['com_product']['product']['lang_code']);
																
																while ($row = $result->fetch())
																{													
																	echo '<option ';
																	if ($row['cat_id'] == intval($_GET["catid"])) { echo 'selected '; }
																	echo ' value=', $row['cat_id'], '>', str_repeat('&nbsp;&nbsp;|____', $k), $row['title'], '</option>';
																	category($row["cat_id"], $k + 1);														
																}
															}
															category(0, 0);
														?>
													</select>
													<select class="inputbox" size="1" name="authorid" id="authorid">
														<option value="0" selected>- Chọn tác giả bài viết -</option>
														<?php
															$result_author = $myprocess->get_author_list();
															while ($row_author = $result_author->fetch())
															{
																?><option <?php if($row_author['Ac_Id'] == intval($_GET["authorid"])){echo "selected";} ?> value="<?php echo $row_author['Ac_Id'] ?>"><?php echo $row_author['UserName'] . "[". $row_author['fullName'] . "]" ?></option><?php
															}
														?>
													</select>
													Từ ngày: 
													<input type="text" id="start_date" name="start_date" maxlength="10" size="12" readonly="true" value="<?php echo $_GET["start_date"]; ?>" />
													<script type="text/javascript" src="../calendar/javascript/dhtmlgoodies_calendar.js?random=20060118"></script>
													<img src="../calendar/images/calendar.gif" class="mar_img" align="top" onClick="displayCalendar(document.phpForm.start_date,'dd/mm/yyyy',this);"  />
													&nbsp;&nbsp;&nbsp; Đến ngày: 
													<input type="text" id="from_date" name="from_date" maxlength="10" size="12" readonly="true" value="<?php echo $_GET["from_date"]; ?>" />
													<img src="../calendar/images/calendar.gif" class="mar_img" align="top" onClick="displayCalendar(document.phpForm.from_date,'dd/mm/yyyy',this);"  />
													&nbsp;&nbsp;&nbsp; <input onclick="javascript:filter_data();" class="btn" type="button" name="btn_filter" value="Lọc kết quả" />
												</p>
												
												<p style="float:right;">
													<strong>Di chuyển sản phẩm đến Danh mục</strong>
													<select class="inputbox" size="1" name="move_to_cat">
														<option value=0 selected>- Chọn danh mục sản phẩm -</option>
														<?php category(0, 0); ?>
													</select>
													<a href="javascript:void(0)" onclick="javascript:if(document.phpForm.boxchecked.value==0){alert('Vui lòng chọn sản phẩm từ danh sách để di chuyển');}else{  submitbutton('move')}">Di chuyển</a>
												</p>
											
											</td>
										</tr>
									</tbody>
								</table>
								
								<table class="adminlist">
								<thead>
								
									<?php 
										include("../protected/back_end_paging.php");
										
                                        $catid = ""; $authorid = ""; $date = "";
										
                                        if (isset($_GET["catid"]) && $_GET["catid"] != 0)
                                        {
                                            $catid = "
                                                AND `book_product`.`book_category_id` IN (
                                    
                                                    SELECT
                                                            `product_category`.`cat_id`
                                                    FROM
                                                            `product_category`,
                                                            (
                                                                SELECT
                                                                        `left`,
                                                                        `right`
                                                                FROM
                                                                        `product_category`
                                                                WHERE
                                                                        `cat_id` = " . intval($_GET["catid"]) . "
                                                                        AND `lang_code` = '" . $_SESSION['amdin']['com_product']['product']['lang_code'] . "'
                                                                LIMIT 0,1
                                                            ) as a
                                                    WHERE `product_category`.`left` >= a.`left` AND `product_category`.`right` <= a.`right`
                                                )
                                            ";
                                        }
										if( isset($_GET["authorid"]) && $_GET["authorid"] != 0) { $authorid = " AND `account`.`Ac_Id` = " . intval($_GET["authorid"]); }
										
										$conditions = $catid . $authorid;
										$result = $myprocess->get_article_view($conditions, $_SESSION['amdin']['com_product']['product']['lang_code']);
							
										$i = 1; $stt = 1; $order_icon = 0;
										
										while ($row = $result->fetch())
										{
											if ($i == 1 && $row['news_category_group'] != 1) { $order_icon = 1; }
											else if ($i == $row['news_category_group'] && $row['news_category_group'] != 1) { $order_icon = 2; $i = 0;}
											else if ($row['news_category_group'] !=1) { $order_icon = 3; }
											else { $order_icon = 0; $i = 0;}
											
											$table_result[] = array(
												'stt'=>$stt++, 
												'id'=>$row['Id'], 
												'cat_title'=>$row['cat_title'],
												'news_title'=>$row['product_name'],
												'focus'=>$row['hot_product'], 
												'num_view'=>$row['num_view'], 
												'enabled'=>$row['status'], 
												'date_add'=>$row['date_add'],
												'ordering'=>$row['order_num'],
												'fullname'=>$row['fullName'],
												'order_icon'=>$order_icon,
												'category_id'=>$row['book_category_id'],
												'Ac_Id'=>$row['Ac_Id'],
												'lang_code'=>$row['lang_code']
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
										$i = 1;
									foreach($table_result as $k=>$rs) {
										if($rs['stt'] > $pager->offset && $rs['stt'] <= $pager->limit){ ?>
											<tr class="row<?php if($rs['stt'] % 2 == 0){echo "0";}else{ echo "1";}?>">
												<td align="center"><?php echo $rs['stt'] ?></td>
												<td align="center"><?php echo $rs['id'] ?></td>
												<td>
													<div style="padding-bottom:8px;">
														<a href=".?com=com_product&view=product&task=view&catid=<?php echo $rs['category_id'] ?>">
															<?php echo $rs['cat_title'] ?>
														</a>
													</div>
													<strong>&nbsp;&nbsp;|____ </strong> &nbsp;
													<a href=".?com=com_product&view=product&task=edit&id=<?php echo $rs['id'] ?>">
														<?php $core_class->create_lang_flag($rs['lang_code'], 16); ?>
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
														<span> <a href="javascript:void(0);" title="Không có mục để sắp xếp">  <img src="template/images/publish_x.png" alt="Đi Xuống" border="0" width="16" height="16"></a> </span>
														<span> &nbsp; </span>
														<input name="order[]" size="5" value="<?php echo $rs['ordering']; ?>" class="text_area" style="text-align: center;" type="text">
													<?php } ?>
									
												</td>					
												<td><a href=".?com=com_product&view=product&task=view&catid=<?php echo $rs['category_id'];?>&authorid=<?php echo $rs['Ac_Id'];?>" title="<?php echo $rs['fullname'] ?>"><?php echo $rs['fullname'] ?></a></td>
												<td nowrap="nowrap"><?php echo date('d/m/Y', $rs['date_add']) ?></td>
												<td align="center" nowrap="nowrap"><?php echo $rs['num_view'] ?></td>
												<td align="center" nowrap="nowrap"><a href=".?com=com_product&view=product&task=copy&id=<?php echo $rs['id'] ?>"><img width="23" src="template/images/copy_f2.png"></a></td>
												<td align="center"><input id="cb<?php echo $i; ?>" name="cid[]" value="<?php echo $rs['id'] ?>" onclick="isChecked(this.checked);" type="checkbox"></td>
											</tr>
									<?php 
											$i++; }
										}
									} ?>
									</tbody>
								</table>
							
							</div>
							
						</div>
						
						<input type="hidden" name="page" value="<?php echo $p; ?>">
						<INPUT type="hidden" value="submit_com_product_product_view" name="hidden">
						<INPUT type="hidden" value="0" name="boxchecked">
						<INPUT type="hidden" name="task">
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