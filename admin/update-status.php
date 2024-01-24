<?php
ob_start(); // Start output buffering
include('partials/menu.php');
?>

<style>
    body {
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .main-content {
        width: 80%;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .tbl-30 {
        width: 50%;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    input[type="submit"] 
    {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color:lightseagreen;
        color:lightcyan;
    }

    .status-ordered {
        background-color: #2691d9;
        color: white;
    }

    .status-on-delivery {
        background-color: yellow;
        color: #333;
    }

    .status-delivered {
        background-color: lightseagreen;
        color: white;
    }

    .status-cancelled {
        background-color: #ff6b81;
        color: white;
    }
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
        // Check if id is set
        if (isset($_GET['id'])) {
            // Get the order details
            $id = $_GET['id'];

            // SQL query to get order details by id
            $sql = "SELECT * FROM tbl_order WHERE id=$id";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Count rows
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // Details available
                $row = mysqli_fetch_assoc($res);

                $id = $row['id'];
                $clothing = $row['clothing'];
                $price = $row['price'];
                $qty = $row['qty'];
                $size = $row['size'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

                // Display the details
                ?>
                <form action="" method="POST">
                    <table class="tbl-30">
                        <tr>
                            <td>Clothing:</td>
                            <td><?php echo $clothing; ?></td>
                        </tr>
                        <tr>
                            <td>Price:</td>
                            <td><?php echo $price; ?></td>
                        </tr>
                        <tr>
                            <td>Quantity:</td>
                            <td><?php echo $qty; ?></td>
                        </tr>
                        <tr>
                            <td>Size:</td>
                            <td><?php echo $size; ?></td>
                        </tr>
                        <tr>
                            <td>Total:</td>
                            <td><?php echo $total; ?></td>
                        </tr>
                        <tr>
                            <td>Order Date:</td>
                            <td><?php echo $order_date; ?></td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td>
                                <select name="status">
                                    <option value="Ordered" class="status-ordered" <?php if ($status == 'Ordered') echo 'selected'; ?>>Ordered</option>
                                    <option value="On Delivery" class="status-on-delivery" <?php if ($status == 'On Delivery') echo 'selected'; ?>>On Delivery</option>
                                    <option value="Delivered" class="status-delivered" <?php if ($status == 'Delivered') echo 'selected'; ?>>Delivered</option>
                                    <option value="Cancelled" class="status-cancelled" <?php if ($status == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="submit" name="submit" value="Update Status">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
            } else {
                // Details unavailable
                // Redirect to manage order
                header('location:' . SITEURL . 'admin/manage-order.php');
                exit(); // Add exit to stop execution after header redirect
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-order.php');
            exit(); // Add exit to stop execution after header redirect
        }

        // Update Status
        if (isset($_POST['submit'])) {
            $updatedStatus = $_POST['status'];

            // SQL query to update status
            $updateSql = "UPDATE tbl_order SET status='$updatedStatus' WHERE id=$id";

            // Execute the query
            $updateRes = mysqli_query($conn, $updateSql);

            if ($updateRes) {
                // Status updated successfully
                $_SESSION['update'] = "<div class='success'>Order Status Updated Successfully</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
                exit(); // Add exit to stop execution after header redirect
            } else {
                // Failed to update status
                $_SESSION['update'] = "<div class='danger'>Failed to Update Order Status</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
                exit(); // Add exit to stop execution after header redirect
            }
        }

        include('partials/footer.php');
        ob_end_flush(); // Flush the output buffer
        ?>
