<?php 
 $myprocess = new process();
$arraySource = array(
		'dist/component/donhang/css/donhang.css' => 'css',
		'dist/component/donhang/js/donhang.js' => 'js'
	);
	$core_class->loadSource($arraySource);
	$ma_don_hang = $myprocess->generateRandomString();
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
	.quantity_sty
		{
			display:none;
		}
</style>
<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" 
	role="form" method="post" id="formDataInsert">
	<div class="m-portlet__body">
	<!-- thông tin  người mua hàng --> 
<div class="form-group m-form__group row">
	 <div class="col-lg-4">
      <label class="">Mã đơn hàng:</label>
      <div class="input-group">
         <input type="text" id="ma_don_hang" name="ma_don_hang" readonly value="<?php echo $ma_don_hang ?>" class="form-control m-input" placeholder="ma_don_hang" maxlength="100">
         
      </div>
      <p class="has-error"></p>
   </div>
   <div class="col-lg-4">
      <label class="required">Email:</label>
      <div class="input-group">
         <input type="email" autocomplete="off" data-autocomplete="email" id="email" name="email" class="form-control m-input" placeholder="nhập email..." maxlength="100">
         <div class="input-group-append">
			<span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
		</div>
		<div class="tt-menu" style="position: absolute;top: 100%;z-index: 100;display:none">
                                    <div class="loadSuggess tt-dataset tt-dataset-states">
                                    </div>
         </div>
      </div>
      <p class="has-error"></p>
   </div>
	<div class="col-lg-4">
		  <label class="required">Tên công ty:</label>
			<input type="text" id="tencongty" name="tencongty" readonly class="form-control m-input" placeholder="Tên công ty" required="" maxlength="100">
			<div id="suggesstion-box"></div>
		  <p class="has-error"></p>
	   </div>
       <div class="col-lg-4">
		  <label class="required">Số điện thoại:</label>
			<input type="text" id="phone" name="phone" class="form-control m-input" placeholder="Số điện thoại" required="" maxlength="100">
			<div id="suggesstion-box"></div>
		  <p class="has-error"></p>
	   </div>
	    <div class="col-lg-4">
		  <label class="required">Người liên hệ:</label>
			<input type="text" id="nguoilienhe" name="nguoilienhe" class="form-control m-input" placeholder="Người liên hệ" required="" maxlength="100">
			<div id="suggesstion-box"></div>
		  <p class="has-error"></p>
	   </div>
	   <div class="col-lg-4">
		  <label>Ghi chú:</label>
			<textarea class="form-control w_full" name="note" maxlength="300"></textarea>
		  <p class="has-error"></p>
	   </div>
	</div>
	<!--- end thông tin -->
	<!--  thông tin dịch vụ -->
			<div class="form-group m-form__group row">
			<?php
		
			    $resultdv = $myprocess ->get_dichvu();
				while($row = $resultdv->fetch()){ 
			?>
			   <div class="col-lg-4">
					<label class="m-option">
						<span class="m-option__control">
							<span class="m-checkbox m-checkbox--state-brand">
								<input type="checkbox" name="dich_vu[]" class="service_id" value="<?php echo $row['service_code'] ?>">
								
								<span></span>
							</span>
						</span>
					         <span class="m-pricing-table-1__price">
									<?php echo $row['service_name'] ?>
								</span><span>( <?php echo $row['note'] ?> )</span><span> <?php echo $row['service_price'] ?></span>
							
						<div class="col-lg-12 quantity_sty">
						<input  type="text" name="" id="qty_<?= $row['service_id']; ?>" value="1" class="col-md-4 form-control quantity">
							<input type="hidden" name="" class="service_id_2" value="<?= $row['service_id']; ?>">
							<input type="text" id="price_<?= $row['service_id']; ?>"  class="form-control m-input  gia_ban" placeholder="Giá bán"  value="0" maxlength="50">
						</div>
					</label>
				</div>
		  <?php } ?>
		      <div class="col-lg-4">
					<label class="m-option">
						<span class="m-option__control">
							<span class="m-checkbox m-checkbox--state-brand">
								<input type="checkbox" name="dich_vu[]" class="service_id" value="job_basic">
								<span></span>
							</span>
						</span>
					         <span class="m-pricing-table-1__price">
									POST BASIC
								</span><span>( Tin thường )</span>
							<div class="col-lg-12 quantity_sty">
								<input  type="text" name="" id="qty_<?= $row['service_id']; ?>" value="1" class="col-md-4 form-control quantity">
								<input type="text" id="price_<?= $row['service_id']; ?>"  class="form-control m-input  gia_ban" placeholder="Giá bán" value="0" maxlength="50">
								<input type="hidden" name="" class="service_id_2" value="3">
							</div>
					</label>
				</div>
				<div class="col-lg-4">
					<label class="m-option">
					         <span class="m-pricing-table-1__price">
									Ngày kích hoạt
								</span>
									<div class="input-group fx_w date">
									<input type="text" value="<?php echo date('d/m/Y') ?>" name="ngaykichhoat" 
										class="form-control m-input datepicker">
									</div>
					</label>
				</div>
				 <div class="col-lg-4">
					<label class="m-option">
					         <span class="m-pricing-table-1__price">
									Ngày hết hạn
								</span>
									<div class="input-group fx_w date">
									<input type="text" value="<?php echo date('d/m/Y', strtotime("+360 days")) ?>" name="ngayhethan" 
										class="form-control m-input datepicker">
									</div>
					</label>
				</div>
				<div class="col-lg-4">
				
					         <span class="m-pricing-table-1__price">
									Tổng tiền
								</span>
									<div class="input-group fx_w date">
									<input type="text" id="tongtien" class="form-control m-input" name="tong_tien" placeholder="Tổng tiền" value="0" required="" maxlength="50">
									</div>
				
				</div>
		</div>
	<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION["session"]["Id"] ?>">
	<input type="hidden" id="congty_id" name="congty_id" value="">
	<input type="hidden" name="act" value="Insert">
</form>
<script>
	
	$('#formDataInsert .m_selectpicker').val();
	$('#formDataInsert .m_selectpicker').selectpicker();
	$(".currency").keyup(function(){
		$(this).val(format($(this).val()));
	});
	jQuery(document).ready(function(){
		$('#btnInsert, .btnInsert').click(function(event){
			
			insertData(event, '<?php echo $com_name ?>', this.id);
		});
		$('#formDataInsert input[type=file]').on('change', function(event){
			uploadImage(event, '<?php echo $com_name ?>', this.id, 0);
		});
		$(".quantity").TouchSpin({
				min: 1,
				max: 1000,
				step: 1,
				maxboostedstep: 10000000,
				buttondown_class: "btn btn-link btn-secondary",
				buttonup_class: "btn btn-link btn-secondary",
				initval: 1,
			  });
			  
	/* 	$("textarea").markdown({
			target_form   : ".markdown"
		}); */
	
	});
    $(document).on("click",".service_id", function(){
			let parent = $(this).parents('label').first();
			var isChecked = $(this).prop("checked");
			if(isChecked)
			{
				
				parent.find(".quantity_sty").show();
				parent.find(".quantity").attr('name', 'quantity[]');
				parent.find(".service_id_2").attr('name', 'service_id[]');
				parent.find(".gia_ban").attr('name', 'don_gia[]');

			}else{
				parent.find(".quantity_sty").hide();
				parent.find(".quantity").removeAttr("name");
				parent.find(".service_id_2").removeAttr('name', 'service_id[]');
				parent.find(".gia_ban").removeAttr('name', 'don_gia[]');
			}
	   })
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

/*  $(document).ready(function(){
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
} */

$(document).ready(function(){
		$(".gia_ban").each(function() {
			
			$(this).keyup(function(){
				calculateSum();
			});
		});
});
function calculateSum() {
var sum = 0;
$(".gia_ban").each(function() {
	if(!isNaN(this.value) && this.value.length!=0) {
		sum += parseFloat(this.value);
	}

});

	$("#tongtien").val(sum);
}
</script>