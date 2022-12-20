<?php include('../config/constants.php'); ?>

<html>
<head>
       <title> LogIn Maalshaay  </title>
       <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">login</h1>

        <br><br>

        <?php

            if(isset($_SESSION['login']))
            {
            //echo "boom";
             echo $_SESSION['login'];// DISPLAY THE MSG
              unset($_SESSION['login']);// remove the msg
            }

            if(isset($_SESSION['no-login-message']))
            {
                //echo "boom";
                echo $_SESSION['no-login-message'];// DISPLAY THE MSG
                unset($_SESSION['no-login-message']);// remove the msg
            }
        ?>
        <br><br>

        <!-- login form starts here -->

        <form action="" method="post">
        Username: <br>
        <input type="text" name="username" placeholder="Enter username"> <br><br>

        Password: <br>
        <input type="password" name="password" placeholder="Enter Password"> <br><br>

        <input type="submit" name="submit" value="Login" class="btn-primary"> <br><br>

        <input type="submit" name="userpanel" value="Back to User Panel" class="btn-secondary"> <br><br><br>
        </form>

        <p class="text-center"> created by  <a href="https://www.facebook.com/Armanhossain1190"> Arman Hossain</a><p>
</div>
</body>

</html>

<?php

    //if user panel clicked
    if(isset($_POST['userpanel']))
    {
        header("location:".SITEURL);  
    }
    
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //get data from form

      //$username= $_POST['username'];
      //$password= md5($_POST['password']);// md5 for encryption of the password

      $username= mysqli_real_escape_string($conn ,$_POST['username']); //mysqli_real_escape_string used for prevent error if user inputs " or '
     // $password= md5($_POST['password']);
      $password= mysqli_real_escape_string($conn ,md5($_POST['password']));

       //check whether the id exist or not
       $sql ="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

       //execute the query
       $res = mysqli_query($conn,$sql);

        //check the dataes in table
        $count = mysqli_num_rows($res);

        if($count==1)
        {
                //available & login success
                $_SESSION['login']="<div class='success'>Login successful.</div>";
                $_SESSION['user']=$username; //to check that the user is loged in or not and log out will unset it

                header("location:".SITEURL.'admin/');
        }
        else
        {
            //not available & login failed
            $_SESSION['login']="<div class='error text-center'>Wrong username or password</div>";
            header("location:".SITEURL.'admin/login.php');
        }
    }
?>