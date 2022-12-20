<?php

    //include constants.php
    include('../config/constants.php');

    //1 get the id of admin to delete
    $_id =$_GET['id'];

    //2 create sql query to dlt
    $sql = "DELETE FROM tbl_admin WHERE id=$_id";

    //execute the query
    $res = mysqli_query($conn,$sql);

    //check whether the query executed or not
    if($res==true)
    {
        //executed successfully deleted
       // echo "admin deleted";
         //create a session Variable to Display msg
         $_SESSION['delete']="<div class='success'>admin deleted successfully</div>";
         //redirect page to merge admin
         header("location:".SITEURL.'admin/manage-admin.php');

    }
    else{
        //failed to delete
        //echo "failed to delete";
        //create a session Variable to Display msg
        $_SESSION['delete']="<div class='error'>failed to delete admin. Try Again</div>";
        //redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
    }

    //3 redirect to admin page with msg
?>