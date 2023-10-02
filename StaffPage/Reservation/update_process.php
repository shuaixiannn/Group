<!--Christian-->
<?php
// Include your database connection code here
include '../db.php';

// Retrieve form data
$reservation_id = $_POST['reservation_id'];
$name = $_POST['name'];
$contact = $_POST['contact'];
$reservation_date = $_POST['reservation_date'];
$reservation_time = $_POST['reservation_time'];
$table_id = $_POST['table_id'];

// Update the reservation in the database
$sql = "UPDATE reservations SET name = '$name', contact = '$contact', reservation_date = '$reservation_date', reservation_time = '$reservation_time', table_id = '$table_id' WHERE id = '$reservation_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: reservation.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

