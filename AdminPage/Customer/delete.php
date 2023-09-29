<! -- Christian -- >
<?php
// Include your database connection code here
include '../db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cust_id = $_GET['id'];

// Delete the customer from the database
$sql = "DELETE FROM customer WHERE cust_id = '$cust_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: customer.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="customer.php">Back to Customer List</a>

