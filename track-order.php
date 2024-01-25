<?php include('partials-front/menu.php'); ?>

<div class="center">
    <h1>Track Order</h1>

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
    } 
    ?>

    <form action="<?php echo SITEURL; ?>track-order.php" method="GET" class="order-form">
        <div class="txt_field">
            <input type="text" id="order_id" name="order_id" required>
            <label for="order_id">Order ID</label>
            <span></span>
        </div>

        <div class="txt_field">
            <input type="email" id="email" name="email" required>
            <label for="email">Email</label>
            <span></span>
        </div>

        <div class="txt_field">
            <input type="text" id="contact" name="contact" required>
            <label for="contact">Contact</label>
            <span></span>
        </div>

        <input type="submit" value="Track Order" class="btn-LP">
    </form>
</div>
<style>



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
 
  @media only screen and (max-width: 768px) {
    .center {
        width: 80%; /* Adjusted width for medium screens */
    }
}

@media only screen and (max-width: 480px) {
    .center {
        width: 100%; /* Full width for smaller screens */
    }
    .center form {
        padding: 0 10px; /* Adjusted padding for smaller screens */
    }
}

</style>



