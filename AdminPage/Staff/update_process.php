<!--Christian-->
<?php
// Include your database connection code here
include '../db.php';

// Retrieve form data
$staff_id = $_POST['staff_id'];
$staff_name = $_POST['staff_name'];
$staff_email = $_POST['staff_email'];
$staff_contact = $_POST['staff_contact'];
$position = $_POST['position'];
$staff_password = $_POST['staff_password'];

// Update the staffomer in the database
$sql = "UPDATE staff SET staff_name = '$staff_name', staff_email = '$staff_email', staff_contact = '$staff_contact', position = '$position', staff_password = '$staff_password' WHERE staff_id = '$staff_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: staff.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="staff.php">Back to Staff List</a>
