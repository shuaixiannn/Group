<! -- Christian -- >
<?php
// Include your database connection code here
include '../db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$staff_id = $_GET['id'];

// Delete the staff from the database
$sql = "DELETE FROM staff WHERE staff_id = '$staff_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: staff.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="staff.php">Back to staff List</a>

