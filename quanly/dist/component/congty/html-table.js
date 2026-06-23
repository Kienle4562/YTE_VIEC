//== Class definition

var DatatableHtmlTableDemo = function() {
	//== Private functions

	// demo initializer
	var demo = function() {

		var datatable = $('.m-datatable').mDatatable({
			sortable: false,
			data: {
				saveState: {cookie: false},
			},/* 
			search: {
				input: $('#generalSearch'),
			}, */
			layout: {
			theme: 'default', // datatable theme
			class: '', // custom wrapper class
			scroll: true, // enable/disable datatable scroll both horizontal and vertical when needed.
			height: 550, // datatable's body's fixed height
			footer: false // display/hide footer
			},
			columns: [
				   {
					field: 'congty_id',
					title: '#',
					width: 10,
					textAlign: 'center',
					selector: {
						class: 'm-checkbox--solid m-checkbox--brand'
					},
					
				  },{
					field: 'Ngày đăng ký',
					title: 'Ngày đăng ký',
					width: 140
				},
				{
					field: 'Người thêm',
					title: 'Người thêm',
					width: 140
				},
				{
					field: 'ID Công Ty',
					title: 'ID Công Ty',
					width: 100
				},
				{
					field: 'Tên Công Ty',
					title: 'Tên Công Ty',
					width: 100
				},
			],
		});

		$('#m_form_status').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Status');
		});

		$('#m_form_type').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Type');
		});

		$('#m_form_status, #m_form_type').selectpicker();

	};

	return {
		//== Public functions
		init: function() {
			// init dmeo
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	DatatableHtmlTableDemo.init();
});