<?php
	$arraySource = array(
		'dist/component/congty/dangtuyen.css' => 'css',
		'dist/component/congty/bootstrap-tagsinput.css' => 'css',
		'dist/component/congty/bootstrap-tagsinput.min.js' => 'js',
		'dist/component/congty/bootstrap-markdown.js' => 'js',
	);
	$core_class->loadSource($arraySource);
	$congty_id = $_POST['congty_id'];
	$row = $core_class->find("trn_congty", array(
		'congty_id',
		'tencongty',
		'loaihinhhoatdong_id',
		'loaihinhhoatdongkhac',
		'loaihinhhoatdong2_id',
		'loaihinhhoatdongkhac2',
		'loaihinhhoatdong3_id',
		'loaihinhhoatdongkhac3',
		'email',
		'guimail',
		'password',
		'trangthai',
		'hien_thi',
		'nguoilienhe',
		'quymo_id',
		'bvhangdau',
		'hinhanh',
		'web',
		'chude',
		'diachicongty',
		'sdthoai',
		'tinhthanh_id',
		'banner',
		'gpkd',
		'urlfacebook',
		'gioithieungan',
		'idyoutube',
		'hinhanhcongty1',
		'hinhanhcongty2',
		'hinhanhcongty3',
		'pin',
		'follow',
		'ghi_chu_nb',
		'user_update',
		
	), array(
		'congty_id' => $congty_id
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
	#country-list{float:left;list-style:none;margin-top:-3px;padding:0;width:360px;position: absolute;z-index: 99;}
	#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
	#country-list li:hover{background:#ece3d2;cursor: pointer;}
	#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}
</style>
<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" 
	role="form" method="post" id="formDataUpdate">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
   <div class="col-lg-4">
      <label class="required">Tên công ty:</label>
		<input type="text" id="tencongty" name="tencongty" class="form-control m-input" placeholder="Tên công ty"  required maxlength="100" value ="<?php echo $row['tencongty'] ?>" onchange="autocompleter()">
		<div id="suggesstion-box"></div>
	  <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
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
   <div class="col-lg-4">
      <label class="">Loại hình hoạt động khác:</label>
		<input type="text" value ="<?php echo $row['loaihinhhoatdongkhac'] ?>" id="loaihinhhoatdongkhac" name="loaihinhhoatdongkhac" class="form-control m-input" placeholder="Loại hình hoạt động khác" maxlength="100">
		
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
      <label class="">Email:</label>
      <div class="input-group">
         <input type="email" id="email" value ="<?php echo $row['email'] ?>" name="email" class="form-control m-input" placeholder="Email" maxlength="100">
         <div class="input-group-append">
			<span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
		</div>
      </div>
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
      <label class="">Mật khẩu:</label>
      <div class="input-group">
         <input type="password" id="password" name="password" class="form-control m-input" placeholder="Mật khẩu">
		  <input type="hidden" id="password_2" name="password_2" class="form-control m-input" placeholder="Mật khẩu" value='<?php echo $row['password']?>'>
         <div class="input-group-append">
			<span class="input-group-text"><i class="fa fa-lock"></i></span>
		 </div>
      </div>
      <p class="has-error"></p>
   </div>
    <div class="col-lg-4">
      <label class="required">Người liên hệ:</label>
		<input type="text" id="nguoilienhe" value ="<?php echo $row['nguoilienhe'] ?>" name="nguoilienhe" class="form-control m-input" placeholder="Người liên hệ" required maxlength="100">
		
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
      <label class="">Trạng thái(activer):</label>
      <div class="m-checkbox-list">
		<label class="m-checkbox">
			<input id="trangthai" name="trangthai" value="1" <?php echo !empty($row['trangthai']) ? 'checked' : '' ?> type="checkbox"> Check vào ô<span></span>
		</label>
	 </div>
      <p class="has-error"></p>
   </div>
     <div class="col-lg-4">
      <label class="">Hiển thị:</label>
      <div class="m-checkbox-list">
		<label class="m-checkbox">
			<input id="trangthai" name="hien_thi" value="1" <?php echo !empty($row['hien_thi']) ? 'checked' : '' ?> type="checkbox"> Check vào ô<span></span>
		</label>
	 </div>
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
      <label>Gửi mail:</label>
      <div class="m-checkbox-list">
		<label class="m-checkbox">
			
			<input id="guimail" name="guimail" value="1" <?php echo !empty($row['guimail']) ? 'checked' : '' ?> type="checkbox"> Check vào ô<span></span>
		</label>
	  </div>
      <p class="has-error"></p>
   </div>
  
   <div class="col-lg-4">
      <label class="">Hàng đầu:</label>
      <div class="m-checkbox-list"><label class="m-checkbox">
	
		<input id="bvhangdau"  name="bvhangdau"  value ="1" <?php echo !empty($row['bvhangdau']) ? 'checked' : '' ?>  type="checkbox" >Check vào ô<span></span></label></div>
    
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
      <label class="">Ghim vị trí:</label>
      <div class="m-checkbox-list">
		<label class="m-checkbox">
			<input id="pin" name="pin" value="1" <?php echo !empty($row['pin']) ? 'checked' : '' ?> type="checkbox"> Check vào ô<span></span>
		</label>
	 </div>
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
      <label class="required">Quy mô công ty:</label>
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
   
   <div class="col-lg-4">
      <label class="">Website công ty:</label>
      <div class="input-group">
         <input type="url" id="web" name="web" class="form-control m-input"  value ="<?php echo $row['web'] ?>" placeholder="Nhập theo định hạng http://...." maxlength="100">
         <div class="input-group-append"><span class="input-group-text"><i class="fa fa-globe"></i></span></div>
      </div>
     
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
		  <label class="">Facebook:</label>
		  <div class="input-group">
			 <input type="url" id="urlfacebook" value ="<?php echo $row['urlfacebook'] ?>"  name="urlfacebook" class="form-control m-input" placeholder="Nhập theo định hạng http://...." maxlength="100">
			 <div class="input-group-append"><span class="input-group-text"><i class="fa fa-globe"></i></span></div>
		  </div>
		
		  <p class="has-error"></p>
	</div>
   <div class="col-lg-4">
      <label class="">Chủ đề:</label><input id="chude" name="chude" type="color" value="<?php echo $row['chude'] ?>">
	  
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
      <label class="required">Địa chỉ công ty:</label><input type="text" id="diachicongty" name="diachicongty" value ="<?php echo $row['diachicongty'] ?>" class="form-control m-input" placeholder="Địa chỉ công ty" required="" maxlength="100">
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
      <label class="required">Số điện thoại:</label><input type="text" id="sdthoai" name="sdthoai" value ="<?php echo $row['sdthoai'] ?>" class="form-control m-input" placeholder="Số điện thoại" required="" maxlength="20">
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
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
	   <div class="col-lg-4">
			<label class="">Logo:</label><input accept="image/*" type="file" id="file_hinhanh" name="file_hinhanh" class="form-control" placeholder="Logo">
			<div style="display:none" class="progressLoadImg_hinhanh m-loader m-loader--danger"></div>
			<div class="loadImg"><img class="m_top_10" id="hinhanh" width="100%" src="<?php if(!empty($row['hinhanh'])){ echo $row['hinhanh'];}else{ echo 'image/noimage.jpg' ;} ?>"></div>
			<input id="hinhanh" name="hinhanh" type="hidden" value="<?php if(!empty($row['hinhanh'])){ echo $row['hinhanh'];}else{ echo 'image/noimage.jpg' ;} ?>">
			<p class="has-error"></p>
   		</div>
	   <div class="col-lg-4">
		  <label class="">Banner công ty:</label><input accept="image/*" type="file" id="file_banner" name="file_banner" class="form-control" placeholder="Banner công ty">
		  <div style="display:none" class="progressLoadImg_banner m-loader m-loader--danger"></div>
		  <div class="loadImg"><img class="m_top_10"  id="banner" width="100%" src="<?php if(!empty($row['banner'])){ echo $row['banner'];}else{ echo 'image/noimage.jpg' ;} ?>"></div>
		  <input id="banner" name="banner" value="<?php if(!empty($row['banner'])){ echo $row['banner'];}else{ echo 'image/noimage.jpg' ;} ?>"  type="hidden">
		  
		  <p class="has-error"></p>
	   </div>
	   <div class="col-lg-4">
		  <label class="">Giấy phép kinh doanh:</label><input accept="image/*" type="file" id="file_gpkd" name="file_gpkd" class="form-control" placeholder="Giấy phép kinh doanh">
		  <div style="display:none" class="progressLoadImg_banner m-loader m-loader--danger"></div>
		  <div class="loadImg"><img class="m_top_10"  id="gpkd" width="100%" src="<?php if(!empty($row['gpkd'])){ echo $row['gpkd'];}else{ echo 'image/noimage.jpg' ;} ?>"></div>
		  <input id="gpkd" name="gpkd" value="<?php if(!empty($row['gpkd'])){ echo $row['gpkd'];}else{ echo 'image/noimage.jpg' ;} ?>"  type="hidden">
		  
		  <p class="has-error"></p>
	   </div>
	   <div class="col-lg-4">
		  <label class="">Hình ảnh công ty 1:</label>
		  <input accept="image/*" type="file" id="file_hinhanhcongty1" name="file_hinhanhcongty1" class="form-control" placeholder="Hình ảnh công ty 1" >
		  <div style="display:none" class="progressLoadImg_hinhanhcongty1 m-loader m-loader--danger"></div>
		  <div class="loadImg"><img class="m_top_10" id="hinhanhcongty1" width="100%" src="<?php if(!empty($row['hinhanhcongty1'])){ echo $row['hinhanhcongty1'];}else{ echo 'image/noimage.jpg' ;} ?>"></div>
		  <input id="hinhanhcongty1" name="hinhanhcongty1" value="<?php if(!empty($row['hinhanhcongty1'])){ echo $row['hinhanhcongty1'];}else{ echo 'image/noimage.jpg' ;} ?>" type="hidden">
		  <p class="has-error"></p>
	   </div>
	   <div class="col-lg-4">
		  <label class="">Hình ảnh công ty 2:</label><input accept="image/*" type="file" id="file_hinhanhcongty2" name="file_hinhanhcongty2" class="form-control" placeholder="Hình ảnh công ty 2">
		  <div style="display:none" class="progressLoadImg_hinhanhcongty2 m-loader m-loader--danger"></div>
		  <div class="loadImg"><img class="m_top_10" id="hinhanhcongty2" width="100%" src="<?php if(!empty($row['hinhanhcongty2'])){ echo $row['hinhanhcongty2'];}else{ echo 'image/noimage.jpg' ;} ?>"></div>
		  <input id="hinhanhcongty2" name="hinhanhcongty2"  value="<?php if(!empty($row['hinhanhcongty2'])){ echo $row['hinhanhcongty2'];}else{ echo 'image/noimage.jpg' ;} ?>" type="hidden">
		 
		  <p class="has-error"></p>
	   </div>
	   <div class="col-lg-4">
		  <label class="">Hình ảnh công ty 3:</label><input accept="image/*" type="file" id="file_hinhanhcongty3" value="<?php echo $row['hinhanhcongty3'] ?>" name="file_hinhanhcongty3" class="form-control" placeholder="Hình ảnh công ty 3">
		  <div style="display:none" class="progressLoadImg_hinhanhcongty3 m-loader m-loader--danger"></div>
		  <div class="loadImg"><img class="m_top_10" id="hinhanhcongty3" width="100%" src="<?php if(!empty($row['hinhanhcongty3'])){ echo $row['hinhanhcongty3'];}else{ echo 'image/noimage.jpg' ;} ?>"></div>
		  <input id="hinhanhcongty3" name="hinhanhcongty3" value="<?php if(!empty($row['hinhanhcongty3'])){ echo $row['hinhanhcongty3'];}else{ echo 'image/noimage.jpg' ;} ?>" type="hidden">
		 
		  <p class="has-error"></p>
	   </div>
	   <div class="col-lg-12">
		  <label class="required">Giới thiệu ngắn:</label>
			<textarea  id="gioithieungan" name="gioithieungan" class="form-control" data-provide="markdown" rows="10"> <?php echo $row['gioithieungan'] ?></textarea>
		  <p class="has-error"></p>
	   </div>
	    <div class="col-lg-12">
		  <label class="required">Ghi chú nội bộ:</label>
			<textarea  id="ghi_chu_nb" name="ghi_chu_nb" class="form-control" data-provide="markdown" rows="10"><?php echo $row['ghi_chu_nb'] ?></textarea>
		  <p class="has-error"></p>
	   </div>
	</div>
	</div>
	<input type="hidden" name="congty_id" value="<?php echo $row['congty_id'] ?>">
	<input type="hidden" id="user_update" name="user_update" value="<?php echo $_SESSION["session"]["Id"] ?>">
	<input type="hidden" name="act" value="Update">
</form>
<script>
	$('#formDataUpdate .m_selectpicker').val();
	$('#formDataUpdate .m_selectpicker').selectpicker();
	$(".currency").keyup(function(){
		$(this).val(format($(this).val()));
	});
	jQuery(document).ready(function(){
		$('#btnUpdate').click(function(event){
			// alert('aaaa');
				updateData_cty(event, '<?php echo $com_name ?>', this.id);
			}); 
		$('#formDataUpdate input[type=file]').on('change', function(event){
			uploadImage(event, '<?php echo $com_name ?>', this.id, 1);
		});
		
		$("textarea").markdown({
			target_form   : ".markdown"
		});

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
		
 $(document).ready(function(){
	$("#tencongty").keyup(function(){
		$.ajax({
		type: "POST",
		url: "Model_congty.ajax",
		data: {
				act: "load_real_company",
				value_search: $(this).val(),
		    },
		beforeSend: function(){
			$("#tencongty").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#tencongty").css("background","#FFF");
		}
		});
	});
});
function autocompleter()
{
	$("#suggesstion-box").hide();
}
</script>