<?php include('partials-front/menu.php'); ?>

<style>
    /* Your existing styles here */
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Track Order</h1>
        <br><br>

        <?php
        if (isset($_GET['order_id']) && isset($_GET['email']) && isset($_GET['contact'])) {
            $order_id = mysqli_real_escape_string($conn, $_GET['order_id']);
            $email = mysqli_real_escape_string($conn, $_GET['email']);
            $contact = mysqli_real_escape_string($conn, $_GET['contact']);

            // Check if the provided details match the records in the database
            $sql = "SELECT * FROM tbl_order WHERE id = $order_id AND customer_email = '$email' AND customer_contact = '$contact'";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    // Display order details
                    $row = mysqli_fetch_assoc($res);
                    // Display order details as needed

                    // Redirect to the order-view page
                    header('location: ' . SITEURL . 'order-view.php?id=' . $order_id);
                    exit(); // Make sure to exit after the header redirect

                } else {
                    // Invalid details, display an error message
                    echo "<p class='danger text-center'>Invalid or mismatched order details. Please check your input.</p>";
                }
            } else {
                // Query execution failed, display an error message
                echo "<p class='danger text-center'>Failed to execute the query.</p>";
            }
        } elseif (!isset($_GET['error'])) {
            // Missing details, display an error message
            echo "<p class='danger text-center'>Please enter valid order details to track your order.</p>";
        }
        ?>

        <form action="<?php echo SITEURL; ?>track-order.php" method="GET" class="order-form">
            <label for="order_id">Order ID:</label>
            <input type="text" id="order_id" name="order_id" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br><br>
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" required>
            <br><br>
            <input type="submit" value="Track Order" class="btn-secondary">
        </form>
    </div>
</div>

<?php include('partials-front/footer.php'); ?>
