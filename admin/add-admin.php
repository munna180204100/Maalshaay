<?php include('partials/menu.php'); ?> 

<div class="main-content">

<div class="wrapper">
    <h1>Add Admin</h1>
    <br><br>

    <?php
            if(isset($_SESSION['add']))
            {
               
                echo $_SESSION['add'];// DISPLAY THE MSG
                unset($_SESSION['add']);// remove the msg
            }
      ?>

      <br><br><br>

    <form action="" method="post">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td> <input type="text" name="full_name" placeholder="Enter Your Name"></td>
            </tr>

            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Your Username"></td>

            </tr>

            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="Your Password"></td>
            </tr>

            <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>
</div>
</div>

<?php include('partials/footer.php');?>

<?php
    //process the value from Form and save it in database

    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //button clicked
       $full_name= $_POST['full_name'];
       $username= $_POST['username'];
       $password= md5($_POST['password']);// md5 for encryption of the password
       

       //sql query to save the data into database
       $sql ="INSERT INTO tbl_admin set full_name= '$full_name',
                                        username= '$username',
                                        password= '$password'";


       //executing query & saving data in database
        $res = mysqli_query($conn,$sql) or die(mysqli_error());

        //check whether the query is executed , data is inserted or not & display appropiate msg
         
        if($res==true)     
        {
            //echo "data inserted";
            //create a session Variable to Display msg
            $_SESSION['add']="admin added successfully";
            //redirect page to merge admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else 
        {
           // echo "not inserted";
            //create a session Variable to Display msg
            $_SESSION['add']="failed to add admin";
            //redirect page to add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
    
?>