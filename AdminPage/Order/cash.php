<!--Christian-->
<?php
require_once("../db.php");
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerPayment = isset($_POST['payment']) ? floatval($_POST['payment']) : 0;
    $totalAmount = isset($_SESSION['totalAmount']) ? floatval($_SESSION['totalAmount']) : 0;

    if ($customerPayment >= $totalAmount) {
        $change = $customerPayment - $totalAmount;
        $changeMessage = "<strong>Change: RM " . number_format($change, 2)."</strong>";
    } else {
        $changeMessage = "Cash is not enough. Please provide sufficient payment.";
    }
}
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
            <a href="cash.php" class="header-logo">Order Management - Cash</a>
        </div>
        
        <!--Back button-->
        <a href="payment.php">
        <button type="button">
        <i class='bx bx-arrow-back'></i>
        </button>
        </a>
        
        <div class="container">
            <?php
            $totalAmount = isset($_SESSION['totalAmount']) ? $_SESSION['totalAmount'] : 0;
            // Display the totalAmount
            echo "<p><strong>Total Amount: RM " . $totalAmount . "</strong></p>";
            ?>
            <!-- Payment form -->
            <form method="POST">
                <div class="form-group">
                    <label for="payment"><strong>Enter Payment Amount (RM):</strong></label>
                    <input type="number" step="0.01" min="0" class="form-control" id="payment" name="payment" required>
                </div>
                <button type="submit" class="btn btn-primary">Pay</button>
            </form>

            <!-- Display change or error message -->
            <?php if (isset($changeMessage)): ?>
                <div class="mt-3">
                    <?php echo $changeMessage; ?>
                </div>
            <?php endif; ?>
            
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
    </style>
</body>
</html>
