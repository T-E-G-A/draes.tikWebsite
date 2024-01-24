<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dræs.tɪkWeb</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css">
</head>

<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="<?php echo SITEURL; ?>images/logo.png" class="img-responsive2">
                </a>
            </div>

            <div  class="menu text-right">
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
