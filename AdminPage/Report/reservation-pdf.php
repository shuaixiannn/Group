<?php
require('../fpdf186/fpdf.php');
require_once '../db.php';

$id = $_GET['id'];

// Function to fetch reservation information by reservation ID
function getReservationId($conn, $id) {
    $query = "SELECT * FROM reservations WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $info = mysqli_fetch_assoc($result);
        return $info;
    } else {
        return null;
    }
}

$info = getReservationId($conn, $id);

// Create a PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Reservation Details', 0, 1, 'C');
$pdf->Ln(10);

// Content
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'ID:', 0);
$pdf->Cell(0, 10, $info['id'], 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Name:', 0);
$pdf->Cell(0, 10, $info['name'], 0, 1);

$pdf->Cell(40, 10, 'Contact Number:', 0);
$pdf->Cell(0, 10, $info['contact'], 0, 1);

$pdf->Cell(40, 10, 'Reservation Date:', 0);
$pdf->Cell(0, 10, $info['reservation_date'], 0, 1);

$pdf->Cell(40, 10, 'Reservation Time:', 0);
$pdf->Cell(0, 10, $info['reservation_time'], 0, 1);

$pdf->Cell(40, 10, 'Number of Guests:', 0);
$pdf->Cell(0, 10, $info['num_guest'], 0, 1);

$pdf->Cell(40, 10, 'Table Number:', 0);
$pdf->Cell(0, 10, 'Table ' . $table, 0, 1);

// Output the PDF
$pdf->Output('Reservation Notification (' . date('Y-m-d') . ').pdf', 'D');
?>
