jQuery(function() {
	var wedding_state = true;
	jQuery('#wedding-p2').hide();
	jQuery( "#wedding-btn" ).click(function() {
		if ( wedding_state ) {
			jQuery( "#wedding-txt" ).animate({
				width:'68%'
			}, 1000, '',
			function() { hideP1('wedding'); });
		} else {
			jQuery( "#wedding-txt" ).animate({
				width: '21%'
			}, 1000, '',
			function() { showP1('wedding'); });
		}
		wedding_state = !wedding_state;
	});
	
	
});
