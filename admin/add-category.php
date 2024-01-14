<?php include('partials/menu.php'); ?>
<link href="https://fonts.googleapis.com/css2?family=Teko&display=swap" rel="stylesheet">

<div class="main-content">
  <div class="wrapper">

    <h1>Add Category</h1>

    <br><br>

    <?php
      // Display success or error messages if set in session
      if(isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
      }

      if(isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
      }
    ?>

    <br><br>
    
    <!-- add category form starts here-->
    <form action="" method="POST" enctype="multipart/form-data">

      <table class="tbl-30">
        <tr>
          <td>Title:</td>
          <td>
            <input type="text" name="title" placeholder="Category Title" style="font-family: 'Teko', sans serif;" required>
          </td>
        </tr>

        <tr>
          <td>Select Image:</td>
          <td>
            <input type="file" name="image" >
          </td>
        </tr>

        <tr>
          <td>Featured:</td>
          <td>
            <input type="radio" name="featured" value="Yes" required> Yes
            <input type="radio" name="featured" value="No" required> No
          </td>
        </tr>

        <tr>
          <td>Active:</td>
          <td>
            <input type="radio" name="active" value="Yes" required> Yes
            <input type="radio" name="active" value="No" required> No
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
    <!-- add category form ends here-->

    <?php
      // Process form submission
      if(isset($_POST['submit'])) {
        $title = $_POST['title'];
        
        $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
        $active = isset($_POST['active']) ? $_POST['active'] : "No";

        if(isset($_FILES['image']['name'])) {
          $image_name = $_FILES['image']['name'];

          if($image_name!="") {
            // Generate a unique image name
            $ext = end(explode('.', $image_name));
            $image_name = "Clothes_category".rand(000,999).'.'.$ext;

            // Set source and destination paths for image upload
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;

            // Move the uploaded image to the destination folder
            $upload = move_uploaded_file($source_path, $destination_path);

            if($upload==false) 
            {
              $_SESSION['upload']="<div class='danger'>Failed to upload image</div>";
              header("location:".SITEURL.'admin/add-category.php');
              die();
            }
          }
        }
        else {
          $image_name="";
        }

        // Insert category details into the database
        $sql ="INSERT INTO tbl_category SET
          title='$title',
          image_name='$image_name',
          featured='$featured',
          active='$active'
        ";

        $res=mysqli_query($conn,$sql);

        // Check if the insertion was successful and redirect accordingly
        if($res==true) {
          $_SESSION['add']="<div class='success'>Category Added Successfully</div>";
          header("location:".SITEURL.'admin/manage-category.php');
        }
        else {
          $_SESSION['add']="<div class='danger'>Failed to add category</div>";
          header("location:".SITEURL.'admin/add-category.php');
        }
      }
    ?>

  </div>
</div>

<?php include('partials/footer.php'); ?>
