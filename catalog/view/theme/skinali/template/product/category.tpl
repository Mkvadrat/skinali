<?php echo $header; ?>

     <main class="main-photo-bank">
        
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
				
				<?php if($description){ ?>
					<?php echo $description; ?>
				<?php } ?>
				
				<?php if ($categories) { ?>
				<ul class="products-list">
					<?php foreach ($categories as $category) { ?>
					<li>
					    <a href="<?php echo $category['href']; ?>">
						   <img src="<?php echo $category['image']; ?>" alt="">
						   <div class="number" id=""><?php echo $category['name']; ?></div>
					    </a>
					</li>
					<?php } ?>
				</ul>
				<?php } ?>
				
				<hr>
				
				<?php if ($products) { ?>
				<ul class="products-list">
					<?php foreach ($products as $product) { ?>
					<li>
					    <a href="<?php echo $product['href']; ?>">
						   <img src="<?php echo $product['thumb']; ?>" alt="">
						   <div class="number" id=""><?php echo $product['model']; ?></div>
					    </a>
					</li>
					<?php } ?>
				</ul>
				<?php } ?>
				
				<ul class="paggination">
					<?php echo $pagination; ?>
                    </ul>
				
				<?php if (!$categories && !$products) { ?>
					<p><?php echo $text_empty; ?></p>
					<a class="button" href="<?php echo $continue; ?>"><?php echo $button_continue; ?></a>
				<?php } ?>
                  </div>
              </div>
          </div>
     
          <!-- end bread-crumbs -->

    </main>
   
<?php echo $footer; ?>
