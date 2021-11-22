<?php 
    include_once "header.php";
    include_once "./ep-content/add-product/insert_product.php";
    include_once "./ep-content/category/class-category.php";
?>

<section id="addProduct">
    <div class="container">
    <form class="p-4 border border-dark" action="ep-content/request-checker/add-product.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="p-4 border border-dark">
                        <h2 class='text-center'>
                            Add product Image
                        </h2>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Sample image one</label>
                        <input name="subOne" class="form-control" type="file" id="formFile">
                    </div>
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Sample image two</label>
                        <input name="subTwo" class="form-control" type="file" id="formFileMultiple" multiple>
                    </div>
                    <div class="mb-3">
                        <label for="formFileDisabled" class="form-label">Sample image three</label>
                        <input name="subThree" class="form-control" type="file">
                    </div>
                    <div class="mb-3">
                        <label for="formFileSm" class="form-label">Sample image for</label>
                        <input name="subFor" class="form-control form-control-sm" id="formFileSm" type="file">
                    </div>
                    <div>
                        <label for="formFileLg" class="form-label">Primary Image</label>
                        <input name="prdPrimaryImage" class="form-control form-control-lg" id="formFileLg" type="file">
                    </div>
                </div>
                
                <div class="p-4 border border-dark">
                    <h2 class='text-center'>
                        Add product Details
                    </h2>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Title</label>
                        <input name="prdTitle" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">product description</label>
                        <textarea name="productDescription" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 border border-dark">
                    <h2 class='text-center'>
                        Add product Info
                    </h2>

                    
                        <?php 
                            $category = new CATEGORY($con);

                            echo $category->get_all_cm();
                            echo $category->get_all_cm('ep_manufacture');
                        ?>

                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                        <input name="prdName" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Author Name</label>
                        <input name="prdAuthName" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Price</label>
                        <input name="prdPrice" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Asking Price</label>
                        <input name="askingPrice" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Currency</label>
                        <input name="prdCurrency" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Availability</label>
                        <input name="prdAvailibility" type="number" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Product Condition</label>
                        <input name="prdCondition" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                    <div class="mb-3 py-2">
                        <input name="submitBtn" type="submit" class="btn btn-info text-light text-right" value="Add Product" name="add-product-btn-post">
                    </div>
                </div>
            </div>

        
        </div>
    </form>
    </div>
</section>


<?php include_once"footer.php";?>