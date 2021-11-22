<?php 
    class product{
        public function __construct(private $con){
        }

        private function give_random($table = 'ep_product'){
            $query = $this->con->query("SELECT * FROM $table");
            //make a array to store all id
            $id = array();
            while($row = $query->fetch_assoc()){
                $id[] = $row['id'];
            }

            return $id;
        }

        public function get_one_product($id){
            $id = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$id)));
            return $this->product($id);
        }

        public function all_product($category = null,$brand = null, $length= 5){
            if($category == null and $brand == null)
            {   
                $random = $this->give_random();
                $count = count($random);
                $prd_array = array();
                for($i=1;$i<=$length;$i++){
                    $num = rand(0,$count - 1);
                    //make a id from random variable 
                    $prd_array[] = $this->product($random[$num]);
                }
                
                return $prd_array;
            }
            if($brand !== null){
                $manufacture = $this->con->query("SELECT * FROM ep_product WHERE manufacture_id={$brand}");
            
                $prd_array = array();
                while($row = $manufacture->fetch_assoc()){
                    $prd_array[] = $this->product($row['id']);
                }

                return $prd_array;
            }
        }

        //make a function to get all brand info 
        public function all_brand($length = 6){
            $random = $this->give_random('ep_manufacture');
            $count = count($random);
            if($count < 5){
                $length = $count;
            }

            
            $prd_array = array();
            for($i=0;$i<$length;$i++){
                $num = $random[$i];//$random[$i];
                $manufacture = $this->con->query("SELECT * FROM ep_manufacture WHERE id={$num}");
                //make a id from random variable 
                $prd_array[] = $manufacture->fetch_assoc();
            }

            return $prd_array;
        }

        //make a funciton that name will be categoryProduct
        public function categoryProduct($id){
            $id = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$id)));
            $product = $this->con->query("SELECT * FROM ep_product WHERE category_id=$id");
            $count = $product->num_rows;

            while($row = $product->fetch_assoc()){
                $id = $row['id'];
            }
            
            $prd_array = array();
            for($i=0;$i<$count;$i++){
                //make a id from random variable 
                $prd_array[] = $this->product($id);
            }

            return $prd_array;
        }

        //make a funcliton that name will be brandProduct
        public function brandProduct($id){
            $id = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$id)));
            $product = $this->con->query("SELECT * FROM ep_product WHERE manufacture_id=$id");
            $count = $product->num_rows;

            while($row = $product->fetch_assoc()){
                $id = $row['id'];
            }
            
            $prd_array = array();
            for($i=0;$i<$count;$i++){
                //make a id from random variable 
                $prd_array[] = $this->product($id);
            }

            return $prd_array;
        }

        //make a fucntion to get output multiple product 
        public function product($id){
            $query = $this->con->query("SELECT * FROM ep_product WHERE id=$id");
            $product = $query->fetch_assoc();
            $product_id = array("prd_id" => $product['product_id']);
            $details = $this->con->query("SELECT * FROM ep_product_details WHERE product_id=$id");
            $images = $this->con->query("SELECT * FROM ep_product_image WHERE product_id=$id");
            $category = $this->con->query("SELECT * FROM ep_category WHERE id={$product['category_id']}");
            $manufacture = $this->con->query("SELECT * FROM ep_manufacture WHERE id={$product['manufacture_id']}");

            $all = $details->fetch_assoc() + $images->fetch_assoc() +  $manufacture->fetch_assoc()+ $category->fetch_assoc() + $product;
            return $all + $product_id;
        }

        public function maxPrice(){
            $product = $this->con->query("SELECT * FROM ep_product");
            $num = $product->num_rows;
            $temp = array();
            while($row = $product->fetch_assoc()){
                $temp[] = $row['product_price'];
            }

            return array("max"=>max($temp),"min"=> min($temp));
        }

        public function priceRange($max,$min){
            $temp = array();
            $query = $this->con->query("SELECT * FROM ep_product WHERE product_price BETWEEN $min AND $max");
            if(!$query){
                echo "";
                return;
            }

            $product = "";
            echo '<h2 class="title text-center">Price Range Items Items</h2>';
             while($prd = $query->fetch_assoc()){ 
                $prd = $this->product($prd['id']);
                echo '<div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <img style="max-width: 100%;" height="240" src="'. $prd['primary_image'] .'" alt="" />
                                    <h2>'.$prd['product_price'].'</h2>
                                    <p>'.$prd['product_name'].'</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <h2>'.$prd['product_price'].'</h2>
                                        <p>'.$prd['product_title'].'</p>
                                        <a href="'.ep_option($this->con,'siteurl')."/product-details.php?id=".$prd['id'].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="'.ep_option($this->con,"siteurl").'/product-details.php?id='.$prd["id"].'"><i class="fa fa-plus-square"></i>View Product</a></li>
                            </ul>
                        </div>
                    </div>
                </div>';
            } 
        }
    }