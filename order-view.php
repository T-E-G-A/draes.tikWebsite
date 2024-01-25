<?php include('partials-front/menu.php'); ?>

<style>
    /* Your existing styles here */
</style>

<div class="main-content">
    <div class="wrapper">
        <h1>Order Details</h1>
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
            </tr>

            <?php
            // Check if the order ID is set in the URL
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $order_id = $_GET['id'];

                // SQL query to retrieve the specific order
                $sql = "SELECT * FROM tbl_order WHERE id = $order_id";

                // Execute the query
                $res = mysqli_query($conn, $sql);

                // Check if the query executed successfully
                if ($res) {
                    // Fetch and display the order details
                    $row = mysqli_fetch_assoc($res);

                    // Check if $row is not null
                    if ($row) {
                        $sn = 1;
                        $id = isset($row['id']) ? $row['id'] : '';
                        $clothing = isset($row['clothing']) ? $row['clothing'] : '';
                        $price = isset($row['price']) ? $row['price'] : '';
                        $qty = isset($row['qty']) ? $row['qty'] : '';
                        $size = isset($row['size']) ? $row['size'] : '';
                        $total = isset($row['total']) ? $row['total'] : '';
                        $order_date = isset($row['order_date']) ? $row['order_date'] : '';
                        $status = isset($row['status']) ? $row['status'] : '';
                        $customer_name = isset($row['customer_name']) ? $row['customer_name'] : '';
                        $customer_contact = isset($row['customer_contact']) ? $row['customer_contact'] : '';
                        $customer_email = isset($row['customer_email']) ? $row['customer_email'] : '';
                        $customer_address = isset($row['customer_address']) ? $row['customer_address'] : '';

                        // Display the order in a table row
                        ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $clothing; ?></td>
                            <td><?php echo $price; ?></td>
                            <td><?php echo $qty; ?></td>
                            <td><?php echo $size; ?></td>
                            <td><?php echo $total; ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td><?php echo $status; ?></td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                        </tr>
                        <?php
                    } else {
                        // $row is null
                        echo "<tr><td colspan='13' class='danger text-center'>Failed to fetch order details.</td></tr>";
                    }
                } else {
                    // Query failed
                    echo "<tr><td colspan='13' class='danger text-center'>Failed to execute the query.</td></tr>";
                }
            } else {
                // Order ID not set or invalid
                echo "<tr><td colspan='13' class='danger text-center'>Invalid or missing order ID.</td></tr>";
            }
            ?>

        </table>
    </div>
</div>
<style>
    
@import url('https://fonts.cdnfonts.com/css/american-captain-2');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap');


*{
    margin: 0;
    padding: 0;
    font-family:'Bebas neue', sans-serif ;
}

.wrapper{
    
    padding: 1%;
    width: 80%;
    margin: 0 auto;
}
.text-center{
    text-align: center;
}
.clearfix{
    float: none;
    clear: both;
}
.tbl-full{
    width: 100%;
}

.tbl-30{
    width: 30%;
}

table tr th{
    border-bottom: 1px solid black;
    padding: 1%;
    text-align: left;
}

table tr td{
    padding: 1%;
}

.btn-primary {
  background-color: #2f3542;
  padding: 1%;
  color: lightcyan;
  text-decoration: none;
  transition: background-color 0.3s ease; 
}

.btn-primary:hover {
  background-color: black;
}


.btn-secondary{
    background-color:  lightseagreen;
    padding: 1%;
    color: lightcyan;
    text-decoration: none;
    transition: background-color 0.3s ease;    
}

.btn-secondary:hover{
    background-color: teal;
}

.btn-tertiary{
    background-color: #ff6b81 ;
    padding: 1%;
    color: lightcyan;
    text-decoration: none;
    transition: background-color 0.3s ease; 

    
}

.btn-tertiary:hover{
    background-color:#ff4757;
}

.success{
    color: lightseagreen;
}

.danger{
    color: #ff6b81;
}

/* CSS for Menu */
.menu{
    border-bottom: 1px solid grey;
}

.menu ul{
    list-style: none;

}
.menu ul li{
    display: inline;
    padding: 1%;

}

.menu ul li a{
    text-decoration: none;
    font-weight:  bold;
    color:  #2f3542;
}

.menu ul li a:hover{
    color: black;
}
/*css for main-content*/

.main-content{
    background-color:white;
    padding: 3%;
}
.col-4{
    width: 18%;
    background-color: white;
    margin: 1%;
    padding: 2%;
    float: left;
}

/* CSS for Footer */
.footer{
    background-color: #2f3542;
    color: lightcyan;
}
/*css for login*/


.center{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 400px;
    background: white;
    border-radius: 10px;
    box-shadow: 10px 10px 15px rgba(0,0,0,0.05);
  }
  .center h1{
    text-align: center;
    padding: 20px 0;
    border-bottom: 1px solid silver;
  }
  .center form{
    padding: 0 40px;
    box-sizing: border-box;
  }
  form .txt_field{
    position: relative;
    border-bottom: 2px solid #adadad;
    margin: 30px 0;
  }
  .txt_field input{
    width: 100%;
    padding: 0 5px;
    height: 40px;
    font-size: 16px;
    border: none;
    background: none;
    outline: none;
  }
  .txt_field label{
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    font-size: 16px;
    pointer-events: none;
    transition: .5s;
  }
  .txt_field span::before{
    content: '';
    position: absolute;
    top: 40px;
    left: 0;
    width: 0%;
    height: 2px;
    background: #2691d9;
    transition: .5s;
  }
  .txt_field input:focus ~ label,
  .txt_field input:valid ~ label{
    top: -5px;
    color: #2691d9;
  }
  .txt_field input:focus ~ span::before,
  .txt_field input:valid ~ span::before{
    width: 100%;
  }
  
  .pass{
    margin: -5px 0 20px 5px;
    color: #a6a6a6;
    cursor: pointer;
  }
  .pass:hover{
    text-decoration: underline;
  }
  .btn-LP{
    width: 100%;
    height: 50px;
    border: 1px solid;
    background:  black;
    border-radius: 25px;
    font-size: 18px;
    color:  white ;
    font-weight: 700;
    cursor: pointer;
    outline: none;
  }
  .btn-LP:hover{
    border-color: #2691d9;
    transition: .5s;
  }
  .author_link{
    margin: 30px 0;
    text-align: center;
    font-size: 16px;
    color: #666666;
  }
  .author_link a{
    color: #66c2ff;
    text-decoration: none;
  }
  .author_link a:hover{
    transition: color 0.3s ease;
    color:#2691d9; 
  }

</style>

<?php include ('partials-front/footer.php');?>
