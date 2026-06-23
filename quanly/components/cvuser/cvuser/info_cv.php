<?php
	$arraySource = array(
		'dist/component/dangtuyen/dangtuyen.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.css' => 'css',
		'dist/component/dangtuyen/bootstrap-tagsinput.min.js' => 'js',
	);
	$core_class->loadSource($arraySource);
	$myprocess = new process();	
//  $cv_id = $_POST['cv_id'];
	$reuslt = $myprocess->getInfoCV($_POST['cv_id']);
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
	<input type="hidden" id="valueCKhac" name="valueCKhac" value="<?php echo $row['chuyenkhoakhac'] ?>">
	<div class="m-portlet__body">
		<div class="form-group m-form__group row">
			<div class="col-lg-4">
				  <label>Họ tên :</label>
				  <strong><?php echo $row['lastname'] ?></strong>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Tên profile:</label>
				<strong><?php echo $row['tenprofilecv'] ?></strong>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label class="required">Cấp bậc mong muốn:</label>
				<strong><?php echo $row['capbacmongmuon'] ?></strong>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label>Ngày sinh:</label>
				<strong><?php echo $row['birthday'] ?></strong>
				<p class="has-error"></p>
			</div>
			<div class="col-lg-4">
				<label >Số điện thoại: </label>
				<strong><?php echo $row['mobile'] ?></strong>
				<p class="has-error"></p>
			</div>
		
			<div class="col-lg-4">
				<label class="">Tìm kiếm:</label>
				<strong><?php if($row['tim_kiem'] == 1) {echo "Activer"; }else { echo 'Disnable';} ?></strong>
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