<!-- Christian -->
<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <!-- Boxicons CDN Link -->
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <body>
    <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-restaurant'></i>
        <div class="logo_name">Chubs Grill</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
          <a href="../index.php">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
     <li>
         <a href="../Menu/menu.php">
        <i class='bx bx-food-menu' ></i>
         <span class="links_name">Menu</span>
       </a>
       <span class="tooltip">Menu</span>
     </li>
     <li>
         <a href="../Table/table.php">
        <i class='bx bx-chair'></i>
         <span class="links_name">Table</span>
       </a>
       <span class="tooltip">Table</span>   
     </li>
     <li>
       <a href="../Reservation/reservation.php">
         <i class='bx bx-time' ></i>
         <span class="links_name">Reservation</span>
       </a>
       <span class="tooltip">Reservation</span>
     </li>
      <li>
          <a href="../Order/member.php">
         <i class='bx bx-cart-alt' ></i>
         <span class="links_name">Order</span>
       </a>
       <span class="tooltip">Order</span>
     </li>
     <li>
         <a href="../Customer/customer.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Customer</span>
       </a>
       <span class="tooltip">Customer</span>
     </li>
     <li>
         <a href="../Staff/staff.php">
         <i class='bx bx-user-circle'></i>
         <span class="links_name">Staff</span>
       </a>
       <span class="tooltip">Staff</span>
     </li>
     <li class="profile">
         <div class="profile-details">
           <div class="name_job">
             <div class="name">Welcome Admin!</div>
             <div class="job"><?php echo $_SESSION["admin_email"]; ?></div>
           </div>
         </div>
         <a href="../../HomePage/AdminLogin/logout.php">
            <i class='bx bx-log-out' id="log_out"></i>
        </a>

     </li>
    </ul>
  </div>
        
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
