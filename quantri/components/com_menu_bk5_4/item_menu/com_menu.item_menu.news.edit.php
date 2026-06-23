<?php
	$myprocess = new process();
	$result = $myprocess->get_menu_edit(intval($_GET["id"]));
	if ($row_edit = $result->fetch())
    {
        $_GET['parent_Id'] = $row_edit['parent_Id'];
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
									        <span class="icon-32-save" title="Save"></span>Lưu và thoát
								        </a>
							        </td>
							        
							        <td class="button" id="toolbar-apply">
								        <a href="#" onclick="javascript: submitbutton('apply')" class="toolbar">
									        <span class="icon-32-apply" title="Apply"></span>Lưu
								        </a>
							        </td>
							        
							        <td class="button" id="toolbar-cancel">
								        <a href="#" onclick="javascript: submitbutton('cancel')" class="toolbar">
									        <span class="icon-32-back" title="Cancel"></span>Quay lại
								        </a>
							        </td>
							        
							        <td class="button" id="toolbar-help">
								        <a href="#" onclick="popupWindow('', 'Help', 640, 480, 1)" class="toolbar">
									        <span class="icon-32-help" title="Help"></span>Trợ gíup
								        </a>
							        </td>
						        </tr>
					        </table>
				        </div>
				        
				        <div class="header icon-48-menu">
				        	<?php
								$__menu = $myprocess->get_main_menu_edit($row_edit['menu_type_Id'])->fetch(PDO::FETCH_ASSOC);
							?>
							Menus » 
								<small><?php $core_class->create_lang_flag($__menu['lang_code'], 20); ?> <?php echo $__menu['title']; ?> »
									<small><?php echo $row_edit['title']; ?> » 
										<small>Chỉnh sửa</small>
									</small>
								</small>
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
			            // <!--
			                function jSelectArticle(id, alias, title) {
				                document.getElementById('select_news_article_page').value = id;
				                document.getElementById('news_title').value = title;
				                document.getElementById('news_alias').value = alias;
				                document.getElementById('sbox-window').close();
			                }
                            
                            function jSelectProduct(id, alias, title) {
                                document.getElementById('select_product_page').value = id;
                                document.getElementById('product_title').value = title;
                                document.getElementById('product_alias').value = alias;
                                document.getElementById('sbox-window').close();
                            }
			                
			                function getCheckedValue() {
				                var form = document.phpForm;
				                for(var i = 0; i < form.rdotype.length; i++) {
					                if(form.rdotype[i].checked) {
						                return form.rdotype[i].value;
					                }
				                }
			                }
				                
			                function submitbutton(pressbutton) {
				                var form = document.phpForm;
				                var checkValue = getCheckedValue();

				                if (pressbutton == 'cancel') {
					                submitform( pressbutton );
					                return;
				                }

				                if(checkValue == "rdoNewsCategories"){
					                if (trim( form.select_news_category_page.value ) == 0){
						                alert( "Vui lòng chọn danh mục bản tin cần liên kết cho menu" );
						                form.select_news_category_page.focus();
						                return;
					                }
				                } else if(checkValue == "rdoNewsArticle"){
					                if (trim( form.select_news_article_page.value ) == 0){
						                alert( "Vui lòng chọn bản tin cần liên kết cho menu" );
						                form.news_title.focus();
						                return;
					                } 
				                } else if(checkValue == "rdoProductCategories"){
					                if (trim( form.select_product_category_page.value ) == 0){
						                alert( "Vui lòng chọn danh mục sản phẩm cần liên kết cho menu" );
						                form.select_product_category_page.focus();
						                return;
					                }
				                } else if(checkValue == "rdoProductDetail"){
					                if (trim( form.select_product_page.value ) == 0){
						                alert( "Vui lòng chọn sản phẩm cần liên kết cho menu" );
						                form.product_title.focus();
						                return;
					                } 
				                } else if(checkValue == "rdoExternal"){
					                if (trim( form.txt_url.value ) == ""){
						                alert( "Vui lòng nhập địa chỉ cần liên kết cho menu" );
						                form.txt_url.focus();
						                return;
					                }
				                }
				                
				                if (trim( form.title.value ) == ""){
					                alert( "Vui lòng nhập tiêu đề cho menu" );
					                form.title.focus();
					                return;
				                } else {
					                submitform( pressbutton );
				                }
			                }
			            //-->
			            </script>
			            
			            <script type="text/javascript">
				            function ChangeLink(k) {
					            var objExternal = document.getElementById('external_page');
                                var objNewsCategories = document.getElementById('news_category_page');
					            var objNewsArticle = document.getElementById('news_article_page');
					            var objProductCategories = document.getElementById('product_category_page');
					            var objProductsDetail = document.getElementById('product_detail_page');
					            objExternal.style.display = 'none';
					            objNewsCategories.style.display = 'none';
					            objNewsArticle.style.display = 'none';
					            objProductCategories.style.display = 'none';
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
						            default: objNewsCategories.style.display = ''; break;
					            }
				            }
			            </script>
			            
			            <script type="text/javascript" src="../myeditor/myfinder/ckfinder.js"></script>
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

			            <form method="post" name="phpForm">
				            <table class="admintable" width="100%">
					            <tr valign="top">
						            <td width="60%">
							            <fieldset>
								            <legend>Chi tiết của danh mục Menu</legend>
									            <table width="100%">
                                                    
                                                    <!-- Thuộc nhóm menu -->
										            <tr>
											            <td class="key" align="right">
												            Thuộc nhóm menu:
											            </td>
											            <td>
												            <select name="menutype" id="menutype" class="inputbox" size="1">
												            <?php
													            $myprocess = new process();
													            $result = $myprocess->process_getMenuType_Add_Article($row_edit["menu_type_Id"]);
													            while($row = $result->fetch()){ ?>
														            <option <?php if($row["Id"]  == $row_edit["menu_type_Id"]){} ?> value="<?php echo $row['Id']; ?>"><?php echo $row['title']; ?></option>
												            <?php }	?>
												            </select>
											            </td>
										            </tr>
                                                    
                                                    <!-- Tiêu đề -->
										            <tr>
											            <td class="key" align="right">
												            Tiêu đề:
											            </td>
											            <td>
												            <input class="inputbox" type="text" name="title" maxlength="255" value="<?php echo $row_edit['title']; ?>" style="width:306px;"/>
											            </td>
										            </tr>
										            
													<tr>
														<td class="key" align="right">
															Biểu tượng:
														</td>
														<td>
															<input class="inputbox" type="text" id="icon" name="icon" maxlength="500" value="<?php echo $row_edit['link']; ?>" style="width:306px;" />
															<a title="Chọn hình ảnh"  href="javascript:void(0)" onClick="javascript:BrowseServer('icon');">Lựa chọn</a>
														</td>
													</tr>
                                                    
										            <tr>
											            <td class="key" align="right">
												            Liên kết:
											            </td>
											            <td>
                                                            <!-- Radio button -->
                                                            <div>
                                                                <?php 
														            $checked = "";
														            if ($row_edit['type'] == "news-category") {
                                                                        $checked = 'checked="checked"';
                                                                    } 
													            ?>
													            <input <?php echo $checked; ?> id="rdoNewsCategories" type="radio" name="rdotype" value="rdoNewsCategories" onclick="javascript:return ChangeLink(2);">
													            <label for="rdoNewsCategories">Danh mục tin tức</label>
													            
													            
                                                                <?php 
														            $checked = "";
														            if ($row_edit['type'] == "news-article") {
                                                                        $checked = 'checked="checked"';
                                                                    }
													            ?>
													            <input <?php echo $checked; ?> id="rdoNewsArticle" type="radio" name="rdotype" value="rdoNewsArticle" onclick="javascript:return ChangeLink(3);">
													            <label for="rdoNewsArticle">Liên kết bản tin</label>                                                               
                                                                
                                                                <?php 
														            $checked = "";
														            if ($row_edit['type'] == "product-category") {
                                                                        $checked = 'checked="checked"';
                                                                    }
													            ?>
													            <input <?php echo $checked; ?> id="rdoProductCategories" type="radio" name="rdotype" value="rdoProductCategories" onclick="javascript:return ChangeLink(4);">
													            <label for="rdoProductCategories">Danh mục sản phẩm</label>
                                                                
                                                                
                                                                <div class="clear"></div>
													            
													            
                                                                <?php 
														            $checked = "";
														            if ($row_edit['type'] == "product-detail") {
                                                                        $checked = 'checked="checked"';
                                                                    }
													            ?>
													            <input <?php echo $checked; ?> id="rdoProductArticle" type="radio" name="rdotype" value="rdoProductDetail" onclick="javascript:return ChangeLink(5);">
													            <label for="rdoProductArticle">Liên kết sản phẩm</label>
                                                                
                                                                
                                                                <?php 
                                                                    $checked = "";
                                                                    if ($row_edit['type'] == "linkout") {
                                                                        $checked = 'checked="checked"';
                                                                    }
                                                                ?>
                                                                <?php 
                                                                    $checked = "";
                                                                    if ($row_edit['type'] == "linkout") {
                                                                        $checked = 'checked="checked"';
                                                                    }
                                                                ?>
                                                                <input <?php echo $checked; ?> id="rdoExternal" type="radio" name="rdotype" value="rdoExternal" onclick="javascript:return ChangeLink(1);">
                                                                <label for="rdoExternal">Trang ngoài</label>
                                                                
                                                                
                                                                <?php 
                                                                    $checked = "";
                                                                    if ($row_edit['type'] == "null") {
                                                                        $checked = 'checked="checked"';
                                                                    }
                                                                ?>
                                                                <input <?php echo $checked; ?> id="rdoNull" type="radio" name="rdotype" value="rdoNull" onclick="javascript:return ChangeLink(6);">
                                                                <label for="rdoNull">Không liên kết</label>
                                                                
                                                                
                                                                <div class="clear"></div>
                                                                
                                                                
                                                                <?php 
                                                                    $checked = "";
                                                                    if ($row_edit['type'] == "cart") {
                                                                        $checked = 'checked="checked"';
                                                                    }
                                                                ?>
                                                                <input <?php echo $checked; ?> id="rdoCart" type="radio" name="rdotype" value="rdoCart" onclick="javascript:return ChangeLink(7);">
                                                                <label for="rdoCart">Giỏ hàng</label>
													            
													            
                                                                <?php 
														            $checked = "";
														            if ($row_edit['type'] == "contact") {
                                                                        $checked = 'checked="checked"';
                                                                    }
													            ?>
													            <input <?php echo $checked; ?> id="rdoContact" type="radio" name="rdotype" value="rdoContact" onclick="javascript:return ChangeLink(8);">
													            <label for="rdoContact">Liên hệ</label>
												            </div>
                                                            <!-- [/] Radio button -->
												            
                                                            <!-- News Category -->
												            <div id="news_category_page" style="min-height:150px;<?php if ($row_edit['type'] != "news-category") { echo 'display:none;'; }  ?>">
													            <?php
														            function category($parentid = 0, $alias = "", $space = '&nbsp;&nbsp;|____', $trees = NULL)
														            {
															            global $myprocess;
															            global $__menu;
															            
															            $result = $myprocess->get_category_view($parentid, $__menu['lang_code']);
															            
                                                                        if (!$trees) {
                                                                            $trees = array();
                                                                        }
															            
                                                                        $k=1;
															            
                                                                        while ($row = $result->fetch()) {
																            $trees[] = array(
                                                                                'id'        =>  $row["cat_id"],
                                                                                'alias'     =>  $row["alias"],
                                                                                'title'     =>  $space . ' ' . $row["title"],
                                                                                'space'     =>  $space
                                                                            );
																            
                                                                            $trees = category($row["cat_id"], $row["alias"] . "/", $space.'&nbsp;&nbsp;|____', $trees);
															            }
															            return $trees;
														            }
														            
                                                                    $category = category(0);
													            ?>
													            <select name="select_news_category_page" id="select_news_category_page" class="inputbox" size="10" style="width:306px;">
													            	<option value="0"  selected="selected">Chọn danh mục</option>
														            <?php
															            if ($row_edit['type'] == "news-category") {
																            foreach($category as $k=>$rs) {
                                                                                ?><option <?php if ($row_edit['link_id'] == $rs['alias'] . '/cn' . $rs['id']) { echo 'selected="selected"'; }?> value="<?php echo $rs['alias'] . '/cn' . $rs['id']; ?>"> <?php echo $rs['title']; ?> </option><?php 
																            }
															            }
                                                                        else {
																            foreach($category as $k=>$rs) {
                                                                                ?><option value="<?php echo $rs['alias'] . '/cn' . $rs['id']; ?>; ?>"> <?php echo $rs['title']; ?> </option><?php
                                                                            }
															            }
														            ?>
													            </select>
												            </div>
                                                            <!-- [/] News Category -->
												            
                                                            <!-- News Article -->
                                                            <?php 
													            if ($row_edit['type'] == "news-article") {
													                $news_alias = $core_class->convertStrToArr($row_edit['link_id'], "/"); 
													                $result = $myprocess->get_news_from_alias($news_alias[count($news_alias) - 2]);
													                if ($row = $result->fetch()) {
                                                                        ?>
													                    <div id="news_article_page" style="min-height:150px;">													
														                    <div style="padding-top:20px;">
															                    <div style="float: left;">
																                    <input id="news_title" name="news_title" type="text" value="<?php echo $row['title']; ?>" readonly="true" size="50" />
															                    </div>
															                    <div class="button2-left">
																                    <div class="blank">
																	                    <a class="modal" title="Chọn một bài viết"  href=".?com=com_menu&view=item_menu&task=news.choose&lang_code=<?php echo $__menu['lang_code']; ?>" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
																                    </div>
															                    </div>
															                    <input type="hidden" id="select_news_article_page" name="select_news_article_page" value="<?php echo $row["category_id"]; ?>" />
															                    <input type="hidden" id="news_alias" name="news_alias" value="<?php echo $row["alias"] . "/n" . $row['news_id']; ?>" />
														                    </div>													
													                    </div>
												                        <?php
                                                                    }
                                                                    else
                                                                    {
																		?>
														                <div id="news_article_page" style="min-height:150px;display:none;">													
															                <div style="padding-top:20px;">
																                <div style="float: left;">
																	                <input id="news_title" name="news_title" type="text" value="" readonly="true" size="50" />
																                </div>
																                <div class="button2-left">
																	                <div class="blank">
																		                <a class="modal" title="Chọn một bài viết"  href=".?com=com_menu&view=item_menu&task=news.choose&lang_code=<?php echo $__menu['lang_code']; ?>" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
																	                </div>
																                </div>
																                <input type="hidden" id="select_news_article_page" name="select_news_article_page" value="0" />
																                <input type="hidden" id="news_alias" name="news_alias" value="" />
															                </div>													
														                </div>
													                    <?php
                                                                    }
                                                                }
                                                                else {
                                                                    ?>
													                <div id="news_article_page" style="min-height:150px;display:none;">													
														                <div style="padding-top:20px;">
															                <div style="float: left;">
																                <input id="news_title" name="news_title" type="text" value="" readonly="true" size="50" />
															                </div>
															                <div class="button2-left">
																                <div class="blank">
																	                <a class="modal" title="Chọn một bài viết"  href=".?com=com_menu&view=item_menu&task=news.choose&lang_code=<?php echo $__menu['lang_code']; ?>" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
																                </div>
															                </div>
															                <input type="hidden" id="select_news_article_page" name="select_news_article_page" value="0" />
															                <input type="hidden" id="news_alias" name="news_alias" value="" />
														                </div>													
													                </div>
												                    <?php
                                                                }
                                                            ?>
												            <!-- [/] News Article -->
                                                            
                                                            <!-- Product Category -->
												            <div id="product_category_page" style="min-height:150px;<?php if($row_edit['type'] != "product-category") { echo 'display:none;'; }  ?>">
													            <?php
														            function category_product($parentid = 0, $alias = '', $space = '&nbsp;&nbsp;|____', $trees = NULL)
														            {
															            global $myprocess;
															            global $__menu;
															            $result = $myprocess->get_product_category_view($parentid, $__menu['lang_code']);
															            
															            if (!$trees) {
                                                                            $trees = array();
                                                                        }
															            
                                                                        $k=1;
															            
                                                                        while ($row = $result->fetch()) {
                                                                            $trees[] = array(
                                                                                'id'        =>  $row["cat_id"],
                                                                                'alias'     =>  $alias . $row["alias"],
                                                                                'title'     =>  $space . ' ' . $row["title"],
                                                                                'space'     =>  $space
                                                                            );
                                                                            
                                                                            $trees = category_product($row["cat_id"], $alias . $row["alias"] . "/", $space.'&nbsp;&nbsp;|____', $trees);
                                                                        }				
															            
                                                                        return $trees;
														            }
														            
                                                                    $category = category_product(0);
													            ?>
													            <select name="select_product_category_page" id="select_product_category_page" class="inputbox" size="10" style="width:306px;">
														            <option value="0" selected="selected">Chọn danh mục</option>
                                                                    <?php
                                                                        if ($row_edit['type'] == "product-category") {
                                                                            foreach ($category as $k => $rs) {
                                                                                ?><option <?php if ($row_edit['link_id'] == $rs['alias'] . '/cp' . $rs['id'] ) { echo 'selected="selected"'; }?> value="<?php echo $rs['alias'] . '/cp' . $rs['id']; ?>"> <?php echo $rs['title']; ?> </option><?php 
                                                                            }
                                                                        }
                                                                        else {
                                                                            foreach($category as $k=>$rs) {
                                                                                ?><option value="<?php echo $rs['alias'] . '/cp' . $rs['id']; ?>"> <?php echo $rs['title']; ?> </option><?php
                                                                            }
                                                                        }
                                                                    ?>
													            </select>
												            </div>
                                                            <!-- [/] Product Category -->
												            
												            <!-- Product Detail -->
                                                            <?php 
                                                                if ($row_edit['type'] == "product-detail") {
                                                                    $product_alias = $core_class->convertStrToArr($row_edit['link_id'], "/"); 
                                                                    $result = $myprocess->get_product_from_alias($product_alias[count($product_alias) - 2]);
                                                                    if ($row = $result->fetch()) {
                                                                        ?>
                                                                        <div id="product_detail_page" style="min-height:150px;">                                                    
                                                                            <div style="padding-top:20px;">
                                                                                <div style="float: left;">
                                                                                    <input id="product_title" name="product_title" type="text" value="<?php echo $row['product_name']; ?>" readonly="true" size="50" />
                                                                                </div>
                                                                                <div class="button2-left">
                                                                                    <div class="blank">
                                                                                        <a class="modal" title="Chọn một sản phẩm"  href=".?com=com_menu&view=item_menu&task=product.choose&lang_code=<?php echo $__menu['lang_code']; ?>" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" id="select_product_page" name="select_product_page" value="<?php echo $row["book_category_id"]; ?>" />
                                                                                <input type="hidden" id="product_alias" name="product_alias" value="<?php echo $row["alias"] . "/p" . $row['Id']; ?>" />
                                                                            </div>                                                    
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    else {
																		?>
	                                                                    <div id="product_detail_page" style="min-height:150px;display:none;">                                                    
	                                                                        <div style="padding-top:20px;">
	                                                                            <div style="float: left;">
	                                                                                <input id="product_title" name="product_title" type="text" value="" readonly="true" size="50" />
	                                                                            </div>
	                                                                            <div class="button2-left">
	                                                                                <div class="blank">
	                                                                                    <a class="modal" title="Chọn một sản phẩm"  href=".?com=com_menu&view=item_menu&task=product.choose&lang_code=<?php echo $__menu['lang_code']; ?>" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
	                                                                                </div>
	                                                                            </div>
	                                                                            <input type="hidden" id="select_product_page" name="select_product_page" value="0" />
	                                                                            <input type="hidden" id="product_alias" name="product_alias" value="" />
	                                                                        </div>                                                    
	                                                                    </div>
	                                                                    <?php
                                                                    }
                                                                }
                                                                else {
                                                                    ?>
                                                                    <div id="product_detail_page" style="min-height:150px;display:none;">                                                    
                                                                        <div style="padding-top:20px;">
                                                                            <div style="float: left;">
                                                                                <input id="product_title" name="product_title" type="text" value="" readonly="true" size="50" />
                                                                            </div>
                                                                            <div class="button2-left">
                                                                                <div class="blank">
                                                                                    <a class="modal" title="Chọn một sản phẩm"  href=".?com=com_menu&view=item_menu&task=product.choose&lang_code=<?php echo $__menu['lang_code']; ?>" rel="{handler: 'iframe', size: {x: 1000, y: 600}}">Lựa chọn</a>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" id="select_product_page" name="select_product_page" value="0" />
                                                                            <input type="hidden" id="product_alias" name="product_alias" value="" />
                                                                        </div>                                                    
                                                                    </div>
                                                                    <?php
                                                                }
                                                            ?>
                                                            <!-- [/] Product Detail -->
                                                            
                                                            <!-- Linkout -->
												            <?php
                                                                if ($row_edit['type'] == "linkout") {
                                                                    ?>
												                    <div id="external_page" style="min-height:150px;">
													                    <div style="padding-top:20px;">
														                    <span style="font-weight:bold;">Nhập đường dẫn</span><br />
														                    <input type="text" id="txt_url" name="txt_url" value="<?php echo $row_edit['link_id']; ?>" style="width:306px;" />
													                    </div>
												                    </div>
												                    <?php
                                                                } 
                                                                else { 
                                                                    ?>
												                    <div id="external_page" style="min-height:150px;display:none">
													                    <div style="padding-top:20px;">
														                    <span style="font-weight:bold;">Nhập đường dẫn</span><br />
														                    <input type="text" id="txt_url" name="txt_url" style="width:306px;" />
													                    </div>
												                    </div>
												                    <?php
                                                                }
                                                            ?>
                                                            <!-- [/] Linkout -->
											            </td>
										            </tr>																	
										            <tr>
											            <td class="key" align="right" valign="top">
												            Menu cha:
											            </td>
											            <td>						
												            <select name="parent" id="selections" class="inputbox" size="10" style="width:306px;">
													            <option value="0" selected="selected">Root</option>
													            <?php 
														            function menu($parentid = 0, $menu_type_Id, $space = '&nbsp;&nbsp;|____', &$html = ''){
															            $myprocess = new process();
															            $result = $myprocess->list_menu($parentid, $menu_type_Id);
															            while($row = $result->fetch()){
																												            
																            $html .= '<option'; 
																            if( $row["Id"] == intval($_GET["parent_Id"]) ){ $html .= ' selected'; } 
																            $html .= ' value="'.$row['Id'].'">' . $space . ' ' . $row['title'].'</option>';
																            
																            menu($row["Id"], $menu_type_Id, $space.'&nbsp;&nbsp;|____', $html);
															            }				
															            return $html;
														            }
														            echo menu(0, intval($row_edit["menu_type_Id"]), $space . '&nbsp;&nbsp;|____'); 
													            ?>
												            </select>
											            </td>
										            </tr>
										            <tr>
											            <td class="key" valign="top" align="right">
												            Hiển thị:
											            </td>
											            <td>
												            <input type="radio" name="published" id="published0" value="0"  />
												            <label for="published0">No</label>
												            <input type="radio" name="published" id="published1" value="1" checked="checked"  />
												            <label for="published1">Yes</label>
										            </tr>
										            <tr>
											            <td class="key" valign="top" align="right">
												            Thứ tự:
											            </td>
											            <td>Mặc định các danh mục mới ở vị trí cuối cùng. Thứ tự có thể thay đổi sau khi danh mục này được lưu. </td>
										            </tr>						
										            <tr>
											            <td class="key" valign="top" align="right">
												            Khi click chuột, mở ra tại: 
											            </td>
											            <td>
												            <select name="browserNav" id="browserNav" class="inputbox" size="3">
												            <option value="_self"  selected="selected">Hiển thị trong cửa sổ đang xem</option>
												            <option value="_blank" >Hiển thị trong cửa sổ mới</option>
												            </select>
											            </td>
										            </tr>
									            </table>
							            </fieldset>
						            </td>			
					            </tr>
				            </table>
				            <input type="hidden" name="hidden" value="submit_com_menu_item_menu_edit" />
				            <input type="hidden" name="menu_id" value="<?php echo $row_edit["Id"]; ?>" />
				            <input type="hidden" name="task"/>
			            </form>

				        <div class="clr"></div>
			        </div>
			        <div class="b">
				        <div class="b">
					        <div class="b"></div>
				        </div>
			        </div>
   		        </div>
		        <noscript>
			        Warning! JavaScript must be enabled for proper operation of the Administrator Back-end
                </noscript>
		        <div class="clr"></div>
	        </div>
	        <div class="clr"></div>
        </div>
    </div>
    <div id="border-bottom"><div><div></div></div></div>
<?php } ?>