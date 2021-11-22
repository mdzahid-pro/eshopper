<?php 
    //start session
    session_start();
    //include databse config file
    include_once "../../../ep-config.php";
    //include function.php file
    include_once "../../../ep-content/global/function.php";
    //include insert function hare 
    include_once "../add-product/insert_product.php";
    //include category class hare
    include_once "../category/class-category.php";

    $obj = new CATEGORY($con);
    //check request where come and request method
    if(isset($_POST['createCategoryBtn'])){
        //make a object to insert category
        $obj->inserte($_POST['categoryName'],$_POST['categoryStatus']);
    }else if(isset($_POST['createManufactureBtn'])){
        //make a object to insert category
        if($obj->inserte($_POST['brandName'],$_POST['brandStatus'],'ep_manufacture')){
            header("Location: ../../add-category.php");
        }else{
            $_SESSION['massege'] = "Something Went Wrong";
            header('Location: ../../add-category.php');
        }
    }else if(isset($_GET['mde_active'])){
        $data = $obj->de_active('ep_manufacture',htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_GET['mde_active']))));
        if($data == true){
            header("Location: ../../all-manufacture.php");
        }else{
            header("Location: ../../all-manufacture.php");
        }
    }else if(isset($_GET['mactive'])){
        $data = $obj->active('ep_manufacture',htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_GET['mactive']))));
        if($data == true){
            header("Location: ../../all-manufacture.php");
        }else{
            header("Location: ../../all-manufacture.php");
        }
    }else if(isset($_GET['mdelete'])){
        $data = $obj->deletes(id: htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_GET['delete']))));
        if($data == true){
            header("Location: ../../all-manufacture.php");
        }else{
            header("Location: ../../all-manufacture.php");
        }
    }else if(isset($_GET['de_active'])){
        $data = $obj->de_active(id: htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_GET['de_active']))));
        if($data == true){
            header("Location: ../../all-category.php");
        }else{
            header("Location: ../../all-category.php");
        }
    }else if(isset($_GET['active'])){
        $data = $obj->active(id: htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_GET['active']))));
        if($data == true){
            header("Location: ../../all-category.php");
        }else{
            header("Location: ../../all-category.php");
        }
    }else if(isset($_GET['delete'])){
        $data = $obj->deletes(id: htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_GET['delete']))));
        if($data == true){
            header("Location: ../../all-category.php");
        }else{
            header("Location: ../../all-category.php");
        }
    }else if(isset($_POST['ManufactureUpdateBtn'])){
        if($_SESSION['manufacture_id_edit'] == $_POST['id']){
            if($obj->edit($_SESSION['manufacture_id_edit'],$_POST['brandName'],0,'ep_manufacture')){
                $_SESSION['manufacture_id_edit'] = null;
                header("Location: ../../all-manufacture.php");
            }else{
                header("Location: ../../all-manufacture.php");
            }
        }else{
            $_SESSION['massege'] = "Something Went wrong";
            header("Location: ../../all-manufacture.php");
        }
    }else if(isset($_POST['categoryUpdateBtn'])){
        if($_SESSION['category_id_edit'] == $_POST['id']){
            if($obj->edit($_SESSION['category_id_edit'],$_POST['brandName'],0)){
                $_SESSION['category_id_edit'] = null;
                header("Location: ../../all-category.php");
            }else{
                header("Location: ../../all-category.php");
            }
        }else{
            $_SESSION['massege'] = "Something Went wrong";
            header("Location: ../../all-category.php");
        }
    }