<?php 
	include_once "./header.php";
	include_once "admin/ep-content/add-product/insert_product.php";
	include_once "admin/ep-content/category/class-category.php";
	include_once "./ep-content/global/function.php";
	if(!isset($_GET['id'])){
		echo "<script>location.href='index.php'</script>";
	}elseif($_GET['id'] == ""){
		echo "<script>location.href='index.php'</script>";
	}
	$id = htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_GET['id'])));
	$row = $product->product($id);
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
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="<?php echo ep_option($con,'siteurl')."/".$row['primary_image'];?>" alt="" />
								<h3>ZOOM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="<?php echo ep_option($con,'siteurl')."/".$row['image_one'];?>" alt=""></a>
										  <a href=""><img src="<?php echo ep_option($con,'siteurl')."/".$row['image_two'];?>" alt=""></a>
										  <a href=""><img src="<?php echo ep_option($con,'siteurl')."/".$row['image_three'];?>" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="<?php echo ep_option($con,'siteurl')."/".$row['image_for'];?>" alt=""></a>
										  <a href=""><img src="<?php echo ep_option($con,'siteurl')."/".$row['image_one'];?>" alt=""></a>
										  <a href=""><img src="<?php echo ep_option($con,'siteurl')."/".$row['image_two'];?>" alt=""></a>
										</div>
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<?php 
									if(isset($_SESSION['massege'])){
										echo "<div class='alert alert-success'>
											".$_SESSION['massege']."
										</div>";
										$_SESSION['massege'] = null;
									}
								?>
								<h2><?php echo $row['product_title'];?></h2>
								<p>Web ID: <?php echo $row['prd_id'];?></p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
								<?php 
									if($row['product_carency'] == 'TAKA' or $row['product_carency'] == 'taka'){
										$symbol = "&#2547;";
									}
								?>
								<form action="<?php echo ep_option($con,'siteurl');?>/ep-content/request_checker/cart.php" method="post">
									<?php 
										$_SESSION["product_items"] = $row['id'];
									?>
									<span> <?php echo $symbol . " ".$row['product_price'];?></span>
										<label>Quantity:</label>
										<input name="quantity" type="text" value="1" required/>
										<button type="submit" class="btn btn-fefault cart">
											<i class="fa fa-shopping-cart"></i>
											Add to cart
										</button>
									</span>
								</form>
								<p><b>Product Name:</b> <?php echo $row['product_name'];?></p>
								<p><b>Availability:</b> <?php echo $row['product_availability'];?></p>
								<p><b>Condition:</b> <?php echo $row['product_condition'];?></p>
								<p><b>Brand:</b> <?php echo $row['manufacture_name'];?></p>
								<p><b>Category:</b> <?php echo $row['category_name'];?></p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Details</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews (5)</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<p><b>Author Name:</b> <?php echo $row['auth_name'];?></p>
								<p><b>Product Title:</b> <?php echo $row['product_title'];?></p>
								<p><b>Product Descrition:</b> <?php echo $row['product_details'];?></p>
								<p><b>Product Name:</b> <?php echo $row['product_name'];?></p>
								<p><b>Availability:</b> <?php echo $row['product_availability'];?></p>
								<p><b>Condition:</b> <?php echo $row['product_condition'];?></p>
								<p><b>Brand:</b> <?php echo $row['manufacture_name'];?></p>
								<p><b>Category:</b> <?php echo $row['category_name'];?></p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery1.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery3.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery2.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/gallery4.jpg" alt="" />
												<h2>$56</h2>
												<p>Easy Polo Black Edition</p>
												<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="<?php $_SESSION['product_id'] = $id; echo ep_option($con,"siteurl")."/ep-content/request_checker/review.php";?>" method="POST">
										<span>
											<input name="name" type="text" placeholder="Your Name"/>
											<input name="email" type="email" placeholder="Email Address"/>
										</span>
										<textarea name="comment" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button name="review_btn" type="submit" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
</section>


<?php 
	include_once "./footer.php";