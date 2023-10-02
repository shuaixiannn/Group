<!--Christian-->
<?php
session_start();
session_unset();
session_destroy();

header("Location: order_success.php");
exit();
?>
