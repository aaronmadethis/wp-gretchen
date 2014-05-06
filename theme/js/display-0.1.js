var animating = false;

jQuery(document).ready(function($) {
	var win_w = $(window).width(),
		win_h = $(window).height(),
		has_video = $('html.video').length > 0 ? true : false,
		win_ratio,
		is_horizontal;

	/* ---------------------------------------------------------------------------------------
	WINDOW RATIO
	--------------------------------------------------------------------------------------- */
	function set_window_ratio(){
		win_ratio = win_w / win_h;
		is_horizontal = false;
		
		if(win_ratio < 1) is_horizontal = true;

		if(win_h <= 600){
			$('#nav-container').removeClass('tall').addClass('short');
		}else{
			$('#nav-container').removeClass('short').addClass('tall');
		}
	}
	set_window_ratio();


	/* ---------------------------------------------------------------------------------------
	NAVIGATION FIXES
	--------------------------------------------------------------------------------------- */
	$('li.menu-item-33 a').first().click(function(e){ e.preventDefault(); });


	/* ---------------------------------------------------------------------------------------
	HOME CLICK THROUGH
	--------------------------------------------------------------------------------------- */
	$('#stage-wrapper').click(function(e){
		$('#stage-wrapper').fadeOut(500);
	});

	/* ---------------------------------------------------------------------------------------
	PROJECT IMAGES
	--------------------------------------------------------------------------------------- */
	$('#lrg-image-container li').first().addClass('first');
	$('#thumb-image-container li').first().addClass('first selected');

	var loader_url = '<div id="temp-load" class="myinvisible"><img src="http://gretchensmelter.com/web/wp-content/themes/gretchensmelter/images/loader_icon.png" title="preloader image"></div>';
	$('body').prepend( loader_url );

	imagesLoaded( '#temp-load', function(){
		$('#temp-load').remove();
		setTimeout(load_first_img, 1000)
	});


	function load_first_img(){
		imagesLoaded( '#lrg-image-container li.first', function() {
			$('#loader').addClass('myhide');
			$('#lrg-image-container li.first').addClass('selected').css({'visibility': 'visible'}).stop(true, true).delay(200).animate({opacity: 1},500);
		});
	}


	function change_image(img_index){
		var current = $('#lrg-image-container li.selected').index();

		if( current != img_index ){
			$('#lrg-image-container li.selected').removeClass('selected').stop(true, true).animate({opacity: 0},200, function(){
				$(this).css({'visibility': 'hidden'});
			});
			$('#lrg-image-container').find('li').eq(img_index).addClass('selected').css({'visibility': 'visible'}).stop(true, true).animate({opacity: 1},200);

			$('#thumb-image-container li.selected').removeClass('selected');
			$('#thumb-image-container').find('li').eq(img_index).addClass('selected');
			
			
			if(current > img_index){
				var scroll_pos = (Math.floor(img_index / 8) * 608);
				$('#thumb-wrapper').scrollTo( scroll_pos, 500, {axis: 'x'});
				console.log(current, img_index, scroll_pos);
			}else{
				var scroll_pos  = Math.floor(img_index / 4) * 304;
				$('#thumb-wrapper').scrollTo( scroll_pos, 500, {axis: 'x'});
				console.log(current, img_index, scroll_pos);
			}
		}
	}

	$('#left-half').click(function(e){
		var img_index = $('#lrg-image-container li.selected').index();

		if(img_index == 0){
			img_index = $('#lrg-image-container li').length - 1;
		}else{
			--img_index;
		}

		change_image(img_index);
		e.preventDefault();
	});

	$('#right-half').click(function(e){
		var img_index = $('#lrg-image-container li.selected').index();

		if(img_index == $('#lrg-image-container li').length - 1 ){
			img_index = 0
		}else{
			++img_index;
		}

		change_image(img_index);
		e.preventDefault();
	});

	$('#mobile-next').click(function(e){
		var img_index = $('#lrg-image-container li.selected').index();

		if(img_index == $('#lrg-image-container li').length - 1 ){
			img_index = 0
		}else{
			++img_index;
		}

		change_image(img_index);
		e.preventDefault();
	});


	function set_img_ratios(){
		if( $('#lrg-image-container').length > 0 ){
			$('#lrg-image-container li').each(function(i) {
				var img = $(this).find('img');
				set_ratio(img);
			});
		}
		if( $('#home-wrapper').length > 0 ){
			set_ratio( $('#home-wrapper img') );
		}
	}

	function set_ratio(img){
			win_r = win_w / win_h,
			img_w = $(img).attr('data-width'),
			img_h = $(img).attr('data-height'),
			img_r = img_w / img_h;

		if(win_r > img_r){
			//window is wide
			$(img).removeClass('vert').addClass('horz');
		}else{
			//window is high
			$(img).removeClass('horz').addClass('vert');
		}
	}

	set_img_ratios();


	/* ---------------------------------------------------------------------------------------
	THUMBNAILS
	--------------------------------------------------------------------------------------- */
	var thumb_num = $('#thumb-images li').length;

	if(thumb_num > 8){
		$('#thumb-images').css({'width': 76*thumb_num});
	}

	$('#thumb-btn-show a').click(function(e){
		e.preventDefault();
		$('#thumb-image-container').removeClass('closed').addClass('opened');
		$('#thumb-btn-show').animate({opacity: 0},200, function(){
			$(this).css({'visibility': 'hidden'});
			$('#thumb-wrapper').removeClass('closed').addClass('opened');
		});
		$('#thumb-btn-controls').fadeIn('fast', function(){ 
			$(this).animate({opacity: 1},200);
		});
		$('#lrg-image-container').removeClass('thumb-hidden').addClass('thumb-shown');
	});

	$('#thumb-btn-controls a.myclose').click(function(e){
		e.preventDefault();
		
		$('#thumb-btn-controls').fadeOut('fast', function(){
			$('#thumb-btn-show').css({'visibility': 'visible'}).stop(true, true).animate({opacity: 1},200,function(){
		
			});
		});
		$('#thumb-image-container').removeClass('opened').addClass('closed');

		$('#lrg-image-container').removeClass('thumb-shown').addClass('thumb-hidden');
		$('#thumb-wrapper').removeClass('opened').addClass('closed');

	});

	$('#thumb-images li a').click(function(e){
		e.preventDefault();

		var img_index = $(this).parent().index();
		change_image(img_index);
	});

	/* ---------------------------------------------------------------------------------------
	THUMBNAIL SCROLLING
	--------------------------------------------------------------------------------------- */
	$('#thumb-btn-controls a.prev').click(function(e){
		e.preventDefault();
		$('#thumb-wrapper').scrollTo('-=608px', 500, {axis: 'x'});
	});
	$('#thumb-btn-controls a.next').click(function(e){
		e.preventDefault();
		$('#thumb-wrapper').scrollTo('+=608px', 500, {axis: 'x'});
	});


	/* ---------------------------------------------------------------------------------------
	WINDOW RESIZE
	--------------------------------------------------------------------------------------- */		
	var rtime = new Date(1, 1, 2000, 12,00,00),
		timeout = false;
		delta = 50;
		
	$(window).resize(function() {
		$('#inset').attr({style: ''});
	    rtime = new Date();
	    if (timeout === false) {
	        timeout = true;
	        setTimeout(resize_end, delta);
	    }
	});

	function resize_end() {
	    if (new Date() - rtime < delta) {
	        setTimeout(resize_end, delta);
	    } else {
	        timeout = false;
	        win_w = $(window).width();
			win_h = $(window).height();
			set_window_ratio();
			set_img_ratios();
	    }               
	}

});

