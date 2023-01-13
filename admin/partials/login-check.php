<?php
//check user id logged ?authorization
if(!isset($_SESSION['user'])) //if login is not set i.e user is not logged in 
{
  $_SESSION['no-login-message']="<div class='error text-center'>Please login to access admin panel.</div>";
  header("location: ".SITEURL.'admin/login.php');
}


?>