<?php 
	session_start();
	require "../ep-db-config.php";
	if(!isset($_SESSION['admin_user'])){
		echo "<script>location.href='login.php'</script>";
  }
  
  require_once "../auto-loader.php";
	
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details | E-Shopper</title>
    <!-- <link href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/css/price-range.css" rel="stylesheet">
    <link href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/css/animate.css" rel="stylesheet">
    <link href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/css/main.css" rel="stylesheet">
    <link href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo ep_option($con,'siteurl');?>/ep-content/asset/images/ico/apple-touch-icon-57-precomposed.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Eshopper Admin Panel</title>
  </head>
  <body>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <!-- admin header logo -->
      <a class="navbar-brand" href="#"><img src="<?php echo ep_option($con,'siteurl');?>/eshopper/images/home/logo.png" alt="Eshopper Admin Panel Logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <!-- admin panel navigation menu -->
        <ul class="navbar-nav">
          <!-- menu item -->
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="insex.php">Home</a>
          </li>
          <!-- menu item -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Product
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?php echo ep_option($con,'siteurl');?>/admin/add-product.php">Add product</a></li>
              <li><a class="dropdown-item" href="<?php echo ep_option($con,'siteurl');?>/admin/all-product.php">All Product</a></li>
            </ul>
          </li>
          <!-- menu item -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Slider
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?php echo ep_option($con,'siteurl');?>/admin/add-slider.php">Add Slider</a></li>
              <li><a class="dropdown-item" href="<?php echo ep_option($con,'siteurl');?>/admin/all-slider.php">All Slider</a></li>
            </ul>
          </li>
          <!-- menu item -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?php echo ep_option($con,'siteurl');?>/admin/add-category.php">Add Category</a></li>
              <li><a class="dropdown-item" href="<?php echo ep_option($con,'siteurl');?>/admin/all-category.php">All Category</a></li>
              <li><a class="dropdown-item" href="<?php echo ep_option($con,'siteurl');?>/admin/all-manufacture.php">All Brand</a></li>
            </ul>
          </li>
      </div>
    </div>
  </nav>