<!--Christian-->
<?php
require('../fpdf186/fpdf.php');
require_once '../db.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 10, "The Chubs Grills", 0, 1, 'C');
        $this->Ln(0);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Total Sales of Food Report', 0, 0, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function Title($title)
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $title, 0, 1, 'L');
        $this->Ln(2);
    }

    function Body($body)
    {
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 6, $body);
        $this->Ln(2);
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Set the current date
$currentDate = date('Y/m/d');

// Calculate total sales for today
$totalSalesDaily = "SELECT SUM(total) AS total_sales FROM order_food
                        INNER JOIN menu ON order_food.menu_id = menu.menu_id
                        INNER JOIN orders ON order_food.order_id = orders.order_id
                        WHERE DATE(orders.order_time) = '$currentDate'";
$dailyResult = mysqli_query($conn, $totalSalesDaily);

if (!$dailyResult) {
    die("Query failed: " . mysqli_error($conn));
}

$dailyRow = mysqli_fetch_assoc($dailyResult);
$totalDaily = $dailyRow['total_sales'];

// Daily Report
$pdf->Title('Daily Report'. " (" . date('Y/m/d') . ")\n");
$pdf->Body("RM " . number_format($totalDaily, 2));
$pdf->Ln();

// Calculate total sales for this week (assuming week starts on Monday)
$currentWeekStart = date('Y/m/d', strtotime('monday this week'));
$weekTotalSales = "SELECT SUM(total) AS total_sales FROM order_food
                            INNER JOIN menu ON order_food.menu_id = menu.menu_id
                            INNER JOIN orders ON order_food.order_id = orders.order_id
                            WHERE DATE(orders.order_time) >= '$currentWeekStart'";
$weekTotalSalesResult = mysqli_query($conn, $weekTotalSales);

if (!$weekTotalSalesResult) {
    die("Query failed: " . mysqli_error($conn));
}

$weekTotalSalesRow = mysqli_fetch_assoc($weekTotalSalesResult);
$totalWeek = $weekTotalSalesRow['total_sales'];

// Weekly Report
$pdf->Title('Weekly Report' . '(' . $currentWeekStart . ' to ' . date('Y/m/d') . ')');
$pdf->Body("RM " . number_format($totalWeek, 2));
$pdf->Ln();

// Calculate total sales for this month
$currentMonthStart = date('Y/m/01');
$monthTotalSales = "SELECT SUM(total) AS total_sales FROM order_food
                            INNER JOIN menu ON order_food.menu_id = menu.menu_id
                            INNER JOIN orders ON order_food.order_id = orders.order_id
                            WHERE DATE(orders.order_time) >= '$currentMonthStart'";
$monthTotalSalesResult = mysqli_query($conn, $monthTotalSales);

if (!$monthTotalSalesResult) {
    die("Query failed: " . mysqli_error($conn));
}

$monthTotalSalesRow = mysqli_fetch_assoc($monthTotalSalesResult);
$totalMonth = $monthTotalSalesRow['total_sales'];

// Monthly Report
$pdf->Title('Monthly Report' . ' (' . $currentMonthStart . ' to ' . date('Y/m/t') . ')');
$pdf->Body("RM " . number_format($totalMonth, 2));
$pdf->Ln();

// Calculate total sales for this year
$currentYearStart = date('Y/01/01');
$yearTotalSales = "SELECT SUM(total) AS total_sales FROM order_food
                            INNER JOIN menu ON order_food.menu_id = menu.menu_id
                            INNER JOIN orders ON order_food.order_id = orders.order_id
                            WHERE DATE(orders.order_time) >= '$currentYearStart'";
$yearTotalSalesResult = mysqli_query($conn, $yearTotalSales);

if (!$yearTotalSalesResult) {
    die("Query failed: " . mysqli_error($conn));
}

$yearTotalSalesRow = mysqli_fetch_assoc($yearTotalSalesResult);
$totalYear = $yearTotalSalesRow['total_sales'];

// Yearly Report
$pdf->Title('Yearly Report' . ' (' . $currentYearStart . ' to ' . date('Y/12/t') . ')');
$pdf->Body("RM " . number_format($totalYear, 2));
$pdf->Ln();

// Calculate total sales for the entire period
$totalSalesQuery = "SELECT SUM(total) AS total_sales FROM order_food
                    INNER JOIN menu ON order_food.menu_id = menu.menu_id
                    INNER JOIN orders ON order_food.order_id = orders.order_id
                    WHERE DATE(orders.order_time) >= '$currentYearStart'";
$totalSalesResult = mysqli_query($conn, $totalSalesQuery);

if (!$totalSalesResult) {
    die("Query failed: " . mysqli_error($conn));
}

$totalSalesRow = mysqli_fetch_assoc($totalSalesResult);
$totalSales = $totalSalesRow['total_sales'];

// Total Sales Section
$pdf->Title('Total Sales');
$pdf->Body("RM " . number_format($totalSales, 2));
$pdf->Ln();

$pdf->Ln();

$pdf->Output('Report (' . date('Y-m-d') . ').pdf', 'D');
ob_end_flush();
?>
