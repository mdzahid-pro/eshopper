<?php 
	session_start();
?>

<?php 
	//check session already have or not
	if(isset($_SESSION["admin_user"])){
		header('location: index.php');
	}
	
	if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
		if(isset($_POST["adminLoginBtn"])){
			//require database config file
			require "../ep-config.php";
			//require a file for authontication admin user login
			require "ep-admin-content/admin-login-check.php";
			//call adminathontication function to check user athontication
			if(checkAthontication($_POST["adminUsername"],$_POST["adminPassword"],$con) == true){
				//then all is work then redirect index page with a session veriable
				//session is created .created file is admin-login-chech.php
				echo "<script>location.href='index.php'</script>";
			}else{
				$wrong = "Username and Password is not metched";
			}
		}
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    
	<section id="form">
		<div class="conatainer">
			<div class="row  m-4">
				<div class="col-md-6 m-auto p-4 border border-dark">
					<form method="POST">
						<h2 class="text-center">Login Form</h2>
					  <div class="form-group">
						<label for="exampleInputEmail1">Username</label>
						<input name="adminUsername" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					  </div>
					  <div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input name="adminPassword" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					  </div>
					  <div class="form-check">
						<input type="checkbox" class="form-check-input" id="exampleCheck1">
						<label class="form-check-label" for="exampleCheck1">Remember Me</label>
					  </div>
					  <button name="adminLoginBtn" type="submit" class="btn btn-primary mt-2 float-right">Login</button>
					</form>
				</div>
			</div>
		</div>
	</section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>