<?php include ('partials-front/menu.php')?>

    <!-- clothes sEARCH Section Starts Here -->
    <section class="clothes-search text-center">
        <div class="container">
            
            <form action="clothes-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Clothes..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-tertiary">
            </form>

        </div>
    </section>
    <!-- clothes sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
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

    <!-- clothes MEnu Section Starts Here -->
    <section class="clothes-menu">
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

    <?php include ('partials-front/footer.php');?> 

</body>
</html>