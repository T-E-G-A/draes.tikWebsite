<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dræs.tɪkWeb</title>
    <link rel="stylesheet" href="css/style.css">

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

        #navbar-container {
            animation: fadeIn 1s ease-in-out;
            position: relative;
            overflow: hidden;
        }

        #navbar:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.8)), url('images/logo-background.jpg');
            background-size: cover;
            background-position: center;
            z-index: -1;
        }

        body {
            margin: 0;
            font-family: 'Arial', sans-serif; /* Change to your preferred font */
        }

        #navbar-container .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            box-sizing: border-box;
        }

        #navbar-logo a {
            text-decoration: none;
        }

        #navbar-logo img {
            max-width: 80%;
            height: auto;
            opacity: 0.9;
            display: block; /* Ensures proper sizing */
            margin: 0; /* Reset margin */
            margin-right: auto; /* Move the logo to the left */
            margin-left: -10px; /* Add some left margin if needed */
           
        }

        #navbar-menu ul {
            animation: fadeIn 1s ease-in-out;
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: flex-end;
        }

        #navbar-menu li {
            animation: fadeIn 1s ease-in-out;
            animation-delay: 0.2s;
            margin: 0 15px;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            #navbar-menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px; /* Adjust as needed */
                left: 0;
                width: 100%;
                background-color: #fff; /* Adjust as needed */
            }

            #navbar-menu.active {
                display: flex;
            }

            #navbar-menu li {
                margin: 10px 0;
            }

            #navbar-container {
                height: 60px; /* Adjust as needed */
            }
        }
    </style>
</head>

<body>
    <section id="navbar-container">
        <div class="container">
            <div id="navbar-logo">
            
                <a href="#" title="Logo">
                <img src="images/logo.png" class="img-responsive">
                </a>
            </div>

            <div id="navbar-menu" class="text-right">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>categories.php">Categories</a></li>
                    <li><a href="<?php echo SITEURL; ?>clothes.php">Pieces</a></li>
                    <li><a href="<?php echo SITEURL; ?>contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </section>
</body>

</html>
