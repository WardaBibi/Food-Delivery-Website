<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
         <h1>Add Category</h1>
         <br/><br/>
         <?php
         if(isset($_SESSION['add'])) //checking wheter system is saved or not display msg if saved
         {
             echo $_SESSION['add'];
             unset( $_SESSION['add']);
         }
         if(isset($_SESSION['upload'])) //checking wheter system is saved or not display msg if saved
         {
             echo $_SESSION['upload'];
             unset( $_SESSION['upload']);
         }
         ?>
         <br/><br/>
         <form action="" method="POST" enctype="multipart/form-data">
         <table class="tbl-30">
         <tr>
            <td>Title:</td>
            <td><input type="text" name="title" placeholder="Category title" ></td> 
         </tr>
         <tr>
             <td>Select image:</td>
             <td><input type="file" name="image"></td>

         </tr>
         <tr>
             <td>
                 Featured:
             </td>
             <td>
                 <input type="radio" name="featured" value="Yes">Yes
                 <input type="radio" name="featured" value="No">No
                </td>
         </tr>
         <tr>
             <td>
                 Active:
             </td>
             <td>
                 <input type="radio" name="active" value="Yes">Yes
                 <input type="radio" name="active" value="No">No
                </td>
         </tr>
         <tr>
             <td colspan="2">
             <input type="submit" name="submit" value="Add Category" class="btn-secondary"> 
             </td>
         </tr>
         </table>
         </form>
         <?php
      if(isset($_POST['submit']))
      {
        $title = $_POST['title'];
        if(isset($_POST['featured']))
        {
            $featured=$_POST['featured'];

        }else
        {
            $featured="No";
            //set default
        }
        if(isset($_POST['active']))
        {
            $active=$_POST['active'];

        }else
        {
            $active="No";
            //set default
        }
        //print_r($_FILES['image']);
        //die();
        if(isset($_FILES['image']['name']))
         {
                $image_name=$_FILES['image']['name'];
                if($image_name!="")
                {

                
                 //auto rename image name
                $ext =end(explode('.',$image_name));
                $image_name="Food_Category_".rand(000,999).'.'.$ext;
                


                $source_path=$_FILES['image']['tmp_name'];
                $destinition_path="../images/category/".$image_name;
                 $upload = move_uploaded_file($source_path,$destinition_path);
                if($upload==false)
                {
                    $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                    header("location: ".SITEURL.'admin/add-category.php'); 
                    die();
                }
            }
        }
        else{
            $image_name="";
        }

        //create sql query 
        $sql="INSERT INTO category_table SET 
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";
        //execute
        $res =mysqli_query($conn,$sql); 
        if($res==true)
        {
          
            $_SESSION['add']="<div class='success'>Category Added succesfully</div>";
            header("location: ".SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['add']="<div class='error'>Failed to add Category </div>";
            header("location: ".SITEURL.'admin/add-category.php');
        }

      }
      ?> 
    

</div>
</div>

  
<?php include('partials/footer.php');?>