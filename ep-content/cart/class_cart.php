<?php 
    class CART extends database{
        public function __construct(protected $con) {

        }
        
        private function str_random($len){
            $charecter = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charecter_length = strlen($charecter);
            $random_string = "";
            for($i=0;$i < $len;$i++){
                $random_string .= $charecter[rand(0,$charecter_length - 1)];
            }
    
            return $random_string;
        }

        protected function checkProduct($id){
            $result = $this->con->query("SELECT * FROM ep_cart WHERE product_id=$id");
            return $result->num_rows;
        }

        //make a function that will work add to cart
        public function add($id,$qty){
            $con = $this->con;
            $product = new product($con);
            $data = $product->product($id);

            if(isset($_SESSION['user_id'])){
                if(isset($_SESSION['CART_ITEM'])){
                    $arr = $_SESSION['CART_ITEM'];
                    $temp = array();
                    foreach($arr as $key => $value){
                        if($this->checkProduct($value['Product id']) === 0){
                            $temp['user_id'] = $_SESSION['user_id'];
                            $temp['product_id'] = $value['Product id'];
                            $temp['product_quentity'] = $value['Product Quantity'];
                            $temp['product_price'] = $value['Product Price'];
                            $temp['product_image'] = $value['Product Image'];
                            $temp['product_total'] = $value['Product Total'];

                            $this->insert("ep_cart",$temp);
                            $_SESSION['massege'] = "SUCCESSFULL OPARATION";
                        }else{
                            $temp['product_quentity'] = $value['Product Quantity'];
                            $temp['product_total'] = ceil($value['Product Quantity'] * $value['Product Price']);

                            $_SESSION['massege'] = "SUCCESSFULL OPARATION";
                            $this->update("ep_cart",$temp,['product_id'=>$value['Product id']]);
                        }
                    }

                    unset($_SESSION['CART_ITEM']);
                    
                }else{
                    if($this->checkProduct($id) === 0){
                        $temp['user_id'] = $_SESSION['user_id'];
                        $temp['product_id'] = $id;
                        $temp['product_quentity'] = $qty;
                        $temp['product_price'] = $data['product_price'];
                        $temp['product_image'] = $data['product_image'];
                        $temp['product_total'] = ceil($data['product_price'] * $qty);

                        $this->insert("ep_cart",$temp);
                    }else{
                        $temp['product_quentity'] = $qty;
                        $temp['product_total'] = ceil($data['product_price'] * $qty);;

                        $this->update("ep_cart",$temp,['product_id'=>$id]);
                    }
                }
            }else{
                
                if(isset($_SESSION['CART_ITEM'])){
                    //make a session for insert data
                    $arr = $_SESSION['CART_ITEM'];
                    if(isset($arr)){
                        foreach($arr as $key => $value){
                            
                            if($value['Product id'] === $id){
                                $_SESSION['CART_ITEM'][$key]['Product Quantity'] = $qty;
                                $_SESSION['CART_ITEM'][$key]['Product Total'] = ceil($data['product_price'] * $qty);
                                return ;
                            }
                        }
                       
                        $_SESSION['CART_ITEM'] += [
                                $this->str_random(20) => [
                                    "Product id" => $data['product_id'],
                                    "Product Name" => $data['product_name'],
                                    "Product Title" => $data['product_sort_title'],
                                    "Product Image" => $data['primary_image'],
                                    "Product Title" => $data['product_title'],
                                    "Product Price" => $data['product_price'],
                                    "Product Total" => ceil($data['product_price'] * $qty),
                                    "Product Quantity" => $qty,
                                ]
                            ]
                            ;
                        return "";
                        
                    }

                    
                }else{
                    $_SESSION['CART_ITEM'] = [
                        $this->str_random(20) => [
                            "Product id" => $data['product_id'],
                            "Product Name" => $data['product_name'],
                            "Product Title" => $data['product_sort_title'],
                            "Product Image" => $data['primary_image'],
                            "Product Title" => $data['product_title'],
                            "Product Price" => $data['product_price'],
                            "Product Total" => ceil($data['product_price'] * $qty),
                            "Product Quantity" => $qty,
                        ]
                    ]
                    ;
                }
            }
        }

        public function cartGet($id){
                $result = $this->con->query("SELECT * FROM ep_cart WHERE user_id=$id");
                if($result == false){
                    return null;
                }
    
                $temp = "";
                $product = new product($this->con);
    
                while($row = $result->fetch_assoc()){
                $prd = $product->product($row['product_id']); 
                ?>
                    <tr>
                        <td class="cart_product">
                            <a href="<?php echo ep_option($this->con,"siteurl")."/product-details.php?id=".$row['id'];?>"><img height="80" src="<?php echo ep_option($this->con,"siteurl")."/".$row['product_image'];?>" alt="" width="80"></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="<?php echo ep_option($this->con,"siteurl").$prd['product_name'];?>/"><?php echo $prd['product_name'];?></a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>&#2547; <?php echo $row['product_price']; ?></p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                            <form action="<?php echo ep_option($this->con,"siteurl");?>/ep-content/request_checker/cart.php" method="POST">
                                <input name="productId" value="<?php echo $row['id']; ?>" type="hidden">
                                <input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $row['product_quentity'];?>" autocomplete="off" size="2">
                                <input name="updateQuantity" type="submit" value="Update" class="btn btn-secondary">
                            </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">&#2547;  <?php echo $row['product_total']; ?></p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="<?php echo ep_option($this->con,"siteurl");?>/ep-content/request_checker/cart.php?deleteCart=<?php echo $row['id'];?>"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
               <?php }
            }
    public function deleteCart($id){
        $this->con->query("DELETE FROM ep_cart WHERE id=$id");
        if($this->con->error){
            echo "Sorry to delete item There is something wrong line no:".__LINE__;
            return false;
        }
        return true;
    }

    public function editCart($id,$qty){
        $query = $this->con->query("SELECT * FROM ep_cart WHERE id=$id");
        $result = $query->fetch_assoc();

        $id = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$id)));
        $qty = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$qty)));

        //var_dump(ceil((INT)$result['product_price'] * (INT)$qty));
        $data = array(
            "product_quentity"=>$qty,
            "product_price"=>$result['product_price'],
            "product_total"=> ceil((INT)$result['product_price'] * (INT)$qty),
        );
        $query = $this->update('ep_cart',$data,array('id'=>$id));
        if($this->con->error){
            echo "Sorry to delete item There is something wrong line no:".__LINE__;
            return false;
        }

        return true;
    }
}
