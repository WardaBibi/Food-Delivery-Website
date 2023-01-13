<?php 

//include contants .pho
include('../config/constant.php');
//get id
//create sql query
//redirect to manage admin with msg
$id = $_GET['id'];
$sql ="DELETE FROM admin_table WHERE id =$id ";
$res = mysqli_query($conn,$sql);
//check
if($res== TRUE )
{
    //admin deleted
    //echo "Admin Deleted";
    //create session var
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
    //redirect to manage admin page
    header("location: ".SITEURL.'admin/manage-admin.php');
}
else{
    //not deleted
    //echo "Failed to Admin";
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin .Try again later.</div>";
    //redirect to manage admin page
    header("location: ".SITEURL.'admin/manage-admin.php');
}

?> 