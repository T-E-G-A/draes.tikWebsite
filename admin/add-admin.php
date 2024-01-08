<?php include('partials/menu.php');?>
<link href="https://fonts.googleapis.com/css2?family=Teko&display=swap" rel="stylesheet">



<div class="main-content">
    <div class="wrapper">
       <h1>Add Admin</h1>

       <br><br>

       <?php
            if(isset($_SESSION['add']))//checking if the session us set or not
            {
                echo $_SESSION['add'];// displaying session message
                unset($_SESSION['add']);//removing session message
              }
       ?>

       <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter Your Name" style="font-family:'Teko', sans serif; width: 8rem;"></td>
            </tr>

            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Enter Your Username" style="font-family:'Teko', sans serif; width: 8rem;"></td>
            </tr>

            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="Enter Your Password" style="font-family:'Teko', sans serif; width: 8rem;"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>
       </form>
      
       <div class="clearfix"></div>
    </div>
  </div>

<?php include('partials/footer.php');?>



<?php
    //Process the Value From and Save it in db
    
    //Check whether the button is clicked or not
    if(isset($_POST['submit'])){
        //Button Clicked
       // echo"Button Clicked";

       //1.Get the Data from form
       $full_name = $_POST['full_name'];
       $username = $_POST['username'];
       $password = md5($_POST['password']);//passsword encryption with md5

       //2.Sql query to save data to the db
       $sql= "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
       ";

       
       //3.Execute Query and save data to the db    
       $res = mysqli_query($conn, $sql) or die(mysqli_error());

       //4.Check whether the (query is executed) data is inserted or not and display appropriate message
       if($res==TRUE){
        //Data Inserted
        //echo "Data Inserted";
        //Create a Session Variabe to Display Message
        $_SESSION['add']="<div class='success'>Admin added successfully</div>";
        //Redirect Page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');

       }
       else{
        //Failed to insert data
        //echo "Failed to insert data";
        //Create a Session Variabe to Display Message
        $_SESSION['add']="<div class='error'>Failed to add admin</div>";
        //Redirect Page to add admin
        header("location:".SITEURL.'admin/add-admin.php');
       }



    }

    else{
        

    }

?>