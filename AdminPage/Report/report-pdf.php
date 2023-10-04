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

    function CellContent($width, $height, $text, $border = 0, $align = 'L', $fill = false)
    {
        $this->Cell($width, $height, $text, $border, 0, $align, $fill);
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

// Create a table for the Daily Report
$pdf->Title('Daily Report'. " (" . date('Y/m/d') . ")\n");
$pdf->CellContent(50, 10, 'Report Type', 1);
$pdf->CellContent(60, 10, 'Period', 1);
$pdf->CellContent(50, 10, 'Total Sales', 1);
$pdf->Ln();
$pdf->CellContent(50, 10, 'Daily Report', 1);
$pdf->CellContent(60, 10, date('Y/m/d'), 1);
$pdf->CellContent(50, 10, "RM " . number_format($totalDaily, 2), 1);
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

// Create a table for the Weekly Report
$pdf->Title('Weekly Report' . '(' . $currentWeekStart . ' to ' . date('Y/m/d') . ')');
$pdf->CellContent(50, 10, 'Report Type', 1);
$pdf->CellContent(60, 10, 'Period', 1);
$pdf->CellContent(50, 10, 'Total Sales', 1);
$pdf->Ln();
$pdf->CellContent(50, 10, 'Weekly Report', 1);
$pdf->CellContent(60, 10, $currentWeekStart . ' to ' . date('Y/m/d'), 1);
$pdf->CellContent(50, 10, "RM " . number_format($totalWeek, 2), 1);
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

// Create a table for the Monthly Report
$pdf->Title('Monthly Report' . ' (' . $currentMonthStart . ' to ' . date('Y/m/t') . ')');
$pdf->CellContent(50, 10, 'Report Type', 1);
$pdf->CellContent(60, 10, 'Period', 1);
$pdf->CellContent(50, 10, 'Total Sales', 1);
$pdf->Ln();
$pdf->CellContent(50, 10, 'Monthly Report', 1);
$pdf->CellContent(60, 10, $currentMonthStart . ' to ' . date('Y/m/t'), 1);
$pdf->CellContent(50, 10, "RM " . number_format($totalMonth, 2), 1);
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

// Create a table for the Yearly Report
$pdf->Title('Yearly Report' . ' (' . $currentYearStart . ' to ' . date('Y/12/t') . ')');
$pdf->CellContent(50, 10, 'Report Type', 1);
$pdf->CellContent(60, 10, 'Period', 1);
$pdf->CellContent(50, 10, 'Total Sales', 1);
$pdf->Ln();
$pdf->CellContent(50, 10, 'Yearly Report', 1);
$pdf->CellContent(60, 10, $currentYearStart . ' to ' . date('Y/12/t'), 1);
$pdf->CellContent(50, 10, "RM " . number_format($totalYear, 2), 1);
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

// Create a table for the Total Sales Section
$pdf->Title('Total Sales');
$pdf->CellContent(50, 10, 'Report Type', 1);
$pdf->CellContent(60, 10, 'Period', 1);
$pdf->CellContent(50, 10, 'Total Sales', 1);
$pdf->Ln();
$pdf->CellContent(50, 10, 'Total Sales', 1);
$pdf->CellContent(60, 10, $currentYearStart . ' to ' . date('Y/m/d'), 1);
$pdf->CellContent(50, 10, "RM " . number_format($totalSales, 2), 1);
$pdf->Ln();

// Continue with other reports and content as needed...

// Signature Section
$pdf->Ln(20);
$pdf->SetFont('Times', 'B', 12); // Change to Times, bold, size 12
$pdf->CellContent(0, 10, 'Signature:', 0, 'L');
$pdf->Ln(8);
$pdf->SetFont('Times', '', 12); // Change back to Times, regular, size 12
$pdf->CellContent(0, 10, 'Christian', 0, 'L');
$pdf->Ln();

$pdf->Output('Report (' . date('Y-m-d') . ').pdf', 'D');
ob_end_flush();
?>
