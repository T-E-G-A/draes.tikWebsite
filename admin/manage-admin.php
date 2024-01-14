<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Manage Admin</h1>
    <br>

    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add']; // Displaying session message
      unset($_SESSION['add']); // Removing session message
    }

    if(isset($_SESSION['delete']))
    {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }

    if(isset($_SESSION['update']))
    {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }
    if(isset($_SESSION['user-not-found']))
    {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }
    if(isset($_SESSION['pwd-not-match']))
    {
      echo $_SESSION['pwd-not-match'];
      unset($_SESSION['pwd-not-match']);
    }

    if(isset($_SESSION['change-pwd']))
    {
      echo $_SESSION['change-pwd'];
      unset($_SESSION['change-pwd']);
    }
    
    if(isset($_SESSION['no-cat-found']))
    {
      echo $_SESSION['no-cat-found'];
      unset($_SESSION['no-cat-found']);
    }
    ?>

    <br><br><br>
    <a href="add-admin.php" class="btn-primary">Add Admin</a>
    <br><br><br>

    <table class="tbl-full">
      <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>username</th>
        <th>Actions</th>
      </tr>
      <?php
      // Query to get all admins
      $sql = "SELECT * FROM tbl_ADMIN"; // Added a semicolon here

      // Execute the query
      $res = mysqli_query($conn, $sql);

      // Check if the query executed successfully
      if ($res) { // Simplified the condition check
        // Count rows to check for data
        $count = mysqli_num_rows($res);

        $sn=1; //create a varaible and assign the value

        // If there's data, display it
        if ($count > 0) {
          while ($rows = mysqli_fetch_assoc($res)) {
            $id = $rows['id'];
            $full_name = $rows['full_name'];
            $username = $rows['username'];

            // Display values in table
            ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $full_name; ?></td>
              <td><?php echo $username; ?></td>
              <td>
                <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-tertiary">Delete Admin</a>
              </td>
            </tr>
            <?php
          }
        } else {
          // Handle the case where there's no data
        }
      } else {
        // Handle the case where the query failed
      }
      ?>
    </table>
  </div>
</div>


<?php include('partials/footer.php'); ?>
