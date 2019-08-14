function l_image (a) {
    document.example_img.src=a
}

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

function sendFullHiddenForm() {
    var data = $('#sendFullHiddenForm').serialize();
    
    $.ajax({
        url: 'index.php?route=common/footer/sendFullForm',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (data) {
            if(data.success){
                $(".warning").html('');
                
                $(".reset_input").val('');
    
                swal({
                    title: data.success,
                    text: "",
                    timer: 1000,
                    showConfirmButton: false
                });
    
                $.fancybox.close();
                
                location.reload();
            }
            
            if(data.error){
                var error = data.error;
                $(".warning").html('<div class="warning">' + error.join("") + '</div>');
            }
        }
    });
}

function sendFullForm() {
    var data = $('#sendFullForm').serialize();
    
    $.ajax({
        url: 'index.php?route=information/contact/sendFullForm',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (data) {
            if(data.success){
                $(".warning").html('');
                
                $(".reset_input").val('');
    
                swal({
                    title: data.success,
                    text: "",
                    timer: 1000,
                    showConfirmButton: false
                });
    
                $.fancybox.close();
                
                location.reload();
            }
            
            if(data.error){
                var error = data.error;
                $(".warning").html('<div class="warning">' + error.join("") + '</div>');
            }
        }
    });
}

function sendFormHeader() {
    var data = $('#sendFormHeader').serialize();
    
    $.ajax({
        url: 'index.php?route=module/bidbanner/sendFormHeader',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (data) {
            if(data.success){
                $(".warning").html('');
                
                $(".reset_input").val('');
    
                swal({
                    title: data.success,
                    text: "",
                    timer: 1000,
                    showConfirmButton: false
                });
    
                $.fancybox.close();
                
                location.reload();
            }
            
            if(data.error){
                var error = data.error;
                $(".warning").html('<div class="warning">' + error.join("") + '</div>');
            }
        }
    });
}

function sendFormFooter() {
    var data = $('#sendFormFooter').serialize();
    
    $.ajax({
        url: 'index.php?route=module/block6/sendFormFooter',
        type: 'post',
        data: data,
        dataType: 'json',
        success: function (data) {
            if(data.success){
                $(".warning").html('');
                
                $(".reset_input").val('');
    
                swal({
                    title: data.success,
                    text: "",
                    timer: 1000,
                    showConfirmButton: false
                });
    
                $.fancybox.close();
                
                location.reload();
            }
            
            if(data.error){
                var error = data.error;
                $(".warning").html('<div class="warning">' + error.join("") + '</div>');
            }
        }
    });
}