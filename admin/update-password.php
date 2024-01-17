<?php include('partials/menu.php')?>
<link href="https://fonts.googleapis.com/css2?family=Teko&display=swap" rel="stylesheet">
<style>
  body {
    
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
  }
  .main-content {
    width: 80%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .tb1-30 {
    width: 50%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  table td {
    padding: 10px;
    border: 1px solid #ddd;
  }

  input[type="password"] {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  input[type="submit"] {
    background-color: lightseagreen;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: teal;
  }
</style>


<div class="main-content">
    <div class="wrapper">

        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tb1-30">

                <tr>
                    <td>Current Password: </td>
                    <td><input type="password" name="current_password" placeholder="Old Password" style="font-family:'Teko',sans serif;"></td>
               </tr>

               <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password" style="font-family:'Teko',sans serif;"></td>
              </tr>

              <tr>
                    <td>Confirm Password: </td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password" style="font-family:'Teko',sans serif;"></td>
             </tr>

              <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id?>">
                    <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
             </tr>

    </table>

    </form>

    </div>
</div>

<?php

            //check whether the submit button is clicked
            if(isset($_POST['submit']))
            {
                // echo "clicked";

                //1.get the data from form
                $id=$_POST['id'];
                $current_password=md5($_POST['current_password']);
                $new_password=md5($_POST['new_password']);
                $confirm_password=md5($_POST['confirm_password']);


                //2.check whether the user with current ID and Current Passowrd exists
                $sql ="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                //execute the query
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //check if the data is available or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //user exists and password can be changed
                        // echo "user found";
                        
                        //check whether the new passowrd and confirm password match
                        if($new_password==$confirm_password)
                        {
                            //update the password
                            $sql2 = "UPDATE tbl_admin SET
                                password='$new_password'
                                WHERE id=$id
                            ";

                            //execute the query
                            $res2 = mysqli_query($conn, $sql2);

                            //check whether the query executed
                            if($res2==true)
                            {
                                //display success message
                                //redirect to manage admin page with success message
                                $_SESSION['change-pwd'] = "<div class='success'> Password Change Successful.</div>";
                                //redirect back to manage-admin page
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //display error message
                                //redirect to manage admin page with error message
                                $_SESSION['change-pwd'] = "<div class='danger'> Password Change failed.</div>";
                                //redirect back to manage-admin page
                                header('location:'.SITEURL.'admin/manage-admin.php');
                                
                            }
                        }
                        else{
                            //redirect to manage admin page with error message
                            $_SESSION['pwd-not-match'] = "<div class='danger'> Passwords did not match.</div>";
                            //redirect back to manage-admin page
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        //if not admin current password set message and redirect
                        $_SESSION['user-not-found'] = "<div class='danger'> Invalid current password.</div>";
                        //redirect back to manage-admin page
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

                //3.check whether the new password and confirm password match

                //4.change password if all above is true
            }

?>


<?php include('partials/footer.php')?>