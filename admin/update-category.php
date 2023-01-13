<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
         <h1>Update Category</h1>
         <br/><br/>
         <?php
         if(isset($_GET['id'])) //checking wheter system is saved or not display msg if saved
         {
             $id=$_GET['id'];
             $sql="SELECT * FROM category_table  WHERE id =$id";
             //execute 
             $res=mysqli_query($conn,$sql);
             $count=mysqli_num_rows($res);
                if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $title=$row['title'];
                        $current_image=$row['image_name'];
                        $active=$row['active'];
                        $featured=$row['featured'];

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



   <br/><br/>
<form action="" method="POST" enctype="multipart/form-data">
<table class="tbl-30">
         <tr>
            <td>Title:</td>
            <td><input type="text" name="title" value ="<?php echo $title;?>"></td> 
         </tr>
         <tr>
             <td>Current image:</td>
             <td>  <?php 
               if($current_image!="")
                    {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width="120px">
                       
                        <?php
                    }
                else
                    {
                        echo "<div class='error'>Image not added</div>";
                    }
              ?>          
                  </td>

         </tr>
         <tr>
             <td>New image:</td>
             <td><input type="file" name="image"></td>  

         </tr>
         <tr>
             <td>
                 Featured:
             </td>
             <td>
                 <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                 <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                </td>
         </tr>
         <tr>
             <td>
                 Active:
             </td>
             <td>
                 <input  <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                 <input  <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                </td>
         </tr>
         <tr>
             <td colspan="2">
                 <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                 <input type="hidden" name="id" value="<?php echo $id;?>">
                 
                 <input type="submit" name="submit" value="Update Category" class="btn-secondary"> 
             </td>
         </tr>
         </table>
</form>
</div>
<?php
//check submit button
if(isset($_POST['submit']))
{
   //echo "button clicked";
   //get val from form to update
    $id=$_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    if(isset($_FILES['image']['name']))
    {
        $image_name=$_FILES['image']['name'];

        if($image_name!="")
        {
            $ext =end(explode('.',$image_name));
            $image_name="Food_Category_".rand(000,999).'.'.$ext;
             
            //  $ext = end(explode('.', $image_name));
           // $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;


            $source_path=$_FILES['image']['tmp_name'];
            $destinition_path="../images/category/".$image_name;
             $upload = move_uploaded_file($source_path,$destinition_path);
            if($upload==false)
            {
                $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                header("location: ".SITEURL.'admin/manage-category.php'); 
                die();
            }
            if($current_image!="")
            {
                $remove_path="../images/category/".$current_image;
                $remove=unlink( $remove_path);
                if($remove==false)
                {
                    $_SESSION['failed-remove']="<div class='error'>Failed to remove image</div>";
                    header("location: ".SITEURL.'admin/manage-category.php'); 
                    die();
                }
            }
           
        }  else
            {
                $image_name=$current_image;
            }
    
    }else{
        $image_name=$current_image;
    }

    $sql2= "UPDATE category_table SET
    title ='$title',
    featured ='$featured ' ,
    image_name='$image_name',
    active  = '$active '
    WHERE id='$id'
    ";
     $res2 = mysqli_query($conn,$sql2) ; 
     if($res2==TRUE)
     {
        $_SESSION['update'] = "<div class='success'>Category Updated successfully.</div>";
        header("location: ".SITEURL.'admin/manage-category.php'); 
     }
     else
     {
        $_SESSION['update'] = "<div class='error'>Failed to update Category .</div>";
        header("location: ".SITEURL.'admin/manage-category.php'); 
     }

}
    ?>



</div>
</div>

<?php include('partials/footer.php');?>