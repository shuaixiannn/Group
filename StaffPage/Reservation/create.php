<!--Christian-->
<!DOCTYPE html>
<html>
<head>
    <title>Reservation</title>
</head>
<body>
    
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Reservation</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <section class="home-section">
        <div class="header">
            <a href="reservation.php" class="header-logo">Reservation Management - Create Reservation</a>
        </div>
        
        <a href="reservation.php">
            <button type="button">
                <i class='bx bx-arrow-back'></i>
            </button>
        </a>
        <?php
        include '../db.php';
        
        // Retrieve available tables from the 'tables' table
        $query = "SELECT table_id, name, capacity FROM tables WHERE table_status = 'Available'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Database query failed.");
        }
        ?>
        
        <form action="create_process.php" method="POST">
            <!-- Input fields for reservation details -->
            <!-- Updated form fields based on the reservation schema -->
            Name: <input type="text" name="name" required><br>
            Contact: <input type="tel" name="contact" required><br>
            Reservation Date: <input type="date" name="reservation_date" required><br>

            <!-- Dropdown for Reservation Time -->
            Reservation Time:
            <select name="reservation_time" required>
                <option value="06:00">6:00 PM</option>
                <option value="07:00">7:00 PM</option>
                <option value="08:00">8:00 PM</option>
                <option value="09:00">9:00 PM</option>
                <option value="10:00">10:00 PM</option>
                <option value="11:00">11:00 PM</option>
                <option value="12:00">12:00 PM</option>
                <!-- Add more options for available times as needed -->
            </select><br><br>

            <!-- Dropdown for Table Number -->
            Table Number:
            <select name="table_id" required>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $table_id = $row['table_id'];
                    $table_name = $row['name'];
                    $table_capacity = $row['capacity'];
                    echo "<option value='{$table_id}'>{$table_name} (Capacity: {$table_capacity})</option>";
                }
                ?>
            </select><br>
            
            <!--Report PDF-->
            <br>
            <a href="../Report/reservation-pdf.php?id=<?php echo $id; ?>">
                  <input type="submit" value="Create">
            </a>
        </form>
        <?php
        // Don't forget to close the database connection
        mysqli_close($conn);
        ?>
    </section>
    <style>
        /* Updated form styling */
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
input[type="time"],
textarea {
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

input[type="submit"]:hover {
    background-color: #555;
}

/* Style for select dropdown */
select {
    appearance: none; /* Remove default arrow in some browsers */
    background-color: #fff; /* Background color for the select box */
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 3px;
    cursor: pointer;
}

/* Style for select options */
select option {
    background-color: #fff; /* Background color for options */
    color: #333; /* Text color for options */
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