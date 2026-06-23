<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
	$meta_title = "Liên Hệ";
	$pathway_text = "<li class=\"m_right_8 f_xs_none\"><a href=\"$link\" class=\"color_default d_inline_m m_right_10\">Liên Hệ</a></li>";
?>
<!--content-->
<section class="section_offset">
    <div class="container clearfix">
		<div class="row">            
			<div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
				<h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c">Thông tin liên hệ</h3>
				<p class="m_bottom_35 heading_2 t_align_c"><?php echo $_APP['config']['contact']['company_name']; ?></p>
				<div class="row">
                    <ul class="col-lg-12 col-md-12 col-sm-12 fw_light w_break m_bottom_45 m_xs_bottom_30">
                    	<?php 
						$phone = array_filter($_APP['config']['contact']['phone']);
						for($i = 1; $i <= count($phone); $i++) {?>
                        <li class="m_bottom_8">
                            <div class="d_inline_m icon_wrap_size_1 color_purple circle m_right_10">
                                <i class="icon-phone-1"></i>
                            </div>
                            <?= $phone["phone".$i]; ?>
                        </li>
                        <?php } ?>
                        <?php 
						$mobile = array_filter($_APP['config']['contact']['mobile']);
						for($i = 1; $i <= count($mobile); $i++) {?>
                        <li class="m_bottom_8">
                            <div class="d_inline_m icon_wrap_size_1 color_purple circle m_right_10">
                                <i class="icon-mobile"></i>
                            </div>
                            <?= $mobile["mobile".$i]; ?>
                        </li>
                        <?php } ?>
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
                    	<?php 
						$address = array_filter($_APP['config']['contact']['address']);
						for($i = 1; $i <= count($address); $i++) {?>
                        <li class="m_bottom_8 fw_light">
                            <div class="d_inline_m icon_wrap_size_1 color_purple circle m_right_10">
                                <i class="icon-location"></i>
                            </div>
                            <?= $address["address".$i]; ?>
                        </li>
                        <?php } ?>
                        <?php 
						$skype = array_filter($_APP['config']['contact']['skype']);
						for($i = 1; $i <= count($skype); $i++) {?>
                        <li class="m_bottom_8 fw_light">
                            <div class="d_inline_m icon_wrap_size_1 color_purple circle m_right_10">
                                <i class="icon-skype-1"></i>
                            </div>
                            <?= $skype["skype".$i]; ?>
                        </li>
                        <?php } ?>
                        <?php 
						$yahoo = array_filter($_APP['config']['contact']['yahoo']);
						for($i = 1; $i <= count($yahoo); $i++) {?>
                        <li class="fw_light">
                            <div class="d_inline_m icon_wrap_size_1 color_purple circle m_right_10">
                                <i class="icon-facebook"></i>
                            </div>
                            <a href="http://<?= $yahoo["yahoo".$i]; ?>" target="_blank" class="color_dark color_purple_hover"><?= $yahoo["yahoo".$i]; ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
				<h5 class="color_dark m_bottom_20 fw_light">Giữ kết nối</h5>
				<ul class="hr_list social_icons">
					<!--tooltip_container class is required-->
					<li class="m_right_15 m_bottom_15 tooltip_container">
						<!--tooltip-->
						<span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Facebook</span>
						<a href="#" class="d_block facebook icon_wrap_size_2 circle color_grey_light_2">
							<i class="icon-facebook fs_small"></i>
						</a>
					</li>
					<li class="m_right_15 m_bottom_15 tooltip_container">
						<!--tooltip-->
						<span class="d_block r_corners color_default tooltip fs_small tr_all">Follow Us on Twitter</span>
						<a href="#" class="d_block twitter icon_wrap_size_2 circle color_grey_light_2">
							<i class="icon-twitter fs_small"></i>
						</a>
					</li>
					<li class="m_right_15 m_bottom_15 tooltip_container m_xs_right_15">
						<!--tooltip-->
						<span class="d_block r_corners color_default tooltip fs_small tr_all">Google Plus</span>
						<a href="#" class="d_block googleplus icon_wrap_size_2 circle color_grey_light_2">
							<i class="icon-gplus-1 fs_small"></i>
						</a>
					</li>
					<li class="m_right_15 m_bottom_15 tooltip_container">
						<!--tooltip-->
						<span class="d_block r_corners color_default tooltip fs_small tr_all">Pinterest</span>
						<a href="#" class="d_block pinterest icon_wrap_size_2 circle color_grey_light_2">
							<i class="icon-pinterest fs_small"></i>
						</a>
					</li>
					<li class="m_bottom_15 m_right_15 m_md_right_15 tooltip_container">
						<!--tooltip-->
						<span class="d_block r_corners color_default tooltip fs_small tr_all">Dribbble</span>
						<a href="#" class="d_block dribbble icon_wrap_size_2 circle color_grey_light_2">
							<i class="icon-dribbble fs_small"></i>
						</a>
					</li>
					<li class="m_right_15 m_bottom_15 tooltip_container m_sm_right_0 m_xs_right_15">
						<!--tooltip-->
						<span class="d_block r_corners color_default tooltip fs_small tr_all">Flickr</span>
						<a href="#" class="d_block flickr icon_wrap_size_2 circle color_grey_light_2">
							<i class="icon-flickr-1 fs_small"></i>
						</a>
					</li>
					<li class="m_right_15 m_bottom_15 tooltip_container">
						<!--tooltip-->
						<span class="d_block r_corners color_default tooltip fs_small tr_all">Youtube</span>
						<a href="#" class="d_block youtube icon_wrap_size_2 circle color_grey_light_2">
							<i class="icon-youtube-play fs_small"></i>
						</a>
					</li>
					<li class="m_right_15 m_bottom_15 tooltip_container">
						<!--tooltip-->
						<span class="d_block r_corners color_default tooltip fs_small tr_all">Vimeo</span>
						<a href="#" class="d_block vimeo icon_wrap_size_2 circle color_grey_light_2">
							<i class="icon-vimeo fs_small"></i>
						</a>
					</li>
					<li class="m_right_15 m_bottom_15 tooltip_container">
						<!--tooltip-->
						<span class="d_block r_corners color_default tooltip fs_small tr_all">Instagram</span>
						<a href="#" class="d_block instagram icon_wrap_size_2 circle color_grey_light_2">
							<i class="icon-instagramm fs_small"></i>
						</a>
					</li>
					<li class="m_bottom_15 tooltip_container">
						<!--tooltip-->
						<span class="d_block r_corners color_default tooltip fs_small tr_all">LinkedIn</span>
						<a href="#" class="d_block linkedin icon_wrap_size_2 circle color_grey_light_2">
							<i class="icon-linkedin-squared fs_small"></i>
						</a>
					</li>
				</ul>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
				<h3 class="color_dark fw_light m_bottom_15 heading_1 t_align_c">Form Liên Hệ</h3>
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
							<input type="text" name="cf_subject" placeholder="Chủ đề" class="w_full r_corners fw_light">
						</li>
						<li class="m_bottom_5">
							<textarea class="w_full r_corners fw_light height_3" name="cf_message" placeholder="Nội dung liên hệ"></textarea>
						</li>
						<li class="m_bottom_20">
							<label for="capcha" class="d_inline_m fw_light m_right_5 w_auto">Nhập mã bảo vệ Spam: </label>
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
			<div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
				<iframe class="w_full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13214.572079592435!2d105.76993435209164!3d10.040295708373591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a08811f02d69c9%3A0xb5594d8443bcbc77!2zNDI0IMSQxrDhu51uZyBOZ3V54buFbiBWxINuIEPhu6ssIEFuIEhvw6AsIE5pbmggS2nhu4F1LCBD4bqnbiBUaMahLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1538658880933" height="400"></iframe>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_30">
				<iframe class="w_full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5556.0532914668065!2d105.77932367040492!3d10.039698053482084!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a062a746b6e46b%3A0xcbf0565dfedb809a!2zNDMgWMO0IFZp4bq_dCBOZ2jhu4cgVMSpbmgsIEFuIEjhu5lpLCBOaW5oIEtp4buBdSwgQ-G6p24gVGjGoSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2sus!4v1538659550010" height="400"></iframe>
			</div>
		</div>
    </div>
</section>