<?php 

	/**
		encrypt function
	*/
	function encrypt($string,$encrypt_key="01400127177zahid#"){
		$key = hex2bin($encrypt_key);
		$nonceSize = openssl_cipher_iv_length("aes-256-ctr");
		$nonce = openssl_random_pseudo_bytes($nonceSize);
		
		$ciphertext = openssl_encrypt($string,'aes-256-ctr',$key,OPENSSL_RAW_DATA,$nonce);
		
		return base64_encode($nonce.$ciphertext);
	}
	/**
		decrypt function
	*/
	
	function decrypt($string,$encryption_key="01400127177zahid#"){
		$key = hex2bin($encryption_key);
		$string = base64_decode($string);
		$nonceSize = openssl_cipher_iv_length('aes-256-ctr');
		$nonce = mb_substr($string, 0, $nonceSize, '8bit');
		$ciphertext = mb_substr($string, $nonceSize, null, '8bit');
		$plaintext= openssl_decrypt($ciphertext,'aes-256-ctr',$key,OPENSSL_RAW_DATA,$nonce);
		
		return $plaintext;
	}
	
	/**
		mainpath function main link
	*/
	function get_link(){
		if(isset($_SERVER['HTTPS']) == 'on'){
			$http = "https://";
		}else{
			$http = "http://";
		}
		
		return $http.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	}
	
	function createAvater($text){
		//create image path where this file are gone
		$path = "/ep-content/avater/".uniqid().".png";
		//lets create image file
		$image = imagecreatetruecolor(200,200);
		//define and declare the random color for avater image background 
		//store the color name in diffrent variable
		$red = rand(0,255);
		$blue = rand(0,255);
		$green = rand(0,255);
		//giving the text color
		$textColor = imagecolorallocate($image,255,255,255);
		//make background color full
		$bgcolor = imagecolorallocate($image,$red,$blue,$green);
		//store a font family PATH
		$font = realpath("ep-content/font/Helvetica.ttf");
		//fill background color
		imagefill($image,0,0,$bgcolor);
		
		imagettftext($image,100,0,55,150,$textColor,$font,$text);
		
		header("Content-Type: image/png");
		imagepng($image,$path);
		imagedestroy($image);
		
		return $path;
	}

	function str_random($len){
		$charecter = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charecter_length = strlen($charecter);
		$random_string = "";
		for($i=0;$i < $len;$i++){
			$random_string .= $charecter[rand(0,$charecter_length - 1)];
		}

		return $random_string;
	}