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

                    <?php if($images){?>
					<div id="gallery">
					<?php foreach($images as $image){?>
						<a href="<?php echo $image['popup']; ?>"><img src="<?php echo $image['popup']; ?>" alt="" /></a>
					<?php } ?>
					</div>
					<?php } ?>
                </div>
            </div>
        </div>

        <!-- end bread-crumbs -->

    </main>
<?php echo $footer; ?> 