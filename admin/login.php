<?php
include('../config/constant.php');
?>


<html>
    <head>
        <title>
            login-Food order sytem
        </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br/><br/>

            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];//diplaying session
                unset($_SESSION['login']);//removing session after display
            }
            if(isset( $_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];//diplaying session
                unset($_SESSION['no-login-message']);
            }
            ?>
 <br/><br/> 
               <form action=""  method="POST" class="text-center">
                   UserName:<br/><br/>
                   <input type="text" name ="username" placeholder="Enter Username" ><br/><br/><br/>
                  Password:<br/><br/>
                   <input type="password" name ="password" placeholder="Enter password" ><br/><br/>
                <input type="submit" name="submit" value ="login" class="btn-primary"><br/><br/><br/>
               </form>

            <p class="text-center">Created by - <a href="www.wardabibi.com">warda bibi</a></p>
        </div>
    </body>
</html>

<?php
if(isset($_POST['submit']))
{
    //process login
    $username = $_POST['username'];
    $password =md5($_POST['password']);
    $sql= "SELECT * FROM admin_table where username='$username' AND password='$password'";
    $res = mysqli_query($conn,$sql) ; 
   
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            //user available
            $_SESSION['login'] = "<div class='success text-center'>Login Successful.</div>";
            $_SESSION['user'] =  $username; //to ckeck user is logged in ?

              //session type var of name add having value admin not added

            header("location: ".SITEURL.'admin/');
        }else{
            //no user
            $_SESSION['login'] = "<div class='error text-center'>Login failed.</div>";   //session type var of name add having value admin not added
            header("location: ".SITEURL.'admin/login.php');
        }
   
  
}
//check submit btn
?>
