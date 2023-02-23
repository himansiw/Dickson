<?php
include '../commons/fpdf181/fpdf.php';
include '../model/sale_model.php';
$saleObj= new Sale();
$data=$saleObj->sevenDay();
$totNet=$saleObj->sevenDayTotal();
$totRow=$totNet->fetch_assoc();

date_default_timezone_set('Asia/Colombo');
$currentdate = date("Y-m-d   g:i:s a");

//require('html_table.php');

class PDF extends FPDF
{
// Page header
    function Header()
    {
        // Logo
        $this->Image('../images/logo/logo.png', 15, 12, 33);
        // Arial bold 15
        $this->SetFont('Times','B',15);
        // Move to the right
        $this->Cell(40);
        // Title
        $this->Cell(120,14,'EXPRESS DICKSONS FOOD CITY - GALLE',0,1,'C');
        $this->SetFont('Times','',14);
        // Move to the right
        $this->Cell(36);
        $this->Cell(120,8,'392G Dangedara,Galle,Sri Lanka',0,1,'C');
        $this->SetFont('Times','',14);
        // Move to the right
        $this->Cell(36);
        $this->Cell(120,8,'No.0912 235 249',0,1,'C');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,' Copyright © Dickson Food City 2020',0,0,'C');
        //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(0,5,"Total income of sale orders for seven days",0,"1","L");
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15,10,"Date: ",0,"0");
$pdf->Cell(14,10,$currentdate,0,"1");
$pdf->Ln(10);
//set the form of pdf
$pdf->SetFont('Arial', 'B', 10);
//assign the form post value in a variable and pass it.
$pdf->setFillColor(230,230,230);
$pdf->Cell("30",10,"",0,"0",1);
$pdf->Cell("20",10,"#",1,"0",'C',1);
$pdf->Cell("50",10,"Sales Date",1,0,'C',1 );
$pdf->Cell("50",10,"Sub Total",1,"0",'C',1);
$pdf->Cell("20",10,"",0,"1");
$pdf->SetFont('Arial', '', 10);
$counter=0;
while($pr_row=$data->fetch_assoc()) {
    $counter++;
    $pdf->Cell("30",10,"",0,"0","C");
    $pdf->Cell(20, 10, "$counter", 1, "0","C");
    $pdf->Cell(50, 10, $pr_row["date"], 1, 0, "C");
    $pdf->Cell(50, 10,'Rs. '. number_format($pr_row["total_sales"], 2), 1, 0, "R");
    $pdf->Cell("20",10,"",0,"1");
}
$pdf->Cell("30",10,"",0,"0",1);
$pdf->Cell("70",10,"Total income",1,"0",'R');
$pdf->Cell("50",10,'Rs. '. number_format($totRow["income"], 2),1,"0","R");
$pdf->Cell("20",10,"",0,"1");

$pdf->Output();


