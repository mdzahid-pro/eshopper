<?php 
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include_once "../../ep-config.php";
        include_once "../global/database.php";
        include_once "../checkout/class_checkout.php";

        //call checkout class 
        $obj = new CHECKOUT($con);
        if(isset($_POST['checkout_btn'])){
            //call create function 
            $obj->create($_POST['email'],$_POST['firstName'],$_POST['lastName'],$_POST['addrOne'],$_POST['addrTwo'],$_POST['postalCode'],$_POST['country'],$_POST['mobile']);
        }elseif(isset($_POST['orderComfirmBtn'])){
            if(!empty($_POST['paymentMethod'])){
                if($_POST['paymentMethod'] == 'on'){
                    $data = 'Cash On Delevery';
                }else{
                    $data = $_POST['paymentMethod'];
                }
                if($obj->placeOrder($data)){
                    header("Location: ../../checkout.php");
                }else{
                    header("Location: ../../checkout.php");
                }
            }else{
                header("location: ".$_SERVER['HTTP_REFERER']);
            }
        }else{
            header("location: ".$_SERVER['HTTP_REFERER']);
        }
    }