<?php
include('../config/constant.php');
//destroy session and redirect
session_destroy();

header("location: ".SITEURL.'admin/login.php');
?>