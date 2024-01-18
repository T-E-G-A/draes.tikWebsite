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

  h1 {
    color: #333;
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

  input[type="text"],
  input[type="number"],
  select,
  textarea {
    width: 100%;
    padding: 8px;
    margin: 5px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  textarea {
    resize: vertical;
  }

  input[type="file"] {
    margin-top: 5px;
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

  input[type="radio"] {
    margin-right: 5px;
  }
</style>

<?php include('partials/menu.php');?>

<?php
        // Check if the id is set
        if(isset($_GET['id'])) 
        {
            // Get the id and all other details
            $id = $_GET['id'];
            // SQL query to get all other details
            $sql2 = "SELECT * FROM tbl_clothes WHERE id=$id";
            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Count the rows to check if id is valid or not
            $count = mysqli_num_rows($res2);
            // Check if we have data for the item
            if($count == 1) {
                // Get the details
                $row2 = mysqli_fetch_assoc($res2);

                $title = $row2['title'];
                $price = $row2['price'];
                $description = $row2['description'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            } 
            else 
            {
                // Redirect to manage clothes page
                $_SESSION['no-item-found'] = "<div class='danger'>Item not found.</div>";
                header('location:'.SITEURL.'admin/manage-clothes.php');
            }
        } 
        else 
        {
            // Display error message
            $_SESSION['error']="<div class='danger'>Access Denied, ID Required</div>";
            // Redirect to manage category
            header("location:".SITEURL.'admin/manage-clothes.php');
        }

        // Check if the form is submitted
        if(isset($_POST['submit'])) 
        {
            // Sanitize and get form data
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category_id = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

           // Handle image upload
            $image_name = $_FILES['image_name']['name'];
            if($image_name != "") 
            {
                // Get the file extension
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);

                // Create a new name for the image
                $image_name = "item-name" . rand(000, 999) . '.' . $ext;

                // Upload the new image
                $source_path = $_FILES['image_name']['tmp_name'];
                $destination_path = "../images/clothes/" . $image_name;
                $upload = move_uploaded_file($source_path, $destination_path);

                if(!$upload) 
                {
                    // Display error if image upload fails
                    $_SESSION['upload'] = "<div class='danger'>Failed to upload image.</div>";
                    header('location:'.SITEURL.'admin/manage-clothes.php');
                    exit();
                }

                // Remove the old image
                if($current_image != "") 
                {
                    $remove_path = "../images/clothes/".$current_image;
                    
                    // Check if the file exists before attempting to remove it
                    if(file_exists($remove_path))
                     {
                        $remove = unlink($remove_path);
                        
                        if(!$remove) 
                        {
                            // Display error if removal of old image fails
                            $_SESSION['failed-remove'] = "<div class='danger'>Failed to remove old image.</div>";
                            header('location:'.SITEURL.'admin/manage-clothes.php');
                            exit();
                        }
                    } 
                    else 
                    {
                        // Display a message if the file doesn't exist
                        echo "<div>No such file found for removal: $remove_path</div>";
                    }
                }
            } 
            else 
            {
                // If no new image is selected, use the current image
                $image_name = $current_image;
            }


            // Update the database
            $sql3 = "UPDATE tbl_clothes SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category_id,
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id";

            $res3 = mysqli_query($conn, $sql3);

            if($res3) 
            {
                // Display success message on successful update
                $_SESSION['update'] = "<div class='success'>Item updated successfully.</div>";
                header('location:'.SITEURL.'admin/manage-clothes.php');
            } 
            else 
            {
                // Display error message on update failure
                $_SESSION['update'] = "<div class='danger'>Failed to update item.</div>";
                header('location:'.SITEURL.'admin/manage-clothes.php');
            }
        }
?>

        <div class="main-content">
        <div class="wrapper">
            <h1>Update Clothes</h1>
            <br><br>
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="tb1-30">
                <tr>
                <td>Title: </td>
                <td><input type="text" name="title" value="<?php echo $title;?>" style="font-family:'Teko', sans-serif"></td>
                </tr>

                <tr>
                <td>Description: </td>
                <td><textarea name="description" cols="30" rows="5" style="font-family:'Teko', sans-serif"><?php echo $description;?></textarea></td>
                </tr>

                <tr>
                <td>Price: </td>
                <td><input type="number" name="price" value="<?php echo $price;?>"></td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image !="")
                        {
                            // Display image
                            ?>
                            <img src="<?php echo SITEURL;?>images/clothes/<?php echo $current_image; ?>" width="150px">
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
                    <td>Select New Image:</td>
                    <td>
                        <input type="file" name="image_name" >
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" >
                            
                            <?php
                                //create php code to display categories from database
                                //1.create sql to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //executing query
                                $res = mysqli_query($conn,$sql);

                                //count rows to check if we have categories
                                $count = mysqli_num_rows($res);

                                //if count is greater than zero, we have categories
                                if($count>0)
                                {
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of category
                                    
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        ?>

                                        <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>


                                        <?php

                                    }
                                }
                                else
                                {
                                    //we don't have any category
                                    ?>
                                    <option value="0">No category Found</option>
                                    <?php
                                }
                                //Display on dropdown
                            ?>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes

                    <input  <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes

                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Item" class="btn-secondary">
                    </td>
                </tr>

            </table>
            </form>
        </div>
        </div>

<?php include('partials/footer.php');?>
