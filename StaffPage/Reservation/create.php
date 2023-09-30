<! -- Christian -- >
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
        
        <form action="create_process.php" method="POST">
            <!-- Input fields for reservation details -->
            <!-- Updated form fields based on the reservation schema -->
            Name: <input type="text" name="name" required><br>
            Contact: <input type="text" name="contact" required><br>
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
            </select><br>

            Table Number: <input type="number" name="table_id" required><br>
            <input type="submit" value="Create">
        </form>
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
input[type="number"],
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
