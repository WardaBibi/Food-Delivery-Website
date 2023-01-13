<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
         <h1>Add Admin</h1>
         <br/><br/>
         <?php
         if(isset($_SESSION['add'])) //checking wheter system is saved or not display msg if saved
         {
             echo $_SESSION['add'];
             unset( $_SESSION['add']);
         }
         ?>

<form action="" method="POST">
   <!--post or git method for passing value from form
       post hides data while passing into db 
       git display data while passing-->
  <table class="tbl-30">
      <tr>
          <td>Full Name:</td>
          <td> <input type="text" name="full_name" placeholder="Enter your name"></td>
      </tr>
      <tr>
          <td>User Name: </td>
          <td>
              <input type="text" name="username" placeholder="Your Username">
          </td>
      </tr>
      <tr>
          <td>Password: </td>
          <td>
              <input type="password" name="password" placeholder="Your Password">
          </td>
      </tr>
      <tr>
          <td colspan="2">
              <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
          </td>
      </tr>
  </table>  




</form>





    </div>
</div>





<?php include('partials/footer.php');?>
<?php 
//process the value from form and save it in database
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
   {
       //button value passes through post method
       //  echo "Button clicked ";
       //get data from form
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']);  //password encryption with md5
       //sql query to save data into db
       $sql= "INSERT INTO admin_table SET
       full_name ='$full_name ' ,
       username  = '$username ' ,
       password=   '$password'
       ";
       //db connection
     

       $res =mysqli_query($conn,$sql) ; 
       //execute query to save data in db 

       if($res==TRUE)
       {
           
               //echo "inserted";
               //create a session variable
             $_SESSION['add'] = "Admin added successfully";   //session type var of name add having value admin added succesfuly
             //redirect page to manage admin
             header("location: ".SITEURL.'admin/manage-admin.php'); //. for concatenation

            }else{
             // echo "not inserted";
                 //create a session variable
                 $_SESSION['add'] = "Failed to Add Admin";   //session type var of name add having value admin not added
                 //direct page to add admin
                 header("location: ".SITEURL.'admin/add-admin.php');
    
       }



   }
   

?>