<!--Christian-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reservations</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <section class="home-section">
        <div class="header">
            <a href="reservation.php" class="header-logo">Reservations Management - Edit Reservation</a>
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
            // Display reservation details in a form for editing
            echo "<form action='update_process.php' method='POST'>";
            echo "Name: <input type='text' name='name' value='" . $row["name"] . "'><br>";
            echo "Contact: <input type='tel' name='contact' value='" . $row["contact"] . "'><br>";
            echo "Reservation Date: <input type='date' name='reservation_date' value='" . $row["reservation_date"] . "'><br>";
            
            echo "Reservation Time: <select name='reservation_time' required>";
            echo "<option value='06:00'>6:00 PM</option>";
            echo "<option value='07:00'>7:00 PM</option>";
            echo "<option value='08:00'>8:00 PM</option>";
            echo "<option value='09:00'>9:00 PM</option>";
            echo "<option value='10:00'>10:00 PM</option>";
            echo "<option value='11:00'>11:00 PM</option>";
            echo "<option value='12:00'>12:00 PM</option>";
            echo "</select><br>";
            
            // Add the dropdown for Table ID
            echo "Table ID: <select name='table_id' required>";
            // Retrieve available tables from the 'tables' table
            $query = "SELECT table_id, name, capacity FROM tables WHERE table_status = 'Available'";
            $tableResult = $conn->query($query);
            while ($tableRow = $tableResult->fetch_assoc()) {
                $tableId = $tableRow['table_id'];
                $tableName = $tableRow['name'];
                $tableCapacity = $tableRow['capacity'];
                $selected = ($tableId == $row["table_id"]) ? "selected" : "";
                echo "<option value='$tableId' $selected>$tableName (Capacity: $tableCapacity)</option>";
            }
            echo "</select><br><br>";
            
            echo "<input type='hidden' name='reservation_id' value='" . $row["id"] . "'>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";
        } else {
            echo "Reservation not found";
        }

        $conn->close();
        ?>
    </section>
<style>
/* Updated form styling */
form {
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 1000px;
    margin: 0 auto;
    background-color: #f7f7f7;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="tel"],
input[type="date"],
textarea,
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc; /* Added a border for better visibility */
    border-radius: 3px; /* Rounded corners for input fields */
}

/* Updated button styling */
input[type="submit"],
textarea{
    background-color: #333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 3px; /* Rounded corners for the button */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

input[type="submit"]:hover,
textarea:hover{
    background-color: #555;
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
