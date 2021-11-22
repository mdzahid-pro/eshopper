<?php 
	include_once "./header.php";
	//include_once "./slider.php";
	include_once "admin/ep-content/add-product/insert_product.php";
	include_once "admin/ep-content/category/class-category.php";


?>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<?php 
								//make a object
								$obj = new CATEGORY($con);
								$obj->get_category();
							?>
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Brands</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<?php 
										$obj->get_category('ep_manufacture');
									?>
								</ul>
							</div>
						</div><!--/brands_products-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>

							<?php foreach($product->categoryProduct($_GET['id']) as $prd){ ?>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center">
													<img style="max-width: 100%;" height="240" src="<?php echo $prd['primary_image'];?>" alt="" />
													<h2><?php echo $prd['product_price'];?></h2>
													<p><?php echo $prd['product_name'];?></p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												<div class="product-overlay">
													<div class="overlay-content">
														<h2><?php echo $prd['product_price'];?></h2>
														<p><?php echo $prd['product_title'];?></p>
														<a href="<?php echo ep_option($con,'siteurl')."/product-details.php?id=".$prd['id'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
													</div>
												</div>
										</div>
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
												<li><a href="<?php echo ep_option($con,'siteurl')."/product-details.php?id=".$prd['id'];?>"><i class="fa fa-plus-square"></i>View Product</a></li>
											</ul>
										</div>
									</div>
								</div>
							<?php } ?>
						
					</div>

					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<?php //echo "<pre>"; var_dump($product->all_brand()[0]);	?>
							<ul class="nav nav-tabs">
							<?php foreach($product->all_brand() as $key => $prd){?>
								
								<li <?php if($key == 0){echo "class='active'";}?> ><a href="#<?php echo $prd['manufacture_name'];?>" data-toggle="tab"><?php echo $prd['manufacture_name'];?></a></li>
							<?php } ?>
							</ul>
						</div>
						<div class="tab-content">
							<?php 
								foreach($product->all_brand() as $key => $prd){
									$data = $product->all_product(brand: $prd['id']);
									//echo "<pre>";var_dump($data);
							?>
							<div class="tab-pane fade <?php if($key == 0){echo "active";}?> in" id="<?php echo $prd['manufacture_name'];?>" >
								<?php foreach($data as $dt){?>
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img height="150" src="<?php echo $dt['primary_image'];?>" alt="" />
													<h2><?php echo $dt['product_price'];?></h2>
													<p><?php echo $dt['product_title'];?></p>
													<a href="<?php echo ep_option($con,'siteurl')."/product-details.php?id=".$prd['id'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
							
							<?php } ?>
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									<?php foreach($product->all_product(length: 3) as $prd){ ?>

									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img height="150px"  src="<?php echo $prd['primary_image'];?>" alt="" />
													<h2><?php echo $prd['product_price'];?></h2>
													<p><?php echo $prd['product_title'];?></p>
													<a href="<?php echo ep_option($con,'siteurl')."/product-details.php?id=".$prd['id'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>

							 		<?php } ?>
								</div>
								<div class="item">	
									<?php foreach($product->all_product(length: 3) as $prd){ ?>

									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img height="150px"  src="<?php echo $prd['primary_image'];?>" alt="" />
													<h2><?php echo $prd['product_price'];?></h2>
													<p><?php echo $prd['product_title'];?></p>
													<a href="<?php echo ep_option($con,'siteurl')."/product-details.php?id=".$prd['id'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>

									<?php } ?>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
<?php 
	include_once "./footer.php";