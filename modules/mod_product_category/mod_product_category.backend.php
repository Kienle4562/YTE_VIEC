<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 

    include_once("mod_product_category.models.php");
    include_once("mod_product_category.handler.php");
    $myprocess = new process_product_category();

    $result = $myprocess->get_module_edit(intval($url[1]));
    
    if ($row_detail = $result->fetch())
    {
        if (empty($row_detail["params"]) || $row_detail["params"] == "undefine") {
            $params = array(
                'cat_id' => -1,
                'max_level' => 0
            );
        }
        else {
            $params = unserialize($row_detail["params"]);
        } ?>
        
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
					        Modules » <small>[Danh mục sản phẩm] » Chỉnh sửa module</small>
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
						        } else {							
							        submitform(pressbutton);
						        }
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

                                                    ID danh mục sản phẩm

                                                </td>

                                                <td>

                                                    <input type="text" name="product_category" value="<?php echo $params['product_category']; ?>" />                                                   

                                                </td>


                                            </tr>
                                            <tr>
                                                <td class="key">
                                                    Danh mục cha
                                                </td>
                                                <td>
                                                    <select name="cat_id" style="width: 240px;">
                                                        <option value="0">--Hiển thị tất cả--</option>
                                                        <?php
                                                        	
                                                        	if (!function_exists('mod_category'))
                                                        	{
	                                                            function mod_category($lang_code, $parentid = 0, $category_id, $space = '&nbsp;&nbsp;|____')
	                                                            {
	                                                                $myprocess = new process_product_category();
	                                                                
	                                                                $result = $myprocess->category_multi_level($parentid, $lang_code);
	                                                                
	                                                                while($row = $result->fetch()) {
	                                                                    echo '<option ';
	                                                                    
	                                                                    if ($row['cat_id'] == $category_id)
	                                                                    {
	                                                                        echo 'selected="selected" ';
	                                                                    }
	                                                                    
	                                                                    echo ' value="', $row['cat_id'], '">', $space, $row['title'], '</option>';
	                                                                    
	                                                                    mod_category($lang_code, $row["cat_id"], $category_id, $space . '&nbsp;&nbsp;|____');
	                                                                }
	                                                            }
															}
                                                            
                                                            mod_category($row_detail['lang_code'], 0, $params['cat_id']);
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key">
                                                    Cấp độ tối đa
                                                </td>
                                                <td>
                                                    <input type="text" name="max_level" value="<?php echo $params['max_level']; ?>" />
                                                    <span class="editlinktip hasTip" title="Cấp độ tối đa::+ Nhập vào 0 nếu bạn muốn hiển thị tất cả các danh mục con.<br />+ Nếu nhập vào số lớn hơn 0 thì những danh mục có cấp độ nhỏ hơn hoặc bằng giá trị này sẽ hiển thị.">
                                                        <a href="javascript:void(0);">
                                                            Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" />
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
					        </div>
					        <div class="clr"></div>			
					        <input type="hidden" name="hidden" value="submit_mod_product_category" />
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