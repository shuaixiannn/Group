<! -- Christian -- >
<?php
session_start();
require_once("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["membership_choice"])) {
        $membership_choice = $_POST["membership_choice"];
        if ($membership_choice === "Yes") {
            // Redirect to the login form
            header("Location: login_cust.php");
            exit;
        } else {
            // Redirect to the order page
            $_SESSION['customer_id'] = '0';
            header("Location: table.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        function chooseMembership(choice) {
            document.getElementById("membership_choice").value = choice;
            document.getElementById("membership_form").submit();
        }
    </script>
</head>
<body>
    <?php include '../sidebar.php'; ?>
    <section class="home-section">
        <div class="header">
            <a href="member.php" class="header-logo">Order Management - Customer</a>
        </div>
        <div class="form-container">
            <div class="container">
            <h2>Membership?</h2>
            <button style="background-color:white; margin-bottom: 10px;" class="form-control" onclick="chooseMembership('Yes')">Yes</button> 
            <button style="background-color:white;" class="form-control" onclick="chooseMembership('No')">No</button>
            <form id="membership_form" method="post">
                <input type="hidden" id="membership_choice" name="membership_choice" value="">  
            </form>
            </div>
        </div>
    </section>
    <style>
        .form-container{
            font: 14px sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 80vh;
        }
        .container{
            width: 360px; 
            padding: 20px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
            background-color: #f9f9f9;
        }
    </style>
</body>
</html>
