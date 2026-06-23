<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 

    include_once("mod_product_xuhuong.models.php");
    include_once("mod_product_xuhuong.handler.php");
    $myprocess = new process_product_xuhuong();

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
				        <form method="post" name="phpForm">
					        <div class="col width-50">
						        <?php include('modules/modules.backend.left.php'); ?>
					        </div>
			        
					        <div class="col width-50">
                            	<fieldset class="adminform">
                                    <legend>Chọn kiểu hiển thị</legend>
                                    <table class="admintable" width="100%">
                                        <tbody id="phone_container">
                                        	<tr>
                                                <td class="key" align="right">
                                                    Kiểu:
                                                </td>
                                                <td>
                                                    <select type="text" name="sl_style" style="width:306px;">
                                                    	<option <?= ($params["style"]==1) ? 'selected="selected"':'' ?> value="1">Kiểu 1 - 4 hình nằm ngang</option>
                                                        <option <?= ($params["style"]==2) ? 'selected="selected"':'' ?> value="2">Kiểu 2 - 2 hình lớn 2 hình nhỏ</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                             	</fieldset>
                            	<fieldset class="adminform">
                                    <legend>Khung 1</legend>
                                    <table class="admintable" width="100%">
                                        <tbody id="phone_container">
                                        	<tr>
                                                <td class="key" align="right">
                                                    Tiêu đề:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" name="khung1_title" maxlength="255" value="<?= $params["khung1_title"] ?>" style="width:306px;"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key" align="right">
                                                    Biểu tượng:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" id="khung1_image" name="khung1_image" maxlength="500" value="<?= $params["khung1_image"] ?>" style="width:306px;" />
                                                    <a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('khung1_image');">Lựa chọn</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key" align="right">
                                                    Liên kết hiện có:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" name="khung1_link_url" id="khung1_link_url" readonly="readonly" maxlength="500" value="<?= $params["khung1_linkurl"] ?>" style="width:306px;" />
                                                </td>
                                            </tr>
                                        	<tr>
                                                <td class="key" align="right">
                                                    Liên kết:
                                                </td>
                                                <td>
                                                    <div>
                                                        <input checked="checked" id="khung1_rdoNewsCategories" type="radio" name="khung1_rdotype" value="rdoNewsCategories" onclick="javascript:return ChangeLink1(2);">
                                                        <label for="khung1_rdoNewsCategories">Danh mục tin tức</label>
                                                        <input id="khung1_rdoNewsArticle" type="radio" name="khung1_rdotype" value="rdoNewsArticle" onclick="javascript:return ChangeLink1(3);">
                                                        <label for="khung1_rdoNewsArticle">Liên kết bản tin</label>
                                                        <input id="khung1_rdoProductCategories" type="radio" name="khung1_rdotype" value="rdoProductCategories" onclick="javascript:return ChangeLink1(4);">
                                                        <label for="khung1_rdoProductCategories">Danh mục sản phẩm</label>
                                                        <div class="clear"></div>
                                                        <input id="khung1_rdoProductArticle" type="radio" name="khung1_rdotype" value="rdoProductDetail" onclick="javascript:return ChangeLink1(5);">
                                                        <label for="khung1_rdoProductArticle">Liên kết sản phẩm</label>
                                                        <input id="khung1_rdoExternal" type="radio" name="khung1_rdotype" value="rdoExternal" onclick="javascript:return ChangeLink1(1);">
                                                        <label for="khung1_rdoExternal">Trang ngoài</label>
                                                        <input onclick="setlink(this.id,'khung1')" id="khung1_rdoNull" type="radio" name="khung1_rdotype" value="rdoNull" onclick="javascript:return ChangeLink1(6);">
                                                        <label for="khung1_rdoNull">Không liên kết</label>
                                                        <div class="clear"></div>                                               
                                                        <input id="khung1_rdoContact" onclick="setlink(this.id,'khung1')" type="radio" name="khung1_rdotype" value="rdoContact" onclick="javascript:return ChangeLink1(8);">
                                                        <label for="khung1_rdoContact">Liên hệ</label>
                                                       
                                                        <input id="khung1_rdoProductCategories2" type="radio" name="khung1_rdotype" value="rdoProductCategories2" onclick="javascript:return ChangeLink1(9);"> <label for="khung1_rdoProductCategories2">Danh mục sản phẩm mới</label>
                                                    </div>
                                                                                                
                                                    <div id="khung1_news_category_page" style="min-height:150px;">
                                                        <select onchange="setlink(this.id,'khung1_link_url')" name="khung1_select_news_category_page" id="khung1_select_news_category_page" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                            <?php category(0); ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div id="khung1_news_article_page" style="min-height:150px;display:none;">
                                                        <div style="padding-top:20px;">
                                                            <div style="float: left;">
                                                                <input id="khung1_news_title" name="khung1_news_title" type="text" value="Chọn bản tin cần liên kết" readonly="true" size="50" />
                                                            </div>
                                                            <div class="button2-left">
                                                                <div class="blank">
                                                                    <a class="modal" title="Chọn một bài viết"  href="/quantri/?com=com_menu&view=item_menu&task=news.choose2&lang_code=vi&khung=khung1" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="khung1_select_news_article_page" name="khung1_select_news_article_page" value="0" />
                                                            <input onChange="setlink(this.id,'khung1_link_url')" type="hidden" id="khung1_news_alias" name="khung1_news_alias" value="" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="khung1_product_category_page" style="min-height:150px;display:none">
                                                        <select onchange="setlink(this.id,'khung1_link_url')" name="khung1_select_product_category_page" id="khung1_select_product_category_page" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                            <?php category_product(0); ?>
                                                        </select>
                                                    </div>
                                                    <div id="khung1_product_category_page_2" style="min-height:150px;display:none">
                                                        <select onchange="setlink(this.id,'khung1_link_url')" name="khung1_select_product_category_page_2" id="khung1_select_product_category_page_2" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                                <?php category_product_2(0); ?>
                                                        </select>
                                                    </div>
                                                    <div id="khung1_product_detail_page" style="min-height:150px;display:none">
                                                        <div style="padding-top:20px;">
                                                            <div style="float: left;">
                                                                <input id="khung1_product_title" name="khung1_product_title" type="text" value="Chọn sản phẩm cần liên kết" readonly="true" size="50" />
                                                            </div>
                                                            <div class="button2-left">
                                                                <div class="blank">
                                                                    <a class="modal" title="Chọn một sản phẩm"  href="/quantri/?com=com_menu&view=item_menu&task=product.choose2&lang_code=vi&khung=khung1" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="khung1_select_product_page" name="khung1_select_product_page" value="0" />
                                                            <input type="hidden" id="khung1_product_alias" name="khung1_product_alias" value="" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="khung1_external_page" style="min-height:150px;display:none">
                                                        <div style="padding-top:20px;">
                                                            <span style="font-weight:bold;">Nhập đường dẫn</span><br />
                                                            <input onkeyup="setlink(this.id,'khung1_link_url')" type="text" id="khung1_txt_url" name="khung1_txt_url" style="width:306px;" />
                                                        </div>
                                                    </div>
                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                             	</fieldset>
                                <fieldset class="adminform">
                                    <legend>Khung 2</legend>
                                    <table class="admintable" width="100%">
                                        <tbody id="phone_container">
                                        	<tr>
                                                <td class="key" align="right">
                                                    Tiêu đề:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" name="khung2_title" maxlength="255" value="<?= $params["khung2_title"] ?>" style="width:306px;"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key" align="right">
                                                    Biểu tượng:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" id="khung2_image" name="khung2_image" maxlength="500" value="<?= $params["khung2_image"] ?>" style="width:306px;" />
                                                    <a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('khung2_image');">Lựa chọn</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key" align="right">
                                                    Liên kết hiện có:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" name="khung2_link_url" id="khung2_link_url" readonly="readonly" maxlength="500" value="<?= $params["khung2_linkurl"] ?>" style="width:306px;" />
                                                </td>
                                            </tr>
                                        	<tr>
                                                <td class="key" align="right">
                                                    Liên kết:
                                                </td>
                                                <td>
                                                    <div>
                                                        <input checked="checked" id="khung2_rdoNewsCategories" type="radio" name="khung2_rdotype" value="rdoNewsCategories" onclick="javascript:return ChangeLink2(2);">
                                                        <label for="khung2_rdoNewsCategories">Danh mục tin tức</label>
                                                        <input id="khung2_rdoNewsArticle" type="radio" name="khung2_rdotype" value="rdoNewsArticle" onclick="javascript:return ChangeLink2(3);">
                                                        <label for="khung2_rdoNewsArticle">Liên kết bản tin</label>
                                                        <input id="khung2_rdoProductCategories" type="radio" name="khung2_rdotype" value="rdoProductCategories" onclick="javascript:return ChangeLink2(4);">
                                                        <label for="khung2_rdoProductCategories">Danh mục sản phẩm</label>
                                                        <div class="clear"></div>
                                                        <input id="khung2_rdoProductArticle" type="radio" name="khung2_rdotype" value="rdoProductDetail" onclick="javascript:return ChangeLink2(5);">
                                                        <label for="khung2_rdoProductArticle">Liên kết sản phẩm</label>
                                                        <input id="khung2_rdoExternal" type="radio" name="khung2_rdotype" value="rdoExternal" onclick="javascript:return ChangeLink2(1);">
                                                        <label for="khung2_rdoExternal">Trang ngoài</label>
                                                        <input onclick="setlink(this.id,'khung2')" id="khung2_rdoNull" type="radio" name="khung2_rdotype" value="rdoNull" onclick="javascript:return ChangeLink2(6);">
                                                        <label for="khung2_rdoNull">Không liên kết</label>
                                                        <div class="clear"></div>                                               
                                                        <input id="khung2_rdoContact" onclick="setlink(this.id,'khung2')" type="radio" name="khung2_rdotype" value="rdoContact" onclick="javascript:return ChangeLink2(8);">
                                                        <label for="khung2_rdoContact">Liên hệ</label>
                                                       
                                                        <input id="khung2_rdoProductCategories2" type="radio" name="khung2_rdotype" value="rdoProductCategories2" onclick="javascript:return ChangeLink2(9);"> <label for="khung2_rdoProductCategories2">Danh mục sản phẩm mới</label>
                                                    </div>
                                                                                                
                                                    <div id="khung2_news_category_page" style="min-height:150px;">
                                                        <select onchange="setlink(this.id,'khung2_link_url')" name="khung2_select_news_category_page" id="khung2_select_news_category_page" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                            <?php category(0); ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div id="khung2_news_article_page" style="min-height:150px;display:none;">
                                                        <div style="padding-top:20px;">
                                                            <div style="float: left;">
                                                                <input id="khung2_news_title" name="khung2_news_title" type="text" value="Chọn bản tin cần liên kết" readonly="true" size="50" />
                                                            </div>
                                                            <div class="button2-left">
                                                                <div class="blank">
                                                                    <a class="modal" title="Chọn một bài viết"  href="/quantri/?com=com_menu&view=item_menu&task=news.choose2&lang_code=vi&khung=khung2" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="khung2_select_news_article_page" name="khung2_select_news_article_page" value="0" />
                                                            <input onChange="setlink(this.id,'khung2_link_url')" type="hidden" id="khung2_news_alias" name="khung2_news_alias" value="" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="khung2_product_category_page" style="min-height:150px;display:none">
                                                        <select onchange="setlink(this.id,'khung2_link_url')" name="khung2_select_product_category_page" id="khung2_select_product_category_page" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                            <?php category_product(0); ?>
                                                        </select>
                                                    </div>
                                                    <div id="khung2_product_category_page_2" style="min-height:150px;display:none">
                                                        <select onchange="setlink(this.id,'khung2_link_url')" name="khung2_select_product_category_page_2" id="khung2_select_product_category_page_2" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                                <?php category_product_2(0); ?>
                                                        </select>
                                                    </div>
                                                    <div id="khung2_product_detail_page" style="min-height:150px;display:none">
                                                        <div style="padding-top:20px;">
                                                            <div style="float: left;">
                                                                <input id="khung2_product_title" name="khung2_product_title" type="text" value="Chọn sản phẩm cần liên kết" readonly="true" size="50" />
                                                            </div>
                                                            <div class="button2-left">
                                                                <div class="blank">
                                                                    <a class="modal" title="Chọn một sản phẩm"  href="/quantri/?com=com_menu&view=item_menu&task=product.choose2&lang_code=vi&khung=khung2" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="khung2_select_product_page" name="khung2_select_product_page" value="0" />
                                                            <input type="hidden" id="khung2_product_alias" name="khung2_product_alias" value="" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="khung2_external_page" style="min-height:150px;display:none">
                                                        <div style="padding-top:20px;">
                                                            <span style="font-weight:bold;">Nhập đường dẫn</span><br />
                                                            <input onkeyup="setlink(this.id,'khung2_link_url')" type="text" id="khung2_txt_url" name="khung2_txt_url" style="width:306px;" />
                                                        </div>
                                                    </div>
                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                             	</fieldset>
                                <fieldset class="adminform">
                                    <legend>Khung 3</legend>
                                    <table class="admintable" width="100%">
                                        <tbody id="phone_container">
                                        	<tr>
                                                <td class="key" align="right">
                                                    Tiêu đề:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" name="khung3_title" maxlength="255" value="<?= $params["khung3_title"] ?>" style="width:306px;"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key" align="right">
                                                    Biểu tượng:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" id="khung3_image" name="khung3_image" maxlength="500" value="<?= $params["khung3_image"] ?>" style="width:306px;" />
                                                    <a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('khung3_image');">Lựa chọn</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key" align="right">
                                                    Liên kết hiện có:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" name="khung3_link_url" id="khung3_link_url" readonly="readonly" maxlength="500" value="<?= $params["khung3_linkurl"] ?>" style="width:306px;" />
                                                </td>
                                            </tr>
                                        	<tr>
                                                <td class="key" align="right">
                                                    Liên kết:
                                                </td>
                                                <td>
                                                    <div>
                                                        <input checked="checked" id="khung3_rdoNewsCategories" type="radio" name="khung3_rdotype" value="rdoNewsCategories" onclick="javascript:return ChangeLink3(2);">
                                                        <label for="khung3_rdoNewsCategories">Danh mục tin tức</label>
                                                        <input id="khung3_rdoNewsArticle" type="radio" name="khung3_rdotype" value="rdoNewsArticle" onclick="javascript:return ChangeLink3(3);">
                                                        <label for="khung3_rdoNewsArticle">Liên kết bản tin</label>
                                                        <input id="khung3_rdoProductCategories" type="radio" name="khung3_rdotype" value="rdoProductCategories" onclick="javascript:return ChangeLink3(4);">
                                                        <label for="khung3_rdoProductCategories">Danh mục sản phẩm</label>
                                                        <div class="clear"></div>
                                                        <input id="khung3_rdoProductArticle" type="radio" name="khung3_rdotype" value="rdoProductDetail" onclick="javascript:return ChangeLink3(5);">
                                                        <label for="khung3_rdoProductArticle">Liên kết sản phẩm</label>
                                                        <input id="khung3_rdoExternal" type="radio" name="khung3_rdotype" value="rdoExternal" onclick="javascript:return ChangeLink3(1);">
                                                        <label for="khung3_rdoExternal">Trang ngoài</label>
                                                        <input onclick="setlink(this.id,'khung3')" id="khung3_rdoNull" type="radio" name="khung3_rdotype" value="rdoNull" onclick="javascript:return ChangeLink3(6);">
                                                        <label for="khung3_rdoNull">Không liên kết</label>
                                                        <div class="clear"></div>                                               
                                                        <input id="khung3_rdoContact" onclick="setlink(this.id,'khung3')" type="radio" name="khung3_rdotype" value="rdoContact" onclick="javascript:return ChangeLink3(8);">
                                                        <label for="khung3_rdoContact">Liên hệ</label>
                                                       
                                                        <input id="khung3_rdoProductCategories2" type="radio" name="khung3_rdotype" value="rdoProductCategories2" onclick="javascript:return ChangeLink3(9);"> <label for="khung3_rdoProductCategories2">Danh mục sản phẩm mới</label>
                                                    </div>
                                                                                                
                                                    <div id="khung3_news_category_page" style="min-height:150px;">
                                                        <select onchange="setlink(this.id,'khung3_link_url')" name="khung3_select_news_category_page" id="khung3_select_news_category_page" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                            <?php category(0); ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div id="khung3_news_article_page" style="min-height:150px;display:none;">
                                                        <div style="padding-top:20px;">
                                                            <div style="float: left;">
                                                                <input id="khung3_news_title" name="khung3_news_title" type="text" value="Chọn bản tin cần liên kết" readonly="true" size="50" />
                                                            </div>
                                                            <div class="button2-left">
                                                                <div class="blank">
                                                                    <a class="modal" title="Chọn một bài viết"  href="/quantri/?com=com_menu&view=item_menu&task=news.choose2&lang_code=vi&khung=khung3" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="khung3_select_news_article_page" name="khung3_select_news_article_page" value="0" />
                                                            <input onChange="setlink(this.id,'khung3_link_url')" type="hidden" id="khung3_news_alias" name="khung3_news_alias" value="" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="khung3_product_category_page" style="min-height:150px;display:none">
                                                        <select onchange="setlink(this.id,'khung3_link_url')" name="khung3_select_product_category_page" id="khung3_select_product_category_page" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                            <?php category_product(0); ?>
                                                        </select>
                                                    </div>
                                                    <div id="khung3_product_category_page_2" style="min-height:150px;display:none">
                                                        <select onchange="setlink(this.id,'khung3_link_url')" name="khung3_select_product_category_page_2" id="khung3_select_product_category_page_2" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                                <?php category_product_2(0); ?>
                                                        </select>
                                                    </div>
                                                    <div id="khung3_product_detail_page" style="min-height:150px;display:none">
                                                        <div style="padding-top:20px;">
                                                            <div style="float: left;">
                                                                <input id="khung3_product_title" name="khung3_product_title" type="text" value="Chọn sản phẩm cần liên kết" readonly="true" size="50" />
                                                            </div>
                                                            <div class="button2-left">
                                                                <div class="blank">
                                                                    <a class="modal" title="Chọn một sản phẩm"  href="/quantri/?com=com_menu&view=item_menu&task=product.choose2&lang_code=vi&khung=khung3" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="khung3_select_product_page" name="khung3_select_product_page" value="0" />
                                                            <input type="hidden" id="khung3_product_alias" name="khung3_product_alias" value="" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="khung3_external_page" style="min-height:150px;display:none">
                                                        <div style="padding-top:20px;">
                                                            <span style="font-weight:bold;">Nhập đường dẫn</span><br />
                                                            <input onkeyup="setlink(this.id,'khung3_link_url')" type="text" id="khung3_txt_url" name="khung3_txt_url" style="width:306px;" />
                                                        </div>
                                                    </div>
                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                             	</fieldset>
                                <fieldset class="adminform">
                                    <legend>Khung 4</legend>
                                    <table class="admintable" width="100%">
                                        <tbody id="phone_container">
                                        	<tr>
                                                <td class="key" align="right">
                                                    Tiêu đề:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" name="khung4_title" maxlength="255" value="<?= $params["khung4_title"] ?>" style="width:306px;"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key" align="right">
                                                    Biểu tượng:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" id="khung4_image" name="khung4_image" maxlength="500" value="<?= $params["khung4_image"] ?>" style="width:306px;" />
                                                    <a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('khung4_image');">Lựa chọn</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="key" align="right">
                                                    Liên kết hiện có:
                                                </td>
                                                <td>
                                                    <input class="inputbox" type="text" name="khung4_link_url" id="khung4_link_url" readonly="readonly" maxlength="500" value="<?= $params["khung4_linkurl"] ?>" style="width:306px;" />
                                                </td>
                                            </tr>
                                        	<tr>
                                                <td class="key" align="right">
                                                    Liên kết:
                                                </td>
                                                <td>
                                                    <div>
                                                        <input checked="checked" id="khung4_rdoNewsCategories" type="radio" name="khung4_rdotype" value="rdoNewsCategories" onclick="javascript:return ChangeLink4(2);">
                                                        <label for="khung4_rdoNewsCategories">Danh mục tin tức</label>
                                                        <input id="khung4_rdoNewsArticle" type="radio" name="khung4_rdotype" value="rdoNewsArticle" onclick="javascript:return ChangeLink4(3);">
                                                        <label for="khung4_rdoNewsArticle">Liên kết bản tin</label>
                                                        <input id="khung4_rdoProductCategories" type="radio" name="khung4_rdotype" value="rdoProductCategories" onclick="javascript:return ChangeLink4(4);">
                                                        <label for="khung4_rdoProductCategories">Danh mục sản phẩm</label>
                                                        <div class="clear"></div>
                                                        <input id="khung4_rdoProductArticle" type="radio" name="khung4_rdotype" value="rdoProductDetail" onclick="javascript:return ChangeLink4(5);">
                                                        <label for="khung4_rdoProductArticle">Liên kết sản phẩm</label>
                                                        <input id="khung4_rdoExternal" type="radio" name="khung4_rdotype" value="rdoExternal" onclick="javascript:return ChangeLink4(1);">
                                                        <label for="khung4_rdoExternal">Trang ngoài</label>
                                                        <input onclick="setlink(this.id,'khung4')" id="khung4_rdoNull" type="radio" name="khung4_rdotype" value="rdoNull" onclick="javascript:return ChangeLink4(6);">
                                                        <label for="khung4_rdoNull">Không liên kết</label>
                                                        <div class="clear"></div>                                               
                                                        <input id="khung4_rdoContact" onclick="setlink(this.id,'khung4')" type="radio" name="khung4_rdotype" value="rdoContact" onclick="javascript:return ChangeLink4(8);">
                                                        <label for="khung4_rdoContact">Liên hệ</label>
                                                       
                                                        <input id="khung4_rdoProductCategories2" type="radio" name="khung4_rdotype" value="rdoProductCategories2" onclick="javascript:return ChangeLink4(9);"> <label for="khung4_rdoProductCategories2">Danh mục sản phẩm mới</label>
                                                    </div>
                                                                                                
                                                    <div id="khung4_news_category_page" style="min-height:150px;">
                                                        <select onchange="setlink(this.id,'khung4_link_url')" name="khung4_select_news_category_page" id="khung4_select_news_category_page" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                            <?php category(0); ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div id="khung4_news_article_page" style="min-height:150px;display:none;">
                                                        <div style="padding-top:20px;">
                                                            <div style="float: left;">
                                                                <input id="khung4_news_title" name="khung4_news_title" type="text" value="Chọn bản tin cần liên kết" readonly="true" size="50" />
                                                            </div>
                                                            <div class="button2-left">
                                                                <div class="blank">
                                                                    <a class="modal" title="Chọn một bài viết"  href="/quantri/?com=com_menu&view=item_menu&task=news.choose2&lang_code=vi&khung=khung4" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="khung4_select_news_article_page" name="khung4_select_news_article_page" value="0" />
                                                            <input onChange="setlink(this.id,'khung4_link_url')" type="hidden" id="khung4_news_alias" name="khung4_news_alias" value="" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="khung4_product_category_page" style="min-height:150px;display:none">
                                                        <select onchange="setlink(this.id,'khung4_link_url')" name="khung4_select_product_category_page" id="khung4_select_product_category_page" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                            <?php category_product(0); ?>
                                                        </select>
                                                    </div>
                                                    <div id="khung4_product_category_page_2" style="min-height:150px;display:none">
                                                        <select onchange="setlink(this.id,'khung4_link_url')" name="khung4_select_product_category_page_2" id="khung4_select_product_category_page_2" class="inputbox" size="10" style="width:306px;">
                                                            <option value="0"  selected="selected">Chọn danh mục</option>
                                                                <?php category_product_2(0); ?>
                                                        </select>
                                                    </div>
                                                    <div id="khung4_product_detail_page" style="min-height:150px;display:none">
                                                        <div style="padding-top:20px;">
                                                            <div style="float: left;">
                                                                <input id="khung4_product_title" name="khung4_product_title" type="text" value="Chọn sản phẩm cần liên kết" readonly="true" size="50" />
                                                            </div>
                                                            <div class="button2-left">
                                                                <div class="blank">
                                                                    <a class="modal" title="Chọn một sản phẩm"  href="/quantri/?com=com_menu&view=item_menu&task=product.choose2&lang_code=vi&khung=khung4" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="khung4_select_product_page" name="khung4_select_product_page" value="0" />
                                                            <input type="hidden" id="khung4_product_alias" name="khung4_product_alias" value="" />
                                                        </div>
                                                    </div>
                                                    
                                                    <div id="khung4_external_page" style="min-height:150px;display:none">
                                                        <div style="padding-top:20px;">
                                                            <span style="font-weight:bold;">Nhập đường dẫn</span><br />
                                                            <input onkeyup="setlink(this.id,'khung4_link_url')" type="text" id="khung4_txt_url" name="khung4_txt_url" style="width:306px;" />
                                                        </div>
                                                    </div>
                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                             	</fieldset>
                                
                                
                                
                                
					        </div>
					        <div class="clr"></div>			
					        <input type="hidden" name="hidden" value="submit_mod_product_xuhuong" />
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