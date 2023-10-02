<!--Christian-->
<?php
include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST["menu_status"];
    $menu_id = $_GET["menu_id"];
            
    $updatesql = "update menu set menu_status = '$status' where menu_id = '$menu_id';"; 
    $updateResult = mysqli_query($conn, $updatesql);
    
    header("Location: menu.php");
    exit();
}
?>
