<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include('partials-front/menu.php');

if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM tbl_clothes WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location: ' . SITEURL);
        exit();
    }
} else {
    header('location: ' . SITEURL);
    exit();
}

if (isset($_POST['submit'])) {
    $clothing = $title;
    $qty = $_POST['qty'];
    $size = $_POST['size'];

    $total = $price * $qty;
    $order_date = date("Y-m-d H:i:s"); // Use uppercase H for 24-hour format
    $status = "ordered";
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];

    // Use prepared statement to prevent SQL injection
    $sql2 = "INSERT INTO tbl_order (clothing, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address, size) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("sdddsssssss", $clothing, $price, $qty, $total, $order_date, $status, $customer_name, $customer_contact, $customer_email, $customer_address, $size);

    if ($stmt2->execute()) {
        $_SESSION['order'] = "<div class='success text-center'>Order placed successfully.</div>";
        header('location: ' . SITEURL);
        exit();
    } else {
        $_SESSION['order'] = "<div class='danger text-center'>Failed to place order.</div>";
        header('location: ' . SITEURL);
        exit();
    }

    $stmt2->close();
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- Add your CSS links or styles here -->
    <style>
        /* Your existing CSS styles */
        input[type=submit] {
            background-color: #2f3542;
            color: lightcyan;
            cursor: pointer;
            font-family: 'bebas neue', sans-serif;
            transition: background-color 0.3s ease;
        }

        input[type=submit]:hover {
            color: lightcyan;
            background-color: black;
        }
        /* Add any additional styles here */
    </style>
</head>
<body>

<section class="clothes-search">
    <div class="container">
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="#" method="post" class="order">
            <fieldset>
                <legend style="color: lightcyan; font-family:'Bebas Neue', sans-serif;">Selected item</legend>

                <div class="clothes-img">
                    <?php
                    if ($image_name == "") {
                        echo "<div class='danger'>Image not available</div>";
                    } else {
                        echo "<img src='" . SITEURL . "images/clothes/" . $image_name . "' class='img-responsive img-curve' height='" . $maxBoxHeight . "'>";
                    }
                    ?>
                </div>

                <div class="clothes-menu-desc">
                    <h3 style="color: white;" name="clothing"><?php echo $title;?></h3>
                    <p class="clothes-price" style="color: white;">₦<?php echo $price;?></p>

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                    <div class="order-label">Size</div>
                    <select name="size">
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                </div>
            </fieldset>

            <fieldset>
                <legend style="color: lightcyan; font-family: 'Bebas Neue', sans-serif;">Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. John Doe" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 08043xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. JD@JohnDoe.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order">
            </fieldset>
        </form>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
</body>
</html>
