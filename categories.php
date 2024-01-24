<?php
include('partials-front/menu.php');

class CategoriesPage
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

<<<<<<< HEAD
    /* Apply fadeIn animation to the specified elements */
    .clothes-search,
    .categories {
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
   #categories-section{
       animation: fadeIn 1s ease-in-out;
       position: relative;
       overflow: hidden;
   }

   #search-section form {
       animation: fadeIn 1s ease-in-out;
       animation-delay: 0.2s; /* Adjust this delay as needed */
   }

   
</style>



<!-- clothes SEARCH Section Starts Here -->
<section class="clothes-search text-center" id="search-section">
   <div class="container">
       <form action="<?php echo SITEURL; ?>clothes-search.php" method="POST">
           <input type="search" name="search" placeholder="Search for items..." style="font-family:'Teko', sans-serif" required>
           <input type="submit" name="submit" value="Search" style="font-family:'Teko', sans-serif" class="btn btn-tertiary">
       </form>
   </div>
</section>
<!-- clothes SEARCH Section Ends Here -->

<!-- Categories Section Starts Here -->
<section class="categories">
    <div class="container" >
        <h2 class="text-center">Explore All Our Options</h2>

        <?php
            //create sql query to display categories from db
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count rows to check if category is available
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //categories available
                $animationDelay = 0.2; // Initial delay for the fadeIn animation

                while ($row = mysqli_fetch_assoc($res)) {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="<?php echo SITEURL; ?>category-clothes.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container" style="animation-delay: <?php echo $animationDelay; ?>;" >
                            <?php
                                //check if the image is available 
                                if ($image_name == "") {
                                    //display message
                                    echo "<div class='danger'>image not available</div>";
                                } else {
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve"  >
                                    <?php
                                }
                            ?>

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>

                    <?php
                    $animationDelay += 0.2; // Increment delay for each subsequent element
=======
    public function displayCategories()
    {
        $this->printStyles();
        $this->printSearchSection();
        $this->printCategoriesSection();
        
        include('partials-front/footer.php');
        echo '</body></html>';
    }

    private function printStyles()
    {
        echo '
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
>>>>>>> ddbc7e0a58578553a2283eecf16086b706d83b59
                }
            }

            /* Apply fadeIn animation to the specified elements */
            .clothes-search,
            .categories {
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
        </style>';
    }

    private function printSearchSection()
    {
        echo '
        <section class="clothes-search text-center" id="search-section">
            <div class="container">
                <form action="clothes-search.html" method="POST">
                    <input type="search" name="search" placeholder="Search for items..." style="font-family:\'Teko\', sans-serif" required>
                    <input type="submit" name="submit" value="Search" style="font-family:\'Teko\', sans-serif" class="btn btn-tertiary">
                </form>
            </div>
        </section>';
    }

    private function printCategoriesSection()
    {
        echo '
        <section class="categories">
            <div class="container" id="categories-section">
                <h2 class="text-center">Explore All Our Options</h2>';

        // create sql query to display categories from db
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
        // execute the query
        $res = mysqli_query($this->conn, $sql);
        // count rows to check if category is available
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            // categories available
            $animationDelay = 0.2; // Initial delay for the fadeIn animation

            while ($row = mysqli_fetch_assoc($res)) {
                $this->printCategory($row, $animationDelay);
                $animationDelay += 0.2; // Increment delay for each subsequent element
            }
        } else {
            // categories not available
            echo "<div class= 'danger'>Category not added</div>";
        }

        echo '<div class="clearfix"></div>
            </div>
        </section>';
    }

    private function printCategory($row, $animationDelay)
    {
        $id = $row['id'];
        $title = $row['title'];
        $image_name = $row['image_name'];

        echo '
        <a href="category-clothes.html">
            <div class="box-3 float-container" style="animation-delay: ' . $animationDelay . 's;" >';

        if ($image_name == "") {
            echo "<div class='danger'>image not available</div>";
        } else {
            echo '<img src="' . SITEURL . 'images/category/' . $image_name . '" class="img-responsive img-curve" width="100px" height="350px" >';
        }

        echo '<h3 class="float-text text-white">' . $title . '</h3>
            </div>
        </a>';
    }
}

$categoriesPage = new CategoriesPage($conn);
$categoriesPage->displayCategories();
?>
