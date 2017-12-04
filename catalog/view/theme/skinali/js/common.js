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

    $('.block-links .with').click(function() {
    	$('.with-without').attr('style', 'background-image: url(catalog/view/theme/skinali/images/photo-14.jpg);');
    });

    $('.block-links .without').click(function() {
    	$('.with-without').attr('style', 'background-image: url(catalog/view/theme/skinali/images/photo-15.jpg);');
    });

    $('.block-links a').click(function() {
    	$('.block-links a').removeClass('active');
    	$(this).addClass('active');
    });
});