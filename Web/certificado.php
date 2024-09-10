<?php
require('../fpdf/fpdf.php');

// Participantes
$participants = array(
    array('name' => 'John Doe'),
    array('name' => 'Jane Smith'),
    array('name' => 'Bob Johnson'),
    array('name' => 'Alice Lee' )
);

// Create PDF object
$pdf = new FPDF('P', 'mm', 'A4');

// Loop through participants
foreach($participants as $participant) {

    // Add new page
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('Arial','B',24);

    // Add title
    $pdf->Cell(0,40,'Certificate of Participation',0,1,'C');
    $pdf->Ln(10);

    // Add content
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,20,'This certificate is awarded to',0,1,'C');
    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,20,$participant['name'],0,1,'C');
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,20,'For their participation in a mathematics competition',0,1,'C');
    $pdf->Ln(20);

    // Add signature
    $pdf->SetFont('Arial','B',16);
    $pdf->Line(10, 230, 70, 230); // draw signature line
   
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,130,'Director',0,1,'l');

    // Add date
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,-80,'Date: '.date('d/m/Y'),0,1,'R');
}

// Output PDF
$pdf->Output();
