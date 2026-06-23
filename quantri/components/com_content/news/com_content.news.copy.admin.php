<?php defined( '_VALID_MOS' ) or die( include("404.php") );
if($_SESSION["session"]["key"] == "Supper Administrator" || $_SESSION["session"]["key"] == "Administrator"){ 
// bat dau thuc thi voi quyen Supper Administrator va Administrator
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
					<tr>
						<td class="button" id="toolbar-save">
							<a href="#" onclick="javascript: submitbutton('save')" class="toolbar">
								<span class="icon-32-save" title="Lưu"></span>Lưu và đóng
							</a>
						</td>
						
						<td class="button" id="toolbar-apply">
							<a href="#" onclick="javascript: submitbutton('apply')" class="toolbar">
								<span class="icon-32-apply" title="Áp dụng"></span>Lưu
							</a>
						</td>
						
						<td class="button" id="toolbar-cancel">
							<a href="#" onclick="javascript: submitbutton('cancel')" class="toolbar">
								<span class="icon-32-cancel" title="Hủy"></span>Hủy
							</a>
						</td>
						
						<td class="button" id="toolbar-help">
							<a href="#" onclick="popupWindow('', 'Trợ giúp', 640, 480, 1)" class="toolbar">
								<span class="icon-32-help" title="Trợ giúp"></span>Trợ giúp
							</a>
						</td>
					
					</tr>
					</table>
			</div>
<div class="header icon-48-addedit">
Bài viết: <small><small>[ Chỉnh sữa ]</small></small>
</div>

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
				<script language="javascript" type="text/javascript">
					<!--
					function submitbutton(pressbutton)
					{
						var form = document.phpForm;
						if (pressbutton == 'cancel') {
							submitform( pressbutton );
							return;
						}
						
						if (form.title.value == ""){
							alert("Vui lòng nhập tiêu đề");
							form.title.focus();
							return;
						} else if (form.catid.value == "0"){
							alert("Vui lòng chọn danh mục");
							return;
						} else {
							if(form.alias.value == ''){
								form.alias.value = form.title.value;
							}
							submitform(pressbutton);
						}						
					}
					//-->
				</script>
				<script type="text/javascript" src="../myeditor/myfinder/ckfinder.js"></script>
				<script language="javascript" type="text/javascript">
					function BrowseServer( inputId )
					{
						var finder = new CKFinder() ;
						finder.StartupPath  = "Product:/product/";
						finder.selectActionFunction = SetFileField ;
						finder.selectActionData = inputId ;
						finder.popup();
					}
					
					// This is a sample function which is called when a file is selected in CKFinder.
					function SetFileField( fileUrl, data )
					{
						document.getElementById( data["selectActionData"] ).value = fileUrl;
					}
				</script>
				<?php
					$result = $myprocess->get_article_edit(intval($_GET["id"]));
					if($row = $result->fetch()){
				?>
				<form method="post" name="phpForm">
					<table cellspacing="0" cellpadding="0" border="0" width="100%">
						<tr>
							<td valign="top">
								<table  class="adminform">
									<tr>
										<td>
											<label for="title">Tiêu đề	</label>
										</td>
										<td>
											<input class="inputbox" type="text" name="title" id="title" size="70" maxlength="255" value="<?php echo $row['title'] ?>" />
										</td>
										<td>
											<label>Đã được bật </label>
										</td>
										<td>
										<?php if($row['enabled'] == 1){ ?>
											<input type="radio" name="state" id="state0" value="0"/>
											<label for="state0">No</label>
											<input type="radio" name="state" id="state1" value="1" checked="checked"/>
											<label for="state1">Yes</label>
										<?php } else { ?>
											<input type="radio" name="state" id="state0" value="0" checked="checked"/>
											<label for="state0">No</label>
											<input type="radio" name="state" id="state1" value="1"/>
											<label for="state1">Yes</label>
										<?php } ?>
										</td>
									</tr>
									<tr>
										<td>
											<label for="alias">Alias </label>
										</td>
										<td>
											<input class="inputbox" type="text" name="alias" id="alias" size="70" maxlength="255" value="<?php echo $row['alias'] ?>" />
										</td>
										<td>
											<label>Tin tiêu điểm </label>
										</td>
										<td>
										<?php if($row['focus'] == 1){ ?>
											<input type="radio" name="frontpage" id="frontpage0" value="0"  />
											<label for="frontpage0">No</label>
											<input type="radio" name="frontpage" id="frontpage1" value="1" checked="checked" />
											<label for="frontpage1">Yes</label>
										<?php } else { ?>
											<input type="radio" name="frontpage" id="frontpage0" value="0" checked="checked"  />
											<label for="frontpage0">No</label>
											<input type="radio" name="frontpage" id="frontpage1" value="1"  />
											<label for="frontpage1">Yes</label>
										<?php } ?>
										</td>
									</tr>
									<tr>
										<td>
											<label for="alias">Hình ảnh </label>
										</td>
										<td>
											<div style="float: left;">
											<input style="background: #ffffff;" type="text" id="image_file" name="image_file" value="<?php echo $row['img_file']; ?>" size="55" />
											</div>
											<div class="button2-left">
												<div class="blank">
												<a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('image_file');">Lựa chọn</a>
												</div>
											</div>
										</td>
										<td>
											<label>Hiển thị </label>
										</td>
										<td>
											<?php if($row['img_status'] == 1){?>
												<input type="radio" name="img_status" id="img_status0" value="0" />
												<label for="img_status0">No</label>
												<input type="radio" name="img_status" id="img_status1" value="1"  checked="checked" />
												<label for="img_status1">Yes</label>
											<?php } else { ?>
												<input type="radio" name="img_status" id="img_status0" value="0" checked="checked"  />
												<label for="img_status0">No</label>
												<input type="radio" name="img_status" id="img_status1" value="1"  />
												<label for="img_status1">Yes</label>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<td>
											<label for="sectionid">Danh mục </label>
										</td>
										<td>
											<select class="inputbox" size=1 name="catid" id="catid">
												<option id="0" value="0" selected>- Chọn Danh mục</option>"
												<?php 
													$category_id = $row['category_id'];
													function category($parentid = 0, $category_id, $space = '&nbsp;&nbsp;&nbsp;/_ ', &$html = ''){
														$myprocess = new process();										
														$result = $myprocess->category_multi_level($parentid);
														while($row = $result->fetch()){													
															$html .= '<option ';
															if($row['cat_id'] == $category_id){ $html .= 'selected '; }
															$html .= ' value="'.$row['cat_id'].'">'.$space . $row['title'] . '</option>';
															category($row["cat_id"], $category_id, $space.'&nbsp;/_&nbsp;', $html);
														}				
														return $html;
													}
													echo category(0, $category_id);
												?>
											</select>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
								</table>
							</td>
							<td valign="top" width="320" style="padding: 7px 0 0 5px">
								<div id="content-pane" class="pane-sliders">
									<div class="panel">
										<h3 class="jpane-toggler title" id="detail-page">
											<span>Các thông số - bài viết</span>
										</h3>
										<div class="jpane-slider content">
											<table width="100%" class="paramlist admintable" cellspacing="1" height="81px;">
												<tr>
													<td width="40%" class="paramlist_key">
														<span class="editlinktip">
														<label id="detailscreated_by-lbl" for="detailscreated_by" class="hasTip" title="Tác giả::Tên tác giả">Tác giả</label>
														</span>
													</td>
													<td class="paramlist_value">
														<select class="inputbox" size="1" name="created_by">
															<?php $result = $myprocess->get_author_list();
															while($row1 = $result->fetch()){ ?>
																<option <?php if($row1['userName'] == $row["acc_id"]) { echo "selected"; } ?> value=<?php echo $row1['Ac_Id'] ?>><?php echo $row1['userName'] ?></option>
															<?php } ?>
														</select>
													</td>
												</tr>
												<tr>
													<td width="40%" class="paramlist_key">
														<span class="editlinktip">
														<label id="detailscreated-lbl" for="detailscreated" class="hasTip" title="Ngày tạo::Ngày tạo bài viết này">Ngày tạo</label>
														</span>
													</td>
													<td class="paramlist_value">
														<input class="text_area" name="date_add" id="date_add" value="<?php echo date('d/m/Y')?>" size="20" maxlength="10" title="ngày bản tin được thêm" type="text">						
														<script type="text/javascript" src="../calendar/javascript/dhtmlgoodies_calendar.js?random=20060118"></script>
														<img src="../calendar/images/calendar.gif" class="mar_img" align="top" onClick="displayCalendar(document.phpForm.date_add,'dd/mm/yyyy',this);"  />
													</td>
												</tr>					
											</table>
										</div>
									</div>
								</div>								
							</td>
						</tr>
					</table>
				
				<table class="adminform">
					<tr>
						<td>				
							<br>
							<label style="font-weight:bold ">Nội dung tổng quát:</label> <br><br>
							<script type="text/javascript" src="../myeditor/ckeditor.js"></script>
							<textarea name="html_description"><?php echo $row['description']; ?></textarea>
							<script type="text/javascript">
								CKEDITOR.replace( 'html_description' );
							</script>
							<br>
							<label style="font-weight:bold ">Nội dung chi tiết: (thông tin tùy chọn có thể để trống)</label> <br><br>
							<textarea name="html_content"><?php echo $row['content']; ?></textarea>
							<script type="text/javascript">
								CKEDITOR.replace( 'html_content', {height : '500px'} );
							</script>
						</td>
					</tr>
				</table>
				<INPUT type="hidden" name="newsid" value="<?php echo $row['news_id'] ?>">
				<input type="hidden" id="hidden" name="hidden" value="submit_com_content_news_copy" />
				<input type="hidden" name="task"/>
				</form>
				<?php } ?>
				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
   		</div>
		<noscript>
			!Cảnh báo! Javascript phải được bật để chạy được các chức năng trong phần Quản trị		</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id="border-bottom"><div><div></div></div></div>
<?php } ?>	