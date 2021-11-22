<?php 
	$host = "localhost";
	$user = "eshopper";
	$password = "5lBOp15OcHNIyTEP";
	$dbname = "eshopper";
	
	$con = mysqli_connect($host,$user,$password,$dbname);
	if($con == false){
		die("Can't connect with database:".mysqli_connect_error());
	}