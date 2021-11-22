<?php 
	//require function file for decrypt password
	require "../ep-content/global/function.php";
	//this is our user athontication function in php
	function checkAthontication($username,$adminPwd,$con){
		//filter admin form input data
		//username and password
		$username = htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$username)));
		$adminPwd = htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$adminPwd)));
		if($username == "" && $userPwd == ""){
			return false;
		}
		// check username is valide or not
		$query = mysqli_query($con,"SELECT * FROM `ep_admin_user` WHERE user_login='$username'");
		//username is true or false
		if(mysqli_num_rows($query) == 1){
			//extract admin user data
			//and get admin user password
			$row = mysqli_fetch_assoc($query);
			//now we need to decrypt password
			if(decrypt($row["user_password"],"616d617273686f7262616e676c61") === $adminPwd && $username == $row["user_login"]){
				$_SESSION["admin_user"] = $row['id'];
				return true;
			}else{
				return false;
			}
		}
	}