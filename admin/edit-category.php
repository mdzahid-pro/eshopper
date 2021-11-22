<?php 
    require "header.php";
    //include insert function hare 
    include_once "./ep-content/add-product/insert_product.php";
    //include clas-get-all-slide.php file
    include_once "./ep-content/category/class-category.php";
?>
    <div class="container">

        <?php 
            // make a object
            $objc = new CATEGORY($con);
            $row = $objc->getOne(htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$_GET['edit']))));

            $_SESSION['category_id_edit'] = $row['id'];
        
        ?>

<section id="addProduct">
    <div class="container">
    <form class="p-4 border border-dark" action="<?php echo ep_option($con,'siteurl');?>/admin/ep-content/request-checker/category.php" method="post">
        

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
        <div class="row">

        <div class="col-md-12">
        <!-- this is for brand -->
                <div class="p-4 border border-dark">
                    <h2 class='text-center'>
                        Edit Manufacturer
                    </h2>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Manufacturer Name</label>
                        <input value="<?php echo $row['category_name'];?>" name="brandName" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Slider Heading">
                    </div>
                    <input name="id" style="display: none;" value="<?php echo $row['id'];?>">
                    <div class="mb-3 py-2">
                        <input name="categoryUpdateBtn" type="submit" class="btn btn-info text-light text-right" value="Save Changes">
                    </div>
                </div>
            </div>
    </div>
<?php 
 require "footer.php";