<?php include ('partials-front/menu.php');?> 

<!-- clothes sEARCH Section Starts Here -->
<section class="clothes-search text-center">
    <div class="container">
        <?php
            //get the search keyword
            $search = mysqli_real_escape_string($conn,$_POST['search']);
        ?>
        <h2 style="color:lightcyan;">Items on Your Search <a href="#" class="search-link text-white">"<?php echo $search;?>"</a></h2>
    </div>
</section>
<!-- clothes sEARCH Section Ends Here -->

<!-- Style the search link -->
<style>
    .search-link {
        text-decoration: none;
        font-weight: bold;
        color: #66c2ff;
        
    }

    .search-link:hover {
        text-decoration: none; 
        color: #2691d9;

    }
</style>
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
    .clothes-menu {
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
   #clothes-menu-section {
       animation: fadeIn 1s ease-in-out;
       position: relative;
       overflow: hidden;
   }

   

 
</style>


<!-- clothes MEnu Section Starts Here -->
<section class="clothes-menu">
    <div class="container">
        <h2 class="text-center">Results</h2>

        <?php
            // Check if the search key is set in the $_POST array
            if(isset($_POST['search'])){
               

                //sql query to get clothes based on search keyword
                
                $sql = "SELECT * FROM tbl_clothes WHERE title LIKE '%$search%' OR description like '%$search%'";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether clothes available or not
                if($count > 0) {
                    //clothes available
                    while($row = mysqli_fetch_assoc($res)) {
                        //get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

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
                    //clothes not available
                    echo "<div class='danger text-center'>No Items matched your search</div>";
                }
            }
            else 
            {
                // Search key is not set
                echo "<div class='danger'>Please enter a search term</div>";
            }
        ?>

        <div class="clearfix"></div>

    </div>
</section>
<!-- clothes Menu Section Ends Here -->

<?php include ('partials-front/footer.php');?> 

</body>
</html>
