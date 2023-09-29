<! -- Christian -- >
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Table</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
  <section class="home-section">
    <div class="header">
        <a href="table.php" class="header-logo">Table Management</a>
    </div>
      
    <! -- Search & Add -- >
    <form method="GET" action="search.php">
        <div class="search-container">
            <input type="text" name="search" id="search" placeholder="Search table...">
            <button type="submit" class="search-button"><i class='bx bx-search'></i></button>
        </div>
        <a href="create.php">
            <button type="button">
            <i style="color: #fff;" class='bx bx-plus'></i>
            <span>Create Table</span>
            </button>
        </a>
    </form>
      
    <table border="1">
        <tr>
            <th>Table ID</th>
            <th>Name</th>
            <th>Capacity</th>
            <th>Status</th>
            <th style="width: 190px;">Action</th>
        </tr>
        
        <?php
        include '../db.php';

        $sql = "SELECT * FROM tables";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["table_id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["capacity"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td><a href='read.php?id=" . $row["table_id"] . "'><i class='bx bx-spreadsheet'></i></a> | <a href='update.php?id=" . $row["table_id"] . "'><i class='bx bx-edit' ></i></a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No table found</td></tr>";
        }

        $conn->close();
        ?>
        
    </table>
  </section>
<style>
/* Seacrh & Add */
form{
    padding-top: 10px;
    padding-right: 10px;
}
/* Container for the search box */
.search-container {
  padding-left: 20px;
  position: relative;
  display: inline-block;
}

/* Search input field */
#search {
  padding: 10px;
  border: none;
  border-radius: 25px;
  outline: none;
  width: 500px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Search button */
.search-button {
  position: absolute;
  top: 0;
  right: 0;
  background-color: #333; /* Change this to your desired button color */
  border: none;
  border-radius: 0 25px 25px 0;
  padding: 10px 15px;
  cursor: pointer;
}

/* Icon inside the search button (font-awesome used here) */
.search-button i {
  color: white;
}

/* Hover effect for the button */
.search-button:hover {
  background-color: #555; /* Change this to your desired hover color */
}

/* Updated button styling */
button {
    float: right;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s; /* Smooth transition for hover effect */
}

button:hover {
    background-color: #555;
}

/* Styling for the table */
table {
    background-color:#fff;
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}

th {
    background-color: #333;
    color: #fff;
}
i{
  color: black;
}
</style>
</body>
</html>



