<?php include('partials/menu.php'); ?> 

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Food</h1>

    <br /> <br>

    <?php
         if(isset($_SESSION['add']))
         {
            
             echo $_SESSION['add'];// DISPLAY THE MSG
             unset($_SESSION['add']);// remove the msg
         }

         if(isset($_SESSION['delete']))
         {
            
             echo $_SESSION['delete'];// DISPLAY THE MSG
             unset($_SESSION['delete']);// remove the msg
         }

         if(isset($_SESSION['remove']))
         {
            
             echo $_SESSION['remove'];// DISPLAY THE MSG
             unset($_SESSION['remove']);// remove the msg
         }

         if(isset($_SESSION['upload']))
         {
            
             echo $_SESSION['upload'];// DISPLAY THE MSG
             unset($_SESSION['upload']);// remove the msg
         }

         if(isset($_SESSION['unauthorized']))
         {
            
             echo $_SESSION['unauthorized'];// DISPLAY THE MSG
             unset($_SESSION['unauthorized']);// remove the msg
         }

         if(isset($_SESSION['failed-remove']))
         {
            
             echo $_SESSION['failed-remove'];// DISPLAY THE MSG
             unset($_SESSION['failed-remove']);// remove the msg
         }

         if(isset($_SESSION['update']))
         {
            
             echo $_SESSION['update'];// DISPLAY THE MSG
             unset($_SESSION['update']);// remove the msg
         }
    ?>

    <br><br>
    
          <!-- button add admin -->
          <a href="<?php echo SITEURL ; ?>admin/add-food.php" class="btn-primary">Add Food</a>

          <br /><br> <br>
          
          <table class="tbl-full">
              <tr>
                 <th>S.N.</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Featured</th>
                  <th>Active</th>
                  <th>Actions</th>
                  </tr>

                  <?php
                    //query to get all category
                    $sql = "SELECT * FROM tbl_food";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows
                    $count=mysqli_num_rows($res);

                    //serial number veriable
                    $sn=1;

                     //check the number of rows
                     if($count>0)
                        {
                            //get the foods
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get indivisual data
                             $id=$row['id'];
                             $title=$row['title'];
                             $price=$row['price'];
                             $image_name=$row['image_name'];
                             $featured=$row['featured'];
                             $active=$row['active'];

                             ?>

                                <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php 

                                    if($image_name != ""){
                                        //display the image
                                        ?>
                                        <img src="<?php echo SITEURL ;?>images/food/<?php echo $image_name ;?>" width="100px">
                                        <?php
                                    }
                                    else{
                                        //Display the msg
                                        echo "<div class='error'> Image not Added</div>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                </td>
                                </tr>
                             <?php

                            }

                        }
                        else{

                           echo "<tr><td colspan='7'><div class='error'> food not Added.</div></td></tr>";
                        }

                        ?>

          </table>

    </div>

</div>

<?php include('partials/footer.php') ?>