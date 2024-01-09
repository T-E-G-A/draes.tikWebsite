<?php include('../config/constants.php');?>
<link href="https://fonts.googleapis.com/css2?family=Teko&display=swap" rel="stylesheet">


<html>
<head>
    <title>Login draes.tik Admin System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<div class="center">
    <h1 style>Login</h1>

    <?php
    if(isset($_SESSION['login']))
    {
      echo $_SESSION['login'];
      unset($_SESSION['login']);
    }
    if(isset($_SESSION['no-login-message']))
    {
      echo $_SESSION['no-login-message'];
      unset($_SESSION['no-login-message']);
    }
    ?>

    <form method="POST" action=""> 
        <div class="txt_field">
            <input type="text" name="username"  style="font-family:'Teko', sans serif;" required>
            <span></span>
            <label>Username</label>
        </div>
        <div class="txt_field">
            <input type="password" name="password" style="font-family:'Teko', sans serif;" required>
            <span></span>
            <label>Password</label>
        </div>
        <input type="submit" name="submit" value="Login" class="btn-LP">
        <div class="author_link">
            <p class="text-center">Created By <a href="#">Edward Oviasogie</a></p>
        </div>
    </form>
</div>

<?php
//check if the submit button is clicked or not
if(isset($_POST['submit'])) {
    //process for login
    //1.get the data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    
    // 2.Sql to check if the user with username and password exist
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    
    //3.execute the query
    $res = mysqli_query($conn,$sql);

    //4.count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //user available and login success
        $_SESSION['login']="<div class='success'>Logged in successfully</div>";
        $_SESSION['user'] = $username;//to check whether the user is logged in and logout will unset it

        //Redirect Page to dashboard index.php
        header("location:".SITEURL.'admin/index.php');

    }
    else
    {
        $_SESSION['login']="<div class='danger text-center'>Username or Password did not match</div>";
        //Redirect Page to dashboard index.php
        header("location:".SITEURL.'admin/login.php');
    }

}
?>

</body>
</html>
