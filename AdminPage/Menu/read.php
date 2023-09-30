<! -- Christian -- >
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <section class="home-section">
    <div class="header">
        <a href="menu.php" class="header-logo">Menu Management - Menu Details</a>
    </div>
        
    <a href="menu.php">
        <button type="button">
        <i class='bx bx-arrow-back'></i>
        </button>
    </a>
        
    <?php
    // Include your database connection code here
    include '../db.php';

    $menu_id = $_GET['id'];

    // Retrieve customer details
    $sql = "SELECT * FROM menu WHERE menu_id = '$menu_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display customer details
        echo "<form><p><strong>Menu ID:</strong> " . $row["menu_id"] . "</p><br>";
        echo "<p><strong>Menu Name:</strong> " . $row["menu_name"] . "</p><br>";
        echo "<p><strong>Description:</strong> " . $row["menu_desc"] . "</p><br>";
        echo "<p><strong>Price:</strong> " . "RM " . $row["menu_price"] . "</p><br>";
        echo "<p><strong>Category:</strong> " . $row["category"] . "</p><br>";
        echo "<p><strong>Status:</strong> " . $row["menu_status"] . "</p></form>";
    } else {
        echo "Menu not found";
    }

    $conn->close();
    ?>
    </section>
    <style>
form {
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 700px;
    margin: 0 auto;
    background-color: #f7f7f7;
    border-radius: 5px; 
}
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
    </style>
</body>
</html>
