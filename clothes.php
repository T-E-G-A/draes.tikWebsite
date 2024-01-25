<?php include ('partials-front/menu.php');?> 
<style>
    /* Add this style block for additional animations */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Apply fadeIn animation to the specified elements */
    .clothes-search,
    .clothes-menu .clothes-box{
        animation: fadeIn 1s ease-in-out;
    }

    /* Optional: You can add animation delays to create a stagger effect */
    
    .clothes-menu .clothes-box {
        animation-delay: 0.2s;
    }

    /* Media Queries for Responsive Design */
    @media only screen and (max-width: 768px) {
        .clothes-box {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }
    }
</style>

<style>
   
   @keyframes fadeIn {
       0% {
           opacity: 0;
           transform: translateY(-20px);
       }

       100% {
           opacity: 1;
           transform: translateY(0);
       }
   }

   #search-section,
   #categories-section{
       animation: fadeIn 1s ease-in-out;
       overflow: hidden;
   }

   #search-section form {
       animation: fadeIn 1s ease-in-out;
       animation-delay: 0.2s; /* Adjust this delay as needed */
   }
  

   
</style>



<!-- clothes SEARCH Section Starts Here -->
<section class="clothes-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>clothes-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for items..." style="font-family:'Teko', sans-serif" required>
            <input type="submit" name="submit" value="Search" style="font-family:'Teko', sans-serif" class="btn btn-tertiary">
        </form>
    </div>
</section>
<!-- clothes SEARCH Section Ends Here -->

    <?php
        // Variable to store the maximum height of the box
                $maxBoxHeight = 0;

        // Calculate and update the maximum height
        $maxBoxHeight = max($maxBoxHeight, 350);
    ?>

  <!-- clothes Menu Section Starts Here -->
<section class="clothes-menu" id="clothes-menu-section">
    <div class="container">
        <h2 class="text-center">Available Pieces</h2>

        <?php
        // create sql query to display categories from db
        $sql2 = "SELECT * FROM tbl_clothes WHERE active='Yes'  "; //AND featured='Yes' LIMIT 6
        // execute the query
        $res2 = mysqli_query($conn,$sql2);
        // count rows to check if category is available
        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {
            // categories available
            while ($row = mysqli_fetch_assoc($res2)) {
                // get the values
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>

                <div class="clothes-box">
                    <div class="clothes-img">
                        <?php
                        // check if the image is available
                        if ($image_name == "") {
                            // display message
                            echo "<div class='danger'>image not available</div>";
                        } else {
                            // image available
                            ?>
                            <img src="<?php echo SITEURL;?>images/clothes/<?php echo $image_name;?>" class="img-responsive img-curve" height="<?php echo $maxBoxHeight; ?>">
                            <?php
                        }
                        ?>
                    </div>

                    <div class="clothes-desc">
                        <h4><?php echo $title;?></h4>
                        <p class="clothes-price" style="font-family:'Teko', sans-serif">₦<?php echo $price;?></p>
                        <br>
                        <a href="<?php echo SITEURL; ?>order.php?item_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>                    </div>
                </div>
                <?php
            }
        } else {
            // categories not available
            echo "<div class= 'danger'>Category not added</div>";
        }
        ?>

        <div class="clearfix"></div>
    </div>

    <p class="text-center">
       
    </p>
</section>
<!-- clothes Menu Section Ends Here -->


    <?php include ('partials-front/footer.php');?> 
</body>
</html>