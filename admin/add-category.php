<?php include('partials/menu.php'); ?> 

<div class="main-content">

<div class="wrapper">
    <h1>Add Category</h1>
    <br><br>

    <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];// DISPLAY THE MSG
                unset($_SESSION['add']);// remove the msg
            }


            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];// DISPLAY THE MSG
                unset($_SESSION['upload']);// remove the msg
            }
      ?>
      
      <br><br>

    <!--  add category form starts here-->
    <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td> <input type="text" name="title" placeholder="Category Title"></td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td> <input type="file" name="image"></td>
            </tr>


            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
            </td>

            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
            </td>

            </tr>

            <tr>
                <td colspan="2">
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>
   
    <?php

        if(isset($_POST['submit']))
        {
            //echo "clicked";

            $title= $_POST['title'];
            
            //for radio typre we need to check whether the button is clicked or not
            if(isset($_POST['featured']))
            {
                //get the value from form
                $featured = $_POST['featured'];
            }
            else{
                //set the default value
                $featured = "No";
            }

            //for active
            if(isset($_POST['active']))
            {
                //get the value from form
                $active = $_POST['active'];
            }
            else{
                //set the default value
                $active = "No";
            }
            //check whether the image is selected or not or set the value for image accordingly


            if(isset($_FILES['image']['name']))
            {
                //upload the image
                //we need image name ,source path ,destination path
                $image_name= $_FILES['image']['name'];

                //if there is image available
                if($image_name != "")
                {

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
                        header("location:".SITEURL.'admin/add-category.php');
                        //stop the process
                        die();


                    }
            
                }
            }
            else{
                //dont upload and set the image value blank
                $image_name="";
            }

            //create sql to execute dataes
            $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";

            //execute the query
            $res = mysqli_query($conn,$sql);

            //check whether is executed or not
            if($res==true){
                //executed
                 //create a session Variable to Display msg
            $_SESSION['add']="<div class='success'>Category added successfully.</div>";
            //redirect page to merge category
            header("location:".SITEURL.'admin/manage-category.php');
            }
            else{
                //failed to add category
            //create a session Variable to Display msg
            $_SESSION['add']="<div class='error'>Failed to Add Category.</div>";
            //redirect page to add category
            header("location:".SITEURL.'admin/add-category.php');
            }

        }

    ?>

    </div>
</div>

<?php include('partials/footer.php');?>