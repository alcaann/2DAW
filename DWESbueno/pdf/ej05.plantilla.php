<?php

//Imprime en una plantilla pdf
require_once('./fpdf/fpdf.php');

require_once('./fpdi/fpdi.php');



// initiate FPDI
$pdf = new FPDI();
// add a page
$pdf->AddPage();
// set the source file
//$pdf->setSourceFile("/docs/factura.pdf");
$pdf->setSourceFile("factura.pdf");
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at point 0,0 with a width of 210 mm DIN A4 297*210
$pdf->useTemplate($tplIdx, 0, 0, 210);

// now write some text above the imported page
$pdf->SetFont('Helvetica');
$pdf->SetTextColor(255, 0, 0);
$pdf->SetXY(20, 20);
$pdf->Write(0, 'Is is just a simple text');
$paso = 10;
$pdf->SetXY(20+$paso, 20+$paso);
$pdf->Write(0, 'Is just a simple text');
$pdf->Output();
?>