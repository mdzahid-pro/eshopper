<?php 
    //make a validation function to validate all data this function will execute only admin panel
    function validate($con='',$data,$max=255,$min=0,$requered=false,$unique=['table' => '','data'=>'','where'=>'']){
        // now need to check this filed is requered or not
        filterData($data,$con);
        
        if($requered == true){
            requered($data);
        }

        if($unique['data'] !== '' and $unique['where'] !== '' and $unique['table'] !== ''){
            if(uniqueData($unique['table'],$unique['data'],$unique['where'],$con) == false){
                return "This data is already exists on this table";
            }
        }

        if(maxdata($data,$max) == false){
            return "This value can't be biggerthan $max value.";
        }

        if(mindata($data,$min) == false){
            return "This value Must be $min charecter";
        }

        return $data;
    }

    function filterData($data,$con){
        if($con == ""){
            return htmlentities(htmlspecialchars($data));
        }else{
            return htmlentities(htmlspecialchars(mysqli_real_escape_string($con,$data)));
        }
    }

    function mindata($data,$min){
        if(strlen($data) <= $min){
            return true;
        }else{
            return false;
        }
    }

    function maxdata($data,$max){
        if(strlen($data) >= $max){
            return false;
        }else{
            return true;
        }
    }

    function uniqueData($table,$data,$where,$con){
        //write query to check that data are have or not
        $query = mysqli_query($con,"SELECT * FROM $table WHERE $where='$data'");
        if(mysqli_num_rows($query) == 0){
            return true;
        }else{
            return false;
        }
    }

    function requered($data){
        if($data == null){
            return false;
        }else{
            return true;
        }
    }