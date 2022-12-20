<?php
        //include constants.php
    include('../config/constants.php');

     if(isset($_GET['id']) AND isset($_GET['image_name']))
     {
         //process to dlt
         // 1. get id & imagename
        $id=$_GET['id'];
        $image_name = $_GET['image_name'];

         //2. remove the image if available
         if($image_name != "")
         {
             //get the image path
             $path = "../images/food/".$image_name;
             //remove the image
             $remove= unlink($path);

             //if fail to remove image
            if($remove== false)
            {
                //set the session msg
                $_SESSION['remove']="<div class='error'>failed to remove Food image file. </div>";
                //redirect to mng category
                header("location:".SITEURL.'admin/manage-food.php');
                die();
            }
         }

         //3. delete food from database
         $sql = "DELETE FROM tbl_food WHERE id=$id";

         //execute the query
             $res = mysqli_query($conn,$sql);

            //check whether the query executed or not
              //4.redirect
            if($res==true)
            {
                
                //create a session Variable to Display msg
                $_SESSION['delete']="<div class='success'>food deleted successfully</div>";
                //redirect page to manage category
                header("location:".SITEURL.'admin/manage-food.php');

            }

            else{
                //failed to delete food;
                 //create a session Variable to Display msg
                $_SESSION['delete']="<div class='error'>failed to delete food. Try Again</div>";
                //redirect page to manage category
                header("location:".SITEURL.'admin/manage-food.php');
            }

       
     }
     else 
     {
         //redirect to manage food
          //create a session Variable to Display msg
        $_SESSION['unauthorized']="<div class='error'>Unauthorized Access. Try Again</div>";
        //redirect page to manage category
        header("location:".SITEURL.'admin/manage-food.php');

     }
?>