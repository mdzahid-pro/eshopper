<?php 
    require "header.php";
    //include insert function hare 
    include_once "./ep-content/add-product/insert_product.php";
    //include clas-get-all-slide.php file
    include_once "./ep-content/category/class-category.php";
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
                            $_SESSION['error'] == null; 
                        }

                        
                    ?>
        <?php 
            // make a object
            $objc = new CATEGORY($con);
            echo $objc->getAllData(0,10,'ep_manufacture');
        ?>
    </div>
<?php 
 require "footer.php";