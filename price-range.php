<?php 
session_start();
    //include database config file
    include_once "ep-config.php";
    //include auto loader file
    include_once "auto-loader.php";
	//include class product file into hare to get lot of information
	include_once "./ep-content/product/class_product.php";
	//include class slider file into hare for get all data
	include_once "./ep-content/slider/class_slider.php";
	//make a object for slider 
	$slider = new SLIDER($con);
	//make a product object
	$product = new product($con);

    $min = htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_POST['min'])));
    $max = htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_POST['max'])));

    $product->priceRange($max,$min);