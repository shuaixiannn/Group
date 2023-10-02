<!--Christian-->
<?php
include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST["staff_status"];
    $staff_id = $_GET["staff_id"];
            
    $updatesql = "update staff set staff_status = '$status' where staff_id = '$staff_id';"; 
    $updateResult = mysqli_query($conn, $updatesql);
    
    header("Location: staff.php");
    exit();
}
?>
