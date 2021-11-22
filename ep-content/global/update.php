<?php 
    // make a class to update all data i get from the browser
    class update{
        //make a public function and use Constructor method
        
        //now make function that name will be update it will be public
        public function update(string $table,array $data,array $where){
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
                return "Sorry to update your data ".$this->con->error;
            }else{
                return true;
            }
        }
    }