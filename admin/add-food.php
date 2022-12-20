<?php include('partials/menu.php'); ?> 

<div class="main-content">

<div class="wrapper">
    <h1>Add Food</h1>
    <br><br>

    <?php
         if(isset($_SESSION['upload']))
         {
            
             echo $_SESSION['upload'];// DISPLAY THE MSG
             unset($_SESSION['upload']);// remove the msg
         }
    ?>

<!--  add category form starts here-->
<form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td> <input type="text" name="title" placeholder="Name of the food"></td>
            </tr>

            <tr>
                <td>Description:</td>
                <td> <textarea name="description" cols="30" rows="5" placeholder="Description of the food"></textarea></td>
            </tr>

            <tr>
                <td>Price:</td>
                <td> <input type="number" name="price" ></td>
            </tr>

            <tr>
                <td>Select Image:</td>
                <td> <input type="file" name="image"></td>
            </tr>

            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">
                    <?php
                    //we will only display active categories here
                    //sql for getting all active categories
                    $sql = "SELECT * FROM tbl_category WHERE active= 'Yes'";

                    //executing query & saving data in database
                    $res = mysqli_query($conn,$sql);

                     //count rows
                     $count=mysqli_num_rows($res);

                     if($count>0){
                            //categories
                            //get the data nd display
                         while($row=mysqli_fetch_assoc($res))
                         {
                              //get indivisual data
                              $id=$row['id'];
                              $title=$row['title'];
                             
                              ?>
                              <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                              <?php
                         }
                     }

                     else{
                         //no category
                         ?>
                         <option value="0">No Category Found</option>
                         <?php
                     }

                    //display on dropdown

                    ?>


                    </select>

                </td>
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
                <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>

    <?php
        // submit button clicked or not
        if(isset($_POST['submit']))
        {
            // get the data from form
            $title= $_POST['title'];
            $description= $_POST['description'];
            $price= $_POST['price'];
            $category= $_POST['category'];

            //for radio button featured
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

            //upload the image if selected
             //check whether the image is selected or not or set the value for image accordingly

             if(isset($_FILES['image']['name'])){
                 //get the image details
                 $image_name= $_FILES['image']['name'];

                 //if image is selected
                if($image_name != ""){

                    //get the extention of image (.jpg .png .gif etc.)
                    $ext = end(explode('.',$image_name));
                    //rename the image
                    $image_name= "Food_Name_".rand(0000,9999).".".$ext;

                    //the current location of the image
                    $src = $_FILES['image']['tmp_name'];

                    //where the image will be uploades
                    $dst ="../images/food/".$image_name;

                    //upload the image
                    $upload = move_uploaded_file($src,$dst);

                     //check image is uploaded or not
                     if($upload == false)
                     {
                         //set message
                         $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                         //redirect
                         header("location:".SITEURL.'admin/add-food.php');
                         //stop the process
                         die();
 
 
                     }
                }
             }
             else{
                 //set default values
                 $image_name= "";
             }



            //insert into database
            //create sql to execute dataes
            //for numeric value we dont need quations
            $sql2 = "INSERT INTO tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id=$category,
                    featured='$featured',
                    active='$active'
                    ";

            //execute the query
            $res2 = mysqli_query($conn,$sql2);

             //check whether is executed or not
             //redirect with msg to manage food
             if($res2==true){
                //executed
                 //create a session Variable to Display msg
            $_SESSION['add']="<div class='success'>Food added successfully.</div>";
            //redirect 
            header("location:".SITEURL.'admin/manage-food.php');
            }
            else{
                //failed to add food
            //create a session Variable to Display msg
            $_SESSION['add']="<div class='error'>Failed to Add Food.</div>";
            //redirect page to add category
            header("location:".SITEURL.'admin/add-food.php');
            }

            
        }
        ?>

    </div>
</div>

<?php include('partials/footer.php');?>