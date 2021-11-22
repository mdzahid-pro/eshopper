<?php 
    function ep_option($con,$value){
        $query = $con->query("SELECT * FROM ep_options WHERE option_name='".$value."'");
        if($query == true){
            $fetch = $query->fetch_assoc();
            return $fetch['option_value'];
        }else{
            echo "Sorry to run ".mysqli_error($con);
        }
    }