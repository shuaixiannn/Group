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
            <a href="checkout.php" class="header-logo">Order Management - Checkout</a>
        </div>
        
        <!--Back button-->
        <a href="order.php">
        <button type="button">
        <i class='bx bx-arrow-back'></i>
        </button>
        </a>
        
        <div class="container">
        <?php
        // Check if the selected table ID and customer ID are set in the session
        if (isset($_SESSION['selected_table_id']) && isset($_SESSION['customer_id'])) {
            $table_id = $_SESSION['selected_table_id'];
            $customer_id = $_SESSION['customer_id'];

            // Retrieve the order details for the selected table and customer
            $order_sql = "SELECT * FROM orders WHERE table_id = '$table_id' AND cust_id = '$customer_id' ORDER BY order_time DESC LIMIT 1";
            $order_result = $conn->query($order_sql);

            if ($order_result->num_rows > 0) {
                $order_row = $order_result->fetch_assoc();
                // Display order details
                echo "<h2>Order Details</h2>";
                echo "<p><strong>Order ID:</strong> " . $order_row["order_id"] . "</p>";
                echo "<p><strong>Order Date:</strong> " . $order_row["order_time"] . "</p>";
                echo "<p><strong>Customer ID:</strong> " . $order_row["cust_id"] . "</p>";
                echo "<p><strong>Table ID:</strong> " . $order_row["table_id"] . "</p>";

                // You can add more order-related information here as needed

                // Retrieve and display order food details for the order
                $order_id = $order_row["order_id"];
                $order_food_sql = "SELECT * FROM order_food WHERE order_id = '$order_id'";
                $order_food_result = $conn->query($order_food_sql);

                if ($order_food_result->num_rows > 0) {
                    echo "<h3>Order Food Details</h3>";
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th>Menu ID</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Total</th>";
                    echo "</tr>";

                    $totalAmount = 0; // Initialize total amount

                    while ($order_food_row = $order_food_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $order_food_row["menu_id"] . "</td>";
                        echo "<td>" . $order_food_row["quantity"] . "</td>";
                        echo "<td>" . $order_food_row["total"] . "</td>";
                        // You can add more order food-related information here as needed

                        // Calculate total amount by summing up the quantities
                        $totalAmount += $order_food_row["total"];
                        // Store the totalAmount in a session variable
                        $_SESSION['totalAmount'] = $totalAmount;

                        echo "</tr>";
                    }
                    echo "</table>";

                    // Display the total amount
                    echo "<br><p><strong>Total Amount: RM</strong> " . $totalAmount . "</p>";
                } else {
                    echo "<p>No order food items found for this order.</p>";
                }
            } else {
                echo "<p>No order found for the selected table and customer.</p>";
            }
        } else {
            echo "<p>No Order taken!</p>";
        }
        ?>
        <!-- Place Order button -->
        <form action="payment.php"  method="POST">
            <button type="submit">Place Order</button>
        </form>
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
        
table {
    background-color:#fff;
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}

th {
    background-color: #333;
    color: #fff;
}
    </style>
</body>
</html>
