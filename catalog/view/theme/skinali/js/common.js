$(document).ready(function() {
    /* Search */
    $('.but-search').on('click', function() {
        url = $('base').attr('href');

		var value = $('input[name=\'search\']').val();

		if (value) {
			url += 'search/?search=' + encodeURIComponent(value);
		}

		location = url;
    });

	$('input[name=\'search\']').bind('keydown', function(e) {
		if (e.keyCode == 13) {
            url = $('base').attr('href');
    
            var value = $(this).val();
    
            if (value) {
                url += 'search/?search=' + encodeURIComponent(value);
            }
    
            location = url;
		}
	});

	$(".menu-button").click(function() {
		$(".menu-block .menu").slideToggle();
	});
    
    $(".fancybox").fancybox();
    
    $( '#gallery' ).jGallery();
});