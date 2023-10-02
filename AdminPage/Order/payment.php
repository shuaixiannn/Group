<!--Christian-->
<?php
require_once("../db.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <section class="home-section">
        <div class="header">
            <a href="payment.php" class="header-logo">Order Management - Payment</a>
        </div>
        
        <!--Back button-->
        <a href="checkout.php">
        <button type="button">
        <i class='bx bx-arrow-back'></i>
        </button>
        </a>
        
        <div class="container">
            <h2>Select payment method</h2>
            <a href="cash.php"><button style="border-radius: 5px;">Cash</button></a>
            <a href="next_cust.php.php"><button style="border-radius: 5px;">Card</button></a>
            <a href="e-wallet.php"><button style="border-radius: 5px;">E-wallet</button></a>
        
        </div>
    </section>
<style>
button {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 0px; /* Rounded corners for the button */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}
button:hover {
    background-color: #555;
}
.container {
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 700px;
    margin: 0 auto;
    background-color: #f7f7f7;
    border-radius: 5px; 
}
</style>
</body>
</html>
