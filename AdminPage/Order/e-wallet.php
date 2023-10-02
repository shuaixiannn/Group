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
            <a href="e-wallet.php" class="header-logo">Order Management - E-wallet</a>
        </div>
        
        <!--Back button-->
        <a href="payment.php">
        <button type="button">
        <i class='bx bx-arrow-back'></i>
        </button>
        </a>
        
        <div class="container">
            <img src="E-wallet QR.png" alt=""/>
            
            <?php
            $totalAmount = isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : 0;
            // Display the totalAmount
            echo "<p><strong>Total Amount: RM " . $totalAmount . "</strong></p>";
            ?>
            
            <a href="next_cust.php"><button style="border-radius: 10px;"type="submit">Done</button></a>
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
.container img{
  display: block;
  margin: auto;
  width: 50%;
}
    </style>
</body>
</html>
