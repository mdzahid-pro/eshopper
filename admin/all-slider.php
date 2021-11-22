<?php 
    require "header.php";
    //include clas-get-all-slide.php file
    include_once "./ep-content/slider/class-get-all-slide.php";
?>
    <div class="container">
    
    <?php 
                        if(isset($_SESSION['massege'])){
                            ?>
                                <div class="alert alert-success"><?php echo $_SESSION['massege'];?></div>
                            <?php
                            $_SESSION['massege'] = null;
                        }
                        
                        if(isset($_SESSION['error'])){
                            ?>
                                <div class="alert alert-success"><?php echo $_SESSION['error'];?></div>
                            <?php
                            $_SESSION['error'] = NULL; 
                        }

                        
                    ?>
        <?php 
            // make a object
            $objc = new GETALLSlider($con);
            echo $objc->getAllData(0,10);
        ?>
    </div>
<?php 
 require "footer.php";