<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 

    include_once("mod_visitcounter.models.php");
    include_once("mod_visitcounter.handler.php");
    $myprocess = new process_mod_visitcounter();

    $result = $myprocess->get_module_edit(intval($url[1]));
    
    if ($row_detail = $result->fetch())
    {
        if (empty($row_detail["params"]) || $row_detail["params"] == "undefine") {
            $params = array(
            	'today' => 1,
				'yesterday' => 1,
				'thisweek' => 1,
				'thismonth' => 1,
				'all' => 1,
				'online' => 1
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
				        <div class="header icon-48-stats">
					        Modules » <small>[Thống kê truy cập] » Chỉnh sửa module</small>
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
                                                <td class="key">Tùy chọn item hiển thị</td>
                                                <td>
                                                	<ul>
                                                        <li style="font-weight:bold;width:70px;float:left;color:#666">Hôm nay:</li>
                                                        <li style="list-style:none;"><input type="checkbox" name="today" <?php if($params['today']){ echo "checked"; } ?> /></li>
                                                        <li style="font-weight:bold;width:70px;float:left;color:#666">Hôm qua: </li>
                                                        <li style="list-style:none;"><input type="checkbox" name="yesterday" <?php if($params['yesterday']){ echo "checked"; } ?> /> </li>
                                                        <li style="font-weight:bold;width:70px;float:left;color:#666">Tuần này: </li>
                                                        <li style="list-style:none;"><input type="checkbox" name="thisweek" <?php if($params['thisweek']){ echo "checked"; } ?> /> </li>
                                                        <li style="font-weight:bold;width:70px;float:left;color:#666">Tháng này: </li>
                                                        <li style="list-style:none;"><input type="checkbox" name="thismonth" <?php if($params['thismonth']){ echo "checked"; } ?> /> </li>
                                                        <li style="font-weight:bold;width:70px;float:left;color:#666">Tất cả: </li>
                                                        <li style="list-style:none;"><input type="checkbox" name="all" <?php if($params['all']){ echo "checked"; } ?> /> </li>
                                                        <li style="font-weight:bold;width:70px;float:left;color:#666">Online: </li>
                                                        <li style="list-style:none;"><input type="checkbox" name="online" <?php if($params['online']){ echo "checked"; } ?> /> </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                                
					        </div>
					        
                            <div class="clr"></div>			
					        
                            <input type="hidden" name="hidden" value="submit_mod_visitcounter" />
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