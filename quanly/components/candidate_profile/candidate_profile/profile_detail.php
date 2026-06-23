<?php
	$arraySource = array(
		'dist/component/dangtuyen/dangtuyen.css' => 'css',
	);
	$core_class->loadSource($arraySource);
	$myprocess = new process();	
//  $cv_id = $_POST['cv_id'];
	$reuslt = $myprocess->getInfoCV($_POST['profile_id']);
	if($row = $reuslt->fetch()){
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
	role="form" method="post" id="formDataUpdate">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				  <label>Họ và tên :</label>
				  <strong><?php echo $row['full_name'] ?></strong>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="">Địa chỉ Email:</label>
				<strong><?php echo $row['email'] ?></strong>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="">Ngày sinh:</label>
				<strong>
					<?php 
						echo ($row['dob'] != 'Chưa cập nhật' && !empty($row['dob']))
							? date('d-m-Y', strtotime($row['dob']))
							: 'Chưa cập nhật';
					?>
				</strong>
				<p class="has-error"></p>
			</div>

			<div class="col-lg-4">
				<label>Số điện thoại: </label>
				<strong><?php echo $row['phone'] ?></strong>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label >Địa chỉ: </label>
				<strong><?php echo $row['address'] ?></strong>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label >Nghề nghiệp: </label>
				<strong><?php echo $row['occupation'] ?></strong>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label >Nơi công tác: </label>
				<strong><?php echo $row['workplace'] ?></strong>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4"></div>
			
		</div>
	</div>
	
</form>
<?php } ?>
<script>
		var Treeview = function () {
		var createTree = function () {
			$('#m_tree_add').jstree({
				'plugins': ["wholerow", "checkbox", "types"],
				'core': {
					"themes" : {
						"responsive": false
					},
				},
				"types" : {
					"default" : {
						"icon" : "fa fa-folder m--font-warning"
					},
					"file" : {
						"icon" : "fa fa-file  m--font-warning"
					}
				},
			});
			$('#m_tree_add').on('changed.jstree', function (e, data) {
				var parentValue = $('li[data-parent]').map(function(){
					if($(this).find('.jstree-clicked').length > 0){
						return $(this).data('parent');
					}
				}).get();
				$("[name=AUTH_PER]").val(parentValue);
			})
		}
		return {
			init: function () {
				createTree();
			}
		};
	}();

	$(function(){
		Treeview.init();
		// run selectpicker
		BootstrapSelect.init();
		$('#Ngaysinh').datepicker({
			format: 'dd/mm/yyyy',
			todayBtn: "linked",
			clearBtn: true,
			todayHighlight: true,
			autoclose: true,
			templates: {
				leftArrow: '<i class="la la-angle-left"></i>',
				rightArrow: '<i class="la la-angle-right"></i>'
			}
		});
	})
	$(".currency").keyup(function(){
		$(this).val(format($(this).val()));
	});
</script>