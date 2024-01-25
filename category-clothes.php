<?php include ('partials-front/menu.php');?> 

<?php
    //check if id is passed
    if(isset($_GET['category_id']))
    {
        //category id is set and get id
        $category_id = $_GET['category_id'];
        //get category title based on category id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //execute the query
        $res = mysqli_query($conn,$sql);

        //get the value from db
        $row = mysqli_fetch_assoc($res);
        //get the title
        $category_title = $row['title'];
    }
    else
    {
        //category not passed
        //redirect to home page
        header('location:'.SITEURL);
    }
?>

<style>
    .cat-link {
        text-decoration: none;
        font-weight: bold;
        color: #66c2ff;
        
    }

    .cat-link:hover {
        text-decoration: none; 
        color: #2691d9;

    }
</style>
    <!-- clothes sEARCH Section Starts Here -->
    <section class="clothes-search text-center">
        <div class="container">
            
            <h2 style="color:lightcyan;">Items in <a href="#" class="cat-link"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- clothes sEARCH Section Ends Here -->



    <!-- clothes MEnu Section Starts Here -->
    <section class="clothes-menu">
        <div class="container">
            <h2 class="text-center"> Results</h2>

            <?php
                //create sql query to get items based on selected category
                $sql2 = " SELECT * FROM tbl_clothes where category_id=$category_id";

                //execute the query
                $res2 = mysqli_query($conn,$sql2);

                //count rows
                $count2=mysqli_num_rows($res2);

                //check if item is available
                if($count2>0)
                {
                    //item is available
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        //get the details
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        <div class="clothes-box" >
                            <div class="clothes-img">
                                <?php
                                    //check if the image is available 
                                    if($image_name == "") {
                                        //display message
                                        echo "<div class='danger'>image not available</div>";
                                    } else {
                                        //image available
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/clothes/<?php echo $image_name;?>" class="img-responsive img-curve"   >
                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="clothes-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="clothes-price" style="font-family:'Teko', sans-serif">₦<?php echo $price;?></p>
                                <br>
                                <a href="<?php echo SITEURL; ?>order.php?item_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //item not available
                    echo "<div class='danger text-center'> No items available</div>";
                }
            ?>

           

           



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- clothes Menu Section Ends Here -->

    <?php include ('partials-front/footer.php');?> 

</body>
</html>