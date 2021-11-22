<?php include_once "header.php"; include_once "./ep-content/global/function.php"; 

if(isset($_SESSION['user_id'])){
	echo "<script>location.href='index.php'</script>";
}
?>
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="<?php echo ep_option($con,'siteurl');?>/ep-content/auth/request-checker/request.php" method="POST">
							<?php 
								$random = str_random(30);
								$_SESSION['authCheck'] = $random;
							?>
							
							<input style="display:none" name="authCheck" value="<?php echo $random;?>">
							<input name="email" type="email" placeholder="Email Address" />
							<input name="pass" type="password" placeholder="Enter Your Password" />
							<!--<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>-->
							<button name="login_user_btn" type="submit" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<?php if(isset($_SESSION['massege'])){echo "<div class='alert alert-success'>".$_SESSION['massege']."</div>"; $_SESSION['massege'] = null;}?>
						<?php if(isset($_SESSION['new_user_id'])){ ?>
							<form action="<?php echo ep_option($con,'siteurl');?>/ep-content/auth/request-checker/request.php" method="POST">
								<input name="verifyCode" type="number" placeholder="Your Email Varification Code"/>
								<button name="verifyEmail" type="submit" class="btn btn-default">Verify</button>
							</form>
						<?php }else{ ?>
						<form action="<?php echo ep_option($con,'siteurl');?>/ep-content/auth/request-checker/request.php" method="POST">
							<input name="fname" type="text" placeholder="First Name"/>
							<input name="lname" type="text" placeholder="Last Name"/>
							<input name="email" type="email" placeholder="Email Address"/>
							<input name="password" type="password" placeholder="Password"/>
							<button name="singupBtn" type="submit" class="btn btn-default">Signup</button>
						</form>
					 	<?php } ?>
						
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<?php include_once "footer.php"; ?>