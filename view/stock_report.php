<?php

date_default_timezone_set('Asia/Colombo');
$currentdate = date("Y-m-d   g:i:s a");

require('html_table.php');
$pdf=new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);

$pdf->AliasNbPages();
//add page page automatically for its true parameter
$pdf->SetAutoPageBreak(true, 25);
//add images or logo which you want
$pdf->Image('../images/logo/logo.png', 15, 13, 33);
//set font style
$pdf->SetFont('Arial', 'B', 14);
//Break
$pdf->Ln(0);
$pdf->Cell(0,40,"EXPRESS DICKSONS FOOD CITY - GALLE",0,"1","R");
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(15,10,"Date: ",0,"0");
$pdf->Cell(14,10,$currentdate,0,"1");
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0,5,"Inventory Analysis",0,"1","L");
$pdf->Ln(10);
//set the form of pdf
$pdf->SetFont('Arial', 'B', 10);
//assign the form post value in a variable and pass it.
$pdf->setFillColor(230,230,230);
$pdf->Cell("10",8,"#",1,"0",1,1);
$pdf->Cell("50",8,"Product Name",1,0,1,1 );
$pdf->Cell("30",8,"SKU",1,0,1,1 );
$pdf->Cell("30",8,"Stock In",1,"0",1,1);
$pdf->Cell("30",8,"Stock Out",1,"0",1,1);
$pdf->Cell("30",8,"Available Stock",1,"1",1,1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell("10",8,"1",1,"0",1);
$pdf->Cell("50",8,"Brinjals 1KG",1,0,1 );
$pdf->Cell("30",8,"DS0001",1,"0",1);
$pdf->Cell("30",8,"18",1,"0",1);
$pdf->Cell("30",8,"10",1,"0",1);
$pdf->Cell("30",8,"8",1,"1",1);
$pdf->Cell("10",8,"2",1,"0",1);
$pdf->Cell("50",8,"Green Beans 1KG",1,0,1 );
$pdf->Cell("30",8,"DS0002",1,"0",1);
$pdf->Cell("30",8,"13",1,"0",1);
$pdf->Cell("30",8,"8",1,"0",1);
$pdf->Cell("30",8,"5",1,"1",1);
$pdf->Cell("10",8,"3",1,"0",1);
$pdf->Cell("50",8,"Dambala 1KG",1,0,1);
$pdf->Cell("30",8,"DS0003",1,"0",1);
$pdf->Cell("30",8,"10",1,"0",1);
$pdf->Cell("30",8,"4",1,"0",1);
$pdf->Cell("30",8,"6",1,"1",1);



$pdf->SetFont('Arial', 'B', 6);
$pdf->Output();

?>