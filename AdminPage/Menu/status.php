<?php
include '../db.php';

if(isset($_GET['menu_id']) && isset($_GET['menu_status'])){
    $menu_id = $_GET['menu_id'];
    $menu_status = $_GET['menu_status'];

    // Update the status in the database
    $sql = "UPDATE menu SET menu_status = $menu_status WHERE menu_id = $menu_id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the menu page
        header("Location: menu.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request";
}
?>
