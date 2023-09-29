<! -- Christian -- >
<?php
session_start();
session_unset();
session_destroy();

// Redirect to a new customer login page (you can specify the login page)
header("Location: order_success.php");
exit();
?>
