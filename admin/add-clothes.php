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

<div class="main-content">
  <div class="wrapper">

    <h1>Add Clothes</h1>

    <br><br>

    

    <form action="" method="POST" enctype="multipart/form-data">

      <table class="tb1-30">

        <tr>
          <td>Title: </td>
          <td><input type="text" name="title" placeholder="Title of the Item"></td>
        </tr>

        <tr>
          <td>Description: </td>
          <td><textarea name="description" cols="30" rows="5" placeholder="Description of the Item."></textarea></td>
        </tr>

        <tr>
          <td>Price: </td>
          <td><input type="number" name="price"></td>
        </tr>

        <tr>
            <td>Select Image:</td>
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
                                $id = $row['id'];
                                $title = $row['title'];

                                ?>

                                <option value="<?php echo $id;?>"><?php echo $title;?></option>

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
                <input type="radio" name="featured" value="Yes"> Yes
                <input type="radio" name="featured" value="No"> No
            </td>
        </tr>

        <tr>
            <td>Active:</td>
            <td>
                <input type="radio" name="active" value="Yes"> Yes
                <input type="radio" name="active" value="No"> No
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Item" class="btn-secondary">
            </td>
        </tr>

      </table>

    </form>


    <?php

        //check if the button is clicked or not
        if(isset($_POST['submit']))
        {
            //add the item to database
            // echo "clicked";
            
            //1. get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check if radio button for featured and active are checked
            if (isset($_POST['featured'])) 
            {

             $featured = $_POST['featured'];

            }
            
            else 
            {
                $featured = "No"; //Setting the Default Value            
            }
            
            
            
            if (isset($_POST['active'])) 
            {
                $active = $_POST['active'];
            
            }
            
            
            else
            {
            
            $active = "No"; //Setting Default Value
            }
            //2. upload the image if selected
            // Check whether the select image is clicked or not and upload the image only if the image is selected
            if (isset($_FILES['image_name']['name'])) {

           
            // Get the details of the selected image
            $image_name = $_FILES['image_name']['name'];

            // Check whether the Image is Selected or not and upload image only if selected
            if ($image_name != "") {


                // Image is Selected
                // A. Rename the Image
                // Get the extension of the selected image (jpg, png, gif, etc.) "ed-2.jpg" ed-2 jpg
$fileParts = explode('.', $image_name);

// Check if explode successfully created an array
if (is_array($fileParts)) {
    $ext = end($fileParts);
} else {
    // Handle the case where explode failed
    // You may want to set a default extension or handle the error in a way that fits your application
    $ext = 'default_extension';
}

// Create a new name for the image
$new_image_name = "Item-Name-" . rand(0000, 9999) . "." . $ext;


                // B. Upload the Image
                // Get the Src Path and Destinaton path

                // Source path is the current location of the image
                $src = $_FILES['image_name']['tmp_name'];

                // Destination Path for the image to be uploaded
                $dst = "../images/clothes/" . $image_name;

                //finally upload the image
                $upload = move_uploaded_file($src, $dst);

                //check if the image is uploaded
                if($upload==false)
                {
                  //failed to upload image
                  //redirect to add clothes page with error message
                  //stop the process
                  $_SESSION['upload']="<div class='danger'>Failed to upload image</div>";
                  header("location:".SITEURL.'admin/add-clothes.php');
                  die();
                }
            
            } 

            else 
            {


                $image_name = ""; // Setting Default Value as blank

            }


        


             // 3. insert into the db
             // create a sql query to save item
             $sql2 = "INSERT INTO tbl_clothes 
             (title, description, price, image_name, category_id, featured, active) 
             VALUES 
             ('$title', '$description', $price, '$image_name', $category, '$featured', '$active')";

              // execute the query
              $res2 = mysqli_query($conn, $sql2);

              // check if the data is inserted
              // 4. redirect with message to manage clothes page
              if ($res2 == true) 
              {
                // data inserted successfully
                $_SESSION['add'] = "<div class='success'>Item Added Successfully</div>";
                header("location:" . SITEURL . 'admin/manage-clothes.php');
                exit();
              } 
              else 
              {
                // failed to insert data
                $_SESSION['add'] = "<div class='danger'>Failed to add item</div>";
                header("location:" . SITEURL . 'admin/add-clothes.php');
                die();
              }
            
        }
        }
    
    ?>

  </div>
</div>



<?php include('partials/footer.php');?>
