<?php 
session_start();
    // include insert class from insert_product.php
    include_once("../../../ep-config.php");
    //check user submited button name
    if(isset($_POST['submitBtn'])){
        // include insert class from insert_product.php
        include_once("../add-product/insert_product.php");
        // if i want to add a product and insert data into database i have to include a file that file name is add-product.php
        include_once("../add-product/add-product.php");
        //make a object for add product
        $objc = new ADDproduct(
            $con,
            $_POST['prdName'],
            $_POST['prdAuthName'],
            $_POST['prdPrice'],
            $_POST['askingPrice'],
            $_POST['prdCurrency'],
            $_POST['prdCondition'],
            $_POST['prdAvailibility'],
            $_POST['prdTitle'],
            $_POST['productDescription'],
            $_POST['brand_name'],
            $_POST['category_name'],
            $_FILES['prdPrimaryImage'],
            $_FILES['subOne'],
            $_FILES['subTwo'],
            $_FILES['subThree'],
            $_FILES['subFor'],
        );
        
        if($objc->execute()){
            header("location: ".$_SERVER['HTTP_REFERER']."?success");
        }else{
            header("location: ".$_SERVER['HTTP_REFERER'].'?Sorry=There are a problem');
        }
    }else if(isset($_POST['edit-product-btn-post'])){
        //include validation php file into hare
        include_once "../../../ep-include/validation.php";
        //include edit-product
        include_once "../add-product/edit-product.php";
        //now check all data validation
        $prd_name =       $_POST['prdName'];
        $auth_name =      $_POST['prdAuthName'];
        $price =          $_POST['prdPrice'];
        $askPrice =       $_POST['askingPrice'];
        $currency =       $_POST['prdCurrency'];
        $condition =      $_POST['prdCondition'];
        $availibility =   $_POST['prdAvailibility'];
        $title =          $_POST['prdTitle'];
        $description =    $_POST['productDescription'];
        $brand =          $_POST['brand_name'];
        $category =          $_POST['category_name'];
        //make a id to variable to store product id get from session variable
        $id = $_SESSION['EDIT_PRODUCT_ID'];

        //make a object for edit data
        $obj = new EDITproduct(
            $con,
            $id,
            $prd_name,
            $auth_name,
            $price,
            $askPrice,
            $currency ,
            $condition,
            $availibility,
            $title,
            $description,
            $brand,
            $category,
            $_FILES['prdPrimaryImage'],
            $_FILES['subOne'],
            $_FILES['subTwo'],
            $_FILES['subThree'],
            $_FILES['subFor'],
        );

        //call ececute method in EDITproduct class
        if($obj->execute()){
            header("Location: ../../all-product.php?update=success");
        }

       
    }

