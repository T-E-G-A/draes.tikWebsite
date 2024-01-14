
<link href="https://fonts.googleapis.com/css2?family=Teko&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Teko', sans-serif;
        background-color: #f4f4f4;
    }

    form {
        max-width: 400px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-size: 16px;
        color: #333;
    }

    input[type="submit"] {
        background-color: lightseagreen;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        font-family:'Teko', sans-serif;
    }


</style>



<?php
    // Include constant.php file
    include('../config/constants.php');

    // Get the id of admin to be deleted
    $id = $_GET['id'];

    // Check if the confirmation is received from the user
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['confirm']) && $_POST['confirm'] == 'Yes') {

            // SQL query to delete admin
            $sql = "DELETE FROM tbl_admin WHERE id=$id";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Check whether the query executed successfully
            if($res == TRUE) {
                // Query executed successfully and admin deleted
                $_SESSION['delete'] = "<div class='danger'>Admin has been deleted</div>";
                // Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            } else {
                // Failed to delete admin
                $_SESSION['delete'] = "<div class='danger'>Admin Deletion Failed</div>";
                // Redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        } else {
            // Confirmation not received, redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    } else {
        // Display the confirmation form
        echo "
        <form method='POST' action='" . SITEURL . "admin/delete-admin.php?id=$id'>
            <label>Are you sure you want to delete this admin?</label>
            <input class type='submit' name='confirm' value='Yes'>
            <input type='submit' href='" . SITEURL . "admin/manage-admin.php' value='No' style='background-color:#ff4757;'>
        </form>";
    }
?>




