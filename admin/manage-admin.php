       <?php include('partials/menu.php');?>

        <!--main content section starts-->
        <div class="main-content ">
        <div class="wrapper">
        <h1>Manage Admin</h1>
        <br/><br/>
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//diplaying session
                unset($_SESSION['add']);//removing session after display
            }
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];//diplaying session
                unset($_SESSION['delete']);//removing session after display
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];//diplaying session
                unset($_SESSION['delete']);//removing session after display
            }
            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];//diplaying session
                unset($_SESSION['user-not-found']);//removing session after display
            }
            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];//diplaying session
                unset($_SESSION['pwd-not-match']);//removing session after display
            }
            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];//diplaying session
                unset($_SESSION['change-pwd']);//removing session after display
            }


        ?>

      <br/><br/><br/>

        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br/><br/><br/>


          <table class="tbl-full">
              <tr>
                  <th>S.no</th>
                  <th>Full Name</th>
                  <th>User name</th>
                  <th>Actions</th>
              </tr>
              
              <?php
                //sql code to diplay all admin from db on manage admin page
                  $sql="SELECT * FROM admin_table";
                  //execute query
                  $res=mysqli_query($conn,$sql);
                  //check query executed?
                  if($res==TRUE)
                  {
                      //count rows to check do we have data in db or not
                      $count = mysqli_num_rows($res);//fntn to get all rows in db




                      $sn=1;//create a var and assign the value

                      //check no of rows
                      if($count>0)
                      {
                          //then we have data in db
                          //display all  data in db using while
                          while($rows=mysqli_fetch_assoc($res))
                          {
                             $id=$rows['id'];
                             $full_name=$rows['full_name'];
                             $username=$rows['username'];
                             //now break php to diplay data n table using html
                             ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change password</a>
                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <!--passing value through form is post method
                                while passing value trough url as here is get method-->
                                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> Delete Admin</a>
                                </td>
                            </tr>
                             
                           <?php


                          }

                      }
                      else{

                        //no data
                      }
                  }


              ?>
             
              
          </table>
        
            </div>
        </div>
        <!--main content section ends-->
        <?php include('partials/footer.php');?>
</html>