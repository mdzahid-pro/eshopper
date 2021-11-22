<?php 
    class GETALLSlider{
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
            $query = $this->con->query("SELECT * FROM slider ORDER BY id LIMIT 0,10");
            if(mysqli_error($this->con)){
                echo "There went somthing wrong".mysqli_error($this->con);
            }
            $length = ceil($query->num_rows / $end);

            $table = '
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Slide Id</th>
                    <th scope="col">Slider Heading</th>
                    <th scope="col">Slider Description</th>
                    <th scope="col">Slider Status</th>
                    <th scope="col">Image</th>
                    <th scope="col">Slider Action</th>
                </tr>
            </thead>
            <tbody>
            ';
            //return fetch data
            while($row = $query->fetch_assoc()){ 
                if($row['slider_status'] == 1){
                    $data = "<td class='text-success'><label class='label label-success'>Active</label></td>";
                    $ankhor = "<a class='btn btn-info text-danger' href='".ep_option($this->con,'siteurl')."/admin/ep-content/request-checker/slider.php?de_active=".$row['id']."'><i class='fa fa-thumbs-down'></i></a>";
                }else{
                    $data = "<td class='text-danger'><label class='label label-danger'>De-Active</label></td>";
                    $ankhor = "<a class='btn text-success btn-light' href='".ep_option($this->con,'siteurl')."/admin/ep-content/request-checker/slider.php?active=".$row['id']."'><i class='fa fa-thumbs-up'></i></a>";
                }
                $table .= '
                    <tr>
                        <td scope="row">'.$row['id'].'</td>
                        <td>'.$row['slider_heading'].'</td>
                        <td style="width:35%;">'.substr($row['slider_description'],0,40).'</td>
                        '.$data.'

                        <td>
                            <img style="width:40px;height:30px;" src="'.ep_option($this->con,'siteurl').'/'.$row['slider_image'].'">
                        </td>

                        <td style=";"> 
                        '.$ankhor.'
                            <a class="btn btn-info" href="'. ep_option($this->con,'siteurl') .'/admin/edit-slider.php?edit='.$row['id'].'"><i class="fa 
                            fa-pencil"></i></a>
                            <a class="btn btn-danger" href="'. ep_option($this->con,'siteurl') .'/admin/ep-content/request-checker/slider.php?delete='.$row['id'].'"><i class="fa fa-times" aria-hidden="true"></i></a>
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