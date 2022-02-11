<?php
// include composer packages
// include "vendor/autoload.php";
// header('Content-type: application/pdf');
// Create new Landscape PDF
// $pdf = new \setasign\Fpdi\Fpdi('l');
$pdf = new \setasign\Fpdi\Fpdi('l');

// asset('storage/OXMeHsPfVXL1AKip3ruuZmCWtKHSN5nnT8hw9QP0.jpg')
// $i = asset('storage/OXMeHsPfVXL1AKip3ruuZmCWtKHSN5nnT8hw9QP0.jpg');
// Reference the PDF you want to use (use relative path)
// $pagecount = $pdf->setSourceFile(asset('/storage/uDUZB8w6uDtAgVtfBvKLYSaGQBgaYqtmdYyaJi0H.pdf'));
$pagecount = $pdf->setSourceFile(public_path('/storage/certificate.pdf'));
// $pagecount = $pdf->setSourceFile( "asset('http://127.0.0.1:8000/storage/OXMeHsPfVXL1AKip3ruuZmCWtKHSN5nnT8hw9QP0.jpg')" );

// http://127.0.0.1:8000/storage/certificate.pdf

// Import the first page from the PDF and add to dynamic PDF
$tpl = $pdf->importPage(1);
$pdf->AddPage();

// Use the imported page as the template
$pdf->useTemplate($tpl);

// Set the default font to use
$pdf->SetFont('Helvetica');

// adding a Cell using:
// $pdf->Cell( $width, $height, $text, $border, $fill, $align);

// First box - the user's Name
$pdf->SetFontSize('20'); // set font size
$pdf->SetXY(100, 89); // set the position of the box
$pdf->Cell(100, 10, 'Sheharyar Mehmood', 1, 1, 'C'); // add the text, align to Center of cell

// add the reason for certificate
// note the reduction in font and different box position
$pdf->SetFontSize('20');
$pdf->SetXY(80, 105);
$pdf->Cell(150, 10, 'creating an awesome tutorial', 1 , 1, 'C');

// the day
$pdf->SetFontSize('20');
$pdf->SetXY(118,122);
$pdf->Cell(20, 10, date('d'), 1, 0, 'C');

// the month
$pdf->SetXY(160,122);
$pdf->Cell(30, 10, date('M'), 1, 0, 'C');

// the year, aligned to Left
$pdf->SetXY(200,122);
$pdf->Cell(20, 10, date('y'), 1, 0, 'L');

ob_get_clean(); 
// render PDF to browser
$pdf->Output('I');
?>

