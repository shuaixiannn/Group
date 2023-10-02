<!--Christian-->
<?php
// Include your database connection code here
include '../db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$staff_name = $_POST['staff_name'];
$staff_email = $_POST['staff_email'];
$staff_contact = $_POST['staff_contact'];
$position = $_POST['position'];
$staff_password = $_POST['staff_password'];

// Check if any of the required fields are empty
if (empty($staff_name) || empty($staff_email) || empty($staff_contact) || empty($position) || empty($staff_password)) {
    echo "Error: Please fill in all the required fields.";
} else {
    // Insert the new staff member into the database
    $sql = "INSERT INTO staff (staff_name, staff_email, staff_contact, position, staff_password) VALUES ('$staff_name', '$staff_email', '$staff_contact', '$position', '$staff_password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: staff.php");  
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<br>
<a href="staff.php">Back to staff List</a>
