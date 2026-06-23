<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 

    include_once("mod_show_option_list.models.php");
    include_once("mod_show_option_list.handler.php");
    
    $myprocess = new process_block_news();

    $result = $myprocess->get_module_edit(intval($url[1]));
    
    if ($row_detail = $result->fetch())
    {
        if (empty($row_detail["params"]) || $row_detail["params"] == "undefine") {
            $params = array(
                'cat_id' => -1,
                'sub_number' => 4,
				'news_id' => 0,
				'subdec_number' => 100,
				'layout_boostrap' => 2,
                'class' => "",
				'show_option_type_choose' => 'Hình ảnh & thông tin mô tả',
				'show_option_type_value'  => '1',
            );
        }
        else {
            $params = unserialize($row_detail["params"]);
        } 
	
		?>
        
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
								        <td class="button" id="toolbar-save">
									        <a href="#" onclick="javascript: submitbutton('save')" class="toolbar">
										        <span class="icon-32-save" title="Lưu và thoát"></span> Lưu lại
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
				        <div class="header icon-48-sections">
					        Modules » <small>[Danh mục tin tức] » Chỉnh sửa module</small>
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
		        
		        <?php if(isset($_SESSION["sys_message"]["error"])) { ?>
		        <div id="toolbar-box">
			        <div class="t"><div class="t"><div class="t"></div></div></div>
			        <div class="m">
				        <div style="text-align:center;font-size:18px;color:#FF0000;"><?php echo $_SESSION["sys_message"]["error"]; ?></div>
			        </div>
			        <div class="b"><div class="b"><div class="b"></div></div></div>
		        </div>
		        <?php unset($_SESSION["sys_message"]["error"]); } ?>
		        
		        <div id="element-box">
			        <div class="t">
				        <div class="t">
					        <div class="t"></div>
				        </div>
			        </div>
			        <div class="m">
				        <script language="javascript" type="text/javascript">
					        //<!--	
					        function submitbutton(pressbutton)
					        {
						        var form = document.phpForm;
						        if (pressbutton == 'cancel') {
							        submitform( pressbutton );
							        return;
						        }
						        
						        if (form.title.value == ""){
							        alert("Vui lòng nhập tiêu đề module");
							        form.title.focus();
							        return;
						        } else if (form.show_option_type_value.value == ""){
							        alert("Vui lòng chọn kiểu hiển thị");
							        form.show_option_type_choose.focus();
							        return;
						        } else {							
							        submitform(pressbutton);
						        }
                            }
							
							function show_option_choose(id, title){
								var form = document.phpForm;
								form.show_option_type_choose.value = title;
								form.show_option_type_value.value = id;
							}
					        //-->
				        </script>
				        <form method="post" name="phpForm">
					        <div class="col width-50">
						        <?php include('modules/modules.backend.left.php'); ?>
					        </div>
			        
					        <div class="col width-50">
                              <fieldset class="adminform">
                                <legend>Cấu hình</legend>
                                  <table class="admintable" width="100%">
                                      <tbody id="phone_container">
                                          <tr>
                                              <td class="key">
                                                  Danh mục cha
                                              </td>
                                              <td>
                                                  <select name="cat_id">
                                                      <option value="0">--Hiển thị tất cả--</option>
                                                      <?php
                                                            function category($parentid = 0, $category_id, $space = '&nbsp;&nbsp;|____')
                                                            {
                                                            	global $row_detail;

                                                                $myprocess = new process_block_news();
                                                                
                                                                $result = $myprocess->category_multi_level($parentid, $row_detail['lang_code']);
                                                                
                                                                while($row = $result->fetch())
                                                                {
                                                                    echo '<option ';
                                                                    
                                                                    if ($row['cat_id'] == $category_id) {
                                                                        echo 'selected="selected" ';
                                                                    }
                                                                    
                                                                    echo ' value="', $row['cat_id'], '">', $space, ' ', $row['title'], '</option>';
                                                                    
                                                                    category($row["cat_id"], $category_id, $space . '&nbsp;&nbsp;|____');
                                                                }
                                                            }
                                                            
                                                            echo category(0, $params['cat_id']);
                                                        ?>
                                                  </select>
                                              </td>
                                          </tr>                                          
                                          <tr>
                                              <td class="key">
                                                  ID bản tin
                                              </td>
                                              <td>
                                                  <input type="text" name="news_id" value="<?php echo $params['news_id']; ?>" />
                                                  <span class="editlinktip hasTip" title="Chọn số mẫu tin con sẽ hiện thị ngoài trang chủ,vui lòng chọn lớn hơn 0">
                                                      <a href="javascript:void(0);">
                                                          Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" />
                                                      </a>
                                                  </span>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="key">
                                                  Số mẫu tin hiển thị
                                              </td>
                                              <td>
                                                  <input type="text" name="sub_number" value="<?php echo $params['sub_number']; ?>" />
                                                  <span class="editlinktip hasTip" title="Chọn số mẫu tin con sẽ hiện thị ngoài trang chủ,vui lòng chọn lớn hơn 0">
                                                      <a href="javascript:void(0);">
                                                          Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" />
                                                      </a>
                                                  </span>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="key">
                                                  Số ký tự hiển thị
                                              </td>
                                              <td>
                                                  <input type="text" name="subdec_number" value="<?php echo $params['subdec_number']; ?>" />
                                                  <span class="editlinktip hasTip" title="Chọn số mẫu tin con sẽ hiện thị ngoài trang chủ,vui lòng chọn lớn hơn 0">
                                                      <a href="javascript:void(0);">
                                                          Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" />
                                                      </a>
                                                  </span>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="key">
                                                 layout hiển thị
                                              </td>
                                              <td>
                                               <input type="radio" name="layout_boostrap" id="layout_boostrap0" value="0" class="inputbox" <?php if($params["layout_boostrap"] == 0) { echo 'checked="checked"'; } ?>>
                                                <label for="layout_boostrap0">module</label>
                                                <input type="radio" name="layout_boostrap" id="layout_boostrap1" value="1" class="inputbox" <?php if($params["layout_boostrap"] == 1) { echo 'checked="checked"'; } ?>>
                                                <label for="layout_boostrap1">content</label>
                                                <input type="radio" name="layout_boostrap" id="layout_boostrap2" value="2" class="inputbox" <?php if($params["layout_boostrap"] == 2) { echo 'checked="checked"'; } ?>>
                                                <label for="layout_boostrap1">Mặc định</label>
                                                  <span class="editlinktip hasTip" title="Chọn kiểu reponsive cho module">
                                                      <a href="javascript:void(0);">
                                                          Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" />
                                                      </a>
                                                  </span>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="key">
                                                  Class
                                              </td>
                                              <td>
                                                  <input type="text" name="class" value="<?php echo $params['class']; ?>" />
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="key">
                                                  Kiểu hiển thị
                                              </td>
                                              <td>
                                                  <input size="40" readonly="readonly" type="text" name="show_option_type_choose" id="show_option_type_choose" value="<?php echo $params['show_option_type_choose']; ?>" /> Chọn bên dưới
                                                  <input type="hidden" name="show_option_type_value" id="show_option_type_value" value="<?php echo $params['show_option_type_value']; ?>" />
                                              </td>
                                          </tr>
                                           <tr>
                                              <td colspan="2">
                                              
													  <div class="cke_skin_kama">
                                                       	  <div class="cke_single_page">
                                                            	
                                                               <?php 
																	$template = array( array("id" => 1, "image" => $index_backend . "images/option_list_template/1.png", "title" => "Hình ảnh & thông tin mô tả" , "description" => "Hiển thị hình ảnh và thông tin mô tả."),
																					   array("id" => 2, "image" => $index_backend . "images/option_list_template/2.png", "title" => "Hình ảnh, tiêu đề & thông tin mô tả" , "description" => "Hiển thị hình ảnh, tiêu đề và thông tin mô tả. Các tin khác bên dưới"),
																					   array("id" => 3, "image" => $index_backend . "images/option_list_template/3.png", "title" => "Hình ảnh & các tin liên quan" , "description" => "Hiển thị hình ảnh, tiêu đề nằm bên dưới hình ảnh với các tin liên quan (bên phải)."),
																					   array("id" => 4, "image" => $index_backend . "images/option_list_template/4.png", "title" => "Hình ảnh & tiêu đề bản tin" , "description" => "Hiển thị danh sách bản tin bao gồm hình ảnh và tiêu đề bản tin."),
																					   array("id" => 5, "image" => $index_backend . "images/option_list_template/5.png", "title" => "Danh sách bản tin" , "description" => "Hiển thị danh sách bản tin bao gồm tiêu đề bản tin.")
																				); 
																?>
                                                                
                                                              <table class="cke_dialog_contents" role="presentation">
                                                                <tbody>
                                                                    <tr>
                                                                        <td id="cke_dialog_contents_181" class="cke_dialog_contents" role="presentation" style="width: 440px;">
                                                                            <div role="tabpanel" id="190_uiElement" class="cke_dialog_ui_vbox cke_dialog_page_contents" style="width: 100%; height: 100%; " aria-labelledby="selectTpl_191" name="selectTpl" aria-hidden="false">
                                                                                <table role="presentation" cellspacing="0" border="0" style="width:100%;" align="left">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td role="presentation" class="cke_dialog_ui_vbox_child"><div role="presentation" id="189_uiElement" class="cke_dialog_ui_vbox">
                                                                                                <table role="presentation" cellspacing="0" border="0" style="width:100%;" align="left">
                                                                                                    <tbody>
                                                                                                        <tr>
                                                                                                            <td role="presentation" style="padding:5px" class="cke_dialog_ui_vbox_child">
                                                                                                                <span id="184_uiElement" class="cke_dialog_ui_html">Hãy chọn mẫu dựng sẵn để thiết lập kiểu hiển thị cho module</span>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td role="presentation" style="padding:5px" class="cke_dialog_ui_vbox_child">
                                                                                                                <div class="cke_tpl_list" tabindex="-1" role="listbox" aria-labelledby="cke_tpl_list_label_180" id="185_uiElement">
                                                                                                                	<?php for ($row = 0; $row < count($template); $row++){ ?>																													
                                                                                                                    <a href="javascript:show_option_choose(<?php echo $template[$row]["id"]; ?>, '<?php echo $template[$row]["title"]; ?>')" tabindex="-1" role="option" aria-posinset="1" aria-setsize="3">
                                                                                                                        <div class="cke_tpl_item">
                                                                                                                            <table style="width:350px;" class="cke_tpl_preview" role="presentation">
                                                                                                                                <tbody>
                                                                                                                                    <tr>
                                                                                                                                        <td class="cke_tpl_preview_img"><img src="<?php echo $template[$row]["image"]; ?>" alt="" title=""></td>
                                                                                                                                        <td style="white-space:normal;"><span class="cke_tpl_title"><?php echo $template[$row]["title"]; ?></span><br><span><?php echo $template[$row]["description"]; ?></span></td>
                                                                                                                                    </tr>
                                                                                                                                </tbody>
                                                                                                                            </table>
                                                                                                                        </div>
                                                                                                                    </a>
                                                                                                                    <?php } ?>
                                                                                                                 </div>
                                                                                                                 <span class="cke_voice_label" id="cke_tpl_list_label_180">Tùy chọn mẫu dựng sẵn</span>
                                                                                                            </td>
                                                                                                        </tr>                                                                                              
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                        </td>
                                                                                   </tr>
                                                                                </tbody>
                                                                                </table>
                                                                            </div>
                                                                         </td>
                                                                    </tr>
                                                                 </tbody>
                                                              </table>
                                                            
                                                          </div>
                                                      </div>
                                              </td>
                                          </tr>
                                      </tbody>
                                  </table>
                                </fieldset>
					        </div>
					        <div class="clr"></div>			
					        <input type="hidden" name="hidden" value="submit_mod_show_option" />
                            <input type="hidden" name="module_id" value="<?php echo $url[1]; ?>" />
					        <input type="hidden" name="task" value="" />
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
        <?php
    }