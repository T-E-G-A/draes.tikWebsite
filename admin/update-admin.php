<?php include('partials/menu.php')?>
<link href="https://fonts.googleapis.com/css2?family=Teko&display=swap" rel="stylesheet">


<div class="main-content">
    <div class="wrapper">
       <h1>Update Admin</h1>

       <br><br>

       <?php
       
         //1.get the id of selected admin
         $id = $_GET['id'];

         //2.create sql query to get the details
         $sql = "SELECT * FROM tbl_admin WHERE id=$id";

         //execute the query
         $res = mysqli_query($conn, $sql);

         //check if the query has been executed or not
         if($res==true)
         {
            //check whether the data is available or not
            $count = mysqli_num_rows($res);
            //check fi we have data admin data or not
            if($count==1) 
            {
                //get the details
                // echo "Admin Available";
                $row=mysqli_fetch_assoc($res);
                
                $full_name = $row['full_name'];
                $username = $row['username'];

            }
            else
            {
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
         }


       ?>

       <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name" value="<?php echo $full_name;?>" style="font-family:'Teko', sans serif; width: 8rem;" ></td>
            </tr>

            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Enter Your Username" value="<?php echo $username;?>"style="font-family:'Teko', sans serif; width: 8rem;"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
       </form>
      
       <div class="clearfix"></div>
    </div>
  </div>

  <?php
  
        //check whether the button is clicked or not
        if(isset($_POST['submit']))
        {
            // echo "Button Clicked";
            //get all the values from form to update
            $id = $_POST['id'];
            $full_name= $_POST['full_name'];
            $username= $_POST['username'];

            //create sql query to update admin
            $sql = "UPDATE tbl_admin SET
            full_name = '$full_name',
            username = '$username'
            WHERE id=$id
            ";

            //Execute the query
            $res=mysqli_query($conn,$sql);

            //Check whether the query was executed successfully
            if($res==true)
            {
                //query executed and admin updated
                $_SESSION['update'] = "<div class='success'>Admin has been updated</div>";
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                //failed to update admin
                $_SESSION['update'] = "<div class='danger'>Failed to update admin</div>";
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            

        }

  ?>



<?php include('partials/footer.php')?>