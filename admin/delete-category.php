<?php
    // Include constant.php file
    include('../config/constants.php');

    // Check whether the id and image_name values are set
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the id and image_name of category to be deleted
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $image_name = $_GET['image_name'];

        // Remove the physical image file if available
        if($image_name != "")
        {
            // Image is available to be removed
            $path = "../images/category/" . $image_name;
            
            // Remove the image
            $remove = unlink($path);

            // If image fails to remove, add an error message and stop the process
            if($remove == false)
            {
                // Set the session message
                $_SESSION['remove'] = "<div class='danger'>Failed to remove category image</div>";
                // Redirect to manage category page
                header('location:' . SITEURL . 'admin/manage-category.php');
                // Stop the process
                die();
            }
        }
    }

    // SQL query to delete category
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully
    if($res == TRUE)
    {
        // Query executed successfully, and category deleted
        $_SESSION['delete'] = "<div class='success'>Category has been deleted</div>";
        // Redirect to manage category page
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
    else
    {
        // Failed to delete category
        $_SESSION['delete'] = "<div class='danger'>Category Deletion Failed</div>";
        // Redirect to manage category page
        header('location:' . SITEURL . 'admin/manage-category.php');
    }
?>
