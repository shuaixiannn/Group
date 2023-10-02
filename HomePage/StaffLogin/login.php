<! -- Kerry -- >
<?php
session_start();
 
// Check if the user is already logged in, if yes then redirect them to the welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../../StaffPage/index.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processing form data when the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT staff_email, staff_password FROM staff WHERE staff_email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                // Bind result variables
                mysqli_stmt_bind_result($stmt,$db_email, $plain_password); // Change $hashed_password to $plain_password
                if(mysqli_stmt_fetch($stmt)){
                if($password === $plain_password){ // Compare plain text passwords
                // Password is correct, so start a new session
                session_start();
                // Rest of your code remains the same

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["staff_email"] = $db_email; 

                            
                            // Redirect user to the welcome page
                            header("location: ../../StaffPage/index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else{
                    // Email doesn't exist, display a generic error message
                    $login_err = "Invalid email or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
        font: 14px sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 80vh;
        background-image: url("../assets/img/header-bg.jpg"); /* Replace 'path/to/your/image.jpg' with the actual path to your background image */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        position: relative; /* Add this to position pseudo-element relative to the body */
    }

    body::before {
        content: "";
        background-color: rgba(0, 0, 0, 0.5); /* Adjust the last value (0.5) to control the darkness; 0 is fully transparent, 1 is fully opaque */
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .wrapper {
        width: 360px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        position: relative; /* Add this to ensure content is above the overlay */
    }
         body{ font: 14px sans-serif; display: flex; justify-content: center; align-items: center; height: 80vh; }
        .wrapper{ width: 360px; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;}
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="form-group text-center"> <!-- Centered div -->
            <h1 class="navbar-brand" style="font-family: 'Montserrat', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'; color: #ffc800;">THE CHUBS GRILL</h1>
        </div>
        <h2>Staff Login</h2>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>
</html>