<?php 
$arraySource = array(
		'dist/component/dangtuyen/dangtuyen.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.min.js' => 'js',
		'dist/component/dangtuyen/dangtuyen.js' => 'js',
	);
	$core_class->loadSource($arraySource);
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
	.code_post
		{
			display:none;
		}
</style>
<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" 
	role="form" method="post" id="formDataInsert">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="required">Tên công việc:</label>
				<input type="text" name="tencongviec" class="form-control m-input" placeholder="Tên công việc" required maxlength='100'>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Người liên hệ:</label>
				<input type="text" name="nguoilienhe" class="form-control m-input" placeholder="Người liên hệ" required maxlength='50'>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required_">Email đăng tin:</label>
				<div class="input-group">
					
					<input type="text" class="form-control m-input" name="email" id="email" value="" data-role="tagsinput" size="150">
					
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
						""
					);
				?>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Loại hình công việc:</label>
				<?php
					echo $core_class->createCheckBox2(
						"mst_loaihinhcongviec", // table
						"loaihinhcongviec_id", // column1
						"tenloaihinhcongviec", // column2
						"required", // $attribute
						"", // where
						array(), // split, data
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
						""
					);
				?>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label>Độ tuổi:</label>
				<input type="text" name="dotuoi" class="form-control m-input" required maxlength="50">
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
						""
					);
				?>
				<input style='width:150px;float:left' type="text" 
					name="sonamkinhnghiem" 
					class="form-control m-input d_none sonamkinhnghiem" 
					placeholder="Số năm kinh nghiệm" 
					maxlength='20'>
				<div style="width:100%;float:left">
					<p class="has-error"></p>
				</div>
			</div>
			<div class="col-lg-4">
				<label class="required">Yêu cầu ngôn ngữ:</label>
				<?php
					echo $core_class->createCheckBox2(
						"mst_yeucauhoso", // table
						"yeucauhoso_id", // column1
						"tenyeucauhoso", // column2
						"required", // $attribute
						"", // where
						array(), // split, data
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
						""
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
						""
					);
				?>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Phúc lợi:</label>
				<?php
					echo $core_class->createCheckBox2(
						"mst_loaiphucloi", // table
						"loaiphucloi_id", // column1
						"tenloaiphucloi", // column2
						"required", // $attribute
						"", // where
						array(), // split, data
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
						"loaitien_id", // where
						array(),
						""
					);
				?>
				<p class="has-error"></p>
			</div>
			
		</div>
		<div class="form-group m-form__group row">
			
			<div class="col-lg-4">
				<label class="required">Mô tả công việc:</label>
				<textarea data-provide="markdown" name="motacongviec" class="form-control" required></textarea>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Chuyên môn yêu cầu:</label>
				<textarea data-provide="markdown" name="chuyenmonyeucau" class="form-control" required></textarea>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Tỉnh thành:</label>
				<div class="col-xl-12 col-lg-12">
					<select class="form-control m-select2" id="tinhthanh" name="noilamviec[]" multiple>
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
		</div>
		<div class="form-group m-form__group row">
		
			<div class="col-lg-4">
				<label>Quyền lợi:</label>
				<textarea data-provide="markdown" name="quyenloi" class="form-control"></textarea>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Yêu cầu hồ sơ:</label>
				<textarea data-provide="markdown" name="yeucauhoso" class="form-control"></textarea>
				<p class="has-error"></p>
			</div>
			<!--<div class="col-lg-4">
				<label class="required">Nộp hồ sơ:</label>
				<textarea data-provide="markdown" name="nophoso" class="form-control" required></textarea>
				<p class="has-error"></p>
			</div>-->
			<div class="col-lg-4">
				<label>Số lượng cần tuyển:</label>
				<input type="text" 
					name="soluongcantuyen" 
					class="form-control m-input"
					maxlength="50">
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			
			<div class="col-lg-4">
				<label class="required">Danh mục công việc:</label>
				<?php
					echo $core_class->createSelectDM("danhmuccv_id", "required", "ORDER BY DISORDER");
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
							""
						);
					?>
				</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="">Đăng hộ</label>
				<div class="m-checkbox-list">
					<label class="m-checkbox">
						<input name="dang_ho" value="1" class="dang_ho" type="checkbox">
						Check vào ô
						<span></span>
					</label>
				</div>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				<label class="">Ngày online:</label>
				<div class="input-group date">
					<input type="text" readonly
						value="<?php echo date("d/m/Y") ?>"
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
				<?php $next_due_date = date('d/m/Y', strtotime("+30 days")); ?>
				<div class="input-group date">
					<input type="text" readonly
						value="<?php echo $next_due_date ?>"
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
				<label class="">Trạng thái (<strong>POST BASIC</strong>):</label>
				<div class="m-checkbox-list">
					<label class="m-checkbox">
						<input name="trangthai" id="showCheckoutHistory" value="1" type="checkbox">
						Check vào ô
						<span></span>
					</label>
				</div>
				<p class="has-error"></p>
			</div>
		</div>
		<div class="form-group m-form__group row code_post">
			<div class="col-lg-4">
				<label class=""><strong>Nhập mã: </strong></label>
				<div class="m-checkbox-list">
					<label class="m-input">
						<input type="text" name="code_oder" autocomplete="off" data-autocomplete="code_oder"  id="code_oder" class="form-control m-input" maxlength="50">
						<div class="tt-menu" style="position: absolute;top: 100%;z-index: 100;display:none">
                                    <div class="loadSuggess tt-dataset tt-dataset-states">
									</div>
						</div>
					</label>
				</div>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-8" id="show_dichvu">
			</div>
			<!--<div class="col-lg-4">
				<label class="">Nút ứng tuyển:</label>
				<div class="m-checkbox-list">
					<label class="m-checkbox">
						<input name="btn_ungtuyen" value="1" <?php echo !empty($row['btn_ungtuyen']) ? 'checked' : '' ?> type="checkbox">
						Check vào ô
						<span></span>
					</label>
				</div>
				<p class="has-error"></p>
			</div>-->
		</div>
	</div>
	<input type="hidden" name="act" value="insert_job">
</form>
<script>
	$('#formDataInsert .m_selectpicker').val();
	$('#formDataInsert .m_selectpicker').selectpicker();
	$(".currency").keyup(function(){
		$(this).val(format($(this).val()));
	});
	/* $(document).on("click",".service_id", function(){
			let parent = $(this).parents('label').first();
			var isChecked = $(this).prop("checked");
			if(isChecked)
			{
				
				parent.find(".quantity_sty").show();
				parent.find(".quantity").attr('name', 'quantity[]');
				parent.find(".service_id_2").attr('name', 'service_id[]');

			}else{
				parent.find(".quantity_sty").hide();
				parent.find(".quantity").removeAttr("name");
				parent.find(".service_id_2").removeAttr('name', 'service_id[]');
			}
	   }) */
	jQuery(document).ready(function(){
		//$("textarea").markdown({
		//	target_form   : ".markdown"
		//});
		
	   	$('input[name="dang_ho"]').click(function(){
			  if($(this).is(":checked")){
					/* $('input[name="power_job"]').prop('disabled', false);   
				    $('input[name="hot_job"]').prop('disabled', false);*/
				    $('.code_post').show();
			  }
			  else if($(this).is(":not(:checked)")){
				  $('.code_post').hide();
				/*  $('input[name="power_job"]').prop('disabled', true);
				 $('input[name="hot_job"]').prop('disabled', true); */
				 
			  }
			});
		$("input, select, textarea").change(function(){
			$(this).parents("div[class^='col']").find("p.has-error").html('');
		})
		
		var danhmuccv_id = $("[name=danhmuccv_id]").val();

		loadChuyenKhoa(danhmuccv_id);
		$("[name=danhmuccv_id]").change(function(){
			var values = $(this).val();
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
	$("[name=kinhnghiem_id]").change(function(){
		var values = $(this).val();	
		if(values != 2){
			$('.sonamkinhnghiem').css('display','none');
			$('.sonamkinhnghiem').removeAttr('required');
		}else{
			$('.sonamkinhnghiem').css('display','block');
			$('.sonamkinhnghiem').attr('required',true);
		}
	})
	function loadChuyenKhoa(values){
		$.ajax({
			url: "Model_congviec.ajax",
			type: "POST",
			data: {
				act : "loadchuyenkhoa",
				danhmuccv_id : values,
				congviec_id: <?php echo empty($_REQUEST["id"]) ? 0 : $_REQUEST["id"] ?>
			},
			success: function(result){
				$(".chuyenkhoa").html(result);
				$("[name=chuyenkhoa_id]").selectpicker();
			}
		})
	}

</script>