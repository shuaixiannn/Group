<! -- Christian -- >
<?php
include '../db.php';

// Retrieve form data
$cust_name = $_POST['cust_name'];
$cust_email = $_POST['cust_email'];
$cust_contact = $_POST['cust_contact'];
$cust_password = $_POST['cust_password'];

// Insert the new customer into the database
$sql = "INSERT INTO customer (cust_name, cust_email, cust_contact, cust_password) VALUES ('$cust_name', '$cust_email', '$cust_contact', '$cust_password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: customer.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="customer.php">Back to Customer List</a>
