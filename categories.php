<?php include('partials-front/menu.php'); ?> 


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //query to get all category
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

             //execute the query
             $res = mysqli_query($conn, $sql);

             //count rows
             $count=mysqli_num_rows($res);

             //check the number of rows
             if($count>0)
             {
                 //category available
                  //get the data nd display
                  while($row=mysqli_fetch_assoc($res))
                  {
                      //get indivisual data
                      $id=$row['id'];
                      $title=$row['title'];
                      $image_name=$row['image_name'];

                      ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id ; ?>">
                            <div class="box-3 float-container">
                                <?php

                                    //check if category has image or not
                                    if($image_name=="")
                                    {
                                        //display msg
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                    else
                                    {
                                        //image available
                                        ?>

                                        <img src="<?php echo SITEURL ; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>
                                
                                    <br><br><br><br><br><br>
                                <h3 class="float-text text-black"><?php echo $title ; ?></h3>
                            </div>
                        </a>
                      <?php

                  }
             }
             else
             {
                 //cat not available
                echo "<div class='error'>Category Not Found.</div>";
             }

            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>