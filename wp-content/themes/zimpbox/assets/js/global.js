/*-------------------------------------------------------------------------------------------------------------------------------*/
/*This is main JS file that contains custom style rules used in this template*/
/*-------------------------------------------------------------------------------------------------------------------------------*/
/* Template Name: Site Title*/
/* Version: 1.0 Initial Release*/
/* Build Date: 22-04-2015*/
/* Author: Unbranded*/
/* Website: http://moonart.net.ua/site/ 
/* Copyright: (C) 2015 */
/*-------------------------------------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------*/
/* TABLE OF CONTENTS: */
/*--------------------------------------------------------*/
/* 01 - VARIABLES */
/* 02 - PAGE CALCULATIONS */
/* 03 - FUNCTION ON DOCUMENT READY */
/* 04 - FUNCTION ON PAGE LOAD */
/* 05 - FUNCTION ON PAGE RESIZE */
/* 06 - FUNCTION ON PAGE SCROLL */
/* 07 - SWIPER SLIDERS */
/* 08 - BUTTONS, CLICKS, HOVERS */
/* 09 - LIGHT-BOX */

/*-------------------------------------------------------------------------------------------------------------------------------*/

;(function($, window, document, undefined) {

	"use strict";

	/*================*/
	/* 01 - VARIABLES */
	/*================*/
	var swipers = [], winW, winH, winScr, $container, _isresponsive, smPoint = 768, mdPoint = 992, lgPoint = 1200, addPoint = 1600, _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i);

	/*========================*/
	/* 02 - PAGE CALCULATIONS */
	/*========================*/
	function pageCalculations(){
		winW = $(window).width();
		winH = $(window).height();
		if($('.menu-button').is(':visible')) _isresponsive = true;
		else _isresponsive = false;
	}

	/*=================================*/
	/* 03 - FUNCTION ON DOCUMENT READY */
	/*=================================*/
	pageCalculations();

	//center all images inside containers
	$('.swiper-slide .center-image, .main-image.banner .center-image, .video-block .center-image').each(function(){
		var bgSrc = $(this).attr('src');
		$(this).parent().addClass('background-block').css({'background-image':'url('+bgSrc+')'});
		$(this).hide();
	});

	$(window).resize(function(){
		image_width();
		absoluteImage();
	});

	function image_width() {
		if( $('.skills-x-img .main-image').length ) {
			setTimeout(function(){
				$('.skills-x-img .main-image').removeClass('background-block').css({'background-image':'none'});
				
				if( ! $('.skills-x-img .main-image .img').length ) {
					$('.skills-x-img .main-image').append('<div class="img"></div>');
				}
				$('.skills-x-img .main-image .img').css({
					'background-image':'url('+ $('.skills-x-img .main-image img').attr('src') +')'
				});

				if( $(window).width() >= 992 ) {
					$('.skills-x-img .main-image .img').css({
						width: $(window).width() / 2 - 15,
						height: $('.skills-x-img .center-image').closest('.vc_row').outerHeight(),
						top: '-' + $('.skills-x-img .center-image').closest('.vc_row').css('padding-top')
					});
				} else {
					$('.skills-x-img .main-image .img').css({
						width: $(window).width(),
						left: $('.skills-x-img .center-image').closest('.vc_row').css('left').split('p')[0]-15,
						height: 600,
						top: $('.skills-x-img .center-image').closest('.vc_row').css('padding-bottom')
					});
					$('.skills-x-img .center-image').closest('.skills-x-img').height( 600 );
				}

				if( $(window).width() < 768 ) {
					$('.skills-x-img .main-image .img').css('height', 400);
					$('.skills-x-img .center-image').closest('.skills-x-img').height( 400 );
				}
				if( $(window).width() < 450 ) {
					$('.skills-x-img .main-image .img').css('height', 200);
					$('.skills-x-img .center-image').closest('.skills-x-img').height( 200 );
				}
				$('.skills-x-img .center-image').hide();
				
			}, 300);
		}
	}

	function absoluteImage() {
		if( $('.absolute-image-right .wpb_single_image img').length ) {
			if( $(window).width() > 768 ) {
				$('.absolute-image-right .wpb_single_image img').css({
					width: ( $(window).width() / 2 ),
					position: 'absolute',
					display: 'block',
					left: 0,
					'max-width': 'none'
				});
			} else {
				$('.absolute-image-right .wpb_single_image img').css({
					width: 'auto',
					position: 'relative',
					display: 'block',
					left: 0,
					'max-width': '100%'
				});
			}
		}
	}

	$(window).scroll(function(){
		image_width();
	});


	/*============================*/
	/* 04 - FUNCTION ON PAGE LOAD */
	/*============================*/
	$(window).load(function(){
		absoluteImage();

		if($(window).scrollTop()>0){
			$('.header').addClass('scrolled');
		}
		
		image_width();

		$('#loading').fadeOut();
		initSwiper();

		var initValue = $('.filter-nav').find('.selected a').attr('data-filter');
		$container.isotope({itemSelector: '.item', filter: initValue,masonry:{gutter:0,columnWidth:'.grid-sizer'}});

		if( $('.main-nav').length ) {
			$('.main-nav .menu > li.menu-item-has-children > a').after( '<i class="sub-toggle fa fa-angle-down"></i>' );
		}
		
	});

	/*==============================*/
	/* 05 - FUNCTION ON PAGE RESIZE */
	/*==============================*/
	function resizeCall(){
		pageCalculations();

		$('.swiper-container.initialized[data-slides-per-view="responsive"]').each(function(){
			var thisSwiper = swipers['swiper-'+$(this).attr('id')], $t = $(this), slidesPerViewVar = updateSlidesPerView($t);
			thisSwiper.params.slidesPerView = slidesPerViewVar;
			thisSwiper.reInit();
			var paginationSpan = $t.find('.pagination span');
			var paginationSlice = paginationSpan.hide().slice(0,(paginationSpan.length+1-slidesPerViewVar));
			if(paginationSlice.length<=1 || slidesPerViewVar>=$t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
			else $t.removeClass('pagination-hidden');
			paginationSlice.show();
		});
	}
	if(!_ismobile){
		$(window).resize(function(){
			resizeCall();
		});
	} else{
		window.addEventListener("orientationchange", function() {
			resizeCall();
		}, false);
	}

	/*==============================*/
	/* 06 - FUNCTION ON PAGE SCROLL */
	/*==============================*/
	$(window).scroll(function(){
		if($(window).scrollTop()>0){
			$('.header').addClass('scrolled');
		} else {
			$('.header').removeClass('scrolled');
		}

		if( $('.header.style-3').length && winW >=768){
			var $headerS3 = $('.header.style-3');
			var heightS3 = $headerS3.height();
			if($(window).scrollTop()>heightS3+80){
				$headerS3.addClass('show');
			} else{
				$headerS3.removeClass('show');
			}		
		}
	});	

	/*=====================*/
	/* 07 - SWIPER SLIDERS */
	/*=====================*/
	function initSwiper(){
		var initIterator = 0;
		$('.swiper-container').each( function(){		
			var $t = $(this);								  

			var index = 'swiper-unique-id-'+initIterator;

			$t.addClass('swiper-'+index + ' initialized').attr('id', index);
			$t.find('.pagination').addClass('pagination-'+index);

			var autoPlayVar = parseInt($t.attr('data-autoplay'),10);
			var centerVar = parseInt($t.attr('data-center'),10);
			var simVar = ($t.closest('.circle-description-slide-box').length)?false:true;

			var slidesPerViewVar = $t.attr('data-slides-per-view');
			if(slidesPerViewVar == 'responsive'){
				slidesPerViewVar = updateSlidesPerView($t);
			}
			else slidesPerViewVar = parseInt(slidesPerViewVar,10);

			var loopVar = parseInt($t.attr('data-loop'),10);
			var speedVar = parseInt($t.attr('data-speed'),10);

			var slidesPerGroup = parseInt($t.attr('data-slides-per-group'),10);
			if(!slidesPerGroup){slidesPerGroup=1;}			

			swipers['swiper-'+index] = new Swiper('.swiper-'+index,{
				speed: speedVar,
				pagination: '.pagination-'+index,
				loop: loopVar,
				paginationClickable: true,
				autoplay: autoPlayVar,
				slidesPerView: slidesPerViewVar,
				slidesPerGroup: slidesPerGroup,
				keyboardControl: true,
				calculateHeight: true, 
				simulateTouch: simVar,
				centeredSlides: centerVar,
				roundLengths: true,
				onInit: function(swiper){
					var browserWidthResize = $(window).width();
					if (browserWidthResize < 750) {
							swiper.params.slidesPerGroup=1;
					} else { 
                      swiper.params.slidesPerGroup=slidesPerGroup;
					}
				},
				onResize: function(swiper){
					var browserWidthResize2 = $(window).width();
					if (browserWidthResize2 < 750) {
							swiper.params.slidesPerGroup=1;
					} else { 
                      swiper.params.slidesPerGroup=slidesPerGroup;
					  swiper.resizeFix(true);
					}					
				},									
				onSlideChangeEnd: function(swiper){
					var activeIndex = (loopVar===true)?swiper.activeIndex:swiper.activeLoopIndex;
					var qVal = $t.find('.swiper-slide-active').attr('data-val');
					$t.find('.swiper-slide[data-val="'+qVal+'"]').addClass('active');
					var textAnimation = $t.find('.swiper-slide.active .text-animation').attr("data-animation");
					$t.find('.swiper-slide.active .text-animation').addClass('animated ' + textAnimation);
				},
				onSlideChangeStart: function(swiper){
					var textAnimation = $t.find('.swiper-slide.active .text-animation').attr("data-animation");
					$t.find('.swiper-slide.active .text-animation').removeClass('animated ' + textAnimation);
					$t.find('.swiper-slide.active').removeClass('active');

				},
				onSlideClick: function(swiper){

				}
			});
			swipers['swiper-'+index].reInit();
			if($t.attr('data-slides-per-view')=='responsive'){
				var paginationSpan = $t.find('.pagination span');
				var paginationSlice = paginationSpan.hide().slice(0,(paginationSpan.length+1-slidesPerViewVar));
				if(paginationSlice.length<=1 || slidesPerViewVar>=$t.find('.swiper-slide').length) $t.addClass('pagination-hidden');
				else $t.removeClass('pagination-hidden');
				paginationSlice.show();
			}
			initIterator++;
		});
	}

	function updateSlidesPerView(swiperContainer){
		if(winW>=addPoint) return parseInt(swiperContainer.attr('data-add-slides'),10);
		else if(winW>=lgPoint) return parseInt(swiperContainer.attr('data-lg-slides'),10);
		else if(winW>=mdPoint) return parseInt(swiperContainer.attr('data-md-slides'),10);
		else if(winW>=smPoint) return parseInt(swiperContainer.attr('data-sm-slides'),10);
		else return parseInt(swiperContainer.attr('data-xs-slides'),10);
	}

	//swiper arrows
	$('.swiper-arrow-left').on("click", function(){
		swipers['swiper-'+$(this).parent().attr('id')].swipePrev();
	});

	$('.swiper-arrow-right').on("click", function(){
		swipers['swiper-'+$(this).parent().attr('id')].swipeNext();
	});

	/*==============================*/
	/* 08 - BUTTONS, CLICKS, HOVERS */
	/*==============================*/
	// top menu
	$(".cmn-toggle-switch").on("click", function(){
		$(this).toggleClass("active");
		$('.header').toggleClass("active");
		$('.main-nav').slideToggle();
		return false;
	});
	$('.menu').on('click', '.sub-toggle', function(e){
		$(this).siblings("ul").slideToggle();
		return false;
	});		

	//video background
	if($('.video-slide').length){
		var video = $('.video-slide').attr('data-video');
		$('.video-slide').tubular({videoId: video});
	}


	//isotope filter
	$container = $('.filter-content');
	$('.filter-nav').on( 'click', 'a', function() {
		var filterValue = $(this).attr('data-filter');
		$container.isotope({ filter: filterValue });
		var $buttonGroup = $(this).parent().parent();
		$buttonGroup.find('.selected').removeClass('selected');
		$(this).parent().addClass('selected');
	});

	//counters
	$('.counters').viewportChecker({
		classToAdd: 'counted',
		offset: 100,
		callbackFunction: function(elem, action){
			elem.find('.count-number').countTo();		
		}		
	});

	//circliful
	$('.circle-wrapper').viewportChecker({
		classToAdd: 'counted',
		offset: 100,
		callbackFunction: function(elem, action){
			elem.find('.circle').circliful();
		}
	});

	//video-play

	$('.video-block').each(function(){
		var $this = $(this);
		$(this).find('.video-play').on("click", function(){
			var video = $this.find('.video-play').data('video');			
			$this.find('.popup-video').show();
			$this.find('.popup-video .movie iframe').attr('src',video);
			return false;
		});	
		$(this).find('.close-button').on("click", function(){
			$this.find('.popup-video').hide();
			$this.find('.popup-video .movie iframe').attr('src','');
			return false;
		});	
	});				

	/*=====================*/
	/* 09 - LIGHT-BOX */
	/*=====================*/
	
	/*activity indicator functions*/
	var activityIndicatorOn = function(){
		$( '<div id="imagelightbox-loading"><div></div></div>' ).appendTo( 'body' );
	};
	var activityIndicatorOff = function(){
		$( '#imagelightbox-loading' ).remove();
	};
	
	/*close button functions*/
	var closeButtonOn = function(instance){
		$('<button type="button" id="imagelightbox-close" title="Close"></button>').appendTo('body').on('click touchend', function(){ $(this).remove(); instance.quitImageLightbox(); return false; });
	};
	var closeButtonOff = function(){
		$('#imagelightbox-close').remove();
	};
	
	/*overlay*/
	var overlayOn = function(){$('<div id="imagelightbox-overlay"></div>').appendTo('body');};
	var overlayOff = function(){$('#imagelightbox-overlay').remove();};	
	
	/*caption*/
	var captionOff = function(){$('#imagelightbox-caption').remove();};
	var captionOn = function(){
		var description = $('a[href="' + $('#imagelightbox').attr('src') + '"] img').attr('alt');
		var author = $('a[href="' + $( '#imagelightbox' ).attr('src') + '"] img').attr('data-author');
		if(description.length > 0 && author.length > 0)
			$('<div id="imagelightbox-caption">' + description + '<span> - </span>' + author +'</div>').appendTo('body');
	};

	/*arrows*/
	var arrowsOn = function( instance, selector ){
		var $arrows = $( '<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"><i class="fa fa-chevron-left"></i></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"><i class="fa fa-chevron-right"></i></button>' );
		$arrows.appendTo('body');
		$arrows.on('click touchend', function(e)
		{
			e.preventDefault();
			var $this	= $(this),
				$target	= $(selector + '[href="' + $('#imagelightbox').attr('src') + '"]' ),
				index	= $target.index(selector);
			if( $this.hasClass('imagelightbox-arrow-left') )
			{
				index = index - 1;
				if( !$(selector).eq(index).length )
					index = $(selector).length;
			}
			else
			{
				index = index + 1;
				if( !$(selector).eq(index).length )
					index = 0;
			}
			instance.switchImageLightbox(index);
			return false;
		});
	};
	var arrowsOff = function(){$('.imagelightbox-arrow').remove();};	
			
	var selectorG = '.lightbox';		
	var instanceG =$(selectorG).imageLightbox({
		quitOnDocClick:	false,
		onStart:		function() {arrowsOn( instanceG, selectorG );overlayOn(); closeButtonOn(instanceG); },
		onEnd:			function() {arrowsOff();captionOff(); overlayOff(); closeButtonOff(); activityIndicatorOff(); },
		onLoadStart: 	function() {captionOff(); activityIndicatorOn(); },
		onLoadEnd:	 	function() {$('.imagelightbox-arrow').css('display', 'block');captionOn(); activityIndicatorOff(); }
	});	



})(jQuery, window, document);