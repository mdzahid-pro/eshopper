<?php
session_start();
    include_once("../../ep-config.php");
    include_once("../global/insert_product.php");
    include_once("../product/class_review.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //echo $_POST["name"];
        $id =  $_SESSION["product_id"];
        $obj = new RIVIEW($con);
        if($obj->insertRiview($id,$_POST['name'],$_POST['email'],$_POST['comment'])){
            $_SESSION["product_id"] = null;
            echo "<script>location.href='../../product-details.php?id={$id}'</script>";
        }else{
            echo "<script>location.href='../../index.php?failed'</script>";
        }
    }