
<?php include('partials/menu.php');?>
<div class="main-content">

    <div class="wrapper">
    <h1>Update Admin</h1>
         <br/><br/>
         <?php
         //get id of selected admin
         $id=$_GET['id'];
         //create sql query to get details
         $sql="SELECT * FROM admin_table  WHERE id =$id";
         //execute 
         $res=mysqli_query($conn,$sql);
         //check if executed?
         if($res==true)
         {
             //check data?
             $count=mysqli_num_rows($res);
             if($count==1)
             {
              //echo "Admin available"
              $row=mysqli_fetch_assoc($res);
              $full_name=$row['full_name'];
              $username=$row['username'];

             }
             else
             {
                 //redirect
                 header("location: ".SITEURL.'admin/manage-admin.php');
             }
         }
         ?>
         <form action="" method="POST">
   <!--post or git method for passing value from form
       post hides data while passing into db 
       git display data while passing-->
  <table class="tbl-30">
      <tr>
          <td>Full Name:</td>
          <td> <input type="text" name="full_name" value="<?php echo $full_name;?>"></td>
      </tr>
      <tr>
          <td>User Name: </td>
          <td>
              <input type="text" name="username" value="<?php echo $username;?>">
          </td>
      </tr>
     
      <tr>
          <td colspan="2"> 
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          
          <input type="submit" name="submit" value="update Admin" class="btn-secondary">
          </td>
      </tr>
  </table>  




</form>





     </div>
</div>
<?php
//check submit button
if(isset($_POST['submit']))
{
   //echo "button clicked";
   //get val from form to update
    $id = $_POST['id'];
   $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    $sql= "UPDATE admin_table SET
    full_name ='$full_name ' ,
    username  = '$username ' 
    WHERE id='$id'
    ";
     $res = mysqli_query($conn,$sql) ; 
     if($res==TRUE)
     {
         
             //echo "updated";
             //create a session variable
           $_SESSION['update'] = "<div class='success'>Admin Updated successfully.</div>";   //session type var of name add having value admin added succesfuly
           //redirect page to manage admin
           header("location: ".SITEURL.'admin/manage-admin.php'); //. for concatenation

          }else{
           // echo "not updated";
               //create a session variable
               $_SESSION['update'] = "<div class='error'>Failed to update Admin.</div>";   //session type var of name add having value admin not added
               //direct page to add admin
               header("location: ".SITEURL.'admin/update-admin.php');
  
     }

}

?>

<?php include('partials/footer.php');?>
