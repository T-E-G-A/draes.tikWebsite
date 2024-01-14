<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>
        <?php

          if(isset($_SESSION['add']))//checking if the session is set or not
            {
              echo $_SESSION['add'];// displaying session message
              unset($_SESSION['add']);//removing session message
            }
          if(isset($_SESSION['delete']))
            {
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
            }
          if(isset($_SESSION['remove']))
            {
              echo $_SESSION['remove'];
              unset($_SESSION['remove']);
            }
          if(isset($_SESSION['error']))
            {
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            }
          if(isset($_SESSION['no-cat-found']))
            {
              echo $_SESSION['no-cat-found'];
              unset($_SESSION['no-cat-found']);
            }

          if(isset($_SESSION['update']))
            {
              echo $_SESSION['update'];
              unset($_SESSION['update']);
            }

          if(isset($_SESSION['upload']))
            {
              echo $_SESSION['upload'];
              unset($_SESSION['upload']);
            }
          
          if(isset($_SESSION['failed-remove']))
            {
              echo $_SESSION['failed-remove'];
              unset($_SESSION['failed-remove']);
            }
        ?>
        <br><br>


          <!-- Button to add catgeory-->
          <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
       <br><br><br>
          
          <table class="tbl-full">
            <tr>
              <th>S.N</th>
              <th>title</th>
              <th>Image</th>
              <th>Featured</th>
              <th>Active</th>
              <th>Actions</th>


            </tr>

            <?php
            
            //query to get all category data from db
            $sql = "SELECT * FROM tbl_category";

            //execute query
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            $sn=1; //create a varaible and assign the value

            //check if data is in database
            if($count>0)
            {
              //data present in database
              //get data and display
              while($row=mysqli_fetch_assoc($res))
              {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

                ?>

                <tr>
                  <td><?php echo $sn++;?></td>
                  <td><?php echo $title;?></td>

                  <td>
                    <?php 
                          //check whether image name is available or not
                          if($image_name!="")
                          {
                            //display image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" height="80px">

                            <?php
                          }
                          else{
                            // display message
                            echo "<div>No added image</div>";

                          }
                    ?>
                  </td>

                  <td><?php echo $featured;?></td>
                  <td><?php echo $active;?></td>
                  <td>
                  <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Category</a>
                  <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-tertiary">Delete Category</a>
                  </td>
               </tr>

                <?php


              }
            }
            
            ?>

            

           
          </table>
    </div>
    
</div>

<?php include('partials/footer.php');?>