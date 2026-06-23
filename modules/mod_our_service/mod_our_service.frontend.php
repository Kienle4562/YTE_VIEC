<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") ); 
    
    include_once("mod_our_service.models.php"); 
	
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
        
    <!--what our service-->
    <section class="section_offset image_bg_1 t_align_c">
        <div class="container">
            <h3 class="color_dark m_bottom_15 t_align_c heading_3">Web Tiện Ích cung cấp cho khách hàng những gì</h3>
            <h6 class="m_bottom_35 t_align_c heading_4">Chúng tôi cam kết cung cấp dịch vụ tốt nhất cho khách hàng. </h6>
            
            <div class="row t_align_c m_bottom_35">
                <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
                    <figure>
                        <div class="icon_wrap_size_8 circle color_yellow d_inline_m animation_fill type_2 relative m_bottom_20">
                            <i class="icon-tools tr_all"></i>
                        </div>
                        <figcaption>
                            <h5 class="color_dark m_bottom_15">Thiết kế website</h5>
                            <p class="m_bottom_23">Thiết kế website chuyên nghiệp, sáng tạo, giao diện đẹp mắt, hiển thị tốt trên các thiết bị di động, hỗ trợ SEO thúc đẩy doanh số bán hàng tăng doanh thu.</p>
                            <a href="./website/bang-gia-thiet-ke-web/w1313.html" class="button_type_2 color_dark r_corners fs_medium color_yellow_hover tr_all d_inline_b">Xem thêm</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
                    <figure>
                        <div class="icon_wrap_size_8 circle color_yellow d_inline_m animation_fill type_2 relative m_bottom_20">
                            <i class="icon-network tr_all"></i>
                        </div>
                        <figcaption>
                            <h5 class="color_dark m_bottom_15">Đăng ký tên miền</h5>
                            <p class="m_bottom_23">WTI cung cấp dịch vụ đăng ký tên miền chuyên nghiệp bao gồm: Đăng ký tên miền Việt Nam (.VN) và đăng ký tên miền quốc tế (Tên miền Enom - Tên miền Directi). .</p>
                            <a href="./domain/bang-gia-ten-mien-web-tien-ich/d1308.html" class="button_type_2 color_dark r_corners fs_medium color_yellow_hover tr_all d_inline_b">Xem thêm</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
                    <figure>
                        <div class="icon_wrap_size_8 circle color_yellow d_inline_m animation_fill type_2 relative m_bottom_20">
                            <i class="icon-hdd tr_all"></i>
                        </div>
                        <figcaption>
                            <h5 class="color_dark m_bottom_15">Cho thuê hosting</h5>
                            <p class="m_bottom_23">WTI chính là nơi lý tưởng để bạn lưu trữ website của mình với hệ thống máy chủ mạnh mẽ, sao lưu dữ liệu tự động, đường truyền tốc độ cao ...</p>
                            <a href="./hosting/bang-gia-web-hosting-linux/h1311.html" class="button_type_2 color_dark r_corners fs_medium color_yellow_hover tr_all d_inline_b">Xem thêm</a>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <!--second services-->
            <div class="row t_align_c">
                <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
                    <figure>
                        <div class="icon_wrap_size_8 circle color_yellow d_inline_m animation_fill type_2 relative m_bottom_20">
                            <i class="icon-picture tr_all"></i>
                        </div>
                        <figcaption>
                            <h5 class="color_dark m_bottom_15">Thiết kế đồ họa</h5>
                            <p class="m_bottom_23">Thiết kế templates website, logo công ty, bao bì sản phẩm, thiết kế catalogue, Menu, bộ nhận dạng thương hiệu, danh thiếp, tờ rơi ...</p>
                            <a href="./service/thiet-ke-do-hoa/s1324.html" class="button_type_2 color_dark r_corners fs_medium color_yellow_hover tr_all d_inline_b">Xem thêm</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
                    <figure>
                        <div class="icon_wrap_size_8 circle color_yellow d_inline_m animation_fill type_2 relative m_bottom_20">
                            <i class="icon-search tr_all"></i>
                        </div>
                        <figcaption>
                            <h5 class="color_dark m_bottom_15">Quảng cáo Google Adwords</h5>
                            <p class="m_bottom_23">Quảng cáo của bạn sẽ xuất hiện ngay trang nhất của Google, gia tăng doanh thu, lợi nhuận, tăng lưu lượng truy cập website để thúc đẩy bán hàng.</p>
                            <a href="./service/quang-cao-tu-khoa-google-adwords/s1322.html" class="button_type_2 color_dark r_corners fs_medium color_yellow_hover tr_all d_inline_b">Xem thêm</a>
                        </figcaption>
                    </figure>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 m_xs_bottom_30">
                    <figure>
                        <div class="icon_wrap_size_8 circle color_yellow d_inline_m animation_fill type_2 relative m_bottom_20">
                            <i class="icon-mail tr_all"></i>
                        </div>
                        <figcaption>
                            <h5 class="color_dark m_bottom_15">Dịch vụ Email</h5>
                            <p class="m_bottom_23">Xây dựng email với tên miền riêng (như sales@cong-ty.com ), quản lý tập trung, quảng bá thương hiệu, tạo tin cậy cho đối tác hơn khi dùng các địa chỉ email miễn phí như Gmail, Yahoo, VNN</p>
                            <a href="./service/dich-vu-hosting-email/s1321.html" class="button_type_2 color_dark r_corners fs_medium color_yellow_hover tr_all d_inline_b">Xem thêm</a>
                        </figcaption>
                    </figure>
                </div>
            </div>
            
        </div>
    </section>
    
</div>