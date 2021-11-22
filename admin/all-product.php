<?php 
    //include header file for get all CSS Favicon link are have there
    include_once "./header.php";
    //include get all data from database
    include_once "./ep-content/add-product/get-all-data.php";
?>
    <div class="container">
        <?php 
            // make a object
            $objc = new GETallproduct($con);
            echo $objc->getAllData(0,10);
        ?>
    </div>
<?php
    //include footer file for get all scripting file i have
    include_once "./footer.php";