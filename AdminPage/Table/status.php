<!-- Christian -->
<?php
include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST["table_status"];
    $table_id = $_GET["table_id"];
            
    $updatesql = "update tables set table_status = '$status' where table_id = '$table_id';"; 
    $updateResult = mysqli_query($conn, $updatesql);
    
    header("Location: table.php");
    exit();
}
?>

