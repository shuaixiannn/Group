<! -- Christian -- >
<!DOCTYPE html>
<html>
<head>
    <title>Order</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <section class="home-section"> 
        <div class="header">
            <a href="table.php" class="header-logo">Order Management - Table Select</a>
        </div>
        <!--Back button-->
        <a href="login.php">
        <button type="button">
        <i class='bx bx-arrow-back'></i>
        </button>
        </a>
        
        <div class="row">
        <?php
        include '../db.php';
        
        // SQL query to retrieve table information
        $sql = "SELECT * FROM tables";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tableId = $row["table_id"];
                $tableCapacity = $row["capacity"];
                echo '
                    <a href="order.php?table=' . $tableId . '&condition=true">
                        <div class="column" style="background-color:#ccc;">
                            <h2><br>Table ID:' . $tableId . '</h2>
                            <p>Capacity: ' . $tableCapacity . '</p>
                        </div>
                    </a>';
            }
        } else {
            echo "No tables found in the database.";
        }

        // Close the database connection
        $conn->close();
        ?>
        </div>
    </section>
</body>
<style>
* {
  box-sizing: border-box;
}

.column {
  float: left;  
  width: 15%;
  padding: 10px;
  margin: 10px;
  border-radius: 5px;
  text-align: center;
  height: 0;
  padding-bottom: 13%; /* This creates a square aspect ratio */
  position: relative;
  justify-content: center;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

h2 {
  color: black;
}
/* Adjust the font size of the heading */
h1 {
  font-size: 20px;
  text-align: center;
}
p{
  color: black;
}
button {
float: left;
background-color: #333;
color: #fff;
border: none;
padding: 10px 20px;
cursor: pointer;
border-radius: 0px; /* Rounded corners for the button */
margin-right: 10000px;
}
button:hover {
background-color: #555;
}
</style>
</html>
