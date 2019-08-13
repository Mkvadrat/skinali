    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="form banner-form">
                        <p class="h2-title">Оставить заявку на расчёт стоимости</p>
                        <fieldset id="sendFormHeader">
                            <div class="warning"></div>
                            <label for="#name">Ваше имя</label>
                            <input id="name_header" name="name" class="reset_input" value="" type="text">
                            <label for="tel">Ваш мобильный номер</label>
                            <input id="tel_header" name="tel" class="reset_input" value="" type="text">
                            <span><i class="fa fa-lock" aria-hidden="true"></i>Ваши данные надёжно защищены</span>
                            
                            <?php echo $captcha; ?>
                             
                            <input class="button" onclick="sendFormHeader();" type="submit" value="Оставить заявку">
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>