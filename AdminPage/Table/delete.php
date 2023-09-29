<! -- Christian -- >
<?php
// Include your database connection code here
include '../db.php';


$table_id = $_GET['id'];

// Delete the customer from the database
$sql = "DELETE FROM tables WHERE table_id = '$table_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="table.php">Back to Table List</a>

