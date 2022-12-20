<?php include('partials/menu.php'); ?> 

<div class="main-content">

    <div class="wrapper">
        <h1>Update Order</h1>

        <br><br>

        <?php

            if(isset($_GET['id']))
            {
                //get the id nd other details
                $id=$_GET['id'];

                //create sql to get details
                $sql ="SELECT * FROM tbl_order WHERE id=$id";

                //execute query
                 $res= mysqli_query($conn,$sql);

                 $count=mysqli_num_rows($res);

                 if($count == 1)
                 {
                     //available
                     $row=mysqli_fetch_assoc($res);

                     $food=$row['food'];
                     $price=$row['price'];
                     $qty=$row['qty'];
                     $status=$row['status'];

                 }
                 else
                 {
                     //not available
                     header("location:".SITEURL.'admin/manage-order.php');

                 }

            
            }

            else
            {
                //redirect to manage food
             header("location:".SITEURL.'admin/manage-order.php');
            }

        ?>

        <form action="" method="post" >
            <table class="tbl-30">

                <tr>
                    <td>Food Name:</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td> <b><?php echo $price; ?> tk </b></td>
                </tr>

                <tr>
                        <td>Qty:</td>
                        <td> <input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>

                <tr>
                        <td>Status:</td>
                        <td> <select name="status">
                            <option <?php if($status=="Ordered") { echo "selected" ;}?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery") { echo "selected" ;}?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered") { echo "selected" ;}?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled") { echo "selected" ;}?>  value="Cancelled">Cancelled</option>
                        </select></td>
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id ;?>"> 
                    <input type="hidden" name="price" value="<?php echo $price ;?>"> 
                    <input type="submit" name="submit" value="Update Order" class="btn-secondary">

                    </td>
                </tr>




            </table>
        </form>

        <?php
         if(isset($_POST['submit']))
         {
            // echo "clicked";
             // 1. get all the details from form
                $id=$_POST['id'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total= $price * $qty;
                $status=$_POST['status'];

                $sql2 = "UPDATE tbl_order set
                        qty=$qty,
                        total=$total,
                        status = '$status'
                        WHERE id= $id
                        ";
                //execute the query
                $res2 = mysqli_query($conn,$sql2);

                if($res2==true)
                {
                    //updated
                     //create a session Variable to Display msg
                  $_SESSION['update']="<div class='success'>Order updated successfully</div>";
                  //redirect page to manage food
                  header("location:".SITEURL.'admin/manage-order.php');
                }
                else
                {

                     //create a session Variable to Display msg
                 $_SESSION['update']="<div class='error'>failed to update Order . Try Again</div>";
                 //redirect page to manage food
                 header("location:".SITEURL.'admin/manage-order.php');
                }

         }

        ?>

</div>
</div>
<?php include('partials/footer.php');?>