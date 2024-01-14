<?php include('partials/menu.php');?>
<link href="https://fonts.googleapis.com/css2?family=Teko&display=swap" rel="stylesheet">

<div class="main-content">
  <div class="wrapper">

    <h1>Update Category</h1>

    <br><br>

    <?php
        // Check if the id is set
        if(isset($_GET['id']))
        {
            // Get the id and all other details
            $id = $_GET['id'];
            // SQL query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            // Execute the query
            $res = mysqli_query($conn,$sql);

            // Count the rows to check if id is valid or not
            $count = mysqli_num_rows($res);
            // Check if we have data for the category
            if($count == 1) 
            {
                // Get the details
                $row = mysqli_fetch_assoc($res);
                
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                // Redirect to manage category page
                $_SESSION['no-cat-found'] = "<div class='danger'>Category not found.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else
        {
            // Display error message
            $_SESSION['error']="<div class='danger'>Access Denied, ID Required</div>";
            // Redirect to manage category
            header("location:".SITEURL.'admin/manage-category.php');
        }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">

      <table class="tbl-30">
        <tr>
          <td>Title: </td>
          <td>
            <input type="text" name="title" value="<?php echo $title;?>" style="font-family:'Teko', sans-serif">
          </td>
        </tr>

        <tr>
          <td>Current Image: </td>
          <td>
            <?php
                if($current_image !="")
                {
                    // Display image
                    ?>
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="150px">
                    <?php
                }
                else
                {
                    // Display message
                    echo "<div>No added image</div>";
                }
            ?>
          </td>
        </tr>

        <tr>
          <td>New Image: </td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>

        <tr>
          <td> Featured:</td>
          <td>
            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

            <input  <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
          </td>
        </tr>

        <tr>
          <td> Active:</td>
          <td>
            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes

            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
          </td>
        </tr>

        <tr>
            <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
            </td>
        </tr>

      </table>

    </form>

    <?php
    
         if(isset($_POST['submit']))
         {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Check if image is selected
            if(isset($_FILES['image']['name']))
            {
                // Get the image details
                $image_name = $_FILES['image']['name'];

                // Check if the image is available
                if($image_name != "")
                {
                    // Auto Rename our Image
                    $ext = end(explode('.', $image_name));
                    $image_name = "Clothes_Category_" . rand(000, 999) . '.' . $ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    // Upload the Image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Check whether the image is uploaded
                    if($upload == false)
                    {
                        $_SESSION['upload'] = "<div class='danger'>Failed to Upload Image</div>";
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        die();
                    }

                    // Remove the current image if available
                    if($current_image != "")
                    {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        // Check whether the image is removed
                        if($remove == false)
                        {
                            $_SESSION['failed-remove'] = "<div class='danger'>Failed to remove current Image.</div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
            }
            else
            {
                $image_name = $current_image;
            }

            // Update the database
            $sql2 = "UPDATE tbl_category SET
                     title = '$title',
                     image_name = '$image_name',
                     featured = '$featured',
                     active = '$active' 
                     WHERE id=$id           
            ";

            $res2 = mysqli_query($conn,$sql2);

            // Check if the query executed successfully
            if($res2 == true)
            {
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                $_SESSION['update'] = "<div class='danger'>Category failed to update</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
         }
    ?>

  </div>
</div>

<?php include('partials/footer.php');?>
