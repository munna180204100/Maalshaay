<?php

    //include constants.php
    include('../config/constants.php');

    //echo "delete page";
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the values nd dlt
        $id=$_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file if available
        if($image_name != ""){
            //image is available
            $path = "../images/category/".$image_name;
            //remove the image
            $remove= unlink($path);
            

            //if fail to remove image
            if($remove== false)
            {
                //set the session msg
                $_SESSION['remove']="<div class='error'>failed to remove Category image. </div>";
                //redirect to mng category
                header("location:".SITEURL.'admin/manage-category.php');
                die();
            }
        }

        //delete data from database
        //2 create sql query to dlt
                $sql = "DELETE FROM tbl_category WHERE id=$id";

        //execute the query
            $res = mysqli_query($conn,$sql);

            //check whether the query executed or not
    if($res==true)
    {
        
         //create a session Variable to Display msg
         $_SESSION['delete']="<div class='success'>Category deleted successfully</div>";
         //redirect page to manage category
         header("location:".SITEURL.'admin/manage-category.php');

    }
    else{
       
        //create a session Variable to Display msg
        $_SESSION['delete']="<div class='error'>failed to delete Category. Try Again</div>";
        //redirect page to manage category
        header("location:".SITEURL.'admin/manage-category.php');
    }
    }
    else{
        //redirect to manage category page
         header("location:".SITEURL.'admin/manage-category.php');
    }
?>