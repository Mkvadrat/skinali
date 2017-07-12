    <!-- start footer -->

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 top-line">
                    <div class="block-logo-footer">
                        <p>
                            <?php if ($logo) { ?>
                                <a class="logo-footer" href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a>
                            <?php } else { ?>
                                <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
                            <?php } ?>
                        </p>
                        <ul>
                            <li><a href="<?php echo $instagram; ?>"><img src="catalog/view/theme/skinali/images/icon-insta.jpg" alt=""></a></li>
                            <li><a href="<?php echo $facebook; ?>"><img src="catalog/view/theme/skinali/images/icon-fb.png" alt=""></a></li>
                        </ul>
                    </div>
                    <?php echo $footer_text; ?>
                    </p>
                    <div class="call-footer">
                        <?php echo $contact_inf; ?>
                    </div>
                </div>
                <div class="col-md-5">
                    <p class="all-rights">Skinali 2017 все права защищены</p>
                </div>
                <div class="col-md-7">
                    <p><a class="make-in" href="http://mkvadrat.com/">Сайт разработан в <img src="catalog/view/theme/skinali/images/icon-m2.jpg" alt=""></a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- end footer -->

<script>
    $(function(){
        $('.but').click(function(){
            $('.block').toggleClass('active');
        });
    });
</script>

<ul>

<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        autoplay:true,
        smartSpeed:2000,
        autoplayTimeout:5000,
        dots:true,
        stopOnHover:true,
        navigationText:["",""],
        rewindNav:true,
        pagination:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
        });

    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("a.fancybox").fancybox();
    });
</script>

<!-- Смена картинки при клике -->

<script type="text/javascript">
    function l_image (a) {
        document.example_img.src=a
    }
</script>

<!-- Добавление активного состояния ссылке при клике -->

<script>
    $(function() {
        $(".work-easily li span a").click(function() {
            $(".work-easily li span a").removeClass("active");         
            $(this).toggleClass("active");
        })
    });
</script>

<script type="text/javascript">
function sendFormHeader(){
	$.ajax({
		url: 'index.php?route=common/footer/sendForm',
		type: 'post',
		data: {  
            'name' : $('#name_header').val(),
            'tel' : $('#tel_header').val(),
        },
		dataType: 'json',
		success: function(data) {
			swal(data.message);
		}
	});
}
    
function sendFormFooter(){
	$.ajax({
		url: 'index.php?route=common/footer/sendForm',
		type: 'post',
		data: {  
            'name' : $('#name_footer').val(),
            'tel' : $('#tel_footer').val(),
        },
		dataType: 'json',
		success: function(data) {
			swal(data.message);
		}
	});
}
</script>

</body>
</html>