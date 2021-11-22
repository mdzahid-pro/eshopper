<?php   
session_start();
include_once "../../../ep-config.php";
include_once "../../../ep-content/global/insert_product.php";
include_once "../../../ep-content/global/update.php";
include_once "../slider/class-slider.php";
include_once "../slider/class-edit-slider.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['sliderPostBtn'])){
            //make a object class for slider
            if(isset($_POST['sliderStatus'])){
                $slider = $_POST['sliderStatus'];
            }else{
                $slider = 0;
            }

            $obj = new SLIDER($con,$_POST['sliderHeading'],$_POST['sliderDescription'],$slider,$_FILES['sliderImage']);
            //now call a object method that name is execute
            //$data = $obj->execute();

            if($obj->execute() == false){
                $_SESSION['error'] = "Slider filed to create";
                header("Location: ../../add-slider.php?falied");
            }else{
                $_SESSION['massege'] = "Slider created successfully";
                header("Location: ../../add-slider.php?success");
            }


        }elseif(isset($_POST['sliderEditPostBtn'])){
             //make a object 
            $obj = new EDITslider($con);
            $data = $obj->editSlider($_POST['id'],$_POST['sliderHeading'],$_POST['sliderDescription'],$_POST['sliderStatus'],$_FILES['sliderImage']);
            if($data == false){
                header("Location: ../../all-slider.php?falied");
            }else{
                header("Location: ../../all-slider.php?success");
            }
        }else{
            header("Lcoation: ".$_SERVER['HTTP_REFERER']);
        }
    }elseif($_SERVER['REQUEST_METHOD'] == "GET"){
        if(isset($_GET['delete'])){
            //make a object 
            $obj = new EDITslider($con);
            if($obj->delete($_GET['id']) == false){
                header("Location: ../../all-slider.php?falied");
            }else{
                header("Location: ../../all-slider.php?success");
            }
        }elseif(isset($_GET['active'])){
            //make a object 
            $obj = new EDITslider($con);
            if($obj->active($_GET['active']) == false){
                header("Location: ../../all-slider.php?falied");
            }else{
                header("Location: ../../all-slider.php?success");
            }
        }elseif(isset($_GET['de_active'])){
            //make a object 
            $obj = new EDITslider($con);
            if($obj->de_active($_GET['de_active']) == false){
                echo $_GET['id'];
                header("Location: ../../all-slider.php?falied");
            }else{
                header("Location: ../../all-slider.php?success");
            }
        }
    }else{
        header("Lcoation: ".$_SERVER['HTTP_REFERER']);
    }