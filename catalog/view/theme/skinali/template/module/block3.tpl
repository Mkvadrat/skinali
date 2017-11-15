<main class="main-index">

    <?php if($results){ ?>

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                

                <?php //var_dump($results); ?>

                <p class="h1-title">Наши проекты</p>

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

                    <a href="<?php echo $view_all; ?>" class="button">посмотреть все проекты</a>

                </p>

            </div>

        </div>

    </div>

    <?php } ?>

    

    <div class="container">

        <div class="row">

            <div class="col-md-12">

              <?php if($heading_title) { ?>

                <h2><?php echo $heading_title; ?></h2>

              <?php } ?>

              <?php echo $html; ?>

            </div>

        </div>

    </div>

</main>

