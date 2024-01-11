<?php include('partials/menu.php');?>
<div class="main-content">
  <div class="wrapper">

    <h1>Add Category</h1>

    <br><br>

    <?php

        if(isset($_SESSION['add']))//checking if the session is set or not
          {
            echo $_SESSION['add'];// displaying session message
            unset($_SESSION['add']);//removing session message
          }
        
         if(isset($_SESSION['upload']))//checking if the session is set or not
          {
            echo $_SESSION['upload'];// displaying session message
            unset($_SESSION['upload']);//removing session message
          }
    ?>

    <br><br>
 <!-- add category form starts here-->
    <form action="" method="POST" enctype="multipart/form-data">

      <table class="tbl-30">
        <tr>
          <td>Title:</td>
          <td>
            <input type="text" name="title" placeholder="Category Title">
          </td>
        </tr>

        <tr>
          <td>Select Image:</td>
          <td>
            <input type="file" name="image">
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
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
            </td>
        </tr>


      </table>

      </form>
      <!-- add category form ends here-->

      <?php
      
            //check whether the submit button is clicked
            if(isset($_POST['submit']))
            {
                // echo "clicked";

                //1.get value from catgeory form
                $title = $_POST['title'];
                
                //for radio input type to check if the button is clicked
                if(isset($_POST['featured']))
                {
                    //get the value from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //set the default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    //get the value from form
                    $active = $_POST['active'];
                }
                else
                {
                    //set the default value
                    $active = "No";
                }
            
            //check whether the image is selected or not and set the value for image name
            // print_r($_FILES['image']);

            // die();//break the code here
            if(isset($_FILES['image']['name']))
            {
                //upload image
                //to upload images, image name, source path and destination path is needed
                $image_name = $_FILES['image']['name'];
                //auto rename image
                //get the extension of image (jpg,png,gif,etc) e.g "logo.png"
                $ext = end(explode('.', $image_name));

                //rename image
                $image_name = "Clothes_category".rand(000,999).'.'.$ext;



                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/category/" . $image_name;


                //upload image query
                $upload = move_uploaded_file($source_path,$destination_path);

                //check if image is uploaded or not
                //if not uploaded then stop the process and redirect with error messagw
                if($upload==false)
                {
                    //set message
                    $_SESSION['upload']="<div class='danger'>Failed to upload image</div>";
                    //Redirect Page to add category
                    header("location:".SITEURL.'admin/add-category.php');
                    //stop the process
                    die();
                    }

            }
            else
            {
                //don't upload image and set image_value as blank
                $image_name="";
            }


            //2.create sql query to insert data into db
            $sql ="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

            //3.execute the query and save in db
            $res=mysqli_query($conn,$sql);

            //4.check whether the query is executed or not
            if($res==true)
            {
                //query executed and category added
                $_SESSION['add']="<div class='success'>Category added successfully</div>";
                 //Redirect Page to manage category
                header("location:".SITEURL.'admin/manage-category.php');

            }
            else
            {
                //failed to add category                
                //Create a Session Variabe to Display Message
                $_SESSION['add']="<div class='danger'>Failed to add category</div>";
                //Redirect Page to add category
                header("location:".SITEURL.'admin/add-category.php');
                    
            }
                
            }
      
      ?>

  </div>
</div>


<?php include('partials/footer.php');?>