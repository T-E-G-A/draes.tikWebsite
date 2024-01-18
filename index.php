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
            <h2 class="text-center">Available Options</h2>

            <div class="clothes-box">
                <div class="clothes-img">
                    <img src="images/mens.jpg"  class="img-responsive img-curve">
                </div>

                <div class="clothes-desc">
                    <h4>Escape the Grid White Tee</h4>
                    <p class="clothes-price">₦9,000</p>
                    <p class="clothes-detail">
                       
                    </p>
                    <br>

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="clothes-box">
                <div class="clothes-img">
                    <img src="images/BTM.jpg"  class="img-responsive img-curve">
                </div>

                <div class="clothes-desc">
                    <h4>Behind the Mugshot Black Tee</h4>
                    <p class="clothes-price">₦9,000</p>
                    <p class="clothes-detail">
                        
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="clothes-box">
                <div class="clothes-img">
                    <img src="images/GP.jpg"  class="img-responsive img-curve">
                </div>

                <div class="clothes-desc">
                    <h4>Glitched Persona Black Tee</h4>
                    <p class="clothes-price">₦9,000</p>
                    <p class="clothes-detail">
                        
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>
          

            <div class="clothes-box">
                <div class="clothes-img2">
                    <img src="images/WB.jpg"  class="img-responsive img-curve">
                </div>

                <div class="clothes-desc">
                    <h4>Wired Bloom White Tee</h4>
                    <p class="clothes-price">₦9,000</p>
                    <p class="clothes-detail">
                        
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="clothes-box">
                <div class="clothes-img2">
                    <img src="images/LIM.jpg"  class="img-responsive img-curve">
                </div>

                <div class="clothes-desc">
                    <h4>Life in Motion Black Tee</h4>
                    <p class="clothes-price">₦9,000</p>
                    <p class="clothes-detail">
                        
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="clothes-box">
                <div class="clothes-img2">
                    <img src="images/RI.jpg"  class="img-responsive img-curve">
                </div>

                <div class="clothes-desc">
                    <h4>Reinvention Grey Tee</h4>
                    <p class="clothes-price">₦9,000</p>
                    <p class="clothes-detail">
                        
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Clothes</a>
        </p>
    </section>
    <!-- clothes Menu Section Ends Here -->

    <?php include ('partials-front/footer.php');?> 

</body>
</html>