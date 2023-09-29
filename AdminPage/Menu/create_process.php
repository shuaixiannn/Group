<! -- Christian -- >
<?php
// Include your database connection code here
include '../db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$menu_id = $_POST['menu_id'];
$menu_name = $_POST['menu_name'];
$menu_desc = $_POST['menu_desc'];
$menu_price = $_POST['menu_price'];
$category = $_POST['category'];
$status = $_POST['status'];

// Insert the new customer into the database
$sql = "INSERT INTO menu (menu_id, menu_name, menu_desc, menu_price, category, status) VALUES ('$menu_id', '$menu_name', '$menu_desc', '$menu_price', '$category','$status')";

    if ($conn->query($sql) === TRUE) {
        header("Location: menu.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="menu.php">Back to Menu List</a>
