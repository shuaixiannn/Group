<! -- Christian -- >
<?php
// Include your database connection code here
include '../db.php';

$menu_id = $_GET['id'];

// Delete the customer from the database
$sql = "DELETE FROM menu WHERE menu_id = '$menu_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: menu.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="menu.php">Back to Menu List</a>

