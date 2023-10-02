<!--Christian-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reservation Details</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <section class="home-section">
        <div class="header">
            <a href="reservation.php" class="header-logo">Reservations Management - Reservation Details</a>
        </div>
        
        <a href="reservation.php">
            <button type="button">
            <i class='bx bx-arrow-back'></i>
            </button>
        </a>
        
        <?php
        // Include your database connection code here
        include '../db.php';

        $reservation_id = $_GET['id'];

        // Retrieve reservation details
        $sql = "SELECT * FROM reservations WHERE id = '$reservation_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display reservation details
            echo "<form><p><strong>Reservation ID:</strong> " . $row["id"] . "</p><br>";
            echo "<p><strong>Name:</strong> " . $row["name"] . "</p><br>";
            echo "<p><strong>Contact:</strong> " . $row["contact"] . "</p><br>";
            echo "<p><strong>Reservation Date:</strong> " . $row["reservation_date"] . "</p><br>";
            echo "<p><strong>Reservation Time:</strong> " . $row["reservation_time"] . "</p><br>";
            echo "<p><strong>Table ID:</strong> " . $row["table_id"] . "</p></from>";
        } else {
            echo "Reservation not found";
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
        /* Updated button styling */
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
