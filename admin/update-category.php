<?php include('partials/menu.php'); ?> 

<div class="main-content">

<div class="wrapper">
    <h1>Update Category</h1>

    <br><br>

    <?php
        if(isset($_GET['id'])){
            //get the id nd other details

                //get the id
            $id=$_GET['id'];

            //create sql to get details
            $sql ="SELECT * FROM tbl_category WHERE id=$id";

            //execute query
            $res= mysqli_query($conn,$sql);

            //check the dataes in table
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //get the details
                $row=mysqli_fetch_assoc($res);

                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active =$row['active'];
            }
            else{

                $_SESSION['no-category-found']="<div class='error'>Category Not Found</div>";
                //redirect
                header("location:".SITEURL.'admin/manage-category.php');
            }
            
        }

        else{
            //redirect to manage category
            header("location:".SITEURL.'admin/manage-category.php');
        }
    ?>
    

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td> <input type="text" name="title" value="<?php  echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                                if($current_image != "")
                                {
                                    //display image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px" >
                                    <?php
                                }
                                else
                                {
                                    //display msg
                                    echo "<div class='error'>Image Not Added</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image:</td>
                        <td> <input type="file" name="image"></td>
                    </tr>


                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if($featured=="Yes") { echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                            <input <?php if($featured=="No") { echo "checked";}?>  type="radio" name="featured" value="No"> No
                    </td>

                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes") { echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                            <input <?php if($active=="No") { echo "checked";}?> type="radio" name="active" value="No"> No
                    </td>

                    </tr>

                    <tr>
                        <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image ;?>">  
                        <input type="hidden" name="id" value="<?php echo $id ;?>">  
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>

        </form>

        <?php
    if(isset($_POST['submit']))
    {
         //get all the values
        $id=$_POST['id'];
       $title=$_POST['title'];
       $current_image=$_POST['current_image'];
       $featured=$_POST['featured'];
       $active=$_POST['active'];

       //update new image 
        if(isset($_FILES['image']['name']))
        {
            //get the details
            $image_name = $_FILES['image']['name'];  

            if($image_name != "")
            {
                //image available
                // upload the new img 
                   //get the extention of image (.jpg .png .gif etc.)
                   $ext = end(explode('.',$image_name));

                   //rename the image
                   $image_name= "Food_Category_".rand(000,999).'.'.$ext;


                   $source_path = $_FILES['image']['tmp_name'];

                   $destination_path ="../images/category/".$image_name;
                   
                   //upload the file
                   $upload = move_uploaded_file($source_path,$destination_path);

                   //check image is uploaded or not
                   if($upload == false)
                   {
                       //set message
                       $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                       //redirect
                       header("location:".SITEURL.'admin/manage-category.php');
                       //stop the process
                       die();


                   }
                   if($current_image!=""){
                                    //remove the current image
                            $remove_path = "../images/category/".$current_image;
                            //remove the image
                            $remove= unlink($remove_path);

                                //if fail to remove image
                    if($remove== false)
                    {
                        //set the session msg
                        $_SESSION['failed-remove']="<div class='error'>failed to remove Current image. </div>";
                        //redirect to mng category
                        header("location:".SITEURL.'admin/manage-category.php');
                        die();
                    }

                }
                  

            }

            else{
                $image_name= $current_image;
            }
        }
        else{
            $image_name= $current_image;
        }

       //update the database
       $sql2 = "UPDATE tbl_category SET
       title='$title',
       image_name='$image_name',
       featured='$featured',
       active='$active'
       WHERE id='$id'
       ";

        //execute the query
        $res2 = mysqli_query($conn,$sql2);

       //redirect
       if($res2==true)
       {
          
            //create a session Variable to Display msg
            $_SESSION['update']="<div class='success'>Category updated successfully</div>";
            //redirect page 
            header("location:".SITEURL.'admin/manage-category.php');
   
       }
       else{
           //create a session Variable to Display msg
           $_SESSION['update']="<div class='error'>failed to update category. Try Again</div>";
           //redirect page
           header("location:".SITEURL.'admin/manage-category.php');
       }
       
    }
    ?>

</div>
</div>
<?php include('partials/footer.php');?>