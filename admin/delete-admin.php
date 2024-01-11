<?php
    //include constant.php file
    include('../config/constants.php');

    //1.get the id of admin  to the deleted
    $id = $_GET['id'];

    //2.sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check whether the query executed successfully
    if($res==TRUE)
    {
        //query executed successfully and admin deleted
        // echo "Admin deleted";
        //Create session variable to display message 
        $_SESSION['delete'] = "<div class='danger'>Admin has been deleted</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //failed to delete admin
        // echo "failed to delete admin";
        $_SESSION['delete'] = "<div class='danger'>Admin Deletion Failed</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }

    //3.redirect to manage admin page with success or error message

?>