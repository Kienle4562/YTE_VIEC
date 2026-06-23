$(function(){

	var styleswitcher = $('#styleswitcher'),
		layoutContainer = $('[class*="_layout"]'),
		sc = $('#select_bg_color'),
		menuType = $('#menu_type'),
		body = $('body'),
		header = $('[role="banner"]'),
		footer = $('[role="contentinfo"]'),
		bgType = $('#bg_type'),
		colorBG = $('#color_bg'),
		imageBG = $('#image_bg'),
		hChange = $('.header_change'),
		fChange = $('.footer_change'),
		reset = $('#reset');

	setTimeout(function(){
		styleswitcher.removeClass('active');
	},1500);

	$('#open_switcher').on('click',function(){
		styleswitcher.toggleClass('active');
	});

	$('.layout_change').on('click','li a',function(e){
		$(this).parent().addClass('active').siblings().removeClass('active');
		if($(this).text() == "WIDE"){
			layoutContainer.removeClass('boxed_layout').addClass('wide_layout');
		}else if($(this).text() == "BOXED"){
			layoutContainer.removeClass('wide_layout').addClass('boxed_layout');
		}
		if($('.iosslider').length) $('.iosslider').trigger('resize');
		e.preventDefault();
	});

	sc.ColorPicker({
		color: '#2c2b44',
		onShow: function (colpkr){
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb){
			$('body').css('background-image','none');
			sc.add('body').css('backgroundColor', '#' + hex);
		}
	});

	var ifSticky = false;
	menuType.on('click','li',function(){
		var self = $(this);
		if(self.text() == "Sticky menu"){
			body.addClass('sticky_menu');
			if(!ifSticky){
				$.stickyMenu();
				ifSticky = true;
			}
		}else{
			body.removeClass('sticky_menu');
			$.sideMenu();
			$('[role="banner"]').next().css('margin-top',0);
			$('.header_bottom_partm,.sticky_part').removeClass('fixed');
		}
	});

	imageBG.find('button').each(function(){
		$(this).css('background-image','url('+$(this).data('bg')+')');
	});

	imageBG.children('ul').on('click','li button',function(){
		body.css('background-image','url('+$(this).data('bg')+')');
	});


	bgType.on('click','li',function(){
		if($(this).text() == "Image"){
			colorBG.slideUp(function(){
				imageBG.slideDown();
			});
		}else{
			imageBG.slideUp(function(){
				colorBG.slideDown();
			});
		}
	});

	reset.on('click',function(){
		body.add(sc).css({
			'backgroundImage':'none',
			'background-color':'#2c2b44'
		}).addClass('sticky_menu');
		layoutContainer.removeClass('boxed_layout').addClass('wide_layout');
		menuType.prev('.select_title').text("Sticky menu");
		$('.layout_change').find('li:first').addClass('active').siblings().removeClass('active');
		bgType.prev('.select_title').text("Color");
		imageBG.slideUp(function(){
			colorBG.slideDown();
		});
		if($('.iosslider').length) $('.iosslider').trigger('resize');
	});

	function headerSelects(){
		$('[role="banner"] .custom_select').each(function(){

      		var title = $(this).find('.select_title'),
      			select = $(this).find('select'),
      			len = select.children('option').length,
      			list = $(this).find('.select_list');

      		// title.text(select.children('option').eq(0).val());

      		for(var i = 0; i < len; i++){
      			list.append('<li class="tr_delay fs_medium color_grey">'+select.children('option').eq(i).val()+'</li>');
      		}

      		title.on('click',function(){
      			$(this).toggleClass('active');
      			list.toggleClass('vertical_animate_finished');
      		});

      		list.on('click','li',function(){
      			var val = $(this).text();
      			select.val(val);
      			title.text(val).removeClass('active');
      			list.removeClass('vertical_animate_finished');
      		});

      	});
	}

	setTimeout(function(){
		hChange.children('li:first').addClass('active');
		fChange.children('li:first').addClass('active');
	},500);
	hChange.on('click','li:not(.active)',function(){
		var t = $(this).text();
		$(this).addClass('active').siblings().removeClass('active');

		header.slideUp(function(){
			var self = $(this).html("");

			switch(t){
				case "Header 1" : 
					self.load('inc/header_1.html',function(){
						$(this).removeClass('type_2').slideDown(500);
						$.megaMenu();
						$.responsiveMenu();
						$.stickyMenu()
						$('[role="banner"] .custom_select').formSelect();
					});
				break;
				case "Header 2" : 
					self.load('inc/header_2.html',function(){
						$(this).removeClass('type_2').slideDown(500);
						$.megaMenu();
						$.responsiveMenu();
						$.stickyMenu()
						$('[role="banner"] .custom_select').formSelect();
					});
				break;
				case "Header 3" : 
					self.load('inc/header_3.html',function(){
						$(this).addClass('type_2').slideDown(500);
						$.megaMenu();
						$.responsiveMenu();
						$.stickyMenu()
						$('[role="banner"] .custom_select').formSelect();
					});
				break;
				case "Header 4" : 
					self.load('inc/header_4.html',function(){
						$(this).addClass('type_2').slideDown(500);
						$.megaMenu();
						$.responsiveMenu();
						$.stickyMenu()
						$('[role="banner"] .custom_select').formSelect();
					});
				break;
				case "Header 5" : 
					self.load('inc/header_5.html',function(){
						$(this).addClass('type_2').slideDown(500);
						$.megaMenu();
						$.responsiveMenu();
						$.stickyMenu()
						$('[role="banner"] .custom_select').formSelect();
					});
				break;
				case "Header 6" : 
					self.load('inc/header_6.html',function(){
						$(this).addClass('type_2').slideDown(500);
						$.megaMenu();
						$.responsiveMenu();
						$.stickyMenu()
						$('[role="banner"] .custom_select').formSelect();
					});
				break;
			}

		});

	});
	fChange.on('click','li:not(.active)',function(){
		var t = $(this).text();

		$(this).addClass('active').siblings().removeClass('active');

		footer.slideUp(function(){
			var self = $(this).html("");
			switch(t){
				case "Footer 1" : 
					self.load('inc/footer_1.html',function(){
						$(this).removeClass('p_top_0').slideDown(500);
						$('html,body').animate({ scrollTop : $(document).height() });
						var tweets = $('.tweets');
						if(tweets.length){
							var follow = $('.tw_follow'),
							settings = {
						        modpath: 'plugins/twitter/',
						        username : 'fanfbmltemplate',
						        count: tweets.hasClass('no_carousel') ? 2 : 3,
						        loading_text: '<img src="images/loader2.gif" alt="">',
						        template : '<li class="fw_light relative m_bottom_25 w_break"><div class="icon_wrap_size_1 color_blue circle"><i class="icon-twitter fs_small"></i></div><p>{text}</p><p class="fs_medium color_grey"><i>{time}</i></p></li>'
						    }
						    if(tweets.hasClass('single')){
						    	settings = {
						    		modpath: 'plugins/twitter/',
						        	username : 'fanfbmltemplate',
						        	count: 3,
						        	loading_text:'<img src="images/loader2.gif" alt="">',
						        	template : '<li class="m_bottom_25 relative w_break"><p class="fs_large">{text}</p><p class="color_grey"><i>{time}</i></p></li>'		
						    	}
						    }
							tweets.tweet(settings);
							follow.attr('href','https://twitter.com/'+settings.username);
							if(tweets.hasClass('no_carousel')) return;
							var owl = tweets.children('.tweet_list').owlCarousel({
								singleItem : true,
								pagination:false,
								autoHeight:true,
								autoPlay:true,
								beforeInit: function(){
									tweets.find('.tweet_odd').remove();
									tweets.find('.tweet_text').find('a').addClass('tr_all color_black_hover');
								}
							});

							$('.twc_prev').on('click',function(){
								owl.trigger('owl.prev');
							});
							$('.twc_next').on('click',function(){
								owl.trigger('owl.next');
							});
						}
					});
				break;
				case "Footer 2" : 
					self.load('inc/footer_2.html',function(){
						$(this).removeClass('p_top_0').slideDown(500);
						$('html,body').animate({ scrollTop : $(document).height() });
						var flickr = $('.flickr_list');
						if(flickr.length){
						
							flickr.jflickrfeed({
								limit: flickr.hasClass('nine_items') ? 9 : 6,
								qstrings: {
									id: '76745153@N04'
								},
								itemTemplate: '<li class="f_left r_corners wrapper tr_all"><a data-group="flickr" data-title="{{title}}" href="{{image}}" class="jackbox d_block"><img alt="" src="{{image_s}}"/></a></li>'
							},function(data){
								flickr.find('.jackbox[data-group]').jackBox("newItem", {
							        group: "flickr"
							    });
							});
						}
					});
				break;
				case "Footer 3" : 
					self.load('inc/footer_3.html',function(){
						$(this).removeClass('p_top_0').slideDown(500);
						$('html,body').animate({ scrollTop : $(document).height() });
						var flickr = $('.flickr_list');
						if(flickr.length){
						
							flickr.jflickrfeed({
								limit: flickr.hasClass('nine_items') ? 9 : 6,
								qstrings: {
									id: '76745153@N04'
								},
								itemTemplate: '<li class="f_left r_corners wrapper tr_all"><a data-group="flickr" data-title="{{title}}" href="{{image}}" class="jackbox d_block"><img alt="" src="{{image_s}}"/></a></li>'
							},function(data){
								flickr.find('.jackbox[data-group]').jackBox("newItem", {
							        group: "flickr"
							    });
							});
						}
						var tweets = $('.tweets');
						if(tweets.length){
							var follow = $('.tw_follow'),
							settings = {
						        modpath: 'plugins/twitter/',
						        username : 'fanfbmltemplate',
						        count: tweets.hasClass('no_carousel') ? 2 : 3,
						        loading_text: '<img src="images/loader2.gif" alt="">',
						        template : '<li class="fw_light relative m_bottom_25 w_break"><div class="icon_wrap_size_1 color_blue circle"><i class="icon-twitter fs_small"></i></div><p>{text}</p><p class="fs_medium color_grey"><i>{time}</i></p></li>'
						    }
						    if(tweets.hasClass('single')){
						    	settings = {
						    		modpath: 'plugins/twitter/',
						        	username : 'fanfbmltemplate',
						        	count: 3,
						        	loading_text: 'loading twitter feed...',
						        	template : '<li class="m_bottom_25 relative w_break"><p class="fs_large">{text}</p><p class="color_grey"><i>{time}</i></p></li>'		
						    	}
						    }
							tweets.tweet(settings);
							follow.attr('href','https://twitter.com/'+settings.username);
							if(tweets.hasClass('no_carousel')) return;
							var owl = tweets.children('.tweet_list').owlCarousel({
								singleItem : true,
								pagination:false,
								autoHeight:true,
								autoPlay:true,
								beforeInit: function(){
									tweets.find('.tweet_odd').remove();
									tweets.find('.tweet_text').find('a').addClass('tr_all color_black_hover');
								}
							});

							$('.twc_prev').on('click',function(){
								owl.trigger('owl.prev');
							});
							$('.twc_next').on('click',function(){
								owl.trigger('owl.next');
							});
						}
					});
				break;
				case "Footer 4" : 
					self.load('inc/footer_4.html',function(){
						$(this).addClass('p_top_0').slideDown(500);
						$('html,body').animate({ scrollTop : $(document).height() });
					});
				break;
				case "Footer 5" : 
					self.load('inc/footer_5.html',function(){
						$(this).removeClass('p_top_0').slideDown(500);
						$('html,body').animate({ scrollTop : $(document).height() });
						var tweets = $('.tweets');
						if(tweets.length){
							var follow = $('.tw_follow'),
							settings = {
						        modpath: 'plugins/twitter/',
						        username : 'fanfbmltemplate',
						        count: tweets.hasClass('no_carousel') ? 2 : 3,
						        loading_text: 'loading twitter feed...',
						        template : '<li class="fw_light relative m_bottom_25 w_break"><div class="icon_wrap_size_1 color_blue circle"><i class="icon-twitter fs_small"></i></div><p>{text}</p><p class="fs_medium color_grey"><i>{time}</i></p></li>'
						    }
						    if(tweets.hasClass('single')){
						    	settings = {
						    		modpath: 'plugins/twitter/',
						        	username : 'fanfbmltemplate',
						        	count: 3,
						        	loading_text: 'loading twitter feed...',
						        	template : '<li class="m_bottom_25 relative w_break"><p class="fs_large">{text}</p><p class="color_grey"><i>{time}</i></p></li>'		
						    	}
						    }
							tweets.tweet(settings);
							follow.attr('href','https://twitter.com/'+settings.username);
							if(tweets.hasClass('no_carousel')) return;
							var owl = tweets.children('.tweet_list').owlCarousel({
								singleItem : true,
								pagination:false,
								autoHeight:true,
								autoPlay:true,
								beforeInit: function(){
									tweets.find('.tweet_odd').remove();
									tweets.find('.tweet_text').find('a').addClass('tr_all color_black_hover');
								}
							});

							$('.twc_prev').on('click',function(){
								owl.trigger('owl.prev');
							});
							$('.twc_next').on('click',function(){
								owl.trigger('owl.next');
							});
						}
					});
				break;
				case "Footer 6" : 
					self.load('inc/footer_6.html',function(){
						$(this).removeClass('p_top_0').slideDown(500);
						$('html,body').animate({ scrollTop : $(document).height() });
					});
				break;
			}
		});

	});


});

$(window).on('load',function(){

	if(window.location.hash.indexOf('#footer') !== -1){

		$('html,body').animate({ scrollTop : $(document).height() },1000);

	}
	
});