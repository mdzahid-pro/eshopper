<?php 
    class insert{
        public function insert($table,$data){
            // make a variable for store array keys 
            $keys = implode("`,`",array_keys($data));
            // make a variable for store array value or data
            $data = implode("','",$data);
            $query = $this->con->query("INSERT INTO `$table` (`$keys`) VALUES ('$data')");
            if(mysqli_error($this->con)){
                echo die("Sorry to run this query").mysqli_error($this->con);
            }
			
			return $this->con->insert_id;
        }
    }