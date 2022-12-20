<?php
        //authorization  - access control
        // whether the user is login or not
        if(!isset($_SESSION['user']))//if session is not set
            {
               //user is not logged in
               $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access the admin panel</div>";
               //redirect to login page
               header("location:".SITEURL.'admin/login.php');
            }
?>