<main class="main-index">

    <div class="container-fluid bg-grey">

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

    </div>

    

    <?php if($latest_gallery){ ?>

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <p class="h1-title">МОНТАЖ СКИНАЛЕЙ</p>

                <ul class="products-list">

                    <?php foreach($latest_gallery as $gallery){ ?>

                    <li>

                        <a href="<?php echo $gallery['image']; ?>" class="gallery" rel="group">

                            <img src="<?php echo $gallery['image']; ?>" alt="">

                        </a>

                    </li>

                    <?php } ?>

                </ul>

                

                <p class="button-block">

                    <a class="button button-gallery" onclick="ajaxGallery()">посмотреть все изображения</a>

                </p>

            </div>

        </div>

    </div>

    <?php } ?>

</main>



<script type="text/javascript">

    $(document).ready(function() {

        $("a.gallery").fancybox();

    });

</script>



<script type="text/javascript">    

    function ajaxGallery(){

        $.ajax({

            url: 'index.php?route=module/block4/ajaxGallery',

            type: 'post',

            dataType: 'json',

            success: function(json) {

                

                //console.log(json.image);

                    

                $.fancybox(json.image, {

                    width: 905,

                    height: 505

                }); 

            }

        });

    }

</script>

