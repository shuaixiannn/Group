<!--Christian-->
<?php
// Include your database connection code here
include '../db.php';

$reservation_id = $_GET['id'];

// Delete the menu item from the database
$sql = "DELETE FROM reservations WHERE id = '$reservation_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: reservation.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

