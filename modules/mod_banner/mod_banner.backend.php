<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 



    include_once("mod_banner.models.php");

    include_once("mod_banner.handler.php");

    $myprocess = new process_mod_banner();



    $result = $myprocess->get_module_edit(intval($url[1]));

    

    if ($row_detail = $result->fetch())

    {

        if (empty($row_detail["params"]) || $row_detail["params"] == "undefine") {

            $params = array(

                'control_nav' => 1,

                'with_effect' => 1,

				'class' => ""

            );

        }

        else {

            $params = unserialize($row_detail["params"]);

        } ?>
<?php

	function category($parentid = 0, $alias = "", $level = 1)

	{

		global $myprocess;

		global $__menu;

		$result = $myprocess->get_category_view($parentid);

		while($row = $result->fetch())

		{

			echo '<option value="' , $row["alias"] , "/cn" , $row["cat_id"] , '">', str_repeat('&nbsp;&nbsp;|____', $level), $row['title'], '</option>';

			category($row["cat_id"], $row["alias"] . "/", $level + 1);

		}

	}

	function category_product($parentid = 0, $alias = "", $level = 1)

	{

		global $myprocess;

		global $__menu;

		

		$result = $myprocess->get_product_category_view($parentid);

		

		while($row = $result->fetch())

		{

			echo '<option value="', $alias, $row["alias"], "/cp" , $row["cat_id"],  '">', str_repeat('&nbsp;&nbsp;|____', $level), $row['title'], '</option>';

			category_product($row["cat_id"], $alias . $row["alias"] . "/", $level + 1);

		}

	}

	function category_product_2($parentid = 0, $alias = "", $level = 1)

	{

		global $myprocess;

		global $__menu;

		

		$result = $myprocess->get_product_category_view($parentid, $__menu['lang_code']);

		

		while($row = $result->fetch())

		{

			echo '<option value="', $alias, $row["alias"], "/moi" , $row["cat_id"],  '">', str_repeat('&nbsp;&nbsp;|____', $level), $row['title'], '</option>';

			category_product_2($row["cat_id"], $alias . $row["alias"] . "/", $level + 1);

		}

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

				        <div class="header icon-48-gallery">

					        Modules » <small>[Trình diễn ảnh] » Chỉnh sửa module</small>

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
						<script type="text/javascript" src="/quantri/javascript/modal.js"></script>

                    <script type="text/javascript">

							window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });

							window.addEvent('domready', function(){ new Accordion($$('.panel h3.jpane-toggler'), $$('.panel div.jpane-slider'), {onActive: function(toggler, i) { toggler.addClass('jpane-toggler-down'); toggler.removeClass('jpane-toggler'); },onBackground: function(toggler, i) { toggler.addClass('jpane-toggler'); toggler.removeClass('jpane-toggler-down'); },duration: 300,opacity: false,alwaysHide: true}); });		

							window.addEvent('domready', function() {

					

								SqueezeBox.initialize({});

					

								$$('a.modal').each(function(el) {

									el.addEvent('click', function(e) {

										new Event(e).stop();

										SqueezeBox.fromElement(el);

									});

								});

							});

					  </script>

                    	<script language="javascript" type="text/javascript">

			<!--			

			

			function jSelectArticle(id, alias, title, id_input) {

				document.getElementById(id_input+'_news_title').value = title;

				document.getElementById(id_input+'_link_url').value = alias;

				document.getElementById('sbox-window').close();

			}

                            

            function jSelectProduct(id, alias, title, id_input) {

                document.getElementById(id_input+'_product_title').value = title;

                document.getElementById(id_input+'_link_url').value = alias;

                document.getElementById('sbox-window').close();

            }

			

/*			function getCheckedValue() {

				var form = document.phpForm;

				for(var i = 0; i < form.khung1_rdotype.length; i++) {

					if(form.khung1_rdotype[i].checked) {

						return form.khung1_rdotype[i].value;

					}

				}

			}*/

				

			

			</script>

			

			<script type="text/javascript">

				function setlink(id, id_url){

					var input_value = document.getElementById(id).value;

					if(id==id_url+'_rdoContact'){

						document.getElementById(id_url+"_link_url").value = 'lien-he.html';

					}else if(id==id_url+'_rdoNull'){

						document.getElementById(id_url+"_link_url").value = 'javascript:void(0)';

					}else{

						document.getElementById(id_url).value = input_value;

					}

					

				}

				<?php for($num=1;$num<=4;$num++){ ?>

				function ChangeLink<?= $num?>(k) {

			

					var objExternal = document.getElementById('khung<?= $num?>_external_page');

			

					var objNewsCategories = document.getElementById('khung<?= $num?>_news_category_page');

					

					var objNewsArticle = document.getElementById('khung<?= $num?>_news_article_page');

					

					var objProductCategories = document.getElementById('khung<?= $num?>_product_category_page');

					var objProductCategories_2 = document.getElementById('khung<?= $num?>_product_category_page_2');

					

					var objProductsDetail = document.getElementById('khung<?= $num?>_product_detail_page');

			

					objExternal.style.display = 'none';

			

					objNewsCategories.style.display = 'none';

			

					objNewsArticle.style.display = 'none';

			

					objProductCategories.style.display = 'none';

					objProductCategories_2.style.display = 'none';

			

					objProductsDetail.style.display = "none";

			

					switch (k) {

			

						case 1: objExternal.style.display = ''; break;

						case 2: objNewsCategories.style.display = ''; break;

						case 3: objNewsArticle.style.display = ''; break;

						case 4: objProductCategories.style.display = ''; break;

						case 5: objProductsDetail.style.display = ''; break;

                        case 6: break;

                        case 7: break;

                        case 8: break;

						case 9: objProductCategories_2.style.display = ''; break;

						default: objNewsCategories.style.display = ''; break;

			

					}

			

				}

				<?php }?>

                </script>

				

				<script type="text/javascript" src="/myeditor/myfinder/ckfinder.js"></script>

				<script language="javascript" type="text/javascript">

					function BrowseServer( inputId )

					{

						var finder = new CKFinder() ;

						finder.StartupPath  = "Image:/image/";

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

				        <form method="post" action="" name="phpForm">

                            

					        <div class="col width-50">

						        <?php include('modules/modules.backend.left.php'); ?>

					        </div>

			        

					        <div class="col width-50">

                                <a style="display:none" class="backend_link" href="<?php echo $index_backend; ?>?com=mod_banner&view=folder&task=view" target="_blank">

                                    Cập nhật hình ảnh

                                    <img src="<?php echo $index; ?>images/go_link_out.gif" border="0" />

                                </a>

                                <br />

                                <fieldset class="adminform">

                                    <legend>Cấu hình</legend>

                                    <table class="admintable" width="100%">

                                        <tbody id="phone_container">

                                            <tr style="display:none">

                                                <td class="key">Hiển thị nút chọn hình</td>

                                                <td>

                                                    <input type="radio" name="controlNav" value="1" <?php if ($params['control_nav'] == 1) { echo 'checked="checked"'; } ?> />

                                                    Hiển thị

                                                    <input type="radio" name="controlNav" value="0" <?php if ($params['control_nav'] == 0) { echo 'checked="checked"'; } ?> />

                                                    Không hiển thị

                                                </td>

                                            </tr>

                                            <tr style="display:none">

                                                <td class="key">Sử dụng hiệu ứng</td>

                                                <td>

                                                    <select name="withEffect">

                                                        <option value="0" <?php if ($params['with_effect'] == 0) { echo 'selected="selected"'; } ?>>Không sử dụng hiệu ứng</option>

                                                        <option value="1" <?php if ($params['with_effect'] == 1) { echo 'selected="selected"'; } ?>>Trình diễn ảnh</option>

                                                          

                                                        <option value="2" <?php if ($params['with_effect'] == 2) { echo 'selected="selected"'; } ?>>Cuộn ảnh (ngang)</option>

                                                        <option value="3" <?php if ($params['with_effect'] == 3) { echo 'selected="selected"'; } ?>>Cuộn ảnh (dọc)</option>

                                                        <option value="4" <?php if ($params['with_effect'] == 4) { echo 'selected="selected"'; } ?>>Trình diễn ảnh (thumnail)</option>

                                                    </select>

                                                </td>

                                            </tr>

                                            <tr style="display:none">

                                                <td class="key">

                                                    Class

                                                </td>

                                                <td>

                                                    <input size="70" type="text" name="class" value="<?php echo $params['class']; ?>" />

                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="key">Hình banner 1</td>
                                                <td>
													<input size="70" type="text" name="banner1" id="banner1" value="<?php echo $params['banner1']; ?>" />
													<a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('banner1');">Lựa chọn</a>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td class="key" align="right">

                                                    Liên kết banner 1:

                                                </td>

                                                <td>

                                                    <input class="inputbox" type="text" name="urlbanner1" id="urlbanner1" maxlength="500" value="<?= $params["urlbanner1"] ?>" style="width:306px;" />

                                                </td>

                                            </tr>
                                            <tr style="display:none">
                                                <td class="key">Hình banner 2</td>
                                                <td>
													<input size="70" type="text" name="banner2" id="banner2" value="<?php echo $params['banner2']; ?>" />
                                                    <a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('banner2');">Lựa chọn</a>
												</td>
                                            </tr>
                                            <tr style="display:none">

                                                <td class="key" align="right">

                                                    Liên kết banner 2:

                                                </td>

                                                <td>

                                                    <input class="inputbox" type="text" name="urlbanner2" id="urlbanner2" maxlength="500" value="<?= $params["urlbanner2"] ?>" style="width:306px;" />

                                                </td>

                                            </tr>
                                            <tr style="display:none">
                                                <td class="key">banner 3</td>
                                                <td>
													<input size="70" type="text" name="banner3" id="banner3" value="<?php echo $params['banner3']; ?>" />
                                                    <a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('banner3');">Lựa chọn</a>
												</td>
                                            </tr>
											<tr style="display:none">

                                                <td class="key" align="right">

                                                    Liên kết banner 3:

                                                </td>

                                                <td>

                                                    <input class="inputbox" type="text" name="urlbanner3" id="urlbanner3" maxlength="500" value="<?= $params["urlbanner3"] ?>" style="width:306px;" />

                                                </td>

                                            </tr>
                                        </tbody>

                                    </table>

                                </fieldset>

                                

					        </div>

					        

                            <div class="clr"></div>			

					        

                            <input type="hidden" name="hidden" value="submit_mod_banner" />

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