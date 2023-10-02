<! -- Calvin -- >
<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $contact = $reservation_date = $reservation_time = $num_guests = $table = "";
$name_err = $contact_err = $reservation_date_err = $reservation_time_err = $num_guests_err = $table_err = "";

// Available reservation times
$available_times = ["6:00 PM", "7:00 PM", "8:00 PM", "9:00 PM", "10:00 PM", "11:00 PM", "12:00 PM"];

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    // Validate contact number
    $input_contact = trim($_POST["contact"]);
    if (empty($input_contact)) {
        $contact_err = "Please enter a contact number.";
    } elseif (!is_numeric($input_contact)) {
        $contact_err = "Please enter a valid contact number.";
    } else {
        $contact = $input_contact;
    }

    // Validate reservation date
    $input_reservation_date = trim($_POST["reservation_date"]);
    if (empty($input_reservation_date)) {
        $reservation_date_err = "Please enter a reservation date.";
    } else {
        $reservation_date = $input_reservation_date;
    }

    // Validate reservation time
    $input_reservation_time = trim($_POST["reservation_time"]);
    if (empty($input_reservation_time)) {
        $reservation_time_err = "Please enter a reservation time.";
    } else {
        $reservation_time = $input_reservation_time;
    }

    // Validate number of guests
    $input_num_guests = trim($_POST["num_guests"]);
    if (empty($input_num_guests)) {
        $num_guests_err = "Please enter the number of guests.";
    } elseif (!is_numeric($input_num_guests)) {
        $num_guests_err = "Please enter a valid number of guests.";
    } else {
        $num_guests = $input_num_guests;
    }

   // Validate table selection
    $input_table = trim($_POST["table"]);
    if (empty($input_table) || !in_array($input_table, range(1, 12))) {
        $table_err = "Please select a valid table (1 to 12).";
    } else {
        $table = $input_table;
    }

    // Check input errors before inserting into the database
    if (empty($name_err) && empty($contact_err) && empty($reservation_date_err) && empty($reservation_time_err) && empty($num_guests_err) && empty($table_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO reservations (name, contact, reservation_date, reservation_time, num_guests, table_id) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_name, $param_contact, $param_reservation_date, $param_reservation_time, $param_num_guests, $param_table);

            // Set parameters
            $param_name = $name;
            $param_contact = $contact;
            $param_reservation_date = $reservation_date;
            $param_reservation_time = $reservation_time;
            $param_num_guests = $num_guests;
            $param_table = $table;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: homepage.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
}
?>
<?php
include 'config.php';

// Retrieve available tables from the 'tables' table
$query = "SELECT table_id, name, capacity FROM tables WHERE table_status = 'Available'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed.");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Homepage</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">The Chubs Grill</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Top Sales Item</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>
                        <li class="nav-item"><a class="nav-link" href="#reservation">Reservation</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact2">Contact</a></li>
                        <li class="nav-item dropdown text-uppercase">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdowm" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="membershiplogin/login.php">Membership</a>
                                <a class="dropdown-item" href="StaffLogin/login.php">Staff</a>
                                <a class="dropdown-item" href="Adminlogin/login.php">Admin</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading text-uppercase">Welcome To Our Restaurant!</div>
                <div class="masthead-heading text-uppercase">It's Nice To Meet You</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Tell Me More</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Menu</h2>
                    <h3 class="section-subheading text-muted">Explore our tantalizing menu, where culinary artistry meets extraordinary flavors. <strong>*Click the icon below to see our menu.*</strong></h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <a href="Menu/index.php">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-solid fa-bowl-food fa-stack-1x fa-inverse"></i>
                           </a>
                        </span>
                        <h4 class="my-3">Meal</h4>
                        <p class="text-muted">Experience a delightful journey of tastes, textures, and aromas crafted with passion and care.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <a href="Menu/index.php">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa-solid fa-martini-glass-citrus fa-stack-1x fa-inverse"></i>
                           </a>
                        </span>
                        <h4 class="my-3">Beverages</h4>
                        <p class="text-muted">Refreshing, indulgent, and utterly satisfying, each sip takes you on a blissful journey.</p>
                    </div>
                    <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <a href="Menu/index.php">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas fa-solid fa-wine-bottle fa-stack-1x fa-inverse"></i>
                           </a>
                        </span>
                        <h4 class="my-3">Wine and Beer</h4>
                        <p class="text-muted">Savor sophistication with our exquisite wine selection and embrace camaraderie with diverse beer offerings.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Top Sales Item</h2>
                    <h3 class="section-subheading text-muted"></h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/1.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Bangers Pork</div>
                                <div class="portfolio-caption-subheading text-muted">Mashed</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 2-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal2">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/2.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Napolitan Pork</div>
                                <div class="portfolio-caption-subheading text-muted">Spaghetti</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 3-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal3">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/3.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Supreme Beef</div>
                                <div class="portfolio-caption-subheading text-muted">Pizza</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-lg-0">
                        <!-- Portfolio item 4-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal4">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/4.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Potato Soup</div>
                                <div class="portfolio-caption-subheading text-muted">Cheese</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 mb-4 mb-sm-0">
                        <!-- Portfolio item 5-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal5">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/5.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">Ice Cream Float</div>
                                <div class="portfolio-caption-subheading text-muted">Beverage</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <!-- Portfolio item 6-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal6">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/6.jpg" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading">House Wine</div>
                                <div class="portfolio-caption-subheading text-muted">Wine</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">About</h2>
                    <h3 class="section-subheading text-muted">Our Humble Beginnings</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/10.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>2010</h4>
                                <h4 class="subheading">Our Humble Beginnings</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">In the year 2010, our culinary adventure began as we set out to establish a restaurant company, bringing flavors and experiences that would delight diners for years to come.</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/11.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Delicious Food:</h4>
                                <h4 class="subheading">Your Ultimate Dining Destination</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Ribs, burger, pasta and ice cold beer. We got it all. There is definitely something for everyone. We pride ourselves by serving quality food.</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/12.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Fun Vibes:</h4>
                                <h4 class="subheading">Experience the pulse of pure joy</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Experience the pulse of pure joy – where every moment is alive with fun vibes. Join us for an unforgettable adventure filled with laughter, excitement, and boundless energy. From vibrant gatherings to carefree get-togethers, our atmosphere is your playground of positivity. Discover the heart of fun vibes today!</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/13.jpg" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4>Our</h4>
                                <h4 class="subheading">Location</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">We are located at Plaza Shell, Jln Tunku Abdul Rahman, Pusat Bandar Kota Kinabalu, 88300 Kota Kinabalu, Sabah. Experience culinary delights and warm hospitality at our restaurant – your table is ready to create memorable moments.</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Now
                                <br />
                                Eat, Drink &
                                <br />
                                Be Merry!
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Our Amazing Team</h2>
                    <h3 class="section-subheading text-muted">Meet the Culinary Artists Behind Every Dish.</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/7.jpg" alt="..." />
                            <h4>Christian Lau</h4>
                            <p class="text-muted">Executive Chef</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Parveen Anand LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/8.jpg" alt="..." />
                            <h4>Calvin Chia</h4>
                            <p class="text-muted">Head Chef</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Diana Petersen LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/9.jpg" alt="..." />
                            <h4>Kerry Wong</h4>
                            <p class="text-muted">Deputy Chef</p>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker Facebook Profile"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Larry Parker LinkedIn Profile"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">Our restaurant's magic unfolds in the hands of our remarkable chefs. With diverse expertise and a shared passion, they bring flair and flavor to every plate. Join us to savor their exquisite creations.</p></div>
                </div>
            </div>
        </section>
        <!-- Reservation-->
        <section class="page-section" id="reservation">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Reservation</h2>
            <h3 class="section-subheading text-muted">Fill out the form below to make a reservation.</h3>
        </div>
        <div class="form-wrapper">
        <div class="form-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>" required>
                    <span class="invalid-feedback"><?php echo $name_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" id="contact" name="contact" class="form-control <?php echo (!empty($contact_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contact; ?>" required>
                    <span class="invalid-feedback"><?php echo $contact_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="reservation_date">Reservation Date</label>
                    <input type="date" id="reservation_date" name="reservation_date" class="form-control <?php echo (!empty($reservation_date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $reservation_date; ?>" required>
                    <span class="invalid-feedback"><?php echo $reservation_date_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="reservation_time">Reservation Time</label>
                    <select id="reservation_time" name="reservation_time" class="form-control <?php echo (!empty($reservation_time_err)) ? 'is-invalid' : ''; ?>" required>
                        <option value="">Select a time</option>
                        <?php foreach ($available_times as $time): ?>
                            <option value="<?php echo $time; ?>" <?php echo ($reservation_time === $time) ? 'selected' : ''; ?>><?php echo $time; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="invalid-feedback"><?php echo $reservation_time_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="num_guests">Number of Guests</label>
                    <input type="number" id="num_guests" name="num_guests" class="form-control <?php echo (!empty($num_guests_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $num_guests; ?>" required>
                    <span class="invalid-feedback"><?php echo $num_guests_err; ?></span>
                </div>
                <div class="form-group">
                    <label for="table">Table Number (1 to 12)</label>
                    <select id="table" name="table" class="form-control<?php echo (!empty($table_err)) ? 'is-invalid' : ''; ?>" required>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $table_id = $row['table_id'];
                            $table_name = $row['name'];
                            $table_capacity = $row['capacity'];
                            echo "<option value='{$table_id}'>{$table_name} (Capacity: {$table_capacity})</option>";
                        }
                        ?>
                    </select>
                    <span class="invalid-feedback"><?php echo $table_err; ?></span>
                </div>
                <br>
                <!--Reservation PDF-->
                <input type="submit" class="btn btn-primary" value="Submit" onclick="myFunction2()">
                
            </form>
        </div>
    </div>
    </div>
</section>
        
<script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var contact = document.getElementById("contact").value;
        var reservation_date = document.getElementById("reservation_date").value;
        var reservation_time = document.getElementById("reservation_time").value;
        var num_guests = document.getElementById("num_guests").value;

        if (name === "" || contact === "" || reservation_date === "" || reservation_time === "" || num_guests === "") {
            alert("Please fill out all required fields.");
            return false;
        }

        // Additional validation logic can be added here if needed.

        return true; // Form will submit if all required fields are filled
    }
</script>

        <!-- Contact-->
        <section class="page-section" id="contact2">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Contact Us</h2>
                    <h3 class="section-subheading text-muted">Fill out this form to share us your message.</h3>
                </div>
                <!-- * * * * * * * * * * * * * * *-->
                <!-- * * SB Forms Contact Form * *-->
                <!-- * * * * * * * * * * * * * * *-->
                <!-- This form is pre-integrated with SB Forms.-->
                <!-- To make this form functional, sign up at-->
                <!-- https://startbootstrap.com/solution/contact-forms-->
                <!-- to get an API token!-->
                <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- Name input-->
                                <input class="form-control" id="name" type="text" placeholder="Your Name *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <div class="form-group">
                                <!-- Email address input-->
                                <input class="form-control" id="email" type="email" placeholder="Your Email *" data-sb-validations="required,email" />
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <div class="form-group mb-md-0">
                                <!-- Phone number input-->
                                <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" data-sb-validations="required" />
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <!-- Message input-->
                                <textarea class="form-control" id="message" placeholder="Your Message *" data-sb-validations="required"></textarea>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit success message-->
                    <!---->
                    <!-- This is what your users will see when the form-->
                    <!-- has successfully submitted-->
                    <div class="d-none" id="submitSuccessMessage">
                        <div class="text-center text-white mb-3">
                            <div class="fw-bolder" style="color:white;">Form submission successful!</div>
                        </div>
                    </div>
                    <!-- Submit error message-->
                    <!---->
                    <!-- This is what your users will see when there is-->
                    <!-- an error submitting the form-->
                    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                    <!-- Submit Button-->
                    <div class="text-center"><button class="btn btn-primary btn-xl text-uppercase " id="submitButton" type="submit" onclick="myFunction()">Send Message</button></div>
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2023</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Bangers Pork</h2>
                                    <p class="item-intro text-muted">Mashed</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/1.jpg" alt="..." />
                                    <p>Discover culinary delight with our signature Bangers & Pork dish at Chubs Grill. Immerse yourself in a symphony of robust flavors and succulent textures, expertly crafted to elevate your dining experience. Whether you're a food enthusiast seeking gastronomic adventure or a casual diner in search of comfort, our Bangers & Pork promises a memorable journey through the finest ingredients and culinary craftsmanship, redefining your notion of hearty satisfaction.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong></strong>
                                           
                                        </li>
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 2 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Napolitan Pork</h2>
                                    <p class="item-intro text-muted">Spaghetti</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/2.jpg" alt="..." />
                                    <p>Experience a culinary journey like no other with our Napolitan Pork Spaghetti at Chubs Grill. Immerse your taste buds in a symphony of authentic Italian flavors and textures, expertly crafted to perfection. From the savory pork to the al dente spaghetti, every bite encapsulates the essence of Italy's culinary tradition. Whether you're a food aficionado seeking gastronomic excellence or a casual diner in search of comfort, our Napolitan Pork Spaghetti promises to transport you to the heart of Italy, redefining your dining experience one delicious forkful at a time.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 3 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Supreme Beef</h2>
                                    <p class="item-intro text-muted">Pizza</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/3.jpg" alt="..." />
                                    <p>Indulge in the ultimate pizza experience with our Supreme Beef Pizza at Chubs Grill. Immerse yourself in a symphony of robust flavors and premium ingredients meticulously crafted to perfection. From the savory beef to the harmonious blend of toppings, every bite takes your taste buds on a delectable journey. Whether you're a pizza enthusiast seeking culinary excellence or simply craving a satisfying slice, our Supreme Beef Pizza promises to redefine your pizza cravings, delivering a taste of pure delight with every mouthwatering bite.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong></strong>
                                        </li>
                                        <li>
                                            <strong></strong>
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 4 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Potato Soup</h2>
                                    <p class="item-intro text-muted">Cheese</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/4.jpg" alt="..." />
                                    <p>Delight in the comforting warmth of our Potato Soup at Chubs Grill. Immerse yourself in a bowl of creamy goodness, crafted with the finest potatoes and expert seasoning to create a harmonious blend of flavors and textures. Whether you're seeking solace on a chilly day or a heartwarming taste of tradition, our Potato Soup promises a spoonful of comfort that transcends the ordinary, warming both body and soul with every savory sip.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 5 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">Ice Cream Float</h2>
                                    <p class="item-intro text-muted">Beverage</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/5.jpg" alt="..." />
                                    <p>Experience pure delight with our Blissful Ice Cream Floats at Chubs Grill. Discover the perfect fusion of artisanal ice cream and sparkling beverages, topped with a burst of flavors. Create your own masterpiece or savor classic pairings, all in one sensational, effervescent sip.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio item 6 modal popup-->
        <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase">House Wine</h2>
                                    <p class="item-intro text-muted">Wine</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/6.jpg" alt="..." />
                                    <p>Elevate your dining experience with our exquisite House Wine selection at Chubs Grill. Immerse yourself in the rich symphony of flavors crafted to perfection, each sip a journey through the finest vineyards and meticulous craftsmanship. Whether you're a connoisseur seeking nuanced notes or an enthusiast enjoying casual elegance, our House Wine collection promises to enhance every moment, turning ordinary occasions into extraordinary memories.</p>
                                    <ul class="list-inline">
                                        <li>
                                            <strong></strong>
                                           
                                        </li>
                                        <li>
                                            <strong></strong>
                                            
                                        </li>
                                    </ul>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        <script>
            function myFunction() {
                alert("Your message has been submitted!");
            }
            
            function myFunction2() {
                alert("Your reservation has been reserved!");
            }
        </script>
    </body>
</html>