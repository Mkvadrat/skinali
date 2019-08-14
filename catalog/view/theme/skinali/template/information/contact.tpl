<?php echo $header; ?>

    <main class="main-contacts">
        
        <!-- start bread-crumbs -->

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="bread-crumbs">
						<?php			
							$count = count($breadcrumbs);
							$i=1;
							foreach ($breadcrumbs as $breadcrumb) {
								if($i!=$count){
						?>
									<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a><?php echo ' ' . $breadcrumb['separator']; ?></li>
						<?php
								}else{
									echo '<li><span> '.$breadcrumb['text'] . '</span></li>'; 
								}		
								$i++;
							} 
						?>
                    </ul>

                    <p class="h1-title">Контакты</p>

                </div>

                <div class="col-md-6">
                    <div class="contacts-block">
                        <?php echo $contact_inf; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="map-block">

                    <div id="YMapsID" style="width:100%; height:280px"></div>
                    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
                    <script type="text/javascript">
                     
                        var myMap, myPlacemark, coords;
                     
                        ymaps.ready(init);
                     
                            function init () {
                     
                                //Определяем начальные параметры карты
                                myMap = new ymaps.Map('YMapsID', {
                                        center: [<?php if(!empty($geocode)){ ?><?php echo $geocode; ?><?php }else{ echo '56.326944, 44.0075'; } ?>], 
                                        zoom: 15
                                    });	
                     
                                //Определяем элемент управления поиск по карте	
                                var SearchControl = new ymaps.control.SearchControl({noPlacemark:true});	
                     
                                //Добавляем элементы управления на карту
                                 myMap.controls              
                                    .add('zoomControl')                
                                    .add('typeSelector')
                                    
                                coords = [<?php if(!empty($geocode)){ ?><?php echo $geocode; ?><?php }else{ echo '56.326944, 44.0075'; } ?>];
                     
                                //Определяем метку и добавляем ее на карту				
                                myPlacemark = new ymaps.Placemark([<?php if(!empty($geocode)){ ?><?php echo $geocode; ?><?php }else{ echo '56.326944, 44.0075'; } ?>],{}, {preset: "twirl#redIcon", draggable: true});	
                     
                                myMap.geoObjects.add(myPlacemark);			
                        }
                    </script>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="devider"></div>
                </div>

                <div class="col-md-5">
                    <p class="h2-title">Форма обратной связи</p>
                    <p>Вы можете задать интересующий Вас вопрос при помощи формы обратной связи</p>

                    <div class="form contact-form">
                        <fieldset id="sendFullForm">
                            <div class="warning"></div>
                            <label for="#name">Ваше имя</label>
                            <input id="name_contact_page" name="name" class="reset_input" value="" type="text">
                            <label for="tel">Ваш мобильный номер</label>
                            <input id="tel_contact_page" name="tel" class="reset_input" value="" type="tel">
                            <label for="#question">Ваш вопрос или комментарий</label>
                            <textarea id="question_contact_page" name="question" class="reset_input"></textarea>
                            
                            <?php echo $captcha; ?>
                            
                            <input class="button" onclick="sendFullForm();" type="submit" value="Оставить">
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-1 col-md-1-offset"></div>

                <div class="col-md-6">
                    <img src="catalog/view/theme/skinali/images/contact.jpg" alt="">
                </div>
            </div>
        </div>

        <!-- end bread-crumbs -->

    </main>
    
<?php echo $footer; ?>
