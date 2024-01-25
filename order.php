<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include('partials-front/menu.php');

if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id'];

    $sql = "SELECT * FROM tbl_clothes WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $stmt->close();

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $id = $row['id'];
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
    $id = $_POST['id'];
    $clothing = $title;
    $qty = $_POST['qty'];
    $size = $_POST['size'];
    $total = $price * $qty;
    $order_date = date("Y-m-d H:i:s");
    $status = "ordered";
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];

    $sql2 = "INSERT INTO tbl_order (clothing, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address, size) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("sdddsssssss", $clothing, $price, $qty, $total, $order_date, $status, $customer_name, $customer_contact, $customer_email, $customer_address, $size);

    if ($stmt2->execute()) {
        // Fetch the last inserted ID
        $lastInsertedId = $stmt2->insert_id;

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'dragseddie@gmail.com';
            $mail->Password   = 'tvtgpfgmmttrbkwl';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->setFrom('dragsddie@gmail.com', 'dræs.tɪk');
            $mail->addAddress($customer_email);

            $mail->isHTML(true);
            $mail->Subject = "Order Confirmation - dræs.tɪk";
            $mail->Body = "
                <div style='background-color: #f8f8f8; padding: 20px; font-family: 'Arial', sans-serif;'>
                    <div style='max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 8px;'>
                        <h2 style='text-align: center; color: #333;'>Order Confirmation</h2>

                        <div style='border-top: 1px solid #ddd; padding-top: 20px; margin-top: 20px;'>
                            <h3 style='color: #28a745; font-weight: bold; text-align: center;'>Order Placed Successfully</h3>

                            <p>Clothing: $clothing</p>
                            <p>Quantity: $qty</p>
                            <p>Size: $size</p>
                            <p>Total Price: ₦$total</p>

                            <br>

                            <p>Name: $customer_name</p>
                            <p>Contact: $customer_contact</p>
                            <p>Email: $customer_email</p>
                            <p>Address: $customer_address</p>
                            <p>Order ID: $lastInsertedId</p>
                        </div>

                        <p style='text-align: center; margin-top: 20px;'>
                            <a href='" . SITEURL . "' style='background-color: #f8f9fa; color: #333; border: 1px solid #ccc; padding: 10px 20px; font-size: 16px; text-decoration: none; border-radius: 4px; transition: background-color 0.3s ease; display: inline-block;'>
                                Back to Home
                            </a>
                        </p>
                    </div>
                </div>
            ";

            $mail->send();
            $_SESSION['order'] = "<div class='success text-center'>Order placed successfully. Confirmation email sent.</div>";
            header('location: ' . SITEURL);
            exit();
        } catch (Exception $e) {
            error_log("Error sending mail: " . $mail->ErrorInfo);
            $_SESSION['order'] = "<div class='danger text-center'>Failed to place order.</div>";
            header('location: ' . SITEURL);
            exit();
        }
    }

    $stmt2->close();
}
?>

<!-- The rest of your HTML code remains unchanged -->



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
                
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Confirm Order">
                
            </fieldset>
        </form>
    </div>
</section>

<?php include('partials-front/footer.php'); ?>
</body>
</html>
