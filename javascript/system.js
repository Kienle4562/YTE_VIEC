// JavaScript Document
/* javascript module toogle menu */
function startList() {
if (document.all && document.getElementById) {
  navRoot = document.getElementById("module_tooltip"); 
  for (i = 0; i < navRoot.childNodes.length; i++) {
	 node = navRoot.childNodes[i]; 
	 if (node.nodeName == "LI") {
		node.onmouseover = function() {
		   this.className += " over"; 
		   }
		node.onmouseout = function() {
		   this.className = this.className.replace(" over", ""); 
		   }
		}
	 }
  }
}
/* cai dat cac ham được chạy init */
jQuery(document).ready(function () {	
	// startList();
    check_active_link();
});

function module_process(id, task, position)
{
	jQuery('#frm_module_' + id + " #task").val(task);
	jQuery('#frm_module_' + id + " #position").val(position);
	
	if (task == '439353')
	{
		if (confirm('Bạn có chắc chắn muốn xoá module này không?'))
		{
			jQuery('#frm_module_' + id).submit();
		}
	}
	else
	{
		jQuery('#frm_module_' + id).submit();
	}
}

function module_translate(id, obj, mod_name, lang)
{
	var container = jQuery(obj).parent().parent().parent().parent();
	module_translate_generator(id, container, mod_name, lang);
}

function component_translate(obj, com_name, lang)
{
	var rnd = Math.floor(Math.random() * 1000000000000000);
	module_translate_generator(rnd, obj, com_name, lang);
}

function module_translate_generator(id, container, mod_name, lang)
{
	if (jQuery.browser.msie) {
		alert('Thông báo: chức năng này không được hỗ trợ trên trình duyệt Internet Explorer');
		return false;
	}
	
	// Kiểm tra hàm trim trong prototype
	if (String.prototype.trim) {
		String.prototype.trim=function(){return this.replace(/^\s+|\s+$/g, '');};
	}
	
	var offset = container.offset();
	var panel_width = container.width();
	var panel_height = container.height();
	
	var sub_panel = null;
	
	var panel = jQuery('<div></div>')
		.attr({
			id				:	'module_translate_' + id,
			'class'			:	'translate_panel'
		})
		.css({
			position		:	'absolute',
			width			:	panel_width,
			height			:	panel_height,
			top				:	offset.top,
			left			:	offset.left,
			background		:	'rgba(0, 0, 0, 0.2)',
			opacity			:	0,
			'z-index'		:	99999,
			'box-shadow'	:	'2px 2px 5px #888'
		});
	
	var form = jQuery('<form></form>')
		.attr({
			name			:	"module_translate_" + id + "_form",
			method			:	"POST",
			submit 			:	function() {return false}
		});
	
	var btn_save = jQuery('<a></a>')
		.attr({
			href			:	'javascript:void(0)'
		})
		.css({
			width			:	16,
			height			:	16,
			position		:	'absolute',
			left			:	-23,
			top				: 	0,
			background		:	'white url(images/icons/save.png) center center no-repeat',
			padding			:	3,
			'border-radius'	:	3,
			border			:	'solid 1px black'
		})
		.click(function() {
			var form_data = {};
			
			form.find('input[type!=button]').each(function() {
				// Gỡ bỏ dấu nháy đơn và ký tự xuống dòng
				var __val = jQuery(this).attr('value').replace(/'/g, '′').replace(/(\r\n|\n|\r)/gm, '<br />');
				// Cập nhật lại cho input
				jQuery(this).attr('value', __val);
				// Đưa dữ liệu vào form_data
				eval('form_data.' + jQuery(this).attr('name') 
						+ '= \'' 
						+ jQuery(this).attr('value') + '\';'
				);
			});
			
			jQuery.ajax('./translate?lang=' + lang, {
				data	:	form_data,
				type	:	'POST',
				success	:	function(data, textStatus, jqXHR) {
					if (data == 1) {
						alert('Cập nhật thành công');
						
						form.find('input').each(function(idx) {
							var __tmp_value = jQuery(this).attr('value');
							jQuery('.' + mod_name).find('span[alt=' + jQuery(this).attr('name') + ']').each(function(idx) {
								jQuery(this).html(__tmp_value);
							});
						});
						
						btn_cancel.click();
					}
					else {
						alert('Đã xảy ra lỗi trong quá trình cập nhật. Xin vui lòng thử lại.');
					}
				}
			});
		});
	
	var btn_cancel = jQuery('<a></a>')
		.attr({
			href			:	'javascript:void(0)'
		})
		.css({
			width			:	16,
			height			:	16,
			position		:	'absolute',
			left			:	-23,
			top				: 	46,
			background		:	'white url(images/icons/cancel.png) center center no-repeat',
			padding			:	3,
			'border-radius'	:	3,
			border			:	'solid 1px black'
		})
		.click(function() {
			panel.animate({opacity: 0}, 500, function() { jQuery(this).remove(); });
			btn_increase.remove();
			btn_decrease.remove();
			/* jQuery('#demo-bar').stop(true,true).show().animate({opacity: 1}, 500); */
		});
		
	var btn_list = jQuery('<a></a>')
		.attr({
			href			:	'javascript:void(0)'
		})
		.css({
			width			:	16,
			height			:	16,
			position		:	'absolute',
			left			:	-23,
			top				: 	23,
			background		:	'white url(images/icons/list.png) center center no-repeat',
			padding			:	3,
			'border-radius'	:	3,
			border			:	'solid 1px black'
		})
		.click(function() {
			sub_panel.stop(true, true).show().css({opacity: 0}).animate({opacity: 1}, 500);
			btn_increase.hide();
			btn_decrease.hide();
		});
		
	var btn_increase = jQuery('<a></a>')
		.attr({
			href			:	'javascript:void(0)',
			id				:	'btn_increase_' + id
		})
		.css({
			width			:	10,
			height			:	10,
			position		:	'absolute',
			left			:	0,
			top				: 	0,
			background		:	'white url(images/icons/plus.png) center center no-repeat',
			'z-index'		:	100000,
			border			:	'solid 1px black'
		})
		.click(function() {
			__tmp_input = form.find('input[name=' + jQuery(this).attr('alt') + ']');
			__tmp_input.width(__tmp_input.width() + 30);
		}).hide();
		
	var btn_decrease = jQuery('<a></a>')
		.attr({
			href			:	'javascript:void(0)',
			id				:	'btn_decrease_' + id
		})
		.css({
			width			:	10,
			height			:	10,
			position		:	'absolute',
			left			:	18,
			top				: 	0,
			background		:	'white url(images/icons/minus.png) center center no-repeat',
			'z-index'		:	100000,
			border			:	'solid 1px black'
		})
		.click(function() {
			__tmp_input = form.find('input[name=' + jQuery(this).attr('alt') + ']');
			if (__tmp_input.width() >= 40) {
				__tmp_input.width(__tmp_input.width() - 30);
			}
		}).hide();
	
	var inp_count = 0;
	
	// Mảng lưu giá trị name của các input, tránh trường hợp tạo ra 2 input trùng tên
	var __alt_list = [];
	
	container.find('.text2translate')
		.each(function(idx) {
			if (jQuery(this).css('display') != 'none')
			{
				var alt = jQuery(this).attr('alt').trim();
				if (alt != '')
				{
					if (jQuery.inArray(alt, __alt_list) == -1)
					{
						var inp_value = jQuery(this).html();
						if (inp_value == '') {
							inp_value = alt;
							jQuery(this).html(alt);
						}

						var inp_offset = jQuery(this).offset();
						var inp_height = jQuery(this).height();
						var inp_width = jQuery(this).width();
						var inp_font_name = jQuery(this).css('font-family');
						var inp_font_size = jQuery(this).css('font-size');
						var inp_font_weight = jQuery(this).css('font-weight');
						var inp_font_style = jQuery(this).css('font-style');
						var inp_text_transform = jQuery(this).css('text-transform');
						
						if (inp_width < 10) { inp_width = 10; }
						if (inp_height < 10) { inp_height = 14; }
						
						var inp = jQuery('<input />')
							.attr({
								name		:	alt,
								type		:	'text',
								'class'		:	'input2translate',
								value		:	inp_value
							})
							.css({
								position		:	'absolute',
								border			:	'solid 1px rgba(0, 0, 0, 0.5)',
								'font-family'	:	inp_font_name,
								'font-size'		:	inp_font_size,
								'font-weight'	:	inp_font_weight,
								'font-style'	:	inp_font_style,
								'text-transform':	inp_text_transform,
								top				:	inp_offset.top - offset.top - 1,
								left			:	inp_offset.left - offset.left - 1,
								height			:	inp_height,
								width			:	inp_width
							})
							.focus(function() {
								var __tmp_top = jQuery(this).offset().top;
								var __tmp_left = jQuery(this).offset().left;
								var __tmp_name = jQuery(this).attr('name');
								
								btn_increase.css({
									top		:	__tmp_top - 11,
									left	:	__tmp_left + 11
								})
								.attr({
									alt		:	__tmp_name
								})
								.show();
								
								btn_decrease.css({
									top		:	__tmp_top - 11,
									left	:	__tmp_left
								})
								.attr({
									alt		:	__tmp_name
								})
								.show();
								
								form.find('input[type=text]').stop(true,true).animate({opacity : 0.7});
								jQuery(this).stop(true,false).animate({opacity : 1});
							})
							.appendTo(form);
						
						__alt_list[inp_count] = alt;
						inp_count++;
					}
				}
			}
		});

	jQuery.get('./translate_get_hidden?f=' + mod_name + '&lang=' + lang, function(data) {
		if (data.trim() != '')
		{
			var list = data.split('\n');
			
			sub_panel = jQuery('<div></div>')
				.attr({
					id				:	'module_translate_' + id + '_sub',
					'class'			:	'translate_sub_panel'
				})
				.css({
					position			:	'absolute',
					top					:	2,
					left				:	2,
					'background-color'	:	'rgba(0, 0, 0, 0.8)',
					color				:	'white',
					width				:	panel_width - 4,
					height				:	panel_height - 4,
					overflow			:	'scroll',
					display				:	'none',
					'z-index'			:	100001
				});
				
			jQuery('<p></p>')
				.css({
					'text-align': 'right',
					'margin-right': 5
				})
				.append(
					jQuery('<input />')
						.attr({
							href	:	'javascript:void(0)',
							type	:	'button',
							value	:	'Quay lại'
						})
						.click(function() {
							sub_panel.stop(true, true).css({opacity: 1}).animate({opacity: 0}, 500, function() { jQuery(this).hide(); });
						})
				)
				.appendTo(sub_panel);
			
			var __tmp_table = jQuery('<table></table>')
				.attr({
					width		:	'100%',
					border		:	0,
					cellpadding	:	'10',
					cellspacing	:	0
				});
			
			for (var i = 0; i < list.length; i++)
			{
				var item = list[i].split('\t');
				var __tmp_tr = jQuery('<tr></tr>');
				
				var __tmp_td_1 = jQuery('<td></td>')
					.attr({width : '20%'})
					.css({'text-align': 'right'})
					.html(item[0])
					.appendTo(__tmp_tr);
				
				var __tmp_td_2 = jQuery('<td></td>').attr({width : '80%'});
				
				var __tmp_inp = jQuery('<input />')
					.attr({
						name		:	item[0],
						value		:	item[1],
						type		:	'text'
					})
					.css({
						width		:	'100%',
						border		:	'solid 1px rgba(0, 0, 0, 0.5)'
					})
					.focus(function() {
						form.find('input[type!=button]').stop(true,true).animate({opacity : 0.7});
						jQuery(this).stop(true,false).animate({opacity : 1});
					})
					.appendTo(__tmp_td_2);
				
				__tmp_td_2.appendTo(__tmp_tr);
				__tmp_tr.appendTo(__tmp_table);
				
				inp_count++;
			}
			
			__tmp_table.appendTo(sub_panel);
			
			sub_panel.appendTo(form);
		}
	});
	
	if (inp_count == 0)
	{
		alert('Module này hiện vẫn chưa hỗ trợ chức năng biên dịch');
	}
	else
	{
		jQuery('<input />').attr({
				type	:	'hidden',
				name	:	'module_name',
				value	:	mod_name
			}).appendTo(form);

		jQuery('<input />').attr({
				type	:	'hidden',
				name	:	'task',
				value	:	'789744'
			}).appendTo(form);

		btn_save.appendTo(panel);
		btn_cancel.appendTo(panel);
		btn_list.appendTo(panel);
		
		btn_increase.appendTo(jQuery('body'));
		btn_decrease.appendTo(jQuery('body'));
		
		form.appendTo(panel);
		
		panel.appendTo(jQuery('body'));
		panel.animate({opacity: 1}, 500);
		
		/*
		jQuery('#demo-bar').stop(true,true).animate({opacity: 0}, 500, function() {
			jQuery('#demo-bar').hide();
		});
		*/
	}
}

function check_active_link()
{
    jQuery('.check_active_link a[href="' + location.href + '"]').addClass('active');
    // jQuery('.check_active_link a[href="' + location.href + '"]').parents('li').addClass('active');
}