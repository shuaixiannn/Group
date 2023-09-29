<! -- Christian -- >
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Staff</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    <?php
    include '../sidebar.php';
    ?>
    
    <section class="home-section">
    <div class="header">
        <a href="staff.php" class="header-logo">Staff Management - Staff Details</a>
    </div>
        
    <a href="staff.php">
        <button type="button">
        <i class='bx bx-arrow-back'></i>
        </button>
    </a>
        
    <?php
    include '../db.php';
    $staff_id = $_GET['id'];

    // Retrieve staff details
    $sql = "SELECT * FROM staff WHERE staff_id = '$staff_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display staff details
        echo "<form><p><strong>Staff ID:</strong> " . $row["staff_id"] . "</p><br>";
        echo "<p><strong>Name:</strong> " . $row["staff_name"] . "</p><br>";
        echo "<p><strong>Email:</strong> " . $row["staff_email"] . "</p><br>";
        echo "<p><strong>Contact Number:</strong> " . $row["staff_contact"] . "</p><br>";
        echo "<p><strong>Position :</strong> " . $row["position"] . "</p><br>";
        echo "<p><strong>Hire Date&Time:</strong> " . $row["staff_hiredate"] . "</p><br>";
        echo "<p><strong>Status:</strong> " . $row["status"] . "</p></form>";
    } else {
        echo "Staff not found";
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
