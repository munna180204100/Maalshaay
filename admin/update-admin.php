<?php include('partials/menu.php'); ?> 

<div class="main-content">

<div class="wrapper">
    <h1>Update Admin</h1>

    <br><br>

    <?php
        //get the id
        $id=$_GET['id'];

        //create sql to get details
        $sql ="SELECT *FROM tbl_admin WHERE id=$id";

        //execute query
        $res= mysqli_query($conn,$sql);

        if($res==true)     //solve from here
        {
            //check the dataes in table
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //get the details
                //echo "updated properly";
                $row=mysqli_fetch_assoc($res);

                $full_name=$row['full_name'];
                $username=$row['username'];
            }
            else{
                //redirect
                header("location:".SITEURL.'admin/manage-admin.php');
            }

        }
       
    ?>

    <form action="" method="post">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td> <input type="text" name="full_name" value="<?php echo $full_name ;?>"></td>
            </tr>

            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" value="<?php echo $username ;?>"></td>

            </tr>


            <tr>
                <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id ;?>">    
                <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>

    </div>
</div>

<?php
    if(isset($_POST['submit']))
    {
       // echo "Button Clicked";
       //get all the values
       $id=$_POST['id'];
       $full_name=$_POST['full_name'];
       $username=$_POST['username'];

       //create a query to update admin
       $sql = "UPDATE tbl_admin SET
       full_name='$full_name',
       username='$username'
       WHERE id='$id'
       ";

       //execute the query
       $res = mysqli_query($conn,$sql);

       //check whether executed or not
       if($res==true)
       {
           //executed successfully deleted
            //create a session Variable to Display msg
            $_SESSION['update']="<div class='success'>admin updated successfully</div>";
            //redirect page to merge admin
            header("location:".SITEURL.'admin/manage-admin.php');
   
       }
       else{
           //failed to delete
           //create a session Variable to Display msg
           $_SESSION['update']="<div class='error'>failed to update admin. Try Again</div>";
           //redirect page to merge admin
           header("location:".SITEURL.'admin/manage-admin.php');
       }

    }
?>

<?php include('partials/footer.php');?>