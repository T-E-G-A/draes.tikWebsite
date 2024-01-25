

<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br><br>

        <?php 
             if(isset($_SESSION['update']))
             {
               echo $_SESSION['update'];
               unset($_SESSION['update']);
             }
        ?>

        
        
       
        <br><br>

        

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Item</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Size</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
            //get all the orders from DB
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC ";// display latest order first
            //execute query
            $res = mysqli_query($conn,$sql);
            //count the rows
            $count = mysqli_num_rows($res);

            if($count > 0) {
                //order available
                $sn = 1; // Initialize serial number outside the loop
                while($row = mysqli_fetch_assoc($res)) {
                    //get all order details
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

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $clothing; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td><?php echo $size; ?></td>
                        <td><?php echo $total; ?></td>
                        <td><?php echo $order_date; ?></td>

                        <td>
                            <?php 
                                //ordered, on delivery, delivered, cancelled
                                if($status=="Ordered")
                                    {
                                        echo "<label style='color:blue;'>$status</label>";
                                    }
                                elseif($status=="On Delivery")
                                    {
                                        echo "<label style='color:orange;'>$status</label>";
                                    }
                                elseif($status=="Delivered")
                                    {
                                        echo "<label style='color:lightseagreen;'>$status</label>";
                                    }
                                elseif($status=="Cancelled")
                                    {
                                        echo "<label style='color:#ff4757;'>$status</label>";
                                    }
                            
                            ?>
                        </td>

                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-status.php?id=<?php echo $id;?>" class="btn-secondary" style="border-radius:4px;font-size: 22px;" >Update</a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                //order unavailable
            }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php');?>
