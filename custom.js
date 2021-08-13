jQuery(document).ready(function() {
	jQuery('.iw_optin_left, .cf7_form_wrap').addClass("fwf-hidden").viewportChecker({
		classToAdd: 'fwf-visible animated fadeInLeft',
		offset: 100
	});
	jQuery('.iw_optin_right').addClass("fwf-hidden").viewportChecker({
		classToAdd: 'fwf-visible animated fadeInRight',
		offset: 100
	});
});

jQuery(function ($) {
	//$('.check_it_out, .trigger_signup').unbind('click');
	//$('.check_it_out, .trigger_signup').bind('click', showModal);
	
	function showModal() {
		$('#modal_offer_box').modal({overlayClose:true, minWidth:680, minHeight:366});
	}
	
	var d =  new Date();
	var today = (d.getMonth() + 1) + ' ' + d.getDate() + ' ' + d.getFullYear();

	$('.CountdownContainer').countdown({
		date: today + " 23:59:59",
		//date: "10 29 2013 23:59:59",
		//date: + {new Date(month, day, year)} + 10000,
		render: function(data) {
          var el = $(this.el);
          el.empty()
            .append("<div class='time_box'>" + this.leadingZeros(data.hours, 2) + " <span>hrs</span></div>")
            .append("<div class='time_box'>" + this.leadingZeros(data.min, 2) + " <span>min</span></div>")
            .append("<div class='time_box'>" + this.leadingZeros(data.sec, 2) + " <span>sec</span></div>");
        }
	});
});