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
                    
                    <?php echo $text_empty; ?>
                
                </div>
            </div>
        </div>

        <!-- end bread-crumbs -->

    </main>


<?php echo $footer; ?>