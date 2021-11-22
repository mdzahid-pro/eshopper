<?php
    //database name
    define("DB_NAME",'eshopper');
    //database username name
    define("DB_USER",'eshopper');
    //database password
    define("DB_PASS",'5lBOp15OcHNIyTEP');
    //database host name
    define("DB_HOST",'localhost');
    //echo DB_HOST;

    $con = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if($con == false){
        echo "Sorry To Connect With Database: ".$con->error();
    }