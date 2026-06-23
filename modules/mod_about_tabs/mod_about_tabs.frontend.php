<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_about_tabs.models.php"); 
	
	if (empty($params) || $params == "undefine") {
        $params = array(           
            'class' => '',
			'content' => ''
        );
    }
    else {
        $params = unserialize($params);
    }
	
?>    
<div class="<?php if (!empty($params['class'])) echo $params['class']; ?>">
    <?php if( !empty($module_title) ) { ?><h5 class="fw_light color_dark m_bottom_20"><?php echo $module_title; ?></h5><?php } ?>
        
    <section class="section_offset">
        <div class="container t_align_c">
            <h3 class="color_dark m_bottom_15 heading_1">Về Web Tiện Ích</h3>
            <h6 class="m_bottom_35 heading_2">Những thông tin cơ bản về WTI. </h6>
            <div class="tabs">
                <!--tabs nav-->
                <ul class="tabs_nav hr_list d_inline_b d_xs_block m_bottom_30 m_xs_bottom_20">
                    <li class="f_xs_none"><a href="#tab-1" class="color_dark d_block n_sc_hover">Giới thiệu chung</a></li>
                    <li class="f_xs_none"><a href="#tab-2" class="color_dark d_block n_sc_hover">Tầm nhìn & sứ mệnh</a></li>
                    <li class="f_xs_none"><a href="#tab-3" class="color_dark d_block n_sc_hover">WTI với báo chí</a></li>
                    <li class="f_xs_none"><a href="#tab-4" class="color_dark d_block n_sc_hover">Nguồn nhân lực</a></li>
                </ul>
                <!--tabs content-->
                <article id="tab-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 m_xs_bottom_20">
                            <img src="files/images/gioi-thieu/home_img_1.png" class="r_corners" alt="">
                        </div>
                        <div class="col-lg-6 col-md-6 t_align_l fw_light">
                            <p class="m_bottom_15">
                                Công ty TNHH Dịch Vụ - Quảng Cáo Web Tiện Ích được thành lập từ năm 2013 theo quyết định số 1801314923 do sở kế hoạch và đầu tư thành phố Cần Thơ cấp, với chức năng:
                            </p>
                            <p class="m_bottom_15">
                                <ul class="vr_list_type_5 fs_small color_dark">
                                    <li class="f_xs_none m_xs_right_0 m_xs_bottom_5 fs_large">
                                        1.	Thiết kế website
                                    </li>
                                    <li class="f_xs_none m_xs_right_0 m_xs_bottom_5 fs_large">
                                        2.	Phát triển phần mềm 
                                    </li>
                                    <li class="f_xs_none m_xs_right_0 m_xs_bottom_5 fs_large">
                                        3.	Quảng cáo từ khoá lên TOP 1 google (google adsword)
                                    </li>
                                    <li class="f_xs_none m_xs_right_0 m_xs_bottom_5 fs_large">
                                        4.	Quảng cáo trực tuyến trên mạng internet
                                    </li>
                                    <li class="f_xs_none m_xs_right_0 m_xs_bottom_5 fs_large">
                                        5.	Cung cấp Domain, Hosting, Server
                                    </li>
                                    <li class="f_xs_none m_xs_right_0 m_xs_bottom_5 fs_large">
                                        6.	Thi công hệ thống mạng, lắp đặt Camera quan sát
                                    </li>
                                </ul>                                         
                            </p>
                            <p class="m_bottom_15"></p>
                            <p>Với đội ngũ thiết kế đồ họa và kỹ sư CNTT trẻ, đầy sáng tạo và năng động, chịu khó và ham học hỏi. Cùng sự góp sức của các chuyên gia dày dặn kinh nghiệm về thiết kế và phát triển ứng dụng trên Internet, chúng tôi tự hào khi mang đến cho khách hàng những website cao cấp với phong cách thiết kế website chuyên nghiệp, để lại ấn tượng sâu sắc trong lòng người viếng thăm, qua đó nâng cao khả năng cạnh tranh cho khách hàng trong lĩnh vực quảng bá tên tuổi trên Internet. </p>
                        </div>
                    </div>
                </article>
                <article id="tab-2">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 m_sm_bottom_20 t_align_l fw_light">
                            <p class="m_bottom_15">" Sứ mệnh của chúng tôi là trở thành một công ty kinh doanh, thiết kế những dịch vụ phục vụ cho ngành CNTT hàng đầu Miền Tây nói riêng và Việt Nam nói chung. Phục vụ tốt nhất những khách hàng trong thị trường mà công ty có được".</p>
                            <p class="m_bottom_15">
                                Khách hàng là giá trị cơ bản của bất kỳ doanh nghiệp nào, là lý do duy nhất để doanh nghiệp tồn tại và phát triển. Chính sách "khách hàng là trung tâm" chỉ lối dẫn đường cho mọi hoạt động của công ty.
                                Chúng tôi lắng nghe, phân tích và thấu hiểu nhu cầu của từng khách hàng và áp dụng kinh nghiệm, kỹ năng, tư duy của mình để giải quyết tối ưu những nhu cầu đó, giúp chủ doanh nghiệp tập trung vào các hoạt động kinh doanh cốt lõi của mình. Mỗi khách hàng là một viên gạch xây lên giá trị của công ty. 
                            </p>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <img src="files/images/gioi-thieu/home_img_2.png" class="r_corners" alt="">
                        </div>
                    </div>
                </article>
                <article id="tab-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 m_sm_bottom_20">
                            <div class="iframe_video_wrap">
                                <iframe src="https://www.youtube.com/embed/Du8ld5hrqN0?enablejsapi=1&amp;html5=1&amp;hd=1&amp;wmode=opaque&amp;controls=1&amp;showinfo=0;rel=0"></iframe>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 t_align_l fw_light">
                            <p class="m_bottom_15">Donec porta diam eu massa. Quisque diam lorem, interdum vitae, dapibus ac, scelerisque vitae, pede. Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipis. </p>
                            <p class="m_bottom_15">Mauris accumsan nulla vel diam. Sed in lacus ut enim adipiscing aliquet. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Donec sit amet eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </p>
                            <p>Mauris fermentum dictum magna. Sed laoreet aliquam leo. Ut tellus dolor, dapibus eget, elementum vel, cursus eleifend, elit. Aenean auctor wisi et urna. Aliquam erat volutpat. Duis ac turpis. Integer rutrum ante eu lacus.</p>
                        </div>
                    </div>
                </article>
                <article id="tab-4" class="t_align_l fw_light">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 m_sm_bottom_20 t_align_l fw_light">
                            <p class="m_bottom_15">Với đội ngũ  trên 10 thành viên tại web tiện ích đã tốt nghiệp các trường đại học chuyên ngành CNTT trong và ngoài nước. Đang không ngừng nghiên cứu ra những giá trị mới để phát triển nhằm phục vụ cho lợi ích khách hàng một cách tốt nhất.</p>
                            <p class="m_bottom_15">Với kinh nghiệm nhiều năm hoạt động trong lĩnh vực CNTT của đội ngũ quản lý, kỹ sư và nhân viên trong công ty chúng tôi sẽ giúp cho sản phẩm của quý khách hàng tiếp cận thị trường một cách nhanh nhất, hiệu quả nhất và chuyên nghiệp nhất. </p>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <img src="images/home_img_1.jpg" class="r_corners" alt="">
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    
</div>