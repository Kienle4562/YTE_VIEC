<?php 
	defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
	$meta_title = "Liên hệ";
	$pathway_text = '<li class="m_right_8 f_xs_none"><a href="lien-he.html" class="color_default d_inline_m m_right_10">Liên hệ</a></li>';
?>

<!--content-->

<section class="section_offset">

    <div class="container clearfix">

        <div class="row">

            <div class="col-lg-7 col-md-7 col-sm-7 m_xs_bottom_30">

                <h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c">Thông tin liên hệ</h3>

                <p class="m_bottom_35 heading_2 t_align_c"><?= $_APP['config']['contact']['company_name']; ?> </p>		

                

                <div class="row">

                    <ul class="col-lg-6 col-md-6 col-sm-6 fw_light w_break m_bottom_45 m_xs_bottom_30">

                    	<?php 

						$phone = array_filter($_APP['config']['contact']['phone']);

						for($i = 1; $i <= 1; $i++) {?>

                        <li class="m_bottom_8">

                            <div class="d_inline_m icon_wrap_size_1 color_purple circle m_right_10">

                                <i class="icon-phone-1"></i>

                            </div>

                            <?= $phone["phone".$i]; ?>

                        </li>

                        <?php } ?>

                       <!-- <?php 

						$mobile = array_filter($_APP['config']['contact']['mobile']);

						for($i = 1; $i <= 1; $i++) {?>

                        <li class="m_bottom_8">

                            <div class="d_inline_m icon_wrap_size_1 color_purple circle m_right_10">

                                <i class="icon-mobile"></i>

                            </div>

                            <?= $mobile["mobile".$i]; ?>

                        </li>

                        <?php } ?>-->

                        <?php 

						$email = array_filter($_APP['config']['contact']['email']);

						for($i = 1; $i <= count($email); $i++) {?>

                        <li class="m_bottom_8">

                            <div class="d_inline_m icon_wrap_size_1 color_purple circle m_right_10">

                                <i class="icon-mail-alt"></i>

                            </div>

                            <a href="mailto:<?= $email["email".$i]; ?>" class="color_black color_purple_hover"><?= $email["email".$i]; ?></a>

                        </li>

                        <?php } ?>                       

                    </ul>

                    <ul class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30 vr_list_type_5">

                    	<?php 

						$address = array_filter($_APP['config']['contact']['address']);

						for($i = 1; $i <= count($address); $i++) {?>

                        <li class="m_bottom_8 fw_light">

                            <div class="f_left icon_wrap_size_1 color_purple circle">

                                <i class="icon-location"></i>

                            </div>

                            <?= $address["address".$i]; ?>

                        </li>

                        <?php } ?>

                        <?php 

						$skype = array_filter($_APP['config']['contact']['skype']);

						for($i = 1; $i <= count($skype); $i++) {?>

                        <li class="m_bottom_8 fw_light">

                            <div class="f_left icon_wrap_size_1 color_purple circle">

                                <i class="icon-skype-1"></i>

                            </div>

                            <?= $skype["skype".$i]; ?>

                        </li>

                        <?php } ?>

                        <?php 

						$yahoo = array_filter($_APP['config']['contact']['yahoo']);

						for($i = 1; $i <= count($yahoo); $i++) {?>

                        <li class="fw_light">

                            <div class="f_left icon_wrap_size_1 color_purple circle">

                                <i class="icon-facebook"></i>

                            </div>

                            <a href="http://<?= $yahoo["yahoo".$i]; ?>" target="_blank" class="color_dark color_purple_hover"><?= $yahoo["yahoo".$i]; ?></a>

                        </li>

                        <?php } ?>

                    </ul>

                </div>

                <h5 class="color_dark m_bottom_20 fw_light">Giờ làm việc</h5>

                <div class="r_corners wrapper border_grey">

                    <table class="w_full responsive_table t_align_c">                  

                      <tbody>

                        <tr>

                          <td class="bg_light_2 color_dark">Thứ</td>

                          <td>2</td>

                          <td>3</td>

                          <td>4</td>

                          <td>5</td>

                          <td>6</td>

                          <td>7</td>

                          <td>CN</td>

                        </tr>

                        <tr>

                          <td class="bg_light_2 color_dark">Giờ</td>

                          <td>8 - 18h</td>

                          <td>8 - 18h</td>

                          <td>8 - 18h</td>

                          <td>8 - 18h</td>

                          <td>8 - 18h</td>

                          <td>8 - 18h</td>

                          <td>Off</td>

                        </tr>

                      </tbody>

                    </table>

                </div>

            </div>

            <div class="col-lg-5 col-md-5 col-sm-5 m_xs_bottom_30">

                <h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c">Liên hệ</h3>

                <p class="m_bottom_35 heading_2 t_align_c">Điền đầy đủ các thông tin bên dưới để liên hệ với chúng tôi</p>		

                <form id="contactform">

                    <ul>

                        <li class="row m_bottom_10">

                            <div class="col-lg-6 col-md-6 col-sm-6 w_xs_full m_xs_bottom_10">

                                <input type="text" name="cf_name" placeholder="Họ tên*" class="w_full r_corners fw_light">

                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 w_xs_full">

                                <input type="email" name="cf_email" placeholder="Email*" class="w_full r_corners fw_light">

                            </div>

                        </li>

                        <li class="m_bottom_10">

                            <input type="text" name="cf_subject" placeholder="Chủ đề*" class="w_full r_corners fw_light">

                        </li>

                        <li class="m_bottom_5">

                            <textarea class="w_full r_corners fw_light height_3" name="cf_message" placeholder="Nội dung liên hệ"></textarea>

                        </li>

                        <li class="m_bottom_20">

                            <label for="capcha" class="d_inline_m fw_light m_right_5 w_auto">Nhập mã: </label>

                            <input id="capcha" type="text" name="cf_anti_spam" class="r_corners fw_light d_inline_m w_auto">

                            <img class="r_corners" id="captcha" src="captcha?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" />

                            <label class="d_inline_m fw_light m_right_5 w_auto"><a href="#" onclick="document.getElementById('captcha').src = 'captcha?sid=<?php echo md5(uniqid()) ?>'; return false" class="btn btn-info btn-sm">Hiển thị mã khác</a></label>

                        </li>

                        <li class="m_bottom_10">

                        	<input type="hidden" name="do" value="contact" />

                            <button class="button_type_5 color_blue transparent r_corners fs_medium tr_all m_right_10 m_sm_bottom_10">Gởi liên hệ</button>

                        </li>

                    </ul>

                </form>

            </div>

        </div>

    </div>

</section>
