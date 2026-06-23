<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
	<!-- BEGIN: Left Aside -->
	<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
		<i class="la la-close"></i>
	</button>
	<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
		<!-- BEGIN: Aside Menu -->
		<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " data-menu-vertical="true"data-menu-scrollable="false" data-menu-dropdown-timeout="500">
			<ul class="check_active_link m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
				<li class="m-menu__item" aria-haspopup="true" >
					<a  href="<?php echo $index ?>" class="m-menu__link ">
						<i class="m-menu__link-icon flaticon-interface-9"></i>
						<span class="m-menu__link-title">
							<span class="m-menu__link-wrap">
								<span class="m-menu__link-text">
									Trang chủ
								</span>
							</span>
						</span>
					</a>
				</li>
				<li class="m-menu__section">
					<h4 class="m-menu__section-text">
						Quản lý chính
					</h4>
					<i class="m-menu__section-icon flaticon-more-v3"></i>
				</li>
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 1;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>
				<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
					<a href="career.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon fa fa-user-o"></i>
						<span class="m-menu__link-text">
							Người tìm việc
						</span>
					</a>
				</li>
				<?php } ?>
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 1;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>
				<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
					<a href="ungtuyen.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon flaticon-file"></i>
						<span class="m-menu__link-text">
							Ứng tuyển
						</span>
					</a>
				</li>
				<?php } ?>
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 1;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>
				<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
					
					<a href="cvuser.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon flaticon-file"></i>
						<span class="m-menu__link-text">
							Quản lý CV
							<?php 
										$condition = " ";
										$trang_thai = " " ;
										$tu_ngay = " ";
										$den_ngay = " ";
									
										if(isset($_REQUEST["tu_ngay"])){
											$tu_ngay = $_REQUEST["tu_ngay"];
											$where_CT .= " AND trn_profilecv.INSERT_DATE >='".$core_class->_formatdate($tu_ngay)." 00:00:00'"; 
										}
										if(isset($_REQUEST["den_ngay"])){
											$den_ngay = $_REQUEST["den_ngay"];
											$where_CT .= " AND trn_profilecv.INSERT_DATE <='".$core_class->_formatdate($den_ngay)." 23:59:59'"; 
										}
										$countCty = $core_class->countColumnInTable("trn_profilecv", "profilecv_id",$where_CT);
								?>
								<span class="m-badge m-badge--danger">
										Tổng số : <?php echo $countCty ?>
									</span>
						</span>
					</a>
				</li>
				<?php } ?>
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 2;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>
				<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
					<a href="congty.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon fa fa-hospital-o"></i>
						<span class="m-menu__link-text">
							Công Ty
							 <?php 
										$condition = " ";
										$trang_thai = " " ;
										$tu_ngay = " ";
										$den_ngay = " ";
										if($_SESSION["session"]['Id'] !=4)
										{
											$where_CT = "WHERE trn_congty.user_id =".$_SESSION["session"]['Id'];	
										}else{
											$where_CT = "WHERE 1=1";
											if(isset($_REQUEST["user"])){
												//$user = $_REQUEST["user"];
												$where_CT .= " AND trn_congty.user_id =".$_REQUEST["user"];
												
											}											
										}
										if(isset($_REQUEST["status"]) && is_numeric($_REQUEST["status"])){
												$trang_thai = $_REQUEST["status"];
												$where_CT .= " AND trn_congty.trangthai ='".$trang_thai."'"; 
											}
										if(isset($_REQUEST["tu_ngay"])){
											$tu_ngay = $_REQUEST["tu_ngay"];
											$where_CT .= " AND trn_congty.DISORDER >='".$core_class->_formatdate($tu_ngay)." 00:00:00'"; 
										}
										if(isset($_REQUEST["den_ngay"])){
											$den_ngay = $_REQUEST["den_ngay"];
											$where_CT .= " AND trn_congty.DISORDER <='".$core_class->_formatdate($den_ngay)." 23:59:59'"; 
										}
										$countCty = $core_class->countColumnInTable("trn_congty", "congty_id",$where_CT);
								?>
								<span class="m-badge m-badge--danger">
										Tổng số : <?php echo $countCty ?>
									</span>
						</span>
						
					</a>
				</li>
				<?php } ?>
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 3;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>		
				<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
					<a href="congviec.html" class="m-menu__link">
						<i class="m-menu__link-icon fa fa-shopping-bag"></i>
						<span class="m-menu__link-title">
							<span class="m-menu__link-wrap">
								<span class="m-menu__link-text">
									Công việc
								</span>
								<span class="m-menu__link-badge">
									<?php
										$condition = " ";
										$trang_thai = " " ;
										$tu_ngay = " ";
										$den_ngay = " ";
										if($_SESSION["session"]['Id'] !=4)
										{
											$where_CV = "WHERE trn_congviec.DELETE_FLG = 0 AND  trn_congviec.user_id =".$_SESSION["session"]['Id'];	
										}else{
											$where_CV = "WHERE 1=1 AND trn_congviec.DELETE_FLG = 0 ";
											if(isset($_REQUEST["user"])){
												//$user = $_REQUEST["user"];
												$where_CV .= " AND trn_congviec.user_id =".$_REQUEST["user"];
												
											}											
										}
										if(isset($_REQUEST["status"]) && is_numeric($_REQUEST["status"])){
												$trang_thai = $_REQUEST["status"];
												$where_CV .= " AND trn_congviec.trangthai ='".$trang_thai."'"; 
											}
										if(isset($_REQUEST["tu_ngay"])){
											$tu_ngay = $_REQUEST["tu_ngay"];
											$where_CV .= " AND trn_congviec.DISORDER >='".$core_class->_formatdate($tu_ngay)." 00:00:00'"; 
										}
										if(isset($_REQUEST["den_ngay"])){
											$den_ngay = $_REQUEST["den_ngay"];
											$where_CV .= " AND trn_congviec.DISORDER <='".$core_class->_formatdate($den_ngay)." 23:59:59'"; 
										}
										
										$countCviec = $core_class->countColumnInTable("trn_congviec", "congviec_id",$where_CV);
									?>
									<span class="m-badge m-badge--danger">
										Tổng số : <?php echo $countCviec ?>
									</span>
								</span>
							</span>
						</span>
					</a>
				</li>
				<?php } ?>
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 4;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>			
				<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" data-menu-submenu-toggle="hover">
					<a href="archive.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon fa fa-book"></i>
						<span class="m-menu__link-text">
							Tài liệu chuyên khoa
						</span>
					</a>
				</li>
				<?php } ?>
				<li class="m-menu__section">
					<h4 class="m-menu__section-text">
						Quản lý kinh doanh
					</h4>
					<i class="m-menu__section-icon flaticon-more-v3"></i>
				</li>
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 12;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>		
				<li class="m-menu__item  m-menu__item--submenu">
					<a href="<?php echo $index ?>loaihinhcongviec.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon flaticon-puzzle"></i>
						<span class="m-menu__link-text">
							Quản lý banner
						</span>
					</a>
				</li>
				<?php } ?>
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 13;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>		
				<li class="m-menu__item  m-menu__item--submenu">
					<a href="<?php echo $index ?>donhang.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon flaticon-list-1"></i>
						<span class="m-menu__link-text">
							Quản lý đơn hàng
						</span>
					</a>
				</li>
				<li class="m-menu__item  m-menu__item--submenu">
					<a href="<?php echo $index ?>khuyenmai.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon flaticon-list-1"></i>
						<span class="m-menu__link-text">
							Quản lý khuyến mãi
						</span>
					</a>
				</li>
				<?php } ?>
				<li class="m-menu__section">
					<h4 class="m-menu__section-text">
						Hệ thống
					</h4>
					<i class="m-menu__section-icon flaticon-more-v3"></i>
				</li>
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 5;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>	
				<li class="m-menu__item  m-menu__item--submenu">
					<a href="<?php echo $index ?>loaihinhcongviec.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon flaticon-interface-9"></i>
						<span class="m-menu__link-text">
							Loại hình công việc
						</span>
					</a>
				</li>
				<?php } ?>	
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 6;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>			
				<li class="m-menu__item  m-menu__item--submenu">
					<a href="<?php echo $index ?>danhmuccongviec.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon flaticon-folder-2"></i>
						<span class="m-menu__link-text">
							Danh mục công việc
						</span>
					</a>
				</li>
				<?php } ?>	
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 6;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>			
				<li class="m-menu__item  m-menu__item--submenu">
					<a href="<?php echo $index ?>chuyenkhoa.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon flaticon-file-1"></i>
						<span class="m-menu__link-text">
							Chuyên khoa
						</span>
					</a>
				</li>
				<?php } ?>	
				<?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 7;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>	
					<li class="m-menu__item  m-menu__item--submenu">
						<a href="<?php echo $index ?>loaiphucloi.html" class="m-menu__link m-menu__toggle">
							<i class="m-menu__link-icon flaticon-coins"></i>
							<span class="m-menu__link-text">
								Loại phúc lợi
							</span>
						</a>
					</li>
					<?php } ?>
			   <?php   
					$quyen_han_list = $_SESSION["session"]["AUTH_PER"];
					$chucnang_list = $_SESSION["session"]["AUTH_FUNC"];    
					$chucnang = 11;
					if($core_class->_checkIdinArray( $chucnang, $chucnang_list )){
				?>		
				<li class="m-menu__item  m-menu__item--submenu">
					<a href="<?php echo $index ?>Employee.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon flaticon-users"></i>
						<span class="m-menu__link-text">
							Tạo tài khoản
						</span>
					</a>
				</li>
				<li class="m-menu__item  m-menu__item--submenu">
					<a href="<?php echo $index ?>dichvu.html" class="m-menu__link m-menu__toggle">
						<i class="m-menu__link-icon flaticon-gift"></i>
						<span class="m-menu__link-text">
							Tạo gói dịch vụ
						</span>
					</a>
				</li>
				<?php } ?>
			</ul>
		</div>
		<!-- END: Aside Menu -->
	</div>
	<!-- END: Left Aside -->
				
			