<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 

    include_once("mod_product_new.models.php");
    include_once("mod_product_new.handler.php");
    $myprocess = new process_mod_product_new();



    $result = $myprocess->get_module_edit(intval($url[1]));

    

    if ($row_detail = $result->fetch())

    {

        if (empty($row_detail["params"]) || $row_detail["params"] == "undefine") {

            $params = array(

                'limit' => 0,

                'cat_id' => 0

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

					        Modules » <small>[Hiển thị sản phẩm] » Chỉnh sửa module</small>

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

                                                    Danh mục cha

                                                </td>

                                                <td width="100">

                                                    <select name="cat_id" style="width:230px;">

                                                    	<option <?php if($params['cat_id'] == "-1"){ echo "selected"; }?> value="-1">-- Hiển thị sản phẩm nổi bật --</option>

                                                        <option <?php if($params['cat_id'] == 0){ echo "selected"; }?> value="0">-- Hiển thị tất cả sản phẩm --</option>

                                                        <?php

                                                        	$myprocess = new process_mod_product_new();

                                                        	$category_id = $params['cat_id'];

                                                        	

                                                            function category($parentid = 0, $level = 0)

                                                            {

                                                            	global $row_detail;

                                                            	global $myprocess;

                                                            	global $category_id;

                                                                

                                                                $result = $myprocess->category_multi_level($parentid, $row_detail['lang_code']);

                                                                

                                                                while ($row = $result->fetch())

                                                                {

                                                                    echo '<option ';

                                                                    

                                                                    if ($row['cat_id'] == $category_id)

                                                                    {

                                                                        echo 'selected="selected" ';

                                                                    }

                                                                    

                                                                    echo ' value="', $row['cat_id'], '">', str_repeat('&nbsp;&nbsp;|____', $level), '&nbsp;', $row['title'], '</option>';

                                                                    category($row["cat_id"], $level + 1);

                                                                }

                                                            }

                                                            

                                                            category();

                                                        ?>

                                                    </select>                                                    

                                                </td>

                                                <td>

                                                	 <span class="editlinktip hasTip" title="Danh mục sản phẩm cần hiển thị::Chọn danh mục sản phẩm cần hiển thị">

                                                        <a href="javascript:void(0);">

                                                            Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" />

                                                        </a>

                                                     </span>

                                                </td>


                                            </tr>

                                            <tr>

                                                <td class="key">

                                                    Số sản phẩm hiển thị

                                                </td>

                                                <td>

                                                    <input type="text" name="limit" value="<?php echo $params['limit']; ?>" />                                                   

                                                </td>

                                                <td>

                                                    <span class="editlinktip hasTip" title="Giới hạn::Nhập 0 nếu bạn muốn hiển thị hết tất cả sản phẩm">

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

                                                <td></td>

                                            </tr>

                                            <tr>

                                                <td class="key">Hiển tiêu đề sản phẩm</td>

                                                <td>

                                                    <input type="radio" name="show_title" value="1" <?php if ($params['show_title'] == 1) { echo 'checked="checked"'; } ?> />

                                                    Hiển thị

                                                    <input type="radio" name="show_title" value="0" <?php if ($params['show_title'] == 0) { echo 'checked="checked"'; } ?> />

                                                    Không hiển thị                                                    

                                                </td>

                                                <td>

                                                	<span class="editlinktip hasTip" title="Danh mục sản phẩm cần hiển thị::Chọn danh mục sản phẩm cần hiển thị">

                                                        <a href="javascript:void(0);">

                                                            Trợ giúp <img src="<?php echo $index_backend; ?>template/images/help16x16.gif" />

                                                        </a>

                                                    </span>

                                                </td>

                                            </tr>

                                            <tr>

                                                <td class="key">Sử dụng hiệu ứng</td>

                                                <td>

                                                    <select name="withEffect">

                                                        <option value="0" <?php if ($params['with_effect'] == 0) { echo 'selected="selected"'; } ?>>Không sử dụng hiệu ứng</option>

                                                        <option value="1" <?php if ($params['with_effect'] == 1) { echo 'selected="selected"'; } ?>>Trình diễn ảnh</option>

                                                        <option value="2" <?php if ($params['with_effect'] == 2) { echo 'selected="selected"'; } ?>>Cuộn ảnh (ngang)</option>

                                                        <option value="3" <?php if ($params['with_effect'] == 3) { echo 'selected="selected"'; } ?>>Cuộn ảnh (dọc)</option>


                                                        <option value="4" <?php if ($params['with_effect'] ==4) { echo 'selected="selected"'; } ?>>Fade in & fade out</option>
                                                    </select>

                                                </td>

                                                <td>

                                                    <span class="editlinktip hasTip" title="Tùy chọn cách hiển thị cho module này::Chọn hình thức hiển thị cho module này">

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

					        <input type="hidden" name="hidden" value="submit_mod_product_new" />

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