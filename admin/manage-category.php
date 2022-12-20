<?php include('partials/menu.php'); ?> 

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Category</h1>

    <br /> <br>

    <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];// DISPLAY THE MSG
                unset($_SESSION['add']);// remove the msg
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];// DISPLAY THE MSG
                unset($_SESSION['remove']);// remove the msg
            }

            if(isset($_SESSION['delete']))
            {
                //echo "boom";
                echo $_SESSION['delete'];// DISPLAY THE MSG
                unset($_SESSION['delete']);// remove the msg
            }

            if(isset($_SESSION['no-category-found']))
            {
                //echo "boom";
                echo $_SESSION['no-category-found'];// DISPLAY THE MSG
                unset($_SESSION['no-category-found']);// remove the msg
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];// DISPLAY THE MSG
                unset($_SESSION['update']);// remove the msg
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];// DISPLAY THE MSG
                unset($_SESSION['upload']);// remove the msg
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];// DISPLAY THE MSG
                unset($_SESSION['failed-remove']);// remove the msg
            }

            
      ?>
      
      <br><br>
    
          <!-- button add admin -->
          <a href="<?php echo SITEURL ; ?>admin/add-category.php" class="btn-primary">Add Category</a>

          <br /><br> <br>
          
          <table class="tbl-full">
              <tr>
                  <th>S.N.</th>
                  <th>Title</th>
                  <th>Image</th>
                  <th>Featured</th>
                  <th>Active</th>
                  <th>Actions</th>
                  </tr>


                  <?php
                    //query to get all category
                    $sql = "SELECT * FROM tbl_category";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows
                    $count=mysqli_num_rows($res);

                    //serial number veriable
                    $sn=1;

                     //check the number of rows
                     if($count>0){
                         //we have data
                         //get the data nd display
                         while($row=mysqli_fetch_assoc($res))
                         {
                             //using whileloop to get all data from table

                             //get indivisual data
                             $id=$row['id'];
                             $title=$row['title'];
                             $image_name=$row['image_name'];
                             $featured=$row['featured'];
                             $active=$row['active'];

                            ?>

                            <tr>
                            <td><?php echo $sn++; ?>.</td>
                            <td><?php echo $title; ?></td>
                            <td>
                                <?php 
                                    //check whether image name is available or not
                                    if($image_name != ""){
                                        //display the image
                                        ?>
                                        <img src="<?php echo SITEURL ;?>images/category/<?php echo $image_name ;?>" width="100px">
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
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                
                            </td>
                        </tr>

                            <?php
                         }

                     }
                     else{
                         //no data in table
                         //we need to display the msg inside the table
                         ?>
                         <tr>
                             <td colspan="6">
                                    <div class="error">No Category Added.</div>
                             </td>
                         </tr>

                         <?php
                     }

                  ?>

                  


                  
          </table>

    </div>

</div>

<?php include('partials/footer.php') ?>