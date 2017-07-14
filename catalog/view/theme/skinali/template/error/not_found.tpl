<?php echo $header; ?>

    <main class="main-404">
        
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

                    <p class="h1-title">Ошибка 404</p>
                    <p>Объект не найден</p>
                </div>
            </div>
        </div>

        <!-- end bread-crumbs -->

    </main>


<?php echo $footer; ?>