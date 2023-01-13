<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>
        <?php
        if(isset($_GET['id'])) //checking wheter system is saved or not display msg if saved
         {
             $id=$_GET['id'];
             $sql="SELECT * FROM order_table  WHERE id =$id";
             //execute 
             $res=mysqli_query($conn,$sql);
             $count=mysqli_num_rows($res);
                if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);
                       // $id = $row['id'];
                            $food=$row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                           // $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];

                    }
                else
                    {

                        $_SESSION['no-category-found'] = "<div class='error'>Category not found .</div>";
                        header("location: ".SITEURL.'admin/manage-category.php');
                    }
             //check if executed?
            
           
         }
         else
         {
            header("location: ".SITEURL.'admin/manage-category.php');

         }
         
         ?>
         <br><br>
         
        <form action="" method="POST" enctype="multipart/form-data">

           <table class="tbl-30">
           <tr>
                    <td>Food Name:</td>
                    
                        <td><b><?php echo $food;?></b></td>
                    
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b> $ <?php echo $price;?></b></td>
                  
                </tr>
                <tr>
                    <td>Qty:</td>
                    <td>
                        <input type="Nnumber" name="qty" value="<?php echo $qty;?>">
                    </td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status" >
                            <option <?php if($status=="ordered"){echo "selected";} ?> value="ordered">Ordered</option>
                            <option <?php if($status=="on delivery"){echo "selected";} ?> value="on delivery">On Delivery</option>
                            <option <?php if($status=="delivered"){echo "selected";} ?> value="delivered">delivered</option>
                            <option <?php if($status=="cancelled"){echo "selected";} ?> value="cancelled">cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td><textarea name="customer_address"  cols="30" rows="5"><?php echo $customer_address; ?></textarea></td>
                </tr>

                <tr>
             <td colspan="2">
                 <input type="hidden" name="id" value ="<?php echo $id;?>">
                 <input type="hidden" name="price" value ="<?php echo $price;?>">
                 <input type="submit" name="submit" value="Update Order" class="btn-secondary"> 
             </td>
         </tr>


           </table>
        </form>



        <?php
          if (isset($_POST['submit'])) {

            $food=$_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $id=$_POST['id'];
            $order_date = date("Y-m-d h:i:sa:");
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];


        $sql2 = "UPDATE   order_table SET
        food = '$food',
        price = $price,
        qty = $qty,
        total = $total,
        order_date = '$order_date',
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contact',
        customer_email = '$customer_email',
        customer_address = '$customer_address'
        WHERE id=$id
        ";


$res2 = mysqli_query($conn,$sql2) ; 
     if($res2==TRUE)
     {
        $_SESSION['update'] = "<div class='success text-center'>Order Updated successfully.</div>";
        header("location: ".SITEURL.'admin/manage-order.php'); 
     }
     else
     {
        $_SESSION['update'] = "<div class='error text-center'>Failed to update food .</div>";
        header("location: ".SITEURL.'admin/manage-order.php'); 
     }
    }


        
          



        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
