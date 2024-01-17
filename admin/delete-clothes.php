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
        transition: color 0.3s ease;
    }
    


</style>


<?php
    // Include constant.php file
    include('../config/constants.php');

    // Check whether the id and image_name values are set
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the id and image_name of category to be deleted
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $image_name = $_GET['image_name'];

        // Display the confirmation form
        echo "
        <form method='POST' action='" . $_SERVER['PHP_SELF'] . "?id=$id&image_name=$image_name'>
            <label>Are you sure you want to delete this item?</label>
            <input type='submit' name='confirm' value='Yes'>
            <input type='submit' href='" . SITEURL . "admin/manage-clothes.php' value='No'style='background-color:#ff4757;'>
        </form>";

        // Check if the confirmation is received from the user
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['confirm']) && $_POST['confirm'] == 'Yes') {

                // Remove the physical image file if available
                if($image_name != "")
                {
                    // Image is available to be removed
                    $path = "../images/clothes/" . $image_name;

                    // Remove the image
                    $remove = unlink($path);

                    // If image fails to remove, add an error message and stop the process
                    if($remove == false)
                    {
                        // Set the session message
                        $_SESSION['remove'] = "<div class='danger'>Failed to remove item image</div>";
                        // Redirect to manage clothes page
                        header('location:' . SITEURL . 'admin/manage-clothes.php');
                        // Stop the process
                        die();
                    }
                }

                // SQL query to delete item
                $sql = "DELETE FROM tbl_clothes WHERE id=$id";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Check whether the query executed successfully
                if($res == TRUE)
                {
                    // Query executed successfully, and item deleted
                    $_SESSION['delete'] = "<div class='danger'>Item has been deleted</div>";
                    // Redirect to manage category page
                    header('location:' . SITEURL . 'admin/manage-clothes.php');
                }
                else
                {
                    // Failed to delete item
                    $_SESSION['delete'] = "<div class='danger'>Item Deletion Failed</div>";
                    // Redirect to manage clothes page
                    header('location:' . SITEURL . 'admin/manage-clothes.php');
                }
            } else {
                // Redirect to manage clothes page if Cancel is clicked
                header('location:' . SITEURL . 'admin/manage-clothes.php');
            }
        }
    }
?>
