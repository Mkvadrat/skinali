<main class="main-index">

    <?php if($results){ ?>

    <div class="container">

        <div class="row">

            <div class="col-md-12 photo-bank">

                <p class="h1-title">Фотобанк</p>

                <p><strong>Вы можете выбрать изображение для Вашего кухонного<br>фартука из нашего каталога изображений</strong></p>

                <ul class="products-list products-list-photobank">

                    <?php foreach($results as $result){ ?>

                    <li style="background-image: url(<?php echo $result['image']; ?>);">

                        <a href="<?php echo $result['href']; ?>">

                            <!-- <img src="<?php echo $result['image']; ?>" alt=""> -->

                            <div class="number" id=""><?php echo $result['model']; ?></div>

                        </a>

                    </li>

                    <?php } ?>

                </ul>

                <p class="button-block">

                    <a href="<?php echo $view_all; ?>" class="button">посмотреть все изображения</a>

                </p>

            </div>

        </div>

    </div>

    <?php } ?>



    <!-- start banner -->



    <div class="small-banner">

        <div class="container">

            <div class="row">

                <div class="col-md-12">

                    <div class="form banner-form">

                        <p class="h2-title">Оставить заявку на расчёт стоимости</p>

                        <fieldset>

                            <label for="name">Ваше имя</label>

                            <input id="name_footer" type="text">

                            <label for="tel">Ваш мобильный номер</label>

                            <input id="tel_footer" type="tel">

                            <span><i class="fa fa-lock" aria-hidden="true"></i>Ваши данные надёжно защищены</span>

                            <input class="button" onclick="sendFormFooter();" type="submit" value="Оставить заявку">

                        </fieldset>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- end banner -->

</main>

