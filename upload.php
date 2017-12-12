<?php
require('library_to_pdf/fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->WriteHTML('<p>Hola</p>');
$pdf->Output();
?>