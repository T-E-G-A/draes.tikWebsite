<?php include ('partials-front/menu.php')?>
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
    .categories,
    .clothes-menu {
        animation: fadeIn 1s ease-in-out;
    }

    /* Optional: You can add animation delays to create a stagger effect */
    .categories .box-3,
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
   #categories-section,
   #clothes-menu-section {
       animation: fadeIn 1s ease-in-out;
       position: relative;
       overflow: hidden;
   }

   #search-section form {
       animation: fadeIn 1s ease-in-out;
       animation-delay: 0.2s; /* Adjust this delay as needed */
   }

   /* Media Queries for Responsive Design */
   @media only screen and (max-width: 768px) {
       .clothes-search form {
           flex-direction: column;
           align-items: center;
       }

       .clothes-search input[type="search"],
       .clothes-search input[type="submit"] {
           width: 100%;
           margin-bottom: 10px;
       }
   }
</style>
<style>
    #clothes-menu-section .clothes-box {
        margin-left: auto;
        margin-right: auto;
        margin: 0 20px 20px 0; 
        position: relative;
        left: 70px;
        max-width: 1200px;
        
    }

    @media only screen and (max-width: 768px) {
        #clothes-menu-section .clothes-box {
           width: calc(100% - 40px); 
            padding: 0 20px;
            margin: 0 0 20px 0; 
        }
    }
</style>
<style>
    #categories-section .box-3 {
        margin-left: auto;
        margin-right: auto;
        position: relative;
        left: 32px;
        margin: 0 20px 20px; /* Adjust the margins as needed for spacing */
        max-width: 1200px; /* Adjust the max-width as needed */
    }

    @media only screen and (max-width: 768px) {
        #categories-section .box-3 {
            width: calc(100% - 40px); /* Adjust the width and padding as needed */
            padding: 0 20px; /* Adjust the padding as needed */
            margin: 0 0 20px 0; /* Adjust the margins as needed for spacing */
        }
    }
</style>

<!-- clothes SEARCH Section Starts Here -->
<section class="clothes-search text-center" id="search-section">
   <div class="container">
       <form action="clothes-search.html" method="POST">
           <input type="search" name="search" placeholder="Search for items..." style="font-family:'Teko', sans-serif" required>
           <input type="submit" name="submit" value="Search" style="font-family:'Teko', sans-serif" class="btn btn-tertiary">
       </form>
   </div>
</section>
<!-- clothes SEARCH Section Ends Here -->

<!-- Categories Section Starts Here -->
<section class="categories" id="categories-section">
    <div class="container">
        <h2 class="text-center">Explore Our Options</h2>

        <?php
            //create sql query to display categories from db
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3 ";
            //execute the query
            $res = mysqli_query($conn,$sql);
            //count rows to check if category is available
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="category-clothes.html">
                        <div class="box-3 float-container" >
                            <?php
                                //check if the image is available 
                                if($image_name=="")
                                {
                                    //display message
                                    echo "<div class='danger'>image not available</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" class="img-responsive img-curve" width="100px" height="350px" >
                                    <?php
                                }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title;?></h3>
                        </div>
                    </a>

                    <?php
                }
            }
            else
            {
                //categories not available
                echo "<div class= 'danger'>Category not added</div>";
            }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- clothes Menu Section Starts Here -->
<section class="clothes-menu" id="clothes-menu-section">
    <div class="container">
        <h2 class="text-center">Available Pieces</h2>

        <?php
            //create sql query to display categories from db
            $sql2 = "SELECT * FROM tbl_clothes WHERE active='Yes' AND featured='Yes' LIMIT 6 ";
            //execute the query
            $res2 = mysqli_query($conn,$sql2);
            //count rows to check if category is available
            $count2 = mysqli_num_rows($res2);

            if($count2>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="clothes-box" style="width: 40%;" >
                        <div class="clothes-img" >
                            <?php
                                //check if the image is available 
                                if($image_name=="")
                                {
                                    //display message
                                    echo "<div class='danger'>image not available</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/clothes/<?php echo $image_name;?>" class="img-responsive img-curve"  height="350px" style="width: 100%;" >
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="clothes-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="clothes-price" style="font-family:'Teko', sans-serif">₦<?php echo $price;?></p>
                            <br>
                            <a href="order.html" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                //categories not available
                echo "<div class= 'danger'>Category not added</div>";
            }
        ?>

        <div class="clearfix"></div>
    </div>

    <p class="text-center">
        <a href="#">See All Pieces</a>
    </p>
</section>
<!-- clothes Menu Section Ends Here -->

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

    #categories-section .box-3,
    #clothes-menu-section .clothes-box {
        animation: fadeIn 1s ease-in-out;
        animation-delay: 0.2s; /* Adjust this delay as needed */
    }

    /* Media Queries for Responsive Design */
    @media only screen and (max-width: 768px) {
        #categories-section .box-3 {
            width: 100%;
        }

        #clothes-menu-section .clothes-box {
            width: 100%;
        }
    }
</style>

<?php include ('partials-front/footer.php');?> 

</body>
</html>
