<! -- Christian -- >
<?php
// Include your database connection code here
include '../db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$cust_id = $_POST['cust_id'];
$cust_name = $_POST['cust_name'];
$cust_email = $_POST['cust_email'];
$cust_contact = $_POST['cust_contact'];
$cust_password = $_POST['cust_password'];

// Update the customer in the database
$sql = "UPDATE customer SET cust_name = '$cust_name', cust_email = '$cust_email', cust_contact = '$cust_contact', cust_password = '$cust_password' WHERE cust_id = '$cust_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: customer.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="customer.php">Back to Customer List</a>
