<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 

    include_once("mod_company.models.php");
    include_once("mod_company.handler.php");
    
    $myprocess = new process_mod_company();

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
						        
						        submitform(pressbutton);
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
                                                  Mô tả
                                              </td>
                                              <td>
                                                  <textarea style="width:100%;height:120px" type="text" name="class"><?php echo $params['class']; ?></textarea>
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