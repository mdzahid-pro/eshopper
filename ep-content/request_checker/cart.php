<?php 
session_start();
    //include database config file
    include_once "../../ep-config.php";
	//include class product file into hare to get lot of information
	include_once "../../ep-content/product/class_product.php";
    //include database file that file was contain update and insert function 
    include_once "../global/database.php";
    //include class cart file into hate to add product info in cart
    include_once "../../ep-content/cart/class_cart.php";
    if(isset($_POST['updateQuantity'])){
        $cart = new CART($con);
        //$DATA = $cart->add($_POST['productId'],$_POST['quantity']);
        if(isset($_SESSION['user_id'])){
            if($cart->editCart($_POST['productId'],$_POST['quantity'])){
                $_SESSION['massege'] = "Successfully Removed Items";
                header("Location: ../../cart.php");
            }
        }

        //$_SESSION['massege'] = "Successfully Update Quantity";
        //unset($_SESSION['product_items']);
        //header("Location: ../../cart.php");
    }elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!isset($_SESSION['user_id'])){
            if(isset($_SESSION['product_items'])){
                $cart = new CART($con);
                $DATA = $cart->add($_SESSION['product_items'],$_POST['quantity']);
                
                //$_SESSION['CART_ITEM'];
                $id = $_SESSION['product_items'];
                $_SESSION['massege'] = "Successfully Add Items into Card";
                unset($_SESSION['product_items']);
                header("Location: ../../product-details.php?id=".$id);
            }else{
                header("Location: ".$_SERVER['HTTP_REFERER']);
            }
        }else{
            $cart = new CART($con);
            $id = $_SESSION['product_items'];
            $DATA = $cart->add($id,$_POST['quantity']);
            unset($_SESSION['product_items']);

            $_SESSION['massege'] = "Successfully Add Items into Card";
            header("Location: ../../product-details.php?id=".$id);
        }
        
    }elseif(isset($_GET['deleteCart'])){
        $id = htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_GET['deleteCart'])));
        if(isset($_SESSION['user_id'])){
            echo $id;
            $cart = new CART($con);
            if($cart->deleteCart($id)){
                $_SESSION['massege'] = "Successfully Removed Items";
                header("Location: ../../cart.php");
            }
        }
        if(isset($_SESSION['CART_ITEM'][$id])){
            unset($_SESSION['CART_ITEM'][$id]);
        }
        
        //$_SESSION['massege'] = "Successfully Removed Items";
        //header("Location: ../../cart.php");
    }else{
        include "../../../404.php";
    }