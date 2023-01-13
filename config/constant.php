<?php
//start session
//session is a avariable that can be opened across different pages as long as browser is open
session_start();
  //create constant to store non repeating values
  define('SITEURL','http://localhost/food_order/');
  define('LOCALHOST','localhost'); //capital ->constant   small->variables
  define('DB_USERNAME','root');
  define('DB_PASSWORD','');
  define('DB_NAME','food_order');

  $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
  $db_select= mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //selecting DB
?>