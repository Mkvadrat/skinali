<main class="main-index">

    <?php if($results){ ?>

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <p class="h1-title">Наши работы</p>

                <ul class="products-list">

                    <?php foreach($results as $result){ ?>

                    <li>

                        <a href="<?php echo $result['href']; ?>">

                            <img src="<?php echo $result['image']; ?>" alt="">

                            <div class="number" id=""><?php echo $result['model']; ?></div>

                        </a>

                    </li>

                    <?php } ?>

                </ul>

                <p class="button-block">

                    <a href="<?php echo $view_all; ?>" class="button">посмотреть все работы</a>

                </p>

            </div>

        </div>

    </div>

    <?php } ?>

</main>

