<! -- Christian -- >
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Staff</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    <?php
    include '../sidebar.php';
    ?>
    <section class="home-section">
    <div class="header">
        <a href="staff.php" class="header-logo">Staff Management - Edit Staff</a>
    </div>
        
    <a href="staff.php">
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

    // Check if 'id' is set in the URL
    if (isset($_GET['id'])) {
        $staff_id = $_GET['id'];

        // Retrieve staff details
        $sql = "SELECT * FROM staff WHERE staff_id = '$staff_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Display staff details in a form for editing
            echo "<form action='update_process.php' method='POST'>";
            echo "Name: <input type='text' name='staff_name' value='" . $row["staff_name"] . "'><br>";
            echo "Email: <input type='text' name='staff_email' value='" . $row["staff_email"] . "'><br>";
            echo "Contact Number: <input type='text' name='staff_contact' value='" . $row["staff_contact"] . "'><br>";
            echo "Position: <input type='text' name='position' value='" . $row["position"] . "'><br>";
            echo "Password: <input type='password' id='myInput' name='staff_password' value='" . $row["staff_password"] . "'><br>";
            echo "<input type='checkbox' onclick='myFunction()'>Show Password<br><br>";
             echo "Status: 
            <select name='status'>
                <option value='Active' " . ($row["status"] == "Active" ? "selected" : "") . ">Active</option>
                <option value='Retired' " . ($row["status"] == "Retired" ? "selected" : "") . ">Retired</option>
                <option value='Resigned' " . ($row["status"] == "Resigned" ? "selected" : "") . ">Resigned</option>
              </select><br>";
            echo "<input type='hidden' name='staff_id' value='" . $row["staff_id"] . "'>";
            echo "<input type='submit' value='Update'>";
            echo "</form>";
        } else {
            echo "Staff not found";
        }
    } else {
        echo "Staff ID not provided in the URL";
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
