<?php
require('fpdf.php'); // Include the FPDF library

// Database connection
include('db_connect.php');

// Fetch loan data with concatenated client and guarantor names
$query = "SELECT 
    l.loan_id, 
    l.client_id, 
    CONCAT(c.first_name, ' ', c.last_name) AS client_name,
    l.loan_amount, 
    l.loan_type, 
    l.interest_rate, 
    l.repayment_period, 
    l.guarantor_id, 
    CONCAT(g.g_first_name, ' ', g.g_last_name) AS guarantor_name,
    l.start_date, 
    l.due_date 
FROM loan l
LEFT JOIN clients c ON l.client_id = c.client_id
LEFT JOIN guarantors g ON l.guarantor_id = g.guarantor_id";
$result = mysqli_query($conn, $query);

// Create instance of FPDF class
$pdf = new FPDF('P', 'mm', 'A3');
$pdf->AddPage();

// Set title
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(200, 10, 'Loan Details Report', 0, 1, 'C');

// Add column headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Loan ID', 1);
$pdf->Cell(40, 10, 'Client Name', 1);      // Increased width for names
$pdf->Cell(30, 10, 'Loan Amount', 1);
$pdf->Cell(30, 10, 'Loan Type', 1);
$pdf->Cell(30, 10, 'Interest Rate', 1);
$pdf->Cell(30, 10, 'Repayment', 1);
$pdf->Cell(40, 10, 'Guarantor Name', 1);   // Increased width for names
$pdf->Cell(30, 10, 'Start Date', 1);
$pdf->Cell(30, 10, 'Due Date', 1);
$pdf->Ln();

// Add data from database to the report
$pdf->SetFont('Arial', '', 12);
while ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(30, 10, $row['loan_id'], 1);
    $pdf->Cell(40, 10, $row['client_name'], 1);      // Display full client name
    $pdf->Cell(30, 10, $row['loan_amount'], 1);
    $pdf->Cell(30, 10, $row['loan_type'], 1);
    $pdf->Cell(30, 10, $row['interest_rate'], 1);
    $pdf->Cell(30, 10, $row['repayment_period'], 1);
    $pdf->Cell(40, 10, $row['guarantor_name'], 1);   // Display full guarantor name
    $pdf->Cell(30, 10, $row['start_date'], 1);
    $pdf->Cell(30, 10, $row['due_date'], 1);
    $pdf->Ln();
}

// Output the PDF
$pdf->Output('D', 'loan_report.pdf'); // This will force the browser to download the PDF
?>