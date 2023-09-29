<! -- Christian -- >
<?php
// Include your database connection code here
include '../db.php';

// Retrieve form data
$table_id = $_POST['table_id'];
$name = $_POST['name'];
$capacity = $_POST['capacity'];
$status = $_POST['status'];

// Insert the new customer into the database
$sql = "INSERT INTO tables (table_id, name, capacity) VALUES ('$table_id', '$name', '$capacity', '$status')";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="table.php">Back to table List</a>
