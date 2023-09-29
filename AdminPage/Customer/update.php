<! -- Christian -- >
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Customer</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <section class="home-section">
    <div class="header">
        <a href="staff.php" class="header-logo">Staff Management - Edit Customer</a>
    </div>
    
    <! -- Add -- >
    <a href="customer.php">
        <button type="button">
        <i class='bx bx-arrow-back'></i>
        </button>
    </a>
    
    <?php
    // Include your database connection code here
    include '../db.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $cust_id = $_GET['id'];

    // Retrieve customer details
    $sql = "SELECT * FROM customer WHERE cust_id = '$cust_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display customer details in a form for editing
        echo "<form action='update_process.php' method='POST'>";
        echo "Name: <input type='text' name='cust_name' value='" . $row["cust_name"] . "'><br>";
        echo "Email: <input type='text' name='cust_email' value='" . $row["cust_email"] . "'><br>";
        echo "Contact Number: <input type='text' name='cust_contact' value='" . $row["cust_contact"] . "'><br>";
        echo "Password: <input type='password' id='myInput' name='cust_password' value='" . $row["cust_password"] . "'><br>";
        echo "<input type='checkbox' onclick='myFunction()'>Show Password<br><br>";
        echo "<input type='hidden' name='cust_id' value='" . $row["cust_id"] . "'>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";
    } else {
        echo "Customer not found";
    }

    $conn->close();
    ?>

    </section>
    <style>
/* Updated form styling */
form {
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 1000px;
    margin: 0 auto;
    background-color: #f7f7f7;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc; /* Added a border for better visibility */
    border-radius: 3px; /* Rounded corners for input fields */
}

/* Updated button styling */
input[type="submit"],
textarea{
    background-color: #333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 3px; /* Rounded corners for the button */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

input[type="submit"]:hover {
    background-color: #555;
}

button {
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
<script>
  /* Show Password */
  function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
</body>
</html>
