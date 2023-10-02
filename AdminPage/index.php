<!--Christian-->
<?php
include 'db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu</title>
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
        <div class="logo_name">Chubs Grill</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="index.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
     <li>
         <a href="Menu/menu.php">
        <i class='bx bx-food-menu' ></i>
         <span class="links_name">Menu</span>
       </a>
       <span class="tooltip">Menu</span>
     </li>
     <li>
         <a href="Table/table.php">
        <i class='bx bx-chair'></i>
         <span class="links_name">Table</span>
       </a>
       <span class="tooltip">Table</span>
     </li>
     <li>
         <a href="Reservation/reservation.php">
         <i class='bx bx-time' ></i>
         <span class="links_name">Reservation</span>
       </a>
       <span class="tooltip">Reservation</span>
     </li>
      <li>
          <a href="Order/member.php">
         <i class='bx bx-cart-alt' ></i>
         <span class="links_name">Order</span>
       </a>
       <span class="tooltip">Order</span>
     </li>
     <li>
         <a href="Customer/customer.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Customer</span>
       </a>
       <span class="tooltip">Customer</span>
     </li>
     <li>
         <a href="Staff/staff.php">
         <i class='bx bx-user-circle'></i>
         <span class="links_name">Staff</span>
       </a>
       <span class="tooltip">Staff</span>
     </li>
     <li class="profile">
         <div class="profile-details">
           <div class="name_job">
             <div class="name">Welcome Admin!</div>
             <div class="job"><?php echo $_SESSION["email"]; ?></div>
           </div>
         </div>
         <a href="../HomePage/AdminLogin/logout.php">
          <i class='bx bx-log-out' id="log_out" ></i>
         </a>
     </li>
    </ul>
  </div>
    
  <section class="home-section">
      <div class="header">
          <a href="index.php" class="header-logo">Dashboard</a>
      </div>
      
      <!--Report PDF-->
      <br>
      <a href="Report/report-pdf.php">
            <button type="button">
            <i style="color: #fff;" class='bx bx-file' ></i>
            <span>Generate Report PDF</span>
            </button>
      </a>
      
    <div class="box-info">
        <div class="box">
            <span class="icon"><i class='bx bxs-group'></i></span>
            <div class="text">
                <p>Total Membership</p>
                <?php
                $custCountResult = mysqli_query($conn, "SELECT COUNT(cust_id) as count FROM customer;");
                $row = mysqli_fetch_assoc($custCountResult);
                echo $row['count'];
                ?>
            </div>
        </div>

        <div class="box">
            <span class="icon"><i class='bx bxs-calendar-check'></i></span>
            <div class="text">
                <p>Daily Food Order</p>
                <?php
                $currentDate = date("Y-m-d");
                $checkOrderResult = mysqli_query($conn, "SELECT COUNT(*) as count FROM orders WHERE DATE(order_time) = '$currentDate';");
                $row = mysqli_fetch_assoc($checkOrderResult);
                echo $row['count'];
                ?>
            </div>
        </div>

        <div class="box">
            <span class="icon"><i class='bx bxs-dollar-circle'></i></span>
            <div class="text">
                <p>Daily Total Sales</p>
                <?php
                $currentDate = date("Y-m-d");
                $totalSalesResult = mysqli_query($conn, "SELECT SUM(total) as total FROM order_food 
                WHERE order_id IN (SELECT order_id FROM orders WHERE DATE(order_time) = '$currentDate');");
                $row = mysqli_fetch_assoc($totalSalesResult);
                echo $row['total'];
                ?>

            </div>
        </div>
    </div>


      
  </section>
<style>
/* Updated button styling */
button {
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s; /* Smooth transition for hover effect */
    margin-left: 10px;
}

button:hover {
    background-color: #555;
}

.box-info {
	margin-top: 40px;
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	grid-gap: 36px;
}
.box-info .box {
	padding: 24px;
	background: #F9F9F9;
	border-radius: 20px;
	display: flex;
	grid-gap: 32px;
	align-items: center;
	flex-wrap: wrap;
}
.box-info .box .icon {
	display: flex;
	min-width: 100px;
	height: 100px;
	border-radius: 10px;
	justify-content: center;
	align-items: center;
	background: #eee;
	font-size: 48px;
}
.box-info .box .text h3 {
	font-size: 28px;
	margin-bottom: 4px;
	font-weight: 600;
}
.box-info .box .text p {
	font-size: 16px;
}
.box-info .box:nth-child(1) .icon {
	color: var(--blue);
	background: #CFE8FF;
}
.box-info .box:nth-child(2) .icon {
	color: var(--yellow);
	background: #FFF2C6;
}
.box-info .box:nth-child(3) .icon {
	color: var(--orange);
	background: #FFE0D3;
}
</style>
<script>
  let sidebar = document.querySelector(".sidebar");
  let closeBtn = document.querySelector("#btn");
  let searchBtn = document.querySelector(".bx-search");

  closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();//calling the function(optional)
  });

  searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });

  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
   if(sidebar.classList.contains("open")){
     closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
   }else {
     closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
   }
  }
</script>
</body>
</html>
