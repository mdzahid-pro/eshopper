<?php
    function insert_ep_option($con,$link,$home,$name,$description,$email){
        $select = "SELECT * FROM ep_options";
        $query = $con->query($select);
        //make a array for store all data 
        $arr = array("site_url"=>$link,"home_url"=>$home,"Site_title"=>$name,"site_description"=>$description,"email"=>$email);
        //check number of row are have in database
        $num = $query->num_rows;
        if($num < 24){
            //now write a query to insert all data
            $insert = "INSERT INTO ep_options ()";
        }
    }