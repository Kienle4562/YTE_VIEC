<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	$title = "Cập Nhật Thông Tin Công Ty";
	$action = "Update";
	$btn = "Cập nhật";
	$row = $core_class->find("trn_congty", array(
		'congty_id',
		'tencongty',
		'sdthoai',
		'nguoilienhe',
		'quymo_id',
		'hinhanh',
		'web',
		'chude',
		'diachicongty',
		'banner',
		'urlfacebook',
		'gioithieungan',
		'idyoutube',
		'loaihinhhoatdong_id',
		'tinhthanh_id'
	), array(
		'email' => $_SESSION["session"]["Tendangnhap"]
	));
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<div class="m-content">
		<div class="m-portlet">
			<div class="m-portlet__head">
				<div class="m-portlet__head-caption">
					<div class="m-portlet__head-title">
						<span class="m-portlet__head-icon m--hide">
							<i class="la la-gear"></i>
						</span>
						<h3 class="m-portlet__head-text">
							<?php echo $title ?>
						</h3>
					</div>
				</div>
			</div>
			<!--begin::Form-->
			<form id="m_form" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
				<div class="m-portlet__body">
					<div class="form-group m-form__group row">
						<div class="col-lg-3">
							<label class="required">Tên cơ quan doanh nghiệp:</label>
							<div class="m-input-icon m-input-icon--left">
								<input required type="text" id="tencongty" name="tencongty" class="form-control m-input" placeholder="Tên công ty" maxlength="50" value="<?php echo $row['tencongty'] ?>">
								<p class="has-error"></p>
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-building"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="col-lg-3">
							<label class="required">Email:</label>
							<div class="m-input-icon m-input-icon--left">
								<input required value="<?php echo $_SESSION["session"]["Tendangnhap"] ?>" type="text" disabled="disabled" class="form-control m-input"/>
								<p class="has-error"></p>
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-internet-explorer"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="col-lg-3">
							<label class="required">Số điện thoại:</label>
							<div class="m-input-icon m-input-icon--left">
								<input required value="<?php echo $row['sdthoai'] ?>" id="sdthoai" name="sdthoai" type="text" class="form-control m-input"/>
								<p class="has-error"></p>
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-phone"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="col-lg-3">
							<label class="required">Người liên hệ:</label>
							<div class="m-input-icon m-input-icon--left">
								<input required type="text" id="nguoilienhe" name="nguoilienhe" value="<?php echo $row['nguoilienhe'] ?>" class="form-control m-input"/>
								<p class="has-error"></p>
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-user"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="col-lg-3">
							<label class="">Quy mô công ty:</label>
							<?php
								echo $core_class->createSelectBox5(
									"mst_quymo",
									"quymo_id",
									"tenquymo",
									"required", // $attribute
									"form-control",
									"quymo_id", // name
									"", // where
									array(),
									$row['quymo_id']
								);
							?>
							<p class="has-error"></p>
						</div>
						<div class="col-lg-3">
							<label class="">Website công ty:</label>
							<div class="m-input-icon m-input-icon--left">
								<input type="text" id="web" name="web" value="<?php echo $row['web'] ?>" maxlength="50" class="form-control m-input"/>
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-globe"></i>
									</span>
								</span>
							</div>
							<p class="has-error"></p>
						</div>
						<div class="col-lg-3">
							<label class="required">Địa chỉ công ty:</label>
							<div class="m-input-icon m-input-icon--left">
								<input required type="text" id="diachicongty" value="<?php echo $row['diachicongty'] ?>" name="diachicongty" maxlength="100" class="form-control m-input"/>
								<p class="has-error"></p>
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="flaticon-map-location"></i>
									</span>
								</span>
							</div>
						</div>
						<div class="col-lg-3">
							<label class="">URL Facebook:</label>
							<div class="m-input-icon m-input-icon--left">
								<input type="text" id="urlfacebook" name="urlfacebook" value="<?php echo $row['urlfacebook'] ?>" maxlength="100" class="form-control m-input"/>
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-facebook-official"></i>
									</span>
								</span>
							</div>
							<span class="m-form__help">
								Là địa chỉ fanpage facebook hay trang facebook cá nhân, VD: https://www.facebook.com/zuck
							</span>
							<p class="has-error"></p>
						</div>
						<div class="col-lg-3">
							<label class="">Video Youtube:</label>
							<div class="m-input-icon m-input-icon--left">
								<input type="text" id="idyoutube" name="idyoutube" value="<?php echo $row['urlfacebook'] ?>" maxlength="50" class="form-control m-input"/>
								<span class="m-input-icon__icon m-input-icon__icon--left">
									<span>
										<i class="la la-youtube-play"></i>
									</span>
								</span>
							</div>
							<span class="m-form__help">
								Là id video của bạn trên Youtube.com, VD: https://www.youtube.com/watch?v=B0aTg5s1c2c ID sẽ là <code>B0aTg5s1c2c</code>
							</span>
							<p class="has-error"></p>
						</div>
						<div class="col-lg-3">
							<label class="required">Loại hình hoạt động:</label>
							<?php
		
								echo $core_class->createSelectBox5(
									"mst_loaihinhhoatdong",
									"loaihinhhoatdong_id",
									"tenloaihinhhoatdong",
									"required", // $attribute
									"form-control",
									"loaihinhhoatdong_id", // name
									"", // where
									array(),
									$row['loaihinhhoatdong_id']
								);
							?>
							<p class="has-error"></p>
						</div>
						<div class="col-lg-3">
							<label class="required">Tỉnh thành:</label>
							 <?php
									echo $core_class->createSelectBox5(
										"mst_tinhthanh",
										"id",
										"ten_tinhthanh",
										"required", // $attribute
										"form-control",
										"tinhthanh_id", // name
										"", // where
										array(),
										$row['tinhthanh_id']
									);
							?>
							<p class="has-error"></p>
						</div>
						<div class="col-lg-3">
							<label class="">Ảnh đại diện công ty (Logo):</label>
							<input accept="image/*" type="file" id="file_hinhanh" name="file_hinhanh" class="form-control">
							<div style="display:none" class="progressLoadImg_hinhanh m-loader m-loader--danger" style="width: 30px; display: inline-block;"></div>
							<div class="loadImg">
								<img class="m_top_10" id="hinhanh" width=100% src="<?php if(!empty($row['hinhanhcongty1'])){ echo $row['hinhanhcongty1'];}else{ echo 'image/noimage.jpg' ;} ?>"/>
								
							</div>
							<input name="hinhanh" type="hidden">
							<span class="m-form__help">
								Logo kích thước : 100px X 100px
							</span>
							<p class="has-error"></p>
						</div>
						<div class="col-lg-3">
							<label class="">Banner công ty:</label>
							<input accept="image/*" type="file" id="file_banner" name="file_banner" class="form-control">
							<div style="display:none" class="progressLoadImg_banner m-loader m-loader--danger" style="width: 30px; display: inline-block;"></div>
							<div class="loadImg">
								<img class="m_top_10" id="banner" width=100% src="<?php if(!empty($row['banner'])){ echo $row['banner'];}else{ echo 'image/noimage.jpg' ;} ?>"/>
							</div>
							<input name="banner" type="hidden">
							<span class="m-form__help">
								Kích thước : 1350px X 570px
							</span>
							<p class="has-error"></p>
						</div>
						<div class="col-lg-12">
							<label class="">Giới thiệu ngắn:</label>
							<textarea rows="9" data-provide="markdown" class="form-control m-input" name="gioithieungan"><?php echo $row['gioithieungan'] ?></textarea>
							<!--<textarea id="m_summernote_1" class="summernote form-control m-input" name="gioithieungan" ><?php echo $row['gioithieungan'] ?></textarea>-->
							<p class="has-error"></p>
						</div>
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions--solid">
						<div class="row">
							<div class="col-lg-5"></div>
							<div class="col-lg-7">
								<button type="button" id="UpdateThongTinCongTy" data-wizard-action="submit" class="btn btn-brand">
									<?php echo $btn ?>
								</button>
								<button type="button" onclick="window.location='.'" class="btn btn-secondary">
									Thoát ra
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<!--end::Form-->
		</div>
	</div>
</div>
<script src="dist/assets/web/custom/components/forms/widgets/summernote.js" type="text/javascript"></script>
<script src="dist/assets/web/custom/components/forms/wizard/congty.js" type="text/javascript"></script>
<script>
	function loadDataEdit(com_name){
		// $.getJSON('Model_'+com_name+'.ajax?act=LoadDataEdit', function(data) {
			// for (var i in data) {
				// var $el = $('#m_form [name="'+i+'"]'),
				// type = $el.attr('type');
				// if(isNaN(data[i]) == false && i.indexOf("dongia") >= 0){
					// data[i] = format(data[i]);
				// }
				// switch(type){
					// case 'checkbox':
						// $el.prop('checked', false);
						// if(data[i] == 1){
							// $el.prop('checked', true);
						// }
					// break;
					// case 'radio':
						// $el.prop('checked', false);
						// $el.filter('[value="'+data[i]+'"]').prop('checked', true);
					// break;
					// case 'hidden':
						// if(data[i].length == 0){
							// data[i] = "image/noimage.jpg";
						// }
						// $('#m_form img#'+i).attr("src", data[i]);
						// $('#m_form input[name="'+i+'"][type=hidden]').val(data[i]);
						// $('#m_form input[name="'+i+'"][type=file]').val(data[i]);
					// break;
					// default: 
						// $('#m_form input[name="'+i+'"],#m_form select[name="'+i+'"],#m_form textarea[name="'+i+'"]').val(data[i]).change();
				// }
			// }
		// });
	}
	loadDataEdit('congty');
jQuery(document).ready(function() {
	$('input[type=file]').on('change', function(event){
		uploadImage(event, '<?php echo $com_name ?>', this.id, 1);
	});

	$("input:invalid").on("keyup", function(){
		$("input:valid").next("p.has-error").empty();
	})
});
</script>