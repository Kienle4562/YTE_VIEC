<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include_once('com_account_manager.models.php');
	$myprocess = new process_manager_bds();
    $result = $myprocess->get_pass_show($_SESSION["career"]["career_id"]);
	if( isset($_SESSION['message']) )
	{
	   $alert = ' <div class="alert_box error r_corners relative fs_medium m_bottom_12"><p> '. $_SESSION['message'] .'</p></div>';
	   unset($_SESSION['message']);
	}
	if($row = $result->fetch()){
?>
<div class="clearfix m_xs_bottom_10 margin_top_20">
    <div class="bg_white p_15 r_corners m_bottom_20">
        <h4 class="color_dark m_bottom_12">Cập nhật mật khẩu</h4>
        <div class="col-lg-7 col-md-7 col-sm-7 f_none" style="margin:0 auto;">
         <?php echo $alert ?>
           <form name="validateSubmitForm" id="validateSubmitForm" method="post">
				<ul>
					<li class="m_bottom_15 m_xs_bottom_15">
						<label for="input_1" class="required d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">Mật khẩu cũ:</label>
						<input type="password" name="pass_old" id="pass_old"  class="r_corners d_inline_m w_sm_full" value="" placeholder="*****">
					</li>
					<li class="m_bottom_15 m_xs_bottom_15">
						<label for="input_1" class="required d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">Mật khẩu mới:</label>
						<input type="password" name="pass" id="pass"  class="r_corners d_inline_m w_sm_full" value="" required>
					</li>
					<li class="m_bottom_15 m_xs_bottom_15">
						<label for="input_1" class="required d_inline_m d_sm_block w_sm_auto m_sm_bottom_5">Nhập lại mật khẩu mới:</label>
						<input type="password" name="pass_config" id="pass_config" class="r_corners d_inline_m w_sm_full"value=""  required> 
					</li>
					<li class="m_bottom_20 m_xs_bottom_15">
						<input type="hidden" name="idaccount" value="<?php echo $_SESSION["member"]["Ac_Id"] ?>" />
						<input type="hidden" name="do" value="editpass" />
						<button type="submit" class="button_type_5 color_blue transparent r_corners fs_medium tr_all m_right_10 m_sm_bottom_10">Cập nhật</button>
					</li>                                            
				</ul>
			</form> 
        </div>
    </div>
</div>
<?php } ?>
<script type="text/javascript" src="<?php echo $index; ?>javascript/jquery.validate.min.js"></script>
<script type="text/javascript">
	$("#validateSubmitForm").validate({
		rules: {
			pass_old: {
				required: true,
				minlength: 5
			},
			pass: {
				required: true,
				minlength: 5
			},
			pass_config: {
				required: true,
				minlength: 5,
				equalTo: "#pass"
			}
		},
		messages: {
			pass_old: {
			  required: "Mật khẩu cũ không được bỏ trống",
			  minlength: "Mật khẩu cũ phải lớn hơn 5 ký tự"
			},
			pass: {
			  required: "Mật khẩu mới không được bỏ trống",
			  minlength: "Mật khẩu mới phải lớn hơn 5 ký tự"
			},
			pass_config: {
				required: "Nhập lại mật khẩu không được bỏ trống",
				minlength: "Nhập lại mật khẩu phải lớn hơn 5 ký tự",
				equalTo: "Nhập lại mật khẩu không chính xác"
			}
		}
	});
</script>