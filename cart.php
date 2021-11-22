<?php 
	include_once "./header.php";
	include_once "admin/ep-content/add-product/insert_product.php";
	include_once "admin/ep-content/category/class-category.php";
	//include cart object from cart class
	include_once "./ep-content/global/database.php";
	include_once "./ep-content/cart/class_cart.php";
	//if isset user id than diclare object
	if(isset($_SESSION['user_id'])){
		$cart = new CART($con);
	}
?>

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
			<?php 
				if(isset($_SESSION['massege'])){
					echo "<div class='alert alert-success'>
						".$_SESSION['massege']."
					</div>";
					$_SESSION['massege'] = null;
				}
			?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					
						<?php
						//var_dump($product->product(4));
						$sum = 0;
						if(isset($_SESSION["CART_ITEM"])){
							foreach($_SESSION["CART_ITEM"] as $key => $cart):
								$sum += $_SESSION['CART_ITEM'][$key]['Product Total'];
						?>
						<tr>
							<td class="cart_product">
								<a href="<?php echo ep_option($con,"siteurl")."/product-details.php?id=".$_SESSION['CART_ITEM'][$key]['Product id'];?>"><img height="80" src="<?php echo ep_option($con,"siteurl")."/".$_SESSION['CART_ITEM'][$key]['Product Image'];?>" alt="" width="80"></a>
							</td>
							<td class="cart_description">
								<h4><a href="<?php echo ep_option($con,"siteurl")."/product-details.php?id=".$_SESSION['CART_ITEM'][$key]['Product id'];?>"><?php echo $_SESSION['CART_ITEM'][$key]['Product Name'];?></a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>&#2547; <?php echo $_SESSION['CART_ITEM'][$key]['Product Price']; ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								<form action="<?php echo ep_option($con,"siteurl");?>/ep-content/request_checker/cart.php" method="POST">
									<input name="productId" value="<?php echo $_SESSION['CART_ITEM'][$key]['Product id']; ?>" type="hidden">
									<input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $_SESSION['CART_ITEM'][$key]['Product Quantity'];?>" autocomplete="off" size="2">
									<input name="updateQuantity" type="submit" value="Update" class="btn btn-secondary">
								</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">&#2547;  <?php echo $_SESSION['CART_ITEM'][$key]['Product Total']; ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="<?php echo ep_option($con,"siteurl");?>/ep-content/request_checker/cart.php?deleteCart=<?php echo $key;?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php endforeach;}else{
							if(isset($_SESSION['user_id'])){
								$cart->cartGet($_SESSION['user_id']);
							}
							
							//echo $cart->cartGet($_SESSION['user_id']);
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

    <?php 
	include_once "./footer.php";