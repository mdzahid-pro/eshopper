<?php 
    include_once "header.php";

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

        <div class="col-md-6">
        <!-- this is for brand -->
                <div class="p-4 border border-dark">
                    <h2 class='text-center'>
                        Add Manufacturer
                    </h2>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Manufacturer Name</label>
                        <input name="brandName" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Slider Heading">
                    </div>

                    <div class="checkbox">
                        <label>
                            <input name="brandStatus" type="checkbox" value="1"> Category Status
                        </label>
                    </div>

                    <div class="mb-3 py-2">
                        <input name="createManufactureBtn" type="submit" class="btn btn-info text-light text-right" value="Add Manufacture">
                    </div>
                </div>
            </div>

            <!-- this is for category -->
            <div class="col-md-6">
                <div class="p-4 border border-dark">
                    <h2 class='text-center'>
                        Add Category
                    </h2>

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
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                        <input name="categoryName" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Slider Heading">
                    </div>

                    <div class="checkbox">
                        <label>
                            <input name="categoryStatus" type="checkbox" value="1"> Category Status
                        </label>
                    </div>

                    <div class="mb-3 py-2">
                        <input name="createCategoryBtn" type="submit" class="btn btn-info text-light text-right" value="Add Category">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</section>


<?php include_once"footer.php";?>