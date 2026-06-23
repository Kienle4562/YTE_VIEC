<?php 
	$arraySource = array(
		'dist/component/dangtuyen/dangtuyen.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.min.js' => 'js',
	);
	$core_class->loadSource($arraySource);
?>
<?php

	$congviec_id = $_POST['congviec_id'];
	$row = $core_class->find("trn_congviec", array(
		'congviec_id',
		'tencongviec',
		'nguoilienhe',
		'email',
		'congty_id',
		'loaihinhcongviec_id',
		'gioitinh_id',
		'dotuoi',
		'kinhnghiem_id',
		'sonamkinhnghiem',
		'yeucauhoso_id',
		'capbac_id',
		'bangcap_id',
		'phucloi_id',
		'mucluongtoithieu',
		'mucluongtoida',
		'loaitien_id',
		'tinhthanh_id',
		'tentinhthanh',
		'noilamviec',
		'motacongviec',
		'chuyenmonyeucau',
		'quyenloi',
		'yeucauhoso',
		'nophoso',
		'soluongcantuyen',
		'danhmuccv_id',
		'chuyenkhoa_id',
		'chuyenkhoakhac',
		'ngaydang',
		'ngayhethan',
		'goiy',
		'trangthai',
		'vip',
	), array(
		'congviec_id' => $congviec_id
	))
?>
<style>
	.bootstrap-tagsinput{
		width: 100%;
	}
	.m-typeahead .twitter-typeahead{
		position: relative;
		display: inline-block !important;
		width: 100px;
	}
</style>
<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" 
	role="form" method="post" id="formDataCopy">
	<input type="hidden" name="valueCKhac" value="<?php echo $row['chuyenkhoakhac'] ?>">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="required">Tên công việc (ID: <?php echo $row['congviec_id'] ?> ) :</label>
				<input type="text" value="<?php echo $row['tencongviec'] ?>" name="tencongviec" class="form-control m-input" placeholder="Tên công việc" required maxlength='100'>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Người liên hệ:</label>
				<input type="text" value="<?php echo $row['nguoilienhe'] ?>" name="nguoilienhe" class="form-control m-input" placeholder="Người liên hệ" required maxlength='50'>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required_">Email đăng tin:</label>
				<div class="input-group">
					<input type="email" value="<?php echo $row['email'] ?>" name="email" class="form-control m-input" placeholder="Email đăng tin" maxlength='100'>
					<div class="input-group-append">
						<span class="input-group-text">
							<i class="fa fa-envelope-o"></i>
						</span>
					</div>
				</div>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="required">Tên công ty:</label>
				<?php
					echo $core_class->createSelectBox5(
						"trn_congty",
						"congty_id",
						"tencongty",
						"required", // $attribute
						"form-control m-bootstrap-select m_selectpicker",
						"congty_id", // name
						"", // where
						array(),
						$row['congty_id'] // selected
					);
				?>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Loại hình công việc:</label>
				<?php
					$loaihinhcongviec_id = str_replace("/","|",$row['loaihinhcongviec_id']);
					echo $core_class->createCheckBox2(
						"mst_loaihinhcongviec", // table
						"loaihinhcongviec_id", // column1
						"tenloaihinhcongviec", // column2
						"required", // $attribute
						"", // where
						array('|', $loaihinhcongviec_id), // split, data
						"", // content
						"loaihinhcongviec_id[]"
					);
				?>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Giới tính:</label>
				<?php
					echo $core_class->createSelectBox5(
						"mst_gioitinh",
						"gioitinh_id",
						"gioitinh",
						"required", // $attribute
						"form-control",
						"gioitinh_id", // name
						"", // where
						array(),
						$row['gioitinh_id']
					);
				?>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label>Độ tuổi:</label>
				<input type="text" name="dotuoi" value="<?php echo $row['dotuoi'] ?>" class="form-control m-input" required maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required w100">Yêu cầu kinh nghiệm:</label>
				<?php
					echo $core_class->createSelectBox5(
						"mst_kinhnghiem",
						"kinhnghiem_id",
						"tenkinhnghiem",
						"style='width:200px;float:left;margin-right:10px' required", // $attribute
						"form-control",
						"kinhnghiem_id", // name
						"", // where
						array(),
						$row['kinhnghiem_id']
					);
				?>
				<input style='width:150px;float:left' type="text"
					value="<?php echo $row['sonamkinhnghiem'] ?>"
					name="sonamkinhnghiem" 
					class="form-control m-input d_none sonamkinhnghiem"
					placeholder="Số năm kinh nghiệm" 
					maxlength='20'>
				<div style="width:100%;float:left">
					<p class="has-error"></p>
				</div>
			</div>
			<div class="col-lg-4">
				<label class="required">Yêu cầu hồ sơ:</label>
				<?php
					$yeucauhoso_id = str_replace("/","|",$row['yeucauhoso_id']);
					echo $core_class->createCheckBox2(
						"mst_yeucauhoso", // table
						"yeucauhoso_id", // column1
						"tenyeucauhoso", // column2
						"required", // $attribute
						"", // where
						array('|', $yeucauhoso_id), // split, data
						"", // content
						"yeucauhoso_id[]"
					);
				?>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="required">Cấp bậc:</label>
				<?php
					echo $core_class->createSelectBox5(
						"mst_capbac",
						"capbac_id",
						"tencapbac",
						"required", // $attribute
						"form-control",
						"capbac_id", // name
						"", // where
						array(),
						$row['capbac_id']
					);
				?>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Bằng cấp:</label>
				<?php
					echo $core_class->createSelectBox5(
						"mst_bangcap",
						"bangcap_id",
						"tenbangcap",
						"required", // $attribute
						"form-control",
						"bangcap_id", // name
						"", // where
						array(),
						$row['bangcap_id']
					);
				?>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Phúc lợi:</label>
				<?php
					$phucloi_id = str_replace("/","|",$row['phucloi_id']);
					echo $core_class->createCheckBox2(
						"mst_loaiphucloi", // table
						"loaiphucloi_id", // column1
						"tenloaiphucloi", // column2
						"required", // $attribute
						"", // where
						array('|', $row['phucloi_id']), // split, data
						"", // content
						"phucloi_id[]"
					);
				?>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label>Mức lương tối thiểu:</label>
				<input type="text"
					value="<?php echo number_format($row['mucluongtoithieu'], 0) ?>"
					name="mucluongtoithieu" 
					class="form-control m-input currency"
					oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
					maxlength="15">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Mức lương tối đa:</label>
				<input type="text" 
					name="mucluongtoida"
					value="<?php echo number_format($row['mucluongtoida'], 0) ?>"
					class="form-control m-input currency"
					oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
					maxlength="15">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Loại tiền tệ:</label>
					<?php
					echo $core_class->createSelectBox5(
						"mst_loaitien",
						"loaitien_id",
						"tenloaitien",
						"form-control",
						"loaitien_id", // name
						"", // where
						array(),
						$row['loaitien_id']
					);
				?>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<!--<div class="col-lg-4">
				<label class="required">Nơi làm việc:</label>
				<textarea data-provide="markdown" name="noilamviec" class="form-control" required><?php echo $row['noilamviec'] ?></textarea>
				<p class="has-error"></p>
			</div>-->
			<div class="col-lg-4">
				<label class="required">Tỉnh thành:</label>
				<div class="col-xl-12 col-lg-12">
					<script>
						$(document).ready(function(){
								var dataTH = '<?php echo $row['tentinhthanh'] ?>';
								var tinhthanhArray = dataTH.split(",");
				
							$("#tinhthanhcopy").val(tinhthanhArray).trigger('change');
						});
					</script>
					<select class="form-control m-select2" id="tinhthanhcopy" name="noilamviec[]" multiple>
						<?php
								
								$myprocess = new process();
								$rsTT = $myprocess->loadTinhThanh();
								while($rowTT = $rsTT->fetch())
						{?>
								<option value="<?php echo $rowTT['ten_tinhthanh'] ?>"><?php echo $rowTT['ten_tinhthanh'] ?></option>		
					   <?php	} 
							?>
					</select>
				</div>
				
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Mô tả công việc:</label>
				<textarea data-provide="markdown" name="motacongviec" class="form-control" required><?php echo $row['motacongviec'] ?></textarea>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Chuyên môn yêu cầu:</label>
				<textarea data-provide="markdown" name="chuyenmonyeucau" class="form-control" required><?php echo $row['chuyenmonyeucau'] ?></textarea>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label>Quyền lợi:</label>
				<textarea data-provide="markdown" name="quyenloi" class="form-control"><?php echo $row['quyenloi'] ?></textarea>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Yêu cầu hồ sơ:</label>
				<textarea data-provide="markdown" name="yeucauhoso" class="form-control"><?php echo $row['yeucauhoso'] ?></textarea>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Nộp hồ sơ:</label>
				<textarea data-provide="markdown" name="nophoso" class="form-control" required><?php echo $row['nophoso'] ?></textarea>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label>Số lượng cần tuyển:</label>
				<input type="text"
					value="<?php echo $row['soluongcantuyen'] ?>"
					name="soluongcantuyen"
					class="form-control m-input"
					maxlength="50">
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Danh mục công việc:</label>
				<?php
					echo $core_class->createSelectBox5(
						"trn_danhmuccv",
						"danhmuccv_id",
						"tendanhmuccv",
						"required", // $attribute
						"form-control m-bootstrap-select m_selectpicker",
						"danhmuccv_id", // name
						"", // where
						array(),
						$row['danhmuccv_id']
					);
				?>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required"><span class="lbaction"> Chọn chuyên khoa </span></label>
				<div class="chuyenkhoa">
					<?php
					echo $core_class->createSelectBox5(
						"mst_chuyenkhoa",
						"chuyenkhoa_id",
						"chuyenkhoa_name",
						"required", // $attribute
						"form-control m-bootstrap-select m_selectpicker",
						"chuyenkhoa_id", // name
						"", // where
						array(),
						$row['chuyenkhoa_id']
					);
				?>
				</div>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="">Ngày đăng:</label>
				<div class="input-group date">
					<input type="text" readonly
						value="<?php echo date("d/m/Y", strtotime($row['ngaydang'])) ?>"
						name="ngaydang" 
						class="form-control m-input datepicker">

					<div class="input-group-append">
						<span class="input-group-text">
							<i class="la la-calendar-check-o"></i>
						</span>
					</div>
					<p class="has-error"></p>
				</div>
			</div>
			<div class="col-lg-4">
				<label class="">Ngày hết hạn:</label>
				<div class="input-group date">
					<input type="text" readonly
						value="<?php echo date("d/m/Y", strtotime($row['ngayhethan'])) ?>"
						name="ngayhethan" 
						class="form-control m-input datepicker">

					<div class="input-group-append">
						<span class="input-group-text">
							<i class="la la-calendar-check-o"></i>
						</span>
					</div>
					<p class="has-error"></p>
				</div>
			</div>
			<div class="col-lg-4">
				<label class="">Gợi ý người dùng:</label>
				<div class="m-checkbox-list">
					<label class="m-checkbox">
						<input name="goiy" <?php echo !empty($row['goiy']) ? 'checked' : '' ?> value="1" type="checkbox">
						Check vào ô
						<span></span>
					</label>
				</div>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="">Trạng thái:</label>
				<div class="m-checkbox-list">
					<label class="m-checkbox">
						<input name="trangthai" <?php echo !empty($row['trangthai']) ? 'checked' : '' ?> value="1" type="checkbox">
						Check vào ô
						<span></span>
					</label>
				</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="">Hàng đầu:</label>
				<div class="m-checkbox-list">
					<label class="m-checkbox">
						<input name="vip" value="1" <?php echo !empty($row['vip']) ? 'checked' : '' ?> type="checkbox">
						Check vào ô
						<span></span>
					</label>
				</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="">Nút ứng tuyển:</label>
				<div class="m-checkbox-list">
					<label class="m-checkbox">
						<input name="btn_ungtuyen" value="1" <?php echo !empty($row['btn_ungtuyen']) ? 'checked' : '' ?> type="checkbox">
						Check vào ô
						<span></span>
					</label>
				</div>
				<p class="has-error"></p>
			</div>
		</div>
	</div>
	<input type="hidden" name="act" value="insert_job">
	<input type="hidden" name="congviec_id" value="<?php echo $row['congviec_id'] ?>">
	<input type="hidden" name="ck_id" value="<?php echo $row['chuyenkhoa_id'] ?>">
</form>

<script>
	$('#formDataCopy .m_selectpicker').val();
	$('#formDataCopy .m_selectpicker').selectpicker();
	$(".currency").keyup(function(){
		$(this).val(format($(this).val()));
	});
	jQuery(document).ready(function(){
		//$("textarea").markdown({
		//	target_form   : ".markdown"
		//});

		$("input, select, textarea").change(function(){
			$(this).parents("div[class^='col']").find("p.has-error").html('');
		})
		
		
		
		$("input:checkbox[required]").change(function(){
			var nameElm = $(this).attr("name");
			var groupChecked = $("[name='"+nameElm+"']:checked").length;
			if(groupChecked > 0){
				$(this).parents("div[class^='col']").find("input:checkbox").removeAttr("required");
			}else{
				$(this).parents("div[class^='col']").find("input:checkbox").prop("required", true);
			}
		})
	});
	
		function substringMatcher(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;

                // an array that will be populated with substring matches
                matches = [];

                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');

                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                    if (substrRegex.test(str)) {
                        matches.push(str);
                    }
                });

                cb(matches);
            };
        };
	checkSNKN();
	function checkSNKN(){
		var values = $('[name=kinhnghiem_id]').val();	
		if(values != 2){
			$('.sonamkinhnghiem').css('display','none');
		
		}else{
			$('.sonamkinhnghiem').css('display','block');
		}
	}
	
	$("[name=kinhnghiem_id]").change(function(){
		checkSNKN();
	})
	 var danhmuccv_id = $("[name=danhmuccv_id]").val();
	   var valueckhac = $("[name=ck_id]").val();
	   var valueCKhac_in = $("[name=valueCKhac]").val();
		loadChuyenKhoa(danhmuccv_id,valueckhac);
		$("[name=danhmuccv_id]").change(function(){
			var values = $(this).val();
			var valueckhac = '';
			if(values == 1)
			{
				$('.lbaction').text("Chọn chuyên khoa");
			}else if(values == 99)
			{
				$('.lbaction').text("Nhập chuyên ngành");
			}else
			{
				$('.lbaction').text("Chọn chuyên ngành");
			}
			loadChuyenKhoa(values);
		})
	function loadChuyenKhoa(values,valueckhac){
		$.ajax({
			url: "Model_congviec.ajax",
			type: "POST",
			data: {
				act : "loadchuyenkhoa",
				danhmuccv_id : values,
				valueckhac : valueckhac,
				textkhac : valueCKhac_in,
				congviec_id: <?php echo empty($_REQUEST["id"]) ? 0 : $_REQUEST["id"] ?>
			},
			success: function(result){
				$(".chuyenkhoa").html(result);
				$("[name=chuyenkhoa_id]").selectpicker();
			}
		})
	}
</script>