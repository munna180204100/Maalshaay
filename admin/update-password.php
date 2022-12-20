<?php include('partials/menu.php'); ?> 

<div class="main-content">

    <div class="wrapper">
        <h1>Change Password</h1>

        <br><br>

       

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="post">
            <table class="tbl-30">

            <tr>
                <td>Current Password:</td>
                <td> 
                    <input type="password" name="current_password" placeholder="current password">
                </td>
            </tr>

            <tr>
                <td>New Password:</td>
                <td>
                  <input type="password" name="new_password" placeholder="new password">
                </td>
            </tr>

            <tr>
                <td>Confirm Password:</td>
                <td> 
                    <input type="password" name="confirm_password" placeholder="confirm password">
                </td>
            </tr>

            <tr>
                <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id ;?>"> 
                <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
            </tr>



            </table>
        </form>
     </div>
</div>

<?php
//chech if clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button Clicked";
         //get all the values
       $id=$_POST['id'];
       $current_password=md5($_POST['current_password']);
       $new_password=md5($_POST['new_password']);
       $confirm_password=md5($_POST['confirm_password']);

       //check whether the id exist or not
       $sql ="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //execute the query
        $res = mysqli_query($conn,$sql);


        if($res==true)     
        {
            //check the dataes in table
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //get the details
               // echo "user found";
               if($new_password==$confirm_password)
               {
                   //updare the pass
                  // echo "matched";
                  $sql2= "UPDATE tbl_admin SET
                  password='$new_password'
                  WHERE id='$id'
                  ";

                  //execute
                  $res2 = mysqli_query($conn,$sql2);

                  //check if execute or not
                  if($res2==true) 
                   {

                    $_SESSION['pwd-changed']="<div class='success'>Password changed succesfully</div>";
                    //redirect
                    header("location:".SITEURL.'admin/manage-admin.php');

                   }   
                   else
                   {
                    $_SESSION['pwd-changed']="<div class='error'>Failed to change password</div>";
                    //redirect
                    header("location:".SITEURL.'admin/manage-admin.php');
                   }
        
}
               else{
                   //redirect
                   $_SESSION['pwd-not-matched']="<div class='error'>Comfirm the password correctly</div>";
                //redirect
                header("location:".SITEURL.'admin/manage-admin.php');
               }
                
            }
            else{

                $_SESSION['user-not-found']="<div class='error'>User Not Found</div>";
                //redirect
                header("location:".SITEURL.'admin/manage-admin.php');
            }

        }
      
    }

?>

<?php include('partials/footer.php');?>