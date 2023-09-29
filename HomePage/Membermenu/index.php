<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Page</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/scripts.js"></script>
    <style>
        .menu{
            height:650vh;
            display:flex;
            align-items: center;
            justify-content: space-around;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="../homepage.php#page-top">The Chubs Grill</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="../membershiplogin/memberhomepage.php#services">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="../membershiplogin/memberhomepage.php#portfolio">Top Sales Item</a></li>
                        <li class="nav-item"><a class="nav-link" href="../membershiplogin/memberhomepage.php#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="../membershiplogin/memberhomepage.php#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="../membershiplogin/memberhomepage.php#reservation">Reservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="../membershiplogin/memberhomepage.php#contact2">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="../membershiplogin/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    
    <div class="menu">
    <img src="Food.png" alt="">
    <img src="Grill Pork.png" alt="">
    <img src="Pizza.png" alt="">
    <img src="Drinks.png" alt="">
    <img src="Beer.png" alt="">
</div>
</body>
</html>
