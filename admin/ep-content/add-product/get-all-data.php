<?php 
    class GETallproduct{
        public function __construct(private $con)
        {
            
        }

        public function getAllData($start = 0,$end = 10){
            if($start == 0){
                $start = 0;
            }else{
                $start = $start * $end;
            }

            // than make a query to get specifique data
            $query = $this->con->query("SELECT * FROM ep_product ORDER BY id LIMIT 0,10");
            if(mysqli_error($this->con)){
                echo "There went somthing wrong".mysqli_error($this->con);
            }
            $length = ceil($query->num_rows / $end);

            $table = '
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Product id</th>
                    <th scope="col">Price</th>
                    <th scope="col">Asking Price</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Image</th>
                    <th scope="col">Author</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            ';
            //return fetch data
            while($row = $query->fetch_assoc()){ 
                $authName = $this->getData('ep_product_details' , $row['id'], 'product_id')['auth_name'];
                $images   = $this->getData('ep_product_image' , $row['id'], 'product_id');
                
                $table .= '
                    <tr>
                        <td scope="row">'.$row['product_name'].'</td>
                        <td>'.$row['product_id'].'</td>
                        <td>'.$row['product_price'].'</td>
                        <td>'.$row['product_ask_price'].'</td>
                        <td>'.$row['product_brand'].'</td>

                        <td>
                            <img style="width:40px;height:30px;" src="'.ep_option($this->con,'siteurl').'/'.$images['primary_image'].'">
                            <img style="width:40px;height:30px;" src="'.ep_option($this->con,'siteurl').'/'.$images['image_one'].'">
                            <img style="width:40px;height:30px;" src="'.ep_option($this->con,'siteurl').'/'.$images['image_two'].'">
                            <img style="width:40px;height:30px;" src="'.ep_option($this->con,'siteurl').'/'.$images['image_three'].'">
                            <img style="width:40px;height:30px;" src="'.ep_option($this->con,'siteurl').'/'.$images['image_for'].'">
                        </td>

                        <td>'.$authName.'</td>
                        <td> 
                            <a class="btn btn-info" href="'. ep_option($this->con,'siteurl') .'/admin/edit-product.php?id='.$row['product_id'].'">Edit</a>
                            <a class="btn btn-danger" href="'. ep_option($this->con,'siteurl') .'/admin/delete-product.php?id='.$row['product_id'].'">Delete</a>
                            <a class="btn btn-primary" href="'. ep_option($this->con,'siteurl') .'/admin/view-product.php?id='.$row['product_id'].'">View</a>
                        </td>
                    </tr>
                ';
            }

            $table .= "</tbody><tfoor> <tr><td colspan='9'>";
            for($i=0; $i < $length;$i++){
                $table .= "<a href='all-product.php?pageno='".$i."' class='label label-info'>";
            }
            $table .= "<td></tr></tfoot>
            </table>";

            return $table;
        }

        public function getData(string $table=null,int $id = null,string $type = 'id'){
            //frist we have to check table name is valied or not 
            if($table != null and $id != null){
                // than make a query to get specifique data
                $query = $this->con->query("SELECT * FROM $table WHERE $type='".$id."'");
                if(mysqli_error($this->con)){
                    echo "There went somthing wrong".mysqli_error($this->con);
                }
                //return fetch data
                return $query->fetch_assoc();
            }
            return "Please give me sumthing";
        }

        // make a function to get spesific data from the database
        public function getOne($table,$id){
            $query = $this->con->query("SELECT * FROM $table WHERE product_id='".$id."'");
            if($this->con->error){
                echo "Something went wrong";
            }
            if($query->num_rows > 0){
                return $row = $query->fetch_assoc();
            }else{
                echo "There are have something wrong";
            }
        }
    }