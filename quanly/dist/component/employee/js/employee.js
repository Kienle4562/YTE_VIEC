jQuery(document).ready(function() {
	$(document).on('click', '.btnEdit', function(){
		var btn = $(this);
		var employee_id = btn.data('id');
		$.ajax({
			url: 'Model_Employee.ajax',
			type: 'POST',
			async: true,
			data: {
				act: 'ModalEdit',
				employee_id: employee_id
			},
			beforeSend: function(){
				btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
			},
			success: function(rsHTML){
				btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
				$("#loadEditContent").html(rsHTML);
				$("#Dialog_CapNhat").modal('show');
			}
		})
	})

	$(document).on('click', '.addEmployee', function(){
		var btn = $(this);
		$.ajax({
			url: 'Model_Employee.ajax',
			type: 'POST',
			async: true,
			data: {
				act: 'ModalAdd',
			},
			beforeSend: function(){
				btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
			},
			success: function(rsHTML){
				btn.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
				$("#loadAddContent").html(rsHTML);
				$("#Dialog_ThemMoi").modal('show');
			}
		})
	})
});