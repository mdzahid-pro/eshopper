<?php 
    // make a class that will do many thing first insert update delete 
    class CATEGORY extends insert{
        public function __construct(protected $con)
        {
            
        }

        //make a class to filter all data 
        private function filter($data){
            $data = htmlentities(htmlspecialchars(mysqli_real_escape_string($this->con,$data)));
            return $data;
        }

        // make a function to check status are have or not if status = 0 than return 0
        private function checkStatus($data){
            if($data == 1){
                return 1;
            }else{
                $data = 0;
            }
        }

        //that function will this check name is unique or not
        private function checkName($data,$table){
            if($table == 'ep_category'){
                $where = "category_name='$data'";
            }else{
                $where = "manufacture_name='$data'";
            }
            $query = $this->con->query("SELECT * FROM {$table} WHERE {$where}");
            if($query == false){
                echo "Sorry to run this query".$this->con->error;
            }

            return $query->num_rows;
        }

        //make a function that fucntion will make a array to insert data
        private function checkTable($table,$name,$status){
            if($table == 'ep_category'){
                return array(
                    'category_name' => $name,
                    'category_status' => $status,
                );
            }else{
                return array(
                    'manufacture_name' => $name,
                    'manufacture_status' => $status,
                );
            }
        }

        //make a funciton to insert into database
        public function inserte($name,$status=0,$table='ep_category'){
            //now filter all data
            $name = $this->filter($name);
            $status = $this->filter($status);

            //check status 
            $this->checkStatus($status);

            //check that name is unique or not
            if($this->checkName($name,$table) == 0){
                //now insert data
                //make a array to store data
                $data = $this->checkTable($table,$name,$status);
                $query = $this->insert($table,$data);
                if($query == false){
                    echo "Sorry to insert data ".$this->con->error;
                    return false;
                }
                $_SESSION['massege'] = "Created successfully";
                header("Location: ../../add-category.php");
            }else{
                $_SESSION['massege'] = "Sorry to create that name is already have try another one";
                header("Location: ../../add-category.php");
            }
        }

        public function active($table='ep_category',$id){
            if($table == 'ep_category'){
                $data = $this->update($table,array('category_status'=>'1'),array('id'=> $id));
            }else{
                $data = $this->update($table,array('manufacture_status'=>'1'),array('id'=> $id));
            }

            if($data == false){
                echo "Sorry to active".$this->con->error;
                return false;
            }
            
            $_SESSION['massege'] = "Actived Successfull";
            return true;
        }

        public function de_active($table='ep_category',$id){
            if($table == 'ep_category'){
                $data = $this->update($table,array('category_status'=>'0'),array('id'=> $id));
            }else{
                $data = $this->update($table,array('manufacture_status'=>'0'),array('id'=> $id));
            }

            if($data == false){
                echo "Sorry to De-Active".$this->con->error;
                return false;
            }
            
            $_SESSION['massege'] = "De-Actived Successfull";
            return true;
        }

        //make a function that will delete
        public function deletes($table='ep_category',$id){
            $query = $this->con->query("DELETE FROM $table WHERE id='$id'");
            if($query == false){
                echo "Sorry to delete".$this->con->error;
                return false;
            }
            echo "Working";
            $_SESSION['massege'] = "Successfull Delete Data";
            return true;
        }

        //make a function to edit all data
        public function edit($id,$name,$status,$table='ep_category'){
            //now filter all data come from the browser
            $name = $this->filter($name);
            $status = $this->filter($status);
            $id = $this->filter($id);

            //check name is unique or not
            
            //check that name is unique or not
            if($this->checkName($name,$table) == 0){
                //now insert data
                //make a array to store data
                $data = $this->checkTable(table: $table,name: $name,status: $status);
                $query = $this->update($table,$data,array('id'=>$id));
                if($query == false){
                    echo "Sorry to insert data".$this->con->error;
                    return false;
                }
                $_SESSION['massege'] = "Updated successfully";
                return true;
            }else{
                $_SESSION['massege'] = "Sorry to Update that name is already have try another one";
                return true;
            }
        }

        //now make function that name will be update it will be public
        private function update(string $table,array $data,array $where){
            //we need to defined two variable one will store data and other one will store where will execute 
            $datas = "";
            $wheres = "";
            //now i need to make a string from an array
            //run a loop 
            foreach($data as $key => $values){
                $datas .= $key. "='".$values."', ";
            }

            $datas .= substr($datas,-0,-2);

            //now i need to make a string from array for the where condition
            foreach($where as $key => $value){
                $wheres .= $key . "='".$value."'";
            }
            
            //write a query 
            $query = $this->con->query("UPDATE $table SET $datas WHERE $wheres");
            if($this->con->error){
                echo "Sorry to update your data ".$this->con->error;
                return false;
            }else{
                return true;
            }
        }

        public function getAllData($start = 0,$end = 10,$tables='ep_category'){
            if($start == 0){
                $start = 0;
            }else{
                $start = $start * $end;
            }

            // than make a query to get specifique data
            $query = $this->con->query("SELECT * FROM $tables ORDER BY id LIMIT 0,10");
            if(mysqli_error($this->con)){
                echo "There went somthing wrong".mysqli_error($this->con);
            }
            $length = ceil($query->num_rows / $end);

            $table = '
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">Slide Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            ';

            // /var_dump($query->fetch_assoc());

            if($tables == 'ep_category'){
                //return fetch data
                while($row = $query->fetch_assoc()){ 
                    //check category status
                    if($row['category_status'] == 1){
                        $data = "<td class='text-success'><label class='label label-success'>Active</label></td>";
                        $ankhor = "<a class='btn btn-info text-danger' href='".ep_option($this->con,'siteurl')."/admin/ep-content/request-checker/category.php?de_active=".$row['id']."'><i class='fa fa-thumbs-down'></i></a>";
                    }else{
                        $data = "<td class='text-danger'><label class='label label-danger'>De-Active</label></td>";
                        $ankhor = "<a class='btn text-success btn-light' href='".ep_option($this->con,'siteurl')."/admin/ep-content/request-checker/category.php?active=".$row['id']."'><i class='fa fa-thumbs-up'></i></a>";
                    }
                    $table .= '
                        <tr>
                            <td scope="row">'.$row['id'].'</td>
                            <td>'.$row['category_name'].'</td>
                            '.$data.'
                            <td style=";"> 
                            '.$ankhor.'
                                <a class="btn btn-info" href="'. ep_option($this->con,'siteurl') .'/admin/edit-category.php?edit='.$row['id'].'"><i class="fa 
                                fa-pencil"></i></a>
                                <a class="btn btn-danger" href="'. ep_option($this->con,'siteurl') .'/admin/ep-content/request-checker/category.php?delete='.$row['id'].'"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    ';
                }
            }else{
                //return fetch data
                while($row = $query->fetch_assoc()){ 
                    if($row['manufacture_status'] == 1){
                        $data = "<td class='text-success'><label class='label label-success'>Active</label></td>";
                        $ankhor = "<a class='btn btn-info text-danger' href='".ep_option($this->con,'siteurl')."/admin/ep-content/request-checker/category.php?mde_active=".$row['id']."'><i class='fa fa-thumbs-down'></i></a>";
                    }else{
                        $data = "<td class='text-danger'><label class='label label-danger'>De-Active</label></td>";
                        $ankhor = "<a class='btn text-success btn-light' href='".ep_option($this->con,'siteurl')."/admin/ep-content/request-checker/category.php?mactive=".$row['id']."'><i class='fa fa-thumbs-up'></i></a>";
                    }
                    $table .= '
                        <tr>
                            <td scope="row">'.$row['id'].'</td>
                            <td>'.$row['manufacture_name'].'</td>
                            '.$data.'
                            <td style=";"> 
                            '.$ankhor.'
                                <a class="btn btn-info" href="'. ep_option($this->con,'siteurl') .'/admin/edit-brand.php?edit='.$row['id'].'"><i class="fa 
                                fa-pencil"></i></a>
                                <a class="btn btn-danger" href="'. ep_option($this->con,'siteurl') .'/admin/ep-content/request-checker/category.php?mdelete='.$row['id'].'"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    ';
                }
            }

            $table .= "</tbody><tfoor> <tr><td colspan='9'>";

            for($i=0; $i < $length;$i++){
                $table .= "<a href='all-product.php?pageno='".$i."' class='label label-info'>";
            }

            $table .= "<td></tr></tfoot>
            </table>";

            return $table;
        }

        public function getData(string $table='ep_category',int $id = null,string $type = 'id'){
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
        public function getOne($id,$table='ep_category'){
            $query = $this->con->query("SELECT * FROM $table WHERE id='".$id."'");
            if($this->con->error){
                echo "Something went wrong";
            }

            if($query->num_rows > 0){
                return $row = $query->fetch_assoc();
            }else{
                echo "There are have something wrong";
            }
        }

        public function get_all_cm($table="ep_category"){
            $query = $this->con->query("SELECT * FROM $table");
            if($this->con->error){
                echo "Something went wrong";
            }
            $data = "";
            if($table=="ep_category"){
                $data = '<div style="border:none" class="mb-3"><select name="category_name" class="form-select" aria-label="Default select example">
                <option selected>Select Category</option>';

                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        if($row['category_status'] == 1){
                            $data .= "<option value='". $row['id'] . "'> ". $row['category_name'] ." </option>";
                        }
                    }

                    $data .= '</select></div>';
                    return $data;
                }else{
                    echo "There are have something wrong";
                }
            }else{
                $data = '
                <div class="mb-3"><select name="brand_name" class="form-select" aria-label="Default select example">
                <option selected>Select Brand</option>';

                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        if($row['manufacture_status'] == 1){
                            $data .= "<option value='". $row['id'] . "'> ". $row['manufacture_name'] ." </option>";
                        } 
                    }

                    $data .= '</select></div>';
                    return $data;
                }else{
                    echo "There are have something wrong";
                }
            }
        }

        public function get_category($table = "ep_category"){
            $query = $this->con->query("SELECT * FROM $table");
            if($this->con->error){
                echo "Something went wrong";
            }
            $data = "";
            if($table=="ep_category"){
                while($row = $query->fetch_assoc()){
                    echo '<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">';
                                        echo '<a href="product-category.php?id='.$row['id'].'">'.$row['category_name'].'</a>';
                                    
                                echo '</h4>
								</div>
							</div>';
                }
            }else{
                while($row = $query->fetch_assoc()){
                    $num = $this->con->query("SELECT * FROM `ep_product` WHERE `manufacture_id`='". $row['id'] ."'");
                    $num = $num->num_rows;

                    echo '<li><a href="product-brand.php?id='.$row['id'].'"> <span class="pull-right">('.$num.')</span>'.$row['manufacture_name'].'</a></li>';
                }
            }
        }
    }