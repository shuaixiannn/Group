<! -- Christian -- >
<!DOCTYPE html>
<html>
<head>
    <title>Table</title>
</head>
<body>
    
</body>
</html>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Create Table</title>
    <link rel="stylesheet" href="../style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <section class="home-section">
    <div class="header">
        <a href="table.php" class="header-logo">Table Management - Create table</a>
    </div>
        <a href="table.php">
        <button type="button">
        <i class='bx bx-arrow-back'></i>
        </button>
    </a>
    <form action="create_process.php" method="POST">
        <!-- Input fields for table details -->
        <!-- Replace these with your form fields -->
        Name: <input type="text" name="name"><br>
        Capacity: <input type="number" id="myInput" name="capacity"><br>
        <input type="submit" value="Create">
    </form>
    </section>
    <style>
/* Updated form styling */
form {
    border: 1px solid #ccc;
    padding: 20px;
    max-width: 1000px;
    margin: 10px auto;
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
input[type="number"],
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
</body>
</html>
