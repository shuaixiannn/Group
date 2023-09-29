<! -- Christian -- >
<?php
// Include your database connection code here
include 'db.php';


// Retrieve form data
$name = $_POST['name'];
$contact = $_POST['contact'];
$reservation_date = $_POST['reservation_date'];
$reservation_time = $_POST['reservation_time'];
$table_id = $_POST['table_id'];

// Insert the new reservation into the database
$sql = "INSERT INTO reservations (name, contact, reservation_date, reservation_time, table_id) 
        VALUES ('$name', '$contact', '$reservation_date', '$reservation_time', '$table_id')";

if ($conn->query($sql) === TRUE) {
    header("Location: reservation.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
