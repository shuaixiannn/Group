<!--Christian-->
<?php
session_start();
require_once("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cust_id = $_POST["cust_id"];
    $sql = "SELECT * FROM customer WHERE cust_id = '$cust_id'";    
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        echo $row['cust_id'];
        $_SESSION["customer_id"] = $row["cust_id"];

        if ($row["membership"]) {
            header("Location: member.php");
        } else {
            header("Location: table.php");
        }
    } else{                  
        $login_err = "Invalid ID. Try Again!";
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
</head>
<body>
    <?php include '../sidebar.php'; ?>
    <section class="home-section">
        <div class="header">
            <a href="login.php" class="header-logo">Order Management - Login Membership</a>
        </div>
        
        <!--Back button-->
        <a href="member.php">
        <button type="button">
        <i class='bx bx-arrow-back'></i>
        </button>
        </a>
        
        <div class="form-container">
            <div class="container">
                
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
            <form method="post" action="login.php">
            <label for="cust_id" style="font-size: 25px;">Membership ID:</label><br>
            <input class="form-control" type="text" name="cust_id" required><br>
        
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
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
        button {
            float: left;
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 0px; /* Rounded corners for the button */
            transition: background-color 0.3s; /* Smooth transition for hover effect */
        }
        button:hover {
            background-color: #555;
        }
    </style>
</body>
</html>