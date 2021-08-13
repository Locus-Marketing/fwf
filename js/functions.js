jQuery(function ($) {
	// OPACITY OF BUTTON SET TO 0%
	$('.fwf-transformation-wall a').each(function(i, obj) {
		$(this).prepend('<span class="roll">&nbsp;</span>');
		$(this).find(".roll").css("opacity","0");
		
		// ON MOUSE OVER
		$(this).find(".roll").hover(function () {
		 
		// SET OPACITY TO 70%
		$(this).stop().animate({
		opacity: .7
		}, "slow");
		},
		 
		// ON MOUSE OUT
		function () {
		 
		// SET OPACITY BACK TO 50%
		$(this).stop().animate({
		opacity: 0
		}, "slow");
		});
	});
	
	//viewportChecker Animation
	jQuery('.t_image_container').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated fadeIn', offset: 100 });
	jQuery('.fwf-swing').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated swing', offset: 100 });
	jQuery('.fwf-fadeInLeft').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated fadeInLeft', offset: 100 });
	jQuery('.fwf-fadeInRight').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated fadeInRight', offset: 100 });
	jQuery('.fwf-flipInX').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated flipInX', offset: 100 });
	jQuery('.fwf-flipInY').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated flipInY', offset: 100 });
	jQuery('.fwf-fadeIn').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated fadeIn', offset: 100 });
	jQuery('.fwf-fadeInDown').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated fadeInDown', offset: 100 });
	jQuery('.fwf-fadeInUp, .entry-content .wpb_text_column:not(.about-hover-image) h3, .card-boxes h2').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated fadeInUp', offset: 100 });
	jQuery('.fwf-bounceInDown').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated bounceInDown', offset: 100 });
	jQuery('.fwf-bounceInLeft').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated bounceInLeft', offset: 100 });
	jQuery('.fwf-bounceInRight').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated bounceInRight', offset: 100 });
	jQuery('.fwf-bounceInRight').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated bounceInRight', offset: 100 });
	jQuery('.fwf-slideInDown').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated slideInDown', offset: 100 });
	jQuery('.fwf-slideInUp').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated slideInUp', offset: 100 });
	jQuery('.fwf-slideInLeft').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated slideInLeft', offset: 100 });
	jQuery('.fwf-slideInRight').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated slideInRight', offset: 100 });
	jQuery('.fwf-zoomIn').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated zoomIn', offset: 100 });
	jQuery('.fwf-zoomInUp').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated zoomInUp', offset: 100 });
	jQuery('.fwf-zoomInDown').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated zoomInDown', offset: 100 });
	jQuery('.fwf-zoomInLeft').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated zoomInLeft', offset: 100 });
	jQuery('.fwf-zoomInRight').addClass("fwf-hidden").viewportChecker({ classToAdd: 'fwf-visible animated zoomInRight', offset: 100 });
	
	$('.top-navbar ul.menu').slimmenu(
	{
		resizeWidth: fwf_slimmenu_resizepoint, /* Navigation menu will be collapsed when document width is below this size or equal to it. */
		collapserTitle: '&nbsp;', /* Collapsed menu title. */
		animSpeed: 'medium', /* Speed of the submenu expand and collapse animation. */
		easingEffect: null, /* Easing effect that will be used when expanding and collapsing menu and submenus. */
		indentChildren: false, /* Indentation option for the responsive collapsed submenus. If set to true, all submenus will be indented with the value of the option below. */
		childrenIndenter: '&nbsp;' /* Responsive submenus will be indented with this character according to their level. */
	});
	
	//$(".optinform .name").watermark("Enter Your Name");
	//$(".optinform .email").watermark("Enter Your Primary Email");
	//$(".optinform .phone").watermark("Your Best Phone");
	
	// Load dialog on page load
	//$('#basic-modal-content').modal();

	// Load dialog on click
	$('.check_it_out, .trigger_signup').click(function (e) {
		$('#modal_offer_box').modal({overlayClose:true});
		return false;
	});
	
	//Toggle the SEO content box at the bottom
	$('.toggler').click(function (e) {
		$(this).toggleClass('show').parent('.toggle_content').find('.toggle_hidden').slideToggle();
		if ($(this).hasClass('show')) {
			$(this).text('[-]');
		} else {
			$(this).text('[+]');
		}
	});		
	
});