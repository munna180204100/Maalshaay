<?php include('partials-front/menu.php'); ?> 

<?php
    //check whether id is passed or not
    if(isset($_GET['food_id']))
    {
        //get details
         //get the id
         $food_id=$_GET['food_id'];

          //create sql to get details
        $sql ="SELECT * FROM tbl_food WHERE id=$food_id";

        //execute query
        $res= mysqli_query($conn,$sql);

         //count rows
         $count=mysqli_num_rows($res);

         //check the number of rows
         if($count==1)
         {
             //we have data
              //get the data nd display
              $row=mysqli_fetch_assoc($res);

                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
             
         }
         else
         {
             //food not available
             //redirect to home
             header('location:'.SITEURL);
         }
    }
    else
    {
        //redirect to home
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php

                         //check if food has image or not
                         if($image_name=="")
                         {
                             //img not available
                             echo "<div class='error'>Image not available</div>";
                         }
                         else
                         {
                              //image available
                             ?>
                                <img src="<?php echo SITEURL ; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                               
                             <?php
                         }

                        ?>
                       
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title ; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title ; ?>">

                        <p class="food-price"><?php echo $price ; ?>tk</p>
                        <input type="hidden" name="price" value="<?php echo $price ; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Your name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="phone number" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="enter the mail address" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="your current location" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            //check whether the submit button is clicked or not
                if(isset($_POST['submit'])) 
                {
                    $food= $_POST['food'];
                    $price= $_POST['price'];
                    $qty= $_POST['qty'];

                    $total= $price * $qty; //price x quantity =total

                    $order_date= date("Y-m-d h:i:sa"); //order date will get us the current time that the submit button was clicked
                    
                    $status = "Ordered"; //Ordered ,On Delivery, Delivered , Cancelled 

                    $customer_name=$_POST['full-name'];

                    $customer_contact=$_POST['contact'];

                    $customer_email=$_POST['email'];

                    $customer_address=$_POST['address'];

                    //sql query to save the data into database
                    $sql2 ="INSERT INTO tbl_order set 
                            food='$food',
                            price=$price,
                            qty=$qty,
                            total=$total,
                            order_date='$order_date',
                            status='$status',
                            customer_name = '$customer_name',
                            customer_contact = '$customer_contact',
                            customer_email = '$customer_email',
                            customer_address = '$customer_address'
                            ";

                   // echo $sql2 ; die();

                     //executing query & saving data in database
                    $res2 = mysqli_query($conn,$sql2);   
                    
                    if($res2==true) 
                    {
                        //executed
                        //create a session Variable to Display msg
                        $_SESSION['order']="<div class='success text-center'>Food Ordered successfully</div>";
                        //redirect page to merge admin
                        header("location:".SITEURL);
                    }
                    else
                    {
                        //failed to execute
                         //create a session Variable to Display msg
                         $_SESSION['order']="<div class='error text-center'>Failed to Order Food</div>";
                         //redirect page to merge admin
                         header("location:".SITEURL);
                    }


                }
               

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>