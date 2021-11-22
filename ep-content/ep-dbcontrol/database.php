<?php 
	/* create a table if not exists for admin users */

	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_admin_user(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user_login VARCHAR(60) NOT NULL,
		user_password VARCHAR(255) NOT NULL,
		user_nicname VARCHAR(50) NOT NULL,
		user_email VARCHAR(100) NOT NULL,
		user_url VARCHAR(100) NOT NULL,
		user_registered DATETIME NOT NULL,
		user_activation_key VARCHAR(255) NOT NULL,
		user_status INT(11) NOT NULL,
		display_name VARCHAR(250) NOT NULL
	)");

	//CHECK ADMIN USERS TABLE HAVE ANY PROBLEM THAN ECHO ERROR
	if($query == false){
		echo mysqli_error($con);
	}
	
	//create a table if not exists ep_option
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_option(
		option_id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		option_name VARCHAR(191) NOT NULL,
		option_value LONGTEXT NOT NULL,
		option_autoload VARCHAR(20)
	)");
	
	//ep_option table have any problem then show a error
	if($query == false){
		echo mysqli_error($con);
	}
	
	//create a ep_product if not exists
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_product(
		id BIGINT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		product_name VARCHAR(255) NOT NULL,
		product_id BIGINT(19) NOT NULL,
		product_price VARCHAR(20) NOT NULL,
		product_carency VARCHAR(50) NOT NULL,
		product_condition VARCHAR(50) NOT NULL,
		product_availability INT(11) NOT NULL,
		product_brand VARCHAR(150) NOT NULL,
		product_image VARCHAR(150) NOT NULL,
		product_time VARCHAR(50) NOT NULL
	)");
	
	//ep_product table have any error
	if($query == true){
		echo mysqli_error($con);
	}
	
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_product_details(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		auth_name VARCHAR(150) NOT NULL,
		product_brand VARCHAR(150) NOT NULL,
		product_title VARCHAR(255) NOT NULL,
		product_details TEXT NOT NULL,
		product_id BIGINT(20) NOT NULL
	)");
	
	if($query == true){
		echo mysqli_error($con);
	}
	
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_company_profile(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		brand_name VARCHAR(150) NOT NULL,
		about_company TEXT NOT NULL,
		company_location TEXT NOT NULL
	)");
	
	if($query == true){
		echo mysqli_error($con);
	}
		
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_product_review(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		product_id BIGINT(20) NOT NULL,
		youser_email VARCHAR(250) NOT NULL,
		comment TEXT NOT NULL,
		user_ratting VARCHAR(10) NOT NULL,
		review_time VARCHAR(120) NOT NULL
	)");
	
	if($query == true){
		echo mysqli_error($con);
	}
		
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_contact(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		cn_name VARCHAR(100) NOT NULL,
		cn_email VARCHAR(150) NOT NULL,
		cn_subject VARCHAR(150) NOT NULL,
		cn_message TEXT NOT NULL,
		cn_time VARCHAR(120) NOT NULL
	)");
	
	if($query == true){
		echo mysqli_error($con);
	}
		
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_wishlist(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user_id INT(20) NOT NULL,
		product_id BIGINT(20) NOT NULL,
		product_quentity INT(11) NOT NULL
	)");
	
	if($query == true){
		echo mysqli_error($con);
	}
	
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_cart(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user_id INT(20) NOT NULL,
		product_id BIGINT(20) NOT NULL,
		product_quentity INT(11) NOT NULL
	)");
	
	if($query == true){
		echo mysqli_error($con);
	}
	
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_order_product(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user_id INT(20) NOT NULL,
		product_id BIGINT(20) NOT NULL,
		product_quentity INT(11) NOT NULL,
		price VARCHAR(100) NOT NULL,
		quentity VARCHAR(120) NOT NULL
	)");
	
	if($query == true){
		echo mysqli_error($con);
	}
	
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_order(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user_id BIGINT(20) NOT NULL,
		company_name VARCHAR(255) NOT NULL,
		email VARCHAR(255) NOT NULL,
		title VARCHAR(255) NOT NULL,
		frist_name 	VARCHAR(60) NOT NULL,
		middle_name VARCHAR(60) NOT NULL,
		last_name VARCHAR(60) NOT NULL,
		addr_one VARCHAR(255) NOT NULL,
		addr_two VARCHAR(255) NOT NULL,
		zip_code BIGINT(50) NOT NULL,
		country VARCHAR(100) NOT NULL,
		state VARCHAR(50) NOT NULL,
		phone VARCHAR(50) NOT NULL,
		mobile VARCHAR(50) NOT NULL,
		fax VARCHAR(100) NOT NULL,
		order_time VARCHAR(150) NOT NULL
	)");
	
	if($query == true){
		echo mysqli_error($con);
	}
	
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_users(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		fname VARCHAR(50) NOT NULL,
		lname VARCHAR(50) NOT NULL,
		password VARCHAR(255) NOT NULL,
		company_name VARCHAR(255) NOT NULL,
		email VARCHAR(255) NOT NULL,
		title VARCHAR(255) NOT NULL,
		frist_name 	VARCHAR(60) NOT NULL,
		middle_name VARCHAR(60) NOT NULL,
		last_name VARCHAR(60) NOT NULL,
		addr_one VARCHAR(255) NOT NULL,
		addr_two VARCHAR(255) NOT NULL,
		zip_code BIGINT(50) NOT NULL,
		country VARCHAR(100) NOT NULL,
		state VARCHAR(50) NOT NULL,
		phone VARCHAR(50) NOT NULL,
		mobile VARCHAR(50) NOT NULL,
		fax VARCHAR(100) NOT NULL,
		time VARCHAR(150) NOT NULL
	)");
	
	if($query == true){
		echo mysqli_error($con);
	}

	
	
	$query = mysqli_query($con,"CREATE TABLE IF NOT EXISTS ep_product_image(
		id BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		primary_image VARCHAR(255) NOT NULL,
		image_one VARCHAR(255) NOT NULL,
		image_two VARCHAR(255) NOT NULL,
		image_three VARCHAR(255) NOT NULL,
		image_for VARCHAR(255) NOT NULL
	)");
	
	if($query == true){
		echo mysqli_error($con);
	}

	
	
	

	
	
	
	
	
	