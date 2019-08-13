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

                <div class="col-lg-5 col-md-5 col-sm-12">

                    <p class="all-rights">Skinali 2018 все права защищены</p>

                </div>

                <div class="col-lg-7 col-md-5 col-sm-12">

                    <p class="developed-in"><a class="make-in" href="http://mkvadrat.com/" target="_blank">Сайт разработан в <img src="catalog/view/theme/skinali/images/icon-m2.jpg" alt=""></a></p>

                </div>

            </div>

        </div>

    </footer>

	

	<div class="hidden">

        <div id="call-back">

            <div class="form banner-form">

                <p class="h2-title">Заказать бесплатный звонок</p>

                <fieldset id="sendFullHiddenForm">

                    <span>Введите, пожалуйста, Ваши контактные данные</span>
                    
                    <div class="warning"></div>
                    
                    <label for="#name">Ваше имя</label>

                    <input id="name_full_hidden_form" name="name" class="reset_input" value="" type="text">

                    <label for="tel">Ваш мобильный номер</label>

                    <input id="tel_full_hidden_form" name="tel" class="reset_input" value="" type="tel">

                    <label>Ваш вопрос или комментарий</label>

                    <textarea id="question_full_hidden_form" name="question" class="reset_input"></textarea>

                    <span><i class="fa fa-lock" aria-hidden="true"></i>Ваши данные надёжно защищены</span>
                    
                    <?php echo $captcha; ?>

                    <input class="button" onclick="sendFullHiddenForm();" type="submit" value="Оставить заявку">

                </fieldset>

            </div>

        </div>

        <!--<div id="application">

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

        </div>-->

    </div>

    <!-- end footer -->

<!-- Смена картинки при клике -->

</body>
</html>