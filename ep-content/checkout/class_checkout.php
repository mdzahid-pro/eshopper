<?php 
    class CHECKOUT extends database{
        public function __construct(protected $con){
        }

        private function filter($data){
            return $data = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$data)));
        }

        public function create($email,$fname,$lname,$addrOne,$addrTwo,$zipCode,$country,$mobile){
            $email = $this->filter($email);
            $fname = $this->filter($fname);
            $lname = $this->filter($lname);
            $addrOne = $this->filter($addrOne);
            $addrTwo = $this->filter($addrTwo);
            $zipCode = $this->filter($zipCode);
            $country = $this->filter($country);
            $mobile = $this->filter($mobile);

            if(empty($email) == true and empty($fname) == true and empty($addrOne) == true and empty($addrTwo) == true and empty($zipCode) == true and empty($country) == true and empty($mobile) == true){
                header("location: ".$_SERVER['HTTP_REFERER']);
            }

            $data = array(
                "email" => $email,
                "frist_name" => $fname,
                "last_name" => $lname,
                "addr_one" => $addrOne,
                "addr_two" => $addrTwo,
                "zip_code" => $zipCode,
                "country" => $country,
                "mobile" => $mobile,
            );
            $id = $this->insert("ep_checkout",$data);
            if($id){
                $_SESSION['checkout_user'] = true;
                $_SESSION['checkout_id'] = $id;
                $_SESSION['massege'] = "Successfully Inserted value";
                header("Location: ../../checkout.php");
            }else{
                $_SESSION['massege'] = "Failed to Insert value";
                header("Location: ../../checkout.php");
            }
        }

        public function placeOrder($method=null){
            if(isset($_SESSION['user_id'])){
                
            }else{
                if(isset($_SESSION['checkout_user'])){
                    if(isset($_SESSION['checkout_id'])){
                        if(isset($_SESSION["CART_ITEM"])){
                            if(empty($_SESSION["CART_ITEM"]) == false){
                                $arr = array(
                                    "user_id" => 0,
                                    "payment_method" => $method,
                                    "checkout_id" => $_SESSION['checkout_id'],
                                    "payment_status" => 0,
                                );

                                $query = $this->insert('ep_payment',$arr);
                                if($query == false){
                                    $_SESSION['massege'] = "Sorry to add order!".__LINE__;
                                    return false;
                                }

                                foreach($_SESSION["CART_ITEM"] as $key => $row){
                                    $data = $_SESSION['CART_ITEM'][$key];
                                    $arr = array("product_id"=>$data['Product id'],"checkout_id"=>$_SESSION['checkout_id'],"product_quantity"=>$data['Product Quantity']);
                                    $id = $this->insert('ep_order',$arr);
                                    if($id == false){
                                        $_SESSION['massege'] = "Sorry to add order!".__LINE__;
                                        return false;
                                    }
                                    unset($_SESSION['CART_ITEM'][$key]);
                                }

                                $_SESSION['massege'] = "Your Order Successfully Recived";
                                $_SESSION['ext_massege'] = "We will Contact with you as soon as posible";
                                unset($_SESSION['checkout_id']);
                                unset($_SESSION['checkout_user']);
                                return true;
                            }else{
                                $_SESSION['massege'] = "No Item Selected hare!".__LINE__;
                                return false;
                            }
                        }else{
                            $_SESSION['massege'] = "No Item Selected hare!".__LINE__;
                            return false;
                        }
                    }else{
                        $_SESSION['massege'] = "Before order please fill the checkout form!".__LINE__;
                        return false;
                    }
                }else{
                    $_SESSION['massege'] = "Before order please fill the checkout form!".__LINE__;
                    return false;
                }
            }
        }
    }