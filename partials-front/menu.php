<?php include('config/constants.php');?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dræs.tɪkWeb</title>
    <link rel="stylesheet" href="css/style.css">

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

        .navbar {
            animation: fadeIn 1s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        .navbar:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.8)), url('images/logo-background.jpg'); /* Replace with your background image */
            background-size: cover;
            background-position: center;
            z-index: -1;
        }

        .logo img {
            opacity: 0.9; /* Adjust the opacity level */
            z-index: 1;
        }

        .menu ul {
            animation: fadeIn 1s ease-in-out;
        }

        .menu li {
            animation: fadeIn 1s ease-in-out;
            animation-delay: 0.2s;
            
        }
        


        /* Add more animations as needed */
    </style>
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>clothes.php">Clothes</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
</body>

</html>
