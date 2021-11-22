<?php 
    if(isset($_POST['singupBtn'])){
        $re = basename($_SERVER['HTTP_REFERER']);
        include_once "../../../ep-config.php";
        include_once "../../../auto-loader.php";
        include_once "../../global/update.php";
        include_once "../../global/insert_product.php";
        include_once "../../../ep-include/ep-option.php";
        include_once "../function/send-mail.php";
        include_once "../class/add-user.php";
        include_once "../../../ep-include/validation.php";
        include_once "../../../ep-include/ep-option.php";
        include_once "../../global/function.php";

        //make a object 
        $abj = new CREATEuser($con,$_POST['fname'],$_POST['lname'],$_POST['email'],$_POST['password']);
        if($abj->execute() == true){
             header("Location: ".ep_option($con,'siteurl')."/login.php?USER_CREATION=SUCCESS");
        }else{
             $_SESSION['errors'] = $abj->execute();
             header("Location: ".ep_option($con,'siteurl')."/login.php?USER_CREATION=FAILED");
        }
        
    }else if(isset($_POST['verifyEmail'])){
          include_once "../../../ep-config.php";
          include_once "../function/send-mail.php";
         //include class-verify-email.php file hare to checking verify code
         //make a object to access class data
         include_once "../class/class-verify-email.php";
          $obj = new VERIFYemail($con);
          if($obj->execute($_POST['verifyCode'])){
               $_SESSION['new_user_id'] = null;
               $_SESSION['massege'] = "Successfully Verifiy Your E-mail";
               header("Location: ../../../login.php");
          }
    }else if(isset($_POST['login_user_btn'])){
          include_once "../../../ep-config.php";
          include_once "../../global/function.php";
          include_once "../class/class-login-user.php";
          if(mysqli_real_escape_string($con,$_POST['authCheck']) === $_SESSION['authCheck']){
               //make a object for getting all info
               $obj = new AUTH_LOGIN($con,$_POST['email'],$_POST['pass']);
               $obj->execute();
          }else{
               header("Location: ".$_SERVER['HTTP_REFERER']);
          }
    }else{
         header("Location: ../../../login.php");
    }