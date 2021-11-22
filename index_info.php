<?php 
	require "ep-content/global/function.php";
	//require "ep-config.php";
	require "ep-db-config.php";
	require "ep-content/ep-dbcontrol/database.php";
	//($_SERVER);
	echo  get_link()."<br>";
	
	echo encrypt("zahid1234","616d617273686f7262616e676c61");
	echo "<br>";
	echo decrypt(encrypt("zahid1234","616d617273686f7262616e676c61"),"616d617273686f7262616e676c61");
?>