<! -- Christian -- >
<?php
// Include your database connection code here
include '../db.php';

// Retrieve form data
$table_id = $_POST['table_id'];
$name = $_POST['name'];
$capacity = $_POST['capacity'];


// Update the table in the database
$sql = "UPDATE tables SET name = '$name', capacity = '$capacity' WHERE table_id = '$table_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="table.php">Back to Table List</a>
