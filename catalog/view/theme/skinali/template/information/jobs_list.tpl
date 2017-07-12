<?php echo $header; ?>
    <main class="main-our-project">
        
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

                    <?php echo $content_top; ?>
					
                    <ul class="products-list">
						<?php foreach ($all_posts as $posts) { ?>
                        <li>
                            <a href="<?php echo $posts['view']; ?>">
                                <img src="<?php echo $posts['image']; ?>" alt="">
                                <div class="number" id=""><?php echo $posts['model']; ?></div>
                            </a>
                        </li>
						<?php } ?>
                    </ul>
					
					
                    <ul class="paggination">
						<?php echo $pagination; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- end bread-crumbs -->

    </main>

<?php echo $footer; ?> 