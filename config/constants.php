<?php
        //start session
        session_start();
        
        /* execute query and save data in database */ 

    //creates constants to store non repeating values
    define('SITEURL','http://localhost/maalshaay/'); //for home page
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','maalshaay');


       $conn= mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());  //CONNECTING DATABASE
       $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());  //SELECTING DATABASE
?>