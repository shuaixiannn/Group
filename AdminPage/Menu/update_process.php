<!--Christian-->
<?php
// Include your database connection code here
include '../db.php';

// Retrieve form data
$menu_id = $_POST['menu_id'];
$menu_name = $_POST['menu_name'];
$menu_desc = $_POST['menu_desc'];
$menu_price = $_POST['menu_price'];
$category = $_POST['category'];

// Update the menu in the database
$sql = "UPDATE menu SET menu_name = '$menu_name', menu_desc = '$menu_desc', menu_desc = '$menu_desc', menu_price ='$menu_price', category = '$category' WHERE menu_id = '$menu_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: menu.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>
<br>
<a href="menu.php">Back to Menu List</a>
