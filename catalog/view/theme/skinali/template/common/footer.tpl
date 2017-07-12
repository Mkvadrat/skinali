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
	
	<div class="hidden">
        <div id="call-back">
            <div class="form banner-form">
                <p class="h2-title">Заказать бесплатный звонок</p>
                <fieldset>
                    <span>Введите, пожалуйста, Ваши контактные данные</span>
                    <label for="#name">Ваше имя</label>
                    <input id="name_full_hidden_form" type="text">
                    <label for="tel">Ваш мобильный номер</label>
                    <input id="tel_full_hidden_form" type="tel">
                    <label>Ваш вопрос или комментарий</label>
                    <textarea id="question_full_hidden_form"></textarea>
                    <span><i class="fa fa-lock" aria-hidden="true"></i>Ваши данные надёжно защищены</span>
                    <input class="button" onclick="sendFullHiddenForm();" type="submit" value="Оставить заявку">
                </fieldset>
            </div>
        </div>

        <div id="application">
            <div class="form banner-form">
                <p class="h2-title">Оставить заявку на расчёт стоимости</p>
                <fieldset>
                    <span>Введите, пожалуйста, Ваши контактные данные</span>
                    <label for="#name">Ваше имя</label>
                    <input id="name_bid_form" type="text">
                    <label for="tel">Ваш мобильный номер</label>
                    <input id="tel_bid_form" type="tel">
                    <input type="checkbox" id="check_bid_form">
					<input type="hidden" id="checkvalue" value="1">
                    <span>Отправляя заявку на расчет стоимости, я соглашаюсь на обработку своих данных, указаных в заявке, с целью получения расчета стоимости моего изделия</span>
                    <input class="button" onclick="sendBidForm();" type="submit" value="Оставить заявку">
                </fieldset>
            </div>
        </div>
    </div>
    <!-- end footer -->

<!-- Смена картинки при клике -->
<script type="text/javascript">
    function l_image (a) {
        document.example_img.src=a
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox();
    });
</script>

<!-- Формы -->
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

function sendFullForm(){
	$.ajax({
		url: 'index.php?route=common/footer/sendFullForm',
		type: 'post',
		data: {  
            'name' : $('#name_contact_page').val(),
            'tel' : $('#tel_contact_page').val(),
			'question' : $('#question_contact_page').val(),
        },
		dataType: 'json',
		success: function(data) {
			swal(data.message);
		}
	});
}

function sendFullHiddenForm(){
	$.ajax({
		url: 'index.php?route=common/footer/sendFullForm',
		type: 'post',
		data: {  
            'name' : $('#name_full_hidden_form').val(),
            'tel' : $('#tel_full_hidden_form').val(),
			'question' : $('#question_full_hidden_form').val(),
        },
		dataType: 'json',
		success: function(data) {
			swal(data.message);
		}
	});
}

function sendBidForm(){
	var check;
	if($("#check_bid_form").is(':checked')){
		check = $("#checkvalue").val();
	}else{
		check = '';
	}
	
	var data = {  
		'name' : $('#name_bid_form').val(),
		'tel' : $('#tel_full_hidden_form').val(),
		'check' : check,
    };
	
	$.ajax({
		url: 'index.php?route=common/footer/sendBidForm',
		type: 'post',
		data: data,
		dataType: 'json',
		success: function(data) {
			swal(data.message);
		}
	});
}
</script>

</body>
</html>