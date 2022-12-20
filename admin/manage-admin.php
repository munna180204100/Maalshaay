<?php include('partials/menu.php'); ?> 

    <!-- Main Content Section Starts -->
    <div class="main-content">
    <div class="wrapper">
          <h1>Manage Admin</h1>
    <br /> 

      <?php
            if(isset($_SESSION['add']))
            {
                //echo "boom";
                echo $_SESSION['add'];// DISPLAY THE MSG
                unset($_SESSION['add']);// remove the msg
            }

            if(isset($_SESSION['delete']))
            {
                //echo "boom";
                echo $_SESSION['delete'];// DISPLAY THE MSG
                unset($_SESSION['delete']);// remove the msg
            }

            if(isset($_SESSION['update']))
            {
                //echo "boom";
                echo $_SESSION['update'];// DISPLAY THE MSG
                unset($_SESSION['update']);// remove the msg
            }


            if(isset($_SESSION['user-not-found']))
            {
                //echo "boom";
                echo $_SESSION['user-not-found'];// DISPLAY THE MSG
                unset($_SESSION['user-not-found']);// remove the msg
            }

            if(isset($_SESSION['pwd-not-matched']))
            {
                //echo "boom";
                echo $_SESSION['pwd-not-matched'];// DISPLAY THE MSG
                unset($_SESSION['pwd-not-matched']);// remove the msg
            }

            if(isset($_SESSION['pwd-changed']))
            {
                //echo "boom";
                echo $_SESSION['pwd-changed'];// DISPLAY THE MSG
                unset($_SESSION['pwd-changed']);// remove the msg
            }

            
      ?>

        <br><br><br>
    

          <!-- button add admin -->
          <a href="add-admin.php" class="btn-primary">Add Admin</a>

          <br /><br> <br>
          
          <table class="tbl-full">
              <tr>
                  <th>S.N.</th>
                  <th>Full Name</th>
                  <th>Username</th>
                  <th>Actions</th>
                  </tr>

                  <?php
                    //query to get all admin
                    $sql = "SELECT * FROM tbl_admin";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //check whether the sql is executed or not
                    if($res==true)
                    {
                        //count rows in tbl
                        $count=mysqli_num_rows($res);

                        $sn=1;// creating variable for serial number

                        //check the number of rows
                        if($count>0)
                        {
                            //there is data
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //using whileloop to get all data from table

                                //get indivisual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //display the values in our table
                                ?>

                    <tr>
                      <td><?php echo $sn++; ?>.</td>
                      <td><?php echo $full_name; ?></td>
                      <td><?php echo $username; ?></td>
                      <td>
                          <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">change password</a>
                          <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">update admin</a>
                          <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">delete admin</a>
                      </td>

                    </tr>
                                
                    <?php
                            }
                        }

                        
                    }

                    else
                        {
                            //no data in database
                        }
                  
                  ?>

                 

                 </table>

        </div>
    </div>
    <!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>