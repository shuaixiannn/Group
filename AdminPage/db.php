<! -- Christian -- >
<?php
    $db_server = "localhost";
    $db_user = "root";
    $dc_password = "";
    $db_name = "chubs_db";
    $conn = "";

    $conn = mysqli_connect($db_server, $db_user, $dc_password, $db_name); 

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>