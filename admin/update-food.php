<?php include('partials/menu.php'); ?> 

<?php
        if(isset($_GET['id'])){
            //get the id nd other details
            $id=$_GET['id'];

            //create sql to get details
            $sql2 ="SELECT * FROM tbl_food WHERE id=$id";

            //execute query
            $res2= mysqli_query($conn,$sql2);

            //get the details
            $row2=mysqli_fetch_assoc($res2);

            //get the indivisual values
            $title=$row2['title'];
            $description= $row2['description'];
            $price= $row2['price'];
            $current_image=$row2['image_name'];
            $current_category=$row2['category_id'];
            $featured=$row2['featured'];
            $active =$row2['active'];
        }
        else{
            
             //redirect to manage food
             header("location:".SITEURL.'admin/manage-food.php');
        }

?>

<div class="main-content">

    <div class="wrapper">
        <h1>Update Food</h1>

        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td> <input type="text" name="title" value="<?php  echo $title; ?>"></td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td> <textarea name="description" id="" cols="30" rows="5"><?php echo $description ;?></textarea></td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td> <input type="number" name="price" value="<?php  echo $price; ?>"></td>
                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                        <?php
                                if($current_image != "")
                                {
                                    //display image
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px" >
                                    <?php
                                }
                                else
                                {
                                    //display msg
                                    echo "<div class='error'>Image Not Available.</div>";
                                }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Select New Image:</td>
                        <td> <input type="file" name="image"></td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category" >
                                <?php

                                //sql for getting all active categories
                                $sql = "SELECT * FROM tbl_category WHERE active= 'Yes'";

                                //executing query & saving data in database
                                $res = mysqli_query($conn,$sql);

                                 //count rows
                                $count=mysqli_num_rows($res);

                                if($count>0){
                                    //category available
                                    //get the data nd display
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //get indivisual data
                                            $category_id=$row['id'];
                                            $category_title=$row['title'];
                                            
                                            
                                       // echo "<option value='$category_id'>$category_title</option>";
                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                            
                                        }
                                }
                                else{
                                    //not available
                                    echo "<option value='0'>No Category Available.</option>";
                                }

                                ?>
                                
                            </select>
                        </td>
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
                        <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image ;?>">  
                        <input type="hidden" name="id" value="<?php echo $id ;?>">  
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                        </td>
                    </tr>




            </table>
        </form>
        
    <?php
    if(isset($_POST['submit'])){
        
        // 1. get all the details from form
        $id=$_POST['id'];
        $title=$_POST['title'];
        $description= $_POST['description'];
        $price=$_POST['price'];
        $current_image=$_POST['current_image'];
        $category=$_POST['category'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];
 

        //2. upload the image if selected
        if(isset($_FILES['image']['name'])){
            
            $image_name = $_FILES['image']['name']; 

            if($image_name != "")
            {
                //image is available
                //get the extention of image (.jpg .png .gif etc.)
                $ext = end(explode('.',$image_name));

                //rename the image
                $image_name= "Food_Name_".rand(000,999).'.'.$ext;


                $src_path = $_FILES['image']['tmp_name'];

                $dest_path ="../images/food/".$image_name;

                 //upload the file
                 $upload = move_uploaded_file($src_path,$dest_path);

                 //check image is uploaded or not
                 if($upload == false)
                 {
                     //set message
                     $_SESSION['upload']="<div class='error'>Failed to Upload Image.</div>";
                     //redirect
                     header("location:".SITEURL.'admin/manage-food.php');
                     //stop the process
                     die();

                 }

                 //3.remove old image if new one is uploaded
                 //removing current image
                 if($current_image!=""){
                        //available
                        $remove_path = "../images/food/".$current_image;
                        //remove the image
                        $remove= unlink($remove_path);

                    //if fail to remove image
                    if($remove== false)
                    {
                        //set the session msg
                        $_SESSION['failed-remove']="<div class='error'>failed to remove Current image. </div>";
                        //redirect to mng category
                        header("location:".SITEURL.'admin/manage-food.php');
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
            //4.update the food in database
            $sql3 = "UPDATE tbl_food SET
            title='$title',
            description='$description',
            price=$price,
            image_name='$image_name',
            category_id='$category',
            featured='$featured',
            active='$active'
            WHERE id=$id
            ";

             //execute the query
             $res3 = mysqli_query($conn,$sql3);

             if($res3==true)
             {
                
                  //create a session Variable to Display msg
                  $_SESSION['update']="<div class='success'>Food updated successfully</div>";
                  //redirect page to manage food
                  header("location:".SITEURL.'admin/manage-food.php');
         
             }
             else{
                 //create a session Variable to Display msg
                 $_SESSION['update']="<div class='error'>failed to update food . Try Again</div>";
                 //redirect page to manage food
                 header("location:".SITEURL.'admin/manage-food.php');
             }

           
    }

    ?>

    </div>
</div>
<?php include('partials/footer.php');?>