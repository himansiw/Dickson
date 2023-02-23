<?php
include '../commons/session.php';
$user=$_SESSION["user"]["firstname"];
//Include the sale model
include '../model/sale_model.php';

$saleObj= new Sale();
//Get the invoice number in this customer invoice
$invoice_no=$_REQUEST["invoice_no"];
$salResult=$saleObj->getSale($invoice_no);
$salerow = $salResult->fetch_assoc();
//Get loyalty detail
$loyalty_result = $saleObj->getloyalDetails($invoice_no);
$loyalty_row = $loyalty_result->fetch_assoc();
//Get sale item details
$saleItemResult=$saleObj->getSaleItem($invoice_no);
//Count the no of pieces.
$qtyResult=$saleObj->getNoPieces($invoice_no);
//Get payment details
$paymentResult=$saleObj->getPaymentDetail($invoice_no);
$paymentrow = $paymentResult->fetch_assoc();
//Card detail
$cardResult= $saleObj->getCardDetail($invoice_no);
$cardrow = $cardResult->fetch_assoc();
if(isset($paymentrow["payment_mid"]) && $paymentrow["payment_mid"] == 2){
    $payment = $cardrow["card_method"];
}else{
    $payment = $paymentrow["payment_type"];//else then expect card
}


// Include the fpdf library
include '../commons/fpdf181/fpdf.php';
// Create the fpdf object
$fpdf= new FPDF();
$fpdf = new FPDF('p','mm',array(105,300));
$fpdf->SetTitle("DICKSONS Food city");
//Adding a pdf Page
$fpdf->AddPage("P","",0);
//Set the font
$fpdf->SetFont("Arial","","8");
$fpdf->Image('../images/logo/logo.png',35,5,28,0,'PNG');
//Break
$fpdf->Ln(0);
$fpdf->Cell(0,25,"",0,"1","C");
$fpdf->Cell(0,5,"No:39/2G,HENRY PEDIRIS MV",0,"1","C");
$fpdf->Cell(0,5,"DANGEDARA GALLE",0,"1","C");
$fpdf->Cell(0,5,"TEL: 0912235674",0,"1","C");
//Break
$fpdf->Ln(4);
$fpdf->Cell(15,5,"CASHIER : ",0,"0");
$fpdf->Cell(14,5,$user,0,"0");
$fpdf->Cell(10,5,"",0,"0");
$fpdf->Cell(18,5,"START TIME:",0,"0");
$fpdf->Cell(24,5, $salerow["sales_sdate"] ,0,"1");
$fpdf->Cell(15,5,"UNIT : ",0,"0");
$fpdf->Cell(14,5,"2",0,"0");
$fpdf->Cell(10,5,"",0,"0");
$fpdf->Cell(18,5,"INVOICE:",0,"0");
$fpdf->Cell(24,5,$salerow["invoice_no"] ,0,"1");

//Adding a break line
$fpdf->Line(10,70,95,70);
$fpdf->Line(10,76,95,76);

$fpdf->SetFont("Arial","","8");
$fpdf->Cell(80,5,"",0,"1");
$fpdf->Cell("8",8,"Ln",0,"0");
$fpdf->Cell("20",8,"ITEM",0,"0");
$fpdf->Cell("13",8,"QTY",0,0);
$fpdf->Cell("15",8,"U/PRICE",0,"0");
$fpdf->Cell("15",8,"O/PRICE",0,0);
$fpdf->Cell("20",8,"AMOUNT",0,1);

$counter=0;
$fpdf->SetFont("Arial","","8");
while($pr_row=$saleItemResult->fetch_assoc()) {
    $counter++;
    $fpdf->Cell(8, 4, "$counter", 0, "0");
    $fpdf->Cell(52, 4, $pr_row["pcode"] . " " . $pr_row["saleproduct_id"], 0, "1");
    $fpdf->Cell(28, 5, "", 0, 0, "C");
    $fpdf->Cell(13, 5,number_format($pr_row["sqty"], 3), 0, 0, "C");
    $fpdf->Cell(15, 5,number_format($pr_row["sale_rprice"], 2), 0, 0, "C");
    $fpdf->Cell(15, 5,number_format($pr_row["sdiscount"],2) , 0, 0, "C");
    $fpdf->Cell(20, 5,number_format($pr_row["subprice_amount"],2) , 0, 1,"C");
}

//$fpdf->Line(10,132,95,132);
//$fpdf->Line(10,154,95,154);



$fpdf->Cell(80,3,"",0,"1");
$fpdf->Cell(25,5,"Gross Amount","0,1,0,0","0");
$fpdf->Cell(48,5,"",0,"0");
$fpdf->Cell(15,5,$salerow["stotal"],0,"1","R");

$fpdf->Cell(27,5,"Promotion Discount",0,"0");
$fpdf->Cell(46,5,"",0,"0");
$fpdf->Cell(15,5,$salerow["distotal"],0,"1","R");

$fpdf->SetFont("Arial","B","9");
$fpdf->Cell(25,5,"Net Amount",0,"0");
$fpdf->Cell(48,5,"",0,"0");
$fpdf->SetFont("Arial","","8");
$fpdf->Cell(15,5,$salerow["netotal"],0,"1","R");

$fpdf->Cell(25,5,$payment,0,"0");
$fpdf->Cell(48,5,"",0,"0");
$fpdf->Cell(15,5,$salerow["paid"],0,"1","R");

$fpdf->Cell(132,3,"--------------------------------------------------------------------------------------------",0,1);

$fpdf->Cell(5,5,"",0,"1");
$fpdf->SetFont("Arial","B","9");
$fpdf->Cell(25,5,"Balance",0,"0");
$fpdf->Cell(48,5,"",0,"0");
$fpdf->SetFont("Arial","","8");
$fpdf->Cell(15,5,$salerow["due"],0,"1","R");

$fpdf->Cell(80,5,"",0,"1");
$fpdf->SetFont("Arial","B","8");

if(!is_null($loyalty_row)) {
    $fpdf->Cell(0, 5, "Loyalty Card Details", "0,1,0,0", "1", "C");
    $fpdf->Cell(80, 5, "", 0, "1");
    $fpdf->SetFont("Arial", "", "8");

    $fpdf->Cell(132, 3, "--------------------------------------------------------------------------------------------", 0, 1);


    $fpdf->Cell(25, 5, "Cus.Name:", 0, "0");
    $fpdf->Cell(40, 5, $loyalty_row["scus_id"], 0, "1");
    $fpdf->Cell(25, 5, "Card Num:", 0, "0");
    $fpdf->Cell(40, 5, $loyalty_row["sale_cardno"], 0, "1");
    $fpdf->Cell(25, 5, "C.Points:", 0, "0");
    $fpdf->Cell(40, 5, $loyalty_row["c_point"], 0, "1");
    $fpdf->Cell(25, 5, "Earn Value:", 0, "0");
    $fpdf->Cell(40, 5, $loyalty_row["c_point"], 0, "1");
    $fpdf->Cell(25, 5, "Redeem Points:", 0, "0");
    $fpdf->Cell(40, 5, $loyalty_row["r_point"], 0, "1");
    $fpdf->Cell(25, 5, "Balance Points:", "0,0,0,1", "0");
    $fpdf->Cell(40, 5, $loyalty_row["r_value"], 0, "1");
    $fpdf->Line(10, "", 95, "");
}
$fpdf->SetFont("Arial","","8");

$fpdf->Cell(80,5,"",0,"1");
$fpdf->Cell(22,5,"NO OF ITEMS : ",0,"0");
$fpdf->Cell(14,5,$counter,0,"0");
$fpdf->Cell(6,5,"",0,"0");
$fpdf->Cell(16,5,"END TIME : ",0,"0");
$fpdf->Cell(14,5,$salerow["sales_fdate"],0,"1");
$fpdf->Cell(22,5,"NO OF PIECES:",0,"0");
$fpdf->Cell(24,5,$qtyResult,0,"1");

$fpdf->Cell(80,6,"",0,"1");
$fpdf->Cell(0,5,"THANK YOU FOR SHOPPING AT ",0,"1","C");
$fpdf->Cell(0,5,"DICKSONS FOOD CITY",0,"1","C");
$fpdf->Cell(0,5,"Exchange possible with in 7 days",0,"1","C");
$fpdf->Cell(0,5,"Bill must be submit to cashier",0,"1","C");
$fpdf->Cell(0,5,"**(c) Retail 076 3 123091**",0,"1","C");



//    $date=date("Y-m-d");
//    $d1=$date."";
//    $filename="Invoice_$d1.pdf";
//    $path="../documents/invoice/$filename";
//    $fpdf->Output("$filename.pdf","D");
    $fpdf->Output();







