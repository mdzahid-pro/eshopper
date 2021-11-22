<?php
class RIVIEW extends insert{
    public function __construct(protected $con)
    {
        
    }
    private function filter($data){
        return htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$data)));
    }

    public function insertRiview($id,$name,$email,$review){
        $id = $this->filter($id);
        $name = $this->filter($name);
        $email = $this->filter($email);
        $review = $this->filter($review);

        $product = $this->con->query("SELECT * FROM `ep_product` WHERE id={$id}");
        if($product->num_rows == 1){
            $data = array(
                'product_id'=>$id,
                'user_email'=>$email,
                'comment'=>$review,
                'user_ratting'=>5,
            );
            $insert = $this->insert('ep_product_review',$data);
            if($insert == false){
                echo "There something wrong";
                return false;
            }

            $_SESSION['massege'] = "Review Inserted successfull";
            return true;
        }else{
            //echo "<script>location.href='../../index.php'</script>";
        }
    }
}