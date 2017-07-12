<?php echo $header; ?>

    <main class="main-object">
        
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
                    
                    
                    <p class="h1-title"><?php echo $heading_title; ?></p>
                    <p>Изображение <strong>№<?php echo $model; ?></strong></p>

                    <p>
                        <?php if ($image) { ?>
                            <img src="<?php echo $image; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" />
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- end bread-crumbs -->

    </main>

<?php echo $footer; ?>
