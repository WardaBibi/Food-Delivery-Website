<?php
include('../config/constant.php');
   //echo "Delete Page";
   //check whether the id and image_name value is set or not
   if(isset($_GET['id']) AND isset($_GET['image_name']))
   {
       //get the value and delete
       $id = $_GET['id'];
       $image_name = $_GET['image_name'];
       if($image_name != "")
       {
           $path = "../images/category/".$image_name;
           $remove = unlink($path);
           if($remove == false)
           {
               $_SESSION['remove']= "<div class = 'error'>Failed to remove category image.</div>";
               header('location:'.SITEURL.'admin/manage-category.php');
               die();
           }
       }

       $sql = "DELETE FROM category_table WHERE id=$id";
       $res = mysqli_query($conn, $sql);

       if($res==true)
       {
           $_SESSION['delete'] = "<div class = 'success'>Category Deleted Successfully.</div>";
           header('location:' .SITEURL.'admin/manage-category.php');
       }
       else
       {
           $_SESSION['delete'] = "<div class = 'error'>Failed to delete Category.</div>";
           header('location:' .SITEURL.'admin/manage-category.php');
       }

   }
   else
   {
       //redirect to manage catergory page
       header('location:'.SITEURL.'admin/manage-category.php');
   }

?>
    