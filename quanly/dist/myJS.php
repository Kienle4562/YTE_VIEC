<!-- begin::Quick Nav -->	
<!--begin::Base Scripts -->
<script src="dist/assets/vendors/base/vendors.bundle.js?ver=<?php echo date("dmyHis") ?>" type="text/javascript"></script>
<script src="dist/assets/web/base/scripts.bundle.js?ver=<?php echo date("dmyHis") ?>" type="text/javascript"></script>
<!--end::Base Scripts -->   
<!--begin::Page Vendors -->
<script src="dist/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
<!--end::Page Vendors -->  
   <!--begin::Page Resources -->
	<script src="dist/assets/web/custom/components/forms/widgets/select2.js" type="text/javascript"></script>
<!--end::Page Resources -->
<!--begin::Page Snippets -->
<script src="dist/assets/app/js/dashboard.js" type="text/javascript"></script>
<script src="<?php $core_class->latest_version("dist/custom.js"); ?>" type="text/javascript"></script>
<script src="<?php $core_class->latest_version("dist/func_common.js"); ?>" type="text/javascript"></script>
<!--end::Page Snippets -->   
<!-- begin::Page Loader -->
<script>
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		todayBtn: "linked",
		clearBtn: false,
		todayHighlight: true,
		templates: {
			leftArrow: '<i class="la la-angle-left"></i>',
			rightArrow: '<i class="la la-angle-right"></i>'
		},
		autoclose: true
	});
	$(window).on('load', function() {
		$('body').removeClass('m-page--loading');         
	});
</script>
<!-- end::Page Loader -->