<?php 
    include_once "header.php";

?>

<section id="addProduct">
    <div class="container">
        <form class="p-4 border border-dark" action="ep-content/request-checker/slider.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="p-4 border border-dark">
                        <h2 class='text-center'>
                            Add Slider Image
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

                        <div>
                            <label for="formFileLg" class="form-label">Slider Image</label>
                            <input name="sliderImage" class="form-control form-control-lg" id="formFileLg" type="file">
                        </div>
                        <div class="checkbox">
                            <label>
                            <input name="sliderStatus" type="checkbox" value="1"> Slider Status
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 border border-dark">
                        <h2 class='text-center'>
                            Add Slider Info
                        </h2>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Slider Heading</label>
                            <input name="sliderHeading" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Slider Heading">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Slider Description</label>
                            <textarea rows="4" name="sliderDescription" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Slider Description">
                            </textarea>
                        </div>
                        <div class="mb-3 py-2">
                            <input name="sliderPostBtn" type="submit" class="btn btn-info text-light text-right" value="Add Product">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>


<?php include_once"footer.php";?>