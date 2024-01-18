<?php include ('partials-front/menu.php');?> 



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
            <h2 class="text-center">Explore All Our Options</h2>

            <?php
                //create sql query to display categories from db
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";
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


<?php include ('partials-front/footer.php');?> 


</body>
</html>