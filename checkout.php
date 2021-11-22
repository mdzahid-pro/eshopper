<?php 
	require_once "./header.php";
	
	if(isset($_SESSION['user_id'])){
		$cart = new CART($con);
	}
?>

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->
<?php //$_SESSION['checkout_id'] = 1; 
	if(isset($_SESSION['checkout_user']) == true and empty($_SESSION['checkout_user']) == false){
		//if user checkout form fill than what next
		?>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>
			<form action="<?php echo ep_option($con,"siteurl");?>/ep-content/request_checker/checkout.php" method="POST">
			<div class="payment-options">
				<span>
					<label><input name="paymentMethod" type="radio"> Direct Bank Transfer</label>
				</span>
				<span>
					<label><input name="paymentMethod" type="radio"> Cash On Payment</label>
				</span>
				<span>
					<label><input name="paymentMethod" type="radio"> Paypal</label>
				</span>

				<input type="submit" value="PLace Order" name="orderComfirmBtn">
			</div>
		</div>
	</section>
		<?php
	}else{
?>
	<section>
		<div class="container">
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input id="dlname" type="text" placeholder="Display Name">
								<input id="email" type="email" placeholder="Email Account">
								<input id="password" type="password" placeholder="Password">
								<input id="cm_password" type="password" placeholder="Confirm password">
							</form>
							
							<a class="btn btn-primary" href="javascript:void(0)">Continue</a>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							
							<div class="form-one">
								<form action="<?php echo ep_option($con,"siteurl");?>/ep-content/request_checker/checkout.php" method="POST">
									<input name="email" type="text" placeholder="Email*">
									<input name="firstName" type="text" placeholder="First Name *">
									<input name="lastName" type="text" placeholder="Last Name *">
									<input name="addrOne" type="text" placeholder="Address 1 *">
									<input name="addrTwo" type="text" placeholder="Address 2">
									<input name="postalCode" type="text" placeholder="Zip / Postal Code *">
									<input name="mobile" type="text" placeholder="Mobile Phone">

									<select name="country">
										<option>-- Country --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>

									<input type="submit" name="checkout_btn" class="btn btn-primary" value="Continue">
								</form>
							</div>
						</div>
					</div>				
				</div>
			</div>
			
<?php 
	}
	?>
			
	<section id="cart_items">
		<div class="container">
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

	<script src="./ep-content/asset/js/checkout.js"></script>

	<?php 
		require_once "./footer.php";
	?>