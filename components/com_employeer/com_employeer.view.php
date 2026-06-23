<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	include_once('com_employeer.models.php');
?>
<script>
	$(function(){
		$("#solTitle").click(function(){
			swal({
				title: "",
				text: "Rất tiếc! Hiện tại chúng tôi đang trong quá trình hoàn thiện tính năng này trong thời gian sớm nhất để phục vụ quý khách",
				type: "info"
			})
		})
		$("#solTitle2").click(function(){
			swal({
				title: "",
				text: "Rất tiếc! Hiện tại chúng tôi đang trong quá trình hoàn thiện tính năng này trong thời gian sớm nhất để phục vụ quý khách",
				type: "info"
			})
		})
		
	})
</script>        
<section id="timviec" class="parallax-viewport">
	<div class="parallax-layer"></div>
	<div class="container">
		<div class="row">
			<div class="col-sm-6 phone-number">
				
			</div>
		</div>
		<div class="row">
		<div class="background-caption-box hidden-xs">
                    <h1 class="title-intro">MẠNG TUYỂN DỤNG NHÂN SỰ Y TẾ HÀNG ĐẦU VIỆT NAM</h1>
                    <img src="/images/line.png" class="line" alt="nhà tuyển dụng">
                    <p class="quality-intro">
                        Chúng tôi đồng hành cùng sự phát triển của doanh nghiệp thông qua dịch vụ tuyển dụng nhân sự chuyên nghiệp nhất</p>
                    
                </div>
		</div>
	</div>
</section>
<div class="container">
	<div class="row">
		<div style="background-color: #182641;margin-bottom: 10px;display: inline-block;" class="col-md-12">
			<div id="feature_em2">
				<div class="cb-wrapper">
					<ul class="pack_section1">			
						<li>
							<div class="service1">
								<div class="content">
									<a class="title_feature">Đăng Tuyển Dụng</a>
									<div class="content_fck">
										<p style="font-weight: bold">Xây dựng đội ngũ nhân tài cho doanh nghiệp</p>
										<p>Thông tin đăng tuyển của bạn sẽ hiển thị trực tuyến trên YTeViec.Com và các trang đối tác của chúng tôi trong vòng 30 ngày.</p>            
									</div>
									<a class="radius2px images_emp adv_now" href="http://tuyendung.yteviec.com/">Đăng Tuyển Ngay</a>								
								</div>
							</div>
						</li>
						<li>
							<div class="service2">
								<div class="image"></div>
								<div class="content">
									<!--<a href="tim-ung-vien.html" id="solTitle" class="title_feature">Tìm Hồ Sơ Ứng Viên</a>-->
									<a href="javascipt:void(0)" id="solTitle" class="title_feature">Tìm Hồ Sơ Ứng Viên</a>
										<div class="content_fck">
											<p style="font-weight: bold">Không bỏ lỡ nhân tài</p>
											<p>Truy cập vào hàng trăm ngàn hồ sơ hoàn chỉnh và được cập nhật mới thường xuyên để tìm kiếm những ứng viên phù hợp nhất với vị trí tuyển dụng.</p>            
										</div>
										<a href="javascipt:void(0)"  id="solTitle2" class="radius2px images_emp search_resumes">Tìm Hồ Sơ</a>
									<!--<a href="tim-ung-vien.html" class="radius2px images_emp search_resumes">Tìm Hồ Sơ</a> -->								
								</div>
							</div>
						</li>
						<li>
							<div class="service4">
								<div class="image"></div>
								<div class="content">
									<a href="./tao-su-khac-biet-cho-thuong-hieu-cong-ty/n1364.html" class="title_feature">Quảng Bá Tuyển Dụng</a>
									<div class="content_fck">
										<p style="font-weight: bold;">Tạo sự khác biệt cho thương hiệu công ty</p>
										<p>Thông tin tuyển dụng của bạn sẽ nổi bật hơn nhờ nội dung đăng tuyển được thiết kế hấp dẫn nhấn mạnh văn hóa và thương hiệu công ty</p>            
									</div>
									<div class="more_info">
										<a class="more" href="./tao-su-khac-biet-cho-thuong-hieu-cong-ty/n1364.html">Xem thêm</a>
									</div>
								</div>
							</div>
						</li>
					</ul>		
				</div>
			</div>
		</div>
    </div>
</div>
<?php $core_class->load_module("slideshow2"); ?>