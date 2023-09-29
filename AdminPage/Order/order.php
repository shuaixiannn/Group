<! -- Christian -- >
<?php
session_start();
include '../db.php'; // Include your database connection file

if(isset($_GET['condition'])){
$condition = $_GET['condition'];
if($condition){
$_SESSION['selected_table_id'] = $_GET['table'];
}}

if (isset($_POST['place_order'])) {
    // Get the selected table_id and customer_id
    $table_id = $_SESSION['selected_table_id'];
    $cust_id = $_SESSION['customer_id'];

    // Create a new order and get the order_id
    $order_id = createNewOrder($table_id, $cust_id, $conn);

    // If the order was successfully created, insert order items
    if ($order_id !== false) {
        foreach ($_SESSION['cart'] as $cartItem) {
            $menu_id = $cartItem['menu_id'];
            $quantity = $cartItem['quantity'];

            $menuPriceResult = mysqli_query($conn, "SELECT menu_price FROM menu WHERE menu_id = '$menu_id'");
            $menuPrice = mysqli_fetch_assoc($menuPriceResult)['menu_price'];

            if (is_numeric($menuPrice) && is_numeric($quantity)) {
                $total = $menuPrice * $quantity;

                // Check if total is not null before inserting
                if ($total !== null) {
                    $insert_order_food_sql = "INSERT INTO order_food (order_id, menu_id, quantity, total) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($insert_order_food_sql);
                    $stmt->bind_param("iiid", $order_id, $menu_id, $quantity, $total);

                    if ($stmt->execute()) {
                        // Insertion was successful
                    } else {
                        echo "Error inserting order item: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Error: Total value is null.";
                }
            } else {
                echo "Invalid menu price or quantity.";
            }
        }

        // Clear the cart after placing the order
        $_SESSION['cart'] = array();

        $checkOrderResult = mysqli_query($conn, "SELECT COUNT(*) as count FROM orders;");
        $row = mysqli_fetch_assoc($checkOrderResult);

        if ($row['count'] > 0) {
            header("Location: checkout.php?order_id=$order_id");
        } else {
            header("Location: order.php");
        }
        exit;

    }
}

function createNewOrder($table_id, $cust_id, $conn) {
    $currentTime = date('Y-m-d H-i-s');
    $insert_order_sql = "INSERT INTO orders (cust_id, table_id, order_time) VALUES ('$cust_id', '$table_id', '$currentTime')";
    if ($conn->query($insert_order_sql) === TRUE){ 
        return $conn->insert_id;
    } else {
        echo "Error creating order: " . $conn->error;
        return false;
    }
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['menu_id']) && isset($_POST['menu_name']) && isset($_POST['menu_price']) && isset($_POST['quantity'])) {
    // Get menu item details and quantity
    $menu_id = $_POST['menu_id'];
    $menu_name = $_POST['menu_name'];
    $menu_price = $_POST['menu_price'];
    $quantity = $_POST['quantity'];

    // Create a cart item array
    $cartItem = array(
        'menu_id' => $menu_id,
        'menu_name' => $menu_name,
        'menu_price' => $menu_price,
        'quantity' => $quantity
    );

    // Add the cart item to the session cart
    $_SESSION['cart'][] = $cartItem;

    // Redirect back to the same page after adding the item
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_menu_id'])) {
    // Get the menu ID to delete
    $delete_menu_id = $_POST['delete_menu_id'];

    // Loop through the cart and remove the item with the specified menu ID
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        if ($cartItem['menu_id'] == $delete_menu_id) {
            unset($_SESSION['cart'][$key]);
        }
    }

    // Redirect back to the same page after deleting the item
    header("Location: {$_SERVER['PHP_SELF']}");
    exit;
}
?>

<?php
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
    $totalAmount = 0;
} else {
    $cartItems = array();
    $totalAmount = 0;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order</title>
    <link rel="stylesheet" href="../style.css"> 
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include '../sidebar.php'; ?>
    
    <section class="home-section"> 
        <div class="header">
            <a href="order.php" class="header-logo">Order Management - Order Food</a>
        </div>
        
        <!-- Search -->
        <form class="search" method="GET" action="search.php">
            <div class="search-container">
                <input type="text" name="search" id="search" placeholder="Search order...">
                <button type="submit" class="search-button"><i class='bx bx-search'></i></button>
            </div>
        </form>
        
        <div class="left-column">
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                <?php
                include '../db.php';

                $sql = "SELECT menu.menu_id, menu.menu_name, menu.menu_price, menu.category, SUM(order_food.quantity) AS order_quantity
                        FROM menu
                        LEFT JOIN order_food ON menu.menu_id = order_food.menu_id
                        GROUP BY menu.menu_id";

                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["menu_id"] . "</td>";
                        echo "<td>" . $row["menu_name"] . "</td>";
                        echo "<td>" . $row["menu_price"] . "</td>";
                        echo "<td>" . $row["category"] . "</td>";
                        echo "<td class='quantity-container'>";
                        echo "<label for='quantity{$row["menu_id"]}'>Quantity:</label>";
                        echo "<form method='POST'  action='{$_SERVER['PHP_SELF']}'>";
                        echo "<input type='number' name='quantity' id='quantity{$row["menu_id"]}' value='0' min='1'>";
                        echo "<input type='hidden' name='menu_id' value='{$row["menu_id"]}'>";
                        echo "<input type='hidden' name='menu_name' value='{$row["menu_name"]}'>";
                        echo "<input type='hidden' name='menu_price' value='{$row["menu_price"]}'>";
                        echo "<button type='submit'>Add to Cart</button>";  
                        echo "</form>";
                        echo "</td>";
                        echo "<tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No order found</td></tr>";
                }

                $conn->close();
                ?>
            </table>
        </div>

        <div class="right-column">
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach ($cartItems as $cartItem) {
                    $menu_id = $cartItem['menu_id'];
                    $menu_name = $cartItem['menu_name'];
                    $menu_price = $cartItem['menu_price'];
                    $quantity = $cartItem['quantity'];
                    $total_amount = (float)$menu_price * (int)$quantity;

                    echo "<tr>";
                    echo "<td>$menu_id</td>";
                    echo "<td>$menu_name</td>"; 
                    echo "<td>$menu_price</td>";
                    echo "<td>$quantity</td>";
                    echo "<td>$total_amount</td>";
                    echo "<td>";
                    echo "<form method='POST' action='{$_SERVER['PHP_SELF']}'>";
                    echo "<input type='hidden' name='delete_menu_id' value='$menu_id'>";
                    echo "<button type='button' onclick='showDeleteConfirmation({$menu_id})'><i class='bx bx-trash'></i></button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";

                    // Calculate total amount
                    $totalAmount += $total_amount;
                }
                ?>
            </table>

            <!-- Place Order button -->
            <form action="order.php"  method="POST">
                <button name="place_order" type="submit"><i class='bx bx-list-check' style="font-size: 20px;"></i></button>
            </form>
        </div>
    </section>
</body>
<style>
.left-column {
    width: 50%;
    float: left;
    padding: 10px;
}

.right-column {
    width: 50%;
    float: left;
    padding: 10px;
}

/* Rest of the styles remain the same */
.search-container {
  padding-left: 20px;
  position: relative;
  display: inline-block;
}

.quantity-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
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
    padding: 5px 10px;
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
</style>
<script>
function showDeleteConfirmation(menu_id) {
    var confirmation = confirm("Are you sure you want to delete this food?");
    
    if (confirmation) {
        // If the user clicks "OK," submit the form to delete the item
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?php echo $_SERVER["PHP_SELF"]; ?>';

        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete_menu_id';
        input.value = menu_id;

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    }
    // If the user clicks "Cancel," do nothing
}
</script>

</html>

